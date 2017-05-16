<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="20%">名稱</th>
				<th width="10%">訂單狀態</th>
				<th width="10%">訂單日期</th>
				<th width="10%">操作</th>
			</tr>
		</thead>
		<tbody>
			<? if($orders->num_rows() > 0): ?>
				<? foreach($orders->result() as $order): ?>
					<tr data-order_id="<?=$order->order_id;?>">
						<td><?=$order->name;?></td>
						<td><?=$order->status;?></td>
						<td><?=date('Y/m/d H:i:s',strtotime($order->order_date));?></td>
						<td>
							<button class="btnReceive btn btn-info btn-xs">接收</button>
						</td>
					</tr>
				<? endforeach; ?>
			<? else: ?>
				<tr>
					<td colspan="3">暫無訂單需求</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function() {
		$('.btnReceive').click(function(){
			if(!confirm("確定接收此訂單?")){
				return;
			}
			var order_id = $(this).parent().parent().attr('data-order_id');
			$.ajax({
				url: '<?=base_url()?>order/order/receive_order',
				type: 'POST',
				dataType: 'json',
				data:{
					order_id: order_id
				},
				success: function (res) {
					
				}
			});
		});
	});
</script>