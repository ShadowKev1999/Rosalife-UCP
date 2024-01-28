<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPickup extends Model
{
    use HasFactory;

    protected $table = "server_pickups";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'x',
        'y',
        'z',
        'model',
        'world',
        'interior',
        'type',
        'text',
    ];
}
