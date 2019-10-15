<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    use BelongsToUserTrait;
    //
    public $incrementing = false;
    protected $fillable = ['id', 'user_id','editor_content','subject','form_data','source_type','source_id'];

}
