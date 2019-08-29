<?php include('application/views/services/service.php');
// echo $GLOBALS['img_url']; die; ?>
<?= link_tag('application/css/montlyCal.css'); ?>

<script type="text/javascript">
	 $(document).ready(function(){

     var selectedChild = $(".childId option:selected").val();
     var selectedMilk = $("#milktype option:selected").val();
     var selectedMilkText = $("#milktype option:selected").text();
    // alert(selectedMilk);
      changeChildById();
      changeCheckboxStatus();
      milkBydefaultshow(selectedMilk,selectedMilkText);
      var  currentChild = $(".hiddenchild").val();
      childMealCategoryItem(selectedChild);

      var sel = $("#interval");
 
  
   sel.change(function(){

      if($(".hiddenchildMealStatus").val() == 1)
       {
          
         // bootbox.alert("Please save your edited meal");
          
       bootbox.dialog({
       title: "Please Save meal for this child",
       message: "Please save meal for this child otherwise Go next for other child",
       buttons: {
         confirm: {
         label: 'Yes',
         className: 'btn-success',
            callback: function(){

                             currentChangeChild = $(".hiddenchild").val();
                              $("#interval").val(currentChangeChild);
                               stop;
                             }
                       },
         cancel: {
         label: 'Go Next',
         className: 'btn-danger',
         callback: function(){



  var selectedMilk = $("#milktype option:selected").val();
     var selectedMilkText = $("#milktype option:selected").text();
          var selectedChild1 = $(".childId option:selected").val();
      
          var  currentChangeChild ='',c=0;


          currentChangeChild = $(".hiddenchild").val();

           // alert(currentChangeChild);
                

          if(currentChild == currentChangeChild ) 
          {
             currentChangeChild = currentChild;
             c++;
          }






      ///////// on child change milk not add     
         var date1 =[];
         $('.counterIncrement').each(function(){

                  date1.push($(this).text());

           });
          
          

        $.ajax({

            type:'post',
            url:'<?php echo base_url(); ?>ChildMonthlyCalendarController/checkMealAviableOnChangeChild',
            data: {selectedChild:currentChangeChild},
            dataType:'json',
            success: function (data) {
                      
                    
            if (data.success)
            {

          
                $(".hiddenchild").val(selectedChild1);
                $("#milktype").val(0);
                $("#drinktype").val(0);

                for(a=0;a<date1.length;a++) 
                    {
                   
                      date2 = date1[a].split("/");
                      date3 = date2[2]+"-"+date2[0]+"-"+date2[1]; 
                      Classdate3 = date2[0]+date2[1]+date2[2];

                      $("#milkCategory"+Classdate3).html("");
                      $("#drinkCategory"+Classdate3).html("");
                    }

                  var changechildmeal = $(".hiddenchild").val();
                  childMealCategoryItem(changechildmeal);
                        milkBydefaultshow(selectedMilk,selectedMilkText);

                    
            }
            else{
                bootbox.dialog({
                      title: "Please Save meal for this child",
                      message: "Are you sure you want to change the child as you have not saved menu for "+data.childName,
                      buttons: {
                          cancel: {

                             label: '<i class="fa fa-times"></i> Cancel',
                             className: 'btn-danger cancelchield',
                            callback: function(){


                               $("#milktype").val(0);
                               $("#drinktype").val(0);

                               for(a=0;a<date1.length;a++) 
                               {
                   
                                  date2 = date1[a].split("/");
                                  date3 = date2[2]+"-"+date2[0]+"-"+date2[1]; 
                                  Classdate3 = date2[0]+date2[1]+date2[2];

                                  $("#milkCategory"+Classdate3).html("");
                                  $("#drinkCategory"+Classdate3).html("");


                             

                             }
                                          
                                 var currentchield = $(".hiddenchild").val();

                                $("#interval option[value=" + currentchield +"]").attr('selected', 'selected');
                                $("#interval").val(currentchield);
                                 $(".hiddenchild").val(currentchield);

                                 childMealCategoryItem(currentchield);
                                                            milkBydefaultshow(selectedMilk,selectedMilkText);
 

                                }

                             },
                          confirm: {
                            label: '<i class="fa fa-check"></i> Go Next',
                            callback: function(){

                          $("#milktype").val(0);
                           $("#drinktype").val(0);

                           for(a=0;a<date1.length;a++) 
                             {
                   
                               date2 = date1[a].split("/");
                               date3 = date2[2]+"-"+date2[0]+"-"+date2[1]; 
                               Classdate3 = date2[0]+date2[1]+date2[2];

                               $("#milkCategory"+Classdate3).html("");
                               $("#drinkCategory"+Classdate3).html("");


                             

                             }


                              var currentchield = $(".hiddenchild").val();


                              $("#interval option[value=" + currentchield +"]").attr('selected', 'false');
                              changeChildById();
                              var currentchield = $(".hiddenchild").val();

                              $("#interval option[value=" + currentchield +"]").attr('selected', 'selected');

                              $("#interval").val(currentchield);
                              $(".hiddenchild").val(currentchield);
                              
                          
                              childMealCategoryItem(currentchield);
                                  
                        milkBydefaultshow(selectedMilk,selectedMilkText);


                                           }
                                      }
                                  },
                                  callback: function () {

                                           
                                       }
                                  
                               });
                        }

                   },
                error: function () {
                       
                }
         })

                                
                           }
                      }
                  }
              });

        }

    else{

        var selectedChild1 = $(".childId option:selected").val();
      
          var  currentChangeChild ='',c=0;

          currentChangeChild = $(".hiddenchild").val();

           // alert(currentChangeChild);
                

          if(currentChild == currentChangeChild ) 
          {
             currentChangeChild = currentChild;
             c++;
          }






      ///////// on child change milk not add     
         var date1 =[];
         $('.counterIncrement').each(function(){

                  date1.push($(this).text());

           });
          
          

        $.ajax({

            type:'post',
            url:'<?php echo base_url(); ?>ChildMonthlyCalendarController/checkMealAviableOnChangeChild',
            data: {selectedChild:currentChangeChild},
            dataType:'json',
            success: function (data) {
                      
                    
            if (data.success)
            {

          
                $(".hiddenchild").val(selectedChild1);
                $("#milktype").val(0);
                $("#drinktype").val(0);

                for(a=0;a<date1.length;a++) 
                    {
                   
                      date2 = date1[a].split("/");
                      date3 = date2[2]+"-"+date2[0]+"-"+date2[1]; 
                      Classdate3 = date2[0]+date2[1]+date2[2];

                      $("#milkCategory"+Classdate3).html("");
                      $("#drinkCategory"+Classdate3).html("");
                    }

                  var changechildmeal = $(".hiddenchild").val();
                  childMealCategoryItem(changechildmeal);
                        milkBydefaultshow(selectedMilk,selectedMilkText);

                    
            }
            else{
                bootbox.dialog({
                      title: "Please Save meal for this child",
                      message: "Are you sure you want to change the child as you have not saved menu for "+data.childName,
                      buttons: {
                          cancel: {

                             label: '<i class="fa fa-times"></i> Cancel',
                             className: 'btn-danger cancelchield',
                            callback: function(){


                               $("#milktype").val(0);
                               $("#drinktype").val(0);

                               for(a=0;a<date1.length;a++) 
                               {
                   
                                  date2 = date1[a].split("/");
                                  date3 = date2[2]+"-"+date2[0]+"-"+date2[1]; 
                                  Classdate3 = date2[0]+date2[1]+date2[2];

                                  $("#milkCategory"+Classdate3).html("");
                                  $("#drinkCategory"+Classdate3).html("");


                             

                             }
                                          
                                 var currentchield = $(".hiddenchild").val();

                                $("#interval option[value=" + currentchield +"]").attr('selected', 'selected');
                                $("#interval").val(currentchield);
                                 $(".hiddenchild").val(currentchield);

                                 childMealCategoryItem(currentchield);
                                       milkBydefaultshow(selectedMilk,selectedMilkText);

                                }

                             },
                          confirm: {
                            label: '<i class="fa fa-check"></i> Go Next',
                            callback: function(){

                          $("#milktype").val(0);
                           $("#drinktype").val(0);

                           for(a=0;a<date1.length;a++) 
                             {
                   
                               date2 = date1[a].split("/");
                               date3 = date2[2]+"-"+date2[0]+"-"+date2[1]; 
                               Classdate3 = date2[0]+date2[1]+date2[2];

                               $("#milkCategory"+Classdate3).html("");
                               $("#drinkCategory"+Classdate3).html("");


                             

                             }


                              var currentchield = $(".hiddenchild").val();


                              $("#interval option[value=" + currentchield +"]").attr('selected', 'false');
                              changeChildById();
                              var currentchield = $(".hiddenchild").val();

                              $("#interval option[value=" + currentchield +"]").attr('selected', 'selected');

                              $("#interval").val(currentchield);
                              $(".hiddenchild").val(currentchield);
                              
                          
                              childMealCategoryItem(currentchield);
                                   milkBydefaultshow(selectedMilk,selectedMilkText);


                                           }
                                      }
                                  },
                                  callback: function () {

                                           
                                       }
                                  
                               });
                        }

                   },
                error: function () {
                       
                }
         })
    }
       

          

    });


    function changeChildById(){
        var selectedChild = $(".childId option:selected").val();
     $(".hiddenchild").val(selectedChild);

    }


    function changeCheckboxStatus() {
     
      $(document).on('change', 'input[type=checkbox]', function() {
                $(".hiddenchildMealStatus").val(1);
           });

    }




 function childMealCategoryItem(selectedChild){

 	
         var date1 =[];
 	       $('.counterIncrement').each(function(){

                  date1.push($(this).text());

           });

  
     $.ajax({
      
           type: 'post',
           url: '<?php echo base_url();?>ChildMonthlyCalendarController/categoryItemMeal',
           data: {selectedChild: selectedChild,DateValue1:date1},
           dataType:'json',
           success:function(data){
             var a,b,c,k,m,date2,date3,Classdate3,html1="",html2="",html3='';
           
           if(data['category'].length >0 || data['checkMealItemData'].length>0)
            {

              for(a=0;a<date1.length;a++) 
              {
                   
                    date2 = date1[a].split("/");
                    date3 = date2[2]+"-"+date2[0]+"-"+date2[1];	
                    Classdate3 = date2[0]+date2[1]+date2[2];

                  $("#monthcal"+Classdate3).html("");
                  $("#monthcalCategory"+Classdate3).html("");
                  $("#monthcalNoselection"+Classdate3).html("");

               ////// for selected meal     
              	for(b=0;b<data['checkMealItemData'].length;b++)
              	{
              		
              	   if(data['checkMealItemData'][b]['date'] == date3)
              	      {
              	       let checked = "";
                       for(c=0;c<data['selectMealItemDataChild'].length;c++)
                       {
                        var selecteditemDate = data['selectMealItemDataChild'][c]['date'];


                        if((data['selectMealItemDataChild'][c]['mealid'] === data['checkMealItemData'][b]['mealid'])  && ( selecteditemDate === date3) )
                            {
                                 checked = "checked";
                            }
                       }
                
                      html1+='<div class="mealBborder"><input type="checkbox" name="" value='+data['checkMealItemData'][b]['mealid']+' '+checked+' class="menuID menuCheckbox meal'+Classdate3+'" id='+Classdate3+'><div class="menuItem">'+data['checkMealItemData'][b]['meal']+'</div><p class="price">$'+data['checkMealItemData'][b]['price'][0]+'</p><div class="mealItem">'+data['checkMealItemData'][b]['item'][0]+'</div></div>';
                   
                      $("#monthcal"+Classdate3).append(html1); 
                      html1='';
                   
              	       }
              	   else
              	       {
                       }
                     
                      
                 } 

                  
                ///// for category side selected 

                 for(k=0;k<data['category'].length;k++) 
                 {
                   
                   if(data['category'][k]['date'] == date3 && data['category'][k].categoryid != "3")
                   {
                   	  html2+='<div class="menuCategory"><input type="hidden" name="categoryName[]" class="categoryID" value="'+data['category'][k]['categoryid']+'"><div class="menuItem">'+data['category'][k]['category']+'</div>';

                   	  for(m=0;m<data['checkCategoryItemData'].length;m++)
                   	  {

                         let checked223 = '';
                         for(n=0;n<data['selectCategoryItemDataChild'].length;n++)
                         {
                             var selectCategoryitemDate = data['selectCategoryItemDataChild'][n]['date'];

                       
                            if((data['checkCategoryItemData'][m]['itemid'] === data['selectCategoryItemDataChild'][n]['itemid']) && (data['checkCategoryItemData'][m]['categoryid'] === data['category'][k]['categoryid']) && (selectCategoryitemDate === date3 ))
                                     { 
                                          
                                           checked223 = "checked"
                                     }
                         }

                      if((data['checkCategoryItemData'][m].categoryid  === data['category'][k].categoryid) && data['checkCategoryItemData'][m]['date'] === date3   )
                      {  
                        

                          html2+='<div class="menuItemSide"><input type="checkbox" class="menuItemCheckbox  sides_'+Classdate3+'" name="" id="drinks123" value='+data['checkCategoryItemData'][m]['itemid']+' '+checked223+' disabled><p class="">'+data['checkCategoryItemData'][m]['item']+'</p><img src="<?php echo $GLOBALS['img_url']; ?>dish-3.png" alt=""></div>'
                      }
                    }
                   	  html2+='</div>';
                   
                      $("#monthcalCategory"+Classdate3).append(html2); 
                      html2='';

                   }

                   else
              	   {
                   }

                 }
                     let checked123 = '';
                  for(k=0;k<data['selectNoMealItemDataChild'].length;k++) 
                 {
                   
                   if(data['selectNoMealItemDataChild'][k]['date'] == date3 &&    data['selectNoMealItemDataChild'][k]['categoryid'] == 0 &&
                     data['selectNoMealItemDataChild'][k]['categoryid'] == 0)
                   {
                      checked123 = "checked"
                   }
                 }
               
                html3+='<div class="mealBborder"><input type="checkbox" class="nomealcheckbox nomeal'+Classdate3+'" name="" value="0" id='+Classdate3+' '+checked123+'><div class="menuItem">NO Lunch</div></div>';

                $("#monthcalNoselection"+Classdate3).append(html3);
                  html3='';         

      }}}
        
 	   });
 	   
       
    }

    ///// -----------------  when meal checked or unchecked sides automaticalley changed .


     $(document).on('change','.menuID', function(){


    ////////// code for if one of meal checked sides selected 
        var mealId = $(this).attr('id');
        
        $('.sides_'+mealId).prop('checked', true);
       

    /////////////  code for if none meal selected ,sides also not selected
        var meallength = $('.meal'+mealId+':checked').length;
       
        if(meallength < 1 )
        {
         
           $('.sides_'+mealId).prop('checked', false);
          
        }else
        {
              ////// if  any meal checked then no lunch automatically unchecked
               $('.nomeal'+mealId).prop('checked', false);
              // $('.necessMilk'+mealId).prop('checked', true);   
             
        }
 });




      /////////////////  code for select milk type
 
       function  milkBydefaultshow(milkID,milkName){

         var a,i,j,date2,dateMilk,Classdate3,date1 =[],html4='',noMilkDate,date3 =[];
          $('.counterIncrement').each(function(){

                  date1.push($(this).text());

           });

           $(".hiddenchildMilkStatus").val(1);
       
       //  var milkID =  $(this).val();
     //    var milkName = $("option:selected",this).text();
         var milkdata = $('#milkData').val();

         var extraMilkdata = milkdata.split(",");

         var extraMilkId = extraMilkdata[0];
         var extraMilkName = extraMilkdata[1];
         var extraMilkPrice = extraMilkdata[2];
         var restDate = $('#restrictredDate').val();
             restDate=restDate.split(",");

        for(a=0;a<date1.length;a++) 
         {
            date2 = date1[a].split("/");

            Classdate3 = date2[0]+date2[1]+date2[2];


            var deletemilkClass = 'div#monthcalCategory'+Classdate3;



//////////  ------  below code commented because of requirment milk not neccessary with meal . this is optional 


          //  var milkDeleteCheckpointer = $('.gridd-item').children('div.counterIncrement').next().next(deletemilkClass).children().eq(1).remove(); 

         

            $("#milkCategory"+Classdate3).html("");
               dateMilk ='';
            for(j=0;j<restDate.length;j++)
            {
                 noMilkDate = restDate[j].split("-");
                 date3 = noMilkDate[1]+"/"+noMilkDate[2]+"/"+noMilkDate[0]; 
                 if(date3 === date1[a])
                 {
                   dateMilk = 'true';
                 }
            
            } 
          
            if(dateMilk =='true')
             {

             }
            else
            {
                if(milkID != 0)
                      {
                         html4+='<div class="menuCategory"><div class="menuItem"><input type="hidden" name="categoryName[]" class="categoryID" value="3"> Milk</div><div class="menuItemSide"><input type="checkbox" class="menuCheckbox milk necessMilk'+Classdate3+' milk'+Classdate3+'" id='+Classdate3+' name="" value="'+milkID+'" ><p class="">'+milkName+'<span class="price" style="float:right; display:inline;color: #f03063;font-weight: bold;">$ 0.25</span></p></div><div class="menuItemSide"><input type="checkbox" class="menuCheckbox milk'+Classdate3+' extramilk extramilk'+Classdate3+' extramilkchecked'+Classdate3+'"  name="" id='+Classdate3+' value="'+extraMilkId+'" ><p class="">'+extraMilkName+'<span class="price" style="float:right; display:inline;color: #f03063;font-weight: bold;">   $'+extraMilkPrice+'</span></p></div></div>'
                   
                           $("#milkCategory"+Classdate3).append(html4); 
                            $('.nomeal'+Classdate3).prop('checked', false);
                           html4='';
                      }
            }
          }
       
       };






   


   ////////  code for if any milk selected then no lunch checkbox unchecked

    $(document).on('change','.milk', function(){
        
        var pointer = $(this);

         var mealId = pointer.attr('id');
         var milklength = $('.necessMilk'+mealId+':checked').length;
         var meallength = $('.meal'+mealId+':checked').length;
         var extramilklength = $('.extramilk'+mealId+':checked').length;

           //alert(meallength);
       
         if(milklength > 0)
           {
                $('.nomeal'+mealId).prop('checked', false);
            }


            // else
            // {
            //   $('.extramilkchecked'+mealId).prop('checked', false);
            // }

////   if any meal selected then milk neccesary selected 
               
            // if(meallength > 0)
            // {
            //    $('.necessMilk'+mealId).prop('checked', true);
            // }

    });





      /////////////////  code for select juice or water type
 
      $(document).on('change', '#drinktype', function(){

          var a,i,j,date2,dateDrink,Classdate3,date1 =[],html5='',noDrinkDate,date3 =[];
          $('.counterIncrement').each(function(){

                  date1.push($(this).text());

           });
       
         var drinkID = $(this).val();
         var drinkName = $("option:selected",this).text();
         var drinkData = $('#drinkData').val();
        
         var extraDrinkData = drinkData.split(",");

         var extraDrinkId = extraDrinkData[0];
         var extraDrinkName = extraDrinkData[1];
         var extraDrinkPrice = extraDrinkData[2];

         var restDate1 = $('#restrictredDate1').val();
             restDate1=restDate1.split(",");


         for(a=0;a<date1.length;a++) 
         {
            date2 = date1[a].split("/");

            Classdate3 = date2[0]+date2[1]+date2[2];

            


            $("#drinkCategory"+Classdate3).html("");
               dateDrink ='';
            for(j=0;j<restDate1.length;j++)
            {
                 noDrinkDate = restDate1[j].split("-");
                 date3 = noDrinkDate[1]+"/"+noDrinkDate[2]+"/"+noDrinkDate[0];

                 
                 if(date3 === date1[a])
                 {
                   var deleteDrinkClass = 'div#monthcalCategory'+Classdate3;
                  var DrinkDeleteCheckpointer = $('.gridd-item').children('div.counterIncrement').next().next(deleteDrinkClass).children().remove(); 
                   dateDrink = 'true';
                 }
            
            }

             if(dateDrink =='true')
             {
               if(drinkID != 0)
                 {
                         html5+='<div class="menuCategory"><div class="menuItem"><input type="hidden" name="categoryName[]" class="categoryID" value="3">Add on Drink</div><div class="menuItemSide"><input type="checkbox" class="menuCheckbox necessDrink'+Classdate3+' drink drink'+Classdate3+'" id='+Classdate3+' name="" value="'+drinkID+'" checked ><p class="">'+drinkName+'</p></div><div class="menuItemSide"><input type="checkbox" class="menuCheckbox extradrink drink'+Classdate3+' extradrink'+Classdate3+'" name="" id='+Classdate3+' value="'+extraDrinkId+'"><p class="">'+extraDrinkName+'<span class="price" style="float:right; display:inline;color: #f03063;font-weight: bold;">$'+extraDrinkPrice+'</span></p></div></div>'
                   
                           $("#drinkCategory"+Classdate3).append(html5); 
                           $('.nomeal'+Classdate3).prop('checked', false);
                           html5='';

                  }
             }
            
         }
        
       
       });




    ////////  code for if any drink selected then no lunch checkbox unchecked
    $(document).on('change','.drink', function(){
         var mealId = $(this).attr('id');
         var drinklength = $('.drink'+mealId+':checked').length;
          var meallength = $('.meal'+mealId+':checked').length;

       
         if(drinklength > 0)
           {
                $('.nomeal'+mealId).prop('checked', false);
           }

//////////////// if juice or water unchecked extra drink automatically unchecked
           if($(this).is(":checked"))
            {
                
            }
            else{
              $('.extradrink'+mealId).prop('checked', false);
            }


    });




 ///////////  when no selection menu none checkbox checked 

     $(document).on('click','.nomealcheckbox', function(){


      ////////// code for if one of meal checked sides selected 
        var mealId = $(this).attr('id');
        $('.meal'+mealId).prop('checked', false);
        $('.sides_'+mealId).prop('checked', false);
        $('.milk'+mealId).prop('checked', false);
        $('.extramilk'+mealId).prop('checked', false);
        $('.drink'+mealId).prop('checked', false);
        $('.extradrink'+mealId).prop('checked', false);

     });


////////////  when extra drink selected drink automatically selected

         $(document).on('change','.extradrink', function(){
                        

                      var extradrinkId = $(this).attr('id');
                    //  $('.drink'+extradrinkId).prop('checked', true);
                       if($(this).is(":checked"))
                       {
                          $('.drink'+extradrinkId).prop('checked', true);
                            $('.nomeal'+extradrinkId).prop('checked', false);

                       }
         });



////////////  when extra milk selected drink automatically selected

         $(document).on('change','.extramilk', function(){
                        

                      var extramilkId = $(this).attr('id');
                   
                       if($(this).is(":checked"))
                       {
                         // $('.milk'+extramilkId).prop('checked', true);
                            $('.nomeal'+extramilkId).prop('checked', false);
                       }
                      

                    


         });






//////////////   save meal for child 


     $('.btnsave').click(function(){

         var trcheckpointer = $('.gridd-item'); 
         
         var selectedChild = $(".childId option:selected").val();
         var noSelectedMilk = $("#milktype option:selected").val();
         var noSelectedDrink = $("#drinktype option:selected").val();
         var c =0;
      
       //////////// validation code for  if no milk and drink selected for child that mean's milk and drink is necessary with every meal .

        // if(noSelectedMilk == 0)
        // {
        //        bootbox.alert({
        //                           message: "Please select Milk Type"
        //                      });
        //                      exit;
        // }

        // if(noSelectedDrink == 0)
        // {
        //        bootbox.alert({
        //                           message: "Please Select Drink For Pizza/Hot Dog"
        //                      });
        //                      exit;
        // }


        $(".hiddenchildMealStatus").val(0);
        $(".hiddenchildMilkStatus").val(0);



        var date1 =[],date2,date3;
        $('.counterIncrement').each(function(){

                  date1.push($(this).text());
        });


       var categories = [];
       var ItemArray = [];
       var milkItemArray =[];
       var drinkItemArray =[];
       var noMealItemArray =[];
       var MealId =[];

       for(a=0;a<date1.length;a++) 
              {
               
                    date2 = date1[a].split("/");
                    date3 = date2[2]+"-"+date2[0]+"-"+date2[1]; 
                    Classdate3 = date2[0]+date2[1]+date2[2];

                    var ItemData = [];
                    var milkItemData =[];
                    var drinkItemData =[];
                    var noMealItemData =[];
                    var arrMeal=[];
                    var Mealdata =[];
                    var checkedMeal = 0;
                    var checkedSides = 0;
                    var checkedNoMeal=0;
                    var checkeddrink=0;
                    var checkedMilk=0;



  //////////// code for checked meal,  insert mealId datewise    

                    trcheckpointer.find('.mealInsertData').each(function(index,value){
                     var mealItem =[];
                     $(this).find('.meal'+Classdate3).each(function(index, value){

                               if($(this).is(":checked"))
                               {
                                    checkedMeal = 1;
                                   var meal_id = $(this).val();
                                    mealItem.push([meal_id,date3]);

                          
                               }
                               else
                               {
                               }
                        });

                    
                      if(mealItem.length > 0)
                               {
                                  Mealdata.push({
                                    mealItem,selectedChild
                                  });
                               }


 
                });




 //////////// code for checked meal sides,  insert mealId datewise 

                     trcheckpointer.find('.mealSidesInsertData').each(function(index, value){
                       var arryItem = [];
                        var CategoryID = $(this).find('.categoryID').val();

                       $(this).find('.sides_'+Classdate3).each(function(index, value){
                                 var sidesId ='';
                                 if($(this).is(":checked"))
                                 {
                                    checkedSides=1;
                                    sidesId = $(this).val()
                                    arryItem.push([sidesId, date3]);
                                 }
                                 else
                                 {

                                 }
                              });

                        
                               if(arryItem.length > 0)
                               {
                                  ItemData.push({
                                    CategoryID, arryItem, selectedChild
                                  });
                               }  
                         
                               
                });



        //////////////// code for insert milkid in table 

                 trcheckpointer.find('.mealMilkInsertData').each(function(index, value){
                       var arryMilkItem = [];
                       var CategoryMilkID = $(this).find('.categoryID').val();
                     
                       $(this).find('.milk'+Classdate3).each(function(index, value){
                                 var MilkId ='';
                                 if($(this).is(":checked"))
                                 {
                                     checkedMilk = 1;
                                    MilkId = $(this).val()

                                    arryMilkItem.push([MilkId, date3]);
                                 }
                                 else
                                 {
                                   
                                 }
                              });


                               if(arryMilkItem.length > 0)
                               {
                                  milkItemData.push({
                                    CategoryMilkID, arryMilkItem, selectedChild
                                  });
                               } 


                         
                               
                });



          //////////////// code for insert drink for friday in table 

                 trcheckpointer.find('.mealDrinkInsertData').each(function(index, value){
                       var arryDrinkItem = [];
                       var CategorydrinkID = $(this).find('.categoryID').val();
                     
                       $(this).find('.drink'+Classdate3).each(function(index, value){
                                 var drinkId ='';
                                 if($(this).is(":checked"))
                                 {
                                    checkeddrink = 1;
                                    drinkId = $(this).val()

                                    arryDrinkItem.push([drinkId, date3]);
                                 }
                                 else
                                 {

                                 }
                              });

                               if(arryDrinkItem.length > 0)
                               {
                                  drinkItemData.push({
                                    CategorydrinkID, arryDrinkItem, selectedChild
                                  });
                               } 


                         
                               
                });





    //////////////// code for insert no meal milk select in table 

                 trcheckpointer.find('.noMealInsertData').each(function(index, value){
                       var arrynomealItem = [];
                   
                       $(this).find('.nomeal'+Classdate3).each(function(index, value){
                                 var nomealId ='';
                                 if($(this).is(":checked"))
                                 {
                                    checkedNoMeal = 1;
                                    nomealId = $(this).val()
                                    arrynomealItem.push([nomealId, date3]);
                                 }
                                 else
                                 {

                                 }
                              });


                        
                               if(arrynomealItem.length > 0)
                               {
                                  noMealItemData.push({
                                     arrynomealItem, selectedChild
                                  });
                               } 


                         
                               
                });

//////////// validation message for if any checkbox not checked for any date
       if(checkedMeal === 0 && checkedNoMeal === 0 && checkedSides === 0 && checkeddrink === 0 && checkedMilk === 0)
         {
               bootbox.alert({
                              message: "Please Select checkbox for "+date1[a]
                            });
                                       exit;
         }
  

           if(Mealdata.length > 0)
           {
                  MealId.push({Mealdata});
           }

          if(ItemData.length> 0)
          {
                  ItemArray.push({ItemData});
          }

          if(milkItemData.length> 0)
          {
                  milkItemArray.push({milkItemData});
          }
          if(drinkItemData.length> 0)
          {
                  drinkItemArray.push({drinkItemData});
          }
           if(noMealItemData.length> 0)
          {
                  noMealItemArray.push({noMealItemData});
          }


}

     var flagval = '0';

     $.ajax({

            type:'post',
            url:'<?php echo base_url(); ?>ChildMonthlyCalendarController/insertMenuMealitem',

            data: {selectedChild:selectedChild,MealId:MealId,ItemArray : ItemArray,milkItemArray:milkItemArray,drinkItemArray:drinkItemArray,noMealItemArray:noMealItemArray,DateValue1:date1,flagval:flagval},
            dataType:'json',

           beforeSend: function() {
                                   $("#loading-image").show();
                                },
            success: function (data) {
                   
                     $('#loading-image').hide();
                      if (data.success)
                    {
                      bootbox.alert({

                                message: "Meal items has been assigned sucessfully for this child."
                              });
                    }
                   },
                error: function () {
                      $('#loading-image').hide();
                        bootbox.alert({
                        message: "data is not assigned",
                        callback: function () {

                        }
                    })
                }

         })



         
     });


$('.btncheckout').click(function(){


    var trcheckpointer = $('.gridd-item'); 
    var currentchield = $(".hiddenchild").val();

     var allChildValues = [];

        $('#interval option').each(function() {
             allChildValues.push($(this).val());
          });



       if($(".hiddenchildMealStatus").val() == 1)
       {


          bootbox.alert("Please save your edited meal");
          exit;
       }

       if($(".hiddenchildMilkStatus").val() == 1)
       {


          bootbox.alert("Please save your edited milk");
          exit;
       }
        


       $.ajax({

            type:'post',
            url:'<?php echo base_url(); ?>ChildMonthlyCalendarController/checkMealAviable',
            data: {selectedChild:allChildValues,currentchield:currentchield},
            dataType:'json',
            success: function (data) {

                 if (data.success)
                 {
                   if(data['resultChildArray']== ''){
                            location.href = '<?php echo base_url(); ?>ChildMenuItemController/reportCheckout/';
                     }
                      else{

                          bootbox.dialog({
                                  title: "Please Save meal for all child",
                                  message: "Are you sure you want to checkout without save meal for "+data['resultChildArray'],
                                  buttons: {
                                      cancel: {

                                          label: '<i class="fa fa-times"></i> No',
                                          className: 'btn-danger',
                                          callback: function(){
                                          
                                          }
                                      },
                                      confirm: {
                                          label: '<i class="fa fa-check"></i> Yes',
                                           callback: function(){
                                            location.href = '<?php // echo base_url(); ?>ChildMenuItemController/reportCheckout/';
                                              
                                           }
                                      }
                                  },
                                  callback: function () {

                                           
                                       }
                                  
                               });
                       }

                    }
                    else{
                         bootbox.alert("Please save meal for atleast one child");

                         }
                   },
                error: function () {
                       
                }

         })

 });
   
});

 


