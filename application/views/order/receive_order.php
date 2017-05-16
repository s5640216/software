<br>
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			接收訂單
		</div>
		<div class="panel-body">
			<div class="form-inline">
				<div class="form-group">
					<label>地區篩選</label>
					<div class="sel_address">
						<select class="sel_city form-control">
							<option>請選擇</option>
						</select>
						<select class="sel_area form-control">
							<option>請選擇</option>
						</select>
						<button type="button" class="btnAddressSearch btn btn-primary">查詢</button>
					</div>
				</div>
			</div>
			<div class="ajax_content"></div>
		</div>
		
	</div>
</div>

<script>
	$(document).ready(function() {
		city = new City();
		_get_receive_order_list(null, null);
		
		$('.btnAddressSearch').click(function(){
			var city_id = $(this).parent().find('.sel_city :selected').attr('data-city_id');
			var area_id = $(this).parent().find('.sel_area :selected').attr('data-area_id');
			_get_receive_order_list(city_id, area_id);
		});
	});
	
	function _get_receive_order_list(city_id, area_id){
		$.ajax({
			url: '<?=base_url()?>order/order/get_receive_order_list',
			type: 'POST',
			data:{
				city_id: city_id,
				area_id: area_id
			},
			dataType: 'html',
			success: function (res) {
				$('.ajax_content').html(res);
			}
		});
	}
</script>