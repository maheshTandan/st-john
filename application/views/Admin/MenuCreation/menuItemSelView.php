<?php include('application/views/services/service.php'); ?>

<style>
    .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso 
    form{font-family: Arial, Helvetica, sans-serif; color: black}
    .bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} 
    .asteriskField{color: red;}
    .MT-50{margin-top: 50px}
</style>






<div id="page-wrapper" style="min-height: 327px;">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="page-header">Hot Lunch Calendar</h1>
        </div>
<!--        <div class="col-lg-2 ">
            <button class="btn btn-submit btnsave page-header" type="button" id="clonedata" name="btnsave" value="Add Item" style="margin-right:5px; padding: 5px 25px">Clone</button>
        </div>-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                        <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>menuitemsel/insertmenuitem">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <div class="form-group text-center">
                                        <?php
                                            $dt = new DateTime;
                                            $dt1 = new DateTime;
                                           
                                            if (isset($_GET['year']) && isset($_GET['week'])) {
                                                $dt->setISODate($_GET['year'], $_GET['week']);
                                                $dt1->setISODate($_GET['year'], $_GET['week']);
                                            } else {
                                                $dt->setISODate($dt->format('o'), $dt->format('W'));
                                                $dt1->setISODate($dt->format('o'), $dt->format('W'));
                                            }
                                            $year = $dt->format('o');
                                            $week = $dt->format('W');
                                            $year1 = $dt1->format('o');
                                            $week1 = $dt1->format('W');
                                            ?>
                                            <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="caltab" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                                <thead>
                                                    <tr role="row"><th><a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">Pre Week</a></th><th colspan="5" class="text-center">Weekly Calendar</th><th> <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Next Week</a> <!--Next week--></th></tr>
                                                    <tr><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th class="text-off">Saturday</th><th class="text-off">Sunday</th></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <?php
                                                    //print_r($checkData);
                                                    $arrayname = array();
                                                    do{
                                                        $arrayname[$dt1->format('Y-m-d')] = 'Not assigned.';
                                                        $dt1->modify('+1 day'); 
                                                      }while($week1 == $dt1->format('W'));
                                                     // print_r($arrayname);
                                                    for($j = 0; $j<count($checkData); $j++)
                                                    {
                                                      if (array_key_exists($checkData[$j]['date'],$arrayname))
                                                        {
                                                            $arrayname[$checkData[$j]['date']] = $checkData[$j]['item_name'];
                                                        }
                                                       
                                                    }
                                                 // print_r($arrayname);
                                                    do {  
                                                            $html = '';
                                                            $dtate =trim($dt->format('Y-m-d'));
                                                            $dtate = strtotime($dtate);
                                                            $distinctGrade = $this->obj->distinctGrade($locationid,trim(date('Y-m-d', $dtate)));
                                                            for($i = 0; $i < count($menuObj); $i++)
                                                            {
                                                               $html.='<div class="popover__wrapper">
                                                                                <a href="'.  base_url().'menuitemsel/menuselitemview/'.trim(date('Y-m-d', $dtate)).'">
                                                                                    <h2 class="popover__title">'.$menuObj[$i]['menu_name'].'</h2>
                                                                                </a><div style="display:none;" class="push popover__content">';
                                                            }
                                                            $dtate = strtotime(date('Y-m-d', strtotime("+1 day", $dtate))); ?>
                                                        <td> <a href="<?php echo base_url() ?>menuitemsel/menuselitemview/<?php echo trim(date('Y-m-d', strtotime("-1 day", $dtate))); ?>" style="color:black;"> <?php echo $dt->format('d M Y') ?> </a>
                                                                <div>
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item tooltip-display">
                                                                            <span data-toggle="tooltip" data-placement='bottom' title="<?php echo $arrayname[$dt->format('Y-m-d')]; ?>"> 
                                                                                 <a href="<?php echo base_url() ?>menuitemsel/menuselitemview/<?php echo trim(date('Y-m-d', strtotime("-1 day", $dtate))); ?>" <?php if($arrayname[$dt->format('Y-m-d')] =='Not assigned.'){?> style="color:red;" <?php }?>> 
                                                                            <?php 
                                                                                    if($arrayname[$dt->format('Y-m-d')] =='Not assigned.'){
                                                                                        echo $arrayname[$dt->format('Y-m-d')];
                                                                                    }
                                                                                    else{
                                                                                            $arr = explode(",", $arrayname[$dt->format('Y-m-d')]); 
                                                                                            $output = implode(', ', array_slice($arr, 0, 5));
                                                                                            echo $output.".....view more.";
                                                                                    }
                                                                                   
                                                                            ?>
                                                                                </a>
                                                                            </span>
                                                                        </li>
                                                                    </ul>
                                                                </div><?php  $html."</td>\n";
                                                            $dt->modify('+1 day'); 
                                                        }while ($week == $dt->format('W'));
                                            ?>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="loading" id="loading-image" style="display: none;">
        </div>
</div>



<?php include('application/views/Footer/footer.php'); ?>


<script type="text/javascript">
//    $(document).ready(function () {
//        $(document).on('click','#clonedata',function(event) {
//               $.ajax({
//                url: '<?php //echo base_url() ?>menuitemsel/cloneData',
//                //async: true,
//                data: {},
//                type: 'POST',
//                dataType: 'json',
//                beforeSend: function(){
//                    $("#loading-image").show();
//                    //alert('before send');
//                },
//                success: function (data) {
//                            $("#loading-image").hide();
//                            var dialog = bootbox.dialog({
//                                message: '<p class="text-center">Cloning has been done.</p>',
//                                closeButton: false
//                                });
//                                setTimeout(function(){
//                                dialog.modal('hide');
//                                location.href = '<?php //echo base_url() ?>menuitemsel/index';
//                            }, 2000);
//                            
//                },
//                 error: function ( data ) {
//                       
//                    }
//            });
//        });
//    });
</script>
