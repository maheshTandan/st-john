 <?php include('application/views/services/service.php');
 //print_r($grades);
 ?>


<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
	
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {extend: 'csv', title: 'Daily Details Order Report'}, {extend: 'excel', title: 'Daily Details Order Report'}, {extend: 'pdf', title: 'Daily Details Order Report'}, { extend: 'print', title: 'Daily Details Order Report'}
        ]
    });
} );
</script>

<div id="page-wrapper" style="min-height: 327px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"></h1>
        </div>
    </div>
 
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Daily Details Order Report
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th style="display: none;">Sr No.</th>
                                            <th>Date</th>
                                            <th>G</th> 
                                            <th>Class</th> 
                                            <th>Student</th> 
                                            <th>Lunch</th> 
                                            <th>DRINK(S)</th> 
                                           
                                        
<!--                                            <th>Edit</th>-->
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php  
                                            $srnum=1;
                                            for($ii=0; $ii<count($grades);$ii++)
                                            {
                                                
                                            
                                                
                                           
                                           
                                            $flag = 0;
                                            for ($i=0; $i<count($reportData);$i++) 
                                            { 
                                               
                                                if($grades[$ii]['Grade_name'] == $reportData[$i]['Grade_name'])
                                                {
                                                    
                                                   $flag++;
                                                

/*							
   $sql = "select a.*, (select count(*) from ARCHIVE_child_menu_item_date_mapping where `date` = a.`date` and parent_id = a.parent_id and child_id = a.child_id and  IF(`item_id` = 0, `meal_id`, `item_id`) IN ('63','64', '999', '998', '1001') and `parent_id` NOT IN (3648, 626, 3678, 3679, 3677, 3675) )as 'qty1' 
from 
(
select c.id as child_id,concat(c.first_name, ' ', c.last_name) as `name`,b.item_name as item, a.`date`, a.`parent_id`
from ARCHIVE_child_menu_item_date_mapping as a inner join item as b ON a.item_id = b.id inner join person_details as c ON a.child_id = c.id where a.date= '".$reportData[$i]['date']."' and a.child_id= '".$reportData[$i]['id']."' and a.item_id IN(63,64,999,998, 1001)
) a group by child_id"; */
   
  $sql = "select  AA.child_id, AA.`name`, AA.`item`, AA.`date`, AA.`parent_id`,  (AA.quantity + AA.extra) AS 'qty1' 
from (
SELECT 
    a.*,
    (SELECT 
            COUNT(*)
        FROM
            ARCHIVE_child_menu_item_date_mapping
        WHERE
            `date` = a.`date`
                AND parent_id = a.parent_id
                AND child_id = a.child_id
                AND `item_id` IN ('1001' , '1000')
                AND `parent_id` NOT IN (3648 , 626, 3678, 3679, 3677, 3675)) AS 'extra'
FROM
    (SELECT 
        c.id AS child_id,
            CONCAT(c.first_name, ' ', c.last_name) AS `name`,
            b.item_name AS item,
            a.`date`,
            a.`parent_id`,
            a.`quantity`
    FROM
        ARCHIVE_child_menu_item_date_mapping AS a
    INNER JOIN item AS b ON a.item_id = b.id
    INNER JOIN person_details AS c ON a.child_id = c.id
    WHERE
        a.date = '".$reportData[$i]['date']."'
            AND a.child_id = '".$reportData[$i]['id']."'
            AND a.item_id IN (63 , 64, 999, 998, 1001)) a )AA
            GROUP BY AA.child_id";

                             $sql1 = $this->db->query($sql); 
                             $sql2 = $sql1->result_array();

                           //  print_r($sql2); die;
				
                                            ?>
                                            <tr  role="row">
                                                <td style="display:none;"><?php echo $srnum++; ?></td>
<!--                                                <td ><?php //echo $reportData[$i]['date'] ?></td>-->
                                                <td ><?php if($flag == 1){ $date=date_create($reportData[$i]['date']);
                                                                            echo "<b>".date_format($date,"d M, Y")."</b>";              
                                                                         }else{ } ?></td>
                                                <td ><?php if($flag == 1){ echo $reportData[$i]['Grade_name']; }else{ } ?></td>
                                                <td ><?php if($flag == 1){ echo $reportData[$i]['teacher']; }else{ } ?></td>
<!--                                                <td ><?php // echo $reportData[$i]['teacher'] ?></td>-->
                                                <td ><?php echo $reportData[$i]['Student'] ?></td>
                                                <td ><?php if($reportData[$i]['item_name']=='Juice' || $reportData[$i]['item_name']=='Water' || $reportData[$i]['item_name']=='Chocolate milk' || $reportData[$i]['item_name']=='White milk'){}else{ echo $reportData[$i]['item_name']; } ?></td>
                                                <td> <?php if(isset($sql2[0]['item'])) {
                                               echo $sql2[0]['item']; echo ":".$sql2[0]['qty1'];
                                           } else {
                                               
                                           }   ?> </td>
                                               
                                            
                                            </tr>
                                            <?php } 
                                            
                                                } 
                                                
                                                } ?>
                                       </tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                  
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>

 <?php include('application/views/Footer/footer.php') ?>
