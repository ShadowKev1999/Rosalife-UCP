<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioStation extends Model
{
    use HasFactory;

    protected $table = "vehicle_radios";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'radioName',
        'radioColor',
        'radioUrl',
        'radioActive',
    ];
}
