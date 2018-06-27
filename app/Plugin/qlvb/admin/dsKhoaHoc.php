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
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" id='id' name="id" value="">
		<div class="col-md-6">
			<label>Mã khóa học</label>
			<input type="text" id='code' class="form-control" name="code" value="">
		</div>
		<div class="col-md-6">
			<label>Thời gian</label>
			<input type="text" id='time' class="form-control" name="time" value="">
		</div>
		<br>
		<div class="col-md-6">
			<button type="submit" class="btn btn-success">Lưu</button>
		</div>
	</div>
</form>
<br>
<table class="table table-responsive"> 
	<thead>
		<tr>
			<th>STT</th>
			<th>Mã</th>
			<th>Thời gian</th>
			<th>Hành động</th>
		</tr>
	</thead>
	<?php if (!empty($listData)) {
		$i=0;
	foreach ($listData as $key => $value) {
	 	$i++; ?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $value['Khoahoc']['code'] ?></td>
		<td><?php echo $value['Khoahoc']['time'] ?></td>
		<td><a href="#" onclick='edit("<?php echo $value['Khoahoc']['id'] ?>","<?php echo $value['Khoahoc']['code'] ?>","<?php echo $value['Khoahoc']['time'] ?>")' title="">Sửa</a>|<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delKhoahoc.php?id=<?php echo $value['Khoahoc']['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"  title="">Xóa</a></td>
	</tr>
	<?php }
	}else
	echo '<tr>
<td colspan="6" rowspan="" headers="" align="center">Chưa có dữ liệu</td></tr>'; ?>
</table>
<script>
	function edit(id,code,time)
	{
		document.getElementById("id").value = id;
		document.getElementById("time").value = time;
		document.getElementById("code").value = code;
	}
</script>