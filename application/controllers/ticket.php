<?php
/**
 * @author Dogwin
 * @date 2013-12-05
 * @website http://dogwin.net
 */
class Ticket extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('file','url','cookie'));
		$this->load->library(array('session','parser','email','image_lib','phpmail','user_agent','pagination','calendar'));
		$this->load->model(array('auth_mdl','admin_mdl'));
		
		if($this->auth_mdl->dogwin_check_session()){
			$data['userInfo'] = $this->data['userInfo'] = $userInfo = $this->auth_mdl->getUserInfo();
			$data['name'] =$userInfo->firstName.".".$userInfo->lastName;
			//header
			$data['roleName'] = $this->admin_mdl->RoleName($userInfo->authLevel);
			$this->data['header'] = $this->load->view("global/header",$data,true);
			$this->data['footer'] = $this->load->view("global/footer",$data,true);
		}
	}
	//new ticket
	function index(){
		$this->loggin();
		//ticket list
		$this->data['authLevel'] =  $this->data['userInfo']->authLevel;
		$this->data['ticketList'] = $this->admin_mdl->tickets($this->data['userInfo']->id);
		$this->data['closeTicketList'] = $this->admin_mdl->ticketsClose($this->data['userInfo']->id);
		$this->load->view("index",$this->data);
	}
	//edit ticket
	function edit(){
		$this->data['website'] = $this->admin_mdl->webSite();
		//job task type
		$this->data['JobTaskType'] = $this->admin_mdl->JobTaskType();
		//status
		$this->data['status'] = $this->admin_mdl->getStatus();
		//email list
		$this->data['emaillist'] = $this->admin_mdl->vemailList($this->data['userInfo']->id,0);
		//echo $this->data['emaillist'];
		$this->data['userID'] = $this->data['userInfo']->id;
		$this->load->view('ticket/edit',$this->data);
	}
	function open(){
		$this->data['ticketID'] = $ticketID = $this->uri->segment(3,0);
		$ticketInfo = $this->admin_mdl->getInfo('ticket',$ticketID);
		$this->data['ticketN'] = $this->admin_mdl->newID($ticketID);
		$this->data['taskTitle'] = $ticketInfo->taskTitle;
		$this->data['changeRequestDescription'] = $ticketInfo->changeRequestDescription;
		$this->data['link'] = $ticketInfo->link;
		$this->data['status'] = $this->admin_mdl->getStatus($ticketInfo->status);
		$this->data['stagingLink'] = $ticketInfo->stagingLink;
		$this->data['userID'] = $this->data['userInfo']->id;
		//comment list 5
		$this->data['commentList'] = $this->admin_mdl->commentlist($ticketID,5);
		$this->data['authLevel'] =  $this->data['userInfo']->authLevel;
		$this->load->view('ticket/open',$this->data);
	}
	//go to live 
	function golive(){
		$this->data['userID'] = $this->data['userInfo']->id;
		$this->data['ticketID'] = $ticketID = $this->uri->segment(3,0);
		$ticketInfo = $this->admin_mdl->getInfo('ticket',$ticketID);
		$this->data['emaillist'] = $this->admin_mdl->vemailList($this->data['userInfo']->id,0);
		
		$this->load->view('ticket/golive',$this->data);
		
	}
	function exportnew(){
		$this->load->view('ticket/exportNew',$this->data);
	}
	//
	function success(){
		$ticketID = $this->uri->segment(3,0);
		$this->data['ticketN'] = $this->admin_mdl->newID($ticketID);
		$ticketInfo = $this->admin_mdl->getInfo('ticket',$ticketID);
		$finishDayArr = explode('-',$ticketInfo->finishDay);
		$this->data['newDay'] = $finishDayArr[2]."/".$finishDayArr[1]."/".$finishDayArr[0];
		$this->data['title'] = $ticketInfo->taskTitle;
		$this->load->view('ticket/success',$this->data);
	}
	function openexport(){
		$this->admin_mdl->export();
	}
	function closeexport(){
		$this->admin_mdl->export(6);
	}
	function exportclose(){
		$this->load->view('ticket/exportClose',$this->data);
	}
	//report
	function report(){
		$this->loggin();
	}
		
	//user login
	function login(){
		$userLog = $this->auth_mdl->get_cookie();
		$this->data['email'] = $userLog['email'];
		$this->data['password'] = $userLog['password'];
		$this->data['rm'] = $this->data['email']?"checked":"";
		$this->load->view('auth/login',$this->data);
	}
	function loggin(){
		if(!$this->auth_mdl->dogwin_check_session()){
			header('location:'.base_url("ticket/login"));
			exit();
		}
	}
	function logout(){
		if($this->auth_mdl->logout()){
			
		}
		header("Location:".base_url("ticket/login"));
	}
}