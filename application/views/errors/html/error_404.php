<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$ci = new CI_Controller();
$ci =& get_instance();
$ci->load->helper('url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<link href='http://fonts.googleapis.com/css?family=Amarante' rel='stylesheet' type='text/css'>
<style type="text/css">
body{
    background:url(<?php echo base_url(); ?>application/images/bg.png);
    margin:0;
}
.wrap{
    margin:0 auto;
    width:1000px;
}
.logo{
    margin-top: -300px;
    text-align:center;
}   
.logo p span{
    color:lightgreen;
}   
.sub a{
    color:white;
    background:rgba(0,0,0,0.3);
    text-decoration:none;
    padding:5px 10px;
    font-size:13px;
    font-family: arial, serif;
    font-weight:bold;
}   
.footer{
    color:#555;
    position:absolute;
    right:10px;
    bottom:10px;
    font-weight:bold;
    font-family:arial, serif;
}   
.footer a{
    font-size:16px;
    color:#ff4800;
}   
</style>
</head>
<body>
    <img src="<?php echo base_url(); ?>application/images/bg.png"/> 
    <div class="wrap">
       <div class="logo">
           <img src="<?php echo base_url(); ?>application/images/404.png"/>
               <div class="sub">
                 <p><a href="<?php echo base_url(); ?>">Go Back to Home</a></p>
               </div>
        </div>
     </div>
</body>
</html>