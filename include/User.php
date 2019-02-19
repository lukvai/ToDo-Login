<?php 
	// include "DB.php";
	class User{
		protected $db;
		public function __construct(){
			$this->db = new DB();
			$this->db = $this->db->ret_obj();
		}
		
		// Login
		public function check_login($username, $password){;
		$query = "SELECT uid from users WHERE uname='$username' and upass='$password'";
		$result = $this->db->query($query) or die($this->db->error);
		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;
		
		if ($count_row == 1) {
	            $_SESSION['login'] = true; // this login var will use for the session
	            $_SESSION['uid'] = $user_data['uid'];
	            return true;
	        }
			
		else{return false;}
		

	}
	
	// Get Role
	public function get_Role($uid){
		$query = "SELECT role FROM users WHERE uid = '$uid'";
		$result = $this->db->query($query) or die($this->db->error);
		
		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		return $user_data['role'];
	}
	
	/*** starting the session ***/
	public function get_session(){
	    return $_SESSION['login'];
	    }

	public function user_logout() {
	    $_SESSION['login'] = FALSE;
		unset($_SESSION);
	    session_destroy();
	    }
}