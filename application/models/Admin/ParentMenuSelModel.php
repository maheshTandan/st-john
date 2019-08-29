<?php

class ParentMenuSelModel extends CI_Model {
  
    public function getMenu()
    {
        
        
//       $sql = "select * from (select id, menu_name, flag from (
//                select a.id as id,  a.menu_name as `menu_name`, (case when (b.child_id =".$childid." ) THEN 1 ELSE 0 END) as flag from menu a
//                left join child_menu_item_date_mapping b
//                on a.id = b.menu_id
//                where a.`status` = 1
//                order by a.menu_name asc ) A where flag = 1 
//                UNION
//                select id, menu_name, flag from (
//                select a.id as id,  a.menu_name as `menu_name`, (case when (b.child_id =".$childid." ) THEN 1 ELSE 0 END) as flag from menu a
//                left join child_menu_item_date_mapping b
//                on a.id = b.menu_id
//                where a.`status` = 1
//                order by a.menu_name asc ) B where flag=0 ) A group by menu_name";
//       $sql1 = $this->db->query($sql); 
//       return $row = $sql1->result_array();
        
        
        
        //echo $childid; die;
        $this->db->select('a.`menu_id` as id, b.menu_name');
        $this->db->from('menu_item_mapping as a');
        $this->db->join('menu as b', 'a.menu_id = b.id');
        $this->db->group_by(array("b.menu_name"));
        $this->db->order_by('b.menu_name', 'ASC');
        return $query = $this->db->get()->result_array();
    }
    
    public function getItem($menuid, $childid)
    {
//        $sql = "select * from (select * from (select d.id as `item_id`, c.id as `menu_id`, c.`menu_name`, d.`item_name`,
//        (case when (b.child_id =".$childid." ) THEN 1 ELSE 0 END) as flag  
//        from menu_item_mapping a
//        left join child_menu_item_date_mapping b
//        on a.menu_id = b.menu_id
//        inner join menu c
//        on a.menu_id = c.id
//        inner join item d
//        on a.item_id = d.id
//        where a.menu_id ='".$menuid."'
//        order by c.menu_name ASC) A where flag=1 
//
//        UNION
//
//        select * from (select d.id as `item_id`, c.id as `menu_id`, c.`menu_name`, d.`item_name`,
//        (case when (b.child_id =".$childid." ) THEN 1 ELSE 0 END) as flag  
//        from menu_item_mapping a
//        left join child_menu_item_date_mapping b
//        on a.menu_id = b.menu_id
//        inner join menu c
//        on a.menu_id = c.id
//        inner join item d
//        on a.item_id = d.id
//        where a.menu_id ='".$menuid."'
//        order by c.menu_name ASC) B where flag = 0 ) AA group by menu_name, item_name"; 
//        
//        $sql1 = $this->db->query($sql); 
//        return $row = $sql1->result_array();
        
        
        
        
        $this->db->select('a.`item_id` as id, b.menu_name, c.item_name');
        $this->db->from('menu_item_mapping as a');
        $this->db->join('menu as b', 'a.menu_id = b.id');
        $this->db->join('item as c', 'a.item_id = c.id');
        $this->db->where('a.menu_id =',$menuid);
        $this->db->order_by('b.menu_name', 'ASC');
        return $query = $this->db->get()->result_array();
    }
    
    public function getAllChildren($parentID)
    {
        $sql = 'select a.`id`, a.`email`, a.`phone`, a.`parent_id`, b.`child_id`, trim(concat(a.first_name," ", a.middle_name, " ", a.last_name)) as `Name`, a.`Address`,
        a.`City`, a.`State`, a.`Zip`, a.`location`, a.`locid`, b.`date`, b.`menu_id`, b.`item_id`,c.`menu_name`, GROUP_CONCAT(d.`item_name`) as `item_name`, GROUP_CONCAT(b.`item_id`) as `item_id`
        from person_details a
        inner join child_menu_item_date_mapping b
        on a.id = b.`child_id`
        inner join menu c
        on b.`menu_id`=c.`id`
        inner join item d
        on b.`item_id`=d.`id`
        where a.`status`=1 and a.`signup_status`=1 and a.`parent_id`='.$parentID.'
        group by b.`date`, c.`menu_name`';
        
        $sql1 = $this->db->query($sql); 
        return $row = $sql1->result_array();
        
        
//        $this->db->select('id, trim(concat(first_name," ", middle_name, " ", last_name)) as `first_name`');
//        $this->db->from('person_details');
//        $this->db->where('parent_id =',$parentID);
//
//         $this->db->where("parent_relation='child'");
//
//        $this->db->order_by('first_name', 'ASC');
//        return $query = $this->db->get()->result_array();
    }
    

    public function getAllParents()
    {   
        
        $sql = "select `id`, `email`, `phone`, `parent_id`, trim(concat(first_name,' ', middle_name,' ', last_name)) as `Name`, `Address`,
        `City`, `State`, `Zip`, `location`, `locid`
        from person_details
        where `status`=1 and `signup_status`=1";
        $sql1 = $this->db->query($sql); 
        return $row = $sql1->result_array();
        
//        $this->db->select('b.`date`, a.first_name, c.menu_name, GROUP_CONCAT(distinct d.item_name) as item');
//        $this->db->from('person_details a');
//        $this->db->join('child_menu_item_date_mapping b', ' a.id = b.child_id');
//        $this->db->join('menu as c', 'b.menu_id = c.id');
//        $this->db->join('item as d', 'b.item_id = d.id');
//        $this->db->where('a.parent_id =',$parentID);
//        $this->db->group_by(array("c.menu_name","b.`date`"));
//        $this->db->order_by('a.first_name', 'ASC');
//        return $query = $this->db->get()->result_array();
    }
    

    public function updateChild($childID, $date, $menuID, $itemArr)
    {
        $itemArr = explode(',', $itemArr);
        
         echo $sql = "DELETE FROM child_menu_item_date_mapping
                 WHERE child_id = '".$childID."', date = '".$date."', menu_id = '".$menuID."'"; die;
         //$sql1 = $this->db->query($sql); 
        //$this->db->delete('child_menu_item_date_mapping', array('child_id' => trim($childID), 'date' => trim($date),'menu_id' => trim($menuID)));

        if($this->db->affected_rows() > 0)
        {
            
            for($i = 0; $i<count($itemArr); $i++)
            {
                $field[] = array( 
                                    'child_id'=>$childid,
                                    'date' => $this->input->post('date'),
                                    'menu_id'=>$this->input->post('optionsRadio'),
                                    'item_id'=>$itemArr[$i],
                                  );
            }
            $this->db->insert_batch('child_menu_item_date_mapping', $field);
            if($this->db->affected_rows() > 0)
                return 1;
            
        }
        else
        {
            return 0;
        }
           

        
       // for($i = 0; $i<count($itemArr); $i++)
        //{
            //$this->db->delete('child_menu_item_date_mapping', array('child_id' => trim($childID), 'date' => trim($date),'menu_id' => trim($menuID),'item_id' => trim($itemArr[$i])));
            
        
            
        //}
       // die;
        
        
       
    }
}

?>