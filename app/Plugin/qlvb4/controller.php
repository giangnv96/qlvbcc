<?php 
function ctCC()
{
    global $urlHomes;
    $model=new Chungchi();
    $modelSV=new Sinhvien();
    $modelKH = new Khoahoc();
    $modelNganh = new Nganh();
    if (!empty($_SESSION['infoManager'])&&!empty($_GET['id'])) {
    $data = $model->find('first',array('conditions'=>array('_id'=>new MongoID($_GET['id']),'id_sv'=>$_SESSION['infoManager']['Manager']['id_sv'])));
    if (!empty($data)) {
    $modelLop = new Lop();   
    $dataSV = $modelSV -> getDataById($_SESSION['infoManager']['Manager']['id_sv']); 
    $dataLop = $modelLop -> getListById($dataSV['Sinhvien']['idLop']);
    $khoahoc = $modelKH ->find('first',array('conditions'=>array('_id'=>new MongoID($dataLop['Lop']['khoahoc']))));
    $nganh = $modelNganh ->find('first',array('conditions'=>array('_id'=>new MongoID($dataLop['Lop']['nganh']))));
    $hinhthuc = hinhthuc($dataLop['Lop']['hinhthuc']);
    $xl = getXLById($data['Chungchi']['id_xl']);
    setVariable('data',$data);
    setVariable('dataLop',$dataLop);
    setVariable('khoahoc',$khoahoc);
    setVariable('nganh',$nganh);
    setVariable('dataSV',$dataSV);
    setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    }
    else
    $model->redirect($urlHomes);
    }
    else
    $model->redirect($urlHomes);
}
function ctVB()
{
    global $urlHomes;
    $model=new Vanbang();
    $modelSV=new Sinhvien();
    $modelKH = new Khoahoc();
    $modelNganh = new Nganh();
    if (!empty($_SESSION['infoManager'])&&!empty($_GET['id'])) {
    $data = $model->find('first',array('conditions'=>array('_id'=>new MongoID($_GET['id']),'id_sv'=>$_SESSION['infoManager']['Manager']['id_sv'])));
    if (!empty($data)) {
    $modelLop = new Lop();   
    $dataSV = $modelSV -> getDataById($_SESSION['infoManager']['Manager']['id_sv']); 
    $dataLop = $modelLop -> getListById($dataSV['Sinhvien']['idLop']);
    $khoahoc = $modelKH ->find('first',array('conditions'=>array('_id'=>new MongoID($dataLop['Lop']['khoahoc']))));
    $nganh = $modelNganh ->find('first',array('conditions'=>array('_id'=>new MongoID($dataLop['Lop']['nganh']))));
    $hinhthuc = hinhthuc($dataLop['Lop']['hinhthuc']);
    $xl = getXLById($data['Vanbang']['id_xl']);
    setVariable('data',$data);
    setVariable('dataLop',$dataLop);
    setVariable('khoahoc',$khoahoc);
    setVariable('nganh',$nganh);
    setVariable('dataSV',$dataSV);
    setVariable('hinhthuc',$hinhthuc);
    setVariable('xl',$xl);
    }
    else
    $model->redirect($urlHomes);
    }
    else
    $model->redirect($urlHomes);
}
// function saveUserAll()
// {
//     global $urlHomes;
//     global $urlPlugins;
//     if(checkAdminLogin()){
//         $model = new Sinhvien();
//         $modelUser = new Manager();
//         $listSV = $model->find('all');
//         foreach ($listSV as $key => $value) {
//                 $save['Manager']['user']=$value['Sinhvien']['masv'];
//                 $save['Manager']['pass']=md5($value['Sinhvien']['masv']);
//                 $save['Manager']['hoten']=$value['Sinhvien']['hoten'];
//                 $save['Manager']['diachi']=$value['Sinhvien']['diachi'];
//                 $save['Manager']['email']=$value['Sinhvien']['email'];
//                 $save['Manager']['id_sv']=$value['Sinhvien']['id'];
//                 $save['Manager']['sdt']=$value['Sinhvien']['sdt'];
//                 $save['Manager']['permission']='2';
//                     $modelUser->saveMany($save);
//         }
//     }else {
//         $model->redirect($urlHomes);
//     }
// }
// function del()
// {
//     global $urlHomes;
//     global $urlPlugins;
//     if(checkAdminLogin()){
//         $model = new Sinhvien();
//         $modelUser = new Manager();
//         $dk = array('permission'=>"2");
//                     $model->deleteAll($dk);
        
