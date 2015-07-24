<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /* Checking for Mobile Number if its already Exist or Not */

    public function checkMobileNo($mobileNo) {
        $mobile = DB::table('users')
                ->select('*')
                ->where('users.mobile_number', $mobileNo)
                ->first();
        return $mobile;
    }

    public function updateById($data, $id) {
        DB::table('users')->where('id', $id)->update($data);
    }

    public function updateData($data, $onField, $onValue) {
        DB::table('users')->where($onField, $onValue)->update($data);
    }

    public function updateStatus($mobile) {
        DB::table('users')->where('mobile_number', $mobile)->update(array('status' => 'active'));
        $selectedValue = DB::table('users')->where('mobile_number', $mobile)->first();
        return $selectedValue;
    }

}