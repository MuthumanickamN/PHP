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
                                            <form action ="<?php echo base_url() . 'index.php/reports/coach_roaster' ?>" id="searchForm" method="POST">
                                            
                                            <div class="row" style="margin-bottom: 20px">    
                                                <div class="col-lg-2">
                                                    <b>Coach</b>
                                                    <select class="form-control coach" id="coach_idval" name="coach_idval">
                                                        <option value="">Select</option>
                                                        <?php if(isset($coachList)){
                                                            foreach ($coachList as $coach) { ?>
                                                                <option value="<?php echo $coach['coach_id'] ?>" <?php if(isset($coach_idval) && $coach['coach_id']==$coach_idval ){ echo 'selected';} ?>><?php echo $coach['coach_name']; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>                                            
                                                <div class="col-lg-2">
                                                    <b>Date</b>
                                                    <input type="date" id="date" name="date" class="form-control" value="<?php echo $date;?>" placeholder="From date">
                                                </div>
                                                <div class="col-lg-2">
                                                    <button class="btn btn-secondary margin-top-20">Search</button>
                                                </div>
                                            </div>
                                              </form>
                                            <table id="activityListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Student Name</th>
                                                        <th scope="col">Student ID</th>
                                                        <th scope="col">Activity</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Level</th>
                                                        <th scope="col">From</th>
                                                        <th scope="col">To</th>
                                                        <th scope="col">Lane/Court</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Coach</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($activityListing)){
                                                        foreach ($activityListing as $activity) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $activity['name'];?></td>
                                                        <td><?php echo $activity['sid'];?></td>
                                                        <td><?php echo $activity['activity_id'];?></td>
                                                        <td><?php echo $activity['location_id'];?></td>
                                                        <td><?php echo $activity['level_id'];?></td>
                                                        <td><?php echo $activity['from_time'];?></td>
                                                        <td><?php echo $activity['to_time'];?></td>
                                                        <td><?php echo $activity['lane_court_id'];?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($activity['booked_date']));?></td>
                                                        <td><?php echo $activity['coach_id'];?></td>                                                        
                                                        


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
            className: 'btn btn-secondary', 
            footer: true, 
            messageTop: 'Coach Roaster Report - '+dateVal, 
            title: 'Coach Roaster Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10 ]
                },
            },
            { extend: 'pdf', 
            className: 'btn btn-secondary',
            footer: true, 
            messageTop: 'Coach Roaster Report - '+dateVal, 
            title: 'Coach Roaster Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10 ]
                },
            },
            { extend: 'excel', 
            className: 'btn btn-secondary',
            footer: true, 
            messageTop: 'Coach Roaster Report - '+dateVal, 
            title: 'Coach Roaster Report', 
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
<script type = "text/javascript">
$(document).ready(function(){
$('.coach').select2();

});
</script>

