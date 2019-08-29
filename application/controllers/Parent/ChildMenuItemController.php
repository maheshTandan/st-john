<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChildMenuItemController extends CI_Controller {
    
    function __construct() {
            parent::__construct();
		   date_default_timezone_set('Asia/Kolkata');
            $this->load->model('Parent/ChildMenuItemModel','m');
               $this->load->model(array('Access_model','MenuSelection/MenuItemSelModel'));
                $this->load->library(array('session'));
                  $this->load->model(array('Parent/ChildReportListModel','Signup_model'));
                    $this->load->model(array('MenuSelection/BmTeacherReportModel','BmTeacherReportModel'));
                  $this->load->helper('url');

                  // $this->load->model('Access_model');
    }

    public function index()
    {
        // $arrItem = array();

          if(!isset($_GET['week']))
          {
            redirect('/menusel/index?week=05&year=2019','refresh');
          }
          $service =  $this->Access_model->showAdminService();
           $loginstatus   = $this->session->userdata('logged_in'); 
         $parent_id = $loginstatus['parent_id'];
         $childName = $this->m->allChild($parent_id);
         
        $locid = $this->MenuItemSelModel->locbmid();
        $locationid = $locid['locid'];

        $monthDate = $this->MenuItemSelModel->startLastDate($locationid);

        $date =  urldecode($this->uri->segment(3));     
      //  $checkData = $this->m->checkMenuItem($locationid);
      // print_r($monthDate); die;
        

       $start_Date = $monthDate[0]['start_date']; 
       $end_date = $monthDate[0]['end_date'];
        
        
         $status = $this->BmTeacherReportModel->activateDeactivateCal();
          
        $this->load->view('Parent/childListView',['serviceData'=>$service,'menuObj'=>$this->m->getMenu(), 'dataItem'=>$this->m->getItem(), 'date'=>$date, 'child'=>$childName,'start_Date'=>$start_Date,'end_date'=>$end_date, 'parent_id'=>$parent_id, 'status'=>$status['status']]);    

    }


    public function categoryItemMeal()
    {
        
        $childId = $this->input->post('selectedChild');
        $parentIDD = $this->input->post('parentIDD');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $childDateItem = $this->input->post('DateValue1');


       

        $checkMealItemData  = $this->m->checkMealItemData($childId,$childDateItem);
        $selectMealItemDataChild = $this->m->childMealItemData($childId);   //for selected meal by child
        $category = $this->m->category($childId,$childDateItem);
        $uncheckDate = $this->ChildReportListModel->uncheckDate($parentIDD, $childId, $startDate, $endDate);
       
        for($i=0;$i<count($checkMealItemData);$i++)             
         {
           $arrItem = explode(",", $checkMealItemData[$i]['item']);
           $arrPrice = explode(",", $checkMealItemData[$i]['price']);
           $checkMealItemData[$i]['item'] = $arrItem;
           $checkMealItemData[$i]['price'] = $arrPrice;
         
         }

//echo $childId; echo "--->"; print_r($childDateItem); die;
      $checkCategoryItemData = $this->m->checkCategoryItemData($childId,$childDateItem);
      $selectCategoryItemDataChild = $this->m->childCategoryItemData($childId);   //for selected item by child
  //die;
      $data['category'] = $category;
      $data['checkMealItemData'] = $checkMealItemData;
      $data['selectMealItemDataChild'] = $selectMealItemDataChild;
      $data['checkCategoryItemData'] = $checkCategoryItemData;
      $data['selectCategoryItemDataChild'] = $selectCategoryItemDataChild;
      $data['uncheckDate'] = $uncheckDate;
     // print_r($checkCategoryItemData); die;
     
        echo json_encode($data);  
    }
    
    public function showMenu()
    {
      
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
    
    public function showAllChildren()
    {
  
        $loginstatus   = $this->session->userdata('logged_in'); 
       // print_r($loginstatus); die;
         $parent_id = $loginstatus['parent_id']; 
        $result = $this->m->getAllChildren($parent_id);
       // print_r($result); die;
        echo json_encode($result);
    }
    
    public function addChildMenu()
    {
      $childid = $this->uri->segment(3); 
      $result = $this->m->addChildMenu($childid);
        $msg['success'] = false;
        $msg['type'] = 'add';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    
    
    
   public function showAllChildrenMenu()
    {
        $result = $this->m->getAllChildrenMenuItem('44');
        echo json_encode($result);
    }


    public function insertchildmenuitemdata()
    {
      $resultData = $this->input->post('ItemArray'); 
       $date = $this->input->post('date');
       $childId = $this->input->post('selectedChild');
 
       $result = $this->m->insertchildparentData($resultData, $date,$childId);   
        
        $msg['success'] = false;
        $msg['type'] = 'add';

        if($result){
            $msg['success'] = true;
        }
          echo json_encode($msg);
      
    }



    public function parentmenuselitemview()
    {
         $date =  urldecode($this->uri->segment(3)); 
         $loginstatus   = $this->session->userdata('logged_in'); 
         $parent_id = $loginstatus['parent_id'];

         $locid = $this->m->locationid($parent_id);
        
         $childId = $this->input->post('selectedChild');
       
         $service =  $this->Access_model->showAdminService();
         $childName = $this->m->allChild($parent_id);
         $checkData = $this->m->checkMenuItem1($date,$locid[0]['locid']);
         $parentItem = $this->m->checkParentItem($date,$locid[0]['locid']);
     
         $this->load->view('Parent/childMenuItemView',['dataMenu'=>$this->m->getMenu(), 'date'=>$date,'checkData'=>$checkData,'serviceData'=>$service,'child'=>$childName,'parentSelectItem'=>$parentItem]);
    }


    public function showselectItem()
    {

         $date = $this->input->post('date');
       $childId = $this->input->post('selectedChild');

        $loginstatus   = $this->session->userdata('logged_in'); 
         $parent_id = $loginstatus['parent_id'];
                                                    
         $locid = $this->m->locationid($parent_id);
         $service =  $this->Access_model->showAdminService();
            
        $checkData = $this->m->checkMenuItem1($date,$locid[0]['locid']);
        $parentItem = $this->m->checkParentchildItem($childId,$date,$locid[0]['locid']);
        $dataMenu=$this->m->getMenu();

        $data['checkData'] = $checkData;
        $data['parentItem'] = $parentItem;
        $data['datamenu'] = $dataMenu;

           echo json_encode($data);


         // $this->load->view('Parent/childMenuItemView',['dataMenu'=>$this->m->getMenu(), 'date'=>$date,'checkData'=>$checkData,'serviceData'=>$service,'parentSelectItem'=>$parentItem]);
       

    }
    
  // user-defined comparison function 
// based on timestamp
function date_sort($a, $b) {
    return strtotime($a) - strtotime($b);
}
 

public function insertMenuMealitem()
{
  //echo "DIVESH"; die;
            // Truncate TEMP Table
          //$this->db->query("Delete from TEMP_child_menu_item_date_mapping where 1=1");
          $service =  $this->Access_model->showAdminService();
          $loginstatus   = $this->session->userdata('logged_in'); 
          $parent_id = $loginstatus['parent_id'];
          $childName = $this->m->allChild($parent_id);
          $locid = $this->MenuItemSelModel->locbmid();
          $locationid = $locid['locid'];
       //   print_r($locationid); die;
          $checkData = $this->m->checkMenuItem($locationid);
          $selectedChild=$this->input->post('selectedChild');
          $datevalue1 = $this->input->post('DateValue1'); 
          
          $flagval = $this->input->post('flagval'); 
          $childIDS = $this->input->post('childIDS'); 
          //$childIDS = explode(',', $childIDS);
          
          $childMealData = $this->input->post('MealId');
          $childItemData = $this->input->post('ItemArray');
       // print_r($childMealData); 
//        echo "<br>--->Now Meal Data--->";
       // print_r($childItemData); die;

         // $updatechildItemData = $this->m->updatechildItemCategoryData($selectedChild);
          
          
          if($flagval == '0')
          {
                for($p = 0; $p< count($datevalue1); $p++)
                {
                  $this->db->query("Delete from child_menu_item_date_mapping where child_id='".$selectedChild."' and parent_id='".$parent_id."' and `date`='".$datevalue1[$p]."' and `locid` ='".$locationid."'");
                  $this->db->query("Delete from TEMP_child_menu_item_date_mapping where child_id='".$selectedChild."' and parent_id='".$parent_id."' and `date`='".$datevalue1[$p]."' and `locid` ='".$locationid."'");
                }
          }
          
         

          $str = " ";
          $itemdateFrom="";
          $itemdateTo="";
          $dateItemFlag = 1;

          if(is_array($childItemData))
          {
            if($flagval == '0')
            {
              for($i=0;$i<count($childItemData);$i++)
              { 
                //  echo "jgjkuislijudiur"; die;
                  for($j=0;$j<count($childItemData[$i]['ItemData']);$j++)
                  {
                    for($k=0;$k<count($childItemData[$i]['ItemData'][$j]['arryItem']);$k++)
                    {   

                     $itemDate =  $childItemData[$i]['ItemData'][$j]['arryItem'][$k]['1'];
                     //   print_r($itemDate); die;
                     if($dateItemFlag)
                     {
                         $itemdateFrom = $itemDate;
                         $dateItemFlag = 0;
                     }
                    
                    
                     $str = "'".$childItemData[$i]['ItemData']['0']['selectedChild']."','".$parent_id."','".$itemDate."','2','".$childItemData[$i]['ItemData'][$j]['CategoryID']."','".$childItemData[$i]['ItemData'][$j]['arryItem'][$k]['0']."','0','1','".$locationid."'";
                     $insertItemCategoryMeal= $this->m->insertItemCategoryMeal($str,$parent_id);
                    }

                  }
              }
              $itemdateTo = $itemDate;
            }
            
          }




           $str1 = " ";
           $insertMealId = " ";
           $mealdateFrom="";
           $mealdateTo="";
           $datemealFlag = 1;

           if(is_array($childMealData))
           {  
              if($flagval == '0')
              {
                for($k=0;$k<count($childMealData);$k++)
                {
                    for($l=0;$l<count($childMealData[$k]['Mealdata']);$l++)
                    {
                      for($m=0;$m<count($childMealData[$k]['Mealdata'][$l]['mealItem']);$m++)
                      {

                        $itemDate =  $childMealData[$k]['Mealdata'][$l]['mealItem'][$m]['1'];
                        if($datemealFlag)
                        {
                           $mealdateFrom = $itemDate;
                           $datemealFlag = 0;
                        }

                         $str1 = "'".$childMealData[$k]['Mealdata'][$l]['selectedChild']."','".$parent_id."','".$itemDate."','2','0','0','".$childMealData[$k]['Mealdata'][$l]['mealItem'][$m]['0']."','1','".$locationid."'";


                         $insertMealId= $this->m->insertMealId($str1,$parent_id);
                      }

                    }
                }
                $mealdateTo = $itemDate;
              } 
               
           }


          $arryDate = array();

          if($itemdateFrom!='')
          {
               array_push($arryDate, $itemdateFrom);
          }
          if($itemdateTo!='')
          {
                array_push($arryDate, $itemdateTo);
          }
          if($mealdateFrom!='')
          {
              array_push($arryDate, $mealdateFrom);
          }
          if($mealdateTo!='')
          {
              array_push($arryDate, $mealdateTo);
          }

          $arryDate = array_unique($arryDate); //die;
         // $arryDate1 = array_unique($arryDate);


          usort($arryDate, array($this,'date_sort'));

          $c = count($arryDate)-1;

          $fdate = $arryDate[0];
          $tdate = $arryDate[$c];



        $msg['success'] = false;
        $msg['fdate'] = $fdate;
        $msg['tdate'] = $tdate;
        $msg['selectedChild'] = $selectedChild;
        $checkNoSelection= $this->m->checkNoSelection($fdate, $tdate);
        $checkNoSelection = $checkNoSelection['count'];
            

      if($insertMealId || $insertItemCategoryMeal){
          if($checkNoSelection !=5)
          {
              $msg['noselectionflag'] = false;
          }
          else
          {
              $msg['noselectionflag'] = true;
          }
          
          $msg['success'] = true;
      }
        echo json_encode($msg);
}
  
public function reportCheckout()
{     
    //$fromdate = $this->uri->segment(3); 
    //$todate =  $this->uri->segment(4); 
    $resultdate = $this->ChildReportListModel->max_minDate();  //print_r($resultdate['mindate']); die;
    $fromdate = $resultdate['mindate'];
    $todate = $resultdate['maxdate'];
    $selectedChild = $this->uri->segment(5);

    $service =  $this->Access_model->showAdminService();
    $loginstatus   = $this->session->userdata('logged_in'); 
    $parent_id = $loginstatus['parent_id'];
    $locid = $this->ChildReportListModel->loctionId($parent_id);
    $info = $this->Signup_model->personalInfo($parent_id);


  //  print_r($loginstatus); die;
    $parentName = $this->ChildReportListModel->parentName($parent_id);
    $parentList = $this->Signup_model->parentName();

    $childName = $this->ChildReportListModel->allChild($parent_id);


    $allChild = array();
    for($i=0;$i<count($childName);$i++)
    {
       array_push($allChild,$childName[$i]['id']);
    }
    $allParent = array();
    for($i=0;$i<count($parentList);$i++)
    {
       array_push($allParent,$parentList[$i]['id']);
    }



        $childItem = $this->ChildReportListModel->Temp_itemName($parent_id,$allChild);
        $allChildName = $this->ChildReportListModel->allChildName($allParent);
      //   print_r($childItem); die;

        $allParentChild = array();
        for($i=0;$i<count($allChildName);$i++)
        {
           array_push($allParentChild,$allChildName[$i]['id']);
        }

     //   print_r($allParentChild); die;


              // if($this->input->server('REQUEST_METHOD') == 'POST'){
 //$childName
        
        $iddd =''; 
        for ($i = 0; $i < count($childName); $i++) { 
                    $iddd .= "'".$childName[$i]['id']."',";
        } 
        $iddd = rtrim($iddd,',');

                                      
        
        if($info['type'] == 'Parent')
        {
                        
                        $discount = $this->ChildReportListModel->discount($parent_id); 
                        
                        if($selectedChild!='')
                        {
                          
                            // echo   $result="and b.child_id IN('".$selectedChild."')";
                            $result="and b.child_id IN(".$iddd.")";
                        }
                        else
                        {
                        // $result = '';
                            $result="and b.child_id IN(".$iddd.")";
                        }
                        $parentName1 = $this->ChildReportListModel->parentName($parent_id);
                            if($fromdate !='' and $todate!=''){

                                $date1 = date("Y-m-d", strtotime($fromdate));
                                $date2 = date("Y-m-d", strtotime($todate));
                                $date_str = "AND b.date BETWEEN '$date1' AND '$date2'";
                            }else{
                                $date_str ='';
                            }
                           //echo $parent_id; echo $result; echo $date_str;
                        $childItem1 = $this->ChildReportListModel->Temp_itemName1($parent_id,$result,$date_str);
                        $childName1 = $this->ChildReportListModel->allChild1($parent_id,$result);


                       $this->load->view('Parent/childReportListCheckOutView',['serviceData'=>$service,
                       'parentName'=>$parentName1,'childItem'=>$childItem1,'child'=>$childName1,'personalInfo'=>$info
                        ,'date1'=>$date1,'date2'=>$date2,'discount'=>$discount, 'childIDD'=>$selectedChild]);
                       
                       
                      
                      
                  //  }


        }

        else{
               

            }
}

public function payment_status_info()
{

    /*
    //print_r($this->input->is_ajax_request());die;
    if ($this->input->is_ajax_request())
{
        //echo "Asdsadsd".$this->input->post('dateOnly');
}
echo "Asdsadsd".$this->input->post('dateOnly');
    die;
    */
   // echo "Asdsadsd".$this->input->post('dateOnly')."--".$this->input->post('childOnly');
     if ($this->input->is_ajax_request())
    {
   // echo "Asdsadsd".$this->input->post('dateOnly');
    $loginstatus   = $this->session->userdata('logged_in'); 
    $parent_id = $loginstatus['parent_id'];

    $unique_id = $parent_id.time().uniqid();

     $datevalue1 = $this->input->post('dateOnly'); 
     $childOnly = $this->input->post('childOnly'); 

    $childID = rtrim($childOnly,",");
    $childID= explode(",",$childID);

    $childID =  array_unique($childID); 
    $childID =  array_values($childID); 
    
    //array_values(a);
     $result = $this->ChildReportListModel->uniqueArchiveInst($unique_id, $datevalue1,$parent_id,$childID);


    $encodeUniqueId =  urlencode(base64_encode(trim($unique_id)));
   // print_r($encodeUniqueId); die;

     
    $msg['success'] = false;
    if($result){
            $msg['encodeUniqueId']= $encodeUniqueId;
            $msg['unique_id']=$unique_id;
            $msg['parent_id']=$parent_id;
          
            $msg['success'] = true;
    }
    echo json_encode($msg);
    //echo $msg;
    }
}

public function insertMenuMealitemFWD()
{
  //echo "DIVESH"; die;
            // Truncate TEMP Table
          //$this->db->query("Delete from TEMP_child_menu_item_date_mapping where 1=1");
          $service =  $this->Access_model->showAdminService();
          $loginstatus   = $this->session->userdata('logged_in'); 
          $parent_id = $loginstatus['parent_id'];
          $childName = $this->m->allChild($parent_id);
          $locid = $this->MenuItemSelModel->locbmid();
          $locationid = $locid['locid'];
     
          $checkData = $this->m->checkMenuItem($locationid);
          $selectedChild=$this->input->post('selectedChild');
          $datevalue1 = $this->input->post('DateValue1'); 
         


          $childMealData = $this->input->post('MealId');
          $childItemData = $this->input->post('ItemArray');
       
          
      
          for($p = 0; $p< count($datevalue1); $p++)
          {
            $this->db->query("Delete from child_menu_item_date_mapping where child_id='".$selectedChild."' and parent_id='".$parent_id."' and `date`='".$datevalue1[$p]."' and `locid` ='".$locationid."'");
            $this->db->query("Delete from TEMP_child_menu_item_date_mapping where child_id='".$selectedChild."' and parent_id='".$parent_id."' and `date`='".$datevalue1[$p]."' and `locid` ='".$locationid."'");
          }
    
          $str = " ";
          $itemdateFrom="";
          $itemdateTo="";
          $dateItemFlag = 1;
         

          if(is_array($childItemData))
          {
            
              for($i=0;$i<count($childItemData);$i++)
              { 
                //  echo "jgjkuislijudiur"; die;
                  for($j=0;$j<count($childItemData[$i]['ItemData']);$j++)
                  {
                    for($k=0;$k<count($childItemData[$i]['ItemData'][$j]['arryItem']);$k++)
                    {   

                     $itemDate =  $childItemData[$i]['ItemData'][$j]['arryItem'][$k]['1'];
                     //   print_r($itemDate); die;
                     if($dateItemFlag)
                     {
                         $itemdateFrom = $itemDate;
                         $dateItemFlag = 0;
                     }
                    
                     
                        $str = "'".$childItemData[$i]['ItemData']['0']['selectedChild']."','".$parent_id."','".$itemDate."','2','".$childItemData[$i]['ItemData'][$j]['CategoryID']."','".$childItemData[$i]['ItemData'][$j]['arryItem'][$k]['0']."','0','1','".$locationid."'";
                       
                        $insertItemCategoryMeal= $this->m->insertItemCategoryMeal($str,$parent_id);
                    }

                  }
              }

               $itemdateTo = $itemDate;
          }




           $str1 = " ";
           $insertMealId = " ";
           $mealdateFrom="";
           $mealdateTo="";
           $datemealFlag = 1;

           if(is_array($childMealData))
           {  
             
              for($k=0;$k<count($childMealData);$k++)
              {
                  for($l=0;$l<count($childMealData[$k]['Mealdata']);$l++)
                  {
                    for($m=0;$m<count($childMealData[$k]['Mealdata'][$l]['mealItem']);$m++)
                    {

                      $itemDate =  $childMealData[$k]['Mealdata'][$l]['mealItem'][$m]['1'];
                      if($datemealFlag)
                      {
                         $mealdateFrom = $itemDate;
                         $datemealFlag = 0;
                      }
                    
                       $str1 = "'".$childMealData[$k]['Mealdata'][$l]['selectedChild']."','".$parent_id."','".$itemDate."','2','0','0','".$childMealData[$k]['Mealdata'][$l]['mealItem'][$m]['0']."','1','".$locationid."'";
                       $insertMealId= $this->m->insertMealId($str1,$parent_id);
                    }

                  }
              }

              $mealdateTo = $itemDate;
           }
           
           return true;
}

public function ajaxCheck()
{
    $parentIDD = $this->input->post('parentIDD');
    $childID = $this->input->post('childID');
    $startDate = $this->input->post('startDate');
    $endDate = $this->input->post('endDate');
    $result = $this->ChildReportListModel->uncheckDate($parentIDD, $childID, $startDate, $endDate);
    $msg['success'] = false;
    if($result){
            $msg['success'] = true;
    }
    echo json_encode($msg);
}

}


?>
