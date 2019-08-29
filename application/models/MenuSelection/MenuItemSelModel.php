<?php

function array_push_assoc($array, $key, $value){
$array[$key] = $value;
return $array;
}

class MenuItemSelModel extends CI_Model {

    public function getMenu() {
        return $query = $this->db->select('id, menu_name')
                        ->where('menu_name !=', '')
                        ->where('status =', 1)
                        ->group_by('menu_name')
                        ->order_by('id', 'ASC')
                        //->order_by('menu_name', 'ASC')
                        ->get('menu')->result_array();
    }

    public function getItem($locationid) {
//        return $query = $this->db->select('id, item_name,price')
//                        ->where('item_name !=', '')
//                        ->where('status =', 1)
//                        ->group_by('item_name')
//                        ->order_by('id', 'ASC')
//                        //->order_by('item_name', 'ASC')
//                        ->get('item')->result_array();
//        
        
//        $SQL = "select a.`id`, a.`item_name`, IF(b.`price` is NULL, IFNULL(a.`price`,0), IFNULL(b.`price`,0)) as 'price'
//                from `item` a 
//                left join menu_item_assign b on a.`id` = b.`item_id`
//                where 
//                a.`item_name` !='' and a.`status` = 1 
//                group by a.`item_name` 
//                order by a.`id` ASC";
        
        $SQL = "select a.`id`, a.`item_name`, a.`category_id`, b.`category_name`, a.`price`, a.`locid`,a.`status` 
                from item a 
                inner join item_category b on a.`category_id`=b.`id`
                where a.`status`=1 and a.`locid` IN ('','".$locationid."')";
        $result = $this->db->query($SQL);
        return $result->result_array();
        
        
    }
    
        public function dataItemCategory($locationid){
    
        $SQL = "select `id`, `category_name`
                from item_category
                order by `category_name` ASC";
        $result = $this->db->query($SQL);
        return $result->result_array();
        
        
    }

    public function insertData($resultData, $date, $grade, $interval) {
        
        
        if(!is_array($grade))
        {
            $grade = explode(',', $grade);
        }
       
        $grade1 = $grade;
        $gradeRes =[];
          
        for($i=0;$i<count($grade1);$i++)
        {
            $sql = "select id from Classes where Grade_id ='".$grade1[$i]."' AND (`UNIT`= 'RELIGIOUSED2018' OR `UNIT`='SCHOOL2018') "; 
             $res = $this->db->query($sql);
              $res = $res->result_array();
                
                for($j=0;$j<count($res);$j++)
                {
                    array_push($gradeRes,$res[$j]);
                }
                
        }
        
        $grade = $gradeRes;
     //  print_r($grade);
        
      // die;
        
        
        $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id'];   
        $result = $this->db->query($locidSQL);
        $result = $result->row_array();
        $createdId = "select id from user where `ref_id` = ". $loginstatus['parent_id'];  
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array();
        $arrItm = array();

         
        $date = strtotime($date);
       // $date = strtotime("+7 day", $date);  
    if( isset($interval))
    {
        for ($a = 0; $a < $interval; $a++)
        {
           $date1 = "";
          $date1 = strtotime("+$a day", $date);  
          $dateItem = date('Y-m-d',$date1);
         
          for ($i = 0; $i < count($resultData); $i++)
          {
              for($j = 0; $j < count($resultData[$i]['ItemArry1']); $j++)
              {
                  for($k= 0; $k< count($resultData[$i]['ItemArry1'][$j]['arr1']); $k++)
                  {
                     for($l = 0; $l < count($grade); $l++)
                      {
                          $data = "'".$grade[$l]['id']."','".$resultData[$i]['menuID']."', '".$resultData[$i]['ItemArry1'][$j]['catagoryID']."', '".$resultData[$i]['ItemArry1'][$j]['arr1'][$k]."', '".$resultData[$i]['ItemArry1'][$j]['mealID']."', '".$result['locid']."', '".$dateItem."','1', '".$resultid['id']."'";
                       //   echo $data; die;
                          $this->db->query('INSERT into menu_item_assign (`grade_id`, `menu_id`, `category_id`, `item_id`, `meal_id`,  `locid`, `date`, `status`, `createdby`) VALUES ('.$data.')');
                      }
                  } 
              }
          }
        }
    }
    else{
       
        $date = date('Y-m-d',$date);
         //echo $date;  die;
        for($l = 0; $l < count($grade); $l++)
        {
            $sql1 = "DELETE FROM menu_item_assign WHERE `grade_id`='".$grade[$l]['id']."' and `date`='".$date."'";
            $this->db->query($sql1);
        }
        
        for ($i = 0; $i < count($resultData); $i++)
        {
            for($j = 0; $j < count($resultData[$i]['ItemArry1']); $j++)
            {
                for($k= 0; $k< count($resultData[$i]['ItemArry1'][$j]['arr1']); $k++)
                {
                   for($l = 0; $l < count($grade); $l++)
                    {
                     
                        $data = "'".$grade[$l]['id']."','".$resultData[$i]['menuID']."', '".$resultData[$i]['ItemArry1'][$j]['catagoryID']."', '".$resultData[$i]['ItemArry1'][$j]['arr1'][$k]."', '".$resultData[$i]['ItemArry1'][$j]['mealID']."', '".$result['locid']."', '".$date."','1', '".$resultid['id']."'";
                      $this->db->query('INSERT into menu_item_assign (`grade_id`, `menu_id`, `category_id`, `item_id`, `meal_id`,  `locid`, `date`, `status`, `createdby`) VALUES ('.$data.')'); 
                    }
                } 
            }
        }

    }
    
        return true;
    }



