<?php

namespace App\Models;

use App\Models\Relations\BelongsToCategoryTrait;
use App\Models\Relations\BelongsToUserDataTrait;
use App\Models\Relations\BelongsToUserTrait;
use App\Models\Relations\MorphManyCommentsTrait;
use App\Models\Relations\MorphManyTagsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class Question extends Model
{
    use BelongsToUserTrait, MorphManyCommentsTrait, MorphManyTagsTrait, BelongsToCategoryTrait;
    protected $table = 'questions';
    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'description',
        'price',
        'hide',
        'status',
        'device',
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        /*监听问题创建*/
        static::creating(function ($question) {
            /*开启问题审核状态检查*/
            if (Setting()->get('verify_question') == 1 && $question->status != -1) {
                $question->status = 0;
            }
        });

        static::saved(function ($question) {
            if (Setting()->get('xunsearch_open', 0) == 1) {
                App::offsetGet('search')->update($question);
            }
        });


        static::deleted(function ($question) {

            /*删除回答数据*/
            Answer::where("question_id", "=", $question->id)->delete();

            UserData::where("user_id", "=", $question->user_id)->where("questions", ">", 0)->decrement('questions');
            /*删除问题评论*/
            Comment::where('source_type', '=', get_class($question))->where('source_id', '=', $question->id)->delete();

            /*删除动态*/
            Doing::where('source_type', '=', get_class($question))->where('source_id', '=', $question->id)->delete();

            /*删除问题关注*/
            Attention::where('source_type', '=', get_class($question))->where('source_id', '=',
                $question->id)->delete();

            /*删除标签关联*/
            Taggable::where('taggable_type', '=', get_class($question))->where('taggable_id', '=',
                $question->id)->delete();

            /*删除问题邀请*/
            QuestionInvitation::where('question_id', '=', $question->id)->delete();

            /*删除问题收藏*/
            Collection::where('source_type', '=', get_class($question))->where('source_id', '=',
                $question->id)->delete();

            if (Setting()->get('xunsearch_open', 0) == 1) {
                App::offsetGet('search')->delete($question);
            }

        });
    }

    public function getImagesAttribute($value)
    {
        if ($value) {
            return explode(",", $value);
        }
        return [];
    }

    /*获取相关问题*/
    public static function correlations($tagIds, $size = 6)
    {
        $questions = self::whereHas('tags', function ($query) use ($tagIds) {
            $query->whereIn('tag_id', $tagIds);
        })->orderBy('created_at', 'DESC')->take($size)->get();
        return $questions;
    }


    /*热门问题*/
    public static function hottest($categoryId = 0, $pageSize = 20)
    {
        $query = self::with('user');
        $category = Category::findFromCache($categoryId);
        if ($category) {
            $query->whereIn('category_id', $category->getSubIds());
        }
        if(Setting()->get('hot_content_period',365)){
            $query->where('created_at', ">" , Carbon::now()->subDays(Setting()->get('hot_content_period',365)));
        }
        $list = $query->where('status', '>', 0)->orderBy('views', 'DESC')->orderBy('answers',
            'DESC')->orderBy('created_at', 'DESC')->paginate($pageSize);
        return $list;

    }

    /*最新问题*/
    public static function newest($categoryId = 0, $pageSize = 20)
    {
        $query = self::with('user');
        $category = Category::findFromCache($categoryId);
        if ($category) {
            $query->whereIn('category_id', $category->getSubIds());
        }
        $list = $query->where('status', '>', 0)->orderBy('created_at', 'DESC')->paginate($pageSize);
        return $list;
    }

    /*未回答的*/
    public static function unAnswered($categoryId = 0, $pageSize = 20)
    {
        $query = self::query();
        $category = Category::findFromCache($categoryId);

        if ($category) {
            $query->whereIn('category_id', $category->getSubIds());
        }
        $list = $query->where('status', '>', 0)->where('answers', '=', 0)->orderBy('created_at',
            'DESC')->paginate($pageSize);
        return $list;
    }

    /*悬赏问题*/
    public static function reward($categoryId = 0, $pageSize = 20)
    {
        $query = self::query();
        $category = Category::findFromCache($categoryId);

        if ($category) {
            $query->whereIn('category_id', $category->getSubIds());
        }
        $list = $query->where('status', '>', 0)->where('price', '>', 0)->orderBy('created_at',
            'DESC')->paginate($pageSize);
        return $list;
    }

    /*最近热门问题*/
    public static function recent()
    {
        $list = Cache::remember('recent_questions', 300, function () {
            return self::where('status', '>', 0)->where('created_at', '>', Carbon::today()->subWeek())->orderBy('views',
                'DESC')->orderBy('answers', 'DESC')->orderBy('created_at', 'DESC')->take(12)->get();
        });

        return $list;
    }

    /*是否已经邀请用户回答了*/
    public function isInvited($sendTo, $fromUserId)
    {
        return $this->invitations()->where("send_to", "=", $sendTo)->where("from_user_id", "=", $fromUserId)->count();
    }


    /*问题搜索*/
    public static function search($word, $size = 16)
    {

        $query = self::query();

        foreach (explode(" ", $word) as $item) {
            $query->orWhere('title', 'like', "%$item%");
            $query->orWhere('description', 'like', "%$item%");
        }
        $list = $query->paginate($size);
        return $list;
    }


    /*问题所有回答*/
    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id');
    }


    /*问题所有邀请*/
    public function invitations()
    {
        return $this->hasMany('App\Models\QuestionInvitation', 'question_id');
    }

}
