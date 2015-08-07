<?php

class AppUserController extends \BaseController
{

    protected $layout = "layouts.main";

    public function __construct()
    {
        //$this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pass = new PasscodeVerification();
        $orders = new Order();
        $passcodes = $pass->getAllUsersPasscodes();
        $order = $orders->getTotalDetails();
        $this->layout->content = View::make('users.dashboard')->with('passcodes', $passcodes)->with('order', $order);
    }

    public function searchPasscode()
    {
        $mobile = Input::get("mobile");
        $result = DB::table('passcode_verification')->where('mobile_number', 'LIKE', '%' . $mobile . '%')->get();
        return json_encode($result, 200);
    }

    public function getOrder($id)
    {
        $order = new Order();
        $orderDetail = $order->getOrderById($id);
        $this->layout->content = View::make('users.order')->with('orderDetail', $orderDetail);
    }
}