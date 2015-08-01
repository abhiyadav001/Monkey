<?php

class UserController extends \BaseController {

    public function sendVerification($mobile, $passcode) {
        if ($mobile == 1111111111 || $mobile == 2222222222 || $mobile == 3333333333) {
            return true;
        }
        try {
            Twilio::message("+91$mobile", "Enter $passcode on the sign up page to verify your account. This is one time message from Couture.");
            return true;
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            return false;
        }
    }

    public function errorMessage($msg) {
        return json_encode(array(
            'success' => false,
            'messages' => $msg,
            'response' => Null), 400
        );
    }

    public function successMessage($msg) {
        return json_encode(array(
            'success' => true,
            'messages' => $msg,
            'response' => Null), 200
        );
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

    /* Sign In Full Process */

    public function signUpMobile() {
        $passVeri = new PasscodeVerification();
        $passcode = mt_rand(100000, 999999);
        $data['mobile_number'] = Input::get('mobile_number');
        $data['passcode'] = $passcode;
        $passVeriUpdated = $passVeri->insert($data);
        $status = $this->sendVerification($passVeriUpdated->mobile_number, $passVeriUpdated->passcode);
        if ($status) {
            $msg = "verification sent.";
            return $this->successMessageWithVar($msg, $passVeriUpdated->passcode, 'passcode');
        } else {
            $msg[] = "Sorry! SMS is not going on this number.";
            return $this->errorMessage($msg);
        }
    }

    public function signInMobile() {
        $data = Input::all();
        $user = new User();
        $userDetail = $user->validateAndGetData($data);

        if (isset($userDetail->password) && (Hash::check(Input::get('password'), $userDetail->password))) {
            $msg = "Signin successfully.";
            return $this->successMessageWithVar($msg, $userDetail, 'userDetails');
        } else {
            $msg[] = "Sorry! wrong credentials provided.";
            return $this->errorMessage($msg);
        }
    }

    public function saveUserInfo() {
        $validator = $this->checkValidation();
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $msg[] = $message;
            }
            return $this->errorMessage($msg);
        }
        $user = new User();
        $deviceDetail = new DeviceDetails();
        $passVeri = new PasscodeVerification();
        $data = Input::all();
        $deviceDetail->insert($data);
        $passVeri->updateVerify($data['mobile_number']);
        $userDetail = $user->insert($data);
        $msg = "Account successfully created.";
        return $this->successMessageWithVar($msg, $userDetail, 'userDetails');
    }

    public function checkValidation() {
        return $validator = Validator::make(
                        array(
                    'mobile_number' => Input::get('mobile_number'),
                    'full_name' => Input::get('full_name'),
                    'password' => Input::get('password'),
                    'email'=>Input::get('email')        
                        ), array(
                    'mobile_number' => 'required|unique:users',
                    'full_name' => 'required',
                    'password' => 'required',
                    'email' => 'required|email|unique:users'
                        )
        );
    }

}