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
                                            <form action ="<?php echo base_url() . 'index.php/reports/coach_profile' ?>" id="searchForm" method="POST">
                                            
                                            <div class="row" style="margin-bottom: 20px">
                                                <div class="col-lg-2">
                                                    <b>Coach</b>
                                                    <select class="form-control" id="coach_idval" name="coach_idval">
                                                        <option value="">Select</option>
                                                        <?php if(isset($coachList)){
                                                            foreach ($coachList as $coach) { ?>
                                                                <option value="<?php echo $coach['coach_id'] ?>" <?php if(isset($coach_idval) && $coach['coach_id']==$coach_idval ){ echo 'selected';} ?>><?php echo 'PSSCH'.$coach['coach_id'].' | '.$coach['coach_name']; ?></option>
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
                                                    <button class="btn btn-success margin-top-20">Search</button>
                                                </div>
                                          

                                            </div>
                                            
                                              </form>
                                            <table id="coachListing" class="table table-bordered table-hover small " style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Coach ID</th>
                                                        <th scope="col">Coach Name</th>
                                                        <th scope="col">Activity</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Phone no</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($coachListing)){
                                                        //echo "<pre>"; print_r($studentList); die;
                                                        foreach ($coachListing as $coach) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo 'PSSCH'.$coach['coach_id'];?></td>
                                                        <td><?php echo $coach['coach_name'];?></td>
                                                        <td><?php echo $coach['activity_id'];?></td>
                                                        <td><?php echo $coach['location_id'];?></td>
                                                        <td><?php echo $coach['phone1'];?></td>
                                                        <td><?php echo $coach['email_id'];?></td>
                                                        <td>
                                                            <?php if($coach['status'] == 'Active'){
                                                            $tag ='success';
                                                            $setval = 'Inactive';
                                                        }else{
                                                            $tag ='danger';
                                                            $setval = 'Active';
                                                        };?>
                                                            <a class='badge badge-<?php echo $tag;?>' onclick="changestatus('<?php echo $coach['coach_id'];?>','status','<?php echo $setval;?>')"><?php echo $coach['status'];?></a>
                                                        </td>
                                                        <td>
                                                            <a  href="<?php echo base_url('index.php/coach/view/'.$coach['coach_id']); ?>" title="View coach details" class="view-coach ml-1 btn-ext-small btn btn-sm btn-info"  data-schoolid="' + row[0] + '"><i class="fas fa-eye"></i></a>
                                                            <a  href="<?php echo base_url('index.php/coach/edit/'.$coach['coach_id']); ?>" title="Edit coach details" class="edit-coach ml-1 btn-ext-small btn btn-sm btn-warning"  data-schoolid="' + row[0] + '"><i class="fas fa-edit"></i></a>
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
<!-- Modal confirm -->
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
jQuery(document).ready(function() {
    var t = jQuery('#coachListing').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', 
            footer: true, 
            messageTop: 'Coach Profile Report', 
            title: 'Coach Profile Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7 ]
                },
            },
            { extend: 'pdf', 
            footer: true, 
            messageTop: 'Coach Profile Report', 
            title: 'Coach Profile Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7 ]
                },
            },
            { extend: 'excel', 
            footer: true, 
            messageTop: 'Coach Profile Report', 
            title: 'Coach Profile Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7 ]
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
function changestatus(id,field,value){
    confirmDialog('Are you sure to change the status?', function(){
        jQuery.ajax({
            type:'POST',
            url:baseurl+'index.php/Reports/changestatus/coach/'+id+'/'+field+'/'+value,
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
</script>

