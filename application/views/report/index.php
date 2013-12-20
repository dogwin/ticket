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
    	<div class="center_control"><a href="<?php echo base_url('report/edit/0');?>" class="btn popup-with-zoom-anim">New Report Request</a><h2>Reports Requested</h2></div>
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
            <tr>
            	<td><a href="<?php echo base_url('report/open');?>" class="popup-with-zoom-anim">9191919</a></td>
                <td>Title Here</td>
                <td>21 August 2013</td>
                <td>2</td>
                <td>Y</td>
                <td><span class="icon_r"></span></td>
                <td>In Progress</td>
                <td>English</td>
            </tr>
            <tr>
            	<td><a href="<?php echo base_url('report/open');?>" class="popup-with-zoom-anim">9191919</a></td>
                <td>Title Here</td>
                <td>21 August 2013</td>
                <td>2</td>
                <td>Y</td>
                <td><span class="icon_r"></span></td>
                <td>In Progress</td>
                <td>English</td>
            </tr>
            <tr>
            	<td><a href="<?php echo base_url('report/open');?>" class="popup-with-zoom-anim">9191919</a></td>
                <td>Title Here</td>
                <td>21 August 2013</td>
                <td>2</td>
                <td>Y</td>
                <td><span class="icon_r"></span></td>
                <td>In Progress</td>
                <td>English</td>
            </tr>
            <tr>
            	<td><a href="<?php echo base_url('report/open');?>" class="popup-with-zoom-anim">9191919</a></td>
                <td>Title Here</td>
                <td>21 August 2013</td>
                <td>2</td>
                <td>Y</td>
                <td><span class="icon_r"></span></td>
                <td>In Progress</td>
                <td>English</td>
            </tr>
        </table>
        <div class="center_control"><a href="<?php echo base_url('report/exportnew');?>" class="popup-with-zoom-anim btn">Export to Excel</a></div>
    </div>
    <div class="r_main">
    	<div class="center_control"><h2>Reports for Download</h2></div>
        <table cellpadding="0" cellspacing="0" border="0" class="c_table">
        	<tr>
            	<th width="82">Ticket Number</th>
                <th>Title</th>
                <th>Request submitted <br />(date)</th>
                <th>Days remaining<br />(+/-days fm request)</th>
                <th>Additional requests <br />made? (Y/N)</th>
                <th>Reports</th>
            </tr>
            <tr>
            	<td>9191919</td>
                <td>Title Here</td>
                <td>21 August 2013</td>
                <td>2</td>
                <td>Y</td>
                <td><a href="#" class="btn">Download</a></td>
            </tr>
            <tr>
            	<td>9191919</td>
                <td>Title Here</td>
                <td>21 August 2013</td>
                <td>2</td>
                <td>Y</td>
                <td><a href="#" class="btn">Download</a></td>
            </tr>
            <tr>
            	<td>9191919</td>
                <td>Title Here</td>
                <td>21 August 2013</td>
                <td>2</td>
                <td>Y</td>
                <td><a href="#" class="btn">Download</a></td>
            </tr>
            <tr>
            	<td>9191919</td>
                <td>Title Here</td>
                <td>21 August 2013</td>
                <td>2</td>
                <td>Y</td>
                <td><a href="#" class="btn">Download</a></td>
            </tr>
        </table>
        <div class="center_control"><a href="<?php echo base_url('report/exportclose');?>" class="popup-with-zoom-anim btn">Export to Excel</a></div>
    </div>
</div>

<?php echo $footer;?>
<?php
/*End the file index.php*/
/*Location ./aaplication/views/report/index.php*/