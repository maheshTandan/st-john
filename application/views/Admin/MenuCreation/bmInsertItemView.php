
  <?php include('application/views/services/service.php') ?>

  <script type="text/javascript">
    
    $(document).ready(function() {
    $('#dataTables-example').DataTable();
} );
</script>      

<style>
    .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso 
/*    form{font-family: Arial, Helvetica, sans-serif; color: black}*/
    .bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} 
    .asteriskField{color: red;}
    .MT-50{margin-top: 50px}    
    .MT-25{margin-top: 25px}
</style>


<div id="page-wrapper" style="min-height: 327px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Item Insertion</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <?php echo form_open_multipart('bmiteminst/saveitemdata');?>
<!--                            <form enctype="multipart/form-data" accept-charset="utf-8" class="" name="item_insert" id="item_insert" method="post" action="<?php //echo base_url(); ?>bmiteminst/saveitemdata">-->
                                <div class="row">


                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label for="item_name">Item<span class="asteriskField">
                                                        *
                                                    </span></label>
                                            <input class="form-control" name='item_name' id="item_name" placeholder="Enter text">
                                            <p class="itemalert" style="color: red; display:none; "><b>Already Exist!</b></p>
                                            <p class="itemalert1" style="color: green; display:none; "><b>Available</b></p>
                                            <input type="hidden" value="" id="itemalerthidden" />
                                            <div id="alertmsg1" style="color:red;"></div>
                                        </div>
                                       
                                    </div>
                                    
                                     <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label for="item_alias">Item Alias<span class="asteriskField">
                                                        *
                                                    </span></label>
                                            <input class="form-control" name='item_alias' id="item_alias" placeholder="Enter text">
                                            <p class="itemalertalias" style="color: red; display:none; "><b>Already Exist!</b></p>
                                            <p class="itemalertalias1" style="color: green; display:none; "><b>Available</b></p>
                                            <input type="hidden" value="" id="itemalertaliashidden" />
                                            <div id="alertalertmsg1" style="color:red;"></div>
                                        </div>
                                       
                                    </div>
                                    
                                     <div class="col-md-3 col-lg-3">
                                                <label for="category" class="control-label">Category<span class="asteriskField">
                                                        *
                                                    </span></label>
                                                <select class="form-control" id ="category" name="category">
                                                   <option value="0" selected>--Select--</option>
                                                    <?php for ($i = 0; $i < count($category); $i++) { ?>
                                                        <option value="<?php echo $category[$i]['id']; ?>"><?php echo $category[$i]['category_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div id="alertmsg2" style="color:red;"></div>
                                            </div>


                                    <div class="col-sm-3" >
                                        <div class="form-group ">
                                            <label for="price_name">Price<span class="asteriskField">
                                                        *
                                                    </span></label>
                                            <input type="number" class="form-control" name='price_name' id="price_name" placeholder="Enter price" maxlength="10" min="0">
                                            <p class="pricealert" style="color: red; display:none; "><b>You can't enter -ve Price.</b></p>
                                            <div id="alertmsg3" style="color:red;"></div>
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-3" >
                                        <div class="form-group ">
                                            <label for="price_name">Item Picture<span class="asteriskField">
                                                        *
                                                    </span></label>
                                          
                                           <input type="file" id="fileupload" name="userfile" size="20" />
                                           <?php if(isset($error)){ echo "<p><b>".$error."</b></p>"; }?>
                                        </div>
                                    </div>

<!--                                    <div class="col-sm-3 MT-25"><button class="btn btn-primary btn-submit " name="submit" type="submit" id="btnSave1">
                                            Insert     
                                        </button> <?php if($flag==1){ ?><span class="has-success"><label class="control-label">Menu inserted</label></span><?php } ?> 
                                    </div>-->
                                    
                                   
                                    <div class="col-sm-3 MT-25 ">
                                        <input type="submit" name="submit" value="Save Item" id="btnSave1" class="btn btn-primary btn-submit" />
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
                    Item List
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
                                            <th>Item</th>
                                             <th>Category</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                    </thead>
                                    <tbody>
                                            <?php 
                                                $srnum=1;
                                                foreach ($dataItem as $value) {
                                                    ?>
                                        <tr class="gradeA odd" role="row">
                                            <td class="sorting_1"><?php echo $srnum++; ?></td>
                                            <td class="sorting_1"> <?php echo $value['item_name']; ?></td>
                                             <td class="sorting_1"> <?php echo $value['category_name']; ?></td>
                                               <td ><?php echo "$ ".$value['price']; ?></td>
                                            <td class="edit tooltip-display" style="background-color:">
                                                 <span data-toggle="tooltip" data-placement="bottom" title="" style="text-align:center!important;" data-original-title="Edit Location">
                                                 <a href="<?php  echo base_url(); ?>bmiteminst/edit/<?php echo $value['id']; ?>">
                                                     <button class="btn btn-xs btn-warning btn-style">
                                                     <i class="fa fa-pencil" data-original-title="" title=""></i>
                                                     </button>
                                                 </a>
                                                 </span> 
                                                <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Location">
                                                    <a href="<?php echo base_url();?>bmiteminst/delete/<?php echo $value['id']; ?>">
                                                        <button class="btn btn-xs btn-danger btn-style"><span class="fa fa-trash" data-original-title="" title=""></span></button>
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


<script type="text/javascript">
  $(document).ready(function () {
      
      
    $('#item_name').keyup(function(){
        //alert($.trim($(this).val()).length);
                    if($.trim($(this).val()).length > 0){
                       //$(this).parent().removeClass('has-error');
                       var itemName = $.trim($(this).val());
                       //console.log(itemName);
                        $('#alertmsg1').html('');
                       $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url(); ?>bmiteminst/ajaxcheckitem',
                                data:  {itemName: itemName},
                                dataType: 'json',
                                success: function(data){
                                        //console.log(data);
                                        $('#itemalerthidden').val(data);
                                        if(data == 1)
                                        {
                                            console.log(data);
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
      
     $('#item_alias').keyup(function(){
        //alert($.trim($(this).val()).length);
                    if($.trim($(this).val()).length > 0){
                       //$(this).parent().removeClass('has-error');
                       var itemName = $.trim($(this).val());
                       //console.log(itemName);
                        $('#alertalertmsg1').html('');
                       $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url(); ?>bmiteminst/ajaxcheckitemalias',
                                data:  {itemName: itemName},
                                dataType: 'json',
                                success: function(data){
                                        //console.log(data);
                                        $('#itemalertaliashidden').val(data);
                                        if(data == 1)
                                        {
                                            console.log(data);
                                            $('.itemalertalias').hide();
                                            $('.itemalertalias1').show();
                                        }
                                        else
                                        {
                                            $('.itemalertalias1').hide();
                                            $('.itemalertalias').show();
                                        }
                                },
                                error: function(){

                                }
                        });
                    }
                    else{
                                $('.itemalertalias').hide();
                                $('.itemalertalias1').hide();
                                $('#itemalertaliashidden').val('');
                    }

            });
     
    $("form").submit(function(){
        
        //return false;
        if($.trim($("#price_name").val())> 0)
        {
            $(".pricealert").hide();
            $("#price_name").parent().removeClass('has-error');
            $('#alertmsg3').html('');
        }
        
      /*
        if($.trim($("#itemalerthidden").val())=="" || $.trim($("#itemalerthidden").val())=='0' || $.trim($("#item_name").val())=="")
        {
             $("#item_name").parent().addClass('has-error');
             $('#alertmsg1').html('');
             if($.trim($("#item_name").val())==""){
             $('#alertmsg1').append("Item name should not be blank!");}
             return false;
        }
        else
        {
            $("#item_name").parent().removeClass('has-error');
            $('#alertmsg1').html('');
        }
        
        if($.trim($("#itemalertaliashidden").val())=="" || $.trim($("#itemalertaliashidden").val())=='0')
        {
             $("#item_alias").parent().addClass('has-error');
             $('#alertalertmsg1').html('');
             $('#alertalertmsg1').append("Alias name should not be blank!");
             return false;
        }
        else
        {
            $("#item_alias").parent().removeClass('has-error');
            $('#alertalertmsg1').html('');
        }  */
        
            if($.trim($("#itemalerthidden").val())=="" || $.trim($("#itemalerthidden").val())=='0' || $.trim($("#item_name").val())=="")
            {
                 $("#item_name").parent().addClass('has-error');
                 $('#alertmsg1').html('');
                 if($.trim($("#item_name").val())==""){
                 $('#alertmsg1').append("Item name should not be blank!"); }
                 return false;
            }
            else
            {
                $("#item_name").parent().removeClass('has-error');
                $('#alertmsg1').html('');
            }
            
            if($.trim($("#itemalertaliashidden").val())=="" || $.trim($("#itemalertaliashidden").val())=='0' || $.trim($("#item_alias").val())=="")
            {
                 $("#item_alias").parent().addClass('has-error');
                 $('#alertalertmsg1').html('');
                 if($.trim($("#item_alias").val())==""){
                 $('#alertalertmsg1').append("Alias name should not be blank!"); }
                 return false;
            }
            else
            {
                $("#item_alias").parent().removeClass('has-error');
                $('#alertalertmsg1').html('');
            }
            
            if($.trim($("#category").val())=="0")
            {
                $("#item_name").parent().removeClass('has-error');
                $("#category").parent().addClass('has-error');
                $('#alertmsg2').html('');
                $('#alertmsg2').append("Please Select Category!");
                 return false;
            }
            else if($.trim($("#price_name").val())=="" || $.trim($("#price_name").val()) < 0 )
            {
                 if($.trim($("#price_name").val()) < 0){
                            $(".pricealert").show();
                        }
                $("#item_name").parent().removeClass('has-error');
                $('#alertmsg').html('');
                $("#category").parent().removeClass('has-error');
                $('#alertmsg2').html('');
                $("#price_name").parent().addClass('has-error');
                $('#alertmsg3').html('');
                $('#alertmsg3').append("Price Alert!");
                 return false;
            }
            else if($.trim($("#fileupload").val())=="")
            {
                $("#item_name").parent().removeClass('has-error');
                $("#category").parent().removeClass('has-error');
                $("#price_name").parent().removeClass('has-error');
                 $('#alertmsg1').html('');
                 $('#alertmsg2').html('');
                 $('#alertmsg3').html('');
                 return true;
            }
            else{
                $("#item_name").parent().removeClass('has-error');
                $("#category").parent().removeClass('has-error');
                $("#price_name").parent().removeClass('has-error');
                $('#alertmsg1').html('');
                $('#alertmsg2').html('');
                $('#alertmsg3').html('');
                return true;
            }
           
           
    });
      
    $('#btnSave1').click(function () {
           
           //return false;
        //alert("DD");  
        $("form").submit();
          
            
         });
      
  });
</script>













<?php
$this->load->view('Footer/footer');
?>