<?php
if($opcode==1) { ?>
    <div class="row">
        <div class="col-md-3"><strong>Bank Name</strong>*</div>                            
        <div class="col-md-3">
            <select name="bank" id="bank" class="form-control"  required="">
                <option value="">Select</option>
                <?php if(isset($bankdetails)){
                foreach($bankdetails as $row){?>
                <option value="<?php echo $row['bank_name'] ?>"><?php echo $row['bank_name']; ?></option><?php
                } } ?>
            </select>
            <span class="errorMsg"></span>
        </div>
    </div>

<?php } if($opcode==2){  ?>
<div class="row">
    <div class="col-md-3"><b>Cheque No</b>*</div>                            
    <div class="col-md-3">
        <input type="text"  id="cheque_no" name="cheque_no" required="" class="form-control">
        <span class="errorMsg"></span>
    </div>
</div>

<div class="row">
    <div class="col-md-3"><b>Cheque Date</b>*</div>                            
    <div class="col-md-3">
        <input type="date"  name="cheque_date" id="cheque_date" class="form-control">
        <span class="errorMsg"></span>
    </div>
</div>

<div class="row">
    <div class="col-md-3"><strong>Bank Name</strong>*</div>                            
    <div class="col-md-3">
        <select name="bank" id="bank" class="form-control"  required="">
            <option value="">Select</option>
            <?php if(isset($bankdetails)){
            foreach($bankdetails as $row){?>
            <option value="<?php echo $row['bank_name'] ?>"><?php echo $row['bank_name']; ?></option><?php
            } } ?>
        </select>
        <span class="errorMsg"></span>
    </div>
</div>
<?php } if($opcode==4){  ?>

<div class="row">
    <div class="col-md-3"><strong>Parent-ID</strong>*</div>                            
    <div class="col-md-3">
        <input type="hidden" id="parent_id" name="parent_id" value="<?php echo ($parent_id!=0)?$parent_id:''; ?>" readonly="" class="form-control">
        <input type="text" id="parent_code" name="parent_code" value="<?php echo isset($row2['parent_code'])?$row2['parent_code']:''; ?>" readonly="" class="form-control">
        <span class="errorMsg"></span>
    </div>
</div>
<div class="row">
<div class="col-md-3">
<strong>Name</strong>*
</div>                            
<div class="col-md-3">
<input type="text" id="parent_name" name="parent_name" value="<?php echo isset($row2['parent_name'])?$row2['parent_name']:''; ?>" readonly="" class="form-control">
<span class="errorMsg"></span>
</div>
</div>
<div class="row">
<div class="col-md-3">
<strong>Mobile</strong>*
</div>                            
<div class="col-md-3">
<input type="text" id="parent_mobile" name="parent_mobile" value="<?php echo isset($row2['mobile_no'])?$row2['mobile_no']:''; ?>" readonly=""  class="form-control">
<span class="errorMsg"></span>
</div>
</div>
<div class="row">
<div class="col-md-3">
<strong>Email-ID</strong>*
</div>                            
<div class="col-md-3">
<input type="text" id="parent_email_id" name="parent_email_id" value="<?php echo isset($row2['email_id'])?$row2['email_id']:''; ?>" readonly=""  class="form-control">
<span class="errorMsg"></span>
</div>
</div>
<div class="row">
<div class="col-md-3">
<strong>Balance Credits (AED)</strong>*
</div>                            
<div class="col-md-3">
<input type="text" id="balance_credits" name="balance_credits" required="" value="<?php echo isset($wallet['balance_credits'])?$wallet['balance_credits']:0; ?>" readonly=""  class="form-control">
<span class="errorMsg"></span>
</div>
</div>
<div class="row">
<div class="col-md-3">
<strong>Total Credits (AED)</strong>*
</div>                            
<div class="col-md-3">
<input type="text" id="total_credits" name="total_credits" value="<?php echo isset($wallet['total_credits'])?$wallet['total_credits']:0; ?>"  readonly=""  class="form-control">
<span class="errorMsg"></span>
</div>
</div>
<?php } ?>