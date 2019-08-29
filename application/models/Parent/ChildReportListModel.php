<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ChildReportListModel extends CI_Model {
    
  public function __construct()
    {
          parent::__construct();
           $this->load->library('session');
     }




public function parentName($id)
{
 
      $sql = "select a.id as id, a.first_name as ParentName, a.`mother_name` as 'MotherName' from person_details
              as a where a.id = '$id'";
             return $this->db->query($sql)->result_array();; 

             

}

public function parentName1($id)
{
      $result = "'" . implode ( "', '", $id ) . "'";
      $sql = "select a.id as id, a.first_name as ParentName from person_details
              as a where a.id IN($result)";
             return $this->db->query($sql)->result_array();; 

             

}


public function allChild($id)
{
           $sql = "select first_name,id,location from person_details where parent_id= '$id' and parent_relation = 'child'"; 
                $sql1 = $this->db->query($sql); 

               return $row = $sql1->result_array();
} 


public function allChild1($parentid,$childid)
{
   $sql = "select first_name,id,location from person_details 
      where parent_id= '$parentid' and parent_relation = 'child'"; 
      $sql1 = $this->db->query($sql); 

     return $row = $sql1->result_array();
}


public function allChildName($parentid)
{


 $result = "'" . implode ( "', '", $parentid ) . "'";


      $sql = "select first_name,id,location from person_details where parent_id IN($result) and parent_relation = 'child'"; 
      $sql1 = $this->db->query($sql); 

     return $row = $sql1->result_array();
}


public function itemName($id,$childId)
{
   
 

      $result = "'" . implode ( "', '", $childId ) . "'";

 
      $sql = "select a.* from(select distinct a.id as childid, a.first_name as ChildName,b.`date` as `date`,
                  c.id as categoryId,(c.category_name) as category,
                  group_concat(d.item_name) as Item,group_concat(d.price) as price, b.`quantity` from person_details as a 
                  inner join ARCHIVE_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                  item_category as c ON c.id = b.category_id inner join item as d ON 
                  d.id = b.item_id   where b.parent_id = '$id'  and b.child_id IN($result)and a.id=b.child_id
                  group by b.`date`,c.category_name, b.child_id
                  union
                  select distinct  a.id as childid,a.first_name as ChildName,(b.`date`)as `date`,
                  e.id as categoryId,(e.meal_name) as meal,group_concat(d.item_name) as Item ,group_concat(e.price )as price, b.`quantity`
                        from person_details as a inner join 
                        ARCHIVE_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                        meal_item_mapping as c ON c.meal_id = b.meal_id inner join item as d ON 
                        d.id = c.item_id  inner join meal_plan as e ON e.id = c.meal_id 
                        where b.parent_id = '$id' and  b.child_id IN($result) and a.id=b.child_id group by b.`date`, e.`meal_name`, b.child_id) a order by `date`, ChildName
                        
                  
                  "; 

                 return $this->db->query($sql)->result_array();

             
}

public function loctionId($userid)
{

      $sql = "select locid from user_location where userid= '$userid'"; 
      $sql1 = $this->db->query($sql); 

      return $row = $sql1->result_array();

}

public function parentitemName($parentId,$childid,$locid)
{
      
            $result = "'" . implode ( "', '", $parentId ) . "'";
            $result1 = "'" . implode ( "', '", $childid ) . "'";

           
            
          $sql = "select a.* from(select distinct a.id as parentid, a.first_name as parentName,a.mother_name as mother_name,b.`date` as `date`,
                        c.id as categoryId,(c.category_name) as category,
                        group_concat(d.item_name) as Item,group_concat(d.price) as price, b.`quantity` from 
                        person_details as a 
                        inner join ARCHIVE_child_menu_item_date_mapping as b ON b.parent_id = a.id 
                        inner join item_category as c ON c.id = b.category_id
                        inner join item as d ON d.id = b.item_id where b.child_id IN($result1) and a.id = b.parent_id and  b.parent_id IN($result)
                        and b.locid='$locid' group by b.`date`,c.category_name, b.child_id
                        union
                        select distinct a.id as parentid, a.first_name as parentName,a.mother_name as mother_name,(b.`date`)as `date`,
                        e.id as categoryId,(e.meal_name) as meal,group_concat(d.item_name) as Item ,group_concat(d.price )as price, b.`quantity`
                        from person_details as a inner join 
                        ARCHIVE_child_menu_item_date_mapping as b ON a.id = b.parent_id inner join 
                        meal_item_mapping as c ON c.meal_id = b.meal_id inner join item as d ON 
                        d.id = c.item_id  inner join meal_plan as e ON e.id = c.meal_id 
                        where b.child_id IN($result1) and  a.id = b.parent_id and  b.parent_id IN($result) 

                        and b.locid='$locid' group by b.`date`, e.`meal_name`, b.child_id) a order by parentName,`date`";


 
             return $this->db->query($sql)->result_array();
}



