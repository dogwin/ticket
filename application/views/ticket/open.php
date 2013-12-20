<div id="open_ticket" class="zoom-anim-dialog lft-dialog">
	<div class="lft-dialog-tit"><button class="mfp-close" type="button" title="Close (Esc)">×</button>Open Ticket</div>
    <div class="lft-dialog-body">
    	<div class="ld_website">
        	<h3>Website</h3>
            <table cellpadding="0" cellspacing="0" border="0">
            	<tr>
                	<td valign="top">Ticket Number:</td>
                    <td valign="top"><?php echo $ticketN;?></td>
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
        <form id="goliveForm" method="POST" enctype="multipart/form-data">
        <div class="ld_golivenow"><input type="button" value="Go Live Now" class="btn" onclick="location.href='<?php echo base_url('ticket/index?act=golive&ticketID='.$ticketID);?>'"/></div>
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
            <input type='hidden' name="ticketID" value='<?php echo $ticketID;?>' id='ticketID'>
        	<input type='hidden' name="userID" value='<?php echo $userID;?>' id='userID'>
            <div class="ld_comment_control"><input type="button" value="Submit" id="commentbt" class="btn" /></div>
        </div>
       
        </form>
        <?php echo $commentList;?>
        <!-- 
        <div class="ld_comment_list">
        	<div class="ld_comment_list_img"><img src="<?php echo base_url();?>images/default_img.jpg" alt=""  /></div>
            <div class="ld_comment_list_content">
            	<h5>Prentice Mathew <span>12/12/2012</span></h5>
                <p>Li European lingues es membres del sam familie. Lor seperat existntie<br />es un myth. Por scientie.</p>
                <div class="ld_comment_list_attach">
                	<h5>Attached Files</h5>
                    <a href="#" class="c01">test.jpg</a>
                    <a href="#" class="c01">test.pptx</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="ld_comment_list">
        	<div class="ld_comment_list_img"><img src="<?php echo base_url();?>images/default_img.jpg" alt=""  /></div>
            <div class="ld_comment_list_content">
            	<h5>Prentice Mathew <span>12/12/2012</span></h5>
                <p>Li European lingues es membres del sam familie. Lor seperat existntie<br />es un myth. Por scientie.</p>
            </div>
            <div class="clear"></div>
        </div>-->
        <div class="ld_control tc"><input type="button" value="Load more comments" class="btn" onclick="commentload(<?php echo $ticketID;?>)"/></div>
    </div>
</div>
<script>
$(document).ready(function(){
	$("#status").change(function(){
		var status = $(this).val();
		var ticketID = $("#ticketID").val();
		var staginglink = $("#staginglink").val();
		resetV(ticketID,status,staginglink);
	});
	$("#staginglink").blur(function(){
		var status = $(this).val();
		var ticketID = $("#ticketID").val();
		var staginglink = $("#staginglink").val();
		resetV(ticketID,status,staginglink);
	});
	//add comment
	$("#commentbt").live('click',function(){
		$("#goliveForm").attr('action','<?php echo base_url('post/comment')?>');
		var comment = $("#comment").val();
		if(comment.length<1){
			$("#errormsg").html('Comments');
		}else{
			$("#goliveForm").submit();
		}
		//
	});
});
function resetV(ticketID,status,staginglink){
	$.ajax({
		type:'POST',
		url:'<?php echo base_url('post/updateTicket');?>',
		cache:false,
		dataType:'json',
		data:{
			ticketID:ticketID,
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
function commentload(ticketID){
	  $.ajax({
		  type:'POST',
			url:'<?php echo base_url('post/loadComm');?>',
			cache:false,
			dataType:'json',
			data:{
				ticketID:ticketID,
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