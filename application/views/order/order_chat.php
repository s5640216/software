<style>
	.chat{
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.chat li{
		margin-bottom: 10px;
		padding-bottom: 5px;
		border-bottom: 1px dotted #B3A9A9;
	}

	.chat li.left .chat-body{
		margin-left: 60px;
	}

	.chat li.right .chat-body{
		margin-right: 60px;
	}


	.chat li .chat-body p{
		margin: 0;
		color: #777777;
	}

	.panel .slidedown .glyphicon, .chat .glyphicon{
		margin-right: 5px;
	}

	.body-panel{
		overflow-y: scroll;
		height: 250px;
	}

	::-webkit-scrollbar-track{
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		background-color: #F5F5F5;
	}

	::-webkit-scrollbar{
		width: 12px;
		background-color: #F5F5F5;
	}

	::-webkit-scrollbar-thumb {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color: #555;
	}
</style>

<div class="row form-group">
        <div class="col-xs-12 col-md-offset-2 col-md-8 col-lg-8 col-lg-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> 訊息
                    <div class="btn-group pull-right">
                        <!--<button type="button" class="btn btn-default btn-xs" data-toggle="collapse" href="#collapseOne">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>-->
						<button type="button" class="btn btn-success btn-xs" onclick="_load_message_view('<?=$order_id?>');">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    </div>
                </div>
				<div class="" id="collapseOne">
					<div class="panel-body body-panel">
						<ul class="chat">
							<? if($messages->num_rows() > 0 ): ?>
								<? foreach($messages->result() as $message): ?>
									<li class="<?=($message->uid == $uid)? 'right' : 'left'?> clearfix">
										<span class="chat-img pull-<?=($message->uid == $uid)? 'right' : 'left'?> thumbnail">
											<img src="<?=base_url('assets/home/img/user.jpg');?>" alt="User Avatar" class="img-circle" width="35" height="35">
										</span>
										<div class="chat-body clearfix">
											<div class="header_message">
												<? if($message->uid == $uid): ?>
													<strong class="primary-font"><?=$message->name;?></strong> 
													<small class="pull-right text-muted"><span class="glyphicon glyphicon-time" ></span><?=date('Y/m/d H:i:s',strtotime($message->message_date));?></small>
												<? else: ?>
													<small class="pull-right text-muted"><span class="glyphicon glyphicon-time" ></span><?=date('Y/m/d H:i:s',strtotime($message->message_date));?></small>
													<strong class="primary-font"><?=$message->name;?></strong> 
												<? endif; ?>
											</div>
											<p><?=$message->message;?></p>
										</div>
									</li>
								<? endforeach; ?>
							<? endif; ?>
						</ul>
					</div>
					<?if(!in_array($order->status, $hide_send_message)):?>
					<div class="panel-footer clearfix">
						<div class="row">
							<div class="col-md-9">
								<input class="Message_input form-control" placeholder="填入訊息" onkeypress="return enter_send(event);">
							</div>
							<div class="col-md-3">
								<button class="btnSendMessage btn btn-warning btn-block">送出</button>
							</div>
						</div>
					</div>
					<?endif;?>
				</div>
			</div>
		</div>
	</div>
	
<script>
	$(document).ready(function() {
		$('.btnSendMessage').click(function(){
			send_message();
		});
	});
	
	function enter_send(e){
		if (e.keyCode == 13) {
			send_message();
		}
	}
	
	function send_message(){
		var message = $('.Message_input').val();
		if(message == '' || message == null){
			return;
		}
		$.ajax({
			"url": "<?=base_url();?>/order/order/send_message",
			"type": "POST",
			"dataType": "json",
			"data":{
				order_id: '<?=$order_id?>',
				message: message
			},
			success: function (res) {
				if(res.status == 'success'){
					success_toast(null, res.message);
					 $('.Message_input').val('');
					 _load_message_view('<?=$order_id?>');
				} else {
					error_toast(null, res.message);
				}
			}
		});
	}
</script>	