<br>
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">會員管理</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>uid</th>
							<th>帳號</th>
							<th>名稱</th>
						</tr>
					</thead>
					<tbody>
						<? if($users->num_rows() > 0): ?>
							<? foreach($users->result() as $user): ?>
								<tr>
									<td><?=$user->uid;?></td>
									<td><?=$user->account;?></td>
									<td><?=$user->name;?></td>
								</tr>
							<? endforeach; ?>
						<? endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>