<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SaleItem;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $guarded  = [];


    public function saleItem(): HasMany
    {
        return $this->hasMany(SaleItem::class, 'item_id', 'id');
    }
}
