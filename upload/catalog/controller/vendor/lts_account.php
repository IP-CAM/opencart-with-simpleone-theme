<?php

class ControllerVendorLtsAccount extends Controller {

  private $error = [];

  public function index() {

    if (!$this->config->get('module_lts_vendor_status')) {
      $this->response->redirect($this->url->link('error/not_found', '', true));
    }

        
    if (!$this->customer->getId() || !$this->customer->isVendor()) {
      $this->response->redirect($this->url->link('vendor/lts_login', '', true));
    }

    $this->load->language('vendor/lts_account');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('vendor/lts_account');

    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

      $this->model_vendor_lts_account->venddorInfo($this->request->post);
    }

    if (isset($this->session->data['success'])) {
      $data['success'] = $this->session->data['success'];

      unset($this->session->data['success']);
    } else {
      $data['success'] = '';
    }

    if (isset($this->error['username'])) {
      $data['error_username'] = $this->error['username'];
    } else {
      $data['error_username'] = '';
    }

    if (isset($this->error['firstname'])) {
      $data['error_firstname'] = $this->error['firstname'];
    } else {
      $data['error_firstname'] = '';
    }

    if (isset($this->error['lastname'])) {
      $data['error_lastname'] = $this->error['lastname'];
    } else {
      $data['error_lastname'] = '';
    }

    if (isset($this->error['email'])) {
      $data['error_email'] = $this->error['email'];
    } else {
      $data['error_email'] = '';
    }

    if (isset($this->error['store'])) {
      $data['error_store'] = $this->error['store'];
    } else {
      $data['error_store'] = '';
    }

    if (isset($this->error['address1'])) {
      $data['error_address1'] = $this->error['address1'];
    } else {
      $data['error_address1'] = '';
    }

    if (isset($this->error['city'])) {
      $data['error_city'] = $this->error['city'];
    } else {
      $data['error_city'] = '';
    }

    if (isset($this->error['country_id'])) {
      $data['error_country_id'] = $this->error['country_id'];
    } else {
      $data['error_country_id'] = '';
    }

    if (isset($this->error['zone_id'])) {
      $data['error_zone_id'] = $this->error['zone_id'];
    } else {
      $data['error_zone_id'] = '';
    }

    if (isset($this->error['paypal'])) {
      $data['error_paypal'] = $this->error['paypal'];
    } else {
      $data['error_paypal'] = '';
    }

    if (isset($this->error['account_holder'])) {
      $data['error_account_holder'] = $this->error['account_holder'];
    } else {
      $data['error_account_holder'] = '';
    }

    if (isset($this->error['bankname'])) {
      $data['error_bankname'] = $this->error['bankname'];
    } else {
      $data['error_bankname'] = '';
    }

    if (isset($this->error['accountno'])) {
      $data['error_accountno'] = $this->error['accountno'];
    } else {
      $data['error_accountno'] = '';
    }

