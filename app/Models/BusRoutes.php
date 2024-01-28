<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BusRouteCp;

class BusRoutes extends Model
{
    use HasFactory;

    protected $table = "server_busroutes";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'color',
        'name',
        'skill',
        'bonusmoney',
        'jobexpbonus',
    ];

    public function checkpoints() {
        return $this->hasMany(BusRouteCp::class, 'busRoute', 'id');
    }
}
