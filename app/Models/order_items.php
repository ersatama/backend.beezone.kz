<?php

namespace App\Models;

use App\Contracts\OrderItems;
use App\Contracts\Orders as OrdersContract;
use Illuminate\Database\Eloquent\Model;
use App\Models\orders;

class order_items extends Model
{
    protected $fillable = [
        OrderItems::ORDER_ID,
        OrderItems::CATEGORY_ID,
        OrderItems::TITLE,
        OrderItems::COUNT,
        OrderItems::PRICE,
        OrderItems::DEL,
    ];

    public function order() {
        return $this->belongsTo(orders::class,OrdersContract::ID,OrderItems::ORDER_ID);
    }
}
