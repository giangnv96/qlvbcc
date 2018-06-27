<h3>Thêm mới lớp</h3>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<input type="hidden" name="id" value="<?php echo @$data['Lop']['id'] ?>">
		<div class="col-md-6">
			<label>Mã lớp:</label>
			<input class="form-control" type="" name="code" value="<?php echo @$data['Lop']['code'] ?>" required="">
		</div>
		<div class="col-md-6">
			<label>Tên lớp:</label>
			<input class="form-control" type="" name="name" value="<?php echo @$data['Lop']['name'] ?>" required="">
		</div>
		<div class="col-md-6">
			<label>Khóa học:</label>
			<select name="khoahoc" class="form-control">
				<?php 
				global $dsKhoahoc;
				if (!empty($dsKhoahoc)) {
					foreach ($dsKhoahoc as $key => $value) {
						?>
						<option value="<?php echo $value['Khoahoc']['id'] ?>" <?php (!empty($data['Lop']['khoahoc'])&&$value['Khoahoc']['id']==$data['Lop']['khoahoc'])?'selected':'' ?>><?php echo $value['Khoahoc']['code'] ?></option>
						<?php
					}
				}
				 ?>
			</select>
		</div>
		<div class="col-md-6">
			<label>Ngành:</label>
			<select name="nganh" id="nganh" class="form-control" required="">
				<?php $dsKhoa = dsNganhFun();
				foreach ($dsKhoa as $key => $value) {
				 ?>
				 <option value="<?php echo $value['Nganh']['id'] ?>" <?php (!empty($data['Lop']['nganh'])&&$value['Nganh']['id']==$data['Lop']['nganh'])?'selected':'' ?>><?php echo $value['Nganh']['name'] ?></option>
				 <?php
				 } ?>
			</select>
		</div>
		<div class="col-md-6">
			<label>Hình thức đào tạo:</label>
			<select name="hinhthuc" class="form-control" required="">
				<?php 
				global $hinhthuc;
				if (!empty($hinhthuc)) {
					foreach ($hinhthuc as $key => $value) {
						?>
						<option value="<?php echo $value['id'] ?>" <?php (!empty($data['Lop']['hinhthuc'])&&$value['id']==$data['Lop']['hinhthuc'])?'selected':'' ?>><?php echo $value['name'] ?></option>
						<?php
					}
				}
				 ?>
			</select>
		</div>
		
	</div>
<button type="submit" class="btn btn-danger">Lưu</button>

</form>