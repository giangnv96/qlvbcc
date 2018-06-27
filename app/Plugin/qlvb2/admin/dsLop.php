<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoLop.php" class="btn btn-danger">Thêm</a>

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