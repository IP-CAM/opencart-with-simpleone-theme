<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function login(){
		$this->load->view('head');
		$this->load->view('admin_login');
	}

	public function logout(){
		session_destroy();
		header("location:".base_url('admin/login'));
	}

    public function signin() {

        $data = $this->input->post();
        
        
        
		if($data['username' ]== "admin" && $data['password']=="Admin@56") {
			
			$_SESSION['user'] = array("username" => $data['username']); 

			header("location:".base_url('admin'));
			return false;

		} else {
			$_SESSION['msg'] = array('body'=>'Wrong email or password', status=>'fail');
			header("location:".base_url("admin/login"));
			return false;
		}		
    }

    public function index() {

        $this->isAdmin();

        $this->load->view('head');
		$this->load->view('admin_home');
    }
    
    public function addcustomer() {
        
        $this->isAdmin();
        
        $data = array(
            "business_name" => strip_tags( $this->security->xss_clean($this->input->post('business_name')) ),
            "business_contact" => strip_tags( $this->security->xss_clean($this->input->post('business_contact')) ),
            "business_email" => strip_tags( $this->security->xss_clean($this->input->post('business_email')) ),
            "business_address" => strip_tags( $this->security->xss_clean($this->input->post('business_address')) ),
        );

        if($this->db->insert('ls_customers', $data)) {
            $feedbackId = $this->db->insert_id();
		}
		
		$_SESSION["msg"] =  "Customer is added successfully!";
		header("location:".base_url("admin"));
    }

    public function isAdmin() {
        if(!empty($_SESSION['user']) && $_SESSION['user']['username'] == 'admin') {
            return true;
        }

        header("location:".base_url("admin/login"));
        return false;
    }

    public function addcoupons() {
        $this->isAdmin();

        $this->load->view('head');
		$this->load->view('admin_coupons');
    }

    public function insertcoupon() {
        
        $this->isAdmin();
        
        $data = array(
            "code" => substr(strtoupper(md5($t)), rand(1,10), 4) ,
            "title" => strip_tags( $this->security->xss_clean($this->input->post('title')) ),
            "type" => strip_tags( $this->security->xss_clean($this->input->post('type')) ),
            "discount" => strip_tags( $this->security->xss_clean($this->input->post('discount')) ),
            "business_address" => strip_tags( $this->security->xss_clean($this->input->post('business_address')) ),
            "business_name" => strip_tags( $this->security->xss_clean($this->input->post('business_name')) ),
            "status" => "A"
        );

        if($this->db->insert('ls_coupons', $data)) {
            $feedbackId = $this->db->insert_id();
		}
		
		$_SESSION["msg"] =  "Coupon is added successfully!";
		header("location:".base_url("admin/addcoupons"));
    }
}