//     }else {
//         $model->redirect($urlHomes);
//     }
// }
// function updatett()
// {
//     global $urlHomes;
//     global $urlPlugins;
//     if(checkAdminLogin()){
//         $model = new Sinhvien();
//         $save['tinhtrang']="2";
//                     $dk= array('idLop'=>'5afc2dd5d3c70cec14000029');
//                     $model->updateAll($save,$dk);
//     }else {
//         $model->redirect($urlHomes);
//     }
// }
function loadNganh()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
        if (!empty($_REQUEST['id'])) {
            $model = new Nganh();
            $dsNganh = $model -> find('all',array('conditions'=>array('id_khoa'=>$_REQUEST['id'])));
            if (!empty($dsNganh)) {
                echo "<option value=''>Chọn ngành</option>";
                foreach ($dsNganh as $key => $value) {
                    ?>
                    <option value="<?php echo $value['Nganh']['id'] ?>"><?php echo $value['Nganh']['name'] ?></option>
                    <?php
                }
            }
        }
    }else {
        $model->redirect($urlHomes);
    }
}
function loadLop()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
        $conditions=array();
        if (!empty($_REQUEST['idNganh'])) {
            $conditions['nganh']=$_REQUEST['idNganh'];
        }
        if (!empty($_REQUEST['idKH'])) {
            $conditions['khoahoc']=$_REQUEST['idKH'];
        }
                    $model = new Lop();
            $dsLop = $model -> find('all',array('conditions'=>$conditions));
            if (!empty($dsLop)) {
            echo "<option value=''>Chọn lớp</option>";
                foreach ($dsLop as $key => $value) {
                    ?>
                    <option value="<?php echo $value['Lop']['id'] ?>"><?php echo $value['Lop']['name'] ?></option>
                    <?php
                }
            }
        
    }else {
        $model->redirect($urlHomes);
    }
}
function timXacminh()
{
    global $urlHomes;
    global $urlPlugins;
    global $urlNow;
    if(checkAdminLogin()){
        $modelLoai= new Loai();
        $modelVB = new Vanbang();
        $modelCC = new Chungchi();
        $modelSV = new Sinhvien();
        $loai = $modelLoai->find('all');
        setVariable('loai',$loai);
        if (!empty($_REQUEST['loai'])) {
        // if (!empty($_REQUEST['hoten'])) {
        // $dataSV = $modelSV->find('all')
        //     $conditions['hoten']= array('$regex'=>trim($_REQUEST['hoten']));
        // }
        if (!empty($_REQUEST['sohieu'])) {
            $conditions['sohieu']= array('$regex'=>trim($_REQUEST['sohieu']));
        }
        if (!empty($_REQUEST['sovaoso'])) {
            $conditions['sovaoso']= array('$regex'=>trim($_REQUEST['sovaoso']));
        }
        if (!empty($_REQUEST['ngaycap'])) {
            $conditions['ngaycap']= array('$regex'=>trim($_REQUEST['ngaycap']));
        }
        $loai = explode('-', $_REQUEST['loai']);
        if ($loai[0]=='Văn bằng') {
            $conditions['loai']=$loai[1];
             $listData1 = $modelVB-> find('all', array('conditions'=>$conditions));
             foreach ($listData1 as $key => $value) {
                 $listData[]=$value['Vanbang'];
             }
            $totalData= $modelVB->find('count',array('conditions' => $conditions));

        }
        else
        {
            $conditions['loai']=$loai[1];
             $listData1 = $modelCC-> find('all', array('conditions'=>$conditions));
             foreach ($listData1 as $key => $value) {
                 $listData[]=$value['Chungchi'];
             }
             $totalData= $modelCC->find('count',array('conditions' => $conditions));

        }
        $page=(isset($_REQUEST['page']))?$_REQUEST['page']:1;
        $limit = 20;
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
        setVariable('listData',$listData);
        }
        }else {
        $model->redirect($urlHomes);
    }
}
function inXacminh()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
            $model = new Xacminh();
            $modelSV = new Sinhvien();
            $modelNganh = new Nganh();
            $modelVB = new Vanbang();
            $modelCC = new Chungchi();
            $modelLoai = new Loai();
            if (!empty($_GET['id'])) {
                $data= $model -> find('first',array('conditions'=>array('_id'=>new MongoId($_GET['id']))));
                setVariable('data',$data);
                if (!empty($data['Xacminh']['trangthai'])&&$data['Xacminh']['trangthai']==1) {
                if (!empty($data['Xacminh']['loai'])) {
                if ($data['Xacminh']['loai']=='Văn bằng') {
                $dataVB = $modelVB-> find('first', array('conditions'=>array('_id'=>new MongoID($data['Xacminh']['idxm']))));
                $dataVB = (!empty($dataVB))?$dataVB['Vanbang']:'';
                $loai = $modelLoai-> find('first', array('conditions'=>array('_id'=>new MongoID($dataVB['loai']))));
                $dataSV = $modelSV-> find('first', array('conditions'=>array('_id'=>new MongoID($dataVB['id_sv']))));
                }
                elseif ($data['Xacminh']['loai']=='Chứng chỉ') {
                $dataVB = $modelCC-> find('first', array('conditions'=>array('_id'=>new MongoID($data['Xacminh']['idxm']))));
                $dataVB = (!empty($dataVB))?$dataVB['Chungchi']:'';
                $loai = $modelLoai-> find('first', array('conditions'=>array('_id'=>new MongoID($dataVB['loai']))));
                $dataSV = $modelSV-> find('first', array('conditions'=>array('_id'=>new MongoID($dataVB['id_sv']))));
                }
                setVariable('loai',$loai);
                setVariable('dataSV',$dataSV);
                setVariable('dataVB',$dataVB);
                }
                }
            }
    }else {
        $model->redirect($urlHomes);
    }
}
function taoXacMinh()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
            $model = new Xacminh();
            if (!empty($_GET['id'])) {
                $data= $model -> find('first',array('conditions'=>array('_id'=>new MongoId($_GET['id']))));
                setVariable('data',$data);
            }
            if (!empty($_REQUEST['submit'])) {
                if (empty($_REQUEST['id'])) {
                $trangthai= $_REQUEST['trangthai'];
                $save['Xacminh']['donvi']=$_REQUEST['donvi'];
                $save['Xacminh']['idxm']=$_REQUEST['idxm'];
                $save['Xacminh']['loai']=$_REQUEST['loai'];
                $save['Xacminh']['ngaytao']=date("Y-m-d");
                $save['Xacminh']['lydo']=$_REQUEST['lydo'];
                $save['Xacminh']['trangthai']=$trangthai;
                $save['Xacminh']['img']=$_REQUEST['img'];
                $model -> save($save);
                $model->redirect($urlPlugins . 'admin/qlvb-admin-dsXacminh.php?mess=1');
                }
                else
                {
                $save['Xacminh']['donvi']=$_REQUEST['donvi'];
                $save['Xacminh']['lydo']=$_REQUEST['lydo'];
                $save['Xacminh']['img']=$_REQUEST['img'];
                $id= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$id);
               $model->updateAll($save['Xacminh'],$dk);
               $model->redirect($urlPlugins . 'admin/qlvb-admin-dsXacminh.php?mess=1');
                }
            }
    }else {
        $model->redirect($urlHomes);
    }
}
function xoaXacminh()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Xacminh();     
    if(checkAdminLogin()){
        $id= new MongoID($_REQUEST['id']);
        $model->delete($id);
        $model->redirect($urlPlugins.'admin/qlvb-admin-dsXacminh.php?mess=2');
    }
    else {
        $modelUser->redirect($urlHomes);
    }
}
function dsXacminh()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
        // if (!empty($_REQUEST['donvi'])) {
            $model = new Xacminh();
            $listData = $model -> find('all');
            setVariable('listData',$listData);
        // }
    }else {
        $model->redirect($urlHomes);
    }
}
function changePass()
{
    global $urlHomes;
    $model = new Manager();
    if (!empty($_SESSION['infoManager'])) {
        if (!empty($_POST)) {
        if (!empty($_POST['user'])&&!empty($_POST['pass'])&&!empty($_POST['passnew'])&&!empty($_POST['passagain'])) {
        $user=$_REQUEST['user'];
        $pass=md5($_REQUEST['pass']);
        $passnew=md5($_REQUEST['passnew']);
        $passagain=md5($_REQUEST['passagain']);
        if ($passnew==$passagain) {
        $users = $model->checkLogin($user,$pass);
        if (!empty($users)&&count($users)==1) {
            $save['pass']=$passnew;
            $dk=new MongoID($_SESSION['infoManager']['Manager']['id']);
            $dk= array('_id'=>$dk);
            $model->updateAll($save,$dk);
            unset($_SESSION['infoManager']);
            $model->redirect($urlHomes.'login');
        }
        else
        {
            echo '<script>
                        alert("Tài khoản, mật khẩu không đúng");
                    </script>
            ';
        }
        }
        else
        {
            echo '<script>
                        alert("Nhập lại mật khẩu");
                    </script>
            ';
        }
        }
        else
        {
            echo '<script>
                        alert("Yêu cầu nhập đủ dữ liệu");
                    </script>
            ';
        }
        }
    }
    else
    {
        $model->redirect($urlHomes.'login');
    }
}
function login()
{
    global $urlHomes;
    $model = new Manager();
    if (empty($_SESSION['infoManager'])) {
        if (!empty($_POST['user'])&&!empty($_POST['pass'])) {
        $user=$_REQUEST['user'];
        $pass=md5($_REQUEST['pass']);
        $users = $model->checkLogin($user,$pass);
        if (!empty($users)&&count($users)==1) {
            $_SESSION['infoManager']=$users[0];
            if ($_SESSION['infoManager']['Manager']['permission']==1) {
                $model->redirect($urlHomes.'dashboard');
            }
            elseif ($_SESSION['infoManager']['Manager']['permission']==2) {
                $model->redirect($urlHomes.'dashboardSV');
            }
        }
        else
        {
            $model->redirect($urlHomes.'login?error=1');
        }
    }
    }
    else
    {
        if ($_SESSION['infoManager']['Manager']['permission']==1) {
                $model->redirect($urlHomes.'dashboard');
            }
            elseif ($_SESSION['infoManager']['Manager']['permission']==2) {
                $model->redirect($urlHomes.'dashboardSV');
            }
    }
}
function logout()
{
    global $urlHomes;
    $model = new Manager();
    if (!empty($_SESSION['infoManager'])) {
        unset($_SESSION['infoManager']);
        $model->redirect($urlHomes.'login');
    }
    else
    {
        $model->redirect($urlHomes.'login');
    }
}
function dashboard()
{
    global $urlHomes;
    $modelVB= new Vanbang();
    $modelCC = new Chungchi();
    if (!empty($_SESSION['infoManager']['Manager'])&&$_SESSION['infoManager']['Manager']['permission']==1) {
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
    if (!empty($_REQUEST)) {
    if (!empty($_REQUEST['tungay'])) {
    $conditions['ngaycap']['$gte']=$_REQUEST['tungay'];
    }
    if (!empty($_REQUEST['denngay'])) {
    $conditions['ngaycap']['$lte']=$_REQUEST['denngay'];
    }
    // if (!empty($_REQUEST['loai'])) {
    // $loai = explode('-', $_REQUEST['loai']);
    //     if ($loai[0]=='Văn bằng') {
    //         $conditions['loai']=$loai[1];
    //          $listData1 = $modelVB-> find('all', array('conditions'=>$conditions));
    //          foreach ($listData1 as $key => $value) {
    //              $listData[]=$value['Vanbang'];
    //          }
    //         $totalData= $modelVB->find('count',array('conditions' => $conditions));

    //     }
    //     else
    //     {
    //         $conditions['loai']=$loai[1];
    //          $listData1 = $modelCC-> find('all', array('conditions'=>$conditions));
    //          foreach ($listData1 as $key => $value) {
    //              $listData[]=$value['Chungchi'];
    //          }
    //          $totalData= $modelCC->find('count',array('conditions' => $conditions));

    //     }
    // setVariable('loaivb',$loaivb);
    // }
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
        $loai = explode('-', @$_REQUEST['loai']);
        if ($loai[0]=='Văn bằng') {
            $conditions['loai']=$loai[1];
             $listData1 = $modelVB-> find('all', array('conditions'=>$conditions));
             foreach ($listData1 as $key => $value) {
                 $listData[]=$value['Vanbang'];
             }
            $totalData= $modelVB->find('count',array('conditions' => $conditions));
        if (!empty($conditions)) {
        $all = $modelVB->find('all',array('conditions'=>$conditions));
        $conditions['id_xl']='1';
        $xx= $modelVB->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='2';
        $gioi= $modelVB->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='3';
        $kha= $modelVB->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='4';
        $tb= $modelVB->find('count',array('conditions'=>$conditions));
        setVariable('all',$all);
        setVariable('xx',$xx);
        setVariable('gioi',$gioi);
        setVariable('kha',$kha);
        setVariable('tb',$tb);
    }
    else
    {
        $all = $modelVB->find('all');
        $conditions['id_xl']='1';
        $xx= $modelVB->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='2';
        $gioi= $modelVB->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='3';
        $kha= $modelVB->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='4';
       $tb= $modelVB->find('count',array('conditions'=>$conditions));
        setVariable('all',$all);
        setVariable('xx',$xx);
        setVariable('gioi',$gioi);
        setVariable('kha',$kha);
        setVariable('tb',$tb);
        pr($all);
    }
        }
        else
        {
            $conditions['loai']=$loai[1];
             $listData1 = $modelCC-> find('all', array('conditions'=>$conditions));
             foreach ($listData1 as $key => $value) {
                 $listData[]=$value['Chungchi'];
             }
             $totalData= $modelCC->find('count',array('conditions' => $conditions));
             if (!empty($conditions)) {
        $all = $modelCC->find('all',array('conditions'=>$conditions));
        $conditions['id_xl']='1';
        $xx= $modelCC->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='2';
        $gioi= $modelCC->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='3';
        $kha= $modelCC->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='4';
        $tb= $modelCC->find('count',array('conditions'=>$conditions));
        setVariable('all',$all);
        setVariable('xx',$xx);
        setVariable('gioi',$gioi);
        setVariable('kha',$kha);
        setVariable('tb',$tb);
    }
    else
    {
        $all = $modelCC->find('all');
        $conditions['id_xl']='1';
        $xx= $modelCC->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='2';
        $gioi= $modelCC->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='3';
        $kha= $modelCC->find('count',array('conditions'=>$conditions));
        $conditions['id_xl']='4';
        $tb= $modelCC->find('count',array('conditions'=>$conditions));
        setVariable('all',$all);
        setVariable('xx',$xx);
        setVariable('gioi',$gioi);
        setVariable('kha',$kha);
        setVariable('tb',$tb);
    }
        }
        $page=(isset($_REQUEST['page']))?$_REQUEST['page']:1;
        $limit = 20;
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
        setVariable('listData',$listData);
    }
        
    }else {
        $model->redirect($urlHomes);
    }
}

