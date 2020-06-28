<?php

class ControllerVendorLtsStoreInfo extends Controller {

  private $error = [];

  public function index() {

    $this->load->language('vendor/lts_store_info');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('vendor/lts_vendor');

    if (!$this->config->get('module_lts_vendor_status')) {
      $this->response->redirect($this->url->link('error/not_found', '', true));
    }
    
    if (!$this->customer->getId() || !$this->customer->isVendor()) {
      $this->response->redirect($this->url->link('vendor/lts_login', '', true));
    }


    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

      $this->model_vendor_lts_vendor->editStoreInformation($this->request->post);

      $this->session->data['success'] = $this->language->get('text_success');

      $this->response->redirect($this->url->link('vendor/lts_dashboard')); 
    }

    //error 

    if (isset($this->error['warning'])) {
      $data['error_warning'] = $this->error['warning'];
    } else { 
      $data['error_warning'] = '';
    }

    if (isset($this->error['meta_title'])) {
      $data['error_meta_title'] = $this->error['meta_title'];
    } else {
      $data['error_meta_title'] = '';
    }

    if (isset($this->error['meta_description'])) {
      $data['error_meta_description'] = $this->error['meta_description'];
    } else {
      $data['error_meta_description'] = '';
    }

    if (isset($this->error['meta_keyword'])) {
      $data['error_meta_keyword'] = $this->error['meta_keyword'];
    } else {
      $data['error_meta_keyword'] = '';
    }

    if (isset($this->error['owner_name'])) {
      $data['error_owner_name'] = $this->error['owner_name'];
    } else {
      $data['error_owner_name'] = '';
    }

    if (isset($this->error['store_name'])) {
      $data['error_store_name'] = $this->error['store_name'];
    } else {
      $data['error_store_name'] = '';
    }

    if (isset($this->error['address'])) {
      $data['error_address'] = $this->error['address'];
    } else {
      $data['error_address'] = '';
    }

    if (isset($this->error['email'])) {
      $data['error_email'] = $this->error['email'];
    } else {
      $data['error_email'] = '';
    }

    if (isset($this->error['telephone'])) {
      $data['error_telephone'] = $this->error['telephone'];
    } else {
      $data['error_telephone'] = '';
    }
    

     if (isset($this->error['country'])) {
      $data['error_country'] = $this->error['country'];
    } else {
      $data['error_country'] = '';
    }
    
    if (isset($this->error['zone'])) {
      $data['error_zone'] = $this->error['zone'];
    } else {
      $data['error_zone'] = '';
    }
    

