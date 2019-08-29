
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Create Menu</title>
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Source+Sans+Pro:400,600,700" rel="stylesheet">
    <?= link_tag('application/css/main.css'); ?>
       <?= link_tag('application/css/bootstrap.min.css'); ?>
        
           <?= link_tag('application/css/animate.css'); ?>
             <?= link_tag('application/css/flaticon.css'); ?>
              
        <?= link_tag('application/css/smart-forms.css'); ?>
       
       <?= link_tag('application/css/style.css'); ?>
        <?= link_tag('application/css/style.min.css'); ?>
        <?=  link_tag('application/css/font-awesome.min.css'); ?>
         <?=  link_tag('application/css/dataTables.bootstrap.min.css'); ?>
          

      
      
        <?= link_tag('application/css/metisMenu.min.css'); ?>
        <?=   link_tag('application/css/sb-admin-2.css'); ?>
        <?=  link_tag('application/css/morris.css'); ?> 
       

        
     
     
      


<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" ></script>-->
        
        <!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>application/js/isotope.pkgd.js" ></script>

<!--===============================================================================================-->
	  <script type="text/javascript" src="<?php echo base_url();?>application/js/jquery-ui.js"></script>
          <script type="text/javascript" src="<?php echo base_url();?>application/js/wow.min.js"></script>
<!-- 	<script type="text/javascript">
		new WOW().init();
                //console.log(new WOW().init());
	</script> -->
    <script type="text/javascript" src="<?php echo base_url();?>application/js/popper.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url();?>application/js/animsition.min.js"></script>
<!--===============================================================================================-->

<!--	<script type="text/javascript" src="<?php //echo base_url();?>application/js/bootstrap.min.js"></script>-->
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>application/js/main.js"></script>

<!--===============================================================================================-->
    
        
        
        
        <script type="text/javascript" src="<?php echo base_url();?>application/js/bootstrap.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>application/js/Jquery.dataTables.min.js" ></script>
         <script type="text/javascript" src="<?php echo base_url();?>application/js/dataTables.bootstrap.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>application/js/bootbox.min.js" ></script>
       

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/> 

</head>
<body>
    <?php  $loginstatus   = $this->session->userdata('logged_in'); 
    //print_r($loginstatus); 
         if(!empty($loginstatus)){
    ?>
           <div id="top-area" class="top-area top-area-style-default top-area-alignment-left">
            <div class="container">
                <div class="row ">
                    <div class="col-sm-5 top-area-block top-area-contacts"><div class="gem-contacts inline-inside"><div class="gem-contacts-item gem-contacts-address"><i class="fa fa-map-marker mr-10"></i>502 S. Park Blvd., Streamwood, IL 60107 </div><div class="gem-contacts-item gem-contacts-phone"><i class="fa fa-phone mr-10"></i>630.837.6500 </div></div></div>
                    <div class="col-sm-7">
                        <div class="welcom-Login">
                            Welcome <strong><?php echo $loginstatus['name']; ?></strong>, You have been logged in as <strong><?php echo $loginstatus['type']; ?></strong> for <strong>St John Account</strong>
                        </div>
                        </div>
                    </div>
                  <!--   <div class="top-area-block top-area-menu">
                        <div class="top-area-button"><div class="gem-button-container gem-button-position-inline"><a class="gem-button gem-button-size-tiny gem-button-style-flat gem-button-text-weight-normal gem-button-no-uppercase" style="border-radius: 3px;" onmouseleave="" onmouseenter="" href="#" target="_self">DONATE NOW</a></div> </div>
                    </div> -->
                </div>
            </div>
         <?php } ?>
        <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-static-top mynavbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>application/images/Logo.png"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="http://52.76.89.150/sites/stjohn/?page_id=33654" target="_blank">Parish Staff</a></li>
                        <li><a href="#contact">New Parishner</a></li>

                        <li><a href="http://52.76.89.150/sites/stjohn/?page_id=33229" target="_blank">Gallery</a></li>
                        <li><a href="http://52.76.89.150/sites/stjohn/?page_id=32856" target="_blank">About Us</a></li>

                        <?php
                        if(!empty($loginstatus)){ ?> 
                             
                                <li class="dropdown">
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
                                          <ul class="dropdown-menu drop123">
                                            <li><a href="<?php echo base_url();?>Signup_controller/personalProfile/<?php echo $loginstatus['parent_id']  ?>"><i class="fa fa fa-user fa-fw mr-5"></i>Profile</a></li>
                                            <li><a href="<?php echo base_url();?>Signup_controller/resetPassword"><i class="fa fa-unlock-alt fa-fw mr-5"></i>Reset Password</a></li>
                                             <li><a href="<?php echo base_url();?>Signup_controller/logout">
                                            <i class="fa fa-sign-out fa-fw mr-5"></i>Logout</a> </li>
                                               
                                          </ul>
                                        </li>

                         <?php }else{ ?> 
                        <li><a href="<?php echo base_url();?>Signup_controller/login">Signin</a> </li>
                       
                         <li><a href="<?php echo base_url();?>Signup_controller"></i>Signup</a>
                        </li>

                         <?php } ?>
                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </nav>

