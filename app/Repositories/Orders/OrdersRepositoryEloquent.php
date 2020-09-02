<?php


namespace App\Repositories\Orders;

use App\Models\orders;
use App\Models\order_items;
use App\Contracts\UserContract;
use App\Contracts\StatusCode;
use App\Contracts\Orders as OrdersContract;
use App\Contracts\OrderItems;
use Illuminate\Support\Facades\Auth;

class OrdersRepositoryEloquent implements OrdersRepositoryInterface
{

    private $take = 30;
    private $skip = 0;

    public function store($request) {
        $items      = json_decode($request['items'], true);
        $address    = $request['address'];
        $time_id    = $request['time_id'];
        $payment_id = $request['payment_id'];
        $comment    = $request['comment'];
        $status     = $request['status'];
        if (Auth::check()) {
            $ORDER = orders::create([
                OrdersContract::CODE        => 'code-',
                OrdersContract::USER_ID     => Auth::id(),
                OrdersContract::ADDRESS     => $address,
                OrdersContract::TIME_ID     => $time_id,
                OrdersContract::PAYMENT_ID  => $payment_id,
                OrdersContract::COMMENT     => $comment,
                OrdersContract::STATUS      => $status,
                OrdersContract::DEL         => OrdersContract::DEL_ACTIVE
            ]);
            foreach ($items as &$value) {
                order_items::create([
                    OrderItems::USER_ID     => Auth::id(),
                    OrderItems::ORDER_ID    => $ORDER->id,
                    OrderItems::TITLE       => $value['title'],
                    OrderItems::CATEGORY_ID => $value['category_id'],
                    OrderItems::COUNT       => $value['count'],
                    OrderItems::PRICE       => $value['price'],
                    OrderItems::DEL         => OrderItems::DEL_ACTIVE
                ]);
            }
            $DATA = orders::with('items')->where([
                [OrdersContract::ID,$ORDER->id],
                [OrdersContract::DEL,OrdersContract::DEL_ACTIVE]
            ])->get();
            return response($DATA, StatusCode::OK);
        }
        return response('UNAUTHORIZED', StatusCode::UNAUTHORIZED);
    }

    public function main() {
        if (Auth::check()) {
            $DATA = [
                'count'     => 0,
                'sum'       => 0,
                'profit'    => 0
            ];
            $ORDERS = orders::with('items')->where([
                [OrdersContract::USER_ID,Auth::id()],
                [OrdersContract::DEL,OrdersContract::DEL_ACTIVE]
            ])->get();
            foreach ($ORDERS as &$ORDER) {
                $DATA['count']++;
                foreach ($ORDER['items'] as &$VALUE) {
                    if ($VALUE->del === OrderItems::DEL_ACTIVE) {
                        $DATA['sum'] += $VALUE->count * $VALUE->price;
                        if ($ORDER['status'] === 4) {
                            $DATA['profit'] += $VALUE->count * $VALUE->price;
                        }
                    }
                }
            }
            return response($DATA, StatusCode::OK);
        }
        return response('UNAUTHORIZED', StatusCode::UNAUTHORIZED);
        /*$phone          = '87784139424';
        $password       = 'qwerty00';
        $credentials    = [
            UserContract::PHONE    => $phone,
            UserContract::PASSWORD => $password,
        ];
        if (Auth::attempt($credentials)) {
            return response(Auth::id(), StatusCode::OK);//IF AUTH SUCCESS, THEN RETURN OK
        }*/
    }

    public function list($request) {
        if (Auth::check()) {
            if (array_key_exists('page',$request)){
                $this->skip = $request['page'] - 1;
            }
            $orders = orders::with('items')->where([
                [OrdersContract::USER_ID,Auth::id()],
                [OrdersContract::DEL,OrdersContract::DEL_ACTIVE]
            ])->skip($this->skip)->take($this->take)->get();
            return response($orders, StatusCode::OK);
        }
        return response('UNAUTHORIZED', StatusCode::UNAUTHORIZED);
    }

    public function all($request) {
        return 'hello world';
    }

    public function detail($id) {
        if (Auth::check()) {
            $orders = orders::with('items')->where([
                [OrdersContract::USER_ID,Auth::id()],
                [OrdersContract::DEL,OrdersContract::DEL_ACTIVE]
            ])->first();
            return response($orders,StatusCode::OK);
        }
        return response('UNAUTHORIZED', StatusCode::UNAUTHORIZED);
    }

    public function status($status) {
        if (Auth::check()) {

            orders::where([
                [OrdersContract::USER_ID,Auth::id()],
            ])->update(['status'=>$status]);

            $orders = orders::with('items')->where([
                [OrdersContract::USER_ID,Auth::id()],
                [OrdersContract::DEL,OrdersContract::DEL_ACTIVE]
            ])->first();

            return response($orders,StatusCode::OK);

        }
        return response('UNAUTHORIZED', StatusCode::UNAUTHORIZED);
    }

}
