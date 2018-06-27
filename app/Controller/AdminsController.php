<?php
   class AdminsController extends AppController
   {
	    var $name = 'Admins';
        var $helpers = array('Session','Paginator');
        var $paginate = array();
		
        function index()
        {
            //Configure::write('debug', 2);
            $users= $this->Session->read('infoAdminLogin');
            if($users)
            {
                $this->setup();
            }
            else 
            {
            	$this->redirect(array('controller' => 'admins', 'action' => 'login'));
            }
        }
 // Install Mantan System       
       function installMantan()
       {
       		//Configure::write('debug', 2);
       		$this->layout= 'default';
       		$this->Session->destroy();

       		global $infoMantanSource;

       		$webRoot= Router::url('/', true).'app/webroot';
       		$infoMantanSource= @simplexml_load_file($webRoot.'/info.xml');

       		if($this->isDBConnected())
       		{
	       		Controller::loadModel('Option');
	       		$infoSite= $this->Option->getOption('infoSite');
	       		if(!$infoSite['Option']['value']['domain'])
	            {
	            	$users= $this->Session->read('infoAdminLogin');
		            if($users)
		            {
	            		$this->redirect(array('controller' => 'options', 'action' => 'infoSite'));
	            	}
	            	else
	            	{
		            	$this->redirect(array('controller' => 'options', 'action' => 'login'));
	            	}
	            }
	            else
	            {
		            $this->redirect(array('controller' => 'admins', 'action' => 'index'));
	            }
       		}
			
			$urlAdmins= Router::url('/', true).'admins/';
			$this->set('urlAdmins',$urlAdmins);
			$this->set('infoMantanSource',$infoMantanSource);
       }
       
       function startInstall()
       {
       		//Configure::write('debug', 2);
	        if($this->isDBConnected())
       		{
       			Controller::loadModel('Option');
	       		$infoSite= $this->Option->getOption('infoSite');
	       		if(!$infoSite['Option']['value']['domain'])
	            {
	            	$this->redirect(array('controller' => 'options', 'action' => 'infoSite'));
	            }
	            else
	            {
		            $this->redirect(array('controller' => 'homes', 'action' => 'index'));
	            }
       		}
       		
       		$user= $_POST['user'];
       		$Passwd1= $_POST['Passwd1'];
       		$Passwd2= $_POST['Passwd2'];
       		$database= $_POST['database'];
       		$databaseHost= ($_POST['databaseHost']!='')?$_POST['databaseHost']:'localhost'; 
       		$databaseUser= $_POST['databaseUser'];
       		$databasePassword= $_POST['databasePassword'];
       		$databasePort= ($_POST['databasePort']!='')?$_POST['databasePort']:27017;

       		
       		if($Passwd1==$Passwd2 && $database!='')
       		{
	       		if(function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules()))
		        {
		        	$urlLocalConfig= '../Config/';
		        }
		        else
		        {
			        $urlLocalConfig= 'app/Config/';
		        }
		        
		        $string= '<?php class DATABASE_CONFIG {public $default = array("datasource" => "Mongodb.MongodbSource","host" => "'.$databaseHost.'","database" => "'.$database.'","login" => "'.$databaseUser.'","password" => "'.$databasePassword.'","port" => '.$databasePort.',"prefix" => "","persistent" => "true","encoding" => "utf8");}?>';
		        $file = fopen($urlLocalConfig.'database.php','w');
		        fwrite($file,$string);
		        fclose($file);
		        
		        $this->Session->write('createDataDefault',true);
		        $pass= md5($Passwd1);
		        
		        $this->redirect(Router::url('/', true).'admins/createDataDefault/'.$pass.'/'.$user);
	        }
	        else
	        {
		        $this->redirect(array('controller' => 'admins', 'action' => 'installMantan'));
	        }
       }
       
       function createDataDefault($pass,$user)
       {
       	   $createDataDefault= $this->Session->read('createDataDefault');
       	   if($createDataDefault)
       	   {
		       Controller::loadModel('Option');
		       Controller::loadModel('Admin');
		       $url= $this->getUrlLocal();
		       
		       $powers= array($url['urlOptions'].'infoSite',
		       				  $url['urlNotices'].'listNotices',
		       				  $url['urlOptions'].'categoryNotice',
		       				  $url['urlNotices'].'listPages',
		       				  $url['urlAlbums'].'listAlbums',
		       				  $url['urlVideos'].'listVideos',
		       				  $url['urlAdmins'].'listFiles',
		       				  $url['urlOptions'].'languages',
		       				  $url['urlOptions'].'themes',
		       				  $url['urlOptions'].'menus',
		       				  $url['urlOptions'].'plugins',
		       				  $url['urlOptions'].'sitemap',
		       				  $url['urlAdmins'].'listAccount',
							  $url['urlUsers'].'listUser',
		       				  $url['urlAdmins'].'logout'
		       				 );
		       
		       $this->Admin->saveAdmin($user,$pass,$powers);
		       
		       $language["Option"]['value']= array( "code"=> "en","file"=> "en.php" );
		       $this->Option->create();
		       $this->Option->saveOption('language',$language["Option"]['value']);
		       
		       $this->Option->create();
		       $this->Option->saveOption('theme','default');
		       
		       $this->Session->destroy();
		       $this->redirect(array('controller' => 'admins', 'action' => 'login'));
	       }
	       else $this->redirect(array('controller' => 'admins', 'action' => 'login'));
       }
       
