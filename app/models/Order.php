<?php

class Order extends Eloquent {

    protected $table = 'orders';

    public function getOrderById($id) {
        $orderDetail = DB::table($this->table)->join('users', 'users.id', '=', "$this->table.user_id")
                        ->select("$this->table.*", 'users.full_name as full_name')
                        ->where("$this->table.id", $id)->first();
        $orderDetail->orderItems = $this->getItemsById($id);
        return $orderDetail;
    }

    public function getItemsById($id) {
        return $orderItems = DB::table('order_details')->join('medicines', 'order_details.medicine_id', '=', 'medicines.id')
                        ->select('order_details.*', 'medicines.name as medicine')
                        ->where('order_id', $id)->get();
    }

    public function getOrderDetails() {
        $where=Input::all();
        $orderIds=DB::table($this->table)->where($where)->lists('id');
        $ordersDetails=array();
        foreach ($orderIds as $orderId) {
            $orderDetails=$this->getOrderById($orderId);
            $ordersDetails[]=$orderDetails;
        }
        return $ordersDetails;
    }
}