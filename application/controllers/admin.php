<?php
/**
 * @author dogwin
 * @date 2013-12-16
 * @webSite http://dogwin.net
 */
class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('file','url','cookie'));
		$this->load->library(array('session','parser','email','image_lib','phpmail','user_agent','pagination','calendar'));
		$this->load->model(array('auth_mdl','admin_mdl'));
	
		if($this->auth_mdl->dogwin_check_session()){
			$data['userInfo'] = $this->data['userInfo'] = $userInfo = $this->auth_mdl->getUserInfo();
			$data['name'] =$userInfo->firstName.".".$userInfo->lastName;
			//header
			
			$this->data['header'] = $this->load->view("global/header",$data);
			$this->data['footer'] = $this->load->view("global/footer");
			$this->data['roleName'] = array(1=>'Client',2=>'Agency',3=>'Developer');
		}
	}
	
	//user management
	function index(){
		$this->loggin();
		$userInfo = $this->auth_mdl->getUserInfo();
		/*
		 * 0 admin
		* 1 client
		* 2 agency
		* 3 developer
		*/
		if($userInfo->authLevel==0){
			//admin pannel
			//user list
			$this->data['userList'] = $this->admin_mdl->userList(10);
				
			$this->load->view("admin/index",$this->data);
		}else{
			//own pannel
			$this->data['userID'] = $userInfo->id;
			$this->data['firstName'] = $userInfo->firstName;
			$this->data['lastName'] = $userInfo->lastName;
			$this->data['email'] = $userInfo->email;
			$this->data['phone'] = $userInfo->phone;
			$this->data['role'] = $this->data['roleName'][$userInfo->authLevel];
			$this->data['emaillist'] = $this->admin_mdl->emailList($this->data['userID'],0);
			$this->load->view('admin/edit',$this->data);
		}
	}
	//user edit 
	function userEdit(){
		$this->loggin();
		$adminUserInfo = $this->auth_mdl->getUserInfo();
		$this->data['userID'] = $userID = $this->uri->segment(3,0);
		
		if($userID){
			//update
			$userInfo = $this->admin_mdl->getInfo('admin_user',$userID);
			$this->data['firstName'] = $userInfo->firstName;
			$this->data['lastName'] = $userInfo->lastName;
			$this->data['email'] = $userInfo->email;
			$this->data['phone'] = $userInfo->phone;
			
			if($adminUserInfo->authLevel==0){
				$this->data['role'] = $this->admin_mdl->roleSelect($userInfo->authLevel);
			}else{
				$this->data['role'] = $this->data['roleName'][$userInfo->authLevel];
			}
			
		}else{
			//insert
			$this->data['firstName'] = '';
			$this->data['lastName'] = '';
			$this->data['email'] = '';
			$this->data['phone'] = '';
			if($adminUserInfo->authLevel==0){
				$this->data['role'] = $this->admin_mdl->roleSelect();
			}else{
				$this->data['role'] = '';
			}
		}
		$this->data['emaillist'] = $this->admin_mdl->emailList($userID,0);
		
		$this->load->view('admin/edit',$this->data);
	}
	function loaduser(){
		$page = $this->input->post('page');
		$numrows = $this->admin_mdl->usercount();
		$pagesize = 10;
		$pages=intval($numrows/$pagesize);
		$offset = ($page-1)*$pagesize;
		$userlist = $this->admin_mdl->pageUserList($offset,$pagesize);
		$array = array('userlist'=>$userlist);
		echo json_encode($array);
	}
	function loggin(){
		if(!$this->auth_mdl->dogwin_check_session()){
			header('location:'.base_url("ticket/login"));
			exit();
		}
	}
}
/*End the file admin.php*/
/*Location ./application/controllers/admin.php*/