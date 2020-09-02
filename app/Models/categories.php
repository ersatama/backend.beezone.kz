<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\goods;
use App\Contracts\Goods as GoodsContract;
use App\Contracts\Category;
class categories extends Model
{
    public function goods() {
        return $this->hasOne(goods::class, GoodsContract::ID, Category::GOODS_ID);
    }
}
