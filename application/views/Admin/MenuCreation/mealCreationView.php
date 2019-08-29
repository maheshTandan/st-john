<?php 
    include('application/views/services/service.php');
    //echo $error;
    //echo form_open_multipart('mealcreation/itemInst');
?>
 



<style>
    .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso 
    form{font-family: Arial, Helvetica, sans-serif; color: black}
    .bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} 
    .asteriskField{color: red;}
    .MT-50{margin-top: 50px}    
    .MT-25{margin-top: 25px}
.dataTables_scrollHeadInner{width:100% !important}
div.dataTables_scrollHead table.table-bordered {
    width: 100% !important;
}
</style>


<div id="page-wrapper" style="min-height: 327px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Meal Manager</h1>
        </div>
    </div>

    
     <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
<!--                            <form class="form-horizontal" id="meal_insert" name="meal_insert" method="post" action="<?php //echo base_url();?>mealcreation/savemenudata">-->
                                <div class="row">
                                    <div class="col-sm-3 ">
                                        <div class="form-group row">
                                            <label>Meal Name</label>
                                            <input class="form-control mealname" id="category_name" name='category_name' placeholder="Enter text">
                                             <p class="itemalert" style="color: red; display:none; "><b>Already Exist!</b></p>
                                             <p class="itemalert1" style="color: green; display:none; "><b>Available</b></p>
                                             <input type="hidden" value="" id="itemalerthidden" />
                                                <div id="alertmsg1" style="color:red;"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3 ">
                                        <div class="form-group row">
                                            <label>Meal Alias</label>
                                            <input class="form-control mealalias" id="meal_alias" name='meal_alias' placeholder="Enter text">
                                             <p class="itemmealalert" style="color: red; display:none; "><b>Already Exist!</b></p>
                                             <p class="itemmealalert1" style="color: green; display:none; "><b>Available</b></p>
                                             <input type="hidden" value="" id="itemalertmealhidden" />
                                                <div id="alertmealmsg1" style="color:red;"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 ">
                                        <div class="form-group row">
                                            <label>Price</label>
                                            <input type="number" class="form-control mealprice"  name='price' placeholder="Enter price" min="1">
                                          <!--    <p class="itemalert" style="color: red; display:none; "><b>Already Exist!</b></p> -->
                                           <!--   <p class="itemalert1" style="color: green; display:none; "><b>Available</b></p> -->
                                             <div id="alertmsg2" style="color:red;"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 MT-25">
                                        <button class="btn btn-info" id="mealsubmit" name="submit" type="submit">
                                            Submit     
                                        </button> <?php if($flag==1){ ?><span class="has-success"><label class="control-label">Menu inserted</label></span><?php } ?> 
                                    </div>
                                    <div class="col-sm-6 pull-right MT-25">
                                         <button id="btnAdd" class="btn btn-success" style="float: right;">Add Item</button>
                                   </div>
                                </div>
                                
