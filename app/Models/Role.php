<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/6/20
 * Time: 下午6:14
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['id', 'name','description','slug'];


}