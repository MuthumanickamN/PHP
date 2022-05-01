<?php  ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>User Wallet Details</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
    
 function view_games_level(games_level_id)
{
    window.location='<?php echo site_url('activity_level/view/'); ?>'+games_level_id; 

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
                  <li class="breadcrumb-item"><a href="#">User Wallet Details</a>
                  </li>
                 
                </ol>
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
                    <h4 class="card-title">User Wallet Details</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>
                                           <th style="text-align: center">Parent-ID</th>
                                            <th style="text-align: center">Name</th>
                                            <th style="text-align: center">Mobile</th>
                                            <th style="text-align: center">Email-ID</th>
                                            <th style="text-align: center">Wallet Balance</th>
                                            <th style="text-align: center">Last Recharge On</th>
                                            <th style="text-align: center">Last Recharge For</th>
                                             <th style="text-align: center">Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php                      
                          $osql1 = "select pc.*,p.parent_code,p.parent_name,p.email_id,p.mobile_no from prepaid_credits pc left join parent p on p.parent_id=pc.parent_id";                              
                            $oexe1 = $this->db->query($osql1 )->result_array();
                             foreach ( $oexe1 as $key => $row1 ){  

                            

                            ?>

                            <tr>
                             <td style="text-align: center"><?php   echo $row1['parent_code'];  ?></td>
                             <td><?php echo $row1['parent_name']; ?></td>
                             <td style="text-align: center"><?php echo $row1['mobile_no']; ?></td>
                             <td style="text-align: center"><?php echo $row1['email_id']; ?></td>
                             <td style="text-align: center;"><?php echo $row1['balance_credits'];  ?></td>
                             <td style="text-align: center"><span style="display:none;"><?php echo strtotime($row1['created_at']); ?></span><?php echo date('d/m/Y H:i:s',strtotime($row1['created_at'])); ?></td>
                             <td style="text-align: center"><?php echo $row1['description']; ?></td>
                          

                              <td style="text-align: center"><a type="button" style="color:white;text-decoration:none; line-height: 15px" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('User_wallet_details/edit/'.$row1['id']); ?>">
                              </a>
                            </td>







                          </tr>
            <?php  } ?>
            
                                    
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

