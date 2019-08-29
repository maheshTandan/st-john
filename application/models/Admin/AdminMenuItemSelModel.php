<?php


class AdminMenuItemSelModel extends CI_Model {

    public function getMenu() 
    {
        return $query = $this->db->select('id, menu_name')
                        ->where('menu_name !=', '')
                        ->where('status =', 1)
                        ->group_by('menu_name')
                        ->order_by('id', 'ASC')
                        //->order_by('menu_name', 'ASC')
                        ->get('menu')->result_array();
    }

    public function getItem() 
    {
        $SQL = "select a.`id`, a.`item_name`, a.`price`
                from `item` a 
                where a.`item_name` !='' and a.`status` = 1 
                group by a.`item_name` 
                order by a.`id` ASC";
        $result = $this->db->query($SQL);
        return $result->result_array();
    }
    
    public function dataItemCategory($locationid)
    {
        $SQL = "select `id`, `category_name`
                from item_category
                where `locid` ='42480' order by `category_name` ASC";
        $result = $this->db->query($SQL);
        return $result->result_array();
    }
    
    public function locbmid()
    {
        $loginstatus   = $this->session->userdata('logged_in'); 
        $user_id =  $loginstatus['parent_id']; 
        $sql = "select locid from  user_location where userid = '$user_id' "; 
        $sql1 = $this->db->query($sql); 
        return $sql1->row_array();
    }
    
    public function checkMenuItem()
    {
        $SQL = "select * from mapping_items_category";
        $result = $this->db->query($SQL);
        return $result->result_array();
    }
    
