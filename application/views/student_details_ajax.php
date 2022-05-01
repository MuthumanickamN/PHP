<?php
//ss============Student Details disply============ss//

if($opcode==1){  
?>
<div class="row">
    <div class="col-md-3">
            <strong>Name</strong>*
          </div>                            
    <div class="col-md-3">
<input type="text" id="student_name" name="student_name" value="<?php echo isset($name)?$name:''; ?>" readonly="" class="form-control">
    </div></div>
    <div class="row">
    <div class="col-md-3">
            <strong>Parent ID</strong>*
          </div>                            
    <div class="col-md-3">
      <input type="text" id="parent_id" name="parent_id" value="<?php echo isset($parent_id)?$parent_id:''; ?>" readonly="" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-3">
            <strong>Parent Name</strong>*
          </div>                            
    <div class="col-md-3">
      <input type="text" id="parent_name" name="parent_name" value="<?php echo isset($parent_name)?$parent_name:''; ?>" readonly=""  class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-3">
            <strong>Parent Contact No</strong>*
          </div>                            
    <div class="col-md-3">
      <input type="text" id="parent_contact_no" name="parent_contact_no" value="<?php echo isset($mobile_no)?$mobile_no:''; ?>" readonly=""  class="form-control">
    </div>
</div>
<?php } 
if($opcode==2){ 

?>
<div class="row">
    <div class="col-md-3">
            <strong>Wallet Amount </strong><abbr title="required">*</abbr>
          </div>                            
    <div class="col-md-3">
      <input type="text" id="wallet_amount" name="wallet_amount" value="<?php echo isset($wallet_amount)?$wallet_amount:0.00; ?>" readonly class="form-control">
    </div>
    
    <span class="errorWalletMsg errorMsg"></span>
</div>
<?php } 
if($opcode==3){ 

?>

 <div class="row">
    <div class="col-md-3"><strong>No. of Classes</strong>*</div>
    <div class="col-md-3">
    <input type="text" id="classes" name="classes" readonly="" class="form-control" value="<?php echo $session; ?>">
    </div>
</div>

<?php } ?>

<script type="text/javascript">
calculate();
</script>