<br>
<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoSV.php" class="btn btn-danger">Thêm</a>
<br>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<div class="col-md-5">
			<input type="text" name="code" value="<?php echo @$_GET['code'] ?>" placeholder="Mã sinh viên" class="form-control">
		</div>
		<div class="col-md-5">
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