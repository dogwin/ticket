<?php echo $header;?>
<div id="center">
	<div class="main">
    	<div class="center_control"><a href="<?php echo base_url("ticket/edit/0");?>" class="btn popup-with-zoom-anim">New Request</a><h2>Open Tickets</h2></div>
        <table cellpadding="0" cellspacing="0" border="0" class="c_table">
        	<tr>
            	<th width="82">Ticket Number</th>
                <th>Title</th>
                <th>Request submitted <br />(date)</th>
                <th>Days remaining<br />(+/-days fm request)</th>
                <th>Additional requests <br />made? (Y/N)</th>
                <th>Escalate/Add <br />request</th>
                <th width="120">Status</th>
                <th width="223">Website</th>
            </tr>
            <?php echo $ticketList;?>
            <!-- 
            <tr>
            	<td><a href="<?php echo base_url('ticket/open/');?>" class="popup-with-zoom-anim">9191919</a></td>
                <td>Title Here</td>
                <td>21 August 2013</td>
                <td>2</td>
                <td>Y</td>
                <td><span class="icon_r"></span></td>
                <td>In Progress</td>
                <td>English</td>
            </tr>-->
        </table>
        <div class="center_control"><a href="<?php echo base_url('ticket/openexport');?>" class="btn">Export to Excel</a></div>
    </div>
    <div class="c_main">
    	<div class="center_control"><h2>Closed Ticket</h2></div>
        <table cellpadding="0" cellspacing="0" border="0" class="c_table">
        	<tr>
            	<th width="82">Ticket Number</th>
                <th>Title</th>
                <th>Request submitted <br />(date)</th>
                <th>Days remaining<br />(+/-days fm request)</th>
                <th>Additional requests <br />made? (Y/N)</th>
            </tr>
            <?php echo $closeTicketList;?>
        </table>
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
<?php echo $footer;?>