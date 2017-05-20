<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="20%">店名名稱</th>
				<th width="10%">描述</th>			
			</tr>
		</thead>
		<tbody>
			<? if($stores->num_rows() > 0): ?>
				<? foreach($stores->result() as $store): ?>
					<tr data-order_id="<?=$store->store_id;?>">
						<td><?=$store->name;?></td>
						<td><?=$store->describe;?></td>
					
					</tr>
				<? endforeach; ?>
			<? else: ?>
				<tr>
					<td colspan="3">尚未有店家資訊</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</div>
