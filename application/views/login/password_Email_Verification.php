<?php include('application/views/Header/header.php') ?>
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

        <div id="page-wrapper marginzero" class="container">
            <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Email Verification</h1>
                        </div>
                    
                    </div>
            <div class="form_error">
                  <?php echo validation_errors(); ?>
                </div>
                <?php  if($flag == 1) { ?>
                     <p>Please Enter Correct Email Address </p>
                <?php  } ?>
                    <form method="post" action="<?php echo base_url();?>Signup_controller/emailVerify" >
                  <div class="panel panel-default">
                 <div class="panel-body">
                     <div class="row">
                        
                            <div class="col-lg-6">
                               
                                    <div class="form-group">
                                        <label>Email</label>
                                     <input class="form-control" name="email" value="" placeholder="Enter email" >
                                    </div>
                                                                       
                            </div>                   
                                      
                     </div>
               
                 </div>
               </div>

             <div class="row">
            <div class="col-lg-12 rightclass">
           <button align="center" type="submit" class="btn btn-primary">Verify</button>
            </div>   
        </div>

        </form>


        </div>

      <?php include('application/views/Footer/footer.php') ?>