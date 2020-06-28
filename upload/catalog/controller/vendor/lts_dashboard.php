<?php

class ControllerVendorLtsDashboard extends Controller {

  public function index() {
    $data = [];

    $this->load->language('vendor/lts_dashboard');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('vendor/lts_order');

    $this->load->model('vendor/lts_product');

    $data['order_total'] = $this->model_vendor_lts_order->getTotalOrders();

    $data['product_total'] = $this->model_vendor_lts_product->getTotalProducts();

    if (!$this->config->get('module_lts_vendor_status')) {
      $this->response->redirect($this->url->link('error/not_found', '', true));
    }

    if (!$this->customer->getId() || !$this->customer->isVendor()) {
        
      $this->response->redirect($this->url->link('vendor/lts_login', '', true));

    }
    
    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('vendor/lts_dashboard')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('vendor/lts_attribute_group')
    );

    if (isset($this->session->data['success'])) {
        $data['success'] = $this->session->data['success'];

        unset($this->session->data['success']);
    } else {
        $data['success'] = '';
    }

    $data['add_product'] = $this->url->link('vendor/lts_product/add');
    $data['view_order'] = $this->url->link('vendor/lts_order');

    $this->load->controller('vendor/lts_header/script');
    
    $data['header'] = $this->load->controller('common/header');
    $data['lts_column_left'] = $this->load->controller('vendor/lts_column_left');
    $data['lts_column_right'] = $this->load->controller('vendor/lts_column_right');

    $data['footer'] = $this->load->controller('common/footer');
    $this->response->setOutput($this->load->view('vendor/lts_dashboard', $data));
  }

}
