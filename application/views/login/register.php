<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CakeBETA註冊</title>
  <!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>">
		<link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap-theme.min.css');?>">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?=base_url('assets/AdminLTE/css/AdminLTE.min.css');?>">
		<!-- iCheck -->
		<link rel="stylesheet" href="<?=base_url('assets/plugins/iCheck/square/blue.css');?>">

</head>
<body class="hold-transition register-page">
	<div class="register-box">
		<div class="register-logo">
			<a href="<?=base_url()?>"><b>Cake</b>BETA</a>
		</div>
		<div class="register-box-body">
			<p class="login-box-msg">註冊一個新的帳號，成為我們的會員</p>
			<form >
				<div class="form-group has-feedback">
					<input type="text" class="name form-control" placeholder="名稱">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="text" class="account form-control" placeholder="帳號">
					<span class="fa fa-user-secret form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="passwd form-control" placeholder="密碼">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="passwd2 form-control" placeholder="確認密碼">
					<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="email" class="email form-control" placeholder="E-mail">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
				<span class="fa fa-venus-mars form-control-feedback"></span>
					<label>性別</label>
					<label class="radio-inline">
						<input type="radio" name="sex" value="男" checked> 男
					</label>
					<label class="radio-inline">
						<input type="radio" name="sex" value="女"> 女
					</label>
					
				</div>
			</form>
			<div class="row">
				<div class="col-xs-12">
					<button id="btnregister" class="btn btn-primary btn-block btn-flat">註冊</button>
				</div>
			</div>
			
			
			
			<a href="<?=base_url()?>login" class="text-center">我已經有帳號了</a>
		</div>
  <!-- /.form-box -->
	</div>
<!-- /.register-box -->
</body>
</html>

<!-- jQuery 2.2.3 -->
	<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
	<!-- iCheck -->
	<script src="<?=base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>

$(function () {
	
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
	
	$('#btnregister').click(function(){
		var name = $('.name').val();
		var account = $('.account').val();
		var passwd = $('.passwd').val();
		var passwd2 = $('.passwd2').val();
		var email = $('.email').val();
		var sex = $('input[name=sex]:checked').val();
		var check_status = check(name,account,passwd,passwd2,email);
		if(check_status == true && check_email(email) == true){
			$.ajax({
				url: '<?=base_url()?>login/register/register',
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
						alert(res.message);
						window.location = '<?=base_url()?>' + 'login';
					} else {
						alert(res.message);
					}
				}
			});
		}
	});
	
});
	function check(name,account,passwd,passwd2,email){
		if(name && account && passwd && passwd2 && email){
			return true;
		} else {
			alert("表格不能為空");
			return false;
		}
			
		
	}
	function check_email(email){
		var pattern = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/; 
		flag = pattern.test(email); 
		if(flag){
			return true;
		} else {
			alert('請輸入正確的Email!!'); 
			return false;
		}
  }
</script>


