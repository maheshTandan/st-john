<?php

class MealCreationModel extends CI_Model {

    public function getItems($locationid) {
        $SQL = "(select a.`id`, a.`item_name`, a.`price` as 'price'
                from `item` a 
                left join menu_item_assign b on a.`id` = b.`item_id`
                where 
                a.`item_name` !='' and a.`status` = 1 and a.`locid`=''
                group by a.`item_name`)
                UNION
                (select a.`id`, a.`item_name`, a.`price` as 'price'
                                from `item` a 
                                left join menu_item_assign b on a.`id` = b.`item_id`
                                where 
                                a.`item_name` !='' and a.`status` = 1 and a.`locid`='".$locationid."'
                                group by a.`item_name`)
                order by `id` ASC";
        $result = $this->db->query($SQL);
        return $result->result_array();
    }


    
    public function insertMeal($meal,$meal_alias,$price, $locationid){
        
        $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id'];   
        $result = $this->db->query($locidSQL);
        $result = $result->row_array();
        $createdId = "select id from user where `ref_id` = ". $loginstatus['parent_id'];  
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array();
       
        $data = array(
        'meal_name' => $meal,
        'meal_alias' => $meal_alias,
        'price'=>$price,
        'locid' => $locationid,
        'status'  => '1',
        'createdby'  => $resultid['id'],
       );
        
        $this->db->insert('meal_plan', $data);
        if($this->db->affected_rows() > 0){
            return 1;
        }else{
                return false;
        }
    }
    
    public function deleteMealByID(){
        
        $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id'];   
        $result = $this->db->query($locidSQL);
        $result = $result->row_array();
        
        $id = $this->input->get('id');
        $this->db->where('meal_id', $id);
        $this->db->where('locid', $result['locid']);
        $this->db->delete('meal_item_mapping');
        
        
        //$this->db->delete('menu_item_assign', array('category_id' => $MealID));
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('meal_plan');
        
       
        
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function locbmid()
    {
        $loginstatus   = $this->session->userdata('logged_in'); 
        $user_id =  $loginstatus['parent_id']; 
        $sql = "select locid from  user_location where userid = '$user_id' "; 
        $sql1 = $this->db->query($sql); 
        return $sql1->row_array();
    }
    
     public function showAllMeal($locationid)
    {
        $SQL = "select A.`id`, A.`meal_name`, A.`price`,A.`locid`, IF(B.`items` is NULL, 'No Items Assigned', B.`items`) as 'items' , IF(B.`item_id` is NULL, 0, B.`items`) as 'item_id',A.`status` from meal_plan A 
        left join
        (select a.`meal_id`, trim(group_concat(a.`item_id`)) as `item_id`, a.`locid`, trim(group_concat(' ',b.`item_name`)) as `items`
        from meal_item_mapping a inner join item b on b.`id` = a.`item_id` where a.`locid` ='".$locationid."'
        group by a.`meal_id`) B
        on B.`meal_id` = A.`id`"; 
        $result = $this->db->query($SQL);
        if($result->num_rows() > 0){
                return $result->result_array();
        }else{
                return false;
        }
    }
    
    public function insertMealItemMaping($ItemArray){
        
        $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id'];   
        $result = $this->db->query($locidSQL);
        $result = $result->row_array();
        $createdId = "select id from user where `ref_id` = ". $loginstatus['parent_id'];  
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array();
        $insertData = array();
        $sql = "DELETE from meal_item_mapping WHERE  `meal_id` =".$ItemArray['mealID']; 
        $this->db->query($sql);
        for($i=0; $i<count($ItemArray['items']);$i++)
        {
            $insertData[] = array(
                                    'meal_id'=>$ItemArray['mealID'],
                                'item_id'=>$ItemArray['items'][$i], 
                                    'locid'=>$ItemArray['locid'],
                                    'createdby'=>$resultid['id']
                                );
        }
        $this->db->insert_batch('meal_item_mapping', $insertData);
        if($this->db->affected_rows() > 0)
            return 1;
    }
    
    public function insertItem($locationid, $imageurl)
    {
        $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id'];   
        $result = $this->db->query($locidSQL);
        $result = $result->row_array();
        $createdId = "select id from user where `ref_id` = ". $loginstatus['parent_id'];  
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array();
        $field = array(
            'item_name'=>trim($this->input->post('txtItemName')),
            'category_id'=>trim($this->input->post('category')),
            'price'=>trim($this->input->post('txtPriceName')),
            'Image'=>$imageurl,
            'status'  => '1',
            'locid' => trim($locationid),
            'createdby'  => trim($resultid['id'])
                    );
        $this->db->insert('item', $field); 
        if($this->db->affected_rows() > 0){
                return true;
        }else{
                return false;
        }
    }
    
    
    
    
    public function checkedItems($mealid, $locationid)
    {
        $sql = "select meal_id, item_id 
                from meal_item_mapping
                where meal_id =".$mealid;  
        $result = $this->db->query($sql);
        
          if($result->num_rows() > 0){
                return $result->result_array();
        }else{
                return false;
        }
       
    }


    public function updatemealStatus($mealID,$statusValue)
    {

                $sql ="UPDATE meal_plan SET status='".$statusValue."' 
                       WHERE id='".$mealID."'";
               return $result = $this->db->query($sql);
    }
    
    
     public function dataItemCategory()
    {
        $SQL = "select `id`, `category_name`
                from item_category
                order by `category_name` ASC";
        $result = $this->db->query($SQL);
        return $result->result_array();
    }
    
     public function ajaxCheckMealName($itemName, $locationid)
    {
        $sql = "select count(*) as 'count' from  `meal_plan` where `meal_name` ='".trim($itemName)."' and `locid`='".$locationid."'"; 
        $sql1 = $this->db->query($sql); 
        $data = $sql1->row_array();
        if($data['count'] > 0)
            return 0;
        else
            return 1;
    }
    
     public function ajaxCheckMealNameAlias($itemName, $locationid)
    {
        $sql = "select count(*) as 'count' from  `meal_plan` where `meal_alias` ='".trim($itemName)."' and `locid`='".$locationid."'"; 
        $sql1 = $this->db->query($sql); 
        $data = $sql1->row_array();
        if($data['count'] > 0)
            return 0;
        else
            return 1;
    }
}

?>
