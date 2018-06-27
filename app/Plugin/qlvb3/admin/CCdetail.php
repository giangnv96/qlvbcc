
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
<p>Ngày cấp: <strong><?php echo @$data['Chungchi']['ngaycap'] ?></strong></p>
<p>Người cấp: <strong><?php echo @$data['Chungchi']['nguoicap'] ?></strong></p>
<p>Từ ngày: <strong><?php echo @$data['Chungchi']['tungay'] ?></strong></p>
<p>Đến ngày: <strong><?php echo @$data['Chungchi']['denngay'] ?></strong></p>
<p>Chức vụ: <strong><?php echo @$data['Chungchi']['chucvu'] ?></strong></p>
<p>Số hiệu: <strong><?php echo @$data['Chungchi']['sohieu'] ?></strong></p>
<p>Số vào sổ cấp bằng: <strong><?php echo @$data['Chungchi']['sovaoso'] ?></strong></p>
<p>Xếp loại: <strong><?php echo @$xl['Xeploai']['name'] ?></strong></p>
<p>Ảnh:</p>
<div class="col-md-8 col-md-offset-2">
	<img src="<?php echo @$data['Chungchi']['img'] ?>" alt="">
</div>
