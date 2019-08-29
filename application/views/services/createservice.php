
  <?php include('application/views/services/service.php') ?>  


<script type="text/javascript">
  
 $(document).ready(function(){
  
        $('.servicetext').on('input change', function () {
            if ($(this).val() != '') {
                $('.serviceUpdate').prop('disabled', false);
            }
            else {
                $('.serviceUpdate').prop('disabled', true);
            }
        });
    });


</script>


<div id="page-wrapper">
    <?php if(isset($servicedata)){ ?>
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Service </h1>
                </div>
  </div>
  
 
    
 <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
            <form method="post" action="<?php echo base_url();?>Access_controller/updateService" >
          <div class="panel panel-default">
         <div class="panel-body">
             <div class="row">
                                <div class="col-lg-8">
                                   
                                        <div class="form-group ">
                                            <label>Service Name</label>
                                            <input type="text" class="form-control servicetext" name="service" value="<?php echo $servicedata['serviceName'] ?>" placeholder="Enter Service Name" >

                                             <input type="hidden" name="id" value="<?php echo $servicedata['serviceid'] ?>">
                                        </div>


                                                                           
                                </div>
                            
                            </div>


                            
       </div>

        <div class="row">
    <div class="col-lg-12" style="margin:0px 0px 6px 15px">
   <button align="center" type="submit" class="btn btn-primary serviceUpdate btn-submit">Update</button>
    </div>
   
</div>

</form>


</div>
 <?php } else { ?> 

 <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
            <form method="post" action="<?php echo base_url();?>Access_controller/serviceCreate" >
          <div class="panel panel-default">
         <div class="panel-body">
             <div class="row">
                                <div class="col-lg-8">
                                   
                                        <div class="form-group">
                                            <label>Service Name</label>
                                            <input type="text" class="form-control servicetext" name="service" value="" placeholder="Enter Service Name" >
                                        </div>


                                                                           
                                </div>
                            
                            </div>


                            
       </div>

  <div class="row">
    <div class="col-lg-12" style="margin:0px 0px 6px 15px">
   <button align="center" type="submit" class="btn btn-primary serviceUpdate btn-submit" disabled>Create</button>
    </div>
   
</div>

</form>


</div>



 <?php }?></div>
 <?php include('application/views/Footer/footer.php') ?>
