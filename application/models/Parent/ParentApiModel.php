<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ParentApiModel extends CI_Model {

 function __construct()
      {
            parent::__construct();
             $this->load->library('session');
       }


  public function apidateData($locid)
  {

 	$sql = "select distinct date from menu_item_assign where locid = '".$locid."' ";
 	    return $this->db->query($sql)->result_array();
  }



 public function apiCategoryName($locid,$date)
 {
	   $sql = "select distinct b.category_name as category,a.date from menu_item_assign as a
		inner join item_category as b ON a.category_id = b.id where a.locid = '".$locid."' and 
		a.date='".$date."' ";
 	   return $this->db->query($sql)->result_array();
 }



public function apiItemCategoryName($locid,$category,$date)
{
	 $sql = "select a.item_name as item,a.price,concat('".$GLOBALS['img_url']."',a.image) as image,c.category_name as category
	  from item as a inner join menu_item_assign as b ON a.id = b.item_id 
	  inner join item_category as c ON b.category_id = c.id  where b.locid = '".$locid."' 
	  and c.category_name = '".$category."' and b.date= '".$date."' group by item"; 
 	   return $this->db->query($sql)->result_array();
}



 public function apiItemMealData($locid,$meal)
 {
 	  

         $sql = "select distinct b.meal_name as meal,c.item_name as item,b.price,concat('".$GLOBALS['img_url']."',c.image) as image from menu_item_assign as a inner join meal_plan as b ON a.meal_id = b.id  inner join meal_item_mapping as d ON d.meal_id = a.meal_id inner join item as c ON c.id = d.item_id where a.locid = '".$locid."' and b.meal_name = '".$meal."' "; 

 	    return $this->db->query($sql)->result_array();
 }


 public function apiMealName($locid,$date)
 {
 	      $sql = "select distinct b.meal_name as meal from menu_item_assign as a inner join meal_plan as b ON a.meal_id = b.id  where a.locid = '".$locid."' and a.date = '".$date."' ";

 	    return $this->db->query($sql)->result_array();
 }



}

?>