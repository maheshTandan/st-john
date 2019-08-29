<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

   class Access_model extends CI_Model {

       function __construct()
      {
            parent::__construct();
             $this->load->library('session');
       }
          
       public function insertProfile($profileName,$data_id)
       {

               	$insertData = array(    'profile'=>$profileName,
								    'createdby'=>$data_id,
								    'status'=>'1'
							           );
                     if($insertData)
                         {
                         
                          	$this->db->insert('profile',$insertData);
                          	$insert_id = $this->db->insert_id();
                        	return $insert_id;

                          }
                     else{
                        	return false;
                         }       
       }


       public function allProfile()
       {

       	$sql = "select person_details.first_name as Name,profile.profile as profile,profile.id as id from person_details INNER JOIN user ON person_details.id = user.ref_id and person_details.email = user.userid  LEFT JOIN profile ON user.id = profile.createdby where profile.status = 1"; 
       $sql1 = $this->db->query($sql); 

        $row = $sql1->result_array();

        if(empty($row))
           {
              return false;
       
           }

           else{
           	   return $row;
           }
       }

       public function editprofile($id)
       {
      
       	  $id1 = $this->uri->segment('3');

       	  for($i=0;$i<count($id);$i++)

       	  {
       	  	if($id[$i] == $id1)
       	  	{
       	  		 	$sql = "select profile.profile as profile from profile where id= '$id1' "; 
                    $sql1 = $this->db->query($sql); 
                   return $row = $sql1->row_array();
       	  	}
       	  }



         }


         public function updateprofile($id,$profileName)
         {
         	    $sql = "UPDATE profile SET profile= '$profileName' WHERE id = '$id' ";
           	     $sql1 = $this->db->query($sql);
           	      return true;
         }




      public function allService()
      {

      	$sql ="select person_details.first_name as Name,service.service as serviceName,service.id as serviceid,user.id as id from person_details INNER JOIN user ON person_details.id = user.ref_id and person_details.email = user.userid  LEFT JOIN service ON user.id = service.createdby and service.status=1";
      	 $sql1 = $this->db->query($sql); 

        $row = $sql1->result_array();


         if(empty($row))
           {
              return false;
       
           }

           else{
           	   return $row;
           }
      }


      public function insertservice($serviceid,$profileid)
      {     
         $sql = "select profile.createdby as createdby from profile where id =$profileid ";
          $sql1 = $this->db->query($sql); 

        $row = $sql1->row_array();

         $user =  $row['createdby']; 

         if(empty($serviceid))
         {
         	echo "please select atleast one service";
             return false;
         }
         else{
         	 $insertData = array();
         for($i=0;$i<count($serviceid); $i++)
         {
         	$insertData[] = array('profile_id'=>$profileid,
         	                       'service_id'=>$serviceid[$i], 
								    'createdby'=>$user,
								  
							           );
         
         }

         $this->db->insert_batch('assign_service', $insertData);
            return true;  
         }
         
      	
          
      }

         
         public function selectservice($profileid)

         {
            $sql = "select assign_service.service_id as id,service.service as service from assign_service INNER JOIN service ON assign_service.service_id = service.id where assign_service.profile_id ='$profileid'";
              $sql1 = $this->db->query($sql); 
             return $row = $sql1->result_array();

         }


  public function updateService($profileid,$serviceid,$createdbyid)
  {
  	
    	$this->db->where('profile_id', $profileid);
     $this->db->delete('assign_service');
      
         $insertData = array();
         for($i=0;$i<count($serviceid); $i++)
         {
         	$insertData[] = array('profile_id'=>$profileid,
         	                       'service_id'=>$serviceid[$i], 
								    'createdby'=>$createdbyid,
								  
							           );
         
         }

         $this->db->insert_batch('assign_service', $insertData);
            return true;  
  
     }

      public function createService($created,$service)
      {

        	$insertData = array(    'service'=>$service,   
								    'status'=>'1',
								    'createdby'=>$created
							           );
                     if($insertData)
                         {
                         
                          	$this->db->insert('service',$insertData);
                          	$insert_id = $this->db->insert_id();
                        	return $insert_id;

                          }
                     else{
                        	return false;
                         }       
      }

      public function editservice($id)
      {
         $sql = "select person_details.first_name as Name,service.service as serviceName,service.id as serviceid from person_details INNER JOIN user ON person_details.id = user.ref_id LEFT JOIN service ON  service.createdby=user.id where service.id='$id' " ;
          $sql1 = $this->db->query($sql); 

       return $row = $sql1->row_array();

       
      }

      public function Updateservice1($id,$service)
      {
              
             	$sql = "UPDATE service SET service= '$service' WHERE id = '$id' ";
           	 $sql1 = $this->db->query($sql);
           	      return true;
      }

      public function showAllService()

      {
          $sql = "select person_details.first_name as Name,service.service as serviceName,service.id as serviceid from person_details INNER JOIN user ON person_details.id = user.ref_id LEFT JOIN service ON  service.createdby=user.id and service.status=1";

         $sql1 = $this->db->query($sql); 

         return $row = $sql1->result_array();
      }
         
         public function showAdminService()
         {

           $loginstatus   = $this->session->userdata('logged_in'); 
           $id = $loginstatus["id"];
        
          
          $sql = "select a.id,d.service,d.link from user a inner join user_profile_mapping b inner join assign_service c inner join service d on a.id=b.user_id and b.profile_id=c.profile_id and c.service_id=d.id where a.id='$id' and d.status = 1";

          $sql1 = $this->db->query($sql); 
         return $row = $sql1->result_array();
         }
         
    public function delProfile($ID)
    {
        $data = array(
                'status'=>0,
              );
    
        $this->db->where('id', $ID);
        return $this->db->update('profile', $data);
    }  
    
    public function delService($ID)
    {
        $data = array(
                'status'=>0,
              );
    
        $this->db->where('id', $ID);
        return $this->db->update('service', $data);
    }  
     
  }