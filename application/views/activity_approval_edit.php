<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Activity Approval</title>
</head>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
    
 function view_games_level(games_level_id){
    window.location='<?php echo site_url('index.php/activity_level/view/'); ?>'+games_level_id; 
}

$(function () {
    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
});


function classes(){ 
  var level_id=document.getElementById('level_id').value;
  $.ajax({
      url:"<?php echo base_url().'index.php/activity_approval/classes/'; ?>?level_id=level_id",
      type:"POST",
      data:{level_id:level_id},
      success:function(data){   
        document.getElementById('result').innerHTML=data;
      }
});
}
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
                  <li class="breadcrumb-item"><a href="#">Activity Approval</a>
                  </li>
                 
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-6 col-12">
            <div class="media width-250 float-right">
              <media-left class="media-middle">
                <div id="sp-bar-total-sales"></div>
              </media-left>
              <div class="media-body media-right text-right">
                 <ul class="list-inline mb-0">
            <li> <a href="<?php echo site_url('index.php/activity_approval/'); ?>" class="btn btn-primary"   ><b>Approval List</b></a></li>
          </ul>
                
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
                    <h4 class="card-title">Activity  Approval Edit</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                 <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
                      <form id="approvalForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
                        <input type="hidden" value="<?php echo $id;?>" name="id" id="id">
                       <div class="row">
                        <div class="col-md-3"><strong>Name</strong>*</div>
                        <div class="col-md-3">
                        <input type="text" id="student_name" name="student_name" readonly="" class="form-control" value="<?php echo $student_name; ?>">
                        <span class="errorMsg"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><strong>Activity</strong><abbr title="required">*</div>
                        <div class="col-md-3">     
                         <select name="activity_id" id="activity_id" class="form-control choiceChosen"  >
                            <option value="">Select</option>
                            <?php                        
                          $osql1 = "select game_id,game from games ORDER BY game ASC";                              
                            $oexe1 = mysqli_query( $con, $osql1 );
                             while ( $row1 = mysqli_fetch_assoc( $oexe1 ) ){ ?>
                        <option value="<?php echo $row1['game_id'] ?>" <?php if($row1['game_id']==$activity_id ){ echo 'selected';} ?>><?php echo $row1['game'] ?>
                         </option><?php }  ?></select>
                         <span class="errorMsg"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><strong>Level</strong>*</div>
                        <div class="col-md-3">
                        <select name="level_id" id="level_id" class="form-control choiceChosen"   onchange="classes()">
                            <option value="">Select</option>
                             <?php                        
                          $osql1 = "select level,games_level_id from game_levels ORDER BY level ASC";                              
                            $oexe1 = mysqli_query( $con, $osql1 );
                             while ( $row1 = mysqli_fetch_assoc( $oexe1 ) ){ ?>
                        <option value="<?php echo $row1['games_level_id'] ?>" <?php if($row1['games_level_id']==$level_id ){ echo 'selected';} ?>><?php echo $row1['level'] ?>
                         </option><?php }  ?></select>
                         <span class="errorMsg"></span>
                        </div>
                    </div>
                    <div id="result"></div>
                     <div class="row">
                        <div class="col-md-3"><strong>Contract</strong>*</div>
                        <div class="col-md-3">
                  <input id="contract" type="radio" value="Yes" name="contract" <?php if($contract=='Yes'){ echo 'checked';} ?> >
                    <label style="margin-left: 10px; margin-right: 10px">Yes</label>
                  <input id="contract" type="radio" value="No" name="contract" <?php if($contract=='No'){ echo 'checked';} ?>>
                          <label style="margin-left: 10px; margin-right: 10px">No</label>
                          <input id="contract" type="radio" value="Contract" name="contract" <?php if($contract=='Contract'){ echo 'checked';} ?> onclick="getContract('<?php echo $id; ?>')">
                          <label style="margin-left: 10px; margin-right: 10px">Contract Form</label>
                          <br><span class="errorMsg"></span>
                        </div>
                      </div>

                     <div class="row">
                        <div class="col-md-3"><strong>Status</strong>*</div>
                        <div class="col-md-3">     
                         <select name="status" id="status" class="form-control choiceChosen"  >
                            <option value="">Select</option>
                      
                        <option value="Active" <?php if($status=='Active'){ echo 'selected';} ?>>Active
                         </option>
                       <option value="Inactive" <?php if($status=='Inactive'){ echo 'selected';} ?>>Inactive
                         </option></select>
                         <span class="errorMsg"></span>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-3"><strong>Discount Applicable</strong>*</div>
                        <div class="col-md-3">
                          <input id="discount_applicable" class="discount_applicable" <?php if($discount_applicable=='Yes'){ echo 'checked';} ?> type="radio" value="Yes" name="discount_applicable" >
                            <label style="margin-left: 10px; margin-right: 10px">Yes</label>
                          <input id="discount_applicable" class="discount_applicable" <?php if($discount_applicable=='No'){ echo 'checked';} ?>  type="radio" value="No" name="discount_applicable" >
                          <label style="margin-left: 10px; margin-right: 10px">No</label>
                         <br><span class="errorMsg"></span>
                        </div>
                      </div>

                      <div class="discount_div" style="display: none;">
                      <div class="row">
                        <div class="col-md-3"><strong>Discount Type</strong>*</div>
                        <div class="col-md-3">     
                         <select name="discount_type" id="discount_type" class="form-control"  >
                            <option value="">Select</option>
                            <?php if(isset($discountList)){
                                foreach ($discountList as $key => $discount) { ?>
                                <option value="<?php echo $discount['id'];?>" <?php if($status==$discount['id']){ echo 'selected';} ?> ><?php echo $discount['discount_name'];?></option>
                            <?php } } ?>
                        </select>
                        <span class="errorMsg"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"><strong>Discount Percentage</strong>*</div>
                        <div class="col-md-3">
                        <input type="text" id="discount_percentage" name="discount_percentage" readonly="" class="form-control" value="<?php echo $discount_percentage; ?>" readonly>
                        <span class="errorMsg"></span>
                        </div>
                    </div>
                    </div>


                        <div class="row">
                        <div class="col-md-3"><strong>Approval Status</strong>*</div>
                        <div class="col-md-3">     
                        <select name="approval_status" id="approval_status" class="form-control choiceChosen"  >
                        <option value="">Select</option>
                      
                        <option value="Pending" <?php if($approval_status=='Pending'){ echo 'selected';} ?>>Pending
                         </option>
                       <option value="Approved" <?php if($approval_status=='Approved'){ echo 'selected';} ?>>Approve
                         </option></select>
                         <span class="errorMsg"></span>
                        </div>
                    </div>

                       <div class="row">
                        <div class="col-md-3"><strong>Parent Id</strong>*</div>
                        <div class="col-md-3">
                        <input type="text" id="user_id" name="user_id" readonly="" class="form-control" value="<?php echo $user_id; ?>">
                        </div>
                    </div>

                       <div class="row">
                        <div class="col-md-3"><strong>Parent Name</strong>*</div>
                        <div class="col-md-3">
                        <input type="text" id="parent_name" name="parent_name" readonly="" class="form-control" value="<?php echo $parent_name; ?>">
                        </div>
                    </div>

                       <div class="row">
                        <div class="col-md-3"><strong>Parent Mobile</strong>*</div>
                        <div class="col-md-3">
                        <input type="text" id="parent_mobile" name="parent_mobile" readonly="" class="form-control" value="<?php echo $parent_mobile; ?>">
                        </div>
                    </div>

                       <div class="row">
                        <div class="col-md-3"><strong>Parent Email-id</strong>*</div>
                        <div class="col-md-3">
                        <input type="text" id="parent_email_id" name="parent_email_id" readonly="" class="form-control" value="<?php echo $parent_email_id; ?>">
                        </div>
                    </div>

                     <div class="row-btm">
                      <div class="col-md-6 control text-center">
                        <input id="save" type="submit" name="submit" value="Update" class="btn btn-success" />                        
                         <a class="btn btn-danger" >Cancel</a></div></div>
                
            </div>
        </div></div>
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
<div class="modal " id="contractForm" style="display:none;">
    <div class="modal-dialog modal-lg large-modal"> 
        <form id="contract_form" class="contract_form " method="post">   
            <div class="modal-content panel panel-warning">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Contract Form</h4>
                    <button type="button" class="close close_button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body panel-body">
                    <div class="col-md-12">
                    <p><span class="alertMsg"></span></p>
                    <div class="row">
                        <h5 class="grey_header">Contract For: <span class="student_name"></span> Activity<span class="activity"></span></h5>
                    </div>
                    <p><b>Student Details</b></p>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" id="student_name" name="student_name" class="form-control" value="<?php echo $student_name; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Student Passport</label>
                            <input type="text" id="student_passport_id" name="student_passport_id" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['student_passport_id']:''; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Student Emirates Id</label>
                            <input type="text" id="student_emirates_id" name="student_emirates_id" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['student_emirates_id']:''; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Student Emirates Id Expiry</label>
                            <input type="date" id="student_emirates_id_expiry" name="student_emirates_id_expiry" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['student_emirates_id_expiry']:''; ?>">
                            <span class="errorMsg"></span>
                        </div>
                    </div>
                    <hr>
                    <p><b>Parent Details</b></p>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Parent Name</label>
                            <input type="text" id="parent_name" name="parent_name" class="form-control" value="<?php echo $parent_name; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Parent Passport</label>
                            <input type="text" id="parent_passport_id" name="parent_passport_id" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['parent_passport_id']:''; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Parent Emirates Id</label>
                            <input type="text" id="parent_emirates_id" name="parent_emirates_id" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['parent_emirates_id']:''; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Parent Emirates Id Expiry</label>
                            <input type="date" id="parent_emirates_id_expiry" name="parent_emirates_id_expiry" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['parent_emirates_id_expiry']:''; ?>">
                            <span class="errorMsg"></span>
                        </div>
                    </div>
                    <hr>

                    <p><b>Contract Details</b></p>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Contract Amount</label>
                            <input type="text" id="contract_gross_amount" name="contract_gross_amount" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['contract_gross_amount']:''; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">VAT Percentage</label>
                            <input type="text" id="contract_vat_percentage" name="contract_vat_percentage" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['contract_vat_percentage']:''; ?>" readonly>
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">VAT Amount</label>
                            <input type="text" id="contract_vat_amount" name="contract_vat_amount" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['contract_vat_amount']:''; ?>" readonly>
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Total Amount</label>
                            <input type="text" id="contract_net_amount" name="contract_net_amount" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['contract_net_amount']:''; ?>" readonly>
                            <span class="errorMsg"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Year</label><br>
                            <input id="year" type="radio" value="1" name="year" <?php if(isset($contract_arr) && $contract_arr['year']=='1'){ echo 'checked';} ?> >
                            <label style="margin-left: 10px; margin-right: 10px">One</label>
                            <input id="year" type="radio" value="2" name="year" <?php if(isset($contract_arr) && $contract_arr['year']=='2'){ echo 'checked';} ?>>
                            <label style="margin-left: 10px; margin-right: 10px">Two</label>
                            <input id="year" type="radio" value="3" name="year" <?php if(isset($contract_arr) && $contract_arr['year']=='3'){ echo 'checked';} ?> >
                            <label style="margin-left: 10px; margin-right: 10px">Three</label>
                            <br><span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">From date</label>
                            <input type="date" id="contract_from_date" name="contract_from_date" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['contract_from_date']:''; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">To date</label>
                            <input type="date" id="contract_to_date" name="contract_to_date" class="form-control" value="<?php echo isset($contract_arr)?$contract_arr['contract_to_date']:''; ?>" readonly>
                            <span class="errorMsg"></span>
                        </div>
                    </div>
                    <hr>
                    <p><b>Payment Details</b></p>
                    <input type="hidden" name="balance_amount" class="balance_amount" value="<?php echo (isset($balance_amount) && isset($contract_arr))?$balance_amount:$contract_arr['contract_gross_amount']; ?>">
                    <?php if(isset($contractList)){ ?>
                    <div class="col-md-12">
                        <p><b>Payment History</b></p>
                        <table class="table table-bordered">
                            <thead>
                                <th>S.No</th>
                                <th>Payment type</th>
                                <th>Bank</th>
                                <th>Cheque Number</th>
                                <th>Cheque Date</th>
                                <th>Amount</th>
                            </thead>
                            <?php foreach ($contractList as $key => $value) {?>
                            <tr>
                                <td><?php echo $key+1;?></td>
                                <td><?php echo $value['payment_type'];?></td>
                                <td><?php echo $value['bank'];?></td>
                                <td><?php echo $value['cheque_number'];?></td>
                                <td><?php echo ($value['payment_type'] == 'Cheque')?$value['cheque_date']:'';?></td>
                                <td><?php echo $value['amount'];?></td>                                
                            </tr>
                        <?php } ?>
                        <tfoot>
                            <tr>
                                <th colspan="5" style="text-align: right;">Total Amount Paid</th>
                                <th><?php echo isset($paid_amount)?$paid_amount:'';?></th>
                            </tr>
                            <tr>
                                <th colspan="5" style="text-align: right;">Balance Amount</th>
                                <th><?php echo isset($balance_amount)?$balance_amount:'';?></th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label">Payment type</label>
                            <select name="payment[0][payment_type]" id="payment_type" class="form-control " onchange="payment_details(this.value)">
                                <option value="">Select</option>
                                <option value="Cash" <?php if($payment_type=='Cash'){ echo 'selected'; } ?>>Cash</option>
                                <option value="Card" <?php if($payment_type=='Card'){ echo 'selected'; } ?>>Card</option>
                                <option value="Online" <?php if($payment_type=='Online'){ echo 'selected'; } ?>>Online</option>
                                <option value="Cheque" <?php if($payment_type=='Cheque'){ echo 'selected'; } ?>>Cheque</option>
                            </select>
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-2 control bank_div" style="display:none;">
                          <label class="form-label">Bank</label>
                         <select name="payment[0][bank]" id="bank" class="form-control bank">
                            <option value="">Select</option>
                            <?php if(isset($bankdetails)){
                              foreach($bankdetails as $row){?>
                                <option value="<?php echo $row['bank_name'] ?>" <?php if($row['bank_name']==$bank ){ echo 'selected';} ?>><?php echo $row['bank_name']; ?></option><?php
                             } } ?></select>
                        </div>
                        <div class="cheque_div col-md-6" style="display:none;">
                            <div class="row">
                            <div class="col-md-4" >
                              <label class="form-label">Bank</label>
                             <select name="payment[0][cheque_bank]" id="cheque_bank" class="form-control cheque_bank">
                                <option value="">Select</option>
                                <?php if(isset($bankdetails)){
                                  foreach($bankdetails as $row){?>
                                    <option value="<?php echo $row['bank_name'] ?>" <?php if($row['bank_name']==$bank ){ echo 'selected';} ?>><?php echo $row['bank_name']; ?></option><?php
                                 } } ?></select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cheque Number</label>
                                <input type="text" id="cheque_number" name="payment[0][cheque_number]" class="form-control" value="<?php echo $cheque_number; ?>">
                                <span class="errorMsg"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cheque Date</label>
                                <input type="date" id="cheque_date" name="payment[0][cheque_date]" class="form-control" value="<?php echo $cheque_date; ?>">
                                <span class="errorMsg"></span>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Pay Date</label>
                            <input type="date" id="payable_date" name="payment[0][payable_date]" class="form-control" value="<?php echo $payable_date; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Pay Amount</label>
                            <input type="text" id="amount" name="payment[0][amount]" class="form-control pay_amount" value="<?php echo $amount; ?>">
                            <span class="errorMsg"></span>
                        </div>
                        
                      </div>

                    </div>
                
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">                            
                            <button type="button" class="btn rkmd-btn btn-success close_button" data-dismiss="modal">Submit</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      
   
    </div>
</div>

<script type="text/javascript">
    $('.discount_applicable').change(function(){
        $discount = $("input[name='discount_applicable']:checked").val();
        if($discount == 'Yes'){
            $('.discount_div').css('display','block');
        }else{
            $('.discount_div').css('display','none');
        }
    });
    $('#discount_type').change(function(){
        var discount_type = $('#discount_type').val();
        jQuery.ajax({
        type:'POST',
        url:baseurl+'Activity_approval/get_discount/'+discount_type,        
        dataType:'json',    
        success: function (data) {
            $('#discount_percentage').val(data);
        },
        });
    });
    $('.pay_amount').keyup(function(){
        var amount = $('.pay_amount').val();
        var balance = $('.balance_amount').val();
        if(parseFloat(balance) < parseFloat(amount)){
            $('#amount').parent().find(".errorMsg").html('Amount should not exceed '+balance);
            $('#amount').val('');
            $('#amount').focus();
        }
    });

    jQuery(document).on('keyup', '#contract_gross_amount', function(){
        var amount = jQuery(this).val();
        var vatpercent = jQuery('#contract_vat_percentage').val();
        var percentvalue = (amount*vatpercent /100);
        var netamount = parseFloat(amount) + parseFloat(percentvalue);
        jQuery('#contract_vat_amount').val(percentvalue);
        jQuery('#contract_net_amount').val(netamount);
        

    });
    $('#contract_from_date').change(function(){
        var startdate = $('#contract_from_date').val();
        var year = $("input[name='year']:checked").val();
        var newDate = moment(startdate).add(year, 'years').format('YYYY-MM-DD');
        $('#contract_to_date').val(newDate)
    });

    function payment_details(type){
        if(type == 'Cash'){
            $('.bank_div').css('display','none');
            $('.cheque_div').css('display','none');
        }else if(type == 'Cheque'){
            $('.bank_div').css('display','none');
            $('.cheque_div').css('display','block');
        }else{
            $('.bank_div').css('display','block');
            $('.cheque_div').css('display','none');
        }
    }
$(document).ready(function (e) {

 $("#approvalForm").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
    url: baseurl+'Activity_approval/submit',
   type: "POST",
   data:  new FormData(this),
   contentType: false,
    cache: false,
   processData:false,
   success: function(json){
    var firstId = '';
    $(".errorMsg").html('');
    $('.text-danger').remove();
          if (json['error']) {             
              for (i in json['error']) {
                if(firstId == ''){
                  firstId = i;
                }
                  //var element = $('.input-school-' + i.replace('_', '-'));
                  var element = $('#'+ i);
                  $(element).parent().find(".errorMsg").html(json['error'][i]);
              }
              $('#'+firstId).focus();
          } else {
              if(json['status'] == 'success'){
                jQuery('form#approvalForm').find('textarea, input, select').each(function () {
                    jQuery(this).val('');
                });
                window.location.href = baseurl+'Activity_approval';
          }
              
          }
      },
     error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }          
    });
 }));
});

function getContract(id){
     confirmDialog('Are you sure to proceed the contract form?', function(){
        jQuery.ajax({
            type:'POST',
            url:baseurl+'Activity_approval/getContractDetails/'+id,
            dataType:'json',    
            success: function (json) {
                var modal = $("#contractForm");
                modal.modal("show");
                $('.modal-backdrop').addClass('show');
                $('.modal-backdrop').addClass('in');
                for (i in json) {
                    $('#'+i).val(json[i]);

                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            },          
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
