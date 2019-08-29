<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


   class Access_controller extends CI_Controller {

   	public function __construct()
   	{
         parent :: __construct();
	date_default_timezone_set('Asia/Kolkata');
             $this->load->model('Access_model');
          	 $this->load->helper( array('form','url' )); 
          	 $this->load->library(array('form_validation','session','email'));
          	//  $this->load->library('Signup_controller');
             // $loginstatus   = $this->session->userdata('logged_in'); 
             //   if($loginstatus["status"] != '1')
             //       {

             //            redirect('logout');
             //        }
      
   	}  

       
   	public function manageProfile()
   	{
      $service =  $this->Access_model->showAdminService();
   	$data = $this->Access_model->allProfile();
     $this->load->view('profile/manageprofile',['profiledata'=>$data,'serviceData'=>$service]);
   	}
   

   public function createProfile() 
   {
       $service1 =  $this->Access_model->showAdminService();
    $service = $this->Access_model->allService();  
   	$this->load->view('profile/createprofile',['servicedata'=>$service,'serviceData'=>$service1]);

   }

   public function profileCreate() 
   {
   	if($this->input->server('REQUEST_METHOD') == 'POST')
   	{
   		 $this->form_validation->set_rules('profile', 'Profile Name', 'trim|required');

   		 if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('profile/createprofile');
			}
			else
			{        $id = "";
				     $id = $this->security->xss_clean($this->input->post('id'));
				     $data_id = $this->session->userdata['logged_in']['id'];
			         $profileName = $this->security->xss_clean($this->input->post('profile'));
			         $serviceid = $this->security->xss_clean($this->input->post('serviceCheck'));
			       

                if($id!= "") {

                        $insertUser = $this->Access_model->updateprofile($id,$profileName);
                        $insertServiceCheck = $this->Access_model->updateService($id,$serviceid,$data_id);
			  	
			  } else{
                        
                        $insertUser = $this->Access_model->insertProfile($profileName,$data_id);
                        $insertService = $this->Access_model->insertservice($serviceid,$insertUser);

                 }
				

			  	if($insertUser){
             $service =  $this->Access_model->showAdminService();
                $data = $this->Access_model->allProfile();
                 $this->load->view('profile/manageprofile',['profiledata'=>$data,'serviceData'=>$service]);
			  	}
			  	else{
			  		 $this->load->view('profile/manageprofile');
			  	     }	  	
			}  

	 } 
   }


    public function editProfile() 

    {       	$data = $this->Access_model->allProfile();
    	         $service = $this->Access_model->allService();  
                $id = array();
    	     for($i=0; $i< count($data); $i++)
    	     {
                $id[] = $data[$i]['id'];
    	     }
    	//     print_r($service); die;

    	    $id2 = $this->uri->segment('3');

    	  
    		$data1 = $this->Access_model->editprofile($id);
    		$data2 = $this->Access_model->selectservice($id2);
    		// print_r($data2); die;
         $service1 =  $this->Access_model->showAdminService();
    	  
    	      	$this->load->view('profile/createprofile',['profiledata'=>$data1 ,'servicedata'=>$service,'selectcheck'=>$data2,'serviceData'=>$service1]);
    	     
          
    }
   public function manageService()
   {            
   	          
              $service = $this->Access_model->allService(); 
              $service1 =  $this->Access_model->showAdminService();
            	$this->load->view('services/manageservice',['servicedata'=>$service,'serviceData'=>$service1]);

   }

   public function createService()
   {
       $service =  $this->Access_model->showAdminService();
   	       $this->load->view('services/createservice',['serviceData'=>$service]);

   }

   public function serviceCreate()

   {
     if($this->input->server('REQUEST_METHOD') == 'POST')
    	{
   		 $this->form_validation->set_rules('service', 'Service Name', 'trim|required');

   		 if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('services/createservice');
			}
			else
			{        
                      $createdby = $this->session->userdata['logged_in']['id'];
			         $serviceName = $this->security->xss_clean($this->input->post('service'));


			         $insertService = $this->Access_model->createService($createdby,$serviceName);
			         if($insertService)

			         {
                 $service1 =  $this->Access_model->showAdminService();
			         	 $service = $this->Access_model->allService(); 
			         	$this->load->view('services/manageservice',['servicedata'=>$service,'serviceData'=>$service1]);
			         }
			}  

	 } 
   }

   public function editService()
   {
   	   $id = $this->uri->segment('3');
 	     $service = $this->Access_model->allService();  

         // echo $id; die;
   	   $data = $this->Access_model->editservice($id);
   	 //  print_r($data); die;
           $service1 =  $this->Access_model->showAdminService();
   	   	$this->load->view('services/createservice',['servicedata'=>$data,'serviceData'=>$service,'serviceData'=>$service1]);

         
   }

   public function updateService()
   {
   	if($this->input->server('REQUEST_METHOD') == 'POST'){
   		 $this->form_validation->set_rules('service', 'Service Name', 'trim|required');


   		 if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('services/createservice');
			}
		else{
			      $id="";
                  $id = $this->security->xss_clean($this->input->post('id'));
                   $serviceName = $this->security->xss_clean($this->input->post('service'));
                    $service = $this->Access_model->allService(); 
                    $service1 =  $this->Access_model->showAdminService();
                    $serviceData = array_column($service, 'serviceName');
                    $find = array_search($serviceName,$serviceData);
                    if(empty($find))
                    {
                         $insertService = $this->Access_model->Updateservice1($id,$serviceName);
   	                   //  $data = $this->Access_model->editservice($id);
   	                      $data      = $this->Access_model->showAllService();
   	                     // print_r($data); die;
                      $this->load->view('services/manageservice',['servicedata'=>$data,'serviceData'=>$service1]);
                    }

                     else{
                     	 $insertService = $this->Access_model->Updateservice1($id,$serviceName);
                       if($insertService)
                          {
                           
                          	$this->load->view('services/manageservice',['servicedata'=>$service,'serviceData'=>$service1]);
                           }
                     }
                 


			}
   	}

   }


   public function showservice()
   {
    
   $service =  $this->Access_model->showAdminService();
   $this->load->view('services/service',['serviceData'=>$service]);

   }
   
    public function delProfile()
   {
    $id = $this->uri->segment('3');
   // echo "df";
    $data = $this->Access_model->delProfile($id);
    if($data)
    {
        redirect('Access_controller/manageProfile', 'refresh');
    }
  

   }
   
     public function delService()
   {
    $id = $this->uri->segment('3');
   // echo "df";
    $data = $this->Access_model->delService($id);
    if($data)
    {
        redirect('Access_controller/manageservice', 'refresh');
    }
  

   }



}
