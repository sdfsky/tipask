<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2018/5/9
 * Time: 下午6:41
 */

namespace App\Policies;


use App\Models\Article;
use App\Models\User;
use App\Policies\Traits\AdminTrait;

class ArticlePolicy
{
    use AdminTrait;

    public function create(User $user, Article $article){
        return $article->user_id == $user->id;
    }

    public function update(User $user,Article $article){
        return $article->user_id == $user->id;
    }

    public function updateInTime(User $user,Article $article){
        if( Setting()->get('edit_article_timeout') && $article->created_at->diffInMinutes() > Setting()->get('edit_article_timeout') ){
            return false;
        }
        return true;
    }

}