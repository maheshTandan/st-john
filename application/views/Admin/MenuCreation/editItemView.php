
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
            <h1 class="page-header">Item Updation</h1>
        </div>
    </div>

    
     <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <form enctype="multipart/form-data" class="" name="menu_insert" method="post" action="<?php echo base_url()?>iteminst/edit/<?php echo $dataItem[0]['id']; ?>">
                                <div class="row">


                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Item</label>
                                            <input class="form-control" name='item_name' placeholder="Enter text" value="<?php echo $dataItem[0]['item_name']; ?>">
                                        </div>
                                    </div>

                                      <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Category3345</label>
                                            <select class="form-control category1" id ="category" name="category">
                                                <?php 
                                                    for ($i = 0; $i < count($dataCategory); $i++) 
                                                    {
                                                       if(trim($dataItem[0]['category_id']) == trim($dataCategory[$i]['id']))
                                                        { ?>
                                                            <option value="<?php echo $dataCategory[$i]['id']; ?>" selected><?php echo $dataCategory[$i]['category_name']; ?></option>
                                                <?php   }
                                                       else
                                                       { ?>
                                                            <option value="<?php echo $dataCategory[$i]['id']; ?>"><?php echo $dataCategory[$i]['category_name']; ?></option> 
                                                 <?php }
                                                ?>
                                                    
                                              <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" class="form-control" name='price_name' placeholder="Enter text" value="<?php echo $dataItem[0]['price']; ?>" maxlength="10">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Item Picture</label>
                                            <input id="uploadFile" name="uploadFileOne" type="text" disabled="disabled" placeholder="<?php echo $dataItem[0]['Image']; ?>" class="name-info-form file-witdth" />
                                            <input class="upload" type="file" id="fileupload" name="userfile" value="Select File" size="20" />
                                            <input type="hidden" name="hiddenfile" value="<?php echo $dataItem[0]['Image']; ?>" />
                                            
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