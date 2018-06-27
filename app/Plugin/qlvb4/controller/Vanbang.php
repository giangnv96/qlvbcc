<?php 

function dsVB()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
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
    if (!empty($_REQUEST['sohieu'])) {
            $conditions['sohieu']= array('$regex'=>trim($_REQUEST['sohieu']));
        }
        if (!empty($_REQUEST['sovaoso'])) {
            $conditions['sovaoso']= array('$regex'=>trim($_REQUEST['sovaoso']));
        }
        if (!empty($_REQUEST['ngaycap'])) {
            $conditions['ngaycap']= array('$regex'=>trim($_REQUEST['ngaycap']));
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
    $idSV=array();
    if (!empty($sinhvien)) {
        foreach ($sinhvien as $key => $value) {
            $idSV[]=$value['Sinhvien']['id'];
        }
        $conditions['id_sv'] = array('$in'=>$idSV);
    }

    elseif (!empty($lop)) {
        $idlop=array();
        
        foreach ($lop as $key => $value) {
            $listSV = $modelSV->find('all',array('conditions'=>array('idLop'=>$value['Lop']['id'])));
            
            foreach ($listSV as $key => $value) {
            $idSV[] = $value['Sinhvien']['id'];
            }
        }
    $conditions['id_sv'] = array('$in'=>$idSV);
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
    $conditions['id_sv'] = array('$in'=>$idSV);
        }
    }

    if (!empty($_REQUEST['loai'])) {
    $conditions['loai']=$_REQUEST['loai'];
    }
    $model = new Vanbang(); 
    $page=(isset($_REQUEST['page']))?$_REQUEST['page']:1;
    $limit = 20;
    $totalData= $model->find('count',array('conditions' => $conditions));
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
    $listData=$model ->find('all',array('limit'=>$limit,'page'=>$page,'conditions'=>$conditions));
    setVariable('listData',$listData);
    }else {
        $model->redirect($urlHomes);
    }
}
function dsThongkeVB()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $modelKhoa = new Khoa(); 
    global $urlNow;
    $modelNganh = new Nganh(); 
    $modelSV = new Sinhvien(); 
    $modelLop = new Lop();
    $modelKH = new Khoahoc();
    $dsKH = $modelKH->find('all');
    $dsKhoa= $modelKhoa->find('all');
    $dsNganh= $modelNganh->find('all');
    $dsLop= $modelLop->find('all');
    setVariable('dsKH',$dsKH);
    setVariable('dsKhoa',$dsKhoa);
    setVariable('dsNganh',$dsNganh);
    setVariable('dsLop',$dsLop);    
    $modelLoai = new Loai();
    $loai = $modelLoai->getList('Văn bằng');
    setVariable('loai',$loai);
    $model = new Vanbang(); 
    if (!empty($_REQUEST['tungay'])) {
    $conditions['ngaycap']['$gte']=$_REQUEST['tungay'];
    }
    if (!empty($_REQUEST['denngay'])) {
    $conditions['ngaycap']['$lte']=$_REQUEST['denngay'];
    }
    if (!empty($_REQUEST['loai'])) {
    $conditions['loai']=$_REQUEST['loai'];
    $loaivb = $modelLoai->getDataById($_REQUEST['loai']);
    setVariable('loaivb',$loaivb);
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
    $idSV=array();
    if (!empty($sinhvien)) {
        foreach ($sinhvien as $key => $value) {
            $idSV[]=$value['Sinhvien']['id'];
        }
        $conditions['id_sv'] = array('$in'=>$idSV);
    }

    elseif (!empty($lop)) {
        $idlop=array();
        
        foreach ($lop as $key => $value) {
            $listSV = $modelSV->find('all',array('conditions'=>array('idLop'=>$value['Lop']['id'])));
            
            foreach ($listSV as $key => $value) {
            $idSV[] = $value['Sinhvien']['id'];
            }
        }
    $conditions['id_sv'] = array('$in'=>$idSV);
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
    $conditions['id_sv'] = array('$in'=>$idSV);
        }
    }
    if (!empty($conditions)) {

        $all = $model->find('all',array('conditions'=>$conditions));
        $conditions['id_xl']='1';
        $xx= $model->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='2';
        $gioi= $model->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='3';
        $kha= $model->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='4';
        $tb= $model->find('count',array('conditions'=>$conditions));
        setVariable('all',$all);
        setVariable('xx',$xx);
        setVariable('gioi',$gioi);
        setVariable('kha',$kha);
        setVariable('tb',$tb);
        
    }
    else
    {
        $all=$model ->find('all');
        $conditions['id_xl']='1';
        $xx= $model->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='2';
        $gioi= $model->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='3';
        $kha= $model->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='4';
        $tb= $model->find('count',array('conditions'=>$conditions));
        setVariable('all',$all);
        setVariable('xx',$xx);
        setVariable('gioi',$gioi);
        setVariable('kha',$kha);
        setVariable('tb',$tb);
    }
    }else {
        $model->redirect($urlHomes);
    }
}
function chonSV()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien();
    $modelVB = new Vanbang();
    $list=$model ->getListSVTT($_GET['idLop']);
    $listData = array();
    foreach ($list as $key => $value) {
        $check = checkVBEmty($value['Sinhvien']['id'],$_GET['loaivb']);
        if(empty($check)){
        $listData[]=$value;
        }
    }
    setVariable('listData',$listData);
    setVariable('idLop',$_GET['idLop']);
    }else {
        $model->redirect($urlHomes);
    }
}
function chonVB()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $modelLoai = new Loai();    
    $loai = $modelLoai->getList('Văn bằng');
    setVariable('loai',$loai);
    setVariable('idLop',$_GET['idLop']);
    }else {
        $model->redirect($urlHomes);
    }
}

