<html><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<link rel="stylesheet" href="<?php echo base_url().'css/bootstrap.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/bootstrgap.min.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/bootstrap-table.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/bootstrap-theme.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/bootstrap-theme.min.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/datepicker.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/datepicker3.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/font-awesome.min.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/jquery-ui.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/paginate.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/print.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'css/styless.css' ?>">
<script  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'js/script.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'js/jquery-1.11.1.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'js/bootstrap.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'js/bootstrap.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'js/bootstrap-datepicker.js' ?>"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>

  <style type="text/css">

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
  font-size: 13px;
  line-height: 20px;
  background-image: linear-gradient(180deg, #efefef, #dfe1e2);
  
  

}
    #login-header
   {
    background-color: #ba272d9e;
    background-image: #ba272d9e;
    text-shadow: #fff 0 1px 0;
    border: solid 1px #cdcdcd;
    border-color: #d4d4d4;
    border-top-color: #e6e6e6;
    border-right-color: #d4d4d4;
    border-bottom-color: #cdcdcd;
    border-left-color: #d4d4d4;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 0 1px #FFF inset;
    font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    box-sizing: border-box;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.37);
    display: table;
    border-bottom-color: #EEE;
    width: 100%;
    position: relative;
    margin: 0;
    padding: 10px 30px;
    z-index: 800;
    background-image: linear-gradient(180deg, #f5050f7a, #ba272d0d);
    color: white;
}
#login-header::after {
    clear: both;
    content: "";
    display: table;
}
.table
th,td
    {
        
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    width: 1000px;            
}
.table
th
{
  

    background-image: linear-gradient(180deg, #efefef, #dfe1e2);
    text-shadow: #fff 0 1px 0;
    border: solid 1px #cdcdcd;
    border-color: #d4d4d4;
    border-top-color: #e6e6e6;
    border-right-color: #d4d4d4;
    border-bottom-color: #cdcdcd;
    border-left-color: #d4d4d4;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 0 1px #FFF inset;
    font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: center;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 15px;
  line-height: 15px;
}
.table
td
{
  

   
    text-shadow: #fff 0 1px 0;
    border: solid 1px #cdcdcd;
    border-color: #d4d4d4;
    border-top-color: #e6e6e6;
    border-right-color: #d4d4d4;
    border-bottom-color: #cdcdcd;
    border-left-color: #d4d4d4;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 0 1px #FFF inset;
    font-size: 1em;
    
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: center;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 14px;
  line-height: 15px;
}
 nav.nav,
    nav.nav-tabs,
    ul.dropdown-toggle,
    ul.dropdown-menu
     li a {
  color: white;
  font: bold;


}
#a1,#a2,#a3,#a4,#a5
{
  color: white;
  font: bold;
  
  
}
p
{
  font-style: italic;
}

.btn1
{
  background-color: #ba272d;
  color: white;
  background-size: 10px;
  padding: 5px;


}
.btn1:hover,
.btn1:focus,
.btn1.focus {
  color: white;
  text-decoration: none;

}
.body
{
  font-family: ariel;
}

.dropdown-menu > li > a:hover
{
  color: white;
  text-decoration: none;
  background-color: #db5d63;
  background-image: linear-gradient(to bottom,#b95b5b 0,#ed1010 100%);
}
.navbar-default .navbar-nav .dropdown.open a:focus {
    background-color: #6dbcc9;
}


  </style>
 
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  
    <nav class="navbar navbar-light"  style="height: 100px; background-color: #ba272d">
  <div class="wrapper" >
     <a class="navbar-brand" href="<?php echo base_url().'index.php/dashboard' ?>" ><img src="<?php echo base_url().'images/main_logo.jpg' ?>"></a>
    <ul class="nav navbar-nav">
      
      <li class="dropdown" style="margin-top: 25px;"><a class="btn btn1 dropdown-toggle" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" href="#" ><b>Academy Activities</b><span class="caret"></span></a>
        <ul class="dropdown-menu" style="color: white; background-color: #ba272d"> 
            <li><a href="<?php echo base_url().'index.php/Student' ?>"><b>Student Registration</b></a></li>
            <li><a href="<?php echo base_url().'index.php/Coach' ?>"><b>Coach Registration</b></a></li>
            <li><a href="<?php echo base_url().'index.php/Registration_fees' ?>"><b>Registration Fees</b></a></li>

        </ul>
      </li>
       <li class="dropdown" style="margin-top: 25px;"><a class="btn btn1 dropdown-toggle" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" href="#" ><b>Maintenance</b><span class="caret"></span></a>
        <ul class="dropdown-menu" style="color: white; background-color: #ba272d">
              <li id="games"><a href="<?php echo base_url().'index.php/games' ?>"><b>Activity</b></a></li>
              <li id="locations"><a href="<?php echo base_url().'index.php/location' ?>"><b>Location</b></a></li>
              <li id="location_based_games"><a href="<?php echo base_url().'index.php/location_based_games' ?>"><b>Activity Based Location</b></a></li>
              <li id="lane_court"><a href="<?php echo base_url().'index.php/lane_court' ?>"><b>Lane/Court</b></a></li>
              <li id="activity_level"><a href="<?php echo base_url().'index.php/activity_level' ?>"><b>Activity Level</b></a></li>
              <li id="activity_slot"><a href="<?php echo base_url().'index.php/activity_slot' ?>"><b>Activity Slot</b></a></li>
              <li id="registration_charge_setup"><a href="<?php echo base_url().'index.php/registration_charge_setup' ?>"><b>Registration Charge Setup</b></a></li>
              <li id="fees_package_setup"><a href="<?php echo base_url().'index.php/Fees_package_setup' ?>"><b>Fees Package Setup</b></a></li>
              <li id="bank_details"><a href="<?php echo base_url().'index.php/bank_details' ?>"><b>Bank Deatails</b></a></li>
              <li id="discount_setup"><a href="<?php echo base_url().'index.php/discount_setup' ?>"><b>Discount Setup</b></a></li>
              <li id="account_code"><a href="<?php echo base_url().'index.php/account_codes' ?>"><b>Account Code</b></a></li>
              <li id="events"><a href="<?php echo base_url().'index.php/events' ?>"><b>Event</b></a></li>
              <li id="scroll_text_message"><a href="<?php echo base_url().'index.php/scroll_text_messages' ?>"><b>Scroll Text Message</b></a></li>
              <li id="set_academy_holiday"><a href="<?php echo base_url().'index.php/set_academy_holiday' ?>"><b>Set Academy Holiday</b></a></li>
              <li id="vat_setup"><a href="<?php echo base_url().'index.php/vat_setup' ?>"><b>Vat Setup</b></a></li>
              <li id="refund_discount_percentages"><a href="<?php echo base_url().'index.php/refund_discount_percentages' ?>"><b>Refund Discount Percentage</b></a></li>
              <li id="fees_structure_images"><a href="<?php echo base_url().'index.php/fees_structure_images' ?>"><b>Fees Structure Image</b></a></li>
              <li id="fees_structure_images"><a href="<?php echo base_url().'index.php/assign_coach' ?>"><b>Assign Coach</b></a></li>
                       
                   
      </ul>
      </li>
     
    </ul>
    <ul class="nav navbar-nav navbar-right" style="margin-top: 25px; margin-right: 20px">
      <li><a href="#" class="btn btn1"><span class="glyphicon glyphicon-user" style="color: white"></span><b><?php echo $this->session->userdata('username'); ?> </b></a></li>
      <li><a href="<?php echo base_url().'index.php/login/logout' ?>" class="btn btn1"><b>Logout</b></a></li>
    </ul>

  </div>

  

</nav></html>