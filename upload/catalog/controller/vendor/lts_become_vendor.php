<?php

class ControllerVendorLtsBecomeVendor extends Controller {

  private $error = [];

  public function index() {
    $this->load->language('vendor/lts_account');

    $this->load->model('account/customer'); 

    if (!$this->config->get('module_lts_vendor_status')) {
      $this->response->redirect($this->url->link('error/not_found', '', true));
    }

   
    if (!$this->customer->getId() ) {
      $this->response->redirect($this->url->link('vendor/lts_login', '', true));
    }

     if ($this->customer->isLogged() && $this->customer->isVendorNotApproved()) {
      
        $this->session->data['error'] = $this->language->get('error_vendor_approved');

        $this->response->redirect($this->url->link('vendor/lts_login', '', true));
    }

    if ($this->customer->isLogged() && $this->customer->isVendor()) {
      $this->response->redirect($this->url->link('vendor/lts_dashboard', '', true));
    }

    $this->document->setTitle($this->language->get('heading_title'));

    // $this->load->model('vendor/lts_account');

    $this->load->model('vendor/lts_vendor');


    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

        $customer_id = $this->customer->getId();

        $customer_info = $this->model_account_customer->getCustomer($customer_id);

        $this->model_vendor_lts_vendor->addVendor($customer_id, $customer_info);

        $this->response->redirect($this->url->link('vendor/lts_dashboard', '', true));
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
   
    $data['action'] = $this->url->link('vendor/lts_become_vendor');

    $data['header'] = $this->load->controller('common/header');
    $data['footer'] = $this->load->controller('common/footer');
    $data['column_left'] = $this->load->controller('common/column_left');

    $this->response->setOutput($this->load->view('vendor/lts_become_vendor', $data));
  }

  protected function validateForm() {
    if ((utf8_strlen($this->request->post['store']) < 3) || (utf8_strlen($this->request->post['store']) > 64)) {
      $this->error['store'] = $this->language->get('error_store');
    }

    return !$this->error;
  }

}
