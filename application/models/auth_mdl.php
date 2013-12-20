<?php
/**
 * @author dogwin
 * @date 2013-12-16
 * @website http://dogwin.net
 */
class Auth_mdl extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * rand numbers
	 */
	function dogwin_rand($min = null, $max = null){
		static $seeded;
		if (!isset($seeded)){
			mt_srand((double)microtime()*1000000);
			$seeded = true;
		}
		if (isset($min) && isset($max)){
			if ($min >= $max){
				return $min;
			}else{
				return mt_rand($min, $max);
			}
		}else{
			return mt_rand();
		}
	}
	/**
	 *
	 * password
	 *
	 */
	function dogwin_encrypt_password($plain){
		$password = '';
		for ($i=0; $i<10; $i++) {
			$password .= $this->dogwin_rand();
		}
		$salt = substr(md5($password), 0, 2);
		$password = md5($salt . $plain) . ':' . $salt;
		return $password;
	}
	/**
	 *
	 * decrypt password
	 *
	 */
	function dogwin_decrypt_password($database_ps,$in_ps){
		$A_database_ps = explode(":",$database_ps);
		$new_ps = md5($A_database_ps[1].$in_ps).':'.$A_database_ps[1];
		return $new_ps;
	}
	/**
	 *
	 * set cookie
	 *
	 */
	function dogwin_set_cookie($email,$password){
		$email_len = strlen($email)+19770725;
		$set_value = convert_uuencode($email.":".$password.":".$email_len);
		$C_value = array(
				"name"=>"C_loginfo",
				"value"=>$set_value,
				"expire"=>'999993600',
				"path"=>'/',
		);
		set_cookie($C_value);
	}
	/**
	 *
	 * get cookie
	 *
	 */
	function get_cookie(){
		$C_loginfo = convert_uudecode(get_cookie('C_loginfo'));
		if(strlen($C_loginfo)>10){
			
			$str_name_ps = explode(":",$C_loginfo);
			$name_len = $str_name_ps['2']-19770725;
			$name_password = $str_name_ps[0].":".$str_name_ps[1];
			$C_len = strlen($name_password);
			$email = substr($name_password,0,$name_len);
			$password = substr($name_password,$name_len+1,$C_len);
			$array = array('email'=>$email,'password'=>$password);
		}else{
			$array = array('email'=>'','password'=>'');
		}
		return $array;
	}
	function dogwin_get_cookie(){
		$C_loginfo = convert_uudecode(get_cookie('C_loginfo'));
		if(strlen($C_loginfo)>10){
			$str_name_ps = explode(":",$C_loginfo);
			$name_len = $str_name_ps['2']-19770725;
			$name_password = $str_name_ps[0].":".$str_name_ps[1];
			$C_len = strlen($name_password);
			$email = substr($name_password,0,$name_len);
			$password = substr($name_password,$name_len,$C_len);
			$sql = "select * from admin_user where email=? and password=?";
			$query = $this->db->query($sql,array($email,$password));
			if($query->num_rows()<>0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	/**
	 *
	 * set session
	 *
	 */
	function dogwin_set_session($email,$password){
		$A_S_Log = array(
				"email"=>$email,
				"password"=>$password,
		);
		$this->session->set_userdata($A_S_Log);
	}
	//get session
	function dogwin_check_session(){
		$S_email = $this->session->userdata('email');
		$S_password = $this->session->userdata('password');
		//echo "sslslslsls".$S_email;
		if($S_email==""||$S_password==""){
			return false;
		}else{
			//已登陆验证
			$sql = "select * from admin_user where email=? and password=?";
			$query = $this->db->query($sql,array($S_email,$S_password));
			if($query->num_rows()<>0){
				return true;
			}else{
				return false;
			}
		}
		//echo "S_email==>".$S_email;
		//echo "<BR>S_password==>".$S_password;
	}
	function getUserInfo(){
		$S_email = $this->session->userdata('email');
		$S_password = $this->session->userdata('password');
		$sql = "select * from admin_user where email=? and password=?";
		$query = $this->db->query($sql,array($S_email,$S_password));
		return $query->row();
	}
	/**
	 * user register
	 */
	function user_register($array_data){
		return $this->db->insert('admin_user',$array_data);
	}

	/**
	 * user update
	 */
	function user_update($array_data,$email,$password){
		return $this->db->update('admin_user',$array_data,array('email'=>$email,'password'=>$password));
	}
	/**
	 * user login
	 */
	function user_login($email,$password,$rememberme){
		$sql = "select * from admin_user where email=?";
		$query = $this->db->query($sql,array($email));
		if($query->num_rows()>0){
			$row = $query->row_array();
			$new_ps = $this->dogwin_decrypt_password($row["password"],$password);
			if($row["password"]==$new_ps){
				$this->dogwin_set_session($email,$new_ps);
				if($rememberme){
					$this->dogwin_set_cookie($email,$password);
				}else{
					//
					delete_cookie("C_loginfo");
				}
				return TRUE;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	/**
	 * check login
	 */
	function check_login($email,$password){
		$sql = "select * from admin_user where email='$email' and password='$password'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//login check
	function isLogged(){
		$CookieFlag = $this->dogwin_get_cookie();
		$SessionFlag = $this->dogwin_check_session();
		if($CookieFlag||$SessionFlag){
			return true;
		}else{
			return false;
		}
	}
	//logout
	function logout(){
		return $this->session->sess_destroy();
	}
}
/*End the file auth_mdl.php*/
/*Location .application/models/auth_mdl.php*/