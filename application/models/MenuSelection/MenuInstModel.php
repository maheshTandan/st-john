<?php

class MenuInstModel extends CI_Model {
  
    public function insertMenu($menu)
    {
        $data = array(
        'menu_name' => $menu,
        'status'  => '1',
       );

        //$sql = $this->db->set($data)->get_compiled_insert('menu');
       // echo $sql;
        
        $this->db->insert('menu', $data);
        if($this->db->affected_rows() > 0)
            return 1;
    }
    
    public function getMenu()
    {
       return $query = $this->db->select('id, menu_name')
                        ->where('menu_name !=','')
                        ->group_by('menu_name')
                        ->order_by('menu_name', 'ASC')
                        ->get('menu')->result_array();
    }
    
    public function getMenuByID($MenuID)
    {
       return $query = $this->db->select('id, menu_name')
                        ->where('id=',$MenuID)
                        ->group_by('menu_name')
                        ->order_by('menu_name', 'ASC')
                        ->get('menu')->result_array();
    }
    
    public function updateMenuByID($MenuID, $menuName)
    {
       $data = array(
                'menu_name' => $menuName,
                );

        $this->db->where('id', $MenuID);
        return $this->db->update('menu', $data);
        
        //$this->db->update('mytable', $data, array('id' => $id));
        //$this->db->update('mytable', $data, "id = 4");
    }
    
    public function deleteMenuByID($MenuID)
    {
        return $this->db->delete('menu', array('id' => $MenuID));
       // return $this->db->delete('menu_item_mapping', array('menu_id' => $MenuID));
        
        //$this->db->update('mytable', $data, array('id' => $id));
        //$this->db->update('mytable', $data, "id = 4");
    }
}

?>