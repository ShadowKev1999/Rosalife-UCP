<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerRemoves extends Model
{
    use HasFactory;

    protected $table = "mapping_removes";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'modelid',
        'mapId'
    ];
}
