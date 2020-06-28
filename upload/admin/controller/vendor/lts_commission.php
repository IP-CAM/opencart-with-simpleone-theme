<?php
class ControllerVendorLtsCommission extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('vendor/lts_commission');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_commission');

		$this->getList(); 
	}

	public function add() {
		$this->load->language('vendor/lts_commission');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_commission');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_vendor_lts_commission->addCommission($this->request->post); 

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('vendor/lts_commission', 'user_token=' . $this->session->data['user_token'], true));
		}
 
		$this->getForm();
	}

	public function delete() {
		
		$this->load->language('vendor/lts_commission');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_commission');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $commission_id) {
				$this->model_vendor_lts_commission->deleteCommission($commission_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('vendor/lts_commission', 'user_token=' . $this->session->data['user_token'], true));
		} 

		$this->getList();
	}

	public function edit() {

		$this->load->language('vendor/lts_commission');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_commission');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vendor_lts_commission->editCommission($this->request->get['commission_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('vendor/lts_commission', 'user_token=' . $this->session->data['user_token'], true));
		}

		$this->getForm();
	}

	protected function getList() {
		// if (isset($this->request->get['filter_name'])) {
		// 	$filter_name = $this->request->get['filter_name'];
		// } else {
		// 	$filter_name = '';
		// }

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'cd.name';
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

		// if (isset($this->request->get['filter_name'])) {
		// 	$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		// }

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
			'href' => $this->url->link('vendor/lts_commission', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('vendor/lts_commission/add', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['delete'] = $this->url->link('vendor/lts_commission/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$filter_data = array(
			// 'filter_name'	  => $filter_name,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$commission_total = $this->model_vendor_lts_commission->getTotalCommissions($filter_data);

		$results = $this->model_vendor_lts_commission->getCommissions($filter_data);



		foreach ($results as $result) {
			$data['commissions'][] = array(
				'commission_id' => $result['commission_id'],
				'name'			=> $result['name'],
				'commission_type' => ($result['commission_type'] == 'p')  ? $this->language->get('text_percentage') : $this->language->get('text_fixed'),
				'commission'	=> $result['commission'],
				'edit'       => $this->url->link('vendor/lts_commission/edit', 'user_token=' . $this->session->data['user_token'] . '&commission_id=' . $result['commission_id'], true)
			);
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$url = '';

		// if (isset($this->request->get['name'])) {
		// 	$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		// }

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
			
		$data['sort_name'] = $this->url->link('vendor/lts_commission', 'user_token=' . $this->session->data['user_token'] . '&sort=cd.name' . $url, true);

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $commission_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('vendor/lts_commission', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($commission_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($commission_total - $this->config->get('config_limit_admin'))) ? $commission_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $commission_total, ceil($commission_total / $this->config->get('config_limit_admin')));

		$data['header'] 	 = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] 	 = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vendor/lts_commission_list', $data));
	}

	
	public function getForm() {
		$data['text_form'] = !isset($this->request->get['commission_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['category'])) {
			$data['error_category'] = $this->error['category'];
		} else {
			$data['error_category'] = ''; 
		}

		if (isset($this->error['commission'])) {
			$data['error_commission'] = $this->error['commission'];
		} else {
			$data['error_commission'] = ''; 
		}

		$this->load->model('catalog/category');

		$data['categories'] = $this->model_catalog_category->getCategories();



		if (isset($this->request->get['commission_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$commission_info = $this->model_vendor_lts_commission->getCommission($this->request->get['commission_id']);
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} elseif (!empty($commission_info)) {
			$data['category_id'] = $commission_info['category_id'];
		} else {
			$data['category_id'] = '';
		}

		if (isset($this->request->post['commission_type'])) {
			$data['commission_type'] = $this->request->post['commission_type'];
		} elseif (!empty($commission_info)) {
			$data['commission_type'] = $commission_info['commission_type'];
		} else {
			$data['commission_type'] = '';
		}

		if (isset($this->request->post['commission'])) {
			$data['commission'] = $this->request->post['commission'];
		} elseif(!empty($commission_info)) {
			$data['commission'] = $commission_info['commission'];
		} else {
			$data['commission'] = '';
		}


		$data['cancel'] = $this->url->link('vendor/lts_commission', 'user_token=' . $this->session->data['user_token'], true);

		if (!isset($this->request->get['commission_id'])) {
			$data['action'] = $this->url->link('vendor/lts_commission/add', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('vendor/lts_commission/edit', 'user_token=' . $this->session->data['user_token'] . '&commission_id=' . $this->request->get['commission_id'], true);
		}

		$data['header']		= $this->load->controller('common/header');
		$data['footer']		= $this->load->controller('common/footer');
		$data['column_left']= $this->load->controller('common/column_left');

		$this->response->setOutput($this->load->view('vendor/lts_commission_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'vendor/lts_commission')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['category_id']) {
			$this->error['category'] = $this->language->get('error_category');
		}	

		if (!$this->request->post['commission']) {
			$this->error['commission'] = $this->language->get('error_commission');
		}

		if ($this->model_vendor_lts_commission->getTotalCategoryById($this->request->post['category_id'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}

		return !$this->error;
	}

	public function validateDelete() {
		if (!$this->user->hasPermission('modify', 'vendor/lts_commission')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}


?> 