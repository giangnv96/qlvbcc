<?php 
function login()
{
    global $urlHomes;
    $model = new Manager();
    if (empty($_SESSION['infoManager'])) {
        if (!empty($_POST['user'])&&!empty($_POST['pass'])) {
        $user=$_REQUEST['user'];
        $pass=md5($_REQUEST['pass']);
        $users = $model->checkLogin($user,$pass);
        if (!empty($users)&&count($users)==1) {
            $_SESSION['infoManager']=$users[0];
            if ($_SESSION['infoManager']['Manager']['quyen']==1) {
                $model->redirect($urlHomes.'dashboard');
            }
            elseif ($_SESSION['infoManager']['Manager']['quyen']==2) {
                $model->redirect($urlHomes.'dashboardSV');
            }
        }
        else
        {
            $model->redirect($urlHomes.'login?error=1');
        }
    }
    }
    else
    {
        $model->redirect($urlHomes.'dashboard');
    }
}
function logout()
{
    global $urlHomes;
    $model = new Manager();
    if (!empty($_SESSION['infoManager'])) {
        unset($_SESSION['infoManager']);
        $model->redirect($urlHomes.'login');
    }
    else
    {
        $model->redirect($urlHomes.'login');
    }
}
function dashboard()
{
    global $urlHomes;
    $modelVB= new Vanbang();
    $modelCC = new Chungchi();
    if (!empty($_SESSION['infoManager']['Manager'])&&$_SESSION['infoManager']['Manager']['quyen']==1) {
    if (!empty($_REQUEST)) {
    if (!empty($_GET['masv'])) {
        $conditions['masv']=$_GET['masv'];
    }
    }
    }
    else
    {
        $model->redirect($urlHomes.'login');
    }
}

function dashboardSV()
{
    global $urlHomes;
    $modelVB= new Vanbang();
    $modelCC = new Chungchi();
    if (!empty($_SESSION['infoManager']['Manager'])&&$_SESSION['infoManager']['Manager']['quyen']==2) {
    if (!empty($_SESSION['infoManager']['Manager']['tinhtrang'])&&$_SESSION['infoManager']['Manager']['tinhtrang']==2) {
        $id=$_SESSION['infoManager']['Manager']['id'];
        $listVB=$modelVB->getListByIdSV($id);
        $listCC=$modelCC->getListByIdSV($id);
        if (empty($listVB)) {
            $mess="Đang cập nhật.";
            setVariable('mess',$mess);
        }
        else
        {
        setVariable('listVB',$listVB);
        }
        if (empty($listCC)) {
            $mess="Đang cập nhật.";
            setVariable('mess',$mess);
        }
        else
        {
        setVariable('listCC',$listCC);
        }
    }
    else
    {
        $mess ="Bạn không có văn bằng chứng chỉ nào.";
        setVariable('mess',$mess);
    }
    }
    else
    {
        $model->redirect($urlHomes.'login');
    }
}

