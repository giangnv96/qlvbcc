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
<br>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" id="id" name="id" value="">
		<div class="col-md-6">
			<label>Hình thức đào tạo</label>
			<input type="text" class="form-control" id="name" name="name" value="" required="">
		</div>
	</div>
	<br>
	<button type="submit">Lưu</button>
	<br>
</form>
<table class="table table-bordered table-hover">
	<tr>
		<th>STT</th>
		<th>Tên</th>
		<th>Hành động</th>
	</tr>
	<?php if (!empty($listData)) {
		$i=0;
	foreach ($listData as $key => $value) {
	 	$i++; ?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $value['Hinhthucdt']['name'] ?></td>
		<td><a href="#" onclick='edit("<?php echo $value['Hinhthucdt']['id'] ?>","<?php echo $value['Hinhthucdt']['name'] ?>")' title="">Sửa</a>|<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delHinhthucdt.php?id=<?php echo $value['Hinhthucdt']['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"  title="">Xóa</a></td>
	</tr>
	<?php }
	}else
	echo '<tr>
<td colspan="6" rowspan="" headers="" align="center">Chưa có dữ liệu</td></tr>'; ?>
</table>
<script>
	function edit(id,name)
	{
		document.getElementById("id").value = id;
		document.getElementById("name").value = name;
	}
</script>