<?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Activity Slot</title>
</head>


<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="<?php echo base_url().'chosen/chosen.min.css';?>">
<link rel="stylesheet" href="<?php echo base_url().'chosen/select2.css';?>">

<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    
    
<style type="text/css">
  .limitedNumbChosen, .limitedNumbSelect2{
  width: 308px;
}
.choiceChosen, .productChosen {
  width: 308px ;
}
#loginForm
{
  font-size: 15px;
  line-height: 20px;
  font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: left;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 12px;
  line-height: 20px;
}
</style>
<script type="text/javascript">



  function Validation()
{
  var game_id = document.getElementById('game_id').value;
  var location_id = document.getElementById('location_id').value;
  var level_id = document.getElementById('level_id').value;
  var lane_court_id = document.getElementById('lane_court_id').value;
  var category = document.getElementById('category').value;
  var status = document.getElementById('status').value;
  var days = document.getElementById('days').value;

  if(game_id=="")
  {
    alert("Please Select Activity");
     return false;
  } 
  else  if(location_id=="")
  {
    alert("Please Select Location");
     return false;
  } 
    else if(level_id=="")
  {
    alert("Please Select level");
     return false;
  } 
   else if(lane_court_id=="")
  {
    alert("Please Select Lane Court");
     return false;
  } 
   else if(category=="")
  {
    alert("Please Select Category");
     return false;
  } 
   else if(status=="")
  {
    alert("Please Select Status");
     return false;
  } 
   else if(days=="")
  {
    alert("Please Select Days");
     return false;
  } 
}

  $(document).ready(function(){
  //Chosen
  $(".limitedNumbChosen").chosen({
    max_selected_options: 2,
    placeholder_text_multiple: "Select Time From"
  })
  .bind("chosen:maxselected", function (){
    window.alert("You reached your limited number of selections which is 2 selections!");
  });
  //Select2
  $(".limitedNumbSelect2").select2({
    maximumSelectionLength: 2,
    placeholder: "Select Time From"
  });
  
  $("#days").select2();
  
});

  $(document).ready(function(){
  //Chosen
  $(".choiceChosen, .productChosen").chosen({});
  //Logic
  $(".choiceChosen").change(function(){
    if($(".choiceChosen option:selected").val()=="no"){
      $(".productChosen option[value='2']").attr('disabled',true).trigger("chosen:updated");
      $(".productChosen option[value='1']").removeAttr('disabled',true).trigger("chosen:updated");
    } else {
      $(".productChosen option[value='1']").attr('disabled',true).trigger("chosen:updated");
      $(".productChosen option[value='2']").removeAttr('disabled',true).trigger("chosen:updated");
    }
  })
})

    $(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });

