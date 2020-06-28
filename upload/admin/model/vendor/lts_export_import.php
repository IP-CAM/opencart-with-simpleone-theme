<?php

class ModelVendorLtsExportImport extends Model {

  public $null_array = array();
  public $use_table_seo_url = false;

  public function download($export_type) {
    include DIR_SYSTEM . '/library/vendor/PHPExcel.php';

    // PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_ExportImportValueBinder() );
    // chdir( $cwd );
    // find out whether all data is to be downloaded
    // $all = !isset($offset) && !isset($rows) && !isset($min_id) && !isset($max_id);
    // Memory Optimization
//    if ($this->config->get('export_import_settings_use_export_cache')) {
//      $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
//      $cacheSettings = array('memoryCacheSize' => '16MB');
//      PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
//    }
    // $this->posted_categories = $this->getPostedCategories();
    // try {
    // set appropriate timeout limit

    set_time_limit(1800);

    $languages = $this->getLanguages();
    $default_language_id = $this->getDefaultLanguageId();

    // create a new workbook
    $workbook = new PHPExcel();

    // set some default styles
    $workbook->getDefaultStyle()->getFont()->setName('Arial');
    $workbook->getDefaultStyle()->getFont()->setSize(10);
    //$workbook->getDefaultStyle()->getAlignment()->setIndent(0.5);
    $workbook->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $workbook->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $workbook->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);

