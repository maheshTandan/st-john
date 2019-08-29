
<!-- <script type="text/javascript" src="<?php  // echo base_url();?>application/js/jquery.min.js" ></script>  -->
<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery.dataTables.min.js" ></script>
 <script type="text/javascript" src="<?php echo base_url();?>application/js/dataTables.buttons.min.js" ></script>
 <script type="text/javascript" src="<?php echo base_url();?>application/js/buttons.print.min.js" ></script>
  <script type="text/javascript" src="<?php echo base_url();?>application/js/moment.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/metisMenu.min.js" ></script>     
<script type="text/javascript" src="<?php echo base_url();?>application/js/raphael.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/morris.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/morris-data.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/sb-admin-2.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>application/js/jquery.slimscroll.min.js" ></script>





<!-- <script type="text/javascript" src="<?php echo base_url();?>application/js/bootstrap-datepicker.js" ></script> -->
<!-- Include Date Range Picker -->
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

 
 
 
 
 
 
 <footer class="page-footer font-small blue pt-4 mt-4">

            <!-- Footer Links -->
            <div class="container text-md-left">

                <!-- Grid row -->
                <div class="row">

                    <!-- Grid column -->
                    <div class="col-md-3 mt-md-0 mt-3">

                        <!-- Content -->
                        <h5 class="text-uppercase">WAYS TO CONTRIBUTE<img src="<?php echo base_url(); ?>application/images/play.png" class="play"></h5>
                        <p>Every donation is precious.Whether you are looking to contribute your time, talent or treasure, feel free to visit our ongoing events to see ways you can give. If you have any questions or can’t find what you’re looking for, please feel free to get in touch with us!</p>

                    </div>
                    <!-- Grid column -->



                    <!-- Grid column -->
                    <div class="col-md-3 mb-md-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase">CONTACT <img src="<?php echo base_url(); ?>application/images/play.png" class="play"></h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#!"><i class="fa fa-map-marker mr-10"></i><strong>Address:</strong>
                                    502 S. Park Blvd., Streamwood, IL 60107</a>
                            </li>
                            <hr>
                            <li>
                                <a href="#!"><i class="fa fa-phone mr-10"></i><strong>Phone:</strong> 630.837.6500</a>
                            </li>
                            <li>
                                <a href="#!"><i class="fa fa-envelope mr-10"></i><strong>Email:</strong> parish@mystjohns.org</a>
                            </li>
                            <li>
                                <a href="#!"><i class="fa fa-globe mr-10"></i><strong>Website:</strong> www.mystjohns.org/</a>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 mb-md-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase">QUICK LINKS<img src="<?php echo base_url(); ?>application/images/play.png" class="play"></h5>

                        <ul class="list-unstyled menu">
                            <li>
                                <a href="#!">Home</a>
                            </li>
                            <li>
                                <a href="http://52.76.89.150/sites/stjohn/?page_id=33654" target="_blank">Parish Staff</a>
                            </li>
                            <li>
                                <a href="#!">New Parishioners</a>
                            </li>
                            <li>
                                <a href="http://52.76.89.150/sites/stjohn/?page_id=33229" target="_blank">Gallery</a>
                            </li>
                            <li>
                                <a href="http://52.76.89.150/sites/stjohn/?page_id=32856" target="_blank">About Us</a>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->
                    <!-- Grid column -->
                    <div class="col-md-3 mb-md-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase">OUR SUBSCRIBERS<img src="<?php echo base_url(); ?>application/images/play.png" class="play"></h5>

                     <!--    <ul class="list-unstyled">
                            <li>
                                <a href="#!">Link 1</a>
                            </li>
                            <li>
                                <a href="#!">Link 2</a>
                            </li>
                            <li>
                                <a href="#!">Link 3</a>
                            </li>
                            <li>
                                <a href="#!">Link 4</a>
                            </li>
                        </ul> -->

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </div>
            <!-- Footer Links -->



        </footer>
        <footer id="footer-nav" class="site-footer">
            <div class="container"><div class="row">

                    <div class="col-md-3 col-md-push-9">
                        <div id="footer-socials"><div class="socials inline-inside socials-colored">
                                <a href="#" target="_blank" title="facebook" class="socials-item"><i class="fa fa-facebook "></i></a>
                                <a href="#" target="_blank" title="twitter" class="socials-item"><i class="fa fa-twitter"></i></a>
                                <a href="#" target="_blank" title="googleplus" class="socials-item"><i class="fa fa-google-plus"></i></a>
                                <a href="#" target="_blank" title="youtube" class="socials-item"><i class="fa fa-youtube"></i></a>
                            </div></div><!-- #footer-socials -->
                    </div>

                    <div class="col-md-6">
                    </div>

                    <div class="col-md-3 col-md-pull-9"><div class="footer-site-info">Copyrights © St John the Evangelist Catholic Church. All Rights Reserved</div></div>

                </div></div>
        </footer>
    </div>
       






<script>
	$(document).ready(function(){
            
                     function setHeight() {
                                            windowHeight = $('#page-wrapper').height();
                                            //alert(windowHeight);
                                            $('.sidebar').css('min-height', windowHeight);
                                            };
                                            setHeight();

                                            $(window).resize(function() {
                                            setHeight();
                                    });
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		});
	
    
                    
        $(document).on('change', '.menuRadio', function (){ 
            
            $(':input[type="submit"]').prop('disabled', true);
             $(".itemCheck").removeAttr("disabled");
             $( ".itemCheck" ).prop( "checked", false );

            
            // $('input[type=check][name=optionsCheck]:unchecked');
        
//           var id = $('input[type=radio][name=optionsRadios]:checked').attr('id');
//            //console.log(id);
//                    $.ajax({
//                        url: 'menuitemsel/ajaxitem',
//                        data: {'id': id}, // change this to send js object
//                        type: "post",
//                        success: function (data) {
//                            //document.write(data); just do not use document.write
//                            console.log(data);
//                        }
//                    });
//$('#itemdiv').show();
        });
        
        
         
                var checkboxes = $("input[type='checkbox']"),
                submitButt = $("input[type='submit']");

                checkboxes.click(function() {
                submitButt.attr("disabled", !checkboxes.is(":checked"));
                });   
    
    });
</script>




</body>

</html>


