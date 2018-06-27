<?php 
/**
* 
*/
class Manager extends AppModel
{
	function checkManager($user,$id=null)
	{
		if (empty($id)) {
			return true;
		}
		else
		{
		$user=$this->find('all',array('conditions'=>array('user'=>$user,'_id'=>new MongoID($id))));
		if ($user==null) {
			return true;
		}
		else
		{
			return false;
		}
		}
	}
	function checkLogin($user,$pass)
	{
		return $this->find('all',array('conditions'=>array('user'=>$user,'pass'=>$pass),'fields'=>array('user','hoten','diachi','email','sdt','permission')));
	}
	function checkCodeId($code,$id=null)
	{
		
		$sv=$this->find('all',array('conditions'=>array('user'=>$code,'_id'=>new MongoID($id))));
		if (!empty($sv)) {
			return true;
		}
		else
		{
			$sv=$this->checkCode($code);
			if (empty($sv)) {
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	function checkCode($code)
	{
		
		$sv=$this->find('all',array('conditions'=>array('user'=>$code)));
		return $sv;
	}
	
}
class Khoa extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	function checkcode($code='',$name='')
	{
		return $this->find('all', array('conditions'=>array('code'=>$code,'name'=>$name)));
	}
	
}
class Nganh extends AppModel
{

	function checkEmptyId($id_khoa)
	{
		return $this->find('all', array('conditions'=>array('id_khoa'=>$id_khoa)));
	}
	function getList()
	{
		return $this->find('all');
	}
	function checkcode($code='')
	{
		return $this->find('all', array('conditions'=>array('code'=>$code,'name'=>$name)));
	}
}
class Lop extends AppModel
{
	function checkEmptyIdNganh($id_nganh)
	{
		return $this->find('all', array('conditions'=>array('id_nganh'=>$id_nganh)));
	}
	function checkEmptyIdKH($id_kh)
	{
		return $this->find('all', array('conditions'=>array('id_khoahoc'=>$id_kh)));
	}
	function getListById($id)
	{
		return $this->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
	function checkCodeId($code,$id=null)
	{
		
		$sv=$this->find('all',array('conditions'=>array('code'=>$code,'_id'=>new MongoID($id))));
		if (!empty($sv)) {
			return true;
		}
		else
		{
			$sv=$this->checkCode($code);
			if (empty($sv)) {
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	function checkCode($code)
	{
		
		$sv=$this->find('all',array('conditions'=>array('code'=>$code)));
		return $sv;
	}
	function getList()
	{
		return $this->find('all');
	}
	function checkLop($code=null,$name=null)
	{
		if (empty($code)) {
			return true;
		}
		else
		{
					$user=$this->find('all',array('conditions'=>array('code'=>$code,'name'=>$name)));
		if ($user==null) {
			return true;
		}
		else
		{
			return false;
		}
		}
	}
	function getListByKey($key)
	{
		return $this->find('all',array('conditions'=>array('code'=>array('$regex'=>trim($key)))));
	}
	
}
class Loaisv extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	
}
class Vanbang extends AppModel
{
	function checkEmptyIdSv($id_sv)
	{
		return $this->find('all', array('conditions'=>array('id_sv'=>$id_sv)));
	}
	function checkEmptyIdXl($id_xl)
	{
		return $this->find('all', array('conditions'=>array('id_xl'=>$id_xl)));
	}

	function getList($idLop)
	{
		return $this->find('all',array('conditions'=>array('idLop'=>$idLop)));
	}
	function getListVB($idLop,$loai)
	{
		return $this->find('all',array('conditions'=>array('idLop'=>$idLop,'loai'=>$loai)));
	}
	function getListByIdSV($id)
	{
		return $this->find('all',array('conditions'=>array('idSV'=>$id)));
	}
	function getListById($id)
	{
		return $this->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
	
}
class Chungchi extends AppModel
{
	function checkEmptyIdSv($id_sv)
	{
		return $this->find('all', array('conditions'=>array('id_sv'=>$id_sv)));
	}
	function checkEmptyIdXl($id_xl)
	{
		return $this->find('all', array('conditions'=>array('id_xl'=>$id_xl)));
	}
	function getListByIdSV($id)
	{
		return $this->find('all',array('conditions'=>array('idSV'=>$id)));
	}
	function getListById($id)
	{
		return $this->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
	function getList($idLop)
	{
		return $this->find('all',array('conditions'=>array('idLop'=>$idLop)));
	}
	
}
class Sinhvien extends AppModel
{
	function checkEmptyId($id_lop)
	{
		return $this->find('all', array('conditions'=>array('idLop'=>$id_lop,'deleted'=>0)));
	}

	function checkCodeId($code,$id=null)
	{
		
		$sv=$this->find('all',array('conditions'=>array('code'=>$code,'_id'=>new MongoID($id),'deleted'=>0)));
		if (!empty($sv)) {
			return true;
		}
		else
		{
			$sv=$this->checkCode($code);
			if (empty($sv)) {
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	function checkCode($code)
	{
		
		$sv=$this->find('all',array('conditions'=>array('code'=>$code,'deleted'=>0)));
		return $sv;
	}
	function checkSinhvien($code,$id=null)
	{
		if (empty($id)) {
			return true;
		}
		else
		{
		$sv=$this->find('all',array('conditions'=>array('code'=>$code,'_id'=>new MongoID($id),'deleted'=>0)));
		if (empty($sv)) {
			return true;
		}
		else
		{
			return false;
		}
		}
	}
	function getList($idLop,$page=null,$limit=null)
	{
		return $this->find('all',array('limit'=>$limit,'page'=>$page,'conditions'=>array('idLop'=>$idLop,'deleted'=>0)));
	}
	function getListSVTT($idLop)
	{
		return $this->find('all',array('conditions'=>array('idLop'=>$idLop,'tinhtrang'=>'2','deleted'=>0)));
	}
	function getListByList($listid=array())
	{
		return $this->find('all',array('conditions'=>array('_id'=>array('$in'=>$listid),'deleted'=>0)));
	}
	function getDataById($id)
	{
		return $this->find('first',array('conditions'=>array('_id'=>new MongoID($id),'deleted'=>0)));
	}
	
}
class Loai extends AppModel
{
	function getList($loai)
	{
		return $this->find('all',array('conditions'=>array('loai'=>$loai)));
	}
	function getDataById($id)
	{
		return $this->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}

	
}
class Loaiquyen extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	function getPerById($id)
	{
		return $this->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
	
}
class Loaicc extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	
}
class Xeploai extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	function getDataById($id)
	{
		return $this->find('first',array('conditions'=>array('_id'=>new MongoID($id))));
	}
}
class Khoahoc extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	
}
class Xacminh extends AppModel
{
	
	
}
 ?>