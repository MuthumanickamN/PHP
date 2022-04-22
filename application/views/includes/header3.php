<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php  error_reporting(0);?>
<head> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">

  <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

  <!-- BEGIN: Vendor CSS-->
  <!--<link rel="stylesheet" href="<?php echo base_url() . 'css2/bootstrap.min.css' ?>" >-->
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/style.min.css' ?>"/>
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/style.css' ?>"/>
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/horizontal-menu.min.css' ?>"/>
  <!-- DL Menu CSS -->
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/components.min.css' ?>"/>
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/apexcharts.css' ?>"/>
  <!--<link rel="stylesheet" href="<?php echo base_url() . 'css2/datatable.css' ?>">-->
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/colors.min.css' ?>"/>
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/bootstrap-extended.min.css' ?>"/>
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/cryptocoins.css' ?>"/>
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/palette-gradient.min.css' ?>"/>
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/vendor.min.css' ?>"/>
  <!--<link rel="stylesheet" href="<?php echo base_url() . 'css2/vendor-menu.min.css' ?>">-->
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/datatable.min.css' ?>"/>
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/daterangepicker.css' ?>"/>
  <link rel="stylesheet" href="<?php echo base_url() . 'css2/bootstrap-datepicker.css' ?>"/>
  

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'js/script.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'js/moment.min.js' ?>"></script>
  <!--<script type="text/javascript" src="<?php echo base_url() . 'js/jquery-1.11.1.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'js/bootstrap.js' ?>"></script>-->
  <script type="text/javascript" src="<?php echo base_url() . 'js/bootstrap.min.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'js/bootstrap-datepicker.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'js/daterangepicker.min.js' ?>"></script>
  <link href="<?php echo base_url() . 'css/select2.css';?>" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo base_url() . 'js/select2.js' ?>"></script>

  

  <script src="<?php echo base_url(); ?>assets_booking/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_booking/css/dataTables.bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/1.10.0_jquery.validate.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="<?php echo base_url(); ?>assets_booking/libraries/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets_booking/plugins/datatables/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/libraries/jquery-validate.bootstrap-tooltip.js"></script>
  

  <!--<script type="text/javascript" src="<?php echo base_url() . 'assets_booking/datatable.min.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets_booking/datatable-styling.min.js' ?>"></script>-->
  
  <script src="<?php echo base_url(); ?>assets_booking/js/jquery-validate.js" type="text/javascript"></script>   
  <script type="text/javascript" src="<?php echo base_url(); ?>assets_booking/js/jquery-validate.bootstrap-tooltip.js"></script> 
  <script src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="http://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>   
  <script type="text/javascript" src="<?php echo base_url() . 'js/jstars.js' ?>"></script>
  
  <script>var baseurl = "<?php echo site_url(); ?>";</script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
    setTimeout(function () {
          jQuery('span#success-msg').parent().slideUp('slow');
          jQuery('.alert-success').slideUp('slow');
    }, 3000);
  });
  </script>
  <!-- END: Custom CSS-->
  <style type="text/css">
    .header-navbar .navbar-header .navbar-brand .brand-logo {
      width: 121px;
    }
    
    .input-group-addon {
        border-color: #BABFC7;
        height: 33px;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
    }
    .input-group.date .input-group-addon i {
        cursor: pointer;
        width: 16px;
        height: 16px;
        position: relative;
        top: -6px;
    }
    .date_btn { 
     position: relative;   
     top: 0px;   
     border-left: 1px solid aliceblue;   
     border: transparent;   
     height: 33px;   
     border-top-right-radius: 4px;   
     border-bottom-right-radius: 4px;   
     width: 164px;   
    }
    .select2 {
        width:100% !important;
    }
	.coach-menu {
    display: inline-block;
    
	
}
.coach-menu  : hover {
	background-color:rgba(255,255,255,.05)  !important;
	color:#cdced2 !important;
}

