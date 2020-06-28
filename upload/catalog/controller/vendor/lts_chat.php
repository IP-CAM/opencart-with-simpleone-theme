<?php

class ControllerVendorLtsChat extends Controller {

  public function index() {    

    $this->load->language('vendor/lts_chat');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('vendor/lts_vendor');

    $vendor_info = $this->model_vendor_lts_vendor->getStoreInformation($this->customer->isVendor());

    $this->load->model('tool/image');

    // if (isset($this->request->post['logo']) && is_file(DIR_IMAGE . $this->request->post['logo'])) {
    //   $data['logo_thumb'] = $this->model_tool_image->resize($this->request->post['logo'], 100, 100);
    // } elseif (!empty($store_info) && is_file(DIR_IMAGE . $store_info['logo'])) {
    //   $data['logo_thumb'] = $this->model_tool_image->resize($store_info['logo'], 100, 100);
    // } else {
    //   $data['logo_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
    // }

    if(!empty($vendor_info)) {
      $data['logo'] = $this->model_tool_image->resize($vendor_info['logo'], 25, 25);
    } else {
      $data['logo'] = $this->model_tool_image->resize('no_image.png', 25, 25);
    }

    $this->load->model('tool/image');

    if (!empty($vendor_info) && is_file(DIR_IMAGE . $vendor_info['logo'])) {
      $data['logo'] = $this->model_tool_image->resize($vendor_info['logo'], 100, 100);
    } else {
      $data['logo'] = $this->model_tool_image->resize('no_image.png', 100, 100);
    }

    if (!empty($vendor_info)) {
      $data['vendor_id'] = $this->customer->isVendor();
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

    $data['vendor_id'] = $this->customer->isVendor();
    $this->load->controller('vendor/lts_header/script');
    $data['header'] = $this->load->controller('common/header');
    $data['lts_column_left'] = $this->load->controller('vendor/lts_column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('vendor/lts_chat', $data));
  }

  public function add() {

    $this->load->model('vendor/lts_vendor');

    $json = array();

    if(!empty($this->request->post['message'])) {
      
    }


    $this->model_vendor_lts_vendor->addChat($this->request->post);

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }


  public function load() {
    $json =  array();

    $this->load->model('vendor/lts_vendor');

    $results = $this->model_vendor_lts_vendor->getMessage($this->customer->getId(), 0);

     // foreach($results as $result) {
     //    $json['items'][] = $result['message'];
     //  }
    $json['items'] =  $results;
 

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
      
  }


  public function autocomplete() {
    $json = array();

    if (isset($this->request->get['filter_name'])) {
      $this->load->model('vendor/lts_category');

      $filter_data = array(
          'filter_name' => $this->request->get['filter_name'],
          'sort' => 'name',
          'order' => 'ASC',
          'start' => 0,
          'limit' => 5
      );

      $results = $this->model_vendor_lts_category->getCategories($filter_data);

      foreach ($results as $result) {
        $json[] = array(
            'category_id' => $result['category_id'],
            'name' => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
        );
      }
    }

    $sort_order = array();

    foreach ($json as $key => $value) {
      $sort_order[$key] = $value['name'];
    }

    array_multisort($sort_order, SORT_ASC, $json);

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

}
