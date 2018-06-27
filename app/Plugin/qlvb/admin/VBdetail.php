<br>
<button onclick="goBack()" class="btn btn-danger">Quay lại</button>

<script>
function goBack() {
    window.history.back();
}
</script>
<br>
<p>Họ tên: <strong><?php echo @$dataSV['Sinhvien']['hoten'] ?></strong></p>
<p>Hệ đào tạo: <strong><?php echo @$hinhthuc ?></strong></p>
<p>Ngày cấp: <strong><?php echo @$data['Vbcc']['ngaycap'] ?></strong></p>
<p>Người cấp: <strong><?php echo @$data['Vbcc']['nguoicap'] ?></strong></p>
<p>Chức vụ: <strong><?php echo @$data['Vbcc']['chucvu'] ?></strong></p>
<p>Số hiệu: <strong><?php echo @$data['Vbcc']['sohieu'] ?></strong></p>
<p>Số vào sổ cấp bằng: <strong><?php echo @$data['Vbcc']['sovaoso'] ?></strong></p>
<p>Xếp loại: <strong><?php echo $xl ?></strong></p>
<p>Ảnh:</p>
<div class="col-md-8 col-md-offset-2">
	<img src="<?php echo @$data['Vbcc']['img'] ?>" alt="">
</div>