public function itemName1($parentid,$childid,$date_str)
{      
      
            $sql = "select a.* from(select distinct a.id as childid, a.first_name as ChildName,b.`date` as `date`,
                        c.id as categoryId,(c.category_name) as category,
                        group_concat(d.item_name) as Item,group_concat(d.price) as price, b.`quantity` from person_details as a 
                        inner join ARCHIVE_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                        item_category as c ON c.id = b.category_id inner join item as d ON 
                        d.id = b.item_id   where b.parent_id = '$parentid'  and a.id = b.child_id $childid
                        $date_str
                        group by b.`date`,c.category_name, b.child_id
                        union
                        select distinct  a.id as childid,a.first_name as ChildName,(b.`date`)as `date`,
                        e.id as categoryId,(e.meal_name) as meal,group_concat(d.item_name) as Item ,group_concat(d.price )as price, b.`quantity`
                        from person_details as a inner join 
                        ARCHIVE_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                        meal_item_mapping as c ON c.meal_id = b.meal_id inner join item as d ON 
                        d.id = c.item_id  inner join meal_plan as e ON e.id = c.meal_id 
                        where b.parent_id = '$parentid' and a.id = b.child_id $childid
                         $date_str group by b.`date`, e.`meal_name`, b.child_id) a order by ChildName";   

            return $this->db->query($sql)->result_array();

             
}



public function parentitemName1($locid,$date_str,$result2)
{
      
             $sql = "select a.* from(select distinct a.id as parentid, a.first_name as parentName,a.mother_name as mother_name,b.`date` as `date`,
                        c.id as categoryId,(c.category_name) as category,
                        group_concat(d.item_name) as Item,group_concat(d.price) as price, b.`quantity` from 
                        person_details as a 
                        inner join ARCHIVE_child_menu_item_date_mapping as b ON b.parent_id = a.id 
                        inner join item_category as c ON c.id = b.category_id
                        inner join item as d ON d.id = b.item_id where  a.id = b.parent_id $result2
                        and b.locid='$locid'  $date_str group by b.`date`,c.category_name, b.child_id
                        union
                        select distinct a.id as parentid, a.first_name as parentName,a.mother_name as mother_name,(b.`date`)as `date`,
                        e.id as categoryId,(e.meal_name) as meal,group_concat(d.item_name) as Item ,group_concat(d.price )as price, b.`quantity`
                        from person_details as a inner join 
                        ARCHIVE_child_menu_item_date_mapping as b ON a.id = b.parent_id inner join 
                        meal_item_mapping as c ON c.meal_id = b.meal_id inner join item as d ON 
                        d.id = c.item_id  inner join meal_plan as e ON e.id = c.meal_id 
                        where  a.id = b.parent_id $result2
                        and b.locid='$locid' $date_str  group by b.`date`,e.`meal_name`, b.child_id) a order by parentName,`date`";

        
 
             return $this->db->query($sql)->result_array();
}


public function discount($parentid)
{

      $sql = "select discount from discount where parent_id = '$parentid' and `status`=1"; 
      $sql1 = $this->db->query($sql); 

      return $sql1->result_array();

}


public function payment_tranx_info_record($txnID, $tnxdate, $parentID, $locationid,$paymentStatus, $amount,$unique_ID)
{
    
    $data = array(
       'transactionID' => $txnID,
       'transactionDate' => $tnxdate,
       'parentID'=>$parentID,
       'locid'=>$locationid,
       'unique_ID'=>$unique_ID,
       'paymentStatus'=> $paymentStatus,
       'amount'=> $amount

    );

      
        
    $this->db->insert('payment_tnx_info', $data);
      if($this->db->affected_rows() > 0){
            return true;
    }else{
            return false;
    }
}

public function checkMealPriceAgainstCatg($mealname)
{
    $sql = 'select `price` from meal_plan where `meal_name`="'.$mealname.'"';
    $sql = $this->db->query($sql); 
    $row = $sql->row_array();
    return trim($row['price']);
}

function date_sort($a, $b) {
    return strtotime($a) - strtotime($b);
}

