<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Primestar - Generate Coupons</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="icon" type="<?php echo base_url(); ?>assets/image/jpg" href="<?php echo base_url(); ?>assets/images/favicon.jpg" />
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
		<!-- Datepicker style -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" />
		<!-- Multiselect style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" type="text/css"/>
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
<script src="<?php echo base_url(); ?>assets/libraries/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">-->


<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/libraries/app.min.js"></script>
<!-- Bootstrap Date Picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/1.10.0_jquery.validate.min.js"></script> 

<script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/jquery-validate.bootstrap-tooltip.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
 <script src="<?php echo base_url(); ?>assets/libraries/bootstrap3-wysihtml5.all.min.js"></script>
 
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="#" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><img src="<?php echo base_url(); ?>assets/images/favicon.jpg" alt="" /></span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><img src="<?php echo base_url(); ?>assets/images/logo.jpg" class="img-responsive" alt="" /></span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?php echo base_url(); ?>assets/images/user_image.jpg" class="user-image" alt="User Image">
									<span class="hidden-xs">Welcome <?php if($this->session->userdata('username')){ echo $this->session->userdata('username'); } ?><i class="fa fa-angle-down" aria-hidden="true"></i></span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<img src="<?php echo base_url(); ?>assets/images/user_image.jpg" class="img-circle" alt="User Image">
										<p>
											Admin Name
										</p>
									</li>
									<!-- Menu Body -->
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="<?php echo base_url(); ?>profile/edit_profile" class="btn btn-default btn-flat">Edit Profile</a>
										</div>
										<div class="pull-right">
											<a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
					<div class="user-panel">
						<div class="pull-left image">
							<img src="<?php echo base_url(); ?>assets/images/user_image.jpg" class="img-circle" alt="User Image">
						</div>
						<div class="pull-left info">
							<p><?php if($this->session->userdata('username')){ echo $this->session->userdata('username'); } ?></p>
						</div>
					</div>
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						<li class="header">MAIN NAVIGATION</li>
						<li class="treeview"><a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i><span>Schedule</span>
						<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
						<ul class="treeview-menu " >
							<li ><a href="<?php echo base_url(); ?>regular_booking">Regular Booking</a></li>
							<li><a href="<?php echo base_url(); ?>bulk_booking">Bulk Booking</a></li>
							<li><a href="<?php echo base_url(); ?>search">Search</a></li>
						</ul>
					</li>
                                        <li><a href="<?php echo base_url(); ?>booking_approval"><i class="fa fa-file-text-o" aria-hidden="true"></i><span>Customer Booking Approval</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>sports"><i class="fa fa-futbol-o" aria-hidden="true"></i><span>Manage Sports</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>location"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Manage Location</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>court"><i class="fa fa-globe" aria-hidden="true"></i><span>Manage Court</span></a></li>
				
				<li class="treeview"><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span>Manage Users</span>
				<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url(); ?>manage_user">Users</a></li>
					<li><a href="<?php echo base_url(); ?>prepaid_credits">Prepaid Credits</a></li>
				</ul>
			</li>
			<!--<li class="treeview"><a href="#"><i class="fa fa-ticket" aria-hidden="true"></i><span>Promote</span>
			<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
			<ul class="treeview-menu">
				<li><a href="<?php echo base_url(); ?>generate_coupons">Generate Coupons</a></li>
				<li><a href="<?php echo base_url(); ?>invite_to_primstar">Invite to Primestar</a></li>
			</ul>
		</li>-->
                        <li><a href="<?php echo base_url(); ?>reports"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Reports</span></a></li>
	<li class="treeview"><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i><span>Settings</span>
	<span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
	<ul class="treeview-menu">
		<li><a href="<?php echo base_url(); ?>pricing">Pricing</a></li>
	<!--<li><a href="<?php echo base_url(); ?>extras_pricing">Extras Pricing</a></li>-->
		<li><a href="<?php echo base_url(); ?>holidays">Holidays</a></li>
	</ul>
</li>
</ul>
</section>
<!-- /.sidebar -->
</aside>
<!-- Left side column. contains the logo and sidebar -->
			
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";
 var current = window.location.href;

   $('.treeview-menu li a').each(function(){
      var link =  $(this).attr('href');
      if(current.indexOf(link) != -1){
		  
         $(this).closest('li').addClass('active');
		 $(this).closest('li').closest('.treeview-menu').addClass('menu-open');
		 $(this).closest('li').closest('.treeview-menu').closest('.treeview').addClass('active');
		 
      }
   }); 
</script>