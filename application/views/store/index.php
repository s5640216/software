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
								<button class="btnsearchstore btn btn-primary ">search</button>
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
	$(document).ready(function() {
		city = new City();
		_ajax_get_store_list(null, null);
		
		$('.btnsearchstore').click(function(){
			var city_id = $(this).parent().find('.sel_city :selected').attr('data-city_id');
			var area_id = $(this).parent().find('.sel_area :selected').attr('data-area_id');
			_ajax_get_store_list(city_id, area_id);
		});
	});
	
	function _ajax_get_store_list(city_id, area_id){
		$.ajax({
			url: '<?=base_url()?>store/store/ajax_get_store_list',
			type: 'POST',
			data:{
				city_id: city_id,
				area_id: area_id
			},
			dataType: 'html',
			success: function (res) {
				console.log(res);	
				$('.ajax_content').html(res);
			}
		});
	}
</script>