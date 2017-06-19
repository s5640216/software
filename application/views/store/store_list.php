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
						<td class="storename"><?=$store->name;?></td>
						<td class="storedescribe"><?=$store->describe;?></td>
						<td>
							<button type="button" class="btnShowProduct btn btn-primary btn-xs">檢視</button>
							<?if($this->session->userdata('purview') == PURVIEW_ADMIN):?>
								<button type="button" class="btnModifyStore_modal btn btn-warning btn-xs"  data-toggle="modal" data-target="#modify_store_info_modal">修改</button>
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

<div class="modal fade" id="modify_store_info_modal" tabindex="-1" role="dialog" data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">修改店家</h4>
			</div>
			<div class="modal-body" id="modify_store_form">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label">店家名稱</label>
						<div class="col-sm-10">
							<input type="text" class="store_name form-control" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">店家描述</label>
						<div class="col-sm-10">
							<textarea class="store_describe form-control" rows="3"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				<button type="button" data-dismiss="modal" class="btnModifyStore btn btn-primary" >修改</button>
			</div>
		</div>
	</div>
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
	
	$('.btnModifyStore_modal').click(function(){
		var store_id = $(this).parent().parent().attr('data-store_id');
		var store_name = $(this).parent().parent().find('.storename').html();
		var store_describe = $(this).parent().parent().find('.storedescribe').html();
		$('#modify_store_form .store_name').val(store_name);
		$('#modify_store_form .store_describe').val(store_describe);
		$('#modify_store_info_modal .btnModifyStore').attr('data-store_id', store_id);
		
	})
	
	$('.btnModifyStore').click(function(){
		var store_id = $(this).attr('data-store_id');
		var store_name = $('#modify_store_form .store_name').val();
		var store_describe = $('#modify_store_form .store_describe').val();
		$.ajax({
			url: '<?=base_url()?>store/store/modify_store_info',
			type: 'POST',
			data:{
				store_id: store_id,
				store_name: store_name,
				store_describe: store_describe
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
	})
</script>