</script>

<input type="hidden" name="changeChildId" value="" class="hiddenchild">
<input type="hidden" name="changeChildMealStatus" value="0" class="hiddenchildMealStatus">
<input type="hidden" name="changeChildMilkStatus" value="0" class="hiddenchildMilkStatus">

<div id="page-wrapper" style="min-height: 327px;">
     <?php if($status == 1)
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
                                            <option value="<?php echo $child[$i]['id']; ?>" <?php if($i == 0){ echo "selected";} ?>><?php echo $child[$i]['first_name']; ?></option>

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
                            
                   //// rest date where we do not provide milk .         
                            $sqlrestDate = "select `restDates` from rest_date_cal where `status` = 1";
                            $resultrestDate = $this->db->query($sqlrestDate)->result_array();
                            $resDate = '';
                            for ($i = 0; $i < count($resultrestDate); $i++) 
                            {
                                $resDate .= $resultrestDate[$i]['restDates'].",";
                            }
                            $resDate = rtrim($resDate, ',');



                            //// only those date where we provide extra drink . 
                            //  $sqlrestDate1 = "select `restDates` from rest_date_cal_Juice where `status` = 1";
                            // $resultrestDate1 = $this->db->query($sqlrestDate1)->result_array();
                            // $resDate1 = '';
                            // for ($i = 0; $i < count($resultrestDate1); $i++) 
                            // {
                            //     $resDate1 .= $resultrestDate1[$i]['restDates'].",";
                            // }
                            // $resDate1 = rtrim($resDate1, ',');




                   /////   for milk type select         
                            $sqlmilk = "select id, item_name from item where item_type ='add_on_milk' and status = 1";
                            $resultmilk = $this->db->query($sqlmilk)->result_array();

                   /////    for juice and water 

                             // $sqldrink = "select id, item_name from item where item_type ='add_on_drink'  and status = 1";
                             // $resultdrink = $this->db->query($sqldrink)->result_array();


                      ////// for extra milk 
                              $sqlextramilk = "select id, item_name,price from item where item_type ='extra_milk' and status = 1";
                            $resultextramilk = $this->db->query($sqlextramilk)->row_array();
                            $milkData= $resultextramilk['id'].",".$resultextramilk['item_name'].",".$resultextramilk['price'];



                     ////// for extra drink (juice) 
                            //   $sqlextradrink = "select id, item_name,price from item where item_type ='extra_juice' and status = 1";
                            // $resultextradrink = $this->db->query($sqlextradrink)->row_array();
                            // $drinkData= $resultextradrink['id'].",".$resultextradrink['item_name'].",".$resultextradrink['price'];



                            ?>
                         <input type="hidden" id = "restrictredDate" value="<?php echo $resDate; ?>">
