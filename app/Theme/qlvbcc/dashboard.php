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
	<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<div class="col-md-3">
			<label>Chọn khoa</label>
			<select name="id_khoa" id='khoa' class="form-control">
				<option value="">Chọn khoa</option>
				<?php
				if (!empty($tmpVariable['dsKhoa'])) {
					foreach ($tmpVariable['dsKhoa'] as $key => $value) {
				?>
				<option value="<?php echo $value['Khoa']['id'] ?>"><?php echo $value['Khoa']['name'] ?></option>
				<?php
				}
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<label>Chọn ngành</label>
			<select name="id_nganh" id="nganh" class="form-control">
				<option value="">Chọn ngành</option>
			</select>
		</div>
		<div class="col-md-3">
			<label>Chọn khóa học</label>
			<select name="id_kh" id='khoahoc' class="form-control">
				<option value="">Chọn khóa học</option>
				<?php
				if (!empty($tmpVariable['dsKH'])) {
					foreach ($tmpVariable['dsKH'] as $key => $value) {
				?>
				<option value="<?php echo $value['Khoahoc']['id'] ?>"><?php echo $value['Khoahoc']['code'] ?></option>
				<?php
				}
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<label>Chọn lớp</label>
			<select name="idLop" id="lop" class="form-control">
				<option value="">Chọn lớp</option>
			</select>
		</div>
		
		<script type="text/javascript">
				$(document).ready(function(){
					$('#khoa').on('change', function(){
						var $this = $(this),
						$value = $this.val();
						if($value){
$("#nganh").load("<?php echo $urlPlugins ?>admin/qlvb-admin-loadNganh.php", {id: $value});
}
});
});
</script>
<script type="text/javascript">
				$(document).ready(function(){
					$('#khoahoc').on('change', function(){
						var $this = $(this),
						$value = $this.val();
						$value1 = $('#nganh').val();
						if($value){
$("#lop").load("<?php echo $urlPlugins ?>admin/qlvb-admin-loadLop.php", {idNganh: $value1,idKH: $value});
}
});
});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#nganh').on('change', function(){
			var $this = $(this),
			$value = $this.val();
			$value1 = $('#khoahoc').val();
			if($value){
$("#lop").load("<?php echo $urlPlugins ?>admin/qlvb-admin-loadLop.php", {idNganh: $value,idKH: $value1});
}
});
});
</script>
		<div class="col-md-3">
			<label>Số hiệu:</label>
			<input type="text" name="sohieu" class="form-control" placeholder="Số hiệu" value="<?php echo @$_GET['sohieu'] ?>">
		</div>
		<div class="col-md-3">
			<label>Số vào sổ:</label>
			<input type="text" name="sovaoso" class="form-control" placeholder="Số vào sổ" value="<?php echo @$_GET['sovaoso'] ?>">
		</div>
		<div class="col-md-3">
			<label>Ngày cấp:</label>
			<input type="date" name="ngaycap" class="form-control" placeholder="Ngày cấp" value="<?php echo @$_GET['ngaycap'] ?>">
		</div>
		<div class="col-md-3">
			<label>Chọn loại VB/CC:</label>
			<select name="loai" class="form-control" required="">
						<option value="">Chọn loại</option>
						<?php
						if (!empty($tmpVariable['loai'])) {
						 	foreach ($tmpVariable['loai'] as $key => $value) { ?>
						 		<option value="<?php echo $value['Loai']['loai'].'-'.$value['Loai']['id'] ?>" <?php echo (!empty($_REQUEST['loai'])&&$_REQUEST['loai']==$value['Loai']['loai'].'-'.$value['Loai']['id']) ?'selected' :'' ?>><?php echo $value['Loai']['name'] ?></option>
						 	<?php }
						 } 
						 ?>
				</select>
		</div>

	<br>
	<div class="col-md-3">
		<button type="submit" class="btn btn-primary">Tìm kiếm</button>
	</div>
	</div></form>
	<br>