.coach-menu {
	color: #888e8f !important;
   
}

  </style>
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/style.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" />
  <!-- Multiselect style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets_booking/css/bootstrap-multiselect.css" type="text/css"/>
  <script src="https://use.fontawesome.com/58287d3ef3.js"></script>
  <script src="<?php echo base_url(); ?>assets_booking/libraries/app.min.js"></script>
 <script src="<?php echo base_url(); ?>assets_booking/libraries/bootstrap3-wysihtml5.all.min.js"></script>
  
</head>
<!-- END: Head-->


<!-- BEGIN: Body-->
<title><?php echo isset($title)?$title: 'Prime star sports services';?></title>
<body class="horizontal-layout horizontal-menu 2-columns" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
  <?php
  $this->CI =&get_instance();
  $resource = strtolower($this->CI->router->fetch_class());
  if($this->CI->router->fetch_class() != "login"){
        if($this->CI->session->userdata['username'] == '' ){
          $this->session->set_flashdata('error', 'You need to sign in or sign up before continuing. ');
            redirect(base_url() . 'login');  
        }
    }

  $role = strtolower($this->session->userdata['role']);
  $userid =$this->session->userdata['userid'];
  $menu_model = $this->session->userdata['menu_model'];
  //echo "<pre>";print_r($menu_model); die('test');  
  array_walk_recursive($menu_model, function (&$v, $k) {
    $v = strtolower($v);
  });

  function show_model_in_menu($module_name, $menu_model)
  {
    $module_name = strtolower(($module_name));
    return $module_name = array_search(strtolower($module_name), array_column($menu_model, 'module_name'));
  }
  //show_model_in_menu('Event', $menu_model);
  
 
		
		//echo $role;die;
		if($role != 'superadmin')
		{
			$sql="select mu.sub_menu_name,mm.main_menu_name,mu.controller_name,rp.permission as view_permission from `role_permission` as rp 
			left join main_menu_sub_modules as mu on mu.Id=rp.sub_module_id 
			left join main_menu_modules as mm on mm.Id=mu.main_menu_id 
			where rp.user_id='$userid' and mu.controller_name is not null";
			$query = $this->db->query($sql);
			$result_rp = $query->result_array();
			
			
			$academy_activities_menu_arr = [];
			$academy_activities_menu_perm = 0;
			
			$maintenance_menu_arr = [];
			$maintenance_menu_perm = 0;
			
			$reports_menu_arr = [];
			$reports_menu_perm = 0;
			
			$school_menu_arr = [];
			$school_menu_perm = 0;
			
			$user_menu_arr = [];
			$user_menu_perm = 0;

      $court_booking_menu_arr = [];
			$court_booking_menu_perm = 0;

      $parent_court_booking_menu_arr = [];
			$parent_court_booking_menu_perm = 0;
			
			foreach($result_rp as $key => $value)
			{
				if($value['main_menu_name'] == 'Academy Activities')
				{
					$academy_activities_menu_arr[$value['controller_name']] = $value['view_permission'];
					if($value['view_permission'] == 1)
					{
						//show parent menu, if atlease one submenu having view_permission = 1
						$academy_activities_menu_perm = 1;
					}
				}
				else if($value['main_menu_name'] == 'Maintenance')
				{
					$maintenance_menu_arr[$value['controller_name']] = $value['view_permission'];
					if($value['view_permission'] == 1)
					{
						//show parent menu, if atlease one submenu having view_permission = 1
						$maintenance_menu_perm = 1;
					}
				}
				else if($value['main_menu_name'] == 'Reports')
				{
					$reports_menu_arr[$value['controller_name']] = $value['view_permission'];
					if($value['view_permission'] == 1)
					{
						//show parent menu, if atlease one submenu having view_permission = 1
						$reports_menu_perm = 1;
					}
				}
				else if($value['main_menu_name'] == 'School')
				{
					$school_menu_arr[$value['controller_name']] = $value['view_permission'];
					if($value['view_permission'] == 1)
					{
						//show parent menu, if atlease one submenu having view_permission = 1
						$school_menu_perm = 1;
					}
				}
				else if($value['main_menu_name'] == 'User')
				{
					$user_menu_arr[$value['controller_name']] = $value['view_permission'];
					if($value['view_permission'] == 1)
					{
						//show parent menu, if atlease one submenu having view_permission = 1
						$user_menu_perm = 1;
					}
				}
         else if($value['main_menu_name'] == 'Court Booking')
				{
					$court_booking_menu_arr[$value['controller_name']] = $value['view_permission'];
					if($value['view_permission'] == 1)
					{
						//show parent menu, if atlease one submenu having view_permission = 1
						$court_booking_menu_perm = 1;
					}
				}
        else if($value['main_menu_name'] == 'Parent Court Booking')
				{
					$parent_court_booking_menu_arr[$value['controller_name']] = $value['view_permission'];
					if($value['view_permission'] == 1)
					{
						//show parent menu, if atlease one submenu having view_permission = 1
						$parent_court_booking_menu_perm = 1;
					}
				}
			}
			
		}
		
		?>
		
 
  <!-- BEGIN: Header-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="fa fa-menu"></i></a></li>
          <li class="nav-item"><a class="navbar-brand" href="index.html">
              <h3 class="brand-text">Prime Star Sports Services</h3>
            </a></li>
          <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
        </ul>

      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="fa fa-menu"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="modern admin logo" src="<?php echo base_url() . 'images/main_logo.jpg' ?>">
              </a></li>
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li><a href="#" class="btn btn1"><span class="fa fa-user" style="color: white"></span><b><?php echo $this->session->userdata('username'); ?> </b></a></li>
            <li><a href="<?php echo base_url() . 'login/logout' ?>" class="btn btn1"><b>Logout</b></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>


  <!-- END: Header-->


  <!-- BEGIN: Main Menu-->

  <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper" data-open="hover">
    <div class="navbar-container main-menu-content" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
	  
		<?php //if($role == 'superadmin' ) { ?>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="<?php echo base_url() . 'Dashboard' ?>"><i class="fa fa-home"></i><span data-i18n="Dashboard">Dashboard</span></a></li>
		<?php //} ?>
		
		<?php if($role == 'superadmin'  || $role=='parent' || $academy_activities_menu_perm == 1) { ?>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-television"></i><span data-i18n="Templates">Academy Activites</span></a>
          <ul class="dropdown-menu">
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Coach'] == 1) : ?>
              <li data-menu="coach_registration"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Coach' ?>"><span data-i18n="Coach Registration">Coach Registration</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $role == 'parent'|| $academy_activities_menu_arr['Students'] == 1) : ?>
              <li data-menu="student_registration"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Students' ?>"><span data-i18n="Student Registration">Student Registration</span></a></li>
            <?php endif; ?>

           

            <?php if ($role == 'superadmin'|| $role == 'parent' || $academy_activities_menu_arr['Registration_fees'] == 1) : ?>
              <li data-menu="registration_fees"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Registration_fees' ?>"><span data-i18n="Registration Fees">Registration Fees</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Daily_transaction'] == 1) : ?>
              <li data-menu="Daily_transaction"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Daily_transaction' ?>"><span data-i18n="Daily Fees">Daily Transaction</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Activity_remark'] == 1) : ?>
              <li data-menu="Activity_remark"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Activity_remark' ?>"><span data-i18n="Daily Fees">Activity Remark</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Attendance_book'] == 1) : ?>
              <li data-menu="Attendance_book"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Attendance_book' ?>"><span data-i18n="Attendance book">Attendance book</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin'  || $academy_activities_menu_arr['Slot_refund_request/list_'] == 1) : ?>
              <li data-menu="Slot_refund_approval"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Slot_refund_request/list_' ?>"><span data-i18n="Daily Fees">Slot Refund Approval</span></a></li>
            <?php endif; ?>
            
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Prepaid_credits'] == 1) : ?>
              <li data-menu="Prepaid_credits"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Prepaid_credits' ?>"><span data-i18n="Daily Fees">Prepaid Credits</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['User_wallet_details'] == 1) : ?>
              <li data-menu="User_wallet_details"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'User_wallet_details' ?>"><span data-i18n="Daily Fees">User Wallet Details</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Registration_approval'] == 1) : ?>
              <li data-menu="Registration_approval"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Registration_approval' ?>"><span data-i18n="Daily Fees">Registration Approval</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Activity_approval'] == 1) : ?>
              <li data-menu="Activity_approval"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Activity_approval' ?>"><span data-i18n="Daily Fees">Activity Approval</span></a>
              </li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Credits_roll_back'] == 1) : ?>
              <li data-menu="Credits_roll_back"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Credits_roll_back' ?>"><span data-i18n="Daily Fees">Credits Roll Back</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['student_profile_slot_booking/approval'] == 1) : ?>
              <li data-menu="Booking_approval"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'student_profile_slot_booking/approval' ?>"><span data-i18n="Booking Approval">Booking Approval</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Wallet_transaction'] == 1) : ?>
              <li data-menu="Wallet_transaction"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Wallet_transaction' ?>"><span data-i18n="Daily Fees">Wallet Transaction</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Bulk_refund'] == 1) : ?>
              <li data-menu="Bulk_refund"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Bulk_refund' ?>"><span data-i18n="Bulk refund">Bulk refund</span></a></li>
            <?php endif; ?>
            <?php if ($role == 'superadmin' || $academy_activities_menu_arr['Contract_customer_invoice'] == 1) : ?>
              <li data-menu="Contract_customer_invoice"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Contract_customer_invoice' ?>"><span data-i18n="Contract Customer Invoice">Contract Customer Invoice</span></a></li>
            <?php endif; ?>
             <?php /*<li data-menu="manage_uploads"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'manage_uploads' ?>"><span data-i18n="Manage Uploads">Manage Uploads</span></a></li>*/?>
             
                 <?php if ($role == 'parent') : ?>
                  <li data-menu="Wallet_Transaction_Details">
                    <a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Wallet_transaction_details' ?>">
                      <span data-i18n="Wallet_Transaction_Details">Wallet Transactions History </span></a>
                  </li>
                <?php endif; ?>
          </ul>
        </li>
        
         
        
		
		<?php } ?>
		
    <?php if ($role == 'parent') : ?>
          <li class="dropdown nav-item">
            <a class="dropdown-toggle nav-link" href="<?php echo base_url() . 'Active_kids' ?>" id="a2">
              <i class="fa fa-list"></i>
              <span data-i18n="Student Profile / Slot Booking">Student Profile / Slot Booking / Refund Request / Swap Slot  </span></a>
          </li>
        <?php endif; ?>

		<?php if($role == 'superadmin' || $maintenance_menu_perm == 1) { ?>
          <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-cogs"></i><span data-i18n="Apps">Maintenance</span></a>
            <ul class="dropdown-menu">

              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Games'] == 1) : ?>
                <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Games' ?>"><span data-i18n="Activity">Activity</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Location'] == 1) : ?>
                <li data-menu="locations"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Location' ?>"><span data-i18n="Location">Location</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Location_based_games'] == 1) : ?>
                <li data-menu="location_based_games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Location_based_games' ?>"><span data-il8n="Activity Based Location">Activity Based Location</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Lane_court'] == 1) : ?>
                <li data-menu="lane_court"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Lane_court' ?>"><span data-i18n="Lane Court">Lane/Court</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Activity_level'] == 1) : ?>
                <li data-menu="activity_level"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Activity_level' ?>"><span data-i18n="Activity Level">Activity Level</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Activity_slot'] == 1) : ?>
                <li data-menu="activity_slot"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Activity_slot' ?>"><span data-il8n="Activity Slot">Activity Slot</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Registration_charge_setup'] == 1) : ?>
                <li data-menu="registration_charge_setup"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Registration_charge_setup' ?>"><span data-i18n="Registration Charge Setup">Registration Charge Setup</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Fees_package_setup'] == 1) : ?>
                <li data-menu="fees_package_setup"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Fees_package_setup' ?>"><span data-i18n="Fees Package Setup">Fees Package Setup</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Bank_details'] == 1) : ?>
                <li data-menu="bank_details"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Bank_details' ?>"><span data-il8n="Bank Details">Bank Details</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Discount_setup'] == 1) : ?>
                <li data-menu="discount_setup"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Discount_setup' ?>"><span data-i18n="Discount Setup">Discount Setup</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Account_codes'] == 1) : ?>
                <li data-menu="account_codes"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Account_codes' ?>"><span data-i18n="Account Codes">Account Codes</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Events'] == 1) : ?>
                <li data-menu="events"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Events' ?>"><span data-il8n="Events">Events</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Scroll_text_messages'] == 1) : ?>
                <li data-menu="scroll_text_messages"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Scroll_text_messages' ?>"><span data-i18n="Scroll Text Messages">Scroll Text Message</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Set_academy_holiday'] == 1) : ?>
                <li data-menu="set_academy_holiday"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Set_academy_holiday' ?>"><span data-i18n="Set Academy Holiday">Set Academy Holiday</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Vat_setup'] == 1) : ?>
                <li data-menu="vat_setup"><a class="dropdown-item" vat_setup="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Vat_setup' ?>"><span data-il8n="Vat Setup">Vat Setup</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Refund_discount_percentages'] == 1) : ?>
                <li data-menu="refund_discount_percentages"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Refund_discount_percentages' ?>"><span data-i18n="Refund Discount Percentage">Refund Discount Percentage</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Fees_structure_images'] == 1) : ?>
                <li data-menu="fees_structure_images"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Fees_structure_images' ?>"><span data-i18n="Fees Structure Images">Fees Structure Images</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $maintenance_menu_arr['Assign_coach'] == 1) : ?>
                <li data-menu="assign_coach"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Assign_coach' ?>"><span data-il8n="Assign Coach">Assign Coach</span></a></li>
              <?php endif; ?>


            </ul>
          </li>
        <?php } ?>

        <?php if($role == 'superadmin' || $report_menu_perm == 1) { ?>
          <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-list"></i><span data-i18n="Pages">Reports</span></a>
            <ul class="dropdown-menu">
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/activity/daily_activity'] == 1) : ?>
                <li data-menu="daily_activity_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/activity/daily_activity' ?>"><span data-il8n="Daily Activity Report">Daily Activity Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/coach_roaster'] == 1) : ?>
                <li data-menu="Coach_roaster"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/coach_roaster' ?>"><span data-il8n="Coach roaster">Coach roaster</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/student_profile'] == 1) : ?>
                <li data-menu="student_profile_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/student_profile' ?>"><span data-il8n="Student Profile Report">Student Profile Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/coach_profile'] == 1) : ?>
                <li data-menu="student_profile_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/coach_profile' ?>"><span data-il8n="Coach Profile Report">Coach Profile Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['daily_transaction/report'] == 1) : ?>
                <li data-menu="daily_transaction_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'daily_transaction/report' ?>"><span data-il8n="Daily Transaction Report">Daily Transaction Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/ledger_report'] == 1) : ?>
                <li data-menu="Ledger_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/ledger_report' ?>"><span data-il8n="Ledger Report">Ledger Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['Reports/attendance_tracking'] == 1) : ?>
                <li data-menu="attendance_tracking_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Reports/attendance_tracking' ?>"><span data-il8n="Attendance Tracking Report">Attendance Tracking Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['Reports/Request_approve_reject'] == 1) : ?>
                <li data-menu="Request_approve_reject_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Reports/Request_approve_reject' ?>"><span data-il8n="Request Approve Reject Report">Request Approve Reject Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['Reports/wallet_transaction/master'] == 1) : ?>
                <li data-menu="Master_wallet_transaction_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Reports/wallet_transaction/master' ?>"><span data-il8n="Master Wallet Transaction Report">Master Wallet Transaction Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['Reports/wallet_transaction'] == 1) : ?>
                <li data-menu="Wallet_transaction_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Reports/wallet_transaction' ?>"><span data-il8n="Wallet Transaction Report">Wallet Transaction Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['Reports/activity_list'] == 1) : ?>
                <li data-menu="Activity_list_Report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Reports/activity_list' ?>"><span data-il8n="Activity List Report">Activity List Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['Reports/activity/slot_schedule'] == 1) : ?>
                <li data-menu="Slot_schedule_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Reports/activity/slot_schedule' ?>"><span data-il8n="Slot Schedule Report">Slot Schedule Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/activity_slot'] == 1) : ?>
                <li data-menu="daily_transaction_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/activity_slot' ?>"><span data-il8n="Activity Slot Report">Activity Slot Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/invoice_report'] == 1) : ?>
                <li data-menu="Invoice_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/invoice_report' ?>"><span data-il8n="Invoice Report">Invoice Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/vat_report'] == 1) : ?>
                <li data-menu="vat_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/vat_report' ?>"><span data-il8n="VAT Report">VAT Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/contract_payment'] == 1) : ?>
                <li data-menu="Contract_payment_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/contract_payment' ?>"><span data-il8n="Contract Payment Report">Contract Payment Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/slot_swap'] == 1) : ?>
                <li data-menu="Slot_swap_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/slot_swap' ?>"><span data-il8n="Slot Swap Report">Slot Swap Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/rating_review'] == 1) : ?>
                <li data-menu="Rating_review_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/rating_review' ?>"><span data-il8n="Rating Review Report">Rating Review Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/class_report/booked'] == 1) : ?>
                <li data-menu="Class_booked_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/class_report/booked' ?>"><span data-il8n="Class Booked Report">Class Booked Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['reports/class_report/attended'] == 1) : ?>
                <li data-menu="Class_attended_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/class_report/attended' ?>"><span data-il8n="Class Attended Report">Class Attended Report</span></a></li>
              <?php endif; ?>
              <?php if ($role == 'superadmin' || $report_menu_arr['Contract_customer_invoice'] == 1) : ?>
                <li data-menu="Class_missed_report"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports/class_report/missed' ?>"><span data-il8n="Class Missed Report">Class Missed Report</span></a></li>
              <?php endif; ?>

              <?php if (show_model_in_menu('newsfeed', $menu_model)) : ?>
                <li data-menu=""><a class="dropdown-item" href="news-feed.html" data-toggle=""><i class="la la-newspaper-o"></i><span data-i18n="News Feed">News Feed</span></a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php } ?>

        <?php if($role == 'superadmin' || $school_menu_perm == 1) { ?>
          <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-institution"></i><span data-i18n="Layouts">School</span></a>
            <ul class="dropdown-menu">

              <?php if ($role == 'superadmin' || $school_menu_arr['school_profile_reports'] == 1) { ?>
                <li data-menu="school_profile_reports"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'school_profile_reports' ?>"><span data-i18n="School Registration / Profile Report">School Registration / Profile Report</span></a></li>
				<?php } ?>
				<?php if ($role == 'superadmin' || $school_menu_arr['school_credits'] == 1) {?>
				
                <li data-menu="school_profile_reports"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'school_credits' ?>"><span data-i18n="School Credit Invoice">School Credit Invoice</span></a></li>
				<?php } ?>
				<?php if ($role == 'superadmin' || $school_menu_arr['school_credits/report'] == 1) { ?>
                <li data-menu="school_profile_reports"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'school_credits/report' ?>"><span data-i18n="School Invoice Report">School Invoice Report</span></a></li>
				<?php } ?>
				<?php if ($role == 'superadmin' || $school_menu_arr['school_attendance'] == 1) { ?>
				
                <li data-menu="school_profile_reports"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'school_attendance' ?>"><span data-i18n="School Attendance / Booking">School Attendance / Booking</span></a></li>
				
				<?php } ?>
              
              

            </ul>
          </li>
        <?php } ?>
        <?php //echo "<pre>"; print_r($menu_model); die; ?>

        <?php if($role == 'superadmin' || $role == 'admin' || $role == 'parent') { ?>
          <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-user"></i><span data-i18n="UI">User</span></a>
            <ul class="dropdown-menu">
              
                <?php if($role == 'superadmin' || $role == 'admin') {?>
                <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'users' ?>"><span data-i18n="Activity">All Users</span></a></li> 
				<?php } ?>
				<?php if($role == 'superadmin') {?>
                <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Admin/superadmin_list' ?>"><span data-i18n="Activity">Super Admin</span></a></li>
				<?php } ?>
				<?php if($role == 'superadmin' || $role == 'admin') {?>
                <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Admin/list_' ?>"><span data-i18n="Activity">Admin</span></a></li>
				<?php } ?>
              <?php if($role == 'superadmin' || $role == 'admin') { ?>
                <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Coach/list_/headcoach' ?>"><span data-i18n="Activity">Head Coach</span></a></li>
              <?php } if( $role == 'superadmin' || $role == 'admin') { ?>
                <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Coach/list_/coach' ?>"><span data-i18n="Activity">Coach</span></a></li>
              <?php } if($role == 'superadmin' || $role == 'admin' || $role == 'parent') { ?>
                <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'users?role=parent' ?>"><span data-i18n="Activity">Parent</span></a></li>
              <?php } ?>


             
            </ul>
          </li>
        <?php } ?>

        <?php //echo "<pre>"; print_r($menu_model); die; ?>