    public function insertData($resultData) 
    {
       
        $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id'];   
        $result = $this->db->query($locidSQL);
        $result = $result->row_array();
        $createdId = "select id from user where `ref_id` = ". $loginstatus['parent_id'];  
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array();
        $arrItm = array();  print_r($resultData);
        
        $sql = "select count(*) as 'count' from mapping_items_category";
        $sql = $this->db->query($sql); 
        $count = $sql->row_array();
        
        if($count['count'] > 0)
        {
            $sqlDel = "Delete from mapping_items_category where 1=1";
            $this->db->query($sqlDel); 
        }
        
        for ($i = 0; $i < count($resultData); $i++)
        {
            for($j = 0; $j < count($resultData[$i]['ItemArry1']); $j++)
            {
               for($k= 0; $k< count($resultData[$i]['ItemArry1'][$j]['arr1']); $k++)
                {
                  
                       $data = "'".$resultData[$i]['menuID']."', '".$resultData[$i]['ItemArry1'][$j]['catagoryID']."', '".$resultData[$i]['ItemArry1'][$j]['arr1'][$k]."', '1', '".$resultid['id']."'";
                       $this->db->query('INSERT into mapping_items_category (`menu_id`, `category_id`, `item_id`, `status`, `createdby`) VALUES ('.$data.')');
                } 
            }
        }

        return true;
    }

  


         
    
//    public function checkMenuItem($locid)
//    {
//
////       $sql="select c.menu_name, c.id as 'menu_id', GROUP_CONCAT(d.item_name) as item_name, GROUP_CONCAT(d.id) as 'item_id', e.`date`, f.locid 
////                from menu_item_assign a
////                inner join menu_profile b
////                on a.menu_profile_id = b.id
////                inner join menu c
////                on c.id = b.menu_id
////                inner join item d
////                on d.id = a.item_id
////                inner join date_menuprofile_assign e
////                on e.menu_profile_id = b.id
////                inner join location_profile_mapping f
////                on f.date_menu_assign_id = e.id 
////                where f.locid = ' ".$locid."'
////                group by c.id, e.`date` order by e.`date`";  
//            $sql = "select d.`Grade_name`, b.`menu_name`, b.`id` as 'menu_id', group_concat(c.`item_name`) as 'item_name', group_concat(c.`id`) as 'item_id', a.`date`, a.`locid`
//                from menu_item_assign a
//                inner join menu b on a.`menu_id` = b.`id`
//                inner join item c on a.`item_id` = c.`id`
//                inner join `Child_Grade_Program_Selection` d on d.`id` = a.`grade_id`
//                where a.`locid` = '".$locid."'
//                group by a.`grade_id`, b.`id`, a.`date`
//                order by a.`date`"; 
//        return $this->db->query($sql)->result_array();
//
//          
//    }
    
//    public function checkMenuItemByDate($date,$locid)
//    {
//
////          $sql="select c.menu_name, c.id as 'menu_id',d.price as price, GROUP_CONCAT(d.item_name) as item_name, GROUP_CONCAT(d.id) as 'item_id', e.`date`, f.locid 
////                from menu_item_assign a
////                inner join menu_profile b
////                on a.menu_profile_id = b.id
////                inner join menu c
////                on c.id = b.menu_id
////                inner join item d
////                on d.id = a.item_id
////                inner join date_menuprofile_assign e
////                on e.menu_profile_id = b.id
////                inner join location_profile_mapping f
////                on f.date_menu_assign_id = e.id
////                where e.`date` ='".$date."' and f.locid = '".$locid."'
////                group by c.id, e.`date` order by e.`date`";
//          
//          $sql = "select IF(b.`menu_name` is NULL, 'Meal', b.`menu_name`) as 'menu_name', IF(b.`id` is NULL, '0', b.`id`) as 'menu_id', a.`meal_id`, group_concat(c.`item_name`) as 'item_name', group_concat(c.`id`) as 'item_id', a.`date`, a.`locid`
//                from menu_item_assign a
//                left join menu b on a.`menu_id` = b.`id`
//                inner join item c on a.`item_id` = c.`id`
//                where a.`date`='".$date."' and a.`locid` = '".$locid."'
//                group by b.`id`, a.`date`
//                order by a.`date`"; 
//          
//
//          return $this->db->query($sql)->result_array();
//          
//    }
//    
//    public function itemsDisablingCheck()
//    {
//       // return "Pandey";
//        $sql = "select a.`menu_id`, a.`item_id`, b.`child_id`, b.`parent_id`, b.`menu_profile_id` from
//                menu_item_assign a 
//                inner join child_menu_item_date_mapping b on a.`id` = b.`menu_profile_id`";
//        
//        return $this->db->query($sql)->result_array();
//        
//        
//    }
//    
//     public function getGrade()
//    {
//       // return "Pandey";
//        $sql = "select `id`, `Grade_name`, `price` from
//                Child_Grade_Program_Selection order by `Grade_name` ASC";
//        
//        return $this->db->query($sql)->result_array();
//        
//        
//    }
//    
//     public function getGradeByLocid($date,$locationid)
//    {
//       // return "Pandey";
//        $sql = "select a.`id`, a.`Grade_name`, a.`price` 
//                from Child_Grade_Program_Selection a
//                inner join menu_item_assign b 
//                on a.`id` = b.`grade_id`
//                where b.`locid` = '".$locationid."' and b.`date` = '".$date."'
//                group by a.`id`
//                order by a.`Grade_name` ASC";
//        
//        return $this->db->query($sql)->result_array();
//        
//        
//    }
//    
//     public function distinctGrade($locationid, $date)
//    {
//       // return "Pandey";
//        $sql = "select a.`id`, a.`Grade_name`, a.`price` 
//                from Child_Grade_Program_Selection a
//                inner join menu_item_assign b 
//                on a.`id` = b.`grade_id`
//                where b.`locid` = '".$locationid."' and b.`date` = '".$date."'
//                group by a.`id`, b.`date`
//                order by a.`Grade_name` ASC";
//        
//        return $this->db->query($sql)->result_array();
//        
//        
//    }
//    
//     public function displayDynamicMenuItem($gradeID, $date, $locid)
//    {
//       // return "Pandey";
//        $sql = "select a.`category_id`, IF(b.`menu_name` is NULL, 'Meal', b.`menu_name`) as 'menu_name', IF(b.`id` is NULL, '0', b.`id`) as 'menu_id', a.`meal_id`, group_concat(c.`item_name`) as 'item_name', group_concat(c.`id`) as 'item_id', a.`date`, a.`locid`
//               from menu_item_assign a
//               left join menu b on a.`menu_id` = b.`id`
//               inner join item c on a.`item_id` = c.`id`
//               where a.`date`='".$date."' and a.`locid` = '".$locid."'
//               group by b.`id`, a.`category_id`, a.`date`
//               order by a.`date`"; 
//          
//
//        return $this->db->query($sql)->result_array();
//        
//        
//    }
    
   
    
    
    

}

?>