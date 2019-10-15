<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use BelongsToUserTrait;
    //
    public $table = 'report';

    protected $fillable = ['user_id','source_id','source_type','report_type','reason','subject'];

    public function source()
    {
        return $this->morphTo();
    }

    public function answer()
    {
        return $this->hasOne('App\Models\Answer', 'id', 'source_id');
    }
}
