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
<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>ChildReportListController/transactionReportFilter">
  <div class="row ">
    <div class="col-lg-12">
        <div class="form-group">
           <div class="panel panel-default MT-30">
                <div class="panel-body">
                    <div class="form-group clearfix MB-0">


                       <div class="row">

                          <div class="col-md-6">

                                <div class="col-sm-6">
                                <?php 
                                    if($date1 != '' && $date2 != '')
                                           {
                                            $date1 = date("m/d/Y", strtotime($date1));
                                            $date2 = date("m/d/Y", strtotime($date2));
                                           } ?>
                                    <label for="fname1" class="control-label"> From Date</label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" id="data-date" value="<?php echo $date1 ?>" name="date1">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                </div>
   
  

                        
                                <div class="col-sm-6">
                                    <label  for="fname2" class="control-label"> To Date</label>
                                        <div class="input-group date"  data-provide="datepicker">
                                            <input type="text" class="form-control" id="js-date" value="<?php echo $date2 ?>" name="date2">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                </div>

                            </div>
     


                                <div class="col-md-6 ">
                                    <label class="col-sm-6"> Child Name</label>
                                        <select id ="childid" name="child[]" class=" form-control childId" multiple="multiple">
                                            <?php  for ($i=0; $i<count($child);$i++) { ?>
                                                    <option value="<?php  echo $child[$i]['id']; ?>"><?php  echo $child[$i]['first_name']; ?></option>
                                                    
                                            <?php  } ?>
                                        </select>
                                </div>
                        </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                              <input type="submit" id="btnclick" value="Submit" >
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
                   Transactions Report
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
<!--                                            <th>Child Name</th>-->
                                            <th>Transaction Date</th>
                                            <th>Transaction ID</th>
                                            <th colspan="2">Payment Status</th>
<!--                                            <th>Quantity</th>-->
                                            <th>Amount</th>
                                            <th>Action</th>
                                     

                                      
                                        </tr>
                                    </thead>
                                    <tbody id="showReport">
                                    <?php $srnum=1;  $sum = 0;
                                     for ($i=0;$i<count($childItem);$i++)
                                       { ?>
                                         <tr>
                                           <td><?php echo $srnum++; ?> </td>
                                       <td><?php if($parentName['0']['ParentName'] !=''){ echo $parentName['0']['ParentName']; }else{ echo $parentName['0']['MotherName']; } ?> </td>
<!--                                           <td  value="<?php // echo $childItem[$i]['childid']; ?>"><?php //echo $childItem[$i]['ChildName']; ?> </td>-->
                                           <td><?php
                                            
                                              if($childItem[$i]['transactionDate']=='')
                                              {
                                               $pendingdate = date("m/d/Y", strtotime($childItem[$i]['paymentDate']));

                                                echo $pendingdate;
                                              }
                                              else
                                              {
                                              
                                                  $date = date("m/d/Y", strtotime($childItem[$i]['transactionDate']));
                                                  echo $date; 
                                              }
                                                 
                                          
                                           
                                           ?></td>
                                           <td value=""><?php echo $childItem[$i]['transactionID']; ?></td>
                                           <td><?php echo $childItem[$i]['paymentStatus']; ?></td>

                                           <td colspan="2">
                                              <ul style="list-style-type:none" >
                                                <?php
                                                   
                                              if($childItem[$i]['amount']=='')
                                              {
                                              
                                                echo "<li> $ " . $childItem[$i]['price']."</li>";
                                              }
                                              else
                                              {
                                              
                                                   $sum = $sum + trim($childItem[$i]['amount']);
                                                                if($sum !=''){ echo "<li> $" . $childItem[$i]['amount']."</li>";}else{}
                                              }
                                            ?> 
                                             </ul>
                                           
                                           </td>
                                           <td><a href="javascript:;" class="btn btn-info more-details" data="<?php echo trim($childItem[$i]['transactionID']); ?>">View More</a></td>


                                        </tr>
                                   <?php  }  ?>
                                   
                                    </tbody>
                                  
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
</div>
</form>

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
                                            <input type="text" class="form-control" id="data-date" value="<?php echo $date1 ?>" name="date1">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                </div>
   
  

                        
                                <div class="col-sm-6">
                                    <label  for="fname2" class="control-label"> To Date</label>
                                        <div class="input-group date"  data-provide="datepicker">
                                            <input type="text" class="form-control" id="js-date" value="<?php echo $date2 ?>" name="date2">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                </div>

                            </div>
     


                                <div class="col-md-6 ">
                                    <label class="col-sm-6"> Parent Name</label>
                                        <select id ="interval1" name="parent[]" class="form-control parentId" multiple="multiple">
                                            <?php  for ($i=0; $i<count($parentList);$i++) { ?>
                                                    <option value="<?php  echo $parentList[$i]['id']; ?>"><?php  echo $parentList[$i]['first_name']; ?></option>
                                                    
                                            <?php  } ?>
                                        </select>
                                </div>
                        </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                              <input type="submit" id="btnclick" value="Submit" >
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
                                            <th>Date</th>
                                            <th>Category</th>
                                            <th colspan="2">Item</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>

                                    <tbody id="showReport">
                                    <?php $srnum=1;
                                
                                     for ($i=0;$i<count($parentItem);$i++)
                                       { ?>
                                         <tr>
                                           <td><?php echo $srnum++; ?> </td>
                                           <?php // if($parentName['0']['ParentName'] !=''){ echo $parentName['0']['ParentName']; }else{ echo $parentName['0']['MotherName']; } ?>
                                           <td><?php echo $parentItem[$i]['parentName']; ?> </td>
                    
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
                                           <td>
                                              <ul style="list-style-type:none" >
                                                        <?php
                                                    
                                                        $str1 =  explode(',',$parentItem[$i]['price']);  
                                                        foreach ($str1 as $price) {
                                                            echo "<li> $" . $price."</li>";
                                                        }
                                                        
                                                        ?> 
                                             </ul>
                                           
                                           </td>
                                           <td>
                                                        <?php
                                                        $sum = 0;
                                                        $str2 =  explode(',',$parentItem[$i]['price']); 
                                                        foreach ($str2 as $item) {
                                                            $sum = $sum+$item;
                                                        }
                                                        
                                                         echo "$". $sum; ?> 
                                           
                                           </td>
                                        </tr>
                                   <?php  }  ?>
                                   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="8" style="text-align:right">Total:</th>
                                           <?php 
                                           
                                                $sum1=0;
                                               for ($i=0;$i<count($parentItem);$i++)
                                                   {
                                                   $sum = 0;

                                                   $str2 =  explode(',',$parentItem[$i]['price']); 
                                                   foreach ($str2 as $item) {
                                                       $sum = $sum+$item;
                                                   }
                                                   $sum1 = $sum1+$sum;

                                                   }
                                           
                                           ?>
                                             <th><?php echo "$". $sum1; ?></th>
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
</div>
</form>
 

 <?php }

