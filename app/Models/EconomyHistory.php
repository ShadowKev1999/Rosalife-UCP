<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EconomyHistory extends Model
{
    use HasFactory;

    protected $table = "server_economy_history";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'economyId',
        'value',
        'created_at',
    ];
}
