<div class="modal fade" id="add_store_product_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">新增商品</h4>
			</div>
			<div class="modal-body" id="add_store_form">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label">商品名稱</label>
						<div class="col-sm-10">
							<input type="text" class="product_name form-control" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">商品單價</label>
						<div class="col-sm-10">
							<input type="number" class="product_price form-control" value="1" min="1">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">商品狀態</label>
						<div class="col-sm-10">
							<select class="product_status form-control">
								<option value="<?=PRODUCT_SELL;?>"><?=$this->CI->getProductStatusString(PRODUCT_SELL);?></option>
								<option value="<?=PRODUCT_STOP;?>"><?=$this->CI->getProductStatusString(PRODUCT_STOP);?></option>
								<option value="<?=PRODUCT_WILL_SELL;?>"><?=$this->CI->getProductStatusString(PRODUCT_WILL_SELL);?></option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				<button type="button" class="btnAddStoreProduct btn btn-primary">新增</button>
			</div>
		</div>
	</div>
</div>

<script>
	$('#add_store_product_modal .btnAddStoreProduct').click(function(){
		var product_name = $('#add_store_product_modal .product_name').val();
		var product_price = $('#add_store_product_modal .product_price').val();
		var product_status = $('#add_store_product_modal .product_status').val();
		
		if(product_name == ''){
			warning_toast(null, "請輸入商品名稱");
			return;
		}
		if(product_price == null){
			warning_toast(null, "請輸入商品單價");
			return;
		}

		if(isNaN(product_price)){
			warning_toast(null, "請輸入商品單價");
			return;
		}
		if(product_price <= 0){
			warning_toast(null, '價格請輸入大於0');
			return;
		}
		$.ajax({
			url: '<?=base_url()?>store/store/ajax_add_store_product',
			type: 'POST',
			data:{
				store_id: '<?=$store_id;?>',
				product_name: product_name,
				product_price: product_price,
				product_status: product_status
			},
			dataType: 'json',
			success: function (res) {
				if(res.status == 'success'){
					$('#add_store_product_modal').modal('hide');
					_ajax_get_store_product_list();
					_init_input();
					success_toast(null, res.message);
				} else {
					error_toast(null, res.message);
				}
			}
		});
	})
	
	function _init_input(){
		$('#add_store_product_modal .product_name').val('');
		$('#add_store_product_modal .product_price').val(1);
		$('#add_store_product_modal .product_status').val(1);
	}
</script>