<!--                            </form>-->
                        
                            <div class="row">
                               
                            </div>
                            
                            <div class="row">
                                <div class="alert alert-success" id ="itemaddedDiv" style="display: none;">
                                </div>
                            </div>
                        
                           
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
                    Meal List
                </div>
                
                <div class="alert alert-success" id="mtabl" style="display: none;">
        
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
                                            <th>Meal</th>
                                            <th>Items in Meal Plan</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Assign</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showdata">
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
    
    
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form id="myForm" action="" method="post" class="form-horizontal">
                        <input type="hidden" name="txtId" value="0">
                        <div class="form-group">
                            <div class="panel-body">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="modalitemtab" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Sr No.</th>
                                                        <th>Items</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="showdata1">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                        <input type="hidden" value="" name="hiddenlocid" id="hiddenlocid" />
                        <input type="hidden" value="" name="hiddenmenuid" id="hiddenmenuid" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    Do you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="myModal1" class="modal fade " tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body ">
            <form enctype="multipart/form-data" accept-charset="utf-8" name="myForm1" id="myForm1"  action="" method="post" class="form-horizontal" >
                <input type="hidden" name="txtId" value="0">
                           <div class="form-group">
                            <div class="panel-body">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table  class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="modalitemtab1" role="grid" aria-describedby="dataTables-example_info" >
                                                <thead>
                                                    <tr role="row">
                                                        <th>Items Name</th>
                                                        <th>Category</th>
                                                        <th>Price ($)</th>
                                                        <th>Item Pic</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <td>
                                                    <input type="text" name="txtItemName"  class="form-control">
                                                     <div id="alertmsg11" style="color:red;"></div>
                                                </td>
                                                <td>
                                                    <select class="form-control category1" id ="category" name="category">
                                                        <option value="0" selected>--Select--</option>
                                                        <?php for ($i = 0; $i < count($category); $i++) { ?>
                                                            <option value="<?php echo $category[$i]['id']; ?>"><?php echo $category[$i]['category_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div id="alertmsg22" style="color:red;"></div>
                                                </td>
                                                <td>
                                                    <input type="number" name="txtPriceName" class="form-control" placeholder="Enter price" maxlength="10" min="0">
                                                    <p class="pricealert" style="color: red; display: none;"><b>You can't enter -ve Price.</b></p>
                                                     <div id="alertmsg33" style="color:red;"></div>
                                                </td>
                                                <td>
                                                    <input type="file" class="fileupload" name="userfile" size="20" />
                                                    <div id="filediv" style="display:none;">Please select an image.</div>
                                                </td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave1" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
    
    
    
    
    
    
    
    
    
   
</div>

<script>
     $(document).ready(function () {

        // $(document).on('dblclick','.td_class',Edit)
        // function Edit(){
              
        //                    $(this).html("<select><option value=1>Active</option><option value=0>Inactive</option></select>");  

        //   };

         
            showAllMeal();
            
              $('#category_name').keyup(function(){
        //alert($.trim($(this).val()).length);
                    if($.trim($(this).val()).length > 0){
                       //$(this).parent().removeClass('has-error');
                       var itemName = $.trim($(this).val());
                       // console.log(itemName);
                       $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url(); ?>mealcreation/ajaxcheckitem',
                                data:  {itemName: itemName},
                                dataType: 'json',
                                success: function(data){
                                        //console.log(data);
                                        $('#itemalerthidden').val(data);
                                        if(data == 1)
                                        {
                                            //console.log(data);
                                            $('.itemalert').hide();
                                            $('.itemalert1').show();
                                        }
                                        else
                                        {
                                            $('.itemalert1').hide();
                                            $('.itemalert').show();
                                        }
                                },
                                error: function(){

                                }
                        });
                    }
                    else{
                                $('.itemalert').hide();
                                $('.itemalert1').hide();
                                $('#itemalerthidden').val('');
                    }

            });
            
        //      $('#meal_alias').keyup(function(){
        // //alert($.trim($(this).val()).length);
        //             if($.trim($(this).val()).length > 0){
        //                //$(this).parent().removeClass('has-error');
        //                var itemName = $.trim($(this).val());
        //                // console.log(itemName);
        //                $.ajax({
        //                         type: 'POST',
        //                         url: '<?php // echo base_url(); ?>mealcreation/ajaxcheckitemalias',
        //                         data:  {itemName: itemName},
        //                         dataType: 'json',
        //                         success: function(data){
        //                                 //console.log(data);
        //                                 $('#itemalertmealhidden').val(data);
        //                                 if(data == 1)
        //                                 {
        //                                     console.log(data);
        //                                     $('.itemmealalert').hide();
        //                                     $('.itemmealalert1').show();
        //                                 }
        //                                 else
        //                                 {
        //                                     $('.itemmealalert1').hide();
        //                                     $('.itemmealalert').show();
        //                                 }
        //                         },
        //                         error: function(){

        //                         }
        //                 });
        //             }
        //             else{
        //                         $('.itemmealalert').hide();
        //                         $('.itemmealalert1').hide();
        //                         $('#itemalertmealhidden').val('');
        //             }

        //     });
     
                
           
                
                  
                $("#mealsubmit").click(function(){
                    
                    var mealName = $(this).parent().parent().find('input.mealname');
                    var mealAlias = $(this).parent().parent().find('input.mealalias');
                    var mealname = $.trim(mealName.val());
                    var mealalias = $.trim(mealAlias.val());
                    var mealPrice1 = $(this).parent().parent().find('input.mealprice');
                    var mealprice = $.trim(mealPrice1.val());

                    // console.log(mealname);
                    // console.log(mealprice);
                 /*   
                    if (mealname == '') 
                    {
                        //alert("meal name ki value pe");
                        mealName.parent().addClass('has-error');
                        $('#alertmsg1').html('');
                        $('#alertmsg1').append("Meal name should not be blank!");
                        return false;
                    } */
                   /* 
                    if (mealalias == '') 
                    {
                        //alert("meal name ki value pe");
                        mealAlias.parent().addClass('has-error');
                        $('#alertmealmsg1').html('');
                        $('#alertmealmsg1').append("Meal Alias name should not be blank!");
                        return false;
                    } */
                    
                    if($.trim($("#itemalerthidden").val())=="" || $.trim($("#itemalerthidden").val())=='0' || mealname == '')
                    {
                         $("#item_name").parent().addClass('has-error');
                         $('#alertmsg1').html('');
                         if(mealname == ''){
                         $('#alertmsg1').append("Meal name should not be blank!"); }
                         return false;
                    }
                    else
                    {
                        $("#item_name").parent().removeClass('has-error');
                        $('#alertmsg1').html('');
                    }
                    
                    if($.trim($("#itemalertmealhidden").val())=="" || $.trim($("#itemalertmealhidden").val())=='0' || mealalias == '')
                    {
                        // $("#meal_alias").parent().addClass('has-error');
                         $('#alertmealmsg1').html('');
                         if(mealalias == ''){
                         $('#alertmealmsg1').append("Meal Alias name should not be blank!");
                         return false;
                          }
                         
                    }
                    else
                    {
                        $("#meal_alias").parent().removeClass('has-error');
                        $('#alertaliasmsg1').html('');
                    }
                    
                    
                    
                    
                    if (mealprice == '') 
                    {
                       //alert("blank pice ke liye");
                         mealPrice1.parent().addClass('has-error');
                         $('#alertmsg2').html('');
                         $('#alertmsg2').append("Price Alert!");
                         return false;
                    }
                    else{
                         mealPrice1.parent().removeClass('has-error');
                         $('#alertmsg2').html('');
                    }
                    
                   // alert(mealprice); exit;
                    if (mealprice < 0) 
                    {
                       //alert("meal price 0 se bada");
                         mealPrice1.parent().addClass('has-error');
                         $('#alertmsg2').html('');
                         $('#alertmsg2').append("Price Alert!");
                         return false;
                    }
                    else{
                        
                            $.ajax({
                            type: 'ajax',
                            method: 'post',
                            url: '<?php echo base_url() ?>mealcreation/savemenudata',
                            data: {mealname: mealname,meal_alias:mealalias,mealprice: mealprice},
                            dataType: 'json',
                            success: function(response){
                                    if(response.success){
                                        $('#mtabl.alert-success').html('Meal Added successfully').fadeIn().delay(4000).fadeOut('slow');
                                        location.href = '<?php echo base_url() ?>mealcreation';
                                        //showAllMeal();
                                    }else{
                                            alert('Error');
                                    }
                                    //$( "input:reset" );
                            },
                            error: function(){
                                    alert('Could not add data');
                            }
                    });
                      
                            //console.log(mealname);
                        
                        return true;
                    }
                });
                
                $('#category_name').keyup(function(){
                      if($.trim($(this).val()).length > 0){
                         $(this).parent().removeClass('has-error');
                         $('#alertmsg1').html('');
                      }
                      
                });
                
                
                 $('#meal_alias').keyup(function(){
                      if($.trim($(this).val()).length > 0){
                         $(this).parent().removeClass('has-error');
                         $('#alertmealmsg1').html('');
                      }
                      
                });

               //Add New item
        $('#btnAdd').click(function(){
            $('#myForm1')[0].reset();
            //$('#myForm')[0].reset();
            $('#myModal1').modal('show');
            $('#myModal1').find('.modal-title').text('Add New Item');
            $('#myForm1').attr('action', '<?php echo base_url() ?>mealcreation/itemInst');
        });
                
                //item add
                $('#btnSave1').click(function(){
                   
                var url = $('#myForm1').attr('action');
   
                var data = new FormData($("#myForm1")[0]);
               // var data = $('#myForm1').serialize();
                //validate form
                var itemName = $('input[name=txtItemName]');
                var price = $('input[name=txtPriceName]');
                var category1 = $(this).parent().parent().find('.category1');
                var fileupload1 = $(this).parent().parent().find('.fileupload');

               // var Img = $('input[name=Itempic]');
               // console.log(Img); exit;
               // console.log(itemName.val());
                var result = '';
                if(itemName.val()==''){
                        itemName.parent().addClass('has-error');
                        $('#alertmsg11').html('');
                        $('#alertmsg11').append("Item name should not be blank!");
                }else{
                        itemName.parent().removeClass('has-error');
                        $('#alertmsg11').html('');
                        result +='1';
                }
                
                if(category1.val()=='0'){
                       category1.parent().addClass('has-error');
                       $('#alertmsg22').html('');
                       $('#alertmsg22').append("Please Select Category!");
                }else{
                        category1.parent().removeClass('has-error');
                        $('#alertmsg22').html('');
                        result +='1';
                }

                if(price.val()=='' || price.val() < 0 ){
                        price.parent().addClass('has-error');
                        $('#alertmsg33').html('');
                        $('#alertmsg33').append("Price Alert!");
                        if(price.val() < 0){
                            $(".pricealert").show();
                        }
                       
                }else{

                        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
                        var str = price.val();
                        if(numberRegex.test(str)) {
                            if(str > 0){
                             $(".pricealert").hide();
                             $('#alertmsg33').html('');
                            }
                            price.parent().removeClass('has-error');
                            $('#alertmsg33').html('');
                            result +='2';
                       }
                       else{
                            price.parent().addClass('has-error');
                            $('#alertmsg33').html('');
                            bootbox.alert({
                                                message: "Please Enter Numeric Value!",
                                                callback: function () {
                                               // location.href = '<?php //echo base_url() ?>mealcreation';
                                                }
                                            });
                       }



                }

             /*   if(fileupload1.val()==''){
                       fileupload1.parent().addClass('has-error');
                       $("#filediv").show();
                }else{
                        fileupload1.parent().removeClass('has-error');
                         $("#filediv").hide();
                        result +='1';
                } */
                    
                if(result=='112'){
               
                        $.ajax({
                                type: 'POST',
                                //method: 'post',
                                url: url,
                                processData:false,
                                contentType: false,
                                data:  data,
                                //contentType: false,
                                //cache:false,
                                //async:false,
                                //processData:false,
                                dataType: 'json',
                                success: function(response){
                                        if(response.success){
                                                $('#myModal1').modal('hide');
                                                $('#myForm1')[0].reset();
                                                if(response.type=='add'){
                                                        var type = 'added'
                                                }else if(response.type=='update'){
                                                        var type ="updated"
                                                }
                                                $('#itemaddedDiv.alert-success').html('Item '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
                                                 showAllItems();
                                        }else{
                                                if(response.type=='filenotsupported')
                                                {
                                                     bootbox.alert({
                                                    message: "Sorry PNG files are allowed.",
                                                    callback: function () {
                                                           // location.href = '<?php //echo base_url() ?>menuitemsel';
                                                        }
                                                    });    
                                                }
                                                else if(response.type=='filealreadyexists')
                                                {
                                                    bootbox.alert({
                                                    message: "Sorry, file already exists.",
                                                    callback: function () {
                                                           // location.href = '<?php //echo base_url() ?>menuitemsel';
                                                        }
                                                    });    
                                                }
                                                else if(response.type=='largefile')
                                                {
                                                    bootbox.alert({
                                                    message: "Sorry, your file is too large.",
                                                    callback: function () {
                                                           // location.href = '<?php //echo base_url() ?>menuitemsel';
                                                        }
                                                    });    
                                                }
                                                else if(response.type=='filenotuploaded')
                                                {
                                                    bootbox.alert({
                                                    message: "Sorry, your file was not uploaded.",
                                                    callback: function () {
                                                           // location.href = '<?php //echo base_url() ?>menuitemsel';
                                                        }
                                                    });    
                                                }
                                                else if(response.type=='uploadfileerror')
                                                {
                                                    bootbox.alert({
                                                    message: "Sorry, there was an error uploading your file.",
                                                    callback: function () {
                                                           // location.href = '<?php //echo base_url() ?>menuitemsel';
                                                        }
                                                    });    
                                                }
                                        }
                                },
                                error: function(){
                                        alert('Could not add data');
                                }
                        });
                }
        });

                //meal-item mapping
        $('#btnSave').click(function(){
                    
                    var arr1 = [];
                    var url = $('#myForm').attr('action');
                    var data = $('#myForm').serialize();
                    var result = '';
                    var flag = false;
                    $('#modalitemtab.table [type="checkbox"]').each(function(i, chk) {
                       if (chk.checked) {
                          arr1.push($(this).val());
                       }
                    });
                        
                    $('#modalitemtab.table [type="checkbox"]').each(function(i, chk) {
                       if (chk.checked) {
                           result = '12';
                           flag = true;
                           return false;
                       }
                       else{
                           flag = false;
                       }
                    });
                         
                    if(!flag)
                    {
                        bootbox.alert({
                        message: "Please select atleast one item!!",
                        callback: function () {
                               // location.href = '<?php //echo base_url() ?>menuitemsel';
                            }
                        });
                    }
                        
                    if(result=='12'){
                    
                        var ItemArry = {'mealID': $('#hiddenmenuid').val(), 'locid': $('#hiddenlocid').val(), 'items': arr1};
                            $('#myModal').modal('hide');
                            $.ajax({
                                    type: 'POST',
                                    method: 'post',
                                    url: url,
                                    data: {ItemArry:ItemArry},
                                    dataType: 'json',
                                    success: function(data){
                                                if (data)
                                                {
                                                    bootbox.alert({
                                                        message: "Data Saved Successfully!",
                                                        callback: function () {
                                                        location.href = '<?php echo base_url() ?>mealcreation';
                                                        }
                                                    });
                                                }
                                                else
                                                {
                                                    bootbox.alert({
                                                        message: "Could not add data!",
                                                        callback: function () {
                                                            //location.href = '<?php //echo base_url() ?>menuitemsel';
                                                        }
                                                    });
                                                }
                                            

                                    },
                                    error: function(){
                                                        bootbox.alert({
                                                        message: "Could not add data!",
                                                        callback: function () {
                                                            //location.href = '<?php //echo base_url() ?>menuitemsel';
                                                            }
                                                        });
                                    }
                            });
                    }
        });

        //edit
        $('#showdata').on('click', '.item-edit', function(){
                       
                        var mealname = $(this).parent().parent().find('td.mealname').text();
                        var mealID = $(this).parent().parent().find('input.mealID').val();
                        $('#hiddenmenuid').val(mealID);
                       // console.log(mealID);
                        var id = $(this).attr('data');
                        showAllItems();
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text(mealname);
            $('#myForm').attr('action', '<?php echo base_url() ?>mealcreation/mealitemInst');
                });

        //delete- 
        $('#showdata').on('click', '.item-delete', function(){
            var id = $(this).attr('data');
            $('#deleteModal').modal('show');
            $('#btnDelete').unbind().click(function(){
                $.ajax({
                    type: 'POST',
                    method: 'get',
                    url: '<?php echo base_url() ?>mealcreation/delete',
                    data:{id:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#deleteModal').modal('hide');
                                                        $('#mtabl.alert-success').html('Meal Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
                            showAllMeal();
                        }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('Error deleting');
                    }
                });
            });
        });



        //function
        function showAllMeal(){
            $.ajax({
                type: 'ajax',
                url: '<?php echo base_url() ?>mealcreation/showallmeal',
                dataType: 'json',
                success: function(data){
                                        $('#showdata').html('');
                    var html = '';
                    var i;
                                        var sr = 1;
                                        var status = "";
                                         var htmmll='';
                    for(i=0; i<data.length; i++){

                        if(data[i].status == 1)
                        {
                          
                            
                            htmmll ="<select id='meal_status'><option value= '1' selected>Active</option><option  value= '0'>InActive</option></select>";
                        }
                        else{
                              
                                htmmll ="<select id='meal_status'><option  value= '1' >Active</option><option value= '0' selected>InActive</option></select>";
                        }
                       
                    
                        html +='<tr class="gradeA odd" role="row">'+
                                                            '<td>'+(sr++)+'<input type="hidden" class="mealID" value="'+data[i].id+'"/></td>'+
                                                            '<td class="mealname">'+data[i].meal_name+'</td>'+
                                                            '<td>'+data[i].items+'</td>'+
                                                            '<td>'+data[i].price+'</td>'+
                                            '<td class="td_class">'+htmmll+'</td>'+
                                                            '<td><a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'">Assign Items</a></td>'+
                                                            '<td><a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a></td>';
                            '</tr>';
                    }
                                        
                                        $('#hiddenlocid').val(data[0].locid);
                                        $('#showdata').html(html);
                                        $('#dataTables-example').DataTable( {
                                            "scrollY":        "200px",
                                            "scrollCollapse": true,
                                            "paging":         false,
                                            "retrieve": true,
                                        } );  
                                        function setHeight() {
                                            windowHeight = $('#page-wrapper').height();
                                            //alert(windowHeight);
                                            $('.sidebar').css('min-height', windowHeight);
                                            };
                                            setHeight();

                                            $(window).resize(function() {
                                            setHeight();
                                    });
                                },
                error: function(){
                    alert('Could not get Data from Database');
                }
            });
        }
         



// alert("gfhjk");
 $(document).on('change','#meal_status',function(){

      var statusValue = $(this).val();
      var MealId = $(this).parent().parent().find('input.mealID').val();
    
       $.ajax({
         type: 'POST',
         url: '<?php echo base_url() ?>mealcreation/updateStatus',
         data: { mealid: MealId ,statusValue:statusValue },
         dataType: 'json',
         success: function(data){              
              
                 if (data)
                 {
                     bootbox.alert({
                                     message: "Meal Status Successfully Updated!"
                                    });
                                }
                                else
                                {
                                    bootbox.alert({
                                        message: "Could not update Status!"
                                        
                                    });
                                }
          },
                error: function(){
                    alert('Could not get Data from Database');
                }
    });
        
 })




                //function
        function showAllItems(){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>mealcreation/showAllItems',
                data: { mealid: $('#hiddenmenuid').val()},
                dataType: 'json',
                success: function(data){
                                    
                    $('#showdata1').html("");
                    var html = '';
                    var i,j;
                                        var sr = 1;
                    for(i=0; i<data['dataItem'].length; i++)
                                        {
                                            let checked1="";
                                            for(j=0; j<data['checkData'].length; j++)
                                            {
                                                if(data['dataItem'][i].id === data['checkData'][j].item_id)
                                                {
                                                     checked1="checked";
                                                }
                                            }
                        html +='<tr class="gradeA odd" role="row">'+
                                                            '<td>'+(sr++)+'</td>'+
                                                            '<td class="mealname">'+data['dataItem'][i].item_name+'</td>'+
                                                            '<td class="mealname"><b>$'+data['dataItem'][i].price+'</b></td>';
                                                html +='<td class="text-center"><div class="option-group field smart-forms"><label class="option block"><input type="checkbox" name="itemCheckBox[]" class="itemCheckBox" value="'+data['dataItem'][i].id+'" '+checked1+'><span class="checkbox"></span></label></div></td>'+
                                                        '</tr>';
                    }
                    $('#showdata1').html(html);
                                        $('#modalitemtab').DataTable( {
                                            "scrollY":        "200px",
                                            "scrollCollapse": true,
                                            "paging":         false,
                                            "retrieve": true,
                                        } );
                                      
                                },
                error: function(){
                    //alert('Could not get Data from Database');
                }
            });
        }
                
                
          
    });
</script>



<?php

$this->load->view('Footer/footer');
?>