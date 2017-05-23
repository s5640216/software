<div class="modal fade" id="add_store_info_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">新增店家</h4>
			</div>
			<div class="modal-body" id="add_store_form">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label">地址</label>
						<div class="col-sm-10 sel_address form-inline">
							<select class="sel_city form-control">
								<option>請選擇</option>
							</select>
							<select class="sel_area form-control">
								<option>請選擇</option>
							</select>
						</div>
					</div>
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
				<button type="button" class="btnAddStoreInfo btn btn-primary">新增</button>
			</div>
		</div>
	</div>
</div>

<script>
	$('#add_store_info_modal .btnAddStoreInfo').click(function(){
		var city_id = $('#add_store_info_modal .sel_city').find(':selected').attr('data-city_id');
		var area_id = $('#add_store_info_modal .sel_area').find(':selected').attr('data-area_id');
		var store_name = $('#add_store_info_modal .store_name').val();
		var store_describe = $('#add_store_info_modal .store_describe').val();
		if(city_id == null){
			warning_toast(null, "請選擇城市");
			return;
		}
		if(area_id == null){
			warning_toast(null, "請選擇區域");
			return;
		}
		if(store_name == ''){
			warning_toast(null, "請輸入店家名稱");
			return;
		}
		if(store_describe == ''){
			warning_toast(null, "請輸入店家描述");
			return;
		}
		$.ajax({
			url: '<?=base_url()?>store/store/add_store_info',
			type: 'POST',
			data:{
				city_id: city_id,
				area_id: area_id,
				store_name: store_name,
				store_describe: store_describe
			},
			dataType: 'json',
			success: function (res) {
				if(res.status == 'success'){
					$('#add_store_info_modal').modal('hide');
					$('.btnsearchstore').click();
					success_toast(null, res.message);
				} else {
					error_toast(null, res.message);
				}
			}
		});
	})
</script>