<?php

class ChildMenuItemModel extends CI_Model {
  
    public function getMenu()
    {
        

    return $query = $this->db->select('id, menu_name')
                        ->where('menu_name !=', '')
                        ->where('status =', 1)
                        ->group_by('menu_name')
                        ->order_by('menu_name', 'ASC')
                        ->get('menu')->result_array();
      

        
//       $sql = "select *";
//       $sql1 = $this->db->query($sql); 
//       return $row = $sql1->result_array();
//        //echo $childid; die;
//        $this->db->select('a.`menu_id` as id, b.menu_name');
//        $this->db->from('menu_item_assign as a');
//        $this->db->join('menu as b', 'a.menu_id = b.id');
//        $this->db->group_by(array("b.menu_name"));
//        $this->db->order_by('b.menu_name', 'ASC');
//        return $query = $this->db->get()->result_array();

    }
    
    public function getItem()
    { 
       return $query = $this->db->select('id, item_name,price')
                        ->where('item_name !=', '')
                        ->where('status =', 1)
                        ->group_by('item_name')
                        ->order_by('item_name', 'ASC')
                        ->get('item')->result_array();

                        
    }
    
    public function getAllChildren($parentID)
    {
        $this->db->select('id, first_name');
        $this->db->from('person_details');
        $this->db->where('parent_id =',$parentID);

         $this->db->where("parent_relation='child'");

        $this->db->order_by('first_name', 'ASC');
        return $query = $this->db->get()->result_array();
    }
    

    public function getAllChildrenMenuItem($parentID)
    {        
        
        $this->db->select('b.`date`, a.first_name, c.menu_name, GROUP_CONCAT(distinct d.item_name) as item');
        $this->db->from('person_details a');
        $this->db->join('child_menu_item_date_mapping b', ' a.id = b.child_id');
        $this->db->join('menu as c', 'b.menu_id = c.id');
        $this->db->join('item as d', 'b.item_id = d.id');
        $this->db->where('a.parent_id =',$parentID);
        $this->db->group_by(array("c.menu_name","b.`date`"));
        $this->db->order_by('a.first_name', 'ASC');
        return $query = $this->db->get()->result_array();
    }
    

    public function addChildMenu($childid)
    {
        for($i = 0; $i<count($this->input->post('optionsCheck')); $i++)
        {
            $field[] = array( 
                                'child_id'=>$childid,
                                'date' => $this->input->post('date'),
                                'menu_id'=>$this->input->post('optionsRadio'),
                                'item_id'=>$this->input->post('optionsCheck')[$i],
                              );
        }
        $this->db->insert_batch('child_menu_item_date_mapping', $field);
        if($this->db->affected_rows() > 0)
           return 1;
    }


    public function allChild($parent_id)
    {
                $sql = "select first_name,id,location from person_details where parent_id= '$parent_id' and parent_relation = 'child' "; 
                    $sql1 = $this->db->query($sql); 

                   return $row = $sql1->result_array();
    } 


    public function locationid($parent_id)
    {
         $sql="select locid from user_location where userid= '$parent_id' ";
     
          return $this->db->query($sql)->result_array();
    }

    //   public function checkMenuItem($date,$locid)
    // {
        
    //       $sql="select c.menu_name, c.id as 'menu_id', d.item_name as item_name, d.id as 'item_id', e.`date`, f.locid 
    //             from menu_item_assign a
    //             inner join menu_profile b
    //             on a.menu_profile_id = b.id
    //             inner join menu c
    //             on c.id = b.menu_id
    //             inner join item d
    //             on d.id = a.item_id
    //             inner join date_menuprofile_assign e
    //             on e.menu_profile_id = b.id
    //             inner join location_profile_mapping f
    //             on f.date_menu_assign_id = e.id
    //             where e.`date` ='".$date."' and f.`locid` = '".$locid."'
    //             group by c.id, e.`date`;
    //             ";
    //       return $this->db->query($sql)->result_array();
          
