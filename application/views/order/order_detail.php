<style>
	.text-danger strong {
    		color: #9f181c;
		}
	.receipt-main {
		background: #ffffff none repeat scroll 0 0;
		border-bottom: 12px solid #333333;
		border-top: 12px solid #9f181c;
		margin-top: 50px;
		margin-bottom: 50px;
		padding: 40px 30px !important;
		position: relative;
		box-shadow: 0 1px 21px #acacac;
		color: #333333;
		font-family: open sans;
	}
	.receipt-main p {
		color: #333333;
		font-family: open sans;
		line-height: 1.42857;
	}
	.receipt-footer h1 {
		font-size: 15px;
		font-weight: 400 !important;
		margin: 0 !important;
	}
	.receipt-main::after {
		background: #414143 none repeat scroll 0 0;
		content: "";
		height: 5px;
		left: 0;
		position: absolute;
		right: 0;
		top: -13px;
	}
	.receipt-main thead {
		background: #414143 none repeat scroll 0 0;
	}
	.receipt-main thead th {
		color:#fff;
	}
	.receipt-right h5 {
		font-size: 16px;
		font-weight: bold;
		margin: 0 0 7px 0;
	}
	.receipt-right p {
		font-size: 12px;
		margin: 0px;
	}
	.receipt-right p i {
		text-align: center;
		width: 18px;
	}
	.receipt-main td {
		padding: 9px 20px !important;
	}
	.receipt-main th {
		padding: 13px 20px !important;
	}
	.receipt-main td {
		font-size: 13px;
		font-weight: initial !important;
	}
	.receipt-main td p:last-child {
		margin: 0;
		padding: 0;
	}	
	.receipt-main td h2 {
		font-size: 20px;
		font-weight: 900;
		margin: 0;
		text-transform: uppercase;
	}
	.receipt-header-mid .receipt-left h1 {
		font-weight: 100;
		margin: 34px 0 0;
		text-align: right;
		text-transform: uppercase;
	}
	.receipt-header-mid {
		margin: 24px 0;
		overflow: hidden;
	}
</style>


<br>
<div class="container">
	<div class="row">
        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
    			<div class="receipt-header">
					<!--<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="receipt-left">
							<img class="img-responsive" alt="iamgurdeeposahan" src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg" style="width: 71px; border-radius: 43px;">
						</div>
					</div>-->
					<h3 class="text-center" style="color: red;">訂單狀態: <?=$this->CI->getOrderStatusString($order->status);?></h3>
					<?/*<div class="col-xs-6 col-sm-6 col-md-6 text-right">
						<div class="receipt-right">
							<h5>TechiTouch.</h5>
							<p><?=$order->phone;?> <i class="fa fa-phone"></i></p>
							<p><?=$order->email;?> <i class="fa fa-envelope-o"></i></p>
							<p><?=$order->city_name . $order->area_name;?> <i class="fa fa-location-arrow"></i></p>
						</div>
					</div>*/?>
				</div>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<h3>訂單人資訊</h3>
							<h5><?=$order->name;?> <small>  |   <?=$order->sex;?></small></h5>
							<p><b>手機 :</b> <?=$order->phone;?></p>
							<p><b>Email :</b> <?=$order->email;?></p>
							<p><b>訂單地址 :</b> <?=$order->city_name . $order->area_name;?></p>
						</div>
					</div>
					<? if($order->status != ORDER_WAIT): ?>
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<h3>外送員資訊</h3>
							<h5><?=$order->receive_name;?> <small>  |   <?=$order->receive_sex;?></small></h5>
							<p><b>手機 :</b> <?=$order->receive_phone;?></p>
							<p><b>Email :</b> <?=$order->receive_email;?></p>
						</div>
					</div>
					<?endif;?>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
							<h2>TEST</h2>
						</div>
					</div>
				</div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="20%">店家商品</th>
                            <th width="5%">數量</th>
							<th width="10%">總額</th>
                        </tr>
                    </thead>
                    <tbody>
						<?$tmp_store_id = 0;?>
						<? foreach($order_details as $order_detail): ?>
							<? if($tmp_store_id != $order_detail->store_id):?>
							<?$tmp_store_id = $order_detail->store_id;?>
							<tr class="success">
								<th colspan="3"><?=$order_detail->store_city_name . $order_detail->store_area_name . " " . $order_detail->store_name;?></th>
							</tr>
							<? endif; ?>
							<tr>
								<td><?=$order_detail->product_name;?></td>
								<td><?=$order_detail->amount;?></td>
								<td><i class="fa fa-usd"></i> <?=number_format($order_detail->sub_total);?>/-</td>
							</tr>
							<?$sub_total += $order_detail->sub_total?>
						<? endforeach; ?>
                        
                        <tr>
                            <td class="text-right" colspan="2">
								<p><strong>商品小計: </strong></p>
								<p><strong>額外費用: </strong></p>
							</td>
                            <td>
								<p><strong><i class="fa fa-usd"></i> <?=number_format($sub_total);?>/-</strong></p>
								<p><strong><i class="fa fa-usd"></i> <?=ADDITIONAL_FEE?>/-</strong></p>
							</td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="2"><h2><strong>總額: </strong></h2></td>
                            <td class="text-left text-danger"><h2><strong><i class="fa fa-usd"></i> <?=number_format($sub_total + ADDITIONAL_FEE);?>/-</strong></h2></td>
                        </tr>
                    </tbody>
                </table>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<p><b>訂單日期 :</b>  <?=date('Y/m/d H:i:s',strtotime($order->order_date));?></p>
							<h5 style="color: rgb(140, 140, 140);">Thank you for your business!</h5>
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
							<h1>Signature</h1>
						</div>
					</div>
				</div>
            </div>
			<p class="text-left">更改狀態:
				<? if($this->session->userdata('purview') == PURVIEW_SERVICE && ($order->status == ORDER_PROCESSED || $order->status == ORDER_WAIT_CANCEL)): ?>
					<button type="button" class="btnChangeTransport btn btn-warning btn-xs">運送中</button>
				<? endif; ?>
				<? if($this->session->userdata('purview') == PURVIEW_SERVICE && $order->status == ORDER_WAIT_CANCEL): ?>
					<button type="button" class="btnChangeCancel btn btn-danger btn-xs">對方已申請取消訂單</button>
				<? endif; ?>
				<? if($this->session->userdata('purview') == PURVIEW_SERVICE && $order->status == ORDER_TRANSPORT): ?>
					<button type="button" class="btnChangeWaitFinish btn btn-warning btn-xs">已送達</button>
				<? endif; ?>
				<? if($this->session->userdata('purview') == PURVIEW_MEMBER && $order->status == ORDER_WAIT_FINISH): ?>
					<button type="button" class="btnChangeFinish btn btn-warning btn-xs">確認收到商品</button>
				<? endif; ?>
				<? if($order->status == ORDER_PROCESSED || $order->status == ORDER_WAIT): ?>
					<button type="button" class="btnChangeWaitCancel btn btn-danger btn-xs">申請取消訂單</button>
				<? endif; ?>
			</p>
        </div> 
	</div>
	<div class="chat_message"></div>
	
