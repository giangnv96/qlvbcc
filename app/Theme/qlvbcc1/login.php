<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="logo-icon.png"> 
		<title>Đăng nhập</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $urlThemeActive ?>1.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
		<style>

			.row
			{
				margin: auto;
		position: absolute;
		left: 0;
		right: 0;
		top: 50%;
		transform: translateY(-60%);
			}
		</style>
	</head>
	<body style="background-image: url(<?php echo $urlThemeActive ?>bg.png);">
		<div class="container">
			<div class="row text-center">
				<div class="form-login">
					<div class="content">
						<div class="img-logo">
							<img src="<?php echo $urlThemeActive ?>logo-log.png" alt="">
						</div>
						<form action="" method="post" accept-charset="utf-8">
							<div class="form-group">
								<input type="text" class="form-control form-input" name="user" value="" placeholder="Tài khoản"><i class="fa fa-envelope"></i>
							</div>
							<div class="form-group">
								
								<input type="password" class="form-control form-input" name="pass" value="" placeholder="Mật khẩu"><i class="fa fa-lock"></i>
							</div>
							<button class="form-control form-input" style="background-color: #FF9000;font-size:16px;color: #fff" type="submit">Đăng nhập</button>
							<p style="color: #8C918F">Liên hệ quản trị viên khi quên mật khẩu</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>