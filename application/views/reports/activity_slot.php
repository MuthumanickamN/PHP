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
                                            <form action ="<?php echo base_url() . 'index.php/reports/activity_slot' ?>" id="searchForm" method="POST">
                                            
                                            <div class="row" style="margin-bottom: 20px">
                                                <div class="col-lg-2">
                                                    <b>Activity</b>
                                                    <select class="form-control" id="activity_code" name="activity_code" onchange="selectbyActivity()">
                                                        <option value="all" selected="">All</option>
                                                        <?php if(isset($activityList)){
                                                            foreach ($activityList as $activity) { ?>
                                                                <option value="<?php echo $activity['game_id'] ?>" <?php if(isset($activity_code) && $activity['game_id']==$activity_code ){ echo 'selected';} ?>><?php echo $activity['game']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
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
                                                <div class="col-lg-2">
                                                    <button class="btn btn-success margin-top-20">Search</button>
                                                </div>
                                            </div>
                                              </form>
                                            <table id="activitySlotListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Activity</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Level</th>
                                                        <th scope="col">Coach</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Hour</th>
                                                        <th scope="col">Slot Code</th>
                                                        <th scope="col">Slot Count</th>
                                                        <th scope="col">Lane/Court</th>
                                                        <th scope="col">Day</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($activitySlotListing)){
                                                        //echo "<pre>"; print_r($studentList); die;
                                                        foreach ($activitySlotListing as $activity) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $activity['activity'];?></td>
                                                        <td><?php echo $activity['location'];?></td>
                                                        <td><?php echo $activity['level'];?></td>
                                                        <td><?php echo $activity['coach'];?></td>
                                                        <td><?php echo $activity['slot_from_time'].'-'.$activity['slot_to_time'];?></td>
                                                        <td><?php echo $activity['hour'];?></td>
                                                        <td><?php echo $activity['slot_class'];?></td>
                                                        <td><?php echo $activity['slot_id'];?></td>
                                                        <td><?php echo $activity['lane_court'];?></td>
                                                        <td><?php echo $activity['days'];?></td>
                                                        <td><?php echo $activity['category'];?></td>
                                                        <td><?php if($activity['status'] == 'Active'){
                                                            $tag ='success';
                                                            $setval = 'Inactive';
                                                            }else{
                                                                $tag ='danger';
                                                                $setval = 'Active';
                                                            };?>
                                                            <a class='badge badge-<?php echo $tag;?>' onclick="changestatus('<?php echo $activity['id'];?>','status','<?php echo $setval;?>')"><?php echo $activity['status'];?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a  href="<?php echo base_url('index.php/activity_slot/edit/'.$activity['id']); ?>" title="Edit activity slot details" class="edit-transaction ml-1 btn-ext-small btn btn-sm btn-warning" ><i class="fas fa-edit"></i></a>
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
<!-- confirm modal -->
<div class="modal" id="confirmModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-body" id="confirmMessage">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="confirmOk">Ok</button>
                <button type="button" class="btn btn-danger" id="confirmCancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('templates/footer');
?>
<script type="text/javascript">
function selectbyActivity(){
    activity_id = $('#activity_code').val();
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Reports/selectbyActivity',
        data:{activity_id: activity_id},
        dataType:'json',    
        success: function (json) {
            var location = json['locationList'];
            var coach = json['coachList'];
            $('#location_idval').html('<option value="">Select</option>');
            $('#coach_idval').html('<option value="">Select</option>');
            $.each(location, function(i, d) {
                $('#location_idval').append('<option value="' + d.location_id + '">' + d.location + '</option>');
            });
            $.each(coach, function(j, val) {
                $('#coach_idval').append('<option value="' + val.coach_id + '">' + val.coach_name + '</option>');
            });

        },
              
    });
}

function changestatus(id,field,value){
    confirmDialog('Are you sure to change the status?', function(){
        jQuery.ajax({
            type:'POST',
            url:baseurl+'index.php/student_profile_slot_booking/changestatus/'+id+'/'+field+'/'+value,
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
    });
}
function confirmDialog(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#confirmModal");
    modal.modal("show");
    $('.modal-backdrop').addClass('show');
    $('.modal-backdrop').addClass('in');
    $("#confirmMessage").empty().append(message);
    $("#confirmOk").unbind().one('click', onConfirm).one('click', fClose);
    $("#confirmCancel").unbind().one("click", fClose);
}
jQuery(document).ready(function() {
    var t = jQuery('#activitySlotListing').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', 
            footer: true, 
            messageTop: 'Activity Slot Report ', 
            title: 'Activity Slot Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10 ]
                },
            },
            { extend: 'pdf', 
            footer: true, 
            messageTop: 'Daily Activity Report ', 
            title: 'Daily Activity Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10 ]
                },
            },
            { extend: 'excel', 
            footer: true, 
            messageTop: 'Daily Activity Report ', 
            title: 'Daily Activity Report', 
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

