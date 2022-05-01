 <?php  $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Activity Slot</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );

 function view_activity_slot(id)
{
    
    window.location='<?php echo site_url('activity_slot/view/'); ?>'+id; 

}
$(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });
</script>
<style type="text/css">

    .btn2
    {
        color: black;
        background-color: white;

    }
</style>

<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 500px;" class="row">
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
            <li> <a href="<?php echo site_url('activity_slot/add/'); ?>" class="btn btn-primary"   ><b>New Activity Slot</b></a></li>
          </ul>
                
              </div>
            </div>
          </div>
        </div>
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Activity  Slot List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
							<table id="example" class="table table-striped table-bordered  " border="0" cellpadding="0" cellspacing="0" style="width:200%">
								<thead>
									<tr>
										<th style="text-align: center">Activity</th>
										<th style="text-align: center">Location</th>
										<th style="text-align: center">Level</th>
										<th style="text-align: center">Coach</th>
										<th style="text-align: center">Time From</th>
										<th style="text-align: center">Time To</th>
										<th style="text-align: center">Hour</th>
										<th style="text-align: center">Slot Code</th>
										<th style="text-align: center">Slot Count</th>
										<th style="text-align: center">Lane/Court</th>
										<th style="text-align: center">Day</th>
										<th style="text-align: center">Category</th>
										<th style="text-align: center">Status</th>
									    <th style="text-align: center">Edit</th>
										<th style="text-align: center">Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php   
										$i=1;                    
										$osql1 = "select s.*,GROUP_CONCAT(sd.days order by sd.ss_days_id  asc) as days from slot_selections s 
										left join slot_selections_days sd on sd.slot_selections_id = s.id  Group By s.id ORDER BY s.id DESC"; 
										$oexe1 = $this->db->query($osql1)->result_array();
			
			
										foreach($oexe1 as $row1)
										{
											$osql2 = "select game from games where game_id=".$row1['game_id'];                              
											$row2 =$this->db->query($osql2)->row_array();
											
											
											$osql3 = "select lane_court from lane_courts where id=".$row1['lane_court_id'];
											$row3 = $this->db->query($osql3)->row_array();
											
											$osql4 = "select level from game_levels where games_level_id=".$row1['level_id']; 
											$row4 = $this->db->query($osql4)->row_array();  

											$osql5 = "select coach_name from coach where coach_id=".$row1['coach_id'];                              
											$row5 = $this->db->query($osql5)->row_array(); 											
										
											$osql7 = "select location from locations where location_id=".$row1['location_id'];
											$row8 =  $this->db->query($osql7)->row_array();
										
										 $date_time=$row1['created_at'];
										 $date_time1=$row1['updated_at'];
									

										


										/*
										$oexe1 = mysqli_query( $con, $osql1 );
										 while ( $row1 = mysqli_fetch_assoc( $oexe1 ) ){  

										$osql2 = "select game from games where game_id=".$row1['game_id'];                              
										$oexe2 = mysqli_query( $con, $osql2 );
										$row2 = mysqli_fetch_assoc( $oexe2);
										*/
										
										/*
										$osql3 = "select lane_court from lane_courts where id=".$row1['lane_court_id'];                              
										$oexe3 = mysqli_query( $con, $osql3 );
										$row3 = mysqli_fetch_assoc( $oexe3 );
										
										
										$osql4 = "select level from game_levels where games_level_id=".$row1['level_id'];                              
										$oexe4 = mysqli_query( $con, $osql4 );
										$row4 = mysqli_fetch_assoc( $oexe4 );
										

										$osql5 = "select coach_name from coach where coach_id=".$row1['coach_id'];                              
										$oexe5 = mysqli_query( $con, $osql5 );
										$row5 = mysqli_fetch_assoc( $oexe5 );
										
										$osql7 = "select location from locations where location_id=".$row1['location_id'];                              
										$oexe7 = mysqli_query( $con, $osql7 );
										$row8 = mysqli_fetch_assoc( $oexe7 );
										 $date_time=$row1['created_at'];
										 $date_time1=$row1['updated_at'];
										*/

										?>
										<tr>
											<?php
											$slot_from_time = explode(' ',$row1['slot_from_time']);
											$slot_to_time = explode(' ',$row1['slot_to_time']);
										?>
												<td style="text-align: center">
													<?php echo $row2['game']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row8['location']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row4['level']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row5['coach_name']; ?>
												</td>
												<td style="text-align: center"><span style="display:none"><?php echo $slot_from_time[0];?></span>
													<?php echo $row1['slot_from_time']; ?>
												</td>
												<td style="text-align: center"><span style="display:none"><?php echo $slot_to_time[0];?></span>
													<?php echo $row1['slot_to_time']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row1['hour']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row1['slot_class']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row1['slot_id']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row3['lane_court']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row1['days']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row1['category']; ?>
												</td>
												<td style="text-align: center">
													<?php echo $row1['status']; ?>
												</td>
												<!--<td style="text-align: center">
													<?php echo date("d/m/Y h-i-s", strtotime("$date_time")); ?>
												</td>
												<td style="text-align: center;">
													<?php if($date_time1=='0000-00-00 00:00:00') { echo '-'; } else  { echo date("d/m/Y h-i-s", strtotime("$date_time1")); } ?>
												</td>-->
												<td style="text-align: center">
													<a type="button" style="color:white;text-decoration:none; line-height: 15px" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('Activity_slot/edit/'.$row1['id']); ?>"> </a>
												</td>
												<td style="text-align: center">
													<a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none; line-height: 15px;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip" href="<?php echo base_url('Activity_slot/delete/'.$row1['id']); ?>"> </a>
												</td>
										</tr>
										<?php  $i++; } ?>
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>
</div>
</body>
</html>



