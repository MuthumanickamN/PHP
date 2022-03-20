<?php  ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Fees Structure Images</title>
</head>



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
                  <li class="breadcrumb-item"><a href="#">Fees Structure Image</a>
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
            <li><a href="<?php echo site_url('fees_structure_images'); ?>" class="btn btn-primary"   ><b>Image List</b></a></li>
          </ul>
                
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
                    <h4 class="card-title">Fees Structure Image</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" enctype="multipart/form-data" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
          <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Activity</strong>*</div>
                        <div class="col-md-3 control text-left">
                        <select name="activity_id" id="activity_id" class="form-control" required="">
                            <option value="">Select</option>
                            <?php                        
                          $osql1 = "select game_id,game from games ORDER BY game ASC";                              
                            $oexe1 = $this->db->query($osql1 )->result_array();
                             foreach( $oexe1 as $key => $row1 ) { ?>
                        <option value="<?php echo $row1['game_id'] ?>" <?php if($row1['game_id']==$activity_id ){ echo 'selected';} ?>><?php echo $row1['game'] ?>
                         </option><?php }  ?></select>
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Description</strong>*</div>
                        <div class="col-md-3 control text-left">     
                          <textarea id="description" name="description"  value="" class="form-control" required="" placeholder="Enter Description"><?php echo $description; ?></textarea>
                        </div>
                    </div>

                     <div class="form-group lg">
                          

                          <?php if($fee_image_file_name=="") { ?>

                         <div class="col-md-3 control text-left"><strong>Image</strong>*</div>
                        <div class="col-md-3 control text-left">
 
                         <input type="file" id="fee_image_file_name"  name="fee_image_file_name" required=""  /> <?php } else { ?>
                           <div class="col-md-3 control text-left"><strong>Image</strong>*</div>
                        <div class="col-md-3 control text-left">
                           
                            <input type="file" id="fee_image_file_name" name="fee_image_file_name" >
                            <input type="hidden" id="fee_image_file_name1" name="fee_image_file_name1" value="<?php echo $fee_image_file_name; ?>">
                            <img src="<?php  echo base_url().'assets/Fees_structure_images/'.$fee_image_file_name; ?>" style="width:50px; height:50px; margin-top:10px;">
                          (<?php echo $fee_image_file_name; ?>)<?php } ?>
                        </div>
                    </div>
                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                            <?php if($activity_id=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" onclick="<?php echo base_url('fees_structure_images/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('fees_structure_images/add/'); ?>"       class="btn btn-success" /><?php } ?>

                                 

                        
                         <a href="<?php echo base_url().'fees_structure_images' ?>"     class="btn btn-danger" >Cancel</a></div></div>
                    
                </form>
            </div>
        </div></div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
</body>

</html>  
