<?php $this->load->view('includes/header3'); ?>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" style="color: green">School Credit Invoice</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">

                    </div>
                </div>
            </div>
            
        </div>
        <div class="content-body">
			<div class="col-lg-12"><span id="success-msg"></span></div>
            <div class="row">
				<div class="container_wrapper">
				<form id="add-school-credit-form" method="post">
					<div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Transaction date</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="date" name="transaction_date" class="form-control input-credit-transaction_date" id="transaction_date" placeholder="Transaction date">
						</div>						                                
                    </div>
					
					<div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Transaction type</label></legend>
						</div>
						<div class="col-lg-4">
							<fieldset class="choices">
							<ol class="choices-group input-credit-transaction_type" style="list-style: none;">
								<li class="choice"><label for="credit_transaction_type_credit"><input id="credit_transaction_type_credit" type="radio" value="credit" name="transaction_type">Credit</label></li>
							</ol>
							</fieldset>
							
						</div>						                                
                    </div>
					<div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Account code</label></legend>
						</div>
						<div class="col-lg-4">
							<select name="account_code" id="account_code" class="input-credit-account_code form-control">
								<option value="">Select account code</option>
								<?php
								if(isset($account_code_data)){
									foreach($account_code_data as $code){ echo '<option value="'.$code['id'].'">'.$code['name_of_service'].'</option>';} 
								}
								?>
							</select>
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>School Name / Contact</label></legend>
						</div>
						<div class="col-lg-4">
							<select name="school_id" id="school_id" class="input-credit-school_id form-control">
								<option value="">Select School</option>
								<?php
								if(isset($schoolList)){
									foreach($schoolList as $school){ echo '<option value="'.$school['id'].'">'.$school['school_name'].' / '.$school['contact'].'</option>';} 
								}
								?>
							</select>
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>School name</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" name="school_name" class="form-control input-credit-school_name" id="school_name" placeholder="School name" readonly="">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Location</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" name="location_id" class="form-control input-credit-school_location" id="location_id" placeholder="Location"  readonly="">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Contact number</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" name="contact" class="form-control input-credit-contact" id="contact" placeholder="Contact number"  readonly="">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Contact person</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" name="contact_person" class="form-control input-credit-contact_person" id="contact_person" placeholder="Contact person"  readonly="">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>TRN number</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" name="trn_number" class="form-control input-credit-trn_number" id="trn_number" placeholder="TRN number"  readonly="">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Email id</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" name="email_id" class="form-control input-credit-email_id" id="email_id" placeholder="Email id"  readonly="">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Activity</label></legend>
						</div>
						<div class="col-lg-4">
							<select name="activity_id" id="activity_id" class="input-credit-activity_id form-control">
								<option value="">Select Activity</option>
								<?php
								if(isset($activityList)){
									foreach($activityList as $activity){ echo '<option value="'.$activity['game_id'].'">'.$activity['game'].'</option>';} 
								}
								?>
							</select>
						</div>						                                
                    </div>
                    <div class="row" style="margin-bottom:15px;">
						<div class="col-lg-2">
							<legend class="label"><label>Description</label></legend>
						</div>
						<div class="col-lg-4">
							<textarea name="description" class="form-control input-credit-description" id="description" placeholder="description"></textarea>
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Transaction amount (AED)</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" name="transaction_amount" class="form-control input-credit-transaction_amount" id="transaction_amount" placeholder="Transaction amount">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>Gross amount (AED)</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" readonly="" name="gross_amount" class="form-control input-credit-gross_amount" id="gross_amount" placeholder="Gross amount">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>VAT Percentage</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" name="vat_percentage" class="form-control input-credit-vat_percentage" id="vat_percentage" value="<?php echo $vatPercent; ?>">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>VAT value</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" readonly="" name="vat_value" class="form-control input-credit-vat_value" id="vat_value" placeholder="VAT value">
						</div>						                                
                    </div>
                    <div class="row">
						<div class="col-lg-2">
							<legend class="label"><label>NET Amount (AED)</label></legend>
						</div>
						<div class="col-lg-4">
							<input type="text" readonly="" name="net_amount" class="form-control input-credit-net_amount" id="net_amount" placeholder="NET Amount (AED)">
						</div>						                                
                    </div>
                    <div class="row">
                        <div class="col-sm-12 centerAlign">                            
                            <button type="button" class="btn rkmd-btn btn-success" id="add-school-credit">Submit</button> 
                            <button type="button" class="btn rkmd-btn btn-danger">Cancel</button>
                        </div>                    
                    </div>

				</form>
				</div>
            </div>
        </div>
    </div>
</div>
<?php

$this->load->view('templates/footer');
?>
<script>
    jQuery('.datepicker').datepicker();
</script>
