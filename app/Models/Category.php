<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Material;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    
    // One category can have many materials.
    
    public function materials()
    {
        return $this->hasMany(Material::class, 'category_id');
    }
}