<?php

class ControllerVendorLtsCotp extends Controller {

  public function index() {

    $this->load->language('vendor/lts_cotp');

    $this->load->model('account/customer');

    $this->load->model('vendor/lts_cotp');

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_account'),
        'href' => $this->url->link('account/account', '', true)
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_login'),
        'href' => $this->url->link('account/login', '', true)
    );

    if (isset($this->session->data['error'])) {
      $data['error_warning'] = $this->session->data['error'];

      unset($this->session->data['error']);
    } elseif (isset($this->error['warning'])) {
      $data['error_warning'] = $this->error['warning'];
    } else {
      $data['error_warning'] = '';
    }

    $data['action'] = $this->url->link('vendor/lts_cotp', '', true);

    $data['header'] = $this->load->controller('common/header');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('vendor/lts_cotp', $data));
  }

  public function validate() {
    $this->load->language('vendor/lts_cotp');

    $json = array();

    $this->load->model('vendor/lts_cotp');
    $this->load->model('account/customer');

    $this->load->model('vendor/lts_getway');


    // Check if customer has been approved.
    $customer_info = $this->model_vendor_lts_cotp->getCustomerByEmailTelephone($this->request->post['email_telephone']);

    $otp_number = rand(100000, 999999);

        $message = $this->config->get('lts_getway_customer_login_otp');

        $message = str_replace("{otp}", $otp_number, $message);


    $status =  $this->model_vendor_lts_getway->sendMessage($customer_info['telephone'], $message);

    if ($customer_info && !$customer_info['status']) {
      $json['error'] = $this->language->get('error_approved');
    }

    if (!isset($json['error'])) {
      $this->load->model('vendor/lts_getway');

      if (isset($customer_info['email']) && isset($customer_info['telephone'])) {
        $otp_number = rand(100000, 999999);

        $message = $this->config->get('lts_getway_customer_login_otp');

        $message = str_replace("{otp}", $otp_number, $message);

        if ($customer_info['telephone']) {
         $status =  $this->model_vendor_lts_getway->sendMessage($customer_info['telephone'], $message);
        }


        $json['status'] = $status;

        $this->session->data['otp_number'] = $otp_number;

        $json['otp_number'] = $this->session->data['otp_number'];
        $json['email_telephone'] = $this->request->post['email_telephone'];
        $json['success'] = true;
      } else {
        $json['email_telephone'] = '';
        $json['error'] = $this->language->get('error_login');
        $json['success'] = false;
      }




      // if (!$this->customer->email_telephone_login($this->request->post['email'], $this->request->post['password'])) {
      //   $this->error['warning'] = $this->language->get('error_login');
      // //   $this->model_account_customer->addLoginAttempt($this->request->post['email']);
      // // } else {
      // //   $this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
      // }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

}
