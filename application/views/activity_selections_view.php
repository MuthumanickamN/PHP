<?php 

 $this->load->view('includes/header3'); 

 ?>
 
 <script>
  var back_url = "<?php echo $back_url;?>";

 </script>
 <script type="text/javascript">
    var vat_perc = "<?php echo $vat_perc;?>"; 
    var contract_fee = "<?php echo $contract_fee;?>"; 
    $(function () {
		
    /*$('.payable_date').datepicker({
        format: "dd/mm/yyyy", 
    	autoclose: true,
    	todayHighlight: true,
    	//startDate: '-0d',
    	//endDate: '+0d'
	 });	
		
            //Date picker
    $('#contract_from').datepicker({
        format: "dd/mm/yyyy", 
    	autoclose: true,
    	todayHighlight: true,
    	//startDate: '-0d',
    	//endDate: '+0d'
    	 }).on('changeDate', function(ev) {
    	 }).on('hide', function(event) {
    	event.preventDefault();
    	event.stopPropagation();
    	}).on('changeDate', function(e){
    	    event.preventDefault();
    	    var year_c = $("#addContractForm input[type='radio']:checked").val(); 
    	    
    	    var from = $('#contract_from').val(); 
    	    
    	   if(from)
    	    {
    	        var d = $("[id*=contract_from]").datepicker("getDate");
             
                  var year = d.getFullYear();
                  
                  var month = d.getMonth();
                  var day = d.getDate();
                  var c = new Date(year + parseInt(year_c), month, day);
                  var curr_date = c.getDate();
                  var curr_month = c.getMonth();
                  curr_month++;
                  var curr_year = c.getFullYear();
                  
                  if (curr_date.toString().length !=2)
                  {
                      curr_date = '0'+curr_date;
                  }
                  var c2 = curr_date + "/" + curr_month + "/" + curr_year;
                  
                  $('#contract_to').val(c2); 
    	    }
    	    
    	});	
    	*/
    
    $(document).on("change","#contract_from",function(){
      var year_c = $("#addContractForm input[type='radio']:checked").val(); 
    	    
	    var from = $('#contract_from').val(); 
	    
	   if(from)
	    {
	        var input = $("[id*=contract_from]").val();
            var str= input.split('-');
            console.log(str);
            var d = new Date(str[0], str[1]-1, str[2]); 
              var year = d.getFullYear();
              
              var month = d.getMonth();
              var day = d.getDate();
              var c = new Date(year + parseInt(year_c), month, day);
              c.setDate(c.getDate() -1 );
              console.log(c)
              var curr_date = c.getDate();
              var curr_month = c.getMonth();
              curr_month++;
              var curr_year = c.getFullYear();
              
              if (curr_date.toString().length !=2)
              {
                  curr_date = '0'+curr_date;
              }
              var curr_date = ("0" + curr_date).slice(-2);
              var curr_month = ("0" + (curr_month)).slice(-2);
              var c2 = curr_year + "-" + curr_month + "-" + curr_date;
              console.log(c2);
              $('#contract_to').val(c2); 
	    }
     
    });
   
    });
</script>
<style>
.modal {
  overflow-y:auto;
}
</style>
 
 <html>
 <head>
  <title>Student Registration </title>
</head>

<body>

<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 300px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>

