<?php $this->load->view('includes/header3'); ?>

<style>
    .badge{font-size: 100% !important;}
    a.badge {color: #fff !important;}
</style>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" style="color: green"><?php echo $title;?></h3>
                <div class="row breadcrumbs-top">
                  <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Reports</a></li>
                      <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a></li>
                    </ol>
                  </div>
                </div>
            </div>
           
        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $title;?></h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="mainbox col-sm-12">
                                        <div class="panel panel-info">
                                            <form action ="<?php echo base_url() . 'reports/activity/'.$report ?>" id="searchForm" method="POST">
                                            
                                            <div class="row" style="margin-bottom: 20px">
                                                <?php if($report == 'daily_activity'){ ?>
                                                <div class="col-lg-2">
                                                    <b>Date</b>
                                                    <input type="date" id="date" name="date" class="form-control" value="<?php echo $date;?>" placeholder="From date">
                                                </div>
                                                <?php } else if($report == 'slot_schedule'){ ?>
                                                <div class="col-lg-2">
                                                    <b>From date</b>
                                                    <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>To date</b>
                                                    <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
                                                </div>
                                                <?php }?>
                                                <div class="col-lg-2">
                                                    <b>Student</b>
                                                    <select class="form-control" id="stud_name" name="stud_name">
                                                        <option value="">Select</option>
                                                        <?php if(isset($studentList)){
                                                            foreach ($studentList as $student) { ?>
                                                                <option value="<?php echo $student['id'] ?>" <?php if(isset($stud_name) && $student['id']==$stud_name ){ echo 'selected';} ?>><?php echo $student['sid'].' / '.$student['name']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>Activity</b>
                                                    <select class="form-control" id="activity_code" name="activity_code">
                                                        <option value="">Select</option>
                                                        <?php if(isset($activityList)){
                                                            foreach ($activityList as $activity) { ?>
                                                                <option value="<?php echo $activity['game_id'] ?>" <?php if(isset($activity_code) && $activity['game_id']==$activity_code ){ echo 'selected';} ?>><?php echo $activity['game']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                 
                                                <div class="col-lg-2">
                                                    <button class="btn btn-success margin-top-20">Search</button>
                                                </div>
                                          

                                            </div>
                                            <div class="row" style="margin-bottom: 20px">
                                                <div class="col-lg-2">
                                                    <b>Location</b>
                                                    <select class="form-control" id="location_idval" name="location_idval">
                                                        <option value="">Select</option>
                                                        <?php if(isset($locationList)){
                                                            foreach ($locationList as $location) { ?>
                                                                <option value="<?php echo $location['location_id'] ?>" <?php if(isset($location_idval) && $location['location_id']==$location_idval ){ echo 'selected';} ?>><?php echo $location['location']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>Level</b>
                                                    <select class="form-control" id="gameLevelId" name="gameLevelId">
                                                        <option value="">Select</option>
                                                        <?php if(isset($levelList)){
                                                            foreach ($levelList as $level) { ?>
                                                                <option value="<?php echo $level['games_level_id'] ?>" <?php if(isset($gameLevelId) && $level['games_level_id']==$gameLevelId ){ echo 'selected';} ?>><?php echo $level['level']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>Coach</b>
                                                    <select class="form-control" id="coach_idval" name="coach_idval">
                                                        <option value="">Select</option>
                                                        <?php if(isset($coachList)){
                                                            foreach ($coachList as $coach) { ?>
                                                                <option value="<?php echo $coach['coach_id'] ?>" <?php if(isset($coach_idval) && $coach['coach_id']==$coach_idval ){ echo 'selected';} ?>><?php echo $coach['coach_name']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                            </div>
                                              </form>
                                            <table id="activityListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <?php if($report == 'slot_schedule'): ?>
                                                        <th scope="col">BkID</th>
                                                        <?php endif; ?>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Reg-id</th>
                                                        <th scope="col">PSA-id</th>
                                                        <th scope="col">Activity</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Level</th>
                                                        <th scope="col">From</th>
                                                        <th scope="col">To</th>
                                                        <th scope="col">Lane/Court</th>
                                                        <th scope="col">Coach</th>
                                                        <?php if($report == 'daily_activity'): ?>
                                                        <th scope="col">Student Signature</th>
                                                        <?php endif; ?>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($activityListing)){
                                                        //echo "<pre>"; print_r($studentList); die;
                                                        foreach ($activityListing as $activity) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <?php if($report == 'slot_schedule'): ?>
                                                        <td><?php echo $activity['ticket_no'];?></td>
                                                        <?php endif; ?>
                                                        <td><?php echo date('d-m-Y', strtotime($activity['booked_date']));?></td>
                                                        <td><?php echo $activity['name'];?></td>
                                                        <td><?php echo $activity['sid'];?></td>
                                                        <td><?php echo $activity['parent_code'];?></td>
                                                        <td><?php echo $activity['activity_id'];?></td>
                                                        <td><?php echo $activity['location_id'];?></td>
                                                        <td><?php echo $activity['level_id'];?></td>
                                                        <td><?php echo $activity['from_time'];?></td>
                                                        <td><?php echo $activity['to_time'];?></td>
                                                        <td><?php echo $activity['lane_court_id'];?></td>
                                                        <td><?php echo $activity['coach_id'];?></td>
                                                        <?php if($report == 'daily_activity'): ?>
                                                        <td></td>
                                                        <?php endif; ?>
                                                        


                                                    </tr>
                                                    <?php }
                                                        }
                                                        ?>
                                                </tbody>
                                                

                                            </table>
                                        </div>
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

<?php
$this->load->view('templates/footer');
?>
<script type="text/javascript">
jQuery(document).ready(function() {
    var dateVal = $('#date').val();
    var t = jQuery('#activityListing').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', 
            footer: true, 
            messageTop: 'Daily Activity Report - '+dateVal, 
            title: 'Daily Activity Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11,12 ]
                },
            },
            { extend: 'pdf', 
            footer: true, 
            messageTop: 'Daily Activity Report - '+dateVal, 
            title: 'Daily Activity Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11,12 ]
                },
            },
            { extend: 'excel', 
            footer: true, 
            messageTop: 'Daily Activity Report - '+dateVal, 
            title: 'Daily Activity Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11,12 ]
                },
            }
        ],
        "fnRowCallback" : function(nRow, aData, iDisplayIndex ){
                var info = $(this).DataTable().page.info();
                $("td:first", nRow).html(info.start + iDisplayIndex +1);
               return nRow;
            },
     
    } );
} );

</script>

