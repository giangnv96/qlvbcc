<?php
	$menus= array();
	$menus[0]['title']= 'Quản lý văn bằng, chứng chỉ';
	$menus[0]['sub'][0]= array('name'=>'Người dùng',
							   'classIcon'=>'fa-list',
		 					   'url'=>$urlPlugins.'admin/qlvb-admin-dsUser.php',
		    				 'sub'=>array( array('name'=>'Danh sách người dùng','url'=>$urlPlugins.'admin/qlvb-admin-dsUser.php','permission'=>'dsUser'),array('name'=>'Thêm người dùng','url'=>$urlPlugins.'admin/qlvb-admin-taoNgDung.php','permission'=>'taoNgDung'),
								   array('name'=>'Loại phân quyền','url'=>$urlPlugins.'admin/qlvb-admin-phanquyen.php','permission'=>'phanquyen'),
							) ,
		 					   'permission'=>'listUser'
		 					   );
	$menus[0]['sub'][1]= array('name'=>'Văn bằng',
							   'classIcon'=>'fa-cog',
							   'url'=>$urlPlugins.'admin/qlvb-admin-dsVB.php',
		    				 'sub'=>array( array('name'=>'Danh sách sinh viên theo văn bằng','url'=>$urlPlugins.'admin/qlvb-admin-dsVB.php','permission'=>'dsVanBang')
		    				 	,
								   array('name'=>'Thêm mới văn bằng','url'=>$urlPlugins.'admin/qlvb-admin-taoVB.php','permission'=>'taoVB'),
								   array('name'=>'Loại văn bằng','url'=>$urlPlugins.'admin/qlvb-admin-loaiVB.php','permission'=>'loaiVB'),
							) ,
		 					   'permission'=>'vanBang'
		 					   );
    
	$menus[0]['sub'][2]= array('name'=>'Chứng chỉ',
							   'classIcon'=>'fa-cog',
							   'url'=>$urlPlugins.'admin/qlvb-admin-dsCC.php',
							   'sub'=>array( array('name'=>'Danh sách sinh viên theo chứng chỉ','url'=>$urlPlugins.'admin/qlvb-admin-dsCC.php','permission'=>'dsChungChi')
							   	,
								   array('name'=>'Thêm mới chứng chỉ','url'=>$urlPlugins.'admin/qlvb-admin-taoCC.php','permission'=>'taoCC'),
								   array('name'=>'Loại chứng chỉ','url'=>$urlPlugins.'admin/qlvb-admin-loaiCC.php','permission'=>'loaiCC'),
							) ,
		 					   'permission'=>'chungChi'
		 					   );
	$menus[0]['sub'][3]= array('name'=>'Danh sách lớp',
						   'classIcon'=>'fa-list',
	 					   'url'=>$urlPlugins.'admin/qlvb-admin-dsLop.php',
	 					   'sub'=>array( array('name'=>'Danh sách','url'=>$urlPlugins.'admin/qlvb-admin-dsLop.php','permission'=>'dsLop'),
								   array('name'=>'Thêm mới lớp','url'=>$urlPlugins.'admin/qlvb-admin-taoLop.php','permission'=>'taoLop'),
								   // array('name'=>'Thêm mới sinh viên','url'=>$urlPlugins.'admin/qlvb-admin-taoSV.php','permission'=>'taoSV')
							),
	 					   'permission'=>'listClass'
	 					   );
	$menus[0]['sub'][4]= array('name'=>'Cài đặt',
							   'classIcon'=>'fa-cog','url'=>$urlPlugins.'admin/qlvb-admin-dsKhoa.php',
							   'sub'=>array( array('name'=>'Danh sách Khoa','url'=>$urlPlugins.'admin/qlvb-admin-dsKhoa.php','permission'=>'dsKhoa'),
								   array('name'=>'Danh sách Ngành','url'=>$urlPlugins.'admin/qlvb-admin-dsNganh.php','permission'=>'dsNganh'),
								   array('name'=>'Danh sách Khóa học','url'=>$urlPlugins.'admin/qlvb-admin-dsKhoaHoc.php','permission'=>'dsKhoaHoc'),
								   array('name'=>'Xếp loại','url'=>$urlPlugins.'admin/qlvb-admin-xl.php','permission'=>'xl')
							) ,
		 					   'permission'=>'chungChi'
		 					   );

    addMenuAdminMantan($menus);
    $modelPer = new Loaiquyen();
global $listPer;
$listPer = $modelPer->getList();

    $modelKhoahoc = new Khoahoc();
global $dsKhoahoc;
$dsKhoahoc = $modelKhoahoc->getList();
global $hinhthuc;
$hinhthuc=array(['id'=>1,'name'=>'Đại học chính quy'],['id'=>2,'name'=>'Tại chức'],['id'=>3,'name'=>'Cao học'],['id'=>4,'name'=>'Cao đẳng chính quy']);

function hinhthuc($tt)
{	$hinhthuc=array(['id'=>1,'name'=>'Đại học chính quy'],['id'=>2,'name'=>'Tại chức'],['id'=>3,'name'=>'Cao học'],['id'=>4,'name'=>'Cao đẳng chính quy']);

	foreach ($hinhthuc as $key => $value) {
		if ((int)$tt==$value['id']) {
			return $value['name'];
		}
	}
}

global $tinhtrang;
$tinhtrang=array(['id'=>1,'name'=>'Đang học'],['id'=>2,'name'=>'Đã tốt nghiệp'],['id'=>3,'name'=>'Thôi học']);
function tinhtrang($tt)
{	$tinhtrang=array(['id'=>1,'name'=>'Đang học'],['id'=>2,'name'=>'Đã tốt nghiệp'],['id'=>3,'name'=>'Thôi học']);
	foreach ($tinhtrang as $key => $value) {
		if ((int)$tt==$value['id']) {
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
?>