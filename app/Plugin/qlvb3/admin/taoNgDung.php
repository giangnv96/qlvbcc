<h3>Tạo người dùng
</h3>
<form class="form-group" action="" method="post" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" name="id" value="<?php echo  @$data['Manager']['id'] ?>">
		<div class="col-md-6">
			<label>Tài khoản:</label>
			<input class="form-control" type="text" name="user" value="<?php echo  @$data['Manager']['user'] ?>" required>
		</div>
		<div class="col-md-6">
			<label>Mật khẩu:</label>
			<input class="form-control" type="password" name="pass" value="" required>
		</div>
		<div class="col-md-6">
			<label>Họ tên:</label>
			<input class="form-control" type="text" name="hoten" value="<?php echo  @$data['Manager']['hoten'] ?>">
		</div>
		<div class="col-md-6">
			<label>Địa chỉ:</label>
			<input class="form-control" type="text" name="diachi" value="<?php echo  @$data['Manager']['diachi'] ?>">
		</div>
		<div class="col-md-6">
			<label>Email:</label>
			<input class="form-control" type="email" name="email" value="<?php echo  @$data['Manager']['email'] ?>">
		</div>
		<div class="col-md-6">
			<label>Số điện thoại:</label>
			<input class="form-control" type="number" name="sdt" value="<?php echo  @$data['Manager']['sdt'] ?>">
		</div>
		<div class="col-md-6">
			<label>Loại người dùng:</label>
					<select name="loaind" class="form-control" required="">
						<option value="">Chọn quyền</option>
						<?php 
						global $listPer;
						foreach ($listPer as $key => $value) {
						 ?>
						<option value="<?php echo $value['Loaiquyen']['id'] ?>" <?php echo (isset($data['Manager']['permission'])&&$data['Manager']['permission']==$value['Loaiquyen']['id'])?'selected="selected"':"" ?>><?php echo $value['Loaiquyen']['name'] ?></option>
						<?php
						} ?>
					</select>
		</div>
	</div>
	<button type="submit" class="btn btn-danger">Lưu</button>
</form>