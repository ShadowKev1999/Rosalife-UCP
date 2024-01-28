<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Account;

class ServerTimeline extends Model
{
    use HasFactory;

    protected $table = "server_timeline";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $dates = ['created_at'];

    protected $fillable = [
        'userId',
        'tagId',
        'description',
        'created_at',
    ];

    public function userData() {
        return $this->hasOne(Account::class, 'ID', 'userId');
    }
}