</div>


<script>
	$(document).ready(function() {
		_load_message_view('<?=$order->order_id?>');
		
		$('.btnChangeTransport').click(function(){
			confirm_alert("確定轉為運送中?", function(e){
				if(e){
					$.ajax({
						"url": "<?=base_url();?>/order/order/change_order_status",
						"type": "POST",
						"dataType": "json",
						"data":{
							order_id: '<?=$order->order_id?>',
							status: '<?=ORDER_TRANSPORT;?>'
						},
						success: function (res) {
							if(res.status == 'success'){
								success_toast(null, res.message);
								location.reload();
							} else {
								error_toast(null, res.message);
							}
						}
					});
				}
			});
		});
		
		$('.btnChangeWaitFinish').click(function(){
			confirm_alert("確定轉為已送達?", function(e){
				if(e){
					$.ajax({
						"url": "<?=base_url();?>/order/order/change_order_status",
						"type": "POST",
						"dataType": "json",
						"data":{
							order_id: '<?=$order->order_id;?>',
							status: '<?=ORDER_WAIT_FINISH;?>'
						},
						success: function (res) {
							if(res.status == 'success'){
								success_toast(null, res.message);
								location.reload();
							} else {
								error_toast(null, res.message);
							}
						}
					});
				}
			});
		});
		$('.btnChangeFinish').click(function(){
			confirm_alert("確定已收到貨物?", function(e){
				if(e){
					$.ajax({
						"url": "<?=base_url();?>/order/order/change_order_status",
						"type": "POST",
						"dataType": "json",
						"data":{
							order_id: '<?=$order->order_id;?>',
							status: '<?=ORDER_FINISH;?>'
						},
						success: function (res) {
							if(res.status == 'success'){
								success_toast(null, res.message);
								location.reload();
							} else {
								error_toast(null, res.message);
							}
						}
					});
				}
			});
		});
		
		$('.btnChangeWaitCancel').click(function(){
			confirm_alert("確定申請取消訂單?", function(e){
				if(e){
					$.ajax({
						"url": "<?=base_url();?>/order/order/change_order_status",
						"type": "POST",
						"dataType": "json",
						"data":{
							order_id: '<?=$order->order_id;?>',
							status: '<?=ORDER_WAIT_CANCEL;?>'
						},
						success: function (res) {
							if(res.status == 'success'){
								success_toast(null, res.message);
								location.reload();
							} else {
								error_toast(null, res.message);
							}
						}
					});
				}
			});
		});
		
		$('.btnChangeCancel').click(function(){
			confirm_alert("確定取消對方的訂單?", function(e){
				if(e){
					$.ajax({
						"url": "<?=base_url();?>/order/order/change_order_status",
						"type": "POST",
						"dataType": "json",
						"data":{
							order_id: '<?=$order->order_id;?>',
							status: '<?=ORDER_CANCEL;?>'
						},
						success: function (res) {
							if(res.status == 'success'){
								success_toast(null, res.message);
								location.reload();
							} else {
								error_toast(null, res.message);
							}
						}
					});
				}
			});
		});
		
	});
	
	function _load_message_view(order_id){
		$.ajax({
			"url": "<?=base_url();?>/order/order/get_order_chat",
			"type": "POST",
			"dataType": "html",
			"data":{
				order_id: order_id
			},
			success: function (res) {
				$('.chat_message').html(res);
			}
		});
	}
	
	
</script>