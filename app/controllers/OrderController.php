<?php

class orderController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $order = new Order();
        $ordersDetails = $order->getDetailedOrders();
        $msg = "Orders Details are retrieved successfully.";
        return $this->successMessageWithVar($msg, $ordersDetails, 'detailedOrders');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $order = new Order();
        $orderInfo=$order->saveOrder();
        $order->saveOrderItems($orderInfo->id);
        $order->saveShippingAddress($orderInfo->id);
        $orderDetail = $order->getOrderById($orderInfo->id);
        $msg = "Order Details are saved successfully.";
        return $this->successMessageWithVar($msg, $orderDetail, 'orderDetails');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $order = new Order();
        $orderDetail = $order->getOrderById($id);
        $msg = "Order Details are retrieved successfully.";
        return $this->successMessageWithVar($msg, $orderDetail, 'orderDetails');
    }

    public function successMessageWithVar($msg, $data, $key) {
        return json_encode(array(
            'success' => true,
            'messages' => $msg,
            'response' => array(
                $key => $data)
                ), 200
        );
    }

}