<!-- 
                          <input type="hidden" id = "restrictredDate1" value="<?php echo $resDate1; ?>"> -->

                         <input type="hidden" id = "milkData" value="<?php echo $milkData; ?>">
                      <!--   <input type="hidden" id = "drinkData" value="<?php echo $drinkData; ?>">  -->
                       
                       <div class="row" style="display: none">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">Milk Type:</label>
                                <div class="col-sm-8 smart-forms" >
                                    <label class="field select">
                                        <select id="milktype" class="form-control milkclass">
                                         
                                            <?php for ($i = 0; $i < count($resultmilk); $i++) { ?>
                                                <option value="<?php echo $resultmilk[$i]['id']; ?>" selected><?php echo $resultmilk[$i]['item_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <i class="arrow"></i> 
                                    </label>
                                </div>
                            </div>
                        </div> 

                      
                                                
                        
                        <!--   <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <label class="col-sm-4">Drink Choice for Pizza/Hot Dog Lunch:</label>
                                <div class="col-sm-8 smart-forms">
                                    <label class="field select">
                                       <select id="drinktype"  class="form-control">
                                           <option value="0">Please Select</option>
                                            <?php  for ($i = 0; $i < count($resultdrink); $i++) { ?>
                                                <option value="<?php  echo $resultdrink[$i]['id']; ?>"><?php  echo $resultdrink[$i]['item_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <i class="arrow"></i>  
                                    </label>
                                </div>
                            </div>
                        </div> -->  
                    </div>
                </div></div></div></div>

     
         <!--  <div id="loading-image busy">
             <img  src="<?php echo base_url(); ?>application/images/Spinner.gif"/>
          </div> -->
          <div class="loading" id="loading-image" style="display: none;">
            
          </div>

    
    <div class="menuMasssonary">
              <div class="daysGridBlock">
                  <div class="daysGrid">Monday</div>
                  <div class="daysGrid">Tuesday</div>
                  <div class="daysGrid">Wednesday</div>
                  <div class="daysGrid">Thursday</div>
                  <div class="daysGrid">Friday</div>
              </div>
<?php

        $dateStart = date("Y-m-d", strtotime($start_Date));


        $dateEnd = date("Y-m-d", strtotime($end_date));
   //echo $dateEnd; die;

        $dayDate= date("d", strtotime($dateStart));
        $monthCal= date("m", strtotime($dateStart));
        $yearCal= date("Y", strtotime($dateStart));

        $lastDate = date("d", strtotime($dateEnd));
       
         

 ?>



  <div class="gridd" style="position: relative; height: 3020.42px;">
 
     <?php 
	       for($ii=1;$ii<10;$ii++)
		   {   
			 for($j=1;$j< 7; $j++)
				 { 
     			

                           $date = $monthCal."/".$dayDate."/".$yearCal;
                           $classdate1=$monthCal.$dayDate.$yearCal;
                           //  echo $classdate1; die;
                           $day = date('l', strtotime($date));
                   
                           $day_number = intval(date('N', strtotime($date)));
                           // echo var_dump($day); die;

                           $EndDate = date("Y-m-d", strtotime($end_date));
                           $DateLast = date("d", strtotime($dateEnd));
                         //   echo $day; die;
                          if($day == "Saturday")
                          { 
                           
                               $dayDate = $dayDate + 2;
                               if(count($dayDate) < 2 && $dayDate < 10)
			                     {
			                        $dayDate = '0'.$dayDate;
			                      }
                               break;
                              
                              
                          }


       else if($day == "Sunday")
       {

    $dayDate = $dayDate + 1;

  //  echo $dayDate; die;
                               if(count($dayDate) <= 2 && $dayDate < 10)
                           {
                              $dayDate = '0'.$dayDate;
                            }
                               break;
       }


                          else 
                          {
                        
                              if($j == $day_number)
                             {
                          	     $hh='';
                                 $hh.='<div class="gridd-item" id="grid'.$classdate1.'" style="position: absolute; left: 0px; top: 0px;">';

                                 
			                     $hh.='<div class="counterIncrement">'.$date;
			                     

			                            if($dayDate > $DateLast)
			                             {
			                             	break;
			                             } 
						                    $dayDate++;  

			                            if(count($dayDate) < 2 && $dayDate < 10)
			                            {
			                               $dayDate = '0'.$dayDate;
			                            }
			                     // echo $dayDate;

				                  $hh.='</div>';
				                  $hh.='<div id="monthcal'.$classdate1.'" class="mealBG mealInsertData"></div>';

				                  $hh.='<div id="monthcalCategory'.$classdate1.'" class="mealBG mealSides mealSidesInsertData"></div>';

                          $hh.='<div id="milkCategory'.$classdate1.'" class=" mealBG mealSides mealMilkInsertData"></div>';

                          $hh.='<div id="drinkCategory'.$classdate1.'" class=" mealBG mealSides mealDrinkInsertData"></div>';
                          $hh.='<div id="monthcalNoselection'.$classdate1.'" class="mealBG mealSides noMealInsertData"></div>';
                          $hh.='</div>';

                                 echo $hh;
                              }

                               else { ?>

                                 <div class="gridd-item" style="position: absolute; left: 0px; top: 0px;">
                          	     </div>

                             <?php }


                          	}

                     }
                 }

     ?>

 </div>
   
</div>

        <div class="row">
                     <div class="col-sm-6 text-center MT-30 MB-25 col-sm-offset-3">
                             <button class="btn btn-submit btnsave" type="button" id="btnsaveData" name="btnsave" value="Add Item" style="margin-right:5px;">Save Meal</button>
                             <button class="btn btn-submit btncheckout" type="button" id="" name="btncheckout" value="Add Item" style="margin-left:5px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Checkout</button>
                    </div>
                    <div class="col-sm-6 text-center MB-25">
                             
                    </div>
        </div>
       <?php } else{ ?>
                 
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
         
            <?php }      
       ?>
 </div>

<?php include('application/views/Footer/footer.php'); ?>

   <script>
              // external js: isotope.pkgd.js

$('.gridd').isotope({
  itemSelector: '.gridd-item',
  masonry: {
    columnWidth: 12,
//    gutter:5,
    horizontalOrder: true
  }
});

          </script>

          <script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loading-image").style.display = "block";
}
</script>
