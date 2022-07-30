<?php
//ss============Student Details disply============ss//

if($opcode==1) { ?>
<div class="row">
    <div class="col-md-3 control ">
      <p><strong>Bank Name</strong>*</p>
     <select name="bank" id="bank" class="form-control input-transaction-bank"  required="">
        <option value="">Select</option>
        <?php if(isset($bankdetails)){
          foreach($bankdetails as $row){?>
      <option value="<?php echo $row['bank_name'] ?>"><?php echo $row['bank_name']; ?></option><?php
      } } ?></select>
    </div>
</div>
<?php } 
if($opcode==2)
{ 
?>
<div class="row">
    <div class="col-md-3 control ">
      <p><b>Cheque No</b>*</p>
       <input type="text"  id="cheque_number" name="cheque_number" required="" class="form-control input-transaction-cheque_number">
    </div>
    <div class="col-md-3 control ">
      <p><b>Cheque Date</b>*</p>
        <input type="date"  name="cheque_date" id="cheque_date" class="form-control input-transaction-cheque_date">
    </div>
    <div class="col-md-3 control ">
      <p><strong>Bank Name</strong>*</p>
     <select name="bank" id="bank" class="form-control input-transaction-bank"  required="">
        <option value="">Select</option>
        <?php if(isset($bankdetails)){
          foreach($bankdetails as $row){?>
            <option value="<?php echo $row['bank_name'] ?>" <?php //if($row['id']==$id ){ echo 'selected';} ?>><?php echo $row['bank_name']; ?></option><?php
        
         } } ?></select>
    </div>
</div>



<?php } ?>