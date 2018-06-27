<br>
<a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoXacMinh.php" title="" class="btn btn-warning">Không tìm thấy</a>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<!-- <div class="col-md-3">
			<label>Họ tên:</label>
			<input type="text" name="hoten" class="form-control" placeholder="" value="<?php echo @$_GET['hoten'] ?>" required>
		</div> -->
		<div class="col-md-3">
			<label>Số hiệu:</label>
			<input type="text" name="sohieu" class="form-control" placeholder="" value="<?php echo @$_GET['sohieu'] ?>" required>
		</div>
		<div class="col-md-3">
			<label>Số vào sổ:</label>
			<input type="text" name="sovaoso" class="form-control" placeholder="" value="<?php echo @$_GET['sovaoso'] ?>" required>
		</div>
		<div class="col-md-3">
			<label>Ngày cấp:</label>
			<input type="date" name="ngaycap" class="form-control" placeholder="" value="<?php echo @$_GET['ngaycap'] ?>" required>
		</div>
		<div class="col-md-3">
			<label>Chọn loại VB/CC:</label>
			<select name="loai" class="form-control">
						<option value="">Chọn loại</option>
						<?php
						if (!empty($loai)) {
						 	foreach ($loai as $key => $value) { ?>
						 		<option value="<?php echo $value['Loai']['loai'].'-'.$value['Loai']['id'] ?>" <?php echo (!empty($_REQUEST['loai'])&&$_REQUEST['loai']==$value['Loai']['loai'].'-'.$value['Loai']['id']) ?'selected' :'' ?>><?php echo $value['Loai']['name'] ?></option>
						 	<?php }
						 } 
						 ?>
				</select>
		</div>
	</div>
	<br>
	<div class="col-md-3">
		<button type="submit" class="btn btn-primary">Tìm kiếm</button>
	</div>
</form>
<div class="row">
	<table class="table table-responsive table-hover table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Họ tên</th>
				<th>Mã SV</th>
				<th>Nơi sinh</th>
				<th>Mã lớp</th>
				<th>Loại VB</th>
				<th>Xếp loại</th>
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
					$sv= $modelSV->getDataById($value['id_sv']);
					$lop= $modelLop->getListById($value['idLop']);
					$loaivb = $modelLoai->getDataById($value['loai']);
					$xl = getXLById($value['id_xl']);
			?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $sv['Sinhvien']['hoten'] ?></td>
				<td><?php echo $sv['Sinhvien']['masv'] ?></td>
				<td><?php echo $sv['Sinhvien']['noisinh'] ?></td>
				<td><?php echo $lop['Lop']['code'] ?></td>
				<td><?php echo @$loaivb['Loai']['name'] ?> </td>
				<td><?php echo @$xl ?> </td>
				<td><?php echo $value['ngaycap'] ?></td>
				<td><?php echo $value['nguoicap'] ?></td>
				<td><?php echo $value['chucvu'] ?></td>
				<td><a href="<?php echo $urlPlugins ?>admin/qlvb-admin-taoXacminh.php?idxm=<?php echo $value['id'] ?>&loai=<?php echo @$loaivb['Loai']['loai'] ?>" title="">Tạo xác minh</a></td>
			</tr>
			<?php
			}
			}
			?>
			
		</tbody>
	</table>
	
</div>
<div class=" text-center p_navigation" style="<?php if((!empty($totalPage)&&$totalPage==1)||empty($listData)) echo'display: none;';?>">
<nav aria-label="Page navigation">
	<ul class="pagination">
		<?php
		if ($page > 4) {
			$startPage = $page - 4;
		} else {
			$startPage = 1;
		}
		if ($totalPage > $page + 4) {
			$endPage = $page + 4;
		} else {
			$endPage = $totalPage;
		}
		?>
		<li class="<?php if($page==1) echo'disabled';?>">
			<a href="<?php echo $urlPage . $back; ?>" aria-label="Previous">
				<span aria-hidden="true">«</span>
			</a>
		</li>
		<?php
		for ($i = $startPage; $i <= $endPage; $i++) {
			if ($i != $page) {
					echo '	<li><a href="' . $urlPage . $i . '">' . $i . '</a></li>';
			} else {
				echo '<li class="active"><a href="' . $urlPage . $i . '">' . $i . '</a></li>';
			}
		}
		?>
		<li class="<?php if($page==$endPage) echo'disabled';?>">
			<a href="<?php echo $urlPage . $next ?>" aria-label="Next">
				<span aria-hidden="true">»</span>
			</a>
		</li>
	</ul>
</nav>
</div>