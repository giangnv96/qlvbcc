<?php 
function xl()
{
    global $urlHomes;
    global $urlPlugins;
    $modelXeploaivb = new Xeploai();
    if (checkAdminLogin()) {
        $listData=$modelXeploaivb->getList('Văn bằng');
    setVariable('listData',$listData);
        if (!empty($_REQUEST['name'])) {
            $save['Xeploai']['mota']=$_REQUEST['mota'];
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
function delXeploai()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Xeploai();
    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
        $model1 = new Vanbang();
        $model2 = new Chungchi();
        $data1 = $model1->checkEmptyIdXl($_REQUEST['id']);
        $data2 = $model2->checkEmptyIdXl($_REQUEST['id']);
        if (empty($data1)&&empty($data2)) {
        $idDelete = new MongoId($_REQUEST['id']);
        $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-xl.php');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-xl.php?error=-1');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-xl.php');
}else {
        $model->redirect($urlHomes);
    }
}
 ?>