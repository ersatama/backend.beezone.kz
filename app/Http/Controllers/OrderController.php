<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Orders\OrdersRepositoryEloquent;

class OrderController extends Controller
{

    private $orders;
    public function __construct() {
        $this->orders = new OrdersRepositoryEloquent;
    }

    public function store(Request $request) {
        return $this->orders->store($request->all());
    }

    public function main() {
        return $this->orders->main();
    }

    public function list(Request $request) {
        return $this->orders->list($request->all());
    }

    public function all(Request $request) {
        return $this->orders->all($request->all());
    }

    public function detail($id) {
        return $this->orders->detail($id);
    }

    public function status($id) {
        return $this->orders->status($id);
    }
}
