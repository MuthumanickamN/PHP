<?php $this->load->view('includes/header3'); ?>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
    <!--<div class="content-header row">
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
       
    </div>-->
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
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="mainbox col-sm-12">
                                    <div class="panel panel-info">
                                        <!--<form action ="<?php echo base_url() . 'student_profile_slot_booking/viewbooking' ?>" id="searchForm" method="POST">
                                        <div class="row" style="margin-bottom: 20px">
                                            
                                            
                                            <div class="col-lg-3">
                                                <b>From date</b>
                                                <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                                            </div>
                                            <div class="col-lg-3">
                                                <b>To date</b>
                                                <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
                                            </div>
                                            <input type="hidden" name="activity_id" id="activity_id" value="<?php echo $activity_id;?>">
                                            <input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>">
                                           
                                            <div class="col-lg-2">
                                                <button class="btn btn-success margin-top-20">Search</button>
                                            </div>
                                        </div>
                                          </form>-->
                                        <table id="bookingListing" class="table table-bordered table-hover small">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center" scope="col">#</th>
                                                    <th style="text-align: center" scope="col">Booking ID</th>
                                                    <th style="text-align: center" scope="col">Date</th>
                                                    <th  style="text-align: center" scope="col">Student name</th>
                                                    <!--<th  style="text-align: center" scope="col">Registration ID</th>
                                                    <th  style="text-align: center" scope="col">PSA ID</th>-->
                                                    <th  style="text-align: center" scope="col">Activity</th>
                                                    <th  style="text-align: center" scope="col">Location</th>
                                                    <th  style="text-align: center" scope="col">Level</th>
                                                    <th  style="text-align: center" scope="col">From time</th>
                                                    <th  style="text-align: center" scope="col">To time</th>
                                                    <!--<th  style="text-align: center" scope="col">Lane/ Court</th>-->
                                                    <th  style="text-align: center" scope="col">Coach</th>
                                                    <th  style="text-align: center" scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($bookingList)){
                                                    foreach ($bookingList as $book) { ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo $book['ticket_no'];?></td>
                                        <td style="text-align: center"><span style="display:none"><?php echo strtotime($book['checkout_date']);?></span><?php echo date("d/m/Y", strtotime($book['checkout_date']));  ?></td>
                                        <td style="text-align: center" ><?php echo $book['name'];?></td>
                                                   
                                                    <td style="text-align: center" ><?php echo $book['activity_id'];?></td>
                                                    <td style="text-align: center" ><?php echo $book['location_id'];?></td>
                                                    <td style="text-align: center" ><?php echo $book['level_id'];?></td>
                                                    <td style="text-align: center" ><?php echo $book['from_time'];?></td>
                                                    <td style="text-align: center" ><?php echo $book['to_time'];?></td>
                                                   <!-- <td style="text-align: center" ><?php echo $book['lane_court_id'];?></td>-->
                                                    <td style="text-align: center" ><?php echo $book['coach_id'];?></td>
                                       
                                        <td style="text-align: center" > 
                                            <?php if($book['refund_requested'] == 0) {?>            
                                            <a id="myBtn" class="btn btn-success fa fa-exchange"  href="<?php echo base_url('Student_profile_slot_booking/book/'.$activity_id.'/'.$activity_selection_id.'/'.$book['slot_id']); ?>"> Swap</a>  
                                           
                                            &nbsp; 
                                            <button data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#refundModal" data-val="<?php echo $book['slot_id'];?>" id="" class="btn btn-danger fa fa-money refund_btn"  title="Request Refund"> Refund</button>
                                            <?php } else {
                                            if($book['is_refunded'] == 1) {
                                            ?>
                                            <button data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#refundModal" data-val="<?php echo $book['slot_id'];?>" id="" class="btn btn-success fa fa-money refund_btn"  title="Request Refund" disabled> Refunded</button>
                                            
                                            <?php }else{
                                            
                                            if($book['refund_approval_status'] == "Rejected") {
                                            ?>
                                            <button data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#refundModal" data-val="<?php echo $book['slot_id'];?>" id="" class="btn btn-danger fa fa-money refund_btn"  title="Request Refund" disabled> Refund Rejected</button>
                                            
                                            <?php } else { ?>
                                            <button data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#refundModal" data-val="<?php echo $book['slot_id'];?>" id="" class="btn btn-info fa fa-money refund_btn"  title="Request Refund" disabled> Refund Requested</button>
                                            
                                            <?php } } }?>
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

<div class="modal fade rotate" id="refundModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Request Refund</h4>
                    <button type="button" class="close" onclick="clearForm()" data-dismiss="modal">&times;</button>
                </div>
              <form id="requestRefund" name="requestRefund" method="POST" enctype='multipart/form-data' action ="<?php echo base_url() . 'student_profile_slot_booking/request_refund'; ?>">
              <input type="hidden" name="slot_id" id="slot_id" value="<?php echo $book['slot_id'];?>">
              <input type="hidden" name="activity_id" id="activity_id" value="<?php echo $activity_id;?>">
              <input type="hidden" name="activity_selection_id" id="activity_selection_id" value="<?php echo $activity_selection_id;?>">
              <div class="modal-body" id="confirmMessage">     
              <div class="checkAlert" style="width:100%;"></div>  
              
                <div class="row margin-top-20" >
                  <div class="col-md-3 control text-left"><strong>Reason</strong>*</div>
                  <div class="col-md-9 control text-left">     
                     <textarea id="reason" name="reason" class="form-control reason" required></textarea>
                     <span class="reasonErrorMsg errorMsg"></span>
                  </div>
                </div>
                
                <div class="row" >
                  <div class="col-md-3 control text-left"><strong>Document</strong>*</div>
                  <div class="col-md-9 control text-left">     
                     <input type="file" id="file" name="file" class="form-control file" required>
                     
                     <span class="fileErrorMsg errorMsg"></span>
                  </div>
                </div><br>
                <div class="row">
				<div class="col-md-12">
				<p>"Refund for any reason not possible as per agreed terms and conditions" Its solely management decision to approve and reject request.</p>
				</div>
				</div>
              
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Submit</button>
                  <button type="button" class="btn btn-danger" onclick="clearForm()"  data-dismiss="modal">Cancel</button>
              </div>
          </form>
        </div>
    </div>
</div>


<script type="text/javascript">


jQuery(document).ready(function() {
    var fromdateval = jQuery('#from_date').val();
    var todateval = jQuery('#to_date').val();
    var t = jQuery('#bookingListing').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', 
            footer: true, 
            messageTop: 'Slot Schedule report for '+fromdateval+' - '+todateval, 
            title: 'Slot Schedule report', 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9,10,11,12 ]
                },
            }
        ],
        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
    } );
    
   $('.refund_btn').on('click', function(){
        var val_ = $(this).attr('data-val');
        //alert(val_);
        $('#slot_id').val(val_);
    }); /**/
    
   
} );
function clearForm()
{
    $('#requestRefund').trigger("reset");
}

</script>
