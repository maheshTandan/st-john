<?php include('application/views/services/service.php');
    $activateFlag = '';
    $deactivateFlag = '';
//    if($status ==1)
//    {
//        $activateFlag = 'checked';
//    }
//    else
//    {
//        $deactivateFlag = 'checked';
//    }

?>
<script type="text/javascript">
    
    $(document).ready(function() {
        // $('#js-date').datepicker();
    $('#dataTables-example').DataTable();

//    $("#datepicker").datepicker( {
//     format: "mm-yyyy",
//     viewMode: "months", 
//     minViewMode: "months"
// });
    $("#datepicker").datepicker( {
    format: "yyyy-mm",
    startView: "months", 
    minViewMode: "months"
});

$("#datepicker1").datepicker( {
    format: "yyyy-mm",
    startView: "months", 
    minViewMode: "months"
});
    

  
});
</script>

<?php 
     $Year = date('Y');
     $Month = date('m');
     $Date = $Year."-".$Month;
?>

<div id="page-wrapper" style="min-height: 327px;">

 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="text-align:center">Clone Menu/Delete Cloned Menu</h1>
        </div>
 </div>

 <form class="form-horizontal" method="post">

     <div class="row" align="center">

         <div class="col-md-12 searchbarMargin">
            <div class="col-sm-3"> <label class="form-check-label" for="">Clone from Date Select</label>
                <div class="input-group date" data-provide="datepicker" id="datepicker" data-date="<?php echo $Date; ?>" data-date-format="yyyy-mm">
                    <input  type="text" class="form-control"  id="data-date" name="date1"  value=""autocomplete="off"> 
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                </div> 
            </div>
             
             <div class="col-sm-3"> <label class="form-check-label" for="">Clone to Date Select/Delete date</label>
                <div class="input-group date" data-provide="datepicker" id="datepicker1" data-date="<?php echo $Date; ?>" data-date-format="yyyy-mm">
                    <input  type="text" class="form-control"  id="data-date1" name="date2"  value=""autocomplete="off"> 
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                </div> 
            </div>
             
             <div class="col-sm-2">
                 <div class="form-check form-check-inline">
                     <input type="radio" class="form-check-input clonecheck" id="showcal1" name="radiocal" value="1" <?php echo $activateFlag; ?>>
                     <label class="form-check-label" for="showcal1">Clone</label>
                 </div>
             </div>
             <div class="col-sm-2">
                 <div class="form-check form-check-inline">
                     <input type="radio" class="form-check-input clonecheck" id="hidecal1" name="radiocal" value="0" <?php echo $deactivateFlag; ?>>
                     <label class="form-check-label" for="hidecal1">Delete</label>
                 </div>
             </div>

             <div class="col-sm-2 submitbtnMargin" >
                 <input class="calendarSubmit" type="button" id="btnclick" value="Submit" >
             </div>

         </div>                
     </div>         
</form>
    <div class="loading" id="loading-image" style="display: none;">
        </div>

</div>



<?php
  $this->load->view('Footer/footer');
?> 

<script>
    $(document).ready(function(){
        $(document).on('click','#btnclick',function() {
            var radioVal = $('form input[type=radio]:checked').val();
            if(radioVal === '1')
            {
                 var datepointer = $('#data-date');
                 var dateVal = $.trim(datepointer.val());
                 
                 var datepointer1 = $('#data-date1');
                 var dateValto = $.trim(datepointer1.val());
                 
                 if($.trim(datepointer.val()) === '')
                 {
                     //alert('Please select date');
                     datepointer.parent().addClass('has-error');
                     //datepointer1.parent().addClass('has-error');
                     return false;
                    /// exit;
                 }
                 else if($.trim(datepointer1.val()) === '')
                 {
                     datepointer1.parent().addClass('has-error');
                     return false;
                 }
                 else
                 {
                     datepointer.parent().removeClass('has-error');
                     datepointer1.parent().removeClass('has-error');
                     //return true;
                 }   
                //alert(dateVal);
                bootbox.dialog({
                    title: 'Clone Menu',
                    message: "<p>Do you want to clone the menu</p>",
                   
                    buttons: {
                         ok: {
                                    label: "Yes",
                                    className: 'btn-info',
                                    callback: function(){
                                                 $.ajax({
                                                            url: '<?php echo base_url() ?>menuitemsel/cloneData',
                                                            //async: true,
                                                            data: {dateVal:dateVal, dateValto:dateValto},
                                                            type: 'POST',
                                                            dataType: 'json',
                                                            beforeSend: function(){
                                                                $("#loading-image").show();
                                                                //alert('before send');
                                                            },
                                                            success: function (data) {
                                                                        $("#loading-image").hide();
                                                                        var dialog = bootbox.dialog({
                                                                            message: '<p class="text-center">Cloning has been done.</p>',
                                                                            closeButton: false
                                                                            });
                                                                            setTimeout(function(){
                                                                            dialog.modal('hide');
                                                                            location.href = '<?php echo base_url() ?>menuitemsel/index';
                                                                        }, 2000);

                                                            },
                                                             error: function ( data ) {

                                                                }
                                                        });
                                    }
                                },
                        noclose: {
                                    label: "No",
                                    className: 'btn-warning',
                                    callback: function(){


                                    }
                        },
                     
                     
                    }
                    });
            }
            else if(radioVal === '0')
            {
            
                 var datepointer1 = $('#data-date1');
                 var dateValto = $.trim(datepointer1.val());
                 
                 if($.trim(datepointer1.val()) == '')
                 {
                     //alert('Please select date');
                    
                     datepointer1.parent().addClass('has-error');
                     return false;
                    /// exit;
                 }
                 else
                 {
                    
                     datepointer1.parent().removeClass('has-error');
                     //return true;
                 }   
            
            
                 bootbox.dialog({
                    title: 'Delete Clone',
                    message: "<p>Do you want to delete the current menu which you have cloned from the previous month.</p>",
                   
                    buttons: {
                         ok: {
                                    label: "Yes",
                                    className: 'btn-info',
                                    callback: function(){
                                                      $.ajax({
                                                            url: '<?php echo base_url() ?>menuitemsel/cloneDelData',
                                                            //async: true,
                                                            data: {dateValto:dateValto},
                                                            type: 'POST',
                                                            dataType: 'json',
                                                            beforeSend: function(){
                                                                $("#loading-image").show();
                                                                //alert('before send');
                                                            },
                                                            success: function (data) {
                                                                        $("#loading-image").hide();
                                                                        var dialog = bootbox.dialog({
                                                                            message: '<p class="text-center">Deleting has been done.</p>',
                                                                            closeButton: false
                                                                            });
                                                                            setTimeout(function(){
                                                                            dialog.modal('hide');
                                                                            location.href = '<?php echo base_url() ?>menuitemsel/index';
                                                                        }, 2000);

                                                            },
                                                             error: function ( data ) {

                                                                }
                                                        });
                                    }
                                },
                        noclose: {
                                    label: "No",
                                    className: 'btn-warning',
                                    callback: function(){


                                    }
                        },
                     
                     
                    }
                    });
            }
            else
            {
                bootbox.alert("Please select atleast one value!");

            }
        });
       
    });
</script>