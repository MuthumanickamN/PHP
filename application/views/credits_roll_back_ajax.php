<?php
//ss============Student Details disply============ss//




   if($opcode==4)
{  
    $query2=$this->db->query("select * from parent where parent_id='".$parent_id."' and status='Active'");
    $row2=$query2->row_array();


    $query3=$this->db->query("select * from prepaid_credits where parent_id='".$parent_id."'");
    if($query3->num_rows() > 0)
    {
        $row3=$query3->row_array();
        
        $balance_credits=$row3['balance_credits'];
        $total_credits=$row3['total_credits'];
        $credit_id=$row3['id'];
    }
    else
    {
        $balance_credits=0.00;
        $total_credits=0.00;
        $credit_id=0;
    }

?>
<input type="hidden" name="prepaid_credit_id" id="prepaid_credit_id" value="<?php echo $credit_id; ?>">
<div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Parent-ID</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                <input type="text" id="parent_id_show" name="parent_id_show" value="<?php if($row2['parent_code']!="") { echo $row2['parent_code']; } else { echo ''; } ?>" readonly="" class="form-control">
                        </div></div>
                        <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Name</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="parent_name" name="parent_name" value="<?php echo $row2['parent_name']; ?>" readonly="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Mobile</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="parent_mobile" name="parent_mobile" value="<?php echo $row2['mobile_no']; ?>" readonly=""  class="form-control">
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Email-ID</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="parent_email_id" name="parent_email_id" value="<?php echo $row2['email_id']; ?>" readonly=""  class="form-control">
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Balance Credits (AED)</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="balance_credits" name="balance_credits" required="" value="<?php if($balance_credits=="") {  echo '0.00'; } else { echo $balance_credits; }  ?>" readonly=""  class="form-control">
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Total Credits (AED)</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="total_credits" name="total_credits" value="<?php if($total_credits=="") {  echo '0.00'; } else { echo  $total_credits; }  ?>"  readonly=""  class="form-control">
                        </div>
                    </div>
                    

                    <?php } ?>