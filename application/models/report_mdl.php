<?php
/**
 * @author dogwin
 * @date 2013-12-23
 * @website http://dogwin.net
 */
class Report_mdl extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	//Reports Requested
	function reports($userID,$page,$per_page){
		$reportList = "";
		//$sql = "select * from report where userID='$userID' and status!=6";
		$sql = "select * from report where status!=6  order by id desc limit $page,$per_page";
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
				$reportList.='<tr>
            	<td><a href="'.base_url('report/open/'.$row->id).'" class="popup-with-zoom-anim">'.$this->newID($row->id).'</a></td>
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
		return $reportList;
	}
	function reportAC(){
		$sql = "select * from report where status!=6";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	//Reports for Download
	function reportsClose($userID,$page,$per_page){
		$reportList = "";
		//$sql = "select * from report where userID='$userID' and status=6";
		$sql = "select * from report where status=6  order by id desc limit $page,$per_page";
		$query = $this->db->query($sql);
		if($query->num_rows()){
			foreach ($query->result() as $row){
				
				$d = date('j F Y',strtotime($row->finishDay));
				$c = ( strtotime($row->finishDay) - strtotime(date('Y-m-d')) )/(24*3600);
				if($row->file){
					$down = '<a href="'.base_url('post/reportdownload/'.$row->id).'" class="btn">Download</a>';
				}else{
					$down = '&nbsp';
				}
				$reportList.='<tr>
            	<td><a href="'.base_url('report/open/'.$row->id).'" class="popup-with-zoom-anim">'.$this->newID($row->id).'</a></td>
                <td>'.$row->taskTitle.'</td>
                <td>'.$d.'</td>
                <td>'.$c.'</td>
                <td>'.($row->Urgent==0?'Y':'N').'</td>
                <td>'.$down.'</td>
            </tr>';
			}
		}
		return $reportList;
	}
	function closereportAC(){
		$sql = "select * from report where status=6";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function newID($id){
		$idlen = strlen($id);
		if($idlen<5){
			$s = "00000";
			return substr($s,0,5-$idlen).$id;
		}else{return $id;}
	}
	function statusArr($key){
		$SArr = array(0=>'',1=>'Open',2=>'In progress',3=>'Internal Review',4=>'Client Review',5=>'Approved',6=>'Closed');
		return $SArr[$key];
	}
	//get info
	function getInfo($tb,$id){
		$sql = "select * from ".$tb." where id='".$id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function export($status=0){
		$sql = "select * from report";
	
		if($status==6){
			$sql.=" where status=6";
			$exportlist="Ticket Number,Title,Request submitted (date),Days remaining (+/-days fm request),Additional requests made? (Y/N)\n";
			$filename = 'Closed Reports '.date('Y-m-d').".csv";
		}else{
			$sql.=" where status!=6";
			$exportlist = "Ticket Number,Title,Request submitted (date),Days remaining(+\/-days fm request),Additional requests made? (Y\/N),Escalate/Add request,Status,Website\n";
			$filename = 'Open Reports '.date('Y-m-d').".csv";
		}
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
				if($status==6){
					$exportlist.=$this->newID($row->id).",".$row->taskTitle.",".$d.",".$c.",".($row->Urgent==0?'Y':'N')."\n";
				}else{
					$exportlist.=$this->newID($row->id).",".$row->taskTitle.",".$d.",".$c.",".($row->Urgent==0?'Y':'N').",Y,".$this->statusArr($row->status).",".$weblist."\n";
				}
			}
		}
		$this->export_csv($filename,$exportlist);
	}
	function export_csv($filename,$data) {
		//header("Content-Type: application/ms-download;charset=GB2312");
		header("Content-type:text/csv");
		header("Content-Disposition:attachment;filename=".$filename);
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		header('Expires:0');
		header('Pragma:public');
		echo $data;
	}
}
/*End the file report_mdl.php*/
/*Location ./application/models/report_mdl.php*/