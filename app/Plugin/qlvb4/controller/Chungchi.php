<?php 
function dsThongkeCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $modelKhoa = new Khoa(); 
    global $urlNow;
    $modelNganh = new Nganh(); 
    $modelSV = new Sinhvien(); 
    $modelLop = new Lop();
    $dsKhoa= $modelKhoa->find('all');
    $dsNganh= $modelNganh->find('all');
    $dsLop= $modelLop->find('all');
    $modelKH = new Khoahoc();
    $dsKH = $modelKH->find('all');
    setVariable('dsKH',$dsKH);
    setVariable('dsKhoa',$dsKhoa);
    setVariable('dsNganh',$dsNganh);
    setVariable('dsLop',$dsLop);    
    $modelLoai = new Loai();
    $loai = $modelLoai->getList('Chứng chỉ');
    setVariable('loai',$loai);
    $model = new Chungchi(); 
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
        $all = $model->find('all');
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
function dsCC()
{
    global $urlHomes;
    global $urlPlugins;
    global $urlNow;
    if(checkAdminLogin()){
    $modelKhoa = new Khoa(); 
    $modelNganh = new Nganh(); 
    $modelSV = new Sinhvien(); 
    $modelLop = new Lop();
    $dsKhoa= $modelKhoa->find('all');
    $dsNganh= $modelNganh->find('all');
    $dsLop= $modelLop->find('all');
    setVariable('dsKhoa',$dsKhoa);
    setVariable('dsNganh',$dsNganh);
    setVariable('dsLop',$dsLop);
    $modelKH = new Khoahoc();
    $dsKH = $modelKH->find('all');
    setVariable('dsKH',$dsKH);
    $modelLoai = new Loai();
    $loai = $modelLoai->getList('Chứng chỉ');
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
    $model = new Chungchi(); 
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
function editCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Chungchi();
    $modelSV = new Sinhvien();   
    global $xl;
    $modelLoai = new Loai();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Chungchi']['id_sv']); 
    // $hinhthuc = hinhthuc($dataSV['Sinhvien']['hinhthuc']);
    $loai = $modelLoai -> getList('Chứng chỉ'); 
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    // setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    setVariable('loai',$loai);
    if (!empty($_REQUEST['code'])) {
            // $save['Chungchi']['idSV']=$_REQUEST['idSV'];
            // $save['Chungchi']['id_sv']=$_REQUEST['code'];
            $save['Chungchi']['loai']=$_REQUEST['loaicc'];
            $save['Chungchi']['ngaycap']=$_REQUEST['ngaycap'];
            $save['Chungchi']['tungay']=$_REQUEST['denngay'];
            $save['Chungchi']['denngay']=$_REQUEST['tungay'];
            $save['Chungchi']['sohieu']=$_REQUEST['sohieu'];
            $save['Chungchi']['sovaoso']=$_REQUEST['sovaoso'];
            $save['Chungchi']['soqd']=$_REQUEST['soqd'];
            $save['Chungchi']['id_xl']=$_REQUEST['xl'];
            $save['Chungchi']['nguoicap']=$_REQUEST['nguoicap'];
            $save['Chungchi']['chucvu']=$_REQUEST['chucvu'];
            $save['Chungchi']['img']=$_REQUEST['img'];
            // $query='db.collection.insert('.$save['Chungchi'].')';
            $id= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$id);
               $model->updateAll($save['Chungchi'],$dk);
    }
    }
    else {
            $model->redirect($urlHomes);
    }
}


function delCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Chungchi(); 
    $idDelete = new MongoId($_REQUEST['id']);
    $model->delete($idDelete);
    $model->redirect($urlPlugins . 'admin/qlvb-admin-dsLop.php');
    }else {
        $model->redirect($urlHomes);
    }
}
//tạo chứng chỉ

function chonCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $modelLoai = new Loai();    
    $loai = $modelLoai->getList('Chứng chỉ');
    setVariable('loai',$loai);
    setVariable('idLop',$_GET['idLop']);
    }else {
        $model->redirect($urlHomes);
    }
}

function chonSVCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien(); 
    $modelLoai = new Loai();    
    $list=$model ->getListSVTT($_GET['idLop']);
    $loai = $modelLoai->getList('Chứng chỉ');
    $listData = array();
    foreach ($list as $key => $value) {
        $check = checkCCEmty($value['Sinhvien']['id'],$_GET['loaivb']);
        if(empty($check)){
        $listData[]=$value;
        }
    }
    setVariable('listData',$listData);
    setVariable('loai',$loai);
    setVariable('idLop',$_GET['idLop']);
    }else {
        $model->redirect($urlHomes);
    }
}


function themCC()
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


function luuCC()
{
     global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
        $model = new Chungchi();
    if (!empty($_REQUEST['vb'])) {
        $ngcap = $_REQUEST['nguoicap'];
        $chucvu = $_REQUEST['chucvu'];
        $tungay = $_REQUEST['tungay'];
        $denngay = $_REQUEST['denngay'];
        $ngaycap = $_REQUEST['ngaycap'];
        $hoidong = $_REQUEST['hoidong'];
        $loai = $_REQUEST['loai'];
        $i=0;
        foreach ($_REQUEST['vb'] as $key => $value) {
            $i++;
            $save['Chungchi']['id_sv']=$value['id'];
            $save['Chungchi']['idLop']=$_REQUEST['idLop'];
            $save['Chungchi']['loai']=$loai;
            $save['Chungchi']['masv']=$value['code'];
            $save['Chungchi']['ngaycap']=$ngaycap;
            $save['Chungchi']['sohieu']=$value['sohieu'];
            $save['Chungchi']['sovaoso']=$value['sovaoso'];
            $save['Chungchi']['soqd']=$value['soqd'];
            $save['Chungchi']['id_xl']=$value['xl'];
            $save['Chungchi']['hoidong']=$hoidong;
            $save['Chungchi']['nguoicap']=$ngcap;
            $save['Chungchi']['chucvu']=$chucvu;
            $save['Chungchi']['img']=$_REQUEST['img'.$i];
            $save['Chungchi']['tungay']=$tungay;
            $save['Chungchi']['denngay']=$denngay;
            $save['Chungchi']['deleted']=0;

            // $query='db.collection.insert('.$save['Chungchi'].')';
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



function taoCC()
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
function CCdetail()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Chungchi();     
    $modelSV = new Sinhvien();   
    global $xl;
    $modelLop = new Lop();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Chungchi']['id_sv']); 
    $dataLop = $modelLop -> getListById($dataSV['Sinhvien']['idLop']);
    $hinhthuc = hinhthuc($dataLop['Lop']['hinhthuc']);
    $xl = getXLById($data['Chungchi']['id_xl']);
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    }else {
        $model->redirect($urlHomes);
    }
}



 ?>