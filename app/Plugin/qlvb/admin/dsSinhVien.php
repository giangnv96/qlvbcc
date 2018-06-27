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
<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoSV.php" class="btn btn-danger">Thêm</a>
<br>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
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
					$('#khoa').on('change', function(){
						var $this = $(this),
						$value = $this.val();
						if($value){
$("#nganh").load("<?php echo $urlPlugins ?>admin/qlvb-admin-loadNganh.php", {id: $value});
}
});
</script>
<script type="text/javascript">
					$('#khoahoc').on('change', function(){
						var $this = $(this),
						$value = $this.val();
						$value1 = $('#nganh').val();
						if($value){
$("#lop").load("<?php echo $urlPlugins ?>admin/qlvb-admin-loadLop.php", {idNganh: $value1,idKH: $value});
}
});
</script>
<script type="text/javascript">
		$('#nganh').on('change', function(){
			var $this = $(this),
			$value = $this.val();
			$value1 = $('#khoahoc').val();
			if($value){
$("#lop").load("<?php echo $urlPlugins ?>admin/qlvb-admin-loadLop.php", {idNganh: $value,idKH: $value1});
}
});
</script>
		<div class="col-md-3">
			<input type="text" name="code" value="<?php echo @$_GET['code'] ?>" placeholder="Mã sinh viên" class="form-control">
		</div>
		<div class="col-md-3">
			<input type="text" name="name" value="<?php echo @$_GET['name'] ?>" placeholder="Họ tên" class="form-control">
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
		</div>
	</div>
</form>
<br>
<h3>Danh sách sinh viên</h3>
<table class="table table-hover">
	<thead>
		<tr>
			<th>STT</th>
			<th>Tên sinh viên</th>
			<th>Lớp</th>
			<th>Mã sinh viên</th>
			<th>Ngày sinh</th>
			<th>Nơi sinh</th>
			<th>Địa chỉ</th>
			<th>Trạng thái</th>
			<th>Hành động</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		global $tinhtrang;
		if (!empty($listData)) {
			if (!isset($_GET['page'])) {
			$i=0;
		}
		elseif (isset($_GET['page'])&&$_GET['page']==1) {
			$i=0;
		}elseif (isset($_GET['page'])>=2)
		{
			$i=$_GET['page']*20-20;
		}
			foreach ($listData as $key => $value) {
				$lop=getLopByID($value['Sinhvien']['idLop']);
				$i++;	
				$tinhtrang= tinhtrang($value['Sinhvien']['tinhtrang']);
		 ?>
		 <tr>
			<td><?php echo $i ?></td>
			<td><?php echo $value['Sinhvien']['hoten'] ?></td>
			<td><?php echo $lop['Lop']['code'] ?></td>
			<td><?php echo $value['Sinhvien']['masv'] ?></td>
			<td><?php echo $value['Sinhvien']['ngaysinh'] ?></td>
			<td><?php echo @$value['Sinhvien']['noisinh'] ?></td>
			<td><?php echo @$value['Sinhvien']['diachi'] ?></td>
			<td><?php echo $tinhtrang ?></td>
			<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoSV.php?idLop=<?php echo $value['Sinhvien']['idLop'] ?>&id=<?php echo $value['Sinhvien']['id'] ?>" title="">Sửa</a>|
				<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delSV.php?idLop=<?php echo $value['Sinhvien']['idLop'] ?>&id=<?php echo $value['Sinhvien']['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
			</td>
		</tr>
		<?php 
	}}
	else{
		echo '<td colspan="9" rowspan="" headers="" class="text-center">Chưa có dữ liệu</td>';
	}
		 ?>
	</tbody>
</table>
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