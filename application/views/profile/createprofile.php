
 <?php include('application/views/services/service.php') ?>
 <?php 
   $id = $this->uri->segment('3');
 ?>

 <script type="text/javascript">
   $(document).ready(function(){
  if ($('.servicecheck input:checked').length > 0 )
              {

                   $(".serviceUpdate").removeAttr("disabled");
               }

   });

    $(document).on('change', '.servicecheck input[type="checkbox"]', function (){ 
          
          if ($('.servicecheck input:checked').length > 0 )
              {

                   $(".serviceUpdate").removeAttr("disabled");
               }
               else
               {
                $('.serviceUpdate').prop('disabled', true);
               }
            
         
       });

 </script>
<?php 
if(isset($profiledata)){ 
 // print_r($selectcheck); die;
    $serviceData = array_column($servicedata, 'serviceid');
  $serviceCheckId = array_column($selectcheck, 'id');?>
 <div id="page-wrapper">
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Profile </h1>
                </div>
  </div>

   <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
            <form id="form1" method="post" action="<?php echo base_url();?>Access_controller/profileCreate" >
          <div class="panel panel-default">
         <div class="panel-body">
             <div class="row">
                                <div class="col-lg-8">
                                   
                                        <div class="form-group">
                                            <label>Profile Name</label>
                                            <input id="name" type="text" class="form-control" name="profile" value="<?php echo $profiledata['profile']; ?>" placeholder="Enter Profile Name" >

                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                        </div>
                                                                           
                                </div>
                            
                            </div>

                            <div class="row">
                              <div class="col-lg-8">
                                <div class="form-group">
                                  <label>Service* </label>
                                   <?php
                                   $k=0;
                                $service = count($servicedata);
                            //    echo $service; die;
                                
                                 $find = array_intersect($serviceCheckId,$serviceData);
                               //  print_r($serviceCheckId); die;
                              //  print_r($find); die;
                                
                                for ($i=0; $i<$service;$i++)
                                {
                                  if(!empty($servicedata[$i]['serviceid']))
                                   {
                                  if(!empty($find[$k]) && $find[$k] == $servicedata[$i]['serviceid']){      
                                    $k++;
                                          ?> 

                                     <div class="servicecheck">          
                                     <input type="checkbox" class="" name="serviceCheck[]" value="<?php echo $servicedata[$i]['serviceid']; ?>" checked><?php echo $servicedata[$i]['serviceName']; ?>       
                                  </div>
                                
                                <?php } else { ?>
                                        <div class="servicecheck">          
                                      <input type="checkbox" class="" name="serviceCheck[]" value="<?php echo $servicedata[$i]['serviceid']; ?>"><?php echo $servicedata[$i]['serviceName']; ?>       
                                  </div> 
                               <?php }  } } ?> 
                                  
                              </div>
                            </div>
       
         </div>
       
         </div>
       </div>

        <div class="row">
    <div class="col-lg-12">
   <button align="center" type="submit" class="btn btn-primary serviceUpdate btn-submit" disabled>Update</button>
    </div>
   
</div>

</form>


</div>
<?php }

 else { 
// echo "Hiiiiiiiiiiiii"; die;
  ?>
     <div id="page-wrapper">
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create Profile </h1>
                </div>
  </div>

   <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
            <form method="post" action="<?php echo base_url();?>Access_controller/profileCreate" >
          <div class="panel panel-default">
         <div class="panel-body">
             <div class="row">
                                <div class="col-lg-8">
                                   
                                        <div class="form-group">
                                            <label>Profile Name</label>
                                            <input type="text" class="form-control" name="profile" value="" placeholder="Enter Profile Name" >
                                        </div>
                                                                           
                                </div>
                            
                            </div>

                            <div class="">
                              <div class="col-lg-8">
                                <div class="form-group">
                                  <label>Service* </label>
                                  <br>
                                  <label>
                                   <?php
                                   $service = count($servicedata);
                                  // echo $service;
                                   for ($i=0; $i<$service;$i++){
                                    if(!empty($servicedata[$i]['serviceid'])){
                                    ?>
                                  <div class="servicecheck">          
                                  <input type="checkbox" name="serviceCheck[]" value="<?php echo $servicedata[$i]['serviceid']; ?>"><?php echo $servicedata[$i]['serviceName']; ?>       
                                  </div>
                                        
                                  
                                    <?php } } ?>  
                                    </label>       
                                
                              </div>
                            </div>
       
         </div>
       
         </div>
          <div class="row">
          <div class="col-lg-12 rightclass">
            <button align="center" type="submit"  class="btn btn-primary serviceUpdate btn-submit" id="submit" disabled>Create</button>
          </div>
   
        </div><br/>
       </div>

        

</form>


</div>
<?php } ?>



 <?php include('application/views/Footer/footer.php') ?>
