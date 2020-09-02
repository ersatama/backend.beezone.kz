<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Orders as OrdersContract;
use App\Contracts\OrderItems;

class orders extends Model
{

    protected $fillable = [
        OrdersContract::CODE,
        OrdersContract::USER_ID,
        OrdersContract::ADDRESS,
        OrdersContract::TIME_ID,
        OrdersContract::PAYMENT_ID,
        OrdersContract::COMMENT,
        OrdersContract::STATUS,
        OrdersContract::DEL,
    ];

    public function items() {
        return $this->hasMany(order_items::class,OrderItems::ORDER_ID,OrdersContract::ID);
    }

}
