<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerActor extends Model
{
    use HasFactory;

    protected $table = "server_actors";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'name',
        'x',
        'y',
        'z',
        'a',
        'animation',
        'skin',
    ];
}
