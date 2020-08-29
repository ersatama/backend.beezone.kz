<?php

namespace App\Http\Controllers;

use App\Repositories\Brands\BrandsRepositoryEloquent;
use Illuminate\Http\Request;

class BrandsController extends Controller
{

    private $brands;
    public function __construct()
    {
        $this->brands = new BrandsRepositoryEloquent;
    }

    public function list() {
        return $this->brands->list();
    }

    public function getBrandById($id) {
        return $this->brands->getBrandById($id);
    }

}