<?php if($role == 'superadmin' || $role == 'admin' ) { ?>
  <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-user"></i><span data-i18n="UI">Court Booking</span></a>
    <ul class="dropdown-menu">
      
          <?php /*if($role == 'superadmin'|| $role == 'admin') {?>
                  <li data-menu="Schedule"><a class="dropdown-item" data-toggle="" href="#"><span data-i18n="Schedule">Schedule &raquo;</span></a>
                   <ul class="dropdown-submenu">
                    <li>
                      <a class="dropdown-item" href="<?php echo base_url() . 'regular_booking' ?>">Regular Booking</a>
                    </li>
                    <li>
                     <a class="dropdown-item" href="<?php echo base_url() . 'bulk_booking' ?>">Bulk Booking</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?php echo base_url() . 'search' ?>">Search</a>
                    </li>
                   </ul>
                 </li>


          <?php }*/ ?>
          
          <?php if($role == 'superadmin'|| $role == 'admin') {?>
                  <li data-menu="Booking"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Court_booking' ?>"><span data-i18n="Booking">Book Court</span></a></li>

          <?php } ?>
          <?php if($role == 'superadmin'|| $role == 'admin') {?>
                  <li data-menu="Customer Booking Approval"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Booking_Approval' ?>"><span data-i18n="Customer Booking Approval">Customer Booking Approval</span></a></li>

          <?php } ?>

          

          <?php //if($role == 'superadmin'|| $role == 'admin'|| $role == 'parent') { ?>
                  <!--<li data-menu="Manage Users"><a class="dropdown-item" data-toggle="" href="#"><span data-i18n="Manage Users">Manage Users &raquo;</span></a>
                  <ul class="dropdown-submenu">
                    <li>
                      <a class="dropdown-item" href="<?php echo base_url() . 'manage_user' ?>">User</a>
                    </li>
                    <li>
                     <a class="dropdown-item" href="<?php echo base_url() . 'prepaid_credits_booking' ?>">Prepaid Credits</a>
                    </li>
          </ul>
                </li>-->
          <?php //} ?>

          <?php if($role == 'superadmin'|| $role == 'admin') {?>
                  <li data-menu="Reports"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'reports_booking' ?>"><span data-i18n="Reports">Reports</span></a></li>
          <?php } ?>

          <?php if($role == 'superadmin'|| $role == 'admin') {?>
                  <li data-menu="Settings"><a class="dropdown-item" data-toggle="" href="#"><span data-i18n="Settings">Settings &raquo;</span></a>
                  <ul class="dropdown-submenu">
                    
					<?php if($role == 'superadmin'|| $role == 'admin') {?>
                  <li data-menu="Manage Sports"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'sports' ?>"><span data-i18n="Manage Sports">Manage Sports</span></a></li>
          <?php } ?>

          <?php if($role == 'superadmin'|| $role == 'admin') {?>
                  <li data-menu="Manage Location"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'location_booking' ?>"><span data-i18n="Manage Location">Manage Location</span></a></li>
          <?php } ?>

          <?php if($role == 'superadmin'|| $role == 'admin') {?>
                  <li data-menu="Manage Court"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'court' ?>"><span data-i18n="Manage Court">Manage Court</span></a></li>
          <?php } ?>
          <?php if($role == 'superadmin'|| $role == 'admin') {?>
                    <li>
                      <a class="dropdown-item" href="<?php echo base_url() . 'pricing' ?>">Pricing</a>
                    </li>
                    <?php } ?>

                    <!--<li>
                     <a class="dropdown-item" href="<?php echo base_url() . 'holidays' ?>">Holidays</a>
                    </li>-->
          </ul>
                </li>
          <?php } ?>
          <?php if($role == 'superadmin'|| $role == 'admin') {?>
                  <li data-menu="Recharge History"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Recharge_history' ?>"><span data-i18n="Recharge History">Recharge History</span></a></li>

          <?php } ?>

          </ul>
  </li>
<?php } ?> 


          <?php //echo "<pre>"; print_r($menu_model); die; ?>

