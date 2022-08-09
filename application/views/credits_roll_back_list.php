<?php ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Credits Roll Back</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );

 function view_prepaid_credits(id)
{
    
    window.location='<?php echo site_url('Credits_roll_back/view/'); ?>'+id; 

}
  $(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });
</script>
<style type="text/css">

    .btn2
    {
        color: black;
        background-color: white;

    }
</style>
<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 600px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
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
            <li> <a href="<?php echo site_url('Credits_roll_back'); ?>" class="btn btn-primary"   ><b>New Roll Back</b></a></li>
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
                    <h4 class="card-title">Credits Roll Back</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr> 
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">PSA ID</th>
                                        <th style="text-align: center">Parent Name</th>
                                        
                                        <th style="text-align: center">Balance Credits</th>
                                        
                                        <th style="text-align: center">Total Credits</th>
                                        <th style="text-align: center">Description</th>
                                        <th style="text-align: center">Rollback Amount</th>
                                                                          
                                        <th style="text-align: center">Created At</th>
                                        <th style="text-align: center">Created By</th>
                                                    
                                        
                                        <!--<th style="text-align: center">EDIT</th>
                                        <th style="text-align: center">DELETE</th> -->
                                           
                
                                    </tr>
                                </thead>
                                <tbody>
                                <?php                        
                        
                             foreach ( $list as $key => $row1){  



                             $date_time=$row1['created_at'];
                             
                      
                             ?>
            <tr>

              <td style="text-align: center"><?php echo $key+1; ?></td>
              <td style="text-align: center"><?php echo $row1['parent_code']; ?></td>
              <td style="text-align: center"><?php echo $row1['parent_name']; ?></td>
              <td align="right"><?php echo $row1['balance_credits'];  ?></td>
              
              <td style="text-align: right"> <?php echo $row1['total_credits']; ?></td>
              <td style="text-align: center"><?php echo $row1['description']; ?></td>
              <td style="text-align: right"> <?php echo $row1['rollback_amount']; ?></td>
              

              <td style="text-align: center"><span style="display:none;"><?php echo strtotime("$date_time"); ?></span><?php echo date("d/m/Y H:i", strtotime("$date_time")); ?></td>
              <td style="text-align: center"> <?php echo $row1['updated_by_name']; ?></td>
               
                <!--<td style="text-align: center"><a type="button" style="color:white;text-decoration:none; line-height: 15px" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('Credits_roll_back/edit/'.$row1['id']); ?>">
                </a>
              </td>

              <td style="text-align: center">
                <a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none; line-height: 15px;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip"  href="<?php echo base_url('Credits_roll_back/delete/'.$row1['id']); ?>">
                </a>
              </td>-->



                 
  </tr>
            <?php } ?>
            
                                    
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




