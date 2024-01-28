<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInfo extends Model
{
    use HasFactory;

    protected $table = "jobinfos";

    protected $primaryKey = "ID";

    public $timestamps = false;

    protected $fillable = [
        'Gehalt',
        'EXP',
        'jobName',
    ];
}
