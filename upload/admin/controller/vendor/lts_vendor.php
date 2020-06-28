<?php
class ControllerVendorLtsVendor extends Controller {
	public function index() {
		$this->load->language('vendor/lts_vendor');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_vendor');

		$this->getList();
	}

	public function getList() { 
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = '';
		}	

		if (isset($this->request->get['filter_telephone'])) {
			$filter_telephone = $this->request->get['filter_telephone'];
		} else {
			$filter_telephone = '';
		}
 
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = ''; 
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'c.name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		); 

		$vendor_total = $this->model_vendor_lts_vendor->getTotalVendors($filter_data);

		$results = $this->model_vendor_lts_vendor->getVendors($filter_data);

		foreach($results as $result) {
			$store_info = $this->model_vendor_lts_vendor->getStoreName($result['vendor_id']);

			if(!empty($store_info)) {
				$store_name = $store_info['store_name'];
			} else {
				$store_name = 'Not define';
			}

			$data['vendors'][] = array(
				'vendor_id'  => $result['vendor_id'],
				'name'  	 => $result['name'] ,
				'storename'  => $store_name,
				'email'		 => $result['email'],
				'telephone'  => $result['telephone'],
				'status'	 => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'view'		 => $this->url->link('vendor/lts_vendor/view', 'user_token=' . $this->session->data['user_token'] . '&vendor_id=' . $result['vendor_id'], true)
			);
		} 
		$data['vendor_request'] = $this->model_vendor_lts_vendor->vendorRequest();

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		$data['sort_name'] = $this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'] . '&sort=name' . $url, true);
		$data['sort_store'] = $this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'] . '&sort=lv.store' . $url, true);
		$data['sort_email'] = $this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'] . '&sort=c.email' . $url, true);
		$data['sort_telephone'] = $this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'] . '&sort=c.telephone' . $url, true);
		$data['sort_status'] = $this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'] . '&sort=lv.status' . $url, true);
		$data['request'] = $this->url->link('vendor/lts_vendor/request', 'user_token=' . $this->session->data['user_token'], true);

