<?php 
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
            $check=$model->checkCode($_REQUEST['code']);
            if (empty($check)) {
                $save['Lop']['code']=$_REQUEST['code'];
                $save['Lop']['name']=$_REQUEST['name'];
                $save['Lop']['khoahoc']=$_REQUEST['khoahoc'];
                $save['Lop']['nganh']=$_REQUEST['nganh'];
                $save['Lop']['hinhthuc']=$_REQUEST['hinhthuc'];
                    $model->save($save);
                    $model->redirect($urlPlugins.'admin/qlvb-admin-dsLop.php?stt=1');
                
            }
            else
            {
                echo '<script>
                    alert("Mã lớp đã tồn tại");
                    </script>';
            }
        }
            else {
                if ($model->checkCodeId($_REQUEST['code'],$_REQUEST['id'])) {
                $save['Lop']['code']=$_REQUEST['code'];
                $save['Lop']['name']=$_REQUEST['name'];
                $save['Lop']['id_khoahoc']=$_REQUEST['khoahoc'];
                $save['Lop']['id_nganh']=$_REQUEST['nganh'];
                    $dk=new MongoID($_REQUEST['id']);
                    $dk= array('_id'=>$dk);
                    $model->updateAll($save['Lop'],$dk);
                    $model->redirect($urlPlugins.'admin/qlvb-admin-dsLop.php?stt=2');
                }
                else
                {
                    echo '<script>
                        alert("Mã sinh viên đã tồn tại");
                        </script>';
                }
          }  
        }
    }else {
        $model->redirect($urlHomes);
    }
}
function dsLop()
{
    global $urlHomes;
    global $urlPlugins;
    $modelLop = new Lop();      
    if(checkAdminLogin()){
        if (!empty($_REQUEST['key'])) {
            $listData=$modelLop ->getListByKey($_REQUEST['key']);
            setVariable('listData',$listData);
        }
        else
        {
            $listData= $modelLop->find('all');
            setVariable('listData',$listData);
        }
    }else {
        $modelLop->redirect($urlHomes);
    }
}
function delLop()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Lop();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
        $modelDel = new Sinhvien();
        $data = $modelDel->checkEmptyId($_REQUEST['id']);
        if (empty($data)) {
        $idDelete = new MongoId($_REQUEST['id']);
        $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsLop.php?stt=3');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsLop.php?error=-1');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsLop.php');
}else {
        $model->redirect($urlHomes);
    }
}
 ?>