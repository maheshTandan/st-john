
  <?php include('application/views/services/service.php') ?>

<script type="text/javascript">
  
  $(document).ready(function() {
    $('#dataTables-example').DataTable();
} );
</script>


<?php if(isset($profiledata)){?>
   
<div id="page-wrapper">
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Profile </h1>
                </div>
  </div>


    <div class="form_error">
          <?php echo validation_errors(); ?>
</div>

 <form method="post" action="<?php echo base_url();?>Access_controller/manageProfile" >
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading rightclass">
                              <a href="<?php echo base_url();?>Access_controller/createProfile" type="button" class="btn btn-primary btn-submit" >Create Profile</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Profile Name</th>
                                        <th>Created By</th>
                                        <th>Action</th>    
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $srnum=1;
                                     foreach ($profiledata as $key => $value) { 
                                        if(!empty($value['Name']) && !empty($value['profile'])){?>
                                    <tr class="odd gradeX">
                                            <td ><?php echo $srnum++; ?></td>
                                     <td><?php echo $value['profile'] ?></td>
                                     <td><?php echo $value['Name'] ?></td>
                                     <td><a href="<?php echo base_url();?>Access_controller/editProfile/<?php echo $value['id']?>" type="button" class="btn btn-xs btn-warning btn-style"> <i class="fa fa-pencil" data-original-title="" title=""></i></a>
                                      <a href="<?php echo base_url();?>Access_controller/delProfile/<?php echo $value['id']?>" type="button" class="btn btn-xs btn-danger btn-style"><span class="fa fa-trash" data-original-title="" title=""></span></a></td>    
                                    </tr> 
                              <?php }  }?>
                                </tbody>
                            </table>
                        
                        
                        </div>
                  
                    </div>
         
                </div>
            
            </div>

   <!--          <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
       Modal content-->
    <!--   <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> -->
</form>


</div>
 <?php }

 else
 { ?>

  
<div id="page-wrapper">
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Profile </h1>
                </div>
  </div>


    <div class="form_error">
          <?php echo validation_errors(); ?>
</div>

 <form method="post" action="<?php echo base_url();?>Access_controller/manageProfile" >
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Profile 
                              <a href="<?php echo base_url();?>Access_controller/createProfile" type="button" class="btn btn-primary btn-submit">Create Profile</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Profile Name</th>
                                        <th>Created By</th>
                                        <th>Action</th>    
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                     foreach ($profiledata as $key => $value) { 
                                        if(!empty($value['Name']) && !empty($value['profile'])){?>
                                    <tr class="odd gradeX">
                                     <td><?php echo $value['profile'] ?></td>
                                     <td><?php echo $value['Name'] ?></td>
                                     <td>  <a href="<?php echo base_url();?>Access_controller/editProfile/<?php echo $value['id']?>" type="button" class="btn btn-primary">Edit Profile</a><a href="" type="button" class="btn btn-danger">Disable</a></td>    
                                    </tr> 
                              <?php }  }?>
                                </tbody>
                            </table>
                        
                        
                        </div>
                  
                    </div>
         
                </div>
            
            </div>

</form>


</div>
 <?php }?>




 <?php include('application/views/Footer/footer.php') ?>