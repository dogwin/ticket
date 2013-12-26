<?php
/**
 * @author dogwin
 * @date 2013-12-17
 * @webSite http://dogwin.net
 */
?>

<div id="new_ticket" class="zoom-anim-dialog lft-dialog">
	<div class="lft-dialog-tit"><button class="mfp-close" type="button" title="Close (Esc)">×</button>New Ticket</div>
    <form id="myform" method="POST" enctype="multipart/form-data">
    <div class="lft-dialog-body">
    	<div class="ld_website">
        	<h3>Website</h3>
            <ul>
                <?php echo $website;?>
            </ul>
            <div class="clear"></div>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="ld_table">
        	<tr>
            	<th>
                	Job task type<br />
                    <?php echo $JobTaskType;?>
                </th>
                <td>
                	Urgent<br />
                    <p class="ld_table_urgent"><a href="javascript:uv(0);" class="uv" style="border-right:none;">Yes</a><a href="javascript:uv(1);">No</a></p>
                    <input type="hidden" name="urgent_value" value="0" id="urgent_value" />
                </td>
            </tr>
            <tr>
            	<th>
                	Task Title<br />
                    <input type="text" id="tasktitle" name="tasktitle" placeholder="Enter text..." class="ld_table_txt" />
                </th>
                <td>
                	Status<br />
                    <?php echo $status;?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                	Change Request Description<br />
                    <textarea id="changeRequestDescription" name="changeRequestDescription"  class="ld_table_txt" rows="6" placeholder="Enter text..."></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                	Link to current URL<br />
                    <input class="ld_table_txt" id="link" name="link" type="text" placeholder="http://lorem.ipsum.com/dolor.html" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                	Upload new content (Up to 5 files)<br />
                    <input class="ld_table_txt" name="file1" type="file" />
                    <input class="ld_table_txt" name="file2" type="file" />
                    <input class="ld_table_txt" name="file3" type="file" />
                    <input class="ld_table_txt" name="file4" type="file" />
                    <input class="ld_table_txt" name="file5" type="file" />
                </td>
            </tr>
        </table>
        <div class="ld_p01">
        	<input type="radio" name="datetype" checked="checked" value='0'/>Standard Turnaround
            <p>
            	Standard Turnaround<br />
                <span>(5 days from request submission)</span>
            </p>
        </div>
        <div class="ld_p02">
        	<input type="radio" name="datetype" value='1'/>Or Choose Date
            <p>
            	<input type="text" id="standard" name="standard"/>
            	<!-- 
            	<select class="ld_table_txt" style="width:120px"><option>01</option></select>&nbsp;&nbsp;
                <select class="ld_table_txt" style="width:120px"><option>January</option></select>&nbsp;&nbsp;
                <select class="ld_table_txt" style="width:120px"><option>2013</option></select>-->
            </p>
        </div>
        <div class="ld_info">
        	<h3>Live Alert / Notification</h3>
            <div class="ld_mail_list">
            	<p class='el' style='width:0px;height:0px;padding:0;margin:0;border:0px;'></p>
            	<?php echo $emaillist;?>
                <div class="clear"></div>
            </div>
            <h3>Add email address</h3>
            <p><input type="text" id="key" name="key" class="ld_table_txt" placeholder="enter text... " style="width:513px" /></p>
            <div id="errormsg"></div>
            <p><input type="button" value="+ Add another email" id="addemailbt" class="btn" /></p>
        </div>
        <input type='hidden' id="userID" name="userID" value="<?php echo $userID;?>">
        
        <div class="ld_control">
        <div id="msg"></div>
        <input type="button" value="Save" id="save" class="btn" /><input type="button" value="Cancel Ticket" class="btn" /></div>
    </div>
    </form>
</div>
<!--autocomplete begin  -->
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.menu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.js"></script>
<script>
$(document).ready(function(){
	$("#key").autocomplete({
		source: "<?php echo base_url();?>post/autocom",
		minLength: 1,
		autoFocus: true
	});
	var re = /\S+@\S+\.\S+/;
	$("#addemailbt").click(function(){
		var email = $("#key").val();
		var userID = $("#userID").val();
		var adminAdd = 1;
		if(!re.test(email)){
			$("#errormsg").html("Please input email.");
		}else{
			$.ajax({
				type:'POST',
				url:'<?php echo base_url('post/addemail');?>',
				cache:false,
				dataType:'json',
				data:{
					email:email,
					userID:userID,
					type:2,
					adminAdd:adminAdd
				},
				success:function(data){
					console.log(data);	
					if(data.flag){
						//location.href=data.url;
						//$(".ld_mail_list").html(data.emaillist+'<div class="clear"></div>');
						$(".ld_mail_list .el").last().after(data.emaillist);
						$("#key").val('');
					}else{
						//show error
						$("#errormsg").html(data.msg);
					}
				}
			});
		}
	});
	
	$("#save").live('click',function(){
		$("#myform").attr('action','<?php echo base_url('post/addTicket')?>');
		var website= '';
		$('input[class=website]:checked').each(function(){
			website+=$(this).val()+":";
		});
		console.log(website);
		var jobtasktype = $("#jobtasktype").val();
		var tasktitle = $("#tasktitle").val();
		var changeRequestDescription = $("#changeRequestDescription").val();
		var link = $("#link").val();
		var datetype = $('input[name=datetype]:checked').val();
		var standard = $("#standard").val();
		var maillist = '';
		$('input[class=emailList]:checked').each(function(){
			maillist+=$(this).val()+":";
		});
		if(website.length<1){
			$("#msg").html('Please select a website');
		}else if(tasktitle.length<1){
			$("#msg").html('Task Title is null');
		}else if(changeRequestDescription.length<1){
			$("#msg").html('Change Request Description is null');
		}else if(link.length<1){
			$("#msg").html('Link to current URL is null');
		}else if(datetype==1&&standard.length<1){
			$("#msg").html('Date is null');
		}else if(maillist.length<1){
			$("#msg").html('Please select email');
		}else{
			$("#myform").submit();
		}
	});
	/*
	$("#myform").submit(function(event){
		console.log(event);
		alert(event);
		event.preventDefault();
	});
	*/
});
</script>
<?php
/*End the file edit.php*/
/*Location ./application/views/report/edit.php*/