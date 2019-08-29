<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChildMonthlyCalendarController extends CI_Controller {
    
    function __construct() {
            parent::__construct();
		   date_default_timezone_set('Asia/Kolkata');
            $this->load->model('Parent/ChildMonthlyModel','m');
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


    public function monthlyView()
    {


         $service =  $this->Access_model->showAdminService();
         $loginstatus   = $this->session->userdata('logged_in'); 
         $parent_id = $loginstatus['parent_id'];
         $childName = $this->m->allChild($parent_id);
         
         $locid = $this->MenuItemSelModel->locbmid();
         $locationid = $locid['locid'];

         $monthDate = $this->MenuItemSelModel->startLastDate($locationid);

         $date =  urldecode($this->uri->segment(3));     
      //  $checkData = $this->m->checkMenuItem($locationid);
      // print_r($loginstatus); die;
        
          $status = $this->BmTeacherReportModel->activateDeactivateCal();
         $start_Date = $monthDate[0]['start_date']; 
         $end_date = $monthDate[0]['end_date'];

       //  print_r($start_Date); die;
        

         $this->load->view('Parent/parentMonthlyView',['serviceData'=>$service,'menuObj'=>$this->m->getMenu(), 'dataItem'=>$this->m->getItem(), 'date'=>$date, 'child'=>$childName,'start_Date'=>$start_Date,'end_date'=>$end_date, 'parent_id'=>$parent_id, 'status'=>$status['status']]);

    }

    public function categoryItemMeal()
    {
        
        $childId = $this->input->post('selectedChild');
        $parentIDD = $this->input->post('parentIDD');
        $startDate = $this->input->post('startDate');


      //  echo $startDate; die;
        $endDate = $this->input->post('endDate');
        $childDateItem = $this->input->post('DateValue1');
        $checkMealItemData  = $this->m->checkMealItemData($childId,$childDateItem);

      //  print_r($checkMealItemData); die;

        $selectMealItemDataChild = $this->m->childMealItemData($childId);   //for selected meal by child
        $category = $this->m->category($childId,$childDateItem);

      

      //  $uncheckDate = $this->ChildReportListModel->uncheckDate($parentIDD, $childId, $startDate, $endDate);
       
        for($i=0;$i<count($checkMealItemData);$i++)             
         {
           $arrItem = explode(",", $checkMealItemData[$i]['item']);
           $arrPrice = explode(",", $checkMealItemData[$i]['price']);
           $checkMealItemData[$i]['item'] = $arrItem;
           $checkMealItemData[$i]['price'] = $arrPrice;
         
         }
                // print_r($checkMealItemData); die;
  
      $checkCategoryItemData = $this->m->checkCategoryItemData($childId,$childDateItem);
      $selectCategoryItemDataChild = $this->m->childCategoryItemData($childId);
      $selectNoMealItemDataChild = $this->m->childNOMealItemData($childId);    

    
      $data['category'] = $category;
      $data['checkMealItemData'] = $checkMealItemData;
      $data['selectMealItemDataChild'] = $selectMealItemDataChild;
      $data['checkCategoryItemData'] = $checkCategoryItemData;
      $data['selectCategoryItemDataChild'] = $selectCategoryItemDataChild;
      $data['selectNoMealItemDataChild'] = $selectNoMealItemDataChild;
     // $data['uncheckDate'] = $uncheckDate;
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
          $childmilkData = $this->input->post('milkItemArray');
          $childdrinkData = $this->input->post('drinkItemArray');
          $childNoMealData = $this->input->post('noMealItemArray');
          
            
      
     
           
          
          if($flagval == '0')
          {
                  $dateDeleteItem= array();
              for($i=0;$i<count($datevalue1);$i++)
              {

                 $dateItem=date("Y-m-d",strtotime($datevalue1[$i]));
                 array_push($dateDeleteItem, $dateItem);
              }
          

                for($p = 0; $p< count($dateDeleteItem); $p++)
                {
                  

                  $this->db->query("Delete from child_menu_item_date_mapping where child_id='".$selectedChild."' and parent_id='".$parent_id."' and `date`='".$dateDeleteItem[$p]."' and `locid` ='".$locationid."'"); 


                  $this->db->query("Delete from TEMP_child_menu_item_date_mapping where child_id='".$selectedChild."' and parent_id='".$parent_id."' and `date`='".$dateDeleteItem[$p]."' and `locid` ='".$locationid."'");

                  // echo "Delete from ARCHIVE_child_menu_item_date_mapping where child_id='".$selectedChild."' and parent_id='".$parent_id."' and `date`='".$dateDeleteItem[$p]."' and `locid` ='".$locationid."' and `paymentStatus`<>'Success'"; die;

                   $this->db->query("Delete from ARCHIVE_child_menu_item_date_mapping where child_id='".$selectedChild."' and parent_id='".$parent_id."' and `date`='".$dateDeleteItem[$p]."' and `locid` ='".$locationid."' and `paymentStatus` <> 'Success'");
                }
          }
          
          
        ////////// code for  insert  A or B sides in database 


          if(is_array($childItemData))
          {
            
              for($i=0;$i<count($childItemData);$i++)
              { 
               
                  for($j=0;$j<count($childItemData[$i]['ItemData']);$j++)
                  {
                    for($k=0;$k<count($childItemData[$i]['ItemData'][$j]['arryItem']);$k++)
                    {   

                     $itemDate =  $childItemData[$i]['ItemData'][$j]['arryItem'][$k]['1'];
                    
                    
                     $str = "'".$childItemData[$i]['ItemData']['0']['selectedChild']."','".$parent_id."','".$itemDate."','2','".$childItemData[$i]['ItemData'][$j]['CategoryID']."','".$childItemData[$i]['ItemData'][$j]['arryItem'][$k]['0']."','0','0','1','".$locationid."'";

                     $insertItemCategoryMeal= $this->m->insertItemCategoryMeal($str,$parent_id);
                    }

                  }
              }
             
            
          }


        ////////// code for  insert meal A or B in database 

        //  print_r($childMealData); die;

           $insertMealId = false;
           if(is_array($childMealData))
           {  
                for($k=0;$k<count($childMealData);$k++)
                {
                    for($l=0;$l<count($childMealData[$k]['Mealdata']);$l++)
                    {
                      for($m=0;$m<count($childMealData[$k]['Mealdata'][$l]['mealItem']);$m++)
                      {

                        $itemDate =  $childMealData[$k]['Mealdata'][$l]['mealItem'][$m]['1'];
                         
                         $mealPrice ='';
                        if($childMealData[$k]['Mealdata'][$l]['mealItem'][$m]['0'] !=0)
                        {
                          $mealID = $childMealData[$k]['Mealdata'][$l]['mealItem'][$m]['0'];
                          $mealPrice = $this->m->findMealPrice($mealID);

                         // print_r($mealPrice); die;
                        }

                         $str1 = "'".$childMealData[$k]['Mealdata'][$l]['selectedChild']."','".$parent_id."','".$itemDate."','2','0','0','".$childMealData[$k]['Mealdata'][$l]['mealItem'][$m]['0']."','".$mealPrice['price']."','1','".$locationid."'";


                         $insertMealId= $this->m->insertMealId($str1,$parent_id);
                      }

                    }
                }
               
           }




     ////////// code for  insert milk and extra milk in database 

           $insertItemMilkCategoryMeal = false;

        //  print_r($childmilkData); die;

            if(is_array($childmilkData))
          {
            
              for($i=0;$i<count($childmilkData);$i++)
              { 
                //  echo "jgjkuislijudiur"; die;
                  for($j=0;$j<count($childmilkData[$i]['milkItemData']);$j++)
                  {
                    for($k=0;$k<count($childmilkData[$i]['milkItemData'][$j]['arryMilkItem']);$k++)
                    {   

                     $itemMilkDate =  $childmilkData[$i]['milkItemData'][$j]['arryMilkItem'][$k]['1'];


                     $mealFindID = $this->m->checkMealONMilkDate($itemMilkDate);

                  //   print_r($mealFindID); die;
                    
                     $milkPrice ='';
                        if($mealFindID['meal_id']==0)
                        {
                         
                            $milkPrice = 0.50;
                            $str = "'".$childmilkData[$i]['milkItemData']['0']['selectedChild']."','".$parent_id."','".$itemMilkDate."','2','".$childmilkData[$i]['milkItemData'][$j]['CategoryMilkID']."','".$childmilkData[$i]['milkItemData'][$j]['arryMilkItem'][$k]['0']."','0','".$milkPrice."','1','".$locationid."'";
                         
                        }
                        else
                        {
                          $milkID = $childmilkData[$i]['milkItemData'][$j]['arryMilkItem'][$k]['0'];
                          $milkPrice = $this->m->findMilkPrice($milkID);

                     

                          $str = "'".$childmilkData[$i]['milkItemData']['0']['selectedChild']."','".$parent_id."','".$itemMilkDate."','2','".$childmilkData[$i]['milkItemData'][$j]['CategoryMilkID']."','".$childmilkData[$i]['milkItemData'][$j]['arryMilkItem'][$k]['0']."','0','".$milkPrice['price']."','1','".$locationid."'";
                        }

                      


                     $insertItemMilkCategoryMeal= $this->m->insertMilkCategoryMeal($str,$parent_id);
                    }

                  }
              }
            
            
          }





     ////////// code for  insert drink for friday in database 


              $insertItemdrinkCategoryMeal = false;
            if(is_array($childdrinkData))
          {
            
              for($i=0;$i<count($childdrinkData);$i++)
              { 
                
                  for($j=0;$j<count($childdrinkData[$i]['drinkItemData']);$j++)
                  {
                    for($k=0;$k<count($childdrinkData[$i]['drinkItemData'][$j]['arryDrinkItem']);$k++)
                    {   

                     $itemdrinkDate =  $childdrinkData[$i]['drinkItemData'][$j]['arryDrinkItem'][$k]['1'];


                   $mealFindID = $this->m->checkMealONDrinkDate($itemdrinkDate);
                 // print_r($mealFindID); die;

                    $drinkPrice ='';

                        if(empty($mealFindID))
                        {
                               $drinkPrice = 0.50;
                           
                          $str = "'".$childdrinkData[$i]['drinkItemData']['0']['selectedChild']."','".$parent_id."','".$itemdrinkDate."','2','".$childdrinkData[$i]['drinkItemData'][$j]['CategorydrinkID']."','".$childdrinkData[$i]['drinkItemData'][$j]['arryDrinkItem'][$k]['0']."','0','".$drinkPrice."','1','".$locationid."'"; 
                        }
                
                        else if($mealFindID['0']['meal_id']==0)
                        {
                         
                            $drinkPrice = 0.50;
                           
                          $str = "'".$childdrinkData[$i]['drinkItemData']['0']['selectedChild']."','".$parent_id."','".$itemdrinkDate."','2','".$childdrinkData[$i]['drinkItemData'][$j]['CategorydrinkID']."','".$childdrinkData[$i]['drinkItemData'][$j]['arryDrinkItem'][$k]['0']."','0','".$drinkPrice."','1','".$locationid."'"; 
                         
                        }
                        else
                        {
                            $drinkID = $childdrinkData[$i]['drinkItemData'][$j]['arryDrinkItem'][$k]['0'];
                          $drinkPrice1 = $this->m->findDrinkPrice($drinkID);

                  //    print_r($drinkPrice1); die;

                     $str = "'".$childdrinkData[$i]['drinkItemData']['0']['selectedChild']."','".$parent_id."','".$itemdrinkDate."','2','".$childdrinkData[$i]['drinkItemData'][$j]['CategorydrinkID']."','".$childdrinkData[$i]['drinkItemData'][$j]['arryDrinkItem'][$k]['0']."',0,'".$drinkPrice1['0']['price']."','1','".$locationid."'";  

                       
                        }
                    

                   

                     $insertItemdrinkCategoryMeal= $this->m->insertdrinkCategoryMeal($str,$parent_id);
                    }

                  }
              }
            
          }




         
     ////////// code for  insert no meal item data in database 


            $insertNoMealCategoryMeal = false;
            if(is_array($childNoMealData))
          {
            
              for($i=0;$i<count($childNoMealData);$i++)
              { 
                
                  for($j=0;$j<count($childNoMealData[$i]['noMealItemData']);$j++)
                  {
                    for($k=0;$k<count($childNoMealData[$i]['noMealItemData'][$j]['arrynomealItem']);$k++)
                    {   

                     $nomealitemDate =  $childNoMealData[$i]['noMealItemData'][$j]['arrynomealItem'][$k]['1'];
                    
                    
                   $str = "'".$childNoMealData[$i]['noMealItemData']['0']['selectedChild']."','".$parent_id."','".$nomealitemDate."','2','0','".$childNoMealData[$i]['noMealItemData'][$j]['arrynomealItem'][$k]['0']."','0',0,'1','".$locationid."'";

                     $insertNoMealCategoryMeal= $this->m->noMealItemCategoryMeal($str,$parent_id);
                    }

                  }
              }
       
            
          }


        $msg['success'] = false;
        
      if($insertMealId  || $insertItemMilkCategoryMeal || $insertItemdrinkCategoryMeal || $insertNoMealCategoryMeal){
          
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
        // print_r($childItem);

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

public function qty_insert_TEMP()
{
    $resultData = $this->input->post('DataArry1');
    $result = $this->ChildReportListModel->qtyInsert($resultData);
    $msg['success'] = false;
    if($result){
            $msg['success'] = true;
    }
    echo json_encode($msg);
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


//////////// if meal data not save then checkout button not worked
public function checkMealAviable()
{


    $childID = $this->input->post('selectedChild');
    $resultChild = $this->m->checkMealForCheckout($childID);
              

    $resultChildArray = explode (",", $resultChild);
     
   // print_r($resultChildArray); die;

    $msg['success'] = false;
    if(count($resultChildArray) == 0 || $resultChildArray[0]== '')
    {
      $msg['resultChildArray'] = $resultChildArray;
      $msg['success'] = true;
    }
    else if(count($resultChildArray) < count($childID)){

    $msg['resultChildArray'] = $resultChildArray;
    $msg['success'] = true;
  
    }
    else{
       $msg['success'] = false;
    }

       echo json_encode($msg);

 
}



public function checkMealAviableOnChangeChild()
{
    $childID = $this->input->post('selectedChild');
    $result = $this->m->checkMealForChangechildCheckout($childID);
    
    $childName = $this->m->childNameForMealSave($childID);
   
    $msg['success'] = false;
    if($result == 1)
    {
       $msg['childName']= $childName['first_name'];
       $msg['childID']=  $childID;
      $msg['success'] = true;
    }
    else{
      $msg['childName']= $childName['first_name'];
      $msg['childID']=  $childID;
    $msg['success'] = false;
  
    }
   
       echo json_encode($msg);

}






}


?>
