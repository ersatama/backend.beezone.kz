<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Categories\CategoriesRepositoryEloquent;

class CategoryController extends Controller
{
    private $category;
    public function __construct()
    {
        $this->category = new CategoriesRepositoryEloquent;
    }

    public function getByBrandId($brandId, Request $request) {
        return $this->category->getByBrandId($brandId, $request);
    }

    public function getByBrandIdAndGoodsId($brandId, $goodsId, Request $request) {
        return $this->category->getByBrandIdAndGoodsId($brandId, $goodsId, $request);
    }

}
