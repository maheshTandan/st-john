<?php include('application/views/services/service.php');?>
<?php 
 // print_r($checkData); die;
 ?>
<style>
    .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso 
    form{font-family: Arial, Helvetica, sans-serif; color: black}
    .bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} 
    .asteriskField{color: red;}
    .MT-50{margin-top: 50px}
</style>


<div id="page-wrapper" style="min-height: 327px;">

     
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Menu Item Selection</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
               <label>* Please Select child name</label>
          <select class="form-control childId" name="location1[]">
                                               
                                                 <?php  for ($i=0; $i<count($child);$i++) { ?>
                                                <option value="<?php  echo $child[$i]['id']; ?>"><?php  echo $child[$i]['first_name']; ?></option>
                                           
                                                 <?php  } ?>
         </select>
        </div>
    </div>
    </div>
    <?php //echo $date;  ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <form class="form-horizontal" method="post" action="">
                                <?php if(!empty($checkData))
                                { ?>
                                    <div class="row">
                                        <div class="row">
                                        <div class="col-sm-4">
                                        <div class="form-group clearfix">
                                            <label class="control-label text-left col-sm-3 requiredField" for="date">
                                                Date
                                                <span class="asteriskField">
                                                    *
                                                </span>
                                            </label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar-check-o">
                                                        </i>
                                                    </div>
                                                    <input class="form-control" id="date" name="date" value="<?php echo $date; ?>" placeholder="YYYY-MM-DD" type="text" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                        </div>


                                    <div class="row"  id = "dynamicChildItem"> 
                                        <div class="form-group col-sm-8 smart-forms">
                                            <?php

                                                for ($i = 0; $i < count($dataMenu); $i++)
                                                { ?>
                                                    <div class="dynamicMenuItem"><h4 name='menuList[]' class='menuList'><?php echo $dataMenu[$i]['menu_name']; ?></h4> <input type='hidden' class='menuIDHidden' value="<?php echo $dataMenu[$i]['id']; ?>"/><br>
                                                        <?php

                                                            for($j=0;$j< count($checkData);$j++)
                                                            { 
                                                                $checked="";
                                                               if($checkData[$j]['menu_id'] == $dataMenu[$i]['id']){
                                                              
                                                                 for($l=0;$l<count($parentSelectItem);$l++)
                                                                 {
                                                                    
                                                                    if($checkData[$j]['item_id']==$parentSelectItem[$l]['item_id'] && $parentSelectItem[$l]['menu_id'] == $dataMenu[$i]['id'])

                                                                    {
                                                                         $checked="checked";
                                                                    }
                                                                 }   
                                                                
                                                                ?>
                                                                   <div class="option-group field">
                                                                        <label class="option block">
                                                                           <input type="checkbox" name="itemCheckBox[]"  class="itemCheckBox"  value="<?php  echo $checkData[$j]['item_id']; ?>" <?php  echo $checked; ?> /> <span class="checkbox"></span><?php  echo trim($checkData[$j]['item_name']); ?> <span class= "priceTag">
                                                                            <?php  echo " ($".$checkData[$j]['price']. ")"; ?> </span>   
                                                                        </label>
                                                                    </div> 
                                                                   

                                                              <?php   } } ?>  
                                                    </div>
                                          <?php } ?>
                                        </div>
                                    </div>
                          <?php } 
                                else
                                { ?>
                                   <div class="row">
                                    <div class="row">
                                        <div class="col-sm-4">
                                        <div class="form-group clearfix">
                                            <label class="control-label text-left col-sm-3 requiredField" for="date">
                                                Date  
                                                <span class="asteriskField">
                                                    *
                                                </span>
                                            </label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar-check-o">
                                                        </i>
                                                    </div>
                                                    <input class="form-control" id="date" name="date" value="<?php echo $date; ?>" placeholder="YYYY-MM-DD" type="text" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        </div>
                                        </div>


                                    <div class="row" id="changeChild"> 
                                        <div class="form-group col-sm-8 smart-forms">
                                            <?php
                                           for ($i = 0; $i < count($dataMenu); $i++) 
                                           {
                                                ?>
                                            <div class="dynamicMenuItem"><h4 name='menuList[]' class='menuList'><?php echo $dataMenu[$i]['menu_name']; ?></h4> <input type='hidden' class='menuIDHidden' value="<?php  echo $dataMenu[$i]['id']; ?>"/>
                                                
                                                    <?php

                                                    for ($j = 0; $j < count($checkData); $j++) 
                                                    {?>
                                                        <div class="option-group field">
                                                            <label class="option block">
                                                                <input type="checkbox" name="itemCheckBox[]"  class="itemCheckBox" value="<?php  echo $checkData[$j]['id']; ?>" /><span class="checkbox"></span><?php  echo $checkData[$j]['item_name']?> <span class= "priceTag">
                                                                            <?php  echo " ($".$checkData[$j]['price']. ")"; ?> </span> 
                                                            </label>
                                                        </div>
                                              <?php } ?>    
                                            </div>
                                      <?php }
                                            ?>
                                        </div>
                                    </div>
                                
                                
                          <?php } ?>
                               <div class="row">
                                  <div class="">
                                    <input type="button" name="submit" value="Add Selection" id="btnSave1" class="btn btn-primary btn-submit" />

                                   </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript" >
    $(document).ready(function () {

        $('#btnSave1').click(function () {
         //  console.log('fhgjhjkj');
            var ItemArray = [];
             var selectedChild = $(".childId option:selected").val();

            $('div.dynamicMenuItem').each(function (index, value) {
                var this_old = $(this);
                menuID = this_old.find('.menuIDHidden').val();
              //   console.log(menuID);
                var arr1 = [];
                this_old.find('.itemCheckBox').each(function (index, value) {
                    if ($(this).is(":checked")) {
                        arr1.push($(this).val());

                    } else {
                    }
                });

                if (arr1.length > 0)
                {
                    ItemArray.push({
                        menuID, arr1
                    });
                }


            });

           // console.log(ItemArray);
            var date = $("#date").val();
          

            $.ajax({
                type: 'post',
                url: '<?php echo base_url() ?>ChildMenuItem/insertchildmenuitemdata',
                //async: true,
                data: {ItemArray: ItemArray, date: date,selectedChild: selectedChild},
                dataType: 'json',
                success: function (data) {
                    //alert(data);
                    if (data)
                    {
                        bootbox.alert({
                            message: "Data Saved Successfully!",
                            callback: function () {
                                location.href = '<?php echo base_url() ?>menusel';
                            }
                        })
                    }
                },
                error: function () {

                    bootbox.alert({
                        message: "Could not get Data from Database",
                        callback: function () {

                        }
                    })
                }
            });

            //return false;
            // $('#dataArray').val(JSON.stringify(ItemArray)); //store array

        });


// onchange Child event 

   $(document).on('change', '.childId', function(){
      
    var selectedChild = $(".childId option:selected").val();
    var date = $("#date").val();


     $.ajax({
            type: "post",
             url: '<?php echo base_url() ?>childMenuItem/showselectItem',
             data: {date: date,selectedChild: selectedChild},
             dataType: 'json',
             success:function(data){

           
               $("#dynamicChildItem").html("");
               var i,j,l;
               var html = '<div class="form-group col-sm-8 smart-forms">';
                for (i = 0; i < data['datamenu'].length; i++)
                {
           
                html+='<div class="dynamicMenuItem"><h4 name="menuList[]" class="menuList">'+data["datamenu"][i].menu_name+'</h4> <input type="hidden" class="menuIDHidden" value="'+data["datamenu"][i].id+'"/><br>';


              for(j=0;j< data['checkData'].length;j++)
              {
                    var checked="";
                    if(data['checkData'][j]['menu_id'] == data['datamenu'][i]['id'])
                    {
                          for(l=0;l<data['parentItem'].length;l++)
                          {
                            if(data['checkData'][j]['item_id']==data['parentItem'][l]['item_id'] && data['parentItem'][l]['menu_id'] == data['datamenu'][i]['id'])

                                 {
                                    checked="checked";
                                 }                                   
                          }


                          html+='<div class="option-group field"> <label class="option block"><input type="checkbox" name="itemCheckBox[]"  class="itemCheckBox"  value="'+data['checkData'][j]['item_id']+'" '+checked+'/><span class="checkbox"></span>'+data['checkData'][j]['item_name']+'<span class= "priceTag">'+'('+'$'+data['checkData'][j]['price']+')'+'</span> </label></div>'; 
                    }
              }

              html+='</div>';

                }

             html+='</div>';
       
                 $("#dynamicChildItem").append(html);
            }


        });
    
  

    });

})

</script>

<?php include('application/views/Footer/footer.php');?>
















