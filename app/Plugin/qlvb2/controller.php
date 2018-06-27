<?php 
function loadNganh()
{
    global $urlHomes;
    global $urlPlugins;
    if(checkAdminLogin()){
        if (!empty($_REQUEST['id'])) {
            $model = new Nganh();
            $dsNganh = $model -> find('all',array('conditions'=>array('khoa'=>$_REQUEST['id'])));
            if (!empty($dsNganh)) {
                foreach ($dsNganh as $key => $value) {
                    ?>
                    <option value="">Chọn ngành</option>
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
        if (!empty($_REQUEST['id'])) {
            $model = new Lop();
            $dsNganh = $model -> find('all',array('conditions'=>array('nganh'=>$_REQUEST['id'])));
            if (!empty($dsNganh)) {
                foreach ($dsNganh as $key => $value) {
                    ?>
                    <option value="<?php echo $value['Lop']['id'] ?>"><?php echo $value['Lop']['name'] ?></option>
                    <?php
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
        if (!empty($_REQUEST['donvi'])) {
            $model = new Xacminh();
            if (!empty($_GET['id'])) {
                $data= $model -> find('first',array('conditions'=>array('_id'=>new MongoId($_GET['id']))));
                setVariable('data',$data);
            }
            if (!empty($_REQUEST['submit'])) {
                $save['Xacminh']['donvi']=$_REQUEST['donvi'];
                $save['Xacminh']['ngaytao']=$_REQUEST['ngaytao'];
                $save['Xacminh']['lydo']=$_REQUEST['lydo'];
                $save['Xacminh']['img']=$_REQUEST['img'];
                if (empty($_REQUEST['id'])) {
                    $model -> save($save);
                }
                else
                {
                $id= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$id);
               $model->updateAll($save['Xacminh'],$dk);
                }
            }
        }
    }else {
        $model->redirect($urlHomes);
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
    if (!empty($_REQUEST)) {
    if (!empty($_GET['masv'])) {
        $conditions['masv']=$_GET['masv'];
    }
    }
    }
    else
    {
        $model->redirect($urlHomes);
    }
}

function dashboardSV()
{
    global $urlHomes;
    $modelVB= new Vanbang();
    $modelCC = new Chungchi();
    if (!empty($_SESSION['infoManager']['Manager'])&&$_SESSION['infoManager']['Manager']['permission']==2) {
    if (!empty($_SESSION['infoManager']['Manager']['tinhtrang'])&&$_SESSION['infoManager']['Manager']['tinhtrang']==2) {
        $id=$_SESSION['infoManager']['Manager']['id'];
        $listVB=$modelVB->getListByIdSV($id);
        $listCC=$modelCC->getListByIdSV($id);
        if (empty($listVB)) {
            $mess="Đang cập nhật.";
            setVariable('mess',$mess);
        }
        else
        {
        setVariable('listVB',$listVB);
        }
        if (empty($listCC)) {
            $mess="Đang cập nhật.";
            setVariable('mess',$mess);
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