<br>
<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-timXacMinh.php" title="" class="btn btn-warning">Thêm mới</a>
<br>
<h3>Danh sách xác minh</h3>
<table class="table table-hover">
	<thead>
		<tr>
			<th>STT</th>
			<th>Đơn vị yêu cầu</th>
			<th>Ngày tạo</th>
			<th>Trạng thái</th>
			<th>Hành động</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if (!empty($listData)) {
			$i=0;
		 	foreach ($listData as $key => $value) {
		 		$i++;
		 		?>
		 		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $value['Xacminh']['donvi'] ?></td>
			<td><?php echo $value['Xacminh']['ngaytao'] ?></td>
			<td><?php echo ($value['Xacminh']['trangthai']=='1')?'Tìm thấy':'Không tìm thấy' ?></td>
			<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoXacMinh.php?id=<?php echo $value['Xacminh']['id'] ?>" title="">Sửa</a> | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-xoaXacMinh.php?id=<?php echo $value['Xacminh']['id'] ?>" title="">Xóa</a> | <a href="<?php echo $urlHomes ?>inXacminh?id=<?php echo $value['Xacminh']['id'] ?>" target="_blank" title="">In</a></td>
		</tr>
		 		<?php
		 	}
		 } ?>
	</tbody>
</table>