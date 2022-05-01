<?php require_once 'config.php'; ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Activity Based Location</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
    
 function view_location_based_games(id)
{
    window.location='<?php echo site_url('location_based_games/view/'); ?>'+id; 

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
    #header
    {
        background-color: #ba272d9e;
    background-image: #ba272d9e;
    text-shadow: #fff 0 1px 0;
    border: solid 1px #cdcdcd;
    border-color: #d4d4d4;
    border-top-color: #e6e6e6;
    border-right-color: #d4d4d4;
    border-bottom-color: #cdcdcd;
    border-left-color: #d4d4d4;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 0 1px #FFF inset;
    font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    box-sizing: border-box;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.37);
    display: table;
    border-bottom-color: #EEE;
    width: 100%;
    position: relative;
    margin: 0;
    padding: 10px 30px;
    z-index: 800;
    background-image: linear-gradient(180deg, #f5050f7a, #ba272d0d);
    color: white;
    }
</style>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 1000px;" class="row">
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
                  <li class="breadcrumb-item"><a href="#">Activity Based Location</a>
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
            <li> <a href="<?php echo site_url('location_based_games/add/'); ?>" class="btn btn-primary"   ><b>New Activity Based Location</b></a></li>
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
                    <h4 class="card-title">Activity Based Location List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr>  <th style="text-align: center">S.No</th>
                                         <th>Activity</th>
                                        <th>Location</th>
                                        <th style="text-align: center">Created At</th>
                                       <!-- <th style="text-align: center">Updated At</th>
                                          <th style="text-align: center">View</th> -->
                                            <th style="text-align: center">Edit</th>
                                            <th style="text-align: center">Delete</th>
                
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php        $i=1;                
                            $osql1 = "select * from location_based_games ORDER BY id DESC";                              
                            $oexe1 = $this->db->query($osql1 );
                             foreach ( $oexe1->result_array() as $key => $row1){ 
                             $date_time=$row1['created_at'];
                             $date_time1=$row1['updated_at'];
                            
                            $osql2 = "select * from locations where location_id=".$row1['location_id'];                              
                            $oexe2 = $this->db->query( $osql2 );
                            $row2 = $oexe2->row_array() ;

                            $osql3= "select * from games where game_id=".$row1['game_id'];                              
                            $oexe3 = $this->db->query( $osql3 );
                            $row3 = $oexe3->row_array() ;
                             ?>
            <tr>
                   <td style="text-align: center"><?php   echo $i;  ?></td>

                <td><?php echo $row3['game']; ?></td>
                <td><?php echo $row2['location']; ?></td>
                <td style="text-align: center"><span style="display:none;"><?php echo strtotime("$date_time"); ?></span><?php echo date("d/m/Y H:i:s", strtotime("$date_time")); ?></td>
                <!--<td style="text-align: center;"><?php if($date_time1=='0000-00-00 00:00:00') { echo '-'; } else  { echo date("d/m/y-h-i-s", strtotime("$date_time1")); } ?></td>


                 <td style="text-align: center"><a type="button" style="color:white;text-decoration:none" onClick="view_location_based_games(<?php echo $row1['id'];?>)" class="btn btn-info fa fa-eye" data-id="4" data-toggle="tooltip" title="View">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>-->
                <td style="text-align: center"><a type="button" style="color:white;text-decoration:none; line-height: 15px" class="btn btn-warning fa fa-edit" data-id="4" data-toggle="tooltip" title="Edit" href="<?php echo base_url('location_based_games/edit/'.$row1['id']); ?>">
        </a>
                    </td>

                <td style="text-align: center">
                    <a type="button" onClick="return confirm('Are you sure you want to delete?')" style="color:white;text-decoration:none; line-height: 15px;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip"  href="<?php echo base_url('location_based_games/delete/'.$row1['id']); ?>">
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
