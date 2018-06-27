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
			<form action="" method="get" accept-charset="utf-8">
				<div class="col-md-2">
					<select name="" class="form-control">
						<option value="">Chọn khoa</option>
					</select>
				</div>
				<div class="col-md-2">
					<select name="" class="form-control">
						<option value="">Chọn ngành</option>
					</select>
				</div>
				<div class="col-md-2">
					<select name="" class="form-control">
						<option value="">Chọn lớp</option>
					</select>
				</div>
				<div class="col-md-2">
					<select name="" class="form-control">
						<option value="">Chọn loại</option>
						<option value="vb">Văn bằng</option>}
						<option value="cc">Chứng chỉ</option>}
					</select>
				</div>
				<div class="col-md-4">
					<button type="submit" class="btn btn-primary" name="search">Tìm kiếm</button>
				</div>
				
			</form>
		</div>
		<hr>
		<div class="row">
			<table class="table table-responsive table-hover table-bordered">
				<thead>
					<tr>
						<th>STT</th>
						<th>Họ tên</th>
						<th>Mã SV</th>
						<th>Mã lớp</th>
						<th>Ngành</th>
						<th>Loại sinh viên</th>
						<th>Loại VB/CC</th>
						<th>Mã VB/CC</th>
						<th>Ngày cấp</th>
						<th>Người cấp</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			<form action="" method="post" accept-charset="utf-8">
				<div class="col-md-2">
					<button type="submit" class="btn btn-primary" name="export">Xuất excel</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>