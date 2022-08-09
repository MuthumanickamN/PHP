<?php //require_once 'config.php'; ?> 
<?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title>Activity Level</title>
</head>

<script type="text/javascript">
     $(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });

     function allLetter(inputtxt)
      { 
      var letters = /^[A-Za-z ']*$/;
      if(inputtxt.value.match(letters)) { return true; }
      else      { alert('Please input alphabet characters only');
       document.getElementById("level").value="";
        
      return false;
      }
    }

   function limit()
{
  var level = document.getElementById('level').value
  if(level.length>25  )
  {
    alert("Activity Must be Below Twenty Five Digits Only");
     document.getElementById("level").value="";
  } 
}
 function limits()
{
  var session = document.getElementById('session').value
  if(session.length>25  )
  {
    alert("Activity Must be Below Twenty Five Digits Only");
     document.getElementById("session").value="";
  } 
}
</script>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

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
                  <li class="breadcrumb-item"><a href="#">Activity Level</a>
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
            <li><a href="<?php echo site_url('index.php/activity_level'); ?>" class="btn btn-primary"   ><b>Activity Level List</b></a></li>
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
                    <h4 class="card-title">Activity Level</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <div  class="mainbox col-sm-12">
                      <div class="panel panel-info">
          <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px; margin-right: 5px">
           <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Activity Level</strong>*</div>
                        <div class="col-md-3 control text-left">
                        <input type="text" id="level" name="level" required="" oninput="allLetter(document.form.level); limit()" class="form-control" value="<?php echo $level; ?>">
                        </div>
                    </div>
                    <div class="form-group lg">
                        <div class="col-md-3 control text-left"><strong>Classes</strong><abbr title="required">*</div>
                        <div class="col-md-3 control text-left">     
                         <input type="text" id="session" name="session" required="" class="form-control" value="<?php echo $session; ?>" oninput="limits()">
                        </div>
                    </div>

                   
                
                     <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">
                         <?php if($session=="") { ?>
                         <input id="save" type="submit" name="submit" value="Submit" class="btn btn-secondary" onclick="<?php echo base_url('index.php/activity_level/add/'); ?>"       class="btn btn-success" /> 
                       <?php } else { ?>
                          
                                     <input id="save" type="submit" name="submit" value="Update" class="btn btn-secondary" onclick="<?php echo base_url('index.php/activity_level/add/'); ?>"       class="btn btn-success" /><?php } ?>

                                 

                        
                         <a href="<?php echo base_url().'index.php/activity_level' ?>"     class="btn btn-secondary" >Cancel</a></div></div>
                    
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

