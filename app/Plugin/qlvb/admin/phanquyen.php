<br>
<br>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" id="id" name="id" value="">
		<!-- <div class="col-md-6">
			<label>Mã loại quyền</label>
			<input type="text" class="form-control" id="code" name="code" value="" required="">
		</div> -->
		<div class="col-md-6">
			<label>Tên loại quyền</label>
			<input type="text" class="form-control" id="name" name="name" value="" required="">
		</div>
		<div class="col-md-6">
			<label>Mô tả</label>
			<textarea name="des" id="des" class="form-control"></textarea>
		</div>
	</div>
	<br>
	<button type="submit">Lưu</button>
	<br>
</form>
<table class="table table-bordered table-hover">
	<tr>
		<th>STT</th>
<!-- 		<th>Mã</th>
 -->		<th>Tên</th>
		<th>Mô tả</th>
		<th>Hành động</th>
	</tr>
	<?php if (!empty($listData)) {
		$i=0;
	foreach ($listData as $key => $value) {
	 	$i++; ?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $value['Loaiquyen']['name'] ?></td>
		<td><?php echo $value['Loaiquyen']['des'] ?></td>
		<td><a href="#" onclick='edit("<?php echo $value['Loaiquyen']['id'] ?>","<?php echo $value['Loaiquyen']['name'] ?>","<?php echo $value['Loaiquyen']['des'] ?>")' title="">Sửa</a>|<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delLoaiquyen.php?id=<?php echo $value['Loaiquyen']['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" title="">Xóa</a></td>
	</tr>
	<?php }
	}else
	echo '<tr>
<td colspan="5" rowspan="" headers="" align="center">Chưa có dữ liệu</td></tr>'; ?>
</table>
<script>
	function edit(id,name,des)
	{
		document.getElementById("id").value = id;
		document.getElementById("name").value = name;
		document.getElementById("des").value = des;
	}
</script>