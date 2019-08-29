<?php include('application/views/services/service.php');

//print_r($mealData);
?>

<style>
    .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso 
    
    .bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} 
    .asteriskField{color: red;}
    .MT-50{margin-top: 50px}
    .formInline {display:inline-block;}
</style>


<div id="page-wrapper" style="min-height: 327px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Menu Item Selection</h1>
        </div>
    </div>
    <?php //echo $date;  ?>
    <div class="row card card-transparent">
        <div class="col-lg-12 container-fluid   container-fixed-lg ">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <form class="form-horizontal" method="post" action="">
                                <?php if(!empty($checkData))
                                { ?>
                                    <div class="row" id="dynamicChildItem"> 
                                    </div>
                          <?php } 
                                else
                                { ?>
                                 
                                    <?php 
                                        for ($i = 0; $i < count($dataMenu); $i++) 
                                        { ?>
<!--                                            <div class="col-xs-12 text-center"><hr><h2>Items</h2><hr></div>
                                            <div class="row">-->
                                            <?php  for ($j = 0; $j < count($dataItemCategory); $j++) 
                                            { ?>
                                               
                                                    <div class="col-lg-6 col-xl-4 m-b-10 hidden-xlg dynamicMenu">
                                                        <div class="widget-11-2 card no-border card-condensed no-margin widget-loader-circle full-height d-flex flex-column">
                                                            <div class="padding-25">
                                                                <div class="pull-left">
                                                                    <h2 name='categoryList[]' class="text-success categoryList no-margin"><?php echo $dataItemCategory[$j]['category_name']; ?></h2>
                                                                    <input type='hidden' class='categoryListIDHidden' value='<?php echo $dataItemCategory[$j]['id']; ?>'/>
                                                                    <input type='hidden' class='mealListIDHidden' value='0'/>
                                                                    <p name='menuList[]' class="no-margin menuList"><?php //echo $dataMenu[$i]['menu_name']; ?></p>
                                                                    <input type='hidden' class='menuIDHidden' value='<?php echo $dataMenu[$i]['id']; ?>'/>
                                                                  
                                                                </div>
                                                                <h5 class="pull-right semi-bold">
                                                                    <small class="semi-bold">Item count</small>
                                                                    43
                                                                </h5>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="auto-overflow widget-11-2-table dynamicMeal">
                                                           <table class="table table-condensed table-hover">
                                                               <tbody>
                                                       <?php for($k = 0; $k < count($dataItem); $k++)
                                                       { ?>
                                                                          <tr>
                                                                       <td class="b-r b-dashed b-grey" style="width: 20%">
                                                                           <div class="option-group field checkbox check-success  smart-forms dynamicItem">
                                                                                <label class="option block">
                                                                               <input type="checkbox" name="itemCheckBox[]" class="itemCheckBox" value="<?php echo $dataItem[$k]['id']; ?>"/><span class="checkbox"></span>
                                                                               </label>
                                                                           </div>
                                                                       </td>
                                                                       <td class="font-montserrat all-caps fs-12 " style="width: 80%"><?php echo $dataItem[$k]["item_name"]; ?></td>
                                                                   </tr>

                                                                 
                                                                  

                                                         <?php } ?>
                                                                </tbody>
                                                           </table>
                                                       </div>
                                                        </div>
                                                    </div>   
                                             
                                      <?php }?> 

                                                 </div>                    
                                    <?php } 
                                    
                                    ?>
                        <?php  } ?>

                            <div class="row">
                                <div class=" ">
                                    <input type="button" name="submit" value="Add/Update Selection" id="btnSave1" class="btn btn-primary btn-submit" />

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






