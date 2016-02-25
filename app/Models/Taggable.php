<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Taggable extends Model
{
    protected $table = 'taggables';

    protected $fillable = ['source_type', 'source_id', 'tag_id'];


    public static function hottest($pageSize=20)
    {

       $taggables =  DB::table('taggables')->select('tag_id',DB::raw('COUNT(id) as total_num'))
            ->groupBy('tag_id')
            ->orderBy('total_num','desc')
            ->paginate($pageSize);
        return $taggables;

    }

}
