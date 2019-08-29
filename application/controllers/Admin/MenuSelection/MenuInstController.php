<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuInstController extends CI_Controller {
    
    
    public function __construct()
    {
         parent :: __construct();
           date_default_timezone_set('Asia/Kolkata'); 
             $this->load->library('session');
               $this->load->model('Access_model');
            //  $this->load->library('Signup_controller');
             $loginstatus   = $this->session->userdata('logged_in'); 
               if($loginstatus["status"] != '1')
                   {

                       redirect('logout');
                    }

            
            
    } 
    
    public function index()
    {        $service =  $this->Access_model->showAdminService();
            $this->load->model('MenuSelection/MenuInstModel');
            $dataMenu = $this->MenuInstModel->getMenu();
            $this->load->view('Admin/MenuCreation/insertMenuView',
                ['flag'=>0, 'dataMenu'=>$dataMenu,'serviceData'=>$service]);
    }
    
    public function saveMenuData()
    {
        $menu = $this->input->post('menu_name'); 
        $this->load->model('MenuSelection/MenuInstModel');
       
        if($this->MenuInstModel->insertMenu($menu))
        {
            redirect('menuinst', 'refresh');
        }
      
    }
    
    public function editMenu()
    {
        //echo "Cool";
             $service =  $this->Access_model->showAdminService();
         if($this->input->server('REQUEST_METHOD') == 'POST')
         {
             
            $MenuID = $this->uri->segment('3');
            $menuName = $this->input->post('menu_name'); 
            $this->load->model('MenuSelection/MenuInstModel');
            $dataMenu = $this->MenuInstModel->updateMenuByID($MenuID, $menuName);
            // print_r($dataMenu); die;
            if($dataMenu)
            {
                redirect('menuinst', 'refresh');
            }
           
           
         }
         else
         {
            $MenuID = $this->uri->segment('3');
            $this->load->model('MenuSelection/MenuInstModel');
            $dataMenu = $this->MenuInstModel->getMenuByID($MenuID);
            $this->load->view('Admin/MenuCreation/editMenuView',
                ['flag'=>0, 'dataMenu'=>$dataMenu,'serviceData'=>$service]);
         }
    }
    
    
    public function deleteMenu()
    {
      
        $MenuID = $this->uri->segment('3');
        $menuName = $this->input->post('menu_name'); 
        $this->load->model('MenuSelection/MenuInstModel');
        $dataMenu = $this->MenuInstModel->deleteMenuByID($MenuID);
        // print_r($dataMenu); die;
        if($dataMenu)
        {
            redirect('menuinst', 'refresh');
        }
    }
    
}

?>
