<?php 
function dsVB()
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
        if (!empty($_REQUEST['idLop'])) {
            $model = new Vanbang(); 
    $modelLoai = new Loai();
    $listData=$model ->getList($_GET['idLop'],$_REQUEST['loai']);
    $loai = $modelLoai->getList('Văn bằng');
    setVariable('listData',$listData);
    setVariable('loai',$loai);
    setVariable('idLop',$_GET['idLop']);
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
    $modelLoai = new Loai();    
    $listData=$model ->getListSVTT($_GET['idLop']);
    $loai = $modelLoai->getList('Văn bằng');
    setVariable('listData',$listData);
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
    if(checkAdminLogin()){
    $model = new Vanbang();  
    $modelSV = new Sinhvien();   
    $modelXl = new Xeploai(); 
    $modelLop = new Lop();  
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Vanbang']['idSV']); 
    $dataLop = $modelLop -> getListById($dataSV['Sinhvien']['idLop']);
    $hinhthuc = hinhthuc($dataLop['Lop']['hinhthuc']);
    $xl = $modelXl -> getDataById($data['Vanbang']['xl']); 
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
    if(checkAdminLogin()){
    $model = new Vanbang();  
    $modelSV = new Sinhvien();   
    $modelXl = new Xeploai();   
    $modelLoai = new Loai();   
    $data = $model -> getListById($_REQUEST['id']);
    $dataSV = $modelSV -> getDataById($data['Vanbang']['idSV']); 
    // $hinhthuc = hinhthuc($dataSV['Sinhvien']['hinhthuc']);
    $xl = $modelXl -> getList(); 
    $loai = $modelLoai -> getList('Văn bằng'); 
    setVariable('data',$data);
    setVariable('dataSV',$dataSV);
    // setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    setVariable('loai',$loai);
    if (!empty($_REQUEST['loaivb'])) {
            // $save['Vanbang']['idSV']=$_REQUEST['idSV'];
            // $save['Vanbang']['masv']=$_REQUEST['code'];
            $save['Vanbang']['loai']=$_REQUEST['loaivb'];
            $save['Vanbang']['ngaycap']=$_REQUEST['ngaycap'];
            $save['Vanbang']['sohieu']=$_REQUEST['sohieu'];
            $save['Vanbang']['sovaoso']=$_REQUEST['sovaoso'];
            $save['Vanbang']['soqd']=$_REQUEST['soqd'];
            $save['Vanbang']['xl']=$_REQUEST['xl'];
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