function taoNgDung()
{
	global $urlHomes;
	global $urlPlugins;
	$modelUser = new Manager();		
	if(checkAdminLogin()){
		if (!empty($_REQUEST['id'])) {
			$data=$modelUser->find('first',array('conditions'=>array('_id'=>new MongoID($_REQUEST['id']))));
			setVariable('data',$data);
		}
		if(isset($_REQUEST['user']))
		{
			if ($modelUser->checkManager($_REQUEST['user'],$_REQUEST['id'])) {
				$save['Manager']['user']=$_REQUEST['user'];
				$save['Manager']['pass']=(isset($_REQUEST['pass']))?md5($_REQUEST['pass']):$data['Manager']['pass'];
				$save['Manager']['hoten']=$_REQUEST['hoten'];
				$save['Manager']['diachi']=$_REQUEST['diachi'];
				$save['Manager']['email']=$_REQUEST['email'];
                // $save['Manager']['ngaysinh']=$_REQUEST['ngaysinh'];
                // $save['Manager']['noisinh']=$_REQUEST['noisinh'];
				$save['Manager']['sdt']=$_REQUEST['sdt'];
				$save['Manager']['permission']=$_REQUEST['loaind'];
					$modelUser->save($save);
					$modelUser->redirect($urlPlugins.'admin/qlvb-admin-dsUser.php?stt=1');
				
			}
			else {
					$save['Manager']['user']=$_REQUEST['user'];
				$save['Manager']['pass']=(isset($_REQUEST['pass']))?md5($_REQUEST['pass']):$data['Manager']['pass'];
				$save['Manager']['hoten']=$_REQUEST['hoten'];
				$save['Manager']['diachi']=$_REQUEST['diachi'];
                $save['Manager']['email']=$_REQUEST['email'];
				// $save['Manager']['ngaysinh']=$_REQUEST['ngaysinh'];
                // $save['Manager']['noisinh']=$_REQUEST['noisinh'];
				$save['Manager']['sdt']=$_REQUEST['sdt'];
				$save['Manager']['permission']=$_REQUEST['loaind'];
					$dk=new MongoID($_REQUEST['id']);
					$dk= array('_id'=>$dk);
					$modelUser->updateAll($save['Manager'],$dk);
					$modelUser->redirect($urlPlugins.'admin/qlvb-admin-dsUser.php?stt=2');
				}
			
		}
	}
    else {
        $modelUser->redirect($urlHomes);
    }
}
function xl()
{
    global $urlHomes;
    global $urlPlugins;
    $modelXeploaivb = new Xeploai();
    if (checkAdminLogin()) {
        $listData=$modelXeploaivb->getList('Văn bằng');
    setVariable('listData',$listData);
        if (!empty($_REQUEST['code'])) {
            $save['Xeploai']['code']=$_REQUEST['code'];
            $save['Xeploai']['name']=$_REQUEST['name'];
            if (empty($_REQUEST['id'])) {
                $modelXeploaivb->save($save);
        $modelXeploaivb->redirect($urlPlugins . 'admin/qlvb-admin-xl.php');
            }
            else
            {
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $modelXeploaivb->updateAll($save['Xeploai'],$dk);
        $modelXeploaivb->redirect($urlPlugins . 'admin/qlvb-admin-xl.php');
            }

        }
    } else {
        $modelXeploaivb->redirect($urlHomes);
    }
}

//tạo chứng chỉ
function dsSV()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien();     
    $listData=$model ->getList($_GET['idLop']);
    setVariable('listData',$listData);
    } else {
        $model->redirect($urlHomes);
    }
}



function chonSV()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien(); 
    $modelLoai = new Loai();    
    $listData=$model ->getList($_GET['idLop']);
    $loai = $modelLoai->getList('Văn bằng');
    setVariable('listData',$listData);
    setVariable('loai',$loai);
    setVariable('idLop',$_GET['idLop']);
    }else {
        $model->redirect($urlHomes);
    }
}


function themVB()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien();  
    $modelXl = new Xeploai(); 
    if (!empty($_POST['sv'])) {
    $listData=$model ->getListByList($_POST['sv']);
    $xl = $modelXl->getList();
    setVariable('listData',$listData);
    setVariable('xl',$xl);
    setVariable('idLop',$_REQUEST['idLop']);
    setVariable('loai',$_REQUEST['loaivb']);
    }
    else
    {
        $model->redirect($urlPlugins.'admin/qlvb-admin-chonSV.php?idLop='.$_REQUEST['idLop'].'&stt=1');
    }
    
    }else {
        $model->redirect($urlHomes);
    }
}