    public function locbmid()
    {

          $loginstatus   = $this->session->userdata('logged_in'); 
      //   print_r($loginstatus); die;
             $user_id =  $loginstatus['parent_id']; 


             $sql = "select locid from  user_location where userid = '$user_id' "; 
               $sql1 = $this->db->query($sql); 

             //  print_r($sql1); die;
               return $sql1->row_array();
    }
    
    public function checkMenuItem($locid)
    {

            $sql = "select d.`Grade_name`, b.`menu_name`, b.`id` as 'menu_id', group_concat(' ',c.`item_name`) as 'item_name', group_concat(c.`id`) as 'item_id', a.`date`, a.`locid`
                from menu_item_assign a
                inner join menu b on a.`menu_id` = b.`id`
                inner join item c on a.`item_id` = c.`id`
                inner join `Child_Grade_Program_Selection` d on d.`id` = a.`grade_id`
                where a.`locid` = '".$locid."'
                group by  b.`id`, a.`date`
                order by a.`date`"; 
        return $this->db->query($sql)->result_array();

          
    }
    
    public function checkMenuItemByDate($date,$locid)
    {

//          $sql="select c.menu_name, c.id as 'menu_id',d.price as price, GROUP_CONCAT(d.item_name) as item_name, GROUP_CONCAT(d.id) as 'item_id', e.`date`, f.locid 
//                from menu_item_assign a
//                inner join menu_profile b
//                on a.menu_profile_id = b.id
//                inner join menu c
//                on c.id = b.menu_id
//                inner join item d
//                on d.id = a.item_id
//                inner join date_menuprofile_assign e
//                on e.menu_profile_id = b.id
//                inner join location_profile_mapping f
//                on f.date_menu_assign_id = e.id
//                where e.`date` ='".$date."' and f.locid = '".$locid."'
//                group by c.id, e.`date` order by e.`date`";
          
          $sql = "select IF(b.`menu_name` is NULL, 'Meal', b.`menu_name`) as 'menu_name', IF(b.`id` is NULL, '0', b.`id`) as 'menu_id', a.`meal_id`, group_concat(c.`item_name`) as 'item_name', group_concat(c.`id`) as 'item_id', a.`date`, a.`locid`
                from menu_item_assign a
                left join menu b on a.`menu_id` = b.`id`
                left join item c on a.`item_id` = c.`id`
                where a.`date`='".$date."' and a.`locid` = '".$locid."'
                group by b.`id`, a.`date`
                order by a.`date`"; 
          

          return $this->db->query($sql)->result_array();
          
    }
    
    public function itemsDisablingCheck()
    {
       // return "Pandey";
        $sql = "select a.`menu_id`, a.`item_id`, b.`child_id`, b.`parent_id`, b.`menu_profile_id` from
                menu_item_assign a 
                inner join child_menu_item_date_mapping b on a.`id` = b.`menu_profile_id`";
        
        return $this->db->query($sql)->result_array();
        
        
    }
    
