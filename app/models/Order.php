<?php

class Order extends Eloquent
{

    protected $table = 'orders';

    public function getOrderById($id)
    {
        $review = new Review();
        $orderDetail = DB::table($this->table)->join('users', 'users.id', '=', "$this->table.user_id")
            ->select("$this->table.*", 'users.full_name as full_name')
            ->where("$this->table.id", $id)->first();
        $orderDetail->orderItems = $this->getItemsById($id);
        $orderDetail->orderReview = $review->getReviewByOrderID($id);
        $orderDetail->shippingAddress = $this->getShippingAddressByOrderID($id);
        return $orderDetail;
    }

    public function getItemsById($id)
    {
        return $orderItems = DB::table('order_details')
            ->join('medicines', 'order_details.medicine_id', '=', 'medicines.id')
            ->select('order_details.*', 'medicines.name as medicine')
            ->where('order_id', $id)->get();
    }

    public function getDetailedOrders()
    {
        $where = Input::all();
        $orderIds = DB::table($this->table)->where($where)->lists('id');
        $ordersDetails = array();
        foreach ($orderIds as $orderId) {
            $orderDetails = $this->getOrderById($orderId);
            $ordersDetails[] = $orderDetails;
        }
        return $ordersDetails;
    }

    public function getShippingAddressByOrderID($id)
    {
        return $orderItems = DB::table('orders')
            ->join('shipping_addresses as sa', 'sa.order_id', '=', 'orders.id')
            ->select('sa.*')
            ->where('order_id', $id)->first();
    }

    public function saveOrder()
    {
        $this->user_id = Input::get('user_id');
        $this->subtotal = Input::get('subtotal');
        $this->tax = Input::get('tax');
        $this->discount = Input::get('discount');
        $this->shipping_amount = Input::get('shipping_amount');
        $this->charged_amount = Input::get('charged_amount');
        $this->save();
        return $this;
    }

    public function saveOrderItems($orderId)
    {
        $orderItems = Input::get('orderItems');
        foreach ($orderItems as $orderItem) {
            $orderItem['order_id'] = $orderId;
            $orderItem['created_at'] = date("Y-m-d H:i:s");
            $orderItem['updated_at'] = date("Y-m-d H:i:s");
            DB::table('order_details')->insert($orderItem);
        }
    }

    public function saveShippingAddress($orderId)
    {
        $shippingAddress = Input::get('shippingAddress');
        $shippingAddress['order_id'] = $orderId;
        $shippingAddress['created_at'] = date("Y-m-d H:i:s");
        $shippingAddress['updated_at'] = date("Y-m-d H:i:s");
        DB::table('shipping_addresses')->insert($shippingAddress);
    }

    public function getTotalDetails()
    {
        return DB::table($this->table)->join('users', 'users.id', '=', "$this->table.user_id")
            ->select("$this->table.*", 'users.full_name as full_name')
            ->simplePaginate(10);
    }
}