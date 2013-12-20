<?php echo $header;?>
<!-- 
<div class="main">
<p><input type="button" value="Add" id="userAdd" onclick='userAdd(0)'></p>
<ul class="user">
	<?php echo $userList;?>
</ul>
</div>
-->
<div id="user">
	<input type="button" class="btn" value="Add" id="userAdd" onclick='userAdd(0)'/>
	<div id="user_tit"><a href="#"><span>NAME</span></a>EMAIL</div>
    <ul id="userList">
    	<?php echo $userList;?>
    </ul>
    <input type='hidden' id="loaduser" value=''>
    <div><input type="button" class="btn_loadmore" value="Load more" onclick='loaddata()'/></div>
</div>
<script src="<?php echo base_url();?>dogwinjs/auth" type="text/javascript" language="php"></script>
<script type="text/javascript">
var page = 2;
function loaddata(){
	  $.ajax({
		  type:'POST',
			url:'<?php echo base_url('admin/loaduser');?>',
			cache:false,
			dataType:'json',
			data:{
				page:page,
			},
			beforeSend:function(){
				//alert(page);
			},
			success:function(data){
				console.log(data);
				$('#userList li').last().after(data.userlist);
			},
			complete:function(data){
				page++;
			}
	  });
  }
</script>
<?php echo $footer;?>