    // }

     public function checkMenuItem($locid)
    {
        
        // $sql="select c.menu_name, c.id as 'menu_id', GROUP_CONCAT(d.item_name) as item_name, GROUP_CONCAT(d.id) as 'item_id', e.`date`, f.locid 
        //         from menu_item_assign a
        //         inner join menu_profile b
        //         on a.menu_profile_id = b.id
        //         inner join menu c
        //         on c.id = b.menu_id
        //         inner join item d
        //         on d.id = a.item_id
        //         inner join date_menuprofile_assign e
        //         on e.menu_profile_id = b.id
        //         inner join location_profile_mapping f
        //         on f.date_menu_assign_id = e.id
        //          where f.`locid` = '".$locid."'  
        //         group by c.id, e.`date` order by e.`date`"; 

         $sql = "select distinct b.`menu_name`, b.`id` as 'menu_id', group_concat(c.`item_name`) as 'item_name', group_concat(c.`id`) as 'item_id', a.`date`, a.`locid`
               from menu_item_assign a
               inner join menu b on a.`menu_id` = b.`id`
               inner join item c on a.`item_id` = c.`id`
               where a.`locid` = '".$locid."'
               group by a.grade_id,b.`id`, a.`date`
               order by a.`date`";  
          return $this->db->query($sql)->result_array();
          
    }

    public function category($childId,$ItemDate)
    {
        $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id']; 
        $result1 = $this->db->query($locidSQL);
        $result = $result1->row_array();
        $dateCategory = "(";
        for($i=0;$i<count($ItemDate);$i++)
        {
                $dateCategory.="'".$ItemDate[$i]."',";
        }
        $dateCategory=rtrim($dateCategory,',');
        $dateCategory.= ")";
       // print_r($dateCategory); die;
        $sql = "select distinct a.id as categoryid,a.category_name as category,b.date as date from item_category as a inner join  menu_item_assign as b ON a.id=category_id
               inner join person_details as d ON d.location = b.grade_id where d.`id` = '".$childId."' and b.`locid`='".$result['locid']."' and 
               b.date IN ".$dateCategory."
               union
               select a.`category_id` as 'categoryid', 'Drinks' as 'category', a.`date` as 'date' from child_menu_item_date_mapping a
               where a.`child_id`='".$childId."' and a.`category_id` = '3' and a.date IN ".$dateCategory;
        
               return $this->db->query($sql)->result_array();
         
    }
 
   public function checkMealItemData($childId,$ItemDate)
   {
              
            $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id']; 
        $result1 = $this->db->query($locidSQL);
        $result = $result1->row_array();

        $dateCategory = "(";
        for($i=0;$i<count($ItemDate);$i++)
       {
               $dateCategory.="'".$ItemDate[$i]."',";
       }
       $dateCategory=rtrim($dateCategory,',');
       $dateCategory.= ")";
      
         $sql = "select distinct b.id as mealid, b.meal_name as meal,group_concat(c.item_name) as item,
           (b.price) as price,concat('".$GLOBALS['img_url']."',c.Image) as image,a.date as date  from menu_item_assign as a inner join meal_plan as b ON a.meal_id = b.id 
            inner join meal_item_mapping d on d.meal_id = b.id inner join item as c
             ON d.item_id = c.id inner join person_details as e ON e.location = a.grade_id
              where e.`id` = '".$childId."' and a.`locid`='".$result['locid']."' 
              and a.date IN".$dateCategory."  group by b.id,a.`date`"; 
          return $this->db->query($sql)->result_array();
      
   }



