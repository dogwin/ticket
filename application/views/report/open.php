<div id="open_ticket" class="zoom-anim-dialog lft-dialog">
	<div class="lft-dialog-tit"><button class="mfp-close" type="button" title="Close (Esc)">×</button>Open Ticket</div>
    <div class="lft-dialog-body">
    	<div class="ld_website">
        	<h3>Website</h3>
            <table cellpadding="0" cellspacing="0" border="0">
            	<tr>
                	<td valign="top">Ticket Number:</td>
                    <td valign="top"><?php echo $reportN;?></td>
                </tr>
                <tr>
                	<th valign="top">Task Title:</th>
                    <td valign="top">
                    	<?php echo $taskTitle;?>
                    </td>
                </tr>
                	
                <tr>
                	<th valign="top">Change Request Description:</th>
                    <td valign="top">
                    	<?php echo $changeRequestDescription;?>
                    </td>
                </tr>
                
                <tr>
                	<th valign="top">Status</th>
                    <td valign="top"><?php echo $status;?></td>
                </tr>
                <tr>
                	<th valign="top">Link to current URL:</th>
                    <td valign="top"><a href="<?php echo $link;?>" target="_blank" class="c01"><?php echo $link;?></a></td>
                </tr>
            </table>
            
        </div>
        <div class="ld_link">Staging link <input type='text' id="staginglink" value="<?php echo $stagingLink;?>">
        <!-- 
        <a href="#" target="_blank" class="c01">http://www.test.com/testing.html</a>
        --></div>
        
        <div class="ld_golivenow">
        <?php echo $fileName;?>
        <form id="reportForm" method="POST" enctype="multipart/form-data">
        <input type='hidden' name="reportID" value='<?php echo $reportID;?>' id='reportID'>
        <input type='hidden' name="userID" value='<?php echo $userID;?>' id='userID'>
        <input type="file" name='file'/>
        <input type="button" id="reportbt" value="Upload Report" class="btn"/>
        </form>
        </div>
        
        <form id="goliveForm" method="POST" enctype="multipart/form-data">
        <h3 class="ld_tit">Changes/Comments/Feedback</h3>
        <div class="ld_comment">
        	<textarea  class="ld_comment_txt" id="comment" name="comment" rows="6" placeholder="Type here..."></textarea>
            <div class="ld_comment_attach">
            	<h5>Attach files</h5>
                <input type="file" name='file1'/>
                <input type="file" name='file2'/>
                <input type="file" name='file3'/>
                <input type="file" name='file4'/>
                <input type="file" name='file5'/>
            </div>
            <div id="errormsg"></div>
            <input type='hidden' name="reportID" value='<?php echo $reportID;?>' id='reportID'>
        	<input type='hidden' name="userID" value='<?php echo $userID;?>' id='userID'>
            <div class="ld_comment_control"><input type="button" value="Submit" id="commentbt" class="btn" /></div>
        </div>
       
        </form>
        <?php echo $commentList;?>
        <div class="ld_control tc"><input type="button" value="Load more comments" class="btn" onclick="commentload(<?php echo $reportID;?>)"/></div>
    </div>
</div>
<script>
$(document).ready(function(){
	$("#status").change(function(){
		var status = $(this).val();
		var reportID = $("#reportID").val();
		var staginglink = $("#staginglink").val();
		resetV(reportID,status,staginglink);
	});
	$("#staginglink").blur(function(){
		var status = $(this).val();
		var reportID = $("#reportID").val();
		var staginglink = $("#staginglink").val();
		resetV(reportID,status,staginglink);
	});
	//add comment
	$("#commentbt").live('click',function(){
		$("#goliveForm").attr('action','<?php echo base_url('post/reportcomment')?>');
		var comment = $("#comment").val();
		if(comment.length<1){
			$("#errormsg").html('Comments');
		}else{
			$("#goliveForm").submit();
		}
		//
	});
	//upload file
	$("#reportbt").live('click',function(){
		$("#reportForm").attr('action','<?php echo base_url('post/reportFile')?>');
		$("#reportForm").submit();
	});
});
function resetV(reportID,status,staginglink){
	$.ajax({
		type:'POST',
		url:'<?php echo base_url('post/updateReport');?>',
		cache:false,
		dataType:'json',
		data:{
			reportID:reportID,
			status:status,
			staginglink:staginglink
		},
		success:function(data){
			console.log(data);	
			/*
			if(data.flag){
			}else{
				//show error
				$("#errormsg").html(data.msg);
			}*/
		}
	});
}
var page =2;
function commentload(reportID){
	  $.ajax({
		  type:'POST',
			url:'<?php echo base_url('post/loadreportComm');?>',
			cache:false,
			dataType:'json',
			data:{
				reportID:reportID,
				page:page
			},
			beforeSend:function(){
				//alert(page);
			},
			success:function(data){
				console.log(data);
				$(".ld_comment_list").last().after(data.commlist);
			},
			complete:function(data){
				page++;
			}
	  });
}
</script>