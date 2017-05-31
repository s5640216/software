<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="10%">訂單狀態</th>
				<th width="10%">訂單日期</th>
				<th width="10%">查看</th>
			</tr>
		</thead>
		<tbody>
			<? if($orders->num_rows() > 0): ?>
				<? foreach($orders->result() as $order): ?>
					<tr data-order_id="<?=$order->order_id;?>">
						<td><?=$this->CI->getOrderStatusString($order->status);?></td>
						<td><?=date('Y/m/d H:i:s',strtotime($order->order_date));?></td>
						<td><button type="button" class="btnDetail btn btn-info btn-xs">查看</button></td>
					</tr>
				<? endforeach; ?>
			<? else: ?>
				<tr>
					<td colspan="3">暫無訂單紀錄</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</div>

<script>
	$('.btnDetail').click(function(){
		var order_id = $(this).parent().parent().attr('data-order_id');
		window.location = base_url() + "order/order/detail/" + order_id;
	})
</script>