<?php

class PasscodeVerification extends Eloquent {

    protected $table = 'passcode_verification';

    public function insert($data) {
        DB::table('passcode_verification')->where('mobile_number', '=', $data['mobile_number'])->delete();
        $this->mobile_number = $data['mobile_number'];
        $this->passcode = $data['passcode'];
        $this->verified_status = 'No';
        $this->save();
        return $this;
    }

    public function getVerifyNumber($mobile) {
        $passcode = DB::table('passcode_verification')->where('mobile_number', $mobile)->where('verified_status', 'No')->pluck('passcode');
        return $passcode;
    }

    public function updateVerify($mobile) {
        $update = DB::table('passcode_verification')->where('mobile_number', $mobile)->update(array('verified_status' => 'Yes'));
        return $update;
    }

    public function getAllUsersPasscodes() {       
         return  DB::table($this->table)->simplePaginate(10);
    }
    
    public function searchPasscode()
    {
        $mobile = Input::get("mobile");
        $result = DB::table($this->table)->where('mobile_number', 'LIKE', '%' . $mobile . '%')->get();
        return json_encode($result, 200);
    }
}