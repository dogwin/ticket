<?php
/**
 * @author dogwin
 * @date 2013-12-17
 * @webSite http://dogwin.net
 */
?>
<div id="new_ticket" class="zoom-anim-dialog lft-dialog">
	<div class="lft-dialog-tit"><button class="mfp-close" type="button" title="Close (Esc)">×</button>New Ticket</div>
    <div class="lft-dialog-body">
    	<div class="ld_website">
        	<h3>Website</h3>
            <ul>
            	<li><input type="checkbox" />English</li>
                <li><input type="checkbox" />Germany</li>
                <li><input type="checkbox" />Singapore Sessions</li>
                <li><input type="checkbox" />Chinese</li>
                <li><input type="checkbox" />Japan</li>
                <li><input type="checkbox" />Made with Singapore</li>
            </ul>
            <div class="clear"></div>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="ld_table">
        	<tr>
            	<th>
                	Job task type<br />
                    <select class="ld_table_txt"><option>Simple change</option></select>
                </th>
                <td>
                	Urgent<br />
                    <p class="ld_table_urgent"><a href="javascript:uv(0);" class="uv" style="border-right:none;">Yes</a><a href="javascript:uv(1);">No</a></p>
                    <input type="hidden" value="" id="urgent_value" />
                </td>
            </tr>
            <tr>
            	<th>
                	Task Title<br />
                    <input type="text" placeholder="Enter text..." class="ld_table_txt" />
                </th>
                <td>
                	Status<br />
                    <select class="ld_table_txt" style="width:186px"><option>Open</option></select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                	Change Request Description<br />
                    <textarea  class="ld_table_txt" rows="6" placeholder="Enter text..."></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                	Link to current URL<br />
                    <input class="ld_table_txt" type="text" placeholder="http://lorem.ipsum.com/dolor.html" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                	Upload new content (Up to 5 files)<br />
                    <input class="ld_table_txt" type="file" />
                </td>
            </tr>
        </table>
        <div class="ld_p01">
        	<input type="radio" checked="checked" />Standard Turnaround
            <p>
            	Standard Turnaround<br />
                <span>(5 days from request submission)</span>
            </p>
        </div>
        <div class="ld_p02">
        	<input type="radio" />Or Choose Date
            <p>
            	<select class="ld_table_txt" style="width:120px"><option>01</option></select>&nbsp;&nbsp;
                <select class="ld_table_txt" style="width:120px"><option>January</option></select>&nbsp;&nbsp;
                <select class="ld_table_txt" style="width:120px"><option>2013</option></select>
            </p>
        </div>
        <div class="ld_info">
        	<h3>Live Alert / Notification</h3>
            <div class="ld_mail_list">
            	<p><input type="checkbox" /><a href="#">user02@client.com</a></p>
                <p><input type="checkbox" /><a href="#">user02@client.com</a></p>
                <p><input type="checkbox" /><a href="#">user02@client.com</a></p>
                <div class="clear"></div>
            </div>
            <h3>Add email address</h3>
            <p><input type="text" class="ld_table_txt" placeholder="enter text... " style="width:513px" /></p>
            <p><input type="button" value="+ Add another email" class="btn" /></p>
        </div>
        <div class="ld_control"><input type="button" value="Save" class="btn" /><input type="button" value="Cancel Ticket" class="btn" /></div>
    </div>
</div>
<?php
/*End the file edit.php*/
/*Location ./application/views/report/edit.php*/