// Danh nhap, dang xuat -------------------------------------------------------
	 
       function login()
       {
	        //Configure::write('debug', 2);
            $user_id= $this->Session->read('infoAdminLogin');
            if($user_id)
            {
            	$this->redirect(array('controller' => 'admins', 'action' => 'index'));
            }
            $this->setup(true);
            $this->layout= 'default';
       }

       function loginAfter()
       {
         //Configure::write('debug', 2);

		 $user= $_POST['user'];
         $password= md5($_POST['Passwd']);
         
         Controller::loadModel('Admin');
         Controller::loadModel('Option');
         
         $urlLocal= $this->getUrlLocal();
         $users= $this->Admin->checkLogin($user,$password);

         if($users)
         {
         	$infoSite= $this->Option->getOption('infoSite');
         	$users['Admin']['infoSite']= $infoSite["Option"]['value'];
         	$this->Session->write('infoAdminLogin',$users);
         	$this->Session->write('CheckAuthentication',true);
         	// Set session upload cho admin
			$urlBase= Router::url('/');
		 	if(strpos(strtolower($urlBase),'index.php/'))
		 	{
			 	$urlBase= substr_replace($urlBase, '', -10);  
		 	}
		 	$rootUpload=$urlBase.'app/webroot/upload/';
         	$this->Session->write('urlBaseUpload',$rootUpload.$users['Admin']['user'].'/');
         	//
            $this->redirect($urlLocal['urlAdmins']);
           
         }
         else $this->redirect($urlLocal['urlAdmins'].'login/?error=1');
       }


        function logout()
        {
            $this->Session->destroy();
        	$urlLocal= $this->getUrlLocal();

            $this->redirect($urlLocal['urlAdmins'].'login');
        }
// Quan ly file upload -------------------------------------------------
	   function listFiles()
	   {
		   //Configure::write('debug', 2);

	         $users= $this->Session->read('infoAdminLogin');
	         if($users)
	         {
		         $this->setup();
	         }
	         else 
	         {
	        	$urlLocal= $this->getUrlLocal();
	            $this->redirect($urlLocal['urlAdmins'].'login');
	         }
	   }

