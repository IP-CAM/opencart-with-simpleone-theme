<?php

class ControllerVendorLtsColumnRight extends Controller {

  public function index() {
    $data = array();

    $this->load->language('vendor/column_right');


    return $this->load->view('vendor/lts_column_right', $data);
  }

}