function dashboardSV()
{
    global $urlHomes;
    $modelVB= new Vanbang();
    $modelCC = new Chungchi();
    $modelSV = new Sinhvien();
    if (!empty($_SESSION['infoManager']['Manager'])&&$_SESSION['infoManager']['Manager']['permission']==2) {
        $sv = $modelSV -> find('first',array('conditions'=>array('_id'=>new MongoID($_SESSION['infoManager']['Manager']['id_sv']))));
        setVariable('sv',$sv);
    if (!empty($sv['Sinhvien']['tinhtrang'])&&$sv['Sinhvien']['tinhtrang']=="2") {
        $id=$sv['Sinhvien']['id'];
        $listVB=$modelVB->getListByIdSV($id);
        $listCC=$modelCC->getListByIdSV($id);
        if (empty($listVB)) {
            $mess="Đang cập nhật.";
            setVariable('messVB',$mess);
        }
        else
        {
        setVariable('listVB',$listVB);
        }
        if (empty($listCC)) {
            $mess="Đang cập nhật.";
            setVariable('messCC',$mess);
        }
        else
        {
        setVariable('listCC',$listCC);
        }
    }
    else
    {
        $mess ="Bạn không có văn bằng chứng chỉ nào.";
        setVariable('mess',$mess);
    }
    }
    else
    {
        $model->redirect($urlHomes.'login');
    }
}

function delLoaisv()
{
    global $urlHomes;
    global $urlPlugins;
    $modelLoaisv = new Loaisv();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $modelLoaisv->delete($idDelete);
        $modelLoaisv->redirect($urlPlugins . 'admin/qlvb-admin-loaiSV.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}
function delLoaicc()
{
    global $urlHomes;
    global $urlPlugins;
    $modelLoaicc = new Loaicc();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $modelLoaicc->delete($idDelete);
        $modelLoaicc->redirect($urlPlugins . 'admin/qlvb-admin-loaiCC.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}
function delLoaivb()
{
    global $urlHomes;
    global $urlPlugins;
    $modelLoaivb = new Loaivb();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $modelLoaivb->delete($idDelete);
        $modelLoaivb->redirect($urlPlugins . 'admin/qlvb-admin-loaiVB.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}
 include('controller/Chungchi.php');
 include('controller/Khoa.php');
 include('controller/Khoahoc.php');
 include('controller/Loai.php');
 include('controller/Lop.php');
 include('controller/Nganh.php');
 include('controller/Nguoidung.php');
 include('controller/Sinhvien.php');
 include('controller/Vanbang.php');
 include('controller/Xeploai.php');


 ?>