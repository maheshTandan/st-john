<?php

class BmItemInstModel extends CI_Model {
  
    public function insertItem($item, $item_alias,$categoryID, $price, $locationid, $imagePath)
    {
        $loginstatus = $this->session->userdata('logged_in');
        $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id'];   
        $result = $this->db->query($locidSQL);
        $result = $result->row_array();
        $createdId = "select id from user where `ref_id` = ". $loginstatus['parent_id'];  
        $result1 = $this->db->query($createdId);
        $resultid = $result1->row_array();
        
        $data = array(
        'item_name' => $item,
        'item_alias' => $item_alias,
        'category_id' => $categoryID,
        'price'=>$price,
        'Image'=>$imagePath,
        'status'  => '1',
        'locid'=>$locationid,
        'createdby'  => trim($resultid['id'])
       );

        //$sql = $this->db->set($data)->get_compiled_insert('menu');
       // echo $sql;
        
        $this->db->insert('item', $data);
          if($this->db->affected_rows() > 0){
                return true;
        }else{
                return false;
        }
        
        //echo "vicky";
    }
    
    public function getItem($locationid)
    {
        $SQL = " select a.`id`, a.`item_name`, a.`category_id`, b.`category_name`, a.`price`, a.`status` 
                from item a 
                inner join item_category b on a.`category_id`=b.`id`
                where a.`status`= 1 and (a.`locid`='' or a.`locid`='".$locationid."') order by b.`category_name` ASC";
        $result = $this->db->query($SQL);
        return $result->result_array();
       
       
      
    }
    
    public function getItemByID($ItemID)
    {
       return $query = $this->db->select('id, item_name, item_alias,price, category_id, `Image`')
                        ->where('id=',$ItemID)
                        ->group_by('item_name')
                        ->order_by('item_name', 'ASC')
                        ->get('item')->result_array();
    }
    
    public function updateItemByID($ItemID, $itemName,$itemAlias,$price, $categoryid, $imagePath)
    {
       $data = array(
                'category_id'=>trim($categoryid),
              );
    
        $this->db->where('item_id', $ItemID);
        $this->db->update('menu_item_assign', $data);
        
        
        $data = array(
                 'item_name' => $itemName,
                 'item_alias' => $itemAlias,
                 'price'=>$price,
                 'category_id'=>trim($categoryid),
                 'Image'=>$imagePath
                 );
        $this->db->where('id', $ItemID);
        return $this->db->update('item', $data);
    }
    
    public function deleteItemByID($ItemID)
    {
       $SQL="select `item_name`, `item_alias`, `category_id`, `price`, `Image`, `status`, `locid`, `createdby` from `item` where `id`=".$ItemID;
      
        $result = $this->db->query($SQL);
        $data = $result->row_array();
        //$data1 = explode('/', $data['Image']); 
        //$c = count($data1);
        //$file_name =  $data1[--$c];
        $file_name =  $data['Image'];
        //$target_dir = '/opt/lampp/htdocs/st-john/application/images/upload/';
        if(trim($file_name) !="")
        {
            $path = $GLOBALS['img_path'].$file_name;
            unlink($path);
        }
        
       
        $data = array(
        'item_id' => $ItemID,
        'item_name' => $data['item_name'],
        'item_alias' => $data['item_alias'],
        'category_id' => $data['category_id'],
        'price'=>$data['price'],
        'Image'=>$data['Image'],
        'status'  => '1',
        'locid'=>$data['locid'],
        'createdby'  => $data['createdby'],
        'action' => 'Delete'
       );

       $this->db->insert('item_archive', $data);
        
        
       
        return $this->db->delete('item', array('id' => $ItemID));   
       //return $this->db->delete('menu_item_mapping', array('item_id' => $ItemID));
        
        //$this->db->update('mytable', $data, array('id' => $id));
        //$this->db->update('mytable', $data, "id = 4");
    }
    
    public function dataItemCategory()
    {
        $SQL = "select `id`, `category_name`
                from item_category
                order by `category_name` ASC";
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
    
    public function ajaxCheckItemName($itemName, $locationid)
    {
        $sql = "select count(*) as 'count' from  `item` where `item_name` ='".trim($itemName)."' and `locid` IN ('".$locationid."','')"; 
        $sql1 = $this->db->query($sql); 
        $data = $sql1->row_array();
        if($data['count'] > 0)
            return 0;
        else
            return 1;
    }
    
     public function ajaxCheckItemAliasName($itemName, $locationid)
    {
        $sql = "select count(*) as 'count' from  `item` where `item_alias` ='".trim($itemName)."' and `locid` IN ('".$locationid."','')"; 
        $sql1 = $this->db->query($sql); 
        $data = $sql1->row_array();
        if($data['count'] > 0)
            return 0;
        else
            return 1;
    }
}

?>