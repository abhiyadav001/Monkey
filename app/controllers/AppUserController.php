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
        $order = new Order();
        $medi=new Medicine();
        $passcodes = $pass->getAllUsersPasscodes();
        $orders = $order->getTotalDetails();
        $medicines = $medi->getAllMedicines();
        $appsetng=new User();
        $appSettings=$appsetng->getAllAppSettings();
        $this->layout->content = View::make('users.dashboard')->with('passcodes', $passcodes)
                ->with('orders', $orders)->with('medicines',$medicines)->with('appSettings',$appSettings);
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

    public function updateStatus()
    {
        $order = new Order();
        $status = Input::get("status");
        $id = Input::get("id");
        $order->updateStatus($id,$status);
        return "success";
    }
}