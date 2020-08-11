<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function index($username) {

        $username = $this->security->xss_clean($username);

        $arrThoughtIds = array();
		$arrLikeData = array();
		$arrCommentData = array();
        
        $qr = "SELECT * FROM users u where u.username = '$username' "  ;
		$query = $this->db->query($qr);
        $userData = $query->result_array(); 
        $userData = $userData[0];


		$qr = "select t.*, c.comment_id, c.comment from thoughts t LEFT join comments c on t.thought_id = c.object_id where is_published = 1 AND t.to_user_id = " . $userData['user_id'] . " order by t.created desc ";
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

        $data['userId'] = $userData['user_id'];        
        $data['userData'] = $userData;
        $data['thoughtsData'] = $postData;
        
		$this->load->view('head');
		if(isset($_SESSION['user']['company_id'])) {
			$this->load->view('c-header');
		} else {
			$this->load->view('header2');
		}
        $this->load->view('user2', $data);
        $this->load->view('footer', $data);
    }

    public function add_vote() {
        
        $fromUserId = !empty($_SESSION['user']) ? $_SESSION['user']['user_id'] : 0;
        $toUserId = $this->input->post('to_user_id');
        $tagId = $this->input->post('tag_id');

        //$qr = "SELECT * FROM tag_votes where (ip = '". $_SERVER['REMOTE_ADDR'] ."' and tag_id=$tagId) or ( from_user_id =  $fromUserId and to_user_id = $toUserId and tag_id=$tagId ) " ;

        $qr = "SELECT * FROM tag_votes where from_user_id =  $fromUserId and to_user_id = $toUserId and tag_id=$tagId" ;

        $query = $this->db->query($qr);
        $tagsData = $query->result_array(); 
        
        if(!empty($tagsData)) {
            header(':', true, 400);
			echo json_encode(array( "msg" => "You have already voted on this tag" ));
			return false;
        }

        $data = array(
            "from_user_id" => $fromUserId,
            "to_user_id" => $toUserId,
            "tag_id" => $tagId,
            "ip" => $_SERVER['REMOTE_ADDR']
        );
        
        $this->db->insert('tag_votes', $data);

    }
    
    public function add_tag() {
		$tag =  strtolower($this->input->post('txtTag'));
        $toUserId = $this->input->post('user_id');
        $sysTagCount = $this->config->item('sysTagCount');
		
		$query = $this->db->query("SELECT * FROM tags where tag_name = '$tag'" );
		$tagsData = $query->result_array(); 
        
        if(empty($tagsData[0])) {
            header(':', true, 404);
            echo json_encode(array( "msg" => "You are not allowed to add this tag" ));
            return false;
        }
        
        $tagId = $tagsData[0]['tag_id'];

        $query = $this->db->query("SELECT * FROM user_tags where user_id = ".$toUserId);
        $userTagsData = $query->result_array(); 
        $arrUserTagIds = array();
        foreach($userTagsData as $ut) {
            array_push($arrUserTagIds, $ut['tag_id']);
        }

        if(in_array($tagId, $arrUserTagIds)) {
            header(':', true, 404);
            echo json_encode(array( "msg" => "Tag already exists" ));
            return false;
        } 

		//if tag is not system tag and does not exists in user tags then throw error     
        if($tagId > $sysTagCount && !in_array($tagId, $arrUserTagIds)) {
            header(':', true, 404);
            echo json_encode(array( "msg" => "You are not allowed to add this tag" ));
            return false;
        }

        $userTagsData = array(
            "tag_id" => $tagId,
            "user_id" => $toUserId,
            "from_user_id" => $_SESSION['user']['user_id'],
        );

        if($this->db->insert('user_tags', $userTagsData)) {
            $userTagId = $this->db->insert_id();
        }

        echo json_encode(array( "user_tag_id" => $userTagId, "tag_id" => $tagId ));

			
    }
    
    public function thoughts($userId) {
        isLoggedIn();
        
        $qr = "SELECT * FROM users u where u.user_id = " . $userId ;
		$query = $this->db->query($qr);
		$userData = $query->result_array();
        
        $qr = "SELECT *, COUNT(ufl.user_feedback_like_id) as like_count FROM users u, user_feedback uf, user_feedback_likes ufl WHERE u.user_id = uf.to_user_id AND uf.user_feedback_id = ufl.user_feedback_id AND u.user_id = " . $userId . " GROUP BY uf.user_feedback_id ";
		$query = $this->db->query($qr);
		$thoughtsData = $query->result_array(); 

        $data = array(
            "thoughtsData" => $thoughtsData,
            "userId" => $userId,
            "userData" => $userData[0]
        );
		
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('user_thoughts', $data);
		$this->load->view('footer', $data);  
    }

    public function addthought() {

        $fromUserId = !empty($_SESSION['user']) ? $_SESSION['user']['user_id'] : 0;
        $toUserId = $this->input->post('to_user_id');
        $ip = $_SERVER['REMOTE_ADDR'];
        $thoughtId = 0;

        $qr = "SELECT count(*) as thoughtCount FROM thoughts WHERE DATE(`created`) = CURDATE() AND to_user_id = $toUserId  AND (from_user_id = $fromUserId OR ip = '$ip')" ;

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
            "to_user_id" => $toUserId,
            "thought_text" => strip_tags( $this->security->xss_clean($this->input->post('comment')) ),
            "ip" => $_SERVER['REMOTE_ADDR'],
        );

        if($this->db->insert('thoughts', $data)) {
            $thoughtId = $this->db->insert_id();
        }

        //send email
        $query = $this->db->query("SELECT * FROM users where user_id = $toUserId");
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
		}

        echo json_encode(array( "status" => "Success", "thoughtId" => $thoughtId ));

    }

    public function review($username, $reviewId) {

        $reviewId = $this->security->xss_clean($reviewId);
        $username = $this->security->xss_clean($username);

        $arrThoughtIds = array();
		$arrLikeData = array();
		$arrCommentData = array();
        
        $qr = "SELECT * FROM users u where u.username = '$username' ";
		$query = $this->db->query($qr);
        $userData = $query->result_array(); 
        $userData = $userData[0];


		$qr = "select t.*, c.comment_id, c.comment from thoughts t LEFT join comments c on t.thought_id = c.object_id where is_published = 1 AND t.thought_id = " . $reviewId . " order by t.created desc ";
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

        $data['userId'] = $userData["user_id"];        
        $data['userData'] = $userData;
        $data['thoughtsData'] = $postData;
        
		$this->load->view('head');
		$this->load->view('header2');
        $this->load->view('user2', $data);
        $this->load->view('footer', $data);
    }
}
?>