?>
</div>

 <div id="myModal1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Transaction Details</h4>
                </div>
                <div class="modal-body">
                    <form id="myForm" action="" method="post" class="form-horizontal">
                        <input type="hidden" name="txtId" value="0">
                        <div class="form-group">
                            <div class="panel-body">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                   Report
                                                </div>
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                   <div class="container-fluid">
                                                       <div class="row">
                                                       <div class="col-sm-12 ">

                                                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="modalitemtab" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th>Sr No.</th>
                                                                            <th>Parent Name</th>
                                                                            <th>Child Name</th>
                                                                            <th>Date</th>
                                                                            <th>Category</th>
                                                                            <th>Qty</th>
                                                                            <th colspan="1">Item</th>
                                                                            <th>Price</th>
                                                                        </tr>
                                                                    </thead>
                                                                   <tbody id="showReport123">
                                                                   </tbody>
                                                                   
                                                                </table>
                                                                <div style="text-align: center; display:none;" id="modal-loader">
                                                                    <img src="<?php echo base_url();?>application/images/Spinner.gif"/>
                                                                </div>
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
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                        <input type="hidden" value="" name="hiddenlocid" id="hiddenlocid" />
                        <input type="hidden" value="" name="hiddenmenuid" id="hiddenmenuid" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!--                    <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>-->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<script>
    $(document).ready(function () {
        
       
        

        $('#showReport').on('click', '.more-details', function(){

                        // var mealname = $(this).parent().parent().find('td.mealname').text();
                        // var mealID = $(this).parent().parent().find('input.mealID').val();
                        // $('#hiddenmenuid').val(mealID);
                        // console.log(mealID);
                        //  var id = $(this).attr('data');
                        //  showAllItems();
                        var transactionID = $(this).attr('data');
                        //alert(transactionID);
                        $.ajax({
                                    type: 'POST',
                                    method: 'post',
                                    url: '<?php echo base_url() ?>ChildReportListController/ajaxTransactionReport',
                                    data: {transactionID:transactionID},
                                    dataType: 'json',
                                    beforeSend: function(){
                                       
                                        $("#modalitemtab").DataTable().destroy();
                                        $('#showReport123').html('');
                                        $('#modal-loader').show();
                                       
                                    },
                                    success: function(data){
                                                        $('#modal-loader').hide();
                                                        $('#showReport123').html("");
                                                        var srnum=1;  
                                                        var sum = 0; 
                                                        var html = '';
                                                        var i,j;
                                                        var sr = 1;
                                                        if(data['dataItem'].length > 0)
                                                        {
                                                            for(i=0; i< data['dataItem'].length; i++)
                                                            {
                                                                var parent_name = '';
                                                                if(data['parentName'] !=''){ parent_name = data['parentName']; }
                                                                else{  parent_name = data['motherName']; }
                                                                html +='<tr>';
                                                                html +='<td>'+(srnum++)+'</td>';
                                                                html +='<td>'+parent_name+'</td>';
                                                                html +='<td>'+data['dataItem'][i]['ChildName']+'</td>';
                                                                html +='<td>'+data['dataItem'][i]['date']+'</td>';
                                                                //$date = date("m/d/Y", strtotime($childItem[$i]['date']));
                                                               // echo $date; 
                                                               //?></td>
                                                                html +='<td>'+data['dataItem'][i]['category']+'</td>';
                                                                html +='<td>'+data['dataItem'][i]['quantity']+'</td>';
                                                                html +='<td>';
                                                                html +='<ul style="list-style-type:none">';
                                                              // $str =  explode(',',$childItem[$i]['Item']);
                                                                var str = data['dataItem'][i]['Item'].split(",");
                                                                for(j=0; j< str.length; j++)
                                                                {
                                                                    html +='<li>'+str[j]+'</li>'
                                                                }
                                                                   //   foreach ($str as $item) 
                                                                     // {
                                                                     //     echo "<li >$item</li>";
                                                                     // }

                                                                html +='</ul>';
                                                                html +='</td>';
                                                                html +='<td colspan="3">';
                                                                html +='<ul style="list-style-type:none" >';



                                                                //$mealPrice = $this->ChildReportListModel->checkMealPriceAgainstCatg($childItem[$i]['category']);

                                                               // if($mealPrice >= 0 && $mealPrice !='')
                                                                //{
                                                                  //   echo "<li> $" . $mealPrice."</li>";
                                                                   //   $sum = $sum+$mealPrice;
                                                                //}
                                                                //else
                                                                //{
                                                                var sum = 0;
                                                                var str1 =  data['dataItem'][i]['price'].split(",");  
                                                                for(j=0; j< str.length; j++)
                                                                {
                                                                    sum = sum + str1[j];
                                                                    if(str1[j] != null)
                                                                    {
                                                                         html +='<li> $'+str1[j]+'</li>'
                                                                    }
                                                                   
                                                                }


                                                                html +='</ul>';
                                                                html +='</td>';
                                                                html +='</tr>';
                                                            }
                                                        }
                                                        else
                                                        {
                                                            html +='<tr>';
                                                            html +='<td colspan="8" style="text-align: center;"><b>No Data.</b></td></tr>';
                                                        }
                                                       
                                                       
                                                        $('#showReport123').html(html);

                                                       
                                                        //alert(html);
                                                       //  $('#showReport123').html('');
                                                         
                                                           $('#modalitemtab').DataTable( {
                                                                dom: 'Bfrtip',
                                                                buttons: [
                                                                    {extend: 'csv', title: 'Order Report'}, {extend: 'excel', title: 'Order Report'}, {extend: 'pdf', title: 'Order Report'}, { extend: 'print', title: 'Order Report'}

                                                                ]
                                                                
                                                                
                                                            } );
                                                         
                                                         
                                                         
                                                       
                                                        
                                                       // $("#modalitemtab").DataTable().fnDestroy();
                                                        
                                                        
                                                          
                                                            
                                                            // $('#showReport123').html('');
//                                                        
//                                                           $("#modalitemtab").DataTable().fnDestroy();
//                                                              $("#modalitemtab").DataTable().destroy();
//                                                            $('#modalitemtab').DataTable( {
//                                                                "scrollY":        "200px",
//                                                                "scrollCollapse": true,
//                                                                "paging":         false,
//                                                                "retrieve": true,
//                                                                "aoColumnDefs": [
//                                                                                {
//                                                                                   bSortable: false,
//                                                                                   aTargets: [ -3 ]
//                                                                                }
//                                                                              ]
//                                                            } );
                                                            
                                                             
                                                        
                                                        
                                                        
                                                        
                                                        
                                                          function setHeight() {
                                                            windowHeight = $('#page-wrapper').height();
                                                            //alert(windowHeight);
                                                            $('.sidebar').css('min-height', windowHeight);
                                                            };
                                                            setHeight();

                                                            $(window).resize(function() {
                                                            setHeight();
                                                            });
                                                         
                                                            
                                                            
                                                            
                                    },
                                    error: function(){
                                                        bootbox.alert({
                                                        message: "Could not add data!",
                                                        callback: function () {
                                                            //location.href = '<?php //echo base_url() ?>menuitemsel';
                                                            }
                                                        });
                                    }
                            });
                        $('#myModal1').modal('show');
              //  $('#myModal').find('.modal-title').text(mealname);
             //   $('#myForm').attr('action', '<?php //echo base_url() ?>mealcreation/mealitemInst');
                    });
                    
                  
        
                
    });
</script>

<?php
$this->load->view('Footer/footer');
?>

