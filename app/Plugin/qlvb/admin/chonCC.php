<br><h3>Chọn loại văn bằng</h3>
<form action="<?php echo $urlPlugins ?>admin/qlvb-admin-chonSVCC.php" method="GET" accept-charset="utf-8">
	<div class="row">
		<div class="col-md-4">
			<input type="hidden" name="idLop" value="<?php echo $idLop ?>">
			<label>Chọn loại chứng chỉ</label>
			<select name="loaivb" required="" class="form-control">
				<?php 
				foreach ($loai as $key => $value) {
				 ?>
				 <option value="<?php echo $value['Loai']['id'] ?>" ><?php echo $value['Loai']['name'] ?></option>
				 <?php
				 } ?>
			</select>
		</div>
	</div>
	<br>
	<br>
	<button type="submit" class="btn btn-success">Chọn</button>
	<button onclick="goBack()" class="btn btn-danger">Quay lại</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</form>
