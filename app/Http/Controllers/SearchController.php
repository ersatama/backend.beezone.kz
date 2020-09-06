<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Categories\CategoriesRepositoryEloquent;

class SearchController extends Controller
{
    protected $categories;
    public function __construct()
    {
        $this->categories = new CategoriesRepositoryEloquent;
    }

    public function search($text, Request $request) {
        return $this->categories->search($text,$request);
    }
}
