<?php

class ControllerVendorLtsColumnLeft extends Controller {

  public function index() {
    $data = array();

    $this->load->language('vendor/lts_column_left');

    if (!$this->config->get('module_lts_vendor_status')) {
      $this->response->redirect($this->url->link('error/not_found', '', true));
    }
    
    if (!$this->customer->getId() || !$this->customer->isVendor()) {
      $this->response->redirect($this->url->link('vendor/lts_login', '', true));
    }

    $data['dashboard'] = $this->url->link('vendor/lts_dashboard');
    $data['profile'] = $this->url->link('vendor/lts_profile');
    $data['product'] = $this->url->link('vendor/lts_product');
    $data['manufacturer'] = $this->url->link('vendor/lts_manufacturer'); 
    $data['category'] = $this->url->link('vendor/lts_category');
    // $data['recurring'] = $this->url->link('vendor/lts_recurring');
    $data['filter'] = $this->url->link('vendor/lts_filter');

   

    
    $data['store_info'] = $this->url->link('vendor/lts_store_info&vendor_id=' . $this->customer->getId());
    $data['option'] = $this->url->link('vendor/lts_option');

    $data['subscription'] = $this->url->link('vendor/lts_subscription');

    $data['order'] = $this->url->link('vendor/lts_order');
    $data['setting'] = $this->url->link('vendor/lts_setting');
    if ($this->config->get('module_lts_vendor_review_action')) {
      $data['review'] = $this->url->link('vendor/lts_review');
    
    }

    $data['attribute'] = $this->url->link('vendor/lts_attribute');
    $data['visit_store'] = $this->url->link('vendor/lts_visit_store');
    $data['attribute_groups'] = $this->url->link('vendor/lts_attribute_group');
    $data['coupon'] = $this->url->link('vendor/lts_coupon');
    // $data['chat'] = $this->url->link('vendor/lts_chat');

    $data['commission'] = $this->url->link('vendor/lts_commission');
    $data['download'] = $this->url->link('vendor/lts_download');
    $data['account'] = $this->url->link('vendor/lts_account');
    $data['import'] = $this->url->link('vendor/lts_import');
    $data['export'] = $this->url->link('vendor/lts_export');

    return $this->load->view('vendor/lts_column_left', $data);
  }

}
