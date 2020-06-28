<?php 
class ControllerVendorLtsExportImport extends controller {
	private $error = array();

	public function index() {
		$this->load->language("vendor/lts_export_import");

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vendor/lts_export_import');

		$this->getForm();
      
	}

	public function getForm() {


		 $data['action'] = $this->url->link('vendor/lts_export_import/download', 'user_token=' . $this->session->data['user_token'], true);




		$data['header']	= $this->load->controller('common/header');
		$data['column_left']	= $this->load->controller('common/column_left');
		$data['footer']	= $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vendor/lts_export_import', $data));
	}


	public function download() {
		$this->load->model( 'vendor/lts_export_import' ); 

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$export_type = $this->request->post['export_type'];

			switch ($export_type) {

				case 'p':
					$this->model_vendor_lts_export_import->download($export_type);
					break;
				
				default:             
					break;
			}
			$this->response->redirect( $this->url->link( 'vendor/lts_export_import', 'user_token='.$this->request->get['user_token'], $this->ssl) );
		}

		$this->getForm();
	}


	protected function validateForm() {

		if (!$this->user->hasPermission('access', 'vendor/lts_export_import')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return true;

	}




}
