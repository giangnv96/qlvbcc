<?php 
function taoNgDung()
{
	global $urlHomes;
	global $urlPlugins;
	$modelUser = new Manager();		
	if(checkAdminLogin()){
		if (!empty($_REQUEST['id'])) {
			$data=$modelUser->find('first',array('conditions'=>array('_id'=>new MongoID($_REQUEST['id']))));
			setVariable('data',$data);
		}
		if(isset($_REQUEST['user']))
		{
			if (empty($_REQUEST['id'])) {
				$check=$modelUser->checkCode($_REQUEST['user'],$_REQUEST['id']);
			if (empty($check)) {
				$save['Manager']['user']=$_REQUEST['user'];
				$save['Manager']['pass']=(isset($_REQUEST['pass']))?md5($_REQUEST['pass']):$data['Manager']['pass'];
				$save['Manager']['hoten']=$_REQUEST['hoten'];
				$save['Manager']['diachi']=$_REQUEST['diachi'];
				$save['Manager']['email']=$_REQUEST['email'];
                // $save['Manager']['ngaysinh']=$_REQUEST['ngaysinh'];
                // $save['Manager']['noisinh']=$_REQUEST['noisinh'];
				$save['Manager']['sdt']=$_REQUEST['sdt'];
				$save['Manager']['permission']=$_REQUEST['loaind'];
					$modelUser->save($save);
					$modelUser->redirect($urlPlugins.'admin/qlvb-admin-dsUser.php?stt=1');
				
			}
			else 
			{
                echo '<script>
                    alert("Mã người dùng đã tồn tại");
                    </script>';
            }
			}
			else {
					$save['Manager']['user']=$_REQUEST['user'];
				$save['Manager']['pass']=(isset($_REQUEST['pass']))?md5($_REQUEST['pass']):$data['Manager']['pass'];
				$save['Manager']['hoten']=$_REQUEST['hoten'];
				$save['Manager']['diachi']=$_REQUEST['diachi'];
                $save['Manager']['email']=$_REQUEST['email'];
				// $save['Manager']['ngaysinh']=$_REQUEST['ngaysinh'];
                // $save['Manager']['noisinh']=$_REQUEST['noisinh'];
				$save['Manager']['sdt']=$_REQUEST['sdt'];
				$save['Manager']['permission']=$_REQUEST['loaind'];
					$dk=new MongoID($_REQUEST['id']);
					$dk= array('_id'=>$dk);
					$modelUser->updateAll($save['Manager'],$dk);
					$modelUser->redirect($urlPlugins.'admin/qlvb-admin-dsUser.php?stt=2');
				}
			
		}
	}
    else {
        $modelUser->redirect($urlHomes);
    }
}
function dsUser()
{
	global $urlHomes;
	global $urlPlugins;
	$modelUser = new Manager();		
	if(checkAdminLogin()){
		$page=(isset($_REQUEST['page']))?$_REQUEST['page']:1;
		$conditions['user'] = array('$ne'=>null);
		if (!empty($_GET['hoten'])) {
			$conditions['hoten'] = array('$regex'=>trim($_GET['hoten']));
		}
		if (!empty($_GET['sdt'])) {
			$conditions['sdt'] = array('$regex'=>trim($_GET['sdt']));
		}
		if (!empty($_GET['loaind'])) {
			$conditions['permission'] = $_GET['loaind'];
		}
		if (!empty($_GET['email'])) {
			$conditions['email'] = array('$regex'=>trim($_GET['email']));
		}
		$listData= $modelUser->find('all',array('page' => null,'limit'=>null,'conditions'=>$conditions));
		setVariable('listData',$listData);
	}else {
        $modelUser->redirect($urlHomes);
    }
}
function delManager()
{
	global $urlHomes;
	global $urlPlugins;
	$modelUser = new Manager();		
	if(checkAdminLogin()){
		$id= new MongoID($_REQUEST['id']);
		$modelUser->delete($id);
		$modelUser->redirect($urlPlugins.'admin/qlvb-admin-dsUser.php?stt=2');
	}
    else {
        $modelUser->redirect($urlHomes);
    }
}
function phanquyen()
{
    global $urlHomes;
    global $urlPlugins;
    $modelLoaiquyen = new Loaiquyen();

    if (checkAdminLogin()) {
        $listData=$modelLoaiquyen->getList();
    setVariable('listData',$listData);
        if (!empty($_REQUEST['name'])) {
            // $save['Loaiquyen']['code']=$_REQUEST['code'];
            $save['Loaiquyen']['name']=$_REQUEST['name'];
            $save['Loaiquyen']['des']=$_REQUEST['des'];
            if (empty($_REQUEST['id'])) {
                $modelLoaiquyen->save($save);
        $modelLoaiquyen->redirect($urlPlugins . 'admin/qlvb-admin-phanquyen.php');
            }
            else
            {   
                $idDel= new MongoId($_REQUEST['id']);
               $dk= array('_id'=>$idDel);
                $modelLoaiquyen->updateAll($save['Loaiquyen'],$dk);
        $modelLoaiquyen->redirect($urlPlugins . 'admin/qlvb-admin-phanquyen.php');
            }

        }
    } else {
        $modelLoaiquyen->redirect($urlHomes);
    }
}
function delLoaiquyen()
{
    global $urlHomes;
    global $urlPlugins;
    $model = new Loaiquyen();

    if (checkAdminLogin()) {
        if (!empty($_REQUEST['id'])) {
            $idDelete = new MongoId($_REQUEST['id']);
            $model->delete($idDelete);
        $model->redirect($urlPlugins . 'admin/qlvb-admin-phanquyen.php');

        }
}else {
        $model->redirect($urlHomes);
    }
}

 ?>