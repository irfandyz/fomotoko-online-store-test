<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
use App\Models\FlashSale;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function flashSale(): BelongsTo
    {
        return $this->belongsTo(FlashSale::class);
    }
}
