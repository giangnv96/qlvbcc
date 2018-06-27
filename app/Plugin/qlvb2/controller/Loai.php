<?php 
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
 ?>