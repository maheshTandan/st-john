

<?php
//print_r($dataCal); 
$this->load->view('Header/header');
?>


<style>
    .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso 
    form{font-family: Arial, Helvetica, sans-serif; color: black}
    .bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} 
    .asteriskField{color: red;}
    .MT-50{margin-top: 50px}    
    .MT-25{margin-top: 25px}
    
    .prev_sign a, .next_sign a{
    color:white;
    text-decoration: none;
    }
    tr.week_name{
    font-size: 16px;
    font-weight:400;
    color:red;
    width: 10px;
    background-color: #efe8e8;
    }
    .highlight{
    background-color:#25BAE4;
    color:white;
    height: 22px;
    padding-top: 2px;
    padding-bottom: 7px;
    }
    
</style>


<div id="page-wrapper" style="min-height: 327px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>

    
     <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <form class="form-horizontal" name="menu_insert" method="post" action="menuinst/savemenudata">
                                <div class="row">


                                    <div class="col-sm-12 ">
                                        <div class="form-group text-center">
                                            <label>Calender</label>
                                            <?php 
                                            
                                            echo $this->calendar->generate($dataCal['year'],$dataCal['month'],$caldata); 
                                            //echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
                                            
                                            
                                            ?>
                                        </div>
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
                    Menu date wise list
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
                                            <th>Date</th>
                                            <th>Menu</th>
                                            <th>Item</th>
                                    </thead>
                                    <tbody>
                                            <?php 
                                                $srnum=1;
                                                foreach ($data as $value) {
                                                    ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1"><?php echo $srnum++; ?></td>
                                            <td class="sorting_1"><?php echo $value['date']; ?></td>
                                            <td class="sorting_1"><?php echo $value['menu_name']; ?></td>
                                             <td class="sorting_1"><?php echo $value['item']; ?></td>
<!--                                            <td class="edit tooltip-display" style="background-color:">
                                                <span data-toggle="tooltip" data-placement="bottom" title="" style="text-align:center!important;" data-original-title="Edit Location">
                                                 <a href="menuinst/edit/<?php //echo $value['id']; ?>">
                                                     <button class="btn btn-xs btn-warning">
                                                     <span class="glyphicon no-marg glyphicon-pencil" data-original-title="" title=""></span>
                                                     </button>
                                                 </a>
                                                 </span>
                                                <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Location">
                                                    <a href="menuinst/delete/<?php //echo $value['id']; ?>">
                                                        <button class="btn btn-xs btn-danger"><span class="glyphicon no-marg glyphicon-trash" data-original-title="" title=""></span></button>
                                                    </a>
                                                </span>
                                    
                                </td>-->
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