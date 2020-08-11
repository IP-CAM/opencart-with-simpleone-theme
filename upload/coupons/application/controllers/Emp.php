<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp extends CI_Controller {

	public function login(){
		$this->load->view('head');
		$this->load->view('emp_login');
	}

	public function logout(){
		session_destroy();
		header("location:".base_url('emp/login'));
	}

    public function signin() {
		$data = $this->input->post();
		//check whether user exists or not
        $query = $this->db->query("SELECT * FROM ls_emp where username = '" . $data['username'] . "' and password='" . $data['password'] . "'");
        $userData = $query->result_array(); 
		
		if(!empty($userData)) {
			
			$_SESSION['user'] = $userData[0]; 

			header("location:".base_url('emp'));
			return false;

		} else {
			$_SESSION['msg'] = array('body'=>'Wrong email or password', status=>'fail');
			header("location:".base_url("emp/login"));
			return false;
		}		
    }
    
    //LOGIC
    /*
     * REMOVE PAID CUSTOMER FROM LS_CUSTOMER TABLE
     * employee will see only limited like 50 customer per day and he has to play with them, this 50 customer data will change next day
     * first select customers assigned to employee
     * if no customer assigned then assign some customer who are not assigned to anyone
     * on next day employee login, give him new customer data by removing his old assigned customer and assign new one
     
    public function index() {
        
        $limit = 2; 
        $loggedInEmpId = $_SESSION['user']['emp_id']; 
        $today = date("Y-m-d", strtotime("+1 day"));
        
        //select all assigned customer
        $query = $this->db->query("SELECT * FROM ls_customers where assigned_to = $loggedInEmpId limit $limit");
        $custData = $query->result_array();

        //some customers are assigned to employee
        if(!empty($custData)) {
            //get the date of when the customers are assigned to employee
            $assigned_on = explode(" ", $custData[0]['assigned_on'])[0];
            
            //if the customers are just assigned today then show the same data
            if($today == $assigned_on) {
                $data['custData'] = $custData;

                $this->load->view('head');
                $this->load->view('emp_home', $data);

            //if customers are assigned in the past, show new data to employee
            } else {
                //get the last customer_id of the assigned customer and assigne new next 50 customer to employee
                foreach($custData as $cust) {
                    $lastCustId = $cust['customer_id'];
                }

                //the customer data were old, employee has already called them so assign them to another employee by makeing assign_to blank
                $this->db->query("update ls_customers set assigned_to = null where assigned_to = $loggedInEmpId order by customer_id  limit $limit");    

                //assign next new 50 customer new data to employee
                $this->db->query("update ls_customers set assigned_to = $loggedInEmpId, assigned_on=now() where assigned_to is null and customer_id >$lastCustId order by customer_id  limit $limit"); 

                $query = $this->db->query("SELECT * FROM ls_customers where assigned_to = $loggedInEmpId limit $limit");
                $custData = $query->result_array();
                $data['custData'] = $custData;
                $this->load->view('head');
                $this->load->view('emp_home', $data);
            }
            
        } else {
            //if he login for the first time 
            $this->db->query("update ls_customers set assigned_to = $loggedInEmpId, assigned_on=now() where assigned_to is null order by customer_id  limit $limit");            
            $query = $this->db->query("SELECT * FROM ls_customers where assigned_to = $loggedInEmpId limit $limit");
            $custData = $query->result_array();
            $data['custData'] = $custData;
            $this->load->view('head');
            $this->load->view('emp_home', $data);
        }
    }*/

    /*LOGIC2
    * RUN a cron at midnight remove all the assigned customer for all employees by making assigned_to null of all customer
      fetch all employee and randomly assign to batch of 50 users to the employees
      now show only assigned user to employees 
    */
    public function index() {
        $limit = 2; 
        $loggedInEmpId = $_SESSION['user']['emp_id']; 
        $query = $this->db->query("SELECT * FROM ls_customers where assigned_to = $loggedInEmpId limit $limit");
        $custData = $query->result_array();
        $data['custData'] = $custData;
        $this->load->view('head');
        $this->load->view('emp_home', $data);
    }

    //this logic will be run by cron
    /*  remove assign_to of all customers
        now shuffle users and assign batch randomly
    
    public function assigncustomers() {

        $limit = 2;
        $query = $this->db->query("SELECT * FROM ls_emp where status = 'A'");
        $empData = $query->result_array();

        $arrEmpIds = [];
        foreach($empData as $emp) {
            array_push($arrEmpIds, $emp['emp_id']);
        }

        shuffle($arrEmpIds);

        //unassign all customers
        $this->db->query("update ls_customers set assigned_to = null");

        $query = $this->db->query("SELECT count(*) AS cust_count FROM ls_customers");
        $custCountData = $query->result_array();
        echo "CUST".$custCount =  intval($custCountData[0]['cust_count']);

        print_r($arrEmpIds);
        
        $arrMultipleLimit = [];
        for($i = 0; $i < $custCount; $i = $i + $limit) {
            array_push($arrMultipleLimit, $i);
        }

        foreach($arrEmpIds as $empId) {
            $empId = intval($empId);
            $offset = ceil(rand(0, $custCount-$limit));
            echo "LOOP" , $empId ,"|", $i, "|", $limit; 
            echo "update ls_customers set assign_to=$empId, assigned_on=now() where customer_id > $offset order by customer_id limit $limit <br>";
            //$this->db->query("update ls_customers set assign_to=$empId, assigned_on=now() where customer_id between $i and " . $i + $limit);
        }
    }*/

    public function assigncustomers() {

        $limit = 3;
        $query = $this->db->query("SELECT * FROM ls_emp where status = 'A' order by emp_id");
        $empData = $query->result_array();

        $arrEmpIds = [];
        foreach($empData as $emp) {
            array_push($arrEmpIds, $emp['emp_id']);
        }

        $qr = $this->db->query("SELECT * FROM ls_customers where assigned_to is not null order by customer_id desc limit 1");
        $lastCustData = $qr->result_array();
        
        if(!empty($lastCustData)) {
            $lastCustId = intval($lastCustData[0]['customer_id']);
            $lastCustId++;
        } else {
            $lastCustId = 0;
        }

        //unassign all customers
        //$this->db->query("update ls_customers set assigned_to = null");
        
        $offset = $lastCustId;
        foreach($arrEmpIds as $empId) {
            $empId = intval($empId);
            
            $this->db->query("update ls_customers set assigned_to = null where assigned_to= $empId and customer_id < $offset");

            echo "update ls_customers set assigned_to=$empId, assigned_on=now() where customer_id > $offset order by customer_id limit $limit <br>";
            
            $this->db->query("update ls_customers set assigned_to=$empId, assigned_on=now() where customer_id >= $offset order by customer_id limit $limit ");

            $offset += $limit;
        }
    }
}