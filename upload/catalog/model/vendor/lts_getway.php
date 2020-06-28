<?php

class ModelVendorLtsGetway extends Model {

  public function sendMessage($telephone, $message) {

    $sender = $this->config->get('lts_getway_sender');

    $apikey = $this->config->get('lts_getway_apikey');

    $data = array('apikey' => $apikey, 'numbers' => $telephone, "sender" => $sender, "message" => $message);

    $ch = curl_init('https://api.textlocal.in/send/');

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response);
  }
 
}
//
//if ($this->config->get('module_lts_vendor_status') && $this->config->get('lts_getway_status')) {
//  $this->load->model('vendor/lts_getway');
//
//  $otp_number = mt_rand(100000, 999999);
//
//  $this->model_vendor_lts_getway->sendMessage($this->);
//}
//
//
//die;
