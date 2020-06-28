<?php

class ControllerVendorLtsRegister extends Controller {

  private $error;

  public function index() {
    if (!$this->config->get('module_lts_vendor_status') || !$this->config->get('module_lts_vendor_registration')) {
      $this->response->redirect($this->url->link('error/not_found', '', true));
    }

    if ($this->customer->isLogged() && empty($this->customer->notVendor())  ) {
      $this->response->redirect($this->url->link('vendor/lts_become_vendor', '', true));
    }

    if ($this->customer->isLogged() && $this->customer->isVendor()) {
      $this->response->redirect($this->url->link('vendor/lts_dashboard', '', true));
    }


    $this->load->language('vendor/lts_register');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('vendor/lts_vendor');

    $this->load->model('account/customer');

    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

      $customer_id = $this->model_account_customer->addCustomer($this->request->post);

      $vendor_id = $this->model_vendor_lts_vendor->addVendor($customer_id, $this->request->post);

      $this->model_account_customer->deleteLoginAttempts($this->request->post['email']);

      $this->customer->login($this->request->post['email'], $this->request->post['password']);

      unset($this->session->data['guest']); 

      if($this->config->get('module_lts_vendor_approval')) {

         $this->response->redirect($this->url->link('vendor/lts_dashboard'));  

      } else {

        $this->session->data['success'] = $this->language->get('text_success');

        $this->response->redirect($this->url->link('vendor/lts_login'));
      }
    }

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_register'),
        'href' => $this->url->link('vendor/lts_register', '', true)
    );

    $data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', true));

    if (isset($this->error['warning'])) {
      $data['error_warning'] = $this->error['warning'];
    } else {
      $data['error_warning'] = '';
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

    if (isset($this->error['storename'])) {
      $data['error_storename'] = $this->error['storename'];
    } else {
      $data['error_storename'] = '';
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

    if (isset($this->error['password'])) {
      $data['error_password'] = $this->error['password'];
    } else {
      $data['error_password'] = '';
    }

    if (isset($this->error['confirm'])) {
      $data['error_confirm'] = $this->error['confirm'];
    } else {
      $data['error_confirm'] = '';
    }

    $data['action'] = $this->url->link('vendor/lts_register', '', true);

    if (isset($this->request->post['firstname'])) {
      $data['firstname'] = $this->request->post['firstname'];
    } else {
      $data['firstname'] = '';
    }

    if (isset($this->request->post['lastname'])) {
      $data['lastname'] = $this->request->post['lastname'];
    } else {
      $data['lastname'] = '';
    }

    if (isset($this->request->post['email'])) {
      $data['email'] = $this->request->post['email'];
    } else {
      $data['email'] = '';
    }

    if (isset($this->request->post['telephone'])) {
      $data['telephone'] = $this->request->post['telephone'];
    } else {
      $data['telephone'] = '';
    }

    if (isset($this->request->post['password'])) {
      $data['password'] = $this->request->post['password'];
    } else {
      $data['password'] = '';
    }

    if (isset($this->request->post['confirm'])) {
      $data['confirm'] = $this->request->post['confirm'];
    } else {
      $data['confirm'] = '';
    }

    if (isset($this->request->post['store_name'])) {
      $data['store_name'] = $this->request->post['store_name'];
    } else {
      $data['store_name'] = '';
    }

    if ($this->config->get('config_account_id')) {
      $this->load->model('catalog/information');

      $information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

      if ($information_info) {
        $data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), true), $information_info['title'], $information_info['title']);
      } else {
        $data['text_agree'] = '';
      }
    } else {
      $data['text_agree'] = '';
    }

    if (isset($this->request->post['agree'])) {
      $data['agree'] = $this->request->post['agree'];
    } else {
      $data['agree'] = false;
    }

    $data['header'] = $this->load->controller('common/header');
    $data['footer'] = $this->load->controller('common/footer');
    $this->response->setOutput($this->load->view('vendor/lts_register', $data));
  }
 
  protected function validate() {
    if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
      $this->error['firstname'] = $this->language->get('error_firstname');
    }

    if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
      $this->error['lastname'] = $this->language->get('error_lastname');
    }

    if ((utf8_strlen(trim($this->request->post['store_name'])) < 3) || (utf8_strlen(trim($this->request->post['store_name'])) > 36)) {
      $this->error['storename'] = $this->language->get('error_storename');
    }

    if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
      $this->error['email'] = $this->language->get('error_email');
    }

    if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) { 
      $this->error['warning'] = $this->language->get('error_exists');
    }

    if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
      $this->error['telephone'] = $this->language->get('error_telephone');
    }

    if ((utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) < 4) || (utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) > 40)) {
      $this->error['password'] = $this->language->get('error_password');
    }

    if ($this->request->post['confirm'] != $this->request->post['password']) {
      $this->error['confirm'] = $this->language->get('error_confirm');
    }

    // Agree to terms
    if ($this->config->get('config_account_id')) {
      $this->load->model('catalog/information');

      $information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

      if ($information_info && !isset($this->request->post['agree'])) {
        $this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
      }
    }

    return !$this->error;
  }


}
?>