<?php
class ControllerVendorLtsSubscription extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('vendor/lts_subscription');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_subscription');

		$this->getList();
	}

	public function add() {
		$this->load->language('vendor/lts_subscription');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_subscription');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			if(!isset($this->request->post['default_plan'])){
				$this->request->post['default_plan']=0;	
			}

			$this->model_vendor_lts_subscription->addSubscription($this->request->post); 

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('vendor/lts_subscription', 'user_token=' . $this->session->data['user_token'], true));
		}
 
		$this->getForm();
	}

	public function delete() {
		
		$this->load->language('vendor/lts_subscription');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_subscription');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $subscription_id) {
				$this->model_vendor_lts_subscription->deleteSubscription($subscription_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('vendor/lts_subscription', 'user_token=' . $this->session->data['user_token'], true));
		} 

		$this->getList();
	}

	public function edit() {

		$this->load->language('vendor/lts_subscription');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_subscription');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			if(!isset($this->request->post['default_plan'])){
				$this->request->post['default_plan']=0;	
			}

			$this->model_vendor_lts_subscription->editSubscription($this->request->get['subscription_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('vendor/lts_subscription', 'user_token=' . $this->session->data['user_token'], true));
		}

		$this->getForm();
	}

	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}
		
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'sd.name';
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

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
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
			'href' => $this->url->link('vendor/lts_subscription', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('vendor/lts_subscription/add', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['delete'] = $this->url->link('vendor/lts_subscription/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['subscriptions'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$subscription_total = $this->model_vendor_lts_subscription->getTotalSubscriptions($filter_data);

		$results = $this->model_vendor_lts_subscription->getSubscriptions($filter_data);

		foreach ($results as $result) {
			$data['subscriptions'][] = array(
				'subscription_id' => $result['subscription_id'],
				'name'       => $result['name'],
				'status'     => $result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('vendor/lts_subscription/edit', 'user_token=' . $this->session->data['user_token'] . '&subscription_id=' . $result['subscription_id'] . $url, true)
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
			
		$data['sort_name'] = $this->url->link('vendor/lts_subscription', 'user_token=' . $this->session->data['user_token'] . '&sort=cd.name' . $url, true);

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
		$pagination->total = $subscription_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('vendor/lts_subscription', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($subscription_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($subscription_total - $this->config->get('config_limit_admin'))) ? $subscription_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $subscription_total, ceil($subscription_total / $this->config->get('config_limit_admin')));

		$data['header'] 	 = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] 	 = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vendor/lts_subscription_list', $data));
	}
	
	public function getForm() {
		$data['text_form'] = !isset($this->request->get['subscription_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['no_of_product'])) {
			$data['error_no_of_product'] = $this->error['no_of_product'];
		} else {
			$data['error_no_of_product'] = '';
		}	

		if (isset($this->error['join_fee'])) {
			$data['error_join_fee'] = $this->error['join_fee'];
		} else {
			$data['error_join_fee'] = '';
		}

		if (isset($this->error['subscription_fee'])) {
			$data['error_subscription_fee'] = $this->error['subscription_fee'];
		} else {
			$data['error_subscription_fee'] = '';
		}

		if (isset($this->error['validity'])) {
			$data['error_validity'] = $this->error['validity'];
		} else {
			$data['error_validity'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
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
			'href' => $this->url->link('vendor/lts_subscription', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['subscription_id'])) {
			$data['action'] = $this->url->link('vendor/lts_subscription/add', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('vendor/lts_subscription/edit', 'user_token=' . $this->session->data['user_token'] . '&subscription_id=' . $this->request->get['subscription_id'], true);
		}

		$data['cancel'] = $this->url->link('vendor/lts_subscription', 'user_token=' . $this->session->data['user_token'], true);

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->get['subscription_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$subscription_info = $this->model_vendor_lts_subscription->getSubscription($this->request->get['subscription_id']);
		}

		if (isset($this->request->post['subscription_description'])) {
			$data['subscription_description'] = $this->request->post['subscription_description'];
		} elseif (isset($this->request->get['subscription_id'])) {
			$data['subscription_description'] = $this->model_vendor_lts_subscription->getSubscriptionDescriptions($this->request->get['subscription_id']);
		} else {
			$data['subscription_description'] = array();
		}

		if (isset($this->request->post['no_of_product'])) {
			$data['no_of_product'] = $this->request->post['no_of_product'];
		} elseif (!empty($subscription_info)) {
			$data['no_of_product'] = $subscription_info['no_of_product'];
		} else {
			$data['no_of_product'] = '';
		}

		if (isset($this->request->post['join_fee'])) {
			$data['join_fee'] = $this->request->post['join_fee'];
		} elseif (!empty($subscription_info)) {
			$data['join_fee'] = $subscription_info['join_fee'];
		} else {
			$data['join_fee'] = '';
		}	

		if (isset($this->request->post['subscription_fee'])) {
			$data['subscription_fee'] = $this->request->post['subscription_fee'];
		} elseif (!empty($subscription_info)) {
			$data['subscription_fee'] = $subscription_info['subscription_fee'];
		} else {
			$data['subscription_fee'] = '';
		}

		if (isset($this->request->post['validity'])) {
			$data['validity'] = $this->request->post['validity'];
		} elseif (!empty($subscription_info)) {
			$data['validity'] = $subscription_info['validity'];
		} else {
			$data['validity'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($subscription_info)) {
			$data['status'] = $subscription_info['status'];
		} else {
			$data['status'] = false;
		}

		if (isset($this->request->post['default_plan'])) {
			$data['default_plan'] = $this->request->post['default_plan'];
		} elseif (!empty($subscription_info)) {
			$data['default_plan'] = $subscription_info['default_plan'];
		} else {
			$data['default_plan'] = '';
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header']		= $this->load->controller('common/header');
		$data['footer']		= $this->load->controller('common/footer');
		$data['column_left']= $this->load->controller('common/column_left');

		$this->response->setOutput($this->load->view('vendor/lts_subscription_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'vendor/lts_subscription')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['subscription_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}
	
		if (!$this->request->post['no_of_product']) {
			$this->error['no_of_product'] = $this->language->get('error_no_of_product');
		}	

		if (!$this->request->post['join_fee']) {
			$this->error['join_fee'] = $this->language->get('error_join_fee');
		}

		if (!$this->request->post['subscription_fee']) {
			$this->error['subscription_fee'] = $this->language->get('error_subscription_fee');
		}	

		if (!$this->request->post['validity']) {
			$this->error['validity'] = $this->language->get('error_validity');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	public function validateDelete() {
		if (!$this->user->hasPermission('modify', 'vendor/lts_subscription')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}


?> 