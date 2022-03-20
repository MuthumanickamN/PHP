<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Credits Roll Back</title>
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
                  <li class="breadcrumb-item"><a href="#">Credits Roll Back</a>
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
            <li> <a href="<?php echo site_url('index.php/Credits_roll_back/list'); ?>" class="btn btn-primary"   ><b>Back</b></a></li>
          </ul>
                
              </div>
            </div>
          </div>
        </div>
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
         <div class="col-12 col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Credits Roll Back Details</h4>
       
      </div>
      <div class="card-content collapse show">
         <div class="table-responsive">
            <table class="table mb-0">
            
                <tr>
                  <th class="text-left">Parent-Id</th>
                   <td class="text-left"><?php echo $parent_id; ?></td>           </tr>
                <tr>
                  <th class="text-left">Parent Name</th>
                   <td class="text-left"><?php echo $name_id; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Mobile Number</th>
                   <td class="text-left"><?php echo $mobile_id; ?></td>           </tr>
                   <tr>
                  <th class="text-left">Email</th>
                   <td class="text-left"><?php echo $email_id; ?></td>           </tr>
                     <tr>
                  <th class="text-left">Roll Back Credits (AED)</th>
                   <td class="text-left"><?php echo $rollback_amount; ?>.00</td>           </tr>
                     <tr>
                  <th class="text-left">Balance Credits (AED)</th>
                   <td class="text-left"><?php echo $balance_credits; ?>.00</td>           </tr>
                     <tr>
                  <th class="text-left">Description</th>
                   <td class="text-left"><?php echo $description; ?></td>           </tr>
                   
                    <tr>
                  <th class="text-left">Updated By
                   <td class="text-left"><?php echo $updated_name; ?></td>           </tr>

                    <tr>
                  <th class="text-left">Updated Email</th>
                   <td class="text-left"><?php echo $updated_email; ?></td>           </tr>

                    <tr>
                  <th class="text-left">Admin Updated At</th>
                   <td class="text-left"><?php echo $updated_date; ?></td>           </tr>
                      
                     <tr>
                  <th class="text-left">Created At</th>
                   <td class="text-left"><?php echo echo date("d-m-y-h-i-s", strtotime("$created_at")); ?></td>           </tr>
                     <tr>
                  <th class="text-left">Updated At</th>
                    <td class="text-left"><?php if($updated_at=='0000-00-00 00:00:00') { echo '-'; } else  { echo date("d-m-y-h-i-s", strtotime("$updated_at")); } ?></td>          </tr>
                 
                   
            </table>
          </div>

                </div></div></div>





         
                  </div></section></div></div></div></body></html>





