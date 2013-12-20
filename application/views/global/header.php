<?php
/**
 * @author dogwin
 * @date 2013-12-16
 * @webSite http://dogwin.net
 */
?>
<!-- 
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/style.css">
	<script type="text/javascript" src='<?php echo base_url("js/jquery-1.10.2.min.js");?>'></script>
</head>
<body>
<ul>
	<li><a href='<?php echo base_url('ticket');?>'>New ticket</a><li>
	<li><a href='<?php echo base_url('report'); ?>'>Report Downloads</a><li>
	<li><a href='<?php echo base_url('admin');?>'>User Management</a><li>
</ul>
<div>
<p>welcome <?php echo $name;?><p>
<p><a href='<?php echo base_url("ticket/logout")?>'>Logout</a></p>
</div>
<div class="clear"></div>-->
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
<link type="text/css" href="<?php echo base_url();?>css/magnific-popup.css" rel="stylesheet" />
<link href="<?php echo base_url();?>css/jquery.ui.autocomplete.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='<?php echo base_url();?>js/jquery/jquery.min.js?ver=1.8.3'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/web.js?ver=1.0'></script>
<script src="<?php echo base_url();?>js/jquery.magnific-popup.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	
	$('.popup-with-zoom-anim').magnificPopup({
        type: 'ajax',
 
        fixedContentPos: true,
        fixedBgPos: true,
 
        overflowY: 'auto',
 
        closeBtnInside: true,
        preloader: false,
         
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
});
function uv(i)
{
	$(".ld_table_urgent a").removeClass("uv"); 
   	$(".ld_table_urgent a").eq(i).addClass("uv");
	$("#urgent_value").val(i);
}
</script>
</head>
<body>
<div id="header">
	<div class="main">
    	<div id="logo"><a href="<?php if($userInfo->id==1){ echo "#";}else{ echo base_url('ticket');}?>"><img src="<?php echo base_url();?>images/logo.jpg" alt="logo" width="106" height="54" /></a></div>
        <div id="menu">
        	<ul>
            	<li><a href="<?php if($userInfo->id==1){ echo "#";}else{  echo base_url('report');}?>">Report Downloads</a></li>
                <li><a href="<?php echo base_url('admin');?>">User Management</a></li>
            </ul>
        </div>
        <div id="h_login">
        	<div id="defalut_img"><!-- <a href="#"><img src="images/default_img.jpg" alt="" /></a>--></div>
            <div id="h_login_txt">
            	<p>Welcome <a href="#"><?php echo $name;?></a></p>
                <p><input type="button" class="btn" value="Logout" onclick="location.href='<?php echo base_url("ticket/logout")?>'"/></p>
            </div>
        </div>
    </div>
</div>
<?php 
/*End the file header.php*/
/*Location ./application/views/global/header.php*/