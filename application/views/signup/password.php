<?php include('application/views/Header/header.php');

 // print_r($a); die;
 ?>

<div id="page-wrapper">
 
    <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
            <form method="post" action="<?php echo base_url();?>Signup_controller/login" >
          <div class="panel panel-default">
         <div class="panel-body">
             <div class="row">
                                <div class="col-lg-4">
                                   
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" type="password" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" value="" name="pwd1"
                                             onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');if(this.checkValidity()) form.pwd2.pattern = RegExp.escape(this.value);" placeholder="Password" >

                                        </div>
                                                                           
                                </div>

                                

                                  <div class="col-lg-4">
                                   
                                        <div class="form-group">
                                            <label>Re-Password</label>
                                            <input title="Please enter the same Password as above"  type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" class="form-control" name="pwd2" value="" onchange="this.setCustomValidity(
                                            this.validity.patternMismatch ? this.title : '');" placeholder="Re-password">

                        
                                        </div>
                                                                           
                                </div>
                           
                         <input type="hidden" name="email2" value="<?php echo $a ?>" >
                         <input type="hidden" name="email" value="<?php echo $email ?>" >
                         <input type="hidden" name="token" value="<?php echo $token ?>" >
                         <input type="hidden" name="id" value="<?php echo $id ?>" >
                            </div>
       
         </div>
       </div>

        <div class="row">
    <div class="col-lg-12">
   <button align="center" type="submit" class="btn btn-default">create Password</button>
    </div>
   
</div>
 </form>


</div>

 <?php include('application/views/Footer/footer.php') ?>