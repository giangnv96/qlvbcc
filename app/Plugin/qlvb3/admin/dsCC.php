<br>
<div class="row">
	<form action="" method="get" accept-charset="utf-8">
		<div class="col-md-3">
			<select name="" id='khoa' class="form-control" required="">
				<option value="">Chọn khoa</option>
				<?php
				if (!empty($dsKhoa)) {
					foreach ($dsKhoa as $key => $value) {
				?>
				<option value="<?php echo $value['Khoa']['id'] ?>"><?php echo $value['Khoa']['name'] ?></option>
				<?php
				}
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<select name="" id="nganh" class="form-control" required="">
				<option value="">Chọn ngành</option>
			</select>
		</div>
		<div class="col-md-3">
			<select name="idLop" id="lop" class="form-control" required="">
				<option value="">Chọn lớp</option>
			</select>
		</div>
		<div class="col-md-3">
				<select name="cc" class="form-control" required="">
						<option value="">Chọn loại Chứng chỉ</option>
						<option value="1">Chứng chỉ thể dục</option>
						<option value="2">Chứng chỉ quốc phòng</option>
				</select>
		</div>
		<div class="col-md-3">
			<button type="submit" class="btn btn-primary" name="search">Tìm kiếm</button>
		</div>
		
	</form>
</div>
<script type="text/javascript">
				$(document).ready(function(){
					$('#khoa').on('change', function(){
						var $this = $(this),
						$value = $this.val();
						if($value){
$("#nganh").load("<?php echo $urlPlugins ?>admin/qlvb-admin-loadNganh.php", {id: $value});
}
});
});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#nganh').on('change', function(){
			var $this = $(this),
			$value = $this.val();
			if($value){
$("#lop").load("<?php echo $urlPlugins ?>admin/qlvb-admin-loadLop.php", {id: $value});
}
});
});
</script>
<hr>
<div class="row">
	<table class="table table-responsive table-hover table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Họ tên</th>
				<th>Mã SV</th>
				<th>Mã lớp</th>
				<th>Loại VB</th>
				<th>Ngày cấp</th>
				<th>Người cấp</th>
				<th>Chức vụ</th>
				<th>Hành động</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($listData)) {
				$i=0;
				
				$modelSV = new Sinhvien();
				$modelLop = new Lop();
				$modelLoai = new Loai();
				foreach ($listData as $key => $value) {
					$i++;
					$sv= $modelSV->getDataById($value['Chungchi']['id_sv']);
					$lop= $modelLop->getListById($value['Chungchi']['idLop']);
					$loaivb = $modelLoai->getDataById($value['Chungchi']['loai']);
			?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $sv['Sinhvien']['hoten'] ?></td>
				<td><?php echo $sv['Sinhvien']['code'] ?></td>
				<td><?php echo $lop['Lop']['code'] ?></td>
				<td><?php echo @$loaivb['Loai']['name'] ?> </td>
				<td><?php echo $value['Chungchi']['ngaycap'] ?></td>
				<td><?php echo $value['Chungchi']['nguoicap'] ?></td>
				<td><?php echo $value['Chungchi']['chucvu'] ?></td>
				<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-editCC.php?id=<?php echo $value['Chungchi']['id'] ?>" title="">Sửa</a> | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delCC.php?id=<?php echo $value['Chungchi']['id'] ?>" title="">Xóa</a> | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-CCdetail.php?id=<?php echo $value['Chungchi']['id'] ?>" title="">Chi tiết</a></td>
			</tr>
			<?php
			}
			}
			?>
			
		</tbody>
	</table>
	<!-- <form action="" method="post" accept-charset="utf-8">
			<div class="col-md-2">
					<button type="submit" class="btn btn-primary" name="export">Xuất excel</button>
			</div>
	</form> -->
</div>