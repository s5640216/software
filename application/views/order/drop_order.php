<br>
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			下訂單
		</div>
		<div class="panel-body">
			<div class="col-xs-12">
				<div class="form-group">
					<div class="form-inline">
						<div class="form-group">
							<div class="sel_address">
								<label>地區選擇</label>
								<select class="sel_city form-control">
									<option>請選擇</option>
								</select>
								<select class="sel_area form-control">
									<option>請選擇</option>
								</select>
							</div>
						</div>
					</div>
					<br>
					<div class="form-inline">
						<div class="form-group">
							
							<div class="sel_store_detail">
								<label>店家:</label>
								<select class="sel_store form-control">
									<option>請選擇</option>
								</select>
								<label>商品:</label>
								<select class="sel_product form-control">
									<option>請選擇</option>
								</select>
								<label>數量:</label>
								<input class="amount" type="number" min="1" max="30" value="1">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<button class="btnDorpOrder btn btn-primary pull-right">下訂</button>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<script>
	$(function () {
		city = new City();
		
		$('.sel_area').change(function(){
			var city_id = $(this).parent().find('.sel_city :selected').attr('data-city_id');
			var area_id = $(this).find(':selected').attr('data-area_id');
			_load_store_list(city_id, area_id);
			var sel_product = $('.sel_product');
			sel_product.empty();
			sel_product.append("<option>請選擇</option>");
		});
		$('.sel_store').change(function(){
			var store_id = $(this).find(':selected').attr('data-store_id');
			_load_store_product_list(store_id);
		});
		
		$('.btnDorpOrder').click(function(){
			var city_id = $('.sel_city :selected').attr('data-city_id');
			var area_id = $('.sel_area :selected').attr('data-area_id');
			var store_id = $('.sel_store :selected').attr('data-store_id');
			var product_id = $('.sel_product :selected').attr('data-product_id');
			var amount = $('.amount').val();
			if(city_id == null){
				warning_toast(null, '請選擇地區');
				return;
			}
			if(area_id == null){
				warning_toast(null, '請選擇地區');
				return;
			}
			if(store_id == null){
				warning_toast(null, '請選擇店家');
				return;
			}
			if(product_id == null){
				warning_toast(null, '請選擇地商品');
				return;
			}
			$.ajax({
				"url": "<?=base_url();?>/order/order/do_drop_order",
				"type": "POST",
				"dataType": "json",
				"data":{
					city_id: city_id,
					area_id: area_id,
					store_id: store_id,
					product_id: product_id,
					amount: amount
				},
				success: function (data) {
					if(data.status == 'success'){
						window.location.href = '<?=base_url();?>order/order';
					}
				}
			});
		});
	})
	
	function _load_store_list(city_id, area_id){
		var sel_store = $('.sel_store');
		$.ajax({
			"url": "<?=base_url();?>/store/store/ajax_get_store_list",
			"type": "POST",
			"dataType": "json",
			"data":{
				city_id: city_id,
				area_id: area_id
			},
			success: function (data) {
				sel_store.empty();
				sel_store.append("<option>請選擇</option>");
				if(data.length > 0){
					data.forEach(function(store){
						sel_store.append("<option data-store_id=" + store.store_id + ">" + store.name +  "</option>");
					})
				} else {
					sel_store.empty();
					sel_store.append("<option>目前無店家資訊</option>");
				}
			}
		});
	}
	
	function _load_store_product_list(store_id){
		var sel_product = $('.sel_product');
		$.ajax({
			"url": "<?=base_url();?>/store/store/ajax_get_store_product_list",
			"type": "POST",
			"dataType": "json",
			"data":{
				store_id: store_id
			},
			success: function (data) {
				sel_product.empty();
				sel_product.append("<option>請選擇</option>");
				if(data.length > 0){
					data.forEach(function(product){
						sel_product.append("<option data-store_id=" + product.store_id + " data-product_id=" + product.product_id + ">" + product.product_name + "(" + product.price + "元)</option>");
					})
				} else {
					sel_product.empty();
					sel_product.append("<option>目前無商品資料</option>");
				}
			}
		});
	}
</script>