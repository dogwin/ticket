<div id="live_auth" class="zoom-anim-dialog lft-dialog">
	<div class="lft-dialog-tit"><button class="mfp-close" type="button" title="Close (Esc)">×</button>Live Authorisation for Version 1.2</div>
    <div class="lft-dialog-body">
    	<div class="ld_auth_enter">
    		<h3>Enter Client Authorisation ID</h3>
            <p><input type="text" class="ld_table_txt" style="width:275px" name='postcode' id="postcode"/></p>
            <div id='postmsg'></div>
        </div>
        <div class="ld_info">
        	<h3>Live Alert / Notification</h3>
            <div class="ld_mail_list">
            	<p class='el'><input type="checkbox" class="emailList" checked disabled><?php echo $createrEM;?></p>
            	<?php echo $emaillist;?>
                <div class="clear"></div>
            </div>
            <h3>Add email address</h3>
            <p><input type="text" id="key" name="key" class="ld_table_txt" placeholder="enter text... " style="width:513px" /></p>
            <div id="errormsg"></div>
            <p><input type="button" value="+ Add another email" id="addemailbt" class="btn" /></p>
        </div>
        <div class="ld_golivenow ld_auth_mt"><input type="button" value="Go Live Now" id='golivenow'  class="btn" /></div>
        <input type='hidden' id="userID" name="userID" value="<?php echo $userID;?>">
        <input type='hidden' id="ticketID" name="ticketID" value="<?php echo $ticketID;?>">
    </div>
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
					type:2
				},
				success:function(data){
					console.log(data);	
					if(data.flag){
						//location.href=data.url;
						$(".ld_mail_list").html(data.emaillist+'<div class="clear"></div>');
						$("#key").val('');
					}else{
						//show error
						$("#errormsg").html(data.msg);
					}
				}
			});
		}
	});
	$("#golivenow").click(function(){
		var ticketID = $("#ticketID").val();
		var userID = $("#userID").val();
		var postcode = $("#postcode").val();
		var eml = '';
		$('input[class=emailList]:checked').each(function(){
			eml+=$(this).val()+":";
		});
		if(postcode.length<1){
			$("#postmsg").html('Enter Client Authorisation ID');
		}else{
			$.ajax({
				type:'POST',
				url:'<?php echo base_url('post/golive');?>',
				cache:false,
				dataType:'json',
				data:{
					userID:userID,
					ticketID:ticketID,
					postcode:postcode,
					eml:eml
				},
				success:function(data){
					console.log(data);	
					if(data.flag){
						location.href=data.url;
					}else{
						//show error
						$("#postmsg").html(data.msg);
					}
				}
			});
		}
	});
});
</script>