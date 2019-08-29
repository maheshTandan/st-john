
<?php include('application/views/services/service.php') ?>
    

<script type="text/javascript">
    
    $(document).ready(function() {
    $('#dataTables-example').DataTable();
} );
</script>
<div id="page-wrapper">
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Services</h1>
                </div>
  </div>
    <div class="form_error">
          <?php echo validation_errors(); ?>
</div>

 <form method="post" action="manageService" >
           <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading rightclass">
                              <a href="<?php echo base_url();?>Access_controller/createService"" type="button" class="btn btn-primary btn-submit" >Create Service</a> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Service Name</th>
                                        <th>Created By</th>
                                        <th>Action</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $srnum=1;
                                    foreach ($servicedata as $key => $value) { 
                                      //  print_r($value); die;
                                if(!empty($value['serviceName']) && !empty($value['Name'])){ ?>
                                    <tr class="odd gradeX">
                                           <td ><?php echo $srnum++; ?></td>
                                        <td><?php echo $value['serviceName'] ?></td>
                                          <td><?php echo $value['Name'] ?></td>
                                        <td> <a href="<?php echo base_url();?>Access_controller/editService/<?php echo $value['serviceid']?>" type="button" class="btn btn-xs btn-warning btn-style"><i class="fa fa-pencil" data-original-title="" title=""></i></a>
                                            <a href="<?php echo base_url();?>Access_controller/delService/<?php echo $value['serviceid']?>" type="button" class="btn btn-xs btn-danger btn-style"><i class="fa fa-trash" data-original-title="" title=""></span></a></td>
                                       
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



 <?php include('application/views/Footer/footer.php') ?>