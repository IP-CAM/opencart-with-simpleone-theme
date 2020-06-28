<?php

require_once(DIR_SYSTEM . '/library/vendor/PHPExcel.php');

class ControllerVendorLtsImport extends controller {

  public function index() {

    $phpExcel = new PHPExcel();

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {

      if (is_uploaded_file($this->request->files['product']['tmp_name'])) {
        $content = file_get_contents($this->request->files['product']['tmp_name']);
      } else {
        $content = false;
      }


      $objPHPExcel = PHPExcel_IOFactory::load($this->request->files['product']['tmp_name']);


      $sheetDatas = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);


      foreach ($sheetDatas as $value) {
        print_r($value['B']);
      }
    }

    // print_r($data);




    $data['action'] = $this->url->link('vendor/lts_import');

    $data['header'] = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('vendor/lts_import', $data));
  }

}
