<?php

class ControllerVendorLtsSetting extends controller {

  private $error = [];

  public function index() {
    $this->load->language('vendor/lts_setting');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('vendor/lts_vendor');


    // if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
    if ($this->request->server['REQUEST_METHOD'] == 'POST') {

      // $this->model_vendor_lts_vendor->editProfile($this->request->post);

      // $this->session->data['success'] = $this->language->get('text_success');

      // $this->response->redirect($this->url->link('vendor/lts_dashboard')); 
    }

    //error
    // if (isset($this->error['warning'])) {
    //   $data['error_warning'] = $this->error['warning'];
    // } else {
    //   $data['error_warning'] = '';
    // }

    // if (isset($this->error['firstname'])) {
    //   $data['error_firstname'] = $this->error['firstname'];
    // } else {
    //   $data['error_firstname'] = '';
    // }

    // if (isset($this->error['lastname'])) {
    //   $data['error_lastname'] = $this->error['lastname'];
    // } else {
    //   $data['error_lastname'] = '';
    // }

    //  if (isset($this->error['email'])) {
    //     $data['error_email'] = $this->error['email'];
    //   } else {
    //     $data['error_email'] = '';
    //   }

    // if (isset($this->error['telephone'])) {
    //     $data['error_telephone'] = $this->error['telephone'];
    //   } else {
    //     $data['error_telephone'] = '';
    //   }

 
    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('vendor/lts_profile')
    );


    if ($this->request->server['REQUEST_METHOD'] != 'POST') {
      $vendor_info = $this->model_vendor_lts_vendor->getVendor($this->customer->getId());
    }


    // if (isset($this->request->post['firstname'])) {
    //   $data['firstname'] = $this->request->post['firstname'];
    // } elseif (isset($vendor_info['firstname'])) {
    //   $data['firstname'] = $vendor_info['firstname'];
    // } else {
    //   $data['firstname'] = '';
    // }

    // if (isset($this->request->post['lastname'])) {
    //   $data['lastname'] = $this->request->post['lastname'];
    // } elseif (isset($vendor_info['lastname'])) {
    //   $data['lastname'] = $vendor_info['lastname'];
    // } else {
    //   $data['lastname'] = '';
    // } 

    // if (isset($this->request->post['email'])) {
    //   $data['email'] = $this->request->post['email'];
    // } elseif (isset($vendor_info['email'])) {
    //   $data['email'] = $vendor_info['email'];
    // } else {
    //   $data['email'] = '';
    // } 

    // if (isset($this->request->post['telephone'])) {
    //   $data['telephone'] = $this->request->post['telephone'];
    // } elseif (isset($vendor_info['telephone'])) {
    //   $data['telephone'] = $vendor_info['telephone'];
    // } else {
    //   $data['telephone'] = '';
    // }


    $this->load->model('localisation/country');

    $data['countries'] = $this->model_localisation_country->getCountries();

    if (isset($this->request->post['zone_id'])) {
      $data['zone_id'] = $this->request->post['zone_id'];
    } elseif (!empty($store_info)) {
      $data['zone_id'] = $store_info['zone_id'];
    } else {
      $data['zone_id'] = '';
    }



    

    $data['action'] = $this->url->link('vendor/lts_profile', '', true);
    $data['cancel'] = $this->url->link('vendor/lts_dashboard', '', true);
    $this->load->controller('vendor/lts_header/script');
    $data['header'] = $this->load->controller('common/header');
    $data['footer'] = $this->load->controller('common/footer');
    $data['lts_column_left'] = $this->load->controller('vendor/lts_column_left');

    $this->response->setOutput($this->load->view('vendor/lts_setting', $data));
  }

  // protected function validateForm() {
  //   if (!$this->request->post['firstname']) {
  //     $this->error['firstname'] = $this->language->get('error_firstname');
  //   }

  //   if (!$this->request->post['lastname']) {
  //     $this->error['lastname'] = $this->language->get('error_lastname');
  //   }

  //   if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
  //     $this->error['email'] = $this->language->get('error_email');
  //   }

  //   // if ($this->model_vendor_lts_vendor->getTotalVendorsByEmail($this->request->post['email'])) {
  //   //   $this->error['warning'] = $this->language->get('error_exists');
  //   // }

  //   if (!$this->request->post['telephone']) {
  //     $this->error['telephone'] = $this->language->get('error_telephone');
  //   }

  //   // if ($this->model_vendor_lts_vendor->getTotalVendorsByTelephone($this->request->post['telephone'])) {
  //   //   $this->error['warning'] = $this->language->get('error_exists');
  //   // }
  //   return !$this->error;
  // }

}