function luuVB()
{
     global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
        $model = new Vanbang();
    if (!empty($_REQUEST['vb'])) {
        $ngcap = $_REQUEST['nguoicap'];
        $chucvu = $_REQUEST['chucvu'];
        $i=0;
        foreach ($_REQUEST['vb'] as $key => $value) {
            $i++;
            $save['Vanbang']['idSV']=$value['id'];
            $save['Vanbang']['loai']=$value['loai'];
            $save['Vanbang']['masv']=$value['code'];
            $save['Vanbang']['ngaycap']=$value['ngaycap'];
            $save['Vanbang']['sohieu']=$value['sohieu'];
            $save['Vanbang']['sovaoso']=$value['sovaoso'];
            $save['Vanbang']['soqd']=$value['soqd'];
            $save['Vanbang']['xl']=$value['xl'];
            $save['Vanbang']['nguoicap']=$ngcap;
            $save['Vanbang']['chucvu']=$chucvu;
            $save['Vanbang']['img']=$value['img'.$i];
            // $query='db.collection.insert('.$save['Vanbang'].')';
            $model->saveMany($save);
        }
    }
    else
    {
        $model->redirect($urlPlugins.'admin/qlvb-admin-chonSV.php?idLop='.$_REQUEST['idLop'].'&stt=1');
    }
    }else {
        $model->redirect($urlHomes);
    }

}



function taoVB()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Lop();     
    if (!empty($_REQUEST['key'])) {
        $listData=$model ->getListByKey($_REQUEST['key']);
    setVariable('listData',$listData);
    }
    }else {
        $model->redirect($urlHomes);
    }
}

function VBdetail()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Vanbang();  
    $modelSV = new Sinhvien();   
    $modelXl = new Xeploai();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Vanbang']['idSV']); 
    $hinhthuc = hinhthuc($dataSV['Sinhvien']['hinhthuc']);
    $xl = $modelXl -> getDataById($data['Vanbang']['xl']); 
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    }
    else {
            $model->redirect($urlHomes);
    }
}

function editVB()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Vanbang();  
    $modelSV = new Sinhvien();   
    $modelXl = new Xeploai();   
    $modelLoai = new Loai();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Vanbang']['idSV']); 
    // $hinhthuc = hinhthuc($dataSV['Sinhvien']['hinhthuc']);
    $xl = $modelXl -> getList(); 
    $loai = $modelLoai -> getList('Văn bằng'); 
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    // setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    setVariable('loai',$loai);
    if (!empty($_REQUEST['id'])) {
            // $save['Vanbang']['idSV']=$_REQUEST['idSV'];
            // $save['Vanbang']['masv']=$_REQUEST['code'];
            $save['Vanbang']['loai']=$_REQUEST['loaivb'];
            $save['Vanbang']['ngaycap']=$_REQUEST['ngaycap'];
            $save['Vanbang']['sohieu']=$_REQUEST['sohieu'];
            $save['Vanbang']['sovaoso']=$_REQUEST['sovaoso'];
            $save['Vanbang']['soqd']=$_REQUEST['soqd'];
            $save['Vanbang']['xl']=$_REQUEST['xl'];
            $save['Vanbang']['nguoicap']=$_REQUEST['nguoicap'];
            $save['Vanbang']['chucvu']=$_REQUEST['chucvu'];
            $save['Vanbang']['img']=$_REQUEST['img'];
            // $query='db.collection.insert('.$save['Vanbang'].')';
            $id= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$id);
               $this->updateAll($save['Vanbang'],$dk);
    }
    }
    else {
            $model->redirect($urlHomes);
    }
}


function editCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Chungchi
    $modelSV = new Sinhvien();   
    $modelXl = new Xeploai();   
    $modelLoai = new Loai();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Vanbang']['idSV']); 
    // $hinhthuc = hinhthuc($dataSV['Sinhvien']['hinhthuc']);
    $xl = $modelXl -> getList(); 
    $loai = $modelLoai -> getList('Chứng chỉ'); 
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    // setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    setVariable('loai',$loai);
    if (!empty($_REQUEST['id'])) {
            // $save['Vanbang']['idSV']=$_REQUEST['idSV'];
            $save['Chungchi']['masv']=$_REQUEST['code'];
            $save['Chungchi']['loai']=$_REQUEST['loaicc'];
            $save['Chungchi']['ngaycap']=$_REQUEST['ngaycap'];
            $save['Chungchi']['tungay']=$_REQUEST['denngay'];
            $save['Chungchi']['denngay']=$_REQUEST['tungay'];
            $save['Chungchi']['sohieu']=$_REQUEST['sohieu'];
            $save['Chungchi']['sovaoso']=$_REQUEST['sovaoso'];
            $save['Chungchi']['soqd']=$_REQUEST['soqd'];
            $save['Chungchi']['xl']=$_REQUEST['xl'];
            $save['Chungchi']['nguoicap']=$_REQUEST['nguoicap'];
            $save['Chungchi']['chucvu']=$_REQUEST['chucvu'];
            $save['Chungchi']['img']=$_REQUEST['img'];
            // $query='db.collection.insert('.$save['Vanbang'].')';
            $id= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$id);
               $this->updateAll($save['Chungchi'],$dk);
    }
    }
    else {
            $model->redirect($urlHomes);
    }
}

function delVB()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Vanbang(); 
    $idDel = new MongoId($_REQUEST['id']);
    $dk= array('_id'=>$idDel);
    $update['deleted']=1;
    $model->updateAll($update,$dk);
    $model->redirect($urlPlugins . 'admin/qlvb-admin-dsLop.php');
    }else {
        $model->redirect($urlHomes);
    }
}
function delCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Chungchi(); 
    $idDel = new MongoId($_REQUEST['id']);
    $dk= array('_id'=>$idDel);
    $update['deleted']=1;
    $model->updateAll($update,$dk);
    $model->redirect($urlPlugins . 'admin/qlvb-admin-dsLop.php');
    }else {
        $model->redirect($urlHomes);
    }
}
//tạo chứng chỉ



function chonSVCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien(); 
    $modelLoai = new Loai();    
    $listData=$model ->getList($_GET['idLop']);
    $loai = $modelLoai->getList('Chứng chỉ');
    setVariable('listData',$listData);
    setVariable('loai',$loai);
    setVariable('idLop',$_GET['idLop']);
    }else {
        $model->redirect($urlHomes);
    }
}


function themCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien();  
    $modelXl = new Xeploai(); 
    if (!empty($_POST['sv'])) {
    $listData=$model ->getListByList($_POST['sv']);
    $xl = $modelXl->getList();
    setVariable('listData',$listData);
    setVariable('xl',$xl);
    setVariable('idLop',$_REQUEST['idLop']);
    setVariable('loai',$_REQUEST['loaivb']);
    }
    else
    {
        $model->redirect($urlPlugins.'admin/qlvb-admin-chonSV.php?idLop='.$_REQUEST['idLop'].'&stt=1');
    }
    
    }else {
        $model->redirect($urlHomes);
    }
}


function luuCC()
{
     global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
        $model = new Chungchi();
    if (!empty($_REQUEST['vb'])) {
        $ngcap = $_REQUEST['nguoicap'];
        $chucvu = $_REQUEST['chucvu'];
        $tungay = $_REQUEST['tungay'];
        $denngay = $_REQUEST['denngay'];
        $hoidong = $_REQUEST['hoidong'];
        $i=0;
        foreach ($_REQUEST['vb'] as $key => $value) {
            $i++;
            $save['Chungchi']['idSV']=$value['id'];
            $save['Chungchi']['loai']=$value['loai'];
            $save['Chungchi']['masv']=$value['code'];
            $save['Chungchi']['ngaycap']=$value['ngaycap'];
            $save['Chungchi']['sohieu']=$value['sohieu'];
            $save['Chungchi']['sovaoso']=$value['sovaoso'];
            $save['Chungchi']['soqd']=$value['soqd'];
            $save['Chungchi']['xl']=$value['xl'];
            $save['Chungchi']['hoidong']=$hoidong;
            $save['Chungchi']['nguoicap']=$ngcap;
            $save['Chungchi']['chucvu']=$chucvu;
            $save['Chungchi']['img']=$value['img'.$i];
            $save['Chungchi']['tungay']=$tungay;
            $save['Chungchi']['denngay']=$denngay;

            // $query='db.collection.insert('.$save['Chungchi'].')';
            $model->saveMany($save);
        }
    }
    else
    {
        $model->redirect($urlPlugins.'admin/qlvb-admin-chonSV.php?idLop='.$_REQUEST['idLop'].'&stt=1');
    }
    }else {
        $model->redirect($urlHomes);
    }

}



function taoCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Lop();     
    if (!empty($_REQUEST['key'])) {
        $listData=$model ->getListByKey($_REQUEST['key']);
    setVariable('listData',$listData);
    }
    }else {
        $model->redirect($urlHomes);
    }
}
function CCdetail()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Chungchi();     
    $modelSV = new Sinhvien();   
    $modelXl = new Xeploai();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Chungchi']['idSV']); 
    $hinhthuc = hinhthuc($dataSV['Sinhvien']['hinhthuc']);
    $xl = $modelXl -> getDataById($data['Vanbang']['xl']); 
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    }else {
        $model->redirect($urlHomes);
    }
}





function taoSV()
{
    global $urlHomes;
    global $urlPlugins;
    $modelUser = new Sinhvien();     
    if(checkAdminLogin()){
        if (!empty($_REQUEST['id'])) {
            $data=$modelUser->find('first',array('conditions'=>array('_id'=>new MongoID($_REQUEST['id']))));
            setVariable('data',$data);
        }
        if(isset($_REQUEST['code']))
        {
            if ($modelUser->checkSinhvien($_REQUEST['code'],$_REQUEST['id'])) {
                $save['Sinhvien']['code']=$_REQUEST['code'];
                $save['Sinhvien']['hoten']=$_REQUEST['hoten'];
                $save['Sinhvien']['diachi']=$_REQUEST['diachi'];
                $save['Sinhvien']['email']=$_REQUEST['email'];
                $save['Sinhvien']['noisinh']=$_REQUEST['noisinh'];
                $save['Sinhvien']['ngaysinh']=$_REQUEST['ngaysinh'];
                $save['Sinhvien']['sdt']=$_REQUEST['sdt'];
                $save['Sinhvien']['idLop']=$_REQUEST['idLop'];
                $save['Sinhvien']['tinhtrang']=$_REQUEST['tinhtrang'];
                $save['Sinhvien']['gioitinh']=(int)$_REQUEST['gioitinh'];
                $save['Sinhvien']['cmnd']=$_REQUEST['cmnd'];
                
                    $modelUser->save($save);
                    $modelUser->redirect($urlPlugins.'admin/qlvb-admin-dsSV.php?idLop='.$save['Sinhvien']['idLop'].'&stt=1');
                
            }
            else {
                    $save['Sinhvien']['code']=$_REQUEST['code'];
                $save['Sinhvien']['hoten']=$_REQUEST['hoten'];
                $save['Sinhvien']['diachi']=$_REQUEST['diachi'];
                $save['Sinhvien']['email']=$_REQUEST['email'];
                $save['Sinhvien']['noisinh']=$_REQUEST['noisinh'];
                $save['Sinhvien']['ngaysinh']=$_REQUEST['ngaysinh'];
                $save['Sinhvien']['sdt']=$_REQUEST['sdt'];
                $save['Sinhvien']['idLop']=$_REQUEST['idLop'];
                $save['Sinhvien']['tinhtrang']=$_REQUEST['tinhtrang'];
                $save['Sinhvien']['gioitinh']=(int)$_REQUEST['gioitinh'];
                $save['Sinhvien']['cmnd']=$_REQUEST['cmnd'];
                    $dk=new MongoID($_REQUEST['id']);
                    $dk= array('_id'=>$dk);
                    $modelUser->updateAll($save['Sinhvien'],$dk);
                    $modelUser->redirect($urlPlugins.'admin/qlvb-admin-dsSV.php?stt=2');
                }
            
        }
    }
    else {
        $modelUser->redirect($urlHomes);
    }
}
function taoLop()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Lop();     
    if(checkAdminLogin()){
        if (!empty($_REQUEST['id'])) {
            $data=$model->find('first',array('conditions'=>array('_id'=>new MongoID($_REQUEST['id']))));
            setVariable('data',$data);
        }
        if (!empty($_REQUEST['name'])) {
            if (empty($_REQUEST['id'])) {
            if ($model->checkLop($_REQUEST['code'],$_REQUEST['name'])) {
                $save['Lop']['code']=$_REQUEST['code'];
                $save['Lop']['name']=$_REQUEST['name'];
                $save['Lop']['khoahoc']=$_REQUEST['khoahoc'];
                $save['Lop']['nganh']=$_REQUEST['nganh'];
                $save['Lop']['hinhthuc']=$_REQUEST['hinhthuc'];
                    $model->save($save);
                    $model->redirect($urlPlugins.'admin/qlvb-admin-dsLop.php?stt=1');
                
            }
        }
            else {
                $save['Lop']['code']=$_REQUEST['code'];
                $save['Lop']['name']=$_REQUEST['name'];
                $save['Lop']['khoahoc']=$_REQUEST['khoahoc'];
                $save['Lop']['nganh']=$_REQUEST['nganh'];
                    $dk=new MongoID($_REQUEST['id']);
                    $dk= array('_id'=>$dk);
                    $model->updateAll($save['Lop'],$dk);
                    $model->redirect($urlPlugins.'admin/qlvb-admin-dsLop.php?stt=2');
                }
          }  
        
    }else {
        $model->redirect($urlHomes);
    }
}
function dsUser()
{
	global $urlHomes;
	global $urlPlugins;
	$modelUser = new Manager();		
	if(checkAdminLogin()){
		$listData= $modelUser->find('all',array('conditions'=>array('user'=>array('$ne'=>null))));
		setVariable('listData',$listData);
	}else {
        $modelUser->redirect($urlHomes);
    }
}
function dsLop()
{
    global $urlHomes;
    global $urlPlugins;
    $modelLop = new Lop();      
    if(checkAdminLogin()){
        $listData= $modelLop->find('all');
        setVariable('listData',$listData);
    }else {
        $modelLop->redirect($urlHomes);
    }
}
function delManager()
{
	global $urlHomes;
	global $urlPlugins;
	$modelUser = new Manager();		
	if(checkAdminLogin()){
		$id= new MongoID($_REQUEST['id']);
		$modelUser->delete($id);
		$modelUser->redirect($urlPlugins.'admin/qlvb-admin-dsUser.php?stt=2');
	}
    else {
        $modelUser->redirect($urlHomes);
    }
}
function loaiSV()
{
	global $urlHomes;
    global $urlPlugins;
    $modelLoaisv = new Loaisv();

    if (checkAdminLogin()) {
        $listData=$modelLoaisv->getList();
    setVariable('listData',$listData);
        if (!empty($_REQUEST['code'])) {
            $save['Loaisv']['code']=$_REQUEST['code'];
            $save['Loaisv']['name']=$_REQUEST['name'];
            $save['Loaisv']['des']=$_REQUEST['des'];
            if (empty($_REQUEST['id'])) {
            	$modelLoaisv->save($save);
        $modelLoaisv->redirect($urlPlugins . 'admin/qlvb-admin-loaiSV.php');
            }
            else
            {	$idDel= new MongoId($_REQUEST['id']);
		       $dk= array('_id'=>$idDel);
            	$modelLoaisv->updateAll($save['Loaisv'],$dk);
        $modelLoaisv->redirect($urlPlugins . 'admin/qlvb-admin-loaiSV.php');
            }

        }
    } else {
        $modelLoaisv->redirect($urlHomes);
    }
}
function loaiVB()
{
	global $urlHomes;
    global $urlPlugins;
    $modelLoaivb = new Loai();
    if (checkAdminLogin()) {
        $listData=$modelLoaivb->getList('Văn bằng');
    setVariable('listData',$listData);
        if (!empty($_REQUEST['code'])) {
            $save['Loai']['code']=$_REQUEST['code'];
            $save['Loai']['name']=$_REQUEST['name'];
            $save['Loai']['des']=$_REQUEST['des'];
            $save['Loai']['loai']='Văn bằng';
            if (empty($_REQUEST['id'])) {
            	$modelLoaivb->save($save);
        $modelLoaivb->redirect($urlPlugins . 'admin/qlvb-admin-loaiVB.php');
            }
            else
            {
            	$idDel= new MongoId($_REQUEST['id']);
		       $dk= array('_id'=>$idDel);
            	$modelLoaivb->updateAll($save['Loai'],$dk);
        $modelLoaivb->redirect($urlPlugins . 'admin/qlvb-admin-loaiVB.php');
            }

        }
    } else {
        $modelLoaivb->redirect($urlHomes);
    }
}
function loaiCC()
{
	global $urlHomes;
    global $urlPlugins;
    $modelLoaicc = new Loai();

    if (checkAdminLogin()) {
        $listData=$modelLoaicc->getList('Chứng chỉ');
    setVariable('listData',$listData);
        if (!empty($_REQUEST['code'])) {
            $save['Loai']['code']=$_REQUEST['code'];
            $save['Loai']['name']=$_REQUEST['name'];
            $save['Loai']['des']=$_REQUEST['des'];
            $save['Loai']['loai']='Chứng chỉ';
            if (empty($_REQUEST['id'])) {
            	$modelLoaicc->save($save);
        $modelLoaicc->redirect($urlPlugins . 'admin/qlvb-admin-loaiCC.php');
            }
            else
            {	
            	$idDel= new MongoId($_REQUEST['id']);
		       $dk= array('_id'=>$idDel);
            	$modelLoaicc->updateAll($save['Loai'],$dk);
        $modelLoaicc->redirect($urlPlugins . 'admin/qlvb-admin-loaiCC.php');
            }

        }
    } else {
        $modelLoaicc->redirect($urlHomes);
    }
}
function dsKhoa()
{
    global $urlHomes;
    global $urlPlugins;
    $modelKhoa = new Khoa();

    if (checkAdminLogin()) {
        $listData=$modelKhoa->getList();
    setVariable('listData',$listData);
        if (!empty($_REQUEST['code'])) {
            $save['Khoa']['code']=$_REQUEST['code'];
            $save['Khoa']['name']=$_REQUEST['name'];
            $save['Khoa']['des']=$_REQUEST['des'];
            if (empty($_REQUEST['id'])) {
                $modelKhoa->save($save);
        $modelKhoa->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoa.php');
            }
            else
            {   
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $modelKhoa->updateAll($save['Khoa'],$dk);
        $modelKhoa->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoa.php');
            }

        }
    } else {
        $modelKhoa->redirect($urlHomes);
    }
}
function dsNganh()
{
    global $urlHomes;
    global $urlPlugins;
    $modelNganh = new Nganh();

    if (checkAdminLogin()) {
        $listData=$modelNganh->getList();
    setVariable('listData',$listData);
        if (!empty($_REQUEST['code'])) {
            $save['Nganh']['code']=$_REQUEST['code'];
            $save['Nganh']['name']=$_REQUEST['name'];
            $save['Nganh']['des']=$_REQUEST['des'];
            $save['Nganh']['khoa']=$_REQUEST['khoa'];
            if (empty($_REQUEST['id'])) {
                $modelNganh->save($save);
        $modelNganh->redirect($urlPlugins . 'admin/qlvb-admin-dsNganh.php');
            }
            else
            {   
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $modelNganh->updateAll($save['Nganh'],$dk);
        $modelNganh->redirect($urlPlugins . 'admin/qlvb-admin-dsNganh.php');
            }

        }
    } else {
        $modelNganh->redirect($urlHomes);
    }
}
function dsKhoaHoc()
{
    global $urlHomes;
    global $urlPlugins;
    $modelKhoahoc = new Khoahoc();

    if (checkAdminLogin()) {
        $listData=$modelKhoahoc->getList();
    setVariable('listData',$listData);
        if (!empty($_REQUEST['code'])) {
            $save['Khoahoc']['code']=$_REQUEST['code'];
            $save['Khoahoc']['time']=$_REQUEST['time'];
            if (empty($_REQUEST['id'])) {
                $modelKhoahoc->save($save);
        $modelKhoahoc->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoaHoc.php');
            }
            else
            {   
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $modelKhoahoc->updateAll($save['Khoahoc'],$dk);
        $modelKhoahoc->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoaHoc.php');
            }

        }
    } else {
        $modelKhoahoc->redirect($urlHomes);
    }
}
function phanquyen()
{
    global $urlHomes;
    global $urlPlugins;
    $modelLoaiquyen = new Loaiquyen();

    if (checkAdminLogin()) {
        $listData=$modelLoaiquyen->getList();
    setVariable('listData',$listData);
        if (!empty($_REQUEST['code'])) {
            $save['Loaiquyen']['code']=$_REQUEST['code'];
            $save['Loaiquyen']['name']=$_REQUEST['name'];
            $save['Loaiquyen']['des']=$_REQUEST['des'];
            if (empty($_REQUEST['id'])) {
                $modelLoaiquyen->save($save);
        $modelLoaiquyen->redirect($urlPlugins . 'admin/qlvb-admin-phanquyen.php');
            }
            else
            {   
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $modelLoaiquyen->updateAll($save['Loaiquyen'],$dk);
        $modelLoaiquyen->redirect($urlPlugins . 'admin/qlvb-admin-phanquyen.php');
            }

        }
    } else {
        $modelLoaiquyen->redirect($urlHomes);
    }
}
function delLop()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Lop();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDel = new MongoId($_REQUEST['id']);
            $dk= array('_id'=>$idDel);
            $update['status']=0;
            $model->updateAll($update,$dk);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsLop.php');
}
}else {
        $model->redirect($urlHomes);
    }
}
function delKhoa()
{
    global $urlHomes;
    global $urlPlugins;
    $modelKhoa = new Khoa();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $modelKhoa->delete($idDelete);
        $modelKhoa->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoa.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}
function delLoaiquyen()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Loaiquyen();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-phanquyen.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}
function delNganh()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Nganh();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsNganh.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}
function delKhoahoc()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Khoahoc();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoaHoc.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}
function delLoaisv()
{
	global $urlHomes;
    global $urlPlugins;
    $modelLoaisv = new Loaisv();

    if (checkAdminLogin()) {
    	if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
    		$modelLoaisv->delete($idDelete);
        $modelLoaisv->redirect($urlPlugins . 'admin/qlvb-admin-loaiSV.php');

    	}
}else {
        $model->redirect($urlHomes);
    }
}
function delLoaicc()
{
    global $urlHomes;
    global $urlPlugins;
    $modelLoaicc = new Loaicc();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $modelLoaicc->delete($idDelete);
        $modelLoaicc->redirect($urlPlugins . 'admin/qlvb-admin-loaiCC.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}
function delLoaivb()
{
    global $urlHomes;
    global $urlPlugins;
    $modelLoaivb = new Loaivb();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $modelLoaivb->delete($idDelete);
        $modelLoaivb->redirect($urlPlugins . 'admin/qlvb-admin-loaiVB.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}
 ?>