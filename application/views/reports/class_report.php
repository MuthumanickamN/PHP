<?php $this->load->view('includes/header3'); ?>

<style>
    .badge{font-size: 100% !important;}
    a.badge {color: #fff !important;}
    .changeStatusDiv{  margin:20px;  }
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
                        <form action ="<?php echo base_url() . 'index.php/reports/class_report/'.$type ?>" id="attendanceBook" method="POST">
                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-lg-2">
                                <b>From date</b>
                                <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                            </div>
                            <div class="col-lg-2">
                                <b>To date</b>
                                <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
                            </div>
                            <div class="col-lg-2">
                                <b>PSA ID</b>
                                <select class="form-control" id="parent_idval" name="parent_idval">
                                    <option value="">Select</option>
                                    <?php if(isset($parentList)){
                                        foreach ($parentList as $parent) { ?>
                                            <option value="<?php echo $parent['parent_id'] ?>" <?php if(isset($parent_idval) && $parent['parent_id']==$parent_idval ){ echo 'selected';} ?>><?php echo 'PSA00'.$parent['parent_id'].' - '.$parent['parent_name']; ?></option>
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
                            <?php 
                            if($type == 'booked'){
                            $statusArr = array('Pending','Present','Absent'); ?>
                            <div class="col-lg-2">
                                <b>Status</b>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select</option>
                                    <?php foreach ($statusArr as $val) { ?>
                                    <option value="<?php echo $val;?>" <?php if( $val==$status ){ echo 'selected';} ?> ><?php echo $val;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>
                        </div>
                    </form>
                    <form id="attendanceListForm" method="POST">
                        <table id="attendanceList" class="table table-bordered table-hover small">
                            <thead>
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">PSA ID</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Lane/Court</th>
                                    <th scope="col">Coach</th>
                                    <th scope="col">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($attendanceList)){
                                    foreach ($attendanceList as $attendance) { ?>
                                <tr>
								
                                    <td></td>
                                    <td><?php echo date('d-m-Y', strtotime($attendance['booked_date']));?></td>
                                    <td><?php echo $attendance['name'];?></td>
                                    <td><?php echo 'PSA00'.$attendance['parent_id'];?></td>
                                    <td><?php echo $attendance['activity_id'];?></td>
                                    <td><?php echo $attendance['location_id'];?></td>
                                    <td><?php echo $attendance['level_id'];?></td>
                                    <td><?php echo $attendance['from_time'].'-'.$attendance['to_time'];?></td>
                                    <td><?php echo $attendance['lane_court_id'];?></td>
                                    <td><?php echo $attendance['coach_id'];?></td>
                                    <td>
                                        <?php if($attendance['attendance'] == 'Pending'){
                                            $tag ='info';
                                            $setval = 'PENDING';
                                        }elseif($attendance['attendance'] == 'Present'){
                                            $tag ='success';
                                            $setval = 'PRESENT';
                                        }else{
                                            $tag ='danger';
                                            $setval = 'ABSENT';
                                        };?>
                                        <a class='badge badge-<?php echo $tag;?>' ><?php echo $setval;?>
                                        </a>
                                        
                                    </td>
                                    
                                </tr>
                                <?php }
                                    }
                                    ?>
                            </tbody>
                            

                        </table>
                        </form>
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
    var titlename = '<?php echo $title; ?>';
    var fromdateval = jQuery('#from_date').val();
    var todateval = jQuery('#to_date').val();
    var t = jQuery('#attendanceList').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', 
            footer: true, 
            messageTop: titlename+' for '+fromdateval+' - '+todateval, 
            title: titlename, 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10 ]
                },
            },
            { extend: 'pdf', 
            footer: true, 
            messageTop: titlename+' for '+fromdateval+' - '+todateval, 
            title: titlename,  
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10 ]
                },
            },
            { extend: 'excel', 
            footer: true, 
            messageTop: titlename+' for '+fromdateval+' - '+todateval, 
            title: titlename, 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10 ]
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

