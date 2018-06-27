<?php 
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
            if ($modelUser->checkSinhvien($_REQUEST['code'],$_REQUEST['id'])) {
                $codeLop = $model->find('first',array('conditions'=>array('_id'=>new MongoID($_REQUEST['idLop']))));
                $save['Sinhvien']['code']=$_REQUEST['code'];
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