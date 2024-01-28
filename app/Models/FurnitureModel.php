<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\FurnitureCategory;

class FurnitureModel extends Model
{
    use HasFactory;

    protected $table = "furniture_model";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'catalogid',
        'name',
        'modelid',
        'price'
    ];

    public function category() {
        return $this->hasOne(FurnitureCategory::class, 'id', 'catalogid');
    }
}
