<?php

class ControllerVendorLtsCommission extends controller {

  public function index() {
    if (!$this->config->get('module_lts_vendor_status')) {
      $this->response->redirect($this->url->link('error/not_found', '', true));
    }

    if (!$this->customer->getId() || !$this->customer->isVendor()) {
        $this->response->redirect($this->url->link('vendor/lts_login', '', true));
    }

    $this->load->language("vendor/lts_commission");

    $this->document->setTitle($this->language->get('heading_title'));

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('vendor/lts_dashboard')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('vendor/lts_commission')
    );
    $this->load->controller('vendor/lts_header/script');
    $data['header'] = $this->load->controller('common/header');
    $data['footer'] = $this->load->controller('common/footer');
    $data['lts_column_left'] = $this->load->controller('vendor/lts_column_left');
    $this->response->setOutput($this->load->view('vendor/lts_commission', $data));
  }

}
