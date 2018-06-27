<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Danh sách văn bằng</title>
<link rel="shortcut icon" href="logo-icon.png"> 
	<link rel="stylesheet" type="text/css" href="<?php echo $urlThemeActive ?>1.css">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="head">
		<div class="container">
			<div class="row">
				<p>Xin chào: <strong><?php echo $_SESSION['infoManager']['Manager']['hoten'] ?></strong> | <a href="/logout" onclick="return confirm('Bạn có chắc chắn muốn thoát không ?')" title=""><button type="" class="btn btn-success"><span class="glyphicon glyphicon-log-out"></span> Log out</button></a></p>
			</div>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="row">
			<div class="logo">
				<div class="img-logo">
					<a href=""><img src="<?php echo $urlThemeActive ?>logo.png" alt=""></a>
				</div>
			</div>
		</div>
	</div>
	<div class="tit">
		<p>Hệ thống quản lý văn bằng, chứng chỉ trường ĐH CNGTVT</p>
	</div>
	<br>
	<div class="container">
		<div class="row">
			<h3><strong><?php echo $tmpVariable['mess'] ?></strong></h3>
		</div>
	</div>
</body>
</html>