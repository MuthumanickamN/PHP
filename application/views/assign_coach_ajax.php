<?php

//ss============Student Details disply============ss//

if($opcode==1)
{ ?>
     
     <div class="row">
        <div class="col-12"><div class="card">
      <div class="card-header">
        <h4 class="card-title">Assigned Students </h4>
            </div>
            </div> 
            </div> 
            </div> 
     <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                           <form action="<?php echo base_url('index.php/assign_coach/assign_coach/'); ?>" method="post" name="form" enctype="multipart/form-data">  
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:200%">
                            <input type="hidden" name="game_id" value="<?php echo $game_id;?>">
                            <input type="hidden" name="coach_id" value="<?php echo $coach_id;?>">
    <thead>
        <tr>
            <th style="text-align:center;">Check</th>
            <th style="text-align:center;">S.n</th>
            <th style="text-align:center;">Reg-Id</th>
            <th style="text-align:center;">Name</th>
            <th style="text-align:center;">Activity</th>
            <th style="text-align:center;">Coach</th>
            <th style="text-align:center;">Parent Name</th>
            <th style="text-align:center;">Parent-Id</th>
            <th style="text-align:center;">Mobile</th>
            <th style="text-align:center;">Email</th>
            <th style="text-align:center;">Status</th>
            <th style="text-align:center;">Approval Status</th>

        </tr>
    </thead>
     <tbody>
<?php $i=1;

   //$osql1 = "select * from activity_selections where activity_id=".$game_id." and (coach_id='' or coach_id is NULL)";
	$osql1 = "select acs.*,coach.coach_name,parent.parent_code from activity_selections as acs left join coach on coach.coach_id=acs.coach_id left join parent on parent.parent_id = acs.parent_user_id where acs.activity_id=".$game_id." and (coach.coach_id ='$coach_id' and coach.coach_id is NOT NULL)";
   $oexe1 = $this->db->query($osql1 );
   foreach( $oexe1->result_array() as $key => $row1  ){  
	
     $osql2 = "select game from games where game_id=".$row1['activity_id'];                              
     $oexe2 = $this->db->query($osql2 );
     $row2 = $oexe2->row_array();

  ?>
      <tr>
      <td style="text-align:center" ><input type="checkbox" id="checkbox" name="remove_coach_checkbox[]" value ="<?php echo $row1['id']; ?>"/>&nbsp;</td>
        <td style="text-align:center;"><?php echo $i; ?></td>
        <td style="text-align:center;"><?php echo $row1['sid']; ?></td>
        <td style="text-align:center;"><?php echo $row1['student_name']; ?></td>
        <td style="text-align:center;"><?php echo $row2['game']; ?></td>
        <td style="text-align:center;"><?php echo $row1['coach_name']?></td>
        <td style="text-align:center;"><?php echo $row1['parent_name']; ?></td>
        <td style="text-align:center;"><?php echo $row1['parent_code']; ?></td>
        <td style="text-align:center;"><?php echo $row1['parent_mobile']; ?></td>
        <td style="text-align:center;"><?php echo $row1['parent_email_id']; ?></td>
        <td style="text-align:center;"><?php echo $row1['status']; ?></td>
        <td style="text-align:center;"><?php echo $row1['approval_status']; ?></td>
      </tr><?php $i++;   ?>

 
</tbody>
 <?php  
  $session_data = array( 'coach_id'     =>     $coach_id );  
  $this->session->set_userdata($session_data);                       
  }
  ?>
     <tr>
        <td style="text-align: center"> <input type="submit" value="Remove" name="sub" style="background-color: #ba272d !important; color:white"></td>
        <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td><td></td>
      
     </tr>
      <?php  ?>
</table></form>
</div>
</div>
</div>







<div class="row">
        <div class="col-12"><div class="card">
      <div class="card-header">
        <h4 class="card-title">Not Assigned Students </h4>
            </div>
            </div> 
            </div> 
            </div> 
 
     <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                           <form action="<?php echo base_url('index.php/assign_coach/assign_coach/'); ?>" method="post" name="form" enctype="multipart/form-data">  
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:200%">
                            <input type="hidden" name="game_id" value="<?php echo $game_id;?>">
                            <input type="hidden" name="coach_id" value="<?php echo $coach_id;?>">
       <thead>
        <tr>
            <th style="text-align:center;">Check</th>
            <th style="text-align:center;">S.n</th>
            <th style="text-align:center;">Reg-Id</th>
            <th style="text-align:center;">Name</th>
            <th style="text-align:center;">Activity</th>
            <th style="text-align:center;">Parent Name</th>
            <th style="text-align:center;">Parent-Id</th>
            <th style="text-align:center;">Mobile</th>
            <th style="text-align:center;">Email</th>
            <th style="text-align:center;">Status</th>
            <th style="text-align:center;">Approval Status</th>

        </tr>
    </thead>
     <tbody>
<?php $i=1;

   $osql1 = "select acs.*, parent.parent_code from activity_selections as acs left join parent on parent.parent_id = acs.parent_user_id where acs.activity_id=".$game_id." and (acs.coach_id='' or acs.coach_id is NULL)";
	//$osql1 = "select * from activity_selections where activity_id=".$game_id." and (coach_id ='$coach_id' and coach_id is NOT NULL)";
   $oexe1 = $this->db->query($osql1 );
   foreach( $oexe1->result_array() as $key => $row1  ){  
	
     $osql2 = "select game from games where game_id=".$row1['activity_id'];                              
     $oexe2 = $this->db->query($osql2 );
     $row2 = $oexe2->row_array();

  ?>
      <tr>
      <td style="text-align:center" ><input type="checkbox" id = "checkbox" name="assign_coach_checkbox[]" value ="<?php echo $row1['id']; ?>"/>&nbsp;</td>
        <td style="text-align:center;"><?php echo $i; ?></td>
        <td style="text-align:center;"><?php echo $row1['sid']; ?></td>
        <td style="text-align:center;"><?php echo $row1['student_name']; ?></td>
        <td style="text-align:center;"><?php echo $row2['game']; ?></td>
        <td style="text-align:center;"><?php echo $row1['parent_name']; ?></td>
        <td style="text-align:center;"><?php echo $row1['parent_code']; ?></td>
        <td style="text-align:center;"><?php echo $row1['parent_mobile']; ?></td>
        <td style="text-align:center;"><?php echo $row1['parent_email_id']; ?></td>
        <td style="text-align:center;"><?php echo $row1['status']; ?></td>
        <td style="text-align:center;"><?php echo $row1['approval_status']; ?></td>
      </tr><?php $i++;   ?>

 
</tbody>
 <?php  
  $session_data = array( 'coach_id'     =>     $coach_id );  
  $this->session->set_userdata($session_data);                       
  }
  ?>
     <tr>
        <td style="text-align: center"> <input type="submit" value="Assign" name="sub" style="background-color: #ba272d !important; color:white"></td>
        <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td><td></td>
      
     </tr>
      <?php  ?>
</table></form>
</div>
</div>
</div>


<?php } ?>