<?php 
function dsCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $modelKhoa = new Khoa(); 
    $modelNganh = new Nganh(); 
    // $modelSV = new Sinhvien(); 
    $modelLop = new Lop();
    $dsKhoa= $modelKhoa->find('all');
    $dsNganh= $modelNganh->find('all');
    $dsLop= $modelLop->find('all');
    setVariable('dsKhoa',$dsKhoa);
    setVariable('dsNganh',$dsNganh);
    setVariable('dsLop',$dsLop);
    if (!empty($_REQUEST['cc'])) {
        $model = new Chungchi(); 
    $modelLoai = new Loai();
    $listData=$model ->getList($_GET['idLop']);
    $loai = $modelLoai->getList('Chứng chỉ');
    setVariable('listData',$listData);
    setVariable('loai',$loai);
    setVariable('idLop',$_GET['idLop']);
        }
    
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
    $modelXl = new Xeploai();   
    $modelLoai = new Loai();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Chungchi']['idSV']); 
    // $hinhthuc = hinhthuc($dataSV['Sinhvien']['hinhthuc']);
    $xl = $modelXl -> getList(); 
    $loai = $modelLoai -> getList('Chứng chỉ'); 
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    // setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    setVariable('loai',$loai);
    if (!empty($_REQUEST['id'])) {
            // $save['Chungchi']['idSV']=$_REQUEST['idSV'];
            $save['Chungchi']['id_sv']=$_REQUEST['code'];
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
               $this->updateAll($save['Chungchi'],$dk);
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



function chonSVCC()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
    $model = new Sinhvien(); 
    $modelLoai = new Loai();    
    $listData=$model ->getListSVTT($_GET['idLop']);
    $loai = $modelLoai->getList('Chứng chỉ');
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
    if(checkAdminLogin()){
    $model = new Sinhvien();  
    $modelXl = new Xeploai(); 
    if (!empty($_POST['sv'])) {
    $listData=$model ->getListByList($_POST['sv']);
    $xl = $modelXl->getList();
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
        $hoidong = $_REQUEST['hoidong'];
        $loai = $_REQUEST['loai'];
        $i=0;
        foreach ($_REQUEST['vb'] as $key => $value) {
            $i++;
            $save['Chungchi']['id_sv']=$value['id'];
            $save['Chungchi']['idLop']=$_REQUEST['idLop'];
            $save['Chungchi']['loai']=$loai;
            $save['Chungchi']['masv']=$value['code'];
            $save['Chungchi']['ngaycap']=$value['ngaycap'];
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
    $modelXl = new Xeploai();
    $modelLop = new Lop();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Chungchi']['idSV']); 
    $dataLop = $modelLop -> getListById($dataSV['Sinhvien']['idLop']);
    $hinhthuc = hinhthuc($dataLop['Lop']['hinhthuc']);
    $xl = $modelXl -> getDataById($data['Chungchi']['xl']); 
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    }else {
        $model->redirect($urlHomes);
    }
}



 ?>