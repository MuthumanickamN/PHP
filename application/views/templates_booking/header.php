<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Primestar - Generate Coupons</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="icon" type="<?php echo base_url(); ?>assets_booking/image/jpg" href="<?php echo base_url(); ?>assets_booking/images/favicon.jpg" />
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/style.css">
		<!-- Datepicker style -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" />
		<!-- Multiselect style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/bootstrap-multiselect.css" type="text/css"/>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://use.fontawesome.com/58287d3ef3.js"></script>
<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
<script src="<?php echo base_url(); ?>assets_booking/libraries/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets_booking/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets_booking/plugins/datatables/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css/dataTables.bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">-->


<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets_booking/libraries/app.min.js"></script>
<!-- Bootstrap Date Picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/1.10.0_jquery.validate.min.js"></script> 

<script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/jquery-validate.bootstrap-tooltip.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
 <script src="<?php echo base_url(); ?>assets_booking/libraries/bootstrap3-wysihtml5.all.min.js"></script>
 
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			

<?php
if($this->uri->segment(1) != 'regular_booking'){
$this->load->helper('cookie');    
$past = time() - 3600;
    foreach ( $_COOKIE as $key => $value )
    {
        //echo $key.'----'.$value.'<br/>';
        if($key != 'ci_session'){
            setcookie($key, '', $past);
            setcookie( $key, '', $past, '/' );
        }
        
    }
}
?>