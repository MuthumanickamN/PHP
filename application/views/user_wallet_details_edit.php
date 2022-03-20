<?php  ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Prepaid Credits Revise</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
    
 
</script>
<style type="text/css">
.table
th
    {
        
        font-family: Arial, Helvetica;
            


    }
    .btn2
    {
        color: black;
        background-color: white;

    }
</style>


<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 500px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Academy Activities</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Academy Activities</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Prepaid Credits Revise</a>
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
            <li> <a href="<?php echo site_url('User_wallet_details/'); ?>" class="btn btn-primary"   ><b>User Wallet</b></a></li>
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
                    <h4 class="card-title">Prepaid Credits Revise</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                 <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
         <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Parent-ID</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                <input type="text" id="parent_id" name="parent_id" value="<?php echo $parent_code ?>" readonly="" class="form-control">
                        </div></div>
                        <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Name</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="parent_name" name="parent_name" value="<?php echo $parent_name; ?>" readonly="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Mobile</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="parent_mobile" name="parent_mobile" value="<?php echo $mobile_no; ?>" readonly=""  class="form-control">
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Email-ID</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                         

                          <input type="text" id="parent_email_id" name="parent_email_id" value="<?php echo $email_id; ?>" readonly=""  class="form-control">
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Balance Credits (AED)</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="balance_credits" name="balance_credits" required="" value="<?php echo $balance_credits; ?>" readonly=""  class="form-control">
                        </div>
                    </div>
                    <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Revise Amount (AED)</strong>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="revise_amount" name="revise_amount"     class="form-control">
                        </div>
                    </div>
              

                       <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <b>Description</b>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <textarea  id="description" name="description" required="" class="form-control"></textarea>
                        </div>
                    </div>
                    


                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                         
                          
                                     <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('User_wallet_details/edit/'); ?>"       class="btn btn-success" />

                                 

                        
                         <a href="<?php echo base_url().'User_wallet_details' ?>"     class="btn btn-danger" >Cancel</a></div></div>
                    
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

