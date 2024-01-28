<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPlayerHistory extends Model
{
    use HasFactory;
    
    protected $table = "server_players_history";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'amount',
        'created_at',
    ];
}
