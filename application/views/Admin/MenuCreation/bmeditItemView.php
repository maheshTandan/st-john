
 <?php include('application/views/services/service.php');
    //print_r($dataItem);
 ?>


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
                            <form enctype="multipart/form-data" class="" name="menu_insert" method="post" action="<?php echo base_url()?>bmiteminst/edit/<?php echo $dataItem[0]['id']; ?>">
                                <div class="row">


                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Item</label>
                                            <input class="form-control" id='item_name' name='item_name' placeholder="Enter text" value="<?php echo $dataItem[0]['item_name']; ?>">
                                            <input type="hidden" value="<?php echo $dataItem[0]['item_name']; ?>" id="inital_item_name" />
                                            <p class="itemalert" style="color: red; display:none; "><b>Already Exist!</b></p>
                                            <p class="itemalert1" style="color: green; display:none; "><b>Available</b></p>
                                            <input type="hidden" value="1" id="itemalerthidden" />
                                            <div id="alertmsg1" style="color:red;"></div>
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label for="item_alias">Item Alias<span class="asteriskField">
                                                        *
                                                    </span></label>
                                            <input class="form-control" name='item_alias' id="item_alias" value="<?php echo $dataItem[0]['item_alias']; ?>" placeholder="Enter text">
                                            <input type="hidden" value="<?php echo $dataItem[0]['item_alias']; ?>" id="inital_alias_name" />
                                            <p class="itemalertalias" style="color: red; display:none; "><b>Already Exist!</b></p>
                                            <p class="itemalertalias1" style="color: green; display:none; "><b>Available</b></p>
                                            <input type="hidden" value="1" id="itemalertaliashidden" />
                                            <div id="alertalertmsg1" style="color:red;"></div>
                                        </div>
                                       
                                    </div>

                                     <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Category</label>
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
                                            <div id="alertmsg2" style="color:red;"></div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" class="form-control" id="price_name" name='price_name' placeholder="Enter text" value="<?php echo $dataItem[0]['price']; ?>" maxlength="10">
                                            <p class="pricealert" style="color: red; display:none; "><b>You can't enter -ve Price.</b></p>
                                            <div id="alertmsg3" style="color:red;"></div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                     </div>
                                
                                <div class="row">
                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <label>Item Picture</label>
<!--                                            <input id="uploadFile" name="uploadFileOne" type="text" disabled="disabled" placeholder="<?php //echo $dataItem[0]['Image']; ?>" class="name-info-form file-witdth" />-->
                                            <div class="productIcon "><img src="<?php echo $GLOBALS['img_url'].$dataItem[0]['Image']; ?>" alt=""></div>
                                            <input class="upload" type="file" id="fileupload" name="userfile" value="Select File" size="20" />
                                            <input type="hidden" name="hiddenfile" value="<?php echo $dataItem[0]['Image']; ?>" />
                                            
                                        </div>
                                    </div>
                                    
                                </div>

                                    <div class="col-sm-3 MT-25"><button class="btn btn-info " name="submit" type="submit">
                                            Update     
                                        </button> <?php if($flag==1){ ?><span class="has-success"><label class="control-label">Menu inserted</label></span><?php } ?> 
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        
        if($.trim($("#price_name").val())> 0)
        {
            $(".pricealert").hide();
            $("#price_name").parent().removeClass('has-error');
            $('#alertmsg3').html('');
        }
       /* 
        if($.trim($("#itemalerthidden").val())=="" || $.trim($("#itemalerthidden").val())=='0')
        {
             $("#item_name").parent().addClass('has-error');
             $('#alertmsg1').html('');
             $('#alertmsg1').append("Please Check Item name!");
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
        } */
      //  if($.trim($("#item_name").val()) != $.trim($("#inital_item_name").val()))
      //  {
      //      alert("equal nahi hain");
      //  }
        //alert($.trim($("#inital_item_name").val()) +" "+ $.trim($("#item_name").val())); return false;
        if($.trim($("#item_name").val()) != $.trim($("#inital_item_name").val()) || ($.trim($("#item_name").val())==""))
        {
            if($.trim($("#item_name").val())=="" || ($.trim($("#itemalerthidden").val())=="" || $.trim($("#itemalerthidden").val())=='0'))
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
        }
        
        // alert($.trim($("#item_alias").val())); 
        // alert($.trim($("#inital_alias_name").val()));
//         if($.trim($("#inital_alias_name").val())=="")
//        {
//          alert("blank hain");
//        }else{
//            alert('chal nahi raha');
//        }
         
        
        if($.trim($("#inital_alias_name").val()) == '' || ($.trim($("#item_alias").val()) != $.trim($("#inital_alias_name").val())))
        {   //alert("AA"); 
            if(($.trim($("#itemalertaliashidden").val())=="" || $.trim($("#itemalertaliashidden").val())=='0') || $.trim($("#item_alias").val())=="")
            {
                //alert("ahhhahahah");
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
           
          //return false;  
    });
      
    $('#btnSave1').click(function () {
           
            $("form").submit();
          
            
         });
      
  });
</script>





<?php

$this->load->view('Footer/footer');
?>