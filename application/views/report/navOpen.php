<link type="text/css" href="<?php echo base_url();?>css/style.css" rel="stylesheet" />
<script type='text/javascript' src='<?php echo base_url();?>js/jquery/jquery.min.js?ver=1.8.3'></script>
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
            <?php echo $reportList;?>
        </table>
        <?php echo $navOpen;?>
<script>
$(document).ready(function(){
	$("#openT", parent.document.body).height($("table").height()+30);
	//console.log();
});

</script> 