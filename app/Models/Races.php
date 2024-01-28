<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Races extends Model
{
    use HasFactory;

    protected $table = "races";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'race',
    ];
}
