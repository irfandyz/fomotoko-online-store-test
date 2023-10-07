<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Traits\PaginateData;
use App\Models\FlashSale;

class Product extends Model
{
    use HasFactory, PaginateData;
    protected $guarded = [];

    public function flashSale(): HasOne
    {
        return $this->hasOne(FlashSale::class);
    }
}