function themVB()
{
    global $urlHomes;
    global $urlPlugins;
    global $xl;
    if(checkAdminLogin()){
    $model = new Sinhvien();  
    if (!empty($_REQUEST['sv'])) {
    $listData=$model ->getListByList($_REQUEST['sv']);
    setVariable('listData',$listData);
    setVariable('xl',$xl);
    setVariable('idLop',$_REQUEST['idLop']);
    setVariable('loai',$_REQUEST['loaivb']);
    }
    else
    {
        $model->redirect($urlPlugins.'admin/qlvb-admin-chonSV.php?idLop='.$_REQUEST['idLop'].'&stt=1');
    }
    
    }else {
        $model->redirect($urlHomes);
    }
}


function luuVB()
{
     global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
        $model = new Vanbang();
    if (!empty($_REQUEST['vb'])) {
        $ngcap = $_REQUEST['nguoicap'];
        $chucvu = $_REQUEST['chucvu'];
        $loai = $_REQUEST['loai'];
        $ngaycap = $_REQUEST['ngaycap'];
        $i=0;
        foreach ($_REQUEST['vb'] as $key => $value) {
            $i++;
            $save['Vanbang']['id_sv']=$value['id'];
            $save['Vanbang']['idLop']=$_REQUEST['idLop'];
            $save['Vanbang']['loai']=$loai;
            $save['Vanbang']['masv']=$value['code'];
            $save['Vanbang']['ngaycap']=$ngaycap;
            $save['Vanbang']['sohieu']=$value['sohieu'];
            $save['Vanbang']['sovaoso']=$value['sovaoso'];
            $save['Vanbang']['soqd']=$value['soqd'];
            $save['Vanbang']['id_xl']=$value['xl'];
            $save['Vanbang']['nguoicap']=$ngcap;
            $save['Vanbang']['chucvu']=$chucvu;
            $save['Vanbang']['img']=$_REQUEST['img'.$i];
            $save['Vanbang']['deleted']=0;
            // $query='db.collection.insert('.$save['Vanbang'].')';
            $model->saveMany($save);
        }
    }
    else
    {
        $model->redirect($urlPlugins.'admin/qlvb-admin-chonSV.php?idLop='.$_REQUEST['idLop'].'&stt=1');
    }
    }else {
        $model->redirect($urlHomes);
    }

}



function taoVB()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Lop();     
    if (!empty($_REQUEST['key'])) {
        $listData=$model ->getListByKey($_REQUEST['key']);
    setVariable('listData',$listData);
    }
    }else {
        $model->redirect($urlHomes);
    }
}

function VBdetail()
{
    global $urlHomes;
    global $urlPlugins;
    global $xl;
    if(checkAdminLogin()){
    $model = new Vanbang();  
    $modelSV = new Sinhvien();
    $modelLop = new Lop();  
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Vanbang']['id_sv']); 
    $dataLop = $modelLop -> getListById($dataSV['Sinhvien']['idLop']);
    $hinhthuc = hinhthuc($dataLop['Lop']['hinhthuc']);
    $xl = getXLById($data['Vanbang']['id_xl']);
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    }
    else {
            $model->redirect($urlHomes);
    }
}

function editVB()
{
    global $urlHomes;
    global $urlPlugins;
    global $xl;
    if(checkAdminLogin()){
    $model = new Vanbang();  
    $modelSV = new Sinhvien();   
    $modelLoai = new Loai();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Vanbang']['id_sv']); 
    // $hinhthuc = hinhthuc($dataSV['Sinhvien']['hinhthuc']);
    $loai = $modelLoai -> getList('Văn bằng'); 
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    // setVariable('hinhthuc',$hinhthuc);
    setVariable('loai',$loai);
    if (!empty($_REQUEST['sohieu'])) {
            // $save['Vanbang']['idSV']=$_REQUEST['idSV'];
            // $save['Vanbang']['masv']=$_REQUEST['code'];
            $save['Vanbang']['loai']=$_REQUEST['loaivb'];
            $save['Vanbang']['ngaycap']=$_REQUEST['ngaycap'];
            $save['Vanbang']['sohieu']=$_REQUEST['sohieu'];
            $save['Vanbang']['sovaoso']=$_REQUEST['sovaoso'];
            $save['Vanbang']['soqd']=$_REQUEST['soqd'];
            $save['Vanbang']['id_xl']=$_REQUEST['xl'];
            $save['Vanbang']['nguoicap']=$_REQUEST['nguoicap'];
            $save['Vanbang']['chucvu']=$_REQUEST['chucvu'];
            $save['Vanbang']['img']=$_REQUEST['img'];
            // $query='db.collection.insert('.$save['Vanbang'].')';
            $id= new MongoId($_REQUEST['id']);
           $dk= array('_id'=>$id);
           $model->updateAll($save['Vanbang'],$dk);
    }
    }
    else {
            $model->redirect($urlHomes);
    }
}
function delVB()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Vanbang(); 
    $idDelete = new MongoId($_REQUEST['id']);
    $model->delete($idDelete);
    $model->redirect($urlPlugins . 'admin/qlvb-admin-dsLop.php');
    }else {
        $model->redirect($urlHomes);
    }
}

 ?>