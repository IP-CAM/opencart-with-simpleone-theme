<?php

class ControllerVendorLtsLogout extends Controller {

  public function index() {
    if ($this->customer->isLogged()) {
      $this->customer->logout();
      $this->response->redirect($this->url->link('vendor/lts_logout', '', true));
    }

    $this->load->language('vendor/lts_logout');

    $this->document->setTitle($this->language->get('heading_title'));

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_account'),
        'href' => $this->url->link('vendor/lts_account', '', true)
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_logout'),
        'href' => $this->url->link('vendor/lts_logout', '', true)
    );

    $data['continue'] = $this->url->link('common/home');

    $data['column_left'] = $this->load->controller('common/column_left');
    $data['column_right'] = $this->load->controller('common/column_right');
    $data['content_top'] = $this->load->controller('common/content_top');
    $data['content_bottom'] = $this->load->controller('common/content_bottom');
    $data['footer'] = $this->load->controller('common/footer');
    $data['header'] = $this->load->controller('common/header');

    $this->response->setOutput($this->load->view('vendor/lts_success', $data));
  }

}
