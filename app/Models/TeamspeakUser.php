<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamspeakUser extends Model
{
    use HasFactory;

    protected $table = "teamspeak_users";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'identity',
        'description',
    ];
}
