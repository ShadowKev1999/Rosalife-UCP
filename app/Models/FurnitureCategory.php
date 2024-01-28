<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\FurnitureModel;
use App\Models\Account;

class FurnitureCategory extends Model
{
    use HasFactory;

    protected $table = "furniture_category";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'name',
        'creator',
        'created_at',
    ];

    public function models() {
        return $this->hasMany(FurnitureModel::class, 'catalogid', 'id');
    }

    public function userCreator() {
        return $this->hasOne(Account::class, 'ID', 'creator');
    }
}
