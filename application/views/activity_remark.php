 <?php $this->load->view('includes/header3'); ?>


 <style>
.select2-container {
    box-sizing: border-box;
    display: inline-block;
    margin: 0;
    position: relative;
    vertical-align: middle;
    text-align:left !important;
}
</style>

 <script>
   var id="<?php echo $id;?>";
   
    function allLetter(inputtxt)
      { 
          var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
      document.getElementById("remark").value="";
      return false;
      }
    }


  function student_details(id="")
  { 
    if(id)
    {
        var student_id = "";
    }
    else
    {
        var student_id=document.getElementById('student_id').value;
    }
  
    $.ajax({
      
      url:"<?php echo base_url().'Activity_remark/student_details/'; ?>",
      type:"POST",
      data:{student_id:student_id,eid:id},
      success:function(data)
      {   
      document.getElementById('result').innerHTML=data;
      
      }
    });

  }

  function activity_change()
  {
      var level = $('#activity_id option:selected').attr('data-level');
      var level_id = $('#activity_id option:selected').attr('data-level_id');
      
      $('#level').val(level);
      $('#level_id').val(level_id);
  }
 </script>

<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Academy Activites</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Academy Activites</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Activity Remark</a>
                  </li>
                 
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-6 col-12">
             <div class="media width-250 float-right">
              <media-left class="media-middle">
                <div id="sp-bar-total-sales"></div>
              </media-left>
              <div class="media-body media-right text-right">
                 <ul class="list-inline mb-0">
            <li> <a href="<?php echo site_url('Activity_remark/list_'); ?>" class="btn btn-primary"   ><b>Remark List</b></a></li>
          </ul>
                
              </div>
            </div>
          </div>
        </div>
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Activity Remark</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      
              <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" action="<?php echo base_url('Activity_remark/edit/'.$id); ?>" style="margin-top: 25px; margin-left: 5px;">
             
                     <div class="form-group lg-btm">
                        <div class="col-md-2 control"><strong>Psa-ID/Name</strong>*</div>                            
                    <div class="col-md-3 control text-right">
                    <select name="student_id" id="student_id" class="form-control student_id"  required="" onchange="student_details()">
                            <option value="">Select</option>
                            <?php
                        
                          $osql = "select * from registrations WHERE status='Active'";                              
                          $oexe = $this->db->query($osql)->result_array();

    
                         foreach ( $oexe as $key => $row ){ ?>
                        
                        <option value="<?php echo $row['id'] ?>" <?php if($row['id']==$student_id ){ echo 'selected';} ?>><?php echo $row['id']; ?>-<?php echo $row['name']; ?>
                              
                            </option><?php
                            
                             }  ?></select>
                        </div>
                    </div>

                    <div id="result"></div>

                   
                    
                    
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control"><strong>Remark</strong>* </div>                            
                        <div class="col-md-3 control"> <textarea id="remark" name="remark"   class="form-control" required="" placeholder="Enter Remark"><?php echo $remark; ?></textarea>
                          
                        </div>
                    </div>

                  

                     <div class="form-group lg">
                      <div class="col-md-6 control text-center">
                         <?php if($remark=="") { ?>
                      <input id="save" type="submit" name="submit" value="Submit" onclick="<?php echo base_url('Activity_remark/student_detailss/'); ?>"       class="btn btn-success" /> 
                    <?php }  else {?>
                     <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('Activity_remark/edit/'); ?>"       class="btn btn-success" /> 
						<?php } ?>
                        
                         <a href="<?php echo base_url().'activity_remark' ?>"     class="btn btn-danger" >Cancel</a></div></div>
                  </form>
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</div>
</html>
 <?php $this->load->view('includes/footer_select2'); ?>
  <script>
  $( document ).ready(function() {
	  $('.activity_id').select2();
	  $('.student_id').select2();
  if(id){
    student_details(id);
  }
  });
</script>