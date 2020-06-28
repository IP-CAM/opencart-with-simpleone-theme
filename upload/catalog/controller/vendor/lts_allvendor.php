<?php

class ControllerVendorLtsAllvendor extends controller {

  public function index() {
    $this->load->language('vendor/lts_allvendor');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('vendor/lts_allvendor');

    $this->getList();
  }

  protected function getList() {

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('vendor/lts_allvendor')
    );

    $vendor_info = $this->model_vendor_lts_allvendor->getAllActiveVendor();

    $this->load->model('vendor/lts_image');

    foreach ($vendor_info as $vendors) {
      $data['vendors'][] = array(
          'vendor_id' => $vendors['vendor_id'],
          'store' => $vendors['store'],
          'image' => $this->model_vendor_lts_image->resize($vendors['image'], 260, 200),
          'name' => $vendors['name'],
          'email' => $vendors['email'],
          'telephone' => $vendors['telephone'],
          'href' => $this->url->link('vendor/lts_allvendor/info', '&vendor_id=' . $vendors['vendor_id'])
      );
    }

    $data['header'] = $this->load->controller('common/header');
    $data['footer'] = $this->load->controller('common/footer');
    $data['column_left'] = $this->load->controller('common/column_left');

    $this->response->setOutput($this->load->view('vendor/lts_allvendor', $data));
  }

  public function info() {
    if ($this->request->get['vendor_id']) {
      $vendor_id = $this->request->get['vendor_id'];
    } else {
      $vendor_id = 0;
    }

    $this->load->model('vendor/lts_allvendor');

    $vendor_info = $this->model_vendor_lts_allvendor->getVendorProduct($vendor_id);

    $data['header'] = $this->load->controller('common/header');
    $data['footer'] = $this->load->controller('common/footer');
    $data['column_left'] = $this->load->controller('common/column_left');

    $this->response->setOutput($this->load->view('vendor/lts_allvendor_info', $data));
  }

}
