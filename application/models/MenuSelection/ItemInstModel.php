<?php

class ItemInstModel extends CI_Model {

    public function insertItem($item, $categoryID, $price, $imagePath)
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
        'category_id' => $categoryID,
        'price'=>$price,
        'Image'=>$imagePath,
        'status'  => '1',
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
    
      public function getItem()
    {
        $SQL = " select a.`id`, a.`item_name`, a.`category_id`, b.`category_name`, a.`price`, a.`status` 
                from item a 
                inner join item_category b on a.`category_id`=b.`id`
                where a.`status`= 1 order by b.`category_name` ASC";
        $result = $this->db->query($SQL);
        return $result->result_array();
       
       
      
    }
    
    public function getItemByID($ItemID)
    {
       return $query = $this->db->select('id, item_name,price, category_id, `Image`')
                        ->where('id=',$ItemID)
                        ->group_by('item_name')
                        ->order_by('item_name', 'ASC')
                        ->get('item')->result_array();
    }
    
    public function updateItemByID($ItemID, $itemName,$price, $categoryid, $imagePath)
    {
        $data = array(
                'category_id'=>trim($categoryid),
              );
    
        $this->db->where('item_id', $ItemID);
        $this->db->update('menu_item_assign', $data);
        
        $data = array(
                'item_name' => $itemName,
                'price'=>$price,
                'category_id'=>trim($categoryid),
                'Image'=>$imagePath
                );
      // print_r($data); die;

        $this->db->where('id', $ItemID);
        return $this->db->update('item', $data);
        
        //$this->db->update('mytable', $data, array('id' => $id));
        //$this->db->update('mytable', $data, "id = 4");
    }
    
    public function deleteItemByID($ItemID)
    {
              
        $SQL="select `Image` from `item` where `id`=".$ItemID;
        $result = $this->db->query($SQL);
        $data = $result->row_array();
       // $data = explode('/', $data['Image']); 
       // $c = count($data);
       // $file_name =  $data[--$c];
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
        'category_id' => $data['category_id'],
        'price'=>$data['price'],
        'Image'=>$data['Image'],
        'status'  => '1',
        'locid'=>'',
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
        $sql = "select count(*) as 'count' from  `item` where `item_name` ='".trim($itemName)."' and `locid`='".$locationid."'"; 
        $sql1 = $this->db->query($sql); 
        $data = $sql1->row_array();
        if($data['count'] > 0)
            return 0;
        else
            return 1;
    }
    
}

?>