public function dataCopyFromTemp($txnID, $parent_id,$paymentStatus,$unique_ID)
{

    $sql = "SELECT child_id, parent_id, date, menu_id, category_id, item_id, meal_id, quantity, status, locid, createdby from TEMP_child_menu_item_date_mapping where parent_id=".$parent_id;
    $sql = $this->db->query($sql); 
    $result = $sql->result_array();
    $c = count($result); 
    $date1 = array();

    if($c > 0)
    {
        for($i = 0; $i < $c ; $i++)
        {
            $sql_price = "select IF(`new price`=0.25, 0.25, `price`) as 'price' from (
                          select B.`price`, IF(B.`count` = 0, 0.25, 0) as `new price`, child_id, parent_id, `date`, menu_id, category_id, item_id, meal_id, quantity, `status`, locid, createdby from (
                          select `price`, (select count(*) from TEMP_child_menu_item_date_mapping where `child_id` = A.`child_id` and `parent_id`= A.`parent_id` and `date` = A.`date` and `meal_id` <> 0) as 'count'
                        , child_id, parent_id, `date`, menu_id, category_id, item_id, meal_id, quantity, `status`, locid, createdby from (
                        SELECT a.child_id, a.parent_id, a.date, a.menu_id, a.category_id, a.item_id, a.meal_id, a.quantity, a.status, a.locid, a.createdby, d.`price` from TEMP_child_menu_item_date_mapping a
                        inner join item_category as c ON c.id = a.category_id 
                        inner join item as d ON d.id = a.item_id
                        where a.`child_id` = '".$result[$i]['child_id']."' and a.`parent_id`= '".$result[$i]['parent_id']."' and a.`date` = '".$result[$i]['date']."' and
                        a.menu_id = '".$result[$i]['menu_id']."' and a.category_id = '".$result[$i]['category_id']."' and a.item_id = '".$result[$i]['item_id']."' and a.meal_id = '".$result[$i]['meal_id']."' and a.locid = '".$result[$i]['locid']."' and a.createdby = '".$result[$i]['createdby']."'
                        union 
                        SELECT a.child_id, a.parent_id, a.date, a.menu_id, a.category_id, a.item_id, a.meal_id, a.quantity, a.status, a.locid, a.createdby, e.price from TEMP_child_menu_item_date_mapping a
                        inner join meal_item_mapping as c ON c.meal_id = a.meal_id 
                        inner join item as d ON d.id = c.item_id 
                        inner join meal_plan as e ON e.id = c.meal_id
                        where a.`child_id` = '".$result[$i]['child_id']."' and a.`parent_id`= '".$result[$i]['parent_id']."' and a.`date` = '".$result[$i]['date']."' and
                        a.menu_id = '".$result[$i]['menu_id']."' and a.category_id = '".$result[$i]['category_id']."' and a.item_id = '".$result[$i]['item_id']."' and a.meal_id = '".$result[$i]['meal_id']."' and a.locid = '".$result[$i]['locid']."' and a.createdby = '".$result[$i]['createdby']."'
                        ) A) B) C";

            $sqlResult = $this->db->query($sql_price); 
            $row = $sqlResult->row_array();
            //$price = $row['price'];

            if($paymentStatus === 'success')
            {
               $sql_paymentStatus = "UPDATE ARCHIVE_child_menu_item_date_mapping set transactionID='".$txnID."', paymentStatus='".$paymentStatus."', price = '".$row['price']."' where `child_id` = '".$result[$i]['child_id']."' and `parent_id`= '".$result[$i]['parent_id']."' and `date` = '".$result[$i]['date']."' and menu_id = '".$result[$i]['menu_id']."' and category_id = '".$result[$i]['category_id']."' and item_id = '".$result[$i]['item_id']."' and meal_id = '".$result[$i]['meal_id']."' and locid = '".$result[$i]['locid']."' and unique_ID ='".$unique_ID."' and `paymentStatus` <> 'Success' ";

               $sql_paymentStatus1 = $this->db->query($sql_paymentStatus); 
            }
            else
            {
             $sql_paymentStatus = "UPDATE ARCHIVE_child_menu_item_date_mapping set transactionID='".$txnID."',paymentStatus='".$paymentStatus."', price = '".$row['price']."'  where `child_id` = '".$result[$i]['child_id']."' and `parent_id`= '".$result[$i]['parent_id']."' and `date` = '".$result[$i]['date']."' and menu_id = '".$result[$i]['menu_id']."' and category_id = '".$result[$i]['category_id']."' and item_id = '".$result[$i]['item_id']."' and meal_id = '".$result[$i]['meal_id']."' and locid = '".$result[$i]['locid']."' and unique_ID ='".$unique_ID."' and `paymentStatus` <> 'Success'"; 
                 $sql_paymentStatus1 = $this->db->query($sql_paymentStatus); 
            }

           



            // $insertData[] = array(
            //                         'child_id'=>$result[$i]['child_id'],
            //                         'parent_id'=>$result[$i]['parent_id'], 
            //                         'date'=>$result[$i]['date'],
            //                         'menu_id'=>$result[$i]['menu_id'],
            //                         'category_id'=>$result[$i]['category_id'],
            //                         'item_id'=>$result[$i]['item_id'],
            //                         'meal_id'=>$result[$i]['meal_id'],
            //                         'quantity'=>'1',
            //                         'price'=>$row['price'],
            //                         'status'=>$result[$i]['status'],
            //                         'locid'=>$result[$i]['locid'],
            //                         'transactionID'=>$txnID,
            //                         'createdby'=>$result[$i]['createdby']
            //                     );

                               array_push($date1, $result[$i]['date']);


        }


        $date1 = array_unique($date1);
        usort($date1, array($this,'date_sort'));
        for($ii= 0 ; $ii < count($date1); $ii++)
        {
            $this->db->query("Delete from child_menu_item_date_mapping where parent_id=".$parent_id." and `date`='".$date1[$ii]."'");
        } 



      //  $this->db->insert_batch('ARCHIVE_child_menu_item_date_mapping', $insertData);

        $this->db->query("Delete from TEMP_child_menu_item_date_mapping where parent_id=".$parent_id);
    }
}    
    
