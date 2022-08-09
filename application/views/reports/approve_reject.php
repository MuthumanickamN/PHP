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
                                <th style="text-align:center">Reg ID</th>
                  <th style="text-align:center">PSA ID</th>
                  <th style="text-align:center">Name</th>
                  <th style="text-align:center">Bkid</th>
                  <th style="text-align:center">Activity</th>
                  <th style="text-align:center">Location</th>
                  <th style="text-align:center">Coach</th>
                  <!--<th style="text-align:center">Type</th>-->
                  <th style="text-align:center">Slot Date</th>
                  <th style="text-align:center">Slot Time</th>
                  <th style="text-align:center">Refund Requested on</th>
                  <th style="text-align:center">Reason</th>
                  <th style="text-align:center">Document</th>
                  <th style="text-align:center">Approval status</th>
                  <th style="text-align:center; width:80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php  
                if(isset($list) && !empty($list)){
                  foreach ($list as $key => $value) {
                      
                      $booked_on = $value['booked_date'];
                      $requested_on = $value['refund_requested_on'];
                ?>
                <tr>
                  <!--<td></td>
                  <td style="text-align:center"><?php echo  $value['booking_no']; ?></td>-->
                  <td style="text-align:center"><?php echo  $value['sid']; ?></td>
                  <td style="text-align:center"><?php echo  $value['parent_code']; ?></td>
                  <td style="text-align:center"><?php echo  $value['student_name']; ?></td>
                  <td style="text-align:center"><?php echo  $value['booking_no']; ?></td>
                  <td style="text-align:center"><?php echo  $value['activity_id']; ?></td>
                  <td style="text-align:center"><?php echo  $value['location_id']; ?></td>
                  <td style="text-align:center"><?php echo  $value['coach_id']; ?></td>
                 <!-- <td style="text-align:center"><?php echo  'Refund'; ?></td> --> 
                  <td style="text-align:center"><span style="display:none"><?php echo strtotime("$booked_on");?></span><?php echo date("d/m/Y", strtotime("$booked_on"));  ?></td>
                  <td style="text-align:center"><?php echo $value['from_time'].'-'.$value['to_time']; ?></td>
                  <td style="text-align:center"><span style="display:none"><?php echo strtotime("$requested_on");?></span><?php echo date("d/m/Y H:i", strtotime("$requested_on"));  ?></td>
                  <td style="text-align:center"><?php echo $value['reason']; ?></td>
                  <td style="text-align:center">
                  <?php $image1=$value['refund_document']; 
                      if($image1 != ''){ ?> 
                      <a href="<?php echo base_url().'assets/'.$value['refund_document']; ?>">
                      <img src="<?php echo base_url().'assets/'.$value['refund_document']; ?>" style="width:30px; height:30px;  vertical-align: middle"/>
                      </a>
                  <?php } else{ echo "--"; } ?>
                    </td>
                  <td style="text-align:center">
                    <?php 
                        if($value['refund_approval_status'] == 'Approved'){
                          $approvaltag ='success';
                         
                      }else if($value['refund_approval_status'] == 'Rejected'){
                          $approvaltag ='danger';
                      }else{
                          $approvaltag ='info';
                      };?>
                    <a class='badge2 badge-<?php echo $approvaltag;?>'><?php echo ucfirst($value['refund_approval_status']);?></a>
                  </td>
                  <td style="text-align:center">
                    <?php if($value['refund_approval_status'] != 'Approved'){ ?>
                      <button  data-toggle="modal" data-target="#confirmModal" data-value="<?php echo $value['id'];?>" class="btn btn-warning" onclick="changestatus(<?php echo $value['id'];?>)" title="Update Status"><i class="fa fa-edit"></i>  </button>
                    <?php } else{ ?>
                    <!--<a  href="<?php echo base_url('Slot_refund_request/view/'.$value['id']); ?>" title="View" class="edit-transaction ml-1 btn-ext-small btn btn-sm btn-info" ><i class="fa fa-eye"></i></a>-->
                    <button  data-toggle="modal" data-target="#confirmModal" data-value="<?php echo $value['id'];?>" class="btn btn-warning" onclick="changestatus(<?php echo $value['id'];?>)" title="Update Status" disabled><i class="fa fa-edit"></i>  </button>
                  <?php } ?>
                  </td>
              </tr>
              <?php 
            } }
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
<div class="modal fade rotate" id="confirmModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm()"  data-dismiss="modal">&times;</button>
                </div>
              <form id="updateStatus" name="updateStatus" method="POST">
              <input type="hidden" name="id_val" id="id_val">
              <div class="modal-body" id="confirmMessage">
                <div class="row" >
                  <div class="col-md-3 control text-left"><strong>Comment</strong>*</div>
                  <div class="col-md-9 control text-left">     
                    <textarea class="form-control" id="comment" name="comment"></textarea>
                    <span class="errorMsg" id="error1"></span>
                  </div>
                </div>
                <div class="row margin-top-20" >
                  <div class="col-md-3 control text-left"><strong>Status</strong>*</div>
                  <div class="col-md-9 control text-left">     
                     <select id="status" name="status" class="form-control choiceChosen">
                      <option value="">Select</option>
                      <option value="Approved" >Approved</option>
                       <option value="Rejected" >Rejected</option>
                     </select>
                     <span class="errorMsg" id="error2"></span>
                  </div>
              </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" id="btn_submit" onclick="updateRequest()">Submit</button>
                   <button type="button" class="btn btn-danger" onclick="clearForm()"  data-dismiss="modal">Cancel</button>
              </div>
          </form>
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
function changestatus(id){
    $('#id_val').val(id);
  }
function updateRequest(){
	 //$("#btn_submit").hide();
  jQuery.ajax({
      type:'POST',
      url:baseurl+'Slot_refund_request/changestatus',
      data:jQuery("form#updateStatus").serialize(),
      dataType:'json',    
             
      success: function (json) {
        $(".errorMsg").html('');
          if(json['error']){
            for (i in json['error']) {
              if(i == 'error_msg'){
                location.reload();
              }
              var element = $('#'+ i);
              $(element).parent().find(".errorMsg").html(json['error'][i]);
            }
          }else{
			   //$("#btn_submit").show();
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

function clearForm()
{
    $('#error1').val('');
    $('#error2').val('');
    $('#updateStatus').trigger("reset");
}
   
</script>

