
 <?php include('application/views/services/service.php') ?>

           

<style>
    .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso 
    form{font-family: Arial, Helvetica, sans-serif; color: black}
    .bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} 
    .asteriskField{color: red;}
    .MT-50{margin-top: 50px}    
    .MT-25{margin-top: 25px}
</style>



<div id="page-wrapper" style="min-height: 327px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Menu Updation</h1>
        </div>
    </div>

    
     <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <form class="form-horizontal" name="menu_insert" method="post" action="<?php echo $dataMenu[0]['id']; ?>">
                                <div class="row">


                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Menu</label>
                                            <input class="form-control" name='menu_name' placeholder="Enter text" value="<?php echo $dataMenu[0]['menu_name']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-3 MT-25"><button class="btn btn-info " name="submit" type="submit">
                                            Update     
                                        </button> <?php if($flag==1){ ?><span class="has-success"><label class="control-label">Menu inserted</label></span><?php } ?> 
                                    </div>
                                    
                                
                                    
                                </div>
                                <!--                                <hr>-->
                                <!--                                <div class="row text-center">
                                                                    <div class="form-group clearfix">
                                                                        <div class="">
                                                                            <button class="btn btn-primary " name="submit" type="submit">
                                                                                Submit
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php

$this->load->view('Footer/footer');
?>