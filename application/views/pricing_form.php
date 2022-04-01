<script src="<?php echo base_url(); ?>assets_booking/js/pricing.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css2/style.css">
<?php
$hidden_id = ($id !='') ? $id : ''; 
$sports_id = ($id !='') ? $pricing_details['sid'] : '';
$location_id = ($id !='') ? $pricing_details['lid'] : '';
$court_id = ($id !='') ? $pricing_details['cid'] : '';
$court_from_time = ($id !='') ? $pricing_details['from_time'] : '';
$court_to_time = ($id !='') ? $pricing_details['to_time'] : '';
$day_type = ($id !='') ? $pricing_details['day_type'] : '';
$fromday = ($id !='') ? $pricing_details['fromday'] : '';
$today = ($id !='') ? $pricing_details['today'] : '';
$holiday_id = ($id !='') ? $pricing_details['holiday_id'] : '';
$count = ($id !='') ? count($pricing_slot_details) : '1';

//echo '<pre>';
//print_r($pricing_slot_details);
//die();
?>
<section class="content-header">
<h1>Pricing</h1>
<ol class="breadcrumb">
<li><i class="fa fa-cogs" aria-hidden="true"></i> Settings</li>
<li class="active">Add Pricing</li>
</ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content admin_table">
<h3 class="mar_0">Edit Pricing</h3>
<form method="post" action="<?php echo $form_action; ?>" name="add_pricing" id="add_pricing" enctype="multipart/form-data" > 
    <input type="hidden" name="slotcount" id="slotcount" value="<?php echo $count; ?>">
    <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $hidden_id; ?>">
    <input type="hidden" name="hidden_court_id" id="hidden_court_id" value="<?php echo $court_id; ?>">
    <input type="hidden" name="hidden_location_id" id="hidden_location_id" value="<?php echo $location_id; ?>">
    <input type="hidden" name="hidden_court_ftime" id="hidden_court_ftime" value="<?php echo date('h:i A', strtotime($court_from_time)); ?>">
    <input type="hidden" name="hidden_court_totime" id="hidden_court_totime" value="<?php echo date('h:i A', strtotime($court_to_time)); ?>">
<h4 class="pad_top_0">Sports</h4>
<div class="col-sm-12 col-md-4 mar_top_20 pad_le_ri_0">
    <select name="sports" id="sports">
        <option value=''>- Set Pricing For -</option>
        <?php foreach($sports_list as $key => $sports) { ?>
        <option value="<?php echo $sports['id']; ?>" <?php if($id!=''){ if($sports_id == $sports['id']){ echo 'selected'; } } ?> ><?php echo $sports['sportsname']; ?></option>
        <?php } ?>
    </select>
</div>
<div class="clearfix"></div>

<h4 class="pad_top_0">Location</h4>
<div class="col-sm-12 col-md-4 mar_top_20 pad_le_ri_0">
    <select name="location" id="location">
        <option value=''>- Select Location -</option>
    </select>
</div>
<div class="clearfix"></div>

<h4 class="pad_top_0">Court</h4>
<div class="col-sm-12 col-md-4 mar_top_20 pad_le_ri_0">
    <select name="court" id="court">
	<option value="">- Select Court -</option>       
</select>
</div>
<div class="clearfix"></div>

<h4 class="pad_top_0">Day Type</h4>
<p>
<input type="radio" name="day_type" id="single" <?php if($id !=''){ if($day_type == '0'){ ?> checked="checked" <?php } } else{ ?> checked="checked" <?php } ?> value="0" > Single Day
<input type="radio" name="day_type" id="multiple" <?php if($id !=''){ if($day_type == '1'){ ?> checked="checked" <?php } } ?> value="1"> Multiple Day
<input type="radio" name="day_type" id="holiday" <?php if($id !=''){ if($day_type == '2'){ ?> checked="checked" <?php } } ?> value="2"> Holiday
&nbsp; (<span class="active" style="font-size: 12px;">Note: Selection can only be made between monday and sunday</span>)
</p>


