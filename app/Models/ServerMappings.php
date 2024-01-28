<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ServerObjects;
use App\Models\ServerRemoves;

class ServerMappings extends Model
{
    use HasFactory;

    protected $table = "mapping_list";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'name',
        'creator'
    ];

    public function objects() {
        return $this->hasMany(ServerObjects::class, 'mapId', 'id');
    }

    public function removes() {
        return $this->hasMany(ServerRemoves::class, 'mapId', 'id');
    }
}
