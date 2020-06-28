<?php

include DIR_SYSTEM . '/library/vendor/PHPExcel.php';

class ControllerVendorLtsExport extends controller {

  private $error = array();

  public function index() {

    $this->load->language('vendor/lts_export');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('vendor/lts_export');

    $this->load->model('vendor/lts_order_status');

    $this->getForm();
  }

  public function getForm() {

    $this->load->model('vendor/lts_order_status');

    if (isset($this->request->get['product_type'])) {
      $product_type = $this->request->get['product_type'];
    } else {
      $product_type = 1;
    }

    $data['breadcrumbs'] = array();

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('vendor/dashboard')
    );

    $data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('vendor/lts_export')
    );

    $data['product_action'] = $this->url->link('vendor/lts_export/product', '&product_type=' . $product_type, true);

    $data['order_action'] = $this->url->link('vendor/lts_export/order', '&order_status_id=1', true);

    $data['order_statuses'] = $this->model_vendor_lts_order_status->getOrderStatuses();

    $data['header'] = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('vendor/lts_export', $data));
  }

  public function order() {
    $phpExcel = new PHPExcel();

    $this->load->model('vendor/lts_export');

    if (isset($this->request->get['order_status_id'])) {
      $order_status_id = $this->request->get['order_status_id'];
    } else {
      $order_status_id = 0;
    }

    $results = $this->model_vendor_lts_export->getOrderExport($order_status_id);

    if (!empty($results['orders'])) {
      $no = 2;
      $chr = 'A';
      $i = 1;

      $phpExcel->getActiveSheet()->SetTitle('Orders');

      $phpExcel->setActiveSheetIndex(0);

      $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'order_id');
      $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'invoice_no');
      $phpExcel->getActiveSheet()->SetCellValue('C' . $i, 'invoice_prefix');
      $phpExcel->getActiveSheet()->SetCellValue('D' . $i, 'store_id');
      $phpExcel->getActiveSheet()->SetCellValue('E' . $i, 'customer_id');
      $phpExcel->getActiveSheet()->SetCellValue('F' . $i, 'customer_group_id');
      $phpExcel->getActiveSheet()->SetCellValue('G' . $i, 'firstname');
      $phpExcel->getActiveSheet()->SetCellValue('H' . $i, 'lastname');
      $phpExcel->getActiveSheet()->SetCellValue('I' . $i, 'email');
      $phpExcel->getActiveSheet()->SetCellValue('J' . $i, 'telephone');
      $phpExcel->getActiveSheet()->SetCellValue('K' . $i, 'fax');
      $phpExcel->getActiveSheet()->SetCellValue('L' . $i, 'custom_field');
      $phpExcel->getActiveSheet()->SetCellValue('M' . $i, 'payment_firstname');
      $phpExcel->getActiveSheet()->SetCellValue('N' . $i, 'payment_lastname');
      $phpExcel->getActiveSheet()->SetCellValue('O' . $i, 'payment_company');
      $phpExcel->getActiveSheet()->SetCellValue('P' . $i, 'payment_address_1');
      $phpExcel->getActiveSheet()->SetCellValue('Q' . $i, 'payment_address_2');
      $phpExcel->getActiveSheet()->SetCellValue('R' . $i, 'payment_city');
      $phpExcel->getActiveSheet()->SetCellValue('S' . $i, 'payment_postcode');
      $phpExcel->getActiveSheet()->SetCellValue('T' . $i, 'payment_country');
      $phpExcel->getActiveSheet()->SetCellValue('U' . $i, 'payment_country_id');
      $phpExcel->getActiveSheet()->SetCellValue('V' . $i, 'payment_zone');
      $phpExcel->getActiveSheet()->SetCellValue('W' . $i, 'payment_zone_id');
      $phpExcel->getActiveSheet()->SetCellValue('X' . $i, 'payment_address_format');
      $phpExcel->getActiveSheet()->SetCellValue('Y' . $i, 'payment_custom_field');
      $phpExcel->getActiveSheet()->SetCellValue('Z' . $i, 'payment_method');
      $phpExcel->getActiveSheet()->SetCellValue('AA' . $i, 'payment_code');
      $phpExcel->getActiveSheet()->SetCellValue('AB' . $i, 'shipping_firstname');
      $phpExcel->getActiveSheet()->SetCellValue('AC' . $i, 'shipping_lastname');
      $phpExcel->getActiveSheet()->SetCellValue('AD' . $i, 'shipping_company');
      $phpExcel->getActiveSheet()->SetCellValue('AE' . $i, 'shipping_address_1');
      $phpExcel->getActiveSheet()->SetCellValue('AF' . $i, 'shipping_address_2');
      $phpExcel->getActiveSheet()->SetCellValue('AG' . $i, 'shipping_city');
      $phpExcel->getActiveSheet()->SetCellValue('AH' . $i, 'shipping_postcode');
      $phpExcel->getActiveSheet()->SetCellValue('AI' . $i, 'shipping_country');
      $phpExcel->getActiveSheet()->SetCellValue('AJ' . $i, 'shipping_country_id');
      $phpExcel->getActiveSheet()->SetCellValue('AK' . $i, 'shipping_zone');
      $phpExcel->getActiveSheet()->SetCellValue('AL' . $i, 'shipping_zone_id');
      $phpExcel->getActiveSheet()->SetCellValue('AM' . $i, 'shipping_address_format');
      $phpExcel->getActiveSheet()->SetCellValue('AN' . $i, 'shipping_custom_field');
      $phpExcel->getActiveSheet()->SetCellValue('AO' . $i, 'shipping_method');
      $phpExcel->getActiveSheet()->SetCellValue('AP' . $i, 'shipping_code');
      $phpExcel->getActiveSheet()->SetCellValue('AQ' . $i, 'comment');
      $phpExcel->getActiveSheet()->SetCellValue('AR' . $i, 'total');
      $phpExcel->getActiveSheet()->SetCellValue('AS' . $i, 'order_status_id');
      $phpExcel->getActiveSheet()->SetCellValue('AT' . $i, 'affiliate_id');
      $phpExcel->getActiveSheet()->SetCellValue('AU' . $i, 'commission');
      $phpExcel->getActiveSheet()->SetCellValue('AV' . $i, 'marketing_id');
      $phpExcel->getActiveSheet()->SetCellValue('AW' . $i, 'tracking');
      $phpExcel->getActiveSheet()->SetCellValue('AX' . $i, 'language_id');
      $phpExcel->getActiveSheet()->SetCellValue('AY' . $i, 'currency_id');
      $phpExcel->getActiveSheet()->SetCellValue('AZ' . $i, 'currency_code');
      $phpExcel->getActiveSheet()->SetCellValue('BA' . $i, 'currency_value');
      $phpExcel->getActiveSheet()->SetCellValue('BB' . $i, 'forwarded_ip');
      $phpExcel->getActiveSheet()->SetCellValue('BC' . $i, 'user_agent');
      $phpExcel->getActiveSheet()->SetCellValue('BD' . $i, 'accept_language');
      $phpExcel->getActiveSheet()->SetCellValue('BE' . $i, 'date_added');
      $phpExcel->getActiveSheet()->SetCellValue('BF' . $i, 'date_modified');
      foreach ($results['orders'] as $result) {
        if (!(empty($result))) {
          foreach ($result as $value) {
            $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $value['order_id']);
            $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $value['invoice_no']);
            $phpExcel->getActiveSheet()->SetCellValue('C' . $no, $value['invoice_prefix']);
            $phpExcel->getActiveSheet()->SetCellValue('D' . $no, $value['store_id']);
            $phpExcel->getActiveSheet()->SetCellValue('E' . $no, $value['customer_id']);
            $phpExcel->getActiveSheet()->SetCellValue('F' . $no, $value['customer_group_id']);
            $phpExcel->getActiveSheet()->SetCellValue('G' . $no, $value['firstname']);
            $phpExcel->getActiveSheet()->SetCellValue('H' . $no, $value['lastname']);
            $phpExcel->getActiveSheet()->SetCellValue('I' . $no, $value['email']);
            $phpExcel->getActiveSheet()->SetCellValue('J' . $no, $value['telephone']);
            $phpExcel->getActiveSheet()->SetCellValue('K' . $no, $value['fax']);
            $phpExcel->getActiveSheet()->SetCellValue('L' . $no, $value['custom_field']);
            $phpExcel->getActiveSheet()->SetCellValue('M' . $no, $value['payment_firstname']);
            $phpExcel->getActiveSheet()->SetCellValue('N' . $no, $value['payment_lastname']);
            $phpExcel->getActiveSheet()->SetCellValue('O' . $no, $value['payment_company']);
            $phpExcel->getActiveSheet()->SetCellValue('P' . $no, $value['payment_address_1']);
            $phpExcel->getActiveSheet()->SetCellValue('Q' . $no, $value['payment_address_2']);
            $phpExcel->getActiveSheet()->SetCellValue('R' . $no, $value['payment_city']);
            $phpExcel->getActiveSheet()->SetCellValue('S' . $no, $value['payment_postcode']);
            $phpExcel->getActiveSheet()->SetCellValue('T' . $no, $value['payment_country']);
            $phpExcel->getActiveSheet()->SetCellValue('U' . $no, $value['payment_country_id']);
            $phpExcel->getActiveSheet()->SetCellValue('V' . $no, $value['payment_zone']);
            $phpExcel->getActiveSheet()->SetCellValue('W' . $no, $value['payment_zone_id']);
            $phpExcel->getActiveSheet()->SetCellValue('X' . $no, $value['payment_address_format']);
            $phpExcel->getActiveSheet()->SetCellValue('Y' . $no, $value['payment_custom_field']);
            $phpExcel->getActiveSheet()->SetCellValue('Z' . $no, $value['payment_method']);
            $phpExcel->getActiveSheet()->SetCellValue('AA' . $no, $value['payment_code']);
            $phpExcel->getActiveSheet()->SetCellValue('AB' . $no, $value['shipping_firstname']);
            $phpExcel->getActiveSheet()->SetCellValue('AC' . $no, $value['shipping_lastname']);
            $phpExcel->getActiveSheet()->SetCellValue('AD' . $no, $value['shipping_company']);
            $phpExcel->getActiveSheet()->SetCellValue('AE' . $no, $value['shipping_address_1']);
            $phpExcel->getActiveSheet()->SetCellValue('AF' . $no, $value['shipping_address_2']);
            $phpExcel->getActiveSheet()->SetCellValue('AG' . $no, $value['shipping_city']);
            $phpExcel->getActiveSheet()->SetCellValue('AH' . $no, $value['shipping_postcode']);
            $phpExcel->getActiveSheet()->SetCellValue('AI' . $no, $value['shipping_country']);
            $phpExcel->getActiveSheet()->SetCellValue('AJ' . $no, $value['shipping_country_id']);
            $phpExcel->getActiveSheet()->SetCellValue('AK' . $no, $value['shipping_zone']);
            $phpExcel->getActiveSheet()->SetCellValue('AL' . $no, $value['shipping_zone_id']);
            $phpExcel->getActiveSheet()->SetCellValue('AM' . $no, $value['shipping_address_format']);
            $phpExcel->getActiveSheet()->SetCellValue('AN' . $no, $value['shipping_custom_field']);
            $phpExcel->getActiveSheet()->SetCellValue('AO' . $no, $value['shipping_method']);
            $phpExcel->getActiveSheet()->SetCellValue('AP' . $no, $value['shipping_code']);
            $phpExcel->getActiveSheet()->SetCellValue('AQ' . $no, $value['comment']);
            $phpExcel->getActiveSheet()->SetCellValue('AR' . $no, $value['total']);
            $phpExcel->getActiveSheet()->SetCellValue('AS' . $no, $value['order_status_id']);
            $phpExcel->getActiveSheet()->SetCellValue('AT' . $no, $value['affiliate_id']);
            $phpExcel->getActiveSheet()->SetCellValue('AU' . $no, $value['commission']);
            $phpExcel->getActiveSheet()->SetCellValue('AV' . $no, $value['marketing_id']);
            $phpExcel->getActiveSheet()->SetCellValue('AW' . $no, $value['tracking']);
            $phpExcel->getActiveSheet()->SetCellValue('AX' . $no, $value['language_id']);
            $phpExcel->getActiveSheet()->SetCellValue('AY' . $no, $value['currency_id']);
            $phpExcel->getActiveSheet()->SetCellValue('AZ' . $no, $value['currency_code']);
            $phpExcel->getActiveSheet()->SetCellValue('BA' . $no, $value['currency_value']);
            $phpExcel->getActiveSheet()->SetCellValue('BB' . $no, $value['forwarded_ip']);
            $phpExcel->getActiveSheet()->SetCellValue('BC' . $no, $value['user_agent']);
            $phpExcel->getActiveSheet()->SetCellValue('BD' . $no, $value['accept_language']);
            $phpExcel->getActiveSheet()->SetCellValue('BE' . $no, $value['date_added']);
            $phpExcel->getActiveSheet()->SetCellValue('BF' . $no, $value['date_modified']);
          }
        }
      }

      if ($results['order_products']) {

        $no = 2;
        $i = 1;
        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(1);
        $phpExcel->getActiveSheet()->SetTitle('Order Product');
        $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'order_product_id');
        $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'order_id');
        $phpExcel->getActiveSheet()->SetCellValue('C' . $i, 'product_id');
        $phpExcel->getActiveSheet()->SetCellValue('D' . $i, 'name');
        $phpExcel->getActiveSheet()->SetCellValue('E' . $i, 'model');
        $phpExcel->getActiveSheet()->SetCellValue('F' . $i, 'quantity');
        $phpExcel->getActiveSheet()->SetCellValue('G' . $i, 'price');
        $phpExcel->getActiveSheet()->SetCellValue('H' . $i, 'total');
        $phpExcel->getActiveSheet()->SetCellValue('I' . $i, 'tax');
        $phpExcel->getActiveSheet()->SetCellValue('J' . $i, 'reward');
        foreach ($results['order_products'] as $result) {
          if (!empty($result)) {
            foreach ($result as $value) {
              $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $value['order_product_id']);
              $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $value['order_id']);
              $phpExcel->getActiveSheet()->SetCellValue('C' . $no, $value['product_id']);
              $phpExcel->getActiveSheet()->SetCellValue('D' . $no, $value['name']);
              $phpExcel->getActiveSheet()->SetCellValue('E' . $no, $value['model']);
              $phpExcel->getActiveSheet()->SetCellValue('F' . $no, $value['quantity']);
              $phpExcel->getActiveSheet()->SetCellValue('G' . $no, $value['price']);
              $phpExcel->getActiveSheet()->SetCellValue('H' . $no, $value['total']);
              $phpExcel->getActiveSheet()->SetCellValue('I' . $no, $value['tax']);
              $phpExcel->getActiveSheet()->SetCellValue('J' . $no, $value['reward']);

              $no++;
            }
          }
        }
      }

      if ($results['order_history']) {
        $no = 2;
        $i = 1;
        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(2);
        $phpExcel->getActiveSheet()->SetTitle('Order History');
        $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'order_history_id');
        $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'order_id');
        $phpExcel->getActiveSheet()->SetCellValue('C' . $i, 'order_status_id');
        $phpExcel->getActiveSheet()->SetCellValue('D' . $i, 'notify');
        $phpExcel->getActiveSheet()->SetCellValue('E' . $i, 'comment');
        $phpExcel->getActiveSheet()->SetCellValue('F' . $i, 'date_added');
        foreach ($results['order_history'] as $result) {
          if (!empty($result)) {
            foreach ($result as $value) {
              $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $value['order_history_id']);
              $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $value['order_id']);
              $phpExcel->getActiveSheet()->SetCellValue('C' . $no, $value['order_status_id']);
              $phpExcel->getActiveSheet()->SetCellValue('D' . $no, $value['notify']);
              $phpExcel->getActiveSheet()->SetCellValue('E' . $no, $value['comment']);
              $phpExcel->getActiveSheet()->SetCellValue('F' . $no, $value['date_added']);

              $no++;
            }
          }
        }
      }
    }

    $excelWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');

    $filename = 'order.xls';
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $excelWriter->save('php://output');
    unlink($filename);
  }

  public function product() {
    $this->load->model('vendor/lts_export');

    $phpExcel = new PHPExcel();

    $phpExcel->createSheet();


    if (isset($this->request->get['product_type'])) {
      $product_type = $this->request->get['product_type'];
    } else {
      $product_type = 0;
    }

    if (($product_type == 1 ) || ($product_type == 2 ) || ($product_type == 3 )) {

      $no = 2;
      $chr = 'A';
      $i = 1;

      //$phpExcel->setActiveSheetIndex();
      // $phpExcel->getActiveSheet()->mergeCells('A1:AF1');

      $phpExcel->getActiveSheet()->SetTitle('Product');

      $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'product_id');
      $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'metal');
      $phpExcel->getActiveSheet()->SetCellValue('C' . $i, 'model');
      $phpExcel->getActiveSheet()->SetCellValue('D' . $i, 'sku');
      $phpExcel->getActiveSheet()->SetCellValue('E' . $i, 'upc');
      $phpExcel->getActiveSheet()->SetCellValue('F' . $i, 'ean');
      $phpExcel->getActiveSheet()->SetCellValue('G' . $i, 'jan');
      $phpExcel->getActiveSheet()->SetCellValue('H' . $i, 'isbn');
      $phpExcel->getActiveSheet()->SetCellValue('I' . $i, 'mpn');
      $phpExcel->getActiveSheet()->SetCellValue('J' . $i, 'location');
      $phpExcel->getActiveSheet()->SetCellValue('K' . $i, 'quantity');
      $phpExcel->getActiveSheet()->SetCellValue('L' . $i, 'stock_status_id');
      $phpExcel->getActiveSheet()->SetCellValue('M' . $i, 'image');
      $phpExcel->getActiveSheet()->SetCellValue('N' . $i, 'manufacturer_id');
      $phpExcel->getActiveSheet()->SetCellValue('O' . $i, 'shipping');
      $phpExcel->getActiveSheet()->SetCellValue('P' . $i, 'price');
      $phpExcel->getActiveSheet()->SetCellValue('Q' . $i, 'price_extra');
      $phpExcel->getActiveSheet()->SetCellValue('R' . $i, 'points');
      $phpExcel->getActiveSheet()->SetCellValue('S' . $i, 'tax_class_id');
      $phpExcel->getActiveSheet()->SetCellValue('T' . $i, 'date_available');
      $phpExcel->getActiveSheet()->SetCellValue('U' . $i, 'weight');
      $phpExcel->getActiveSheet()->SetCellValue('V' . $i, 'weight_class_id');
      $phpExcel->getActiveSheet()->SetCellValue('W' . $i, 'length');
      $phpExcel->getActiveSheet()->SetCellValue('X' . $i, 'width');
      $phpExcel->getActiveSheet()->SetCellValue('Y' . $i, 'height');
      $phpExcel->getActiveSheet()->SetCellValue('Z' . $i, 'length_class_id');
      $phpExcel->getActiveSheet()->SetCellValue('AA' . $i, 'subtract');
      $phpExcel->getActiveSheet()->SetCellValue('AB' . $i, 'sort_order');
      $phpExcel->getActiveSheet()->SetCellValue('AC' . $i, 'status');
      $phpExcel->getActiveSheet()->SetCellValue('AD' . $i, 'viewed');
      $phpExcel->getActiveSheet()->SetCellValue('AE' . $i, 'date_added');
      $phpExcel->getActiveSheet()->SetCellValue('AF' . $i, 'date_modified');

      $results = $this->model_vendor_export->getAllProducts($product_type);

      if (!empty($results['products'])) {
        foreach ($results['products'] as $key => $result) {
          $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $result['product_id']);
          $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $result['metal']);
          $phpExcel->getActiveSheet()->SetCellValue('C' . $no, $result['model']);
          $phpExcel->getActiveSheet()->SetCellValue('D' . $no, $result['sku']);
          $phpExcel->getActiveSheet()->SetCellValue('E' . $no, $result['upc']);
          $phpExcel->getActiveSheet()->SetCellValue('F' . $no, $result['ean']);
          $phpExcel->getActiveSheet()->SetCellValue('G' . $no, $result['jan']);
          $phpExcel->getActiveSheet()->SetCellValue('H' . $no, $result['isbn']);
          $phpExcel->getActiveSheet()->SetCellValue('I' . $no, $result['mpn']);
          $phpExcel->getActiveSheet()->SetCellValue('J' . $no, $result['location']);
          $phpExcel->getActiveSheet()->SetCellValue('K' . $no, $result['quantity']);
          $phpExcel->getActiveSheet()->SetCellValue('L' . $no, $result['stock_status_id']);
          $phpExcel->getActiveSheet()->SetCellValue('M' . $no, $result['image']);
          $phpExcel->getActiveSheet()->SetCellValue('N' . $no, $result['manufacturer_id']);
          $phpExcel->getActiveSheet()->SetCellValue('O' . $no, $result['shipping']);
          $phpExcel->getActiveSheet()->SetCellValue('P' . $no, $result['price']);
          $phpExcel->getActiveSheet()->SetCellValue('Q' . $no, $result['price_extra']);
          $phpExcel->getActiveSheet()->SetCellValue('R' . $no, $result['points']);
          $phpExcel->getActiveSheet()->SetCellValue('S' . $no, $result['tax_class_id']);
          $phpExcel->getActiveSheet()->SetCellValue('T' . $no, $result['date_available']);
          $phpExcel->getActiveSheet()->SetCellValue('U' . $no, $result['weight']);
          $phpExcel->getActiveSheet()->SetCellValue('V' . $no, $result['weight_class_id']);
          $phpExcel->getActiveSheet()->SetCellValue('W' . $no, $result['length']);
          $phpExcel->getActiveSheet()->SetCellValue('X' . $no, $result['width']);
          $phpExcel->getActiveSheet()->SetCellValue('Y' . $no, $result['height']);
          $phpExcel->getActiveSheet()->SetCellValue('Z' . $no, $result['length_class_id']);
          $phpExcel->getActiveSheet()->SetCellValue('AA' . $no, $result['subtract']);
          $phpExcel->getActiveSheet()->SetCellValue('AB' . $no, $result['sort_order']);
          $phpExcel->getActiveSheet()->SetCellValue('AC' . $no, $result['status']);
          $phpExcel->getActiveSheet()->SetCellValue('AD' . $no, $result['viewed']);
          $phpExcel->getActiveSheet()->SetCellValue('AE' . $no, $result['date_added']);
          $phpExcel->getActiveSheet()->SetCellValue('AF' . $no, $result['date_modified']);
          // $chr++;
          $no++;
        }
      }

      if (!empty($results['product_description'])) {
        $no = 2;
        $i = 1;
        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(1);
        $phpExcel->getActiveSheet()->SetTitle('Product Description');
        $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'product_id');
        $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'language_id');
        $phpExcel->getActiveSheet()->SetCellValue('C' . $i, 'vendor_id');
        $phpExcel->getActiveSheet()->SetCellValue('D' . $i, 'name');
        $phpExcel->getActiveSheet()->SetCellValue('E' . $i, 'description');
        $phpExcel->getActiveSheet()->SetCellValue('F' . $i, 'tag');
        $phpExcel->getActiveSheet()->SetCellValue('G' . $i, 'meta_title');
        $phpExcel->getActiveSheet()->SetCellValue('H' . $i, 'meta_description');
        $phpExcel->getActiveSheet()->SetCellValue('I' . $i, 'meta_keyword');

        foreach ($results['product_description'] as $result) {
          $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $result['product_id']);
          $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $result['language_id']);
          $phpExcel->getActiveSheet()->SetCellValue('C' . $no, $result['vendor_id']);
          $phpExcel->getActiveSheet()->SetCellValue('D' . $no, $result['name']);
          $phpExcel->getActiveSheet()->SetCellValue('E' . $no, $result['description']);
          $phpExcel->getActiveSheet()->SetCellValue('F' . $no, $result['tag']);
          $phpExcel->getActiveSheet()->SetCellValue('G' . $no, $result['meta_title']);
          $phpExcel->getActiveSheet()->SetCellValue('H' . $no, $result['meta_description']);
          $phpExcel->getActiveSheet()->SetCellValue('I' . $no, $result['meta_keyword']);
        }
      }

      if (!empty($results['product_attribute'])) {
        $no = 2;
        $i = 1;
        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(2);
        $phpExcel->getActiveSheet()->SetTitle('Product Attribute');
        $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'product_id');
        $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'attribute_id');
        $phpExcel->getActiveSheet()->SetCellValue('C' . $i, 'language_id');
        $phpExcel->getActiveSheet()->SetCellValue('D' . $i, 'text');

        foreach ($results['product_attribute'] as $result) {
          if (!(empty($result))) {
            $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $result['product_id']);
            $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $result['attribute_id']);
            $phpExcel->getActiveSheet()->SetCellValue('C' . $no, $result['language_id']);
            $phpExcel->getActiveSheet()->SetCellValue('D' . $no, $result['text']);
            $no++;
          }
        }
      }

      if (!empty($results['product_discount'])) {
        $no = 2;
        $i = 1;
        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(3);
        $phpExcel->getActiveSheet()->SetTitle('Product Discout');
        $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'product_discount_id');
        $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'product_id');
        $phpExcel->getActiveSheet()->SetCellValue('C' . $i, 'customer_group_id');
        $phpExcel->getActiveSheet()->SetCellValue('D' . $i, 'quantity');
        $phpExcel->getActiveSheet()->SetCellValue('E' . $i, 'priority');
        $phpExcel->getActiveSheet()->SetCellValue('F' . $i, 'price');
        $phpExcel->getActiveSheet()->SetCellValue('G' . $i, 'date_start');
        $phpExcel->getActiveSheet()->SetCellValue('H' . $i, 'date_end');
        foreach ($results['product_discount'] as $result) {
          if (!empty($result)) {
            $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $result['product_discount_id']);
            $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $result['product_id']);
            $phpExcel->getActiveSheet()->SetCellValue('C' . $no, $result['customer_group_id']);
            $phpExcel->getActiveSheet()->SetCellValue('D' . $no, $result['quantity']);
            $phpExcel->getActiveSheet()->SetCellValue('E' . $no, $result['priority']);
            $phpExcel->getActiveSheet()->SetCellValue('F' . $no, $result['price']);
            $phpExcel->getActiveSheet()->SetCellValue('G' . $no, $result['date_start']);
            $phpExcel->getActiveSheet()->SetCellValue('H' . $no, $result['date_end']);
            $no++;
          }
        }
      }

      if (!empty($results['product_image'])) {
        $no = 2;
        $i = 1;
        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(4);
        $phpExcel->getActiveSheet()->SetTitle('Product Image');
        $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'product_image_id');
        $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'product_id');
        $phpExcel->getActiveSheet()->SetCellValue('C' . $i, 'image');
        $phpExcel->getActiveSheet()->SetCellValue('D' . $i, 'sort_order');
        foreach ($results['product_image'] as $result) {
          if (!empty($result)) {
            foreach ($result as $value) {
              $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $value['product_image_id']);
              $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $value['product_id']);
              $phpExcel->getActiveSheet()->SetCellValue('C' . $no, $value['image']);
              $phpExcel->getActiveSheet()->SetCellValue('D' . $no, $value['sort_order']);
              $no++;
            }
          }
        }
      }

      if (!empty($results['product_download'])) {
        $no = 2;
        $i = 1;
        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(5);
        $phpExcel->getActiveSheet()->SetTitle('Product Download');
        $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'product_id');
        $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'download_id');
        foreach ($results['product_download'] as $result) {
          if (!empty($result)) {
            foreach ($result as $value) {
              $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $value['product_id']);
              $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $value['download_id']);
              $no++;
            }
          }
        }
      }

      if (!empty($results['product_special'])) {
        $no = 2;
        $i = 1;
        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(6);
        $phpExcel->getActiveSheet()->SetTitle('Product Special');
        $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'product_special_id');
        $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'product_id');
        $phpExcel->getActiveSheet()->SetCellValue('C' . $i, 'customer_group_id');
        $phpExcel->getActiveSheet()->SetCellValue('D' . $i, 'priority');
        $phpExcel->getActiveSheet()->SetCellValue('E' . $i, 'price');
        $phpExcel->getActiveSheet()->SetCellValue('F' . $i, 'date_start');
        $phpExcel->getActiveSheet()->SetCellValue('G' . $i, 'date_end');
        foreach ($results['product_special'] as $result) {
          if (!empty($result)) {
            foreach ($result as $value) {
              $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $value['product_special_id']);
              $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $value['product_id']);
              $phpExcel->getActiveSheet()->SetCellValue('C' . $no, $value['customer_group_id']);
              $phpExcel->getActiveSheet()->SetCellValue('D' . $no, $value['priority']);
              $phpExcel->getActiveSheet()->SetCellValue('E' . $no, $value['price']);
              $phpExcel->getActiveSheet()->SetCellValue('F' . $no, $value['date_start']);
              $phpExcel->getActiveSheet()->SetCellValue('G' . $no, $value['date_end']);
              $no++;
            }
          }
        }
      }

      if (!empty($results['product_filter'])) {
        $no = 2;
        $i = 1;
        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(8);
        $phpExcel->getActiveSheet()->SetTitle('Product Filter');
        $phpExcel->getActiveSheet()->SetCellValue('A' . $i, 'product_id');
        $phpExcel->getActiveSheet()->SetCellValue('B' . $i, 'filter_id');
        foreach ($results['product_filter'] as $result) {
          if (!empty($result)) {
            foreach ($result as $value) {
              $phpExcel->getActiveSheet()->SetCellValue('A' . $no, $value['product_id']);
              $phpExcel->getActiveSheet()->SetCellValue('B' . $no, $value['filter_id']);
              $no++;
            }
          }
        }
      }
    }

    $excelWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');

    $filename = 'product.xls';
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $excelWriter->save('php://output');


    // $this->response->addHeader('Content-Type: application/json');
    // $this->response->setOutput(json_encode($excelWriter->save('php://output')));
    // unlink($filename);
  }

  protected function validateForm() {
    if (!$this->request->post['product']) {
      $error['product'] = $this->language->get['error_product'];
    }

    if (!$this->request->post['product']) {
      $error['product'] = $this->language->get['error_product'];
    }

    return !$this->error;
  }

}