    // pre-define some commonly used styles
    $box_format = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'F0F0F0')
        ),
    );

    $text_format = array(
        'number_format' => array(
            'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
        ),
    );
    $price_format = array(
        'number_format' => array(
            'code' => '######0.00'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
    );

    $weight_format = array(
        'numberformat' => array(
            'code' => '##0.00'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
    );

    // create the worksheets
    $worksheet_index = 0;
    switch ($export_type) {
      case 'p':
        // creating the Products worksheet
        $workbook->setActiveSheetIndex($worksheet_index++);
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('Products');
        $this->productWorksheet($worksheet, $languages, $default_language_id, $price_format, $box_format, $weight_format, $text_format);
        $worksheet->freezePaneByColumnAndRow(1, 2);
        
        
        // creating the Product Description worksheet
        $workbook->setActiveSheetIndex($worksheet_index++);
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('ProductDescription');
        $this->productDescriptionWorksheet($worksheet, $languages, $default_language_id, $price_format, $box_format, $weight_format, $text_format);
        $worksheet->freezePaneByColumnAndRow(1, 2);
        
        // creating the AdditionalImages worksheet
        $workbook->createSheet();
        $workbook->setActiveSheetIndex($worksheet_index++);
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('AdditionalImages');
        $this->additionalImagesWorksheet($worksheet, $box_format, $text_format);
        $worksheet->freezePaneByColumnAndRow(1, 2);

        // creating the Specials worksheet
        $workbook->createSheet();
        $workbook->setActiveSheetIndex($worksheet_index++);
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('Specials');
        $this->specialsWorksheet($worksheet, $default_language_id, $price_format, $box_format, $text_format);
        $worksheet->freezePaneByColumnAndRow(1, 2);

        // creating the Discounts worksheet
        $workbook->createSheet();
        $workbook->setActiveSheetIndex($worksheet_index++);
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('Discounts');
        $this->discountsWorksheet($worksheet, $default_language_id, $price_format, $box_format, $text_format);
        $worksheet->freezePaneByColumnAndRow(1, 2);

        // creating the Rewards worksheet
        $workbook->createSheet();
        $workbook->setActiveSheetIndex($worksheet_index++);
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('Rewards');
        $this->rewardsWorksheet($worksheet, $default_language_id, $box_format, $text_format);
        $worksheet->freezePaneByColumnAndRow(1, 2);

        // creating the ProductOptions worksheet
        $workbook->createSheet();
        $workbook->setActiveSheetIndex($worksheet_index++);
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('ProductOptions');
        $this->productOptionsWorksheet($worksheet, $box_format, $text_format);
        $worksheet->freezePaneByColumnAndRow(1, 2);

        // creating the ProductOptionValues worksheet
        $workbook->createSheet();
        $workbook->setActiveSheetIndex($worksheet_index++);
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('ProductOptionValues');
        $this->productOptionValuesWorksheet($worksheet, $price_format, $box_format, $weight_format, $text_format);
        $worksheet->freezePaneByColumnAndRow(1, 2);

        // creating the ProductAttributes worksheet
        $workbook->createSheet();
        $workbook->setActiveSheetIndex($worksheet_index++);
        $worksheet = $workbook->getActiveSheet();
        $worksheet->setTitle('ProductAttributes');
        $this->productAttributesWorksheet($worksheet, $languages, $default_language_id, $box_format, $text_format);
        $worksheet->freezePaneByColumnAndRow(1, 2);

        // creating the ProductFilters worksheet
        if ($this->existFilter()) {
          $workbook->createSheet();
          $workbook->setActiveSheetIndex($worksheet_index++);
          $worksheet = $workbook->getActiveSheet();
          $worksheet->setTitle('ProductFilters');
          $this->productFiltersWorksheet($worksheet, $languages, $default_language_id, $box_format, $text_format);
          $worksheet->freezePaneByColumnAndRow(1, 2);
        }
        // creating the ProductSEOKeywords worksheet
        if ($this->use_table_seo_url) {
          $workbook->createSheet();
          $workbook->setActiveSheetIndex($worksheet_index++);
          $worksheet = $workbook->getActiveSheet();
          $worksheet->setTitle('ProductSEOKeywords');
          $this->productSEOKeywordsWorksheet($worksheet, $languages, $box_format, $text_format);
          $worksheet->freezePaneByColumnAndRow(1, 2);
        }
        break;
      default:
        break;
    }
    
    
    
   print_r($workbook);
   
   die;
    $workbook->setActiveSheetIndex(0);

    // redirect output to client browser
    $datetime = date('Y-m-d');
    switch ($export_type) {
      case 'p':
        $filename = 'lts-_products-' . $datetime;

        if (isset($offset)) {
          $filename .= "-offset-$offset";
        } else if (isset($min_id)) {
          $filename .= "-start-$min_id";
        }

        $filename .= '.xlsx';

        break;

      default:
        $filename = $datetime . '.xlsx';
        break;
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
    $objWriter->setPreCalculateFormulas(false);
    $objWriter->save('php://output');

    // Clear the spreadsheet caches
    $this->clearSpreadsheetCache();
    exit;

    // } catch (Exception $e) {
    //  $errstr = $e->getMessage();
    //  $errline = $e->getLine();
    //  $errfile = $e->getFile();
    //  $errno = $e->getCode();
    //  $this->session->data['export_import_error'] = array( 'errstr'=>$errstr, 'errno'=>$errno, 'errfile'=>$errfile, 'errline'=>$errline );
    //  if ($this->config->get('config_error_log')) {
    //      $this->log->write('PHP ' . get_class($e) . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
    //  }
    //  return;
    // }
  }

  public function productWorksheet(&$worksheet, &$languages, $default_language_id, &$price_format, &$box_format, &$weight_format, &$text_format, $offset = null, $rows = null) {

    $query = $this->db->query("DESCRIBE `" . DB_PREFIX . "product`");

    $product_fields = array();
    foreach ($query->rows as $row) {
      $product_fields[] = $row['Field'];
    }

    // Opencart versions from 2.0 onwards also have product_description.meta_title
    $sql = "SHOW COLUMNS FROM `" . DB_PREFIX . "product_description` LIKE 'meta_title'";
    $query = $this->db->query($sql);

    $exist_meta_title = ($query->num_rows > 0) ? true : false;

    // Set the column widths
    $j = 0;



    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('product_id'), 4) + 1);

//    foreach ($languages as $language) {
//      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('name') + 4, 30) + 1);
//    }
//    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('categories'), 12) + 1);


    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('metal'), 12) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('model'), 8) + 1);


    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('sku'), 10) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('upc'), 12) + 1);
    if (in_array('ean', $product_fields)) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('ean'), 14) + 1);
    }
    if (in_array('jan', $product_fields)) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('jan'), 13) + 1);
    }
    if (in_array('isbn', $product_fields)) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('isbn'), 13) + 1);
    }
    if (in_array('mpn', $product_fields)) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('mpn'), 15) + 1);
    }

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('location'), 10) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('quantity'), 4) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('stock_status_id'), 4) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('image'), 12) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('manufacturer_id'), 10) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('shipping'), 5) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('price'), 10) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('price_extra_type'), 5) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('price_extra'), 5) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('points'), 5) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('tax_class_id'), 2) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_available'), 10) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('weight'), 6) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('weight_class_id'), 6) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('length'), 8) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('width'), 8) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('height'), 8) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('length_class_id'), 8) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('subtract'), 5) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('minimum'), 8) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('sort_order'), 8) + 1);
    
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('status'), 5) + 1);
    
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('viewed'), 5) + 1);
    
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_added'), 19) + 1);

    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_modified'), 19) + 1);



    /*
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('weight_unit'), 3) + 1);


    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('length_unit'), 3) + 1);
    

    foreach ($languages as $language) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('description') + 4, 32) + 1);
    }
    if ($exist_meta_title) {
      foreach ($languages as $language) {
        $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('meta_title') + 4, 20) + 1);
      }
    }

    foreach ($languages as $language) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('meta_description') + 4, 32) + 1);
    }

    foreach ($languages as $language) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('meta_keywords') + 4, 32) + 1);
    }
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('stock_status_id'), 3) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('store_ids'), 16) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('layout'), 16) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('related_ids'), 16) + 1);
    foreach ($languages as $language) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('tags') + 4, 32) + 1);
    }


      */

    // The product headings row and column styles
    $styles = array();
    $data = array();
    $i = 1;
    $j = 0;
    $data[$j++] = 'product_id';
    foreach ($languages as $language) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'name(' . $language['code'] . ')';
    }
    $styles[$j] = &$text_format;
    $data[$j++] = 'categories';
    $styles[$j] = &$text_format;
    $data[$j++] = 'sku';
    $styles[$j] = &$text_format;
    $data[$j++] = 'upc';
    if (in_array('ean', $product_fields)) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'ean';
    }
    if (in_array('jan', $product_fields)) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'jan';
    }
    if (in_array('isbn', $product_fields)) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'isbn';
    }
    if (in_array('mpn', $product_fields)) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'mpn';
    }
    $styles[$j] = &$text_format;
    $data[$j++] = 'location';
    $data[$j++] = 'quantity';
    $styles[$j] = &$text_format;
    $data[$j++] = 'model';
    $styles[$j] = &$text_format;
    $data[$j++] = 'manufacturer';
    $styles[$j] = &$text_format;
    $data[$j++] = 'image_name';
    $data[$j++] = 'shipping';
    $styles[$j] = &$price_format;
    $data[$j++] = 'price';
    $data[$j++] = 'points';
    $data[$j++] = 'date_added';
    $data[$j++] = 'date_modified';
    $data[$j++] = 'date_available';
    $styles[$j] = &$weight_format;
    $data[$j++] = 'weight';
    $data[$j++] = 'weight_unit';
    $data[$j++] = 'length';
    $data[$j++] = 'width';
    $data[$j++] = 'height';
    $data[$j++] = 'length_unit';
    $data[$j++] = 'status';
    $data[$j++] = 'tax_class_id';

    foreach ($languages as $language) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'description(' . $language['code'] . ')';
    }
    if ($exist_meta_title) {
      foreach ($languages as $language) {
        $styles[$j] = &$text_format;
        $data[$j++] = 'meta_title(' . $language['code'] . ')';
      }
    }
    foreach ($languages as $language) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'meta_description(' . $language['code'] . ')';
    }
    foreach ($languages as $language) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'meta_keywords(' . $language['code'] . ')';
    }
    $data[$j++] = 'stock_status_id';
    $data[$j++] = 'store_ids';
    $styles[$j] = &$text_format;
    $data[$j++] = 'layout';
    $data[$j++] = 'related_ids';
    foreach ($languages as $language) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'tags(' . $language['code'] . ')';
    }
    $data[$j++] = 'sort_order';
    $data[$j++] = 'subtract';
    $data[$j++] = 'minimum';
    $worksheet->getRowDimension($i)->setRowHeight(30);
    $this->setCellRow($worksheet, $i, $data, $box_format);

    // The actual products data
    $i += 1;
    $j = 0;
    $store_ids = $this->getStoreIdsForProducts();
    $layouts = $this->getLayoutsForProducts();
    $products = $this->getProducts($languages, $default_language_id, $product_fields, $exist_meta_title, $offset, $rows);
    $len = count($products);

    foreach ($products as $row) {
      $data = array();
      $worksheet->getRowDimension($i)->setRowHeight(26);
      $product_id = $row['product_id'];
      $data[$j++] = $product_id;
      foreach ($languages as $language) {
        $data[$j++] = html_entity_decode($row['name'][$language['code']], ENT_QUOTES, 'UTF-8');
      }
      $data[$j++] = $row['categories'];
      $data[$j++] = $row['sku'];
      $data[$j++] = $row['upc'];
      if (in_array('ean', $product_fields)) {
        $data[$j++] = $row['ean'];
      }
      if (in_array('jan', $product_fields)) {
        $data[$j++] = $row['jan'];
      }

      if (in_array('isbn', $product_fields)) {
        $data[$j++] = $row['isbn'];
      }

      if (in_array('mpn', $product_fields)) {
        $data[$j++] = $row['mpn'];
      }


      $data[$j++] = $row['location'];
      $data[$j++] = $row['quantity'];
      $data[$j++] = $row['model'];
      $data[$j++] = $row['manufacturer'];
      $data[$j++] = $row['image_name'];
      $data[$j++] = ($row['shipping'] == 0) ? 'no' : 'yes';
      $data[$j++] = $row['price'];
      $data[$j++] = $row['points'];
      $data[$j++] = $row['date_added'];
      $data[$j++] = $row['date_modified'];
      $data[$j++] = $row['date_available'];
      $data[$j++] = $row['weight'];
      $data[$j++] = $row['weight_unit'];
      $data[$j++] = $row['length'];
      $data[$j++] = $row['width'];
      $data[$j++] = $row['height'];
      $data[$j++] = $row['length_unit'];
      $data[$j++] = ($row['status'] == 0) ? 'false' : 'true';
      $data[$j++] = $row['tax_class_id'];

      foreach ($languages as $language) {
        $data[$j++] = html_entity_decode($row['description'][$language['code']], ENT_QUOTES, 'UTF-8');
      }

      if ($exist_meta_title) {
        foreach ($languages as $language) {
          $data[$j++] = html_entity_decode($row['meta_title'][$language['code']], ENT_QUOTES, 'UTF-8');
        }
      }

      foreach ($languages as $language) {
        $data[$j++] = html_entity_decode($row['meta_description'][$language['code']], ENT_QUOTES, 'UTF-8');
      }

      foreach ($languages as $language) {
        $data[$j++] = html_entity_decode($row['meta_keyword'][$language['code']], ENT_QUOTES, 'UTF-8');
      }

      $data[$j++] = $row['stock_status_id'];
      $store_id_list = '';

      if (isset($store_ids[$product_id])) {
        foreach ($store_ids[$product_id] as $store_id) {
          $store_id_list .= ($store_id_list == '') ? $store_id : ',' . $store_id;
        }
      }

      $data[$j++] = $store_id_list;
      $layout_list = '';
      if (isset($layouts[$product_id])) {
        foreach ($layouts[$product_id] as $store_id => $name) {
          $layout_list .= ($layout_list == '') ? $store_id . ':' . $name : ',' . $store_id . ':' . $name;
        }
      }

      $data[$j++] = $layout_list;
      $data[$j++] = $row['related'];
      foreach ($languages as $language) {
        $data[$j++] = html_entity_decode($row['tag'][$language['code']], ENT_QUOTES, 'UTF-8');
      }

      $data[$j++] = $row['sort_order'];
      $data[$j++] = ($row['subtract'] == 0) ? 'false' : 'true';
      $data[$j++] = $row['minimum'];
      $this->setCellRow($worksheet, $i, $data, $this->null_array, $styles);
      $i += 1;
      $j = 0;
    }


  }
  
  public function productDescriptionWorksheet(&$worksheet, &$languages, $default_language_id, &$price_format, &$box_format, &$weight_format, &$text_format, $offset = null, $rows = null) {
    
  }

  public function getLanguages() {
    $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE `status`=1 ORDER BY `code`");
    return $query->rows;
  }

  public function getDefaultLanguageId() {
    $language_code = $this->config->get('config_language');
    $sql = "SELECT language_id FROM `" . DB_PREFIX . "language` WHERE code = '$language_code'";
    $result = $this->db->query($sql);
    $language_id = 1;
    if ($result->rows) {
      foreach ($result->rows as $row) {
        $language_id = $row['language_id'];
        break;
      }
    }
    return $language_id;
  }

  public function setCellRow($worksheet, $row/* 1-based */, $data, &$default_style = null, &$styles = null) {
    if (!empty($default_style)) {
      $worksheet->getStyle("$row:$row")->applyFromArray($default_style, false);
    }
    if (!empty($styles)) {
      foreach ($styles as $col => $style) {
        $worksheet->getStyleByColumnAndRow($col, $row)->applyFromArray($style, false);
      }
    }
    $worksheet->fromArray($data, null, 'A' . $row, true);
//      foreach ($data as $col=>$val) {
//          $worksheet->setCellValueExplicitByColumnAndRow( $col, $row-1, $val );
//      }
//      foreach ($data as $col=>$val) {
//          $worksheet->setCellValueByColumnAndRow( $col, $row, $val );
//      }
  }

  public function getStoreIdsForProducts() {
    $sql = "SELECT product_id, store_id FROM `" . DB_PREFIX . "product_to_store` ps;";
    $store_ids = array();
    $result = $this->db->query($sql);
    foreach ($result->rows as $row) {
      $productId = $row['product_id'];
      $store_id = $row['store_id'];
      if (!isset($store_ids[$productId])) {
        $store_ids[$productId] = array();
      }
      if (!in_array($store_id, $store_ids[$productId])) {
        $store_ids[$productId][] = $store_id;
      }
    }
    return $store_ids;
  }

  public function getLayoutsForProducts() {
    $sql = "SELECT pl.*, l.name FROM `" . DB_PREFIX . "product_to_layout` pl ";
    $sql .= "LEFT JOIN `" . DB_PREFIX . "layout` l ON pl.layout_id = l.layout_id ";
    $sql .= "ORDER BY pl.product_id, pl.store_id;";
    $result = $this->db->query($sql);
    $layouts = array();
    foreach ($result->rows as $row) {
      $productId = $row['product_id'];
      $store_id = $row['store_id'];
      $name = $row['name'];
      if (!isset($layouts[$productId])) {
        $layouts[$productId] = array();
      }
      $layouts[$productId][$store_id] = $name;
    }
    return $layouts;
  }

  public function getProductDescriptions(&$languages, $offset = null, $rows = null, $min_id = null, $max_id = null) {
    // some older versions of OpenCart use the 'product_tag' table
    $exist_table_product_tag = false;
    $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "product_tag'");
    $exist_table_product_tag = ($query->num_rows > 0);

    // query the product_description table for each language
    $product_descriptions = array();
    foreach ($languages as $language) {
      $language_id = $language['language_id'];
      $language_code = $language['code'];
      $sql = "SELECT p.product_id, " . (($exist_table_product_tag) ? "GROUP_CONCAT(pt.tag SEPARATOR \",\") AS tag, " : "") . "pd.* ";
      $sql .= "FROM `" . DB_PREFIX . "product` p ";
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_description` pd ON pd.product_id=p.product_id AND pd.language_id='" . (int) $language_id . "' ";
      if ($exist_table_product_tag) {
        $sql .= "LEFT JOIN `" . DB_PREFIX . "product_tag` pt ON pt.product_id=p.product_id AND pt.language_id='" . (int) $language_id . "' ";
      }
      if ($this->posted_categories) {
        $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=p.product_id ";
      }
      if (isset($min_id) && isset($max_id)) {
        $sql .= "WHERE p.product_id BETWEEN $min_id AND $max_id ";
        if ($this->posted_categories) {
          $sql .= "AND pc.category_id IN " . $this->posted_categories . " ";
        }
      } else if ($this->posted_categories) {
        $sql .= "WHERE pc.category_id IN " . $this->posted_categories . " ";
      }
      $sql .= "GROUP BY p.product_id ";
      $sql .= "ORDER BY p.product_id ";
      if (isset($offset) && isset($rows)) {
        $sql .= "LIMIT $offset,$rows; ";
      } else {
        $sql .= "; ";
      }
      $query = $this->db->query($sql);
      $product_descriptions[$language_code] = $query->rows;
    }
    return $product_descriptions;
  }

  public function getProducts(&$languages, $default_language_id, $product_fields, $exist_meta_title, $exist_seo_url_table, $offset = null, $rows = null) {
    $sql = "SELECT ";
    $sql .= "  p.product_id,";
    $sql .= "  GROUP_CONCAT( DISTINCT CAST(pc.category_id AS CHAR(11)) SEPARATOR \",\" ) AS categories,";
    $sql .= "  p.sku,";
    $sql .= "  p.upc,";
    if (in_array('ean', $product_fields)) {
      $sql .= "  p.ean,";
    }
    if (in_array('jan', $product_fields)) {
      $sql .= "  p.jan,";
    }
    if (in_array('isbn', $product_fields)) {
      $sql .= "  p.isbn,";
    }
    if (in_array('mpn', $product_fields)) {
      $sql .= "  p.mpn,";
    }
    $sql .= "  p.location,";
    $sql .= "  p.quantity,";
    $sql .= "  p.model,";
    $sql .= "  m.name AS manufacturer,";
    $sql .= "  p.image AS image_name,";
    $sql .= "  p.shipping,";
    $sql .= "  p.price,";
    $sql .= "  p.points,";
    $sql .= "  p.date_added,";
    $sql .= "  p.date_modified,";
    $sql .= "  p.date_available,";
    $sql .= "  p.weight,";
    $sql .= "  wc.unit AS weight_unit,";
    $sql .= "  p.length,";
    $sql .= "  p.width,";
    $sql .= "  p.height,";
    $sql .= "  p.status,";
    $sql .= "  p.tax_class_id,";
    $sql .= "  p.sort_order,";
    if (!$exist_seo_url_table) {
      $sql .= "  ua.keyword,";
    }
    $sql .= "  p.stock_status_id, ";
    $sql .= "  mc.unit AS length_unit, ";
    $sql .= "  p.subtract, ";
    $sql .= "  p.minimum, ";
    $sql .= "  GROUP_CONCAT( DISTINCT CAST(pr.related_id AS CHAR(11)) SEPARATOR \",\" ) AS related ";
    $sql .= "FROM `" . DB_PREFIX . "product` p ";
    $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON p.product_id=pc.product_id ";
    if ($this->posted_categories) {
      $sql .= " LEFT JOIN `" . DB_PREFIX . "product_to_category` pc2 ON p.product_id=pc2.product_id ";
    }
    if (!$exist_seo_url_table) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "seo_url` ua ON ua.query=CONCAT('product_id=',p.product_id) ";
    }
    $sql .= "LEFT JOIN `" . DB_PREFIX . "manufacturer` m ON m.manufacturer_id = p.manufacturer_id ";
    $sql .= "LEFT JOIN `" . DB_PREFIX . "weight_class_description` wc ON wc.weight_class_id = p.weight_class_id ";
    $sql .= "  AND wc.language_id=$default_language_id ";
    $sql .= "LEFT JOIN `" . DB_PREFIX . "length_class_description` mc ON mc.length_class_id=p.length_class_id ";
    $sql .= "  AND mc.language_id=$default_language_id ";
    $sql .= "LEFT JOIN `" . DB_PREFIX . "product_related` pr ON pr.product_id=p.product_id ";
    if (isset($min_id) && isset($max_id)) {
      $sql .= "WHERE p.product_id BETWEEN $min_id AND $max_id ";
      if ($this->posted_categories) {
        $sql .= "AND pc2.category_id IN " . $this->posted_categories . " ";
      }
    } else if ($this->posted_categories) {
      $sql .= "WHERE pc2.category_id IN " . $this->posted_categories . " ";
    }
    $sql .= "GROUP BY p.product_id ";
    $sql .= "ORDER BY p.product_id ";
    if (isset($offset) && isset($rows)) {
      $sql .= "LIMIT $offset,$rows; ";
    } else {
      $sql .= "; ";
    }
    $results = $this->db->query($sql);
    $product_descriptions = $this->getProductDescriptions($languages, $offset, $rows);
    foreach ($languages as $language) {
      $language_code = $language['code'];
      foreach ($results->rows as $key => $row) {
        if (isset($product_descriptions[$language_code][$key])) {
          $results->rows[$key]['name'][$language_code] = $product_descriptions[$language_code][$key]['name'];
          $results->rows[$key]['description'][$language_code] = $product_descriptions[$language_code][$key]['description'];
          if ($exist_meta_title) {
            $results->rows[$key]['meta_title'][$language_code] = $product_descriptions[$language_code][$key]['meta_title'];
          }
          $results->rows[$key]['meta_description'][$language_code] = $product_descriptions[$language_code][$key]['meta_description'];
          $results->rows[$key]['meta_keyword'][$language_code] = $product_descriptions[$language_code][$key]['meta_keyword'];
          $results->rows[$key]['tag'][$language_code] = $product_descriptions[$language_code][$key]['tag'];
        } else {
          $results->rows[$key]['name'][$language_code] = '';
          $results->rows[$key]['description'][$language_code] = '';
          if ($exist_meta_title) {
            $results->rows[$key]['meta_title'][$language_code] = '';
          }
          $results->rows[$key]['meta_description'][$language_code] = '';
          $results->rows[$key]['meta_keyword'][$language_code] = '';
          $results->rows[$key]['tag'][$language_code] = '';
        }
      }
    }
    return $results->rows;
  }

  public function additionalImagesWorksheet(&$worksheet, &$box_format, &$text_format) {
    // check for the existence of product_image.sort_order field
    $sql = "SHOW COLUMNS FROM `" . DB_PREFIX . "product_image` LIKE 'sort_order'";
    $query = $this->db->query($sql);
    $exist_sort_order = ($query->num_rows > 0) ? true : false;

    // Set the column widths
    $j = 0;
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('product_id'), 4) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('image'), 30) + 1);
    if ($exist_sort_order) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('sort_order'), 5) + 1);
    }

    // The additional images headings row and colum styles
    $styles = array();
    $data = array();
    $i = 1;
    $j = 0;
    $data[$j++] = 'product_id';
    $styles[$j] = &$text_format;
    $data[$j++] = 'image';
    if ($exist_sort_order) {
      $data[$j++] = 'sort_order';
    }
    $worksheet->getRowDimension($i)->setRowHeight(30);
    $this->setCellRow($worksheet, $i, $data, $box_format);

    // The actual additional images data
    $styles = array();
    $i += 1;
    $j = 0;
    $additional_images = $this->getAdditionalImages($exist_sort_order);
    foreach ($additional_images as $row) {
      $data = array();
      $worksheet->getRowDimension($i)->setRowHeight(13);
      $data[$j++] = $row['product_id'];
      $data[$j++] = $row['image'];
      if ($exist_sort_order) {
        $data[$j++] = $row['sort_order'];
      }
      $this->setCellRow($worksheet, $i, $data, $this->null_array, $styles);
      $i += 1;
      $j = 0;
    }
  }

  public function getAdditionalImages($exist_sort_order = true) {
    if ($exist_sort_order) {
      $sql = "SELECT DISTINCT pi.product_id, pi.image, pi.sort_order ";
    } else {
      $sql = "SELECT DISTINCT pi.product_id, pi.image ";
    }
    $sql .= "FROM `" . DB_PREFIX . "product_image` pi ";
    if ($this->posted_categories) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=pi.product_id ";
    }
    if (isset($min_id) && isset($max_id)) {
      $sql .= "WHERE pi.product_id BETWEEN $min_id AND $max_id ";
      if ($this->posted_categories) {
        $sql .= "AND pc.category_id IN " . $this->posted_categories . " ";
      }
    } else if ($this->posted_categories) {
      $sql .= "WHERE pc.category_id IN " . $this->posted_categories . " ";
    }
    if ($exist_sort_order) {
      $sql .= "ORDER BY product_id, sort_order, image;";
    } else {
      $sql .= "ORDER BY product_id, image;";
    }
    $result = $this->db->query($sql);
    return $result->rows;
  }

  public function specialsWorksheet(&$worksheet, $language_id, &$price_format, &$box_format, &$text_format) {
    // Set the column widths
    $j = 0;
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('product_id') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('customer_group') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('priority') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('price'), 10) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_start'), 19) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_end'), 19) + 1);

    // The heading row and column styles
    $styles = array();
    $data = array();
    $i = 1;
    $j = 0;
    $data[$j++] = 'product_id';
    $styles[$j] = &$text_format;
    $data[$j++] = 'customer_group';
    $data[$j++] = 'priority';
    $styles[$j] = &$price_format;
    $data[$j++] = 'price';
    $data[$j++] = 'date_start';
    $data[$j++] = 'date_end';
    $worksheet->getRowDimension($i)->setRowHeight(30);
    $this->setCellRow($worksheet, $i, $data, $box_format);

    // The actual product specials data
    $i += 1;
    $j = 0;
    $specials = $this->getSpecials($language_id);
    foreach ($specials as $row) {
      $worksheet->getRowDimension($i)->setRowHeight(13);
      $data = array();
      $data[$j++] = $row['product_id'];
      $data[$j++] = $row['name'];
      $data[$j++] = $row['priority'];
      $data[$j++] = $row['price'];
      $data[$j++] = $row['date_start'];
      $data[$j++] = $row['date_end'];
      $this->setCellRow($worksheet, $i, $data, $this->null_array, $styles);
      $i += 1;
      $j = 0;
    }
  }

  public function discountsWorksheet(&$worksheet, $language_id, &$price_format, &$box_format, &$text_format, $min_id = null, $max_id = null) {
    // Set the column widths
    $j = 0;
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('product_id') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('customer_group') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('quantity') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('priority') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('price'), 10) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_start'), 19) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_end'), 19) + 1);

    // The heading row and column styles
    $styles = array();
    $data = array();
    $i = 1;
    $j = 0;
    $data[$j++] = 'product_id';
    $styles[$j] = &$text_format;
    $data[$j++] = 'customer_group';
    $data[$j++] = 'quantity';
    $data[$j++] = 'priority';
    $styles[$j] = &$price_format;
    $data[$j++] = 'price';
    $data[$j++] = 'date_start';
    $data[$j++] = 'date_end';
    $worksheet->getRowDimension($i)->setRowHeight(30);
    $this->setCellRow($worksheet, $i, $data, $box_format);

    // The actual product discounts data
    $i += 1;
    $j = 0;
    $discounts = $this->getDiscounts($language_id);
    foreach ($discounts as $row) {
      $worksheet->getRowDimension($i)->setRowHeight(13);
      $data = array();
      $data[$j++] = $row['product_id'];
      $data[$j++] = $row['name'];
      $data[$j++] = $row['quantity'];
      $data[$j++] = $row['priority'];
      $data[$j++] = $row['price'];
      $data[$j++] = $row['date_start'];
      $data[$j++] = $row['date_end'];
      $this->setCellRow($worksheet, $i, $data, $this->null_array, $styles);
      $i += 1;
      $j = 0;
    }
  }

  public function getRewards($language_id) {
    // Newer OC versions use the 'customer_group_description' instead of 'customer_group' table for the 'name' field
    $exist_table_customer_group_description = false;
    $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "customer_group_description'");
    $exist_table_customer_group_description = ($query->num_rows > 0);

    // get the product rewards
    $sql = "SELECT DISTINCT pr.*, ";
    $sql .= ($exist_table_customer_group_description) ? "cgd.name " : "cg.name ";
    $sql .= "FROM `" . DB_PREFIX . "product_reward` pr ";
    if ($exist_table_customer_group_description) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "customer_group_description` cgd ON cgd.customer_group_id=pr.customer_group_id ";
      $sql .= "  AND cgd.language_id=$language_id ";
    } else {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "customer_group` cg ON cg.customer_group_id=pr.customer_group_id ";
    }
    if ($this->posted_categories) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=pr.product_id ";
    }
    if (isset($min_id) && isset($max_id)) {
      $sql .= "WHERE pr.product_id BETWEEN $min_id AND $max_id ";
      if ($this->posted_categories) {
        $sql .= "AND pc.category_id IN " . $this->posted_categories . " ";
      }
    } else if ($this->posted_categories) {
      $sql .= "WHERE pc.category_id IN " . $this->posted_categories . " ";
    }
    $sql .= "ORDER BY pr.product_id, name";
    $result = $this->db->query($sql);
    return $result->rows;
  }

  public function rewardsWorksheet(&$worksheet, $language_id, &$box_format, &$text_format) {
    // Set the column widths
    $j = 0;
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('product_id') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('customer_group') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('points') + 1);

    // The heading row and column styles
    $styles = array();
    $data = array();
    $i = 1;
    $j = 0;
    $data[$j++] = 'product_id';
    $styles[$j] = &$text_format;
    $data[$j++] = 'customer_group';
    $data[$j++] = 'points';
    $worksheet->getRowDimension($i)->setRowHeight(30);
    $this->setCellRow($worksheet, $i, $data, $box_format);

    // The actual product rewards data
    $i += 1;
    $j = 0;
    $rewards = $this->getRewards($language_id);
    foreach ($rewards as $row) {
      $worksheet->getRowDimension($i)->setRowHeight(13);
      $data = array();
      $data[$j++] = $row['product_id'];
      $data[$j++] = $row['name'];
      $data[$j++] = $row['points'];
      $this->setCellRow($worksheet, $i, $data, $this->null_array, $styles);
      $i += 1;
      $j = 0;
    }
  }

  public function getDiscounts($language_id) {
    // Newer OC versions use the 'customer_group_description' instead of 'customer_group' table for the 'name' field
    $exist_table_customer_group_description = false;
    $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "customer_group_description'");
    $exist_table_customer_group_description = ($query->num_rows > 0);

    // get the product discounts
    $sql = "SELECT pd.*, ";
    $sql .= ($exist_table_customer_group_description) ? "cgd.name " : "cg.name ";
    $sql .= "FROM `" . DB_PREFIX . "product_discount` pd ";
    if ($exist_table_customer_group_description) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "customer_group_description` cgd ON cgd.customer_group_id=pd.customer_group_id ";
      $sql .= "  AND cgd.language_id=$language_id ";
    } else {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "customer_group` cg ON cg.customer_group_id=pd.customer_group_id ";
    }
    if ($this->posted_categories) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=pd.product_id ";
    }
    if (isset($min_id) && isset($max_id)) {
      $sql .= "WHERE pd.product_id BETWEEN $min_id AND $max_id ";
      if ($this->posted_categories) {
        $sql .= "AND pc.category_id IN " . $this->posted_categories . " ";
      }
    } else if ($this->posted_categories) {
      $sql .= "WHERE pc.category_id IN " . $this->posted_categories . " ";
    }
    $sql .= "ORDER BY pd.product_id ASC, name ASC, pd.quantity ASC";
    $result = $this->db->query($sql);
    return $result->rows;
  }

  public function getSpecials($language_id) {
    // Newer OC versions use the 'customer_group_description' instead of 'customer_group' table for the 'name' field
    $exist_table_customer_group_description = false;
    $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "customer_group_description'");
    $exist_table_customer_group_description = ($query->num_rows > 0);

    // get the product specials
    $sql = "SELECT DISTINCT ps.*, ";
    $sql .= ($exist_table_customer_group_description) ? "cgd.name " : "cg.name ";
    $sql .= "FROM `" . DB_PREFIX . "product_special` ps ";
    if ($exist_table_customer_group_description) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "customer_group_description` cgd ON cgd.customer_group_id=ps.customer_group_id ";
      $sql .= "  AND cgd.language_id=$language_id ";
    } else {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "customer_group` cg ON cg.customer_group_id=ps.customer_group_id ";
    }
    if ($this->posted_categories) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=ps.product_id ";
    }
    if (isset($min_id) && isset($max_id)) {
      $sql .= "WHERE ps.product_id BETWEEN $min_id AND $max_id ";
      if ($this->posted_categories) {
        $sql .= "AND pc.category_id IN " . $this->posted_categories . " ";
      }
    } else if ($this->posted_categories) {
      $sql .= "WHERE pc.category_id IN " . $this->posted_categories . " ";
    }
    $sql .= "ORDER BY ps.product_id, name, ps.priority";
    $result = $this->db->query($sql);
    return $result->rows;
  }

  protected function productFiltersWorksheet(&$worksheet, &$languages, $default_language_id, &$box_format, &$text_format, $min_id = null, $max_id = null) {
    // Set the column widths
    $j = 0;
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('product_id') + 1);
    if ($this->config->get('export_import_settings_use_filter_group_id')) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('filter_group_id') + 1);
    } else {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('filter_group'), 30) + 1);
    }
    if ($this->config->get('export_import_settings_use_filter_id')) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('filter_id') + 1);
    } else {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('filter'), 30) + 1);
    }
    foreach ($languages as $language) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('text') + 4, 30) + 1);
    }

    // The heading row and column styles
    $styles = array();
    $data = array();
    $i = 1;
    $j = 0;
    $data[$j++] = 'product_id';
    if ($this->config->get('export_import_settings_use_filter_group_id')) {
      $data[$j++] = 'filter_group_id';
    } else {
      $styles[$j] = &$text_format;
      $data[$j++] = 'filter_group';
    }
    if ($this->config->get('export_import_settings_use_filter_id')) {
      $data[$j++] = 'filter_id';
    } else {
      $styles[$j] = &$text_format;
      $data[$j++] = 'filter';
    }
    $worksheet->getRowDimension($i)->setRowHeight(30);
    $this->setCellRow($worksheet, $i, $data, $box_format);

    // The actual product filters data
    if (!$this->config->get('export_import_settings_use_filter_group_id')) {
      $filter_group_names = $this->getFilterGroupNames($default_language_id);
    }
    if (!$this->config->get('export_import_settings_use_filter_id')) {
      $filter_names = $this->getFilterNames($default_language_id);
    }
    $i += 1;
    $j = 0;
    $product_filters = $this->getProductFilters($min_id, $max_id);
    foreach ($product_filters as $row) {
      $worksheet->getRowDimension($i)->setRowHeight(13);
      $data = array();
      $data[$j++] = $row['product_id'];
      if ($this->config->get('export_import_settings_use_filter_group_id')) {
        $data[$j++] = $row['filter_group_id'];
      } else {
        $data[$j++] = html_entity_decode($filter_group_names[$row['filter_group_id']], ENT_QUOTES, 'UTF-8');
      }
      if ($this->config->get('export_import_settings_use_filter_id')) {
        $data[$j++] = $row['filter_id'];
      } else {
        $data[$j++] = html_entity_decode($filter_names[$row['filter_id']], ENT_QUOTES, 'UTF-8');
      }
      $this->setCellRow($worksheet, $i, $data, $this->null_array, $styles);
      $i += 1;
      $j = 0;
    }
  }

  protected function getProductFilters($min_id, $max_id) {
    $sql = "SELECT pf.product_id, fg.filter_group_id, pf.filter_id ";
    $sql .= "FROM `" . DB_PREFIX . "product_filter` pf ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "filter` f ON f.filter_id=pf.filter_id ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "filter_group` fg ON fg.filter_group_id=f.filter_group_id ";
    if ($this->posted_categories) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=pf.product_id ";
    }
    if (isset($min_id) && isset($max_id)) {
      $sql .= "WHERE pf.product_id BETWEEN $min_id AND $max_id ";
      if ($this->posted_categories) {
        $sql .= "AND pc.category_id IN " . $this->posted_categories . " ";
      }
    } else if ($this->posted_categories) {
      $sql .= "WHERE pc.category_id IN " . $this->posted_categories . " ";
    }
    $sql .= "ORDER BY pf.product_id ASC, fg.filter_group_id ASC, pf.filter_id ASC";
    $query = $this->db->query($sql);
    $product_filters = array();
    foreach ($query->rows as $row) {
      $product_filter = array();
      $product_filter['product_id'] = $row['product_id'];
      $product_filter['filter_group_id'] = $row['filter_group_id'];
      $product_filter['filter_id'] = $row['filter_id'];
      $product_filters[] = $product_filter;
    }
    return $product_filters;
  }

  public function productOptionsWorksheet(&$worksheet, &$box_format, &$text_format, $min_id = null, $max_id = null) {
    // Set the column widths
    $j = 0;
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('product_id') + 1);
    if ($this->config->get('export_import_settings_use_option_id')) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('option_id') + 1);
    } else {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('option'), 30) + 1);
    }
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('default_option_value') + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('required'), 5) + 1);

    // The heading row and column styles
    $styles = array();
    $data = array();
    $i = 1;
    $j = 0;
    $data[$j++] = 'product_id';
    if ($this->config->get('export_import_settings_use_option_id')) {
      $data[$j++] = 'option_id';
    } else {
      $styles[$j] = &$text_format;
      $data[$j++] = 'option';
    }
    $styles[$j] = &$text_format;
    $data[$j++] = 'default_option_value';
    $data[$j++] = 'required';
    $worksheet->getRowDimension($i)->setRowHeight(30);
    $this->setCellRow($worksheet, $i, $data, $box_format);

    // The actual product options data
    $i += 1;
    $j = 0;
    $product_options = $this->getProductOptions($min_id, $max_id);
    foreach ($product_options as $row) {
      $worksheet->getRowDimension($i)->setRowHeight(13);
      $data = array();
      $data[$j++] = $row['product_id'];
      if ($this->config->get('export_import_settings_use_option_id')) {
        $data[$j++] = $row['option_id'];
      } else {
        $data[$j++] = html_entity_decode($row['option'], ENT_QUOTES, 'UTF-8');
      }
      $data[$j++] = html_entity_decode($row['option_value'], ENT_QUOTES, 'UTF-8');
      $data[$j++] = ($row['required'] == 0) ? 'false' : 'true';
      $this->setCellRow($worksheet, $i, $data, $this->null_array, $styles);
      $i += 1;
      $j = 0;
    }
  }

  public function productAttributesWorksheet(&$worksheet, &$languages, $default_language_id, &$box_format, &$text_format, $min_id = null, $max_id = null) {
    // Set the column widths
    $j = 0;
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('product_id') + 1);
    if ($this->config->get('export_import_settings_use_attribute_group_id')) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('attribute_group_id') + 1);
    } else {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('attribute_group'), 30) + 1);
    }
    if ($this->config->get('export_import_settings_use_attribute_id')) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('attribute_id') + 1);
    } else {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('attribute'), 30) + 1);
    }
    foreach ($languages as $language) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('text') + 4, 30) + 1);
    }

    // The heading row and column styles
    $styles = array();
    $data = array();
    $i = 1;
    $j = 0;
    $data[$j++] = 'product_id';
    if ($this->config->get('export_import_settings_use_attribute_group_id')) {
      $data[$j++] = 'attribute_group_id';
    } else {
      $styles[$j] = &$text_format;
      $data[$j++] = 'attribute_group';
    }
    if ($this->config->get('export_import_settings_use_attribute_id')) {
      $data[$j++] = 'attribute_id';
    } else {
      $styles[$j] = &$text_format;
      $data[$j++] = 'attribute';
    }
    foreach ($languages as $language) {
      $styles[$j] = &$text_format;
      $data[$j++] = 'text(' . $language['code'] . ')';
    }
    $worksheet->getRowDimension($i)->setRowHeight(30);
    $this->setCellRow($worksheet, $i, $data, $box_format);

    // The actual product attributes data
    if (!$this->config->get('export_import_settings_use_attribute_group_id')) {
      $attribute_group_names = $this->getAttributeGroupNames($default_language_id);
    }
    if (!$this->config->get('export_import_settings_use_attribute_id')) {
      $attribute_names = $this->getAttributeNames($default_language_id);
    }
    $i += 1;
    $j = 0;
    $product_attributes = $this->getProductAttributes($languages, $min_id, $max_id);
    foreach ($product_attributes as $row) {
      $worksheet->getRowDimension($i)->setRowHeight(13);
      $data = array();
      $data[$j++] = $row['product_id'];
      if ($this->config->get('export_import_settings_use_attribute_group_id')) {
        $data[$j++] = $row['attribute_group_id'];
      } else {
        $data[$j++] = html_entity_decode($attribute_group_names[$row['attribute_group_id']], ENT_QUOTES, 'UTF-8');
      }
      if ($this->config->get('export_import_settings_use_attribute_id')) {
        $data[$j++] = $row['attribute_id'];
      } else {
        $data[$j++] = html_entity_decode($attribute_names[$row['attribute_id']], ENT_QUOTES, 'UTF-8');
      }
      foreach ($languages as $language) {
        $data[$j++] = html_entity_decode($row['text'][$language['code']], ENT_QUOTES, 'UTF-8');
      }
      $this->setCellRow($worksheet, $i, $data, $this->null_array, $styles);
      $i += 1;
      $j = 0;
    }
  }

  public function getAttributeGroupNames($language_id) {
    $sql = "SELECT attribute_group_id, name ";
    $sql .= "FROM `" . DB_PREFIX . "attribute_group_description` ";
    $sql .= "WHERE language_id='" . (int) $language_id . "' ";
    $sql .= "ORDER BY attribute_group_id ASC";
    $query = $this->db->query($sql);
    $attribute_group_names = array();
    foreach ($query->rows as $row) {
      $attribute_group_id = $row['attribute_group_id'];
      $name = $row['name'];
      $attribute_group_names[$attribute_group_id] = $name;
    }
    return $attribute_group_names;
  }

  public function existFilter() {
    // only newer OpenCart versions support filters
    $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "filter'");
    $exist_table_filter = ($query->num_rows > 0);
    $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "filter_group'");
    $exist_table_filter_group = ($query->num_rows > 0);
    $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "product_filter'");
    $exist_table_product_filter = ($query->num_rows > 0);
    $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "category_filter'");
    $exist_table_category_filter = ($query->num_rows > 0);

    if (!$exist_table_filter) {
      return false;
    }
    if (!$exist_table_filter_group) {
      return false;
    }
    if (!$exist_table_product_filter) {
      return false;
    }
    if (!$exist_table_category_filter) {
      return false;
    }
    return true;
  }

  protected function getProductAttributes(&$languages, $min_id, $max_id) {
    $sql = "SELECT pa.product_id, ag.attribute_group_id, pa.attribute_id, pa.language_id, pa.text ";
    $sql .= "FROM `" . DB_PREFIX . "product_attribute` pa ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "attribute` a ON a.attribute_id=pa.attribute_id ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "attribute_group` ag ON ag.attribute_group_id=a.attribute_group_id ";
    if ($this->posted_categories) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=pa.product_id ";
    }
    if (isset($min_id) && isset($max_id)) {
      $sql .= "WHERE pa.product_id BETWEEN $min_id AND $max_id ";
      if ($this->posted_categories) {
        $sql .= "AND pc.category_id IN " . $this->posted_categories . " ";
      }
    } else if ($this->posted_categories) {
      $sql .= "WHERE pc.category_id IN " . $this->posted_categories . " ";
    }
    $sql .= "ORDER BY pa.product_id ASC, ag.attribute_group_id ASC, pa.attribute_id ASC";
    $query = $this->db->query($sql);
    $texts = array();
    foreach ($query->rows as $row) {
      $product_id = $row['product_id'];
      $attribute_group_id = $row['attribute_group_id'];
      $attribute_id = $row['attribute_id'];
      $language_id = $row['language_id'];
      $text = $row['text'];
      $texts[$product_id][$attribute_group_id][$attribute_id][$language_id] = $text;
    }
    $product_attributes = array();
    foreach ($texts as $product_id => $level1) {
      foreach ($level1 as $attribute_group_id => $level2) {
        foreach ($level2 as $attribute_id => $text) {
          $product_attribute = array();
          $product_attribute['product_id'] = $product_id;
          $product_attribute['attribute_group_id'] = $attribute_group_id;
          $product_attribute['attribute_id'] = $attribute_id;
          $product_attribute['text'] = array();
          foreach ($languages as $language) {
            $language_id = $language['language_id'];
            $code = $language['code'];
            if (isset($text[$language_id])) {
              $product_attribute['text'][$code] = $text[$language_id];
            } else {
              $product_attribute['text'][$code] = '';
            }
          }
          $product_attributes[] = $product_attribute;
        }
      }
    }
    return $product_attributes;
  }

  protected function getAttributeNames($language_id) {
    $sql = "SELECT attribute_id, name ";
    $sql .= "FROM `" . DB_PREFIX . "attribute_description` ";
    $sql .= "WHERE language_id='" . (int) $language_id . "' ";
    $sql .= "ORDER BY attribute_id ASC";
    $query = $this->db->query($sql);
    $attribute_names = array();
    foreach ($query->rows as $row) {
      $attribute_id = $row['attribute_id'];
      $attribute_name = $row['name'];
      $attribute_names[$attribute_id] = $attribute_name;
    }
    return $attribute_names;
  }

  public function getProductOptions() {
    // get default language id
    $language_id = $this->getDefaultLanguageId();

    // Opencart versions from 2.0 onwards use product_option.value instead of the older product_option.option_value
    $sql = "SHOW COLUMNS FROM `" . DB_PREFIX . "product_option` LIKE 'value'";
    $query = $this->db->query($sql);
    $exist_po_value = ($query->num_rows > 0) ? true : false;

    // DB query for getting the product options
    if ($exist_po_value) {
      $sql = "SELECT p.product_id, po.option_id, po.value AS option_value, po.required, od.name AS `option` FROM ";
    } else {
      $sql = "SELECT p.product_id, po.option_id, po.option_value, po.required, od.name AS `option` FROM ";
    }
    $sql .= "( SELECT p1.product_id ";
    $sql .= "  FROM `" . DB_PREFIX . "product` p1 ";
    if ($this->posted_categories) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=p1.product_id ";
    }
    if (isset($min_id) && isset($max_id)) {
      $sql .= "  WHERE p1.product_id BETWEEN $min_id AND $max_id ";
      if ($this->posted_categories) {
        $sql .= "AND pc.category_id IN " . $this->posted_categories . " ";
      }
    } else if ($this->posted_categories) {
      $sql .= "WHERE pc.category_id IN " . $this->posted_categories . " ";
    }
    $sql .= "  ORDER BY p1.product_id ASC ";
    $sql .= ") AS p ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "product_option` po ON po.product_id=p.product_id ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "option_description` od ON od.option_id=po.option_id AND od.language_id='" . (int) $language_id . "' ";
    $sql .= "ORDER BY p.product_id ASC, po.option_id ASC";
    $query = $this->db->query($sql);
    return $query->rows;
  }

  public function getProductOptionValues($min_id, $max_id) {
    $language_id = $this->getDefaultLanguageId();
    $sql = "SELECT ";
    $sql .= "  p.product_id, pov.option_id, pov.option_value_id, pov.quantity, pov.subtract, od.name AS `option`, ovd.name AS option_value, ";
    $sql .= "  pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix ";
    $sql .= "FROM ";
    $sql .= "( SELECT p1.product_id ";
    $sql .= "  FROM `" . DB_PREFIX . "product` p1 ";
    if ($this->posted_categories) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=p1.product_id ";
    }
    if (isset($min_id) && isset($max_id)) {
      $sql .= "  WHERE p1.product_id BETWEEN $min_id AND $max_id ";
      if ($this->posted_categories) {
        $sql .= "AND pc.category_id IN " . $this->posted_categories . " ";
      }
    } else if ($this->posted_categories) {
      $sql .= "WHERE pc.category_id IN " . $this->posted_categories . " ";
    }
    $sql .= "  ORDER BY product_id ASC ";
    $sql .= ") AS p ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "product_option_value` pov ON pov.product_id=p.product_id ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "option_value_description` ovd ON ovd.option_value_id=pov.option_value_id AND ovd.language_id='" . (int) $language_id . "' ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "option_description` od ON od.option_id=ovd.option_id AND od.language_id='" . (int) $language_id . "' ";
    $sql .= "ORDER BY p.product_id ASC, pov.option_id ASC, pov.option_value_id";
    $query = $this->db->query($sql);
    return $query->rows;
  }

  public function productOptionValuesWorksheet(&$worksheet, &$price_format, &$box_format, &$weight_format, &$text_format, $min_id = null, $max_id = null) {
    // Set the column widths
    $j = 0;
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('product_id') + 1);
    if ($this->config->get('export_import_settings_use_option_id')) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('option_id') + 1);
    } else {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('option'), 30) + 1);
    }
    if ($this->config->get('export_import_settings_use_option_value_id')) {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(strlen('option_value_id') + 1);
    } else {
      $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('option_value'), 30) + 1);
    }
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('quantity'), 4) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('subtract'), 5) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('price'), 10) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('price_prefix'), 5) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('points'), 10) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('points_prefix'), 5) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('weight'), 10) + 1);
    $worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('weight_prefix'), 5) + 1);

    // The heading row and column styles
    $styles = array();
    $data = array();
    $i = 1;
    $j = 0;
    $data[$j++] = 'product_id';
    if ($this->config->get('export_import_settings_use_option_id')) {
      $data[$j++] = 'option_id';
    } else {
      $styles[$j] = &$text_format;
      $data[$j++] = 'option';
    }
    if ($this->config->get('export_import_settings_use_option_value_id')) {
      $data[$j++] = 'option_value_id';
    } else {
      $styles[$j] = &$text_format;
      $data[$j++] = 'option_value';
    }
    $data[$j++] = 'quantity';
    $data[$j++] = 'subtract';
    $styles[$j] = &$price_format;
    $data[$j++] = 'price';
    $data[$j++] = "price_prefix";
    $data[$j++] = 'points';
    $data[$j++] = "points_prefix";
    $styles[$j] = &$weight_format;
    $data[$j++] = 'weight';
    $data[$j++] = 'weight_prefix';
    $worksheet->getRowDimension($i)->setRowHeight(30);
    $this->setCellRow($worksheet, $i, $data, $box_format);

    // The actual product option values data
    $i += 1;
    $j = 0;
    $product_option_values = $this->getProductOptionValues($min_id, $max_id);
    foreach ($product_option_values as $row) {
      $worksheet->getRowDimension($i)->setRowHeight(13);
      $data = array();
      $data[$j++] = $row['product_id'];
      if ($this->config->get('export_import_settings_use_option_id')) {
        $data[$j++] = $row['option_id'];
      } else {
        $data[$j++] = html_entity_decode($row['option'], ENT_QUOTES, 'UTF-8');
      }
      if ($this->config->get('export_import_settings_use_option_value_id')) {
        $data[$j++] = $row['option_value_id'];
      } else {
        $data[$j++] = html_entity_decode($row['option_value'], ENT_QUOTES, 'UTF-8');
      }
      $data[$j++] = $row['quantity'];
      $data[$j++] = ($row['subtract'] == 0) ? 'false' : 'true';
      $data[$j++] = $row['price'];
      $data[$j++] = $row['price_prefix'];
      $data[$j++] = $row['points'];
      $data[$j++] = $row['points_prefix'];
      $data[$j++] = $row['weight'];
      $data[$j++] = $row['weight_prefix'];
      $this->setCellRow($worksheet, $i, $data, $this->null_array, $styles);
      $i += 1;
      $j = 0;
    }
  }

  public function getProductSEOKeywords(&$languages, $min_id, $max_id) {
    $sql = "SELECT s.* FROM `" . DB_PREFIX . "seo_url` s ";
    if ($this->posted_categories) {
      $sql .= "LEFT JOIN `" . DB_PREFIX . "product_to_category` pc ON pc.product_id=CAST(SUBSTRING(s.query FROM 12) AS UNSIGNED INTEGER) ";
    }
    $sql .= "WHERE s.query LIKE 'product_id=%' AND ";
    if ($this->posted_categories) {
      $sql .= "pc.category_id IN " . $this->posted_categories . " AND ";
    }
    $sql .= "CAST(SUBSTRING(s.query FROM 12) AS UNSIGNED INTEGER) >= '" . (int) $min_id . "' AND ";
    $sql .= "CAST(SUBSTRING(s.query FROM 12) AS UNSIGNED INTEGER) <= '" . (int) $max_id . "' ";
    $sql .= "ORDER BY CAST(SUBSTRING(s.query FROM 12) AS UNSIGNED INTEGER), s.store_id, s.language_id";
    $query = $this->db->query($sql);
    $seo_keywords = array();
    foreach ($query->rows as $row) {
      $product_id = (int) substr($row['query'], 11);
      $store_id = (int) $row['store_id'];
      $language_id = (int) $row['language_id'];
      if (!isset($seo_keywords[$product_id])) {
        $seo_keywords[$product_id] = array();
      }
      if (!isset($seo_keywords[$product_id][$store_id])) {
        $seo_keywords[$product_id][$store_id] = array();
      }
      $seo_keywords[$product_id][$store_id][$language_id] = $row['keyword'];
    }
    $results = array();
    foreach ($seo_keywords as $product_id => $val1) {
      foreach ($val1 as $store_id => $val2) {
        $keyword = array();
        foreach ($languages as $language) {
          $language_id = $language['language_id'];
          $language_code = $language['code'];
          $keyword[$language_code] = isset($val2[$language_id]) ? $val2[$language_id] : '';
        }
        $results[] = array(
            'product_id' => $product_id,
            'store_id' => $store_id,
            'keyword' => $keyword
        );
      }
    }
    return $results;
  }

  protected function getFilterGroupNames($language_id) {
    $sql = "SELECT filter_group_id, name ";
    $sql .= "FROM `" . DB_PREFIX . "filter_group_description` ";
    $sql .= "WHERE language_id='" . (int) $language_id . "' ";
    $sql .= "ORDER BY filter_group_id ASC";
    $query = $this->db->query($sql);
    $filter_group_names = array();
    foreach ($query->rows as $row) {
      $filter_group_id = $row['filter_group_id'];
      $name = $row['name'];
      $filter_group_names[$filter_group_id] = $name;
    }
    return $filter_group_names;
  }

  protected function getFilterNames($language_id) {
    $sql = "SELECT filter_id, name ";
    $sql .= "FROM `" . DB_PREFIX . "filter_description` ";
    $sql .= "WHERE language_id='" . (int) $language_id . "' ";
    $sql .= "ORDER BY filter_id ASC";
    $query = $this->db->query($sql);
    $filter_names = array();
    foreach ($query->rows as $row) {
      $filter_id = $row['filter_id'];
      $filter_name = $row['name'];
      $filter_names[$filter_id] = $filter_name;
    }
    return $filter_names;
  }

  protected function getCategoryFilters($min_id, $max_id) {
    $sql = "SELECT cf.category_id, fg.filter_group_id, cf.filter_id ";
    $sql .= "FROM `" . DB_PREFIX . "category_filter` cf ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "filter` f ON f.filter_id=cf.filter_id ";
    $sql .= "INNER JOIN `" . DB_PREFIX . "filter_group` fg ON fg.filter_group_id=f.filter_group_id ";
    if (isset($min_id) && isset($max_id)) {
      $sql .= "WHERE category_id BETWEEN $min_id AND $max_id ";
    }
    $sql .= "ORDER BY cf.category_id ASC, fg.filter_group_id ASC, cf.filter_id ASC";
    $query = $this->db->query($sql);
    $category_filters = array();
    foreach ($query->rows as $row) {
      $category_filter = array();
      $category_filter['category_id'] = $row['category_id'];
      $category_filter['filter_group_id'] = $row['filter_group_id'];
      $category_filter['filter_id'] = $row['filter_id'];
      $category_filters[] = $category_filter;
    }
    return $category_filters;
  }

}
