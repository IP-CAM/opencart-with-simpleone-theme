<?php
class ControllerVendorLtsSubscription extends controller {

  public function index() {  
    $this->load->language('vendor/lts_subscription');

    $this->load->model('vendor/lts_subscription');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->getList();
  }
  
  public function add() {

     $this->load->language('vendor/lts_subscription');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('vendor/lts_subscription');

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {
      $results = $this->model_vendor_lts_subscription->getSubscription($this->request->get['subscription_id']);

      $this->model_vendor_lts_subscription->addVendorPlan($results);

      $this->response->redirect($this->url->link('vendor/lts_subscription', ''));
    }

    $this->getList();


  }

  public function getList() {
    if (!$this->config->get('module_lts_vendor_status')) {
      $this->response->redirect($this->url->link('error/not_found', '', true));
    }
      
    if (!$this->customer->getId() || !$this->customer->isVendor()) {
      $this->response->redirect($this->url->link('vendor/lts_login', '', true));
    }

    $results = $this->model_vendor_lts_subscription->getSubscriptions();

    $data['languages'] = $this->model_localisation_language->getLanguages();

    foreach ($results as $result) {
      $data['subscriptions'][] = array(
          'name'              => $result['name'],
          'subscription_id'   => $result['subscription_id'],
          'no_of_product'     => $result['no_of_product'],
          'join_fee'          => $result['join_fee'],
          'subscription_fee'  => $result['subscription_fee'],
          'validity'          => $result['validity'],
          'subscribe'          => $this->url->link('vendor/lts_subscription/subscribe', '&subscription_id=' . $result['subscription_id']),
      );
    }

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('text_home'),
      'href' => $this->url->link('common/home')
    );

    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('heading_title'),
      'href' => $this->url->link('vendor/lts_subscription', '', true)
    ); 


    $this->load->controller('vendor/lts_header/script');
    $data['header'] = $this->load->controller('common/header');
    $data['lts_column_left'] = $this->load->controller('vendor/lts_column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('vendor/lts_subscription', $data));
  }

  public function subscribe() {

    $this->load->language('vendor/lts_subscription');

    $this->load->model('vendor/lts_subscription');

    $this->document->setTitle($this->language->get('heading_title'));

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('text_home'),
      'href' => $this->url->link('common/home')
    );

    $data['breadcrumbs'][] = array(
      'text' => $this->language->get('heading_title'),
      'href' => $this->url->link('vendor/lts_subscription', '', true)
    ); 

    $results = $this->model_vendor_lts_subscription->getSubscription($this->request->get['subscription_id']);

    
    $data['action'] = $this->url->link('vendor/lts_subscription/add', '&subscription_id=' . $this->request->get['subscription_id']);


    $this->load->controller('vendor/lts_header/script');
    $data['header'] = $this->load->controller('common/header');
    $data['lts_column_left'] = $this->load->controller('vendor/lts_column_left');
    $data['footer'] = $this->load->controller('common/footer');
    $this->response->setOutput($this->load->view('vendor/lts_subscription_confirmation', $data));
  }

}

?>