<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerObjects extends Model
{
    use HasFactory;

    protected $table = "mapping_objects";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'modelid',
        'mapId'
    ];
}
