<br>
<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoNgDung.php" class="btn btn-danger">Thêm</a>
<!--  | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-phanquyen.php" class="btn btn-primary" title="">Thêm quyền</a>
--><br>
<?php
if (!empty($_GET['stt'])) {
	switch ($_GET['stt']) {
		case '1':
			echo "<span style='color:red'>Thêm tài khoản thành công</span>";
			break;
		case '2':
			echo "<span style='color:red'>Cập nhật tài khoản thành công</span>";
			break;
		// case '':
			// 	# code...
			// 	break;
		
		default:
			# code...
			break;
	}
}
?>
<br>
<form action="" class="form-group">
	<div class="row">
		<div class="col-sm-3">
			<input type="text" class="form-control" value="<?php echo @arrayMap($_GET['']) ?>" placeholder="Họ tên" name="hoten">
		</div>
		<div class="col-sm-3">
			<input type="text" class="form-control" value="<?php echo @arrayMap($_GET['']) ?>" placeholder="Số điện thoại" name="sdt">
		</div>
		<div class="col-sm-3">
			<input type="text" class="form-control" value="<?php echo @arrayMap($_GET['']) ?>" placeholder="Địa chỉ" name="diachi">
		</div>
		<div class="col-sm-3">
			<input type="text" class="form-control" value="<?php echo @arrayMap($_GET['']) ?>" placeholder="Email" name="email">
		</div>
	</div>
	<br>
	<button type="submit" class="btn btn-info">Tìm kiếm</button>
</form>
<table class="table table-bordered table-hover table-responsive">
	<thead>
		<tr>
			<th>STT</th>
			<th>Tài khoản</th>
			<th>Họ tên</th>
			<th>Địa chỉ</th>
			<th>Số điện thoại</th>
			<th>Email</th>
			<th>Loại tài khoản</th>
			<th>Hành động</th>
		</tr>
	</thead>
	<tbody>
		<?php
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
			// $per = getPerById($value['Manager']['permission']);
		$i++;?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $value['Manager']['user'] ?></td>
			<td><?php echo $value['Manager']['hoten'] ?></td>
			<td><?php echo $value['Manager']['diachi'] ?></td>
			<td><?php echo $value['Manager']['sdt'] ?></td>
			<td><?php echo $value['Manager']['email'] ?></td>
			<td><?php echo ($value['Manager']['permission']==1 )?'Quản trị':'Sinh viên' ?></td>
			<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoNgDung.php?id=<?php echo $value['Manager']['id'] ?>" title="">Sửa</a>
			<?php
			if ($value['Manager']['permission']!="2") {
			?>
			| <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delManager.php?id=<?php echo $value['Manager']['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
			<?php
			} ?>
		</td>
	</tr>
	<?php }}
	else {
		echo '
	<tr>
		<td colspan="8" rowspan="" headers="" align="center">Chưa có dữ liệu</td>
	</tr>';
	} ?>
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