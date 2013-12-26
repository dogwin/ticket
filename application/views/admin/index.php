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
	<div id="user_tit"><a href="#" data-id='<?php echo $orderData;?>' id="nameOrder"><span>NAME</span></a>EMAIL</div>
    <ul id="userList">
    	<?php echo $userList;?>
    </ul>
    <input type='hidden' id="loaduser" value=''>
    <div><input type="button" class="btn_loadmore" value="Load more" onclick='loaddata("<?php echo $orderData;?>")'/></div>
</div>
<script src="<?php echo base_url();?>dogwinjs/auth" type="text/javascript" language="php"></script>
<script type="text/javascript">
	$("#nameOrder").live('click',function(){
		var orderData = $(this).attr('data-id');
		console.log(orderData);
		if(orderData=='ASC'){
			$(this).attr('data-id','DESC');
		}else{
			$(this).attr('data-id','ASC');
		}
		location.href="<?php echo base_url('admin/index');?>"+"/"+$(this).attr('data-id');
	});
var page = 2;
function loaddata(orderData){
	//var orderData = $('#nameOrder').attr('data-id');
	  $.ajax({
		  type:'POST',
			url:'<?php echo base_url('admin/loaduser');?>',
			cache:false,
			dataType:'json',
			data:{
				page:page,
				orderData:orderData
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
  function delUser(id){
	  var orderData = $('#nameOrder').attr('data-id');
	  if(confirm("Are you sure to delete this account?")){
		  $.ajax({
			  type:'POST',
				url:'<?php echo base_url('admin/delUser');?>',
				cache:false,
				dataType:'json',
				data:{
					id:id,
					orderData:orderData
				},
				beforeSend:function(){
					//alert(page);
				},
				success:function(data){
					console.log(data);
					if(data.flag){
						//locaction.href=data.url;
					}else{
						alert(data.msg);
					}
				}
		  });
	  }
	   
  }
</script>
<?php echo $footer;?>