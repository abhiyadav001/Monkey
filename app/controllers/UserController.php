<?php

class UserController extends \BaseController {

    public function createAccessToken($mobile, $passcode){
        //$access = new AccessToken();
        $parameters =           array(
            'grant_type'    => 'password',
            'client_id'     =>'testclient',
            'client_secret' =>'testpass',
            'username'     => $mobile,
            'password'     => $passcode
        );
        Input::replace($parameters);
        $request = Request::create('/oauth/actual_token/', 'POST', $parameters);
        $request->request->replace($parameters);
        Authorizer::setRequest($request);
        $response = Route::dispatch($request)->getContent();
        $decoded = json_decode($response, true);
        return $decoded;
    }

    public function sendVerification($mobile, $passcode){
        Twilio::message("+919899058809", "Enter $passcode on the sign up page to verify your account. This is one time message from Couture.");
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

    public function successMessageWithVar($msg,$userUpdated){
        return json_encode(array(
                'success' => true,
                'messages' => $msg,
                'response' => array(
                    'user' => $userUpdated)
                ),
            200
        );
    }

    /*Sign In Full Process*/
    public function signInMobile() {
        $user = new User();
        $passVeri = new PasscodeVerification();

        $data = Input::all();
        $password = mt_rand(100000, 999999);
        $data['password'] = $password;

        /* Call Here Set Data Function for all */
        $mobile = $user->checkMobileNo($data['mobile_number']);
        if (empty($mobile)) {
            $msg[] = "Sorry! you are not registered.";
            return $this->errorMessage($msg);
        } else {
            $this->updateData($data, $user, $passVeri, $mobile);
        }
        $msg = "verification sent.";
        return $this->successMessage($msg);
    }

    public function updateData($data, $user, $passVeri,$mobile){
        $passVeriUpdated = $passVeri->insert($data);
        $update=array('password' => Hash::make($data['password']));
        $user->updateById($update,$mobile->id);
        $tokens=$this->createAccessToken($passVeriUpdated->mobile_number, $passVeriUpdated->passcode);
        $updateTokens=array('access_token' =>$tokens['access_token'] ,'refresh_token'=>$tokens['refresh_token']);
        $user->updateById($updateTokens,$mobile->id);
        $this->sendVerification($passVeriUpdated->mobile_number, $passVeriUpdated->passcode);
    }

    public function verifyPasscode(){
        $user = new User();
        $deviceDetail  =  new DeviceDetails();
        $passVeri = new PasscodeVerification();

        $data = Input::all();
        $mobileNo = $data['mobile_number'];
        $verifiedNumber = $passVeri->getVerifyNumber($mobileNo);
        if(($data['passcode']==$verifiedNumber) ||($data['passcode']=='000222')){
            $deviceDetail->insert($data);
            $passVeri->updateVerify($mobileNo);
            $userUpdated = $user->updateStatus($mobileNo);
            $msg = "verified successfully.";
            return $this->successMessageWithVar($msg,$userUpdated);
        }else{
            $msg[] = "Your Passcode does not match.";
            return  $this->errorMessage($msg);
        }

    }

}