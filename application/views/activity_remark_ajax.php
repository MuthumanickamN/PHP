
<div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Registration-Id</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                <input type="text" id="student_id" name="student_id" value="<?php echo $id; ?>" readonly="" class="form-control">
                        </div></div>
                        <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Name</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="student_name" name="student_name" value="<?php echo $name; ?>" readonly="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Activity</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                            <?php if($eid=="") { ?>
                          <select name="activity_id" id="activity_id" class="form-control activity_id" required onchange="activity_change()">
                              <option value="">Select</option>
                              <?php foreach($list as $key2 => $value2) { ?>
                              <option data-level="<?php echo $value2['level'];?>" data-level_id="<?php echo $value2['level_id'];?>" value="<?php echo $value2['activity_id'];?>" ><?php echo $value2['game'];?></option>
                              <?php } ?>
                          </select>    
                        <?php }else{ ?>
                        
                        <select name="activity_id" id="activity_id" class="form-control activity_id" required onchange="activity_change()" readonly>
                         <option data-level="<?php echo $level;?>" data-level_id="<?php echo $level_id;?>" value="<?php echo $activity_id;?>" selected><?php echo $activity;?></option>
                         
                        </select>   
                          
                        <?php } ?>
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Level</strong>
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="level" name="level" value="<?php if(isset($level)){echo $level;}?>" readonly=""  class="form-control">
                          <input type="hidden" id="level_id" name="level_id" value="<?php if(isset($level_id)){echo $level_id;}?>">
                        </div>
                    </div>
                   


      </html>
 <?php $this->load->view('includes/footer_select2'); ?>
  <script>
  $( document ).ready(function() {
	  $('.activity_id').select2();
  });
</script>