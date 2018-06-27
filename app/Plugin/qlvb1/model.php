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

	
}
class Khoa extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	
}
class Nganh extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	
}
class Lop extends AppModel
{
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
class Permission extends AppModel
{
	
	
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
	// function savelist($sv)
	// {
	// 	$count = count($sv);
	// 	for ($i=1; $i <=$count ; $i++) { 
	// 		$this->saveVB($sv[$i]);
	// 	}
	// }
	// function saveVB($sv=array())
	// {
	// 	foreach ($sv as $key => $value) {
	// 		$save['idSV']=$value['Vanbang']['idSV'];
 //            $save['ngaycap']=$value['Vanbang']['ngaycap'];
 //            $save['sohieu']=$value['Vanbang']['sohieu'];
 //            $save['sovaoso']=$value['Vanbang']['sovaoso'];
 //            $save['soqd']=$value['Vanbang']['soqd'];
 //            $save['xl']=$value['Vanbang']['xl'];
 //            $save['nguoicap']=$value['Vanbang']['nguoicap'];
 //            $save['chucvu']=$value['Vanbang']['chucvu'];
 //            $this->save($sv);
	// 	}
	// }
	
}
class Chungchi extends AppModel
{
	
	
}
class Sinhvien extends AppModel
{
	function checkSinhvien($code,$id=null)
	{
		if (empty($id)) {
			return true;
		}
		else
		{
					$sv=$this->find('all',array('conditions'=>array('code'=>$code,'_id'=>new MongoID($id))));
		if (empty($sv)) {
			return true;
		}
		else
		{
			return false;
		}
		}
	}
	function getList($idLop)
	{
		return $this->find('all',array('conditions'=>array('idLop'=>$idLop)));
	}
	function getListByList($listid=array())
	{
		return $this->find('all',array('conditions'=>array('_id'=>array('$in'=>$listid))));
	}
	
}
class Loai extends AppModel
{
	function getList($loai)
	{
		return $this->find('all',array('conditions'=>array('loai'=>$loai)));
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
class Log extends AppModel
{
	
	
}
class Dsxacminh extends AppModel
{
	
	
}
class Xeploai extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	
}
class Khoahoc extends AppModel
{
	function getList()
	{
		return $this->find('all');
	}
	
}

 ?>