<br>
<form action="" method="Post" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" name="id" value="<?php echo @$data['Xacminh']['id'] ?>">
		<input type="hidden" name="idxm" value="<?php echo @$_GET['idxm'] ?>">
		<input type="hidden" name="trangthai" value="<?php echo (!empty(@$_GET['idxm']))?'1':'0' ?>">
		<input type="hidden" name="loai" value="<?php echo (!empty($_GET['loai']))?'$_GET["loai"]':'' ?>">
		<div class="col-md-6">
			<label>Đơn vị:</label>
			<input type="text" class="form-control" name="donvi" value="<?php echo @$data['Xacminh']['donvi'] ?>" required="">
		</div>
		<!-- <div class="col-md-6">
			<label>Ngày tạo:</label>
			<input type="date"  class="form-control" name="ngaytao" value="<?php echo @$data['Xacminh']['ngaytao'] ?>" required="">
		</div> -->
		<div class="col-md-12">
			<label>Lý do:</label>
			<textarea name="lydo"  class="form-control" rows="5" required=""><?php echo @$data['Xacminh']['lydo'] ?></textarea>
		</div>
		<div class="col-md-12">
			<label>Ảnh VB/CC (nếu có):</label>
			<br>
			<?php showUploadFile('img','img',@$data['Xacminh']['img']) ?>
		</div>
	</div>
	<br>
	<input type="submit" class="btn btn-success" value="Lưu" name="submit">
	<button onclick="goBack()" class="btn btn-danger">Quay lại</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</form>