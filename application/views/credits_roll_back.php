 <?php $this->load->view('includes/header3'); ?>
<style>
.select2-container {
    box-sizing: border-box;
    display: inline-block;
    margin: 0;
    position: relative;
    vertical-align: middle;
    text-align:left !important;
}
</style>

 <meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">

<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <style type="text/css">
    .limitedNumbChosen, .limitedNumbSelect2{
  width: 308px;
}
.choiceChosen, .productChosen {
  width: 308px ;
}


 </style>
<style>
#loading_image {
	position: fixed;
	left: 50%;
	top: 50%;
	height: 80px;
	display: flex;
	justify-content: center;
	align-items: center;
    background: rgba(0,0,0,0.6);
	z-index:100;
}
</style>
 <script>

   function allnumeric(inputtxt)
   {
      //var numbers = /^[0-9]+$/;
      var numbers = /^[0-9]*\.?[0-9]*$/;
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(numbers))
      {           return true;       }
       else       {
      alert('Please input numbers only');
      document.getElementById("roll_back_amount").value="";
      return false;       }
   }

    function parent_details()
{ 

  var parent_id=document.getElementById('parent_id').value;
  
$.ajax({
  
  url:"<?php echo base_url().'Credits_roll_back/payment/'; ?>",
  type:"POST",
  data:{parent_id:parent_id},
  success:function(data)
  {   
  document.getElementById('result123').innerHTML=data;
  
  }
});

}
function calculate_amount()
{
  var roll_back_amount=document.getElementById('roll_back_amount').value;
  var balance_credits=document.getElementById('balance_credits').value;

  var a=parseFloat((balance_credits)?balance_credits:0.00) - parseFloat((roll_back_amount)?roll_back_amount:0.00);
  document.getElementById('total_credits').value=parseFloat(a).toFixed(2);
}

    $(document).ready(function(){
      //Chosen
      $(".choiceChosen, .productChosen").chosen({});
      //Logic
      $(".choiceChosen").change(function(){
        if($(".choiceChosen option:selected").val()=="no"){
          $(".productChosen option[value='2']").attr('disabled',true).trigger("chosen:updated");
          $(".productChosen option[value='1']").removeAttr('disabled',true).trigger("chosen:updated");
        } else {
          $(".productChosen option[value='1']").attr('disabled',true).trigger("chosen:updated");
          $(".productChosen option[value='2']").removeAttr('disabled',true).trigger("chosen:updated");
        }
      })
    });

 </script>
<body>
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
                  <li class="breadcrumb-item"><a href="#">Prepaid Credits Roll Back</a>
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
            <li> <a href="<?php echo site_url('Credits_roll_back/list'); ?>" class="btn btn-primary"   ><b>Roll back List</b></a></li>
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
                    <h4 class="card-title">Prepaid Credits Roll Back</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
    <form id="loginForm" class="form-horizontal" role="form" name="form" method="POST" style="margin-top: 25px; margin-left: 5px;">

         <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <strong>Parent ID/Mobile</strong>*
                              </div>                            
                    <div class="col-md-3 control text-right">
                    <select name="parent_id" id="parent_id" class="form-control parent_id"  required="" onchange="parent_details()">
                            <option value="0">Select</option>
                            <?php
                        
                          $osql = "select * from parent WHERE status='Active'";                              
                          $oexe = $this->db->query( $osql )->result_array();

    
                         foreach ( $oexe as $key => $row ){ ?>
                        <option data-code="<?php echo $row['parent_code'] ?>" value="<?php echo $row['parent_id'] ?>" <?php if($row['parent_id']==$parent_id ){ echo 'selected';} ?>><?php echo $row['parent_code']; ?>-<?php echo $row['mobile_no']; ?>
                              
                            </option><?php
                            
                             }  ?></select>
                        </div>
                    </div>

                    <div id="result123"></div>


                     <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <b>Roll Back Amount (AED)</b>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <input type="text" id="roll_back_amount" name="roll_back_amount" required=""  value="<?php echo $rollback_amount;  ?>" oninput="allnumeric(document.form.roll_back_amount); calculate_amount();"   class="form-control" >
                        </div>
                    </div>


                     <div class="form-group lg-btm">
                        <div class="col-md-2 control">
                                <b>Description</b>*
                              </div>                            
                        <div class="col-md-3 control text-right">
                          <textarea  id="description" name="description" required="" class="form-control"><?php echo $description; ?></textarea>
                        </div>
                    </div>

                      <div class="form-group lg-btm">
                      <div class="col-md-6 control text-center">

                         <?php if($id!="") { ?>

                           <input id="save" type="submit" name="submit" value="Update" onclick="<?php echo base_url('Credits_roll_back/edit/'.$id); ?>"       class="btn btn-success" />   
                         <?php } else { ?>

                          <input id="save" type="submit" name="submit" value="Submit" onclick="<?php echo base_url('Credits_roll_back/add/'); ?>"       class="btn btn-success" />          
<?php } ?>
                        
                         <a href="<?php echo base_url().'Credits_roll_back/' ?>"     class="btn btn-danger" >Cancel</a></div></div>

                </form>
                  
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

<?php $this->load->view('includes/footer_select2'); ?>
<script type="text/javascript">
  $( document ).ready(function() {
	 $('.parent_id').select2();
	 $('.head_coach_id').select2();
	 $('#discount_type').select2();

  });
    //parent_details();
    //calculate();

</script>