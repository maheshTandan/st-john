 <!-- // <?php // include('application/views/Header/header.php') ?> -->
  <?php include('application/views/services/service.php') ?>


<div id="page-wrapper">
         <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
            <form method="post" action="<?php echo base_url();?>Signup_controller/createresetPassword" >
          <div class="panel panel-default">
         <div class="panel-body">

          <?php
          if($flag == '0')
          { ?>
                        <p> Please Enter Correct Old Password </p>
        <?php  }
         ?>
    
         
             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Enter Your Old Password</label>
                                            <input  type="password" class="form-control" required value="" name="pwd1" placeholder="Old-Password" >

                                        </div>
                                                                           
                                </div>

                                

                                  <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" required class="form-control" name="pwd2" value="" placeholder="New-password">

                        
                                        </div>
                                                                           
                                </div>
                           
                                 <input type="hidden" name="emailid" value="" >
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