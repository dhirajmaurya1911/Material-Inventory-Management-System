<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MaterialTransaction;

class Material extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'opening_balance',
    ];

    protected $casts = [
        'opening_balance' => 'decimal:2',
    ];

    
     // Material belongs to one category.
     
    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id'
        );
    }

    
    // One material can have many transactions.
     
    public function transactions()
    {
        return $this->hasMany(
            MaterialTransaction::class,
            'material_id'
        );
    }

    /**
     * Calculate current material balance.
     *
     * Current Balance =
     * Opening Balance + All Transaction Quantities
     */
    public function getCurrentBalanceAttribute()
    {
        return $this->opening_balance
            + $this->transactions()->sum('quantity');
    }
}