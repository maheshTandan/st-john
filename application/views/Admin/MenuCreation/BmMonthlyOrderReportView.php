 <?php include('application/views/services/service.php') ?>


<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
	
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {extend: 'csv', title: 'Monthly Order Report'}, {extend: 'excel', title: 'Monthly Order Report'}, {extend: 'pdf', title: 'Monthly Order Report'}, { extend: 'print', title: 'Monthly Order Report'}

        ]
    });
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
                   Monthly Order Report
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
                                            <th>LUNCH A</th> 
                                            <th>LUNCH B</th> 
                                            <th>LUNCH S</th> 
                                            <th>Chocolate milk</th> 
                                            <th>White milk</th> 
                                            <th>Juice</th> 
                                            <th>Water</th> 
                                        
<!--                                            <th>Edit</th>-->
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php  $srnum=1;
                                            for ($i=0; $i<count($reportData);$i++) { ?>
                                            <tr  role="row">
                                                <td ><?php echo $srnum++; ?></td>
                                                <td ><?php echo $reportData[$i]['date'] ?></td>
                                                <td ><?php echo $reportData[$i]['LUNCH A'] ?></td>
                                                <td ><?php echo $reportData[$i]['LUNCH B'] ?></td>
                                                <td ><?php echo $reportData[$i]['LUNCH S'] ?></td>
                                                <td ><?php echo $reportData[$i]['Chocolate milk'] ?></td>
                                                <td ><?php echo $reportData[$i]['White milk'] ?></td>
                                                <td ><?php echo $reportData[$i]['Juice'] ?></td>
                                                <td ><?php echo $reportData[$i]['Water'] ?></td>
                                            
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