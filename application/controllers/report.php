<?php
/**
 * @author dogwin
 * @date 2013-12-18
 * @website http://dogwin.net
 */
class Report extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('file','url','cookie'));
		$this->load->library(array('session','parser','email','image_lib','phpmail','user_agent','pagination','calendar'));
		$this->load->model(array('auth_mdl','admin_mdl'));
	
		if($this->auth_mdl->dogwin_check_session()){
			$data['userInfo'] = $this->data['userInfo'] = $userInfo = $this->auth_mdl->getUserInfo();
			$data['name'] =$userInfo->firstName.".".$userInfo->lastName;
			//header
			$this->data['header'] = $this->load->view("global/header",$data,true);
			$this->data['footer'] = $this->load->view("global/footer",$data,true);
		}
	}
	function index(){
		$this->load->view('report/index',$this->data);
	}
	//edit ticket
	function edit(){
		$this->data['website'] = $this->admin_mdl->webSite();
		//job task type
		$this->data['JobTaskType'] = $this->admin_mdl->JobTaskType();
		//status
		$this->data['status'] = $this->admin_mdl->getStatus();
		$this->load->view('report/edit',$this->data);
	}
	function open(){
		$this->load->view('report/open',$this->data);
	}
	function exportnew(){
		$this->load->view('report/exportNew',$this->data);
	}
	function exportclose(){
		$this->load->view('report/exportClose',$this->data);
	}
}
/*End the file report.php*/
/*Location ./application/controllers/report.php*/