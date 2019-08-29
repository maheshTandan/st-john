<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParentMenuSelController extends CI_Controller {
    
    function __construct() {
            parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
            $this->load->model('Admin/ParentMenuSelModel','m');
            $this->load->model('Access_model');
    }
    public function index()
    {
        $service =  $this->Access_model->showAdminService();
      
        $this->load->view('Admin/parentMenuSelView',['serviceData'=>$service]);
        //$this->load->view('Parent/childMenuItemView');
        $this->load->view('Footer/footer');
    }
    
    public function showMenu()
    {
        //$childid = $this->uri->segment(3); 
        $result = $this->m->getMenu();
        echo json_encode($result);
    }
    
    public function showItem()
    {
        $menuid = $this->input->post('menuid');
        $childid = $this->uri->segment(3); 
        $result = $this->m->getItem($menuid,$childid);
        echo json_encode($result);

    }
    
    public function parentChildrenList()
    {
        $parentID = $this->input->post('parent_id'); 
        $result = $this->m->getAllChildren($parentID);
       // print_r($result); die;
        echo json_encode($result);
    }
    
    public function updateChildItem()
    {
       // print_r($this->input->post('itemIDStr'));  die;
      //$childid = $this->uri->segment(3); 
        $result = $this->m->updateChild($this->input->post('child_id'), $this->input->post('date_by_child_id'), $this->input->post('menu_id'), $this->input->post('itemIDStr'));
        $msg['success'] = false;
        $msg['type'] = 'add';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    
    
    
   public function parentsList()
    {
       $result = $this->m->getAllParents();
        echo json_encode($result);
    }
    

}


?>