   public function checkCategoryItemData($childId,$ItemDate)
   {
       $loginstatus = $this->session->userdata('logged_in');
       $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id']; 
        $result1 = $this->db->query($locidSQL);
        $result = $result1->row_array();
           
        $dateCategory = "(";
         for($i=0;$i<count($ItemDate);$i++)
        {
                $dateCategory.="'".$ItemDate[$i]."',";
        }
        $dateCategory=rtrim($dateCategory,',');
        $dateCategory.= ")";
    
    
       $sql = " select distinct b.id as categoryid,b.category_name as category,(c.id) as itemid,
      (c.item_name) as item,(c.price) as price,concat('".$GLOBALS['img_url']."',c.Image) as image,
      a.date as date from menu_item_assign as a inner join item_category as b 
      ON a.category_id = b.id inner join item as c ON a.item_id = c.id  inner join 
      person_details as d ON d.location = a.grade_id 
      where d.`id` = '".$childId."' and a.`locid`='".$result['locid']."' and a.date IN".$dateCategory."  group by c.id,a.`date`
      union
      select a.`category_id` as 'categoryid', 'Drinks' as 'category', a.`item_id` as 'itemid', b.`item_name` as 'item', b.`price` as 'price', 'image' as 'image', a.`date` as 'date'  from child_menu_item_date_mapping a
      inner join item as b ON a.`item_id` = b.`id`
      where a.`child_id`='".$childId."' and a.date IN".$dateCategory." and a.`category_id` = '3'" ; 
       return $this->db->query($sql)->result_array();
        
    
   }


    public function childMealItemData($childId)
   {
    
        $sql = "select a.meal_id as mealid,a.date as date from child_menu_item_date_mapping as a where a.child_id = '".$childId."'  and a.meal_id !=0"; 

          return $this->db->query($sql)->result_array();

   }

   public function childCategoryItemData($childId)
   {

     $sql = "select distinct b.category_name as category,c.id as itemid,c.item_name as item,c.price as price,d.date as date from child_menu_item_date_mapping as d inner join item_category as b ON d.category_id = b.id   inner join item as c ON d.item_id = c.id  where d.child_id = '".$childId."'  "; 
 //die;
          return $this->db->query($sql)->result_array();
   }

  public function updatechildItemCategoryData($childId)
  {
     $sql = $this->db->query("Delete from child_menu_item_date_mapping where child_id='".$childId."'");
     return true;

  }

   public function insertItemCategoryMeal($data,$parentid)
   {
        
        $createdId = "select id from user where `ref_id` = ".$parentid; 
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array(); 
       // print_r($resultid['id']); die;
       
       $this->db->query("INSERT into TEMP_child_menu_item_date_mapping (child_id,parent_id,`date`,menu_id,category_id, item_id,meal_id,status, locid,createdby) VALUES (".$data.", ".$resultid['id'].")");
       $this->db->query("INSERT into child_menu_item_date_mapping (child_id,parent_id,`date`,menu_id,category_id, item_id,meal_id,status, locid,createdby) VALUES (".$data.", ".$resultid['id'].")");
      return true;

   }


   public function insertMealId($data,$parentid)
   {


       $createdId = "select id from user where `ref_id` = ".$parentid; 
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array(); 
       // print_r($resultid['id']); die;

      $this->db->query("INSERT into TEMP_child_menu_item_date_mapping (child_id,parent_id,`date`,menu_id,category_id, item_id,meal_id,status, locid,createdby) VALUES (".$data.", ".$resultid['id'].")");
      $this->db->query("INSERT into child_menu_item_date_mapping (child_id,parent_id,`date`,menu_id,category_id, item_id,meal_id,status, locid,createdby) VALUES (".$data.", ".$resultid['id'].")");
      return true;
   }

