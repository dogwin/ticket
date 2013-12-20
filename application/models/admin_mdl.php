<?php
/**
 * @author dogwin
 * @date 2013-12-16
 * @webSite http://dogwin.net
 */
class Admin_mdl extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function userList($limit='10'){
		$userList = '';
		$sql = "select * from admin_user limit ".$limit;
		$query = $this->db->query($sql);
		
		if($query->num_rows()){
			foreach ($query->result() as $row){
				$userList.='<li><a class="name" href=\''.base_url('admin/userEdit/'.$row->id).'\'>'.$row->firstName.' '.$row->lastName.'</a><a href=\''.base_url('admin/userEdit/'.$row->id).'\'>'.$row->email.'</a></li>';
				//$userList.='<li class="useritem"><i>'.$this->authLevel($row->authLevel).'</i><i><a href=\''.base_url('admin/userEdit/'.$row->id).'\'>'.$row->firstName.' '.$row->lastName.'</a></i><i>'.$row->email.'</i></li>';
			}
		}
		return $userList;
	}
	function pageUserList($offset,$pagesize){
		$userList = '';
		$sql = "select * from admin_user limit $offset,$pagesize";
		$query = $this->db->query($sql);
		if($query->num_rows()){
			foreach ($query->result() as $row){
				$userList.='<li><a class="name" href=\''.base_url('admin/userEdit/'.$row->id).'\'>'.$row->firstName.' '.$row->lastName.'</a><a href=\''.base_url('admin/userEdit/'.$row->id).'\'>'.$row->email.'</a></li>';
			}
		}
		return $userList;
	}
	//comment
	function pageCommList($ticketID,$offset,$pagesize){
		$commentlist = "";
		$sql = "select * from ticketComment where ticketID='$ticketID' order by id DESC limit $offset,$pagesize";
		
		$query = $this->db->query($sql);
		if($query->num_rows()){
			foreach ($query->result() as $row){
				$userInfo = $this->getInfo('admin_user',$row->userID);
		
				$commentlist.='<div class="ld_comment_list">
		        	<div class="ld_comment_list_img"><img src="'.base_url().'images/default_img.jpg" alt=""  /></div>
		            <div class="ld_comment_list_content">
		            	<h5>'.$userInfo->firstName.' '.$userInfo->lastName.' <span>'.date('d/m/Y',$row->date).'</span></h5>
		                <p>'.$row->comment.'</p>
		                '.$this->attachedFiles($row->id).'
		            </div>
		            <div class="clear"></div>
		        </div>';
			}
				
		}
		return $commentlist;
	}
	
	function usercount(){
		$sql = "select * from admin_user";
		$query = $this->db->query($sql);
		return count($query->result());
	}
	//get info
	function getInfo($tb,$id){
		$sql = "select * from ".$tb." where id='".$id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	//role List
	function roleSelect($RoleID='1'){
		$roleSelect = "<select id='role' name='role'>";
		$array = array(
				'1'=>'Client',
				'2'=>'Agency',
				'3'=>'Developer'
				);
		foreach ($array as $key=>$value ){
			if($key==$RoleID){
				$slt = "selected";
			}else{
				$slt = "";
			}
			$roleSelect.="<option value='".$key."' ".$slt.">".$value."</option>";
		}
		$roleSelect.="</select>";
		return $roleSelect;
	}
	//email exist
	function checkEmail($email){
		$sql = "select * from admin_user where email='$email'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	//authLevel
	function authLevel($key){
		$Arr = array(0=>'',1=>'Client',2=>'Agency',3=>'Developer');
		return $Arr[$key];
	}
	//webSite
	function webSite($keyArr=array(1)){
		$webSite = "<ul class='website'>";
		$sql = "select * from website order by show_orders ASC";
		$query = $this->db->query($sql);
		foreach ($query->result() as $row){
			if(in_array($row->id,$keyArr)){
				$ck = 'checked';
			}else{
				$ck = "";
			}
			$webSite.="<li class='websiteitem'><input type='checkbox' class='website' name='website[]' value='".$row->id."' ".$ck."> ".$row->name."</li>";
		}
		$webSite.="</ul>";
		return $webSite;
	}
	//Job task type
	function JobTaskType($jobID=0){
		$JobType = "<select name='jobtasktype' class='ld_table_txt' id='jobtasktype'>";
		$data = array(1=>'Simple change',2=>'EDM request',3=>'Others');
		foreach ($data as $key=>$v){
			if($jobID==$key){
				$slt = "selected";
			}else{
				$slt = '';
			}
			$JobType.="<option value='".$key."' ".$slt.">".$v."</option>";
		}
		$JobType.="</select>";
		return $JobType;
	}
	//
	function getStatus($sID=1){
		$status = "<select name='status' id='status' class='ld_table_txt'>";
		$data = array(1=>'Open',2=>'In progress',3=>'Internal Review',4=>'Client Review',5=>'Approved',6=>'Closed');
		foreach ($data as $key=>$v){
			if($sID==$key){
				$slt = "selected";
			}else{
				$slt = '';
			}
			$status.="<option value='".$key."' ".$slt.">".$v."</option>";
		}
		$status.="</select>";
		return $status;
	}
	//email list
	function vemailList($userID,$ticketID=''){
		$emailList = "";
		$sql = "select * from userEmail where userID='$userID' and ";//ticketID in (0,$ticketID))";
		if($ticketID){
			$sql.="ticketID in (0,$ticketID))";
		}else{
			$sql.= "ticketID = 0";
		}
		$query = $this->db->query($sql);
		if($query->num_rows()){
			foreach ($query->result() as $row){
				$emailList .= '<p><input type="checkbox" class="emailList" name="emailList[]" value="'.$row->id.'"><a href="#">'.$row->email.'</a></p>';
			}
		}
		return $emailList;
	}
	
	function emailList($userID,$ticketID=''){
		$emailList = "";
		$sql = "select * from userEmail where userID='$userID' and ";//ticketID in (0,$ticketID))";
		if($ticketID){
			$sql.="ticketID in (0,$ticketID))";
		}else{
			$sql.= "ticketID = 0";
		}
		$query = $this->db->query($sql);
		if($query->num_rows()){
			foreach ($query->result() as $row){
				$emailList .= '<p><i onclick="emailDel('.$row->id.',this)">X</i><a href="#">'.$row->email.'</a></p>';
			}
		}
		return $emailList;
	}
	function autocom($key){
		$RSS = array();
		$sql = "select * from admin_user where authLevel>1 and email like '$key%'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			foreach ($query->result() as $row){
				array_push($RSS,$row->email);
			}
			return json_encode($RSS);
		}
	}
	//admin_user
	function emailExist($mail){
		$sql = "select * from admin_user where email='$mail' and authLevel>1";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function inUseremail($email,$userID){
		$sql = "select * from userEmail where email='$email' and userID='$userID'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	//
	function tickets($userID){
		$ticketList = "";
		$sql = "select * from ticket where userID='$userID' and status!=6";
		$query = $this->db->query($sql);
		if($query->num_rows()){
			foreach ($query->result() as $row){
				$d = date('j F Y',strtotime($row->finishDay));
				$c = ( strtotime($row->finishDay) - strtotime(date('Y-m-d')) )/(24*3600);
				$webArr = explode(":",$row->website);
				//print_r($webArr);
				$weblist = '';
				foreach ($webArr as $webID){
					$weblist.=$this->getInfo('website',$webID)->name." ";
				}
				$ticketList.='<tr>
            	<td><a href="'.base_url('ticket/open/'.$row->id).'" class="popup-with-zoom-anim">'.$this->newID($row->id).'</a></td>
                <td>'.$row->taskTitle.'</td>
                <td>'.$d.'</td>
                <td>'.$c.'</td>
                <td>'.($row->Urgent==0?'Y':'N').'</td>
                <td><span class="icon_r"></span></td>
                <td>'.$this->statusArr($row->status).'</td>
                <td>'.$weblist.'</td>
            </tr>';
			}
		}
		return $ticketList;
	}
	function ticketsClose($userID){
		$ticketList = "";
		$sql = "select * from ticket where userID='$userID' and status=6";
		$query = $this->db->query($sql);
		if($query->num_rows()){
			foreach ($query->result() as $row){
				$d = date('j F Y',strtotime($row->finishDay));
				$c = ( strtotime($row->finishDay) - strtotime(date('Y-m-d')) )/(24*3600);
				$ticketList.='<tr>
            	<td>'.$this->newID($row->id).'</td>
                <td>'.$row->taskTitle.'</td>
                <td>'.$d.'</td>
                <td>'.$c.'</td>
                <td>'.($row->Urgent==0?'Y':'N').'</td>
            </tr>';
			}
		}
		return $ticketList;
	}
	function newID($id){
		$idlen = strlen($id);
		if($idlen<5){
			$s = "00000";
			return substr($s,0,5-$idlen).$id;
		}else{return $id;}
	}
	function statusArr($key){
		$SArr = array(1=>'Open',2=>'In progress',3=>'Internal Review',4=>'Client Review',5=>'Approved',6=>'Closed');
		return $SArr[$key];
	}
	//comment 
	function commentlist($ticketID,$limit){
		$commentlist = '';
		$sql = "select * from ticketComment where ticketID='$ticketID' order by id DESC limit $limit";
		$query = $this->db->query($sql);
		if($query->num_rows()){
			foreach ($query->result() as $row){
				$userInfo = $this->getInfo('admin_user',$row->userID);
				
				$commentlist.='<div class="ld_comment_list">
		        	<div class="ld_comment_list_img"><img src="'.base_url().'images/default_img.jpg" alt=""  /></div>
		            <div class="ld_comment_list_content">
		            	<h5>'.$userInfo->firstName.' '.$userInfo->lastName.' <span>'.date('d/m/Y',$row->date).'</span></h5>
		                <p>'.$row->comment.'</p>
		                '.$this->attachedFiles($row->id).'
		            </div>
		            <div class="clear"></div>
		        </div>';
			}
			
		}
		return $commentlist;
	}
	function attachedFiles($comID){
		$attachedFiles = '';
		$sql = "select * from uploads where commentID = '$comID'";
		$query = $this->db->query($sql);
		if($query->num_rows()){
			$attachedFiles.='<div class="ld_comment_list_attach"><h5>Attached Files</h5>';
			foreach ($query->result() as $row){
				$fileArr = explode('file/',$row->fileName);
				$attachedFiles.='<a href="'.base_url('post/download/'.$row->id).'" class="c01" >'.$fileArr[1].'</a>';
			}
			$attachedFiles.='</div>';
		}
		return $attachedFiles;
	}
	//
	function commcount($ticketID){
		$sql = "select * from ticketComment where ticketID = '$ticketID'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	/**
	 * base db function
	 */
	
	function update($tb,$updata,$where){
		return $this->db->update($tb,$updata,$where);
	}
	function insert($tb,$insertdata){
		return $this->db->insert($tb,$insertdata);
	}
	function RinsertID($tb,$insertdata){
		$this->db->insert($tb,$insertdata);
		return $this->db->insert_id();
	}
	function delete($tb,$where){
		return $this->db->delete($tb,$where);
	}
	function insertID($tb,$insertdata){
		$this->db->insert($tb,$insertdata);
		return $this->db->insert_id();
	}
	//base db function end
} 