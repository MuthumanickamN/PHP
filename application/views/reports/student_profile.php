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
            <?php if($role == 'admin' || $role == 'superadmin'):?>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>
                    <div class="media-body media-right text-right">
                        <ul class="list-inline mb-0">
                            <li>
                                <a href="<?php echo base_url();?>Students" class="float-right btn btn-primary btn-sm" style="margin: 4px;"><i class="fa fa-plus"></i> Add</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        <?php endif;?>
           
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
                                        
                                            <table id="studentListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Student ID</th>
                                                        <th scope="col">Student Name</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Parent Id</th>
                                                        <th scope="col">Parent Name</th>
                                                        <th scope="col">Mobile</th>
                                                        <th scope="col">Email ID</th>
                                                        <th scope="col">Registration fees</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Approval</th>
                                                        <th scope="col">View</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($studentList)){
                                                        //echo "<pre>"; print_r($studentList); die;
                                                        foreach ($studentList as $stud) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $stud['sid'];?></td>
                                                        <td><?php echo $stud['name'];?></td>
                                                        <td><?php echo $stud['role'];?></td>
                                                        <td><?php echo 'PSA00'.$stud['parent_user_id'];?></td>
                                                        <td><?php echo $stud['parent_name'];?></td>
                                                        <td><?php echo $stud['parent_mobile'];?></td>
                                                        <td><?php echo $stud['parent_email_id'];?></td>
                                                   <!--  <td><a data-toggle="modal" data-target=""><?php //echo $stud['fees_paid'];?></a></td> --> 

                                                      <td><?php if($stud['fees_paid']=='Due 0 month')
                                                      {
                                                        $tag ='danger';
                                                        $setval = 'Due 0 month ';
                                                    }else{
                                                        $tag ='success';
                                                        $setval = 'Paid above 1 month';
                                                    
                                                      }; 
                                                      
                                                      
                                                       ?>
                                                      <?php $fees_paid = $stud['fees_paid_key'];?>
                                                      
                                                      <a class='' onclick="changeregistration('<?php echo $stud['id'];?>','fees_paid','<?php echo $fees_paid;?>', '<?php echo $stud['fees_id'];?>' );"><?php echo $stud['fees_paid']; ?></a>
                                                      </td>  


                                                     <!--   <td> --><?php
                                                      /*  if($stud['fees_paid']){
                                                            $tag ='danger';
                                                            $setval = 'Due 0 month ';
                                                        }elseif($stud['fees_paid']){
                                                            $tag ='success';
                                                            $setval = 'Paid above 1 month';
                                                        }else{
                                                            $tag ='warning';
                                                            $setval = 'Paid below 1 month';
                                                        }; 
                                                       */ ?> 
                                                        
                                                        <td><?php if($stud['status'] == 'Active'){
                                                            $tag ='success';
                                                            $setval = 'Inactive';
                                                        }else{
                                                            $tag ='danger';
                                                            $setval = 'Active';
                                                        };?>
                                                            <a class='badge2 badge-<?php echo $tag;?>' onclick="changestatus('<?php echo $stud['id'];?>','status','<?php echo $setval;?>')"><?php echo $stud['status'];?></a>
                                                        </td>
                                                        <td><?php if($stud['approval_status'] == 'Approved'){
                                                            $approvaltag ='success';
                                                            $setvalue = 'Pending';
                                                        }else{
                                                            $approvaltag ='danger';
                                                            $setvalue = 'Approved';
                                                        };?>
                                                            <a class='badge2 badge-<?php echo $approvaltag;?>' onclick="changestatus('<?php echo $stud['id'];?>','approval_status','<?php echo $setvalue;?>')"><?php echo ucfirst($stud['approval_status']);?></a>
                                                        </td>
                                                        <td>
                                                            <a  href="<?php echo base_url('Students/edit/'.$stud['id']); ?>" title="Edit student details" class="edit-transaction ml-1 btn-ext-small btn btn-sm btn-warning"  data-schoolid="' + row[0] + '"><i class="fas fa-edit"></i></a>
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

<!-- Extend Validity  -->
<div class="extendvalidity">
<div class="modal" id="extendvaliditymodel" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Extend Validity</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-body" id="confirmMessage">
                <h4>Extend Registration Validity</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="extendOk">Yes, Extend Now</button>
                <button type="button" class="btn btn-danger" id="extendCancel">No</button>
            </div>
        </div>
    </div>
</div>
</div>
<!--<div class="extendvalidity">
<div class="modal" id="extendvaliditymodel" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Extend Validity</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-body" id="confirmMessage">
                <h4>Extend Registration Validity</h4></br>
                <div class="col-md-3 control text-left"><strong>Extend Validity</strong>*</div>
                <div class="col-md-5">
                <input type="date" id="extend" name="extend" class="form-control" >
                <span class="errorMsg"></span>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="extendOk">Yes, Extend Now</button>
                <button type="button" class="btn btn-danger" id="extendCancel">No</button>
            </div>
        </div>
    </div>
</div>
</div>-->
<!-- fees details -->
<div class="modal fade rotate" id="feesDetails" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <form id="voucher_reverse-form" method="post">   
            <div class="modal-content panel panel-success">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Registration Fees details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body panel-body">
                    <p><span class="alertMsg"></span></p>
                    <table class="table table-striped table-bordered" >
                        <tr>
                            <td><b>PSA ID</b></td>
                            <td><input type="hidden" name="hidden_student_id" id="hidden_student_id" value=""><p class="fees-student_id"></p></td>
                        </tr>
                        <tr>
                            <td><b>Name</b></td>
                            <td><p class="fees-name"></p></td>
                        </tr>
                        <tr>
                            <td><b>Date of Birth</b></td>
                            <td><p class="fees-dob"></p></td>
                        </tr>
                        <tr>
                            <td><b>Age</b></td>
                            <td><p class="fees-age"></p></td>
                        </tr>
                        <tr>
                            <td><b>Category</b></td>
                            <td><p class="fees-category"></p></td>
                        </tr>
                        <tr>
                            <td><b>Last paid on</b></td>
                            <td><p class="fees-last_paid"></p></td>
                        </tr>
                        <tr>
                            <td><b>Next Payable on</b></td>
                            <td><p class="fees-next_payable"></p></td>
                        </tr>
                        <div>
                        <button type="button" class="btn btn-success" id="payregistrationfees" >Pay Registration Fees</button>
                        <button type="button" class="btn btn-warning"  id="extendvalidity" class="extendvalidity" >Extend Validity</button>
                        </div> 
                       
                    </table>
                
                </div>
                
            </div>
        </form>      
   
    </div>
</div>

<!-- pay fees -->
<div class="modal fade rotate" id="payregistrationfeesModel" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <form id="voucher_reverse-form" method="post">   
            <div class="modal-content panel panel-success">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">REGISTRATION FEES </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body panel-body">
                    <p><span class="alertMsg"></span></p>
                    <table class="table table-striped table-bordered" >
                        <tr>
                            <td><b>Student ID</b></td>
                            <td><p class="student_id"></p></td>
                        </tr>
                        <tr>
                            <td><b>Student Name</b></td>
                            <td><p class="student_name"></p></td>
                        </tr>
                        <tr>
                            <td><b>Parent ID</b></td>
                            <td><p class="parent_id"></p></td>
                        </tr>
                        <tr>
                            <td><b>parent Name</b></td>
                            <td><p class="parent_name"></p></td>
                        </tr>
                        <tr>
                            <td><b>Mobile No</b></td>
                            <td><p class="mobile_no"></p></td>
                        </tr>
                    
                        <tr>
                            <td><b>Student Category</b></td>
                            <td><p class="student_category"></p></td>
                        </tr>
                        <tr>
                            <td><b>Registration Fees Amount</b></td>
                            <td><p class="registration_fees"></p></td>
                        </tr>
                        <tr>
                            <td><b>Mode</b></td>
                            <td><p class="mode"></p></td>
                        </tr>
                        <tr>
                            <td><b>Wallet Balance</b></td>
                            <td><p class="wallet_balance"></p></td>
                        </tr>
                        <tr>
                            <td><b>VAT</b></td>
                            <td><p class="vat"></p></td>
                        </tr>
                        <tr>
                            <td><b>VAT Amount</b></td>
                            <td><p class="vat_amount"></p></td>
                        </tr>
                        <tr>
                            <td><b>Payable Amount(Inclusive of 5.0% VAT)</b></td>
                            <td><p class="payable_amount"></p></td>
                        </tr>
                        <div>
                        <button type="button" class="btn btn-success" id="paynow">Pay Now</button>
                        <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
                        </div> 
                       
                    </table>
                
                </div>
                
            </div>
        </form>      
   
    </div>
</div>
<?php
$this->load->view('users/popup/display');
$this->load->view('users/popup/edit');
$this->load->view('users/popup/add');
$this->load->view('users/popup/delete');
$this->load->view('templates/footer');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>

<script type="text/javascript">

jQuery(document).ready(function() {
    var t = jQuery('#studentListing').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            /*{ extend: 'print', 
            orientation: 'landscape',
            footer: true, 
            messageTop: 'Student Profile Report ', 
            title: 'Student Profile Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10 ]
                },
            },*/
            { extend: 'pdf',
            className: 'btn btn-secondary', 
            orientation: 'landscape',
            footer: true, 
            messageTop: 'Student Profile Report ', 
            title: 'Student Profile Report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10 ]
                },
            },
            { extend: 'excel',
            className: 'btn btn-secondary',  
            footer: true, 
            messageTop: 'Student Profile Report ', 
            title: 'Student Profile Report', 
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

    $('#payregistrationfees').click(function(){
        var student_id = $('#hidden_student_id').val();
        $("#feesDetails .close").click()
        var modal = $("#payregistrationfeesModel");
        jQuery.ajax({
            type:'POST',
            url:baseurl+'Reports/getDialog2/',
            data:{id:student_id},
            dataType:'json',    
            success: function (result) {
            //  var obj = JSON.parse(result);
            var obj = result;
            
            $('.student_id').html(obj.sid);
            $('.student_name').html(obj.name);
            $('.parent_id').html(obj.code);
            $('.parent_name').html(obj.parent_name);
            $('.mobile_no').html(obj.parent_mobile);
            $('.student_category').html(obj.reg_fee_category);
            $('.registration_fees').html(obj.reg_fee);
            $('.mode').html('Wallet');
            $('.wallet_balance').html(obj.balance_credits);
            $('.vat').html(obj.vat_perc);
            var vat_amount = (parseFloat(obj.reg_fee)*parseFloat(obj.vat_perc)/100);
            var net_amount = parseFloat(obj.reg_fee)+parseFloat(vat_amount);
            $('.vat_amount').html(vat_amount.toFixed(2)); 
            $('.payable_amount').html(net_amount.toFixed(2));    

               
                modal.modal("show");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.fees_paidText + "\r\n" + xhr.responseText);
            }          
        });
        
    });



    $('#extendvalidity').click(function(){
       // var student_id = $('#hidden_student_id').val();
        $("#feesDetails .close").click()
        var student_id = $('#hidden_student_id').val();
        //var modal = $("#extendvaliditymodel");
        //alert(1);
        $('#extendvaliditymodel').modal('show');
      
        
    }); 

    $('#extendOk22').click(function(){
        $("#extendvaliditymodel .close").click()
        var student_id = $('#hidden_student_id').val();
        
        swal({
            icon: 'success',
            title: 'Extend Validity',
            text: "Registration Validity Extended for 1 year Successfully!",
            
        })   
        console.log('test'); 
    });
    $('#extendOk').click(function(){
        $("#extendvaliditymodel .close").click()
        var student_id = $('#hidden_student_id').val();
       // $("#extend").datepicker();
      // $("#extend").datepicker( 'getDate' );
      //var extend = $('#extend').val();
       //console.log(student_id);
       //console.log(extend);
            jQuery.ajax({
            type:'POST',
            url:baseurl+'Registration_fees/extendvalidity',
            data:{id:student_id,extend:''},
            dataType:'html', 
            success: function(output) {
                if(output)
                {
                  swal('Registration Validity Extended Successfully!');
                  window.location.reload();
                }
          }       
        });
            
            
    });

    $('#cancel').click(function(){
        var student_id = $('#hidden_student_id').val();
        $("#payregistrationfeesModel .close").click()
    
    }); 

    $('#paynow').click(function(){
        var student_id = $('#hidden_student_id').val();
        //$("#payregistrationfeesModel .close").click();
        //var modal = $("#payregistrationfeesModel");
        //alert('Payment completed Successfully!');   
        jQuery.ajax({
            type:'POST',
            url:baseurl+'Registration_fees/payRegistration',
            data:{id:student_id},
            dataType:'html', 
            success: function(output) {
                if(!output)
                {
                  swal('Insufficient Balance','Please recharge your wallet and proceed for slot booking','warning');
                }
                else
                {
                    $("#payregistrationfeesModel .close").click();
                    var modal = $("#payregistrationfeesModel");
                    swal('Payment completed Successfully!', 'success');   
                }
          }       
        });
    });

} );

