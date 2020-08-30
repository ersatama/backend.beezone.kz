<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\matrix;
use App\Contracts\Matrix as MatrixContract;

class MatrixController extends Controller
{
    public function getMatrixByCategoryId($id) {
        return matrix::where([[MatrixContract::CATEGORY_ID,$id],[MatrixContract::DEL,MatrixContract::DEL_ACTIVE]])->orderBy(MatrixContract::LIMIT)->get();
    }
}
