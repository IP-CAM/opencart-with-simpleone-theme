<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	public function login(){
		$this->load->view('c-head');
		$this->load->view('c-header-login');
		$this->load->view('c-login');
	}

	public function logout(){
		session_destroy();
		header("location:".base_url('login'));
	}

	public function signup() {
		$data = $this->security->xss_clean($this->input->post());
		$data['company_name'] = ucfirst($data['company_name']);
		
		//check whether user exists or not
		$query = $this->db->query("SELECT * FROM companies where email = '" . $data['email'] . "'");
		$userData = $query->result_array(); 
		
		if(!empty($userData)) {
            
            $_SESSION['msg'] = array('body'=>'Company already Exists!', status=>'fail');
            header("location:".base_url("company/login"));
            return false;

			/*if($userData[0]['status'] == 1){
				$_SESSION['msg'] = array('body'=>'Company already Exists!', status=>'fail');
				header("location:".base_url("login"));
				return false;
			}

			if($userData[0]['status'] == 0){
				$_SESSION['msg'] = array('body'=>'Please validate your email', status=>'fail');
				header("location:".base_url("login"));
				return false;
			}*/
		}
		//print_r($data); die();
		$_SESSION['msg'] = array('body'=>"Sign up successfull, Please login.", status=>'success');
		$this->db->insert('companies', $data);
		header("location:".base_url('company/login'));
	}

	public function signin() {
		$data = $this->input->post();
		//check whether user exists or not
		$query = $this->db->query("SELECT * FROM companies where email = '" . $data['email'] . "' and password='" . $data['password'] . "'");
		$userData = $query->result_array(); 
		
		if(!empty($userData)) {
			
			/*if($userData[0]['status'] == 0){
				$_SESSION['msg'] = array('body'=>'Please validate your email', status=>'fail');
				header("location:".base_url("login"));
				return false;
			}*/

			$_SESSION['user'] = $userData[0]; 

			header("location:".base_url('company'));
			return false;

		} else {
			$_SESSION['msg'] = array('body'=>'Wrong email or password', status=>'fail');
			header("location:".base_url("company/login"));
			return false;
		}		
	}

	public function index() {

		isLoggedIn();
		
		$arrThoughtIds = array();
		$arrLikeData = array();
		$arrCommentData = array();

		$qr = "select t.*, c.comment_id, c.comment from company_thoughts t LEFT join company_comments c on t.thought_id = c.object_id where t.to_company_id = " . $_SESSION['user']['company_id'] . " order by t.created desc ";
		$query = $this->db->query($qr);
		$postData = $query->result_array(); 
		
		foreach($postData as $key => $post) {
			array_push($arrThoughtIds, $post['thought_id']);

			$shareURLCmnt = urlencode(base_url('u/'.$_SESSION['user']['company_id'].'/r/'.$post['thought_id']));
			$shareTextprofile = "Checkout what other people think about me.";
			$socialShareUrls = array (
				"facebook" 	=> "https://www.facebook.com/sharer/sharer.php?u=$shareURLCmnt",
				"twitter" 	=> "https://twitter.com/intent/tweet?url=$shareURLCmnt&text=$shareTextprofile",
				"whatsapp"	=> "whatsapp://send?text=".urlencode($shareTextprofile)."%20$shareURLCmnt"
			); 
			$strSocialUrls = json_encode($socialShareUrls);
			$postData[$key]['socialShareUrls'] = $strSocialUrls; 

		}

		/*$qr = "select object_id, count(like_id) as like_count from likes where object_id in ( " . implode("," ,$arrThoughtIds) . " ) GROUP BY object_id";
		$query = $this->db->query($qr);
		$likeData = $query->result_array(); 
		
		foreach($likeData as $like) {
			$arrLikeData[$like['object_id']] = $like['like_count'];
		}
		
		foreach($postData as $postKey=>$post) {
			$postData[$postKey]['like_count'] = array_key_exists($post['thought_id'], $arrLikeData) ? $arrLikeData[$post['thought_id']] : 0;
		}*/

		$data['thoughtsData'] = $postData;

		$shareURLprofile = urlencode(base_url('company/'.$_SESSION['user']['company_id']));
		$shareTextprofile = "Give us your anonymous feedback.";
		$data['shareUrl']['profile']['twitter'] = "https://twitter.com/intent/tweet?url=$shareURLprofile&text=$shareTextprofile";
		$data['shareUrl']['profile']['facebook'] = "https://www.facebook.com/sharer/sharer.php?u=$shareURLprofile";
		$data['shareUrl']['profile']['whatsapp'] = "whatsapp://send?text=".urlencode($shareTextprofile)."%20$shareURLprofile";

		$this->load->view('head');
		$this->load->view('c-header');
		$this->load->view('c-home', $data);
		$this->load->view('footer', $data);
	}

	public function search() {
		$searchText = $this->security->xss_clean($this->input->get('search'));
		$arrSearchTxt = explode(" ", $searchText);

		
		$cqr = "SELECT * FROM companies WHERE company_name like '%$searchText%'";
		$cquery = $this->db->query($cqr);

		$data = array("companyData" => $cquery->result_array() , "searchText"=>$searchText); 

		$this->load->view('c-head');
		$this->load->view('c-header');
		$this->load->view('search_results', $data);
		$this->load->view('footer', $data);

	}

	public function upp() {
		$filename = $_FILES['upp']['name'];

        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);

		$newFileName = md5($_SERVER['REMOTE_ADDR'] . time()) . "." . $file_extension;

		$file_location = FCPATH . "public/uploads/images/$newFileName";
		$location = base_url()."public/uploads/images/$newFileName";

		if(!in_array($file_extension, $this->config->item('image_ext'))){
			$_SESSION['msg'] = "File upload failed. Supported formats are jpg, png, jpeg, gif";
			header("location:".base_url("company"));
			return false;
		}

		move_uploaded_file($_FILES['upp']['tmp_name'], $file_location);
		$this->db->update('companies', array("image" => $location), "company_id=" . $_SESSION['user']['company_id']);
		$_SESSION['user']['image'] = $location;
		header("location:".base_url("company"));
    }
    
	public function thoughts() {

		isLoggedIn();
		$defTags = implode(",", $this->config->item('defTags'));
		$qr = "SELECT *, COUNT(ufl.user_feedback_like_id) as like_count FROM users u, user_feedback uf, user_feedback_likes ufl WHERE u.user_id = uf.to_user_id AND uf.user_feedback_id = ufl.user_feedback_id AND u.user_id = " . $_SESSION['user']['user_id'] . " GROUP BY uf.user_feedback_id ";
		$query = $this->db->query($qr);
		$thoughtsData = $query->result_array(); 

		$data = array("thoughtsData" => $thoughtsData);
		
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('thoughts', $data);
		$this->load->view('footer', $data);
	}
	
	public function publish($thoughId) {
		$this->db->update("company_thoughts", array("is_published" => 1), array("thought_id" => $thoughId));
		echo json_encode(array( "status" => "success" ));
	}
	public function unpublish($thoughId) {
		$this->db->update("company_thoughts", array("is_published" => 0), array("thought_id" => $thoughId));
		echo json_encode(array( "status" => "success" ));
	}

	public function replythought() {

        $fromUserId = !empty($_SESSION['user']) && !empty($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : 0;
        $thoughId = $this->input->post('thoughtId');
        $ip = $_SERVER['REMOTE_ADDR'];
        $thoughtId = 0;

        $qr = "SELECT count(*) as replyCount FROM company_comments WHERE object_id = $thoughId " ;

        $query = $this->db->query($qr);
        $thoughtsCountData = $query->result_array(); 
        //print_r($thoughtsCountData);
        if($thoughtsCountData[0]['replyCount'] >= 1) {
            header(':', true, 400);
			echo json_encode(array( "msg" => "You have already Replied" ));
			return false;
        }

        $data = array(
            "object_id" => $thoughId,
            "from_user_id" => $fromUserId,
            "comment" => strip_tags( $this->security->xss_clean($this->input->post('comment')) ),
            "ip" => $_SERVER['REMOTE_ADDR'],
        );

        if($this->db->insert('company_comments', $data)) {
            $replyId = $this->db->insert_id();
        }

        echo json_encode(array( "status" => "Success", "replyId" => $replyId ));

    }
    
	public function deletethought($thoughId) {

		$this->db->delete('company_thoughts', array('thought_id' => $thoughId));
		echo json_encode(array( "status" => "Success" ));

	}

	public function deletereply($replyId) {

		$this->db->delete('company_comments', array('comment_id' => $replyId));
		echo json_encode(array( "status" => "Success" ));
		
    }
    
    public function publicpage($companyId) {

        $companyId = $this->security->xss_clean($companyId);

        $arrThoughtIds = array();
		$arrLikeData = array();
		$arrCommentData = array();
        
        $qr = "SELECT * FROM companies u where u.company_id = '$companyId' "  ;
		$query = $this->db->query($qr);
        $userData = $query->result_array(); 
        $userData = $userData[0];


		$qr = "select t.*, c.comment_id, c.comment from company_thoughts t LEFT join company_comments c on t.thought_id = c.object_id where is_published = 1 AND t.to_company_id = " . $userData['company_id'] . " order by t.created desc ";
		$query = $this->db->query($qr);
		$postData = $query->result_array(); 
		
		foreach($postData as $post) {
			array_push($arrThoughtIds, $post['thought_id']);
		}

		/*$qr = "select object_id, count(like_id) as like_count from likes where object_id in ( " . implode("," ,$arrThoughtIds) . " ) GROUP BY object_id";
		$query = $this->db->query($qr);
		$likeData = $query->result_array(); 
		
		foreach($likeData as $like) {
			$arrLikeData[$like['object_id']] = $like['like_count'];
		}
		
		foreach($postData as $postKey=>$post) {
			$postData[$postKey]['like_count'] = array_key_exists($post['thought_id'], $arrLikeData) ? $arrLikeData[$post['thought_id']] : 0;
        }*/

        $data['companyId'] = $userData['company_id'];        
        $data['userData'] = $userData;
        $data['thoughtsData'] = $postData;
        
		$this->load->view('c-head');
		if(isset($_SESSION['user']['company_id'])) {
			$this->load->view('c-header');
		} else {
			$this->load->view('header2');
		}
		        $this->load->view('c-user', $data);
        $this->load->view('footer', $data);
    }

    public function addthought() {

        $fromUserId = !empty($_SESSION['user']) && !empty($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : 0;
        $toCompanyId = $this->input->post('to_company_id');
        $ip = $_SERVER['REMOTE_ADDR'];
        $thoughtId = 0;

        $qr = "SELECT count(*) as thoughtCount FROM company_thoughts WHERE DATE(`created`) = CURDATE() AND to_company_id = $toCompanyId  AND (from_user_id = $fromUserId OR ip = '$ip')" ;

        $query = $this->db->query($qr);
        $thoughtsCountData = $query->result_array(); 
        //print_r($thoughtsCountData);
        if($thoughtsCountData[0]['thoughtCount'] >= 3) {
            http_response_code(400);
			echo json_encode(array( "msg" => "You have already commented" ));
			return false;
        }

        $data = array(
            "from_user_id" => $fromUserId,
            "to_company_id" => $toCompanyId,
            "thought_text" => strip_tags( $this->security->xss_clean($this->input->post('comment')) ),
            "ip" => $_SERVER['REMOTE_ADDR'],
        );

        if($this->db->insert('company_thoughts', $data)) {
            $thoughtId = $this->db->insert_id();
        }

        //send email
        /*$query = $this->db->query("SELECT * FROM users where user_id = $toUserId");
		$userData = $query->result_array(); 
		
		if(!empty($userData)) {
			
            $userData = $userData[0];
            
            $this->load->library('email');

            $config['wordwrap'] = TRUE;
            $config['mailtype'] = "html";

            $this->email->initialize($config);

            $this->email->from('info@unsaidstuff.com', 'unsaidstuff.com');
            $this->email->to($userData['email']);
            
            $this->email->subject('Someone has commented on you profile.');
            $msg = '<div><h3>Hello ' . $userData['first_name'] . " " . $userData['last_name'] . ',</h3><br><br> Someone has commented on your profile, Please <a href="' . base_url() . '"><b>Login</b></a> to checkout. <br><br>Thanks,<br>Unsaidstuff Team</div>';
            $this->email->message($msg);
            
            $this->email->send();
		}*/

        echo json_encode(array( "status" => "Success", "thoughtId" => $thoughtId ));

    }
}
