<br>
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			下訂單(目前訂單只能一家多商品)
		</div>
		<div class="panel-body">
			<div class="col-xs-12">
				<div class="form-group">
					<div class="form-inline">
						<div class="form-group">
							<div class="sel_address" id="sel_address">
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
								<button type="button" class="btnSelectProduct btn btn-success btn-xs">選定</button>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group">
						<div class="table-responsive">
							<table class="table table-striped">
							<caption>已選商品</caption>
								<thead>
									<tr>
										<th width="10%">商品名稱</th>
										<th width="5%">數量</th>
										<th width="5%">刪除</th>
									</tr>
								</thead>
								<tbody id="chosen_product">
								
								</tbody>
							</table>
						</div>
					</div>
					<div class="sel_address" id="order_address">
						<label>外送地點</label>
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
		<div class="panel-footer">
			<button class="btnDorpOrder btn btn-primary pull-right">下訂</button>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<script>
	var product_data = [];

	
	$(function () {
		city = new City();
		
		$('#sel_address .sel_area').change(function(){
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
			var city_id = $('#order_address .sel_city :selected').attr('data-city_id');
			var area_id = $('#order_address .sel_area :selected').attr('data-area_id');
			
			var amount = $('.amount').val();
			if(city_id == null){
				warning_toast(null, '請選擇地區');
				return;
			}
			if(area_id == null){
				warning_toast(null, '請選擇地區');
				return;
			}
			if(product_data.length == 0){
				warning_toast(null, '請選擇一項以上的商品');
				return;
			}
			confirm_alert("確認成立訂單?", function(e){
				if(e){
					$.ajax({
						"url": "<?=base_url();?>/order/order/do_drop_order",
						"type": "POST",
						"dataType": "json",
						"data":{
							city_id: city_id,
							area_id: area_id,
							product_arr: product_data
						},
						success: function (data) {
							if(data.status == 'success'){
								window.location.href = '<?=base_url();?>order/order';
							}
						}
					});
				}
			});
		});
		
		$('.btnSelectProduct').click(function(){
			var store_id = $(this).parent().find('.sel_store :selected').attr('data-store_id');
			var product_id = $(this).parent().find('.sel_product :selected').attr('data-product_id');
			var product_name = $(this).parent().find('.sel_product :selected').html();
			var amount = $(this).parent().find('.amount').val();
			var product = {store_id: store_id, 
							product_id: product_id,
							amount: amount};
			var check = true;
			if(product_data.length > 0 && product_data[0].store_id != store_id){
				warning_toast(null, '目前只接受一個店家的訂單');
				check = false;
			}
			product_data.forEach(function(e){
				if(e.store_id == store_id && e.product_id == product_id){
					warning_toast(null, '此商品已在清單裡面');
					check = false;
				}
			});
			
			if(store_id > 0 && product_id > 0 && check == true){
				$('#chosen_product').append("<tr data-store_id=" + store_id + " data-product_id=" + product_id + ">" +
					"<td>" + product_name + "</td>" +
					"<td><input class='selected_amount' type='number' min='1' max='30' value=" + amount + "></td>" + 
					"<td><button type='button' class='btnDelete btn btn-danger btn-xs'>刪除</button></td>" + 
				"</tr>");
				product_data.push(product);
			}
			
		});
		$(document).on('click', '.btnDelete', function(){
			var store_id = $(this).parent().parent().attr('data-store_id');
			var product_id = $(this).parent().parent().attr('data-product_id');
			product_data.forEach(function(e, key){
				if(e.store_id == store_id && e.product_id == product_id){
					product_data.splice(key, 1);
				} 
			});
			$(this).parent().parent().remove();
		});
		$(document).on('change', '.selected_amount', function(){
			var store_id = $(this).parent().parent().attr('data-store_id');
			var product_id = $(this).parent().parent().attr('data-product_id');
			var amount = $(this).val();
			var obj = $(this);
			product_data.forEach(function(e){
				if(e.store_id == store_id && e.product_id == product_id){
					if(!isNaN(amount) && amount > 0){
						e.amount = amount;
					} else {
						obj.val(e.amount);
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