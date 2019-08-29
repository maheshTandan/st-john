 <?php include('application/views/services/service.php') ?>
<script type="text/javascript">
	
	$(document).ready(function() {
    $('#dataTables-example').DataTable();
} );
</script>

<div id="page-wrapper" style="min-height: 327px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"></h1>
        </div>
    </div>
 
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Parent List
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
                                            <th>Parent Name</th>
                                            <th>Email</th> 
                                            <th>Cell</th> 
                                            <th>Status</th>
                                            <th>Change Password</th>
                                            <th>Edit</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php  $srnum=1;
                                            for ($i=0; $i<count($parentList);$i++) { ?>
                                            <tr  role="row">
                                            <td ><?php echo $srnum++; ?></td>
                                            <td ><?php
                                      //   echo $parentList[$i]['first_name']; die;
                                        if($parentList[$i]['first_name'] !== " ")

                                              { 
                                               echo $parentList[$i]['first_name'];}
                                               else{
                                               echo $parentList[$i]['mother_name'];
                                               }

                                              ?></td>
                                            <td ><?php echo $parentList[$i]['email'] ?></td>
                                            <td ><?php echo $parentList[$i]['phone'] ?></td>
                                            <?php if($parentList[$i]['status'] == '1') { ?>
                                            <td >Active</td>
                                            <?php  } else { ?>
                                            <td >InActive</td>
                                            <?php } ?>
                                            <td>
                                                <span>
                                                 <a href="<?php echo base_url(); ?>Signup_controller/bmPasswordReset/<?php echo $parentList[$i]['id'] ?>"">
                                                     <button class="btn btn-xs btn-warning btn-style">
                                                     Reset Password
                                                     </button>
                                                 </a>
                                             </span>
                                            </td>
                                            <td class="edit tooltip-display" style="background-color:">
                                           
                                             <span data-toggle="tooltip" data-placement="bottom" title="" style="text-align:center!important;" data-original-title="Edit Location">
                                                 <a href="<?php echo base_url(); ?>Signup_controller/personalProfile/<?php echo $parentList[$i]['id'] ?>">
                                                     <button class="btn btn-xs btn-warning btn-style">
                                                     <i class="fa fa-pencil" data-original-title="" title=""></i>
                                                     </button>
                                                 </a>
                                             </span>
                          
                                           </td>

                                        </tr>
                                    <?php } ?>
                                       </tbody>
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

 <?php include('application/views/Footer/footer.php') ?>