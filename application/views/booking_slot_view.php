<script type="text/javascript" src="<?php echo base_url() . 'assets/view_js/booking_slot.js' ?>"></script>
<div id="active_admin_content" class="without_sidebar">
  <div id="main_content_wrapper">
    <div id="main_content">
      <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url() ?>Booking_slot">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo base_url() ?>Booking_reports">Reports</a></li>
			<li class="breadcrumb-item"><a href="<?php echo base_url() ?>Recharge_history">Recharge History</a></li>
		  </ol>
		</nav>
          <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration" class="dashboard">
              <div class="row">
                <div class="col-12">
                  <h4 class="heading1">Prime Star Sport Academy</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

		  
<div class="row">
   
   
   <div class="col-12">
   <form action="<?php echo base_url(); ?>Booking_slot/booking_submit" name="booking_form" id="booking_form" method="post">
    <input type="hidden" name="cid" id="cid" value="<?php // echo $cid; ?>">
    <input type="hidden" name="sid" id="sid" value="<?php echo $sports_id; ?>">
    <input type="hidden" name="lid" id="lid" value="<?php echo $lid; ?>">
    <input type="hidden" name="customer_old_deductable_amount" id="customer_old_deductable_amount" value="<?php echo $customer_old_deductable_amount['total_deductable_amount']; ?>">
    <input type='hidden' name='id_array' id='id_array' value='<?php echo $hidden_arraykey; ?>'>
    <input type="hidden" name="wallet_amount" id="wallet_amount" value="<?php echo $getWalletAmount['amount']; ?>">
  
    <?php /* $msg = FlashMessages::render(); */ if($msg !=''){ ?>
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-success">
        <i class="fa fa-check-square" aria-hidden="true"></i>
        <?php 
          //echo 'Booking is done succesfully. Your balance is '.$customer_wallet_amount['amount']; 
          echo $msg;
          ?>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
      </div>
    </div>
    <?php } ?>
    <?php /* $error_msg = FlashMessages::render(); */ if($error_msg !=''){ ?>
    <div class="col-sm-12 col-md-12">
      <div class="alert alert-danger">
        <?php echo $error_msg; ?>
        <a href="#" class="close" data-dismiss="alert">&times;</a>
      </div>
    </div>
    <?php } ?>
    <div class="col-sm-12">

				<div class="row">
				
				<div class="col-3">
					<div class="form-group">
					<label for="email">Select Sports</label>
					<select name="sports" id="sports" class="form-control">
						  <option value="">- Select Sports -</option>
						  <?php foreach($sportslist as $key => $sports) { ?>
						  <option value="<?php echo $sports['id']; ?>"><?php echo ucfirst($sports['sportsname']); ?></option>
						  <?php } ?>
					</select>
					</div>
				</div>
				<div class="col-3">
					<div class="form-group">
					<label for="pwd">Select Location:</label>
					<select name="location" id="location" class="form-control">
						<option value="">- Select Location -</option>
					</select>
					</div>
				</div>
				<div class="col-3">
					<div class="form-group">
					<label for="pwd">Date</label>
					 <input type="text" class="date-picker form-group" id="booking_date" name="booking_date" value="" readonly />
					</div>
				</div>
				<div class="col-3">
					<div class="form-group" style="margin-top:24px;">
					<label for="pwd">&nbsp;</label>
					  <button type="button" id="slots" class="btn btn-primary">Show Slots</button>
					</div>
				</div>
				
				</div>
	
   
      <div class="clearfix"></div>
      <!--      <div class="table-responsive"  id="show_slot"></div>-->
      <div class="table-responsive">
        <img src="<?php echo base_url(); ?>assets_booking/images/status_image.png" class="pull-right" alt="indicator" title="indicator">
        <table id="show_slot" class="table table-bordered table-striped">
          <tbody></tbody>
        </table>
      </div>
      <div class="table-responsive" id="hide2" <?php if(!isset($_SESSION['cart'])) { ?> style="display:none;" <?php } ?> >
        <input type="hidden" name="hidden_total_price" id="hidden_total_price" value="">
        <input type="hidden" name="hidden_slot_ids" id="hidden_slot_ids" value="">
        <input type="hidden" name="hidden_gross_amount" id="hidden_gross_amount" value="">
        <input type="hidden" name="hidden_net_amount" id="hidden_net_amount" value="">
        <input type="hidden" name="hidden_balance_amount" id="hidden_balance_amount" value="">
        <h4>Booking Summary</h4>
        <table class="table table-bordered booking_table1" id="example3">
          <thead>
            <tr>
              <th>Activity</th>
              <th>Date</th>
              <th>Time</th>
              <th>Location</th>
              <th>Court</th>
              <th>Price</th>
              <th class="text-center" width="250">Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              // echo '<pre>'; 
               //print_r($array);
               if(!empty($array)){
                   foreach($array as $key => $cart_details){
              
                       echo "<tr>";
                       echo "<td><input type='hidden' name='hidden_id[]' id='hidden_id' value='".$cart_details['hidden_id']."'>". ucfirst($cart_details['sportsname']);
                       echo "<input type='hidden' name='hidden_fromtime[]' id='hidden_fromtime' value='".$cart_details['from_time']."'>";
                       echo "<input type='hidden' name='hidden_totime[]' id='hidden_totime' value='".$cart_details['to_time']."'>";
                       echo "<input type='hidden' name='hidden_sid[]' id='hidden_sid' value='".$cart_details['hidden_sid']."'>";
                       echo "<input type='hidden' name='hidden_cid[]' id='hidden_cid' value='".$cart_details['hidden_cid']."'></td>";
                       echo "<td><input type='hidden' name='hidden_booking_date[]' id='hidden_booking_date' value='".$cart_details['hidden_booking_date']."'>".$cart_details['hidden_booking_date']."</td>";
                       echo "<td>".date('h:i A', strtotime($cart_details['from_time'])).'-'.date('h:i A', strtotime($cart_details['to_time']))."</td>";
                       echo "<td>".ucfirst($cart_details['location_name']) ."</td>";
                       echo "<td>".ucfirst($cart_details['courtname']) ."</td>";
                       echo "<td><input type='hidden' class='hidden_price' name='hidden_cost[]' id='hidden_cost' value='".$cart_details['hidden_cost']."'>". $cart_details['hidden_cost']."</td>";
                       echo "<td class='text-center'><button type='button' title='Remove' data-id='".$cart_details['hidden_id']."' data-ckbxid='".$cart_details['ckbxid']."' data-arraykey='".$cart_details['arraykey']."' data-idarray='".$cart_details['id_array']."' class='btn btn-danger btn-xs rmve_btn'><i class='glyphicon glyphicon-trash'></i></button></td>";
                       echo "</tr>";    
              
                   }
               }
               ?>
            <tr>
              <td colspan="6" class="total"><button type="button" title="Book Now" id="checkout" class="btn btn-primary pull-left" <?php if(!isset($_SESSION['cart'])) { ?> style="display:none;" <?php } ?> ><i class="glyphicon glyphicon-ok"></i> &nbsp; Book Now</button></td>
              <td class="total">Deductable Amount: <span id="total_price"><strong></strong></span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="clearfix"></div>
      <div class="table-responsive" id="hide3" style="display: none;">
        <div class="border_box">
          <p class="table_heading">Checkout</p>
          <table class="table table-bordered table-striped checkout_table">
            <tr>
              <td class="text-right">Gross Price</td>
              <td class="amount1"></td>
            </tr>
            <!--                    <tr>
              <td class="text-right">Reservation Amount Payable</td>
              <td class="amount2">400</td>
              </tr>
              <tr>
              <td class="text-right">Apply Coupon</td>
              <td><div class="col-sm-12 col-md-8"><input type="text" name=""></div><div class="col-sm-12 col-md-4"><button type="submit" title="Apply Coupon" class="btn btn-warning btn-sm">Apply</button></div></td>
              </tr>-->
            <tr>
              <td class="text-right"><strong>Net Reservation Price Payable</strong><br/><span class="small">(Inclusive of 5% VAT)</span></td>
              <td class="amount3"></td>
            </tr>
            <!-- <tr>
              <td class="text-right">Balance Abount payable at Venue</td>
              <td class="amount2">0</td>
              </tr>-->
            <tr>
              <td class="text-left"><input type="checkbox" name="terms_condition" id="terms_condition" value="1">&nbsp;&nbsp; I have read and agree to the <a href="#" data-toggle="modal" data-target="#ruleModal" style="line-height:26px; font-size:12px; text-decoration:underline;">Terms and Conditions</a> mentioned above.</td>
              <td><button type="button" id="submit_booking" class="btn btn-success btn-md">Confirm Booking</button></td>
            </tr>
          </table>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
  </form>
                  </div>
                </div>
              </div>
          </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>

