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
                                        <table id="bookingListing" class="table table-responsive table-bordered table-hover small" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="2%">#</th>
                                                    <th scope="col" width="7%">Booking ID</th>
                                                    <th scope="col" width="5%">PSA ID</th>
                                                    <th scope="col" width="8%">Name</th>
                                                    <th scope="col" width="5%">Mobile</th>
                                                    <th scope="col" width="12%">Email</th>
                                                    <th scope="col" width="7%">Date</th>
                                                   <!-- <th scope="col" width="5%">Net <br> Amount<br></th>
                                                    <th scope="col" width="5%">Discount</th>-->
                                                    <th scope="col" width="5%">Paid <br>Amount</th>
                                                    <th scope="col" width="5%">Created<br> By</th>
                                                    <th scope="col" width="10%">Reason</th>
                                                    <th scope="col" width="5%">Status</th>
                                                    <th scope="col" width="5%">View</th>
                                                    <th scope="col" width="5%">Approval</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($bookingList)){
                                                    foreach ($bookingList as $book) { ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo $book['ticket_no'];?></td>
                                                    <td><?php echo $book['parent_code'];?></td>
                                                    <td><?php echo $book['parent_name'];?></td>
                                                    <td><?php echo $book['parent_mobile'];?></td>
                                                    <td><?php echo $book['parent_email'];?></td>
                                                    <td><span style="display:none;"><?php echo strtotime($book['created_at']);?></span><?php echo date('d/m/Y', strtotime($book['created_at']));?></td>
                                                    <!--<td><?php echo $book['payable_amount'];?></td>
                                                    <td><?php echo $book['discount'];?></td>-->
                                                    
                                                    <td><?php echo $book['payable_amount'];?></td>
                                                    <td><?php echo $book['user_name'];?></td>
                                                    <td><?php echo $book['reason'];?></td>
                                                    <td>
                                                        <?php if($book['status'] == 'Pending'){
                                                            $tag ='info';
                                                            $setval = 'PENDING';
                                                        }elseif($book['status'] == 'Approved'){
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
                                                        <a  href="<?php echo base_url('Student_profile_slot_booking/viewBookingDetails/'.$book['id']); ?>" title="View" class="view-booking ml-1 btn-ext-small btn btn-sm btn-info" ><i class="fa fa-eye"></i></a>
                                                    </td>
                                                    <td>
                                                        <button  data-toggle="modal" data-target="#confirmModal" data-val="<?php echo $book['id'];?>" class="btn btn-warning changeStatus"  title="Update Status">Status  </button>
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


<div class="modal fade rotate" id="confirmModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Update Status</h4>
                    <button type="button" class="close" onclick="clearForm()" data-dismiss="modal">&times;<span class="close-x">Close</span></button>
                </div>
              <form id="updateStatus" name="updateStatus" method="POST">
              <input type="hidden" name="booking_id" id="booking_id">
              <div class="modal-body" id="confirmMessage">     
              <div class="checkAlert" style="width:100%;"></div>  
                       
                <div class="row margin-top-20" >
                  <div class="col-md-3 control text-left"><strong>Approval status</strong>*</div>
                  <div class="col-md-9 control text-left">     
                     <select id="status" name="status" class="form-control choiceChosen" required="">
                      <option value="">Select</option>
                      <option value="Approved" >Approved</option>
                       <option value="Rejected" >Rejected</option>
                     </select>
                     <span class=" errorMsg"></span>
                  </div>
              </div>
              <div class="row margin-top-20" >
                  <div class="col-md-3 control text-left"><strong>Reason</strong></div>
                  <div class="col-md-9 control text-left">     
                     <textarea name="reason" id="reason" class="form-control"></textarea>
                     <span class=" errorMsg"></span>
                  </div>
              </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" onclick="updateRequest()">Submit</button>
                  <button type="button" class="btn btn-danger"onclick="clearForm()"  data-dismiss="modal">Cancel</button>
              </div>
          </form>
        </div>
    </div>
</div>
<script type="text/javascript">

jQuery(document).ready(function() {
    var t = jQuery('#bookingListing').DataTable( {
        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
     
    } );
} );


$(".changeStatus").click(function(e){
    e.preventDefault();
    getval=$(this).attr('data-val');
    $('#booking_id').val(getval);
});
function clearForm(){
    jQuery('form#updateStatus').find('select, input').each(function () {
        jQuery(this).val('');
    });
}
function updateRequest(){
    var formData = jQuery("form#updateStatus").serialize();
    jQuery.ajax({
    type:'POST',
    url:baseurl+'Student_profile_slot_booking/changebookingstatus/',
    data:formData,
    dataType:'json',    
         
    success: function (json) {
    $(".errorMsg").html('');
      if(json['error']){
        for (i in json['error']) {
        if(i == 'error_msg'){
            $('.checkAlert').html('<div class="alert alert-danger">'+json['error'][i]+'</div>')
          }
          var element = $('#'+ i);
          $(element).parent().find(".errorMsg").html(json['error'][i]);
        }
      }else{
          if(json['status']=='success'){
            jQuery('form#updateStatus').find('input, select').each(function () {
                jQuery(this).val('');
            });
              location.reload();
          }
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }          
    });
    }
</script>
