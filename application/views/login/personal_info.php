 <?php include('application/views/services/service.php') ?>

<?php 
 // print_r($personalInfo); die;

 ?>
 <script type="text/javascript">

    $(document).ready(function(){
   var i =0,k=0; 
    $("#add-more").click(function() { 
       i++;    
     if(i>0){
        var j = "n"+ i;
       // console.log(" i= "+ i);
        $('#field').append('<div id="field">\n\
<div class="col-lg-12">\n\
    <div class="panel panel-default ">\n\
        <div class="panel-heading"> CHILD INFORMATION \n\
            <button type="button" class="close" aria-label="Close">\n\
                <span aria-hidden="true">&times;</span>\n\
            </button></div>\n\
            <div class="panel-body">\n\
                <div class="row">\n\
                    <div class="col-lg-6"> \n\
                        <div class="form-group">\n\
                            <label>Child First Name</label>\n\
                                <input class="form-control" name="cfirst_name[]" value="" placeholder="Child First Name">\n\
                        </div>\n\
                    </div>\n\
                    <div class="col-lg-6">\n\
                        <div class="form-group"> \n\
                            <label>Child Middle Name</label>\n\
                                <input class="form-control"  name="cmiddle_name[]" value="" placeholder="Child Middle Name"> \n\
                        </div>\n\
                    </div>\n\
                </div>\n\
                <div class="row">\n\
                    <div class="col-lg-6">\n\
                        <div class="form-group">\n\
                            <label>Child Last Name</label>\n\
                            <input class="form-control"  name="clast_name[]" value="" placeholder="Child Last Name" >\n\
                        </div>\n\
                    </div>\n\
                <div class="col-lg-6">\n\
                    <div class="form-group">\n\
                        <label>Date of Birth</label>\n\
                            <input type="date" class="form-control" name="DOB[]" value="" placeholder="Date of Birth" >\n\
                    </div>\n\
                </div> \n\
            </div>\n\
            <div class="form-group">\n\
                <label>Gender of Child : </label>\n\
                    <label class="radio-inline">\n\
                        <input type="radio" name="optionsRadiosInline'+i+'[]" value="MALE" >MALE\n\
                    </label>\n\
                <label class="radio-inline">\n\
                    <input type="radio" name="optionsRadiosInline'+i+'[]" value="FEMALE">FEMALE\n\
                </label>\n\
            </div>\n\
            <div class="row"> \n\
                <div class="col-lg-6">\n\
                    <div class="form-group" id="'+j+'">\n\
                        <label>Child Grade & Program Selection\n\
                        </label>\n\
                        <select class="form-control gradeClass gradeClass1" name="grad_location[]" data-price='+i+'>\n\
                            <option value="">--Please Select--</option> \n\
                            <?php for($j=0; $j< count($childgradeinfo);$j++) { ?><option value="<?php echo $childgradeinfo[$j]['id']; ?>"><?php echo $childgradeinfo[$j]['Grade_name']; ?></option><?php  } ?></select>\n\
                    </div>\n\
                </div>\n\
                <div class="col-lg-6" >\n\
                    <div class="form-group">\n\
                        <div id="price_'+j+'">\n\
                    </div>\n\
                </div>\n\
            </div>\n\
        </div>\n\
        <div class="row" style="margin-bottom:5px;">\n\
            <div class="col-lg-12" >\n\
                <input type="button" value="Add Child Class" class="btn btn-info btn-submit addChildClass">\n\
            </div>\n\
        </div>'+
        '<div class="row">'+
            '<div class="col-lg-12" id="P'+i+'">'+
        '</div>'+
    '</div>'+
'</div>'+
'</div>');}

      

    });

  $(document).on("click",".addChildClass" , function(){
      
         if(i>0)
          {
           // console.log("k=" + i);
             
          //  $(".classChild").html("");
             $("#P"+i).append(' <div class="row">\n\
                <div class="col-lg-6">\n\
                    <label>* Child Class</label>\n\
                        <select class="form-control " name="classGrade[]" >\n\
                            <option value="" disabled>--Please Select--</option> \n\
                                <?php for($j=0;$j<count($childclassInfo);$j++) { ?><option value="<?php echo $childclassInfo[$j]['id']; ?>"><?php echo $childclassInfo[$j]['ClassName']; ?></option><?php  } ?></select> \n\
                </div>\n\
                <div class="col-lg-6">\n\
                    <label>* Child Certificate</label>\n\
                        <select class="form-control childcerti" name="Certificate[]" >\n\
                            <option value="" disabled>--Please Select--</option> <?php for($j=0; $j<count($childcertificateInfo);$j++) { ?><option value="<?php echo $childcertificateInfo[$j]['id']; ?>"><?php echo $childcertificateInfo[$j]['Name']; ?></option><?php  } ?></select>\n\
                </div>\n\
                </div>');
          }
     $('.addChildClass').prop('disabled', true);
     })


     $(document).on('click','.close', function(){
         var j =$(this).parents("div");
                // var k = $(j[3]).attr("id");
                   $(j[3]).remove();
                   i--;
            });
     
       $(document).on('change', '.gradeClass', function(){
    
         var selectedChild = $(this).val();
       
         var childId = $(this).parent().attr('id');
          
         $.ajax({   
            type: "POST",
             url: '<?php echo base_url(); ?>Signup_controller/ajaxGradeprice',
             
                data: {selectedChild: selectedChild},
                dataType: 'json',
                success:function(data){
                         $("#price_"+childId).html("");
                         $("#price_"+childId).append("<label> Price </label>\n\
                                                        <input class='form-control' name='price[]' value='$"+data.success['price']+"' readonly>"); 
            }
        });

      });



    $(document).on('click','.formSubmit', function(e){


               
                    if($(".gradeClass1").length > 0){ 
                       $(".gradeClass1 :selected").each(function()
                        {
                           // alert($(this).val());
                            if($(this).val() ==''){
                                alert("Please Add Child Grade Class");
                               e.preventDefault();
                                return false;
                            }
                        }); 
                    }else{
                    
                    }  
            });

            

          

   });

 </script>
 
