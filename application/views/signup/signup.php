
<?php include('application/views/Header/header.php'); ?>


<script>
  
$(document).ready(function(){
   var i =0;  
   
    $(document).on('click','#optionalChild', function(){


        var count = 0;
        if(count == 0){
            $(".showChild").slideDown("slow");
            count++;
        }


       


        
     if(i>0){
        
        $('#field').append('<div id="field'+i+'"><div class="col-lg-12"><div class="panel panel-default "><div class="panel-heading"> CHILD INFORMATION <button type="button" class="close" aria-label="Close" ><span aria-hidden="true">&times;</span></button></div><div class="panel-body"><div class="row"><div class="col-lg-6"> <div class="form-group"><label>Child First Name</label><input class="form-control" name="cfirst_name[]" value="" placeholder="Child First Name"></div></div><div class="col-lg-6"><div class="form-group"> <label>Child Middle Name</label><input class="form-control"  name="cmiddle_name[]" value="" placeholder="Child Middle Name"> </div></div></div><div class="row"><div class="col-lg-6"><div class="form-group"><label>Child Last Name</label><input class="form-control"  name="clast_name[]" value="" placeholder="Child Last Name" ></div></div><div class="col-lg-6"><div class="form-group"><label>Date of Birth</label><input type="date" class="form-control" name="DOB[]" value="" placeholder="Date of Birth" ></div></div> </div><div class="form-group"><label>Gender of Child : </label><label class="radio-inline"><input type="radio" name="optionsRadiosInline'+i+'[]" value="MALE" >MALE</label><label class="radio-inline"><input type="radio" name="optionsRadiosInline'+i+'[]" value="FEMALE">FEMALE</label></div><div class="row"> <div class="col-lg-6"><div class="form-group"><label>Child Grade & Program Selection</label><select class="form-control gradeClass" name="location[]" data-price='+i+'><option>--Please Select--</option><?php for($i=0; $i< count($GradeProgram);$i++) { ?><option value="<?php echo $GradeProgram[$i]['id']; ?>"><?php echo $GradeProgram[$i]['Grade_name']; ?></option><?php  } ?></select></div></div><div class="col-lg-6" ><div class="form-group"><div id="price'+i+'"></div></div></div></div</div> </div>'); }
        i++;

    });

     $(document).on('click','.close', function(){
         var j =$(this).parents("div");
                // var k = $(j[3]).attr("id");
                   $(j[3]).remove();
                   i--;
            });

      $(".close1").click(function(){
                          $("#field").html("");
                          $("#field").slideUp("slow");
                        });

      $(document).on('change', '.gradeClass', function(){
    
         var selectedChild = $(this).val();
           var val = $(this).attr('data-price');
           console.log(selectedChild);

         $.ajax({
            type: "POST",
             url: '<?php  echo base_url() ?>Signup_controller/ajaxGradeprice',
             
                data: {selectedChild: selectedChild},
                dataType: 'json',
                success:function(data){
                    if(val == undefined)
                    { 
                    
                         $("#price").html("");
                         $("#price").append("<label> Price </label><input class='form-control' name='price[]' value='$"+data.success['price']+"' readonly>"); 
                    }

                    if(val != '')
                    {
                         $("#price"+val).html("");
                         $("#price"+val).append("<label> Price </label><input class='form-control' name='price[]' value='$"+data.success['price']+"' readonly>");
                    }
            }
        });

      });


  });
