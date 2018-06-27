<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoSV.php?idLop=<?php echo $_GET['idLop'] ?>" class="btn btn-danger">Thêm</a>
<!-- <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-loaiSV.php" class="btn btn-info">Loại sinh viên</a> -->
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
			$i=0;
			foreach ($listData as $key => $value) {
				$lop=getLopByID($value['Sinhvien']['idLop']);
				$i++;	
				$tinhtrang= tinhtrang($value['Sinhvien']['tinhtrang']);
		 ?>
		 <tr>
			<td><?php echo $i ?></td>
			<td><?php echo $value['Sinhvien']['hoten'] ?></td>
			<td><?php echo $lop['Lop']['code'] ?></td>
			<td><?php echo $value['Sinhvien']['code'] ?></td>
			<td><?php echo $value['Sinhvien']['ngaysinh'] ?></td>
			<td><?php echo @$value['Sinhvien']['noisinh'] ?></td>
			<td><?php echo @$value['Sinhvien']['diachi'] ?></td>
			<td><?php echo $tinhtrang ?></td>
			<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoSV.php?idLop=<?php echo $value['Sinhvien']['idLop'] ?>&id=<?php echo $value['Sinhvien']['id'] ?>" title="">Sửa</a>|
				<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delSVphp?id=<?php echo $value['Sinhvien']['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
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