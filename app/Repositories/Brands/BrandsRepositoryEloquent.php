<?php


namespace App\Repositories\Brands;

use App\Models\brands;
use App\Contracts\brands as brandsContract;

class BrandsRepositoryEloquent implements BrandsRepositoryInterface
{
    public function list() {
        return brands::where(brandsContract::DEL,brandsContract::DEL_ACTIVE)->orderBy(brandsContract::ORDER)->get();
    }

    public function getBrandById($id) {
        return brands::where([
            [brandsContract::ID,'=',$id],
            [brandsContract::DEL,'=',brandsContract::DEL_ACTIVE],
        ])->first();
    }

}
