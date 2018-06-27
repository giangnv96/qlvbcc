
<br>
<form action="" method="get" accept-charset="utf-8">
	<div class="row">
		<div class="col-md-3">
			<label>Chọn khoa</label>
			<select name="id_khoa" id='khoa' class="form-control">
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
			<label>Chọn ngành</label>
			<select name="id_nganh" id="nganh" class="form-control">
				<option value="">Chọn ngành</option>
			</select>
		</div>
		<div class="col-md-3">
			<label>Chọn lớp</label>
			<select name="idLop" id="lop" class="form-control">
				<option value="">Chọn lớp</option>
			</select>
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
		<div class="col-md-3">
			<label>Từ ngày:</label>
			<input type="date" name="tungay" class="form-control" value="<?php echo @$_GET['tungay'] ?>" placeholder="Từ ngày">
		</div>
		<div class="col-md-3">
			<label>Đến ngày</label>
			<input type="date" name="denngay" class="form-control" value="<?php echo @$_GET['denngay'] ?>" placeholder="Đến ngày">
		</div>
		<div class="col-md-3">
			<label>Loại chứng chỉ</label>
			<select name="loai" class="form-control" required="">
				<option value="">Chọn loại CC</option>
				<?php
				if (!empty($loai)) {
				 	foreach ($loai as $key => $value) { ?>
				 		<option value="<?php echo $value['Loai']['id'] ?>" <?php echo (isset($_GET['loai'])&&$value['Loai']['id']==$_GET['loai'])?'selected="selected"':"" ?>><?php echo $value['Loai']['name'] ?></option>
				 	<?php }
				 } 
				 ?>
			</select>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-3">
			<button type="submit" class="btn btn-warning">Tìm kiếm</button>
		</div>
	</div>
</form>
<br>
  <div class="progress">
  	<?php 
  	$tong = (!empty($all))?count($all):1;
  	$ptxx= ($xx/($tong))*100;
  	$ptg= ($gioi/($tong))*100;
  	$ptk= ($kha/($tong))*100;
  	$pttb= ($tb/($tong))*100;
  	$ptxx = round($ptxx,1);
  	$ptg = round($ptg,1);
  	$ptk = round($ptk,1);
  	$pttb = round($pttb,1);
  	 ?>
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:<?php echo $ptxx ?>%">
    	<?php echo $ptxx ?>%
    </div>
    <div class="progress-bar progress-bar-primary" role="progressbar" style="width:<?php echo $ptg ?>%">
    	<?php echo $ptg ?>%
    </div>
    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?php echo $ptk ?>%">
    	<?php echo $ptk ?>%
    </div>
    <div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?php echo $pttb ?>%">
    	<?php echo $pttb ?>%
    </div>
  </div>
  <div class="row">
  	<div class="col-md-8 col-md-offset-2">
  		<table class="table table-bordered">
  	<thead>
  		<tr>
  			<th class="tt"></th>
  			<th class="xx">Xuất sắc</th>
  			<th class="g">Giỏi</th>
  			<th class="k">Khá</th>
  			<th class="tb">Trung bình</th>
  		</tr>
  	</thead>
  	<tbody>
  		<tr>
  			<td align="right"><strong>Số lượng:</strong></td>
  			<td><?php echo $xx ?></td>
  			<td><?php echo $gioi ?></td>
  			<td><?php echo $kha ?></td>
  			<td><?php echo $tb ?></td>
  		</tr>
  		<tr>
  			<td align="right"><strong>Tổng:</strong></td>
  			<td><strong><?php echo count($all)?></strong></td>
  			<td></td>
  			<td></td>
  			<td></td>
  		</tr>
  	</tbody>
  </table>
  	</div>
  </div>
<!-- <h2><i class="fa fa-bar-chart" ></i> Có <?php echo count($all)?> <?php echo (!empty($loaivb))?' '.$loaivb['Loai']['name']:' chứng chỉ' ?> đã được cấp</h2> -->
<!-- <p>Trong đó:</p>
<p><span class="glyphicon glyphicon-chevron-right"></span> <?php echo $xx ?> văn bằng loại xuất sắc</p>
<p><span class="glyphicon glyphicon-chevron-right"></span> <?php echo $gioi ?> văn bằng loại giỏi</p>
<p><span class="glyphicon glyphicon-chevron-right"></span> <?php echo $kha ?> văn bằng loại khá</p>
<p><span class="glyphicon glyphicon-chevron-right"></span> <?php echo $tb ?> văn bằng loại trung bình</p> -->
<style type="text/css" media="screen">
	p
	{
		font-size: 25px;
	}
	.glyphicon
	{
		color: #1dd212
	}
	.progress
	{
		height: 30px;
	}
	.xx{
		color: white;
		background-color: #5cb85c;
		width: 60px;
	}
	.g{
		color: white;
		background-color: #428bca;
		width: 60px;
	}
	.k{
		color: white;
		background-color: #f0ad4e;
		width: 60px;
	}
	.tb{
		color: white;
		background-color: #d9534f;
		width: 60px;
	}
	.tt
	{	background-color: #ddd;
		width: 60px;
		font-size:bold;
	}
</style>