</script>
<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 300px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Maintenance</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Maintenance</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Activity Slot</a>
                  </li>
                 
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-6 col-12">
            <div class="media width-250 float-right">
              <media-left class="media-middle">
                <div id="sp-bar-total-sales"></div>
              </media-left>
              <div class="media-body media-right text-right">
                 <ul class="list-inline mb-0">
            <li><a href="<?php echo site_url('activity_slot'); ?>" class="btn btn-primary"   ><b>Activity Slot List</b></a></li>
          </ul>
                
              </div>
            </div>
          </div>
        </div>
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Activity Slot</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
         <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Activity</strong>*</div>
                        <div class="col-md-3 control text-left">
                        <select name="game_id" id="game_id" class="form-control choiceChosen"  required="" >
                            <option value="">Select</option>
                            <?php                        
                            $osql1 = "select game_id,game from games ORDER BY game ASC";  
							$oexe1 = $this->db->query($osql1)->result_array();
							foreach($oexe1 as $row1)
							{
								 ?>
                        <option value="<?php echo $row1['game_id'] ?>" <?php if($row1['game_id']==$game_id ){ echo 'selected';} ?>><?php echo $row1['game'] ?>
                         </option><?php }  ?></select>
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Location</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <select name="location_id" id="location_id" class="form-control choiceChosen"  required="" >
                            <option value="">Select</option>
                            <?php                        
                            $osql3 = "select location_id,location from locations ORDER BY location ASC";
							$osql_3 = $this->db->query($osql3)->result_array();
							foreach($osql_3 as $row3)
							{
							?>
                        <option value="<?php echo $row3['location_id'] ?>" <?php if($row3['location_id']==$location_id ){ echo 'selected';} ?>><?php echo $row3['location'] ?>
                         </option><?php }  ?></select>
                        </div>
                    </div>

                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Lane/Court</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <select name="lane_court_id" id="lane_court_id" class="form-control choiceChosen"  required=""  >
                            <option value="">Select</option>
                            <?php                        
							$osql4 = "select id,lane_court from lane_courts ORDER BY  lane_court";  
							$osql4_3 = $this->db->query($osql4)->result_array();
							foreach($osql4_3 as $row4)
							{						  
                            ?>
                        <option value="<?php echo $row4['id'] ?>" <?php if($row4['id']==$lane_court_id ){ echo 'selected';} ?>><?php echo $row4['lane_court'] ?>
                         </option><?php }  ?></select>
                        </div>
                    </div>

                     <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Level</strong>*</div>
                        <div class="col-md-3 control text-left">     
                           <select id="level_id" name="level_id" class="form-control choiceChosen" >
                             <option value="">Select</option>
                            <?php                        
							$osql8 = "select games_level_id,level from game_levels ORDER BY level ASC";                              
							$osql8_3 = $this->db->query($osql8)->result_array();
							foreach($osql8_3 as $row8)
							{	
                            ?>
                        <option value="<?php echo $row8['games_level_id'] ?>" <?php if($row8['games_level_id']==$level_id ){ echo 'selected';} ?>><?php echo $row8['level'] ?>
                         </option><?php }  ?></select>
                        </div></div>


                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Coach</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <select name="coach_id" id="coach_id"  class="form-control choiceChosen"  required="" >
                            <option value="">Select</option>
                            <?php                        
                            $osql5 = "select coach_id,coach_name from coach";  
							$osql5_3 = $this->db->query($osql5)->result_array();
							foreach($osql5_3 as $row5)
							{
														
                            ?>
                        <option value="<?php echo $row5['coach_id'] ?>" <?php if($row5['coach_id']==$coach_id){ echo 'selected';} ?>><?php echo $row5['coach_name'] ?>
                         </option><?php }  ?></select>
                        </div>
                    </div>
					
					<div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Hour</strong>*</div>
                        <div class="col-md-3 control text-left"> 
                          <input id="hour" type="radio" checked required="" data-id="1" value="One" name="hour" <?php if($hour=='One'){ echo 'checked';} ?>/>
                          <label style="margin-left: 10px; margin-right: 10px" >One</label>
                          <input id="hour" type="radio"  value="Two" data-id="2" name="hour" <?php if($hour=='Two'){ echo 'checked';} ?>/>
                          <label style="margin-left: 10px; margin-right: 10px">Two</label>
                           <input id="hour" type="radio" value="Three" data-id="3" name="hour"  <?php if($hour=='Three'){ echo 'checked';} ?>/>
                          <label style="margin-left: 10px; margin-right: 10px">Three</label>
                        </div>
                      </div>

                     <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Slot Time From</strong>*</div>
                        <div class="col-md-3 control text-left">     

                         <select class="limitedNumbSelect2"  name="slot_time_from" id="slot_time_from" class="form-control" required=""  >
