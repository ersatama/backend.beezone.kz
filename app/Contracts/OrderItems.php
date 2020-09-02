<?php


namespace App\Contracts;


class OrderItems implements DB
{
    const NAME          = 'order_items';

    const USER_ID       = 'user_id';
    const ORDER_ID      = 'order_id';
    const TITLE         = 'title';
    const CATEGORY_ID   = 'category_id';
    const COUNT         = 'count';
    const PRICE         = 'price';
}