<script type="text/javascript">
    $(document).ready(function () {
        
        displayDynamicMenuItem();
        
        $('div.dynamicMenuItem').each(function (index, value) {
            var this_old = $(this);
            this_old.find('.itemCheckBox').each(function (index, value) {
                if ($(this).is(":checked")) {
                    $(this).parent().parent().find('span.priceTag').addClass('td_class');
                } else {
                }
            });
        });
        
        $('#btnSave1').click(function () {
            var ItemArray = [];
            
           // alert($('div.dynamicMenu').length);
            //console.log($('div.dynamicMenu').length); exit;
            var date = $("#date").val();
            var grade = $("#grade").val();
            var interval = $("#interval").val();
            
            if(interval == 0)
            {
                $("#interval").parent().addClass('has-error');
                if(grade == 0)
                {
                    $("#grade").parent().addClass('has-error');
                    //return false;
                }
                else
                {
                    $("#grade").parent().removeClass('has-error');
                }
                return false;
            }
            
            if(grade == 0)
            {
               $("#grade").parent().addClass('has-error');
                if(interval == 0)
                {
                    $("#interval").parent().addClass('has-error');
                    //return false;
                }
                else
                {
                      $("#interval").parent().removeClass('has-error');
                }
                return false;
            }
            
            if(interval != 0 && grade != 0)
            {
                 $("#interval").parent().removeClass('has-error');
                 $("#grade").parent().removeClass('has-error');
            }
            
           
            
            
            
            $('div.dynamicMenu').each(function (index, value) {
                //var ArrayOuter = [];
                var this_old = $(this);
                menuID = this_old.find('.menuIDHidden').val();
                //console.log(menuID+"<--MENUID-->"+index); 
                var ItemArry1 = [];
                this_old.find('div.dynamicMeal').each(function (index, value) {
                $(this).addClass("PPP");
                var this_old1 = $(this);
                var catagoryID = $(this).parent().find('input.categoryListIDHidden').val();
                var mealID = $(this).parent().find('input.mealListIDHidden').val();
                var arr1 = [];
               // var priceArr = [];
                this_old1.find('.dynamicItem').each(function(index, value){
                   $(this).addClass("PANDEYYY");
                   var this_old2=$(this);
                   if ( $(this).find('.itemCheckBox').is(":checked")) {

                      arr1.push(this_old2.find('.itemCheckBox').val());
                    } else {}
                });
               // console.log("ARR1-->"+arr1); exit;

                if (arr1.length > 0)
                {
                    ItemArry1.push({
                        arr1, catagoryID, mealID
                    });
                }
                   
                });
               // console.log(ItemArry1); exit;
                  if (ItemArry1.length > 0)
                    {
                        ItemArray.push({
                            ItemArry1, menuID
                        });
                    }
               

            });    //console.log(ItemArray); exit;
           
            //console.log(grade); exit;
            //   $("#date").val();
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() ?>adminmenuitemsel/insertmenuitemdata',
                //async: true,
                data: {ItemArray: ItemArray},
                dataType: 'json',
                success: function (data) {
                   // alert(data);
                    if (data.success)
                    {
                        bootbox.alert({
                            message: "Data Saved Successfully!",
                            callback: function () {
                                location.href = '<?php echo base_url() ?>adminmenuitemsel';
                            }
                        })
                    }
                    else
                    {
                        bootbox.alert({
                            message: "Same Data Already Exit!",
                            callback: function () {
                                //location.href = '<?php //echo base_url() ?>menuitemsel';
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

        $(document).on('dblclick','.td_class',Edit)

        $(document).on('change','.itemCheckBox',function(){
        
            val=$.trim($(this).parent().parent().find('.priceTag').text());
            val = val.replace("($", "");
            val = val.replace(")", "");
           // var parent_span =  $(this).parent();
           // console.log(val);
            if($(this).is(':checked'))
            {
                $(this).parent().parent().find('.priceTag').addClass('td_class');
            }
            else
            {
                $(this).parent().parent().find('.priceTag').removeClass('td_class');
                
                //var parent_span = $(this).parent().parent().find('.priceTag');
                //parent_span.children().remove();
               //parent_span.addClass("DDIIVVEESSH");
               // $(this).parent().parent().find('.priceTag').remove();
               //parent_span.append('($'+val+')');
            }

        });

        function Edit(){
            var price = $(this).attr('data-price');
            var span_this = $(this).html("<input  type='text' size='2px' class ='td1' value='"+$.trim(price)+"'/>");
            $('.td1').focus();
            
            span_this.children().on({
                focus: function(){
                  // span_this.attr('autofocus');
                },
                blur: function() {
                    var val = span_this.children().val();
                    span_this.attr('data-price', val);
                    span_this.children().remove();
                    //input_this.remove();
                    span_this.append('($'+val+')');
                }
            });
        };
        
        $(document).on('keyup','.td1',function(event) {
                if(event.keyCode == 13) 
                {

                   val=$.trim($(this).val()).replace(/\,/g,"");
                   str=isNaN(val);
                   if(str==true)
                   {
                    alert("Please Enter Numeric Value");
                    return false;
                   }
                    var parent_span =  $(this).parent();
                    $(this).remove();
                    parent_span.append('($'+val+')');
                }
            });  
            
        itemsDisabling();
        
         $(document).on('change', '#grade', function(){
             displayDynamicMenuItem();
         });
        
        
        function itemsDisabling()
        {
               $.ajax({
                type: 'post',
                url: '<?php echo base_url() ?>menuitemsel/ajaxitemsdisabling',
                //async: true,
                data: {pq:'9'},
                dataType: 'json',
                success: function (data) {
                    //alert(data);
                  //alert(data);
                  //console.log( $('.dynamicMenuItem').length);
                    var i;
                    for(i=0; i<data.length; i++)
                    {
                        $( ".dynamicMenuItem" ).each(function(index) {
                            this_old = $(this);
                            var menu_id = $(this).find('input.menuIDHidden').val();
                            if(menu_id == data[i].menu_id)
                            {
                               var input_this =  $(this_old).find('input.itemCheckBox');
                                
                                $(input_this).each(function(index) {
                                    
                                    //console.log($(this).val());
                                    if($(this).val() == data[i].item_id)
                                    {
                                        //  console.log($(this).val());
                                          $(this).attr("disabled", true);
                                          $(this).parent().parent().find('span.priceTag').removeClass('td_class');
                                    }
                                    
                                });
                               // console.log( index + " MenuID: "+ menu_id + " MENUID OUTERLOOD AJAX:"+ data[i].menu_id + "ITEM ID:"+ data[i].item_id);
                                return false; 
                            }
                       }); 
                    }
                },
                error: function () {
                }
            });
        }     
        
        
        function displayDynamicMenuItem()
        {
            $.ajax({
                type: "post",
                url: '<?php echo base_url(); ?>adminmenuitemsel/displaydynamicmenuitem',
                data: {},
                dataType: 'json',
                success:function(data){
                                //console.log("HI DIVESH");
                                $("#dynamicChildItem").html("");
                                var i,j,jj,kk,l,p;
                                var html = '';
                                
                                for (i = 0; i < data['datamenu'].length; i++)
                                {
                                   
                                    html+='<div class="row">';
                                    for(jj=0; jj< data['ItemCategory'].length;jj++)
                                    {
                                               
                                        html+='<div class="col-lg-6 col-xl-4 m-b-10 hidden-xlg dynamicMenu">';
                                        html+='<div class="widget-11-2 card no-border card-condensed no-margin widget-loader-circle full-height d-flex flex-column">'
                                        html+='<div class="padding-25">';
                                        html+='<div class="pull-left">';
                                        html+='<h2 name="categoryList[]" class="text-success categoryList no-margin">'+data["ItemCategory"][jj].category_name+'</h2>';
                                        html+='<input type="hidden" class="categoryListIDHidden" value="'+data["ItemCategory"][jj].id+'"/>';
                                        html+='<input type="hidden" class="mealListIDHidden" value="0"/>';
                                        html+='<p name="menuList[]" class="no-margin menuList"></p>';
                                        html+='<input type="hidden" class="menuIDHidden" value="'+data['datamenu'][i]['id']+'"/>';
                                        html+='</div>';
                                        html+='<h5 class="pull-right semi-bold">';
                                        html+='<small class="semi-bold">Item count: </small>';
                                        html+='43';
                                        html+='</h5>';
                                        html+='<div class="clearfix"></div>';
                                        html+='</div>';
                                        html+='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                                        html+='<table class="table table-condensed table-hover">';
                                        html+='<tbody>';
                                        for(kk=0; kk< data['dataItem'].length; kk++)
                                        {
                                            let checked="";
                                            for(j=0;j< data['checkData'].length;j++)
                                            {
                                            // console.log(data['checkData'][j].item_name);
                                               let itemID = data['checkData'][j]['item_id'].split(",");
                                               //console.log(itemID);
                                               for(l=0;l< itemID.length;l++)
                                               {
                                                    if(itemID[l] == data['dataItem'][kk]['id'] && 
                                                    data['checkData'][j]['menu_id'] == data['datamenu'][i]['id']
                                                    &&  data['checkData'][j]['category_id'] == data["ItemCategory"][jj].id)
                                                    {
                                                         checked="checked";
                                                         //console.log("CHECKED");
                                                    }
                                                    //  console.log(data['checkData'][j].item_name);
                                                   
                                               }
                                              
                                          
                                            }
                                            html+='<tr>';
                                            html+='<td class="b-r b-dashed b-grey" style="width: 20%">';
                                            html+='<div class="option-group field checkbox check-success  smart-forms dynamicItem">';
                                            html+='<label class="option block">';
                                            html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox" value="'+data['dataItem'][kk]['id']+'" '+checked+'/><span class="checkbox"></span>';
                                            html+='</label>';
                                            html+='</div>';
                                            html+='</td>';
                                            html+='<td class="font-montserrat all-caps fs-12 " style="width: 80%">'+data['dataItem'][kk]['item_name']+'</td>';
                                            html+='</tr>';
                                          
                                        } 
                                        html+='</tbody>';
                                        html+='</table>';
                                        html+='</div>';
                                        html+='</div>';
                                        html+='</div>';
                                             
                                    } 
                                    html+='</div>';                   
                                } 
    
                                //console.log(html);
                                $("#dynamicChildItem").append(html);
                        }
                    }); 
        }
        
});
</script>
















