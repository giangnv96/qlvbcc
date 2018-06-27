<br>
<h3>Danh sách sinh viên</h3>
<form action="<?php echo $urlPlugins ?>admin/qlvb-admin-luuVB.php" method="post" accept-charset="utf-8" class="row">
	<input type="hidden" name="idLop" value="<?php echo $idLop ?>">
	<input type="hidden" name="loai" value="<?php echo $loai ?>">
	<div class="row">
		<div class="col-md-6">
			<label>Người cấp:</label>
			<input type="text" name="nguoicap" value="Đào Văn Đông" class="form-control" placeholder="Người cấp" required="">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label>Ngày cấp:</label>
			<input type="date" name="ngaycap" value="2017-08-01"  class="form-control" placeholder="Đến ngày">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label>Chức vụ:</label>
			<input type="text" name="chucvu" value="Hiệu trưởng"  class="form-control" placeholder="Chức vụ" required="">
		</div>
	</div>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th>STT</th>
				<th>Mã SV</th>
				<th>Tên SV</th>
				<!-- <th>Chức vụ</th>  -->
				<th>Số hiệu</th>
				<th>Số vào SCB</th>
				<th>Số QĐ</th>
				<th>Ảnh</th>
				<th>Xếp loại</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($listData)) {
				$i=0;
				foreach ($listData as $key => $value) {
				$i++;
			?>
			<tr>
				<input type="hidden" name="vb[<?php echo $i ?>][id]" value="<?php echo $value['Sinhvien']['id']  ?>">
				<input type="hidden" name="vb[<?php echo $i ?>][code]" value="<?php echo $value['Sinhvien']['masv']  ?>">
				<td><?php echo $i ?></td>
				<td><?php echo $value['Sinhvien']['masv'] ?></td>
				<td><?php echo $value['Sinhvien']['hoten'] ?></td>
				<td><input type="text" name="vb[<?php echo $i ?>][sohieu]" value="111111" required></td>
				<td><input type="text" name="vb[<?php echo $i ?>][sovaoso]" value="1111111" required></td>
				<td><input type="text" name="vb[<?php echo $i ?>][soqd]" value="11111112" required></td>
				<td><?php showUploadFile('img'.$i,'img'.$i,'/app/webroot/upload/admin/files/ch%E1%BB%A9ng%20ch%E1%BB%89%20th%E1%BB%83%20d%E1%BB%A5c.png',$i) ?></td>
				<td>
					<select name="vb[<?php echo $i ?>][xl]" required>
						<?php if (!empty($xl)) {
							foreach ($xl as $key => $value) {
						?>
						<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
						<?php
						}
						} ?>
					</select>
				</td>
			</tr>
			<?php
			}
			}else
			{
			echo '<tr><td colspan="4" rowspan="" headers="" class="text-center">Chưa có dữ liệu </td></tr>';
			}
			?>
			
		</tbody>
	</table>
	<br>
	<button type="submit" class="btn btn-success">Lưu</button>
	<button onclick="goBack()" class="btn btn-danger">Quay lại</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</form>