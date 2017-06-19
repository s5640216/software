<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Delivery</title>
		<?php include("css.php");?>
		<!--script-->
		<?php include("js.php");?>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<style>
		.detail{
			font-family:Book Antiqua;
			line-height: 28px;
			color:#006987;
			font-size:30px;
			text-align:center;
			text-transform: capitalize;<!--定義單字的第一個字母大寫，其他字母小寫-->
		}

		body {
			background-image:url('<?=base_url('assets/home/img/back-31.gif');?>');
　			background-repeat:no-repeat;
		}
	</style>
	<?
		if(!$this->session->userdata('isLogin')){
			include("sidebar/nologin_sidebar.php");
		} else {
			switch($this->session->userdata('purview')){
				case PURVIEW_MEMBER:
					include("sidebar/member_sidebar.php");
					break;
				case PURVIEW_SERVICE:
					include("sidebar/service_sidebar.php");
					break;
				case PURVIEW_ADMIN:
					include("sidebar/admin_sidebar.php");
					break;
				case PURVIEW_SUPERADMIN:
					include("sidebar/sidebar.php");
					break;
				default:
					include("sidebar/nologin_sidebar.php");
					break;
			}
			
		}
	?>

	<body>

		<?= $content; ?>

	</body>

</html>

<!-- Custom Theme JavaScript -->
    <script>
		var base_url = function () {
            return '<?=base_url()?>';
        };
	function logout(){
		confirm_alert("確定登出?", function(e){
			if(e){
				document.location.href= "<?=base_url();?>login/login/logout";
			} 
		});
	}
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Scrolls to the selected menu item on the page
    $(function() {
        /*$('a[href*=#]:not([href=#],[data-toggle],[data-target],[data-slide])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });*/
    });
    //#to-top button appears after scrolling
    var fixed = false;
    $(document).scroll(function() {
        if ($(this).scrollTop() > 250) {
            if (!fixed) {
                fixed = true;
                // $('#to-top').css({position:'fixed', display:'block'});
                $('#to-top').show("slow", function() {
                    $('#to-top').css({
                        position: 'fixed',
                        display: 'block'
                    });
                });
            }
        } else {
            if (fixed) {
                fixed = false;
                $('#to-top').hide("slow", function() {
                    $('#to-top').css({
                        display: 'none'
                    });
                });
            }
        }
    });
    
    </script>
