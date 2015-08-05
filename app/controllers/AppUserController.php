<?php

class AppUserController extends \BaseController
{

    protected $layout = "layouts.main";

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = new User();
        $orders = new Order();
        $user = $users->getTotalDetails();
        $order = $orders->getTotalDetails();
        $this->layout->content = View::make('users.dashboard')->with('user', $user)->with('order', $order);
    }

    public function searchPasscode()
    {
        $title = Input::get("title");
        $result = DB::table('users')
            ->select('*')
            ->where('users.mobile_number', 'LIKE', '%' . $title . '%')
            ->get();

        if (!empty($result)) {
            echo $result->passcode . "</br>";
        } else {
            echo "<li>No Passcode Found<li>";
        }
    }

    public function getOrder($id)
    {
        $order = new Order();
        $orderDetail = $order->getOrderById($id);
        $this->layout->content = View::make('users.order')->with('orderDetail', $orderDetail);
    }
}