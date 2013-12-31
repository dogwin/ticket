<?php echo $header;?>
<div id="center">
	<div class="main">
    	<div class="center_control">
    	<?php if($authLevel==1){?>
    	<a href="<?php echo base_url("ticket/edit/0");?>" class="btn popup-with-zoom-anim">New Request</a><h2>Open Tickets</h2>
    	<?php }?>
    	</div>
    	<iframe id='openT' src="<?php echo base_url('ticket/navOpen');?>" width="100%" scrolling="no" frameborder="0"></iframe>
    	
        <div class="center_control"><a href="<?php echo base_url('ticket/openexport');?>" class="btn">Export to Excel</a></div>
    </div>
    <div class="c_main">
    	<div class="center_control"><h2>Closed Ticket</h2></div>
    	<iframe id='closeT' src="<?php echo base_url('ticket/navClose');?>" width="100%" scrolling="no" frameborder="0"></iframe>
       
        <div class="center_control"><a href="<?php echo base_url('ticket/closeexport');?>" class="btn">Export to Excel</a></div>
    </div>
</div>
<div class="confirmation"><a class="popup-with-zoom-anim" id="confirm" href='<?php echo base_url('ticket/success/'.$_GET['ticketID']);?>'></a></div>
<div class="golive"><a class="popup-with-zoom-anim" id="golive" href='<?php echo base_url('ticket/golive/'.$_GET['ticketID']);?>'></a></div>
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
<script language="javascript" type="text/javascript">
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
<?php echo $footer;?>
