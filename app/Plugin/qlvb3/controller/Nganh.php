<?php 
function dsNganh()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Nganh();

    if (checkAdminLogin()) {
        $listData=$model->getList();
    setVariable('listData',$listData);
        $check = $model->checkcode(@$_REQUEST['code'],@$_REQUEST['name']);
        if (!empty($_REQUEST['code'])) {
            $save['Nganh']['code']=$_REQUEST['code'];
            $save['Nganh']['name']=$_REQUEST['name'];
            $save['Nganh']['des']=$_REQUEST['des'];
            $save['Nganh']['id_khoa']=$_REQUEST['khoa'];
            if (empty($_REQUEST['id'])) {
                if (empty($check)) {
                    $model->save($save);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsNganh.php');
                }
                else
                {
                    echo '<script>
                            alert("Mã ngành hoặc tên ngành đã tồn tại");
                            </script>';
                }
            }
            else
            {   
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $model->updateAll($save['Nganh'],$dk);
                $model->redirect($urlPlugins . 'admin/qlvb-admin-dsNganh.php');
            }

        }
        
    } else {
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
        $modelDel = new Lop();
        $data = $modelDel->checkEmptyId($_REQUEST['id']);
        if (empty($data)) {
        $idDelete = new MongoId($_REQUEST['id']);
        $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsNganh.php');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsNganh.php?error=-1');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsNganh.php');
}else {
        $model->redirect($urlHomes);
    }
}
 ?>