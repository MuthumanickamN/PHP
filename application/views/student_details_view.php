<?php 
 $this->load->view('includes/header3'); ?>
<style type="text/css">
#title

{
   background-image: linear-gradient(180deg, #efefef, #dfe1e2);
    text-shadow: #fff 0 1px 0;
    border: solid 1px #cdcdcd;
    border-color: #d4d4d4;
    border-top-color: #e6e6e6;
    border-right-color: #d4d4d4;
    border-bottom-color: #cdcdcd;
    border-left-color: #d4d4d4;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 0 1px #FFF inset;
    font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: left;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 20px;
  line-height: 20px;
}
h5
{
  font-family: "Open Sans",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
  font-size: 15px;
  line-height: 20px;
  font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: left;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 12px;
  line-height: 20px;
}


</style>
 
 <script type="text/javascript">
 	$(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });
 </script>
      <div id="active_admin_content" class="without_sidebar">
        <div id="main_content_wrapper">
          <div id="main_content">

 <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
         <div class="content-body"><!-- Zero configuration table -->
<section id="configuration" class="dashboard">
    

        <div class="row">
        <div class="col-12"><div class="card">
      <div class="card-header">
        <h4 class="card-title">Student Profile Report </h4>
            </div>
            </div> 
            </div> 
            </div> 
            
             
<div class="row">
                <div class="col-12 col-md-12">
    <div class="card">
     
      <div class="card-content collapse show">
        <div class="card-body p-0">
        <div class="table" style="overflow: scroll;">

                  <table class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                  <thead>
        <tr>
          <th style="text-align: center">Student ID</th>
          <th style="text-align: center">Student Name</th>
          <th style="text-align: center">Parent ID</th>
          <th style="text-align: center">Parent Name</th>
          <th style="text-align: center">Mobile</th>
          <th style="text-align: center">Parent E-mail</th>
          <th style="text-align: center">Status</th>
          <th style="text-align: center">Approval Status</th>
          <th style="text-align: center">Action</th>
                 
        </tr>
      </thead>
      <?php
      foreach ($Student_detail as $row) 
        {
        	?>
         <tr>  
        
          <td style="text-align: center"><?php echo $row->student_id;?></td>
          <td style="text-align: center"><?php echo $row->student_name;?></td>
          <td style="text-align: center"><?php echo $row->parent_id;?></td>
          <td style="text-align: center"><?php echo $row->parent_name;?></td>
          <td style="text-align: center"><?php echo $row->mobile_no;?></td>
          <td style="text-align: center"><?php echo $row->email_id;?></td>
          <td style="text-align: center"><?php echo $row->status;?></td>
          <td style="text-align: center"><?php echo $row->approval_status;?></td>
          <td style="text-align: center"><a id="myBtn" class="btn btn-info fa fa-eye"  href="<?php echo base_url('Students/view/'.$row->id); ?>"></a></td>
          
         </tr>
        <?php
        }
        ?> 
      
    </table>
    </br>

    <div class="row1">
        <div class="col-12"><div class="card">
      <div class="card-header">
        <h4 class="card-title">Student Remarks </h4>
            </div>
            </div> 
            </div> 
            </div> 
            
             
<div class="row">
                <div class="col-12 col-md-12">
    <div class="card">
     
      <div class="card-content collapse show">
        <div class="card-body p-0">
        <div class="table2" style="overflow: scroll;">
                  <table class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                  <thead>
        <tr>
          <th style="text-align: center">Student ID</th>
          <th style="text-align: center">Psa-id</th>
          <th style="text-align: center">Student Name</th>
          <th style="text-align: center">Activity</th>
          <th style="text-align: center">Level</th>
          <th style="text-align: center">Remark</th>
          <th style="text-align: center">Date</th>
        
                 
        </tr>
      </thead>
      <?php 
      foreach($list as $key => $row1) 
      {
        $date_time = $row1['updated_at'];
         ?>
         <tr>  
        
          <td style="text-align: center"><?php echo $row1->sid;?></td>
          <td style="text-align: center"><?php echo $row1->parent_code;?></td>
          <td style="text-align: center"><?php echo $row1->name;?></td>
          <td style="text-align: center"><?php echo $row1->game;?></td>
          <td style="text-align: center"><?php echo $row1->level;?></td>
          <td style="text-align: center"><?php echo $row1->remark;?></td>
          <td style="text-align: center"><span style="display:none;"><?php echo strtotime("$date_time"); ?></span><?php echo date("d/m/Y H:i:s", strtotime("$date_time")); ?></td>

      
         </tr>
        <?php
        }
        ?> 
      
    </table>
    </br>


    

      </section>
    </div>
  </div>
</div>
</div>
</div>
</div>
</html>




                
