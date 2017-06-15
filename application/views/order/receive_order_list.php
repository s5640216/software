<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="10%">訂單狀態</th>
				<th width="10%">訂單日期</th>
				<th width="10%">操作</th>
			</tr>
		</thead>
		<tbody>
			<? if($orders->num_rows() > 0): ?>
				<? foreach($orders->result() as $order): ?>
					<tr data-order_id="<?=$order->order_id;?>">
						<td><?=$this->CI->getOrderStatusString($order->status);?></td>
						<td><?=date('Y/m/d H:i:s',strtotime($order->order_date));?></td>
						<td>
							<!--<button class="btnReceive btn btn-success btn-xs">接收</button>-->
							<button class="btnOrderDetail btn btn-info btn-xs">查看</button>
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

<div class="modal fade" id="order_detail_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">訂單資訊</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				<button type="button" class="btnReceiveByModal btn btn-primary" data-dismiss="modal">接收</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.btnReceive').click(function(){
			var order_id = $(this).parent().parent().attr('data-order_id');
			receive_order(order_id);
		});
		
		$('.btnReceiveByModal').click(function(){
			var order_id = $(this).attr('data-order_id');
			receive_order(order_id);
		});
		
		$('.btnOrderDetail').click(function(){
			var order_id = $(this).parent().parent().attr('data-order_id');
			$.ajax({
				url: '<?=base_url()?>order/order/get_order_detail_modal',
				type: 'POST',
				dataType: 'html',
				data:{
					order_id: order_id
				},
				success: function (res) {
					$('#order_detail_modal .modal-body').html(res);
					$('.btnReceiveByModal').attr('data-order_id', order_id);
					$('#order_detail_modal').modal('show');
				}
			});
		});
	});
	
	function receive_order(order_id){
		confirm_alert("確定接收此訂單?", function(e){
			if(e){
				$.ajax({
					url: '<?=base_url()?>order/order/receive_order',
					type: 'POST',
					dataType: 'json',
					data:{
						order_id: order_id
					},
					success: function (data) {
						if(data.status == "success"){
							success_toast(null, data.message);
							_get_receive_order_list();
						} else if(data.status == "fail"){
							error_toast(null, data.message);
						}

					}
				});
			}
		});
	}
</script>