// Quan ly tai khoan ca nhan -------------------------------------------------
	   function listAccount()
	   {
		   //Configure::write('debug', 2);

	         $users= $this->Session->read('infoAdminLogin');
	         if($users)
	         {
		         	$this->setup();
		            $this->set('menu', 3);
		             
		            Controller::loadModel('Admin');
		            
					$dk= array();
	                $this->paginate = array(
	
	                                        'limit' => 15,
	
	                                        'conditions' => $dk,
	
	                                        'order' => array('created'=> 'DESC')
	
	                                        );
	
	                
	                $return = $this->paginate("Admin");
	                
	                $this->set('listData', $return);
	         }
	         else 
	         {
	        	$urlLocal= $this->getUrlLocal();
	            $this->redirect($urlLocal['urlAdmins'].'login');
	         }
	   }
	   
       function account($idAdmin=null)
       {
       		//Configure::write('debug', 2);
	   		$users= $this->Session->read('infoAdminLogin');
	   		$urlLocal= $this->getUrlLocal();
	   		if($users)
	   		{
	        	$this->setup();
				Controller::loadModel('Admin');
				if($idAdmin)
				{
					$account= $this->Admin->getAdmin($idAdmin);
					if($account)
					{
						$this->set('account', $account);
					}
					else $this->redirect($urlLocal['urlAdmins']);
				}
        	}
			else 
			{
            	$this->redirect($urlLocal['urlAdmins'].'login');
        	}
       }
	   
	   function savePowers()
	   {
		 //Configure::write('debug', 2);
         $users= $this->Session->read('infoAdminLogin');
    	 $urlLocal= $this->getUrlLocal();
    	 
         if($users && $_POST['id']!='')
         {
            Controller::loadModel('Admin');
            
            $account['powers']= $_POST['check_list'];
            $account['id']= $_POST['id'];
            
            $return= $this->Admin->savePowers($account);
            
            if($users['Admin']['id']==$account['id']){
            	$users['Admin']['powers']= $account['powers'];
            	$this->Session->write('infoAdminLogin',$users);
        	}
			
			$this->redirect($urlLocal['urlAdmins'].'powers/'.$_POST['id'].'?return='.$return);
         }
         else 
         {
            $this->redirect($urlLocal['urlAdmins'].'login');
         }
	   }
	   
       function saveAccount()
       {
       	 //Configure::write('debug', 2);
         $users= $this->Session->read('infoAdminLogin');
    	 $urlLocal= $this->getUrlLocal();
    	 
         if($users)
         {
            $passOld= $_POST['passOld'];

            $pass1= $_POST['pass1'];

            $pass2= $_POST['pass2'];

            if($pass1==$pass2)
            {
                $pass1= md5($pass1);
                Controller::loadModel('Admin');
                $account['passOld']= $passOld;
                $account['pass1']= $pass1;
                $account['email']= $_POST['email'];
                $account['information']= $_POST['information'];
                $account['id']= $_POST['id'];
                $account['user']= $_POST['user'];
                
                $return= $this->Admin->saveAccount($account);
            }
            else $return= -2;
			
			if($_POST['id']=='')
			{
				$this->redirect($urlLocal['urlAdmins'].'listAccount');
			}
            else $this->redirect($urlLocal['urlAdmins'].'account/'.$_POST['id'].'?return='.$return);
         }
         else 
         {
            $this->redirect($urlLocal['urlAdmins'].'login');
         }

       }
       
       function deleteAccount()
       {
	       //Configure::write('debug', 2);

		   $users= $this->Session->read('infoAdminLogin');
		   if($users)
		   {
               $id= $_POST['id'];

			   if($id != "")
			   {
           	       Controller::loadModel('Admin');
		   		   $id= new MongoId($id);
		   		   $this->Admin->delete($id);
           	   }

         	}
       }
       
       function powers($idAdmin)
       {
	       //Configure::write('debug', 2);
	   		$users= $this->Session->read('infoAdminLogin');
	   		$urlLocal= $this->getUrlLocal();
	   		if($users)
	   		{
	        	$this->setup();
				Controller::loadModel('Admin');
				if($idAdmin)
				{
					$account= $this->Admin->getAdmin($idAdmin);
					if($account)
					{
						$this->set('account', $account);
					}
					else $this->redirect($urlLocal['urlAdmins']);
				}else{
					$this->redirect($urlLocal['urlAdmins']);
				}
        	}
			else 
			{
            	$this->redirect($urlLocal['urlAdmins'].'login');
        	}
	       
       }

// ------------------------------

   }

?>
