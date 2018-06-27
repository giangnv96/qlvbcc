<?php
	$menus= array();
	$menus[0]['title']= 'Quản lý văn bằng, chứng chỉ';
	$menus[0]['sub'][0]= array('name'=>'Quản lý người dùng',
							   'classIcon'=>'fa-list',
		 					   'url'=>$urlPlugins.'admin/qlvb-admin-dsUser.php',
		    				 'sub'=>array( array('name'=>'Danh sách người dùng','url'=>$urlPlugins.'admin/qlvb-admin-dsUser.php','permission'=>'dsUser'),array('name'=>'Thêm người dùng','url'=>$urlPlugins.'admin/qlvb-admin-taoNgDung.php','permission'=>'taoNgDung'),
								   // array('name'=>'Loại phân quyền','url'=>$urlPlugins.'admin/qlvb-admin-phanquyen.php','permission'=>'phanquyen'),
							) ,
		 					   'permission'=>'listUser'
		 					   );
	$menus[0]['sub'][1]= array('name'=>'Quản lý văn bằng',
							   'classIcon'=>'fa-cog',
							   'url'=>$urlPlugins.'admin/qlvb-admin-dsVB.php',
		    				 'sub'=>array( array('name'=>'Danh sách VB','url'=>$urlPlugins.'admin/qlvb-admin-dsVB.php','permission'=>'dsVanBang')
		    				 	,
								   array('name'=>'Thêm mới văn bằng','url'=>$urlPlugins.'admin/qlvb-admin-taoVB.php','permission'=>'taoVB'),
								   array('name'=>'Loại văn bằng','url'=>$urlPlugins.'admin/qlvb-admin-loaiVB.php','permission'=>'loaiVB'),
							) ,
		 					   'permission'=>'vanBang'
		 					   );
    
	$menus[0]['sub'][2]= array('name'=>'Quản lý chứng chỉ',
							   'classIcon'=>'fa-cog',
							   'url'=>$urlPlugins.'admin/qlvb-admin-dsCC.php',
							   'sub'=>array( array('name'=>'Danh sách CC','url'=>$urlPlugins.'admin/qlvb-admin-dsCC.php','permission'=>'dsChungChi')
							   	,
								   array('name'=>'Thêm mới chứng chỉ','url'=>$urlPlugins.'admin/qlvb-admin-taoCC.php','permission'=>'taoCC'),
								   array('name'=>'Loại chứng chỉ','url'=>$urlPlugins.'admin/qlvb-admin-loaiCC.php','permission'=>'loaiCC'),
							) ,
		 					   'permission'=>'chungChi'
		 					   );
	$menus[0]['sub'][3]= array('name'=>'Quản lý lớp',
						   'classIcon'=>'fa-list',
	 					   'url'=>$urlPlugins.'admin/qlvb-admin-dsLop.php',
	 					   'sub'=>array( array('name'=>'Danh sách','url'=>$urlPlugins.'admin/qlvb-admin-dsLop.php','permission'=>'dsLop'),
								   array('name'=>'Thêm mới lớp','url'=>$urlPlugins.'admin/qlvb-admin-taoLop.php','permission'=>'taoLop'),
								   // array('name'=>'Thêm mới sinh viên','url'=>$urlPlugins.'admin/qlvb-admin-taoSV.php','permission'=>'taoSV')
							),
	 					   'permission'=>'listClass'
	 					   );
	$menus[0]['sub'][4]= array('name'=>'Quản lý khoa',
						   'classIcon'=>'fa-list',
	 					   'url'=>$urlPlugins.'admin/qlvb-admin-dsKhoa.php','permission'=>'dsKhoa'
	 					   );
	$menus[0]['sub'][5]= array('name'=>'Quản lý ngành',
						   'classIcon'=>'fa-list',
	 					   'url'=>$urlPlugins.'admin/qlvb-admin-dsNganh.php','permission'=>'dsNganh'
	 					   );
	$menus[0]['sub'][6]= array('name'=>'Quản lý xác minh',
						   'classIcon'=>'fa-list',
	 					   'url'=>$urlPlugins.'admin/qlvb-admin-dsXacminh.php','permission'=>'dsXM'
	 					   );
	$menus[0]['sub'][7]= array('name'=>'Quản lý sinh viên',
						   'classIcon'=>'fa-list',
	 					   'url'=>$urlPlugins.'admin/qlvb-admin-dsSinhVien.php','permission'=>'dsSinhvien',
	 					   'sub'=>array( array('name'=>'Danh sách','url'=>$urlPlugins.'admin/qlvb-admin-dsSinhVien.php','permission'=>'dsSV'),
								   array('name'=>'Thêm mới sinh viên','url'=>$urlPlugins.'admin/qlvb-admin-taoSV.php','permission'=>'taoSV'),
								   // array('name'=>'Thêm mới sinh viên','url'=>$urlPlugins.'admin/qlvb-admin-taoSV.php','permission'=>'taoSV')
							),
	 					   'permission'=>'DSSV'
	 					   );
	$menus[0]['sub'][8]= array('name'=>'Danh sách Khóa học','url'=>$urlPlugins.'admin/qlvb-admin-dsKhoaHoc.php','permission'=>'dsKhoaHoc',
							   'classIcon'=>'fa-cog'
		 					   );
	$menus[0]['sub'][9]= array('name'=>'Hình thức đào tạo','url'=>$urlPlugins.'admin/qlvb-admin-dsHinhthucDT.php','permission'=>'dsHinhthucDT',
							   'classIcon'=>'fa-cog'
		 					   );
	$menus[0]['sub'][10]= array('name'=>'Thống kê',
							   'classIcon'=>'fa-cog','url'=>$urlPlugins.'admin/qlvb-admin-dsThongkeVB.php',
							   'sub'=>array( 
								   array('name'=>'Thống kê văn bằng','url'=>$urlPlugins.'admin/qlvb-admin-dsThongkeVB.php','permission'=>'dsTKVB'),
								   array('name'=>'Thống kê chứng chỉ','url'=>$urlPlugins.'admin/qlvb-admin-dsThongkeCC.php','permission'=>'dsTKCC')
							) ,
		 					   'permission'=>'thongke'
		 					   );

    addMenuAdminMantan($menus);
