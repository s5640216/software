<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="20%">店名名稱</th>
				<th width="10%">描述</th>
				<th width="10%">操作</th>
			</tr>
		</thead>
		<tbody>
			<? if($stores->num_rows() > 0): ?>
				<? foreach($stores->result() as $store): ?>
					<tr data-store_id="<?=$store->store_id;?>">
						<td><?=$store->name;?></td>
						<td><?=$store->describe;?></td>
						<td>
							<button type="button" class="btnShowProduct btn btn-primary btn-xs">檢視</button>
							<?if($this->session->userdata('purview') == PURVIEW_ADMIN):?>
								<button type="button" class="btn btn-warning btn-xs">修改</button>
								<button type="button" class="btnDelStore btn btn-danger btn-xs">刪除</button>
							<?endif;?>
						</td>
					</tr>
				<? endforeach; ?>
			<? else: ?>
				<tr>
					<td colspan="3">尚未有店家資訊</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</div>

<script>
	$('.btnDelStore').click(function(){
		var store_id = $(this).parent().parent().attr('data-store_id');
		confirm_alert('是否刪除此店家', function(e){
			if(e){
				$.ajax({
					url: '<?=base_url()?>store/store/del_store_info',
					type: 'POST',
					data:{
						store_id: store_id
					},
					dataType: 'json',
					success: function (res) {
						if(res.status == 'success'){
							$('.btnsearchstore').click();
							success_toast(null, res.message);
						} else {
							error_toast(null, res.message);
						}
					}
				});
			}
		})
	})
	
	$('.btnShowProduct').click(function(){
		var store_id = $(this).parent().parent().attr('data-store_id');
		window.location.href = base_url() + 'store/store/store_product/' + store_id;
	})
</script>
