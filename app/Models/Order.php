<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "ucp_coupons_orders";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'couponId',
        'referenceId',
        'status',
    ];
}
