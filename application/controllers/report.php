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
		$this->load->model(array('auth_mdl','admin_mdl','report_mdl'));
	
		if($this->auth_mdl->dogwin_check_session()){
			$data['userInfo'] = $this->data['userInfo'] = $userInfo = $this->auth_mdl->getUserInfo();
			$data['name'] =$userInfo->firstName.".".$userInfo->lastName;
			//header
			$this->data['header'] = $this->load->view("global/header",$data,true);
			$this->data['footer'] = $this->load->view("global/footer",$data,true);
		}
	}
	function index(){
		$this->loggin();
		$this->data['reportList'] = $this->report_mdl->reports($this->data['userInfo']->id);
		$this->data['closereportList'] = $this->report_mdl->reportsClose($this->data['userInfo']->id);
		$this->load->view('report/index',$this->data);
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
		$this->load->view('report/edit',$this->data);
	}
	//
	function success(){
		$ticketID = $this->uri->segment(3,0);
		$this->data['reportN'] = $this->admin_mdl->newID($ticketID);
		$reportInfo = $this->admin_mdl->getInfo('report',$ticketID);
		$finishDayArr = explode('-',$reportInfo->finishDay);
		$this->data['newDay'] = $finishDayArr[2]."/".$finishDayArr[1]."/".$finishDayArr[0];
		$this->data['title'] = $reportInfo->taskTitle;
		$this->load->view('report/success',$this->data);
	}
	function open(){
		$this->data['reportID'] = $reportID = $this->uri->segment(3,0);
		$reportInfo = $this->admin_mdl->getInfo('report',$reportID);
		$this->data['reportN'] = $this->admin_mdl->newID($reportID);
		$this->data['taskTitle'] = $reportInfo->taskTitle;
		$this->data['changeRequestDescription'] = $reportInfo->changeRequestDescription;
		$this->data['link'] = $reportInfo->link;
		$this->data['status'] = $this->admin_mdl->getStatus($reportInfo->status);
		$this->data['stagingLink'] = $reportInfo->stagingLink;
		if($reportInfo->file){
			$fileArr = explode('file/',$reportInfo->file);
			$this->data['fileName'] = '<a href="'.base_url('post/reportdownload/'.$this->data['reportID']).'" class="c01" >'.$fileArr[1].'</a>';
		}else{
			$this->data['fileName'] = '';
		}
		
		
		$this->data['userID'] = $this->data['userInfo']->id;
		//comment list 5
		$this->data['commentList'] = $this->admin_mdl->reportcommentlist($reportID,5);
		$this->load->view('report/open',$this->data);
	}
	function golive(){
		$this->data['userID'] = $this->data['userInfo']->id;
		$this->data['reportID'] = $reportID = $this->uri->segment(3,0);
		$reportInfo = $this->admin_mdl->getInfo('report',$reportID);
		$this->data['emaillist'] = $this->admin_mdl->vemailList($this->data['userInfo']->id,0);
		$this->load->view('report/golive',$this->data);
	}
	
	function openexport(){
		$this->report_mdl->export();
	}
	function closeexport(){
		$this->report_mdl->export(6);
	}
	
	function exportnew(){
		$this->load->view('report/exportNew',$this->data);
	}
	function exportclose(){
		$this->load->view('report/exportClose',$this->data);
	}
	
	function loggin(){
		if(!$this->auth_mdl->dogwin_check_session()){
			header('location:'.base_url("ticket/login"));
			exit();
		}
	}
}
/*End the file report.php*/
/*Location ./application/controllers/report.php*/