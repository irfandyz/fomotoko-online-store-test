<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\PaginateData;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory, PaginateData;
    protected $guarded = [];

    public function orderDetail(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
