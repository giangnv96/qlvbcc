
<br>
<form action="" method="post" accept-charset="utf-8">
	<h3>Họ tên: <?php echo $dataSV['Sinhvien']['hoten'] ?></h3>
	<div class="row">
		<div class="col-md-6">
			<label>Ngày cấp:</label>
			<input type="text" name="ngaycap" placeholder="" value="<?php echo $data['Chungchi']['ngaycap'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Số hiệu:</label>
			<input type="text" name="sohieu" placeholder="" value="<?php echo $data['Chungchi']['sohieu'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Số vào sổ:</label>
			<input type="text" name="sovaoso" placeholder="" value="<?php echo $data['Chungchi']['sovaoso'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Số quyết định:</label>
			<input type="text" name="soqd" placeholder="" value="<?php echo $data['Chungchi']['soqd'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Người cấp:</label>
			<input type="text" name="nguoicap" placeholder="" value="<?php echo $data['Chungchi']['nguoicap'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Chức vụ:</label>
			<input type="text" name="chucvu" placeholder="" value="<?php echo $data['Chungchi']['chucvu'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Từ ngày:</label>
			<input type="text" name="tungay" placeholder="" value="<?php echo $data['Chungchi']['tungay'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Đến ngày:</label>
			<input type="text" name="denngay" placeholder="" value="<?php echo $data['Chungchi']['denngay'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Xếp loại:</label>
			<select name="xl" required>
				<?php if (!empty($xl)) {
					foreach ($xl as $key => $value) {
				?>
				<option value="<?php echo $value['Xeploai']['id'] ?>" <?php (isset($data['Chungchi']['xl'])&&$data['Chungchi']['xl']==$value['Xeploai']['id'])?'selected="selected"':'' ?>><?php echo $value['Xeploai']['name'] ?></option>
				<?php
				}
				} ?>
			</select>
		</div>
		<div class="col-md-6">
			<label>Loại chứng chỉ</label>
			<select name="loaicc" required="" class="form-control">
				<?php 
				foreach ($loai as $key => $value) {
				 ?>
				 <option value="<?php echo $value['Loai']['id'] ?>" <?php (isset($data['Chungchi']['loai'])&&$data['Chungchi']['loai']==$value['Loai']['id'])?'selected="selected"':'' ?>><?php echo $value['Loai']['name'] ?></option>
				 <?php
				 } ?>
			</select>
		</div>
		<div class="col-md-6">
			<label>Ảnh:</label>
			<?php showUploadFile('img','img',$data['Chungchi']['img']) ?>
			<img src="<?php echo $data['Chungchi']['img'] ?>" alt="">
		</div>
	</div>

	<br>
	<button type="submit" class="btn btn-success">Lưu</button>
</form>