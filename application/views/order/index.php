<br>
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			訂單紀錄
		</div>
		<div class="panel-body">
			<div class="ajax_content"></div>
		</div>
		
	</div>
</div>

<script>
	$(document).ready(function() {
		_get_order_list();
	});
	
	function _get_order_list(){
		$.ajax({
			url: '<?=base_url()?>order/order/get_order_list',
			type: 'POST',
			dataType: 'html',
			success: function (res) {
				$('.ajax_content').html(res);
			}
		});
	}
</script>