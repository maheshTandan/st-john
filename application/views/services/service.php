 <?php include('application/views/Header/header.php') ?>
    
<div class="navbar-default sidebar"  role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav in" id="side-menu">  
                        <?php  foreach ($serviceData as $key => $value) { ?>
                   
                        <li>
                           <a href="<?php  echo base_url()?><?php echo $value['link']; ?>"> <?php echo $value['service'] ?></a>
                        </li>
                           <?php  } ?>
                    </ul>
                </div>
 </div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.dropdown-toggle').click(function(){
            $(".dropdown-menu").css({"display": "block"});
        })


        $(document).click(function(){
           $(".drop123").hide();
     });
    })


    
</script>

