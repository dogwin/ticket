<?php
/**
 * @author dogwin
 * @date 2013-12-16
 * @webSite http://dogwin.net
 */
class Post extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('file','url','cookie'));
		$this->load->library(array('session','parser','email','image_lib','phpmail','user_agent','pagination','calendar'));
		$this->load->model(array('auth_mdl','admin_mdl'));
	}
	function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$rememberme = $this->input->post('rememberme');
		//$array = array('email'=>$email,'ps'=>$password,'rm'=>$rememberme);
		
		if($this->auth_mdl->user_login($email,$password,$rememberme)){
			$array = array('flag'=>true,'url'=>base_url('ticket/index'));
		}else{
			$array = array('flag'=>false);
		}
		echo json_encode($array);
	}
	//user edit 
	function userEdit(){
		$adminUserInfo = $this->auth_mdl->getUserInfo();
		$userID = $this->input->post('userID');
		
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$phone = $this->input->post('phone');
		$role = $this->input->post('role');
		/*
		$array = array(
				'uid'=>$userID,
				'em'=>$email,
				'ps'=>$password,
				'fn'=>$firstName,
				'ln'=>$lastName,
				'ph'=>$phone,
				'role'=>$role
				);
		*/
		
		if($userID==0){
			//insert
			$ps = $this->auth_mdl->dogwin_encrypt_password($password);
			$data = array('firstName'=>$firstName,'lastName'=>$lastName,'phone'=>$phone,'email'=>$email,'password'=>$ps,'date'=>time());
			if($adminUserInfo->authLevel=='0'){
				$data['authLevel'] = $role;
			}
			if($this->admin_mdl->checkEmail($email)){
				$array = array('flag'=>false,'msg'=>'Email exist.');
			}else{
				if($this->admin_mdl->insert('admin_user',$data)){
					$array = array('flag'=>true,'url'=>base_url('admin'));
				}else{
					$array = array('flag'=>false,'msg'=>'Insert failed.');
				}
			}
			
			
		}else{
			$data = array('firstName'=>$firstName,'lastName'=>$lastName,'phone'=>$phone);
			if($password){
				$data['password'] = $this->auth_mdl->dogwin_encrypt_password($password);
			}
			if($adminUserInfo->authLevel=='0'){
				$data['authLevel'] = $role;
			}
			if($userID==1){
				$data['authLevel'] = 0;
			}
			//update
			if($this->admin_mdl->update('admin_user',$data,array('id'=>$userID))){
				$array = array('flag'=>true,'url'=>base_url('admin'));
			}else{
				$array = array('flag'=>false,'msg'=>'Update failed.');
			}
			
		}
		echo json_encode($array);
	}
	//autocomplete
	function autocom(){
		$key = strtolower($_GET["term"]);//$this->uri->segment(3);
		echo $this->admin_mdl->autocom($key);
	}
	function addTicket(){
		$userID = $_POST['userID'];
		$website = implode(":",$_POST['website']);
		$jobtasktype = $_POST['jobtasktype'];
		$urgent_value = $_POST['urgent_value'];
		$tasktitle = $_POST['tasktitle'];
		$status = $_POST['status'];
		$changeRequestDescription = $_POST['changeRequestDescription'];
		$link = $_POST['link'];
		$datetype = $_POST['datetype'];
		$standard = $_POST['standard'];
		$emailList = $_POST['emailList'];
		if($datetype==0){
			//today + 5
			$finishDay = date('Y-m-d',(time()+(5*24*3600)));
		}else if($datetype==1){
			$finishDay = $standard;
		}
		
		$ticketData = array(
				'userID'=>$userID,
				'website'=>$website,
				'jobTastType'=>$jobtasktype,
				'Urgent'=>$urgent_value,
				'taskTitle'=>$tasktitle,
				'status'=>$status,
				'changeRequestDescription'=>$changeRequestDescription,
				'link'=>$link,
				'finishDay'=>$finishDay,
				'date'=>time()
				);
		$newTicketID = $this->admin_mdl->insertID('ticket',$ticketData);
		//print_r($ticketData);
		//file upload
		if($newTicketID){
			for($i=1;$i<=5;$i++){
				$upload_file=$_FILES['file'.$i]['tmp_name'];
				$upload_file_name=$_FILES['file'.$i]['name'];
				if($upload_file_name){
					//uploads
					$fileN = $this->do_upload($upload_file,$upload_file_name,$i);
					$fileData = array(
							'ticketID'=>$newTicketID,
							'fileName'=>$fileN,
							'date'=>time()
					);
					$this->admin_mdl->insert('uploads',$fileData);
				}
			}
			//email
			for($j=0;$j<count($emailList);$j++){
				//echo $emailList[$j]."<br>";
				$emailData = array(
						'ticketID'=>$newTicketID,
						'ueID'=>$emailList[$j],
						'date'=>time()
						);
				$this->admin_mdl->insert('ticketEmail',$emailData);
			}
			//get to success page
			header("location:".base_url('ticket/index?act=success&ticketID='.$newTicketID));
			exit();
		}else{
			//return alert error msg
			header("location:".base_url('ticket/index?act=failed'));
			exit();
		}
	}
	function addReport(){
		$userID = $_POST['userID'];
		$website = implode(":",$_POST['website']);
		$jobtasktype = $_POST['jobtasktype'];
		$urgent_value = $_POST['urgent_value'];
		$tasktitle = $_POST['tasktitle'];
		$status = $_POST['status'];
		$changeRequestDescription = $_POST['changeRequestDescription'];
		$link = $_POST['link'];
		$datetype = $_POST['datetype'];
		$standard = $_POST['standard'];
		$emailList = $_POST['emailList'];
		if($datetype==0){
			//today + 5
			$finishDay = date('Y-m-d',(time()+(5*24*3600)));
		}else if($datetype==1){
			$finishDay = $standard;
		}
		
		$ticketData = array(
				'userID'=>$userID,
				'website'=>$website,
				'jobTastType'=>$jobtasktype,
				'Urgent'=>$urgent_value,
				'taskTitle'=>$tasktitle,
				'status'=>$status,
				'changeRequestDescription'=>$changeRequestDescription,
				'link'=>$link,
				'finishDay'=>$finishDay,
				'date'=>time()
		);
		$newReportID = $this->admin_mdl->insertID('report',$ticketData);
		//print_r($ticketData);
		//file upload
		if($newReportID){
			for($i=1;$i<=5;$i++){
				$upload_file=$_FILES['file'.$i]['tmp_name'];
				$upload_file_name=$_FILES['file'.$i]['name'];
				if($upload_file_name){
					//uploads
					$fileN = $this->do_upload($upload_file,$upload_file_name,$i);
					$fileData = array(
							'reportID'=>$newReportID,
							'fileName'=>$fileN,
							'date'=>time()
					);
					$this->admin_mdl->insert('reportuploads',$fileData);
				}
			}
			//email
			for($j=0;$j<count($emailList);$j++){
				//echo $emailList[$j]."<br>";
				$emailData = array(
						'reportID'=>$newReportID,
						'ueID'=>$emailList[$j],
						'date'=>time()
				);
				$this->admin_mdl->insert('reportEmail',$emailData);
			}
			//get to success page
			header("location:".base_url('report/index?act=success&reportID='.$newReportID));
			exit();
		}else{
			//return alert error msg
			header("location:".base_url('report/index?act=failed'));
			exit();
		}
	}
	function do_upload($uploadFileName,$file_name,$key){
		$extension = $this->get_extension($file_name);
		list($usec, $new_name) = explode(" ", microtime());
		$newFileName = 'upload/file/'.$new_name.$key.".".$extension;
		if($uploadFileName){
			move_uploaded_file($uploadFileName,$newFileName);
			return $newFileName;
		}
	}
	function updateTicket(){
		$ticketID = $this->input->post('ticketID');
		$status = $this->input->post('status');
		$staginglink = $this->input->post('staginglink');
		if($this->admin_mdl->update('ticket',array('status'=>$status,'staginglink'=>$staginglink),array('id'=>$ticketID))){
			$array = array('flag'=>true);
		}else{
			$array = array('flag'=>true,'msg'=>'Faild');
		}
		echo json_encode($array);
	}
	//report
	function updateReport(){
		$reportID = $this->input->post('reportID');
		$status = $this->input->post('status');
		$staginglink = $this->input->post('staginglink');
		if($this->admin_mdl->update('report',array('status'=>$status,'staginglink'=>$staginglink),array('id'=>$reportID))){
			$array = array('flag'=>true);
		}else{
			$array = array('flag'=>true,'msg'=>'Faild');
		}
		echo json_encode($array);
	}
	//comment
	function comment(){
		//print_r($_POST);
		$userID = $_POST['userID'];
		$ticketID = $_POST['ticketID'];
		$comment = $_POST['comment'];
		$data = array(
				'ticketID'=>$ticketID,
				'userID'=>$userID,
				'comment'=>$comment,
				'date'=>time()
				);
		$commentID = $this->admin_mdl->RinsertID('ticketComment',$data);
		if($commentID){
			
			for($i=1;$i<=5;$i++){
				$upload_file=$_FILES['file'.$i]['tmp_name'];
				$upload_file_name=$_FILES['file'.$i]['name'];
				if($upload_file_name){
					//uploads
					$fileN = $this->do_upload($upload_file,$upload_file_name,$i);
					$fileData = array(
							'commentID'=>$commentID,
							'fileName'=>$fileN,
							'date'=>time()
					);
					$this->admin_mdl->insert('uploads',$fileData);
				}
			}
			//go to ticket index
			header("location:".base_url('ticket/index'));
			exit();
		}else{
			//go to ticket index
			header("location:".base_url('ticket/index'));
			exit();
		}
		
	}
	function reportcomment(){
		//print_r($_POST);
		$userID = $_POST['userID'];
		$reportID = $_POST['reportID'];
		$comment = $_POST['comment'];
		$data = array(
				'reportID'=>$reportID,
				'userID'=>$userID,
				'comment'=>$comment,
				'date'=>time()
		);
		$commentID = $this->admin_mdl->RinsertID('reportComment',$data);
		if($commentID){
				
			for($i=1;$i<=5;$i++){
				$upload_file=$_FILES['file'.$i]['tmp_name'];
				$upload_file_name=$_FILES['file'.$i]['name'];
				if($upload_file_name){
					//uploads
					$fileN = $this->do_upload($upload_file,$upload_file_name,$i);
					$fileData = array(
							'commentID'=>$commentID,
							'fileName'=>$fileN,
							'date'=>time()
					);
					$this->admin_mdl->insert('reportuploads',$fileData);
				}
			}
			//go to ticket index
			header("location:".base_url('report/index'));
			exit();
		}else{
			//go to ticket index
			header("location:".base_url('report/index'));
			exit();
		}
	
	}
	function reportFile(){
		$reportID = $_POST['reportID'];
		$upload_file=$_FILES['file']['tmp_name'];
		$upload_file_name=$_FILES['file']['name'];
		if($upload_file_name){
			//uploads
			$fileN = $this->do_upload($upload_file,$upload_file_name,0);
			if($this->admin_mdl->update('report',array('file'=>$fileN),array('id'=>$reportID))){
				header("location:".base_url('report/index'));
				exit();
			}else{
				header("location:".base_url('report/index'));
				exit();
			}
		}else{
			header("location:".base_url('report/index'));
			exit();
		}
	}
	function download(){
		$id = $this->uri->segment(3,1);
		$info = $this->admin_mdl->getInfo('uploads',$id);
		$file = base_url().$info->fileName;
		$fileNArr = explode('file/',$info->fileName);
		//$array = array('info'=>$this->classics_mdl->getInfo('dw_classics',$id));
		//echo json_encode($array);
		//$filename = $info->bookName;
		header("Content-type: application/x-file-to-save");
		header("Content-Disposition: attachment; filename=".$fileNArr[1]);//.basename($file));
		readfile($file);
	}
	function reportdownload(){
		$id = $this->uri->segment(3,1);
		$info = $this->admin_mdl->getInfo('report',$id);
		$file = base_url().$info->file;
		$fileNArr = explode('file/',$info->file);
		//$array = array('info'=>$this->classics_mdl->getInfo('dw_classics',$id));
		//echo json_encode($array);
		//$filename = $info->bookName;
		header("Content-type: application/x-file-to-save");
		header("Content-Disposition: attachment; filename=".$fileNArr[1]);//.basename($file));
		readfile($file);
	}
	function get_extension($file){
		return end(explode('.', $file));
	}
	//add Email
	function addemail(){
		$email = $this->input->post('email');
		$userID = $this->input->post('userID');
		$type = $this->input->post('type');
		//check exist in admin_user
		if($this->admin_mdl->emailExist($email)){
			//add again
			if($this->admin_mdl->inUseremail($email,$userID)){
				//exist
				$array = array('flag'=>false,'msg'=>'The email you added before.');
			}else{
				//insert
				$data = array('userID'=>$userID,'ticketID'=>0,'email'=>$email,'date'=>time());
				if($this->admin_mdl->insert('userEmail',$data)){
					if($type==1){
						$emaillist = $this->admin_mdl->emailList($userID);
					}else{
						$emaillist = $this->admin_mdl->vemailList($userID);
					}
					$array = array('flag'=>true,'url'=>base_url('admin'),'emaillist'=>$emaillist);
				}else{
					$array = array('flag'=>false,'msg'=>'Error in add');
				}
			}
		}else{
			$array = array('flag'=>false,'msg'=>'Email is not exist');
		}
		echo json_encode($array);
	}
	
	//delete email
	function delemail(){
		$ueID = $this->input->post('ueID');
		if($this->admin_mdl->delete('userEmail',array('id'=>$ueID))){
			$array = array('flag'=>true);
		}else{
			$array = array('flag'=>false,'msg'=>'Delete error');
		}
		echo json_encode($array);
	}
	//load comment
	function loadComm(){
		$ticketID = $this->input->post('ticketID');
		$page = $this->input->post('page');
		$numrows = $this->admin_mdl->commcount($ticketID);
		$pagesize = 5;
		$pages=intval($numrows/$pagesize);
		$offset = ($page-1)*$pagesize;
		$commlist = $this->admin_mdl->pageCommList($ticketID,$offset,$pagesize);
		$array = array('commlist'=>$commlist);
		echo json_encode($array);
	}
	//load report comment
	function loadreportComm(){
		$reportID = $this->input->post('reportID');
		$page = $this->input->post('page');
		$numrows = $this->admin_mdl->commcount($reportID);
		$pagesize = 5;
		$pages=intval($numrows/$pagesize);
		$offset = ($page-1)*$pagesize;
		$commlist = $this->admin_mdl->pagereportCommList($reportID,$offset,$pagesize);
		$array = array('commlist'=>$commlist);
		echo json_encode($array);
	}
}
/*End the file post.php*/
/*Location ./application/controllers/post.php*/