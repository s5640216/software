<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>會員登入</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>">
		<link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap-theme.min.css');?>">
		
		<link rel="stylesheet" href="<?=base_url('assets/toastr/toastr.min.css');?>">
	</head>
	<style>
		/*body {
			padding-top: 90px;
		}*/
		
		.panel-login {
			border-color: #ccc;
			-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
			-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
			box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
		}
		.panel-login>.panel-heading {
			color: #00415d;
			background-color: #fff;
			border-color: #fff;
			text-align:center;
		}
		.panel-login>.panel-heading a{
			text-decoration: none;
			color: #666;
			font-weight: bold;
			font-size: 15px;
			-webkit-transition: all 0.1s linear;
			-moz-transition: all 0.1s linear;
			transition: all 0.1s linear;
		}
		.panel-login>.panel-heading a.active{
			color: #029f5b;
			font-size: 18px;
		}
		.panel-login>.panel-heading hr{
			margin-top: 10px;
			margin-bottom: 0px;
			clear: both;
			border: 0;
			height: 1px;
			background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
			background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
			background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
			background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
		}
		.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
			height: 45px;
			border: 1px solid #ddd;
			font-size: 16px;
			-webkit-transition: all 0.1s linear;
			-moz-transition: all 0.1s linear;
			transition: all 0.1s linear;
		}
		.panel-login input:hover,
		.panel-login input:focus {
			outline:none;
			-webkit-box-shadow: none;
			-moz-box-shadow: none;
			box-shadow: none;
			border-color: #ccc;
		}
		.btn-login {
			background-color: #59B2E0;
			outline: none;
			color: #fff;
			font-size: 14px;
			height: auto;
			font-weight: normal;
			padding: 14px 0;
			text-transform: uppercase;
			border-color: #59B2E6;
		}
		.btn-login:hover,
		.btn-login:focus {
			color: #fff;
			background-color: #53A3CD;
			border-color: #53A3CD;
		}
		.forgot-password {
			text-decoration: underline;
			color: #888;
		}
		.forgot-password:hover,
		.forgot-password:focus {
			text-decoration: underline;
			color: #666;
		}

		.btn-register {
			background-color: #1CB94E;
			outline: none;
			color: #fff;
			font-size: 14px;
			height: auto;
			font-weight: normal;
			padding: 14px 0;
			text-transform: uppercase;
			border-color: #1CB94A;
		}
		.btn-register:hover,
		.btn-register:focus {
			color: #fff;
			background-color: #1CA347;
			border-color: #1CA347;
		}
		.navbar-header {
			float: left;
			padding: 15px;
			text-align: center;
			width: 100%;
		}
		.navbar-brand {float:none;}
	</style>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">外送茶</a>
		</div>
	</nav>
	
	<body>
		
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-login">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-6">
									<a href="#" class="active" id="login-form-link">登入</a>
								</div>
								<div class="col-xs-6">
									<a href="#" id="register-form-link">註冊</a>
								</div>
							</div>
							<hr>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<div id="login_form" style="display: block;">
										<div class="form-group">
											<input type="text" tabindex="1" class="account form-control" placeholder="帳號" value="">
										</div>
										<div class="form-group">
											<input type="password" tabindex="2" class="passwd form-control" placeholder="密碼">
										</div>
										<!--<div class="form-group text-center">
											<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
											<label for="remember"> Remember Me</label>
										</div>-->
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<button id="btnLogin" tabindex="4" class="form-control btn btn-login">登入</button>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-lg-12">
													<div class="text-center">
														<a href="#" tabindex="5" class="forgot-password">忘記密碼</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div id="register_form" role="form" style="display: none;">
										<div class="form-group">
											<input type="text" tabindex="1" class="name form-control" placeholder="名稱" value="">
										</div>
										<div class="form-group">
											<input type="text" tabindex="1" class="account form-control" placeholder="帳號" value="">
										</div>
										<div class="form-group">
											<input type="password" tabindex="1" class="passwd form-control" placeholder="密碼">
										</div>
										<div class="form-group">
											<input type="password" tabindex="1" class="passwd2 form-control" placeholder="確認密碼">
										</div>
										<div class="form-group">
											<input type="email" tabindex="1" class="email form-control" placeholder="Email" value="">
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">性別</label>
											<label class="radio-inline">
												<input type="radio" name="sex" value="男" checked> 男
											</label>
											<label class="radio-inline">
												<input type="radio" name="sex" value="女"> 女
											</label>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<button tabindex="4" id="btnRegister" class="form-control btn btn-register">註冊</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</body>
</html>

<!-- jQuery 2.2.3 -->
<script src="<?=base_url('assets/jquery/core/jquery-2.2.3.min.js');?>" type="text/javascript"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>

<script src="<?=base_url('assets/toastr/toastr.min.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/common/common.js');?>" type="text/javascript"></script>

<script>
	$(function() {

		$('#login-form-link').click(function(e) {
			$("#login_form").delay(100).fadeIn(100);
			$("#register_form").fadeOut(100);
			$('#register-form-link').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});
		$('#register-form-link').click(function(e) {
			$("#register_form").delay(100).fadeIn(100);
			$("#login_form").fadeOut(100);
			$('#login-form-link').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});
		
		$('#btnLogin').click(function(){
			dologin();
		});
		$('#btnRegister').click(function(){
			doregister();
		});
		
	});
	
	function dologin(){
		$.ajax({
			"url": "<?=base_url();?>login/login/dologin/ajax",
			"type": "POST",
			"data": {
				account: $('#login_form .account').val(),
				passwd: $('#login_form .passwd').val()
			},
				"dataType": "json"
		}).done(function (data) {
			if(data.status == "success"){
				window.location.href = '<?=base_url();?>home';
			} else if(data.status == "fail"){
				error_toast(null ,'帳號密碼有錯!');
			}
		});
	}
	
	function doregister(){
		var name = $('#register_form .name').val();
		var account = $('#register_form .account').val();
		var passwd = $('#register_form .passwd').val();
		var passwd2 = $('#register_form .passwd2').val();
		var email = $('#register_form .email').val();
		var sex = $('input[name=sex]:checked').val();
		var check_status = check(name,account,passwd,passwd2,email);
		if(check_status == true && check_email(email) == true){
			$.ajax({
				url: '<?=base_url()?>login/login/register',
				type: 'POST',
				dataType: 'json',
				data: {
					name: name,
					account: account,
					passwd: passwd,
					passwd2: passwd2,
					email: email,
					sex: sex
				},
				success: function (res) {
					if(res.status == "success"){
						success_toast('註冊資訊', res.message);
						android.showToast(res.message);
						$('#login-form-link').click();
						$("#register_form input[type='text']").val('');
						// window.location = '<?=base_url()?>' + 'login/login';
					} else {
						error_toast('註冊資訊', res.message);
					}
				}
			});
		}
	}
	
	function check(name,account,passwd,passwd2,email){
		if(name && account && passwd && passwd2 && email){
			return true;
		} else {
			warning_toast(null, '表格不能為空');
			return false;
		}
	}
	function check_email(email){
		var pattern = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/; 
		flag = pattern.test(email); 
		if(flag){
			return true;
		} else {
			warning_toast(null, '請輸入正確的Email!!');
			return false;
		}
	}
		function testf(){
			
		}
</script>

