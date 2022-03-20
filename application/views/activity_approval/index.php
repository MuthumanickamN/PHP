<?php $this->load->view('includes/header3'); ?>
<div class="app-content content">
<div class="content-overlay"></div>
<div class="content-wrapper">
<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title" style="color: green">Academy Activities</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Academy Activities</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Activity Approval</a>
          </li>
         
        </ol>
      </div>
    </div>
  </div>

</div>
<div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Activity  Approval List</h4>
<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

</div>
<div class="card-content collapse show">
<div class="card-body card-dashboard">

<div class="table-responsive">
    <table id="actitvityApproval" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Registration ID</th>
                <th>Student Name</th>
                <th>Activity</th>
                <th>Parent Name</th>
                <th>Parent Id</th>
                <th>Parent Email</th>
                <th>Status</th>
                <th>Approval Status</th>
                <th>View</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
           <?php    
            if(isset($activityList)){                  
            foreach($activityList as $value){ ?>

            <tr>
                <td></td>
                <td><?php echo $value['sid'];  ?></td>
                <td><?php echo $value['student_name']; ?></td>
                <td><?php echo $value['activity']; ?></td>
                <td><?php echo $value['parent_name']; ?></td>
                <td><?php echo $value['user_id'];  ?></td>
                <td><?php echo $value['parent_email_id']; ?></td>
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
                    <a  href="<?php echo base_url('activity_approval/view/'.$value['id']); ?>" title="View" class="view-booking ml-1 btn-ext-small btn btn-sm btn-info" ><i class="fa fa-eye"></i></a>
                </td>
                <td><a type="button" style="color:white;text-decoration:none; line-height: 15px" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('activity_selections/edit/'.$value['id'].'/'.$value['student_id'].'/1'); ?>">
                </a>
                </td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>
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
     var t = $('#actitvityApproval').DataTable( {
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