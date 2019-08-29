 <!-- // <?php // include('application/views/Header/header.php') ?> -->
  <?php include('application/views/services/service.php');

  // print_r($parent_refid); die;

  ?>

<div id="page-wrapper">
         <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
            <form method="post" action="<?php echo base_url();?>Signup_controller/bmCreateResetPassword" >
          <div class="panel panel-default">
         <div class="panel-body">

        <?php 
          if($flag == 1)
          { ?>
             
               <h6> Please Enter Same Password In Both Fields </h6>

        <?php }

        ?>


        <?php 
          if($flag == 2)
          { ?>
             
               <h6> Password has changed </h6>

        <?php }

        ?>
    
         
             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Enter Your New Password</label>
                                            <input  type="password" class="form-control" required value="" name="pwd1" placeholder="New-Password" >

                                        </div>
                                                                           
                                </div>

                                

                                  <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Re-Enter New Password</label>
                                            <input type="password" required class="form-control" name="pwd2" value="" placeholder="Re-Enter New-password">

                        
                                        </div>
                                                                           
                                </div>
                           
                               <input type="hidden" name="parent_refid" value="<?php echo $parent_refid; ?>" >
             </div>
       
         </div>
       </div>

        <div class="row">
    <div class="col-lg-12">
   <button align="center" type="submit" class="btn btn-primary">create New Password</button>
    </div>
   
</div>
 </form>


</div>


   <?php include('application/views/Footer/footer.php') ?>