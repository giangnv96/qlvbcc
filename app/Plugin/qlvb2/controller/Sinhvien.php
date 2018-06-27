<?php 
function delSV()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Sinhvien();
    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
        $modelDel1 = new Vanbang();
        $modelDel2 = new Chungchi();
        $dataVB = $modelDel1->checkEmptyIdSv($_REQUEST['id']);
        $dataCC = $modelDel2->checkEmptyIdSv($_REQUEST['id']);
        if (empty($dataVB)&&empty($dataCC)) {
            $idDel = new MongoId($_REQUEST['id']);
            $dk= array('_id'=>$idDel);
            $update['deleted']=1;
            $model->updateAll($update,$dk);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsSV.php');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsSV.php?error=-1');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsSV.php');
}else {
        $model->redirect($urlHomes);
    }
}
function dsSV()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien();
    $page=(isset($_REQUEST['page']))?$_REQUEST['page']:1;  
    $listData=$model ->getList($_GET['idLop'],$page);
    setVariable('listData',$listData);
    } else {
        $model->redirect($urlHomes);
    }
}
function dsSinhVien()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien();
    
    if (isset($_REQUEST['code'])&&isset($_REQUEST['name'])) {
    $conditions['deleted'] = 0;
    if (!empty($_REQUEST['code'])) {
    $conditions['code']= array('$regex'=>trim($_REQUEST['code']));
    }
    if (!empty($_REQUEST['name'])) {
    $conditions['hoten']= array('$regex'=>trim($_REQUEST['name']));
    }
    $listData=$model ->find('all', array('conditions'=>$conditions));
    setVariable('listData',$listData);
    }
    } else {
        $model->redirect($urlHomes);
    }
}
function taoSV()
{
    global $urlHomes;
    global $urlPlugins;
    $modelUser = new Sinhvien();     
    $model = new Lop();     
    if(checkAdminLogin()){
        if (!empty($_REQUEST['id'])) {
            $data=$modelUser->find('first',array('conditions'=>array('_id'=>new MongoID($_REQUEST['id']))));
            setVariable('data',$data);
        }
        if(isset($_REQUEST['code']))
        {
            if (empty($_REQUEST['id'])) {
                if (empty($modelUser->checkCode($_REQUEST['code']))) {
                $codeLop = $model->find('first',array('conditions'=>array('_id'=>new MongoID($_REQUEST['idLop']))));
                $save['Sinhvien']['masv']=$_REQUEST['code'];
                $save['Sinhvien']['hoten']=$_REQUEST['hoten'];
                $save['Sinhvien']['diachi']=$_REQUEST['diachi'];
                $save['Sinhvien']['email']=$_REQUEST['email'];
                $save['Sinhvien']['noisinh']=$_REQUEST['noisinh'];
                $save['Sinhvien']['ngaysinh']=$_REQUEST['ngaysinh'];
                $save['Sinhvien']['sdt']=$_REQUEST['sdt'];
                $save['Sinhvien']['idLop']=$_REQUEST['idLop'];
                $save['Sinhvien']['codeLop']=$codeLop['Lop']['code'];
                $save['Sinhvien']['tinhtrang']=$_REQUEST['tinhtrang'];
                $save['Sinhvien']['gioitinh']=(int)$_REQUEST['gioitinh'];
                $save['Sinhvien']['cmnd']=$_REQUEST['cmnd'];
                $save['Sinhvien']['deleted']=0;
                
                    $modelUser->save($save);
                    $modelUser->redirect($urlPlugins.'admin/qlvb-admin-dsSV.php?idLop='.$save['Sinhvien']['idLop'].'&stt=1');
                
            }
            else
            {
                echo '<script>
                    alert("Mã sinh viên đã tồn tại");
                    </script>';
            }
            }
            else {
                $check=$modelUser->checkCodeId($_REQUEST['code'],$_REQUEST['id']);
                $checkcode=$modelUser->checkCode($_REQUEST['code']);
                if ($modelUser->checkCodeId($_REQUEST['code'],$_REQUEST['id'])) {
                $save['Sinhvien']['masv']=$_REQUEST['code'];
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
                else
                {
                    echo '<script>
                        alert("Mã sinh viên đã tồn tại");
                        </script>';
                }
                }
            
        }
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
            {   $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $modelLoaisv->updateAll($save['Loaisv'],$dk);
        $modelLoaisv->redirect($urlPlugins . 'admin/qlvb-admin-loaiSV.php');
            }

        }
    } else {
        $modelLoaisv->redirect($urlHomes);
    }
}

 ?>