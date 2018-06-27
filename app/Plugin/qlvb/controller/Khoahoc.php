<?php 
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
        $modelKhoahoc->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoaHoc.php?stt=1');
            }
            else
            {   
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $modelKhoahoc->updateAll($save['Khoahoc'],$dk);
        $modelKhoahoc->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoaHoc.php?stt=2');
            }

        }
    } else {
        $modelKhoahoc->redirect($urlHomes);
    }
}
function delKhoahoc()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Khoahoc();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
        $modelDel = new Lop();
        $data = $modelDel->checkEmptyIdKH($_REQUEST['id']);
        if (empty($data)) {
        $idDelete = new MongoId($_REQUEST['id']);
        $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoaHoc.php?stt=3');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoaHoc.php?error=-1');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoaHoc.php');
}else {
        $model->redirect($urlHomes);
    }
}

 ?>