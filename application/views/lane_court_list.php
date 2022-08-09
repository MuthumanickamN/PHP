<?php //require_once 'config.php'; ?>
 <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Lane/Court</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
    
 function view_lane_court(id)
{
    window.location='<?php echo site_url('lane_court/view/'); ?>'+id; 

}
  $(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });
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
            height: 50px;line-height: 45px; width: 300px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
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
                  <li class="breadcrumb-item"><a href="#">Lane/Court</a>
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
            <li> <a href="<?php echo site_url('index.php/lane_court/add/'); ?>" class="btn btn-primary"   ><b>New Lane/Court</b></a></li>
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
                    <h4 class="card-title">Lane/Court List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>

                                <!--<th style="text-align: center">S.No</th>-->
                                <th style="text-align: center">Lane/Court</th>
                                <!--<th style="text-align: center">Created At</th>
                                <th style="text-align: center">Updated At</th>
                                  <th style="text-align: center">View</th>-->
                                            <th style="text-align: center">Edit</th>
                                            <th style="text-align: center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php                     
                                                        
                           foreach($list as $key => $row1){  $i = $key+1; ?>
            <tr>
              <!--<td style="text-align: center"><?php   echo $i;  ?></td>-->
                <td style="text-align: center"><?php echo $row1['lane_court']; ?></td>
                <!--<td style="text-align: center"><?php echo date("d/m/y-h-i-s", strtotime("$date_time")); ?></td>
                <td style="text-align: center;"><?php if($date_time1=='0000-00-00 00:00:00') { echo '-'; } else  { echo date("d/m/y-h-i-s", strtotime("$date_time1")); } ?></td>


                <td style="text-align: center"><a type="button" style="color:white;text-decoration:none" onClick="view_lane_court(<?php echo $row1['id'];?>)" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">-->
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                <td style="text-align: center"><a type="button" style="color:white;text-decoration:none; line-height: 15px" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('lane_court/edit/'.$row1['id']); ?>">
        </a>
                    </td>

                <td style="text-align: center">
                    <a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none; line-height: 15px;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip"  href="<?php echo base_url('lane_court/delete/'.$row1['id']); ?>">
        </a>
                  </td>

                 



              
            </tr>
            <?php $i++; } ?>
                                    
                                </tbody>
                              
                            </table>
                        </div>
                    </div>
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


