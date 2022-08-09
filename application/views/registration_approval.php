<?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Registration Approval</title>
</head>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
});
</script>

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
            <li class="breadcrumb-item"><a href="#">Registration Approval</a>
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
<h4 class="card-title">Registration  Approval</h4>
<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

</div>
<div class="card-content collapse show">
<div class="card-body card-dashboard">
   
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
            <thead>
                <tr>
                  <th style="text-align: center">Student ID</th>
                  <th style="text-align: center">Student Name</th>
                  <th style="text-align: center">Parent Name</th>
                  <th style="text-align: center">Parent ID</th>
                  <th style="text-align: center">Parent Email</th>
                  <th style="text-align: center">Approval Status</th>
                  <th style="text-align: center">View</th>
                  <th style="text-align: center">Edit</th>
                </tr>
            </thead>
            <tbody>
            <?php    
               $i = 1;                  
              foreach ($student as $key => $row1) {
                 $approval_status=$row1['approval_status'];
                ?>
              <tr>
              <td style="text-align: center"><?php   echo $row1['sid'];  ?></td>
              <td style="text-align: center"><?php echo $row1['name']; ?></td>
              <td style="text-align: center"><?php echo $row1['parent_name']; ?></td>
              <td style="text-align: center;"><?php echo $row1['parent_code'];  ?></td>
              <td style="text-align: center"><?php echo $row1['email_id']; ?></td>

              <td style="text-align: center;">
              <?php if($row1['approval_status'] == 'Approved'){
                  $tag ='success';
                  $setval = 'Pending';
                  }else{
                      $tag ='danger';
                      $setval = 'Approved';
                  };?>
                  <a class='badge2 badge-<?php echo $tag;?>' onclick="changestatus('<?php echo $row1['id'];?>','approval_status','<?php echo $setval;?>')"><?php echo $row1['approval_status'];?>
                  </a>
              </td>

              <td align="center">
                <a type="button" style="color:white;text-decoration:none" href="<?php echo base_url('Students/view/'.$row1['id']); ?>" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">
              <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
            </td>
              <td style="text-align: center; line-height: 8px"><a type="button" style="color:white;text-decoration:none;" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('student/edit/'.$row1['id']); ?>">
              </a>
              </td>
              </tr>
              <?php $i++; } ?>
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

</body>
</html>


<script type="text/javascript">
  function changestatus(id,field,value){
    confirmDialog('Are you sure to change the approval status?', function(){
        jQuery.ajax({
            type:'POST',
            url:baseurl+'index.php/Students/changestatus/'+id+'/'+field+'/'+value,
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

