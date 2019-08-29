<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

   class BmTeacherReportModel extends CI_Model {

       function __construct()
      {
            parent::__construct();
      }


    function showTeacherGrade($date) {
             $date1 = date("Y-m-d", strtotime($date));

		 // $sql = "select distinct result.childname,result.meal,DATE_FORMAT(result.date,'%m/%d/%Y') as date,b.Grade_id,result.item,b.teacher from(select distinct item.first_name as childname,item.location,item.date,  item.item,meal.meal from
			//     (select CONCAT(a.first_name,' ',a.last_name) as first_name,a.location,b.child_id,group_concat(c.item_alias) as item,b.`date` as `date` from person_details as a inner join ARCHIVE_child_menu_item_date_mapping as b ON a.id = b.child_id inner join item as c ON c.id = b.item_id where b.`date`='$date1' group by b.child_id ) as item join 
			 
			//    (select b.child_id, group_concat(d.meal_alias)  as meal, b.`date` as `date` from person_details as a inner join ARCHIVE_child_menu_item_date_mapping as b ON a.id = b.child_id inner Join meal_plan as d ON d.id = b.meal_id where b.`date`='$date1' group by b.child_id) as meal ON item.child_id = meal.child_id ) as result 

			//    left join (select b.teacher,a.Grade_id,a.id,b.COD_Val from Classes as a inner join Child_Grade_Program_Selection as b ON a.Grade_id = b.id ) as b ON b.id = result.location where date='$date1'"; 


         //    $sql = "select distinct result.childname,result.meal,DATE_FORMAT(result.date,'%m/%d/%Y') as date,b.Grade_id,b.teacher from
         // (select CONCAT(a.first_name,' ',a.last_name) as childname , group_concat(d.meal_alias) as meal, b.`date` as `date`,a.location from person_details as a inner join ARCHIVE_child_menu_item_date_mapping as b ON a.id = b.child_id inner Join meal_plan as d ON d.id = b.meal_id where b.`date`='$date1' group by b.child_id)  as result 

         // left join (select b.teacher,a.Grade_id,a.id as id,b.COD_Val from Classes as a inner join Child_Grade_Program_Selection as b ON a.Grade_id = b.id ) as b ON b.id = result.location where `date`='$date1'"; 


//            $sql = "select distinct result.childid, result.childname,DATE_FORMAT(result.date,'%m/%d/%Y') as `date`,result.meal_alias,b.COD_Val,b.teacher 
// from
// (select A.childid, A.`childname`, A.`date`,if( (A.qty1 = 0 or A.qty1 = 1), A.meal_alias, concat(A.qty1,A.meal_alias)) as 'meal_alias', A.`location` from (
// select `date`, childname, meal_id, meal_alias, location,childid,
// (select count(*) from ARCHIVE_child_menu_item_date_mapping where `date` = result.`date` and `date`=result.`date` and child_id = result.childid and  IF(`item_id` = 0, `meal_id`, `item_id`) IN ('63','64', '999', '998', '1000', '1001') and `parent_id` NOT IN (3648, 626, 3678, 3679, 3677, 3675) ) as 'qty1'
// from
// (select b.child_id as childid,CONCAT(a.first_name,' ',a.last_name) as childname ,IF(b.`item_id` = 0, b.`meal_id`, b.`item_id`) as 'meal_id', IF(b.`item_id` = 0, d.`meal_alias`, c.`item_alias`) as 'meal_alias', b.`date` as `date`,a.location from person_details as a 
// inner join ARCHIVE_child_menu_item_date_mapping as b ON a.id = b.child_id 
// inner join payment_tnx_info as e ON e.transactionID = b.transactionID
// left Join meal_plan as d ON d.id = b.meal_id 
// left join item c on c.`id` = b.`item_id`
// where e.paymentStatus ='success' and b.`date`='$date1' and b.`category_id` <> 18 and (b.`item_id` <> 0 or b.`meal_id` <> 0) and b.`parent_id` NOT IN (3648, 626, 3678, 3679, 3677, 3675)
// group by b.child_id) 
// result) A) result
// left join 
// (select  b.teacher,a.Grade_id,a.id as id,b.COD_Val from Classes as a inner join Child_Grade_Program_Selection as b ON a.Grade_id = b.id ) as b 
// ON 
// b.id = result.location where `date`='$date1'"; 




//   $sql = "select distinct result.childid, result.childname,DATE_FORMAT(result.date,'%m/%d/%Y') as `date`,result.item_alias,result.meal_alias,b.COD_Val,b.teacher 
// from
// (select A.childid, A.`childname`, A.`date`, A.`item_alias`, A.meal_alias,  A.`location` from (
// select `date`, childname, meal_id, item_alias,meal_alias, location,childid
// from
// (select b.child_id as childid,CONCAT(a.first_name,' ',a.last_name) as childname ,b.item_id, c.item_alias, b.meal_id, d.meal_alias, b.`date` as `date`,a.location from person_details as a 
// inner join ARCHIVE_child_menu_item_date_mapping as b ON a.id = b.child_id 
// inner join payment_tnx_info as e ON e.transactionID = b.transactionID
// left Join meal_plan as d ON d.id = b.meal_id 
// left join item c on c.`id` = b.`item_id`
// where e.paymentStatus ='success' and b.`date`='".$date1."' and b.`category_id` <> 18 and (b.`item_id` <> 0 or b.`meal_id` <> 0) and b.`parent_id` NOT IN (3648, 626, 3678, 3679, 3677, 3675)
// group by b.child_id,b.meal_id,b.item_id) 
// result) A) result
// left join 
// (select  b.teacher,a.Grade_id,a.id as id,b.COD_Val from Classes as a inner join Child_Grade_Program_Selection as b ON a.Grade_id = b.id ) as b 
// ON 
// b.id = result.location where `date`='".$date1."'"; 


             $sql = "select distinct result.childid, result.childname,DATE_FORMAT(result.date,'%m/%d/%Y') as `date`,GROUP_CONCAT(result.meal_alias) as meal_alias,b.COD_Val,b.teacher from (select A.childid, A.`childname`, A.`date`,if( (A.qty1 = 0 or A.qty1 = 1), A.meal_alias, concat(A.qty1,A.meal_alias)) as 'meal_alias', A.`location` from ( select `date`, childname, meal_id, meal_alias, location,childid, (select count(*) from ARCHIVE_child_menu_item_date_mapping where `date` = result.`date` and `date`=result.`date` and child_id = result.childid and IF(`item_id` = 0, `meal_id`, `item_id`) IN ('63','64', '999', '998', '1000', '1001') and `parent_id` NOT IN (3648, 626, 3678, 3679, 3677, 3675) ) as 'qty1' from (select b.child_id as childid,CONCAT(a.first_name,' ',a.last_name) as childname ,IF(b.`item_id` = 0, b.`meal_id`, b.`item_id`) as 'meal_id', IF(b.`item_id` = 0, d.`meal_alias`, c.`item_alias`) as 'meal_alias', b.`date` as `date`,a.location from person_details as a inner join ARCHIVE_child_menu_item_date_mapping as b ON a.id = b.child_id inner join payment_tnx_info as e ON e.transactionID = b.transactionID left Join meal_plan as d ON d.id = b.meal_id left join item c on c.`id` = b.`item_id` where e.paymentStatus ='success' and b.`date`='".$date1."' and b.`category_id` <> 18 and (b.`item_id` <> 0 or b.`meal_id` <> 0) and b.`parent_id` NOT IN (3648, 626, 3678, 3679, 3677, 3675) ) result) A) result left join (select b.teacher,a.Grade_id,a.id as id,b.COD_Val from Classes as a inner join Child_Grade_Program_Selection as b ON a.Grade_id = b.id ) as b ON b.id = result.location where `date`='".$date1."' GROUP BY result.childid";

			     $sql1 = $this->db->query($sql); 
                       return $sql1->result_array();
      }
      
    function monthlyOrderReport($date) 
    {
        $date1 = date("Y-m", strtotime($date)); 
        $sql = "select `item_id` from dynamic_itemID_monthlyOrderReport where `status` = 1"; 
        $sql1 = $this->db->query($sql); 
        $result = $sql1->result_array();
        $itemids = 'IN (';
        for($i = 0; $i < count($result); $i++)
        {
            $itemids .="'".$result[$i]['item_id']."', ";
        }
        $itemids = rtrim($itemids,", ");
        $itemids .= ")";
        
     /*   
        $sql = "select B.`date`,sum(`LUNCH A`) as `LUNCH A`,sum(`LUNCH B`) as `LUNCH B`, sum(`LUNCH S`) as `LUNCH S`,sum(`Chocolate milk`) as `Chocolate milk`,sum(`White milk`) as `White milk`,sum(`Extra Milk`) as `Extra Milk`, sum(`Juice`) as `Juice`, sum(`Water`) as `Water`, sum(`Extra Drink`) as `Extra Drink` from (select A.`date`,
                case when LEFT (item_name, 1)='A' then quantity else '' end as `LUNCH A`, 
                case when LEFT (item_name, 1)='B' then quantity else '' end as `LUNCH B`, 
                case when (LEFT (item_name, 1)<>'B' AND LEFT (item_name, 1)<>'A' AND item_name <>'Chocolate milk' AND item_name<>'White milk' AND item_name<>'Extra Milk' AND item_name<>'Juice' AND item_name<>'Water' AND item_name<>'Extra Drink') then quantity else '' end as `LUNCH S`, 
                case when item_name='Chocolate milk' then quantity else '' end as `Chocolate milk`, 
                case when item_name='White milk' then quantity else '' end as `White milk`, 
                case when item_name='Extra Milk' then quantity else '' end as `Extra Milk`, 
                case when item_name='Juice' then quantity else '' end as `Juice`,
                case when item_name='Water' then quantity else '' end as `Water`,
                case when item_name='Extra Drink' then quantity else '' end as `Extra Drink`
                from (select a.`date`,  IF(a.`item_id` = 0, a.`meal_id`, a.`item_id`) as 'id', IF(a.`item_id` = 0, c.`meal_name`, b.`item_name`) as 'item_name', sum(a.`quantity`) as 'quantity'
                from ARCHIVE_child_menu_item_date_mapping a
                left join `item` b on b.`id` = a.`item_id`
                left join `meal_plan` c on c.`id` = a.`meal_id`
                where (a.`item_id` ".$itemids." or a.`meal_id` <> 0) and a.`locid` = '72290' and DATE_FORMAT(a.`date`, '%Y-%m') = '".$date1."'
                group by a.`date`, a.`meal_id`, a.`item_id`) A)B group by B.`date`"; */
      /*
        $sql = "select B.`date`,sum(`LUNCH A`) as `LUNCH A`,sum(`LUNCH B`) as `LUNCH B`, sum(`LUNCH S`) as `LUNCH S`, sum(`Chocolate milk`) as `Chocolate milk`,sum(`White milk`) as `White milk`, sum(`Juice`) as `Juice`, sum(`Water`) as `Water` from (
                select A.`date`, 
                case when LEFT (item_name, '1')='A' then quantity2 else '' end as `LUNCH A`, 
                case when LEFT (item_name, '1')='B' then quantity2 else '' end as `LUNCH B`,
                case when (LEFT (item_name, 1)<>'B' AND LEFT (item_name, 1)<>'A' AND item_name <>'Chocolate milk' AND item_name<>'White milk' AND item_name<>'Extra Milk' AND item_name<>'Juice' AND item_name<>'Water' AND item_name<>'Extra Drink') then quantity2 else '' end as `LUNCH S`,   
                case when item_name='Chocolate milk' then quantity2 else '' end as `Chocolate milk`, 
                case when item_name='White milk' then quantity2 else '' end as `White milk`, 
                case when item_name='Juice' then quantity2 else '' end as `Juice`,
                case when item_name='Water' then quantity2 else '' end as `Water`
                from (
                select *,(quantity1+extra) as quantity2 from (
                select `parent_id`, `child_id`, `date`, id, item_name, quantity as quantity1,
                (select count(*) from ARCHIVE_child_menu_item_date_mapping where `date` = aa.`date` and parent_id = aa.parent_id and child_id = aa.child_id and  IF(`item_id` = 0, `meal_id`, `item_id`) IN ('1001','1000','100','101') and parent_id not in('3648','626')  ) as extra 
                from (
                select a.`parent_id`, a.`child_id`,a.`date`, IF(a.`item_id` = 0, a.`meal_id`, a.`item_id`) as 'id', IF(a.`item_id` = 0, c.`meal_name`, b.`item_name`) as 'item_name', a.`quantity` from ARCHIVE_child_menu_item_date_mapping a left join `item` b on b.`id` = a.`item_id` left join `meal_plan` c on c.`id` = a.`meal_id` where (a.`item_id` ".$itemids." or a.`meal_id` <> 0) and a.`locid` = '72290' and DATE_FORMAT(a.`date`, '%Y-%m') = '".$date1."' and parent_id not in('3648','626') group by a.`parent_id`, a.`child_id`,a.`date`, `id`) aa ) bb )A)B group by B.`date`";
       */
        
        /*final query by alias
        
        $sql = "select B.`date`,sum(`LUNCH A`) as `LUNCH A`,sum(`LUNCH B`) as `LUNCH B`, sum(`LUNCH S`) as `LUNCH S`, sum(`Chocolate milk`) as `Chocolate milk`,sum(`White milk`) as `White milk`, sum(`Juice`) as `Juice`, sum(`Water`) as `Water` from (
                select A.`date`, 
                case when LEFT (item_alias, '1')='A' then quantity2 else '' end as `LUNCH A`, 
                case when LEFT (item_alias, '1')='B' then quantity2 else '' end as `LUNCH B`,
                case when `item_name` IN ('Hot Dog','Extra Hot Dog','Pizza','Extra Pizza') then quantity2 else '' end as `LUNCH S`,   
                case when LEFT (item_alias, '1')='C' then quantity2 else '' end as `Chocolate milk`, 
                case when LEFT (item_alias, '1')='W' then quantity2 else '' end as `White milk`, 
                case when LEFT (item_alias, '1')='J' then quantity2 else '' end as `Juice`,
                case when item_name='Water' then quantity2 else '' end as `Water`
                from (
                select *,(quantity1+extra) as quantity2 from (
                select `parent_id`, `child_id`, `date`, id, item_name, item_alias,quantity as quantity1,
                (select count(*) from ARCHIVE_child_menu_item_date_mapping where `date` = aa.`date` and parent_id = aa.parent_id and child_id = aa.child_id and  IF(`item_id` = 0, `meal_id`, `item_id`) IN ('1001','1000') and parent_id not in('3648','626','3678','3679','3677','3675') )as extra
                from (
                select a.`parent_id`, a.`child_id`,a.`date`, IF(a.`item_id` = 0, a.`meal_id`, a.`item_id`) as 'id', IF(a.`item_id` = 0, c.`meal_name`, b.`item_name`) as 'item_name', IF(a.`item_id` = 0, c.`meal_alias`, b.`item_alias`) as 'item_alias', a.`quantity` from ARCHIVE_child_menu_item_date_mapping a left join `item` b on b.`id` = a.`item_id` left join `meal_plan` c on c.`id` = a.`meal_id` where (a.`item_id` IN (63, 64, 1001, 999, 998, 1000) or a.`meal_id` <> 0) and a.`locid` = '72290' and DATE_FORMAT(a.`date`, '%Y-%m') = '2018-12' and parent_id not in('3648','626','3678','3679','3677','3675') and `meal_id` not IN ('86','93','100','101') group by a.`parent_id`, a.`child_id`,a.`date`, `id`) aa ) bb 
                union all
                select *,(quantity1) as quantity2 from (
                select `parent_id`, `child_id`, `date`, id, item_name, item_alias,quantity as quantity1,'' as extra
                from (
                select a.`parent_id`, a.`child_id`,a.`date`, IF(a.`item_id` = 0, a.`meal_id`, a.`item_id`) as 'id', IF(a.`item_id` = 0, c.`meal_name`, b.`item_name`) as 'item_name', IF(a.`item_id` = 0, c.`meal_alias`, b.`item_alias`) as 'item_alias', a.`quantity` from ARCHIVE_child_menu_item_date_mapping a left join `item` b on b.`id` = a.`item_id` left join `meal_plan` c on c.`id` = a.`meal_id` where (a.`item_id` IN (63, 64, 1001, 999, 998, 1000) or a.`meal_id` <> 0) and a.`locid` = '72290' and DATE_FORMAT(a.`date`, '%Y-%m') = '2018-12' and parent_id not in('3648','626','3678','3679','3677','3675') and `meal_id`  IN ('86','93','100','101') group by a.`parent_id`, a.`child_id`,a.`date`, `id`) aa ) bb
                )A)B group by B.`date`";  

        */
        
        
     /*
        
       $sql = "select B.`date`,sum(`LUNCH A`) as `LUNCH A`,sum(`LUNCH B`) as `LUNCH B`, sum(`LUNCH S`) as `LUNCH S`, sum(`Chocolate milk`) as `Chocolate milk`,sum(`White milk`) as `White milk`, sum(`Juice`) as `Juice`, sum(`Water`) as `Water` from (
                select A.`date`, 
                case when LEFT (item_name, '1')='A' then quantity2 else '' end as `LUNCH A`, 
                case when LEFT (item_name, '1')='B' then quantity2 else '' end as `LUNCH B`,
                case when `item_name` IN ('Hot Dog','Extra Hot Dog','Pizza','Extra Pizza') then quantity2 else '' end as `LUNCH S`,   
                case when item_name='Chocolate milk' then quantity2 else '' end as `Chocolate milk`, 
                case when item_name='White milk' then quantity2 else '' end as `White milk`, 
                case when item_name='Juice' then quantity2 else '' end as `Juice`,
                case when item_name='Water' then quantity2 else '' end as `Water`
                from (
                select *,(quantity1+extra) as quantity2 from (
                select `parent_id`, `child_id`, `date`, id, item_name, quantity as quantity1,
                (select count(*) from ARCHIVE_child_menu_item_date_mapping where `date` = aa.`date` and parent_id = aa.parent_id and child_id = aa.child_id and  IF(`item_id` = 0, `meal_id`, `item_id`) IN ('1001','1000') and parent_id not in('3648','626','3678','3679','3677','3675') )as extra
                from (
                select a.`parent_id`, a.`child_id`,a.`date`, IF(a.`item_id` = 0, a.`meal_id`, a.`item_id`) as 'id', IF(a.`item_id` = 0, c.`meal_name`, b.`item_name`) as 'item_name', a.`quantity` from 
                ARCHIVE_child_menu_item_date_mapping a
                inner join payment_tnx_info d on d.transactionID = a.transactionID
                left join `item` b on b.`id` = a.`item_id` 
                left join `meal_plan` c on c.`id` = a.`meal_id` 
                where d.paymentStatus='success' and (a.`item_id` ".$itemids." or a.`meal_id` <> 0) and a.`locid` = '72290' and DATE_FORMAT(a.`date`, '%Y-%m') = '".$date1."' and parent_id not in('3648','626','3678','3679','3677','3675') and `meal_id` not IN ('86','93','100','101') group by a.`parent_id`, a.`child_id`,a.`date`, `id`) aa ) bb 
                union all
                select *,(quantity1) as quantity2 from (
                select `parent_id`, `child_id`, `date`, id, item_name, quantity as quantity1,'' as extra
                from (
                select a.`parent_id`, a.`child_id`,a.`date`, IF(a.`item_id` = 0, a.`meal_id`, a.`item_id`) as 'id', IF(a.`item_id` = 0, c.`meal_name`, b.`item_name`) as 'item_name', a.`quantity` 
                from ARCHIVE_child_menu_item_date_mapping a 
                inner join payment_tnx_info d on d.transactionID = a.transactionID
                left join `item` b on b.`id` = a.`item_id` 
                left join `meal_plan` c on c.`id` = a.`meal_id` 
                where d.paymentStatus='success' and (a.`item_id` ".$itemids." or a.`meal_id` <> 0) and a.`locid` = '72290' and DATE_FORMAT(a.`date`, '%Y-%m') = '".$date1."' and parent_id not in('3648','626','3678','3679','3677','3675') and `meal_id`  IN ('86','93','100','101') group by a.`parent_id`, a.`child_id`,a.`date`, `id`) aa ) bb
                )A)B group by B.`date`";
    
    */
    
    
       $sql = "SELECT 
    B.`date`,
    SUM(`LUNCH A`) AS `LUNCH A`,
    SUM(`LUNCH B`) AS `LUNCH B`,
    SUM(`LUNCH S`) AS `LUNCH S`,
    SUM(`Chocolate milk`) AS `Chocolate milk`,
    SUM(`White milk`) AS `White milk`,
    SUM(`Juice`) AS `Juice`,
    SUM(`Water`) AS `Water`
FROM
    (SELECT 
        A.`date`,
            CASE
                WHEN LEFT(meal_name, '1') = 'A' THEN quantity1
                ELSE ''
            END AS `LUNCH A`,
            CASE
                WHEN LEFT(meal_name, '1') = 'B' THEN quantity1
                ELSE ''
            END AS `LUNCH B`,
            CASE
                WHEN `meal_name` IN ('Hot Dog' , 'Extra Hot Dog', 'Pizza', 'Extra Pizza') THEN quantity1
                ELSE ''
            END AS `LUNCH S`,
            CASE
                WHEN item_name = 'Chocolate milk' THEN quantity2
                ELSE ''
            END AS `Chocolate milk`,
            CASE
                WHEN item_name = 'White milk' THEN quantity2
                ELSE ''
            END AS `White milk`,
            CASE
                WHEN item_name = 'Juice' THEN quantity2
                ELSE ''
            END AS `Juice`,
            CASE
                WHEN item_name = 'Water' THEN quantity2
                ELSE ''
            END AS `Water`
    FROM
        (SELECT 
        bb.*, (bb.quantity1 + bb.extra) AS quantity2
    FROM
        (SELECT 
            `parent_id`,
            `child_id`,
            `date`,
            item_id,
            item_name,
            meal_id,
            meal_name,
            quantity AS quantity1,
            (SELECT 
                    COUNT(*)
                FROM
                    ARCHIVE_child_menu_item_date_mapping
                WHERE
                    `date` = aa.`date`
                        AND parent_id = aa.parent_id
                        AND child_id = aa.child_id
                        AND `item_id` IN ('1001' , '1000')
                        AND parent_id NOT IN ('3648' , '626', '3678', '3679', '3677', '3675')) AS extra
    FROM
        (SELECT 
            a.`parent_id`,
            a.`child_id`,
            a.`date`,
            a.`item_id`,
            b.`item_name`,
			a.`meal_id`,
            c.`meal_name`,
            a.`quantity`
    FROM
        ARCHIVE_child_menu_item_date_mapping a
    INNER JOIN payment_tnx_info d ON d.transactionID = a.transactionID
    LEFT JOIN `item` b ON b.`id` = a.`item_id`
    LEFT JOIN `meal_plan` c ON c.`id` = a.`meal_id`
    WHERE
            d.paymentStatus = 'success'
            AND (a.`item_id` ".$itemids." OR a.`meal_id` <> 0)
            AND a.`locid` = '72290'
            AND DATE_FORMAT(a.`date`, '%Y-%m') = '".$date1."'
            AND parent_id NOT IN ('3648' , '626', '3678', '3679', '3677', '3675')
            AND `meal_id` NOT IN ('86' , '93', '100', '101')
    GROUP BY a.`parent_id` , a.`child_id` , a.`date` ,  a.`item_id`, a.`meal_id`) aa) bb 
    UNION ALL 
    SELECT 
        bb.*, (bb.quantity1) AS quantity2
    FROM
        (SELECT 
            `parent_id`,
            `child_id`,
            `date`,
            item_id,
            item_name,
            meal_id,
            meal_name,
            quantity AS quantity1,
            '' AS extra
    FROM
        (SELECT 
            a.`parent_id`,
            a.`child_id`,
            a.`date`,
            a.`item_id`,
            b.`item_name`,
			a.`meal_id`,
            c.`meal_name`,
            a.`quantity`
    FROM
        ARCHIVE_child_menu_item_date_mapping a
    INNER JOIN payment_tnx_info d ON d.transactionID = a.transactionID
    LEFT JOIN `item` b ON b.`id` = a.`item_id`
    LEFT JOIN `meal_plan` c ON c.`id` = a.`meal_id`
    WHERE
            d.paymentStatus = 'success'
	    AND a.`locid` = '72290'
            AND DATE_FORMAT(a.`date`, '%Y-%m') = '".$date1."'
            AND parent_id NOT IN ('3648' , '626', '3678', '3679', '3677', '3675')
            AND `meal_id` IN ('86' , '93', '100', '101')
    GROUP BY a.`parent_id` , a.`child_id` , a.`date` ,  a.`item_id`, a.`meal_id`) aa) bb
    ) A
) B
GROUP BY B.`date`";
     
        $sql1 = $this->db->query($sql); 
        return $sql1->result_array();
    }
    
     function dailyDetailOrderReport($date) 
    {
      /*
        $date1 = date("Y-m", strtotime($date)); 
        $sql = "select `item_id` from dynamic_itemID_monthlyOrderReport where `status` = 1"; 
        $sql1 = $this->db->query($sql); 
        $result = $sql1->result_array();
        $itemids = 'IN (';
        for($i = 0; $i < count($result); $i++)
        {
            $itemids .="'".$result[$i]['item_id']."', ";
        }
        $itemids = rtrim($itemids,", ");
        $itemids .= ")"; */
        
     
        

   $sql = "select A.`date`, A.Grade_name, A.teacher, A.parent_id, A.`name` as 'Student', A.child_id as `id`, REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(GROUP_CONCAT(distinct A.item_name), 'White milk', ''),'Chocolate milk',''),',',' '),'Water',''),'Juice', ''),'Extra Milk', ''), 'Extra Drink', '') as 'item_name'
          from (
                select AA.*, b.Grade_id, b.Grade, c.Grade_name, c.teacher  from (
                select child_id, parent_id, `date`, `category_id`, `item_id`, `item_name`, `quantity`, `status`, `locid`, `name`, location
                from 
                (select a.child_id, a.parent_id, a.`date`, a.`category_id`, IF(a.`item_id` = 0, a.`meal_id`, a.`item_id`) as 'item_id', IF(a.`item_id` = 0, d.`meal_name`, c.`item_name`) as 'item_name', a.`quantity`, a.`status`, a.`locid`,
                concat(b.first_name, ' ', b.last_name) as `name`, b.location
                from ARCHIVE_child_menu_item_date_mapping a
                inner join payment_tnx_info e on e.transactionID = a.transactionID
                inner join person_details b on b.id = a.child_id 
                left join item c on c.id = a.`item_id`
                left join meal_plan d on d.id = a.`meal_id`
                where e.paymentStatus='success' and a.`category_id` <> 18 and (a.`item_id` <> 0 or a.`meal_id` <> 0) and a.`parent_id` NOT IN (3648, 626, 3678, 3679, 3677, 3675) and a.`date` = '".$date."'
               
                ) 
                a
                ) AA
                inner join Classes b on AA.location = b.id
                inner join Child_Grade_Program_Selection c on c.id = b.Grade_id ) A WHERE A.`date` = '".$date."'
                group by A.child_id"; 



       
        
        $sql1 = $this->db->query($sql); 
        return $sql1->result_array();
    }
    
    function getGrade()
    {
        $sql = "select distinct a.id,a.`Grade_name`, a.`teacher` from Child_Grade_Program_Selection as a inner join Classes as b ON a.id = b.Grade_id"; 
        
        $sql1 = $this->db->query($sql); 
        return $sql1->result_array();
    }
    
    
    function activateDeactivateCal()
    {
        $sql = "select `status` from activateDeactivateCal where `id`=1"; 
        
        $sql1 = $this->db->query($sql); 
        return $sql1->row_array();
    }
    
    function activateDeactivateCalUpdate($status)
    {
         $data = array(
                 'status' => $status,
                );
        $this->db->where('id', 1);
        return $this->db->update('activateDeactivateCal', $data);
    }
    
     function milkOnlyOrderReport($date) 
    {
        $date1 = date("Y-m", strtotime($date)); 
//        $sql = "select `item_id` from dynamic_itemID_monthlyOrderReport where `status` = 1"; 
//        $sql1 = $this->db->query($sql); 
//        $result = $sql1->result_array();
//        $itemids = 'IN (';
//        for($i = 0; $i < count($result); $i++)
//        {
//            $itemids .="'".$result[$i]['item_id']."', ";
//        }
//        $itemids = rtrim($itemids,", ");
//        $itemids .= ")";

        $sql = "SELECT 
        B.`date`,
        SUM(`Chocolate milk`) AS `Chocolate milk`,
        SUM(`White milk`) AS `White milk`,
        SUM(`Extra Milk`) AS `Extra Milk`
    FROM
        (SELECT 
            A.`date`,
                CASE
                    WHEN item_name = 'Chocolate milk' THEN quantity1
                    ELSE ''
                END AS `Chocolate milk`,
                CASE
                    WHEN item_name = 'White milk' THEN quantity1
                    ELSE ''
                END AS `White milk`,
                CASE
                    WHEN item_name = 'Extra Milk' THEN quantity2
                    ELSE ''
                END AS `Extra Milk`
        FROM
            (SELECT 
            bb.*, (bb.quantity1 + bb.extra) AS quantity2
        FROM
            (SELECT 
            `parent_id`,
                `child_id`,
                `date`,
                item_id,
                item_name,
                meal_id,
                meal_name,
                quantity AS quantity1,
                (SELECT 
                        COUNT(*)
                    FROM
                        ARCHIVE_child_menu_item_date_mapping
                    WHERE
                            `date` = aa.`date`
                            AND parent_id = aa.parent_id
                            AND child_id = aa.child_id
                            AND (meal_id = 0 or item_id <> 0)
                            AND (`item_id` IN ('1001'))
                            AND `price` = '0.5'
                            AND parent_id NOT IN ('3648' , '626', '3678', '3679', '3677', '3675')) AS extra
        FROM
            (SELECT 
            a.`parent_id`,
                a.`child_id`,
                a.`date`,
                a.`item_id`,
                b.`item_name`,
                a.`meal_id`,
                c.`meal_name`,
                a.`quantity`
        FROM
            ARCHIVE_child_menu_item_date_mapping a
        INNER JOIN payment_tnx_info d ON d.transactionID = a.transactionID
        LEFT JOIN `item` b ON b.`id` = a.`item_id`
        LEFT JOIN `meal_plan` c ON c.`id` = a.`meal_id`
        WHERE
                d.paymentStatus = 'success'
                AND a.`item_id` IN ('63' , '64', '1001')
                AND a.`meal_id` = 0
                AND a.`price` = '0.5'
                AND a.`locid` = '72290'
                AND DATE_FORMAT(a.`date`, '%Y-%m') = '".$date1."'
                AND parent_id NOT IN ('3648' , '626', '3678', '3679', '3677', '3675')
        GROUP BY a.`parent_id` , a.`child_id` , a.`date` , a.`item_id` , a.`meal_id`) aa) bb 
       ) A) B
    GROUP BY B.`date`";
     
        $sql1 = $this->db->query($sql); 
        return $sql1->result_array();
    }
    
    
    

}


 ?>