</script>          
    
  
        <div id="page-wrapper marginzero" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User Registration</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
          <!--   <div class="form_error">
          <?php // echo validation_errors(); ?>
        </div> -->

            <form method="post" action="<?php echo base_url();?>Signup_controller/RegisterUser" >
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                   PARENT INFORMATION
                        </div>
                        <div class="panel-body">
                         
                             <div class="row">
                                <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Father Name</label>
                                            <input class="form-control" name="father_name" value="" placeholder="Father's Name">
                                        </div>
                                                                           
                                </div>

                                

                                  <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Mother Name</label>
                                            <input class="form-control" name="mother_name" value="" placeholder="Mother's Name">
                                        </div>
                                                                           
                                </div>
                            </div>


                             <div class="row">
                                 <div class="col-lg-6">
                                 <div class="form-group">
                                 
                                            <label>Marital Status</label>
                                              <?php echo form_error('marital[]'); ?>
                                            <select class="form-control" name="marital[]">
                                             <option value="" hidden>Select your option</option>     
                                             <?php  for ($i=0; $i< count($marital);$i++) { ?>
                                                <option value="<?php  echo $marital[$i]['id']; ?>"><?php echo $marital[$i]['marital_status']; ?></option>
                                            <?php  } ?>
                                             
                                            </select>
                                        </div>
                                </div>

                                 <div class="col-lg-6">
                                
                                        <div class="form-group">
                                     
                                            <label>Email </label>
                                            <?php echo form_error('email'); ?>
                                            <input  class="form-control" name="email" value=""placeholder="Email Address">
                                        </div>
                                        <?php
                                                if($flag == '1')
                                                { ?>
                                                      <p>Email Id is already registered. Please enter another email. </p>
                                         <?php  } 
                                                ?>
                                      
                                     
                                         
                                </div>
                              
                            </div>


                            <div class="row">
                                 <div class="col-lg-6">
                                   
                                        <div class="form-group">
                                            <label>Cell </label>
                                             <?php echo form_error('cell_phone'); ?>
                                            <input  class="form-control" type="tel" pattern="^\d{3}-\d{3}-\d{4}$" name="cell_phone" value="" placeholder="123-456-7890"  maxlength="12" >
                                        </div>
                                 </div>


                                 <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>Address</label>
                                             <?php echo form_error('address'); ?>
                                            <input class="form-control" name="address" value="" placeholder="Address">
                                        </div>
                                </div> 
                           </div>


                            <div class="row">
                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>City</label>
                                             <?php echo form_error('city'); ?>
                                            <input class="form-control" name="city" value="" placeholder="City">
                                        </div>
                                </div>

                                 <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>State</label>
                                             <?php echo form_error('state'); ?>
                                            <input class="form-control" name="state" value="" placeholder="State">
                                        </div>
                                </div>

                           
                              
                            </div>

                            <div class="row">
                               

                                <div class="col-lg-6">
                                
                                        <div class="form-group">
                                            <label>Zip</label>
                                              <?php echo form_error('zip'); ?>
                                            <input  class="form-control" name="zip"  value="" placeholder="Zip">
                                        </div>
                                </div>
                           
                              
                            </div>


                              <div class="row" style="display: none;">
                                <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Location</label>
                                                   <select class="form-control" name="location1[]">
                                                <option>--Please Select--</option>
                                                 <?php foreach ($location as $key => $value) { ?>
                                                <option><?php echo $value['location']; ?></option>
                                           
                                            <?php  } ?>
                                             </select>
                                        </div>
                                </div>
                             </div>
                          
                        </div>
                    </div>
                 
                </div>
              
            </div>

 
            <div class="row">
                    <div class="col-lg-12">
                          <input type="button" value="Add more" class="btn btn-info btn-submit " id="optionalChild">
               
                    </div>
            </div>




             <div class="row showChild" id="field" style="display: none;" >
             <!--   <div class="row" style="float: right;">
                    <div class="col-lg-12">
                        <input type="button" value="Add More Child" class="btn btn-info btn-submit" id="add-more">
               
                    </div>
                 </div> -->
                <div class="col-lg-12">
                    <div class="panel panel-default ">
                        <div class="panel-heading">
                           CHILD INFORMATION
                       <button type="button" class="close1" aria-label="Close" style="float:right;"><span aria-hidden="true" style="color: black;">&times;</span></button>



                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Child First Name</label>
                                            <input class="form-control" name="cfirst_name[]" value="" placeholder="Child First Name">
                                        </div>
                                       
                                      
                                </div>


                                 <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Child Middle Name</label>
                                            <input class="form-control"  name="cmiddle_name[]" value="" placeholder="Child Middle Name">
                                        </div>
                                       
                                      
                                </div>
                           
                              
                            </div>



                              <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Child Last Name</label>
                                            <input class="form-control"  name="clast_name[]" value="" placeholder="Child Last Name" >
                                        </div>
                                       
                                      
                                </div>


                                 <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="date" class="form-control" name="DOB[]" value="" placeholder="Date of Birth" maxlength="8" >
                                        </div>
                                       
                                      
                                </div>
                           
                              
                            </div>


                              <div class="form-group">

                                            <label>Gender of Child : </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline[]"  value="MALE" >MALE
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="optionsRadiosInline[]"  value="FEMALE">FEMALE
                                            </label>
                             </div>





                              <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Child Grade & Program Selection</label>
                                             <select class="form-control gradeClass" name="location[]">
                                                <option>--Please Select--</option>       
                                             <?php  for ($i=0; $i< count($GradeProgram);$i++) { ?>
                                                <option value="<?php  echo $GradeProgram[$i]['id']; ?>"><?php echo $GradeProgram[$i]['Grade_name']; ?></option>
                                            <?php  } ?>
                                             
                                            </select>
                                        </div>
                                       
                                      
                                </div>


                                <div class="col-lg-6" >
                                      <div class="form-group">
                            
                                       <div id="price">
                                           
                                       </div>
                                     </div>
                                </div>

  
                            </div>

                           
                          
                        </div>
                        
                    </div>
                   
                       
                </div>
                
              
            </div>


        

         <div class="row">
                <div class="col-lg-12" style="margin-bottom:5px;text-align:right;">
                  <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

         
      </form>
          
        </div>
    </div>
   



    <?php include('application/views/Footer/footer.php') ?>
   