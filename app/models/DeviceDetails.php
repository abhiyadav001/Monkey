<?php

class DeviceDetails extends Eloquent {

    protected $table = 'users_device_details';

    public function insert($data) {
        $udId = $data['ud_id'];
        $platform = $data['platform'];
        $version = $data['app_version'];
        $token = $data['device_token'];
        $mobile = $data['mobile_number'];

        $ud_id = DB::table('users_device_details')->where('mobile_number', $mobile)->pluck('ud_id');

        if (!empty($ud_id)) {
            $update = DB::table('users_device_details')->where('mobile_number', $mobile)->update(array('platform' => $platform, 'version' => $version, 'device_token' => $token, 'ud_id' => $udId));
            return $update;
        } else {
            $this->ud_id = $udId;
            $this->platform = $platform;
            $this->version = $version;
            $this->device_token = $token;
            $this->mobile_number = $mobile;
            $this->save();
            return $this;
        }
    }

}