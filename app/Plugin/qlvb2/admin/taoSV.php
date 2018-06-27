<h3>Tạo người dùng
</h3>
<form class="form-group" action="" method="post" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" name="idLop" value="<?php echo $_GET['idLop'] ?>">
		<input type="hidden" name="id" value="<?php echo  @$data['Sinhvien']['id'] ?>">
		<div class="col-md-6">
			<label>Mã sinh viên:</label>
			<input class="form-control" type="text" name="code" value="<?php echo  @$data['Sinhvien']['code'] ?>" required>
		</div>
		<div class="col-md-6">
			<label>Họ tên:</label>
			<input class="form-control" type="text" name="hoten" value="<?php echo  @$data['Sinhvien']['hoten'] ?>" required>
		</div>
		<div class="col-md-6">
			<label>Ngày sinh:</label>
			<input class="form-control" type="date" name="ngaysinh" value="<?php echo  @$data['Sinhvien']['ngaysinh'] ?>" required>
		</div>
		<div class="col-md-6">
			<label>Nơi sinh:</label>
			<input class="form-control" type="text" name="noisinh" value="<?php echo  @$data['Sinhvien']['noisinh'] ?>" required>
		</div>
		<div class="col-md-6">
			<label>Giới tính:</label>
			<select name="gioitinh" class="form-control" required="">
				<option value="1" <?php echo  (isset($data['Sinhvien']['gioitinh'])&&$data['Sinhvien']['gioitinh']==1)?'selected':'' ?>>Nam</option>
				<option value="0" <?php echo  (isset($data['Sinhvien']['gioitinh'])&&$data['Sinhvien']['gioitinh']==0)?'selected':'' ?>>Nữ</option>
			</select>
		</div>
		<div class="col-md-6">
			<label>Số CMTND:</label>
			<input class="form-control" type="text" name="cmnd" value="<?php echo  @$data['Sinhvien']['cmnd'] ?>" required>
		</div>
		<div class="col-md-6">
			<label>Địa chỉ:</label>
			<input class="form-control" type="text" name="diachi" value="<?php echo  @$data['Sinhvien']['diachi'] ?>" required>
		</div>
		<div class="col-md-6">
			<label>Email:</label>
			<input class="form-control" type="email" name="email" value="<?php echo  @$data['Sinhvien']['email'] ?>" required>
		</div>
		<div class="col-md-6">
			<label>Số điện thoại:</label>
			<input class="form-control" type="number" name="sdt" value="<?php echo  @$data['Sinhvien']['sdt'] ?>" required>
		</div>
		<div class="col-md-6">
			<label>Tình trạng:</label>
					<select name="tinhtrang" class="form-control" required="">
				<?php 
				global $tinhtrang;
				if (!empty($tinhtrang)) {
					foreach ($tinhtrang as $key => $value) {
						?>
						<option value="<?php echo $value['id'] ?>" <?php (!empty($data['Lop']['tinhtrang'])&&$value['id']==$data['Lop']['tinhtrang'])?'selected':'' ?>><?php echo $value['name'] ?></option>
						<?php
					}
				}
				 ?>
			</select>
		</div>
	</div>
	<button type="submit" class="btn btn-danger">Lưu</button>
</form>