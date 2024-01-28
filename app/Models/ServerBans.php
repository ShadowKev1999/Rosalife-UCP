<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ServerBansComment;

class ServerBans extends Model
{
    use HasFactory;

    protected $table = "accbans";

    protected $primaryKey = "ID";

    public $timestamps = false;

    protected $fillable = [
        'Name',
        'Teammitglied',
        'Banngrund',
        'Uhrzeit',
        'Datum',
    ];

    public function comments() {
        return $this->hasMany(ServerBansComment::class, 'banId', 'ID');
    }
}
