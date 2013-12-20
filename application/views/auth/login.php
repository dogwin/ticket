<?php
/**
 * @author dogwin
 * @date 2013-12-16
 * @webSite http://dogwin.net
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Echo Ticketing</title>
<meta name="keywords" content="Echo Ticketing" />
<meta name="description" content="Echo Ticketing" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=10" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link type="text/css" href="<?php echo base_url();?>css/style.css" rel="stylesheet" />
<script type='text/javascript' src='<?php echo base_url();?>js/jquery/jquery.min.js?ver=1.8.3'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/web.js?ver=1.0'></script>
</head>
<body>
<div id="login">
<h2>Please log in to continue.</h2>
<p><input type="text" class="txt_login" id="email" placeholder="Username" value='<?php echo $email;?>'/></p>
<p><input type="password" class="txt_login" id='password' placeholder="Password" value='<?php echo $password;?>'/></p>
<p><input type="checkbox" class="checkbox_login" value='1' id='rememberme' <?php echo $rm;?> />Remember me on this computer<input type="button" class="btn_login" value="Login" id='loginbt'/></p>
<p><i id="errormsg"></i></p>
</div>
<script src="<?php echo base_url();?>dogwinjs/auth" type="text/javascript" language="php"></script>
</body>
</html>
<?php 
/*End the file login.php*/
/*Location ./application/views/auth/login.php*/