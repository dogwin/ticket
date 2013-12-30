$(document).ready(function(){
	var re = /\S+@\S+\.\S+/;
	$("#loginbt").click(function(){
		$("#errormsg").html('');
		var email = $("#email").val();
		var password = $("#password").val();
		var rememberme = $("#rememberme").is(':checked') ? 1 : 0;
		//console.log(email+"=="+password+"=="+rememberme);
		
		if(!re.test(email)){
			$("#errormsg").html('Not an email.');
		}else if(password.length<6){
			$("#errormsg").html('Password at leaset 6.');
		}else{
			$.ajax({
				type:'POST',
					url:'<?php echo base_url('post/login');?>',
					cache:false,
					dataType:'json',
					data:{
						email:email,
						password:password,
						rememberme:rememberme
					},
					success:function(data){
						console.log(data);	
						if(data.flag){
							location.href=data.url;
						}else{
							//show error
							$("#errormsg").html("Username or password incorrect.");
						}
					}
			});
		}
	});
	
	$("body").keydown(function(e){
		if (e.keyCode == "13"){
			$("#loginbt").click();
		}
	});
	//user edit
	$("#userEdit").click(function(){
		var userID = $("#userID").val();
		
		var firstName = $("#firstName").val();
		var lastName = $("#lastName").val();
		var email = $("#email").val();
		console.log(email);
		var phone = $("#phone").val();
		var password = $("#password").val();
		var repassword = $("#repassword").val();
		var role = $("#role").val();
		
		$("#errormsg").html('');
		if(userID>0){
			//update
			if(firstName.length<1){
				$("#errormsg").html('Please enter a first name.');
			}else if(lastName.length<1){
				$("#errormsg").html('Please enter a last name.');
			}else if(!re.test(email)){
				$("#errormsg").html('Please enter a valid email address.');
			}else if(phone.length<1){
				$("#errormsg").html('Please enter a valid phone number.');
			}else if(password.length>0&&password.length<6){
					$("#errormsg").html('Please enter a password.');
			}else if(password!=repassword){
					$("#errormsg").html('The passwords you have entered don\'t match.');
			}else{
				Ido(userID,firstName,lastName,email,phone,password,role);
			}
		}else{
			if(firstName.length<1){
				$("#errormsg").html('Please enter a first name.');
			}else if(lastName.length<1){
				$("#errormsg").html('Please enter a last name');
			}else if(!re.test(email)){
				$("#errormsg").html('Please enter a valid email address.');
			}else if(phone.length<1){
				$("#errormsg").html('Please enter a valid phone number.');
			}else if(password.length<6){
				$("#errormsg").html('Please enter a password.');
			}else if(password!=repassword){
				$("#errormsg").html('The passwords you have entered don\'t match.');
			}else{
				Ido(userID,firstName,lastName,email,phone,password,role);
			}
		}
		
	});
	function Ido(userID,firstName,lastName,email,phone,password,role){
		$.ajax({
			type:'POST',
			url:'<?php echo base_url('post/userEdit');?>',
			cache:false,
			dataType:'json',
			data:{
				userID:userID,
				firstName:firstName,
				lastName:lastName,
				email:email,
				password:password,
				phone:phone,
				role:role
			},
			success:function(data){
				console.log(data);	
				if(data.flag){
					location.href=data.url;
				}else{
					//show error
					$("#errormsg").html(data.msg);
				}
			}
		});
	}
});
function userAdd(userID){
	location.href='<?php echo base_url('admin/userEdit')?>'+"/"+userID;
}