function changestatus(id,field,value){
    confirmDialog('Are you sure to change the status?', function(){
        jQuery.ajax({
            type:'POST',
            url:baseurl+'index.php/students/changestatus/'+id+'/'+field+'/'+value,
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

function changeregistration(id,field,value, fees_id)
{    
    $('#extendvalidity').css('display', 'none');
    var modal = $("#feesDetails");
    if(value.indexOf('Paid') != -1){
        $('#payregistrationfees').css('display', 'none');
        $('#extendvalidity').css('display', 'none');
    }
    else
    {
        $('#payregistrationfees').css('display', 'inline-block');
        if(fees_id)
        {
            $('#extendvalidity').css('display', 'inline-block');
        }
    }
    jQuery.ajax({
        type:'POST',
        url:baseurl+'Reports/getDialog1/',
        data:{id:id},
        dataType:'json',    
        success: function (result) {
          //  var obj = JSON.parse(result);
          var obj = result;
          $('#hidden_student_id').val(id);
            $('.fees-student_id').html(obj.sid);
            $('.fees-name').html(obj.name);
            $('.fees-dob').html(obj.dob);
            $('.fees-age').html(obj.age);
            $('.fees-category').html(obj.reg_fee_category);
            $('.fees-category').html(obj.reg_fee_category);

            modal.modal("show");
            $('.modal-backdrop').addClass('show');
            $('.modal-backdrop').addClass('in');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.fees_paidText + "\r\n" + xhr.responseText);
        }          
    });
    
}


function confirmDialog1(){

    
    

    //$("#payregistrationfees").unbind().one('click', onConfirm).one('click', "#payregistrationfees");
    //$("#extendvalidity").unbind().one("click", "#extendvalidity");
}

function confirmDialog2(onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#feesDetails");
    modal.modal("show");
    $('.modal-backdrop').addClass('show');
    $('.modal-backdrop').addClass('in');
    //$("#payregistrationfees").empty().append(message);
    $("#extendOk").unbind().one('click', onConfirm).one('click', fClose);
    $("#extendCancel").unbind().one("click", fclose);
}



</script>
