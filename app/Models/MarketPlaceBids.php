<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPlaceBids extends Model
{
    use HasFactory;

    protected $table = "marketplace_bids";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'offerId',
        'userId',
        'created_at',
        'amount',
    ];

    public function player() {
        return $this->hasOne(Account::class, 'ID', 'userId');
    }
}
