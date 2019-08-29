<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuCreation extends CI_Controller {
    

   	public function __construct()
   	{
         parent :: __construct();
          
          	 $this->load->library('session');
          	//  $this->load->library('Signup_controller');
             $loginstatus   = $this->session->userdata('logged_in'); 
               if($loginstatus["status"] != '1')
                   {

                       redirect('logout');
                    }

            
            
   	} 
  
    public function index()
    {
       $this->load->model('MenuSelection/MenuSelectionModel','foodSelection');
       $data = $this->foodSelection->getMenuData();
       //print_r($data);
      // echo count($data); die;
       $this->load->view('Admin/MenuCreation/createMenuView',
               ['menu'=>$data, 'menutotal'=>count($data)]);
       
    }
}

?>