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
        $modelUS = new Manager();
        $dataVB = $modelDel1->checkEmptyIdSv($_REQUEST['id']);
        $dataCC = $modelDel2->checkEmptyIdSv($_REQUEST['id']);
        if (empty($dataVB)&&empty($dataCC)) {
        $idDelete = new MongoId($_REQUEST['id']);
        $model->delete($idDelete);
        $dk = array('id_sv'=>$_REQUEST['id']);
        $modelUS->deleteAll($dk);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsSV.php?idLop='.@$_GET['idLop'].'&stt=3');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsSV.php?idLop='.@$_GET['idLop'].'&error=-1');
        }
        else
        $model->redirect($urlPlugins . 'admin/qlvb-admin-dsSV.php?idLop='.@$_GET['idLop']);
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
    global $urlNow;
    if(checkAdminLogin()){
    $model = new Sinhvien();
    $modelKhoa = new Khoa(); 
    global $urlNow;
    $modelNganh = new Nganh(); 
    $modelLoai = new Loai();
    $modelSV = new Sinhvien(); 
    $modelLop = new Lop();
    $dsKhoa= $modelKhoa->find('all');
    $dsNganh= $modelNganh->find('all');
    $dsLop= $modelLop->find('all');
    $loai = $modelLoai->getList('Văn bằng');
    $modelKH = new Khoahoc();
    $dsKH = $modelKH->find('all');
    setVariable('dsKH',$dsKH);
    setVariable('dsKhoa',$dsKhoa);
    setVariable('dsNganh',$dsNganh);
    setVariable('dsLop',$dsLop);
    setVariable('loai',$loai);
    $conditions=array();
    if (!empty($_REQUEST)) {
    if (!empty($_REQUEST['code'])) {
    $conditions['masv']= array('$regex'=>trim($_REQUEST['code']));
    }
    if (!empty($_REQUEST['name'])) {
    $conditions['hoten']= array('$regex'=>trim($_REQUEST['name']));
    }
    if (empty($_REQUEST['idLop'])) {

    if (empty($_REQUEST['id_nganh'])&&empty($_REQUEST['id_kh'])) {

    if (empty($_REQUEST['id_khoa'])) {

    }
    else
    {
        $nganh=$modelNganh->find('all',array('conditions'=>array('id_khoa'=>$_REQUEST['id_khoa'])));
    }
    }
    elseif (!empty($_REQUEST['id_nganh'])&&empty($_REQUEST['id_kh'])) {
        $lop=$modelLop->find('all',array('conditions'=>array('nganh'=>$_REQUEST['id_nganh'])));
    }

    elseif (empty($_REQUEST['id_nganh'])&&!empty($_REQUEST['id_kh'])) {
        $lop=$modelLop->find('all',array('conditions'=>array('khoahoc'=>$_REQUEST['id_kh'])));
    }

    elseif (!empty($_REQUEST['id_nganh'])&&!empty($_REQUEST['id_kh'])) {
        $lop=$modelLop->find('all',array('conditions'=>array('nganh'=>$_REQUEST['id_nganh'],'khoahoc'=>$_REQUEST['id_kh'])));
    }
    }

    else {
    $sinhvien=$modelSV->find('all',array('conditions'=>array('idLop'=>$_REQUEST['idLop'])));
    
    }
    }


    if (!empty($sinhvien)) {
        $listSV = $sinhvien;
        foreach ($sinhvien as $key => $value) {
            $idSV[]=$value['Sinhvien']['id'];
        }
        $conditions['_id'] = array('$in'=>$idSV);
    }

    elseif (!empty($lop)) {
        $idlop=array();
        
        foreach ($lop as $key => $value) {
            $listSV = $modelSV->find('all',array('conditions'=>array('idLop'=>$value['Lop']['id'])));
       foreach ($listSV as $key => $value) {
            $idSV[] = $value['Sinhvien']['id'];
            }
        }
    $conditions['_id'] = array('$in'=>$idSV);
    }
    
    elseif (!empty($nganh)) {
        $idnganh = array();
            $idlop=array();

        foreach ($nganh as $key => $value) {
            $listlop = $modelLop -> find('all',array('conditions'=>array('nganh'=>$value['Nganh']['id'])));

            foreach ($listlop as $key => $value) {
            $listSV = $modelSV->find('all',array('conditions'=>array('idLop'=>$value['Lop']['id'])));
        foreach ($listSV as $key => $value) {
                $idSV[] = $value['Sinhvien']['id'];
                }
        }
    $conditions['_id'] = array('$in'=>$idSV);
        }
    }
    $page=(isset($_REQUEST['page']))?$_REQUEST['page']:1;
    $limit = 20;
    $totalData= $modelSV->find('count',array('conditions' => $conditions));
    $balance= $totalData%$limit;
    $totalPage= ($totalData-$balance)/$limit;
    if($balance>0)$totalPage+=1;
    $back=$page-1;$next=$page+1;
    if($back<=0) $back=1;
    if($next>=$totalPage) $next=$totalPage;
    if(isset($_GET['page'])){
    $urlPage= str_replace('&page='.$_GET['page'], '', $urlNow);
    $urlPage= str_replace('page='.$_GET['page'], '', $urlPage);
    }else{
    $urlPage= $urlNow;
    }
    if(strpos($urlPage,'?')!== false){
    if(count($_GET)>1 ||  (count($_GET)==1 && !isset($_GET['page']))){
    $urlPage= $urlPage.'&page=';
    }else{
    $urlPage= $urlPage.'page=';
    }
    }else{
    $urlPage= $urlPage.'?page=';
    }
    setVariable('page',$page);
    setVariable('totalPage',$totalPage);
    setVariable('back',$back);
    setVariable('next',$next);
    setVariable('urlPage',$urlPage);
    $listData = $modelSV -> find('all', array('limit'=>$limit,'page'=>$page,'conditions'=>$conditions));
    setVariable('listData',$listData);
    } else {
        $model->redirect($urlHomes);
    }
}
function taoSV()
{
    global $urlHomes;
    global $urlPlugins;
    $modelSV = new Sinhvien();     
    $model = new Lop(); 
    $modelUser = new Manager();    
    if(checkAdminLogin()){
        if (!empty($_REQUEST['id'])) {
            $data=$modelSV->find('first',array('conditions'=>array('_id'=>new MongoID($_REQUEST['id']))));
            setVariable('data',$data);
        }
        if(isset($_REQUEST['code']))
        {
            if (empty($_REQUEST['id'])) {
                $check =$modelSV->checkCode($_REQUEST['code']);
                if (empty($check)) {
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
                    $modelSV->save($save);
                    $id_sv =$modelSV->getLastInsertID();
                //tài khoản
                $save1['Manager']['user']=$_REQUEST['code'];
                $save1['Manager']['pass']=md5($_REQUEST['code']);
                $save1['Manager']['hoten']=$_REQUEST['hoten'];
                $save1['Manager']['diachi']=$_REQUEST['diachi'];
                $save1['Manager']['email']=$_REQUEST['email'];
                $save1['Manager']['sdt']=$_REQUEST['sdt'];
                $save1['Manager']['id_sv']=$id_sv;
                $save1['Manager']['permission']='2';
                    $modelUser->save($save1);
                    $modelSV->redirect($urlPlugins.'admin/qlvb-admin-dsSV.php?idLop='.$save['Sinhvien']['idLop'].'&stt=1');
            }
            else
            {
                echo '<script>
                    alert("Mã sinh viên đã tồn tại");
                    </script>';
            }
            }
            else {
                $check=$modelSV->checkCodeId($_REQUEST['code'],$_REQUEST['id']);
                $checkcode=$modelSV->checkCode($_REQUEST['code']);
                if ($modelSV->checkCodeId($_REQUEST['code'],$_REQUEST['id'])) {
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

                $save1['Manager']['user']=$_REQUEST['code'];
                // $save1['Manager']['pass']=md5($_REQUEST['code']);
                $save1['Manager']['hoten']=$_REQUEST['hoten'];
                $save1['Manager']['diachi']=$_REQUEST['diachi'];
                $save1['Manager']['email']=$_REQUEST['email'];
                $save1['Manager']['sdt']=$_REQUEST['sdt'];
                $save1['Manager']['permission']='2';
                    $dk=new MongoID($_REQUEST['id']);
                    $dk= array('_id'=>$dk);
                    $dk1= array('id_sv'=>$_REQUEST['id']);
                    $modelUser->updateAll($save1['Manager'],$dk1);
                    $modelSV->updateAll($save['Sinhvien'],$dk);
                    $modelSV->redirect($urlPlugins.'admin/qlvb-admin-dsSV.php?stt=2');
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
        $modelSV->redirect($urlHomes);
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