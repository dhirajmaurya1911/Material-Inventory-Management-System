<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

class MaterialTransaction extends Model
{
    protected $fillable = [
        'material_id',
        'transaction_date',
        'quantity',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'quantity' => 'decimal:2',
    ];

    
     //Transaction belongs to one material.
    
    public function material()
    {
        return $this->belongsTo(
            Material::class,
            'material_id'
        );
    }
}