<div class="col-sm-12 col-md-6 pad_le_ri_0 hide_single" <?php if($id !=''){ if($day_type == '0' || $day_type == '1'){ ?> style="display:block;" <?php } else { ?> style="display:none" <?php } } ?> >
    <select name="from_day" id="from_day">
        <option value="">- Select From day -</option>
        <?php foreach($day_list as $key => $days) { ?>
        <option value="<?php echo $days['dayid']; ?>" <?php if($id!=''){ if($fromday == $days['dayid']){ echo 'selected'; } } ?> ><?php echo $days['dayname']; ?></option>
        <?php } ?>
    </select>
</div>

<div class="col-sm-12 col-md-1 hide_multiple" <?php if($id !=''){ if($day_type == '1'){ ?> style="display:block;" <?php } else { ?> style="display:none" <?php } } else { ?> style="display:none" <?php } ?> >
<p class="pad_top_10 text-center">to</p>
</div>

<div class="col-sm-12 col-md-5 pad_le_ri_0 hide_multiple" <?php if($id !=''){ if($day_type == '1'){ ?> style="display:block;" <?php } else { ?> style="display:none" <?php } } else { ?> style="display:none" <?php } ?> >
<select name="to_day" id="to_day">
        <option value="">- Select To day -</option>
        <?php foreach($day_list as $key => $days) { ?>
        <option value="<?php echo $days['dayid']; ?>" <?php if($id!=''){ if($today == $days['dayid']){ echo 'selected'; } } ?> ><?php echo $days['dayname']; ?></option>
        <?php } ?>
    </select>
</div>

<div class="col-sm-12 col-md-5 hide_holiday" <?php if($id !=''){ if($day_type == '2'){ ?> style="display:block;" <?php } else { ?> style="display:none" <?php } } else { ?> style="display:none" <?php } ?> >
    <select name="holidays" id="holidays">
        <option value="">- Select Holiday -</option>
        <?php foreach($holidays as $key => $holiday) { ?>
        <option value="<?php echo $holiday['id']; ?>" <?php if($id!=''){ if($holiday_id == $holiday['id']){ echo 'selected'; } } ?> ><?php echo $holiday['holidaydate']; ?></option>
        <?php } ?>
    </select>
</div>

<div class="clearfix"></div>

<h4 class="pad_top_0">Club Timings: </h4>
<p id="show_court_timings"></p>

