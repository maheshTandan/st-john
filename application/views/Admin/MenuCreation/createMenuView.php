<?php
 //echo $menutotal;
$this->load->view('Header/header');
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
            <h1 class="page-header">Menu Selection</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <form class="form-horizontal" method="post">
                                <div class="row">

                                    <div class="col-sm-4">
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
                                    <div class="col-sm-3 ">




                                        <div class="form-group">
                                            <label>Menu</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" >Break Fast
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Lunch
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Dinner
                                                </label>
                                            </div>
                                        </div>




                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Items</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Paneer Butter Masala
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Chicken Curry
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Dal Tadka
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-2 MT-50"><button class="btn btn-info " name="submit" type="submit">
                                            Add Selection
                                        </button>
                                    </div>
                                </div>
<!--                                <hr>-->
<!--                                <div class="row text-center">
                                    <div class="form-group clearfix">
                                        <div class="">
                                            <button class="btn btn-primary " name="submit" type="submit">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





















<?php

$this->load->view('Footer/footer');
?>