<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Scroll Text Message</title>
</head>


<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<?php displayMessage(); ?>
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
                  <li class="breadcrumb-item"><a href="#">Scroll Text Message</a>
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
            <li><a href="<?php echo site_url('index.php/scroll_text_messages'); ?>" class="btn btn-primary"   ><b>Message List</b></a></li>
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
                    <h4 class="card-title">Scroll Text Message</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
            <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Message</strong>*</div>
                        <div class="col-md-3 control text-left">
                        <input type="text" id="message" name="message" required=""  class="form-control" value="<?php echo $message; ?>">
                        </div>
                    </div>

                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"></div>
                        <div class="col-md-3 control text-left">
                       <input type="checkbox" id="active" name="active" value="Yes" <?php if($active=='Yes'){ echo 'checked';} ?>>
                       <label for="vehicle1">Active</label>
                        </div>
                    </div>
                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">

                         <?php if($message=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" onclick="<?php echo base_url('index.php/scroll_text_messages/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('index.php/scroll_text_messages/add/'); ?>"       class="btn btn-success" /><?php } ?>

                                

                        
                         <a href="<?php echo base_url().'index.php/scroll_text_messages' ?>"     class="btn btn-danger" >Cancel</a></div></div>
                    
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