<!-- Slot set div Starts here -->
<div id="timerange" class="mar_top_20">  
    <?php for($i=1; $i<=$count; $i++){
    $pricing_timeslot_id = ($id !='') ? $pricing_slot_details[$i-1]['id'] : '';    
    $from_time = ($id !='') ? $pricing_slot_details[$i-1]['fromtime'] : ''; 
    $to_time = ($id !='') ? $pricing_slot_details[$i-1]['totime'] : ''; 
    $cost = ($id !='') ? $pricing_slot_details[$i-1]['cost'] : ''; 
    if($i == 1){
        ?>
    <div id="slot_set_1" class="mar_top_20">
        <div class="col-sm-12 col-md-10">
            <div class="col-sm-12 col-md-2"><p class="form_text1 pad_top_10 text-right">From</p></div>
            <div class="col-sm-12 col-md-2">
                <div class="input-group bootstrap-timepicker timepicker">
                    <input id="timepicker1" name="from_time[]" type="text" class="form-control input-small timepickertext_from" value="<?php echo $from_time; ?>" data-rule-required="true" readonly />
                    <input type="hidden" name="pricing_timeslot_id[]" value="<?php echo $pricing_timeslot_id; ?>">
                    <input type="hidden" name="current_slotcount[]" class="current_slotcount" value="<?php echo $i; ?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-2">
                <p class="form_text1 pad_top_10 text-right">To</p>
            </div>
            <div class="col-sm-12 col-md-2">
                <div class="input-group bootstrap-timepicker timepicker">
                    <input id="timepicker1A" name="to_time[]" type="text" class="form-control input-small timepickertext_to" value="<?php echo $to_time; ?>" data-rule-required="true" readonly />
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-2">
                <input type="text" id="slot_price1" name="slot_price[]" class="timeslot_price numeric_input" value="<?php echo $cost; ?>" data-rule-required="true" />
            </div>	
            <div class="clearfix"></div>
            <div id="showslot" class="mar_top_10" style="display: none;">
                <div class="col-sm-6 col-md-1 hidden-sm hidden-xs"></div>
                <div class="col-sm-6 col-md-2 hidden-sm hidden-xs"></div>
                <div class="col-sm-6 col-md-1 hidden-sm hidden-xs"></div>
                <div class="col-sm-6 col-md-2 hidden-sm hidden-xs"></div>
                <div class="col-sm-6 col-md-1 hidden-sm hidden-xs"></div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-sm-12 col-md-2"> </div>
        <div class="clearfix"></div>
    </div>
    <?php } else { ?>
    
    <div id="slot_set_<?php echo $i; ?>" class="mar_top_20">
        
        <div class="col-sm-12 col-md-10">
        <div class="col-sm-12 col-md-2"><p class="form_text1 pad_top_10 text-right">From</p></div>
        <div class="col-sm-12 col-md-2">
        <div class="input-group bootstrap-timepicker timepicker">
            <input id="timepicker<?php echo $i; ?>" name="from_time[]" type="text" class="form-control input-small timepickertext_from" value="<?php echo $from_time; ?>" data-rule-required="true" readonly />
            <input type="hidden" name="pricing_timeslot_id[]" value="<?php echo $pricing_timeslot_id; ?>">
            <input type="hidden" name="current_slotcount[]" class="current_slotcount" value="<?php echo $i; ?>">
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
        </div></div>

        <div class="col-sm-12 col-md-2">
        <p class="form_text1 pad_top_10 text-right">To</p></div>
        <div class="col-sm-12 col-md-2">
        <div class="input-group bootstrap-timepicker timepicker">
            <input id="timepicker<?php echo $i; ?>A" name="to_time[]" type="text" class="form-control input-small timepickertext_to" value="<?php echo $to_time; ?>" data-rule-required="true" readonly />
        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
        </div></div>

        <div class="col-sm-12 col-md-2">
            <input type="text" id="slot_price<?php echo $i; ?>" class="timeslot_price numeric_input" name="slot_price[]" value="<?php echo $cost; ?>" data-rule-required="true" />
        </div>
        <div class="clearfix"></div>
        <div id="showslot1" class="mar_top_10" style="display: none;">
        <div class="col-sm-6 col-md-1 hidden-sm hidden-xs"></div>
        <div class="col-sm-6 col-md-2 hidden-sm hidden-xs"></div>
        <div class="col-sm-6 col-md-1 hidden-sm hidden-xs"></div>
        <div class="col-sm-6 col-md-2 hidden-sm hidden-xs"></div>
        <div class="col-sm-6 col-md-1 hidden-sm hidden-xs"></div>
        <div class="clearfix"></div></div>
        <div class="clearfix"></div>
        </div>
        <div class="col-sm-12 col-md-2">
        <button type="button" title="Remove" data-slot="<?php echo $i; ?>" class="btn btn-danger btn-md removetimerange">
        <i class="glyphicon glyphicon-trash"></i></button>
        </div><div class="clearfix"></div>
        
        </div>
    
    
    <?php } } ?>   
</div>
<!-- Slot set div ends here -->

	<div class="clearfix"></div>
	<div class="col-sm-12 col-md-12 mar_top_20">
        <button type="button" id="addtimerange" class="btn btn-success btn-xs addtimerange">
            <i class="fa fa-plus" aria-hidden="true">

            </i> &nbsp; Add Time Range</button>
             <button type="submit" class="btn btn-primary pull-right" id="sbt_btn">Update Price</button></div>
	<div class="clearfix"></div>
        
</form>
</section>
<!-- /.content -->

<script type="text/javascript">
$(function () {
//Date picker
$('#datepicker, #datepicker1').datepicker({
autoclose: true
});
});
</script>
<!-- DataTables -->

<script type="text/javascript">
$(function () {
$("#example1").DataTable();
$('#example2').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": true
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){

$('#addslot').click(function(){
$("#showslot").show("slow");
$("#addslot").hide("slow");
});
$('#removeslot').click(function(){
$("#showslot").hide("slow");
$("#addslot").show("slow");
});
$('#addtimerange').click(function(){
$("#timerange").show("slow");
});

//$('#removetimerange').click(function(){
//$("#timerange").hide("slow");
//});

$('#addslot1').click(function(){
$("#showslot1").show("slow");
$("#addslot1").hide("slow");
});
$('#removeslot1').click(function(){
$("#showslot1").hide("slow");
$("#addslot1").show("slow");
});
});
</script>

</body>
</html>