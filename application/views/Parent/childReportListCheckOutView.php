<?php include('application/views/services/service.php');

// print_r($personalInfo); die;

 // print_r($childItem); die;
 //$parentIDSQL="select `parent_id` from person_details where id = ".$childIDD;
 // $parentID =$this->db->query($parentIDSQL)->row_array();
 //echo $parentID['parent_id']; die;
 $parentID = $this->session->userdata('logged_in');
 

      // $locidSQL = "select `locid` from user_location where `userid` =" . $loginstatus['parent_id']; 
          
?>
<style>
    input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
</style>
<script type="text/javascript">
    
    $(document).ready(function() {
        $('#js-date').datepicker();
    $('#dataTables-example').DataTable({
      "order": [[ 3, "asc" ],[ 4, "asc" ],]
    });

  
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
<!--<form class="form-horizontal">-->
 
<input type="hidden" id="dateOnly" value="<?php echo $childItem['0']['date']; ?>">

  <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Child Report
                </div>
                
    
                <!-- /.panel-heading -->
                <div class="panel-body">
                   <div class="container-fluid">
                       <div class="row">
                       <div class="col-sm-12 ">
                                   
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="loading" id="loading-image" style="display: none;">
            
                                </div>
                                <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>Sr No.</th>
                                            <th>Parent Name</th>
                                            <th>Child Name</th>
                                            <th>Date</th>
                                            <th>Category</th>
                                            <th colspan="1">Item</th>
                                             <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showReport">
                                    <?php $srnum=1;  $sum = 0;  $childOnlyId='';
                                     for ($i=0;$i<count($childItem);$i++)
                                       { 
                                    
                                       $childOnlyId.=$childItem[$i]['childid'].","; 




                                        ?>
                                         <tr>
                                           <td><?php echo $srnum++; ?> 
                                            <input type='hidden' class="temptableID" value='<?php echo $childItem[$i]['temp_id']; ?>' >
                                           </td>
                                           <td><?php echo $parentName['0']['ParentName']; ?> </td>
                                           <td  value="<?php // echo $childItem[$i]['childid']; ?>"><?php echo $childItem[$i]['ChildName']; ?> </td>
                                           <td><?php
                                             $date = date("m/d/Y", strtotime($childItem[$i]['date']));
                                             echo $date; 
                                          
                                           
                                           ?></td>
                                           <td value="<?php // echo $childItem[$i]['categoryId']; ?>"><?php echo $childItem[$i]['category']; ?></td>
                                           <td>
                                           <ul style="list-style-type:none">
                                              <?php $str =  explode(',',$childItem[$i]['Item']);
                                                  
                                                    foreach ($str as $item) 
                                                    {
                                                        echo "<li >$item</li>";
                                                    }
                                             ?>
                                          </ul>
                                           </td>
                                           <td><select class="quantity" name="qty" disabled><?php
                                                        for($ii =1; $ii<=50; $ii++)
                                                        {
                                                            echo '<option value="'.$ii.'">'.$ii.'</option>';
                                                        }
                                                        ?></select>
<!--                                               <input type="text" pattern="\d*" class="quantity" name="qty" value="1" min="1" maxlength="2"/>-->
                                           </td>
                                           <td colspan="3">
                                              <ul style="list-style-type:none" >
                                                        <?php
                                                    
                                                       
                                                        $mealPrice = $this->ChildReportListModel->checkMealPriceAgainstCatg($childItem[$i]['category']);
                                                        
                                                        if($mealPrice >= 0 && $mealPrice !='')
                                                        {
                                                             echo "<li class='pr'> $" . $mealPrice."</li>";
                                                             echo "<input type='hidden' id='baseprice' value='".$mealPrice."'>";
                                                              $sum = $sum+$mealPrice;
                                                        }
                                                        else
                                                        {
                                                            $str1 =  explode(',',$childItem[$i]['price']);  
                                                            foreach ($str1 as $price) 
                                                            {
                                                                $sum = $sum + trim($price);
                                                                echo "<li class='pr'> $" . $price."</li>";
                                                                echo "<input type='hidden' id='baseprice' value='".$price."'>";
                                                               
                                                            }
                                                        }
                                                     
                                                        
                                                        
                                                        
                                                        ?> 
                                             </ul>
                                           
                                           </td>
<!--                                           <td>-->
                                                        <?php
//                                                        $sum = 0;
//                                                        $str2 =  explode(',',$childItem[$i]['price']); 
//                                                        foreach ($str2 as $item) {
//                                                            $sum = $sum+$item;
//                                                        }
                                                        // echo "$". $sum; ?> 
                                           
<!--                                           </td>-->
                                        </tr>
                                   <?php  } 

                      

                                    ?>
                                  
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                           
                                             <th colspan="7" style="text-align:right">Food Total:</th>
                                           <?php 
                                           
                                                //$sum1=0;
//                                               for ($i=0;$i<count($childItem);$i++)
//                                                   {
//                                                   $sum = 0;
//
//                                                   $str2 =  explode(',',$childItem[$i]['price']); 
//                                                   foreach ($str2 as $item) {
//                                                       $sum = $sum+$item;
//                                                   }
//                                                   $sum1 = $sum1+$sum;
//
//                                                   }
                                           
                                           ?>
                                             <th id="foodTotal"><?php echo "$" .$sum; ?></th>
                                         </tr>

                                         <?php  if(!empty($discount))  { ?>
                                                    <tr>
                                                        <th  colspan="7" style="text-align:right">
                                                            Discount
                                                            <input type="hidden" id="discount" value="<?php echo $discount[0]['discount']; ?>"/>
                                                        </th>
                                                        <th id="discount1">
                                                            <?php echo $discount[0]['discount']. "%"; ?> 
                                                            
                                                        </th>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                            $sum2 = 0;
                                                            
                                                            $sum2 = $sum - (($discount[0]['discount']*$sum)/100);
                                                        
                                                        ?>
                                                        <th  colspan="7" style="text-align:right">
                                                            Total
                                                             <input type="hidden" id="total" value="<?php echo $sum2; ?>"/>
                                                        </th>
                                                        
                                                       
                                                        <?php //echo urlencode(base64_encode(0.01));
                                                             //echo urlencode(base64_encode("http://test-hotlunch.mystjohns.org/paymentackw/"));
                                                            // echo urlencode(base64_encode("http://52.76.89.150/stjohnAdmin/st-john/st-john/paymentackw/"));
                                                           // echo urlencode(base64_encode("http://13.228.196.1/stjohnAdmin/st-john/st-john/paymentackw/")); 

                                                          //for 13.228 IP    aHR0cDovLzEzLjIyOC4xOTYuMS9zdGpvaG5BZG1pbi9zdC1qb2huL3N0LWpvaG4vcGF5bWVudGFja3cv
                                                         // for localhost   // aHR0cDovL2xvY2FsaG9zdC9zdC1qb2huL3BheW1lbnRhY2t3
                                                        //for live GC :     aHR0cDovL2hvdGx1bmNoLm15c3Rqb2hucy5vcmcvcGF5bWVudGFja3c%3D

                                                     
                                                        ?>
                                                        
                                                        <th id="total1">
                                                            
                                                            <?php 
                                                                    if(isset($date))
                                                                    {
                                                                        $menu_date = strtotime($date);
                                                                        $menu_date = date('Y-m-d',$menu_date);
                                                                    }

                                                                     
                                                            echo "$" .$sum2; ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="8" id="check123">


                            <?php if($sum2>0){ ?> <button class="btn btn-primary arefclass clickA">Make Payment</button> <?php }
                                                            else{ ?> <button  class="btn btn-primary clickA">Checkout</button>

                                                           <?php } ?>
                                                        </th>

                                                    </tr>
                                        <?php  }
                                                else
                                                    { ?>
                                                        <tr>
                                                            <th  colspan="7" style="text-align:right">
                                                                Discount
                                                                <input type="hidden" id="discount" value="0"/>
                                                            </th>
                                                            <th id="discount1">0%</th>
                                                        </tr>
                                                        
                                                        <tr>
                                                        <?php
                                                            $sum2 = 0;
                                                            $sum2 = $sum;
                                                        
                                                        ?>
                                                            <th  colspan="7" style="text-align:right">
                                                                Total
                                                                 <input type="hidden" id="total" value="<?php echo $sum2; ?>"/>
                                                            </th>
                                                        
                                                       
                                                        
                                                        
                                                            <th id="total1">

                                                                <?php 
                                                                        if(isset($date))
                                                                        {
                                                                            $menu_date = strtotime($date);
                                                                            $menu_date = date('Y-m-d',$menu_date);
                                                                        }


                                                                echo "$" .$sum2; ?>
                                                            </th>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th colspan="8" id="check123">
                                                                <?php if($sum2>0){ ?> <a href='https://www.givecentral.org/StJohn2018/mobileaoc.php?amount=<?php echo urlencode(base64_encode(trim($sum2))); ?>&parent_id=<?php echo urlencode(base64_encode(trim($parentID['parent_id']))); ?>&uniqueID=<?php echo urlencode(base64_encode(trim($parentID['parent_id']))); ?>&redirect_url=aHR0cDovL2hvdGx1bmNoLm15c3Rqb2hucy5vcmcvcGF5bWVudGFja3c%3D' class="btn btn-primary arefclass clickA">Make Payment</a> <?php }
                                                                else{ ?>                                                                                                                                                                                                                                   

                                                                    <a href="<?php echo base_url() ?>paymentackw?status=success&amount=0&transactionId=<?php echo $reference = 'txn'.uniqid(); ?>&transaction_date=<?php echo date("Y-m-d"); ?>&parent_id=<?php echo $childIDD; ?>" class="btn btn-primary clickA">Checkout</a>
                                                               <?php } ?>
                                                            </th>
                                                        </tr>
                                                        
                                                        
                                                        
                                                    
                                             <?php  } ?>
                                         
                                         
                                        
                                    </tfoot> 
                                </table>

                                 <input type="hidden" id="cid" value="<?php echo $childOnlyId; ?>">
                                 <input type="hidden" id="amountChilds" value="<?php echo urlencode(base64_encode(trim($sum2)));?>">
                                 <input type="hidden" id="amountparent" value="<?php  echo urlencode(base64_encode(trim($parentID['parent_id']))); ?>">

                                   <input type="hidden" id="cid" value="<?php  echo urlencode(base64_encode(trim($parentID['parent_id']))); ?>">

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
<!--</form>-->
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
                                            <th colspan="6" style="text-align:right">Total:</th>
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

<script>
    $(document).ready(function () {
        
        function changeFirstParam(href, newVal) 
        {
            //get our parameters into an array
            params = href.split('&');
            //this will only work if the first parameter is the one
            //we need to change
            var src = params[0].split('=');
            //Remove the first value of the first parameter
            params.shift();
            //Give the first parameter a new value
            src[1] = newVal+'&';
            //Join it all back up
            var newUrl = ( src.join('=') + params.join('&'));
            //Return our new url
            return newUrl;
        }
       
       
      // $(document).on("click","#test-element",function() { alert("click"); })
     //  $('.quantity').change(function()
        $(document).on("change",".quantity",function()
        {
            var pointer = $(this);
         //  alert(pointer); exit;
          // alert($(this).val()); exit;
            if($.trim($(this).val()).length > 0){
               
               if($.trim($(this).val()) > 0 && $.trim($(this).val()) % 1 == 0)
               {
                   
               
               var baseprice = $(this).parent().next('td').find('li.pr').next('input').val(); 
               var baseprice = $('#baseprice').val(); //alert(baseprice);
                var discount = $('#discount').val();
                var total = $('#total').val();

        
                
                var Url = $('.arefclass').attr('href');
                var href = changeFirstParam(Url,encodeURIComponent(btoa($.trim(total11))));
                $('.arefclass').attr('href',href);
            }
            else{
                var intvalue = Math.trunc( $.trim($(this).val() ));
                $(this).val(intvalue);
               // alert(intvalue);
                 
            }
                  

                  
              
            }
            else
            {
                if(  pointer.val()=='')
                {
                     pointer.val(1);
                }
                else
                {
                    
                }
              
               
            }

        });
        
       
       // $('.clickA').click(function()
        $(document).on("click",".clickA",function(){
         
          var dateOnly = $("#dateOnly").val();

          var childOnly =$("#cid").val();

          var amount = $("#total1").text();

          var amountForlocation = $("#amountChilds").val();
          var parentIdForlocation = $("#amountparent").val();

      

         amount = amount.split("$");
         amount= amount[1];

          //   alert(amount); exit;
           dateOnly = dateOnly.split("-");
                      dateOnly = dateOnly[0]+"-"+dateOnly[1]; 
                 
             
            $.ajax({
                url: '<?php echo base_url() ?>ChildMenuItemController/payment_status_info',
                //async: true,
                data: {dateOnly:dateOnly,childOnly:childOnly},
                type: 'POST',
                dataType: 'json',
                beforeSend: function(){
                     $("#loading-image").show(); 
                },
                success: function (data) {
                   // console.log(data);
//alert(data.success);
                  

                  if(data.success){
                         
                     if(amount>0)
                     {
                     
                       window.location= 'http://givecentral.org/StJohn2018/mobileaoc.php?amount='+amountForlocation+'&parent_id='+parentIdForlocation+'&uniqueID='+data.encodeUniqueId+'&redirect_url= aHR0cDovL2hvdGx1bmNoLm15c3Rqb2hucy5vcmcvcGF5bWVudGFja3c%3D';


        // for local              aHR0cDovL2xvY2FsaG9zdC9zdC1qb2huL3BheW1lbnRhY2t3Lw%3D%3D';

//   for live site   aHR0cDovL2hvdGx1bmNoLm15c3Rqb2hucy5vcmcvcGF5bWVudGFja3c%3D
                      

                              $('#loading-image').hide();

                     }
                     else{
                            window.location = '<?php echo base_url(); ?>paymentackw?status=success&amount=0&transactionId=txn'+data.unique_id+'&transaction_date=<?php echo date("Y-m-d");?>&parent_id='+data.parent_id+'&uniqueID='+data.unique_id;
                            $('#loading-image').hide();
                    }
                     
                  }
                       
                    
                },
                 error: function ( data ) {
                      bootbox.alert("Error in Making Payment!");
                     //console.log('error'+data); 
                    }
            });
             
             
            
            
        });
    });
</script>
<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loading-image").style.display = "block";
}
</script>


<?php
$this->load->view('Footer/footer');
?>
