<br>
<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoNgDung.php" class="btn btn-danger">Thêm</a> | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-phanquyen.php" class="btn btn-primary" title="">Thêm quyền</a>
<br>

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
			$i=0;
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
			<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoNgDung.php?id=<?php echo $value['Manager']['id'] ?>" title="">Sửa</a>|
				<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delManager.php?id=<?php echo $value['Manager']['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
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