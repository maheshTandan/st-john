
<?php include('application/views/services/service.php');
$gradeselectall=array();
?>

<style>


.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 20%;
}
    
</style>

<div id="page-wrapper" style="min-height: 327px;">
    <div class="row">
        <div class="">
            <h1 class="page-header">Hot Lunch Calendar</h1>
        </div>
    </div>
    
    
    <?php //echo $date;  ?>
    <div class="row card card-transparent ">
        <form class="form-horizontal" method="post" action="">
                                <?php if(!empty($checkData))
                                { ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="panel-body">

           
                                                                   <div class="form-group  customFiltrers smart-forms">

                                                                       <div class="col-md-6 col-lg-6">
                                                                               <label for="date" class="control-label">Date</label>
                                                                               <div class="section colm colm6">
                                                                                   <label class="field prepend-picker-icon">
                                                                                       <input class="gui-input" id="date" placeholder="YYYY-MM-DD" name="date" value="<?php echo $date; ?>" required="" type="text" disabled="true"  readonly="readonly"><button type="button" class="ui-monthpicker-trigger"><i class="fa fa-calendar"></i></button>
                                                                                   </label>
                                                                               </div>
                                                                              
                                                                           </div>
                                <!--                                           <div class="col-md-6 col-lg-4">

                                                                           </div>-->
                                                                          
                                                                           <div class="col-md-6 col-lg-6">
                                                                               <label for="fname" class="control-label">Grade Selection <span class="asteriskField">
                                                                                       *
                                                                                   </span></label>
                                                                               <select id="grade" name="grade[]" class="form-control grade" rows="4">
<!--                                                                                     <option value="all" >Select All</option>-->
                                                                               <?php  
                                                                                for ($i = 0; $i < count($grade); $i++) 
                                                                                { 
                                                                                    for($j=0;$j<count($gradebydate);$j++)
                                                                                    {
                                                                                        if(in_array($gradebydate[$j]['id'],$grade[$i]))
                                                                                        {
                                                                                            if($j==0)
                                                                                            { ?>
                                                                                            <option value="<?php echo $grade[$i]['id']; ?>" >
                                                                                            <?php echo $grade[$i]['Grade_name']; ?></option>
                                                                                      <?php }
                                                                                            else
                                                                                            { ?>
                                                                                            <option value="<?php echo $grade[$i]['id']; ?>" >
                                                                                            <?php echo $grade[$i]['Grade_name']; ?></option>
                                                                                      <?php }
                                                                                            
                                                                                            ?>
<!--                                                                                                <option value="<?php //echo $grade[$i]['id']; ?>" selected>
                                                                                                <?php //echo $grade[$i]['Grade_name']; ?></option>-->
                                                                                                     <?php $i++;
                                                                                        }
                                                                                        else
                                                                                        {  

                                                                                        } 
                                                                                    } 
                                                                                                       if($i === count($grade))
                                                                                                          {
                                                                                                               break;
                                                                                                          } ?>
                                                                                            
                                                                                                <option value="<?php echo $grade[$i]['id']; ?>" >
                                                                                                <?php  echo $grade[$i]['Grade_name']; ?></option>
                                                                                        
                                                                          <?php }  ?>



                                                                                </select>
                                                                               
                                                                                <?php for ($i = 0; $i < count($grade); $i++) 
                                                                                { 
                                                                                    array_push( $gradeselectall,$grade[$i]['id']);
                                                                                }
                                                                                ?>
                                                                                <input type="hidden" id="selectallgrade" value="<?php echo implode(',', $gradeselectall); ?>" />
                                                                            
                                                                                <div>
                                                                                    <label for="sall" class="control-label">Select All</label>
                                                                                    <input type="checkbox" id="sall" name="sall" />
                                                                                </div>
                                                                           </div>
                                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                         
                                    <div id="dynamicChildItem"> 
                                        
                                    </div>
            
                                            
            
                                    <div class="row">
                                        <div id="loader" class="overlay" style="display:none;">
                                            <img class="center" src="<?php echo $GLOBALS['loader_url']; ?>">
                                        </div>
                                    <div class="col-sm-12 text-center MB-25">
                                        <button type="button" name="submit" value="Add Selection" id="btnSave2" class="btn btn-primary btn-submit" ><i  class="fa fa-plus"></i>&nbsp;&nbsp;Add Selection</button>

                                    </div>
                            </div>
                                       
                          <?php } 
                                else
                                { ?>
                                 
                                 <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    
                            
                                   <div class="form-group  customFiltrers smart-forms">

                                       <div class="col-md-6 col-lg-6">
                                               <label for="date" class="control-label">Date</label>
                                               <div class="section colm colm6">
                                                   <label class="field prepend-picker-icon">
                                                       <input class="gui-input" id="date" placeholder="YYYY-MM-DD" name="date" value="<?php echo $date; ?>" required="" type="text" disabled="true"><button type="button" class="ui-monthpicker-trigger"><i class="fa fa-calendar"></i></button>
                                                   </label>
                                               </div>
                                               <div class="">        
                                                    <label for="interval" class="control-label">Interval<span class="asteriskField">
                                                            *
                                                        </span>
                                                    </label>
                                                    <label class="field select">
                                                        <select id ="interval" name="interval" class="form-control">
                                                           <option value="0" selected>--Select Interval--</option>
                                                           <option value="1">1 Day</option>
                                                           <option value="7">1 week</option>
                                                           <option value="14">2 week</option>
                                                           <option value="21">3 week</option>
                                                           <option value="28">4 week</option>
                                                       </select>
                                                        <i class="arrow"></i>                    
                                                    </label>
                                                </div>
                                           </div>
<!--                                           <div class="col-md-6 col-lg-4">
                                               
                                           </div>-->
                                         
                                           <div class="col-md-6 col-lg-6">
                                               <label for="fname" class="control-label">Grade Selection <span class="asteriskField">
                                                       *
                                                   </span></label>
                                               <select id="grade" name="grade[]" class="multiselect-ui form-control grade" multiple="multiple" rows="4">
                                                       <option value="all" >Select All</option>
                                                   <?php for ($i = 0; $i < count($grade); $i++) { 
                                                      array_push( $gradeselectall,$grade[$i]['id']);
                                                   ?>
                                                       <option value="<?php echo $grade[$i]['id']; ?>"><?php echo $grade[$i]['Grade_name']; ?></option>
                                                   <?php  } ?>
                                                </select>
                                      <input type="hidden" id="selectallgrade" value="<?php echo implode(',', $gradeselectall); ?>" />

                                           </div>
                                    </div>
                               
                           
                        
                </div>
            </div>
        </div>
    </div>
                                
                                
                                 <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-title"><h4>Items</h4></div>
                <div class="panel-body">
                                    <?php 
                                        for ($i = 0; $i < count($dataMenu); $i++) 
                                        { ?>
                                            
                                            <div class="row smart-forms">
                                            <?php  for ($j = 0; $j < count($dataItemCategory); $j++) 
                                            { ?>
                                               
                                                    <div class="col-lg-6 col-xl-4 m-b-10 hidden-xlg dynamicMenu">
                                                        <h6 name='categoryList[]' class=" categoryList no-margin"><?php echo $dataItemCategory[$j]['category_name']; ?><input type="text" id="<?php echo $dataItemCategory[$j]['category_name']; ?>" categoryID="<?php echo $dataItemCategory[$j]['id']; ?>"/></h6>
                                                        <div class="widget-11-2 card main-card no-border card-condensed no-margin widget-loader-circle full-height d-flex flex-column">
                                                            <div class="padding-25">
                                                                <div class="pull-left">
                                                                  
                                                                    <input type='hidden' class='categoryListIDHidden' value='<?php echo $dataItemCategory[$j]['id']; ?>'/>
                                                                    <input type='hidden' class='mealListIDHidden' value='0'/>
                                                                    <p name='menuList[]' class="no-margin menuList"><?php //echo $dataMenu[$i]['menu_name']; ?></p>
                                                                    <input type='hidden' class='menuIDHidden' value='<?php echo $dataMenu[$i]['id']; ?>'/>
                                                                  
                                                                </div>
<!--                                                                <h5 class="pull-right semi-bold">
                                                                    <small class="semi-bold">Item count</small>
                                                                    43
                                                                </h5>-->
                                                                <div class="clearfix"></div>
                                                            </div>
                               
                                                            <div class="auto-overflow widget-11-2-table dynamicMeal" id="<?php echo $dataItemCategory[$j]['category_name']."1"; ?>">
                                                         
                                                       <?php $flag = 0;
                                                       for($k = 0; $k < count($dataItem); $k++)
                                                       { ?>
                                                               <?php  if($dataItemCategory[$j]['id']== $dataItem[$k]['category_id']){ $flag = 1; ?>
                                                                <div class="smart-forms dynamicItem dynamicItem-all"> 
                                                                    <label class="field option block">
                                                                         <input type="checkbox" name="itemCheckBox[]" class="itemCheckBox item<?php echo $dataItemCategory[$j]['category_name']; ?>" value="<?php echo $dataItem[$k]['id']; ?>"/><span class="checkbox"></span>
<!--                                                                         <span class="checkbox"></span> -->
                                                                         <?php echo $dataItem[$k]["item_name"]; ?>&nbsp;&nbsp;
                                                                     </label> 
                                                                    <span class="pull-right priceTag"><b><?php echo "$".$dataItem[$k]["price"]; ?></b></span>
                                                                </div>
                                                               
                                                                   
                                        
                                                               <?php }}
                                                               
                                                               if($flag == 0)
                                                               { ?>
                                                                <div class="alert alert-primary">
                                                                      <p>No Item Assigned.</p>
                                                                   </div>
                                                         <?php }
                                                              
                                                               ?>
                                                       </div>
                                                        </div>
                                                    </div>   
                                             
                                      <?php }?> 

                                                 </div>                    
                                    <?php } 
                                    
                                    ?>
                      </div></div></div></div>
            
                         <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-title"><h4>Meals</h4></div>
                <div class="panel-body">
            
                             
                                      <div class="row">
                                            <?php  for ($j = 0; $j < count($mealData); $j++) 
                                            { 
                                                $arrItem = explode(",", $mealData[$j]['item_name']);
                                                $arrItemPrice = explode(",", $mealData[$j]['price']);
                                                $arrItemID = explode(",", $mealData[$j]['item_id']);
                                                $totItems = count($arrItem);
                                                ?>
                                               
                                                    <div class="col-lg-6 col-xl-4 m-b-10 hidden-xlg dynamicMenu">
                                                         <h6 name='categoryList[]' class=" categoryList no-margin"><span class="padding-0 option-group field checkbox check-success  smart-forms mealCheckboxspan inlineElement"  >
                                                                            <label class="option block MR-0">
                                                                                <input type="checkbox" name="mealCheckBox[]" class="mealCheckBox" value="<?php echo $mealData[$j]['meal_id'];  ?>" /><span class="checkbox"></span>
                                                                            </label>
                                                                        </span><?php echo $mealData[$j]['meal_name']; ?>
                                                                        
                                                                        
                                                                        </h6>
                                                        <div class="widget-11-2 card no-border card-condensed  main-card no-margin widget-loader-circle full-height d-flex flex-column">
                                                          
                                                                
                                                                   
                                                                    <input type='hidden' class='categoryListIDHidden' value='0'/>
                                                                    <input type='hidden' class='mealListIDHidden' value='<?php echo $mealData[$j]['meal_id']; ?>'/>
                                                                    <p name='menuList[]' class="no-margin menuList"></p>
                                                                    <input type='hidden' class='menuIDHidden' value='0'/>
                                                                
<!--                                                                <h5 class="pull-right semi-bold">
                                                                    <small class="semi-bold">Item count</small>
                                                                    <?php //echo $totItems; ?>
                                                                </h5>-->
                                                                <div class="clearfix"></div>
                                                            
                                                            <div class="auto-overflow widget-11-2-table dynamicMeal">
                                                         
                                                               <input type="hidden" class="dynamicItem" />
                                                       <?php 
                                                       for($k = 0; $k < count($arrItem); $k++)
                                                       { ?>
                                                            <div class=" dynamicItem-all smart-forms "> 
                                                                    <label class="field option block">
<!--                                                                         <input type="checkbox" name="itemCheckBox[]" class="itemCheckBox" value="<?php //echo $dataItem[$k]['id']; ?>"/>-->
<!--                                                                         <span class="checkbox"></span>-->
<!--                                                                         <span class="checkbox"></span> -->
                                                                         <?php echo $arrItem[$k]; ?>&nbsp;&nbsp;
                                                                     </label> 
                                                                    <span class="pull-right priceTag"><b><?php echo "$".$arrItemPrice[$k]; ?></b></span>
                                                                </div>

                                                           

                                                         <?php } ?>
                                                              
                                                       </div>
                                                        </div>
                                                    </div>   
                                             
                                      <?php }?> 

                                                 </div> 
                                 </div></div></div></div>
                                 
                                        <div class="row">
                                            <div id="loader" class="overlay" style="display:none;">
                                            <img class="center" src="<?php echo $GLOBALS['loader_url']; ?>">
                                        </div>
                                <div class="col-sm-12 text-center MB-25">
                                    <button type="button" name="submit" value="Add Selection" id="btnSave1" class="btn btn-primary btn-submit" ><i  class="fa fa-plus"></i>&nbsp;&nbsp;Add Selection</button>

                                </div>
                            </div>
                                
                                
                          <?php  } ?>

                            
                            </form>
        
    </div>