public function Temp_itemName($id,$childId)
{
   
 
    $pay_month = "select * from parent_date_cal_oneMonth_restriction where status = 1 ";

    $pay_month1 = $this->db->query($pay_month)->result_array();
    $pay_date =  $pay_month1[0]['month'];

   // print_r($pay_date); die;

    $result = "'" . implode ( "', '", $childId ) . "'";

 
  $sql = "select a.* from(select distinct a.id as childid, a.first_name as ChildName,b.`date` as `date`,
                  c.id as categoryId,(c.category_name) as category,
                  group_concat(d.item_name) as Item,group_concat(d.price) as price, b.`quantity` from person_details as a 
                  inner join TEMP_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                  item_category as c ON c.id = b.category_id inner join item as d ON 
                  d.id = b.item_id   where b.parent_id = '$id'  and b.child_id IN($result)and a.id=b.child_id
                  group by b.`date`,c.category_name, b.child_id
                  union
                  select distinct  a.id as childid,a.first_name as ChildName,(b.`date`)as `date`,
                  e.id as categoryId,(e.meal_name) as meal,group_concat(d.item_name) as Item ,group_concat(e.price )as price, b.`quantity`
                        from person_details as a inner join 
                        TEMP_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                        meal_item_mapping as c ON c.meal_id = b.meal_id inner join item as d ON 
                        d.id = c.item_id  inner join meal_plan as e ON e.id = c.meal_id 
                        where b.parent_id = '$id' and  b.child_id IN($result) and a.id=b.child_id  group by b.`date`, e.`meal_name`,b.child_id) a order by `date`, ChildName"; 

                 return $this->db->query($sql)->result_array();

             
}    


public function Temp_parentitemName($parentId,$childid,$locid)
{
      
            $result = "'" . implode ( "', '", $parentId ) . "'";
            $result1 = "'" . implode ( "', '", $childid ) . "'";

            $sql = "select a.* from(select distinct a.first_name as parentName,b.`date` as `date`,
                        c.id as categoryId,(c.category_name) as category,
                        group_concat(d.item_name) as Item,group_concat(d.price) as price, b.`quantity` from 
                        person_details as a 
                        inner join TEMP_child_menu_item_date_mapping as b ON b.parent_id = a.id 
                        inner join item_category as c ON c.id = b.category_id
                        inner join item as d ON d.id = b.item_id where b.child_id IN($result1) and a.id = b.parent_id and  b.parent_id IN($result)
                        and b.locid='$locid' group by b.`date`,c.category_name, b.child_id
                        union
                        select distinct a.first_name as parentName,(b.`date`)as `date`,
                        e.id as categoryId,(e.meal_name) as meal,group_concat(d.item_name) as Item ,group_concat(e.price )as price, b.`quantity`
                        from person_details as a inner join 
                        TEMP_child_menu_item_date_mapping as b ON a.id = b.parent_id inner join 
                        meal_item_mapping as c ON c.meal_id = b.meal_id inner join item as d ON 
                        d.id = c.item_id  inner join meal_plan as e ON e.id = c.meal_id 
                        where b.child_id IN($result1) and  a.id = b.parent_id and  b.parent_id IN($result) 
                        and b.locid='$locid' group by b.`date`, e.`meal_name`, b.child_id) a order by parentName,`date`";

 
             return $this->db->query($sql)->result_array();
}