    public function checkMenuItem1($date,$locid)
    {
        
       // $sql="select distinct c.id as 'menu_id', d.item_name as item_name,d.price as price,d.id as 'item_id'
       //          from menu_item_assign a
       //          inner join menu_profile b
       //          on a.menu_profile_id = b.id
       //          inner join menu c
       //          on c.id = b.menu_id
       //          inner join item d
       //          on d.id = a.item_id
       //          inner join date_menuprofile_assign e
       //          on e.menu_profile_id = b.id
       //          inner join location_profile_mapping f
       //          on f.date_menu_assign_id = e.id
       //           where f.`locid` = '".$locid."' and e.`date` = '".$date."' 
       //          order by e.`date`"; 


    $sql = "select distinct b.`menu_name`, b.`id` as 'menu_id', c.`item_name` as 'item_name',c.`id` as 'item_id', a.`price` as price, a.`date`, a.`locid`
               from menu_item_assign a
               inner join menu b on a.`menu_id` = b.`id`
               inner join item c on a.`item_id` = c.`id`
               where a.`date`='".$date."' and a.`locid` = '".$locid."'
               order by a.`date`"; 
          return $this->db->query($sql)->result_array();
          
    }


    


    public function insertchildparentData($resultData, $date,$childId)
    {

        $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id']; 
        $result1 = $this->db->query($locidSQL);
        $result = $result1->row_array();
        $createdId = "select id from user where `ref_id` = ". $loginstatus['parent_id'];  
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array();

  
        $menuitem = array();
        $menuitemid = array();

        $sql = $this->db->query('DELETE FROM child_menu_item_date_mapping WHERE `child_id`='.$childId);

        for($i=0;$i<count($resultData);$i++)
        {
             for($j=0;$j<count($resultData[$i]['arr1']);$j++)
            {
                //  $menuitem[$resultData[$i]['menuID']][$j] = $resultData[$i]['arr1'][$j];
              $menuitemid = "select id from menu_item_assign where `menu_id` = '".$resultData[$i]['menuID']."'   and `item_id` = '".$resultData[$i]['arr1'][$j]."' and `date` = '".$date."' "; 
                $result1 = $this->db->query($menuitemid);
                 $resultitemmenuid = $result1->row_array();

                

                  $data = "'".$childId."','".$loginstatus['parent_id']."','".$date."', '".$resultitemmenuid['id']."','1', '".$result['locid']."','".$resultid['id']."' ";

                  $this->db->query('INSERT into child_menu_item_date_mapping (`child_id`,`parent_id`,`date`,`menu_profile_id`, `status`, `locid`,`createdby`) VALUES ('.$data.")");


                 
            }
          
        }

          return true;
    }



   
   public function checkParentItem($date,$locid)

     { 
            $sql = "select distinct c.id as menu_id,c.menu_name as menu_name , d.id as item_id,d.item_name as item_name from menu_item_assign b inner join child_menu_item_date_mapping a on a.menu_profile_id = b.id inner join menu c on b.menu_id = c.id inner join item d on b.item_id = d.id where a.`child_id` = '239' and a.`locid` = '".$locid."' and a.`date` = '".$date."' " ; 

                    return $this->db->query($sql)->result_array();
    }





   
   public function checkParentchildItem($childId,$date,$locid)

     { 
          $sql = "select distinct c.id as menu_id,c.menu_name as menu_name , d.id as item_id,d.item_name as item_name from menu_item_assign b inner join child_menu_item_date_mapping a on a.menu_profile_id = b.id inner join menu c on b.menu_id = c.id inner join item d on b.item_id = d.id where a.`child_id` = '".$childId."' and a.`locid` = '".$locid."' and a.`date` = '".$date."'  order by 'a.child_id' ASC" ;  

                    return $this->db->query($sql)->result_array();
    }

    public function checkNoSelection($fdate, $tdate)
    {
        //$result_str = "'" . implode ( "', '", $arryDate ) . "'";
        $result="and  date BETWEEN '".$fdate."' AND '".$tdate."'";
        $sql = "select count(*) as 'count' from TEMP_child_menu_item_date_mapping"
                . " where (`category_id` =0 and `item_id` =0 and `meal_id` =0 and `status` = 1) ".$result; 
         return $this->db->query($sql)->row_array();
    }

    
}

?>