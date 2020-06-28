<?php

class ControllerVendorLtsHeader extends Controller {
  public function script(){
    $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment.min.js');
    $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment-with-locales.min.js');

    $this->document->addScript('catalog/view/javascript/vendor/lts-vendor.js');

    $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');

    $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/locales.js');

    $this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/locales.min.js');
    

    $this->document->addStyle('catalog/view/javascript/vendor/lts-vendor.css');
    $this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
  }
  public function index() {


    $data['title'] = $this->document->getTitle();

    if ($this->request->server['HTTPS']) {
      $data['base'] = HTTPS_SERVER;
    } else {
      $data['base'] = HTTP_SERVER;
    }

    // $data['description'] = $this->document->getDescription();
    // $data['keywords'] = $this->document->getKeywords();
    // $data['links'] = $this->document->getLinks();
    // $data['styles'] = $this->document->getStyles();
    // $data['scripts'] = $this->document->getScripts();
    // $data['lang'] = $this->language->get('code');
    // $data['direction'] = $this->language->get('direction');
    // $this->load->language('common/header');
    // $data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
    // if (!isset($this->request->get['user_token']) || !isset($this->session->data['user_token']) || ($this->request->get['user_token'] != $this->session->data['user_token'])) {
    // 	$data['logged'] = '';
    // 	$data['home'] = $this->url->link('common/dashboard', '', true);
    // } else {
    // 	$data['logged'] = true;
    // 	$data['home'] = $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true);
    // 	$data['logout'] = $this->url->link('common/logout', 'user_token=' . $this->session->data['user_token'], true);
    // 	$data['profile'] = $this->url->link('common/profile', 'user_token=' . $this->session->data['user_token'], true);

    $this->load->model('vendor/lts_vendor');

    $this->load->model('tool/image');

    $vendor_info = $this->model_vendor_lts_vendor->getVendor($this->customer->isVendor());

    if ($vendor_info) {
      $data['firstname'] = $vendor_info['firstname'];
      $data['lastname'] = $vendor_info['lastname'];

      // if (is_file(DIR_IMAGE . $vendor_info['image'])) {
      // 	//$data['image'] = $this->model_tool_image->resize($vendor_info['image'], 45, 45);
      // } else {
      // 	$data['image'] = $this->model_tool_image->resize('profile.png', 45, 45);
      // }
    } else {
      $data['firstname'] = '';
      $data['lastname'] = '';
      $data['image'] = '';
    }

    // 	// Online Stores
    // 	$data['stores'] = array();
    // 	$data['stores'][] = array(
    // 		'name' => $this->config->get('config_name'),
    // 		'href' => HTTP_CATALOG
    // 	);
    // 	$this->load->model('setting/store');
    // 	$results = $this->model_setting_store->getStores();
    // 	foreach ($results as $result) {
    // 		$data['stores'][] = array(
    // 			'name' => $result['name'],
    // 			'href' => $result['url']
    // 		);
    // 	}
    // }
    // print_r($this->vendor->isLogged());
    // die;


    if (!$this->vendor->isLogged()) {
      $data['logged'] = '';
      $data['home'] = $this->url->link('vendor/lts_dashboard', '', 'SSL');
    } else {
      $data['logged'] = 'SSL';

      $data['logout'] = $this->url->link('vendor/lts_logout', '', 'SSL');
      $data['myprofile'] = $this->url->link('vendor/lts_vendor_profile', 'vendor_id=' . $this->customer->isVendor());
    }

    return $this->load->view('vendor/lts_header', $data);
  }

}
