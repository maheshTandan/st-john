<?php include('application/views/services/service.php') ?>  


<style>
    .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso 
    
    .bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} 
    .asteriskField{color: red;}
    .MT-50{margin-top: 50px}    
    .MT-25{margin-top: 25px}
    
    .prev_sign a, .next_sign a{
    color:white;
    text-decoration: none;
    }
    tr.week_name{
    font-size: 16px;
    font-weight:400;
    color:red;
    width: 10px;
    background-color: #efe8e8;
    }
    .highlight{
    background-color:#25BAE4;
    color:white;
    height: 22px;
    padding-top: 2px;
    padding-bottom: 7px;
    }
    
</style>


<div id="page-wrapper" style="min-height: 327px;">

   
   <div class="alert alert-success" style="display: none;">

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3>Parent Lists</h3>
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
                                            <th>Parent name</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Action</th>
                                    </thead>
                                    <tbody id="showdata1">
                                          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
                
                <div id="showchildren">
                    <div id="loading-image" class="text-center" style="display:none;">
                        <img  src="<?php echo base_url();?>application/images/ajax-loader.gif"/>
                    </div>
                </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>  
</div>



<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
          <form id="myForm" action="" method="post" class="form-horizontal">
              <div class="row">

                  <div class="col-sm-6">
                      <div class="form-group clearfix">
                          <label class="control-label col-sm-3 requiredField" for="date">
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
                                  <input class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" type="text"/>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-6 ">
                      <div class="form-group" id="showmenu">
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group col-sm-12" id="showitem">
                      </div>
                  </div>

                  <input type="hidden" name="childid" id="childid" value="" />
              </div>

            </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
