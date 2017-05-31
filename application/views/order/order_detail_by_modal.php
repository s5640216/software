<div class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-4 control-label">訂單區域：</label>
		<div class="col-sm-8">
			<label class="control-label"><?=$order->city_name . $order->area_name;?></label>
		</div>
	</div>
	<?$tmp_store_id = 0;?>
	<div class="form-group">
		<label class="col-sm-4 control-label">店家資訊：</label>
		<div class="col-sm-8">
			<? foreach($order_detail as $detail): ?>
				<? if($tmp_store_id != $detail->store_id):?>
					<?$tmp_store_id = $detail->store_id;?>
					<p><?=$detail->store_city_name . $detail->store_area_name . " " . $detail->store_name;?></p>
				<? endif; ?>
			<? endforeach; ?>
		</div>
	</div>
</div>