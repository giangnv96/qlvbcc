<br>
<form action="" method="Post" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" name="id" value="<?php echo @$data['Xacminh']['id'] ?>">
		<input type="hidden" name="idxm" value="<?php echo @$_GET['idxm'] ?>">
		<input type="hidden" name="trangthai" value="<?php echo (!empty(@$_GET['idxm']))?'1':'0' ?>">
		<input type="hidden" name="loai" value="<?php echo (!empty($_GET['loai']))?$_GET["loai"]:'' ?>">
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
		<?php 
		if (!empty($data)) {
		?>
		<div class="col-md-6">
			<label>Họ tên người cần xác minh:</label>
			<input type="text" class="form-control" name="hoten" value="<?php echo @$data['Xacminh']['hoten'] ?>" required="">
		</div>
		<div class="col-md-6">
			<label>Ngày sinh:</label>
			<input type="text" class="form-control" name="ngaysinh" value="<?php echo @$data['Xacminh']['ngaysinh'] ?>" required="">
		</div>
		<div class="col-md-6">
			<label>Nơi sinh:</label>
			<input type="text" class="form-control" name="noisinh" value="<?php echo @$data['Xacminh']['noisinh'] ?>" required="">
		</div>
		<div class="col-md-6">
			<label>Giới tính:</label>
			<input type="radio" name="gioitinh" <?php (@$data['Xacminh']['gioitinh']==1)?'checked':'' ?> required="">Nam
			<input type="radio" name="gioitinh" <?php (@$data['Xacminh']['gioitinh']==0)?'checked':'' ?> required="">Nữ
		</div>

		<?php
		}
		elseif (empty($dataSV)) {
		?>
		<div class="col-md-6">
			<label>Họ tên người cần xác minh:</label>
			<input type="text" class="form-control" name="hoten" value="" required="">
		</div>
		<div class="col-md-6">
			<label>Ngày sinh:</label>
			<input type="text" class="form-control" name="ngaysinh" value="" required="">
		</div>
		<div class="col-md-6">
			<label>Nơi sinh:</label>
			<input type="text" class="form-control" name="noisinh" value="" required="">
		</div>
		<div class="col-md-6">
			<label>Giới tính:</label>
			<input type="radio" value="1" name="gioitinh" required="">Nam
			<input type="radio" value="0" name="gioitinh" required="">Nữ
		</div>

		<?php
		}
		 ?>

		<div class="col-md-12">
			<label>Ảnh VB/CC (nếu có):</label>
			<br>
			<?php showUploadFile('img','img',@$data['Xacminh']['img']) ?>
		</div>
	</div>
	<br>
	<input type="submit" class="btn btn-success" value="Lưu" name="submit">
</form>