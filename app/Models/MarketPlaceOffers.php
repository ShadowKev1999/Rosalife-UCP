<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Account;
use App\Models\MarketPlaceBids;

class MarketPlaceOffers extends Model
{
    use HasFactory;

    protected $table = "marketplace_offers";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'userId',
        'created_at',
        'offerType',
        'goodsType',
        'goodsId',
        'buyNow',
        'biddingStart',
        'biddingSteps',
        'endDate',
    ];

    public function player() {
        return $this->hasOne(Account::class, 'ID', 'userId');
    }

    public function bidding() {
        return $this->hasMany(MarketPlaceBids::class, 'offerId', 'id');
    }
}
