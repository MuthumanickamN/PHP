<?php if($opcode==4){  ?>

<div class="row">
<div class="col-md-3">
        <strong>Parent-ID</strong>*
      </div>                            
<div class="col-md-3 ">
<input type="text" id="parent_id" name="parent_id" value="<?php if($parent_id!=0) { echo $parent_id; } else { echo ''; } ?>" readonly="" class="form-control">
<span class="errorMsg"></span>
</div></div>
<div class="row">
<div class="col-md-3">
        <strong>Name</strong>*
      </div>                            
<div class="col-md-3 ">
  <input type="text" id="parent_name" name="parent_name" value="<?php echo isset($row2['parent_name'])?$row2['parent_name']:''; ?>" readonly="" class="form-control">
  <span class="errorMsg"></span>
</div>
</div>
<div class="row">
<div class="col-md-3">
        <strong>Mobile</strong>*
      </div>                            
<div class="col-md-3 ">
  <input type="text" id="parent_mobile" name="parent_mobile" value="<?php echo isset($row2['mobile_no'])?$row2['mobile_no']:''; ?>" readonly=""  class="form-control">
  <span class="errorMsg"></span>
</div>
</div>
<div class="row">
<div class="col-md-3">
        <strong>Email-ID</strong>*
      </div>                            
<div class="col-md-3 ">
  <input type="text" id="parent_email_id" name="parent_email_id" value="<?php echo isset($row2['email_id'])?$row2['email_id']:''; ?>" readonly=""  class="form-control">
  <span class="errorMsg"></span>
</div>
</div>
<div class="row">
<div class="col-md-3"><strong>Student ID</strong>*</div>                            
<div class="col-md-3 ">
<select name="student_id" id="student_id" class="form-control student_id"  required="" >
        <option value="">Select</option>
        <?php foreach ($studentList as $key => $value) { ?>
                <option value="<?php echo $value['id'] ?>" <?php if(isset($student_id) && $value['id']==$student_id ){ echo 'selected';} ?>><?php echo $value['sid'].'|'.$value['name']; ?></option>
        <?php }  ?>
</select>
<span class="errorMsg"></span>
</div>
</div>
<div class="row">
<div class="col-md-3">
    <b>Wallet Credit</b>*
  </div>                            
<div class="col-md-3">
<input type="hidden" name="wallet_id" value="<?php echo isset($wallet_id)?$wallet_id:$walletAmount['id'];  ?>" >
<input type="text" id="total_credit" name="total_credit" required=""  value="<?php echo isset($total_credit)?$total_credit:$walletAmount['total_credits'];  ?>"   class="form-control" oninput="allnumeric(document.form.total_credit);" readonly="" >
<span class="errorMsg"></span>
</div>
</div>



<?php } ?>