     public function getGrade()
    {
       // return "Pandey";
//     $sql = "select a.`id`, trim(concat(trim(b.`Name`),'-',trim(a.`Grade`),'-', trim(a.`Name`))) as 'Grade_name'
//                from Classes a 
//                inner join Unit b 
//                on a.`Unit_id` = b.`id` 
//                order by `Grade_name` ASC"; 
      // where a.`UNIT`= 'RELIGIOUSED2018' OR a.`UNIT`='SCHOOL2018'
     
     
        $sql = "select a.`id` as id,  trim(a.`Grade_name`) as 'Grade_name' from Child_Grade_Program_Selection a" ; 
        
        return $this->db->query($sql)->result_array();
        
        
    }
    
    public function getGradeByDate($date)
    {
//        $sql = "select A.`grade_id` as 'id', A.`Grade_name` 
//                from (select a.`id` as 'grade_id', trim(concat(trim(b.`Name`),'-',trim(a.`Grade`),'-', trim(a.`Name`))) as 'Grade_name'
//                from Classes a 
//                inner join Unit b 
//                on a.`Unit_id` = b.`id` 
//                where a.`type`= 'Religious') A
//                inner join menu_item_assign B
//                on B.`grade_id` = A.`grade_id`
//                where B.`date` = '".$date."' 
//                group by A.`Grade_name` order by A.`Grade_name`";
        
//        $sql = "select distinct b.`Grade_id` as id from menu_item_assign a inner join Classes b on
//                a.`grade_id` = b.`id` where a.`date` = '".$date."' ";
//             $result =  $this->db->query($sql)->result_array();
//            //   print_r($result); die;
        
         $sql1 = "select a.`Grade_id` as id,  trim(a.`Grade`) as 'Grade_name' "
                 . "from Classes a  "
                 . "inner join menu_item_assign B ON  a.`Grade_id` = B.`grade_id`"
                 . " where B.`date` = '".$date."' " ; 
        
        return $this->db->query($sql1)->result_array();
    }
    
     public function getGradeByLocid($date,$locationid)
    {
       // return "Pandey";
        $sql = "select a.`id`, a.`Grade_name`, a.`price` 
                from Child_Grade_Program_Selection a
                inner join menu_item_assign b 
                on a.`id` = b.`grade_id`
                where b.`locid` = '".$locationid."' and b.`date` = '".$date."'
                group by a.`id`
                order by a.`Grade_name` ASC";
        
        return $this->db->query($sql)->result_array();
        
        
    }
    
     public function distinctGrade($locationid, $date)
    {
       // return "Pandey";
        $sql = "select a.`id`, a.`Grade_name`, a.`price` 
                from Child_Grade_Program_Selection a
                inner join menu_item_assign b 
                on a.`id` = b.`grade_id`
                where b.`locid` = '".$locationid."' and b.`date` = '".$date."'
                group by a.`id`, b.`date`
                order by a.`Grade_name` ASC";
        
        return $this->db->query($sql)->result_array();
        
        
    }
    
     public function displayDynamicMenuItem($gradeID, $date, $locid)
    {
       // return "Pandey";
         
        // print_r($gradeID); die;
        
          $grade='';
       
            $sql = "select id from Classes where Grade_id ='".$gradeID."'"; 
             $res = $this->db->query($sql);
              $res = $res->result_array();
            $data = '';
             for($i=0;$i<count($res);$i++)
             {
                 $data .= $res[$i]['id'].',';
             }
                
              $grade =  rtrim($data, ',');
        
         
        $sql = "select a.`category_id`, IF(b.`menu_name` is NULL, 'Meal', b.`menu_name`) as 'menu_name', IF(b.`id` is NULL, '0', b.`id`) as 'menu_id', a.`meal_id`, group_concat(c.`item_name`) as 'item_name', group_concat(c.`id`) as 'item_id', a.`date`, a.`locid`
               from menu_item_assign a
               left join menu b on a.`menu_id` = b.`id`
               inner join item c on a.`item_id` = c.`id`
               where a.`date`='".$date."' and a.`locid` = '".$locid."' and a.`grade_id` IN (".$grade.")
               group by b.`id`, a.`category_id`, a.`date`
               order by a.`date`"; 
          

        return $this->db->query($sql)->result_array();
        
        
    }
    
