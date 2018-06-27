<button onclick="goBack()" class="btn btn-danger">Quay lại</button>

<script>
function goBack() {
    window.history.back();
}
</script>
<br><h3>Danh sách sinh viên</h3>

<?php 
if (!empty($listData)) {
?>
<form action="<?php echo $urlPlugins ?>admin/qlvb-admin-themVB.php" method="GET" accept-charset="utf-8">
	
			<input type="hidden" name="idLop" value="<?php echo $idLop ?>">
			<input type="hidden" name="loaivb" value="<?php echo $_GET['loaivb'] ?>">
	<input type="checkbox" id="select_all" /> Chọn tất cả<br/>
	<br>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th>Chọn</th>
				<th>Mã SV</th>
				<th>Tên SV</th>
				<th>Ngày sinh</th>
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
				<td><input type="checkbox" name="sv[]" id='check' value="<?php echo $value['Sinhvien']['id'] ?>"></td>
				<td><?php echo $value['Sinhvien']['masv'] ?></td>
				<td><?php echo $value['Sinhvien']['hoten'] ?></td>
				<td><?php echo $value['Sinhvien']['ngaysinh'] ?></td>
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
	<button type="submit" class="btn btn-success">Thêm mới</button>
</form>
<?php
 }
  else
 {
 	echo "<h4>Không có sinh viên</h4>";
 } ?>
<script>
	$('#select_all').click(function() {
    var c = this.checked;
    $(':checkbox').prop('checked',c);
});
</script>
<script language="JavaScript">
	function selectAll(source) {
		checkboxes = document.getElementsByName('colors[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
</script>