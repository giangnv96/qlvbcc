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
<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoLop.php" class="btn btn-danger">Thêm</a>
<br>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<div class="col-md-6">
			<input type="text" placeholder="Nhập mã lớp" class="form-control" name="key" value="<?php echo @trim($_GET['key']) ?>">
		</div>
		<div class="col-md-6">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
		</div>
	</div>
</form>
<br>
<table class="table table-bordered table-hover">
	<tr>
		<th>STT</th>
		<th>Mã lớp</th>
		<th>Tên lớp </th>
		<th>Khóa học</th>
		<th>Ngành</th>
		<th>Hành động</th>
	</tr>
	<?php 
	if (!empty($listData)) {
		$i=0;
		foreach ($listData as $key => $value) {
			$i++;
			$nganh = getNganhById($value['Lop']['nganh']);
			$kh = getKHById($value['Lop']['khoahoc']);
		?>
		<tr>
		<td><?php echo $i ?></td>
		<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-dsSV.php?idLop=<?php echo $value['Lop']['id'] ?>" title=""><?php echo $value['Lop']['code'] ?></a></td>
		<td><?php echo $value['Lop']['name'] ?></td>
		<td><?php echo $kh['Khoahoc']['code'] ?></td>
		<td><?php echo $nganh['Nganh']['name'] ?></td>
		<td>
			<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoLop.php?id=<?php echo $value['Lop']['id'] ?>" title="">Sửa</a>|
				<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delLop.php?id=<?php echo $value['Lop']['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a> | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoSV.php?idLop=<?php echo $value['Lop']['id'] ?>" title="">Thêm sinh viên</a>
		</td>
	</tr>
		<?php
	}}
	else
	{
		echo '<td colspan="6" rowspan="" headers="" class="text-center">Chưa có dữ liệu</td>';
	}
	 ?>
</table>