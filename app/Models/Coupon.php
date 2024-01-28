<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = "player_coupons";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'couponId',
        'servertime',
    ];
}