<option value="12:00 AM" <?php if($slot_from_time=='12:00 AM'){ echo 'selected';} ?> >12:00 AM</option>
                            <option value="12:15 AM" <?php if($slot_from_time=='12:15 AM'){ echo 'selected';} ?>>12:15 AM</option>
                            <option value="12:30 AM" <?php if($slot_from_time=='12:30 AM'){ echo 'selected';} ?> >12:30 AM</option>
                            <option value="12:45 AM" <?php if($slot_from_time=='12:45 AM'){ echo 'selected';} ?>>12:45 AM</option>
                            <option value="01:00 AM" <?php if($slot_from_time=='01:00 AM'){ echo 'selected';} ?>>01:00 AM</option>
                            <option value="01:15 AM" <?php if($slot_from_time=='01:15 AM'){ echo 'selected';} ?>>01:15 AM</option>
                            <option value="01:30 AM" <?php if($slot_from_time=='01:30 AM'){ echo 'selected';} ?>>01:30 AM</option>
                            <option value="01:45 AM" <?php if($slot_from_time=='01:45 AM'){ echo 'selected';} ?>>01:45 AM</option>
                            <option value="02:00 AM" <?php if($slot_from_time=='02:00 AM'){ echo 'selected';} ?>>02:00 AM</option>
                            <option value="02:15 AM" <?php if($slot_from_time=='02:15 AM'){ echo 'selected';} ?>>02:15 AM</option>
                            <option value="02:30 AM" <?php if($slot_from_time=='02:30 AM'){ echo 'selected';} ?>>02:30 AM</option>
                            <option value="02:45 AM" <?php if($slot_from_time=='02:45 AM'){ echo 'selected';} ?>>02:45 AM</option>
                            <option value="03:00 AM" <?php if($slot_from_time=='03:00 AM'){ echo 'selected';} ?>>03:00 AM</option>
                            <option value="03:15 AM" <?php if($slot_from_time=='03:15 AM'){ echo 'selected';} ?>>03:15 AM</option>
                            <option value="03:30 AM" <?php if($slot_from_time=='03:30 AM'){ echo 'selected';} ?>>03:30 AM</option>
                            <option value="03:45 AM" <?php if($slot_from_time=='03:45 AM'){ echo 'selected';} ?>>03:45 AM</option>
                            <option value="04:00 AM" <?php if($slot_from_time=='04:00 AM'){ echo 'selected';} ?>>04:00 AM</option>
                            <option value="04:15 AM" <?php if($slot_from_time=='04:15 AM'){ echo 'selected';} ?>>04:15 AM</option>
                            <option value="04:30 AM" <?php if($slot_from_time=='04:30 AM'){ echo 'selected';} ?>>04:30 AM</option>
                            <option value="04:45 AM" <?php if($slot_from_time=='04:45 AM'){ echo 'selected';} ?>>04:45 AM</option>
                            <option value="05:00 AM" <?php if($slot_from_time=='05:00 AM'){ echo 'selected';} ?>>05:00 AM</option>
                            <option value="05:15 AM" <?php if($slot_from_time=='05:15 AM'){ echo 'selected';} ?>>05:15 AM</option>
                            <option value="05:30 AM" <?php if($slot_from_time=='05:30 AM'){ echo 'selected';} ?>>05:30 AM</option>
                            <option value="05:45 AM" <?php if($slot_from_time=='05:45 AM'){ echo 'selected';} ?>>05:45 AM</option>
                            <option value="06:00 AM" <?php if($slot_from_time=='06:00 AM'){ echo 'selected';} ?>>06:00 AM</option>
                            <option value="06:15 AM" <?php if($slot_from_time=='06:15 AM'){ echo 'selected';} ?>>06:15 AM</option>
                            <option value="06:30 AM" <?php if($slot_from_time=='06:30 AM'){ echo 'selected';} ?>>06:30 AM</option>
                            <option value="06:45 AM" <?php if($slot_from_time=='06:45 AM'){ echo 'selected';} ?>>06:45 AM</option>
                            <option value="07:00 AM" <?php if($slot_from_time=='07:00 AM'){ echo 'selected';} ?>>07:00 AM</option>
                            <option value="07:15 AM" <?php if($slot_from_time=='07:15 AM'){ echo 'selected';} ?>>07:15 AM</option>
                            <option value="07:30 AM" <?php if($slot_from_time=='07:30 AM'){ echo 'selected';} ?>>07:30 AM</option>
                            <option value="07:45 AM" <?php if($slot_from_time=='07:45 AM'){ echo 'selected';} ?>>07:45 AM</option>
                            <option value="08:00 AM" <?php if($slot_from_time=='08:00 AM'){ echo 'selected';} ?>>08:00 AM</option>
                            <option value="08:15 AM" <?php if($slot_from_time=='08:15 AM'){ echo 'selected';} ?>>08:15 AM</option>
                            <option value="08:30 AM" <?php if($slot_from_time=='08:30 AM'){ echo 'selected';} ?>>08:30 AM</option>
                            <option value="08:45 AM" <?php if($slot_from_time=='08:45 AM'){ echo 'selected';} ?>>08:45 AM</option>
                            <option value="09:00 AM" <?php if($slot_from_time=='09:00 AM'){ echo 'selected';} ?>>09:00 AM</option>
                            <option value="09:15 AM" <?php if($slot_from_time=='09:15 AM'){ echo 'selected';} ?>>09:15 AM</option>
                            <option value="09:30 AM" <?php if($slot_from_time=='09:30 AM'){ echo 'selected';} ?>>09:30 AM</option>
                            <option value="09:45 AM" <?php if($slot_from_time=='09:45 AM'){ echo 'selected';} ?>>09:45 AM</option>
                            <option value="10:00 AM" <?php if($slot_from_time=='10:00 AM'){ echo 'selected';} ?>>10:00 AM</option>
                            <option value="10:15 AM" <?php if($slot_from_time=='10:15 AM'){ echo 'selected';} ?>>10:15 AM</option>
                            <option value="10:30 AM" <?php if($slot_from_time=='10:30 AM'){ echo 'selected';} ?>>10:30 AM</option>
                            <option value="10:45 AM" <?php if($slot_from_time=='10:45 AM'){ echo 'selected';} ?>>10:45 AM</option>
                            <option value="11:00 AM" <?php if($slot_from_time=='11:00 AM'){ echo 'selected';} ?>>11:00 AM</option>
                            <option value="11:15 AM" <?php if($slot_from_time=='11:15 AM'){ echo 'selected';} ?>>11:15 AM</option>
                            <option value="11:30 AM" <?php if($slot_from_time=='11:30 AM'){ echo 'selected';} ?>>11:30 AM</option>
                            <option value="11:45 AM" <?php if($slot_from_time=='11:45 AM'){ echo 'selected';} ?>>11:45 AM</option>
                            <option value="12:00 PM" <?php if($slot_from_time=='12:00 PM'){ echo 'selected';} ?>>12:00 PM</option>
                            <option value="12:15 PM" <?php if($slot_from_time=='12:15 PM'){ echo 'selected';} ?>>12:15 PM</option>
                            <option value="12:30 PM" <?php if($slot_from_time=='12:30 PM'){ echo 'selected';} ?>>12:30 PM</option>
                            <option value="12:45 PM" <?php if($slot_from_time=='12:45 PM'){ echo 'selected';} ?>>12:45 PM</option>
                            <option value="01:00 PM" <?php if($slot_from_time=='01:00 PM'){ echo 'selected';} ?>>01:00 PM</option>
                            <option value="01:15 PM" <?php if($slot_from_time=='01:15 PM'){ echo 'selected';} ?>>01:15 PM</option>
                            <option value="01:30 PM" <?php if($slot_from_time=='01:30 PM'){ echo 'selected';} ?>>01:30 PM</option>
                            <option value="01:45 PM" <?php if($slot_from_time=='01:45 PM'){ echo 'selected';} ?>>01:45 PM</option>
                            <option value="02:00 PM" <?php if($slot_from_time=='02:00 PM'){ echo 'selected';} ?>>02:00 PM</option>
                            <option value="02:15 PM" <?php if($slot_from_time=='02:15 PM'){ echo 'selected';} ?>>02:15 PM</option>
                            <option value="02:30 PM" <?php if($slot_from_time=='02:30 PM'){ echo 'selected';} ?>>02:30 PM</option>
                            <option value="02:45 PM" <?php if($slot_from_time=='02:45 PM'){ echo 'selected';} ?>>02:45 PM</option>
                            <option value="03:00 PM" <?php if($slot_from_time=='03:00 PM'){ echo 'selected';} ?>>03:00 PM</option>
                            <option value="03:15 PM" <?php if($slot_from_time=='03:15 PM'){ echo 'selected';} ?>>03:15 PM</option>
                            <option value="03:30 PM" <?php if($slot_from_time=='03:30 PM'){ echo 'selected';} ?>>03:30 PM</option>
                            <option value="03:45 PM" <?php if($slot_from_time=='03:45 PM'){ echo 'selected';} ?>>03:45 PM</option>
                            <option value="04:00 PM" <?php if($slot_from_time=='04:00 PM'){ echo 'selected';} ?>>04:00 PM</option>
                            <option value="04:15 PM" <?php if($slot_from_time=='04:15 PM'){ echo 'selected';} ?>>04:15 PM</option>
                            <option value="04:30 PM" <?php if($slot_from_time=='04:30 PM'){ echo 'selected';} ?>>04:30 PM</option>
                            <option value="04:45 PM" <?php if($slot_from_time=='04:45 PM'){ echo 'selected';} ?>>04:45 PM</option>
                            <option value="05:00 PM" <?php if($slot_from_time=='05:00 PM'){ echo 'selected';} ?>>05:00 PM</option>
                            <option value="05:15 PM" <?php if($slot_from_time=='05:15 PM'){ echo 'selected';} ?>>05:15 PM</option>
                            <option value="05:30 PM" <?php if($slot_from_time=='05:30 PM'){ echo 'selected';} ?>>05:30 PM</option>
                            <option value="05:45 PM" <?php if($slot_from_time=='05:45 PM'){ echo 'selected';} ?>>05:45 PM</option>
                            <option value="06:00 PM" <?php if($slot_from_time=='06:00 PM'){ echo 'selected';} ?>>06:00 PM</option>
                            <option value="06:15 PM" <?php if($slot_from_time=='06:15 PM'){ echo 'selected';} ?>>06:15 PM</option>
                            <option value="06:30 PM" <?php if($slot_from_time=='06:30 PM'){ echo 'selected';} ?>>06:30 PM</option>
                            <option value="06:45 PM" <?php if($slot_from_time=='06:45 PM'){ echo 'selected';} ?>>06:45 PM</option>
                            <option value="07:00 PM" <?php if($slot_from_time=='07:00 PM'){ echo 'selected';} ?>>07:00 PM</option>
                            <option value="07:15 PM" <?php if($slot_from_time=='07:15 PM'){ echo 'selected';} ?>>07:15 PM</option>
                            <option value="07:30 PM" <?php if($slot_from_time=='07:30 PM'){ echo 'selected';} ?>>07:30 PM</option>
                            <option value="07:45 PM" <?php if($slot_from_time=='07:45 PM'){ echo 'selected';} ?>>07:45 PM</option>
                            <option value="08:00 PM" <?php if($slot_from_time=='08:00 PM'){ echo 'selected';} ?>>08:00 PM</option>
                            <option value="08:15 PM" <?php if($slot_from_time=='08:15 PM'){ echo 'selected';} ?>>08:15 PM</option>
                            <option value="08:30 PM" <?php if($slot_from_time=='08:30 PM'){ echo 'selected';} ?>>08:30 PM</option>
                            <option value="08:45 PM" <?php if($slot_from_time=='08:45 PM'){ echo 'selected';} ?>>08:45 PM</option>
                            <option value="09:00 PM" <?php if($slot_from_time=='09:00 PM'){ echo 'selected';} ?>>09:00 PM</option>
                            <option value="09:15 PM" <?php if($slot_from_time=='09:15 PM'){ echo 'selected';} ?>>09:15 PM</option>
                            <option value="09:30 PM" <?php if($slot_from_time=='09:30 PM'){ echo 'selected';} ?>>09:30 PM</option>
                            <option value="09:45 PM" <?php if($slot_from_time=='09:45 PM'){ echo 'selected';} ?>>09:45 PM</option>
                            <option value="10:00 PM" <?php if($slot_from_time=='10:00 PM'){ echo 'selected';} ?>>10:00 PM</option>
                            <option value="10:15 PM" <?php if($slot_from_time=='10:15 PM'){ echo 'selected';} ?>>10:15 PM</option>
                            <option value="10:30 PM" <?php if($slot_from_time=='10:30 PM'){ echo 'selected';} ?>>10:30 PM</option>
                            <option value="10:45 PM" <?php if($slot_from_time=='10:45 PM'){ echo 'selected';} ?>>10:45 PM</option>
                            <option value="11:00 PM" <?php if($slot_from_time=='11:00 PM'){ echo 'selected';} ?>>11:00 PM</option>
                            <option value="11:15 PM" <?php if($slot_from_time=='11:15 PM'){ echo 'selected';} ?>>11:15 PM</option>
                            <option value="11:30 PM" <?php if($slot_from_time=='11:30 PM'){ echo 'selected';} ?>>11:30 PM</option>
                            <option value="11:45 PM" <?php if($slot_from_time=='11:45 PM'){ echo 'selected';} ?>>11:45 PM</option>
                           </select>
                        </div>
                    </div>

                     <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Slot Time To</strong>*</div>
                        <div class="col-md-3 control text-left"> 


                  <select class="limitedNumbSelect2" name="slot_time_to" id="slot_time_to" class="form-control" required="" >
                            <option value="<?php echo $slot_to_time; ?>" ><?php echo $slot_to_time; ?></option>
                            
                           </select>
                        </div>
                    </div>



                       <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Slot Code</strong>*</div>
                        <div class="col-md-3 control text-left">     
                          <input type="text" id="slot_code" name="slot_code" value="<?php echo $slot_class; ?>" class="form-control" required="">
                        </div></div>

                        <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Slot Count</strong>*</div>
                        <div class="col-md-3 control text-left">     
                          <input type="text" id="slot_count" name="slot_count" value="<?php echo $slot_id; ?>" class="form-control" required="">
                        </div></div>

                        
                      

                        <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Days</strong>*</div>
                        <div class="col-md-3 control text-left">     
                          <select id="days" name="days[]" class="form-control choiceChosen" required="" multiple>
                            <option value="">Select</option>
                            <option value="Sunday" <?php if(strpos($days, 'Sunday') !== false){ echo 'selected';} ?>>Sunday</option> 
                             <option value="Monday" <?php if(strpos($days, 'Monday') !== false) { echo 'selected';} ?>>Monday</option>
                             <option value="Tuesday" <?php if(strpos($days, 'Tuesday') !== false){ echo 'selected';} ?>>Tuesday</option>
                             <option value="Wednesday" <?php if(strpos($days, 'Wednesday') !== false){ echo 'selected';} ?>>Wednesday</option>
                             <option value="Thursday" <?php if(strpos($days, 'Thursday') !== false){ echo 'selected';} ?>>Thursday</option>
                             <option value="Friday" <?php if(strpos($days, 'Friday') !== false){ echo 'selected';} ?>>Friday</option>
                             <option value="Saturday" <?php if(strpos($days, 'Saturday') !== false){ echo 'selected';} ?>>Saturday</option>
                           </select>
                        </div></div> 

                        <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Category</strong>*</div>
                        <div class="col-md-3 control text-left">     
                           <select id="category" name="category" required="" class="form-control choiceChosen">
                            <option value="">Select</option>
                            <option value="Kid" <?php if($category=='Kid'){ echo 'selected';} ?>>Kid</option>
                             <option value="Adult" <?php if($category=='Adult'){ echo 'selected';} ?>>Adult</option>
                           </select>
                        </div></div>

                        <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Status</strong>*</div>
                        <div class="col-md-3 control text-left">     
                          <select id="status" name="status" class="form-control choiceChosen" required="">
                            <option value="">Select</option>
                            <option value="Active" <?php if($status=='Active'){ echo 'selected';} ?>>Active</option>
                             <option value="Inactive" <?php if($status=='Inactive'){ echo 'selected';} ?>>Inactive</option>
                           </select>
                        </div></div>

                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                        <?php if($status=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" onclick="return Validation()", "<?php echo base_url('activity_slot/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('activity_slot/add/'); ?>"       class="btn btn-success" /><?php } ?>

                        
                         <a href="<?php echo base_url().'activity_slot' ?>"     class="btn btn-danger" >Cancel</a></div></div>
                    
                </form>
            </div>
        </div></div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
</body>
<script type="text/javascript">
$(document).ready( function(){
function getFormattedTime(time) {
 var postfix = "AM";
 var hour = time.getHours();
 console.log(hour);
 var min = time.getMinutes();

 //format hours
 if (hour > 12) {
   hour = hour - 12;
   postfix = "PM";
 }
 

 //format minutes
 min = (''+min).length > 1 ? min : '0' + min;
 return hour + ':' + min + ' ' + postfix;
}

var from = $('#slot_time_from').val();
var hr = $('input[name="hour"]:checked').attr("data-id");
var str = from;
var str1 = str.replaceAll('.', ':');
var time = new Date();
var startTime = str1;
if(hr==1) {
var timeChange = 60; //50 minutes
}
else if(hr==2) {
var timeChange = 120; //110 minutes
}
else
	{
	var timeChange = 180; //170 minutes	
	}
var startHour = startTime.split(':')[0];
var startMin = startTime.split(':')[1].replace(/AM|PM/gi, '');
time.setHours(parseInt(startHour));
time.setMinutes(parseInt(startMin));

//adjusted time
time.setMinutes(time.getMinutes() + timeChange);
var new_to = getFormattedTime(time);
$('#slot_time_to').empty();
$('#slot_time_to').append('<option value="'+new_to+'" selected="selected">'+new_to+'</option>');
$('#slot_time_to').trigger('change'); 

$('#slot_time_from').change(function(){
var from = $(this).val();
var hr = $('input[name="hour"]:checked').attr("data-id");
var str = from;
var str1 = str.replaceAll('.', ':');
var time = new Date();
var startTime = str1;
if(hr==1) {
var timeChange = 60; //50 minutes
}
else if(hr==2) {
var timeChange = 120; //110 minutes
}
else
	{
	var timeChange = 180; //170 minutes	
	}
var startHour = startTime.split(':')[0];
var startMin = startTime.split(':')[1].replace(/AM|PM/gi, '');
time.setHours(parseInt(startHour));
time.setMinutes(parseInt(startMin));

//adjusted time
time.setMinutes(time.getMinutes() + timeChange);
var new_to = getFormattedTime(time);
$('#slot_time_to').empty();
$('#slot_time_to').append('<option value="'+new_to+'" selected="selected">'+new_to+'</option>');
$('#slot_time_to').trigger('change'); 
});

$('input[type=radio]input[name="hour"]').change(function() {
var from = $('#slot_time_from').val();
var hr = $(this).attr("data-id");
var str = from;
var str1 = str.replaceAll('.', ':');
var time = new Date();
var startTime = str1;
if(hr==1) {
var timeChange = 60; //50 minutes
}
else if(hr==2) {
var timeChange = 120; //110 minutes
}
else
	{
	var timeChange = 180; //170 minutes	
	}
var startHour = startTime.split(':')[0];
var startMin = startTime.split(':')[1].replace(/AM|PM/gi, '');
time.setHours(parseInt(startHour));
time.setMinutes(parseInt(startMin));

//adjusted time
time.setMinutes(time.getMinutes() + timeChange);
var new_to = getFormattedTime(time);
$('#slot_time_to').empty();
$('#slot_time_to').append('<option value="'+new_to+'" selected="selected">'+new_to+'</option>');
$('#slot_time_to').trigger('change'); 	
});
});
</script>
</html>  
