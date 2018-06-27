<?php 
function dsKhoa()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Khoa();

    if (checkAdminLogin()) {
        $listData=$model->getList();
        setVariable('listData',$listData);
        $check = $model->checkcode(@$_REQUEST['code'],@$_REQUEST['name']);
        if (!empty($_REQUEST['code'])) {
            $save['Khoa']['code']=$_REQUEST['code'];
            $save['Khoa']['name']=$_REQUEST['name'];
            $save['Khoa']['des']=$_REQUEST['des'];
            if (empty($_REQUEST['id'])) {
                if (empty($check)) {
                    $model->save($save);
                $model->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoa.php?stt=1');
                }
                else
                {
                    echo '<script>
                            alert("Mã khoa hoặc tên khoa đã tồn tại");
                            </script>';
                }
                
            }
            else
            {   
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $model->updateAll($save['Khoa'],$dk);
                $model->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoa.php?stt=2');
            }

        }
    } else {
        $model->redirect($urlHomes);
    }
}
function delKhoa()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Khoa();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
        $modelDel = new Nganh();
        $data = $modelDel->checkEmptyId($_REQUEST['id']);
        if (empty($data)) {
        $idDelete = new MongoId($_REQUEST['id']);
        $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoa.php?stt=3');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoa.php?error=-1');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsKhoa.php');
    
}else {
        $model->redirect($urlHomes);
    }
}

 ?>