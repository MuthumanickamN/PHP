<?php require_once 'config.php'; ?>
 <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Event</title>
</head>
<script type="text/javascript">
function Validation()
{

var nowDate = new Date(); 
var n=nowDate.getMonth()+1;
if(n==10 || n==11 || n==12)
{
  var date = nowDate.getFullYear()+'-'+(nowDate.getMonth()+1)+'-'+nowDate.getDate(); 
}
else { 
var date = nowDate.getFullYear()+'-0'+(nowDate.getMonth()+1)+'-'+nowDate.getDate(); }


  var event_date1=document.getElementById('event_date').value;



 if(event_date1 < date)
{
alert("Please Select Future Date");

return false;
}
else if(event_date1 == date)
return true;
}

 function allLetter(inputtxt)
      { 
      var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
    
       document.getElementById("event_name").value="";
      
      return false;
      }
    }
       function allLetters(inputtxt)
      { 
      var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
    
      
       document.getElementById("event_place").value="";
      return false;
      }
    }
</script>


<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


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
                  <li class="breadcrumb-item"><a href="#">Events</a>
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
            <li><a href="<?php echo site_url('index.php/events'); ?>" class="btn btn-primary"   ><b>Events List</b></a></li>
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
                    <h4 class="card-title">Events</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
          <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Event Date</strong>*</div>
                        <div class="col-md-3 control text-left">
                       <input type="date"  name="event_date"   class="form-control" id="event_date" placeholder="<?php echo $date=date("d-m-Y"); ?>" required="" value="<?php echo $event_date;  ?>" >
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Event Name</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <textarea id="event_name" name="event_name" oninput="allLetter(document.form.event_name);"  value="" class="form-control" required="" ><?php echo $event_name; ?></textarea>
                        </div>
                    </div>

                     <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Event Place</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <textarea id="event_place" name="event_place" oninput="allLetters(document.form.event_place);"  value="" class="form-control" required="" placeholder=""><?php echo $event_place; ?></textarea>
                        </div>
                    </div>

                     <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Event Details</strong>*</div>
                        <div class="col-md-3 control text-left">     
                         <textarea id="event_detail" name="event_detail"  value="" class="form-control" required="" ><?php echo $event_detail; ?></textarea>
                        </div>
                    </div>


                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                         <?php if($event_detail=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" class="btn btn-secondary" onclick="return Validation()","<?php echo base_url('index.php/events/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" class="btn btn-secondary" onclick="<?php echo base_url('index.php/events/add/'); ?>"       class="btn btn-success" /><?php } ?>

                                  

                        
                         <a href="<?php echo base_url().'index.php/events' ?>"     class="btn btn-secondary" >Cancel</a></div></div>
                    
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

