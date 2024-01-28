<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Economy extends Model
{
    use HasFactory;

    protected $table = "server_economy";

    protected $primaryKey = "economyId";

    public $timestamps = false;

    protected $fillable = [
        'value',
        'updated_at',
    ];
}