<style>
    /* For Firefox */
input[type='number'] {
    -moz-appearance:textfield;
}
/* Webkit browsers like Safari and Chrome */
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style> 
 
<div id="page-wrapper">
            <div class="form_error">
                <?php echo validation_errors(); ?>
           </div>
   <?php 
     $loginstatus   = $this->session->userdata('logged_in'); 
 //  print_r($loginstatus); die;

 if($userId == $personalInfo['id'] && $personalInfo['type'] == 'Parent') 
 
   {  ?>
          
   
            <form method="post" id="form1" action="<?php echo base_url();?>Signup_controller/personalProfile/<?php echo $personalInfo['id']; ?>" >

            <div class="row">

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                   PERSONAL INFORMATION
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Last Login</label>
                                            <input class="form-control" name="lastlogin" value="<?php echo date("m-d-Y",strtotime($personalInfo['Last_login'])); ?>" placeholder="" disabled>
                                        </div>
                                                                           
                                </div>

                                
                                 <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Last IP</label>
                                            <input class="form-control" name="Ip_address" value="<?php echo $_SERVER['REMOTE_ADDR']  ?>" placeholder="" disabled>
                                        </div>
                                                                           
                                </div>

                            </div>


                         
                             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Father Name</label>
                                            <input class="form-control" name="father_name" value="<?php echo $personalInfo['first_name']; ?>" placeholder=" Name" >
                                        </div>
                                                                           
                                </div>

                                
                                 <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Father Middle Name</label>
                                            <input class="form-control" name="father_middle_name" value="<?php echo $personalInfo['middle_name']; ?>" placeholder=" Name" >
                                        </div>
                                                                           
                                </div>

                                
                           
                              
                            </div>

                             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Father Last Name</label>
                                            <input class="form-control" name="father_last_name" value="<?php echo $personalInfo['last_name']; ?>" placeholder=" Name" >
                                        </div>
                                                                           
                                </div>

                                
                                 <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                        
                                            <label>Martial Status</label>
                                            <select class="form-control" name="marital[]" disabled>  
                                             
                                                <option value="<?php  echo $personalInfo['parent_martial_status']; ?>" selected readonly>
                                                    <?php echo $personalInfo['marital_status']; ?></option>            
                                        
                                            </select>
                                            
                                        </div>
                                                                           
                                </div>

                            </div>



                            <div class="row">
                                 <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Mother Name</label>
                                            <input class="form-control" name="mother_name" value="<?php echo $personalInfo['mother_name']; ?>" placeholder=" Name">
                                        </div>
                                                                           
                                </div>
                                

                                
                                 <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Mother Middle Name</label>
                                            <input  class="form-control" name="mother_middle_name" value="<?php echo $personalInfo['mother_middle_name'];?>" >
                                        </div>
                                                                           
                                </div>
                           
                              
                            </div>


                             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Mother Last Name</label>
                                            <input class="form-control" name="mother_last_name" value="<?php echo $personalInfo['mother_last_name']; ?>" placeholder=" Name">
                                        </div>
                                                                           
                                </div>

                                
                                 <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                        
                                            <label>Martial Status</label>
                                            <select class="form-control" name="marital[]" disabled>  
                                             
                                                <option value="<?php  echo $personalInfo['parent_martial_status']; ?>" selected readonly>
                                                    <?php echo $personalInfo['marital_status']; ?></option>            
                                        
                                            </select>
                                            
                                        </div>
                                                                           
                                </div>

                                
                           
                              
                            </div>

                             <div class="row">
                                 <?php if($loginstatus['type'] == 'Business Manager'){ ?>
                                       <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>Email/UserId </label>
                                            <input class="form-control" name="email" value="<?php  echo $personalInfo['email']; ?>"placeholder="Email Address" >
                                        </div>
                                </div> 
                                <?php }else{ ?>
                                       <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>Email/UserId </label>
                                            <input class="form-control" name="email" value="<?php  echo $personalInfo['email']; ?>"placeholder="Email Address" readonly>
                                        </div>
                                </div> 
                               <?php  } ?>
                               

                                   <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Cell </label>
                                            <input class="form-control" type="tel" pattern="^\d{3}-\d{3}-\d{4}$" name="cell_phone" value="<?php  echo $personalInfo['phone']; ?>" placeholder="123-456-7890" maxlength="12">
                                        </div>
                                                                           
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" name="address" value="<?php echo $personalInfo['Address'];?>" placeholder="Address">
                                        </div>
                                </div> 


                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>City</label>
                                            <input class="form-control" name="city" value="<?php echo $personalInfo['City'];?>" placeholder="City" >
                                        </div>
                                </div>   
                            </div>



                            <div class="row">
                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>State</label>
                                            <input class="form-control" name="state" value="<?php echo $personalInfo['State'];?>" placeholder="State">
                                        </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label>Zip</label>
                                            <input type="number" id="zip" class="form-control" name="zip" value="<?php echo $personalInfo['Zip']; ?>" placeholder="Zip">
                                    </div>
                                    <div id="alertmsg" style="color:red;"></div>
                                </div>
                           
                              
                            </div>



                         <?php if($loginstatus['type'] == 'Business Manager'){
                                    if($flag == 0)
                                       { ?>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                
                                                        <div class="form-group">
                                                            <label>Discount</label>
                                                            <input class="form-control" name="discount" type="number" min="0" max="100" value="<?php echo $bmdiscount[0]['discount']; ?>" placeholder="discount">
                                                        </div>
                                                </div>
                                            </div>


                                    <?php  } else {  ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                        
                                                    <div class="form-group">
                                                        <label>Discount</label>
                                                        <input class="form-control" name="discount" type="number" min="1" max="100" value=" " placeholder="discount" >
                                                    </div>
                                                </div>
                                            </div>
                                    <?php  }
                              
                            
                            } ?>

                           
                        </div>
                    </div>
                 
                </div>

                 <input type="hidden" name="id" value="<?php echo $personalInfo['id']; ?>" >
              
            </div>

      
     <?php

   //  print_r($childInfo); die;
   
      
      for($i=0; $i<count($childInfo);$i++)
        {  ?>

                 <div class="row showChild">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                   Child Information
                        </div>
                        <div class="panel-body">
                         
                             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                        <label>First Name</label>
                                         <input class="form-control" name="firstname[]" value="<?php echo $childInfo[$i]['first_name']; ?>" placeholder="First Name" >
                                        </div>
                                                                           
                                </div>

                                
                                 <div class="col-lg-6">
                                   
                                      <div class="form-group">
                                            <label>Middle Name</label>
                                            <input class="form-control" name="middlename[]" value="<?php echo $childInfo[$i]['middle_name'];?>" placeholder="Middle Name" >
                                        </div>
                                                                           
                                </div>
                           </div>



                             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" name="lastname[]" value="<?php echo $childInfo[$i]['last_name']; ?>" placeholder="Last Name" >
                                        </div>
                                                                           
                                </div>


                                  <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                             <label>Date of Birth</label>
                                            <input type="date" class="form-control" name="DOB[]" value="<?php echo $childInfo[$i]['dob']; ?>" placeholder="Date of Birth" maxlength="8" disabled>
                                        </div>
                                                                           
                                </div>

                            </div>

                            <div class="row">
                                 <div class="col-lg-6">
                                   
                                      <div class="form-group" id="<?php echo $childInfo[$i]['id'] ?>">
                                            <label>Child Grade & Program Selection</label>
                                        
                                              <select class="form-control gradeClass gradeClass1" name="location[]" disabled>  
                                                
                                                 <?php  for ($j=0; $j<count($childgradeinfo);$j++) { 
                                                   
                                                    if($childgradeinfo[$j]['id'] == $childInfo[$i]['location'])
                                                   {?> 
                                                    <option value="<?php echo $childgradeinfo[$j]['id']; ?>" selected readonly >
                                                <?php echo $childgradeinfo[$j]['Grade_name']; ?>
                                                    
                                                   </option>

                                                    <?php }else{ ?>

                                             <?php  }  } ?>
                                             
                                            </select>
                                        </div>
                                                                           
                                </div>

                                 <div class="col-lg-6" >
                                      <div class="form-group">
                                       <div id="price_<?php echo $childInfo[$i]['id'] ?>">
                                           
                                       </div>
                                     </div>
                                </div>
                            </div>

                        <!--     <div class="row classChild">
                                <div class="col-lg-12">
                                         <div class="form-group">
                                         </div>
                                </div>
                            </div> -->

                            <!--    <div class="row" style="margin-bottom:5px;">
                                    <div class="col-lg-12" >
                                        <input type="button" value="Add Child Class" class="btn btn-info btn-submit addChildClass">
                                    </div>
                               </div> -->
                      
                               <div class="row">
                                   <div class="col-lg-6">
                                        <div class="form-group" id="<?php echo $childInfo[$i]['id'] ?>">
                                            <input type="hidden" name="childhiddenid[]" value="<?php echo $childInfo[$i]['id'] ?>">
                                            <label> Class</label>
                                             <select class="form-control" name="childClass[]" >
                                                    <option value="">--Please Select--</option>
                                                 <?php $flagcheckidclass;
                                                  for ($m=0;$m<count($childclassInfo);$m++ ) { 
                                                  for ($k=0; $k<count($selectChildClassCertificate);$k++)   
                                                  { 
                                                      
                                                    if(($selectChildClassCertificate[$k]['childid'] === $childInfo[$i]['id']) 
                                                       && ($selectChildClassCertificate[$k]['id']===$childclassInfo[$m]['id']))

                                                   {   $flagcheckidclass = $childclassInfo[$m]['id']; ?> 
                                                     
                                                    <option value="<?php echo $childclassInfo[$m]['id']; ?>" selected>
                                                              <?php echo $childclassInfo[$m]['ClassName']; ?>
                                                    </option>
                                                    

                                           <?php   } } ?>
                                                        <?php  
                                                            if($childclassInfo[$m]['id'] == $flagcheckidclass)
                                                            {
                                                            
                                                            }
                                                            else
                                                            { ?>
                                                                 <option value="<?php echo $childclassInfo[$m]['id']; ?>">
                                                                    <?php echo $childclassInfo[$m]['ClassName']; ?>
                                                                </option>
                                                     <?php  }    ?>
                                                     <?php } ?> 
                                                         

                                                    
                  
                                            </select>
                                        </div>
                                   </div>

                                    <div class="col-lg-6">
                                          <div class="form-group" id="<?php echo $childInfo[$i]['id'] ?>">
                                            <label> Certificate</label>
                                              <select class="form-control" name="childcertificate[]" >
                                                  <option value="" hiddden >--Please Select--</option>   
                                                
                                             <?php  $flagcheckidcertificate;
                                            for($a=0;$a<count($childcertificateInfo);$a++)
                                                  {
                                                 for ($l=0; $l<count($selectChildClassCertificate);$l++) { 
                                                   
                                                  if($selectChildClassCertificate[$l]['childid'] === $childInfo[$i]['id']  && ($selectChildClassCertificate[$l]['certificate_id']===$childcertificateInfo[$a]['id']))
                                                   { $flagcheckidcertificate=$childcertificateInfo[$a]['id']; ?> 
                                                  <option value="<?php echo $childcertificateInfo[$a]['id']; ?>"       selected> <?php echo $childcertificateInfo[$a]['Name']; ?>
                                                    
                                                   </option>

                                                    <?php } } 
                                                            
                                                        if($childcertificateInfo[$a]['id'] == $flagcheckidcertificate)
                                                        {
                                                            
                                                        }
                                                        else
                                                        { ?>
                                                           <option value="<?php echo $childcertificateInfo[$a]['id']; ?>">
                                                            <?php echo $childcertificateInfo[$a]['Name']; ?>

                                                          </option> 
                                                 <?php  }
                                                    
                                                    ?>
                                                  


                                                   <?php  } ?>
                                                   
                                             
                                            </select>
                                        </div>
                                   </div>
                               </div>

                    <?php if($loginstatus['type'] == 'Business Manager' && $userId == $personalInfo['id']){ 
                            // 

                        ?>
                           <div class="row" id ="enableDisableChild">
                                <div class="col-lg-6">

                                <label> Child Enable Disable</label>
                                   <select class="form-control" name ="childEnable[]">

                                    <?php 
                                       if($childInfo[$i]['Child_Enable_Disable']== 1)  { 
                                 //     print_r("child enable"); die;
                                        ?>
                                          <option value="1" selected="">Enable</option>
                                           <option value="0">Disable</option>
                                      <?php } else {   ?>
                                             <option value="1">Enable</option>
                                            <option value="0" selected>Disable</option>

                                       <?php   } ?>
                                  
                                   
                                            
                                   </select>
                               </div>
                           </div>
                      <?php }?>

                        </div>
                    </div>
                </div>
            </div>


         <?php } ?>


      <div class="row" id ="field">
                <div class="col-lg-12">
                  
                </div>
     </div>

    

         <div class="row">
            <div class="col-lg-6" style="margin-bottom:5px;">
               <input type="button" value="Add More Child" class="btn btn-info btn-submit " id="add-more">
               
            </div>
        </div>

  
           <div class="row">
            <div class="col-lg-12" style="margin-bottom:5px;text-align:right;">
                  <button type="submit" class="btn btn-primary formSubmit">Update Info</button>
            </div>
        </div>

         
      </form>
 


  <?php } elseif ($personalInfo['type'] == 'Business Manager' && $userId == $personalInfo['id']) {  ?>


       <form method="post" action="<?php echo base_url();?>Signup_controller/personalProfile/<?php echo $personalInfo['id']; ?>" >
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                   PERSONAL INFORMATION
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Last Login</label>
                                            <input class="form-control" name="lastlogin" value="<?php echo date("m-d-Y",strtotime($personalInfo['Last_login'])); ?>" placeholder="" disabled>
                                        </div>
                                                                           
                                </div>

                                
                                 <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Last IP</label>
                                            <input class="form-control" name="Ip_address" value="<?php echo $_SERVER['REMOTE_ADDR']  ?>" placeholder="" disabled>
                                        </div>
                                                                           
                                </div>

                            </div>


                         
                             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" name="father_name" value="<?php echo $personalInfo['first_name']; ?>" placeholder=" Name" required>
                                        </div>
                                                                           
                                </div>

                                
                                 <div class="col-lg-6">
                                   
                                     
                                        <div class="form-group">
                                            <label> Last Name</label>
                                            <input class="form-control" name="father_last_name" value="<?php echo $personalInfo['last_name']; ?>" placeholder=" Name" >
                                        </div>
                                                
                                                                           
                                </div>

                                
                           
                              
                            </div>


                             <div class="row">
                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label> Email/UserId </label>
                                            <input class="form-control" name="email" value="<?php  echo $personalInfo['email']; ?>"placeholder="" disabled>
                                        </div>
                                </div>  

                                   <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Cell </label>
                                            <input type="tel" class="form-control" pattern="^\d{3}-\d{3}-\d{4}$" name="cell_phone" value="<?php  echo $personalInfo['phone']; ?>" placeholder="123-456-7890" maxlength="12" required>
                                        </div>
                                                                           
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" name="address" value="<?php echo $personalInfo['Address'];?>" placeholder="Address" required>
                                        </div>
                                </div> 


                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>City</label>
                                            <input class="form-control" name="city" value="<?php echo $personalInfo['City'];?>" placeholder="City" required>
                                        </div>
                                </div>   
                            </div>



                            <div class="row">
                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label> State</label>
                                            <input class="form-control" name="state" value="<?php echo $personalInfo['State'];?>" placeholder="State" required>
                                        </div>
                                </div>


                               
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label>Zip</label>
                                            <input type="number" id="zip" class="form-control" name="zip" value="<?php echo $personalInfo['Zip']; ?>" placeholder="Zip" >
                                    </div>
                                    <div id="alertmsg" style="color:red;"></div>
                                </div>
                                
                           
                              
                            </div>

                              

                           
                        </div>
                    </div>
                 
                </div>

                 <input type="hidden" name="id" value="<?php echo $personalInfo['id']; ?>" >
              
            </div>

               <div class="row">
                      <div class="col-lg-12" style="margin-bottom:5px;text-align:right;">
                            <button type="submit" class="btn btn-primary">Update Info</button>
                      </div>
              </div>

         
      </form>

      
 <?php  } 

   else { ?>
       <form method="post" action="<?php echo base_url();?>Signup_controller/personalProfile/<?php echo $personalInfo['id']; ?>" >
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                   PERSONAL INFORMATION
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Last Login</label>
                                            <input class="form-control" name="lastlogin" value="<?php echo date("m-d-Y",strtotime($personalInfo['Last_login'])); ?>" placeholder="" disabled>
                                        </div>
                                                                           
                                </div>

                                
                                 <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Last IP</label>
                                            <input class="form-control" name="Ip_address" value="<?php echo $_SERVER['REMOTE_ADDR']  ?>" placeholder="" disabled>
                                        </div>
                                                                           
                                </div>

                            </div>


                         
                             <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" name="father_name" value="<?php echo $personalInfo['first_name']; ?>" placeholder=" Name" required>
                                    </div>
                                                                           
                                </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                            <label> Last Name</label>
                                            <input class="form-control" name="father_last_name" value="<?php echo $personalInfo['last_name']; ?>" placeholder=" Name" >
                                        </div>
                                                
                                                                           
                                </div>  
                            </div>




                             <div class="row">
                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input class="form-control" name="email" value="<?php  echo $personalInfo['email']; ?>"placeholder=" " disabled>
                                        </div>
                                </div>  

                                   <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Cell </label>
                                            <input type="tel" class="form-control" pattern="^\d{3}-\d{3}-\d{4}$" name="cell_phone" value="<?php  echo $personalInfo['phone']; ?>" placeholder="123-456-7890" maxlength="12" required>
                                        </div>
                                                                           
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" name="address" value="<?php echo $personalInfo['Address'];?>" placeholder="Address" required>
                                        </div>
                                </div> 


                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>City</label>
                                            <input class="form-control" name="city" value="<?php echo $personalInfo['City'];?>" placeholder="City" required>
                                        </div>
                                </div>   
                            </div>



                            <div class="row">
                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label> State</label>
                                            <input class="form-control" name="state" value="<?php echo $personalInfo['State'];?>" placeholder="State" required>
                                        </div>
                                </div>


                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label> Zip</label>
                                            <input class="form-control" name="zip" value="<?php echo $personalInfo['Zip']; ?>" placeholder="Zip">
                                        </div>
                                </div>
                           
                              
                            </div>

                           
                        </div>
                    </div>
                 
                </div>

                 <input type="hidden" name="id" value="<?php echo $personalInfo['id']; ?>" >
              
            </div>

               <div class="row">
                      <div class="col-lg-12" style="margin-bottom:5px;text-align:right;">
                            <button type="submit " class="btn btn-primary ">Update Info</button>
                      </div>
              </div>

         
      </form>

 <?php  }  ?>


    </div>




   <?php include('application/views/Footer/footer.php') ?>


<script>

  $("form").submit(function(){
       
    // var zip = $('#zip').val();
    // var reg = /^[0-9]+$/;
    // var errorMessage = "";
    // //alert(zip);
    // if (zip == ''){
    // errorMessage = "*Zipcode required!"; 
    // $('#alertmsg').html('');
    // $('#alertmsg').append(errorMessage);
    // return false;
    // }
    // else if ((zip.length)< 5 || (zip.length)>5 ){
    // errorMessage = "*zipcode should only be 5 digits"; 
    //  $('#alertmsg').html('');
    // $('#alertmsg').append(errorMessage); // $("#movie-data").append(data);
    // return false;
    // }
    // else if (!reg.test(zip)){
    // errorMessage = "*zipcode should be numbers only"; 
    // $('#alertmsg').html('');
    // $('#alertmsg').append(errorMessage);
    // return false;
    // }
    // else
    // {
    //     return true;
    // }
        
       
    });

</script>