<?php $this->load->view('includes/header3'); ?>

<style>
    .badge{font-size: 100% !important;}
    a.badge {color: #fff !important;}
    .changeStatusDiv{  margin:20px;  }
</style>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green"><?php echo $title;?></h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Academy Activities</a></li>
                  <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a></li>
                </ol>
              </div>
            </div>
        </div>
       
    </div>
<div class="content-body">
<!-- Zero configuration table -->
<section id="configuration">
<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $title;?></h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

        </div>
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="mainbox col-sm-12">
                    <div class="panel panel-info">
                        <form action ="<?php echo base_url() . 'Bulk_refund' ?>" id="attendanceBook" method="POST">
                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-lg-2">
                                <b>Date</b>
                                <input type="date" id="date" name="date" class="form-control" value="<?php echo $date;?>" placeholder="From date">
                            </div>
                            <div class="col-lg-2">
                                <b>Student</b>
                                <select class="form-control stud_name" id="stud_name" name="stud_name">
                                    <option value="">Select</option>
                                    <?php if(isset($studentList)){
                                        foreach ($studentList as $student) { ?>
                                            <option value="<?php echo $student['id'] ?>" <?php if(isset($stud_name) && $student['id']==$stud_name ){ echo 'selected';} ?>><?php echo $student['sid'].' / '.$student['name']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                           
                            <div class="col-lg-2">
                                <b>Activity</b>
                                <select class="form-control activity_code" id="activity_code" name="activity_code">
                                    <option value="">Select</option>
                                    <?php if(isset($activityList)){
                                        foreach ($activityList as $activity) { ?>
                                            <option value="<?php echo $activity['game_id'] ?>" <?php if(isset($activity_code) && $activity['game_id']==$activity_code ){ echo 'selected';} ?>><?php echo $activity['game']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
							
                             <div class="col-lg-2">
                                <b>Location</b>
                                <select class="form-control location_idval" id="location_idval" name="location_idval">
                                    <option value="">Select</option>
                                    <?php if(isset($locationList)){
                                        foreach ($locationList as $location) { ?>
                                            <option value="<?php echo $location['location_id'] ?>" <?php if(isset($location_idval) && $location['location_id']==$location_idval ){ echo 'selected';} ?>><?php echo $location['location']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 20px"><!---->
                            <div class="col-lg-2">
                                <b>Level</b>
                                <select class="form-control gameLevelId" id="gameLevelId" name="gameLevelId">
                                    <option value="">Select</option>
                                    <?php if(isset($levelList)){
                                        foreach ($levelList as $level) { ?>
                                            <option value="<?php echo $level['games_level_id'] ?>" <?php if(isset($gameLevelId) && $level['games_level_id']==$gameLevelId ){ echo 'selected';} ?>><?php echo $level['level']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <b>Coach</b>
                                <select class="form-control coach_idval" id="coach_idval" name="coach_idval">
                                    <option value="">Select</option>
                                    <?php if(isset($coachList)){
                                        foreach ($coachList as $coach) { ?>
                                            <option value="<?php echo $coach['coach_id'] ?>" <?php if(isset($coach_idval) && $coach['coach_id']==$coach_idval ){ echo 'selected';} ?>><?php echo $coach['coach_name']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-success margin-top-20">Search</button>
                            </div>
                            
                        </div>
                    </form>
                    <form id="refundListForm" method="POST">
                        <input type="hidden" name="bulk_id" id="bulk_id" >

                        <div class="row changeStatusDiv">
                            <button  data-toggle="modal" data-target="#confirmModal" data-val="all" class="btn btn-info changeStatus"  title="Update Status">Refund  </button>
                        </div>
                        <table id="refundList" class="table table-bordered table-hover small">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center">Check all<br>
                                        <input type="checkbox" id="checkall" name="checkall">
                                    </th>
                                   
                                    <th scope="col" style="text-align: center">Date</th>
                                    <th scope="col" style="text-align: center">Name</th>
                                    <th scope="col" style="text-align: center">PSA ID</th>
                                    <th scope="col" style="text-align: center">Activity</th>
                                    <th scope="col" style="text-align: center">Location</th>
                                    <th scope="col" style="text-align: center">Level</th>
                                    <th scope="col" style="text-align: center">Time</th>
                                    <th scope="col" style="text-align: center">Lane/Court</th>
                                    <th scope="col" style="text-align: center">Coach</th>
                                    <th scope="col" style="text-align: center">Attendance</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($refundList)){
                                    foreach ($refundList as $refund) { ?>
                                <tr>
                                    <td style="text-align: center">
                                        <input type="checkbox" data-val="<?php echo $refund['id'];?>" id="selectRefund" value="<?php echo $refund['id'];?>" class="selectRefund" name="refund_id[<?php echo $refund['id'];?>]">
                                    </td>
                                   
                                    <td style="text-align: center"><span style="display:none;"><?php echo strtotime($refund['booked_date']);?></span><?php echo date('d/m/Y', strtotime($refund['booked_date']));?></td>
                                    <td style="text-align: center"><?php echo $refund['name'];?></td>
                                    <td style="text-align: center"><?php echo $refund['sid'];?></td>
                                    <td style="text-align: center"><?php echo $refund['activity_id'];?></td>
                                    <td style="text-align: center"><?php echo $refund['location_id'];?></td>
                                    <td style="text-align: center"><?php echo $refund['level_id'];?></td>
                                    <td style="text-align: center"><?php echo $refund['from_time'].'-'.$refund['to_time'];?></td>
                                    <td style="text-align: center"><?php echo $refund['lane_court_id'];?></td>
                                    <td style="text-align: center"><?php echo $refund['coach_id'];?></td>
                                    <td style="text-align: center">
                                        <button  data-toggle="modal" data-target="#confirmModal" data-val="<?php echo $refund['id'];?>" class="btn btn-warning changeStatus"  title="Refund">Refund  </button>
                                    </td>
                                </tr>
                                <?php }
                                    }
                                    ?>
                            </tbody>
                            

                        </table>
                        </form>
                    </div>
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

<div class="modal fade rotate" id="confirmModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content panel panel-success">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Refund Slot</h4>
                    <button type="button" class="close" onclick="clearForm()" data-dismiss="modal">&times;</button>
                </div>
              <form id="updateRefund" name="updateRefund" method="POST">
              <input type="hidden" name="refund_id[]" id="id_val">
              <div class="modal-body row" id="confirmMessage">     
                  <div class="col-lg-6 alignCenter">
                    <button type="button" class="btn btn-success" onclick="updateRequest()">Submit</button>  
                  </div>
                  <div class="col-lg-6 alignCenter">
                    <button type="button" class="btn btn-danger"onclick="clearForm()"  data-dismiss="modal">Cancel</button>
                  </div>
              </div>
          </form>
        </div>
    </div>
</div>

<?php
$this->load->view('templates/footer');
?>

<script type="text/javascript">
$( document ).ready(function() {
	$('.stud_name').select2();
	$('.activity_code').select2();
	$('.location_idval').select2();
	$('.gameLevelId').select2();
	$('.coach_idval').select2();

});

$(function () { 
   var t = $('#refundList').DataTable( {
      /*"paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": true,              
      "pageLength": 25,*/
    });
     
});
$("#checkall").click(function(){
    if(this.checked){
        $('.selectRefund').each(function(){
            this.checked = true;
        })
    }else{
        $('.selectRefund').each(function(){
            this.checked = false;
        })
    }
});
$(".selectRefund").click(function(){
    if($(".selectRefund").length == $(".selectRefund:checked").length) {
        $("#checkall").prop("checked", true);
    } else {
        $("#checkall").prop("checked", false);
    }

});
$(".changeStatus").click(function(e){
    e.preventDefault();
    getval=$(this).attr('data-val');
    $('#id_val').val(getval);
});
function clearForm(){
    jQuery('form#updateRefund').find('select, input').each(function () {
        jQuery(this).val('');
    });
}
function updateRequest(){
    id_value = $('#id_val').val();

    if(id_value == 'all'){
        $('#bulk_id').val(id_value);
        var formData = jQuery("form#refundListForm").serialize();
    }else{
        var formData = jQuery("form#updateRefund").serialize();
    }
        jQuery.ajax({
        type:'POST',
        url:baseurl+'Bulk_refund/updateRefund/',
        data:formData,
        dataType:'json',    
             
        success: function (json) {
        $(".errorMsg").html('');
          if(json['error']){
            for (i in json['error']) {
            if(i == 'error_msg'){
                $('.checkAlert').html('<div class="alert alert-danger">'+json['error'][i]+'</div>')
              }
              var element = $('#'+ i);
              $(element).parent().find(".errorMsg").html(json['error'][i]);
            }
          }else{
              if(json['status']=='success'){
                jQuery('form#updateRefund').find('input, select').each(function () {
                    jQuery(this).val('');
                });
                  location.reload();
              }
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }          
        });
    }
   
</script>

