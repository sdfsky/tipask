<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table = 'exchanges';
    protected $fillable = ['name', 'logo','post_type','description','icons','remnants','status'];
}
