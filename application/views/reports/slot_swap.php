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
                        <form action ="<?php echo base_url() . 'index.php/reports/attendance_tracking' ?>" id="attendanceBook" method="POST">
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
                                <button class="btn btn-success margin-top-20">Search</button>
                            </div>
                      

                        </div>
                    </form>
                    <form id="attendanceListForm" method="POST">
                        <table id="attendanceList" class="table table-bordered table-hover small">
                            <thead>
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Parent name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Bk ID</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Old Slot date</th>
                                    <th scope="col">Old Slot Timing</th>
                                    <th scope="col">New Slot date</th>
                                    <th scope="col">New Slot Timing</th>
                                    <th scope="col">Created date</th>
                                    <th scope="col">Updated by</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($arrayList)){
                                    foreach ($arrayList as $value) { ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $value['student_name'];?></td>
                                    <td><?php echo $value['parent_name'];?></td>
                                    <td><?php echo $value['mobile_no'];?></td>
                                    <td><a class="badge badge-success" href="javascript:void(0);" data-toggle="modal" data-target="#swap_details" onclick="getSwapDetails(<?php echo $value['id'];?>)"><?php echo $value['ticket_no'];?></a></td>
                                    <td><?php echo $value['activity'];?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value['checkout_date']));?></td>
                                    <td><?php echo $value['from_time'].'-'.$value['to_time'];?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value['change_slot_date']));?></td>
                                    <td><?php echo $value['change_slot_from_time'].'-'.$value['change_slot_to_time'];?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value['created_at']));?></td>
                                    <td><?php echo $value['updated_admin_id'];?></td>

                                    
                                    
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
$this->load->view('reports/popup/swap_list');
$this->load->view('templates/footer');
?>
<script type="text/javascript">

jQuery(document).ready(function() {
    var fromdateval = jQuery('#from_date').val();
    var todateval = jQuery('#to_date').val();
    var t = jQuery('#attendanceList').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', 
            footer: true, 
            messageTop: 'Slot Swap report for '+fromdateval+' - '+todateval, 
            title: 'Slot Swap report ', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11 ]
                },
            },
            { extend: 'pdf', 
            footer: true, 
            messageTop: 'Slot Swap report for '+fromdateval+' - '+todateval, 
            title: 'Slot Swap report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11 ]
                },
            },
            { extend: 'excel', 
            footer: true, 
            messageTop: 'Slot Swap report for '+fromdateval+' - '+todateval, 
            title: 'Slot Swap report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11 ]
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

function getSwapDetails(id){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Reports/getSwapDetails',
        data:{id: id},
        dataType:'html',    
        success: function (html) {
            jQuery('#swapTable').html(html);
        },
              
    });
}
</script>

