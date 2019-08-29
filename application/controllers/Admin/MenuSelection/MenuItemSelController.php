<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuItemSelController extends CI_Controller {
    
    
    public function __construct()
    {
        parent :: __construct();
		date_default_timezone_set('Asia/Kolkata');           
            $this->load->library('session');
            $this->load->model(array('Access_model','Signup_model'));
            $this->load->model('MenuSelection/MenuItemSelModel','obj');
            $loginstatus   = $this->session->userdata('logged_in'); 
            if($loginstatus["status"] != '1')
            {

                redirect('logout');
            }
    } 
   
    public function index()
    {
        // $this->load->view('Header/header');
        $service =  $this->Access_model->showAdminService();
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        //$checkData = $this->obj->checkMenuItem($locationid);
        $checkData = $this->obj->checkMenuItemByDateHotLunch($locationid);
       // $distinctGrade = $this->obj->distinctGrade($locationid,$date);
     
      
        $this->load->view('Admin/MenuCreation/menuItemSelView',
            ['serviceData'=>$service, 'menuObj'=>$this->obj->getMenu(), 'checkData'=>$checkData, 'locationid'=>$locationid]);
       // $this->load->view('Footer/footer');
    }
    
     public function menuSelItemView()
    {
        $date =  urldecode($this->uri->segment(3)); 
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];

        $service =  $this->Access_model->showAdminService();
        
        $mealData = $this->obj->mealData($date,$locationid); 

       // print_r($mealData); die;
        
        $checkData = $this->obj->checkMenuItemByDate($date,$locationid);
        $Grade = $this->obj->getGrade();
        $GradeByDate = $this->obj->getGradeByDate($date);
        $GradebyLocid = $this->obj->getGradeByLocid($date,$locationid);
        $dataItemCategory = $this->obj->dataItemCategory($locationid);
       // print_r($checkData); die;
        $this->load->view('Admin/MenuCreation/menuSelItemView',
          ['serviceData'=>$service, 'dataMenu'=>$this->obj->getMenu(), 
             'dataItemCategory'=>$dataItemCategory, 'mealData'=>$mealData, 'dataItem'=>$this->obj->getItem($locationid), 'date'=>$date, 'checkData'=>$checkData, 'grade'=>$Grade, 'gradebydate'=>$GradeByDate, 'gradebylocid'=>$GradebyLocid]);

    }
    
    
    public function displayAllMenu()
    {
        //echo "Divesh Pandey"; die;
        $result = $this->obj->getMenu();
        echo json_encode($result);
       // echo $menu = $this->input->post('id'); 
        //echo "Hi Div";
    }
    
     public function displayAllItem()
    {
        //echo "Divesh Pandey"; die;
      // print_r($this->input->post(html2)); die;
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $result = $this->obj->getItem($locationid);
        echo json_encode($result);
       // echo $menu = $this->input->post('id'); 
        //echo "Hi Div";
    }
    
    public function insertMenuItemData()
    {
        //echo "divesh"; die;
        $resultData = $this->input->post('ItemArray');      // print_r($resultData); die;
        $date = $this->input->post('date');
        $interval = $this->input->post('interval');
        $grade = $this->input->post('grade');
      
        $result = $this->obj->insertData($resultData, $date, $grade, $interval);    
        
        $msg['success'] = false;
        if($result){
                $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    
    public function ajaxItemsDisabling()
    {
       
        $result = $this->obj->itemsDisablingCheck();
        echo json_encode($result);
    }
    
    public function displayDynamicMenuItem()
    {
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $gradeID = $this->input->post('gradeID');       //print_r($resultData); die;
        $date = $this->input->post('date');
        $checkData = $this->obj->displayDynamicMenuItem($gradeID, $date, $locationid);
        $checkData1 = $this->obj->displayDynamicMealItem($gradeID, $date, $locationid);
        //print_r($checkData1); die;
        $dataMenu = $this->obj->getMenu();
        $dataMeal = $this->obj->mealData($date,$locationid);
        $dataItem = $this->obj->getItem($locationid);
        $dataItemCategory = $this->obj->dataItemCategory($locationid);
        $data['checkData'] = $checkData;  
        $data['checkData1'] = $checkData1; 
        $data['datamenu'] = $dataMenu;
        $data['datameal'] = $dataMeal;
        $data['dataItem'] = $dataItem;
        $data['ItemCategory'] = $dataItemCategory;
        $data['gradeID']=$gradeID;
        echo json_encode($data);
        
        
    }
    
    public function ajaxSearchItemMenuWise()
    {
       
        $searchItem = trim($this->input->post('searchValue'));
        $categID = trim($this->input->post('categID')); 
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $searchData = $this->obj->searchItemMenuList($searchItem, $locationid, $categID);
        //print_r($searchData);
        $data['searchData'] = $searchData; 
        $data['searchValue'] = trim($searchItem);
        
        echo json_encode($data);
        
    }  
    
    function weeks($month, $year)
    {
       // $num_of_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $num_of_days = date("t", mktime(0,0,0,$month,1,$year)); 
        $lastday = date("t", mktime(0, 0, 0, $month, 1, $year)); 
        $no_of_weeks = 0; 
        $count_weeks = 0; 
        while($no_of_weeks < $lastday){ 
            $no_of_weeks += 7; 
            $count_weeks++; 
        } 
	return $count_weeks;
    } 
    
    public function cloneData()
    {
        //add one month to current month
       //   $month = date('m', strtotime("+1 months", strtotime(date('m'))));
        //current year
       // $year = date('Y');
       
        $locid = $this->obj->locbmid();
        $locationid = $locid['locid'];
        $loginstatus = $this->session->userdata('logged_in');
        $createdId = "select id from user where `ref_id` = ". $loginstatus['parent_id'];  
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array();
        $createdbyID = $resultid['id'];
      
        $monthDel = '';
        $yearDel = ''; 
        $delDate ='';
        
        //date passed via ajax call
       $dateVal = trim($this->input->post('dateVal'));  // from clone 2018-12
       $dateValto = trim($this->input->post('dateValto'));  // to clone 2019-01
       //$Grade = $this->obj->getGrade();
       $Grade = "SELECT distinct `grade_id` from `menu_item_assign` WHERE DATE_FORMAT(`date`, '%Y-%m') = '".$dateVal."' order by grade_id ASC"; 
       $Grade = $this->db->query($Grade)->result_array();
       
       
       $dd = $dateVal; 
       $dd =  explode('-', $dd);
       
       $ddto = $dateValto; 
       $ddto =  explode('-', $ddto);
  
       //get number of days for a specfic month
        $num_of_days =  cal_days_in_month(CAL_GREGORIAN,$dd[1],$dd[0]);
     
        
        $sqlDel = "DELETE FROM menu_item_assign WHERE DATE_FORMAT(`date`, '%Y-%m') = '".$dateValto."'"; 
        $flag = false;
        
        
        $numofWeeks = $this->weeks($dd[1],$dd[0]);
        $c = 1;
        $k = 1;
        $lastdayK = date("t", mktime(0, 0, 0, $ddto[1], 1, $ddto[0])); 
        
        $checkDate = '';
        $checkDateto = '';
       
        
        if(!$flag)
        {
            $this->db->query($sqlDel);
            $flag = true;
        }
        
        
        if($flag)
        {
             $checkDate = $dateVal."-".$c;
             $checkDateto = $dateValto."-".$k;
             $nameOfDay = date('D', strtotime($checkDate));
             $nameOfDayto = date('D', strtotime($checkDateto));
             
             if($nameOfDay == 'Sat'){ $c = $c + 2; }
             elseif ($nameOfDay == 'Sun') {  $c = $c + 1; }
             
             if($nameOfDayto == 'Sat'){ $k = $k + 2; }
             elseif ($nameOfDayto == 'Sun') {  $k = $k + 1; }
             
             
             
//             if($nameOfDayto == 'Mon'){ $k = $k + 0; }
//             elseif ($nameOfDayto == 'Tue') { $k = $k + 6; }
//             elseif ($nameOfDayto == 'Wed') {  $k = $k + 5; }
//             elseif ($nameOfDayto == 'Thu') {  $k = $k + 4; }
//             elseif ($nameOfDayto == 'Fri') {  $k = $k + 3; }
//             elseif ($nameOfDayto == 'Sat') {  $k = $k + 2; }
//             elseif ($nameOfDayto == 'Sun') {  $k = $k + 1; }
            //echo $numofWeeks; die;
            // $i = $c;
             $flg = true;
             
            while($numofWeeks > 0)
            {
                //echo $numofWeeks; die;
                
                if($lastdayK < $k)
                {
                    break;
                }
                
                if($flg)
                {
                    $i = $c;
                    $flg = false;
                }
                else
                {
                    $i = 1;
                }
                
                
                //for($i=1; $i<=7; $i++)
                while($i <= 7)
                {
                    $checkDate = $dateVal."-".$c;   // from date 2018-12-01
                    $checkDateto = $dateValto."-".$k;  // to date 2019-01-01
                    
                    $nameOfDay = date('D', strtotime($checkDate));
                    $nameOfDayto = date('D', strtotime($checkDateto));
                    
                    if($nameOfDay === $nameOfDayto)
                    {
                        if($nameOfDay === 'Sat')
                        {
                            $c++;
                            $k++;
                           
                        }
                        elseif($nameOfDay === 'Sun')
                        {
                            $c++;
                            $k++;
                           
                        }
                        else
                        {
                            $sqlCheck = "select grade_id,`menu_id`, `category_id`, `item_id`, `meal_id` from menu_item_assign where `date`='".$checkDate."' order by grade_id ASC";
                            $resultSet = $this->db->query($sqlCheck)->result_array();
                            //print_r($resultSet);
                           // echo "PP-->".count($resultSet); 
                            if(count($resultSet) !=0)
                            {   
                                $insertData = array();
                                for($j=0;$j<count($resultSet); $j++)
                                {
                                     //$insertData = array();
                                            //$Grade[$l]['grade_id']
                                    for($l = 0; $l < count($Grade); $l++)
                                    {

                                       if($resultSet[$j]['grade_id'] == $Grade[$l]['grade_id'] )
                                       {
                                          $insertData[] = array('grade_id'=>$Grade[$l]['grade_id'],
                                                             'menu_id'=>$resultSet[$j]['menu_id'],
                                                             'category_id'=>$resultSet[$j]['category_id'],
                                                             'item_id'=>$resultSet[$j]['item_id'],
                                                             'meal_id'=>$resultSet[$j]['meal_id'],
                                                             'locid'=>$locationid,
                                                             'date'=>$checkDateto,
                                                             'status'=>1,
                                                             'createdby'=>$createdbyID
                                                            );
                                       }


                                        

                                    } 
                                                 
                                   //$this->db->insert_batch('menu_item_assign', $insertData);
                                }  //echo "---->>>".count($insertData)."<----";
                                $this->db->insert_batch('menu_item_assign', $insertData);
                                $c++;
                                $k++;
                            }
                            else
                            {
                                $c++;
                                $k++;
                               
                            }
                        }
                    }
                    else
                    {
                        //$c++;
                        $k++;
                        //continue;
                    }
                     //$numofWeeks--;
                    $i++;
                }
               // echo $numofWeeks;
                $numofWeeks--;
            }
            echo json_encode(true);
        }
    }
    
    public function cloneDataService()
    {
        
        $service =  $this->Access_model->showAdminService();
        $this->load->view('Admin/MenuCreation/cloneView',['serviceData'=>$service]);
    }
    
    public function cloneDelData()
    {
        $dateValto = trim($this->input->post('dateValto'));
        $sqlDel = "DELETE FROM menu_item_assign WHERE DATE_FORMAT(`date`, '%Y-%m') = '".$dateValto."'"; 
        $flag = false;
        if(!$flag)
        {
            $this->db->query($sqlDel);
            $flag = true;
            echo json_encode(true);
        }
    }
    
    
    
    
}

?>