global $listPer;
$listPer =array(['id'=>1,'name'=>'Cán bộ, nhân viên'],['id'=>2,'name'=>'Sinh viên']);

    $modelKhoahoc = new Khoahoc();
global $dsKhoahoc;
$dsKhoahoc = $modelKhoahoc->getList();
$modelHinhthucdt = new Hinhthucdt();
global $hinhthuc;
$hinhthucDT=$modelHinhthucdt-> find('all');

function hinhthuc($tt)
{	
	$modelHinhthucdt = new Hinhthucdt();
	$hinhthucDT=$modelHinhthucdt-> find('all');
	foreach ($hinhthucDT as $key => $value) {
		if ((int)$tt==$value['Hinhthucdt']['id']) {
			return $value['name'];
		}
	}
}

global $tinhtrang;
$tinhtrang=array(['id'=>2,'name'=>'Đã tốt nghiệp'],['id'=>1,'name'=>'Đang học'],['id'=>3,'name'=>'Thôi học']);
global $xl;
$xl=array(['id'=>1,'name'=>'Xuất sắc'],['id'=>2,'name'=>'Giỏi'],['id'=>3,'name'=>'Khá'],['id'=>4,'name'=>'Trung bình']);
function tinhtrang($tt)
{	$tinhtrang=array(['id'=>1,'name'=>'Đang học'],['id'=>2,'name'=>'Đã tốt nghiệp'],['id'=>3,'name'=>'Thôi học']);
	foreach ($tinhtrang as $key => $value) {
		if ((int)$tt==$value['id']) {
			return $value['name'];
		}
	}
}
function getXLById($id)
{
	$xl=array(['id'=>1,'name'=>'Xuất sắc'],['id'=>2,'name'=>'Giỏi'],['id'=>3,'name'=>'Khá'],['id'=>4,'name'=>'Trung bình']);
	foreach ($xl as $key => $value) {
		if ((int)$id==$value['id']) {
			return $value['name'];
		}
	}
}
function getLopByID($id)
{
	$model = new Lop();
	return $model->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
}
function getPerById($id)
	{
		$model = new Loaiquyen();
		return $model->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
	function getKHById($id)
	{
		$model = new Khoahoc();
		return $model->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
function dsKhoaFun()
	{
		$model = new Khoa();
		return $model->find('all');
	}
function getKhoaById($id)
	{
		$model = new Khoa();
		return $model->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
function dsNganhFun()
	{
		$model = new Nganh();
		return $model->find('all');
	}
function dsKhoahoc1()
	{
		$model = new Khoahoc();
		return $model->find('all');
	}
function getNganhById($id)
	{
		$model = new Nganh();
		return $model->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
function getSVById($id)
	{
		$model = new Sinhvien();
		return $model->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
function checkVBEmty($id_sv,$id_loai)
{
	$model = new Vbcc();
	return $model->find('first',array('conditions'=>array('id_sv'=>$id_sv,'loai'=>$id_loai)));
}
function checkCCEmty($id_sv,$id_loai)
{
	$model = new Vbcc();
	return $model->find('first',array('conditions'=>array('id_sv'=>$id_sv,'loai'=>$id_loai)));
}

	function getListIDSVByLop($arr= array())
	{
		$idSV=array();
		foreach ($arr as $key => $value) {
			$idSV[] = $value['Sinhvien']['id'];
		}
		return $idSV;
	}
?>