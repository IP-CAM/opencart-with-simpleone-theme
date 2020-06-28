<?php
class ControllerVendorLtsCommissionReport extends controller {
	public function index() {
		$this->load->language('vendor/lts_commission_report');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_commission_report');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
			'href' => $this->url->link('vendor/lts_commission_report', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);


		$filter_data = array(
			// 'filter_name'	  => $filter_name,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$commission_report_total = $this->model_vendor_lts_commission_report->getTotalCommissionsReports($filter_data);

		$results = $this->model_vendor_lts_commission_report->getCommissionReport($filter_data);
		
		$this->load->model('vendor/lts_vendor');

		foreach($results as $value) {
			$vendor_info = $this->model_vendor_lts_vendor->getVendorName($value['vendor_id']);
			$data['commissions'][] = array(
				'vendor_name'	=> $vendor_info['name'],
				'name'			=> $value['name'],
				'model'			=> $value['model'],
				'quantity'		=> $value['quantity'],
				'price'			=> $value['price'],
				'commission'			=> $value['commission'],
				'date_added'	=> $value['date_added']
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
			
		$data['sort_name'] = $this->url->link('vendor/lts_commission_report', 'user_token=' . $this->session->data['user_token'] . '&sort=v.vname' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}





		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']		 = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vendor/lts_commission_report', $data));

	}    
}   