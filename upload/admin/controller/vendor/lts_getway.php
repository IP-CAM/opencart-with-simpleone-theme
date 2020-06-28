<?php
class ControllerVendorLtsGetway extends controller {
	private $error;

	public function index() {
		$this->load->language('vendor/lts_getway');
		
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('lts_getway', $this->request->post);

			// $this->model_setting_setting->editSetting('lts_vendor', $this->request->post);

			// $this->session->data['success'] = $this->language->get('text_success');

			// $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}


		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/vendor', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('vendor/lts_getway', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('vendor/lts_getway', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['lts_getway_status'])) {
			$data['lts_getway_status'] = $this->request->post['lts_getway_status'];
		} else {
			$data['lts_getway_status'] = $this->config->get('lts_getway_status');
		}
		if (isset($this->request->post['lts_getway_sender'])) {
			$data['lts_getway_sender'] = $this->request->post['lts_getway_sender'];
		} else {
			$data['lts_getway_sender'] = $this->config->get('lts_getway_sender');
		}
		if (isset($this->request->post['lts_getway_url'])) {
			$data['lts_getway_url'] = $this->request->post['lts_getway_url'];
		} else {
			$data['lts_getway_url'] = $this->config->get('lts_getway_url');
		}	

		if (isset($this->request->post['lts_getway_apikey'])) {
			$data['lts_getway_apikey'] = $this->request->post['lts_getway_apikey'];
		} else {
			$data['lts_getway_apikey'] = $this->config->get('lts_getway_apikey');
		}	
		if (isset($this->request->post['lts_getway_customer_login_otp'])) {
			$data['lts_getway_customer_login_otp'] = $this->request->post['lts_getway_customer_login_otp'];
		} else {
			$data['lts_getway_customer_login_otp'] = $this->config->get('lts_getway_customer_login_otp');
		}

		if (isset($this->request->post['lts_getway_customer_login_by'])) {
			$data['lts_getway_customer_login_by'] = $this->request->post['lts_getway_customer_login_by'];
		} else {
			$data['lts_getway_customer_login_by'] = $this->config->get('lts_getway_customer_login_by');
		}

		if (isset($this->request->post['lts_getway_customer_forget_otp'])) {
			$data['lts_getway_customer_forget_otp'] = $this->request->post['lts_getway_customer_forget_otp'];
		} else {
			$data['lts_getway_customer_forget_otp'] = $this->config->get('lts_getway_customer_forget_otp');
		}	

		if (isset($this->request->post['lts_getway_customer_forget_by'])) {
			$data['lts_getway_customer_forget_by'] = $this->request->post['lts_getway_customer_forget_by'];
		} else {
			$data['lts_getway_customer_forget_by'] = $this->config->get('lts_getway_customer_forget_by');
		}

		if (isset($this->request->post['lts_getway_customer_register_otp'])) {
			$data['lts_getway_customer_register_otp'] = $this->request->post['lts_getway_customer_register_otp'];
		} else {
			$data['lts_getway_customer_register_otp'] = $this->config->get('lts_getway_customer_register_otp');
		}

		if (isset($this->request->post['lts_getway_customer_register_by'])) {
			$data['lts_getway_customer_register_by'] = $this->request->post['lts_getway_customer_register_by'];
		} else {
			$data['lts_getway_customer_register_by'] = $this->config->get('lts_getway_customer_register_by');
		}

		if (isset($this->request->post['lts_getway_vendor_login_otp'])) {
			$data['lts_getway_vendor_login_otp'] = $this->request->post['lts_getway_vendor_login_otp'];
		} else {
			$data['lts_getway_vendor_login_otp'] = $this->config->get('lts_getway_vendor_login_otp');
		}

		if (isset($this->request->post['lts_getway_vendor_login_by'])) {
			$data['lts_getway_vendor_login_by'] = $this->request->post['lts_getway_vendor_login_by'];
		} else {
			$data['lts_getway_vendor_login_by'] = $this->config->get('lts_getway_vendor_login_by');
		}

		if (isset($this->request->post['lts_getway_vendor_forget_otp'])) {
			$data['lts_getway_vendor_forget_otp'] = $this->request->post['lts_getway_vendor_forget_otp'];
		} else {
			$data['lts_getway_vendor_forget_otp'] = $this->config->get('lts_getway_vendor_forget_otp');
		}	

		if (isset($this->request->post['lts_getway_vendor_forget_by'])) {
			$data['lts_getway_vendor_forget_by'] = $this->request->post['lts_getway_vendor_forget_by'];
		} else {
			$data['lts_getway_vendor_forget_by'] = $this->config->get('lts_getway_vendor_forget_by');
		}

		if (isset($this->request->post['lts_getway_vendor_register_otp'])) {
			$data['lts_getway_vendor_register_otp'] = $this->request->post['lts_getway_vendor_register_otp'];
		} else {
			$data['lts_getway_vendor_register_otp'] = $this->config->get('lts_getway_vendor_register_otp');
		}

		if (isset($this->request->post['lts_getway_vendor_register_by'])) {
			$data['lts_getway_vendor_register_by'] = $this->request->post['lts_getway_vendor_register_by'];
		} else {
			$data['lts_getway_vendor_register_by'] = $this->config->get('lts_getway_vendor_register_by');
		}

		$data['header']	= $this->load->controller('common/header');
		$data['column_left']	= $this->load->controller('common/column_left');
		$data['footer']	= $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vendor/lts_getway', $data));
	}


	protected function validate() {
		if (!$this->user->hasPermission('modify', 'vendor/lts_getway')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}



?>