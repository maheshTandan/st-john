<?php include('application/views/services/service.php');
?>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#js-date').datepicker();
  
   $('#dataTables-example').DataTable({
        dom: 'lBfrtip',
        buttons: [
            'print'
        ]
    });
  
});
</script>

<div id="page-wrapper" style="min-height: 327px;">
    <div class="form_error">
          <?php  echo validation_errors(); ?>
    </div>


 <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>ChildReportListController/bmTransactionReport">
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
                                            <input type="text" class="form-control" id="data-date" value="<?php echo $date1 ?>" name="date1" autocomplete="off">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                </div>
   
  

                        
                                <div class="col-sm-6">
                                    <label  for="fname2" class="control-label"> To Date</label>
                                        <div class="input-group date"  data-provide="datepicker">
                                            <input type="text" class="form-control" id="js-date" value="<?php  echo $date2 ?>" name="date2" autocomplete="off">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                  </div>
                               </div>

                            </div>

                              <div class="col-md-6 ">
                                    <label class="col-sm-6">Transaction Status</label>
                                       <select id ="paymentStatus" name="status" class=" form-control">
                                       	 <option value="" hidden>Select your option</option>
                                          
                                         <option <?php if($status == '1'){ echo "selected"; } ?> value="1">Success </option>
		                                  <option <?php if($status == '0'){ echo "selected"; } ?> value="0">Decline</option>
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
                   Transaction Report
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
                                            <th>Parish Id</th>
                                            <th>Parent Name</th>
                                            <th>Family Name</th>
                                            <th>Transaction ID</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showReport">
                                    <?php $srnum=1;  $sum = 0;
                                     for ($i=0;$i<count($transaction);$i++)
                                       { ?>
                                          <tr>
                                           <td><?php echo $srnum++; ?> </td>
                                           </td>
                                            <td><?php echo $transaction[$i]['parish_id']; ?> </td>

                                          <td><?php 
                                         
                                          if($transaction[$i]['parent_name'] != " ")
                                          {   
                                               echo $transaction[$i]['parent_name'];
                                          }else{

                                               echo $transaction[$i]['mother_name'];
                                          }

                                          ?> </td>
                                            <td><?php echo $transaction[$i]['family_name']; ?> </td>

                                            <td class="ddclick" data-value="<?php echo $transaction[$i]['transactionID']; ?>"><a style="cursor: pointer;"><?php echo $transaction[$i]['transactionID']; ?></a> </td>
                                            <td><?php
                                                $date1 = date("m/d/Y", strtotime($transaction[$i]['transactionDate']));


                                             echo $date1; ?> </td>
                                            <td><?php echo $transaction[$i]['paymentStatus']; ?> </td>
                                            <td><?php echo "$" . $transaction[$i]['amount']; ?> </td>

                                       </tr>
                                      <?php } ?>
                  
                             
                                    </tbody>
                                  <!--   <tfoot>
                                        <tr>
                                           
                                  <th colspan="7" style="text-align:right">Food Total:</th>
                                 
                                         </tr>
                                        
                                    </tfoot>  -->
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


</form>

 </div>


<div id="myModal1" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Items Details</h4>
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
            <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
             <thead>
                 <tr role="row">
                     <th>Sr No.</th>
                     <th>Child Name</th>
                     <th>Child Grade</th>
                     <th>Category</th>
                     <th>Item Name</th>
                     <th>Date</th>
                     <th>Price</th>
                    
                    </tr>
              </thead>
       <tbody id="showReport123">
      </tbody>

      <tfoot id="discount123">
      <!-- 	<tr>
      		<th colspan="4" style="text-align:right">Food Total:</th>
      	</tr>
      	<tr>
      		<th colspan="4" style="text-align:right">Discount :</th>
      	</tr>
          <tr>
      		<th colspan="4" style="text-align:right">Total:</th>
      	</tr> -->
      </tfoot>

                                                                   
    </table>
     </div>
    </div>


  <!-- <div class="row">
     <div class="col-sm-12">
            <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="modalitemtab2" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
             <thead>
                 <tr role="row">
                     <th>Sr No.</th>
                     <th>Meal Name</th>
                      <th>Price</th>
                     <th>Date</th>
                    </tr>
              </thead>
       <tbody id="showReport1234">
      </tbody>
                                                                   
    </table>
     </div>
    </div> -->
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
                      