$(document).ready(function(){
     showParents();
    
    
    
    showAllChildren();
    showMenu();
   

   $('.itemCheckBox').on('change', function(){
       alert('divesh');
   });
    

    $('#btnSave').click(function(){

			var url = $('#myForm').attr('action');
			var data = $('#myForm').serialize();
                        var menuName = $('input[name=optionsRadio]:checked'); 
                        var itemName = $('.itemCheck'); //console.log(itemName); exit;
			var result = '';  //console.log(menuName.val());
                        var dateData = $('input[name=date]'); //console.log(dateData); exit;
                        if(dateData.val()==''){
                            dateData.parent().parent().addClass('has-error');
			}else{
				dateData.parent().parent().removeClass('has-error');
				result +='1';
			}
			if(menuName.val()==undefined){
                           $('.menuRadio').parent().parent().addClass('has-error');
			}else{
				$('.menuRadio').parent().parent().removeClass('has-error');
				result +='1';
			}
			if(itemName.is(":checked")==false){
				itemName.parent().parent().addClass('has-error');
			}else{
				itemName.parent().parent().removeClass('has-error');
				result +='2';
			}

			if(result=='112'){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: data,
					//async: false,
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#myModal').modal('hide');
							$('#myForm')[0].reset();
              showAllChildrenMenu();
							if(response.type=='add'){
								var type = 'added'
							}else if(response.type=='update'){
								var type ="updated"
							}
							$('.alert-success').html('Menu '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
							showAllEmployee();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Could not add data');
					}
				});
			}
		});

    
    
    
    $('#showdata1').on('click', '.view-children', function(){
       
        var parent_id = $(this).attr('data');
        //$('#childid').val(child_id);
        $.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?php echo base_url() ?>parentsel/parentchildrenlist',
					data: { parent_id : parent_id },
					//async: false,
					dataType: 'json',
                                        beforeSend: function() {
                                            $("#loading-image").show();
                                        },
					success: function(data){
                                            //alert(data[0].first_name);
                                            
                                            $("#loading-image").hide();
                                            if(data.length > 0)
                                            {
                                                $('#showchildren').html('');
                                                var html = '';
                                                var i, j;
                                                html +='<div class="panel-heading"><h3>Children Lists</h3></div><div class="panel-body"><div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-12"><table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;"><thead><tr role="row"><th>Sr No.</th><th>Date</th><th>Children name</th><th>Menu</th><th>Item</th><th>Action</th></thead><tbody id="showdata123">';
                                               
                                                //console.log(data[2].item_name.split(","));  exit;
                                                for(i=0; i<data.length; i++)
                                                {
                                                    var dynamicItemTD= '';
                                                    var arr_itemID = data[i].item_id.split(",");
                                                    var arr_item = data[i].item_name.split(",");
                                                    for(j=0; j<arr_itemID.length; j++)
                                                    {
                                                        dynamicItemTD +='<div class="checkbox"><label><input type="checkbox" name="optionsCheck[]" id="'+arr_itemID[j]+'" class="itemCheck" value="'+arr_itemID[j]+'" checked>'+arr_item[j]+'</label></div>';
                                                    }
                                                    
                                                   
                                                    html +='<tr><td>'+(i+1)+'</td>'+
                                                           '<td>'+data[i].date+'</td>'+
                                                           '<td>'+data[i].Name+'</td>'+
                                                           '<td>'+data[i].menu_name+'</td>'+
                                                           '<td>'+dynamicItemTD+'</td>'+
                                                           '<td>'+
                                                           '<a href="javascript:;" class="btn btn-info update-data" dataMenuID="'+data[i].menu_id+'"dataItemID[]="'+arr_itemID+'" data1="'+data[i].date+'" data="'+data[i].child_id+'">Update</a>'+
                                                           '</td></tr>';
                                                 
                                                }
                                                html +='</tbody></table></div></div></div> </div>';
                                            $('#showchildren').html(html);
                                           // $('#showchildren').modal('hide');
                                            }
                                            else
                                            {
                                                var html = '';
                                                html +='<div class="panel-heading"><h3>Children Lists</h3></div><div class="panel-body"><div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-12"><table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;"><thead><tr role="row"><th class="btn-danger" style="text-align: center;">No Children for this parent.</th></thead></table></div></div></div> </div>';
                                                $('#showchildren').html(html);
                                            }
                                           
						//if(response.success){
						//	$('#myModal').modal('hide');
						//	$('#myForm')[0].reset();
              //showAllChildrenMenu();
		//					if(response.type=='add'){
		//						var type = 'added'
		//					}else if(response.type=='update'){
		//						var type ="updated"
		//					}
		//					$('.alert-success').html('Menu '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
		//					showAllEmployee();
		//				}else{
		//					alert('Error');
		//				}
					},
					error: function(){
						alert('Could not add data');
					}
				});
        
        
        
        
        
        
        
       // $('#myModal').modal('show');
        //$('#myModal').find('.modal-title').text('Menu Assign');
       // $('#myForm').attr('action', '<?php // echo base_url() ?>menusel/addchildmenu/'+child_id);
    });

     $('#showchildren').on('click', '.update-data', function(){
        var child_id = $(this).attr('data');
        var date_by_child_id = $(this).attr('data1');
        var menu_id = $(this).attr('dataMenuID');
        var itemIDStr = $(this).attr('dataItemID[]');
       // console.log($(this).attr('dataItemID[]')); exit;
       // data[i].item_id.split(",");
        $.ajax({
                                      type: 'ajax',
                                      method: 'post',
                                      url: '<?php echo base_url() ?>parentsel/updatechilditem',
                                      data: { child_id : child_id, date_by_child_id : date_by_child_id, menu_id : menu_id, itemIDStr : itemIDStr },
                                      //async: false,
                                      dataType: 'json',
                                      beforeSend: function() {
                                          $("#loading-image").show();
                                      },
                                      success: function(data){
                                          
                                          alert(data+"Success");
                                        },
                                      error: function(){
                                              alert('Could not add data');
                                      }
                              });
        
        
        
       // console.log(date_by_child_id);
         
     });
    
      $(document).on('change', '.menuRadio', function (){
          
        var menuid = $(this).attr('id');
        showItem(menuid);
      });
    
    
    function showAllChildren(){
           $.ajax({
                   type: 'ajax',
                   url: '<?php echo base_url() ?>menusel/children',
                   //async: true,
                   dataType: 'json',
                   success: function(data){

                                       var html = '';
                                       var i;
                                       for(i=0; i<data.length; i++){

                                               html +='<tr>'+
                                                           '<td>'+(i+1)+'</td>'+
                                                           '<td>'+data[i].first_name+'</td>'+
                                                           '<td>'+
                                                               '<a href="javascript:;" class="btn btn-info item-assign" data="'+data[i].id+'">Assign Menu</a>'+
                                                           '</td>'+
                                                       '</tr>';
                                       }
                                       $('#showdata').html(html);
                               },
                   error: function(){
                           alert('Could not get Data from Database');
                   }
           });
   }

    function showParents(){
         $.ajax({   // b.`date`, a.first_name, c.menu_name, item
                 type: 'ajax',
                 url: '<?php echo base_url() ?>parentsel/parentslist',
                 //async: true,
                 dataType: 'json',
                 success: function(data){

                                     var html = '';
                                     var i;
                                     for(i=0; i<data.length; i++){

                                             html +='<tr>'+
                                                        '<td>'+(i+1)+'</td>'+
                                                        '<td>'+data[i].Name+'</td>'+
                                                        '<td>'+data[i].Address+'</td>'+
                                                        '<td>'+data[i].City+'</td>'+
                                                        '<td>'+data[i].State+'</td>'+
                                                        '<td>'+'<a href="javascript:;" class="btn btn-info view-children" data="'+data[i].id+'">View Children</a>'+'</td>'+
                                                     '</tr>';
                                     }
                                     $('#showdata1').html(html);
                             },
                 error: function(){
                         alert('Could not get Data from Database');
                 }
         });
 }

  

    function showMenu(){
            //alert(child_id);
            $.ajax({
                    type: 'ajax',
                    url: '<?php echo base_url() ?>menusel/showMenu',
                    //async: true,
                    dataType: 'json',
                    success: function(data){
                            var html = '<label>Menu</label>';
                            var i;
                            for(i=0; i<data.length; i++)
                            {
//                                if(data[i].flag == '1')
//                                {
//                                    html +='<div class="radio" id="showmenu"><label><input type="checkbox" name="optionsRadio" id="'+data[i].id+'" class="menuRadio" value="'+data[i].id+'" checked>'+data[i].menu_name+'</label></div>';
//                                }
//                                else
//                                {
                                    html +='<div class="radio" id="showmenu"><label><input type="radio" name="optionsRadio" id="'+data[i].id+'" class="menuRadio" value="'+data[i].id+'">'+data[i].menu_name+'</label></div>';
                                //}
                                
                            }
                            $('#showmenu').html(html);
                    },
                    error: function(){
                            alert('Could not get Data from Database');
                    }
            });
    }
    function showItem(menuid){
    
            var childID = $('#childid').val();
            $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>menusel/showItem/'+childID,
                    //async: true,
                    dataType: 'json',
                    data: {'menuid': menuid},
                    success: function(data){
                            var html = '<label>Items</label>';
                            var i;
                            for(i=0; i<data.length; i++)
                            {
                                if(data[i].flag == '1')
                                {
                                     //html +='<div class="checkbox"><label><input type="checkbox" name="optionsCheck[]" id="'+data[i].id+'" class="itemCheck" value="'+data[i].id+'" checked>'+data[i].item_name+'</label></div>';
                                }
                                else
                                {
                                     html +='<div class="checkbox"><label><input type="checkbox" name="optionsCheck[]" id="'+data[i].id+'" class="itemCheck" value="'+data[i].id+'">'+data[i].item_name+'</label></div>';
                                }
                                
                                
                                
                               
                            }
                            $('#showitem').html(html);
                    },
                    error: function(){
                            alert('Could not get Data from Database');
                    }
            });
    }
});
</script>
