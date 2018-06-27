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
				<select name="" class="form-control" required="">
						<option value="">Chọn loại VB</option>
						<?php
						if (!empty($loai)) {
						 	foreach ($loai as $key => $value) { ?>
						 		<option value="<?php echo $value['Loai']['id'] ?>"><?php echo $value['Loai']['name'] ?></option>
						 	<?php }
						 } 
						 ?>
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
				foreach ($listData as $key => $value) {
					$i++;
					$sv= getSVById($value['Vanbang']['idSV']);
					$lop= getLopByID($value['Vanbang']['idLop']);
					$loaivb = getDataById($value['Vanbang']['loai']);
			?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $sv['Sinhvien']['hoten'] ?></td>
				<td><?php echo $sv['Sinhvien']['code'] ?></td>
				<td><?php echo $lop['Lop']['code'] ?></td>
				<td><?php echo @$loaivb['Loai']['name'] ?> </td>
				<td><?php echo $value['Vanbang']['ngaycap'] ?></td>
				<td><?php echo $value['Vanbang']['nguoicap'] ?></td>
				<td><?php echo $value['Vanbang']['chucvu'] ?></td>
				<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-editVB.php?id=<?php echo $value['Vanbang']['id'] ?>" title="">Sửa</a> | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-delVB.php?id=<?php echo $value['Vanbang']['id'] ?>" title="">Xóa</a> | <a href="<?php echo $urlPlugins ?>admin/qlvb-admin-VBdetail.php?id=<?php echo $value['Vanbang']['id'] ?>" title="">Chi tiết</a></td>
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