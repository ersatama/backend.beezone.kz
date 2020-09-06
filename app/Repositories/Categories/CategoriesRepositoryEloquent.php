<?php


namespace App\Repositories\Categories;

use App\Models\categories;
use App\Contracts\Category;

class CategoriesRepositoryEloquent implements CategoriesRepositoryInterface
{

    private $take = 30;
    private $skip = 0;

    public function getByBrandId($brandId, $request) {
        if ($request->has('page')) {
            $this->skip = (int)$request->input('page') - 1;
        }
        return categories::with('goods')->where([
            [Category::BRAND_ID,$brandId],
            [Category::DEL,Category::DEL_ACTIVE]
        ])->skip($this->skip)->take($this->take)->get();
    }

    public function getById($id) {
        return categories::with('goods')->where([
            [Category::ID,$id],
            [Category::DEL,Category::DEL_ACTIVE]
        ])->first();
        return $id;
    }

    public function getByBrandIdAndGoodsId($brandId, $goodsId, $request) {
        if ($request->has('page')) {
            $this->skip = (int)$request->input('page') - 1;
        }
        return categories::with('goods')->where([
            [Category::BRAND_ID,$brandId],
            [Category::GOODS_ID,$goodsId],
            [Category::DEL,Category::DEL_ACTIVE]
        ])->skip($this->skip)->take($this->take)->get();
    }

    public function search($text, $request) {
        if ($request->has('page')) {
            $this->skip = (int)$request->input('page') - 1;
        }
        $GLOBALS['search'] = $text;
        return categories::with(['goods'=>function($query) {
            $query->where('title','like','%'.$GLOBALS['search'].'%');
        }])->where([
            [Category::DEL,Category::DEL_ACTIVE]
        ])->skip($this->take)->take($this->take)->get();
    }

}
