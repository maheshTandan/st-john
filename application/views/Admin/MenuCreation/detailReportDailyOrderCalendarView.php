<?php include('application/views/services/service.php') ?>


<script type="text/javascript">
    
    $(document).ready(function() {
        $('#js-date').datepicker();
    $('#dataTables-example').DataTable();

  
});
</script>
<div id="page-wrapper" style="min-height: 327px;">

 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="text-align:center">Daily Details Report Calendar</h1>
        </div>
 </div>

 <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>BmTeacherReportController/dailyDeatilReport">

  <div class="row" align="center">

                          <div class="col-md-12 searchbarMargin">
                                 <div class="col-sm-3"></div>
                                <div class="col-sm-4">
                              
                                    <label for="fname1" class="control-label"></label>
                                        <div class="input-group date customTable" data-provide="datepicker ">
                                            <input type="text" class="form-control" id="data-date" value="" name="date" autocomplete="off">
                                            <div class="input-group-addon">
                                                <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
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
