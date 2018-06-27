<br>
<form action="" method="post" accept-charset="utf-8">
	<h3>Họ tên: <?php echo $dataSV['Sinhvien']['hoten'] ?></h3>
	<div class="row">
		<div class="col-md-6">
			<label>Ngày cấp:</label>
			<input type="date" name="ngaycap" placeholder="" value="<?php echo $data['Vanbang']['ngaycap'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Số hiệu:</label>
			<input type="text" name="sohieu" placeholder="" value="<?php echo $data['Vanbang']['sohieu'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Số vào sổ:</label>
			<input type="text" name="sovaoso" placeholder="" value="<?php echo $data['Vanbang']['sovaoso'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Số quyết định:</label>
			<input type="text" name="soqd" placeholder="" value="<?php echo $data['Vanbang']['soqd'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Người cấp:</label>
			<input type="" name="nguoicap" placeholder="" value="<?php echo $data['Vanbang']['nguoicap'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Chức vụ:</label>
			<input type="text" name="chucvu" placeholder="" value="<?php echo $data['Vanbang']['chucvu'] ?>" class="form-control" required="">
		</div>
		<div class="col-md-6">
			<label>Xếp loại:</label>
			<select name="xl" class="form-control" required>
				<?php 
				global $xl;
				if (!empty($xl)) {
					foreach ($xl as $key => $value) {
				?>
				<option value="<?php echo $value['id'] ?>" <?php echo (isset($data['Vanbang']['id_xl'])&&$data['Vanbang']['id_xl']==$value['id'])?'selected="selected"':'' ?>><?php echo $value['name'] ?></option>
				<?php
				}
				} ?>
			</select>
		</div>
		<div class="col-md-6">
			<label>Loại văn bằng</label>
			<select name="loaivb" required="" class="form-control">
				<?php 
				foreach ($loai as $key => $value) {
				 ?>
				 <option value="<?php echo $value['Loai']['id'] ?>" <?php (isset($data['Vanbang']['loai'])&&$data['Vanbang']['loai']==$value['Loai']['id'])?'selected="selected"':'' ?>><?php echo $value['Loai']['name'] ?></option>
				 <?php
				 } ?>
			</select>
		</div>
	</div>
	<div class="row"> 
		<div class="col-md-6">
			<label>Ảnh:</label>
			<?php showUploadFile('img','img',$data['Vanbang']['img']) ?>
			<img src="<?php echo $data['Vanbang']['img'] ?>" alt="">
		</div>
	</div>

	<br>
	<button type="submit" class="btn btn-success">Lưu</button>
</form>