<?php echo $header;?>
<!-- 
<div class="main">
<p>Lorem Ipsum</p>
<p>First Name	<input type="text" value="<?php echo $firstName;?>" id="firstName"><p>
<p>Last Name	<input type="text" value="<?php echo $lastName;?>" id="lastName"><p>
<p>Email Address	<input type="text" value="<?php echo $email;?>" id="email" <?php echo $userID?"disabled":""?>></p>
<p>Phone Number		<input type="text" value="<?php echo $phone;?>" id="phone"></p>
<p>password		<input type="password" id="password"></p>
<p>repet password		<input type="password" id="repassword"></p>
<p><?php echo $role;?></p>
<input type="hidden" id="userID" value="<?php echo $userID;?>"/>
<p><input type="button" value="Save" id="userEdit"></p>
<div id="errormsg"></div>
</div>
-->
<div id="peason">
	<h1><?php echo $firstName;?> <?php echo $lastName;?></h1>
    <div class="peason_info">
    	<ul>
        	<li>First Name<br /><input type="text" class="ld_table_txt" value="<?php echo $firstName;?>" id="firstName"/></li>
            <li>Last Name<br /><input type="text" class="ld_table_txt" value="<?php echo $lastName;?>" id="lastName"/></li>
        </ul>
        <p class="clear"></p>
    </div>
    <div class="peason_info">
    	<ul>
        	<li>Email Address<br /><input type="text" class="ld_table_txt" value="<?php echo $email;?>" id="email" <?php echo $userID?"disabled":""?>/></li>
            <li>Phone Number<br /><input type="text" class="ld_table_txt" value="<?php echo $phone;?>" id="phone"/></li>
        </ul>
        <p class="clear"></p>
        <ul>
            <li>Password<br /><input type="password" class="ld_table_txt" id="password"/></li>
            <li>Repet password<br /><input type="password" class="ld_table_txt" id="repassword"/></li>
        </ul>
        <p class="clear"></p>
        
        <input type="hidden" id="userID" value="<?php echo $userID;?>"/>
        
    </div>
    <div class="peason_info">
    	<?php if($userID!=1){?>
        <p><?php echo $role;?></p>
        <?php }?>
        <?php if($userID&&$userID!=1){?>
        <div class="ld_info">
        	<h3>Live Alert / Notification</h3>
            <div class="ld_mail_list">
            	<?php echo $emaillist;?>
            	<!-- 
            	<p><input type="checkbox" /><a href="#">user02@client.com</a></p>
                <p><input type="checkbox" /><a href="#">user02@client.com</a></p>
                <p><input type="checkbox" /><a href="#">user02@client.com</a></p>-->
                <div class="clear"></div>
            </div>
            <h3>Add email address</h3>
            <p><input type="text" class="ld_table_txt" id="key" name="key" placeholder="enter text... " style="width:513px" /></p>
            <div id="errormsg"></div>
            <p><input type="button" value="+ Add another email" id="addemailbt" class="btn" /></p>
        </div>
        <?php }?>
    </div>
    <div><input type="button" class="btn" value="Save" id="userEdit"/></div>
    <div id="errormsg"></div>
</div>
<!--autocomplete begin  -->
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.menu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.js"></script>
	
<script src="<?php echo base_url();?>dogwinjs/auth" type="text/javascript" language="php"></script>
<script>
//autocomplete
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
					type:1
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
});
function emailDel(ueID,thisid){
	$.ajax({
		type:'POST',
		url:'<?php echo base_url('post/delemail');?>',
		cache:false,
		dataType:'json',
		data:{
			ueID:ueID
		},
		success:function(data){
			console.log(data);	
			if(data.flag){
				//location.href=data.url;
				$(thisid).parent().remove();
			}else{
				//show error
				$("#errormsg").html(data.msg);
			}
		}
	});
	
}
</script>
<?php echo $footer;?>