</div>
</div>


<?php

$this->load->view('Footer/footer');
?>



<script type="text/javascript">
    $(document).ready(function () {
        
           
        
      
        $('.main-card').slimScroll({
            height: '146px',
            width: '100%',
            size: '5px',
        });
        
        // $('.main-card').addClass("PJ");
        
        displayDynamicMenuItem();
        
//            $('.multiselect-ui').multiselect({
//                includeSelectAllOption: true
//            });

        
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
            //var grade = $(this).parent().parent().parent().find('.grade').val();
            var grade = $('#grade').val();
            var interval = $("#interval").val();
            //alert(grade);
            if(grade == "all")
            {
                grade = $('#selectallgrade').val();
                grade=grade.split(",");
                //alert(grade);
            }
            else
            {
                grade = $('#grade').val();
                //alert('haha');
            }
            //console.log(grade); exit;
            if(interval == 0)
            {
                $("#interval").parent().parent().addClass('has-error');
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
                    $("#interval").parent().parent().addClass('has-error');
                    //return false;
                }
                else
                {
                      $("#interval").parent().parent().removeClass('has-error');
                }
                return false;
            }
            
            if(interval != 0 && grade != 0)
            {
                 $("#interval").parent().parent().removeClass('has-error');
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
                var mealID = this_old1.parent().parent().parent().find('.mealCheckBox').val();
                //console.log(mealID); 
                var arr1 = [];
               // var priceArr = [];
                this_old1.find('.dynamicItem').each(function(index, value){
                   //$(this).addClass("PANDEYYY");
                   var this_old2=$(this);   //.prop("checked") == true
                   $(this_old1).parent().parent().parent().find('.mealCheckBox').addClass("haldwani");
                  // console.log($(this).parent().parent().parent().parent().parent().parent().parent().find('.haldwani').val());
                   //console.log("-->"+$(this_old1).parent().parent().parent().find('.mealCheckBox').prop("checked"));
                    console.log("HTML"+$(this_old1).parent().parent().parent().find('.haldwani').val());
                    if ( $(this_old1).parent().parent().parent().find('.haldwani').is(":checked") ) {
                            //console.log("MEAL CHECKED HAIN");
                      arr1.push(this_old2.parent().parent().parent().parent().parent().parent().parent().find('.mealCheckBox').val());
                     // console.log(arr1);
                    } else {
                         // arr1.push(this_old2.parent().parent().parent().parent().parent().parent().parent().find('.mealCheckBox').val());
                        //console.log("MEAL CHECKED NAHI HAIN");
                    }
                    
                   if ( $(this).find('.itemCheckBox').is(":checked")) {

                      arr1.push(this_old2.find('.itemCheckBox').val());
                    //  console.log(arr1);
                    } else {}
                });
               // console.log("ARR1-->"+arr1); exit;

                if (arr1.length > 0)
                {
                    if(mealID==null){
                        mealID='0';
                         ItemArry1.push({
                        arr1, catagoryID, mealID
                    });
                    }else{
                        arr1='0';
                         ItemArry1.push({
                        arr1, catagoryID, mealID
                    });
                    }
                   
                }
                   
                });
             //  console.log(ItemArry1); exit;
                  if (ItemArry1.length > 0)
                    {
                        ItemArray.push({
                            ItemArry1, menuID
                        });
                    }
               

            });  //  alert(ItemArray1); exit;
           
            //console.log(grade); exit;
            //   $("#date").val();
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() ?>menuitemsel/insertmenuitemdata',
                //async: true,
                data: {ItemArray: ItemArray, date: date, grade: grade, interval: interval},
                dataType: 'json',
                 beforeSend: function(){
                                $("#loader").show();
                                 $('button#btnSave1').prop("disabled", true);
                   },
                success: function (data) {
                   // alert(data);
                    $("#loader").hide();
                    if (data.success)
                    {
                        var dialog = bootbox.dialog({
                        message: '<p class="text-center">Items assigned successfully.</p>',
                        closeButton: false
                        });
                    // do something in the background
                    setTimeout(function(){
                        dialog.modal('hide');
                        location.href = '<?php echo base_url() ?>menuitemsel';
                    }, 3000);
                       
                        
//                        
//                        bootbox.alert({
//                            message: "Data Saved Successfully!",
//                            callback: function () {
//                               location.href = '<?php echo base_url() ?>menuitemsel';
//                            }
//                        })
                    }
                    else
                    {
                        bootbox.alert({
                            message: "Same Data Already Exit111!",
                            callback: function () {
                                //location.href = '<?php //echo base_url() ?>menuitemsel';
                            }
                        })
                    }
                },
                error: function () {

                    bootbox.alert({
                        message: "Error!",
                        callback: function () {

                        }
                    })
                }
            });

            //return false;
            // $('#dataArray').val(JSON.stringify(ItemArray)); //store array

        });
        
        
        $('#btnSave2').click(function () {
            var ItemArray = [];
            
           // alert($('div.dynamicMenu').length);
            //console.log($('div.dynamicMenu').length); exit;
            var date = $("#date").val();
            //var grade = $(this).parent().parent().parent().find('.grade').val();
            var grade = $('#grade').val();
            var interval = $("#interval").val();
            //console.log(grade);
            if($('#sall').is(":checked"))
            {
                grade = $('#selectallgrade').val();
                grade=grade.split(",");
                //alert(grade);
            }
            else
            {
                grade = $('#grade').val();
                //alert('haha');
            }
            
           // alert(grade); exit;
            if(interval == 0)
            {
                $("#interval").parent().parent().addClass('has-error');
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
                    $("#interval").parent().parent().addClass('has-error');
                    //return false;
                }
                else
                {
                      $("#interval").parent().parent().removeClass('has-error');
                }
                return false;
            }
            
            if(interval != 0 && grade != 0)
            {
                 $("#interval").parent().parent().removeClass('has-error');
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
                //var mealID;
                var mealID = this_old1.parent().parent().parent().find('.mealCheckBox').val();
                console.log(mealID); 
                var arr1 = [];
                var arrpq = [];
               // var priceArr = [];
                this_old1.find('.dynamicItem').each(function(index, value){
                   //$(this).addClass("PANDEYYY");
                   var this_old2=$(this);   //.prop("checked") == true    $(this_old1).parent().parent().parent().find('.haldwani')
                   $(this_old1).parent().parent().parent().find('.mealCheckBox').addClass("haldwani");
                  // console.log($(this).parent().parent().parent().parent().parent().parent().parent().find('.haldwani').val());
                   //console.log("-->"+$(this_old1).parent().parent().parent().find('.mealCheckBox').prop("checked"));
                    //console.log("HTML"+$(this).parent().parent().prev('h6').find('input.mealCheckBox').addClass("DIVESH").val());
                    if ( $(this).parent().parent().prev('h6').find('input.mealCheckBox').is(":checked") ) {
                            //console.log("MEAL CHECKED HAIN");
                      arr1.push($(this).parent().parent().prev('h6').find('input.mealCheckBox').val());
                      //mealID = $(this).parent().parent().prev('h6').find('input.mealCheckBox').val();
                     // console.log(arr1);
                    } else {
                         // arr1.push(this_old2.parent().parent().parent().parent().parent().parent().parent().find('.mealCheckBox').val());
                        //console.log("MEAL CHECKED NAHI HAIN");
                    }
                    
                   if ( $(this).find('.itemCheckBox').is(":checked")) {

                      arr1.push(this_old2.find('.itemCheckBox').val());
                    //  console.log(arr1);
                    } else {}
                });
               // console.log("ARR1-->"+arr1); exit;

                if (arr1.length > 0)
                {
                    if(mealID==null){
                        mealID='0';
                         ItemArry1.push({
                        arr1, catagoryID, mealID
                    });
                    }else{
                            arrpq=arr1;
                            arr1 = '0';
                            
                         for(var di= 0 ; di< arrpq.length ; di++)
                         {
                             //console.log('for');
                             mealID = arrpq[di];
                             ItemArry1.push({
                                arr1, catagoryID, mealID
                            });
                         }
//                         ItemArry1.push({
//                        arr1, catagoryID, mealID
//                    });
                    }
                   
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
                url: '<?php echo base_url() ?>menuitemsel/insertmenuitemdata',
                //async: true,
                data: {ItemArray: ItemArray, date: date, grade: grade, interval: interval},
                dataType: 'json',
                 beforeSend: function(){
                                $("#loader").show();
                                
                                $('button#btnSave2').prop("disabled", true);
                   },
                success: function (data) {
                     $("#loader").hide();
                     
                   // alert(data);
                    if (data.success)
                    {
                        var dialog = bootbox.dialog({
                        message: '<p class="text-center">Items assigned successfully.</p>',
                        closeButton: false
                        });
                    // do something in the background
                    setTimeout(function(){
                        dialog.modal('hide');
                        location.href = '<?php echo base_url() ?>menuitemsel';
                    }, 3000);
                       
                        
//                        
//                        bootbox.alert({
//                            message: "Data Saved Successfully!",
//                            callback: function () {
//                               location.href = '<?php echo base_url() ?>menuitemsel';
//                            }
//                        })
                    }
                    else
                    {
                        bootbox.alert({
                            message: "Same Data Already Exit111!",
                            callback: function () {
                                //location.href = '<?php //echo base_url() ?>menuitemsel';
                            }
                        })
                    }
                },
                error: function () {

                    bootbox.alert({
                        message: "Error!",
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
        var desertItemID = []; 
        var drinkItemID = [];
        var sideItemID = [];
        var starterItemID = [];
        $(document).on('keyup','#Deserts',function(event) {
           var searchValue = $.trim($(this).val());
           var categID = $(this).attr('categoryID');
           if($.trim($(this).val()).length > 0)
           {
               $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>menuitemsel/ajaxSearchItemMenuWise',
                      data:  {searchValue: searchValue, categID: categID},
                      dataType: 'json',
                      success: function(data){
                                  var i,j,jj,kk,l,p;
                                  $("#Deserts1").html("");
                                  //alert(desertItemID);
                                  //html='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                                  var html ='';
                                  if(data['searchData'].length > 0)
                                  {
                                      for(kk=0; kk< data['searchData'].length; kk++)
                                      {
                                          let check;
                                          for(i = 0; i < desertItemID.length; i++)
                                          {
                                                if(desertItemID[i] == data['searchData'][kk]['id'])
                                                {
                                                    check = "checked";
                                                    break;
                                                }
                                          }

                                          html+='<div class="  smart-forms dynamicItem dynamicItem-all">';
                                          html+='<label class="field option block">';
                                          html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox itemDeserts" value="'+data['searchData'][kk]['id']+'" '+check+'/><span class="checkbox"></span>';
                                          html+=data['searchData'][kk]['item_name']+'&nbsp;&nbsp;';
                                          html+='</label>';
                                          html+='<span class="pull-right priceTag">';
                                          html+='<b>$'+data['searchData'][kk]['price']+'</b></span>';
                                          html+='</div>'; 
                                      } 
                                      //html+='</div>';
                                      $("#Deserts1").append(html); 
                                   }
                                   else
                                   {
                                      html+='<div class="alert alert-primary">';
                                      html+='<p>No Item Assigned.</p>';
                                      html+='</div>';
                                      $("#Deserts1").append(html); 
                                   }
                      },
                      error: function(){

                      }
              });
           }
           else
           {
               $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>menuitemsel/ajaxSearchItemMenuWise',
                  data:  {searchValue: searchValue, categID: categID},
                  dataType: 'json',
                  success: function(data){
                              var i,j,jj,kk,l,p;
                              $("#Deserts1").html("");
                              //html='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                              var html ='';
                              for(kk=0; kk< data['searchData'].length; kk++)
                              {
                                let check;
                                for(i = 0; i < desertItemID.length; i++)
                                {
                                      if(desertItemID[i] == data['searchData'][kk]['id'])
                                      {
                                          check = "checked";
                                          break;
                                      }
                                }
                                html+='<div class="  smart-forms dynamicItem dynamicItem-all">';
                                html+='<label class="field option block">';
                                html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox itemDeserts" value="'+data['searchData'][kk]['id']+'" '+check+'/><span class="checkbox"></span>';
                                html+=data['searchData'][kk]['item_name']+'&nbsp;&nbsp;';
                                html+='</label>';
                                html+='<span class="pull-right priceTag">';
                                html+='<b>$'+data['searchData'][kk]['price']+'</b></span>';
                                html+='</div>'; 
                              } 
                              //html+='</div>';
                              $("#Deserts1").append(html); 
                  },
                  error: function(){
                  }
          });
           }
       }); 
        $(document).on('keyup','#Drinks',function(event) {
           var searchValue = $.trim($(this).val());
           var categID = $(this).attr('categoryID');
           if($.trim($(this).val()).length > 0)
           {
               $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>menuitemsel/ajaxSearchItemMenuWise',
                      data:  {searchValue: searchValue, categID: categID},
                      dataType: 'json',
                      success: function(data){
                                  var i,j,jj,kk,l,p;
                                  $("#Drinks1").html("");
                                  //html='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                                  var html ='';
                                  if(data['searchData'].length > 0)
                                  {
                                      for(kk=0; kk< data['searchData'].length; kk++)
                                      {
                                          let check;
                                          for(i = 0; i < drinkItemID.length; i++)
                                          {
                                                if(drinkItemID[i] == data['searchData'][kk]['id'])
                                                {
                                                    check = "checked";
                                                    break;
                                                }
                                          }
                                          html+='<div class="  smart-forms dynamicItem dynamicItem-all">';
                                          html+='<label class="field option block">';
                                          html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox itemDrinks" value="'+data['searchData'][kk]['id']+'" '+check+'/><span class="checkbox"></span>';
                                          html+=data['searchData'][kk]['item_name']+'&nbsp;&nbsp;';
                                          html+='</label>';
                                          html+='<span class="pull-right priceTag">';
                                          html+='<b>$'+data['searchData'][kk]['price']+'</b></span>';
                                          html+='</div>'; 
                                      } 
                                      //html+='</div>';
                                      $("#Drinks1").append(html); 
                                   }
                                   else
                                   {
                                      html+='<div class="alert alert-primary">';
                                      html+='<p>No Item Assigned.</p>';
                                      html+='</div>';
                                      $("#Drinks1").append(html); 
                                   }
                      },
                      error: function(){

                      }
              });
           }
           else
           {
               $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>menuitemsel/ajaxSearchItemMenuWise',
                  data:  {searchValue: searchValue, categID: categID},
                  dataType: 'json',
                  success: function(data){
                              var i,j,jj,kk,l,p;
                              $("#Drinks1").html("");
                              //html='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                              var html ='';
                              for(kk=0; kk< data['searchData'].length; kk++)
                              {
                                let check;
                                for(i = 0; i < drinkItemID.length; i++)
                                {
                                      if(drinkItemID[i] == data['searchData'][kk]['id'])
                                      {
                                          check = "checked";
                                          break;
                                      }
                                }
                                html+='<div class="  smart-forms dynamicItem dynamicItem-all">';
                                html+='<label class="field option block">';
                                html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox itemDrinks" value="'+data['searchData'][kk]['id']+'" '+check+'/><span class="checkbox"></span>';
                                html+=data['searchData'][kk]['item_name']+'&nbsp;&nbsp;';
                                html+='</label>';
                                html+='<span class="pull-right priceTag">';
                                html+='<b>$'+data['searchData'][kk]['price']+'</b></span>';
                                html+='</div>'; 
                              } 
                              //html+='</div>';
                              $("#Drinks1").append(html); 
                  },
                  error: function(){
                  }
          });
           }
       }); 
        $(document).on('keyup','#Sides',function(event) {
           var searchValue = $.trim($(this).val());
           var categID = $(this).attr('categoryID');
           if($.trim($(this).val()).length > 0)
           {
               $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>menuitemsel/ajaxSearchItemMenuWise',
                      data:  {searchValue: searchValue, categID: categID},
                      dataType: 'json',
                      success: function(data){
                                  var i,j,jj,kk,l,p;
                                  $("#Sides1").html("");
                                  //html='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                                  var html ='';
                                  if(data['searchData'].length > 0)
                                  {
                                      for(kk=0; kk< data['searchData'].length; kk++)
                                      {
                                          let check;
                                          for(i = 0; i < sideItemID.length; i++)
                                          {
                                                if(sideItemID[i] == data['searchData'][kk]['id'])
                                                {
                                                    check = "checked";
                                                    break;
                                                }
                                          }
                                          html+='<div class="  smart-forms dynamicItem dynamicItem-all">';
                                          html+='<label class="field option block">';
                                          html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox itemSides" value="'+data['searchData'][kk]['id']+'" '+check+'/><span class="checkbox"></span>';
                                          html+=data['searchData'][kk]['item_name']+'&nbsp;&nbsp;';
                                          html+='</label>';
                                          html+='<span class="pull-right priceTag">';
                                          html+='<b>$'+data['searchData'][kk]['price']+'</b></span>';
                                          html+='</div>'; 
                                      } 
                                      //html+='</div>';
                                      $("#Sides1").append(html); 
                                   }
                                   else
                                   {
                                      html+='<div class="alert alert-primary">';
                                      html+='<p>No Item Assigned.</p>';
                                      html+='</div>';
                                      $("#Sides1").append(html); 
                                   }
                      },
                      error: function(){

                      }
              });
           }
           else
           {
               $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>menuitemsel/ajaxSearchItemMenuWise',
                  data:  {searchValue: searchValue, categID: categID},
                  dataType: 'json',
                  success: function(data){
                              var i,j,jj,kk,l,p;
                              $("#Sides1").html("");
                              //html='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                              var html ='';
                              for(kk=0; kk< data['searchData'].length; kk++)
                              {
                                let check;
                                for(i = 0; i < sideItemID.length; i++)
                                {
                                      if(sideItemID[i] == data['searchData'][kk]['id'])
                                      {
                                          check = "checked";
                                          break;
                                      }
                                }
                                html+='<div class="  smart-forms dynamicItem dynamicItem-all">';
                                html+='<label class="field option block">';
                                html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox itemSides" value="'+data['searchData'][kk]['id']+'" '+check+'/><span class="checkbox"></span>';
                                html+=data['searchData'][kk]['item_name']+'&nbsp;&nbsp;';
                                html+='</label>';
                                html+='<span class="pull-right priceTag">';
                                html+='<b>$'+data['searchData'][kk]['price']+'</b></span>';
                                html+='</div>'; 
                              } 
                              //html+='</div>';
                              $("#Sides1").append(html); 
                  },
                  error: function(){
                  }
          });
           }
       }); 
        $(document).on('keyup','#Starter',function(event) {
           var searchValue = $.trim($(this).val());
           var categID = $(this).attr('categoryID');
           if($.trim($(this).val()).length > 0)
           {
               $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url(); ?>menuitemsel/ajaxSearchItemMenuWise',
                      data:  {searchValue: searchValue, categID: categID},
                      dataType: 'json',
                      success: function(data){
                                  var i,j,jj,kk,l,p;
                                  $("#Starter1").html("");
                                  //html='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                                  var html ='';
                                  let flag = 0; 
                                  if(data['searchData'].length > 0)
                                  {
                                      for(kk=0; kk< data['searchData'].length; kk++)
                                      {
                                          let check;
                                          for(i = 0; i < starterItemID.length; i++)
                                          {
                                                if(starterItemID[i] == data['searchData'][kk]['id'])
                                                {
                                                    check = "checked";
                                                    break;
                                                }
                                          }
                                          html+='<div class="  smart-forms dynamicItem dynamicItem-all">';
                                          html+='<label class="field option block">';
                                          html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox itemStarter" value="'+data['searchData'][kk]['id']+'" '+check+'/><span class="checkbox"></span>';
                                          html+=data['searchData'][kk]['item_name']+'&nbsp;&nbsp;';
                                          html+='</label>';
                                          html+='<span class="pull-right priceTag">';
                                          html+='<b>$'+data['searchData'][kk]['price']+'</b></span>';
                                          html+='</div>'; 
                                      } 
                                      //html+='</div>';
                                      $("#Starter1").append(html); 
                                   }
                                   else
                                   {
                                      html+='<div class="alert alert-primary">';
                                      html+='<p>No Item Assigned.</p>';
                                      html+='</div>';
                                      $("#Starter1").append(html); 
                                   }
                      },
                      error: function(){

                      }
              });
           }
           else
           {
               $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>menuitemsel/ajaxSearchItemMenuWise',
                  data:  {searchValue: searchValue, categID: categID},
                  dataType: 'json',
                  success: function(data){
                              var i,j,jj,kk,l,p;
                              $("#Starter1").html("");
                              //html='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                              var html ='';
                              let flag = 0; 
                              for(kk=0; kk< data['searchData'].length; kk++)
                              {
                                let check;
                                for(i = 0; i < starterItemID.length; i++)
                                {
                                      if(starterItemID[i] == data['searchData'][kk]['id'])
                                      {
                                          check = "checked";
                                          break;
                                      }
                                }
                                html+='<div class="  smart-forms dynamicItem dynamicItem-all">';
                                html+='<label class="field option block">';
                                html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox itemStarter" value="'+data['searchData'][kk]['id']+'" '+check+'/><span class="checkbox"></span>';
                                html+=data['searchData'][kk]['item_name']+'&nbsp;&nbsp;';
                                html+='</label>';
                                html+='<span class="pull-right priceTag">';
                                html+='<b>$'+data['searchData'][kk]['price']+'</b></span>';
                                html+='</div>'; 
                              } 
                              //html+='</div>';
                              $("#Starter1").append(html); 
                  },
                  error: function(){
                  }
          });
           }
       }); 
        $(document).on('click', '.itemDeserts', function(event){
            if($(this).is(':checked'))
            {
               // alert("checked");
                desertItemID.push($(this).val());
                //alert(desertItemID);
            }
            else
            {
               // alert("Unchecked");
                desertItemID.splice( desertItemID.indexOf($(this).val()), 1 );
               // alert(desertItemID);
            }
        });
        $(document).on('click', '.itemDrinks', function(event){
            if($(this).is(':checked'))
            {
                //alert("checked");
                drinkItemID.push($(this).val());
               // alert(drinkItemID);
            }
            else
            {
               // alert("Unchecked");
                drinkItemID.splice( drinkItemID.indexOf($(this).val()), 1 );
               // alert(drinkItemID);
            }
        });
        $(document).on('click', '.itemSides', function(event){
            if($(this).is(':checked'))
            {
                //alert("checked");
                sideItemID.push($(this).val());
               // alert(sideItemID);
            }
            else
            {
               // alert("Unchecked");
                sideItemID.splice( sideItemID.indexOf($(this).val()), 1 );
               // alert(sideItemID);
            }
        });
        $(document).on('click', '.itemStarter', function(event){
            if($(this).is(':checked'))
            {
                //alert("checked");
                starterItemID.push($(this).val());
               // alert(starterItemID);
            }
            else
            {
               // alert("Unchecked");
                starterItemID.splice( starterItemID.indexOf($(this).val()), 1 );
               // alert(starterItemID);
            }
        });
            
        itemsDisabling();
        
         $(document).on('change', '.grade', function(){
             //alert("Div");
              $(this).parent().find('#sall').prop("checked", false); // Unchecks it
              //$("#dynamicChildItem").html(""); 
//               if($(this).parent().find('input#sall').is(":checked"))
//               {
//                  
//                }
//               else
//               {
//                   $('#sall').attr('checked', false);
//               }
             displayDynamicMenuItem();
         });
        
        
        function itemsDisabling()
        {
//               $.ajax({
//                type: 'post',
//                url: '<?php //echo base_url() ?>menuitemsel/ajaxitemsdisabling',
//                //async: true,
//                data: {pq:'9'},
//                dataType: 'json',
//                success: function (data) {
//                    //alert(data);
//                  //alert(data);
//                  //console.log( $('.dynamicMenuItem').length);
//                    var i;
//                    for(i=0; i<data.length; i++)
//                    {
//                        $( ".dynamicMenuItem" ).each(function(index) {
//                            this_old = $(this);
//                            var menu_id = $(this).find('input.menuIDHidden').val();
//                            if(menu_id == data[i].menu_id)
//                            {
//                               var input_this =  $(this_old).find('input.itemCheckBox');
//                                
//                                $(input_this).each(function(index) {
//                                    
//                                    //console.log($(this).val());
//                                    if($(this).val() == data[i].item_id)
//                                    {
//                                        //  console.log($(this).val());
//                                          $(this).attr("disabled", true);
//                                          $(this).parent().parent().find('span.priceTag').removeClass('td_class');
//                                    }
//                                    
//                                });
//                               // console.log( index + " MenuID: "+ menu_id + " MENUID OUTERLOOD AJAX:"+ data[i].menu_id + "ITEM ID:"+ data[i].item_id);
//                                return false; 
//                            }
//                       }); 
//                    }
//                },
//                error: function () {
//                }
//            });
        }     
        
        
        function displayDynamicMenuItem()
        {
            
            var gradeID =  $('#grade option:selected').val();
            var date = $('#date').val();
             //console.log("PK"+gradeID);
             
            $.ajax({
                type: "post",
                url: '<?php echo base_url(); ?>menuitemsel/displaydynamicmenuitem',
                data: {date: date,gradeID: gradeID},
                dataType: 'json',
                success:function(data){
                              //  console.log("HI DIVESH");
                                $("#dynamicChildItem").html("");
                                var i,j,jj,kk,l,p;
                                var html = '<div class="row">';
                                    html+='<div class="col-lg-12">';
                                    html+='<div class="panel panel-default">';
                                    html+='<div class="panel-title"><h4>Items</h4></div>';
                                    html+='<div class="panel-body">';
                                
                                for (i = 0; i < data['datamenu'].length; i++)
                                {
                                    html+=' <div class="row smart-forms">';
                                    for(jj=0; jj< data['ItemCategory'].length;jj++)
                                    {
                                        html+='<div class="col-lg-6 col-xl-4 m-b-10 hidden-xlg dynamicMenu">';
                                        html+='<h6 name="categoryList[]" class=" categoryList no-margin">'+data["ItemCategory"][jj].category_name+'</h6>';
                                        html+='<div class="widget-11-2 card main-card no-border card-condensed no-margin widget-loader-circle full-height d-flex flex-column">';
                                        html+='<div class="padding-25">';
                                        html+='<div class="pull-left">';
                                        html+='<input type="hidden" class="categoryListIDHidden" value="'+data["ItemCategory"][jj].id+'"/>';
                                        html+='<input type="hidden" class="mealListIDHidden" value="0"/>';
                                        html+='<p name="menuList[]" class="no-margin menuList"></p>';
                                        html+='<input type="hidden" class="menuIDHidden" value="'+data['datamenu'][i]['id']+'"/>';
                                        html+='</div>';
                                        html+='<div class="clearfix"></div>';
                                        html+='</div>';
                                        html+='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                                        let flag = 0; 
                                        for(kk=0; kk< data['dataItem'].length; kk++)
                                        {
                                            let checked="";
                                            for(j=0;j< data['checkData'].length;j++)
                                            {
                                               let itemID = data['checkData'][j]['item_id'].split(",");
                                               for(l=0;l< itemID.length;l++)
                                               {
                                                    if(itemID[l] == data['dataItem'][kk]['id'] && 
                                                    data['checkData'][j]['menu_id'] == data['datamenu'][i]['id']
                                                    &&  data['checkData'][j]['category_id'] == data["ItemCategory"][jj].id
                                                    && data["ItemCategory"][jj].id == data['dataItem'][kk]['category_id'])
                                                    {
                                                         checked="checked";
                                                    }
                                                }
                                            }
                                            if(data["ItemCategory"][jj].id == data['dataItem'][kk]['category_id']){
                                               flag = 1;
                                                html+='<div class="  smart-forms dynamicItem dynamicItem-all">';
                                                html+='<label class="field option block">';
                                                html+='<input type="checkbox" name="itemCheckBox[]" class="itemCheckBox" value="'+data['dataItem'][kk]['id']+'" '+checked+'/><span class="checkbox"></span>';
                                                html+=data['dataItem'][kk]['item_name']+'&nbsp;&nbsp;';
                                                html+='</label>';
                                                html+='<span class="pull-right priceTag">';
                                                html+='<b>$'+data['dataItem'][kk]['price']+'</b></span>';
                                                html+='</div>'; 
                                            }
                                        } 
                                          if(flag == 0)
                                            {
                                                html+='<div class="alert alert-primary">';
                                                html+='<p>No Item Assigned.</p>';
                                                html+='</div>';
                                            }
                                     
                                        html+='</div>';
                                        html+='</div>';
                                        html+='</div>';
                                             
                                    } 
                                    html+='</div>';                   
                                } 
                                    html+='</div></div></div></div>';     
                                   
                                    html+= '<div class="row">';
                                    html+='<div class="col-lg-12">';
                                    html+='<div class="panel panel-default">';
                                    html+='<div class="panel-title"><h4>Meals</h4></div>';
                                    html+='<div class="panel-body">';
                                    html+='<div class="row">';
                                    var checked;
                                    for (i = 0; i < data['datameal'].length; i++)
                                    { 
                                        checked="";
                                        let itemName = data['datameal'][i]['item_name'].split(",");
                                        let itemPrice = data['datameal'][i]['price'].split(",");
                                        let itemID = data['datameal'][i]['item_id'].split(",");
                                        let totItems = itemName.length;  
                                           
                                        for(p= 0; p < data['checkData1'].length; p++)
                                        {
                                            //console.log(data['gradeID']); exit;
                                            if( data['datameal'][i]['meal_id'] === data['checkData1'][p]['meal_id'] )
                                            {
                                                checked="checked";
                                            }
                                        }
                                        html+='<div class="col-lg-6 col-xl-4 m-b-10 hidden-xlg dynamicMenu">';
                                        html+='<h6 name="categoryList[]" class=" categoryList no-margin"><span class="padding-0 option-group field checkbox check-success  smart-forms mealCheckboxspan inlineElement"  >';
                                        html+='<label class="option block MR-0">';
                                        html+='<input type="checkbox" name="mealCheckBox[]" class="mealCheckBox" value="'+data['datameal'][i]['meal_id']+'" '+checked+'/><span class="checkbox"></span>';
                                        html+='</label>';
                                        html+='</span>'+data['datameal'][i]['meal_name'];
                                       
                                        html+='</h6>';
                                        html+=' <div class="widget-11-2 card no-border card-condensed  main-card no-margin widget-loader-circle full-height d-flex flex-column">';
                                        html+='<input type="hidden" class="categoryListIDHidden" value="0"/>';
                                        html+='<input type="hidden" class="mealListIDHidden" value="'+data["datameal"][i].id+'"/>';
                                        html+='<p name="menuList[]" class="no-margin menuList"></p>';
                                        html+='<input type="hidden" class="menuIDHidden" value="0"/>';
                                        html+='<div class="clearfix"></div>';
                                        html+='<div class="auto-overflow widget-11-2-table dynamicMeal">';
                                        html+='<input type="hidden" class="dynamicItem" />';
                                  
                                    for (j = 0; j < itemID.length; j++)
                                    {
                                        html+='<div class=" dynamicItem-all smart-forms ">'; 
                                        html+='<label class="field option block">';
                                        html+=itemName[j]+'&nbsp;&nbsp;';  
                                        html+='</label>';
                                        html+='<span class="pull-right priceTag"><b>$'+itemPrice[j]+'</b></span>';
                                        html+='</div>';
                                    } 

                                    html+='</div>';
                                    html+='</div>';
                                    html+='</div>';   
                                } 
                                    html+='</div>'; 
                                html+='</div></div></div></div>';
                                $("#dynamicChildItem").append(html);
                                
                                  function setHeight() {
                                            windowHeight = $('#page-wrapper').height();
                                            //alert(windowHeight);
                                            $('.sidebar').css('min-height', windowHeight);
                                            };
                                            setHeight();

                                            $(window).resize(function() {
                                            setHeight();
                                    });
                                
                        }
                    }); 
        }
    });
</script>
















