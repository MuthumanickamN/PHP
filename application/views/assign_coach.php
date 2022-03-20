<?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Assign Coach</title>
</head>
<style type="text/css">
    #login
{
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
  font-size: 13px;
  line-height: 20px;
}
</style>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">


  $(document).ready(function(){
  //Chosen
  $(".choiceChosen, .productChosen").chosen({});
  //Logic
  $(".choiceChosen").change(function(){
    if($(".choiceChosen option:selected").val()=="no"){
      $(".productChosen option[value='2']").attr('disabled',true).trigger("chosen:updated");
      $(".productChosen option[value='1']").removeAttr('disabled',true).trigger("chosen:updated");
    } else {
      $(".productChosen option[value='1']").attr('disabled',true).trigger("chosen:updated");
      $(".productChosen option[value='2']").removeAttr('disabled',true).trigger("chosen:updated");
    }
  })
})

    function select_activity()
{ 
  var game_id=document.getElementById('game_id').value;

  
$.ajax({
  
  url:"<?php echo base_url().'index.php/Assign_coach/select_coach/'; ?>?game_id=game_id",
  type:"POST",
  data:{game_id:game_id},
  success:function(data)
  {   
  document.getElementById('result').innerHTML=data;
  
  }
});

}

 function view_student()
{ 
  var game_id=document.getElementById('game_id').value;
  var coach_id=document.getElementById('coach_id').value;
  

  
$.ajax({
  
  url:"<?php echo base_url().'index.php/Assign_coach/select_student/'; ?>?game_id=game_id&coach_id=coach_id",
  type:"POST",
  data:{game_id:game_id,coach_id:coach_id},
  success:function(data)
  {   
  document.getElementById('result1').innerHTML=data;
  
  }
});

}

</script>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Maintenance</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Maintenance</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Assign Coach</a>
                  </li>
                 
                </ol>
              </div>
            </div>
          </div>
      
        </div>
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Assign Coach</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
 <div class="panel panel-info" id="login" style="margin-top: 20px">
            

            <div  class="panel-body">
              

                    <div class="row">
						<div class="col-md-3 control text-left">   
							<select name="game_id" id="game_id" class="form-control choiceChosen"  required="" onchange="select_activity()">
								<option value="">Select Activity</option>
								<?php                        
								$osql1 = "select game_id,game from games";
								$result = $this->db->query($osql1)->result_array();
								foreach($result as $row1)
								{
								?>
								<option value="<?php echo $row1['game_id'] ?>" <?php if($row1['game_id']==$game_id ){ echo 'selected';} ?>><?php echo $row1['game'] ?>
								</option><?php }  ?>
							</select>
						</div>

                         <p style="width:10px"></p>

                         <div id="result"></div>

                   <p style="width:10px"></p>
                   
						<div class="col-md-3 control text-left">
						<select name="coach_id" id="coach_id" class="form-control choiceChosen"  required="" onchange="assign_coach()">
						<option value="">Select Coach</option>
						<?php                        
						$osql1 = "select coach_id,coach_name from coach"; 
						$result = $this->db->query($osql1)->result_array();
						foreach($result as $row1)
						{
						?>
						<option value="<?php echo $row1['coach_id'] ?>" <?php if($row1['coach_id']==$coach_id ){ echo 'selected';} ?>><?php echo $row1['coach_name'] ?>
						</option><?php }  ?></select>
						</div>
										
                 <div class="col-md-3 control text-left">
                     <a onclick="view_student()"     class="btn btn-primary" style="color: white" >Submit</a>
            </div></div>
          </div>
        </div>


<br/>
         <div id="result1"></div>

         <br/>

 <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
    <thead>
        
            <tr>
                <th style="text-align: center">S.No</th>
                <th style="text-align: center">Coach</th>
                <th style="text-align: center">Kids Assigned</th>
                
                
            </tr>
        </thead>
        <tbody>
           <?php                 $i=1;        
                            $osql1 = "select * from coach";  
						$result = $this->db->query($osql1)->result_array();
						foreach($result as $row1)
						{
   

                            $sql = "select * from activity_selections where coach_id=".$row1['coach_id'];                              
     
							 $rowcount = $this->db->query($sql)->num_rows();
							 
                            
                            
                              ?>
         <tr> <td style="text-align: center"><?php echo $i; ?></td>
          <td><?php echo $row1['coach_name']; ?></td>
              <td style="text-align: center"><?php echo $rowcount; ?></td></tr>
            <?php  $i++; } ?>
            </tbody>
          </table>
</div>
</div>
</div>
</div></div></div>
</div></div>
</div>
</section>
</div></div>
</div>
</body>
</html>

    <script>
select_activity();

</script>