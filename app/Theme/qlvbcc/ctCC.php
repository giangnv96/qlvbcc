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
				<p>Xin chào: <strong><?php echo $_SESSION['infoManager']['Manager']['hoten'] ?></strong> | <a href="/logout" onclick="return confirm('Bạn có chắc chắn muốn thoát không ?')" title=""><button type="" class="btn btn-success"><span class="glyphicon glyphicon-log-out"></span> Log out</button></a> | <a href="/changePass" title=""><button type="" class="btn btn-success"><span class="glyphicon glyphicon-cog"></span> Đổi mật khẩu</button></a></p>
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
			
<br>
<button onclick="goBack()" class="btn btn-danger">Quay lại</button>

<script>
function goBack() {
    window.history.back();
}
</script>
<br>
<style type="text/css" media="screen">
label
{
	color: #E11;
}
img
	{
		width: 600px;
	}
.cont-top 
{
	margin-top: 20px;
}
</style>
<div class="container cont-top">
	<div class="row">
		<div class="col-md-4">
			<label>Mã sinh viên:</label> <strong><?php echo @$tmpVariable['dataSV']['Sinhvien']['masv'] ?></strong>
		</div>
		<div class="col-md-4">
			<label>Họ tên:</label> <strong><?php echo @$tmpVariable['dataSV']['Sinhvien']['hoten'] ?></strong>
		</div>
		<div class="col-md-4">
			<label>Trạng thái:</label> <strong>Đã tốt nghiệp</strong>
		</div>
		<div class="col-md-4">
			<label>Khóa:</label> <strong><?php echo @$tmpVariable['khoahoc']['Khoahoc']['code'] ?></strong>
		</div>
		<div class="col-md-4">
			<label>Ngành:</label> <strong><?php echo @$tmpVariable['nganh']['Nganh']['name'] ?></strong>
		</div>
		<div class="col-md-4">
			<label>Lớp:</label> <strong><?php echo @$tmpVariable['dataLop']['Lop']['code'] ?></strong>
		</div>
		<div class="col-md-4">
			<label>Hệ đào tạo:</label> <strong><?php echo @$tmpVariable['hinhthuc'] ?>
		</div>
		<div class="col-md-4">
			<label>Từ ngày:</label> <strong><?php echo @$tmpVariable['data']['Vbcc']['tungay'] ?>
		</div>
		<div class="col-md-4">
			<label>Đến ngày:</label> <strong><?php echo @$tmpVariable['data']['Vbcc']['denngay'] ?>
		</div>
		<div class="col-md-4">
			<label>Hội đồng:</label> <strong><?php echo @$tmpVariable['data']['Vbcc']['hoidong'] ?>
		</div>
		<div class="col-md-4">
			<label>Ngày cấp:</label> <strong><?php echo @$tmpVariable['data']['Vbcc']['ngaycap'] ?>
		</div>
		<div class="col-md-4">
			<label>Người cấp:</label> <strong><?php echo @$tmpVariable['data']['Vbcc']['nguoicap'] ?>
		</div>
		<div class="col-md-4">
			<label>Chức vụ:</label> <strong><?php echo @$tmpVariable['data']['Vbcc']['chucvu'] ?></strong>
		</div>
		<div class="col-md-4">
			<label>Số hiệu:</label> <strong><?php echo @$tmpVariable['data']['Vbcc']['sohieu'] ?> 
		</div>
		<div class="col-md-4">
			<label>Số vào sổ cấp bằng:</label> <strong><?php echo @$tmpVariable['data']['Vbcc']['sovaoso'] ?></strong>
		</div>
		<div class="col-md-4">
			<label>Xếp loại:</label> <strong><?php echo $tmpVariable['xl'] ?></strong>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-4">
			<label>Ảnh:</label>
		</div>
	</div>
</div>
<!-- <p>Họ tên: <strong><?php echo @$tmpVariable['dataSV']['Sinhvien']['hoten'] ?></strong></p>
<p>Hệ đào tạo: <strong><?php echo @$tmpVariable['hinhthuc'] ?></strong></p>
<p>Ngày cấp: <strong><?php echo @$tmpVariable['data']['Vbcc']['ngaycap'] ?></strong></p>
<p>Người cấp: <strong><?php echo @$tmpVariable['data']['Vbcc']['nguoicap'] ?></strong></p>
<p>Từ ngày: <strong><?php echo @$tmpVariable['data']['Vbcc']['tungay'] ?></strong></p>
<p>Đến ngày: <strong><?php echo @$tmpVariable['data']['Vbcc']['denngay'] ?></strong></p>
<p>Chức vụ: <strong><?php echo @$tmpVariable['data']['Vbcc']['chucvu'] ?></strong></p>
<p>Số hiệu: <strong><?php echo @$tmpVariable['data']['Vbcc']['sohieu'] ?></strong></p>
<p>Số vào sổ cấp bằng: <strong><?php echo @$tmpVariable['data']['Vbcc']['sovaoso'] ?></strong></p>
<p>Xếp loại: <strong><?php echo @$tmpVariable['xl'] ?></strong></p>
<p>Ảnh:</p> -->
<div class="col-md-8 col-md-offset-2">
	<img src="<?php echo @$tmpVariable['data']['Vbcc']['img'] ?>" alt="">
</div>

		</div>
	</div>
</body>
</html>