<?php // include('application/views/services/service.php') ?>


<div id="page-wrapper" style="min-height: 327px;">

 <div class="row">
        <div class="col-lg-12">
<!--            <h1 class="page-header" style="text-align:center">Daily Lunch Labels</h1>-->
        </div>
 </div>


 <div class="panel-body">
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

 	<tbody>	
 		<?php
             $recordCount =  count($reportData); 
             $j =0;


            for($i=0;$i<$recordCount;$i++)
             { 

                    $date1 = date("Y-m-d", strtotime($reportData[$i]['date']));
          $sql = "select a.*, (select count(*) from ARCHIVE_child_menu_item_date_mapping where `date` = a.`date` and parent_id = a.parent_id and child_id = a.child_id and  IF(`item_id` = 0, `meal_id`, `item_id`) IN ('63','64', '999', '998') and `parent_id` NOT IN (3648, 626, 3678, 3679, 3677, 3675) )as 'qty1' 
          from 
          (
          select c.id as child_id,concat(c.first_name, ' ', c.last_name) as `name`,b.item_name, b.item_alias, a.`date`, a.`parent_id`
          from ARCHIVE_child_menu_item_date_mapping as a inner join item as b ON a.item_id = b.id inner join person_details as c ON a.child_id = c.id where a.date= '".$date1."' and a.child_id= '".$reportData[$i]['childid']."' and a.item_id IN(63,64,999,998)
          ) a group by child_id";  


                        $sql1 = $this->db->query($sql); 
                             $sql2 = $sql1->result_array();
                            //  print_r($sql2); die;
                if($j== 0) {


                 ?>
                      	<tr>
                     <?php  }	?>
                <td>
 				     <div><?php print_r($reportData[$i]['childname']); ?></div>
 				     <div>
 				     	<span><?php print_r($reportData[$i]['date']); echo ","; ?></span>
 				     	<span><?php print_r($reportData[$i]['COD_Val']);  echo ","; ?></span>
 				     	<span><?php print_r($reportData[$i]['meal_alias']); ?></span>
              <span><?php 
              if($reportData[$i]['meal_alias'] == 'A' || $reportData[$i]['meal_alias'] == 'B')
              {
                 if(isset($sql2[0]['item_alias']))

                       {
                            echo ",".$sql2[0]['item_alias'];
                       }else
                       {
                         
                       }
              }

             
               ?></span>
 				     </div>
 				     <div>
 				     	<span><?php print_r($reportData[$i]['teacher']); ?></span>
 				     </div>
 			    </td>
           		<?php
           		 ++$j;
                if($j == 4) { ?>
                   </tr>
               <?php $j=0 ; }
             }

 		 ?>
 	</tbody>

</table>
</div>


</div>







<?php
  //$this->load->view('Footer/footer');
?> 
