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
                    <form id="attendanceListForm" method="POST">
                        <table id="attendanceList" class="table table-bordered table-hover small">
                            <thead>
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Reg ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Parent Name</th>
                                    <th scope="col">Parent ID</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Approval Status</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Book</th>
                                    <th scope="col">View-slot</th>
                                    <th scope="col">Swap</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($arrayList)){
                                    foreach ($arrayList as $value) { ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $value['sid'];?></td>
                                    <td><?php echo $value['student_name'];?></td>
                                    <td><?php echo $value['activity'];?></td>
                                    <td><?php echo $value['parent_name'];?></td>
                                    <td><?php echo 'PSA00'.$value['parent_user_id'];?></td>
                                    <td><?php echo $value['parent_mobile'];?></td>
                                    <td><?php echo $value['parent_email_id'];?></td>
                                    <td>
                                        <?php if($value['status'] == 'Active'){
                                            $tag ='success';
                                            $setval = 'ACTIVE';
                                        }else{
                                            $tag ='danger';
                                            $setval = 'INACTIVE';
                                        };?>
                                        <a class='badge badge-<?php echo $tag;?>' ><?php echo $setval;?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if($value['approval_status'] == 'Pending'){
                                            $tag ='info';
                                            $setval = 'PENDING';
                                        }elseif($value['approval_status'] == 'Approved'){
                                            $tag ='success';
                                            $setval = 'APPROVED';
                                        }else{
                                            $tag ='danger';
                                            $setval = 'REJECTED';
                                        };?>
                                        <a class='badge badge-<?php echo $tag;?>' ><?php echo $setval;?>
                                        </a>
                                    </td>
                                    <td>
                                        <a  href="<?php echo base_url('index.php/activity_approval/view/'.$value['id']); ?>" title="View booking details" class="view-booking ml-1 btn-ext-small btn btn-sm btn-warning" ><i class="fa fa-eye"></i></a>
                                    </td>
                                    
                                    <td>
                                        <a  href="<?php echo base_url('index.php/student_profile_slot_booking/book/'.$value['activity_id'].'/'.$value['student_id']); ?>" title="Book Slot" class=" ml-1 btn-ext-small btn btn-sm btn-info" ><i class="fa fa-calendar-check-o"></i></a>
                                    </td>
                                    <td>
                                        <a  href="<?php echo base_url('index.php/student_profile_slot_booking/viewbooking/'.$value['activity_id'].'/'.$value['student_id']); ?>" title="Book Slot" class=" ml-1 btn-ext-small btn btn-sm btn-danger" ><i class="fa fa-calendar"></i></a>
                                    </td>
                                    <td>
                                        <a  href="<?php echo base_url('index.php/student_profile_slot_booking/swapList/'.$value['activity_id'].'/'.$value['student_id']); ?>" title="Book Slot" class=" ml-1 btn-ext-small btn btn-sm btn-warning" ><i class="fa fa-exchange"></i></a>
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
    var t = jQuery('#attendanceList').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', 
            footer: true, 
            messageTop: titlename, 
            title: titlename, 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9 ]
                },
            },
            { extend: 'pdf', 
            footer: true, 
            messageTop: titlename, 
            title: titlename,  
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9 ]
                },
            },
            { extend: 'excel', 
            footer: true, 
            messageTop: titlename, 
            title: titlename, 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9 ]
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

