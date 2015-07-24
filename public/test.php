<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   // public function sendVerification($mobile, $passcode){
        $var = Twilio::message("+919711987169", "Enter  on the sign up page to verify your account. This is one time message from Couture.");
        print_r($var);
   // }

