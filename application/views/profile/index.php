<style>
	.user-row {
		margin-bottom: 14px;
	}

	.user-row:last-child {
		margin-bottom: 0;
	}

	.dropdown-user {
		margin: 13px 0;
		padding: 5px;
		height: 100%;
	}

	.dropdown-user:hover {
		cursor: pointer;
	}

	.table-user-information > tbody > tr {
		border-top: 1px solid rgb(221, 221, 221);
	}

	.table-user-information > tbody > tr:first-child {
		border-top: 0;
	}


	.table-user-information > tbody > tr > td {
		border-top: 0;
	}
	.toppad {
		margin-top:20px;
	}

</style>


<div class="container">
	<div class="row">  
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><?=$user['account'];?> 個人資料</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>		
						<br>
						<div class=" col-md-9 col-lg-9 "> 
							<table class="table table-user-information">
								<tbody>
									<tr>
										<td>名稱:</td>
										<td><?=$user['name'];?></td>
									</tr>
									<tr>
										<td>性別:</td>
										<td><?=$user['sex'];?></td>
									</tr>
									<tr>
										<td>電話:</td>
										<td><?=$user['phone'];?></td>
									</tr>
									<tr>
										<td>Email:</td>
										<td><?=$user['email'];?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-primary" data-toggle="modal" data-target="#ChangePasswdModal">修改密碼</button>
					
					<span class="pull-right">
						<button class="btn btn-primary">修改個人資料</button>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ChangePasswdModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">修改密碼</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label">舊密碼</label>
						<div class="col-sm-10">
							<input type="password" class="oldpasswd form-control" placeholder="請輸入舊密碼">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">新密碼</label>
						<div class="col-sm-10">
							<input type="password" class="newpasswd form-control" placeholder="請輸入新密碼">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">確認密碼</label>
						<div class="col-sm-10">
							<input type="password" class="newpasswd2 form-control" placeholder="請輸入確認密碼">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				<button type="button" class="btn btn-primary" id="btnChangePasswd">修改</button>
			</div>
		</div>
	</div>
</div>
	
<script>
	$(document).ready(function() {
		var panels = $('.user-infos');
		var panelsButton = $('.dropdown-user');
		panels.hide();

		//Click dropdown
		panelsButton.click(function() {
			//get data-for attribute
			var dataFor = $(this).attr('data-for');
			var idFor = $(dataFor);

			//current button
			var currentButton = $(this);
			idFor.slideToggle(400, function() {
				//Completed slidetoggle
				if(idFor.is(':visible'))
				{
					currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
				}
				else
				{
					currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
				}
			})
		});


		$('[data-toggle="tooltip"]').tooltip();

		$('#btnChangePasswd').click(function(){
			var oldpasswd = $('#ChangePasswdModal .oldpasswd').val();
			var newpasswd = $('#ChangePasswdModal .newpasswd').val();
			var newpasswd2 = $('#ChangePasswdModal .newpasswd2').val();
			$.ajax({
				url: '<?=base_url()?>profile/profile/change_passwd',
				type: 'POST',
				dataType: 'json',
				data: {
					oldpasswd: oldpasswd,
					newpasswd: newpasswd,
					newpasswd2: newpasswd2
				},
				success: function (res) {
					if(res.status == 'success'){
						success_toast('修改密碼', res.message);
						$("#ChangePasswdModal input").val('');
						$('#ChangePasswdModal').modal('hide');
					} else {
						error_toast('修改密碼', res.message);
					}
				}
			});
		})
			
		
	});
	
	
</script>