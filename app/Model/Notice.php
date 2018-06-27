<?php
   class Notice extends AppModel
   {
       var $name = 'Notice';

       function getNewNotice($limit=5)
       {
       	  $dk = array ( 'type'=> 'post' );
		  $today= getdate();
		  $dk['time']= array('$lte' => $today[0]);
       	  
          $notices = $this->find('all', array('order' => array('time'=>'DESC','created'=> 'DESC'),
                                              'limit' =>$limit,
                                              'conditions' => $dk
                                            ));
          return $notices;
       }
       
       function getTopEventNotice($limit=5)
       {
    	  $dk = array ( 'type'=> 'post','event'=>1 );
		  $today= getdate();
		  $dk['time']= array('$lte' => $today[0]);
       	  
          $notices = $this->find('all', array('order' => array('time'=>'DESC','created'=> 'DESC'),
                                              'limit' =>$limit,
                                              'conditions' => $dk

                                            ));
          return $notices;
       }
       
       function getTopViewNotice($limit=5)
       {
    	  $dk = array ( 'type'=> 'post' );
		  $today= getdate();
		  $dk['time']= array('$lte' => $today[0]);
       	  
          $notices = $this->find('all', array('order' => array('view'=>'DESC','time'=>'DESC','created'=> 'DESC'),
                                              'limit' =>$limit,
                                              'conditions' => $dk

                                            ));
          return $notices;
       }
	   
	   function getPageData($page=1,$limit=null,$conditions=array(),$order=array('time'=>'desc','created' => 'desc','title'=>'asc'),$checkTime= false)
       {
		   if($checkTime){
			  $today= getdate();
			  $conditions['time']= array('$lte' => $today[0]);
		  }
		  
	       $array= array(
	                        'limit' => $limit,
	                        'page' => $page,
	                        'order' => $order,
	                        'conditions' => $conditions
	
	                    );
	       return $this -> find('all', $array);             
       }
       
       function getAllPage()
       {
	       $dk = array ( 'type'=>'page' );
	       $today= getdate();
		   $dk['time']= array('$lte' => $today[0]);
       	  
           $notices = $this->find('all', array( 'order' => array('time'=>'DESC','created'=> 'DESC'),
                                             
                                             	'conditions' => $dk

                                            ));
          return $notices;
       }
       
       function savePages($slug,$author,$title,$key,$content,$image,$introductory,$time,$id)
       {
       		 $listSlug= array();
	       	 $number= 0;
	       	 $slugStart= $slug;
	       	 do
	       	 {
	       	 	 $number++;
		       	 $listSlug= $this->find('all', array('conditions' => array('slug'=>$slug) ));
				 if(count($listSlug)>0 && $listSlug[0]['Notice']['id']!=$id)
				 {
				 	$slug= $slugStart.'-'.$number;
		       	 }
	       	 } while (count($listSlug)>0 && $listSlug[0]['Notice']['id']!=$id);
	       	 
	         if($id != null)
	         {
	            $id= new MongoId($id);
	            $save= $this->getNotice($id);
	         }
	         else
	         {
	            $save['Notice']['view']= 0;
	         }
	         $save['Notice']['title']= $title;
	         $save['Notice']['key']= $key;
	         $save['Notice']['content']= $content;
	         $save['Notice']['author']= $author;
	         $save['Notice']['slug']= $slug;
	         $save['Notice']['type']= 'page';
	         $save['Notice']['image']= $image;
	         if($introductory!=''){
				 $save['Notice']['introductory']= $introductory;
			 }else{
				 $save['Notice']['introductory']= $this->getIntroductory($content,30);
			 }
			 
			 $save['Notice']['time']= (int)$time;
	         
	         $this->save($save);
	         return 1;
       }
       
       function updateView($idNotice)
       {
       	   if($idNotice!='')
       	   {
		       $save['$inc']['view']= 1;
		       $idNotice= new MongoId($idNotice);
		       $dk= array('_id'=>$idNotice);
		       $this->updateAll($save,$dk);
	       }
       }
       
       function saveNotices($slug,$time,$author,$title,$key,$content,$category,$image,$event,$introductory,$id= null)
       {
       	 $listSlug= array();
       	 $number= 0;
       	 $slugStart= $slug;
       	 do
       	 {
       	 	 $number++;
	       	 $listSlug= $this->find('all', array('conditions' => array('slug'=>$slug) ));
			 if(count($listSlug)>0 && $listSlug[0]['Notice']['id']!=$id)
			 {
			 	$slug= $slugStart.'-'.$number;
	       	 }
       	 } while (count($listSlug)>0 && $listSlug[0]['Notice']['id']!=$id);
       	 
       	 $save['Notice']['title']= $title;
         $save['Notice']['slug']= $slug;
         $save['Notice']['key']= $key;
         $save['Notice']['content']= $content;
         $save['Notice']['category']= $category;
         $save['Notice']['image']= $image;
         $save['Notice']['event']= $event;
         $save['Notice']['author']= $author;    
		 if($introductory!=''){
			 $save['Notice']['introductory']= $introductory;
		 }else{
			 $save['Notice']['introductory']= $this->getIntroductory($content,30);
		 }
         
         $save['Notice']['time']= (int)$time;
         $save['Notice']['type']= 'post';
         
         if($id != null)
         {
            $id= new MongoId($id);
            $dk= array('_id'=>$id);
            $this->updateAll($save['Notice'],$dk);
         }
         else
         {
            $save['Notice']['view']= 0;
            $this->save($save);
         }
         return 1;
       }
       
       function getNotice($idNotice)
       {
         $dk = array ('_id' => $idNotice);
         $notice = $this -> find('first', array('conditions' => $dk) );
         return $notice;
       }
       
       function getOtherNotice($category=array(),$limit=5,$conditions=array())
       {
       		 if(!$category) {
	       		 $conditions['category']= null;
       		 }else{
	         	$conditions['category']= array('$in'=>$category);
	         }
			 
			 $today= getdate();
			 $conditions['time']= array('$lte' => $today[0]);
			  
	         $notice = $this -> find('all', array('conditions' => $conditions,'limit' =>$limit,'order' => array('time'=>'DESC','created'=> 'DESC')) );
	         return $notice;
       }
       
       function getSlugNotice($slug)
       {
         $dk = array ('slug' => $slug);
         $notice = $this -> find('first', array('conditions' => $dk) );
         return $notice;
       }

        function getIntroductory($document,$soTu)
        {
          //$modau= $this->tachHTML($document);
          $modau= strip_tags($document, ""); 
		  $modau= str_replace('\r','',$modau);
		  $modau= str_replace('\n','',$modau);
		  $modau= str_replace('\t','',$modau);
		  
          $st= explode(" ", $modau);
          $modau= "";
          for($i=0;$i<$soTu;$i++)
          {
            if(isset($st[$i]))
            $modau= $modau." ".$st[$i];
          }
          $modau= $modau." ...";
          return $modau;
        }
        
        
   }
?>