<br>
<br>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" id="id" name="id" value="">
		<div class="col-md-6">
			<label>Mã Ngành</label>
			<input type="text" class="form-control" id="code" name="code" value="" required>
		</div>
		<div class="col-md-6">
			<label>Tên Ngành</label>
			<input type="text" class="form-control" id="name" name="name" value="" required="">
		</div>
		<div class="col-md-6">
			<label>Mô tả</label>
			<textarea name="des" id="des" class="form-control"></textarea>
		</div>
		<div class="col-md-6">
			<label>Thuộc Khoa</label>
			<select name="khoa" id="khoa" class="form-control" required="">
				<option value="">Chọn khoa</option>
				<?php $dsKhoa = dsKhoaFun();
				foreach ($dsKhoa as $key => $value) {
				 ?>
				 <option value="<?php echo $value['Khoa']['id'] ?>")><?php echo $value['Khoa']['name'] ?></option>
				 <?php
				 } ?>
			</select>
		</div>
	</div>
	<br>
	<button type="submit">Lưu</button>
	<br>
</form>
<table class="table table-bordered table-hover">
	<tr>
		<th>STT</th>
		<th>Mã</th>
		<th>Tên</th>
		<th>Mô tả</th>
		<th>Khoa</th>
		<th>Hành động</th>
	</tr>
	<?php if (!empty($listData)) {
		$i=0;
	foreach ($listData as $key => $value) {
		$khoa = getKhoaById($value['Nganh']['khoa']);
	 	$i++; ?>
	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $value['Nganh']['code'] ?></td>
		<td><?php echo $value['Nganh']['name'] ?></td>
		<td><?php echo $value['Nganh']['des'] ?></td>
		<td><?php echo $khoa['Khoa']['name'] ?></td>
		<td><a href="#" onclick='edit("<?php echo $value['Nganh']['id'] ?>","<?php echo $value['Nganh']['code'] ?>","<?php echo $value['Nganh']['name'] ?>","<?php echo $value['Nganh']['des'] ?>", "<?php echo $value['Nganh']['khoa'] ?>")' title="">Sửa</a>|<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delNganh.php?id=<?php echo $value['Nganh']['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"  title="">Xóa</a></td>
	</tr>
	<?php }
	}else
	echo '<tr>
<td colspan="6" rowspan="" headers="" align="center">Chưa có dữ liệu</td></tr>'; ?>
</table>
<script>
	function edit(id,code,name,des,khoa)
	{
		document.getElementById("id").value = id;
		document.getElementById("name").value = name;
		document.getElementById("des").value = des;
		document.getElementById("code").value = code;
		document.getElementById("khoa").value = khoa;
	}
</script>