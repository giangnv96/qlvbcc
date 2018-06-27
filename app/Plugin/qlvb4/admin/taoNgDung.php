<h3>Tạo người dùng
</h3>
<form class="form-group" action="" method="post" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" name="id" value="<?php echo  @$data['Manager']['id'] ?>">
		<div class="col-md-6">
			<label>Tài khoản:</label>
			<input class="form-control" type="text" name="user" value="<?php echo  @$data['Manager']['user'] ?>" required 
			<?php 
			if (!empty($data['Manager']['permission'])&&$data['Manager']['permission']==2) {
			?>
			disabled>
			<input type="hidden" name="user" value="<?php echo  @$data['Manager']['user'] ?>">
			<?php
			}
			else
				echo ">";
			 ?>
		</div>
		<div class="col-md-6">
			<label>Mật khẩu:</label>
			<input class="form-control" type="password" name="pass" value="" required>
		</div>
		<div class="col-md-6">
			<label>Họ tên:</label>
			<input class="form-control" type="text" name="hoten" value="<?php echo  @$data['Manager']['hoten'] ?>"
			<?php 
			if (!empty($data['Manager']['permission'])&&$data['Manager']['permission']==2) {
			?>
			disabled>
			<input type="hidden" name="hoten" value="<?php echo  @$data['Manager']['hoten'] ?>">
			<?php
			}
			else
				echo ">";
			 ?>
		</div>
		<div class="col-md-6">
			<label>Địa chỉ:</label>
			<input class="form-control" type="text" name="diachi" value="<?php echo  @$data['Manager']['diachi'] ?>"
			<?php 
			if (!empty($data['Manager']['permission'])&&$data['Manager']['permission']==2) {
			?>
			disabled>
			<input type="hidden" name="diachi" value="<?php echo  @$data['Manager']['diachi'] ?>">
			<?php
			}
			else
				echo ">";
			 ?>
		</div>
		<div class="col-md-6">
			<label>Email:</label>
			<input class="form-control" type="email" name="email" value="<?php echo  @$data['Manager']['email'] ?>"
			<?php 
			if (!empty($data['Manager']['permission'])&&$data['Manager']['permission']==2) {
			?>
			disabled>
			<input type="hidden" name="email" value="<?php echo  @$data['Manager']['email'] ?>">
			<?php
			}
			else
				echo ">";
			 ?>
		</div>
		<div class="col-md-6">
			<label>Số điện thoại:</label>
			<input class="form-control" type="number" name="sdt" value="<?php echo  @$data['Manager']['sdt'] ?>"
			<?php 
			if (!empty($data['Manager']['permission'])&&$data['Manager']['permission']==2) {
			?>
			disabled>
			<input type="hidden" name="sdt" value="<?php echo  @$data['Manager']['sdt'] ?>">
			<?php
			}
			else
				echo ">";
			 ?>
		</div>
		<input type="hidden" name="loaind" value="<?php echo (!empty($data['Manager']['permission']))?$data['Manager']['permission']:'1' ?>">
		<!-- <div class="col-md-6">
			<label>Loại người dùng:</label>
					<select name="loaind" class="form-control" required="">
						<option value="">Chọn quyền</option>
						<?php 
						global $listPer;
						foreach ($listPer as $key => $value) {
						 ?>
						<option value="<?php echo $value['id'] ?>" <?php echo (isset($data['Manager']['permission'])&&$data['Manager']['permission']==$value['id'])?'selected="selected"':"" ?>><?php echo $value['name'] ?></option>
						<?php
						} ?>
					</select>
		</div> -->
	</div>
	<button type="submit" class="btn btn-danger">Lưu</button>
	<button onclick="goBack()" class="btn btn-danger">Quay lại</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</form>