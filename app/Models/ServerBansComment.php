<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerBansComment extends Model
{
    use HasFactory;

    protected $table = "accbans_comments";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'banId',
        'userId',
        'commentText',
        'created_at',
    ];

    public function userData() {
        return $this->hasOne(Account::class, 'ID', 'userId');
    }
}
