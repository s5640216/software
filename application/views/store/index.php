<br>
<div class="container">
	<div class="row">
		<p>控制器 controllers\store\Store.php修改，function為 index</p>
		<p>頁面載入 views\store\index.php修改</p>
		<div class="panel panel-primary">
			<div class="panel-heading">
				店家資訊
			</div>
			<div class="panel-body">
				<div class="col-xs-12">
					<div class="form-inline">
						<div class="form-group">
							<label>篩選</label>
							<div class="sel_address">
								<select class="sel_city form-control">
									<option>請選擇</option>
								</select>
								<select class="sel_area form-control">
									<option>請選擇</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="ajax_content"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(function () {
		// _load_store_list();
		city = new City();

	})
	
	function _load_store_list(city_id, area_id){
		var data = null;
		$.ajax({
			"url": "<?=base_url();?> admin/store/store/ajax_get_store_list",
			"type": "POST",
			"dataType": "html",
			"data":{
				city_id: city_id,
				area_id: area_id
			},
			success: function (res) {
				$('.ajax_content').html(res);
			}
		});
	}
</script>