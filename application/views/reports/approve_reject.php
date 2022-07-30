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
                        <form action ="<?php echo base_url() . 'index.php/reports/Request_approve_reject' ?>" id="attendanceBook" method="POST">
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
                                <button class="btn btn-secondary margin-top-20">Search</button>
                            </div>
                        </div>
                    </form>
                    <form id="tableListForm" method="POST">
                        <table id="tableList" class="table table-bordered table-hover small">
                            <thead>
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Ticket No</th>
                                    <th scope="col">BKID</th>
                                    <th scope="col">Reg ID</th>
                                    <th scope="col">PSA ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Coach</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($arrayList)){
                                    foreach ($arrayList as $value) { ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $value['bkid'];?></td>
                                    <td><?php echo $value['ticket_no'];?></td>
                                    <td><?php echo $value['sid'];?></td>
                                    <td><?php echo 'PSA00'.$value['parent_id'];?></td>
                                    <td><?php echo $value['name'];?></td>
                                    <td><?php echo $value['activity_id'];?></td>
                                    <td><?php echo $value['location_id'];?></td>
                                    <td><?php echo $value['checkout_date'];?></td>
                                    <td><?php echo $value['coach_id'];?></td>
                                    <td><?php echo $value['reason'];?></td>
                                    <td>
                                        <?php if($value['approval_status'] == 'Pending'){
                                            $tag ='warning';
                                            $setval = 'Pending';
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
                                        <a  href="<?php echo base_url('index.php/Slot_refund_request/view/'.$value['id']); ?>" title="View request details" class="view-coach ml-1 btn-ext-small btn btn-sm btn-info"  data-schoolid="' + row[0] + '"><i class="fas fa-eye"></i></a>
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
    var fromdateval = jQuery('#from_date').val();
    var todateval = jQuery('#to_date').val();
    var t = jQuery('#tableList').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print',
            className: 'btn btn-secondary', 
            footer: true, 
            messageTop: 'Request approve/reject report for '+fromdateval+' - '+todateval, 
            title: 'Request approve/reject report ', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11 ]
                },
            },
            { extend: 'pdf',
            className: 'btn btn-secondary', 
            footer: true, 
            messageTop: 'Request approve/reject report for '+fromdateval+' - '+todateval, 
            title: 'Request approve/reject report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11 ]
                },
            },
            { extend: 'excel', 
            className: 'btn btn-secondary',
            footer: true, 
            messageTop: 'Request approve/reject report for '+fromdateval+' - '+todateval, 
            title: 'Request approve/reject report', 
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

   
</script>

