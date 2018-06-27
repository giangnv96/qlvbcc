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