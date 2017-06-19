<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="5%">商品編號</th>
				<th width="15%">商品名稱</th>
				<th width="10%">單價</th>
				<?if($this->session->userdata('purview') == PURVIEW_ADMIN):?>
					<th width="10%">狀態</th>
					<th width="10%">操作</th>
				<?endif;?>
			</tr>
		</thead>
		<tbody>
			<? if($store_products->num_rows() > 0): ?>
				<? foreach($store_products->result() as $product): ?>
					<tr data-store_id="<?=$product->store_id;?>" data-product_id="<?=$product->product_id;?>">
						<td><?=$product->product_id;?></td>
						<td class="product_name"><?=$product->product_name;?></td>
						<td class="product_price"><?=$product->price;?></td>
						<?if($this->session->userdata('purview') == PURVIEW_ADMIN):?>
							<td>
								<? if($product->status == PRODUCT_SELL): ?>
									<span class="label label-success"><?=$this->CI->getProductStatusString($product->status);?></span>
								<? elseif($product->status == PRODUCT_STOP): ?>
									<span class="label label-danger"><?=$this->CI->getProductStatusString($product->status);?></span>
								<? elseif($product->status == PRODUCT_WILL_SELL): ?>
									<span class="label label-warning"><?=$this->CI->getProductStatusString($product->status);?></span>
								<? endif; ?>
							</td>
							<td>
								<button type="button" class="btnModifyProductModal btn btn-warning btn-xs" data-toggle="modal" data-target="#modify_store_product_modal">修改</button>
								<? if($product->status == PRODUCT_SELL): ?>
									<button type="button" class="btnStopSell btn btn-danger btn-xs" data-product_status="<?=PRODUCT_STOP?>">停賣</button>
								<? else: ?>
									<button type="button" class="btnStartSell btn btn-success btn-xs" data-product_status="<?=PRODUCT_SELL?>">上架</button>
								<? endif; ?>
							</td>
						<?endif;?>
					</tr>
				<? endforeach; ?>
			<? else: ?>
				<tr>
					<td colspan="3">本店家尚未有商品</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="modify_store_product_modal" tabindex="-1" role="dialog" data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">修改商品</h4>
			</div>
			<div class="modal-body" id="modify_store_product_form">
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
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				<button type="button" data-dismiss="modal" class="btnModifyProduct btn btn-primary">修改</button>
			</div>
		</div>
	</div>
</div>

<script>
	$('.btnStopSell').click(function(){
		var store_id = $(this).parent().parent().attr('data-store_id');
		var product_id = $(this).parent().parent().attr('data-product_id');
		var product_status = $(this).attr('data-product_status');
		confirm_alert('是否停賣此商品', function(e){
			if(e){
				$.ajax({
					url: '<?=base_url()?>store/store/ajax_update_product_status',
					type: 'POST',
					data:{
						store_id: store_id,
						product_id: product_id,
						product_status: product_status
					},
					dataType: 'json',
					success: function (res) {
						if(res.status == 'success'){
							_ajax_get_store_product_list();
							success_toast(null, res.message);
						} else {
							error_toast(null, res.message);
						}
					}
				});
			}
		})
	})
	
	$('.btnStartSell').click(function(){
		var store_id = $(this).parent().parent().attr('data-store_id');
		var product_id = $(this).parent().parent().attr('data-product_id');
		var product_status = $(this).attr('data-product_status');
		confirm_alert('是否上架此商品', function(e){
			if(e){
				$.ajax({
					url: '<?=base_url()?>store/store/ajax_update_product_status',
					type: 'POST',
					data:{
						store_id: store_id,
						product_id: product_id,
						product_status: product_status
					},
					dataType: 'json',
					success: function (res) {
						if(res.status == 'success'){
							_ajax_get_store_product_list();
							success_toast(null, res.message);
						} else {
							error_toast(null, res.message);
						}
					}
				});
			}
		})
	})
	$('.btnModifyProductModal').click(function(){
		var store_id = $(this).parent().parent().attr('data-store_id');
		var product_id = $(this).parent().parent().attr('data-product_id');
		var product_name = $(this).parent().parent().find('.product_name').html();
		var product_price = $(this).parent().parent().find('.product_price').html();
		$('#modify_store_product_form .product_name').val(product_name);
		$('#modify_store_product_form .product_price').val(product_price);
		$('#modify_store_product_modal .btnModifyProduct').attr('data-store_id', store_id);
		$('#modify_store_product_modal .btnModifyProduct').attr('data-product_id', product_id);
	})
	$('.btnModifyProduct').click(function(){
		var store_id = $(this).attr('data-store_id');
		var product_id = $(this).attr('data-product_id');
		var product_name = $('#modify_store_product_form .product_name').val();
		var product_price = $('#modify_store_product_form .product_price').val();
		if(product_price <= 0){
			warning_toast(null, '價格請輸入大於0');
			return;
		}
		$.ajax({
			url: '<?=base_url()?>store/store/modify_store_product',
			type: 'POST',
			data:{
				store_id: store_id,
				product_id: product_id,
				product_name: product_name,
				product_price: product_price
			},
			dataType: 'json',
			success: function (res) {
				if(res.status == 'success'){
					success_toast(null, res.message);
					_ajax_get_store_product_list();
				} else {
					error_toast(null, res.message);
				}
			}
		});
	})
	

</script>
