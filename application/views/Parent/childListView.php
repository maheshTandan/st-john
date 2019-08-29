<?php include('application/views/services/service.php');
//echo $status;
// echo $GLOBALS['img_url']; die;

  // print_r($start_Date); die;
?>

<script type="text/javascript">
  
  $(document).ready(function(){
   
     var selectedChild = $(".childId option:selected").val();
     var parentIDD = $('#parentIDD').val();
     var startDate = $('#startDate').val();
     var endDate = $('#endDate').val();
      childMealCategoryItem(selectedChild, parentIDD, startDate, endDate);
       
      
    $(document).on('change', '.childId', function(){
        
      var selectedChild = $(".childId option:selected").val();
      childMealCategoryItem(selectedChild, parentIDD, startDate, endDate);
    });

    
     function call_milk(x, uncheckDate){
        //alert(uncheckDate);
        var url='';
        var weekvalue = $('#weekvalue').val();
        var yearvalue = $('#yearvalue').val();
        var baseurl = $('#baseurl').val();
        var childID = $('#interval').val();
        //var parentIDD = $('#parentIDD').val();
        //var startDate = $('#startDate').val();
        //var endDate = $('#endDate').val();
        var milkID =  x;
     
      
        if($('.farrow').length === 1)
        {
          url = baseurl+'index.php/menusel/index?week='+(parseInt(weekvalue)+1)+'&year='+yearvalue+'&childID='+childID+'&milkid='+milkID;
          $(".farrow").val(url);
        }
        
        if($('.barrow').length === 1)
        {
            url = baseurl+'index.php/menusel/index?week='+(parseInt(weekvalue)-1)+'&year='+yearvalue+'&childID='+childID+'&milkid='+milkID;
            $(".barrow").val(url);
        }  
       

        var i, day1, day2, day3, day4, day5;
        var restDate = $('#restrictredDate').val();
        restDate=restDate.split(",");
        var noselectiondates = uncheckDate;
        //noselectiondates=noselectiondates.split(",");
        
        //alert(noselectiondates);
        var milkID = x;
        var milkName='';
        $('#milktype').children().each(function(){
            if($(this).val()==x){
                $(this).attr("selected","selected");
                 milkName = $(this).text();
            }
        });
        
       // alert(milkName);
        
        var  date_11_12_2018 = '23356';
      
        $('.dynamicDates').each(function(index, value){
            var prev = $(this);
            var flag = 0;  
         
            if(index == 0)
            {
              day1 = prev.parent().parent().parent().find('thead').find('th.header1').text();
              day2 = prev.parent().parent().parent().find('thead').find('th.header2').text();
              day3 = prev.parent().parent().parent().find('thead').find('th.header3').text();
              day4 = prev.parent().parent().parent().find('thead').find('th.header4').text();
              day5 = prev.parent().parent().parent().find('thead').find('th.header5').text();

             // alert(day1); alert(day2); alert(day3); alert(day4); alert(day5);
             // 2018-12-102018-12-112018-12-122018-12-132018-12-14
            } 

            if(index < 5)
            {

              if(index == 0)
              {
                  date_11_12_2018 = day1;
              } 
              if(index == 1)
              {
                  date_11_12_2018 = day2;
              } 
              if(index == 2)
              {
                  date_11_12_2018 = day3;
              } 
              if(index == 3)
              {
                  date_11_12_2018 = day4;
              } 
              if(index == 4)
              {
                  date_11_12_2018 = day5;
              } 

             // for(i = 0; i< restDate.length; i++)
             // {
                //  if( date_11_12_2018 != restDate[i]  )
                  if(jQuery.inArray(date_11_12_2018, restDate) == -1)
                  {
                      //alert(date_11_12_2018);
                      var counter = index +1;
                      $(this).find('.dynamicMenu').each(function(index, value){
                          
                          
                          
                          $(this).find('.menuID').each(function(index, value){
                             if($(this).is(':checked') == true)
                              {
                                 flag = 1;
                                 // console.log('nahi banega');
                                 return false;
                              }
                          });
                      });

                      if(flag === 0 || flag === 1)
                      {
                         // console.log('banega');
                          prev.find('.dynamicMenuNoSel').each(function(index, value){
                              var prev1 = $(this);
                              var ck =  $(this).children('h6').text();
                              prev1.find('.itemID').each(function(index, value){
                                  //alert($(this).val());
                                  var itmid = $(this).val();
                                  if(itmid == milkID)
                                  {
                                        //$(this).prop('checked', true);
                                  }
                                  else
                                  {
                                     // $(this).prop('checked', false);
                                  }
                               });
                               
                              var side= '.sides'+counter;
                              var noselections = '.noselection'+counter;
                              
                              var ddownmilk = '.ddownmilk'+counter;
                              var ddrriik = '.ddrriik'+counter;
                              prev.find('table.milklabel').remove();
                              
                            
                            
                              
                              
                            
                              //prev.find('input'+side).prop('checked', true); 
                              //prev.find('input'+noselections).prop('checked', false);
                              //alert(prev.find('input'+abc).val());
                                  
                              
                             

                              //prev.find('input.drink').prop('checked', false);
                              //prev.find('table.noselectiontab').before('<table class="milklabel"><tbody><tr><td class="dynamicCategory"><input type="hidden" name="categoryName[]" class="categoryID" value="3"><h6>Add on Milk</h6><label class="option block"><input type="checkbox" class="itemID cc milkonly'+counter+' radiocheck'+counter+' ddownmilk'+counter+'" name="categoryItem[]" value="'+milkID+'"  checked><span class="checkbox"></span><span class="itemLunch">'+milkName+'</span></label><div class="priceTag"></div><label class="option block"><input type="checkbox" class="itemID cc extramilk'+counter+' milkonly'+counter+' radiocheck'+counter+'" name="categoryItem[]" value="1001"><span class="checkbox"></span><span class="itemLunch"> Extra Milk</span></label><div class="priceTag"><p>$ 0.50</p></div></td></tr></tbody></table>');


//                        pointer = $('.ddownmilk1');
//                        var flag55 = 1;  
//                        if(pointer.parent().parent().parent().parent().parent().prev().find('.input'+ddrriik).length === 0)
//                        {
//                            flag55 = 0;
//                        }
                             
                              
                               //alert(date_11_12_2018); 
                            zerocase = prev.find('input'+ddrriik).length;
                              if(jQuery.inArray(date_11_12_2018, noselectiondates) == -1)
                              {
                                  //alert(date_11_12_2018);
                               // prev.find('input'+ddownmilk).prop('checked', false);
                                //prev.find('input'+noselections).prop('checked', true);
                                //prev.find('table.noselectiontab').before('<table class="milklabel"><tbody><tr><td class="dynamicCategory"><input type="hidden" name="categoryName[]" class="categoryID" value="3"><h6>Add on Milk</h6><label class="option block"><input type="checkbox" class="itemID cc milkonly'+counter+' radiocheck'+counter+' ddownmilk'+counter+'" name="categoryItem[]" value="'+milkID+'"  checked><span class="checkbox"></span><span class="itemLunch">'+milkName+'</span></label><div class="priceTag"></div><label class="option block"><input type="checkbox" class="itemID cc extramilk'+counter+' milkonly'+counter+' radiocheck'+counter+'" name="categoryItem[]" value="1001"><span class="checkbox"></span><span class="itemLunch"> Extra Milk</span></label><div class="priceTag"><p>$ 0.50</p></div></td></tr></tbody></table>');
                                    if(zerocase===0)
                                    {
                                        prev.find('table.noselectiontab').before('<table class="milklabel"><tbody><tr><td class="dynamicCategory"><input type="hidden" name="categoryName[]" class="categoryID" value="3"><h6>Add on Milk</h6><label class="option block"><input type="checkbox" class="itemID cc milkonly'+counter+' radiocheck'+counter+' ddownmilk'+counter+'" name="categoryItem[]" value="'+milkID+'"  checked><span class="checkbox"></span><span class="itemLunch">'+milkName+'</span></label><div class="priceTag"></div><label class="option block"><input type="checkbox" class="itemID cc extramilk'+counter+' milkonly'+counter+' radiocheck'+counter+'" name="categoryItem[]" value="1001"><span class="checkbox"></span><span class="itemLunch"> Extra Milk</span></label><div class="priceTag"><p>$ 0.50</p></div></td></tr></tbody></table>');
                                        prev.find('input'+noselections).prop('checked', false);
                                    }
                                    
                             }
                              else{
                                //prev.find('table.noselectiontab').before('<table class="milklabel"><tbody><tr><td class="dynamicCategory"><input type="hidden" name="categoryName[]" class="categoryID" value="3"><h6>Add on Milk</h6><label class="option block"><input type="checkbox" class="itemID cc milkonly'+counter+' radiocheck'+counter+' ddownmilk'+counter+'" name="categoryItem[]" value="'+milkID+'"  ><span class="checkbox"></span><span class="itemLunch">'+milkName+'</span></label><div class="priceTag"></div><label class="option block"><input type="checkbox" class="itemID cc extramilk'+counter+' milkonly'+counter+' radiocheck'+counter+'" name="categoryItem[]" value="1001"><span class="checkbox"></span><span class="itemLunch"> Extra Milk</span></label><div class="priceTag"><p>$ 0.50</p></div></td></tr></tbody></table>');
                            }
                           
                            
                             
                              

                          });  
                      }

                      if(milkID === '0')
                      {
                          var side= '.sides'+counter;
                          prev.find('input'+side).prop('checked', true);
                          prev.find('input.drink').prop('checked', true);
                          prev.find('table.milklabel').remove();
                      }
                 }
             // }
            }
        });
    }
    
    
    
    
   function childMealCategoryItem(selectedChild, parentIDD, startDate, endDate)
       {
         DateValue =  $('.dateHeader').text();
         DateValue1 = DateValue.match(/.{1,10}/g);
           // alert(DateValue1[1]);
        <?php //  print_r($checkData); die; ?>
         $.ajax({
                type: 'post',
                url: '<?php echo base_url();?>ChildMenuItemController/categoryItemMeal',
                data: {selectedChild: selectedChild,DateValue1:DateValue1,parentIDD:parentIDD,startDate:startDate,endDate:endDate},
                dataType:'json',
                success:function(data){
                   var a,b,i,j,k,l,m,n,o,p,html="";
                   var uncheckDate = new Array();

                //console.log(data['uncheckDate']);
                if(data['uncheckDate'].length > 0)
                {
                    uncheckDate = [];
                    for(i = 0; i < data['uncheckDate'].length; i++)
                    {
                        uncheckDate.push(data['uncheckDate'][i].date);
                    }
                }
               // console.log("------->><<>>"+uncheckDate);
                
                if(data['category'].length >0 || data['checkMealItemData'].length>0){

                  html+='<tr id="check123">';
                  var flag;
                  var clsname;
                  // DateValue =  $('.dateHeader').text();
                  // DateValue1 = DateValue.match(/.{1,10}/g);
                 //  console.log("gdhfghkjl;k");
                    
                  for(a=1;a<=5;a++)
                   {
                      
                      if(flag == 0)
                      {
                          clsname = "alt";
                          flag = 1;
                      }
                      else
                      {
                           clsname = "";
                          flag = 0;
                      }
                   html+='<td  style="width:20%" class="totalcheckbox'+a+' dynamicDates diffBorder'+clsname+'">\n\
           <div class="calendarIcon" style="display:none"><img src="<?php echo base_url(); ?>application/images/cal-icon.png" alt="calendarIcon"><span class="datePosition">'+a+'</span></div>';
                   $("#myTabContent").html("");
                   
                   
                     //html+='<hr>';
                      var flag123 = 0;
                      for(m=0;m<data['checkMealItemData'].length;m++)
                      {
                          
                        if((data['checkMealItemData'][m].date === DateValue1[a-1]))
                       {
                          let checked = " ";
                           for(o=0;o<data['selectMealItemDataChild'].length;o++)
                           {
                // console.log("dtyfhyjguykilo");
                             var itemDate = data['selectMealItemDataChild'][o].date;
                           //  console.log(itemDate);


                           //  var d=itemDate.split("-").reverse().join("-");
                            if((data['selectMealItemDataChild'][o].mealid === data['checkMealItemData'][m].mealid)  && ( itemDate=== DateValue1[a-1]) )
                            {
                                 
                                   checked = "checked";
                                   flag123 = 1;

                            }

                           }


                        html+='<table>'
                       html+='<tr><td class="dynamicMenu"><label class="field option block"><input type="checkbox" class="menuID cc meal'+a+' radiocheck'+a+'" name="mobileos" value='+data['checkMealItemData'][m]['mealid']+' '+checked+'><span class="checkbox"></span><span class="itemLunch"><h6>'+data['checkMealItemData'][m]['meal']+'</h6></span><span class="itemLunch" style="text-align:right;display:inline;"><h6 style="float:right; color:#f03063 !important;">$ '+data['checkMealItemData'][m]['price']+'</h6></span></label>';
                        for(n=0;n<data['checkMealItemData'][m]['item'].length;n++)
                         { 
                            
                           
                            html+='<label class="option block"><input style="display:none;" type="checkbox" name="mobileos" value="FR"><span style="display:none;" class="checkbox"></span><span class="itemLunch">'+data['checkMealItemData'][m]['item'][n]+'</span></label><div class="priceTag"><div class="productIcon"><img src="'+data['checkMealItemData'][m].image[n]+'" alt=""></div></div>'  
                               
                               // "<div class="priceTag"><p>$ '+data['checkMealItemData'][m]['price'][n]+'</p></div>"           

                          }
                        
                         html+='</td></tr>';
                         html+='</table>';
                         }                                              
                         else{
                           //  console.log($this);
                                $(this).addClass('ranbir');
                                  $(".dynamicDates").html('');
                                  // html+='<h5>No Menu Available</h5>';
                                  // $(".dynamicDates").html('<h5>No Menu Available</h5>');
                                 // $("#myTabContent").append(html);
                               
                         }


           
                      }
                   
                   
                   var flag = 0;
                   for(k=0;k<data['category'].length;k++)
                   {
                       if((data['category'][k].date === DateValue1[a-1]))
                       {
                        html+='<table>'
                     html+='<tr><td class="dynamicCategory"><input type="hidden" name="categoryName[]" class="categoryID" value="'+data['category'][k].categoryid+'"/><h6>'+data['category'][k].category+'</h6>';
                   
                     for(i=0;i<data['checkCategoryItemData'].length;i++)
                      {
                   
                        
                             let checked = " ";
                             let checked223 = '';
                             for(j=0;j<data['selectCategoryItemDataChild'].length;j++)
                              {
                          
                              var itemDate = data['selectCategoryItemDataChild'][j].date;
        

                                if((data['checkCategoryItemData'][i].itemid === data['selectCategoryItemDataChild'][j].itemid) && (data['checkCategoryItemData'][i].categoryid === data['category'][k].categoryid) && (itemDate === DateValue1[a-1]) )
                                     { 
                                           //checked = "checked";
                                           checked223 = "checked"
                                           flag = 1;

                                      }
                              
                              
                               } 
                             //checked = "checked";
                         if((data['checkCategoryItemData'][i].categoryid  === data['category'][k].categoryid) && (data['checkCategoryItemData'][i].date === DateValue1[a-1]) )
                         {
                            if(data['checkCategoryItemData'][i].price !=0)
                            {
                                 prrice='<p>$ '+data['checkCategoryItemData'][i].price+'</p>';
                            }
                            else
                            {
                                prrice='';
                            }
                           if(data['category'][k].category === 'Sides')
                           {
                               //alert('fd');
                              // if(checked !="checked")
                              // {
                                //   html+='<label class="option block"><input type="checkbox" class="itemID radiocheck'+a+'" name="categoryItem[]" value='+data['checkCategoryItemData'][i].itemid+' '+checked+' disabled><span class="checkbox"></span><span class="itemLunch">'+data['checkCategoryItemData'][i].item+'</span></label><div class="priceTag">'+prrice+'<div class="productIcon "><img src="'+data['checkCategoryItemData'][i].image+'" alt=""></div></div>';  

                           //    }
                             //  else
                              // {
                                  html+='<label class="option block"><input type="checkbox" class="itemID sides'+a+' radiocheck'+a+'" name="categoryItem[]" value='+data['checkCategoryItemData'][i].itemid+' '+checked223+' disabled><span class="checkbox"></span><span class="itemLunch">'+data['checkCategoryItemData'][i].item+'</span></label><div class="priceTag">'+prrice+'<div class="productIcon "><img src="'+data['checkCategoryItemData'][i].image+'" alt=""></div></div>';  

                              // }

                           }
                           else if(data['category'][k].category === 'Drinks')
                           {
                               //alert('fd');
                                html+='<label class="option block"><input type="checkbox" class="itemID cc drink ddrriik'+a+' radiocheck'+a+'" name="categoryItem[]" value='+data['checkCategoryItemData'][i].itemid+' '+checked223+' ><span class="checkbox"></span><span class="itemLunch">'+data['checkCategoryItemData'][i].item+'</span></label><div class="priceTag">'+prrice+'<div class="productIcon "><img src="'+data['checkCategoryItemData'][i].image+'" alt=""></div></div>';  
                                //html+='<input type="checkbox" class="itemID cc radiocheck" name="categoryItem[]" value='' checked disabled>';  

                           }
                           else
                           {
                                html+='<label class="option block"><input type="checkbox" class="itemID cc radiocheck'+a+'" name="categoryItem[]" value='+data['checkCategoryItemData'][i].itemid+' '+checked+' ><span class="checkbox"></span><span class="itemLunch">'+data['checkCategoryItemData'][i].item+'</span></label><div class="priceTag">'+prrice+'<div class="productIcon "><img src="'+data['checkCategoryItemData'][i].image+'" alt=""></div></div>';  

                           }
                         }
                    
                       // html+='<label class="option block"><input type="checkbox" class="itemID cc radiocheck" name="categoryItem[]" value='' checked disabled><span class="checkbox"></span><span class="itemLunch">abc</span></label><div class="priceTag">123</div>';  

                             
                      }  



                         html+='</td></tr>';
                         html+='</table>';
                       }
                       
                    
                    }
                    
                    var checked1 = '';
                   // if(flag != 1 || flag123 !=1)
                    if(flag != 1 && flag123 !=1)
                    {
                        checked1 = "checked";
                        //checked1 = "";
                    }
             
             
                      html+='<table class="noselectiontab">\n\
                            <tbody>\n\
                                <tr>\n\
                                    <td class="dynamicMenu dynamicMenuNoSel">\n\
                                         <label class="field option block">\n\
                                        <input type="hidden" name="categoryName[]" class="categoryName" value="0">\n\
                                           <input type="checkbox" class="menuID cc dp noselection'+a+'" name="mobileos" value="0" '+checked1+'>\n\
                                                    <span class="checkbox"></span>\n\
\n\                                                 <span class="itemLunch">\n\
                                                    <h6>NO Lunch</h6><\spam>\n\
                                                </label>\n\
                                    </td></tr></tbody></table>';
//                    html+='<table>\n\
//                            <tbody>\n\
//                                <tr>\n\
//                                    <td class="dynamicCategory">\n\
//                                        <input type="hidden" name="categoryName[]" class="categoryName" value="0">\n\
//                                            <label class="option block">\n\
//                                            <input type="checkbox" class="itemID" name="categoryItem[]" value="0" '+checked1+'>\n\
//                                                    <span class="checkbox"></span>\n\
//                                                    <h6>NO Selection</h6>\n\
//                                                </label>\n\
//                                    </td></tr></tbody></table>';
               
                                   


                   
                                         
                     html+='</td>';

                   }

               
                   html+='</tr>';
                  
                     $("#myTabContent").append(html);
                   //  $("#noitem").html('');
                     $(".btnsave").removeAttr( 'style' );;
                   }
                   else
                   { 
                    $("#myTabContent").html('');
                      html+='<td class="" colspan="5"><h5 style="text-align: center;">No Menu Available</h5></td>';
                       $("#myTabContent").append(html);
                      // $("#noitem").html('');
                       $(".btnsave").css({"display":"none"});
                      

                   }
                   
                   
                   
                   
                  
                if($('#milkdropdownid').val()!=''){
                    call_milk($('#milkdropdownid').val(), uncheckDate);
                }
                   
                   
                   
                   
                   
                 },
                error: function () {
                           alert("Some error occured");
                  
                }
            });
       }

   

   $('.btnsave').click(function(){
   
   // if nothing is selected it will select no-select checkbox
   var trcheckpointer = $('#check123'); 
   trcheckpointer.find('td.dynamicDates').each(function(index, value){
       //alert(index);
      var ddate =  $(this).parent().parent().parent().find('th:nth-child('+(index + 1)+')').html() ;

       var prev = $(this);
       var checboxlength = prev.find('input.cc').length;
       var c = 0;
       prev.find('input.cc').each(function(index, value){
            //c++;
            if($(this).is(':checked'))
            {
               
            }else{
                 c++;
            }
           
       }); 
       
      // console.log(c); exit;
       //console.log(checboxlength); exit;
       if(c == checboxlength)
       {
            //prev.find('input.dp').prop('checked', true);
            bootbox.alert({
                            message: "Please select atleast one item on " +ddate,
                        });
                        exit;
           
       }  
   });
   
   if($('#milktype').val() == '0')
   {
        bootbox.alert({
                            message: "Please select Milk Type"
                        });
                        exit;
   }
   
   //end
    var categories = [];
    var ItemArray = [];
    var MealId =[];
    var i,j,k,DateValue,DateValue1=[];
    var selectedChild = $(".childId option:selected").val();
         // console.log($('.dynamicCategory').length);
    var DateLength =  $('.dateHeader').length;
   
                DateValue =  $('.dateHeader').text();
                DateValue1 = DateValue.match(/.{1,10}/g);
               // alert(DateValue1);
               // console.log(DateValue1);
                $('.dynamicDates').each(function(index, value){
                var ItemData = [];
                var arrMeal=[];
                var Mealdata =[];
                $(this).find('.dynamicCategory').each(function(index, value){
                              
                                var this_old = $(this);
                              
                                var CategoryID = this_old.find('.categoryID').val();
                                var arryItem = [];
                                $(this).find('.itemID').each(function(index, value){

                                 if($(this).is(":checked")){

                                  var index_val=$(this).parent().parent().parent().parent().parent().parent().index();

                                  var date_val=$('.dateHeader:eq('+index_val+')').text();
                                    //console.log(date_val);
                                    arryItem.push([$(this).val(), date_val]);
                                  }else{

                                  }
                              });

                        
                               if(arryItem.length > 0)
                               {
                                  ItemData.push({
                                    CategoryID, arryItem, selectedChild
                                  });
                               }  
                         
                               
                });

                $(this).find('.dynamicMenu').each(function(index,value){

                        var mealItem =[];
                     $(this).find('.menuID').each(function(index, value){
                        if($(this).is(":checked")){

                          var index_val=$(this).parent().parent().parent().parent().parent().parent().index();

                                  var date_val=$('.dateHeader:eq('+index_val+')').text();
                                 //  console.log(date_val);
                             mealItem.push([$(this).val(), date_val]);
                           }else{

                                  }
                              });

                      if(mealItem.length > 0)
                               {
                                  Mealdata.push({
                                    mealItem,selectedChild
                                  });
                               } 
                });

              if(ItemData.length> 0)
                {
                  ItemArray.push({ItemData});
                }
                
                if(Mealdata.length> 0)
                {
                  MealId.push({Mealdata});
                }
                
          
                   
          

           });
      // $('#loading-image').show();
       // var flagval = $('#chkboxallchildren').val();
        var flagval = '0';
        var childIDS = '0';
        //var childIDS = $('#cciidd').val();
        //alert(flagval);
        //alert(childIDS); exit;
        //console.log(ItemArray); exit;

        $.ajax({

         type:'post',
         url:'<?php echo base_url(); ?>ChildMenuItemController/insertMenuMealitem',
        // url:'<?php //echo base_url(); ?>ChildMenuItemController/reportCheckout',
         data: {ItemArray : ItemArray,selectedChild:selectedChild,MealId:MealId, DateValue1:DateValue1, flagval:flagval, childIDS:childIDS},
         dataType:'json',
         beforeSend: function() {
                                   $("#loading-image").show();
                                },
         success: function (data) {
                    //alert(data);
                     $('#loading-image').hide();
                   
                    if (data.success)
                    {
                       // alert(data.fdate);
                       //  alert(data.tdate);
                        
                       // $msg['noselectionflag'] 
                        if(data.noselectionflag)
                        {
                                bootbox.alert({

                                message: "No menu item has been selected.",
                                callback: function () {
                                    console.log(DateValue1);
                                   location.href = '<?php echo base_url(); ?>ChildMenuItemController/reportCheckout/'+data.fdate+'/'+data.tdate+'/'+data.selectedChild;
                                }
                            });
                        }
                        else
                        {
                                bootbox.alert({

                                message: "Menu items has been assigned sucessfully.",
                                callback: function () {
                                    console.log(DateValue1);
                                   location.href = '<?php echo base_url(); ?>ChildMenuItemController/reportCheckout/'+data.fdate+'/'+data.tdate+'/'+data.selectedChild;
                                }
                            });
                        }
                        
                        
                        
                    }
                    else
                    {
                        $('#loading-image').hide();
                        bootbox.alert({
                            message: "Same Data Already Exit!",
                            callback: function () {
                                //location.href = '<?php //echo base_url() ?>menuitemsel';
                            }
                        })
                    }
                },
                error: function () {
                      $('#loading-image').hide();
                    bootbox.alert({
                        message: "Could not get Data from Database",
                        callback: function () {

                        }
                    })
                }

        });

       });
      
   $('.fwdArrow').click(function(){
    
  // if nothing is selected it will select no-select checkbox
   var trcheckpointer = $('#check123'); 
   trcheckpointer.find('td.dynamicDates').each(function(index, value){
       //alert(index);
      var ddate =  $(this).parent().parent().parent().find('th:nth-child('+(index + 1)+')').html() ;

       var prev = $(this);
       var checboxlength = prev.find('input.cc').length;
       var c = 0;
       prev.find('input.cc').each(function(index, value){
            //c++;
            if($(this).is(':checked'))
            {
               
            }else{
                 c++;
            }
           
       }); 
       
      // console.log(c); exit;
       //console.log(checboxlength); exit;
       if(c == checboxlength)
       {
            //prev.find('input.dp').prop('checked', true);
            bootbox.alert({
                            message: "Please select atleast one item on " +ddate,
                        });
                        exit;
           
       }  
   });
   
   if($('#milktype').val() == '0')
   {
      
        bootbox.alert({
                         message: "Please select Milk Type"
                     });
                     exit;
  
        
   }
   
   
   
   //end
   
    
     //hreflinkcal
     hreflinkcal = $(this).parent().parent().find('input.hreflinkcal').val();
     //alert(hreflinkcal);
     //exit;
    
     
    
     
    var categories = [];
    var ItemArray = [];
    var MealId =[];
    var i,j,k,DateValue,DateValue1=[];
    var selectedChild = $(".childId option:selected").val();
         // console.log($('.dynamicCategory').length);
    var DateLength =  $('.dateHeader').length;
   
                DateValue =  $('.dateHeader').text();
                DateValue1 = DateValue.match(/.{1,10}/g);
               // console.log(DateValue1);
                $('.dynamicDates').each(function(index, value){
                var ItemData = [];
                var arrMeal=[];
                var Mealdata =[];
                $(this).find('.dynamicCategory').each(function(index, value){
                              
                                var this_old = $(this);
                              
                                var CategoryID = this_old.find('.categoryID').val();
                                var arryItem = [];
                                $(this).find('.itemID').each(function(index, value){

                                 if($(this).is(":checked")){

                                  var index_val=$(this).parent().parent().parent().parent().parent().parent().index();

                                  var date_val=$('.dateHeader:eq('+index_val+')').text();
                                    //console.log(date_val);
                                    arryItem.push([$(this).val(), date_val]);
                                  }else{

                                  }
                              });

                        
                               if(arryItem.length > 0)
                               {
                                  ItemData.push({
                                    CategoryID, arryItem, selectedChild
                                  });
                               }  
                         
                               
                });

                $(this).find('.dynamicMenu').each(function(index,value){

                        var mealItem =[];
                     $(this).find('.menuID').each(function(index, value){
                        if($(this).is(":checked")){

                          var index_val=$(this).parent().parent().parent().parent().parent().parent().index();

                                  var date_val=$('.dateHeader:eq('+index_val+')').text();
                                 //  console.log(date_val);
                             mealItem.push([$(this).val(), date_val]);
                           }else{

                                  }
                              });

                      if(mealItem.length > 0)
                               {
                                  Mealdata.push({
                                    mealItem,selectedChild
                                  });
                               } 
                });

              if(ItemData.length> 0)
                {
                  ItemArray.push({ItemData});
                }
                
                if(Mealdata.length> 0)
                {
                  MealId.push({Mealdata});
                }

          
                   
          

           });
        // $('#loading-image').show();
        // var flagval = $('#chkboxallchildren').val();
        var flagval = '0';
        var childIDS = '0';
        //var childIDS = $('#cciidd').val();
        //alert(flagval);
        //alert(childIDS); exit;
        //console.log(ItemArray); exit;
        
        $.ajax({

         type:'post',
         url:'<?php echo base_url(); ?>ChildMenuItemController/insertMenuMealitemFWD',
        // url:'<?php //echo base_url(); ?>ChildMenuItemController/reportCheckout',
         data: {ItemArray : ItemArray,selectedChild:selectedChild,MealId:MealId, DateValue1:DateValue1},
         dataType:'html',
         beforeSend: function() {
                            $("#loading-image").show();        
        },
        success: function (data) {
                    $('#loading-image').hide();
                    location.href = hreflinkcal;
        },
        error: function (data) {
                   
                    $('#loading-image').hide();
                    bootbox.alert({
                        message: "Could not get Data from Database",
                        callback: function () {
                           //  location.href = hreflinkcal
                        }
                    })
        }

        });

       });
       
    
    // for click on any meal all sides will check by default and remove milk section element.
       
    $(document).on('click', '.meal1', function(){
               var flag = 1;
        var meallength = $('.meal1').length;
        var c = 0;
        $('.meal1').each(function(index, value){
            if ($(this).is(":checked")) 
            {

            } 
            else 
            {
               flag = 0;
                c++;

            }
        });

        if(flag === 0 && c === meallength)
        {
              $(this).parent().parent().parent().parent().parent().parent().find('input.sides1').prop('checked', false);
              //$(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk1').prop('checked', false);
              //$(this).parent().parent().parent().parent().parent().parent().find('input.extramilk1').prop('checked', false);
        }
        else
        {
            $(this).parent().parent().parent().parent().parent().parent().find('input.sides1').prop('checked', true);
            
            var len = $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk1').length;
            
            if(len === 0)
            {
                 if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik1').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik1').prop('checked', true);
                 }
               
            }
            else
            {
                if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik1').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk1').prop('checked', true);
                 }
                
                
                

            }
            
        }
        //alert('meal1');
        //$(this).parent().parent().parent().parent().parent().parent().find('input.sides1').prop('checked', true);
       // $(this).parent().parent().parent().parent().parent().parent().find('table.milklabel').remove();
      //  $(this).parent().parent().parent().parent().parent().parent().find('input.drink').parent().parent().parent().parent().parent().remove();
       // $('#milktype').prop('selectedIndex',0);
    });  
    
    $(document).on('click', '.meal2', function(){
               var flag = 1;
        var meallength = $('.meal2').length;
        var c = 0;
        $('.meal2').each(function(index, value){
            if ($(this).is(":checked")) 
            {

            } 
            else 
            {
               flag = 0;
                c++;

            }
        });

        if(flag === 0 && c === meallength)
        {
              $(this).parent().parent().parent().parent().parent().parent().find('input.sides2').prop('checked', false);
        }
        else
        {
            $(this).parent().parent().parent().parent().parent().parent().find('input.sides2').prop('checked', true);
            var len = $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk2').length;
            
            if(len === 0)
            {
                 if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik2').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik2').prop('checked', true);
                 }
               
            }
            else
            {
                if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik2').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk2').prop('checked', true);
                 }
            }
        }

    }); 
    
    $(document).on('click', '.meal3', function(){

                var flag = 1;
        var meallength = $('.meal3').length;
        var c = 0;
        $('.meal3').each(function(index, value){
            if ($(this).is(":checked")) 
            {

            } 
            else 
            {
               flag = 0;
                c++;

            }
        });

        if(flag === 0 && c === meallength)
        {
              $(this).parent().parent().parent().parent().parent().parent().find('input.sides3').prop('checked', false);
        }
        else
        {
            $(this).parent().parent().parent().parent().parent().parent().find('input.sides3').prop('checked', true);
            var len = $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk3').length;
            
            if(len === 0)
            {
                 if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik3').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik3').prop('checked', true);
                 }
               
            }
            else
            {
                if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik3').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk3').prop('checked', true);
                 }
            }
        }
    //alert('meal1');
    //$(this).parent().parent().parent().parent().parent().parent().find('input.sides3').prop('checked', true);
   // $(this).parent().parent().parent().parent().parent().parent().find('table.milklabel').remove();
   // $(this).parent().parent().parent().parent().parent().parent().find('input.drink').parent().parent().parent().parent().parent().remove();
   // $('#milktype').prop('selectedIndex',0);
    }); 
    
    $(document).on('click', '.meal4', function(){
        var flag = 1;
        var meallength = $('.meal4').length;
        var c = 0;
        $('.meal4').each(function(index, value){
            if ($(this).is(":checked")) 
            {

            } 
            else 
            {
               flag = 0;
                c++;

            }
        });

        if(flag === 0 && c === meallength)
        {
              $(this).parent().parent().parent().parent().parent().parent().find('input.sides4').prop('checked', false);
        }
        else
        {
            $(this).parent().parent().parent().parent().parent().parent().find('input.sides4').prop('checked', true);
            var len = $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk4').length;
            
            if(len === 0)
            {
                 if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik4').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik4').prop('checked', true);
                 }
               
            }
            else
            {
                if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik4').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk4').prop('checked', true);
                 }
            }
        }

    //alert('meal1');
    //$(this).parent().parent().parent().parent().parent().parent().find('input.sides4').prop('checked', true);
  //  $(this).parent().parent().parent().parent().parent().parent().find('table.milklabel').remove();
   // $(this).parent().parent().parent().parent().parent().parent().find('input.drink').parent().parent().parent().parent().parent().remove();
  //  $('#milktype').prop('selectedIndex',0);
    
    
    });
    
    $(document).on('click', '.meal5', function(){


        var flag = 1;
        var meallength = $('.meal5').length;
        var c = 0;
        $('.meal5').each(function(index, value){
            if ($(this).is(":checked")) 
            {

            } 
            else 
            {
               flag = 0;
                c++;

            }
        });

        if(flag === 0 && c === meallength)
        {
              $(this).parent().parent().parent().parent().parent().parent().find('input.sides5').prop('checked', false);
        }
        else
        {
            $(this).parent().parent().parent().parent().parent().parent().find('input.sides5').prop('checked', true);
            var len = $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk5').length;
            
            if(len === 0)
            {
                 if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik5').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik5').prop('checked', true);
                 }
               
            }
            else
            {
                if($(this).parent().parent().parent().parent().parent().parent().find('input.ddrriik5').is(':checked'))
                 {
                     
                 }
                 else
                 {
                    $(this).parent().parent().parent().parent().parent().parent().find('input.ddownmilk5').prop('checked', true);
                 }
            }
        }
    
    
    
   
    //$(this).parent().parent().parent().parent().parent().parent().find('input.sides5').prop('checked', true);
  //  $(this).parent().parent().parent().parent().parent().parent().find('table.milklabel').remove();
   // $(this).parent().parent().parent().parent().parent().parent().find('input.drink').parent().parent().parent().parent().parent().remove();
  //  $('#milktype').prop('selectedIndex',0);
    
    
    }); 
    
    // END
       
    // for juice and drink   
       
    $(document).on('click', '.addondrink', function(){
            //$('.radiocheck1').prop('checked', false);
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        if($(this).is(':checked') == false)
        {
            $(this).parent().parent().find('input.extrajuice5').prop('checked', false);
        } 

                //prev.find('input.drink').prop('checked', false);

    });
    
    $(document).on('click', '.extrajuice5', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        
        if($(this).is(':checked') == true)
        {
            $(this).parent().parent().find('input.addondrink').prop('checked', true);
        }
        
    });   
        
     $(document).on('click', '.ddrriik5', function(){
            //$('.radiocheck1').prop('checked', false);
         $(this).parent().parent().parent().parent().parent().parent().find('input.addondrink').prop('checked', false);

                //prev.find('input.drink').prop('checked', false);
//milkonly'+counter+'
    });
    
    // end
    
    // milk work check uncheck
    
    $(document).on('click', '.milkonly1', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        
        if($(this).is(':checked') == false)
        {
            $(this).parent().parent().find('input.extramilk1').prop('checked', false);
        }
        
    });
    
    $(document).on('click', '.extramilk1', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        
        if($(this).is(':checked') == true)
        {
            $(this).parent().parent().find('input.milkonly1').prop('checked', true);
        }
        
    });
    
    $(document).on('click', '.ddrriik1', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.milkonly1').prop('checked', false);
    });
    
    $(document).on('click', '.milkonly2', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        if($(this).is(':checked') == false)
        {
            $(this).parent().parent().find('input.extramilk2').prop('checked', false);
        }
    });
    
    $(document).on('click', '.extramilk2', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        
        if($(this).is(':checked') == true)
        {
            $(this).parent().parent().find('input.milkonly2').prop('checked', true);
        }
        
    });
    
    $(document).on('click', '.ddrriik2', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.milkonly2').prop('checked', false);
    });
    
    $(document).on('click', '.milkonly3', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        if($(this).is(':checked') == false)
        {
            $(this).parent().parent().find('input.extramilk3').prop('checked', false);
        }
    });
    
    $(document).on('click', '.extramilk3', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        
        if($(this).is(':checked') == true)
        {
            $(this).parent().parent().find('input.milkonly3').prop('checked', true);
        }
        
    });
    
    $(document).on('click', '.ddrriik3', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.milkonly3').prop('checked', false);
    });
    
    $(document).on('click', '.milkonly4', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        if($(this).is(':checked') == false)
        {
            $(this).parent().parent().find('input.extramilk4').prop('checked', false);
        }
    });
    
    $(document).on('click', '.extramilk4', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        
        if($(this).is(':checked') == true)
        {
            $(this).parent().parent().find('input.milkonly4').prop('checked', true);
        }
        
    });
    
    $(document).on('click', '.ddrriik4', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.milkonly4').prop('checked', false);
    });
    
     $(document).on('click', '.milkonly5', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        if($(this).is(':checked') == false)
        {
            $(this).parent().parent().find('input.extramilk5').prop('checked', false);
        }
    });
    
    $(document).on('click', '.extramilk5', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.drink').prop('checked', false);
        
        if($(this).is(':checked') == true)
        {
            $(this).parent().parent().find('input.milkonly5').prop('checked', true);
        }
        
    });
    
    $(document).on('click', '.ddrriik5', function(){
        $(this).parent().parent().parent().parent().parent().parent().find('input.milkonly5').prop('checked', false);
    });
    
    //END
    
         
    //for checkuncheck on no-item selection and item-selection for first COLUMN
   $(document).on('click', '.radiocheck1', function(){
        var pointer = $('.totalcheckbox1');
        var checboxlength = pointer.find('.radiocheck1').length;
        var c = 0;
        pointer.find('.radiocheck1').each(function(index, value){
            if($(this).is(':checked') == false)
            {
                c++;
            }
                 
        });
        
        if(c == checboxlength)
        {
             $('.noselection1').prop('checked', true);
        }
        else
        {
            $('.noselection1').prop('checked', false);
        }
    });  
   
    $(document).on('click', '.noselection1', function(){
         $('.radiocheck1').prop('checked', false);
    });   
     // END
   
    //for checkuncheck on no-item selection and item-selection for first COLUMN
   $(document).on('click', '.radiocheck2', function(){
        var pointer = $('.totalcheckbox2');
        var checboxlength = pointer.find('.radiocheck2').length;
        var c = 0;
        pointer.find('.radiocheck2').each(function(index, value){
            if($(this).is(':checked') == false)
            {
                c++;
            }
                 
        });
        
        if(c == checboxlength)
        {
             $('.noselection2').prop('checked', true);
        }
        else
        {
            $('.noselection2').prop('checked', false);
        }
    });  
   
    $(document).on('click', '.noselection2', function(){
         $('.radiocheck2').prop('checked', false);
    });   
     // END
     
      //for checkuncheck on no-item selection and item-selection for first COLUMN
   $(document).on('click', '.radiocheck3', function(){
        var pointer = $('.totalcheckbox3');
        var checboxlength = pointer.find('.radiocheck3').length;
        var c = 0;
        pointer.find('.radiocheck3').each(function(index, value){
            if($(this).is(':checked') == false)
            {
                c++;
            }
                 
        });
        
        if(c == checboxlength)
        {
             $('.noselection3').prop('checked', true);
        }
        else
        {
            $('.noselection3').prop('checked', false);
        }
    });  
   
    $(document).on('click', '.noselection3', function(){
         $('.radiocheck3').prop('checked', false);
    });   
     // END
     
      //for checkuncheck on no-item selection and item-selection for first COLUMN
   $(document).on('click', '.radiocheck4', function(){
        var pointer = $('.totalcheckbox4');
        var checboxlength = pointer.find('.radiocheck4').length;
        var c = 0;
        pointer.find('.radiocheck4').each(function(index, value){
            if($(this).is(':checked') == false)
            {
                c++;
            }
                 
        });
        
        if(c == checboxlength)
        {
             $('.noselection4').prop('checked', true);
        }
        else
        {
            $('.noselection4').prop('checked', false);
        }
    });  
   
    $(document).on('click', '.noselection4', function(){
         $('.radiocheck4').prop('checked', false);
    });   
     // END
     
      //for checkuncheck on no-item selection and item-selection for first COLUMN
   $(document).on('click', '.radiocheck5', function(){
        var pointer = $('.totalcheckbox5');
        var checboxlength = pointer.find('.radiocheck5').length;
        var c = 0;
        pointer.find('.radiocheck5').each(function(index, value){
            if($(this).is(':checked') == false)
            {
                c++;
            }
                 
        });
        
        if(c == checboxlength)
        {
             $('.noselection5').prop('checked', true);
        }
        else
        {
            $('.noselection5').prop('checked', false);
        }
    });  
   
    $(document).on('click', '.noselection5', function(){
         $('.radiocheck5').prop('checked', false);
    });   
     // END
    
    $(document).on('change', '#chkboxallchildren', function(){
       
         
           if($(this).is(":checked")) 
           {
              
               $(this).val(1);
           } 
           else 
           {
                 $(this).val(0);
           }
         
         
    }); 
    
   
    var today = new Date();
    var dd = today.getDate();

    var mm = today.getMonth()+1; 
    var yyyy = today.getFullYear();
    if(dd<10) 
    {
        dd='0'+dd;
    } 

    if(mm<10) 
    {
        mm='0'+mm;
    } 
    today = yyyy+'-'+mm+'-'+dd;
   // console.log(today);
    
    $(".btnsave").attr('disabled',true);
    
    $('.dateHeader').each(function(index, value){
            console.log(value.innerHTML);
            if(today <= value.innerHTML)
            {
                //alert(today);
                $(".btnsave").attr('disabled',false);
                return false; 
            }
            else
            {
               // alert('HI');
               // $(".btnsave").attr('disabled',true);
                //return false; 
            }
           
        });
        
        
        
        
     
        
        
        
        
        
    $(document).on('change', '#milktype', function(){
       
      
      
        var url='';
        var weekvalue = $('#weekvalue').val();
        var yearvalue = $('#yearvalue').val();
        var baseurl = $('#baseurl').val();
        var childID = $('#interval').val();
        var milkID =  $(this).val();
     
      
        if($('.farrow').length === 1)
        {
          url = baseurl+'index.php/menusel/index?week='+(parseInt(weekvalue)+1)+'&year='+yearvalue+'&childID='+childID+'&milkid='+milkID;
          $(".farrow").val(url);
        }
        
        if($('.barrow').length === 1)
        {
            url = baseurl+'index.php/menusel/index?week='+(parseInt(weekvalue)-1)+'&year='+yearvalue+'&childID='+childID+'&milkid='+milkID;
            $(".barrow").val(url);
        }  
       
       
       
       
    
       
        var i, day1, day2, day3, day4, day5;
        var restDate = $('#restrictredDate').val();
        restDate=restDate.split(",");
        var milkID = $(this).val();
        var milkName = $("option:selected",this).text();
        var  date_11_12_2018 = '23356';
      
        $('.dynamicDates').each(function(index, value){
            var prev = $(this);
            var flag = 0;  
         
            if(index == 0)
            {
              day1 = prev.parent().parent().parent().find('thead').find('th.header1').text();
              day2 = prev.parent().parent().parent().find('thead').find('th.header2').text();
              day3 = prev.parent().parent().parent().find('thead').find('th.header3').text();
              day4 = prev.parent().parent().parent().find('thead').find('th.header4').text();
              day5 = prev.parent().parent().parent().find('thead').find('th.header5').text();

             // alert(day1); alert(day2); alert(day3); alert(day4); alert(day5);
             // 2018-12-102018-12-112018-12-122018-12-132018-12-14
            } 

            if(index < 5)
            {

              if(index == 0)
              {
                  date_11_12_2018 = day1;
              } 
              if(index == 1)
              {
                  date_11_12_2018 = day2;
              } 
              if(index == 2)
              {
                  date_11_12_2018 = day3;
              } 
              if(index == 3)
              {
                  date_11_12_2018 = day4;
              } 
              if(index == 4)
              {
                  date_11_12_2018 = day5;
              } 

             // for(i = 0; i< restDate.length; i++)
             // {
                //  if( date_11_12_2018 != restDate[i]  )
                  if(jQuery.inArray(date_11_12_2018, restDate) == -1)
                  {

                      var counter = index +1;
                      $(this).find('.dynamicMenu').each(function(index, value){
                          $(this).find('.menuID').each(function(index, value){
                             if($(this).is(':checked') == true)
                              {
                                 flag = 1;
                                 // console.log('nahi banega');
                                 return false;
                              }
                          });
                      });

                      if(flag === 0 || flag === 1)
                      {
                         // console.log('banega');
                          prev.find('.dynamicMenuNoSel').each(function(index, value){
                              var prev1 = $(this);
                              var ck =  $(this).children('h6').text();
                              prev1.find('.itemID').each(function(index, value){
                                  //alert($(this).val());
                                  var itmid = $(this).val();
                                  if(itmid == milkID)
                                  {
                                        //$(this).prop('checked', true);
                                  }
                                  else
                                  {
                                     // $(this).prop('checked', false);
                                  }
                               });
                              var side= '.sides'+counter;
                              var noselections = '.noselection'+counter;
                              //prev.find('input'+side).prop('checked', false);
                              prev.find('input'+noselections).prop('checked', false);
                              prev.find('table.milklabel').remove();

                              prev.find('input.drink').prop('checked', false);
                              prev.find('table.noselectiontab').before('<table class="milklabel"><tbody><tr><td class="dynamicCategory"><input type="hidden" name="categoryName[]" class="categoryID" value="3"><h6>Add on Milk</h6><label class="option block"><input type="checkbox" class="itemID cc milkonly'+counter+' radiocheck'+counter+' ddownmilk'+counter+'" name="categoryItem[]" value="'+milkID+'" checked><span class="checkbox"></span><span class="itemLunch">'+milkName+'</span></label><div class="priceTag"></div><label class="option block"><input type="checkbox" class="itemID cc extramilk'+counter+' milkonly'+counter+' radiocheck'+counter+'" name="categoryItem[]" value="1001"><span class="checkbox"></span><span class="itemLunch"> Extra Milk</span></label><div class="priceTag"><p>$ 0.50</p></div></td></tr></tbody></table>');



                          });  
                      }

                      if(milkID === '0')
                      {
                          var side= '.sides'+counter;
                          prev.find('input'+side).prop('checked', true);
                          prev.find('input.drink').prop('checked', true);
                          prev.find('table.milklabel').remove();
                      }
                 }
             // }
            }
        });
    });   
    
    $(document).on('change', '#drinktype', function(){
         var i, day5;
         var restDate = $('#restrictredDateJuice').val();
         restDate=restDate.split(",");
         var  date_11_12_2018 = '23356';
       //alert('DRINK');
        var drinkID = $(this).val();
        $('.dynamicDates').each(function(index, value){
          var prev = $(this);
          //var flag = 0;
          
         // alert(index);
         
        if(index == 0)
        {
          day5 = prev.parent().parent().parent().find('thead').find('th.header5').text();
        }
         
         
          
          if(index === 4)
          {
               
                date_11_12_2018 = day5;
                
                if(jQuery.inArray(date_11_12_2018, restDate) == -1)
                {
                    $(this).find('.dynamicMenu').each(function(index, value){
                    var prev1 = $(this);
                    //var ck =  $(this).find('h6').text();
                    //alert(ck); 
//                    var str1 = ck;
//                    var str2 = "Pizza";
//                    var str3 = "Hot Dog";
                    prev.find('table.drinklabel').remove();
                    
                    prev.find('input.drink').prop('checked', false);
                    prev.find('input.noselection5').prop('checked', false);
                    
                    if(drinkID === 'J')
                    {
                        //prev1.append('<label class="option block drinklabel"><input type="checkbox" class="itemID cc radiocheck1" name="categoryItem[]" value="J" checked><span class="checkbox"></span><span class="itemLunch">Juice</span></label>');
                        prev.find('table.noselectiontab').before('<table class="drinklabel"><tbody><tr><td class="dynamicCategory"><input type="hidden" name="categoryName[]" class="categoryID" value="3"><h6>Add on Drinks</h6><label class="option block"><input type="checkbox" class="itemID cc addondrink radiocheck5" name="categoryItem[]" value="999" checked><span class="checkbox"></span><span class="itemLunch">Juice </span></label><div class="priceTag"></div><label class="option block"><input type="checkbox" class="itemID cc addondrink extrajuice5 radiocheck5" name="categoryItem[]" value="1000"><span class="checkbox"></span><span class="itemLunch"> Extra Juice</span></label><div class="priceTag"><p>$ 0.50</p></div></td></tr></tbody></table>');

                    }
                    else if(drinkID === 'W')
                    {
                        //prev1.append('<label class="option block drinklabel"><input type="checkbox" class="itemID cc radiocheck1" name="categoryItem[]" value="W" checked><span class="checkbox"></span><span class="itemLunch">Water</span></label>');
                        prev.find('table.noselectiontab').before('<table class="drinklabel"><tbody><tr><td class="dynamicCategory"><input type="hidden" name="categoryName[]" class="categoryID" value="3"><h6>Add on Drinks</h6><label class="option block"><input type="checkbox" class="itemID cc addondrink radiocheck5" name="categoryItem[]" value="998" checked><span class="checkbox"></span><span class="itemLunch">Water </span></label><div class="priceTag"></div><label class="option block"><input type="checkbox" class="itemID cc addondrink extrajuice5 radiocheck5" name="categoryItem[]" value="1000"><span class="checkbox"></span><span class="itemLunch"> Extra Water</span></label><div class="priceTag"><p>$ 0.50</p></div></td></tr></tbody></table>');

                    }

                    //prev1.append('<label class="option block drinklabel"><input type="checkbox" class="itemID cc radiocheck1" name="categoryItem[]" value="EDrink"><span class="checkbox"></span><span class="itemLunch">Extra Drink</span></label><div class="priceTag drinkptag"><p>$ 0.50</p></div>');

                     //return false;


                   
                  

                //exit;
                });
                }
          }
        
        });
    });   
   
      
      
      
      
    $(document).on('change', '#interval', function(){
    
        //$('#milktype').prop('selectedIndex',0);
        //$('#drinktype').prop('selectedIndex',0);
        var url='';
        var weekvalue = $('#weekvalue').val();
        var yearvalue = $('#yearvalue').val();
        var baseurl = $('#baseurl').val();
        var childID = $(this).val();
        var milkID =  $('#milktype').val();
     
      
        if($('.farrow').length === 1)
        {
          url = baseurl+'index.php/menusel/index?week='+(parseInt(weekvalue)+1)+'&year='+yearvalue+'&childID='+childID+'&milkid='+milkID;
           $(".farrow").val(url);
        }
        
       if($('.barrow').length === 1)
       {
           url = baseurl+'index.php/menusel/index?week='+(parseInt(weekvalue)-1)+'&year='+yearvalue+'&childID='+childID+'&milkid='+milkID;
           $(".barrow").val(url);
       }
        
        
    });  
    
    
  
        
        

       
});






    