      public function displayDynamicMealItem($gradeID, $date, $locid)
    {
       // return "Pandey";
     //  print_r($gradeID); die;
           $grade='';
       
            $sql = "select id from Classes where Grade_id ='".$gradeID."'"; 
             $res = $this->db->query($sql);
              $res = $res->result_array();
            $data = '';
             for($i=0;$i<count($res);$i++)
             {
                 $data .= $res[$i]['id'].',';
             }
                
              $grade =  rtrim($data, ',');
          
          
        $sql = "select a.`category_id`, IF(b.`menu_name` is NULL, 'Meal', b.`menu_name`) as 'menu_name', a.`menu_id`, a.`meal_id`, IF(c.`item_name` is NULL, '', c.`item_name`) as 'item_name', a.`item_id`, a.`date`, a.`locid`, a.`grade_id`
               from menu_item_assign a
               left join menu b on a.`menu_id` = b.`id`
               left join item c on a.`item_id` = c.`id`
               where a.`date`='".$date."' and a.`locid` = '".$locid."' and a.`meal_id` != 0 and a.`grade_id` IN (".$grade.")
               order by a.`date`"; 
          

        return $this->db->query($sql)->result_array();
        
        
    }
    
    public function mealData($date,$locationid)
    {
        $sql = "select '0' as `category_id`, c.`meal_name`,c.price as meal_price, a.`meal_id`, group_concat(b.`item_name`) as 'item_name', group_concat(a.`item_id`) as 'item_id', group_concat(b.`price`) as 'price' from 
                meal_item_mapping a
                inner join `item` b on b.`id` = a.`item_id`
                inner join `meal_plan` c on c.`id` = a.`meal_id`
                where a.`locid` = '".$locationid."' and c.status = 1
                group by a.`meal_id`"; 
          

        return $this->db->query($sql)->result_array();
    }
    

    public function searchItemMenuList($searchItem, $locationid, $category_id)
    {
        $SQL = "select a.`id`, a.`item_name`, a.`category_id`, b.`category_name`, a.`price`, a.`locid`,a.`status` 
                from item a 
                inner join item_category b on a.`category_id`=b.`id`
                where a.`status`=1 and a.`locid` IN ('','".$locationid."') and a.`category_id`=".$category_id." and a.`item_name` like '%$searchItem%'";
        $result = $this->db->query($SQL);
        return $result->result_array();
    }

     public function checkMenuItemByDateHotLunch($locid)
    {

//          $sql="select c.menu_name, c.id as 'menu_id',d.price as price, GROUP_CONCAT(d.item_name) as item_name, GROUP_CONCAT(d.id) as 'item_id', e.`date`, f.locid 
//                from menu_item_assign a
//                inner join menu_profile b
//                on a.menu_profile_id = b.id
//                inner join menu c
//                on c.id = b.menu_id
//                inner join item d
//                on d.id = a.item_id
//                inner join date_menuprofile_assign e
//                on e.menu_profile_id = b.id
//                inner join location_profile_mapping f
//                on f.date_menu_assign_id = e.id
//                where e.`date` ='".$date."' and f.locid = '".$locid."'
//                group by c.id, e.`date` order by e.`date`";
          
        $sql = "select `date`, group_concat(`item_name`) as 'item_name', group_concat(`item_id`) as 'item_id' from (select IF(b.`menu_name` is NULL, 'Meal', b.`menu_name`) as 'menu_name', IF(b.`id` is NULL, '0', b.`id`) as 'menu_id', a.`meal_id`, IF( b.`menu_name` is NULL, d.`meal_name`, c.`item_name` ) as 'item_name', c.`id` as 'item_id', a.`date`, a.`locid`
                from menu_item_assign a
                left join menu b on a.`menu_id` = b.`id`
                left join item c on a.`item_id` = c.`id`
                left join meal_plan d on d.id = a.`meal_id`
                where a.`locid` = '".$locid."'
                group by  a.`date`
                order by a.`date`) A group by `date`"; 
          

          return $this->db->query($sql)->result_array();
          
    }



    public function startLastDate($locationid)
    {

       $sql = "select max(start_date) as start_date,max(end_date) as end_date  from parent_date_cal_oneMonth_restriction
              where locid='".$locationid."' and status = '1' "; 
       return $this->db->query($sql)->result_array();
          

    }
    
    

    

}

?>