<?php if($role == 'parent') { ?>
  <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-user"></i><span data-i18n="UI">Court Booking</span></a>
    <ul class="dropdown-menu">
      
        
        <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Booking_court' ?>"><span data-i18n="Booking">Booking</span></a></li> 


        <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Reports_booking' ?>"><span data-i18n="Reports">Reports</span></a></li>


        <li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Recharge_history' ?>"><span data-i18n="Recharge History">Recharge History</span></a></li>

    


     
    </ul>
  </li>
<?php }/**/ ?>




              </ul>
  </li>
<?php  ?>

<?php if( $role == 'coach') { ?>
<ul class="nav navbar-nav"  id="main-menu-navigation" data-menu="menu-navigation">
	<li class="dropdown nav-item coach-menu" data-menu="dropdown"><a class="dropdown-toggle nav-link coach_menu" href="#" data-toggle="dropdown"><i class="fa fa-user"></i><span data-i18n="UI">Reports</span></a>
		<ul class="dropdown-menu">
			<li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Coach/head_coach_single_view' ?>"><span data-i18n="Booking">Couch Roster</span></a></li> 
			<li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Coach/coach_profile_view' ?>"><span data-i18n="Booking">Couch Profile list</span></a></li> 
			<li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Rating/rating_review_report' ?>"><span data-i18n="Booking">Rating & Review Report</span></a></li> 
		</ul>
	</li>
	</ul>
	<ul class="nav navbar-nav"   id="main-menu-navigation" data-menu="menu-navigation">
	<li class="dropdown nav-item coach-menu" data-menu="dropdown"><a class="dropdown-toggle nav-link coach_menu" href="#" data-toggle="dropdown"><i class="fa fa-user"></i><span data-i18n="UI">User</span></a>
		<ul class="dropdown-menu">
			<li data-menu="games"><a class="dropdown-item" data-toggle="" href="<?php echo base_url() . 'Coach/head_coach_single_view' ?>"><span data-i18n="Booking">Head Couch</span></a></li> 
		</ul>
		</li>
	</ul>
    
<?php } ?>  
        

      </ul>
      </li>
      </ul>
      </li>
      </ul>
      </li>
      </ul>
      </li>
      </ul>
    </div>
  </div>

  <!-- END: Main Menu-->
  <!-- BEGIN: Content-->


</body>

<div class="margin-top-20 col-lg-12">
  <?php if( $this->session->flashdata('success_msg')!=''){ ?><span id="success-msg" ><div class="alert alert-success"><?php echo $this->session->flashdata('success_msg'); ?></div></span>
  <?php } ?>
  <?php if( $this->session->flashdata('error')!=''){ ?><span id="success-msg" ><div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div></span>
  <?php } ?>
</div>

<!-- END: Body-->
<script>
var base_url = "<?php echo base_url();?>";
</script>

<script>
  /*
$(document).ready(function(){
  $('.dropdown-submenu a.droptown-item').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
*/
</script>
</html>









