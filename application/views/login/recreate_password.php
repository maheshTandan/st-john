
 <?php include('application/views/Header/header.php') ?> 
<?php 
// $id = $stuff['id'];
//print_r($id); die;

?>
 <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
            
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url();?>Signup_controller/login"><i class="fa fa-sign-out fa-fw"></i>Login</a>
                        </li>
                    </ul>
                </li>
            </ul>
      </nav>
<div id="page-wrapper">
         <div class="form_error">
          <?php echo validation_errors(); ?>
        </div>
            <form method="post" action="<?php echo base_url();?>Signup_controller/passwordCreate" >
          <div class="panel panel-default">
         <div class="panel-body">
             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" type="password" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" value="" name="pwd1"
                                             onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');if(this.checkValidity()) form.pwd2.pattern = RegExp.escape(this.value);" placeholder="Password" >

                                        </div>
                                                                           
                                </div>

                                

                                  <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Re-Password</label>
                                            <input title="Please enter the same Password as above"  type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" class="form-control" name="pwd2" value="" onchange="this.setCustomValidity(
                                            this.validity.patternMismatch ? this.title : '');" placeholder="Re-password">

                        
                                        </div>
                                                                           
                                </div>
                           
                           <input type="hidden" name="emailid" value="<?php echo $id ?>" >
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