public function Temp_itemName1($parentid,$childid,$date_str)
{      
    
    /* 
                  select D.childid as 'childid', D.ChildName as 'ChildName', D.`date` as 'date', D.categoryId as 'categoryId', D.category as 'category', group_concat(D. Item) as 'Item', group_concat(D.`price`) as 'price', D.`temp_id` as 'temp_id', D.`quantity` as 'quantity' 
                    from (
                    select childid, ChildName,`date`,categoryId,category, Item,IF(`new price`=0.5, 0.5, `price`) as 'price', `temp_id`, `quantity`, item_id, meal_id, parent_id from 
                    (
                    select childid, ChildName,`date`,categoryId,category, Item,price, IF(B.`count` = 0, 0.5, 0) as `new price`, `temp_id`, `quantity`, item_id, meal_id, parent_id
                    from (
                    select A.*, (select count(*) from TEMP_child_menu_item_date_mapping where `child_id` = A.`childid` and `parent_id`= A.`parent_id` and `date` = A.`date` and `meal_id` <> 0) as 'count' from 
                    (select distinct a.id as childid, a.first_name as ChildName,b.`date` as `date`, c.id as categoryId,(c.category_name) as category, d.item_name as Item,d.price as price, b.`id` as 'temp_id', b.`quantity`, b.item_id, b.meal_id, b.parent_id 
                    from person_details as a inner join TEMP_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id 
                    inner join item_category as c ON c.id = b.category_id 
                    inner join item as d ON d.id = b.item_id 
                    where b.parent_id = '$parentid' and a.id = b.child_id $childid $date_str
                    group by b.`date`,c.category_name, b.child_id, d.item_name
                    union 
                    select distinct a.id as childid,a.first_name as ChildName,(b.`date`)as `date`, e.id as categoryId,(e.meal_name) as meal,d.item_name as Item ,e.price as price, b.`id` as 'temp_id', b.`quantity`, b.item_id, b.meal_id , b.parent_id 
                    from person_details as a inner join TEMP_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id 
                    inner join meal_item_mapping as c ON c.meal_id = b.meal_id 
                    inner join item as d ON d.id = c.item_id 
                    inner join meal_plan as e ON e.id = c.meal_id 
                    where b.parent_id = '$parentid' and a.id = b.child_id $childid $date_str
                    group by b.`date`, e.`meal_name`, b.child_id, d.item_name
                    ) A) B) C order by ChildName) D group by D.`date`, D.categoryId, D.childid

          */
    /*
          echo $sql = "select a.* from(select distinct a.id as childid, a.first_name as ChildName,b.`date` as `date`,
                        c.id as categoryId,(c.category_name) as category,
                        group_concat(d.item_name) as Item,group_concat(d.price) as price, b.`id` as 'temp_id', b.`quantity` from person_details as a 
                        inner join TEMP_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                        item_category as c ON c.id = b.category_id inner join item as d ON 
                        d.id = b.item_id   where b.parent_id = '$parentid'  and a.id = b.child_id $childid
                        $date_str
                        group by b.`date`,c.category_name, b.child_id
                        union
                        select distinct  a.id as childid,a.first_name as ChildName,(b.`date`)as `date`,
                        e.id as categoryId,(e.meal_name) as meal,group_concat(d.item_name) as Item ,group_concat(e.price )as price, b.`id` as 'temp_id', b.`quantity`
                        from person_details as a inner join 
                        TEMP_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                        meal_item_mapping as c ON c.meal_id = b.meal_id inner join item as d ON 
                        d.id = c.item_id  inner join meal_plan as e ON e.id = c.meal_id 
                        where b.parent_id = '$parentid' and a.id = b.child_id $childid
                         $date_str group by b.`date`, e.`meal_name`, b.child_id) a order by ChildName";   */
    
           
             $pay_month = "select * from parent_date_cal_oneMonth_restriction where status = 1 ";

    $pay_month1 = $this->db->query($pay_month)->result_array();
    $pay_date =  $pay_month1[0]['month'];

            $sql = "select D.childid as 'childid', D.ChildName as 'ChildName', D.`date` as 'date', D.categoryId as 'categoryId', D.category as 'category', group_concat(D. Item) as 'Item', group_concat(D.`price`) as 'price', D.`temp_id` as 'temp_id', D.`quantity` as 'quantity' 
                    from (
                    select childid, ChildName,`date`,categoryId,category, Item,IF(`new price`=0.25, 0.25, `price`) as 'price', `temp_id`, `quantity`, item_id, meal_id, parent_id from 
                    (
                    select childid, ChildName,`date`,categoryId,category, Item,price, IF(B.`count` = 0, 0.25, 0) as `new price`, `temp_id`, `quantity`, item_id, meal_id, parent_id
                    from (
                    select A.*, (select count(*) from TEMP_child_menu_item_date_mapping where `child_id` = A.`childid` and `parent_id`= A.`parent_id` and `date` = A.`date` and `meal_id` <> 0) as 'count' from 
                    (select distinct a.id as childid, a.first_name as ChildName,b.`date` as `date`, c.id as categoryId,(c.category_name) as category, d.item_name as Item,d.price as price, b.`id` as 'temp_id', b.`quantity`, b.item_id, b.meal_id, b.parent_id 
                    from person_details as a inner join TEMP_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id 
                    inner join item_category as c ON c.id = b.category_id 
                    inner join item as d ON d.id = b.item_id 
                    where b.parent_id = '$parentid' and a.id = b.child_id $childid $date_str and DATE_FORMAT(b.`date`, '%Y-%m') ='".$pay_date."'
                    group by b.`date`,c.category_name, b.child_id, d.item_name
                    union 
                    select distinct a.id as childid,a.first_name as ChildName,(b.`date`)as `date`, e.id as categoryId,(e.meal_name) as meal,d.item_name as Item ,e.price as price, b.`id` as 'temp_id', b.`quantity`, b.item_id, b.meal_id , b.parent_id 
                    from person_details as a inner join TEMP_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id 
                    inner join meal_item_mapping as c ON c.meal_id = b.meal_id 
                    inner join item as d ON d.id = c.item_id 
                    inner join meal_plan as e ON e.id = c.meal_id 
                    where b.parent_id = '$parentid' and a.id = b.child_id $childid $date_str and DATE_FORMAT(b.`date`, '%Y-%m') ='".$pay_date."'
                    group by b.`date`, e.`meal_name`, b.child_id, d.item_name
                    ) A) B) C order by ChildName) D group by D.`date`, D.categoryId, D.childid";   

            $dd = $this->db->query($sql)->result_array();
            //mysqli_next_result( $this->db->conn_id );
            return $dd;
}


