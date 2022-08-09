<?php if($opcode==1)
 { 
 ?>

<div class="row">
    <div class="col-md-6">
       <label><strong>Parent-Name*</strong></label>
    </div>
    <div class="col-md-6">
        <input type="text" id="parent_name" name="parent_name" required="" class="form-control" value="<?php echo isset($parent_name)?$parent_name:''; ?>" style="width: 282px" readonly>
        <span class="errorMsg"></span>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
       <label><strong>Registered Parent E-Mail-id*</strong></label>
    </div>
    <div class="col-md-6">
       <input type="text" id="parent_email_id" name="parent_email_id" required="" class="form-control"  value="<?php echo isset($email_id)?$email_id:''; ?>" style="width: 282px" readonly>
       <span class="errorMsg"></span>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
       <label><strong>Registered Parent-id*</strong></label>
    </div>
    <div class="col-md-6">
        <input type="hidden" id="parent_id" name="parent_id" required=""  class="form-control"  value="<?php echo isset($parent_id)?$parent_id:''; ?>" style="width: 284px" readonly>
        <input type="text" id="parent_code" name="parent_code" required=""  class="form-control"  value="<?php echo isset($parent_code)?$parent_code:''; ?>" style="width: 284px" readonly>
        <span class="errorMsg"></span>
    </div>
</div>


                    
<?php } ?>