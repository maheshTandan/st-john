<?php include('application/views/services/service.php');
    $activateFlag = '';
    $deactivateFlag = '';
    if($status ==1)
    {
        $activateFlag = 'checked';
    }
    else
    {
        $deactivateFlag = 'checked';
    }

?>


<div id="page-wrapper" style="min-height: 327px;">

 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="text-align:center">Activate/De-Activate of Calendar</h1>
        </div>
 </div>

 <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>BmTeacherReportController/activateDeactiveCal">

     <div class="row" align="center">

         <div class="col-md-12 searchbarMargin">
             <div class="col-sm-3"></div>
             <div class="col-sm-2">
                 <div class="form-check form-check-inline">
                     <input type="radio" class="form-check-input" id="showcal1" name="radiocal" value="1" <?php echo $activateFlag; ?>>
                     <label class="form-check-label" for="showcal1">Show Calender</label>
                 </div>
             </div>
             <div class="col-sm-2">
                 <div class="form-check form-check-inline">
                     <input type="radio" class="form-check-input" id="hidecal1" name="radiocal" value="0" <?php echo $deactivateFlag; ?>>
                     <label class="form-check-label" for="hidecal1">Hide Calender</label>
                 </div>
             </div>

             <div class="col-sm-2 submitbtnMargin" >
                 <input class="calendarSubmit" type="submit" id="btnclick" value="Submit" >
             </div>

         </div>                
     </div>         
</form>

</div>



<?php
  $this->load->view('Footer/footer');
?> 