public function Temp_parentitemName1($locid,$date_str,$result2)
{
      
             $sql = "select a.* from(select distinct a.first_name as parentName,b.`date` as `date`,
                        c.id as categoryId,(c.category_name) as category,
                        group_concat(d.item_name) as Item,group_concat(d.price) as price, b.`quantity` from 
                        person_details as a 
                        inner join TEMP_child_menu_item_date_mapping as b ON b.parent_id = a.id 
                        inner join item_category as c ON c.id = b.category_id
                        inner join item as d ON d.id = b.item_id where  a.id = b.parent_id $result2
                        and b.locid='$locid'  $date_str group by b.`date`,c.category_name, b.child_id
                        union
                        select distinct a.first_name as parentName,(b.`date`)as `date`,
                        e.id as categoryId,(e.meal_name) as meal,group_concat(d.item_name) as Item ,group_concat(e.price )as price, b.`quantity`
                        from person_details as a inner join 
                        TEMP_child_menu_item_date_mapping as b ON a.id = b.parent_id inner join 
                        meal_item_mapping as c ON c.meal_id = b.meal_id inner join item as d ON 
                        d.id = c.item_id  inner join meal_plan as e ON e.id = c.meal_id 
                        where  a.id = b.parent_id $result2
                        and b.locid='$locid' $date_str  group by b.`date`, e.`meal_name`, b.child_id) a order by parentName,`date`";

        
 
             return $this->db->query($sql)->result_array();
}

public function transactionReport($id,$childId, $locid)
{
    $result = "'" . implode ( "', '", $childId ) . "'";
    
     $sql = "select  c.first_name as ChildName,sum(a.price) as price, a.`child_id`, a.`parent_id`, a.`date`, a.`locid`, a.`transactionID`, DATE_FORMAT(a.`datetime_added`, '%Y-%m-%d') as paymentDate ,IF(b.`transactionDate` ='1970-01-01','',b.`transactionDate`) as 'transactionDate'
      , a.`paymentStatus`, b.`amount` as 'amount', a.`quantity`
           from ARCHIVE_child_menu_item_date_mapping a
           left join payment_tnx_info b on a.`transactionID` = b.`transactionID`
           inner join person_details c on c.id = a.`child_id` 
           where a.`locid`='".$locid."' and a.`parent_id` = '".$id."' and a.child_id IN(".$result.") group by a.`transactionID` order by a.`id` desc"; 

    return $this->db->query($sql)->result_array();
}


