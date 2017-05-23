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
						<td><?=$product->product_name;?></td>
						<td><?=$product->price;?></td>
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
								<button type="button" class="btn btn-warning btn-xs">修改</button>
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

</script>
