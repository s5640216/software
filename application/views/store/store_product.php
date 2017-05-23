<br>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title pull-left">
					<?=$store_name;?>  商品資訊
				</h3>
				<?if($this->session->userdata('purview') == PURVIEW_ADMIN):?>
					<button class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target="#add_store_product_modal">新增商品</button>
				<?endif;?>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="col-xs-12">
					<div class="ajax_content"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>	
	$(document).ready(function() {
		_ajax_get_store_product_list();
	});
	
	function _ajax_get_store_product_list(){
		var store_id = '<?=$store_id?>';
		$.ajax({
			url: '<?=base_url()?>store/store/ajax_get_store_product_list/view',
			type: 'POST',
			data:{
				store_id: store_id
			},
			dataType: 'html',
			success: function (res) {
				$('.ajax_content').html(res);
			}
		});
	}
</script>