public function transactionReportFilter($locid, $parentid,$childid,$date_str)
{      
        $sql = "select  c.first_name as ChildName, a.`child_id`, a.`parent_id`, a.`date`, a.`locid`, a.`transactionID`, b.`transactionDate`, b.`paymentStatus`, b.`amount`, a.`quantity`
           from ARCHIVE_child_menu_item_date_mapping a
           inner join payment_tnx_info b on a.`transactionID` = b.`transactionID`
           inner join person_details c on c.id = a.`child_id` 
           where a.`locid`='".$locid."' and a.`parent_id` = '".$parentid."' ".$childid." ".$date_str." group by a.`transactionID` order by a.`id` desc";

        return $this->db->query($sql)->result_array();
}

public function transactionReportFilter1($locid,$date_str,$result2)
{
      
    $sql = "select  c.first_name as ChildName, a.`child_id`, a.`parent_id`, a.`date`, a.`locid`, a.`transactionID`, b.`transactionDate`, b.`paymentStatus`, b.`amount`, a.`quantity`
          from ARCHIVE_child_menu_item_date_mapping a
          inner join payment_tnx_info b on a.`transactionID` = b.`transactionID`
          inner join person_details c on c.id = a.`child_id` 
          where a.`locid`='".$locid."' ".$result2." ".$date_str." group by a.`transactionID` order by a.`id` desc";

    return $this->db->query($sql)->result_array();
}

public function ajaxTransactionReport($id,$childId, $locid, $transactionID)
{
   // $result = "'" . implode ( "', '", $childId ) . "'";
    
    $sql1 = "select child_id, parent_id from ARCHIVE_child_menu_item_date_mapping where `transactionID`='".$transactionID."' group by child_id";
    $res =  $this->db->query($sql1);
    $row = $res->result_array();

    $ChildddID =''; 
    for ($i = 0; $i < count($row); $i++) { 
                $ChildddID .= $row[$i]['child_id'].",";
    } 
    $ChildddID = rtrim($ChildddID,','); 
           
        
    
   
    
    $sql = "select a.* from(select distinct a.id as childid, a.first_name as ChildName,b.`date` as `date`,
                  c.id as categoryId,(c.category_name) as category,
                  group_concat(d.item_name) as Item,group_concat(b.price) as price, b.`transactionID`, b.`quantity` from person_details as a 
                  inner join ARCHIVE_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                  item_category as c ON c.id = b.category_id inner join item as d ON 
                  d.id = b.item_id   where b.parent_id = '".$id."' and b.`transactionID`='".$transactionID."' and b.`locid`='".$locid."' and b.child_id IN($ChildddID)and a.id=b.child_id
                  group by b.`date`,c.category_name, b.child_id
                  union
                  select distinct  a.id as childid,a.first_name as ChildName,(b.`date`)as `date`,
                  e.id as categoryId,(e.meal_name) as meal,group_concat(d.item_name) as Item , b.price as price, b.`transactionID`, b.`quantity`
                        from person_details as a inner join 
                        ARCHIVE_child_menu_item_date_mapping as b ON a.parent_id = b.parent_id inner join 
                        meal_item_mapping as c ON c.meal_id = b.meal_id inner join item as d ON 
                        d.id = c.item_id  inner join meal_plan as e ON e.id = c.meal_id 
                        where b.parent_id = '".$id."' and b.`transactionID`='".$transactionID."' and b.`locid`='".$locid."' and  b.child_id IN($ChildddID) and a.id=b.child_id group by b.`date`, e.`meal_name`, b.child_id) a order by `date`, ChildName";
        
            return $this->db->query($sql)->result_array();

}

public function uniqueArchiveInst($id,$date,$parent_id,$childID)
{
   // print_r($childID);
      for($i=0;$i<count($childID);$i++)
      {
           $sql = "UPDATE ARCHIVE_child_menu_item_date_mapping set `unique_ID`='".$id."' WHERE DATE_FORMAT(`date`, '%Y-%m') = '".$date."' and parent_id='".$parent_id."' and child_id='".$childID[$i]."' and `paymentStatus` <> 'Success' "; 
            $result = $this->db->query($sql);
      }
     
  return true;
       
   
}

public function max_minDate()
{
   
    $sql1 = "SELECT min(`date`) as 'mindate', max(`date`) as 'maxdate' from TEMP_child_menu_item_date_mapping";
    return $this->db->query($sql1)->row_array();;
    
}




