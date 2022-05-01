 <?php 

 $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Activity</title>
</head>
<script type="text/javascript">

 function view_games(game_id)
{
    
    window.location='<?php echo site_url('games/view/'); ?>'+game_id; 

}
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
<script type="text/javascript">
   $(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });
          
</script>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


<script type="text/javascript" src="<?php echo base_url().'assets/datatable.min.js' ?>"></script>

<script type="text/javascript" src="<?php echo base_url().'assets/datatable-styling.min.js' ?>"></script>



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
                  <li class="breadcrumb-item"><a href="#">Activity</a>
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
            <li> <a href="<?php echo site_url('Games/add/'); ?>" class="btn btn-primary"   ><b>New Activity</b></a></li>
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
                    <h4 class="card-title">Activity List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
              <div class="card-content collapse show">
          <div class="card-body card-dashboard">
          
            <div class="table-responsive">
              <table class="table table-striped table-bordered base-style" id="empTable">
                                <thead>
                                    <tr>
                                       <th style="text-align: center">S.No</th>
                                         <th style="text-align: left">Activity</th>
                                        <th style="text-align: center">Activity Code</th>
                                        <th style="text-align: center;">Created At</th>
                                        <!--<th style="text-align: center;">Updated At</th>
                                         <th style="text-align: center" >View</th>-->
                                            <th style="text-align: center">Edit</th>
                                            <th style="text-align: center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php       $i=1;                  
                            $osql1 = "SELECT * FROM games ORDER BY game_id DESC";                              
                            $query = $this->db->query($osql1);
                             foreach ( $query->result_array() as $key => $row1 ){  
                                 $date_time=$row1['created_at'];
                             $date_time1=$row1['updated_at'];?>
            <tr>

                <td style="text-align: center"><?php echo $i;  ?></td>
                <td style="text-align: left"><?php echo $row1['game']; ?></td>
                <td style="text-align: center"><?php echo $row1['game_code']; ?></td>
                <td style="text-align: center;"><span style="display:none;"><?php echo strtotime("$date_time"); ?></span><?php echo date("d/m/Y H:i:s", strtotime("$date_time")); ?></td>
               <!-- <td style="text-align: center;">
                    <?php if($date_time1=='0000-00-00 00:00:00') { echo '-'; } else{ echo date("d/m/Y H:i:s", strtotime("$date_time1")); } ?>
                </td>

                

                  <td align="center"><a type="button" style="color:white;text-decoration:none" onClick="view_games(<?php echo $row1['game_id'];?>)" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>-->
                <td style="text-align: center; line-height: 8px"><a type="button" style="color:white;text-decoration:none;" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('games/edit/'.$row1['game_id']); ?>">
        </a>
                    </td>

                <td align="center">
                    <a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip"  href="<?php echo base_url('games/delete/'.$row1['game_id']); ?>">
        </a>
                  </td>
              
                
            </tr>
            <?php  $i++; } ?>
                             
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
