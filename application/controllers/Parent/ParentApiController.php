<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParentApiController extends CI_Controller {
    
    function __construct() {
            parent::__construct();
		   date_default_timezone_set('Asia/Kolkata');
            // $this->load->model('Parent/ChildMenuItemModel','m');
               $this->load->model(array('Access_model','MenuSelection/MenuItemSelModel'));
                $this->load->model('Parent/ParentApiModel');
                $this->load->library(array('session'));
    }


    public function allApiData()
    {
        $locid = '72290';
        $service =  $this->Access_model->showAdminService();
      //  $datedata = $this->ParentApiModel->apidateData($locid);
      $dt = new DateTime;
      $datedata = array();
        $year = $dt->format('o');
        $week = $dt->format('W');
        $dtate =trim($dt->format('Y-m-d'));
        $timestamp = strtotime($dtate);
        $day = date('l', $timestamp);
   
        
       //echo $this->uri->segment(3); die;
        
       if((trim($this->uri->segment(3)))=="")
        { 
            for($i = 1; $i <= 5; $i++) 
            {
                $newdate=date("Y-m-d",strtotime($year.'W'.$week.$i));
                array_push($datedata,$newdate); 
            }
        }
        else
        {
            $urldate = (trim($this->uri->segment(3)));
            for($i = 1; $i <= 5; $i++) 
            {
                $newdate  = $urldate;
                array_push($datedata,$newdate); 
                $date = $urldate;
                $date1 = str_replace('-', '/', $date);
                $newdate = date('Y-m-d',strtotime($date1 . "+1 days"));
                $urldate = $newdate;
                
                
                //$newdate=(trim($this->uri->segment(3)));
                
            }
        } 
        
        
     //date("Y-m-d",$ts);
     
      
     
       $datecategoryarray = array();
       $datecategoryitemarray = array();
       $dateflipCategory = array();
       $ItemArray = array();
       $itemcategory =array();
       $dateflipMeal = array();
       $maincategory = array();
       
       // for($i=0; $i<count($datedata); $i++)
       // {
       //     $count =0;
       //  for($j=0;$j<count($dateCategoryName);$j++)
       //  {
       //      // print_r($datedata[0]['date']) ;
       //      if( $datedata[$i]['date'] == $dateCategoryName[$j]['date'] )
       //      {   
       //            $datecategoryarray[$datedata[$i]['date']][$count] = array($dateCategoryName[$j]['category']);
               
       //          $dateflipCategory[$datedata[$i]['date']][$count] = array_flip($datecategoryarray[$datedata[$i]['date']][$count]);
       //          //  print_r( $datecategoryarray[$datedata[$i]['date']][$count]);
       //          // for($m=0;$m<count($dateflipCategory[$datedata[$i]['date']]);$m++)
       //          // {
       //          //    for($n=0;$n<count($dateItemCategoryName);$n++)
       //          //  {
       //          //    // print_r($dateflipCategory[$datedata[$i]['date']][$m]) ;
       //          //     if($dateflipCategory[$datedata[$i]['date']][$m] == $dateItemCategoryName[$n]['category'])
       //          //     {
       //          //         echo "fghjh";
       //          //     }

       //          //  } 

       //          // }
                     
       //            $count++;
       //        }
                  
               
       //      }
         
        
       //  }

       // foreach ($dateflipCategory as $key1 => $value1) 
       // {

       //    foreach ($value1 as $key2 => $value2)
       //       {
       //          // print_r($value1[$key2]); 
                
       //          foreach ($value2 as $key3 => $value3)
       //           {
       //               print_r($value2[$key3]);
                 
       //             // $value2 = '';
       //               $itemcategory = array();
       //              foreach ($dateItemCategoryName as $key4 => $value4)
       //              {
                         
       //                  if($key3 == $value4['category'])
       //                  {
       //                    //print_r($value3);
       //                   //  $value3 = array($value4['item']);
       //                    // $itemcategory = array();
       //                      array_push($itemcategory, $value4['item']);
                                                        

       //                  }
       //              }
       //              array_push($value2 , $itemcategory);
       //              // $value2 = $itemcategory;
       //              print_r($value2);

       //          }
       //         //  array_push($value1 , $value2);
       //       }
       //    // array_push($dateflipCategory , $value1);
       // }

       
  $count = 0;
    for($i=0;$i<count($datedata);$i++)
    {
         $datecategoryarray =  array_fill_keys(array($datedata[$i]), '');
         $dateCategoryName = $this->ParentApiModel->apiCategoryName($locid,$datedata[$i]);

        $itemcategory=array();
      for($j=0;$j<count($dateCategoryName);$j++)
      {

     
       $dateflipCategory =  array_fill_keys(array($dateCategoryName[$j]['category']), '');

         $dateItemCategoryName = $this->ParentApiModel->apiItemCategoryName($locid,$dateCategoryName[$j]['category'],$datedata[$i]);
           for($m=0;$m<count($dateItemCategoryName);$m++)
        {

            $dateItemCategoryName[$m]['type'] = 'C';
        }
      
        $dateflipCategory[$dateCategoryName[$j]['category']]=$dateItemCategoryName;
        array_push($itemcategory, $dateflipCategory);
       
      }

      $mealName = $this->ParentApiModel->apiMealName($locid,$datedata[$i]);

      for($k=0;$k<count($mealName);$k++)
      {
        $dateflipMeal =  array_fill_keys(array($mealName[$k]['meal']), '');
        $mealItemCategaorydata = $this->ParentApiModel->apiItemMealData($locid,$mealName[$k]['meal']);
      //  array_push($mealItemCategaorydata[$k], 'type'=>'M');

        for($l=0;$l<count($mealItemCategaorydata);$l++)
        {

            $mealItemCategaorydata[$l]['type'] = 'M';
        }
      
         $dateflipMeal[$mealName[$k]['meal']]=$mealItemCategaorydata;
        array_push($itemcategory, $dateflipMeal);
      }
      
        $datecategoryarray[$datedata[$i]]=$itemcategory;
        array_push($ItemArray, $datecategoryarray);
 
    }
     $maincategory =  array_fill_keys(array('maincategory'), '');

     $maincategory['maincategory'] = $ItemArray;
    
      echo json_encode($maincategory);
    	// $this->load->view('Parent/ParentApiView',['serviceData'=>$service]);
    }



}

?>