</script>

<div id="page-wrapper" style="min-height: 327px;">
    
    <?php 
            if($status == 1)
            { ?>
                
                <div class="row " style="display:show">
        <div class="col-lg-12">
            <div class="panel panel-default MT-30">
                <div class="panel-body">
                    <div class="form-group clearfix MB-0">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">* Please Select child name</label>
                                <div class="col-sm-8 smart-forms">
                                    <label class="field select">
                                        <select id ="interval" name="location1[]" class="form-control childId">
                                            <?php for ($i = 0; $i < count($child); $i++) { ?>
                                            <option value="<?php echo $child[$i]['id']; ?>" <?php if(isset($_REQUEST['childID'])){ if($_REQUEST['childID'] == $child[$i]['id']){ echo 'selected'; }} ?>><?php echo $child[$i]['first_name']; ?></option>

                                            <?php } ?>
                                        </select>
                                        <i class="arrow"></i>  
                                    </label>
                                    <?php for ($i = 0; $i < count($child); $i++) { ?>
                                        <input type="hidden" name = "grade[]" value="<?php echo $child[$i]['location']; ?>"  >
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <?php 
                            
                            $sqlrestDate = "select `restDates` from rest_date_cal where `status` = 1";
                            $resultrestDate = $this->db->query($sqlrestDate)->result_array();
                            $resDate = '';
                            for ($i = 0; $i < count($resultrestDate); $i++) 
                            {
                                $resDate .= $resultrestDate[$i]['restDates'].",";
                            }
                            $resDate = rtrim($resDate, ',');
                            
                            $sqlrestDate1 = "select `restDates` from rest_date_cal_Juice where `status` = 1";
                            $resultrestDate1 = $this->db->query($sqlrestDate1)->result_array();
                            $resDate1 = '';
                            for ($i = 0; $i < count($resultrestDate1); $i++) 
                            {
                                $resDate1 .= $resultrestDate1[$i]['restDates'].",";
                            }
                            $resDate1 = rtrim($resDate1, ',');
                            
                            
                            $sqlrestDate2 = "select `date` from child_menu_item_date_mapping where `status` = 1 and `child_id` =3649 and `parent_id`=".$parent_id." and `item_id`=0 and `meal_id`=0 and `category_id`=0 and `date` between '".$start_Date."' and '".$end_date."'";
                            $resultrestDate2 = $this->db->query($sqlrestDate2)->result_array();
                            $resDate2 = '';
                            for ($i = 0; $i < count($resultrestDate2); $i++) 
                            {
                                $resDate2 .= $resultrestDate2[$i]['date'].",";
                            }
                            $resDate2 = rtrim($resDate2, ',');
                           
                            //echo $resDate2; die;
                            
                            $sqldrink = "select id, item_name from item where item_name IN ('Chocolate milk', 'White milk') and status = 1";
                            $resultdrink = $this->db->query($sqldrink)->result_array();
                        
                        ?>
                         <input type="hidden" id = "restrictredDate" value="<?php echo $resDate; ?>">
                         <input type="hidden" id = "restrictredDateJuice" value="<?php echo $resDate1; ?>">
                         <input type="hidden" id = "weekvalue" value="<?php echo $_REQUEST['week']; ?>">
                         <input type="hidden" id = "yearvalue" value="<?php echo $_REQUEST['year']; ?>">
                         <input type="hidden" id = "noselectiondates" value="<?php echo $resDate2; ?>">
                         <input type="hidden" id = "baseurl" value="<?php echo base_url(); ?>">
                         <input type="hidden" id = "parentIDD" value="<?php echo $parent_id; ?>">
                         <input type="hidden" id = "startDate" value="<?php echo $start_Date; ?>">
                         <input type="hidden" id = "endDate" value="<?php echo $end_date; ?>">
                         <input type="hidden" id = "milkdropdownid" value="<?php  if(isset($_REQUEST['milkid'])){echo $_REQUEST['milkid'];}else{};  ?>">
                    
                         
                         <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">Milk Type:</label>
                                <div class="col-sm-8 smart-forms">
                                    <label class="field select">
                                        <select id="milktype" class="form-control">
                                           <option value="0">Please Select</option>
                                            <?php for ($i = 0; $i < count($resultdrink); $i++) { ?>
                                                <option value="<?php echo $resultdrink[$i]['id']; ?>"><?php echo $resultdrink[$i]['item_name']; ?></option>
                                            <?php } ?>
<!--                                          <option value="63">Chocolate Milk</option>
                                           <option value="64">White Milk</option>-->
                                        </select>
                                        <i class="arrow"></i> 
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                          <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">Drink Choice for Pizza/Hot Dog Lunch:</label>
                                <div class="col-sm-8 smart-forms">
                                    <label class="field select">
                                       <select id="drinktype"  class="form-control">
                                           <option value="0">Please Select</option>
                                           <option value="J">Juice</option>
                                           <option value="W">Water</option>
                                        </select>
                                        <i class="arrow"></i>  
                                    </label>
                                </div>
                            </div>
                        </div>
                        
<!--                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">Select all children</label>
                                <div class="col-sm-8 smart-forms">
                                        <label class="field option block">
                                            <input type="checkbox" class="radiocheck1" name="chkboxallchildren" id="chkboxallchildren" value="0" >
                                            <span class="checkbox"></span>
                                        </label>
                                    <?php  //$iddd = ''; 
                                        //for ($i = 0; $i < count($child); $i++) { 
                                          //          $iddd .= $child[$i]['id'].",";
                                       // } 
                                       // $iddd = rtrim($iddd,',');

                                        ?>
                                    <input type="hidden" id="cciidd" value="<?php// echo $iddd; ?>"  >
                                </div></div>
                        </div>-->
                        
                    </div>
                </div></div></div></div>

                <div class="row" style="display:show">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <!--   <div class="bootstrap-iso">
                                      <div class="container-fluid"> -->
                                <form class="form-horizontal" method="post" action="" >
                                    <section class="aboutGC">
                                        <div class= "">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="heading-custom text-center">
                                                        <?php
                                                        $dt = new DateTime;

                                                     //    $dt =  strtotime("12/01/2018");
                                                     // echo $dt; 

                                                       // $dt = "13-12-2018 23:45:52";
               //  $dt = DateTime::createFromFormat('d-m-Y H:i:s', $date)->format('Y-m-d h:i:s');

                                                    //   echo $dt; 
                                                      // die;
                                                        if (isset($_GET['year']) && isset($_GET['week'])) {
                                                            $dt->setISODate($_GET['year'], $_GET['week']);


                                                        } else {
                                                            $dt->setISODate('2018','49');
                                                        }
                                                        $year = $dt->format('o');
                                                        $week = $dt->format('W');


                                                        $dtate = trim($dt->format('Y-m-d'));
                                                        $timestamp = strtotime($dtate);
                                                        $day = date('l', $timestamp);                                                                                                                                                                                  /*<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year; ?>*/
                                                        ?>

                                                        <?php

                                                             $weekUrl =$_GET['week'];
                                                             $ddate = $start_Date;
                                                             $date = new DateTime($ddate);
                                                             $weekStart = $date->format("W");

                                                            //Priyam jugar week start

                                                             if($weekStart == 1)
                                                             {
                                                                 $weekStart = 2;
                                                             }
                                                            //  echo "Weeknummer: $week"; die;

                                                           //  echo $weekUrl; die;

                                                            $timestamp = strtotime($start_Date);
                                                            $day = date('l', $timestamp);

                                                          //  echo $day; die;

                                                           if($day == "Saturday" || $day == "Sunday")
                                                           {
                                                            $weekStart++;
                                                           }

                                                        //   echo $weekStart; 

                                                              $ddate1 = $end_date;
                                                              $date1 = new DateTime($ddate1);
                                                              $weekEnd = $date1->format("W");


                                                              // if($weekEnd == 01)
                                                              // {
                                                              //   // echo "hellooo";
                                                              //   $weekEnd = 52;
                                                              //  // echo $weekEnd; 
                                                              // }

                                                              if($weekUrl == 0)
                                                              {
                                                                $weekUrl = 52;
                                                              }

                                                              if($weekUrl == 53)
                                                              {
                                                                $weekUrl = 01;
                                                              }

                                                             // echo $weekEnd; die;
                                                              $cid='';
                                                           if (isset($_REQUEST['childID']))
                                                           {
                                                               $cid = "&childID=".$_REQUEST['childID'];
                                                           }



                                                         if($weekStart == $weekUrl)
                                                         { ?>
                                                                   <h2> Hot Lunch Menu <a class="directions-link" href="javascript:void(0)">
                                                                           <input type="hidden" class="hreflinkcal farrow" value="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year. $cid.'&milkid=""'; ?>" />
                                                          <span class="toggeleIconRight"> <i class="flaticon-right-arrow fwdArrow"></i></span></a></h2>

                                                      <?php   } elseif ($weekEnd == $weekUrl) { ?>
                                                                <h2 class="section-title"><a class="directions-link" href="javascript:void(0)">
                                                                              <input type="hidden" class="hreflinkcal barrow" value="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year. $cid.'&milkid=""'; ?>" />
                                                          <span class="toggeleIconLeft"><i class="flaticon-back fwdArrow"></i></span>

                                                        </a>Hot Lunch Menu
                                                     <?php } else { ?>
                                                               <h2 class="section-title"><a class="directions-link" href="javascript:void(0)">
                                                                              <input type="hidden" class="hreflinkcal barrow" value="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year. $cid.'&milkid=""'; ?>" />
                                                          <span class="toggeleIconLeft"><i class="flaticon-back fwdArrow"></i></span>

                                                        </a>Hot Lunch Menu <a class="directions-link" href="javascript:void(0)">
                                                               <input type="hidden" class="hreflinkcal farrow" value="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year. $cid.'&milkid=""'; ?>" />
                                                          <span class="toggeleIconRight"> <i class="flaticon-right-arrow fwdArrow"></i></span></a></h2>
                                                    <?php }




                                                            if(($weekStart) < $weekUrl && $weekEnd < $weekUrl)
                                                             { 

                                                         //   echo "both arrow";
                                                              ?>


                                                   <!--      <h2 class="section-title"><a class="directions-link" href="<?php // echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year. $cid; ?>">

                                                          <span class="toggeleIconLeft"><i class="flaticon-back fwdArrow"></i></span>

                                                        </a>Hot Lunch Menu <a class="directions-link" href="<?php //echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year .$cid; ?>">

                                                          <span class="toggeleIconRight"> <i class="flaticon-right-arrow fwdArrow"></i></span></a></h2> -->

                                                           <?php  }
                                                            else if( $weekEnd <= $weekUrl ){ 

                                                              //  echo $weekStart; die;

                                                          //   echo "right arrow";
                                                            ?>

                                                           <!--   <h2> Hot Lunch Menu <a class="directions-link" href="<?php // echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year. $cid; ?>">

                                                          <span class="toggeleIconRight"> <i class="flaticon-right-arrow fwdArrow"></i></span></a></h2>  -->


                                                          <?php } 

                                                          else if($weekStart <= $weekUrl) {
                                                           // echo $weekEnd; die;
                                                          //   echo "left arrow";
                                                           ?>
                                                         <!--     
                                                            <h2 class="section-title"><a class="directions-link" href="<?php // echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year. $cid; ?>">

                                                          <span class="toggeleIconLeft"><i class="flaticon-back fwdArrow"></i></span>

                                                        </a>Hot Lunch Menu -->


                                                       <?php   }
                                                         ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="home-demo">
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <table class="table table-custom smart-forms wow fadeIn animated"  data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                                                            <thead>
                                                                <tr>

                                                                    <?php
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        $ts = strtotime($year . 'W' . $week . $i);

                                                                   //   $ts = strtotime("2018". 'W')
                                                                        ?>
                                                                        <th class="dateHeader <?php echo "header".$i; ?>"><?php
                                                                     echo date("Y-m-d",$ts); 
                                                                    // echo $start_Date;
                                                                        ?></th>
                                                                    <?php } ?>
                                                                </tr>

                                                            </thead>
                                                            <tbody id="myTabContent">
                                                            <div id="loading-image" class="text-center" style="display: none;">
                                                                <img  src="<?php echo base_url(); ?>application/images/Spinner.gif"/>
                                                            </div>
                                                            </tbody>      
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </section>





                                </form>
                                <div class="row">
                                    <div class="col-sm-12 text-center MB-25">
                                        <button class="btn btn-submit btnsave" type="button" id="btnsave12345678" name="btnsave" value="Add Item"><i class="fa fa-plus"></i>&nbsp;&nbsp;Checkout</button>
                                    </div>
                                </div>



                                <!-- 
                                                 </div>
                                             </div>
                                         </div> -->
                            </div>
                        </div> 
                    </div>       

                </div>
    
      <?php }
            else
            { ?>
    
                           <div class="row " style="display:none">
        <div class="col-lg-12">
            <div class="panel panel-default MT-30">
                <div class="panel-body">
                    <div class="form-group clearfix MB-0">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">* Please Select child name</label>
                                <div class="col-sm-8 smart-forms">
                                    <label class="field select">
                                        <select id ="interval" name="location1[]" class="form-control childId">
                                            <?php for ($i = 0; $i < count($child); $i++) { ?>
                                            <option value="<?php echo $child[$i]['id']; ?>" <?php if(isset($_REQUEST['childID'])){ if($_REQUEST['childID'] == $child[$i]['id']){ echo 'selected'; }} ?>><?php echo $child[$i]['first_name']; ?></option>

                                            <?php } ?>
                                        </select>
                                        <i class="arrow"></i>  
                                    </label>
                                    <?php for ($i = 0; $i < count($child); $i++) { ?>
                                        <input type="hidden" name = "grade[]" value="<?php echo $child[$i]['location']; ?>"  >
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <?php 
                            
                            $sqlrestDate = "select `restDates` from rest_date_cal where `status` = 1";
                            $resultrestDate = $this->db->query($sqlrestDate)->result_array();
                            $resDate = '';
                            for ($i = 0; $i < count($resultrestDate); $i++) 
                            {
                                $resDate .= $resultrestDate[$i]['restDates'].",";
                            }
                            $resDate = rtrim($resDate, ',');
                            
                            $sqlrestDate1 = "select `restDates` from rest_date_cal_Juice where `status` = 1";
                            $resultrestDate1 = $this->db->query($sqlrestDate1)->result_array();
                            $resDate1 = '';
                            for ($i = 0; $i < count($resultrestDate1); $i++) 
                            {
                                $resDate1 .= $resultrestDate1[$i]['restDates'].",";
                            }
                            $resDate1 = rtrim($resDate1, ',');
                            
                            
                            $sqlrestDate2 = "select `date` from child_menu_item_date_mapping where `status` = 1 and `child_id` =3649 and `parent_id`=".$parent_id." and `item_id`=0 and `meal_id`=0 and `category_id`=0 and `date` between '".$start_Date."' and '".$end_date."'";
                            $resultrestDate2 = $this->db->query($sqlrestDate2)->result_array();
                            $resDate2 = '';
                            for ($i = 0; $i < count($resultrestDate2); $i++) 
                            {
                                $resDate2 .= $resultrestDate2[$i]['date'].",";
                            }
                            $resDate2 = rtrim($resDate2, ',');
                           
                            //echo $resDate2; die;
                            
                            $sqldrink = "select id, item_name from item where item_name IN ('Chocolate milk', 'White milk') and status = 1";
                            $resultdrink = $this->db->query($sqldrink)->result_array();
                        
                        ?>
                         <input type="hidden" id = "restrictredDate" value="<?php echo $resDate; ?>">
                         <input type="hidden" id = "restrictredDateJuice" value="<?php echo $resDate1; ?>">
                         <input type="hidden" id = "weekvalue" value="<?php echo $_REQUEST['week']; ?>">
                         <input type="hidden" id = "yearvalue" value="<?php echo $_REQUEST['year']; ?>">
                         <input type="hidden" id = "noselectiondates" value="<?php echo $resDate2; ?>">
                         <input type="hidden" id = "baseurl" value="<?php echo base_url(); ?>">
                         <input type="hidden" id = "parentIDD" value="<?php echo $parent_id; ?>">
                         <input type="hidden" id = "startDate" value="<?php echo $start_Date; ?>">
                         <input type="hidden" id = "endDate" value="<?php echo $end_date; ?>">
                         <input type="hidden" id = "milkdropdownid" value="<?php  if(isset($_REQUEST['milkid'])){echo $_REQUEST['milkid'];}else{};  ?>">
                    
                         
                         <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">Milk Type:</label>
                                <div class="col-sm-8 smart-forms">
                                    <label class="field select">
                                        <select id="milktype" class="form-control">
                                           <option value="0">Please Select</option>
                                            <?php for ($i = 0; $i < count($resultdrink); $i++) { ?>
                                                <option value="<?php echo $resultdrink[$i]['id']; ?>"><?php echo $resultdrink[$i]['item_name']; ?></option>
                                            <?php } ?>
<!--                                          <option value="63">Chocolate Milk</option>
                                           <option value="64">White Milk</option>-->
                                        </select>
                                        <i class="arrow"></i> 
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                          <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">Drink Choice for Pizza/Hot Dog Lunch:</label>
                                <div class="col-sm-8 smart-forms">
                                    <label class="field select">
                                       <select id="drinktype"  class="form-control">
                                           <option value="0">Please Select</option>
                                           <option value="J">Juice</option>
                                           <option value="W">Water</option>
                                        </select>
                                        <i class="arrow"></i>  
                                    </label>
                                </div>
                            </div>
                        </div>
                        
<!--                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">Select all children</label>
                                <div class="col-sm-8 smart-forms">
                                        <label class="field option block">
                                            <input type="checkbox" class="radiocheck1" name="chkboxallchildren" id="chkboxallchildren" value="0" >
                                            <span class="checkbox"></span>
                                        </label>
                                    <?php  //$iddd = ''; 
                                        //for ($i = 0; $i < count($child); $i++) { 
                                          //          $iddd .= $child[$i]['id'].",";
                                       // } 
                                       // $iddd = rtrim($iddd,',');

                                        ?>
                                    <input type="hidden" id="cciidd" value="<?php// echo $iddd; ?>"  >
                                </div></div>
                        </div>-->
                        
                    </div>
                </div></div></div></div>

                <div class="row" style="display:none">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <!--   <div class="bootstrap-iso">
                                      <div class="container-fluid"> -->
                                <form class="form-horizontal" method="post" action="" >
                                    <section class="aboutGC">
                                        <div class= "">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="heading-custom text-center">
                                                        <?php
                                                        $dt = new DateTime;

                                                     //    $dt =  strtotime("12/01/2018");
                                                     // echo $dt; 

                                                       // $dt = "13-12-2018 23:45:52";
               //  $dt = DateTime::createFromFormat('d-m-Y H:i:s', $date)->format('Y-m-d h:i:s');

                                                    //   echo $dt; 
                                                      // die;
                                                        if (isset($_GET['year']) && isset($_GET['week'])) {
                                                            $dt->setISODate($_GET['year'], $_GET['week']);


                                                        } else {
                                                            $dt->setISODate('2018','49');
                                                        }
                                                        $year = $dt->format('o');
                                                        $week = $dt->format('W');


                                                        $dtate = trim($dt->format('Y-m-d'));
                                                        $timestamp = strtotime($dtate);
                                                        $day = date('l', $timestamp);                                                                                                                                                                                  /*<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year; ?>*/
                                                        ?>

                                                        <?php

                                                             $weekUrl =$_GET['week'];
                                                             $ddate = $start_Date;
                                                             $date = new DateTime($ddate);
                                                             $weekStart = $date->format("W");

                                                            //Priyam jugar week start

                                                             if($weekStart == 1)
                                                             {
                                                                 $weekStart = 2;
                                                             }
                                                            //  echo "Weeknummer: $week"; die;

                                                           //  echo $weekUrl; die;

                                                            $timestamp = strtotime($start_Date);
                                                            $day = date('l', $timestamp);

                                                          //  echo $day; die;

                                                           if($day == "Saturday" || $day == "Sunday")
                                                           {
                                                            $weekStart++;
                                                           }

                                                        //   echo $weekStart; 

                                                              $ddate1 = $end_date;
                                                              $date1 = new DateTime($ddate1);
                                                              $weekEnd = $date1->format("W");


                                                              // if($weekEnd == 01)
                                                              // {
                                                              //   // echo "hellooo";
                                                              //   $weekEnd = 52;
                                                              //  // echo $weekEnd; 
                                                              // }

                                                              if($weekUrl == 0)
                                                              {
                                                                $weekUrl = 52;
                                                              }

                                                              if($weekUrl == 53)
                                                              {
                                                                $weekUrl = 01;
                                                              }

                                                             // echo $weekEnd; die;
                                                              $cid='';
                                                           if (isset($_REQUEST['childID']))
                                                           {
                                                               $cid = "&childID=".$_REQUEST['childID'];
                                                           }



                                                         if($weekStart == $weekUrl)
                                                         { ?>
                                                                   <h2> Hot Lunch Menu <a class="directions-link" href="javascript:void(0)">
                                                                           <input type="hidden" class="hreflinkcal farrow" value="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year. $cid.'&milkid=""'; ?>" />
                                                          <span class="toggeleIconRight"> <i class="flaticon-right-arrow fwdArrow"></i></span></a></h2>

                                                      <?php   } elseif ($weekEnd == $weekUrl) { ?>
                                                                <h2 class="section-title"><a class="directions-link" href="javascript:void(0)">
                                                                              <input type="hidden" class="hreflinkcal barrow" value="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year. $cid.'&milkid=""'; ?>" />
                                                          <span class="toggeleIconLeft"><i class="flaticon-back fwdArrow"></i></span>

                                                        </a>Hot Lunch Menu
                                                     <?php } else { ?>
                                                               <h2 class="section-title"><a class="directions-link" href="javascript:void(0)">
                                                                              <input type="hidden" class="hreflinkcal barrow" value="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year. $cid.'&milkid=""'; ?>" />
                                                          <span class="toggeleIconLeft"><i class="flaticon-back fwdArrow"></i></span>

                                                        </a>Hot Lunch Menu <a class="directions-link" href="javascript:void(0)">
                                                               <input type="hidden" class="hreflinkcal farrow" value="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year. $cid.'&milkid=""'; ?>" />
                                                          <span class="toggeleIconRight"> <i class="flaticon-right-arrow fwdArrow"></i></span></a></h2>
                                                    <?php }




                                                            if(($weekStart) < $weekUrl && $weekEnd < $weekUrl)
                                                             { 

                                                         //   echo "both arrow";
                                                              ?>


                                                   <!--      <h2 class="section-title"><a class="directions-link" href="<?php // echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year. $cid; ?>">

                                                          <span class="toggeleIconLeft"><i class="flaticon-back fwdArrow"></i></span>

                                                        </a>Hot Lunch Menu <a class="directions-link" href="<?php //echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year .$cid; ?>">

                                                          <span class="toggeleIconRight"> <i class="flaticon-right-arrow fwdArrow"></i></span></a></h2> -->

                                                           <?php  }
                                                            else if( $weekEnd <= $weekUrl ){ 

                                                              //  echo $weekStart; die;

                                                          //   echo "right arrow";
                                                            ?>

                                                           <!--   <h2> Hot Lunch Menu <a class="directions-link" href="<?php // echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year. $cid; ?>">

                                                          <span class="toggeleIconRight"> <i class="flaticon-right-arrow fwdArrow"></i></span></a></h2>  -->


                                                          <?php } 

                                                          else if($weekStart <= $weekUrl) {
                                                           // echo $weekEnd; die;
                                                          //   echo "left arrow";
                                                           ?>
                                                         <!--     
                                                            <h2 class="section-title"><a class="directions-link" href="<?php // echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year. $cid; ?>">

                                                          <span class="toggeleIconLeft"><i class="flaticon-back fwdArrow"></i></span>

                                                        </a>Hot Lunch Menu -->


                                                       <?php   }
                                                         ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="home-demo">
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <table class="table table-custom smart-forms wow fadeIn animated"  data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                                                            <thead>
                                                                <tr>

                                                                    <?php
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        $ts = strtotime($year . 'W' . $week . $i);

                                                                   //   $ts = strtotime("2018". 'W')
                                                                        ?>
                                                                        <th class="dateHeader <?php echo "header".$i; ?>"><?php
                                                                     echo date("Y-m-d",$ts); 
                                                                    // echo $start_Date;
                                                                        ?></th>
                                                                    <?php } ?>
                                                                </tr>

                                                            </thead>
                                                            <tbody id="myTabContent">
                                                            <div id="loading-image" class="text-center" style="display: none;">
                                                                <img  src="<?php echo base_url(); ?>application/images/Spinner.gif"/>
                                                            </div>
                                                            </tbody>      
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </section>





                                </form>
                                <div class="row">
                                    <div class="col-sm-12 text-center MB-25">
                                        <button class="btn btn-submit btnsave" type="button" id="btnsave12345678" name="btnsave" value="Add Item"><i class="fa fa-plus"></i>&nbsp;&nbsp;Checkout</button>
                                    </div>
                                </div>



                                <!-- 
                                                 </div>
                                             </div>
                                         </div> -->
                            </div>
                        </div> 
                    </div>       

                </div>
    
    
                    <div class="row" style="display:show">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <section class="aboutGC">
                                            <div class= "">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="heading-custom text-center">
                                                            <h2> Hot Lunch Menu Closed </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
      <?php } ?>
    
    
    
   
    
   
    
    
  
    
</div>
 



<?php include('application/views/Footer/footer.php'); ?>
