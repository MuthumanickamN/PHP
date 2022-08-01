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
                  <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Reports</a></li>
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
                        <form action ="<?php echo base_url() . 'Attendance_book' ?>" id="attendanceBook" method="POST">
                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-lg-2">
                                <b>Date</b>
                                <input type="date" id="date" name="date" class="form-control" value="<?php echo $date;?>" placeholder="From date">
                            </div>
                            
                            <div class="col-lg-2">
                                <b>Activity</b>
                                <select class="form-control activity" id="activity_code" name="activity_code">
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
                                <select class="form-control location" id="location_idval" name="location_idval">
                                    <option value="">Select</option>
                                    <?php if(isset($locationList)){
                                        foreach ($locationList as $location) { ?>
                                            <option value="<?php echo $location['location_id'] ?>" <?php if(isset($location_idval) && $location['location_id']==$location_idval ){ echo 'selected';} ?>><?php echo $location['location']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <b>Level</b>
                                <select class="form-control level" id="gameLevelId" name="gameLevelId">
                                    <option value="">Select</option>
                                    <?php if(isset($levelList)){
                                        foreach ($levelList as $level) { ?>
                                            <option value="<?php echo $level['games_level_id'] ?>" <?php if(isset($gameLevelId) && $level['games_level_id']==$gameLevelId ){ echo 'selected';} ?>><?php echo $level['level']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                           
                      

                        </div>
                        <div class="row" style="margin-bottom: 20px">
                            <div class="col-lg-2">
                                <b>PSA ID</b>
                                <select class="form-control psa" id="parent_idval" name="parent_idval">
                                    <option value="">Select</option>
                                    <?php if(isset($parentList)){
                                        foreach ($parentList as $parent) { ?>
                                            <option value="<?php echo $parent['parent_id'] ?>" <?php if(isset($parent_idval) && $parent['parent_id']==$parent_idval ){ echo 'selected';} ?>><?php echo 'PSA00'.$parent['parent_id'].' - '.$parent['parent_name']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <b>Coach</b>
                                <select class="form-control coach" id="coach_idval" name="coach_idval">
                                    <option value="">Select</option>
                                    <?php if(isset($coachList)){
                                        foreach ($coachList as $coach) { ?>
                                            <option value="<?php echo $coach['coach_id'] ?>" <?php if(isset($coach_idval) && $coach['coach_id']==$coach_idval ){ echo 'selected';} ?>><?php echo $coach['coach_name']; ?></option>
                                        <?php }
                                    }?>
                                </select>
                            </div>
                            <?php $statusArr = array('Pending','Present','Absent'); ?>
                            <div class="col-lg-2">
                                <b>Status</b>
                                <select class="form-control status" id="status" name="status">
                                    <option value="">Select</option>
                                    <?php foreach ($statusArr as $val) { ?>
                                    <option value="<?php echo $val;?>" <?php if( $val==$status ){ echo 'selected';} ?> ><?php echo $val;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                             <div class="col-lg-2">
                                <button class="btn btn-secondary margin-top-20">Search</button>
                            </div>
                            
                        </div>
                    </form>
                    <form id="attendanceListForm" method="POST">
                        <input type="hidden" name="bulk_id" id="bulk_id" >

                        <div class="row changeStatusDiv">
                            <button  data-toggle="modal" data-target="#confirmModal" data-val="all" class="btn btn-secondary changeStatus"  title="Update Status">Change Status  </button>
                        </div>
                        <table id="attendanceList" class="table table-bordered table-hover small">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center">Check all<br>
                                        <input type="checkbox" id="checkall" name="checkall">
                                    </th>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">PSA ID</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Lane/Court</th>
                                    <th scope="col">Coach</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Attendance</th>
                                    <th scope="col">Signature</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($attendanceList)){
                                    $i=1;
                                    foreach ($attendanceList as $attendance) { 
                                    $date = $attendance['booked_date'];
                                    ?>
                                <tr>
                                    <td style="text-align: center">
                                        <input type="checkbox" data-val="<?php echo $attendance['slot_id'];?>" id="selectAttendance" value="<?php echo $attendance['slot_id'];?>" class="selectAttendance" name="attendance_id[<?php echo $attendance['slot_id'];?>]">
                                    </td>
                                    <td><?php echo $i++;?></td>
                                    <td><span style="display:none"><?php echo strtotime("$date");?></span><?php echo date("d/m/Y", strtotime("$date"));  ?></td>
                                    <td><?php echo $attendance['name'];?></td>
                                    <td><?php echo $attendance['parent_name'];?></td>
                                    <td><?php echo $attendance['parent_code'];?></td>
                                    <td><?php echo $attendance['activity_id'];?></td>
                                    <td><?php echo $attendance['location_id'];?></td>
                                    <td><?php echo $attendance['level_id'];?></td>
                                    <td><?php echo $attendance['from_time'].'-'.$attendance['to_time'];?></td>
                                    <td><?php echo $attendance['lane_court_id'];?></td>
                                    <td><?php echo $attendance['coach_id'];?></td>
                                    <td>
                                        <?php if($attendance['attendance'] == 'Pending'){
                                            $tag ='info';
                                            $setval = 'PENDING';
                                        }elseif($attendance['attendance'] == 'Present'){
                                            $tag ='success';
                                            $setval = 'PRESENT';
                                        }else{
                                            $tag ='danger';
                                            $setval = 'ABSENT';
                                        };?>
                                        <a class='badge2 badge-<?php echo $tag;?>' ><?php echo $setval;?>
                                        </a>
                                        
                                    </td>
                                    <td>
                                        <button  data-toggle="modal" data-target="#confirmModal" data-val="<?php echo $attendance['slot_id'];?>" class="btn btn-warning changeStatus"  title="Update Status">Status  </button>
                                    </td>
                                    <td>
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
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Update Status</h4>
                    <button type="button" class="close" onclick="clearForm()" data-dismiss="modal">&times;</button>
                </div>
              <form id="updateAttendance" name="updateAttendance" method="POST">
              <input type="hidden" name="attendance_id[]" id="id_val">
              <div class="modal-body" id="confirmMessage">     
              <div class="checkAlert" style="width:100%;"></div>           
                <div class="row margin-top-20" >
                  <div class="col-md-3 control text-left"><strong>Attendance</strong>*</div>
                  <div class="col-md-9 control text-left">     
                     <select id="attendance" name="attendance" class="form-control choiceChosen">
                      <option value="">Select</option>
                      <option value="Present" >Present</option>
                       <option value="Absent" >Absent</option>
                     </select>
                     <span class="attendanceErrorMsg errorMsg"></span>
                  </div>
              </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" onclick="updateRequest()">Submit</button>
                  <button type="button" class="btn btn-secondary"onclick="clearForm()"  data-dismiss="modal">Cancel</button>
              </div>
          </form>
        </div>
    </div>
</div>

<?php
$this->load->view('templates/footer');
?>
<script type="text/javascript">

jQuery(document).ready(function() {
    
    
    var dateVal = $('#date').val();
  var locationVal=$("#location_idval option:selected").text();
  var activityVal=$("#activity_code option:selected").text();
  if(dateVal =='Select')
  {
      dateVal = '';
  }
  if(locationVal =='Select')
  {
      locationVal = '';
  }
  if(activityVal =='Select')
  {
      activityVal = '';
  }
  
    var t = $('#attendanceList').DataTable( {
        
        dom: 'Bfrtip',
        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:nth-child(2)", nRow).html(iDisplayIndex +1);
               return nRow;
            },
        buttons: [
           
            { extend: 'print',
            className :"btn btn-secondary", 
            footer: true, 
            //messageTop: 'Attendance Book  '+dateVal+' '+locationVal+' '+activityVal,
            title: 'Attendance Report </br><p style="font-size:25px;"><strong>'+dateVal+'&nbsp;&nbsp;&nbsp;&nbsp;'+locationVal+'&nbsp;&nbsp;&nbsp;&nbsp;'+activityVal+'</strong></p>',
            exportOptions: {
                    columns: [ 1,3,4,9,14]
                    
                },
            customize: function ( win ) {
                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( 'font-size', '100%' );
            }
                
            },
            
        
        ],
        
            

     //$(function () { 
 
      //var t = $('#attendanceList').DataTable( {
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": true,              
      "pageLength": 25,
    });
    t.on( 'order.dt search.dt', function () {
        t.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();    
});




$("#checkall").click(function(){
    if(this.checked){
        $('.selectAttendance').each(function(){
            this.checked = true;
        })
    }else{
        $('.selectAttendance').each(function(){
            this.checked = false;
        })
    }
});
$(".selectAttendance").click(function(){
    if($(".selectAttendance").length == $(".selectAttendance:checked").length) {
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
    jQuery('form#updateAttendance').find('select, input').each(function () {
        jQuery(this).val('');
    });
}
function updateRequest(){
    id_value = $('#id_val').val();
    attendanceStatus = $('#attendance').val();
    if(attendanceStatus == ''){
        $('.attendanceErrorMsg').html('Please select Status');
    }else{
        if(id_value == 'all'){
            $('#bulk_id').val(id_value);
            var formData = jQuery("form#attendanceListForm").serialize();
        }else{
            var formData = jQuery("form#updateAttendance").serialize();
        }
            jQuery.ajax({
            type:'POST',
            url:baseurl+'Attendance_book/updateAttendance/'+attendanceStatus,
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
                    jQuery('form#updateAttendance').find('input, select').each(function () {
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
    }
    
   
</script>
<script type = 'text/javascript'>
$(document).ready(function(){
$('.activity').select2();
$('.location').select2();
$('.level').select2();
$('.psa').select2();
$('.coach').select2();
$('.status').select2();
});

</script>


