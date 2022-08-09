<?php  ?> <?php $this->load->view('includes/header3'); ?>
 <html>
 <body>
 <head>
  <title><?php echo ucfirst($from);?> Registration</title>
</head>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable({
        
        "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
    });

} );

 function view_coach(id)
{
    
    window.location='<?php echo site_url('Coach/view/'); ?>'+id; 

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
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<style rel="stylesheet" src="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"></style>

<style rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></style>
<style rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></style>
<style rel="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" ></style>
<style rel="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"></style>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<link href="font/glyphicons-halflings-regular.woff2">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>


<div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 500px;" class="row">
            <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?></div>
<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green">Head Coach Credentials</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Head Coach Credentials</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#"></a>
                  </li>
                 
                </ol>
              </div>
            </div>
          </div>
        </div>
		
	<style>
        .star{
          color: goldenrod;
          font-size: 2.0rem;
          padding: 0 1rem; /* space out the stars */
        }
        .star::before{
          content: '\2606';    /* star outline */
          /*cursor: pointer;*/
        }
        .star.rated::before{
          /* the style for a selected star */
          content: '\2605';  /* filled star */
        }
        
        .stars{
            counter-reset: rateme 0;   
            font-size: 2.0rem;
            font-weight: 900;
        }
        .star.rated{
            counter-increment: rateme 1;
        }
        .stars::after{
            /*content: counter(rateme) '/5';*/
        }
		
		.div_class
		{
			height:34px;
		}
		.img-responsive{
			position: relative;
			left: 25%;
		}
    </style>		
       <div class="content-body"><!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
<?php

	if(!empty($coach_profile))
	{
		if(!empty($coach_profile['user_name']))
		{
			$coach_name = $coach_profile['user_name'];
		}
		else
		{
			$coach_name = "";
		}
		
		if(!empty($coach_profile['user_id']))
		{
			$coach_id = $coach_profile['user_id'];
		}
		else
		{
			$coach_id = "";
		}
		
	}
	
	
	
?>

			  <?php 
					$one_star = 0;
					$two_star = 0;
					$three_star = 0;
					$four_star = 0;
					$five_star = 0;
					$review_count = 0;
					$overall_star_count = 0;
					$count = 1;
					
					$overall_count = 0;
					foreach($review_detail as $values)
					{
						
						if($values['star_count']==1)
						{
							$one_star=$one_star+1;
						}
						if($values['star_count']==2)
						{
							$two_star=$two_star+1;
						}
						if($values['star_count']==3)
						{
							$three_star=$three_star+1;
						}
						if($values['star_count']==4)
						{
							$four_star=$four_star+1;
						}
						if($values['star_count']==5)
						{
							$five_star=$five_star+1;
						}
						
						$review_count = $review_count+1;
						
						$overall_star_count += $values['star_count'];
						
								
						$overall_count = $count++;
					}
					
					if($overall_star_count !=0)
					{
						$coach_review = $overall_star_count/$overall_count;
						$round_value_review = round($coach_review);
					}
			  ?>
			  

<!-- #################(For Coaches AND HeadCoach)################## -->



 <table id="shivar_assign_coach_table" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            
            <th style="text-align:center;">S.no</th>
            <th style="text-align:center;">Coach</th>
            <th style="text-align:center;">Student Name</th>
            <th style="text-align:center;">Rating & Review</th>
            <!-- <th style="text-align:center;">View</th> -->

        </tr>
    </thead>
    <tbody>

      <tr>
		<td style="text-align:center;">1</td>
        <td style="text-align:center;">
           <div class="card">
            <img src="<?php echo base_url() ?>/images/img_avatar.png" alt="Avatar" width="200" height="200" class="img-responsive">
            <h4 style="text-align: center;"><b><?php echo $coach_name; ?></b></h4> 
            <p style="text-align: center;"><b>coach</b></p> 
         </div>
        </td>
		
         <td style="text-align:center;">
		 
		 <?php if($one_star!=0) {  ?>
			<div class="progress progress-striped div_class">
			 <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20.0%;">
				<span class="progress-type">1 Star</span>
				<span class="progress-completed"><?php echo $one_star; ?>-Student</span>
			 </div>
		  </div>
		 <?php } ?>
		 
		  <?php if($two_star!=0) {  ?>
			<div class="progress progress-striped div_class">
			 <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40.0%;">
				<span class="progress-type">2 Star</span>
				<span class="progress-completed"><?php echo $two_star; ?>-Student</span>
			 </div>
		  </div>
		 <?php } ?>	
		 
		 <?php if($three_star!=0) {  ?>
		  <div class="progress progress-striped div_class">
			 <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60.0%;">
				<span class="progress-type">3 Star</span>
				<span class="progress-completed"><?php echo $three_star; ?>-Student</span>
			 </div>
		  </div>
		<?php } ?>
		<?php if($four_star!=0) {  ?>		
		  <div class="progress progress-striped div_class">
			 <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80.0%;">
				<span class="progress-type">4 Star</span>
				<span class="progress-completed"><?php echo $four_star; ?>-Student</span>
			 </div>
		  </div>
		<?php } ?>	
		
		<?php if($five_star!=0) {  ?>
		 <div class="progress progress-striped div_class">
			 <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100.0%;">
				<span class="progress-type">5 Star</span>
				<span class="progress-completed"><?php echo $five_star; ?>-Student</span>
			 </div>
		  </div>
		<?php } ?>	
		<p><strong><?php  echo $review_count; ?> Customer Reviewed</strong></p>

		<td style="text-align:center;">

			<h3>Coach Star Rating</h3>

			<!-- <div class="stars" id="star_ratings" data-rating=""> -->
			
			<?php if($round_value_review==1){ ?>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<?php } ?>	
			
			<?php if($round_value_review==2){ ?>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<?php } ?>
			
			<?php if($round_value_review==3){ ?>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<?php } ?>
			
			
			<?php if($round_value_review==4){ ?>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star " data-star="">&nbsp;</span>
			<?php } ?>
			
			
			<?php if($round_value_review==5){ ?>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<span class="star rated" data-star="">&nbsp;</span>
			<?php } ?>
			
			
			<!-- </div> -->
			<br>
			<p><strong> <?php echo $round_value_review ?>.0 Out of 5 Stars</strong></p>
			<!-- <br> -->
			<br>
			<a href="<?php echo base_url() ?>/Rating/rating_review_detail/<?php echo $coach_id; ?>" style="color:white;text-decoration:none" type="button" class="btn btn-success rating_review_submit" id="rating_review_submit" data-id=""><i class="fa fa-pencil-square-o" aria-hidden="true"> View</i></a>
		</td>

        
      </tr>
    </tbody>

</table>







  

   




<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);

}

.container {
  padding: 2px 16px;
}
</style>

 <style>
        .star{
          color: goldenrod;
          font-size: 2.0rem;
          padding: 0 1rem; /* space out the stars */
        }
        .star::before{
          content: '\2606';    /* star outline */
          /*cursor: pointer;*/
        }
        .star.rated::before{
          /* the style for a selected star */
          content: '\2605';  /* filled star */
        }
        
        .stars{
            counter-reset: rateme 0;   
            font-size: 2.0rem;
            font-weight: 900;
        }
        .star.rated{
            counter-increment: rateme 1;
        }
        .stars::after{
            /*content: counter(rateme) '/5';*/
        }
    </style>




</div>
</div>
</div>
</section>
</div>
</div>
</div>
</body>
</html>