    if (isset($this->error['ifsc'])) {
      $data['error_ifsc'] = $this->error['ifsc'];
    } else {
      $data['error_ifsc'] = '';
    }

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('vendor/lts_dashboard')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('vendor/lts_account')
    );

    $data['cancel'] = $this->url->link('vendor/lts_dashboard');

    if ($this->request->server['REQUEST_METHOD'] != 'POST') {
      $vendor_info = $this->model_vendor_lts_account->getVendor($this->customer->isVendor());
      $payment_info = $this->model_vendor_lts_account->getPayment($this->customer->isVendor());
    }

    if (isset($this->request->post['username'])) {
      $data['username'] = $this->request->post['username'];
    } elseif (!empty($vendor_info)) {
      $data['username'] = $vendor_info['username'];
    } else {
      $data['username'] = '';
    }

    if (isset($this->request->post['firstname'])) {
      $data['firstname'] = $this->request->post['firstname'];
    } elseif (!empty($vendor_info)) {
      $data['firstname'] = $vendor_info['firstname'];
    } else {
      $data['firstname'] = '';
    }

    if (isset($this->request->post['lastname'])) {
      $data['lastname'] = $this->request->post['lastname'];
    } elseif (!empty($vendor_info)) {
      $data['lastname'] = $vendor_info['lastname'];
    } else {
      $data['lastname'] = '';
    }

    if (isset($this->request->post['email'])) {
      $data['email'] = $this->request->post['email'];
    } elseif (!empty($vendor_info)) {
      $data['email'] = $vendor_info['email'];
    } else {
      $data['email'] = '';
    }

    if (isset($this->request->post['about'])) {
      $data['about'] = $this->request->post['about'];
    } elseif (!empty($vendor_info)) {
      $data['about'] = $vendor_info['about'];
    } else {
      $data['about'] = '';
    }

    if (isset($this->request->post['store'])) {
      $data['store'] = $this->request->post['store'];
    } elseif (!empty($vendor_info)) {
      $data['store'] = $vendor_info['store'];
    } else {
      $data['store'] = '';
    }

    if (isset($this->request->post['address1'])) {
      $data['address1'] = $this->request->post['address1'];
    } elseif (!empty($vendor_info)) {
      $data['address1'] = $vendor_info['address1'];
    } else {
      $data['address1'] = '';
    }

    if (isset($this->request->post['address2'])) {
      $data['address2'] = $this->request->post['address2'];
    } elseif (!empty($vendor_info)) {
      $data['address2'] = $vendor_info['address2'];
    } else {
      $data['address2'] = '';
    }

    if (isset($this->request->post['city'])) {
      $data['city'] = $this->request->post['city'];
    } elseif (!empty($vendor_info)) {
      $data['city'] = $vendor_info['city'];
    } else {
      $data['city'] = '';
    }

    if (isset($this->request->post['postcode'])) {
      $data['postcode'] = $this->request->post['postcode'];
    } elseif (!empty($vendor_info)) {
      $data['postcode'] = $vendor_info['postcode'];
    } else {
      $data['postcode'] = '';
    }

    if (isset($this->request->post['country_id'])) {
      $data['country_id'] = $this->request->post['country_id'];
    } elseif (!empty($vendor_info)) {
      $data['country_id'] = $vendor_info['country_id'];
    } else {
      $data['country_id'] = '';
    }

    if (isset($this->request->post['zone_id'])) {
      $data['zone_id'] = $this->request->post['zone_id'];
    } elseif (!empty($vendor_info)) {
      $data['zone_id'] = $vendor_info['zone_id'];
    } else {
      $data['zone_id'] = '';
    }

    if (isset($this->request->post['paypal'])) {
      $data['paypal'] = $this->request->post['paypal'];
    } elseif (!empty($payment_info)) {
      $data['paypal'] = $payment_info['paypal'];
    } else {
      $data['paypal'] = '';
    }

    if (isset($this->request->post['account_holder'])) {
      $data['account_holder'] = $this->request->post['account_holder'];
    } elseif (!empty($payment_info)) {
      $data['account_holder'] = $payment_info['account_holder'];
    } else {
      $data['account_holder'] = '';
    }

    if (isset($this->request->post['bankname'])) {
      $data['bankname'] = $this->request->post['bankname'];
    } elseif (!empty($payment_info)) {
      $data['bankname'] = $payment_info['bankname'];
    } else {
      $data['bankname'] = '';
    }

    if (isset($this->request->post['accountno'])) {
      $data['accountno'] = $this->request->post['accountno'];
    } elseif (!empty($payment_info)) {
      $data['accountno'] = $payment_info['accountno'];
    } else {
      $data['accountno'] = '';
    }

    if (isset($this->request->post['ifsc'])) {
      $data['ifsc'] = $this->request->post['ifsc'];
    } elseif (!empty($payment_info)) {
      $data['ifsc'] = $payment_info['ifsc'];
    } else {
      $data['ifsc'] = '';
    }

    $this->load->model('vendor/lts_image');

    // if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
    // 	$data['thumb'] = $this->model_vendor_lts_image->resize($this->request->post['image'], 100, 100);
    // } elseif (!empty($vendor_info)) {
    // 	$data['thumb'] = $this->model_vendor_lts_image->resize($vendor_info['image'], 100, 100);
    // } else {
    // 	$data['thumb'] = $this->model_vendor_lts_image->resize('no_image.png', 100, 100);
    // }


    if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
      $data['thumb'] = $this->model_vendor_lts_image->resize($this->request->post['image'], 100, 100);
    } elseif (!empty($vendor_info) && $vendor_info['image'] && is_file(DIR_IMAGE . $vendor_info['image'])) {
      $data['thumb'] = $this->model_vendor_lts_image->resize($vendor_info['image'], 100, 100);
    } else {
      $data['thumb'] = $this->model_vendor_lts_image->resize('no_image.png', 100, 100);
    }

    $data['placeholder'] = $this->model_vendor_lts_image->resize('no_image.png', 100, 100);


    $this->load->model('localisation/country');

    $data['countries'] = $this->model_localisation_country->getCountries();

    $this->load->model('vendor/lts_image');

    $data['action'] = $this->url->link('vendor/lts_account');

    $data['header'] = $this->load->controller('common/header');
    $data['footer'] = $this->load->controller('common/footer');
    $data['column_left'] = $this->load->controller('common/column_left');

    $this->response->setOutput($this->load->view('vendor/lts_account_form', $data));
  }

  public function country() {
    $json = array();

    $this->load->model('localisation/country');

    $country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

    if ($country_info) {
      $this->load->model('localisation/zone');

      $json = array(
          'country_id' => $country_info['country_id'],
          'name' => $country_info['name'],
          'iso_code_2' => $country_info['iso_code_2'],
          'iso_code_3' => $country_info['iso_code_3'],
          'address_format' => $country_info['address_format'],
          'postcode_required' => $country_info['postcode_required'],
          'zone' => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
          'status' => $country_info['status']
      );
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  protected function validateForm() {
    if ((utf8_strlen($this->request->post['username']) < 1) || (utf8_strlen($this->request->post['username']) > 64)) {
      $this->error['username'] = $this->language->get('error_username');
    }

    if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 64)) {
      $this->error['firstname'] = $this->language->get('error_firstname');
    }

    if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 64)) {
      $this->error['lastname'] = $this->language->get('error_lastname');
    }

    if (!$this->request->post['email']) {
      $this->error['email'] = $this->language->get('error_email');
    }

    if ((utf8_strlen($this->request->post['store']) < 3) || (utf8_strlen($this->request->post['store']) > 64)) {
      $this->error['store'] = $this->language->get('error_store');
    }

    if ((utf8_strlen($this->request->post['address1']) < 1) || (utf8_strlen($this->request->post['address1']) > 64)) {
      $this->error['address1'] = $this->language->get('error_address1');
    }

    if (!$this->request->post['city']) {
      $this->error['city'] = $this->language->get('error_city');
    }

    if (!$this->request->post['country_id']) {
      $this->error['country_id'] = $this->language->get('error_country_id');
    }

    if (!$this->request->post['zone_id']) {
      $this->error['zone_id'] = $this->language->get('error_zone_id');
    }

    //payment

    if (!$this->request->post['paypal']) {
      $this->error['paypal'] = $this->language->get('error_paypal');
    }

    if (!$this->request->post['account_holder']) {
      $this->error['account_holder'] = $this->language->get('error_account_holder');
    }

    if (!$this->request->post['bankname']) {
      $this->error['bankname'] = $this->language->get('error_bankname');
    }

    if (!$this->request->post['accountno']) {
      $this->error['accountno'] = $this->language->get('error_accountno');
    }

    if (!$this->request->post['accountno']) {
      $this->error['accountno'] = $this->language->get('error_accountno');
    }

    if (!$this->request->post['ifsc']) {
      $this->error['ifsc'] = $this->language->get('error_ifsc');
    }

    return !$this->error;
  }

}
