<?php
class User extends AppModel
{

	var $name = 'User';
	
	function getPage($page=1,$limit=15,$conditions=array(),$order=array('created' => 'desc'))
	{
		$array= array(
			'limit' => $limit,
			'page' => $page,
			'order' => $order,
			'conditions' => $conditions
			
			);
		return $this -> find('all', $array);             
	}
	
	function getUser($id)
	{
		$id= new MongoId($id);
		$dk = array ('_id' => $id);
		$return = $this -> find('first', array('conditions' => $dk) );
		return $return;

	}
	
	function getUserCode($user)
	{
		$dk = array ('user' => $user);
		$return = $this -> find('first', array('conditions' => $dk) );
		return $return;

	}
	
	function checkLogin($user,$password)
	{
		$dk = array ('user' => $user,'password'=>$password);
		$lay= array ('password'=> 0);

		$return = $this -> find('first', array('conditions' => $dk,'fields' => $lay) );
		
		return $return;
	}
	function isExist($username, $email,$cmnd) {
		
		$conditions['$or'][0]['user']= $username;
		$conditions['$or'][1]['email']= $email;
		$conditions['$or'][2]['cmnd']= $cmnd;
		
		$data = $this->find('count', array('conditions' => $conditions));
		if ($data > 0) {
			return true;
		}
		return false;
	}
	public function isExistUser($username,$email) {
        //$conditions['$or'][0]['slug']= array('$regex' => $key);
		
		$conditions['$or'][0]['user']= $username;
		$conditions['$or'][1]['email']= $email;
		$data = $this->find('first', array('conditions' => $conditions));
		return $data;
	}
}
?>