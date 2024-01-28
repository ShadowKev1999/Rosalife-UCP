<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Account;

class PlayerProtocol extends Model
{
    use HasFactory;

    protected $table = "player_protocol";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'userId',
        'ip',
        'created_at',
    ];

    public function userData() {
        return $this->hasOne(Account::class, 'ID', 'userId');
    }
}
