<?php $this->load->view('includes/header3'); ?>
<style>
    .dataTables_filter {
        display: none;
    }

    .dataTables_wrapper .dt-buttons {
        float: right;
        text-align: center;
        font-size: 12px;
    }

    .dataTables_paginate {
        font-size: 10px;
        margin-bottom: 5px;
    }

    .dataTables_length {
        font-size: 12px;
        margin-bottom: 5px;
    }

    .dataTables_info {
        font-size: 12px;
    }
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
                      <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Home</a></li>
                      <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a></li>
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
                            <li>
                                <a href="<?php echo base_url() . 'index.php/School_attendance/booking' ?>" class="float-right btn btn-primary btn-sm" style="margin: 4px;"><i class="fa fa-th"></i> Booking</a>
                            </li>
                        </ul>

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
                                            <form action ="<?php echo base_url() . 'index.php/School_attendance' ?>" id="searchForm" method="POST">
                                            <div class="row" style="margin-bottom: 20px">
                                                <div class="col-lg-3">
                                                    <b>From date</b>
                                                    <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                                                </div>
                                                <div class="col-lg-3">
                                                    <b>To date</b>
                                                    <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>School name</b>
                                                    <select class="form-control school_name" id="schoolId" name="schoolId">
                                                        <option value="">Select</option>
                                                        <?php if(isset($schoolList)){
                                                            foreach ($schoolList as $school) { ?>
                                                                <option value="<?php echo $school['id'] ?>" <?php if(isset($schoolId) && $school['id']==$schoolId ){ echo 'selected';} ?>><?php echo $school['school_name']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>Coach</b>
                                                    <select class="form-control coach" id="coachId" name="coachId">
                                                        <option value="">Select</option>
                                                        <?php if(isset($coachList)){
                                                            foreach ($coachList as $coach) { ?>
                                                                <option value="<?php echo $coach['coach_id'] ?>" <?php if(isset($coachId) && $coach['coach_id']==$coachId ){ echo 'selected';} ?>><?php echo $coach['coach_name']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button class="btn btn-secondary margin-top-20">Search</button>
                                                </div>
                                          

                                            </div>
                                              </form>
                                            <table id="transactionListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">BK ID</th>
                                                        <th scope="col">Booking date</th>
                                                        <th scope="col">School name</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Activity</th>
                                                        <th scope="col">Coach</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Class Attendance</th>
                                                        <th scope="col">View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($bookingList)){
                                                        foreach ($bookingList as $booking) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $booking['bkid'];?></td>
                                                        <td><?php echo $booking['date'];?></td>
                                                        <td><?php echo $booking['school_name'];?></td>
                                                        <td><?php echo $booking['location_id'];?></td>
                                                        <td><?php echo $booking['activity_id'];?></td>
                                                        <td><?php echo $booking['coach_id'];?></td>
                                                        <td><?php echo $booking['time'];?></td>
                                                        <td><?php if($booking['status'] == 0){?>
                                                            <label style="padding: 2px 8px; " class="btn-primary">PENDING</label>
                                                            <?php }else if($booking['status'] == 1){?>
                                                            <label style="padding: 2px 8px; " class="btn-success">PRESENT</label>
                                                            <?php }else { ?>
                                                            <label style="padding: 2px 8px; " class="btn-danger">ABSENT</label>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <a href="#" style="color: #fff !important;border-radius: 0;" onclick="changeStatus(<?php echo $booking['id'];?>,'1')" class="btn btn-success">Present</a>
                                                            <a href="#" style="color: #fff !important;border-radius: 0;" onclick="changeStatus(<?php echo $booking['id'];?>,'2')" class="btn btn-danger">Absent</a>
                                                        </td>
                                                        <td>
                                                            <button  data-toggle="modal" data-target="#view_booking" data-value="<?php echo $booking['id'];?>" class="btn btn-warning" onclick="view_booking(<?php echo $booking['id'];?>)">View</button>
                                                        </td>
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
$this->load->view('school_attendance/popup/view_booking');
$this->load->view('templates/footer');
?>
<script type="text/javascript">
$(document).ready(function(){
$('.school_name').select2();
$('.coach').select2();
});
jQuery(document).ready(function() {
    var t = jQuery('#transactionListing').DataTable( {
        
        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
     
    } );
} );
function changeStatus(booking_id, status){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/School_attendance/changestatus/'+booking_id+'/'+status,
        dataType:'json',    
               
        success: function (json) {
            $('.text-danger').remove();
            if(json['status']){
                if(json['status']=='success'){
                    location.reload();
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
}
function view_booking(bk_id){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/school_attendance/getbookingDetails',
        data:{bk_id: bk_id},
        dataType:'json',                         
        success: function (json) {
            if(json['data']){
                for (i in json['data']) {

                    var element = jQuery('.label-'+i);
                    jQuery(element).after(json['data'][i]);
                }
            }                             
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
}
</script>
