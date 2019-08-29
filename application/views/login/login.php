<?php include('application/views/Header/header.php');

// print_r($flag); die;
?>               
<div id="page-wrapper marginzero" class="container">
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User Login</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
    <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
            <form method="post" action="<?php echo base_url();?>Signup_controller/profileform" >
          <div class="panel panel-default">
         <div class="panel-body">
         <div>
         <?php
          if($flag == '0')
          { ?>
                        <p> Please Enter Correct Userid/Password </p>
        <?php  }
         ?>
    
         </div>
             <div class="row">
                
                    <div class="col-lg-6">
                       
                            <div class="form-group">
                                <label>Email/Parish Id</label>
                                <input type="Email" class="form-control" name="email" value="" placeholder="Enter email" >
                            </div>
                                                               
                    </div>

                    

                      <div class="col-lg-6">
                       
                            <div class="form-group">
                                <label>Password</label>
                                <input type="Password" class="form-control" name="Password" value="" placeholder="password">
                            </div>
                                                               
                    </div>
                           
                              
             </div>
       
         </div>
       </div>

     <div class="row">

    <div class="col-lg-6" >
   <a href="<?php base_url();?>forgetPassword" align="center" style="float: left;text-decoration: none;"><h5>Forget Password</h5></a>
    </div>

    <div class="col-lg-6 rightclass">
   <button align="center" type="submit" class="btn btn-primary">Login</button>
    </div>

   
   
</div>

</form>


</div>

 <?php include('application/views/Footer/footer.php') ?>