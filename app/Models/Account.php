<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\LockableTrait;

class Account extends Authenticatable
{
    use HasFactory, LockableTrait;

    protected $table = "accounts";

    protected $primaryKey = "ID";

    public $timestamps = false;

    protected $guard = 'account';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Name',
        'Email',
        'Admin',
        'Passwort',
        'lockout_time',
        'is_email_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Passwort',
        'Remember_Token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Email_Verified_At' => 'datetime',
        'Passwort' => 'hashed',
    ];

    public function getAuthPassword() {
        return $this->Passwort;
    }

    public function houses() {
        return $this->hasMany(House::class, "Besitzer", "Name");
    }

    public function vehicles() {
        return $this->hasMany(Vehicle::class, "Besitzer", "Name");
    }

    public function transactionSender() {
        return $this->hasMany(MoneyTransfer::class, "Sender", "Name");
    }

    public function transactionGet() {
        return $this->hasMany(MoneyTransfer::class, "Kontoinhaber", "Name");
    }

    public function teamspeakuser() {
        return $this->hasMany(TeamspeakUser::class, "user_id", "ID");
    }
}
