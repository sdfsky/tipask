<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    use BelongsToUserTrait;
    //
    protected $table = 'operation_log';
    protected $guarded = [];
    public $timestamps = false;
}
