<?php

namespace App\Models;

use App\Models\Relations\BelongsToCategoryTrait;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use BelongsToCategoryTrait;
    protected $table = 'goods';
    protected $fillable = ['name', 'logo','post_type','description','coins','remnants','category_id','status'];





}
