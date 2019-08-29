<?php include('application/views/services/service.php');

// print_r($personalInfo); die;
?>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#js-date').datepicker();
    $('#dataTables-example').DataTable();

  
});
</script>

<div id="page-wrapper" style="min-height: 327px;">
    <div class="form_error">
          <?php  echo validation_errors(); ?>
    </div>
    <?php 
     $loginstatus   = $this->session->userdata('logged_in'); 
 //  print_r($loginstatus); die;

if($personalInfo['type'] == 'Parent') 
{  ?>


   <div>
 
                  <h5> Please wait, payment is proccessing</h5>

   </div>

<?php } ?>


<?php
 if($personalInfo['type'] == 'Business Manager')
 { ?>

   <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>ChildReportListController/childReportFilter">
  <div class="row ">
    <div class="col-lg-12">
        <div class="form-group">
           <div class="panel panel-default MT-30">
                <div class="panel-body">
                    <div class="form-group clearfix MB-0">


                       <div class="row">

                          <div class="col-md-6">

                                <div class="col-sm-6">
                                    <label for="fname1" class="control-label"> From Date</label>
                                        <div class="input-group date" data-provide="datepicker">
                                        <?php
                                           if($date1 != '' && $date2 != '')
                                           {
                                            $date1 = date("m/d/Y", strtotime($date1));
                                            $date2 = date("m/d/Y", strtotime($date2));
                                           }

                                    
                                        ?>
                                            <input type="text" class="form-control" id="data-date" value="<?php echo $date1 ?>" name="date1" autocomplete="off">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                </div>
   
  

                        
                                <div class="col-sm-6">
                                    <label  for="fname2" class="control-label"> To Date</label>
                                        <div class="input-group date"  data-provide="datepicker">
                                            <input type="text" class="form-control" id="js-date" value="<?php echo $date2 ?>" name="date2" autocomplete="off">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                </div>

                            </div>
     


                                <div class="col-md-6 ">
                                    <label class="col-sm-6"> Parent Name</label>
                                        <select id ="interval1" name="parent[]" class="form-control parentId" multiple="multiple">
                                        <?php  for ($i=0; $i<count($parentList);$i++) { 
                                            if($parentList[$i]['first_name'] !=''){
                                              ?>

                                                    <option value="<?php  echo $parentList[$i]['id']; ?>"><?php  echo $parentList[$i]['first_name']; ?></option>
                                                    
                                            <?php } else{ ?>

                                                     <option value="<?php  echo $parentList[$i]['id']; ?>"><?php  echo $parentList[$i]['mother_name']; ?></option>

                                           <?php }  } ?>
                                        </select>
                                </div>
                        </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                              <input class="calendarSubmit btnMargin" type="submit" id="btnclick" value="Submit" >
                                        </div>
                                    </div>


                    </div>
               </div>
           </div>
        </div>
      </div>
   </div>
  <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Parent Report
                </div>
                
    
                <!-- /.panel-heading -->
                <div class="panel-body">
                   <div class="container-fluid">
                       <div class="row">
                       <div class="col-sm-12 ">
                                   
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>Sr No.</th>
                                            <th>Parent Name</th>
                                        <!--     <th>Child Name</th> -->
                                            <th>Date</th>
                                            <th>Category</th>
                                            <th colspan="1">Item</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>

                                    <tbody id="showReport">
                                    <?php $srnum=1;  $sum = 0;
                                
                                     for ($i=0;$i<count($parentItem);$i++)
                                       { ?>
                                         <tr>
                                           <td><?php echo $srnum++; ?> </td>

                                           <td><?php if($parentItem[$i]['parentName'] != '')
                                           {
                                                echo $parentItem[$i]['parentName'];
                                           }else{
                                                echo $parentItem[$i]['mother_name'];
                                           }

                                           ?> </td>

                                        <!--    <?php 

                                           //   for($j=0;$j<count($child);$j++)
                                              {
                                                ?>
                                             <td  value="<?php // echo $child[$j]['id']; ?>"><?php // echo $child[$j]['first_name']; ?> </td>

                                             <?php }

                                           ?> -->
                                        

                                           <td><?php 
                                            $date = date("m/d/Y", strtotime($parentItem[$i]['date']));
                                              echo $date; 
                                           
                                           ?></td>
                                           <td value="<?php // echo $childItem[$i]['categoryId']; ?>"><?php echo $parentItem[$i]['category']; ?></td>
                                           <td>
                                           <ul style="list-style-type:none">
                                              <?php $str =  explode(',',$parentItem[$i]['Item']);
                                                  
                                                    foreach ($str as $item) 
                                                    {
                                                        echo "<li >$item</li>";
                                                    }
                                             ?>
                                          </ul>
                                           </td>
                                          <td><?php echo $parentItem[$i]['quantity'] ?></td>
                                           <td>
                                              <ul style="list-style-type:none" >
                                                        <?php
                                                        $mealPrice = $this->ChildReportListModel->checkMealPriceAgainstCatg($parentItem[$i]['category']);
                                                         if($mealPrice >= 0 && $mealPrice !='')
                                                        {
                                                             echo "<li> $" . ($mealPrice * $parentItem[$i]['quantity'])."</li>";
                                                              $sum = $sum+($mealPrice * $parentItem[$i]['quantity']);
                                                        }
                                                        else
                                                        {
                                                            $str1 =  explode(',',$parentItem[$i]['price']);  
                                                            foreach ($str1 as $price) 
                                                            {
                                                                $sum = $sum + (trim($price) * $parentItem[$i]['quantity']);
                                                                echo "<li> $" . ($price * $parentItem[$i]['quantity'])."</li>";
                                                               
                                                            }
                                                        }
                                                        
//                                                        $str1 =  explode(',',$parentItem[$i]['price']);  
//                                                        foreach ($str1 as $price) {
//                                                            echo "<li> $" . $price."</li>";
//                                                        }
                                                        
                                                        ?> 
                                             </ul>
                                           
                                           </td>
<!--                                           <td>
                                                        <?php
                                                      //  $sum = 0;
                                                     //   $str2 =  explode(',',$parentItem[$i]['price']); 
                                                     //   foreach ($str2 as $item) {
                                                        //    $sum = $sum+$item;
                                                      //  }
                                                        
                                                      //   echo "$". $sum; ?> 
                                           
                                           </td>-->
                                        </tr>
                                   <?php  }  ?>
                                   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" style="text-align:right">Total:</th>
                                           <?php 
                                           
//                                                $sum1=0;
//                                               for ($i=0;$i<count($parentItem);$i++)
//                                                   {
//                                                   $sum = 0;
//
//                                                   $str2 =  explode(',',$parentItem[$i]['price']); 
//                                                   foreach ($str2 as $item) {
//                                                       $sum = $sum+$item;
//                                                   }
//                                                   $sum1 = $sum1+$sum;
//
//                                                   }
                                           
                                           ?>
                                             <th><?php echo "$". $sum; ?></th>
                                         </tr>
                                    </tfoot> 
                                </table>
                            </div>
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
</div>
<!--</div>-->
</form>
 

 <?php }

?>
</div>


<?php
$this->load->view('Footer/footer');
?>
