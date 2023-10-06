<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\PaginateData;

class Cart extends Model
{
    use HasFactory, PaginateData;
    protected $guarded = [];

    public function Product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
