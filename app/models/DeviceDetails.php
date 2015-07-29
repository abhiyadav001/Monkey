<?php

class DeviceDetails extends Eloquent {

    protected $table = 'users_device_details';

    public function insert($data) {
        $platform = $data['platform'];
        $version = $data['app_version'];
        $token = $data['device_token'];
        $mobile = $data['mobile_number'];

        $device_token = DB::table('users_device_details')->where('device_token', $token)->pluck('device_token');

        if (!empty($device_token)) {
            $update = DB::table('users_device_details')->where('device_token', $token)->update(array('platform' => $platform, 'version' => $version, 'mobile_number' => $mobile));
            return $update;
        } else {
            $this->platform = $platform;
            $this->version = $version;
            $this->device_token = $token;
            $this->mobile_number = $mobile;
            $this->save();
            return $this;
        }
    }

}