<div id="dialog2" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 300px;" class="row">
            <span id="lblText2" style="color: Green; top: 50px;"></span> </div>
 <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
           <!-- <h3 class="content-header-title" style="color: green">Activity Selection</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Academy Activities</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Activity Selection</a>
                  </li>
                 
                </ol>
              </div>
            </div>-->
          </div>
         <!--<div class="content-header-right col-md-6 col-12">
            <div class="media width-250 float-right">
              <media-left class="media-middle">
                <div id="sp-bar-total-sales"></div>
              </media-left>
              <div class="media-body media-right text-right">
                 <ul class="list-inline mb-0">
            <li><a href="<?php echo site_url('Students/list_'); ?>" class="btn btn-primary"   ><b>Back</b></a></li>
          </ul>
                
              </div>
            </div>
          </div>-->
        </div>
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Activity Selection</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                    <!--<p> (Please fill all mandatory fields marked with * and complete your registration)</p> -->
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="submitForm" class="form-horizontal" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px" autocomplete="off">
            <input type="hidden" name="id" id="id" value="<?php if(isset($id)){echo $id;}?>">
            <input type="hidden" name="from" id="from" value="<?php if(isset($from)){echo $from;}?>">
            
          
                        
                        <div class="row">
                          <div class="col-md-3">
                            <label><strong>Student Name*</strong></label>
                          </div>
                        <div class="col-md-3">
                           <input type="text" id="student_name" name="student_name"  oninput="" class="form-control" value="<?php if(isset($student_name)) { echo $student_name; } ?>" readonly>
                          <span class="errorMsg"></span>
                        </div>
                      </div>
                      
                      
                      <div class="row">
                          <div class="col-md-3">
                            <label><strong>Activity</strong></label>
                          </div>
                        <div class="col-md-3">
                          <input type="text" id="activity" name="activity"  oninput="" class="form-control" value="<?php if(isset($game)) { echo $game; } ?>" readonly>
                          <span class="errorMsg"></span>
                        </div>
                      </div>
                      <?php 
                      $no_of_classes = '';
                      ?>
                      <div class="row">  
                      <div class="col-md-3 control text-left"><strong>Level</strong>
                      </div>
                      <div class="col-md-3">
                        <select name="level_id" id="level_id" class="form-control select2 level_id"  >
                          <option value="" data-slots="">Select</option>
                          <?php foreach ($levels as $key => $level) { ?>
                          <option value="<?php echo $level['games_level_id'] ?>" <?php if($level['games_level_id']==$level_id ){ $no_of_classes =  $level['session']; echo 'selected';} ?> data-slots="<?php echo $level['session']?>"><?php echo $level['level'] ?></option>
                          <?php }  ?>
                          </select>
                          <span class="errorMsg"></span>
                      </div>
                      </div>
                      
                      
                      <div class="row">
                          <div class="col-md-3">
                            <label><strong>No. of Classes</strong></label>
                          </div>
                        <div class="col-md-3">
                          <input type="text" id="no_of_classes" name="no_of_classes"  class="form-control" value="<?php if(isset($no_of_classes)) { echo $no_of_classes; } ?>" readonly>
                          <span class="errorMsg"></span>
                        </div>
                      </div>
                      
                                          
                      <div class="row">
                        <div class="col-md-3">
                        <label><strong>Contract </strong></label>
                        </div>
                        <div class="col-md-3">
                          <input id="contract" type="radio" value="Yes" name="contract" <?php if(isset($contract) && $contract=="Yes"){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Yes</label>
                          
                          <input id="contract" type="radio" value="No" name="contract" <?php if(isset($contract) && $contract=="No"){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">No</label>    
                          
                          <span class="errorMsg"></span>
                        </div>

                        <div class="contract" style="<?php if(isset($contract) && ($contract=="Yes" || $contract=="yes" )){ echo 'display:block;';}else{ echo 'display:none;'; } ?>">
                        <div class="col-md-3 contract_form" style="display:block;">
                          <button type="button" id="contractBtn" class="btn btn-primary" onClick="$('#contractModal').show();">Add Contract Details</button>
                        </div>
                      </div>
                          </div>   
                      
                      
                      
                      <div class="row">  
                      <div class="col-md-3 control text-left"><strong>Head Coach</strong>
                      </div>
                      <div class="col-md-3">
                        <select name="head_coach_id" id="head_coach_id" class="form-control select2 head_coach_id"  >
                          <option value="">Select</option>
                          <?php foreach ($head_coaches as $key => $coach) { ?>
                          <option value="<?php echo $coach['coach_id'] ?>" <?php if($coach['coach_id']==$head_coach_id ){ echo 'selected';} ?>><?php echo $coach['coach_name'] ?></option>
                          <?php }  ?>
                          </select>
                          <span class="errorMsg"></span>
                      </div>
                      </div>
                      
                      <div class="row">
                      <div class="col-md-3 control text-left"><strong>Status</strong>
                      </div> <div class="col-md-3">
                       <select name="status" id="status" class="form-control" >
                          <option value="">Select</option>
                          <option value="Active" <?php if(isset($status) && $status=='Active' ){ echo 'selected';} ?>>Active</option>
                          <option value="Inactive" <?php if(isset($status) && $status=='Inactive' ){ echo 'selected';} ?>>Inactive</option>
                          </select>
                          <span class="errorMsg"></span>
                      </div>
                    </div>
                      
                    <div class="row">
                        <div class="col-md-3">
                        <label><strong>Discount Applicable </strong></label>
                        </div>
                        <div class="col-md-3">
                          <input id="discount_applicable" type="radio" value="Yes" name="discount_applicable" <?php if(isset($discount_applicable) && ($discount_applicable=="Yes" || $discount_applicable=="yes" )){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">Yes</label>
                          
                          <input id="discount_applicable" type="radio" value="No" name="discount_applicable" <?php if(isset($discount_applicable) && ($discount_applicable=="No"  || $discount_applicable=="no" )){ echo 'checked';} ?> />
                          <label style="margin-left: 10px; margin-right: 10px">No</label>    
                          
                          <span class="errorMsg"></span>
                        </div>
                      </div>   
                      
                      <div class="discount_details" style="<?php if(isset($discount_applicable) && ($discount_applicable=="Yes" || $discount_applicable=="yes" )){ echo 'display:block;';}else{ echo 'display:none;'; } ?>">
                          
                      <div class="row">
                        <div class="col-md-3">
                        <label><strong>Discount Type </strong></label>
                        </div>
                        <div class="col-md-3">
                        <select name="discount_type" id="discount_type" class="form-control select2" style="width:100px;" >
                          <option value="0" perc="0.00">Select</option>
                          <?php foreach ($discount_list as $keyd => $discount) { ?>
                          <option value="<?php echo $discount['id'] ?>" perc="<?php echo $discount['discount_percentage'];?>"  <?php if($discount['id']==$discount_type ){ echo 'selected';} ?>><?php echo $discount['discount_name']; ?></option>
                          <?php }  ?>
                          </select>
                          <span class="errorMsg"></span>
                      </div>
                      </div>   
                      
                      <div class="row">
                        <div class="col-md-3">
                        <label><strong>Discount % </strong></label>
                        </div>
                        <div class="col-md-3">
                        <input type="text" id="discount_percentage" name="discount_percentage"  oninput="" class="form-control" value="<?php if(isset($discount_percentage)) { echo $discount_percentage; }else{echo '0.00';} ?>" readonly>
                          <span class="errorMsg"></span>
                      </div>
                      </div>   
                      
                  </div>   
                      
                      <div class="row">
                      <div class="col-md-3 control text-left"><strong>Approval Status</strong>
                      </div> <div class="col-md-3">
                       <select name="approval_status" id="approval_status" class="form-control" >
                          <option value="">Select</option>
                          <option value="Pending" <?php if(isset($approval_status) && $approval_status=='Pending' ){ echo 'selected';} ?>>Pending</option>
                          <option value="Approved" <?php if(isset($approval_status) && $approval_status=='Approved' ){ echo 'selected';} ?>>Approved</option>
                          <option value="Rejected" <?php if(isset($approval_status) && $approval_status=='Rejected' ){ echo 'selected';} ?>>Rejected</option>
                          </select>
                          <span class="errorMsg"></span>
                      </div>
                    </div>
                      
                    <div class="row">
                          <div class="col-md-3">
                            <label><strong>Parent ID</strong></label>
                          </div>
                        <div class="col-md-3">
                           <input type="text" id="parent_code" name="parent_code"  oninput="" class="form-control" value="<?php if(isset($parent_code)) { echo $parent_code; } ?>" readonly>
                          <span class="errorMsg"></span>
                        </div>
                      </div>
                      
                    <div class="row">
                          <div class="col-md-3">
                            <label><strong>Parent Name</strong></label>
                          </div>
                        <div class="col-md-3">
                           <input type="text" id="parent_name" name="parent_name"  oninput="" class="form-control" value="<?php if(isset($parent_name)) { echo $parent_name; } ?>" readonly>
                          <span class="errorMsg"></span>
                        </div>
                      </div>
                      
                  <div class="row">
                          <div class="col-md-3">
                            <label><strong>Parent Mobile</strong></label>
                          </div>
                        <div class="col-md-3">
                           <input type="text" id="parent_mobile" name="parent_mobile"  oninput="" class="form-control" value="<?php if(isset($parent_mobile)) { echo $parent_mobile; } ?>" readonly>
                          <span class="errorMsg"></span>
                        </div>
                      </div>
                      
                  <div class="row">
                          <div class="col-md-3">
                            <label><strong>Parent Email-ID</strong></label>
                          </div>
                        <div class="col-md-3">
                           <input type="text" id="parent_email_id" name="parent_email_id"  oninput="" class="form-control" value="<?php if(isset($parent_email_id)) { echo $parent_email_id; } ?>" readonly>
                          <span class="errorMsg"></span>
                        </div>
                      </div>
                      
                      
                      
                  <br/>
                     <div class="row">
                      <div class="col-md-12 control text-center">
                        <?php if(isset($id) && $id!="") { ?>
                        <button type="submit" name="submit" class="btn btn-warning" >Update</button>   
                        <?php } else { ?>
                          <button type="submit" id="save" class="btn btn-success" ><b> Submit</b></button>
                          <?php } ?> 
                         <a href="<?php echo base_url().'Students/edit/'.$back_url; ?>"     class="btn btn-danger" >Cancel</a>
                       </div>
                     </div>
                    
                </form>
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

<!-- Trigger/Open The Modal -->
<div id="contractModal" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" style="width: 100%;display: none;">
  <div class="modal-dialog" style="width: 100%;
    float: none;
    margin: 0 auto;
    max-width: 38%;
 
   left:0%">
    <div class="modal-content">
      <div class="modal-body" style="width: 100%;">
      <div class="alert alert-info">
        <!-- <a href="#" class="close" data-dismiss="modal" aria-label="close">X</a> -->
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;opacity:0.6" onClick="$('#contractModal').hide();">&times;<span class="close-x">Close</button> Add Contract Details for
        <strong> <?php echo $student_name;?> - <?php echo $game;?></strong>
      </div>
      <div class="">
        <form id="addContractForm" class="form-horizontal"  name="addContractForm" method="POST" autocomplete="off">
          <input type="hidden" name="activity_selection_id" id="activity_selection_id" value="<?php if(isset($activity_selection_id)){echo $activity_selection_id;}?>">
          <input type="hidden" name="sid" class="sid" value="<?php echo $id; ?>">
          <input type="hidden" name="activity_id" class="activity_id" value="<?php echo $activity_id; ?>">
          <input type="hidden" name="student_id" class="student_id" value="<?php echo $student_id; ?>">
          <input type="hidden" name="parent_id" class="parent_id" value="<?php echo $parent_id; ?>">
          <div class="row">

                <div class="col-3">
                <span class="col-12">
                <label for="contract_student_name " style="display:block"> <strong> Student Name </strong> </label>
                <input type="text" name="contract_student_name" id="contract_student_name" class=" form-control" placeholder="Student Name" value="<?php echo $student_name;?>" required="">
                </span>
                </div>
                <div class="col-3">
                <span class="col-12">
                <label for="contract_student_passport_id" style="display:block"> <strong> Student Passport id </strong> </label>
                <input type="text" name="contract_student_passport_id" class=" form-control" id="contract_student_passport_id" placeholder="student Passport id" value="<?php echo $student_passport;?>" required="">
                </span>
                </div>
                <div class="col-3">
                <span class="col-12">
                <label for="contract_student_emirates_id " style="display:block"> <strong> Student Emirates id </strong> </label>
                <input type="text" name="contract_student_emirates_id" class=" form-control" id="contract_student_emirates_id" placeholder="Student Emirates id" value="<?php echo $student_emirate_id;?>" required="">
                </span>
                </div>
                <div class="col-3">
                <span class="col-12">
                <label for="contract_student_emirates_id_expiry "  style="display:block"> <strong> Student Emirates id Expiry </strong> </label>
                <input type="date" name="contract_student_emirates_id_expiry" class=" form-control"  id="contract_student_emirates_id_expiry" placeholder="Student Emirates id Expiry" value="<?php echo $student_emirates_expiry;?>" required="">
                </span><br><br>
                </div>
               </div>
               <div class="row">
                   <div class="col-3">
                <span class="col-12">
                <label for="contract_parent_name"  style="display:block"> <strong> Parent Name </strong> </label>
                <input type="text" name="contract_parent_name" class=" form-control " id="contract_parent_name" placeholder="Parent Name" value="<?php echo $parent_name;?>" required="">
                </span>
                </div>
                <div class="col-3">
                <span class="col-12">
                <label for="contract_parent_passport_id"  style="display:block"> <strong> Parent Passport id </strong> </label>
                <input type="text" name="contract_parent_passport_id" class=" form-control" id="contract_parent_passport_id" placeholder="Parent Passport id" value="<?php echo $parent_passport;?>" required="">
                </span>
                </div>
                <div class="col-3">
                <span class="col-12">
                <label for="contract_parent_emirates_id " style="display:block"> <strong> Parent Emirates id</strong> </label>
                <input type="text" name="contract_parent_emirates_id" class=" form-control" id="contract_parent_emirates_id" placeholder="Parent Emirates id" value="<?php echo $parent_emirate_id;?>" required="">
                </span>
                </div>
                <div class="col-3">
                <span class="col-12">
                <label for="contract_parent_emirates_id_expiry" style="display:block"> <strong> Parent Emirates id Expiry </strong> </label>
                <input type="date" name="contract_parent_emirates_id_expiry" class=" form-control" id="contract_parent_emirates_id_expiry" placeholder="Parent Emirates id Expiry" value="<?php echo $parent_emirates_expiry;?>" required="" >
                </span>
                </div>
                </div>

          
          <div class="row">
              <div class="col-md-3">
                <label><strong>Contract From *</strong></label>
              </div>
            <div class="col-md-2"> 
               <!-- <input type="date" id="contract_from" name="contract_from"  class="form-control"  value="">-->
               
                	  <input type="date" id="contract_from" name="contract_from" class="form-control" value="" required>
                
                
               
              <span class="errorMsg"></span>
              
            </div>
          </div>
		  
		            <div class="row">
              <div class="col-md-3">
                <label><strong>Contract Year</strong></label>
              </div>
            <div class="col-md-6"> 

              <input id="contract_year" type="radio" value="1"name="contract_year" >
              <label style="margin-left: 10px; margin-right: 10px">One</label>
              <input id="contract_year" type="radio" value="2" name="contract_year" >
              <label style="margin-left: 10px; margin-right: 10px">Two</label>
              <input id="contract_year" type="radio" value="3" name="contract_year" >
              <label style="margin-left: 10px; margin-right: 10px">Three</label>
              <span class="errorMsg"></span>
              
            </div>
          </div>
          
          <div class="row">
              <div class="col-md-3">
                <label><strong>Contract To *</strong></label>
              </div>
            <div class="col-md-2"> 
               <!-- <input type="date" id="contract_from" name="contract_from"  class="form-control"  value="">-->
                <input type="date" id="contract_to" name="contract_to" class="form-control" value="" required>
                
                
               
              <span class="errorMsg"></span>
              
            </div>
          </div>
          
          <div class="row">
              <div class="col-md-3">
                <label><strong>Contract Amount</strong></label>
              </div>
            <div class="col-md-2"> 
                <input type="text" id="contract_amount" name="contract_amount"  class="form-control"  value="<?php echo $contract_fee; ?>" readonly>
               
               <input type="hidden" id="hid_contract_amount" name="hid_contract_amount"  class="form-control"  value="<?php echo $contract_fee; ?>" readonly>
               
               
              <span class="errorMsg"></span>
              
            </div>
          </div>
          
          <div class="row">
              <div class="col-md-3">
                <label><strong>VAT Amount</strong></label>
              </div>
            <div class="col-md-2"> 
                <input type="text" id="vat_amount" name="vat_amount"  class="form-control"  value="<?php echo $vat_val; ?>" readonly>
                <input type="hidden" id="hid_vat_amount" name="hid_vat_amount"  class="form-control"  value="<?php echo $vat_val; ?>" readonly>
               
              <span class="errorMsg"></span>
              
            </div>
          </div>
          
          <div class="row">
              <div class="col-md-3">
                <label><strong>Total Amount</strong></label>
              </div>
            <div class="col-md-2"> 
                <input type="text" id="tot_amount" name="tot_amount"  class="form-control" value="<?php echo $total_amount; ?>" readonly>
                <input type="hidden" id="hid_tot_amount" name="hid_tot_amount"  class="form-control" value="<?php echo $total_amount; ?>" readonly>
                <input type="hidden" id="vat_percentage" name="vat_percentage"  class="form-control" value="<?php echo $vat_perc; ?>" readonly>
               
              <span class="errorMsg"></span>
              
            </div>
            <div class="col-md-7" style="text-align:right;">
               <button type="button" id="add_payment_btn" style="text-align:right;color:white;text-decoration:none;" class="btn btn-info" > <i class="fa fa-plus"> Add Payment</i></button>
              </div>
          </div>
        
    <div class="payment_append">  
        <div class="row payment_row">
            <div class="col-md-1"> 
                <select  class="payment_type form-control" name="payment_type[]" style="width:92px;" >
                    <option value="">Select Payment Type </option>
                    <option value="Cash"> Cash </option>
                    <option value="Card"> Card </option>
                    <option value="Online"> Online </option>
                    <option value="Cheque"> Cheque </option>
                </select>
               
              <span class="errorMsg"></span>
              
            </div>
            
            <div class="col-md-2 show_bank bank_details" style="display:none;"> 
                <select  class="bank_id form-control" name="bank_id[]"   >
                    <option value="">Select Bank</option>
                    <?php 
                        foreach($banks as $b_key => $bank)
                        {
                            echo "<option value='".$bank['id']."'>".$bank['bank_name']."</option>";
                        }
                    ?>
                </select>
               
              <span class="errorMsg"></span>
              
            </div>
            
            <div class="col-md-2 show_cheque_bank cheque_details" style="display:none;"> 
                <input type="text" name="cheque_bank[]" class="cheque_bank form-control" value=""  placeholder="Cheque Bank">
                <span class="errorMsg"></span>
            </div>
            
            <div class="col-md-2 show_cheque_no cheque_details" style="display:none;"> 
                <input type="text" name="cheque_no[]" class="cheque_no form-control" value=""  placeholder="Cheque No.">
                <span class="errorMsg"></span>
            </div>
            
            <div class="col-md-2 show_cheque_date cheque_details" style="display:none;"> 
                <input type="date" name="cheque_date[]" class="cheque_date form-control" value="" placeholder="Cheque Date">
                <span class="errorMsg"></span>
            </div>
            
            
            <div class="col-md-2"> 
                <input type="text" name="payable_amount[]" class="payable_amount form-control" value="" placeholder="Payable Amount">
                <span class="errorMsg"></span>
            </div>
            
            <div class="col-md-2 "> 
                <input type="date" id="contract_to" name="payable_date[]" class="payable_date form-control" value="" placeholder="Payable Date">
                <span class="errorMsg"></span>
            </div>
            
            <button type="button" style="color:white;text-decoration:none;height:33px" class="del_payment btn btn-danger fa fa-trash-0" > <i class="fa fa-trash-o"></i></button>
            
        </div>
        
        
    </div>
          
         
         
          <br>
          <span class="errorMsg activityError"></span>
          <br>
          <br>
          <button id="save"  type="button" name="submit" class="btn btn-success contract_payment_submit" onClick="createContractPayment();" >Submit</button>
          
          <a onClick="$('#contractModal').hide();"    class="btn btn-danger" >Cancel</a>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>


</body>

</html>  

<?php $this->load->view('includes/footer_select2'); ?>
<script type="text/javascript">

  $( document ).ready(function() {
	 $('.level_id').select2();
	 $('.head_coach_id').select2();
	 $('#discount_type').select2();
	  
  });
  //parent_details();

  function createActivity(){
    activity_id = jQuery('#activity_id').val();
    if(activity_id == ''){
      var element = $('.activityError');
      $(element).html('<div class="text-danger left_align" style="font-size: 14px;">Please select activity.</div>');
    }else{
      jQuery.ajax({
          type:'POST',
          url:baseurl+'student_profile_slot_booking/addActivity',
          data:jQuery("form#addActivityForm").serialize(),
          dataType:'json',    
          beforeSend: function () {
              jQuery('button.activity_submit').text('loading');
          },
          success: function (json) {
              $('.text-danger').remove();
              if (json['error']) {             
                var element = $('.activityError');
                $(element).html('<div class="text-danger left_align" style="font-size: 14px;">'+json['error']+'</div>');
                
                jQuery('button.activity_submit').text('Submit');
            } else {
              
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
}


function createContractPayment(){
    var from = $('#contract_from').val();    
    var to = $('#contract_to').val();    
    if(from != '' && to != '')
    {
      jQuery.ajax({
          type:'POST',
          url:baseurl+'Activity_selections/addContractPayment',
          data:jQuery("form#addContractForm").serialize(),
          dataType:'json',    
          beforeSend: function () {
             // jQuery('button.contract_payment').text('loading');
          },
          success: function (json) {
              
            $('#contractModal').hide();
            swal({
                  title: "Contract Details Added Successfully",
                  text: "",
                  type: "success",
                  timer: 1000
               });
            $('#lblText2').html("Contract Details Added Successfully");
            $('#lblText2').show(); 
           

          },
          error: function (xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }        
      });
    }
    else
    {
        alert("Please choose contract dates");
    }
    
}

</script>

<script type="text/javascript">

  $(document).ready(function (e) {

 $("#submitForm").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
    url: baseurl+'Activity_selections/updateActivity',
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
                jQuery('form#registrationForm').find('textarea, input, select').each(function () {
                    jQuery(this).val('');
                });
                 if(json['from'] == 0){
                window.location.href = baseurl+'Students/edit/'+back_url;
                 }
                 else
                 {
                     window.location.href = baseurl+'Activity_approval'; 
                 }
          }
              
          }
      },
     error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }          
    });
 }));
 
 
 $('input[type=radio][name=contract_year]').click(function() {
    //alert(this.value);
    var val = parseInt(this.value);
    var vat_perc = $('#vat_percentage').val();
    var contract_fee_new = parseFloat(contract_fee * val).toFixed(2);
    var vat_val_new = parseFloat((contract_fee_new * vat_perc)/100).toFixed(2);
    var contract_total = (parseFloat(contract_fee_new) + parseFloat(vat_val_new)).toFixed(2);
    
    $('#contract_amount').val(contract_fee_new);
    $('#vat_amount').val(vat_val_new);
    $('#tot_amount').val(contract_total);
    
    var year_c = $("#addContractForm input[type='radio']:checked").val(); 
    	    
    var from = $('#contract_from').val(); 
    
    if(from)
	    {
	        var input = $("[id*=contract_from]").val();
            var str= input.split('-');
            console.log(str);
            var d = new Date(str[0], str[1]-1, str[2]); 
              var year = d.getFullYear();
              
              var month = d.getMonth();
              var day = d.getDate();
              var c = new Date(year + parseInt(year_c), month, day);
              c.setDate(c.getDate() -1 );
              console.log(c)
              var curr_date = c.getDate();
              var curr_month = c.getMonth();
              curr_month++;
              var curr_year = c.getFullYear();
              
              if (curr_date.toString().length !=2)
              {
                  curr_date = '0'+curr_date;
              }
              var curr_date = ("0" + curr_date).slice(-2);
              var curr_month = ("0" + (curr_month)).slice(-2);
              var c2 = curr_year + "-" + curr_month + "-" + curr_date;
              console.log(c2);
              $('#contract_to').val(c2); 
	    }
    
});

  function payable_amount() {
	 var totalPrice =[];
	 $(".payable_amount").each(function(){
        totalPrice.push(parseInt($(this).val()));
    });
	 
	 var sum = totalPrice.reduce(function(a, b){
            return a + b;
        }, 0);
		
	var total = $('#tot_amount').val();
	
	if(total<=sum) {
	$('.contract_payment_submit').show();
	}
	else
	{
	$('.contract_payment_submit').hide();
	}
  }
 $(document).on('keyup','.payable_amount',function(e){
payable_amount(); 
});	
 $(document).on("click","#contractBtn",function(){
	 
	payable_amount(); 
	
    $("input[name='contract_year'][value='1']").prop('checked', true);
    $('#contract_from').val('');
    $('#contract_to').val('');
    $('#contract_amount').val($('#hid_contract_amount').val());
    $('#vat_amount').val($('#hid_vat_amount').val());
    $('#tot_amount').val($('#hid_tot_amount').val());
      
    var output = '';
     
    output += '<div class="row payment_row">\
            <div class="col-md-1"> \
                <select  class="payment_type form-control" name="payment_type[]" style="width:92px;" >\
                    <option value="">Select Payment Type </option>\
                    <option value="Cash"> Cash </option>\
                    <option value="Card"> Card </option>\
                    <option value="Online"> Online </option>\
                    <option value="Cheque"> Cheque </option>\
                </select>\
             <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2 show_bank bank_details" style="display:none;">\ <select  class="bank_id form-control" name="bank_id[]"   >\
                    <option value="">Select Bank</option>\
                    <?php 
                        foreach($banks as $b_key => $bank)
                        {
                            echo "<option value=".$bank['id'].">".$bank['bank_name']."</option>";
                        }
                    ?>
                </select>\
            <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2 show_cheque_bank cheque_details" style="display:none;"><input type="text" name="cheque_bank[]" class="cheque_bank form-control" value=""  placeholder="Cheque Bank">\
                <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2 show_cheque_no cheque_details" style="display:none;"><input type="text" name="cheque_no[]" class="cheque_no form-control" value=""  placeholder="Cheque No.">\
                <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2 show_cheque_date cheque_details" style="display:none;"><input type="text" name="cheque_date[]" class="cheque_date form-control" value="" placeholder="Cheque Date">\
                <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2"><input type="text" name="payable_amount[]" class="payable_amount form-control" value="" placeholder="Payable Amount">\
                <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2"><input type="date" name="payable_date[]" class="payable_date form-control" value="" placeholder="Payable Date">\
                <span class="errorMsg"></span>\
            </div>\
            <button type="button" style="color:white;text-decoration:none;" class="del_payment btn btn-danger fa fa-trash-0" > <i class="fa fa-trash-o"></i></button>\
        </div>';
        
       //alert(output); 
     $('.payment_append').html(output); 
     
 });
 
 $(document).on("click",".del_payment",function(){
     $(this).closest('.payment_row').remove();
     payable_amount(); 
 });
 
 $(document).on("click","#add_payment_btn",function(){
  
    var output = '';
     
    output += '<div class="row payment_row">\
            <div class="col-md-1"> \
                <select  class="payment_type form-control" name="payment_type[]" style="width:92px;" >\
                    <option value="">Select Payment Type </option>\
                    <option value="Cash"> Cash </option>\
                    <option value="Card"> Card </option>\
                    <option value="Online"> Online </option>\
                    <option value="Cheque"> Cheque </option>\
                </select>\
             <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2 show_bank bank_details" style="display:none;">\ <select  class="bank_id form-control" name="bank_id[]"   >\
                    <option value="">Select Bank</option>\
                    <?php 
                        foreach($banks as $b_key => $bank)
                        {
                            echo "<option value=".$bank['id'].">".$bank['bank_name']."</option>";
                        }
                    ?>
                </select>\
            <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2 show_cheque_bank cheque_details" style="display:none;"><input type="text" name="cheque_bank[]" class="cheque_bank form-control" value=""  placeholder="Cheque Bank">\
                <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2 show_cheque_no cheque_details" style="display:none;"><input type="text" name="cheque_no[]" class="cheque_no form-control" value=""  placeholder="Cheque No.">\
                <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2 show_cheque_date cheque_details" style="display:none;"><input type="text" name="cheque_date[]" class="cheque_date form-control" value="" placeholder="Cheque Date">\
                <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2"><input type="text" name="payable_amount[]" class="payable_amount form-control" value="" placeholder="Payable Amount">\
                <span class="errorMsg"></span>\
            </div>\
            <div class="col-md-2"><input type="date" name="payable_date[]" class="payable_date form-control" value="" placeholder="Payable Date">\
                <span class="errorMsg"></span>\
            </div>\
            <button type="button" style="color:white;text-decoration:none;" class="del_payment btn btn-danger fa fa-trash-0" > <i class="fa fa-trash-o"></i></button>\
        </div>';
        
       //alert(output); 
     $('.payment_append').append(output); 
 });
 $(document).on("change",".payment_type",function(){
     var this_ = this;
     var val = $(this_).val();
     //alert(val);
     if(val=="Cash")
     {
        $(this_).closest('.row').find('.bank_details').css('display','none'); 
        $(this_).closest('.row').find('.cheque_details').css('display','none'); 
     }
     else if(val=="Card")
     {
        $(this_).closest('.row').find('.cheque_details').css('display','none');
        $(this_).closest('.row').find('.bank_details').css('display','block');
     }
     else if(val=="Online")
     {
        $(this_).closest('.row').find('.cheque_details').css('display','none'); 
        $(this_).closest('.row').find('.bank_details').css('display','block');
     }
     else if(val=="Cheque")
     {
        $(this_).closest('.row').find('.cheque_details').css('display','block'); 
        $(this_).closest('.row').find('.bank_details').css('display','none');
     }
     else
     {
        $(this_).closest('.row').find('.bank_details').css('display','none'); 
        $(this_).closest('.row').find('.cheque_details').css('display','none'); 
     }
     
 });
 
 $('input[type=radio][name=discount_applicable]').change(function() {
    if (this.value == 'Yes') {
       $('.discount_details').css('display','block');
    }
    else if (this.value == 'No') {
        $('.discount_details').css('display','none');
    }
});
 
 $(document).on("change","#discount_type",function(){
     var this_ = this;
     var val = $(this_).val();
     var perc = $('option:selected', this_).attr('perc');
     $('#discount_percentage').val(perc);
     
 });
 
 $(document).on("change","#level_id",function(){
     var this_ = this;
     var val = $(this_).val();
     var slots = $('option:selected', this_).attr('data-slots');
     $('#no_of_classes').val(slots);
     
 });
 

});

$('input[type=radio][name=contract]').change(function() {
    if (this.value == 'Yes') {
       $('.contract').css('display','block');
    }
    else if (this.value == 'No') {
        $('.contract').css('display','none');
    }
});
  
</script>