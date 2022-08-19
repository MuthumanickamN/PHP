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
.upload-remove img {
    width: 30% !important;
}
</style>

<div class="app-content content">
<div class="content-overlay"></div>
<div class="content-wrapper">
<div class="content-header row">
<div class="content-header-left col-md-6 col-12 mb-2">
<h3 class="content-header-title" style="color: green">Terms And Conditions</h3>
<div class="row breadcrumbs-top">
<div class="breadcrumb-wrapper col-12">

</div>
</div>
</div>
<div class="content-header-right col-md-6 col-12">
<div class="media width-250 float-right">
<media-left class="media-middle">
<div id="sp-bar-total-sales"></div>
</media-left>

</div>
</div>
</div>
<div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
    <h4 class="card-title"><?php echo $title;?></h4>
    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
   
</div>
<div class="card-content collapse show">
    <div class="card-body card-dashboard">
<form action="<?php echo site_url('TermsConditions/edit_details'); ?>" id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px;" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $result['Id'] ?>">

	 
	 
	 <div class="form-group lg-btm">	
            <div class="row">
                  <div class="col-md-3 control"><strong>Upload</strong></div>
              <div class="col-md-3 control">
                <input name="userfile[]" type="file" multiple="multiple" />
              </div>
            </div>	
            	<?php if(!empty($upload_items)) { ?>
                  <div class="row">
                      <div class="col-md-3 control"><strong>Uploaded</strong></div>
                        <div class="col-md-3 control">
                         
                          <a class="btn btn-info" target='_blank' href="<?php echo base_url().'assets/TERMS_and_Conditions_Prime_Star_Sports_Services.pdf'?>">View</a>
                              <?php //foreach($upload_items as $uploads){ ?>
                                <!--<p class="upload-remove" id="upload_remove_<?php echo $uploads['id']; ?>"><img src="<?php echo base_url().'assets/accounts_documents/'.$uploads['filename']; ?>">
                                <span title="Remove" id="hover-remove" style="cursor:pointer; padding-left:10px;" onclick="remove_upload('<?php echo $uploads['id']; ?>')"><i class="fa fa-remove"></i></span></p>-->
                          <?php //} ?>
                        </div>
                      </div>	
                <?php } ?>
             </div> 

           <div class="form-group lg-btm">
              <div class="col-md-6 control text-center">
                <input id="save" type="submit" name="submit" value="Change" class="btn btn-secondary" />      
                <!--<a href="" onClick="window.location.reload();" class="btn btn-secondary" >Cancel</a>-->
              </div>
            </div>
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