    if (isset($this->error['city'])) {
      $data['error_city'] = $this->error['city'];
    } else {
      $data['error_city'] = '';
    }

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('vendor/lts_dashboard')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('vendor/lts_store_info')
    );


    if (isset($this->request->get['vendor_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $store_info = $this->model_vendor_lts_vendor->getStoreInformation($this->request->get['vendor_id']);
    }

    if (isset($this->request->post['description'])) {
      $data['description'] = $this->request->post['description'];
    } elseif (!empty($store_info)) {
      $data['description'] = $store_info['description'];
    } else {
      $data['description'] = '';
    }


    if (isset($this->request->post['meta_title'])) {
      $data['meta_title'] = $this->request->post['meta_title'];
    } elseif (!empty($store_info)) {
      $data['meta_title'] = $store_info['meta_title'];
    } else {
      $data['meta_title'] = '';
    }

    if (isset($this->request->post['meta_description'])) {
      $data['meta_description'] = $this->request->post['meta_description'];
    } elseif (!empty($store_info)) {
      $data['meta_description'] = $store_info['meta_description'];
    } else {
      $data['meta_description'] = '';
    }

    if (isset($this->request->post['meta_title'])) {
      $data['meta_title'] = $this->request->post['meta_title'];
    } elseif (!empty($store_info)) {
      $data['meta_title'] = $store_info['meta_title'];
    } else {
      $data['meta_title'] = '';
    }

    if (isset($this->request->post['meta_keyword'])) {
      $data['meta_keyword'] = $this->request->post['meta_keyword'];
    } elseif (!empty($store_info)) {
      $data['meta_keyword'] = $store_info['meta_keyword'];
    } else {
      $data['meta_keyword'] = '';
    }

    if (isset($this->request->post['owner_name'])) {
      $data['owner_name'] = $this->request->post['owner_name'];
    } elseif (!empty($store_info)) {
      $data['owner_name'] = $store_info['owner_name'];
    } else {
      $data['owner_name'] = '';
    }

    if (isset($this->request->post['store_name'])) {
      $data['store_name'] = $this->request->post['store_name'];
    } elseif (!empty($store_info)) {
      $data['store_name'] = $store_info['store_name'];
    } else {
      $data['store_name'] = '';
    }

    if (isset($this->request->post['address'])) {
      $data['address'] = $this->request->post['address'];
    } elseif (!empty($store_info)) {
      $data['address'] = $store_info['address'];
    } else {
      $data['address'] = '';
    }

    if (isset($this->request->post['email'])) {
      $data['email'] = $this->request->post['email'];
    } elseif (!empty($store_info)) {
      $data['email'] = $store_info['email'];
    } else {
      $data['email'] = '';
    }

    if (isset($this->request->post['telephone'])) {
      $data['telephone'] = $this->request->post['telephone'];
    } elseif (!empty($store_info)) {
      $data['telephone'] = $store_info['telephone'];
    } else {
      $data['telephone'] = '';
    }

    if (isset($this->request->post['fax'])) {
      $data['fax'] = $this->request->post['fax'];
    } elseif (!empty($store_info)) {
      $data['fax'] = $store_info['fax'];
    } else {
      $data['fax'] = '';
    }


    if (isset($this->request->post['country_id'])) {
      $data['country_id'] = $this->request->post['country_id'];
    } elseif (!empty($store_info)) {
      $data['country_id'] = $store_info['country_id'];
    } else {
      $data['country_id'] = '';
    }

    $this->load->model('localisation/country');

    $data['countries'] = $this->model_localisation_country->getCountries();

    if (isset($this->request->post['zone_id'])) {
      $data['zone_id'] = $this->request->post['zone_id'];
    } elseif (!empty($store_info)) {
      $data['zone_id'] = $store_info['zone_id'];
    } else {
      $data['zone_id'] = '';
    }

    if (isset($this->request->post['city'])) {
      $data['city'] = $this->request->post['city'];
    } elseif (!empty($store_info)) {
      $data['city'] = $store_info['city'];
    } else {
      $data['city'] = '';
    }

    if (isset($this->request->post['logo'])) {
      $data['logo'] = $this->request->post['logo'];
    } elseif (!empty($store_info)) {
      $data['logo'] = $store_info['logo'];
    } else {
      $data['logo'] = '';
    }  

    $this->load->model('tool/image');

    if (isset($this->request->post['logo']) && is_file(DIR_IMAGE . $this->request->post['logo'])) {
      $data['logo_thumb'] = $this->model_tool_image->resize($this->request->post['logo'], 100, 100);
    } elseif (!empty($store_info) && is_file(DIR_IMAGE . $store_info['logo'])) {
      $data['logo_thumb'] = $this->model_tool_image->resize($store_info['logo'], 100, 100);
    } else {
      $data['logo_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
    }

    if (isset($this->request->post['banner'])) {
      $data['banner'] = $this->request->post['banner'];
    } elseif (!empty($store_info)) {
      $data['banner'] = $store_info['banner'];
    } else {
      $data['banner'] = '';
    }

    // $this->load->model('vendor/lts_image');

   
    if (isset($this->request->post['banner']) && is_file(DIR_IMAGE . $this->request->post['banner'])) {
      $data['banner_thumb'] = $this->model_tool_image->resize($this->request->post['banner'], 100, 100);
    } elseif (!empty($store_info) && is_file(DIR_IMAGE . $store_info['banner'])) {
      $data['banner_thumb'] = $this->model_tool_image->resize($store_info['banner'], 100, 100);
    } else {
      $data['banner_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
    }

     $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


    if (isset($this->request->post['facebook'])) {
      $data['facebook'] = $this->request->post['facebook'];
    } elseif (!empty($store_info)) {
      $data['facebook'] = $store_info['facebook'];
    } else {
      $data['facebook'] = '';
    }

    if (isset($this->request->post['instagram'])) {
      $data['instagram'] = $this->request->post['instagram'];
    } elseif (!empty($store_info)) {
      $data['instagram'] = $store_info['instagram'];
    } else {
      $data['instagram'] = '';
    }

    if (isset($this->request->post['youtube'])) {
      $data['youtube'] = $this->request->post['youtube'];
    } elseif (!empty($store_info)) {
      $data['youtube'] = $store_info['youtube'];
    } else {
      $data['youtube'] = '';
    }

    if (isset($this->request->post['twitter'])) {
      $data['twitter'] = $this->request->post['twitter'];
    } elseif (!empty($store_info)) {
      $data['twitter'] = $store_info['twitter'];
    } else {
      $data['twitter'] = '';
    }

    if (isset($this->request->post['pinterest'])) {
      $data['pinterest'] = $this->request->post['pinterest'];
    } elseif (!empty($store_info)) {
      $data['pinterest'] = $store_info['pinterest'];
    } else {
      $data['pinterest'] = '';
    }

    $data['action'] = $this->url->link('vendor/lts_store_info');
    $this->load->controller('vendor/lts_header/script');
    $data['header'] = $this->load->controller('common/header');
    $data['lts_column_left'] = $this->load->controller('vendor/lts_column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('vendor/lts_store_info', $data));
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
    $this->load->language('vendor/lts_store_info');
    if ((utf8_strlen($this->request->post['meta_title']) < 1) || (utf8_strlen($this->request->post['meta_title']) > 64)) {
      $this->error['meta_title'] = $this->language->get('error_meta_title');
    }

    if ((utf8_strlen($this->request->post['meta_description']) < 1) || (utf8_strlen($this->request->post['meta_description']) > 255)) {
      $this->error['meta_description'] = $this->language->get('error_meta_description');
    }

    if ((utf8_strlen($this->request->post['meta_keyword']) < 1) || (utf8_strlen($this->request->post['meta_keyword']) > 64)) {
      $this->error['meta_keyword'] = $this->language->get('error_meta_keyword');
    }

    if (!$this->request->post['owner_name']) {
      $this->error['owner_name'] = $this->language->get('error_owner_name');
    }

    if (!$this->request->post['store_name']) {
      $this->error['store_name'] = $this->language->get('error_store_name');
    }

    if (!$this->request->post['address']) {
      $this->error['address'] = $this->language->get('error_address');
    }

    if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
      $this->error['email'] = $this->language->get('error_email');
    }

    // if ($this->model_vendor_lts_vendor->getTotalVendorsByEmail($this->request->post['email'])) {
    //   $this->error['warning'] = $this->language->get('error_exists');
    // }

    if (!$this->request->post['telephone']) {
      $this->error['telephone'] = $this->language->get('error_telephone');
    }

    
    if ($this->request->post['country_id'] == '') {
      $this->error['country'] = $this->language->get('error_country');
    }

    if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
      $this->error['zone'] = $this->language->get('error_zone');
    }

    if (!$this->request->post['city']) {
      $this->error['city'] = $this->language->get('error_city');
    }


    if ($this->error && !isset($this->error['warning'])) {
      $this->error['warning'] = $this->language->get('error_warning');
    }

    return !$this->error;
  }

}