<?php 
if (!empty($tmpVariable['all'])) {
 ?>
<div class="container">
	<div class="row">
		<div class="progress">
  	<?php 
  	$all = $tmpVariable['all'];
  	$xx = $tmpVariable['xx'];
  	$kha = $tmpVariable['kha'];
  	$gioi = $tmpVariable['gioi'];
  	$tb = $tmpVariable['tb'];
  	$tong = (!empty($all))?count($all):1;
  	$ptxx= ($xx/($tong))*100;
  	$ptg= ($gioi/($tong))*100;
  	$ptk= ($kha/($tong))*100;
  	$pttb= ($tb/($tong))*100;
  	$ptxx = round($ptxx,1);
  	$ptg = round($ptg,1);
  	$ptk = round($ptk,1);
  	$pttb = round($pttb,1);
  	 ?>
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:<?php echo $ptxx ?>%">
    	<?php echo $ptxx ?>%
    </div>
    <div class="progress-bar progress-bar-primary" role="progressbar" style="width:<?php echo $ptg ?>%">
    	<?php echo $ptg ?>%
    </div>
    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?php echo $ptk ?>%">
    	<?php echo $ptk ?>%
    </div>
    <div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?php echo $pttb ?>%">
    	<?php echo $pttb ?>%
    </div>
  </div>
  <div class="container">
  	<div class="row">
  	<div class="col-md-8 col-md-offset-2">
  		<table class="table table-bordered">
  	<thead>
  		<tr>
  			<th class="tt"></th>
  			<th class="xx">Xuất sắc</th>
  			<th class="g">Giỏi</th>
  			<th class="k">Khá</th>
  			<th class="tb">Trung bình</th>
  		</tr>
  	</thead>
  	<tbody>
  		<tr>
  			<td align="right"><strong>Số lượng:</strong></td>
  			<td><?php echo $tmpVariable['xx'] ?></td>
  			<td><?php echo $tmpVariable['gioi'] ?></td>
  			<td><?php echo $tmpVariable['kha'] ?></td>
  			<td><?php echo $tmpVariable['tb'] ?></td>
  		</tr>
  		<tr>
  			<td align="right"><strong>Tổng:</strong></td>
  			<td><strong><?php echo count($tmpVariable['all'])?></strong></td>
  			<td></td>
  			<td></td>
  			<td></td>
  		</tr>
  	</tbody>
  </table>
  	</div>
  </div>
  </div>
<style type="text/css" media="screen">
	p
	{
		font-size: 25px;
	}
	.glyphicon
	{
		color: #1dd212
	}
	.progress
	{
		height: 30px;
	}
	.xx{
		color: white;
		background-color: #5cb85c;
		width: 60px;
	}
	.g{
		color: white;
		background-color: #428bca;
		width: 60px;
	}
	.k{
		color: white;
		background-color: #f0ad4e;
		width: 60px;
	}
	.tb{
		color: white;
		background-color: #d9534f;
		width: 60px;
	}
	.tt
	{	background-color: #ddd;
		width: 60px;
		font-size:bold;
	}

</style>
	</div>
</div>
<?php } ?>
<br>
<div class="row">
	<table class="table table-responsive table-hover table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Họ tên</th>
				<th>Mã SV</th>
				<th>Nơi sinh</th>
				<th>Mã lớp</th>
				<th>Loại VB</th>
				<th>Xếp loại</th>
				<th>Ngày cấp</th>
				<th>Người cấp</th>
				<th>Chức vụ</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($tmpVariable['listData'])) {
				$i=0;
				
				$modelSV = new Sinhvien();
				$modelLop = new Lop();
				$modelLoai = new Loai();
				foreach ($tmpVariable['listData'] as $key => $value) {
					$i++;
					$sv= $modelSV->getDataById($value['id_sv']);
					$lop= $modelLop->getListById($value['idLop']);
					$loaivb = $modelLoai->getDataById($value['loai']);
					$xl = getXLById($value['id_xl']);
			?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $sv['Sinhvien']['hoten'] ?></td>
				<td><?php echo $sv['Sinhvien']['masv'] ?></td>
				<td><?php echo $sv['Sinhvien']['noisinh'] ?></td>
				<td><?php echo $lop['Lop']['code'] ?></td>
				<td><?php echo @$loaivb['Loai']['name'] ?> </td>
				<td><?php echo @$xl ?> </td>
				<td><?php echo $value['ngaycap'] ?></td>
				<td><?php echo $value['nguoicap'] ?></td>
				<td><?php echo $value['chucvu'] ?></td>
			</tr>
			<?php
			}
			}
			?>
			
		</tbody>
	</table>
	
</div>
<div class=" text-center p_navigation" style="<?php if((!empty($tmpVariable['totalPage'])&&$tmpVariable['totalPage']==1)||empty($tmpVariable['listData'])) echo'display: none;';?>">
<nav aria-label="Page navigation">
	<ul class="pagination">
		<?php
		if ($tmpVariable['page'] > 4) {
			$startPage = $page - 4;
		} else {
			$startPage = 1;
		}
		if ($tmpVariable['totalPage'] > $tmpVariable['page'] + 4) {
			$endPage = $tmpVariable['page'] + 4;
		} else {
			$endPage = $tmpVariable['totalPage'];
		}
		?>
		<li class="<?php if($tmpVariable['page']==1) echo'disabled';?>">
			<a href="<?php echo $tmpVariable['urlPage'] . $tmpVariable['back']; ?>" aria-label="Previous">
				<span aria-hidden="true">«</span>
			</a>
		</li>
		<?php
		for ($i = $startPage; $i <= $endPage; $i++) {
			if ($i != $tmpVariable['page']) {
					echo '	<li><a href="' . $tmpVariable['urlPage'] . $i . '">' . $i . '</a></li>';
			} else {
				echo '<li class="active"><a href="' . $tmpVariable['urlPage'] . $i . '">' . $i . '</a></li>';
			}
		}
		?>
		<li class="<?php if($tmpVariable['page']==$endPage) echo'disabled';?>">
			<a href="<?php echo $tmpVariable['urlPage'] . $tmpVariable['next'] ?>" aria-label="Next">
				<span aria-hidden="true">»</span>
			</a>
		</li>
	</ul>
</nav>
</div>
</body>
</html>