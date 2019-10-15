<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use BelongsToUserTrait;
    protected $table = 'payments';
    protected $fillable = ['user_id','order_no','trade_no','money','channel','pay_status','source_type','source_id'];

}
