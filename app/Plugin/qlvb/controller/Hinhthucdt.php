<?php 
function dsHinhthucdt()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Hinhthucdt();

    if (checkAdminLogin()) {
        $listData=$model->getList();
        setVariable('listData',$listData);
        if (!empty($_REQUEST['name'])) {
            $save['Hinhthucdt']['name']=$_REQUEST['name'];
            if (empty($_REQUEST['id'])) {
                    $model->save($save);
                $model->redirect($urlPlugins . 'admin/qlvb-admin-dsHinhthucdt.php?stt=1');
            }
            else
            {   
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $model->updateAll($save['Hinhthucdt'],$dk);
                $model->redirect($urlPlugins . 'admin/qlvb-admin-dsHinhthucdt.php?stt=2');
            }

        }
    } else {
        $model->redirect($urlHomes);
    }
}
function delHinhthucdt()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Hinhthucdt();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
        $idDelete = new MongoId($_REQUEST['id']);
        $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsHinhthucdt.php?stt=3');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsHinhthucdt.php');
    
}else {
        $model->redirect($urlHomes);
    }
}

 ?>