</form>
 </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!--                    <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>-->
       </div>
      </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

 
<?php

$this->load->view('Footer/footer');
?>

 <script type="text/javascript">
 	
$(document).ready(function () {


 // var table = $('#dataTables-example').DataTable();
     
    $('#dataTables-example tbody').on('click', 'tr td.ddclick', function () {
        var transactionID = $(this).text();

        $.ajax({
                type: 'post',
                  method: 'post',
                url: '<?php echo base_url() ?>ChildReportListController/bmTranscationItemPopup',
                //async: true,
                data: {transactionID: transactionID},
                dataType: 'json',
                success: function (data) {

                	//console.log(data['discount']);
                      $('#showReport123').html("");
                      $('#discount123').html("");
                      var srnum=1; 
                      var i,j; 
                       var html = ''; 
                        var html1 = '';
                        var sum = 0;                               
                       if(data['transactionItem'].length > 0)
                           {

                           	for(j=0;j<data['transactionItem'].length; j++)
                           	{
                              sum = parseFloat(sum) + parseFloat(data['transactionItem'][j]['price']);
                           	}
                           	 //console.log(sum);
                            for(i=0; i< data['transactionItem'].length; i++)
                            {
                            	
                              
                             html +='<tr>';
                             html +='<td>'+(srnum++)+'</td>';
                             html +='<td>'+data['transactionItem'][i]['childName']+'</td>';
                             html +='<td>'+data['transactionItem'][i]['Grade_name']+'</td>';
                             html +='<td>'+data['transactionItem'][i]['meal_name']+'</td>';
                             html +='<td>'+data['transactionItem'][i]['item_name']+'</td>';
                             html +='<td>'+data['transactionItem'][i]['date']+'</td>';
                             html +='<td> $'+data['transactionItem'][i]['price']+'</td>';
                           
                             html +='</tr>';
                        }
                       }
                       else
                      {
                        html +='<tr>';
                        html +='<td colspan="9" style="text-align: center;"><b>No Data.</b></td></tr>';
                      }

                     var discount = data['discount'][0]['discount'];
                     var totalSum =0;
                       if(discount == 0)
                       {
                            totalSum = sum;
                       }else{

                          totalSum = sum -((sum*discount)/100);
                         
                      
                       }
                         

				             html1 +='<tr>';
				      		 html1 += '<th colspan="6" style="text-align:right">Food Total: </th>';
				      		 html1 +='<th> $ '+sum+'</th>';
				      	     html1 +='</tr>';
				      	     html1 +='<tr>';
				      		 html1 +='<th colspan="6" style="text-align:right">Discount :</th>';
				      		 html1 +='<th> '+data['discount'][0]['discount']+' % </th>';
				             html1 +='</tr>';
				             html1 +='<tr>';
				      		 html1 +='<th colspan="6" style="text-align:right">Total:</th>';
				      		 html1 +='<th> $ '+totalSum+'</th>';
				      	      html1 +='</tr>';
                       
                     

                      //  if(data['transactionMeal'].length > 0)
                      //      {
                      //       for(i=0; i< data['transactionMeal'].length; i++)
                      //       {
                          
                      //        html1 +='<tr>';
                      //        html1 +='<td>'+(srnum1++)+'</td>';
                      //        html1 +='<td>'+data['transactionMeal'][i]['meal_name']+'</td>';
                      //         html1 +='<td>'+data['transactionMeal'][i]['price']+'</td>';
                      //        html1 +='<td>'+data['transactionMeal'][i]['date']+'</td>';
                      //        html1 +='</tr>';
                      //   }
                      //  }
                      //  else
                      // {
                      //   html1 +='<tr>';
                      //   html1 +='<td colspan="8" style="text-align: center;"><b>No Data.</b></td></tr>';
                      // }
                                                       
                                                        //alert(html);
                    $('#showReport123').html(html);
                    $('#discount123').html(html1);

                  $('#modalitemtab').DataTable( {
                         "scrollY":        "200px",
                         "scrollCollapse": true,
                         "paging":         false,
                         "retrieve": true,
                                                        } ); 

                  // $('#modalitemtab2').DataTable( {
                  //        "scrollY":        "200px",
                  //        "scrollCollapse": true,
                  //        "paging":         false,
                  //        "retrieve": true,
                  //                                       } );  
                                                         
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
    } );


});




 </script>

