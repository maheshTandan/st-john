<?php

class MenuSelectionModel extends CI_Model {
    
    public function getMenuData()
    {
      //  $this->load->database();
//        $q = $this->db->query("select * from menu");
//        return $q->result();
//        
        
        return $query = $this->db->select('id, menu_name')
                        ->order_by('menu_name', 'ASC')
                        ->get('menu')->result_array();
    }
}

?>