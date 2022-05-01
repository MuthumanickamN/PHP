<?php $this->load->view('includes/header3'); ?>


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
       
    </div>
    <div class="col-lg-12"><span id="success-msg"></span></div>
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
                        <div class="card-content collapse show container-fluid">
                            <div class="card-body card-dashboard">
                                <div class="mainbox col-sm-12">
                                    <div class="panel panel-info">
                                        <table id="swapList" class="table table-bordered table-hover small" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Ticket No</th>
                                                    <th scope="col">Bk ID</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Activity</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Level</th>
                                                    <th scope="col">Lane/Court</th>
                                                    <th scope="col">Coach</th>
                                                    <th scope="col">Status</th>

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($slotList)){
                                                    foreach ($slotList as $slot) { ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo $slot['bkid'];?></td>
                                                    <td><?php echo $slot['ticket_no'];?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($slot['change_slot_date']));?></td>
                                                    <td><?php echo $slot['change_slot_from_time'].' - '.$slot['change_slot_to_time'];?></td>
                                                    <td><?php echo $slot['activity_id'];?></td>
                                                    <td><?php echo $slot['location_id'];?></td>
                                                    <td><?php echo $slot['level_id'];?></td>
                                                    <td><?php echo $slot['lane_court_id'];?></td>
                                                    <td><?php echo $slot['coach_id'];?></td>
                                                    
                                                    <td>
                                                        <?php if($slot['status'] == 'Active'){
                                                            $tag ='success';
                                                            $setval = 'ACTIVE';
                                                        }else{
                                                            $tag ='danger';
                                                            $setval = 'INACTIVE';
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
<script type="text/javascript">
    $(function () { 
     var t = $('#swapList').DataTable( {
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,              
            "pageLength": 25,
        });
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});
</script>