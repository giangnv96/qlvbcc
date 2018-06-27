<h3>Tạo người dùng
</h3>
<form class="form-group" action="" method="post" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" name="id" value="<?php echo  @$data['Sinhvien']['id'] ?>">
		<div class="col-md-6">
			<label>Mã sinh viên:</label>
			<input class="form-control" type="text" name="code" value="<?php echo  @$data['Sinhvien']['masv'] ?>" required>
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
			<input class="form-control" type="text" name="noisinh" value="Hà Nội" >
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
			<input class="form-control" type="text" name="cmnd" value="<?php echo  @$data['Sinhvien']['cmnd'] ?>" >
		</div>
		<div class="col-md-6">
			<label>Địa chỉ:</label>
			<input class="form-control" type="text" name="diachi" value="<?php echo  @$data['Sinhvien']['diachi'] ?>" >
		</div>
		<div class="col-md-6">
			<label>Email:</label>
			<input class="form-control" type="email" name="email" value="<?php echo  @$data['Sinhvien']['email'] ?>" >
		</div>
		<div class="col-md-6">
			<label>Số điện thoại:</label>
			<input class="form-control" type="number" name="sdt" value="<?php echo  @$data['Sinhvien']['sdt'] ?>" >
		</div>
		<div class="col-md-6">
			<label>Chọn lớp:</label>
					<select name="idLop" class="form-control" required="">
				<?php 
				$lop = new Lop();
				$listClass = $lop->find('all');
				if (!empty($listClass)) {
					foreach ($listClass as $key => $value) {
						?>
						<option value="<?php echo $value['Lop']['id'] ?>" <?php echo ((!empty($data['Sinhvien']['idLop'])&&$value['Lop']['id']==$data['Sinhvien']['idLop'])||($value['Lop']['id']==@$_GET['idLop']))?'selected':'' ?>><?php echo $value['Lop']['name'] ?></option>
						<?php
					}
				}
				 ?>
			</select>
		</div>
		<div class="col-md-6">
			<label>Tình trạng:</label>
					<select name="tinhtrang" class="form-control" required="">
				<?php 
				global $tinhtrang;
				if (!empty($tinhtrang)) {
					foreach ($tinhtrang as $key => $value) {
						?>
						<option value="<?php echo $value['id'] ?>" <?php echo (!empty($data['Sinhvien']['tinhtrang'])&&$value['id']==$data['Sinhvien']['tinhtrang'])?'selected':'' ?>><?php echo $value['name'] ?></option>
						<?php
					}
				}
				 ?>
			</select>
		</div>
	</div>
	<button type="submit" class="btn btn-danger">Lưu</button>
	<button onclick="goBack()" class="btn btn-danger">Quay lại</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</form>