<br>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<div class="col-md-6">
			<input type="text" placeholder="Nhập mã lớp" class="form-control" name="key" value="<?php echo @trim($_GET['key']) ?>">
		</div>
		<div class="col-md-6">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
		</div>
	</div>
</form>
<br>
<h3>Danh sách lớp</h3>
<table class="table table-responsive">
	<thead>
		<tr>
			<th class="text-center">STT</th>
			<th class="text-center">Mã lớp</th>
			<th class="text-center">Tên lớp</th>
			<th class="text-center">Hình thức đào tạo</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if (!empty($listData)) {
			$i=0;
			foreach ($listData as $key => $value) {
			$i++;
			$hinhthuc = hinhthuc($value['Lop']['hinhthuc']);
			?>
				<tr>
					<td class="text-center"><?php echo $i ?></td>
					<td class="text-center"><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-chonSV.php?loai=vb&idLop=<?php echo $value['Lop']['id'] ?>" title=""><?php echo $value['Lop']['code'] ?></a></td>
					<td class="text-center"><?php echo $value['Lop']['name'] ?></td>
					<td class="text-center"><?php echo $hinhthuc ?></td>
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