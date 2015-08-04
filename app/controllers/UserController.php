<?php

class UserController extends \BaseController {
    protected $layout = "layouts.main";

    public function sendVerification($mobile, $passcode){
        try {
          Twilio::message("+91$mobile", "Enter $passcode on the sign up page to verify your account. This is one time message from Couture.");  
          return true;
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            return false;
        }
    }

    public function errorMessage($msg){
        return json_encode(array(
                'success' => false,
                'messages'=> $msg,
                'response'=> Null),
            400
        );
    }

    public function successMessage($msg){
        return json_encode(array(
                'success' => true,
                'messages' => $msg,
                'response'=> Null),
            200
        );
    }

    public function successMessageWithVar($msg,$data,$key){
        return json_encode(array(
                'success' => true,
                'messages' => $msg,
                'response' => array(
                    $key => $data)
                ),
            200
        );
    }

    /*Sign In Full Process*/
    public function signUpMobile() {
        $passVeri = new PasscodeVerification();
        $passcode = mt_rand(100000, 999999);
        $data['mobile_number']=Input::get('mobile_number');
        $data['passcode']=$passcode;
        $passVeriUpdated = $passVeri->insert($data);
        $status=$this->sendVerification($passVeriUpdated->mobile_number, $passVeriUpdated->passcode);
        if($status){
        $msg = "verification sent.";
        return $this->successMessageWithVar($msg,$passVeriUpdated->passcode,'passcode');
        }else{
            $msg[]="Sorry! SMS is not going on this number."; 
            return $this->errorMessage($msg);
        }
    }
       
    public function signInMobile() {
        $data = Input::all();
        $user = new User();
        $userDetail = $user->validateAndGetData($data);
        
        if (isset($userDetail->password)&&(Hash::check(Input::get('password'), $userDetail->password))) {
            $msg = "Signin successfully.";
            return $this->successMessageWithVar($msg, $userDetail, 'userDetails');
        } else {
            $msg[] = "Sorry! wrong credentials provided.";
            return $this->errorMessage($msg);
        }
    }

    public function verifyPasscode() {
        $user = new User();
        $deviceDetail = new DeviceDetails();
        $passVeri = new PasscodeVerification();
        $data = Input::all();
        $deviceDetail->insert($data);
        $passVeri->updateVerify($data['mobile_number']);
        $userDetail = $user->insert($data);
        $msg = "Account successfully created.";
        return $this->successMessageWithVar($msg, $userDetail,'userDetails');
    }

    public function signInAdmin() {
        $this->layout->content = View::make('users.login');
    }

    public function postSignin() {
        $auth = Auth::attempt(array('mobile_number'=>Input::get('username'), 'password'=>Input::get('password')));
        if ($auth) {
            Session::flash('message', 'You are successfully login.');
            Session::flash('alert-class', 'alert-success');
            return Redirect::to('app-users');
        } else {
            Session::flash('message', 'Your username/password combination was incorrect.');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('login')->withInput();
        }
    }

}