<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminMenuItemSelController extends CI_Controller {
    
    
    public function __construct()
    {
        parent :: __construct();
		date_default_timezone_set('Asia/Kolkata');           
            $this->load->library('session');
            $this->load->model(array('Access_model','Signup_model'));
            $this->load->model('Admin/AdminMenuItemSelModel','obj');
            $loginstatus   = $this->session->userdata('logged_in'); 
            if($loginstatus["status"] != '1')
            {

                redirect('logout');
            }
    } 
   
    public function index()
    {   //echo "DP"; die;
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $service =  $this->Access_model->showAdminService();
        $checkData = $this->obj->checkMenuItem();
        $dataItemCategory = $this->obj->dataItemCategory($locationid);
        $this->load->view('Admin/adminmenuSelItemView',
          ['serviceData'=>$service, 'dataMenu'=>$this->obj->getMenu(), 
             'dataItemCategory'=>$dataItemCategory, 'checkData'=>$checkData,'dataItem'=>$this->obj->getItem()]);
    }
    
    public function insertMenuItemData()
    {
        //echo "divesh"; die;
        $resultData = $this->input->post('ItemArray');      // print_r($resultData); die;
        $result = $this->obj->insertData($resultData) ;    
        $msg['success'] = false;
        if($result){
                $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    
    public function displayDynamicMenuItem()
    {
       // echo "DIVESH"; die;
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        //$gradeID = $this->input->post('gradeID');       //print_r($resultData); die;
        //$date = $this->input->post('date');
        $checkData = $this->obj->checkMenuItem();
      //  print_r($checkData); die;
        $dataMenu = $this->obj->getMenu();
       // $dataMeal = $this->obj->mealData($date,$locationid);
        $dataItem = $this->obj->getItem();
        $dataItemCategory = $this->obj->dataItemCategory($locationid);
        $data['checkData'] = $checkData;
        $data['datamenu'] = $dataMenu;
        //$data['datameal'] = $dataMeal;
        $data['dataItem'] = $dataItem;
        $data['ItemCategory'] = $dataItemCategory;
        echo json_encode($data);
    }
    
//     public function menuSelItemView()
//    {
//        $date =  urldecode($this->uri->segment(3)); 
//        $locid = $this->obj->locbmid();
//        $locationid = $locid['locid'];
//
//        $service =  $this->Access_model->showAdminService();
//        
//        $mealData = $this->obj->mealData($date,$locationid); 
//        
//        $checkData = $this->obj->checkMenuItemByDate($date,$locationid);
//        $Grade = $this->obj->getGrade();
//        $GradebyLocid = $this->obj->getGradeByLocid($date,$locationid);
//        $dataItemCategory = $this->obj->dataItemCategory($locationid);
//       // print_r($checkData); die;
//        $this->load->view('Admin/MenuCreation/menuSelItemView',
//          ['serviceData'=>$service, 'dataMenu'=>$this->obj->getMenu(), 
//             'dataItemCategory'=>$dataItemCategory, 'mealData'=>$mealData, 'dataItem'=>$this->obj->getItem(), 'date'=>$date, 'checkData'=>$checkData, 'grade'=>$Grade, 'gradebylocid'=>$GradebyLocid]);
//
//    }
    
    
//    public function displayAllMenu()
//    {
//        //echo "Divesh Pandey"; die;
//        $result = $this->obj->getMenu();
//        echo json_encode($result);
//       // echo $menu = $this->input->post('id'); 
//        //echo "Hi Div";
//    }
    
//     public function displayAllItem()
//    {
//        //echo "Divesh Pandey"; die;
//      // print_r($this->input->post(html2)); die;
//        $result = $this->obj->getItem();
//        echo json_encode($result);
//       // echo $menu = $this->input->post('id'); 
//        //echo "Hi Div";
//    }
    
   
    
//    public function ajaxItemsDisabling()
//    {
//       
//        $result = $this->obj->itemsDisablingCheck();
//        echo json_encode($result);
//    }
    
   
}

?>
