<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDevice extends Model
{
    use HasFactory;

    protected $table = "atms";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'x',
        'y',
        'z',
        'rx',
        'ry',
        'rz',
        'money',
        'state',
        'interior',
    ];
}