public function allTransaction($locid)
{
 
  $sql = "select CONCAT(b.first_name,' ',b.last_name) as parent_name,CONCAT(b.mother_name,' ',b.mother_last_name) as mother_name,b.oldid as parish_id,b.`family name` as family_name,a.transactionID,a.transactionDate,a.paymentStatus,sum(a.amount) as amount 
        from payment_tnx_info as a 
        inner join person_details as b on a.parentID=b.id 
        where a.parentID NOT IN (3648, 626) and a.paymentStatus='success' and b.type='parent' and a.locid = '".$locid."' and a.transactionDate > '2018-11-09' 
        group by a.`parentID`,a.`transactionID`"; 
     return $this->db->query($sql)->result_array();
}



public function allTransactionFilter($locid,$date_str,$status)
{
          if($status == 0)
          {
             $sql = "select CONCAT(b.first_name,' ',b.last_name) as parent_name,CONCAT(b.mother_name,' ',b.mother_last_name)  as mother_name, b.oldid as parish_id,b.`family name` as family_name, a.transactionID,a.transactionDate,a.paymentStatus,sum(a.`amount`) as amount from payment_tnx_info as a inner join person_details as b on "
                     . "a.parentID = b.id where a.parentID NOT IN (3648, 626) and b.type='parent' AND a.paymentStatus='declined' AND a.`locid`='".$locid."' ".$date_str." group by b.first_name,mother_name"; 
              return $this->db->query($sql)->result_array();

          }else
          {
            
              $sql = "select CONCAT(b.first_name,' ',b.last_name) as parent_name,CONCAT(b.mother_name,' ',b.mother_last_name) as mother_name,b.oldid as parish_id,b.`family name` as family_name,a.transactionID,a.transactionDate,a.paymentStatus,sum(a.amount) as amount 
                    from payment_tnx_info as a 
                    inner join person_details as b on a.parentID=b.id 
                    where a.parentID NOT IN (3648, 626) and a.paymentStatus='success' and b.type='parent' and a.locid = '".$locid."' ".$date_str." and a.transactionDate > '2018-11-09' 
                    group by a.`parentID`,a.`transactionID`";
            
               return $this->db->query($sql)->result_array();
              
          }

    }


    public function transactionItem($transactionID) 
    {

         $side = '18';

         $sql = " select a.* from (select e.first_name as childName,g.Grade_name,c.meal_name,b.item_name,date_format(a.`date`, '%m/%d/%Y') as `date`,a.price from ARCHIVE_child_menu_item_date_mapping as a
           inner join meal_plan as c ON a.meal_id = c.id
           inner join meal_item_mapping as d ON d.meal_id = c.id
           inner join item as b ON b.id = d.item_id
           inner join person_details as e on e.id=a.child_id
            inner join Classes as f on f.id = e.location
           inner join Child_Grade_Program_Selection as g on g.id = f.Grade_id
           where transactionID = '".$transactionID."' 
           Union All
            select e.first_name as childName,g.Grade_name,c.category_name,b.item_name,date_format(a.`date`, '%m/%d/%Y') as `date`,a.price from ARCHIVE_child_menu_item_date_mapping as a
            inner join item as b ON b.id = a.item_id
           inner join item_category as c ON a.category_id = c.id
           inner join person_details as e on e.id=a.child_id
            inner join Classes as f on f.id = e.location
           inner join Child_Grade_Program_Selection as g on g.id = f.Grade_id
           where transactionID = '".$transactionID."' and c.id != '".$side."' ) a order by a.`date`,a.childName asc"; 

            return $this->db->query($sql)->result_array();

      
    }


public function bmTransactiondiscount($transactionID)
{

          $sql = "select b.discount as discount from payment_tnx_info as a
        inner join discount as b on a.parentID = b.parent_id
        where a.transactionID = '".$transactionID."'";
             return $this->db->query($sql)->result_array();

}


        public function uncheckDate($parentIDD, $childID, $startDate, $endDate)
        {
            $sqlrestDate2 = "select `date` from child_menu_item_date_mapping where `status` = 1 and `child_id` =".$childID." and `parent_id`=".$parentIDD." and `item_id`=0 and `meal_id`=0 and `category_id`=0 and `date` between '".$startDate."' and '".$endDate."'";
            return $this->db->query($sqlrestDate2)->result_array();
        }
        
        public function payment_info_parent($txnID, $parent_id)
        {
             $sqlrestDate2 = "select `amount`, `transactionDate`, `transactionID` from payment_tnx_info where `parentID` =".$parent_id." and `transactionID` ='".$txnID."'";
             return $this->db->query($sqlrestDate2)->row_array();
        }
    
 
}

?>
