<?php
/**
 * @author dogwin
 * @date 2013-12-18
 * @webSite http://dogwin.net
 */
?>
<?php echo $header;?>
<div id="center">
	<div class="main">
    	<div class="center_control">
    	<?php if($authLevel==1){?>
    	<a href="<?php echo base_url('report/edit/0');?>" class="btn popup-with-zoom-anim">New Report Request</a><h2>Reports Requested</h2>
    	<?php }?>
    	</div>
        <iframe id='openT' src="<?php echo base_url('report/navOpen');?>" width="100%" scrolling="no" frameborder="0"></iframe>
        <div class="center_control"><a href="<?php echo base_url('report/openexport');?>" class="btn">Export to Excel</a></div>
    </div>
    <div class="r_main">
    	<div class="center_control"><h2>Reports for Download</h2></div>
        <iframe id='closeT' src="<?php echo base_url('report/navClose');?>" width="100%" scrolling="no" frameborder="0"></iframe>
        <div class="center_control"><a href="<?php echo base_url('report/closeexport');?>" class="btn">Export to Excel</a></div>
    </div>
</div>
<div class="confirmation"><a class="popup-with-zoom-anim" id="confirm" href='<?php echo base_url('report/success/'.$_GET['reportID']);?>'></a></div>
<div class="golive"><a class="popup-with-zoom-anim" id="golive" href='<?php echo base_url('report/golive/'.$_GET['reportID']);?>'></a></div>
<script>
$(document).ready(function(){
	<?php if(isset($_GET['act'])){
			 if($_GET['act']=='success'){
				?>
				$("#confirm").click();
				<?php 
			 }else if($_GET['act']=='golive'){
			 	?>
			 	$("#golive").click();
			 	<?php
			 }
		   }
	?>
});
</script>
<?php echo $footer;?>
<?php
/*End the file index.php*/
/*Location ./aaplication/views/report/index.php*/