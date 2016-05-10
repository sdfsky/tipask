<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendshipLink extends Model
{
    protected $table = 'friendship_links';
    protected $fillable = ['name', 'slogan','url','sort','status'];

}
