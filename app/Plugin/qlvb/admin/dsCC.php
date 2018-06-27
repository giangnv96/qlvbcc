<script type="text/javascript">
	<?php 
    switch (@$_GET['stt']) {
    	case '1':
    		echo "alert('Thêm mới thành công')";
    		break;
    	case '2':
    		echo "alert('Cập nhật thành công')";
    		break;
    	case '3':
    		echo "alert('Xóa dữ liệu thành công')";
    		break;
    	
    	default:
    		break;
    }
        if (!empty($_GET['error'])&&$_GET['error']==-1) {
    		echo "alert('Xóa dữ liệu thất bại. Kiểm tra các dữ liệu còn tồn tại')";
    }

	 ?>
</script>
<br>
<div class="row">
	<form action="" method="get" accept-charset="utf-8">
		<div class="col-md-3">
			<select name="id_khoa" id='khoa' class="form-control">
				<option value="">Chọn khoa</option>
				<?php
				if (!empty($dsKhoa)) {
					foreach ($dsKhoa as $key => $value) {
				?>
				<option value="<?php echo $value['Khoa']['id'] ?>"><?php echo $value['Khoa']['name'] ?></option>
				<?php
				}
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<select name="id_nganh" id="nganh" class="form-control">
				<option value="">Chọn ngành</option>
			</select>
		</div>
		<div class="col-md-3">
			<select name="id_kh" id='khoahoc' class="form-control">
				<option value="">Chọn khóa học</option>
				<?php
				if (!empty($dsKH)) {
					foreach ($dsKH as $key => $value) {
				?>
				<option value="<?php echo $value['Khoahoc']['id'] ?>"><?php echo $value['Khoahoc']['code'] ?></option>
				<?php
				}
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
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
				<select name="loai" class="form-control">
						<option value="">Chọn loại Chứng chỉ</option>
						<?php
						if (!empty($loai)) {
						 	foreach ($loai as $key => $value) { ?>
						 		<option value="<?php echo $value['Loai']['id'] ?>" <?php echo (!empty($_REQUEST['loai'])&&$_REQUEST['loai']==$value['Loai']['id']) ?'selected' :'' ?>><?php echo $value['Loai']['name'] ?></option>
						 	<?php }
						 } 
						 ?>
				</select>
		</div>
		<div class="col-md-3">
			<input type="text" name="sohieu" class="form-control" placeholder="Số hiệu" value="<?php echo @$_GET['sohieu'] ?>" >
		</div>
		<div class="col-md-3">
			<input type="text" name="sovaoso" class="form-control" placeholder="Số vào sổ" value="<?php echo @$_GET['sovaoso'] ?>" >
		</div>
		<div class="col-md-3">
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
				<th>Loại VB</th>
				<th>Xếp loại</th>
				<th>Ngày cấp</th>
				<th>Người cấp</th>
				<th>Chức vụ</th>
				<th>Hành động</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($listData)) {
				$i=0;
				
				$modelSV = new Sinhvien();
				$modelLop = new Lop();
				$modelLoai = new Loai();
				foreach ($listData as $key => $value) {
					$i++;
					$sv= $modelSV->getDataById($value['Vbcc']['id_sv']);
					$lop= $modelLop->getListById($value['Vbcc']['idLop']);
					$loaivb = $modelLoai->getDataById($value['Vbcc']['loai']);
					$xl = getXLById($value['Vbcc']['id_xl']);
			?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $sv['Sinhvien']['hoten'] ?></td>
				<td><?php echo $sv['Sinhvien']['masv'] ?></td>
				<td><?php echo $lop['Lop']['code'] ?></td>
				<td><?php echo @$loaivb['Loai']['name'] ?> </td>
				<td><?php echo @$xl ?> </td>
				<td><?php echo $value['Vbcc']['ngaycap'] ?></td>
				<td><?php echo $value['Vbcc']['nguoicap'] ?></td>
				<td><?php echo $value['Vbcc']['chucvu'] ?></td>
				<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-editCC.php?id=<?php echo $value['Vbcc']['id'] ?>" title="">Sửa</a> | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delCC.php?id=<?php echo $value['Vbcc']['id'] ?>" title="">Xóa</a> | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-CCdetail.php?id=<?php echo $value['Vbcc']['id'] ?>" title="">Chi tiết</a></td>
			</tr>
			<?php
			}
			}
			?>
			
		</tbody>
	</table>
	<!-- <form action="" method="post" accept-charset="utf-8">
			<div class="col-md-2">
					<button type="submit" class="btn btn-primary" name="export">Xuất excel</button>
			</div>
	</form> -->
</div>
<div class=" text-center p_navigation" style="<?php if(($totalPage==1)||empty($listData)) echo'display: none;';?>">
<nav aria-label="Page navigation">
	<ul class="pagination">
		<?php
		if ($page > 4) {
			$startPage = $page - 4;
		} else {
			$startPage = 1;
		}
		if ($totalPage > $page + 4) {
			$endPage = $page + 4;
		} else {
			$endPage = $totalPage;
		}
		?>
		<li class="<?php if($page==1) echo'disabled';?>">
			<a href="<?php echo $urlPage . $back; ?>" aria-label="Previous">
				<span aria-hidden="true">«</span>
			</a>
		</li>
		<?php
		for ($i = $startPage; $i <= $endPage; $i++) {
			if ($i != $page) {
					echo '	<li><a href="' . $urlPage . $i . '">' . $i . '</a></li>';
			} else {
				echo '<li class="active"><a href="' . $urlPage . $i . '">' . $i . '</a></li>';
			}
		}
		?>
		<li class="<?php if($page==$endPage) echo'disabled';?>">
			<a href="<?php echo $urlPage . $next ?>" aria-label="Next">
				<span aria-hidden="true">»</span>
			</a>
		</li>
	</ul>
</nav>
</div>