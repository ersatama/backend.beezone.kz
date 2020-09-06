<?php


namespace App\Repositories\OneC;

use App\Models\Orders;
use App\Contracts\Orders as OrdersContract;

class OneCRepositoryEloquent implements OneCRepositoryInterface
{

    private $user       =   'Web1CExchange';
    private $password   =   '3838';
    private $url        =   'https://beezones.ngrok.io';
    private $dasberg    =   '/beezone-dasberg/hs/Obmen/Order';
    private $saiko      =   '/beezone-saiko/hs/Obmen/Order';
    private $taffy      =   '/beezone-taffy/hs/Obmen/Order';
    private $vinove     =   '/beezone-vinove/hs/Obmen/Order';
    private $all        =   '/beezone/hs/Obmen/Order';

    public function send($id) {

        $order      =   Orders::with('items')->where(OrdersContract::ID,$id)->first();
        $curlAuth   =   join(':',[$this->user, $this->password]);
        $curlHeader =   ['Content-Type:application/json'];

        $data       =   [
            'id'                =>  '',
            'code'              =>  '',
            'client'            =>  '',
            'phone'             =>  '',
            'email'             =>  '',
            'delivery_address'  =>  '',
            'order_date'        =>  '',
            'order_status'      =>  '',
            'payment_status'    =>  '',
            'delivery_status'   =>  '',
            'sum'               =>  '',
            'company_name'      =>  '',
            'products'          =>  [],
        ];

        $data       =   json_encode($data);

        $ch         =   curl_init();
        curl_setopt($ch, CURLOPT_USERPWD, $curlAuth);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curlAuth);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);

		$order->status = 4;
		$order->save();
        print_r($order);

    }

}
