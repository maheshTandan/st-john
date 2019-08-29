<?php include('application/views/services/service.php') ?>
<?php 
     $Year = date('Y');
     $Month = date('m');
     $Date = $Year."-".$Month;
?>

<script type="text/javascript">
    
    $(document).ready(function() {
        // $('#js-date').datepicker();
    $('#dataTables-example').DataTable();

//    $("#datepicker").datepicker( {
//     format: "mm-yyyy",
//     viewMode: "months", 
//     minViewMode: "months"
// });
    $("#datepicker").datepicker( {
    format: "yyyy-mm",
    startView: "months", 
    minViewMode: "months"
});
    

  
});
</script>
<div id="page-wrapper" style="min-height: 327px;">

 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="text-align:center">Monthly Order Report Calendar</h1>
        </div>
 </div>

 <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>BmTeacherReportController/monthlyOrderReport">

  <div class="row" align="center">

                          <div class="col-md-12 searchbarMargin">
                                 <div class="col-sm-3"></div>
                                <div class="col-sm-4">
                              
                                    <label for="fname1" class="control-label"></label>
                                       <!--  <div class="input-group date customTable" data-provide="datepicker">
                                            <input type="text" class="form-control" id="data-date" value="" name="date">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                        </div> -->

                                   <div class="input-group date" data-provide="datepicker" id="datepicker" data-date="<?php echo $Date; ?>" data-date-format="yyyy-mm">

                                           <input  type="text" class="form-control"  id="data-date" name="date1"  value=""autocomplete="off"> 
                                           
                                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                                              
                                      </div> 

                                    </div>
                                  
                               
                

                                  <div class="col-sm-2 submitbtnMargin" >
                                              <input class="calendarSubmit" type="submit" id="btnclick" value="Submit" >
                                   </div>
                                     <div class="col-sm-3"></div>
                           </div>                
      </div>         
</form>

</div>



<script type="text/javascript">
  $(document).ready(function () {
      
  
    $("form").submit(function(){
        var datepointer = $('#data-date');
       // alert('hi');
        if($.trim(datepointer.val()) == '')
        {
            //alert('Please select date');
            datepointer.parent().addClass('has-error');
            return false;
           /// exit;
        }
        else
        {
            datepointer.parent().removeClass('has-error');
            return true;
        }
      
    });
      
    $('#btnclick').click(function(){
        $("form").submit();
    });
      
  });
</script>



<?php
  $this->load->view('Footer/footer');
?> 
