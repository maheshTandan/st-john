

  <?php include('application/views/services/service.php') ?>


          <script type="text/javascript">
    
    $(document).ready(function() {
    $('#dataTables-example').DataTable();
} );
</script>

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
            <h1 class="page-header">Menu Insertion</h1>
        </div>
    </div>

    
     <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <form class="form-horizontal" name="menu_insert" method="post" action="<?php echo base_url();?>menuinst/savemenudata">
                                <div class="row">


                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Menu</label>
                                            <input class="form-control" name='menu_name' placeholder="Enter text">
                                        </div>
                                    </div>

                                    <div class="col-sm-3 MT-25"><button class="btn btn-info btn-submit" name="submit" type="submit">
                                            Insert     
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
    
    
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Menu List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>Sr No.</th>
                                            <th>Menu</th>
                                            <th>Action</th>
                                    </thead>
                                    <tbody>
                                            <?php 
                                                $srnum=1;
                                                foreach ($dataMenu as $value) {
                                                    ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1"><?php echo $srnum++; ?></td>
                                            <td class="sorting_1"><?php echo $value['menu_name']; ?></td>
                                            <td class="edit tooltip-display" style="background-color:">
                                               <!--  <span data-toggle="tooltip" data-placement="bottom" title="" style="text-align:center!important;" data-original-title="Edit Location">
                                                 <a href="<?php // echo base_url();?>menuinst/edit/<?php // echo $value['id']; ?>">
                                                     <button class="btn btn-xs btn-warning btn-style">
                                                     <i class="fa fa-pencil" data-original-title="" title=""></i>
                                                     </button>
                                                 </a>
                                                 </span> -->
                                                <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Location">
                                                    <a href="<?php echo base_url();?>menuinst/delete/<?php echo $value['id']; ?>">
                                                        <button class="btn btn-xs btn-danger btn-style"><i class="fa fa-trash"></i></button>
                                                    </a>
                                                </span>
                                    
                                       
                                    <input type="hidden" name="loc4" id="loc4" value="0000">
                                    <input type="hidden" name="loc5" id="loc5" value="Y0000">
                                    <input type="hidden" name="locid" id="locid" value="Y00001">
                                    <input type="hidden" name="diocese_id" id="diocese_id" value="1">
                                    
                                    
                                </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                  
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    
    
    
    
    
    
    
    
    
    
    
   
</div>





















<?php

$this->load->view('Footer/footer');
?>