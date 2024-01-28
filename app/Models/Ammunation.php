<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ammunation extends Model
{
    use HasFactory;

    protected $table = "ammunation";

    protected $primaryKey = "ID";

    public $timestamps = false;

    public function player() {
        return $this->hasOne(Account::class, 'Name', 'Besitzer');
    }
}