		$pagination = new Pagination();
		$pagination->total = $vendor_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($vendor_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($vendor_total - $this->config->get('config_limit_admin'))) ? $vendor_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $vendor_total, ceil($vendor_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['delete'] = $this->url->link('vendor/lts_vendor/delete', 'user_token=' . $this->session->data['user_token'], true);

		$data['header'] 	 = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']		 = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vendor/lts_vendor_list', $data));
	}

	public function request() {
		$this->load->language('vendor/lts_vendor');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_vendor');

		$vendor_info = $this->model_vendor_lts_vendor->vendorRequestLists();

		$data['cancel'] = $this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'] , true);

		foreach($vendor_info as $result) {
			$data['vendors'][] = array(
				'vendor_id'  => $result['vendor_id'],
				'name'  	 => $result['firstname'] .' ' . $result['lastname'] ,
				'email'		 => $result['email'],
				'telephone'  => $result['telephone'],
				'approve'	 => $this->url->link('vendor/lts_vendor/approve', 'user_token=' . $this->session->data['user_token'] . '&vendor_id=' . $result['vendor_id'], true)
			);
		} 

		$data['header'] 	 = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']		 = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vendor/lts_request', $data));
	}

	public function view() {
		$this->load->language('vendor/lts_vendor');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_vendor');

		if (isset($this->request->get['vendor_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
	      $store_info = $this->model_vendor_lts_vendor->getStoreInformation($this->request->get['vendor_id']);
	    }
	    $data['user_token'] = $this->session->data['user_token'];

	    if (isset($this->request->post['description'])) {
	      $data['description'] = $this->request->post['description'];
	    } elseif (!empty($store_info)) {
	      $data['description'] = $store_info['description'];
	    } else {
	      $data['description'] = '';
	    }


	    if (isset($this->request->post['meta_title'])) {
	      $data['meta_title'] = $this->request->post['meta_title'];
	    } elseif (!empty($store_info)) {
	      $data['meta_title'] = $store_info['meta_title'];
	    } else {
	      $data['meta_title'] = '';
	    }

	    if (isset($this->request->post['meta_description'])) {
	      $data['meta_description'] = $this->request->post['meta_description'];
	    } elseif (!empty($store_info)) {
	      $data['meta_description'] = $store_info['meta_description'];
	    } else {
	      $data['meta_description'] = '';
	    }

	    if (isset($this->request->post['meta_title'])) {
	      $data['meta_title'] = $this->request->post['meta_title'];
	    } elseif (!empty($store_info)) {
	      $data['meta_title'] = $store_info['meta_title'];
	    } else {
	      $data['meta_title'] = '';
	    }

	    if (isset($this->request->post['meta_keyword'])) {
	      $data['meta_keyword'] = $this->request->post['meta_keyword'];
	    } elseif (!empty($store_info)) {
	      $data['meta_keyword'] = $store_info['meta_keyword'];
	    } else {
	      $data['meta_keyword'] = '';
	    }

	    if (isset($this->request->post['owner_name'])) {
	      $data['owner_name'] = $this->request->post['owner_name'];
	    } elseif (!empty($store_info)) {
	      $data['owner_name'] = $store_info['owner_name'];
	    } else {
	      $data['owner_name'] = '';
	    }

	    if (isset($this->request->post['store_name'])) {
	      $data['store_name'] = $this->request->post['store_name'];
	    } elseif (!empty($store_info)) {
	      $data['store_name'] = $store_info['store_name'];
	    } else {
	      $data['store_name'] = '';
	    }

	    if (isset($this->request->post['address'])) {
	      $data['address'] = $this->request->post['address'];
	    } elseif (!empty($store_info)) {
	      $data['address'] = $store_info['address'];
	    } else {
	      $data['address'] = '';
	    }

	    if (isset($this->request->post['email'])) {
	      $data['email'] = $this->request->post['email'];
	    } elseif (!empty($store_info)) {
	      $data['email'] = $store_info['email'];
	    } else {
	      $data['email'] = '';
	    }

	    if (isset($this->request->post['telephone'])) {
	      $data['telephone'] = $this->request->post['telephone'];
	    } elseif (!empty($store_info)) {
	      $data['telephone'] = $store_info['telephone'];
	    } else {
	      $data['telephone'] = '';
	    }

	    if (isset($this->request->post['fax'])) {
	      $data['fax'] = $this->request->post['fax'];
	    } elseif (!empty($store_info)) {
	      $data['fax'] = $store_info['fax'];
	    } else {
	      $data['fax'] = '';
	    }


	    if (isset($this->request->post['country_id'])) {
	      $data['country_id'] = $this->request->post['country_id'];
	    } elseif (!empty($store_info)) {
	      $data['country_id'] = $store_info['country_id'];
	    } else {
	      $data['country_id'] = '';
	    }

	    $this->load->model('localisation/country');

	    $data['countries'] = $this->model_localisation_country->getCountries();

	    if (isset($this->request->post['zone_id'])) {
	      $data['zone_id'] = $this->request->post['zone_id'];
	    } elseif (!empty($store_info)) {
	      $data['zone_id'] = $store_info['zone_id'];
	    } else {
	      $data['zone_id'] = '';
	    }

	    if (isset($this->request->post['city'])) {
	      $data['city'] = $this->request->post['city'];
	    } elseif (!empty($store_info)) {
	      $data['city'] = $store_info['city'];
	    } else {
	      $data['city'] = '';
	    }

	    if (isset($this->request->post['logo'])) {
	      $data['logo'] = $this->request->post['logo'];
	    } elseif (!empty($store_info)) {
	      $data['logo'] = $store_info['logo'];
	    } else {
	      $data['logo'] = '';
	    }  

	    $this->load->model('tool/image');

	    if (isset($this->request->post['logo']) && is_file(DIR_IMAGE . $this->request->post['logo'])) {
	      $data['logo_thumb'] = $this->model_tool_image->resize($this->request->post['logo'], 100, 100);
	    } elseif (!empty($store_info) && is_file(DIR_IMAGE . $store_info['logo'])) {
	      $data['logo_thumb'] = $this->model_tool_image->resize($store_info['logo'], 100, 100);
	    } else {
	      $data['logo_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
	    }

	    if (isset($this->request->post['banner'])) {
	      $data['banner'] = $this->request->post['banner'];
	    } elseif (!empty($store_info)) {
	      $data['banner'] = $store_info['banner'];
	    } else {
	      $data['banner'] = '';
	    }

	    $data['cancel'] = $this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'] , true);
	   
	    if (isset($this->request->post['banner']) && is_file(DIR_IMAGE . $this->request->post['banner'])) {
	      $data['banner_thumb'] = $this->model_tool_image->resize($this->request->post['banner'], 100, 100);
	    } elseif (!empty($store_info) && is_file(DIR_IMAGE . $store_info['banner'])) {
	      $data['banner_thumb'] = $this->model_tool_image->resize($store_info['banner'], 100, 100);
	    } else {
	      $data['banner_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
	    }

	     $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


	    if (isset($this->request->post['facebook'])) {
	      $data['facebook'] = $this->request->post['facebook'];
	    } elseif (!empty($store_info)) {
	      $data['facebook'] = $store_info['facebook'];
	    } else {
	      $data['facebook'] = '';
	    }

	    if (isset($this->request->post['instagram'])) {
	      $data['instagram'] = $this->request->post['instagram'];
	    } elseif (!empty($store_info)) {
	      $data['instagram'] = $store_info['instagram'];
	    } else {
	      $data['instagram'] = '';
	    }

	    if (isset($this->request->post['youtube'])) {
	      $data['youtube'] = $this->request->post['youtube'];
	    } elseif (!empty($store_info)) {
	      $data['youtube'] = $store_info['youtube'];
	    } else {
	      $data['youtube'] = '';
	    }

	    if (isset($this->request->post['twitter'])) {
	      $data['twitter'] = $this->request->post['twitter'];
	    } elseif (!empty($store_info)) {
	      $data['twitter'] = $store_info['twitter'];
	    } else {
	      $data['twitter'] = '';
	    }

	    if (isset($this->request->post['pinterest'])) {
	      $data['pinterest'] = $this->request->post['pinterest'];
	    } elseif (!empty($store_info)) {
	      $data['pinterest'] = $store_info['pinterest'];
	    } else {
	      $data['pinterest'] = '';
	    }

	    // product

	    $this->load->model('catalog/product');

	    if (isset($this->request->get['sort'])) {
	      $sort = $this->request->get['sort'];
	    } else {
	      $sort = 'pd.name';
	    }

	    if (isset($this->request->get['order'])) {
	      $order = $this->request->get['order'];
	    } else {
	      $order = 'ASC';
	    }

	    if (isset($this->request->get['page'])) {
	      $page = $this->request->get['page'];
	    } else {
	      $page = 1;
	    }

	    $filter_data = array(
	        'sort' => $sort,
	        'order' => $order,
	        'start' => ($page - 1) * $this->config->get('config_limit_admin'),
	        'limit' => $this->config->get('config_limit_admin')
	    );

	    $product_total = $this->model_vendor_lts_vendor->getTotalProducts($this->request->get['vendor_id']);

	    $results = $this->model_vendor_lts_vendor->getProducts($this->request->get['vendor_id'], $filter_data);

	    foreach ($results as $result) {
	      if (is_file(DIR_IMAGE . $result['image'])) {
	        $image = $this->model_tool_image->resize($result['image'], 40, 40);
	      } else {
	        $image = $this->model_tool_image->resize('no_image.png', 40, 40);
	      }

	      $special = false;

	      $product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);
	      // $product_status = $this->model_catalog_product->getVendorProductById($result['product_id']);

	      foreach ($product_specials as $product_special) {
	        if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
	          $special = $this->currency->format($product_special['price'], $this->config->get('config_currency'));

	          break;
	        }
	      }

	      $data['products'][] = array(
	          'product_id'  => $result['product_id'],
	          'image' 		=> $image,
	          'name' 		=> $result['name'],
	          'model' 		=> $result['model'],
	          'price' 		=> $this->currency->format($result['price'], $this->config->get('config_currency')),
	          'special' 	=> $special,
	          'quantity'	=> $result['quantity'],
	          'status' 		=> $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
	          'edit' 		=> 	$this->url->link('catalog/product/edit', 'user_token=' . $this->session->data['user_token'] . '&product_id=' . $result['product_id'], true)
	      );
	    }


	     $url = '';

	    if (isset($this->request->get['filter_name'])) {
	      $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
	    }

	    if (isset($this->request->get['filter_model'])) {
	      $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
	    }

	    if (isset($this->request->get['filter_price'])) {
	      $url .= '&filter_price=' . $this->request->get['filter_price'];
	    }

	    if (isset($this->request->get['filter_quantity'])) {
	      $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
	    }

	    if (isset($this->request->get['filter_status'])) {
	      $url .= '&filter_status=' . $this->request->get['filter_status'];
	    }

	    if ($order == 'ASC') {
	      $url .= '&order=DESC';
	    } else {
	      $url .= '&order=ASC';
	    }

	    if (isset($this->request->get['page'])) {
	      $url .= '&page=' . $this->request->get['page'];
	    }

	    $data['sort_name'] = $this->url->link('vendor/lts_product');
	    $data['sort_model'] = $this->url->link('vendor/lts_product');
	    $data['sort_price'] = $this->url->link('vendor/lts_product');
	    $data['sort_quantity'] = $this->url->link('vendor/lts_product');
	    $data['sort_status'] = $this->url->link('vendor/lts_product');
	    $data['sort_order'] = $this->url->link('vendor/lts_product');

	    $url = '';

	    if (isset($this->request->get['filter_name'])) {
	      $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
	    }

	    if (isset($this->request->get['filter_model'])) {
	      $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
	    }

	    if (isset($this->request->get['filter_price'])) {
	      $url .= '&filter_price=' . $this->request->get['filter_price'];
	    }

	    if (isset($this->request->get['filter_quantity'])) {
	      $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
	    }

	    if (isset($this->request->get['filter_status'])) {
	      $url .= '&filter_status=' . $this->request->get['filter_status'];
	    }

	    if (isset($this->request->get['sort'])) {
	      $url .= '&sort=' . $this->request->get['sort'];
	    }

	    if (isset($this->request->get['order'])) {
	      $url .= '&order=' . $this->request->get['order'];
	    }

	    $pagination = new Pagination();
	    $pagination->total = $product_total;
	    $pagination->page = $page;
	    $pagination->limit = $this->config->get('config_limit_admin');
	    $pagination->url = $this->url->link('vendor/lts_product', '&page={page}');

	    $data['pagination'] = $pagination->render();

	    $data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin')));

	    // $data['filter_name'] = $filter_name;
	    // $data['filter_model'] = $filter_model;
	    // $data['filter_price'] = $filter_price;
	    // $data['filter_quantity'] = $filter_quantity;
	    // $data['filter_status'] = $filter_status;

	    $data['sort'] = $sort;
	    $data['order'] = $order;

    
	    //order
	    $data['orders'] = array();

	    $filter_data = array(
	        'sort' => $sort,
	        'order' => $order,
	        'start' => ($page - 1) * $this->config->get('config_limit_admin'),
	        'limit' => $this->config->get('config_limit_admin')
	    );

	    $order_total = $this->model_vendor_lts_vendor->getTotalOrders($filter_data);

	    $results = $this->model_vendor_lts_vendor->getOrders($this->request->get['vendor_id'], $filter_data);

	    foreach ($results as $result) {
	      $data['orders'][] = array(
	          'order_id' => $result['order_id'],
	          'customer' => $result['customer'],
	          'order_status' => $result['order_status'] ? $result['order_status'] : $this->language->get('text_missing'),
	          'total' => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
	          'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
	          'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
	          'shipping_code' => $result['shipping_code'],
	          'view'          => $this->url->link('sale/order/info', 'user_token=' . $this->session->data['user_token'] . '&order_id=' . $result['order_id'] . $url, true),
	          'edit' => $this->url->link('vendor/lts_order/edit', '&order_id=' . $result['order_id'] . $url, true)
	      );
	    }
        
		$data['header'] 	 = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']		 = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vendor/lts_vendor_view', $data));
	}

	 public function delete() {
        $this->load->language('vendor/lts_vendor');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('vendor/lts_vendor');
        

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $vendor_id) {
                
                // $this->model_vendor_lts_vendor->deleteVendor($vendor_id);
            }


            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'], true));
        }

        $this->getList();
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'vendor/lts_vendor')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }




	public function approve() {
		$this->load->model('vendor/lts_vendor');

		$this->model_vendor_lts_vendor->vendorApproveStatus($this->request->get['vendor_id']);

		$this->session->data['success'] = $this->language->get('text_success');

		$this->response->redirect($this->url->link('vendor/lts_vendor', 'user_token=' . $this->session->data['user_token'] , true));
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('vendor/lts_vendor');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_vendor_lts_vendor->getVendors($filter_data);
		
			foreach ($results as $result) {
				$json[] = array(
					'vendor_id' => $result['vendor_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
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