<?php $this->load->view('includes/header3'); ?>

<style>
.img_div {
border: 1px solid #ccc;
margin: auto;
width: 200px;
text-align: center;
}

.img_div img {
width: 100%;
}

.nameDiv {
padding: 12px;
text-align: center;
font-weight: bold;
}
th, tr{
    text-align: center;
}
.nameDiv h4{font-weight: bold;}
.progress-bar{color: #000;}
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
<li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Home</a></li>
<li class="breadcrumb-item"><a href="#"><?php echo $title;?></a></li>
</ol>
</div>
</div>
</div>

</div>
<div class="col-lg-12"><span id="success-msg"></span></div>
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


<?php


if(!empty($result_row[0]))
{
	
	if(!empty($result_row[0]['passport_size_image']))
	{
		$photo_image = $result_row[0]['passport_size_image'];
	}
	else
	{
		$photo_image = "";
	}	
	
	if(!empty($result_row[0]['passport_size_image']))
	{
		$photo_image = $result_row[0]['passport_size_image'];
	}
	else
	{
		$photo_image = "";
	}
	
	if(!empty($result_row[0]['coach_name']))
	{
		$coach_name = $result_row[0]['coach_name'];
	}
	else
	{
		$coach_name = "";
	}
	
	if(!empty($result_row[0]['user_id']))
	{
		$coach_user_id = $result_row[0]['user_id'];
	}
	else
	{
		$coach_user_id = "";
	}
	
	

}





?>


<!-- <h3><b>Activity:</b> Swimming</h3> -->
<div class="col-sm-5">
<div class="card">
<?php
if(empty($photo_image))
{
?>
  <img src="<?php echo base_url();?>/assets_booking/images/user_image.jpg" alt="Avatar" width="180" style="text-align:center">
<?php } ?>
  <!-- <div class="container"> -->
    <br>
    <h4 style="" id="rating_review_coach_id" data-coach-id=""><b><?php echo $coach_name; ?></b></h4> 
    <p></p> 
  <!-- </div> -->
</div>
</div>




<div class="col-sm-5">
<h2>Coach Star Rating </h2>
 <div class="rating"></div>
<textarea rows="4" cols="50" class="form-control" id="coach_review" name="coach_review" required> </textarea>
<br>
<div class="row">
<input type="hidden" value="" id="h_rating" name="h_rating" >
<input type="hidden" value="<?php echo $psa_id; ?>" id="h_parent_id" name="h_parent_id" >
<input type="hidden" value="<?php echo $activity_id; ?>" id="h_activity_id" name="h_activity_id" >
<input type="hidden" value="<?php echo $coach_user_id; ?>" id="h_coach_id" name="h_coach_id" >
<a type="reset" class="btn btn-danger" id="rating_review_cancel"><i class="fa fa-times" aria-hidden="true"> Cancel</i></a>
<a type="button" class="btn btn-success rating_review_submit" id="rating_review_submit"><i class="fa fa-pencil-square-o" aria-hidden="true"> Submit</i></a>
</div>        

      
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

<?php
$this->load->view('templates/footer');

?>
<script>
var base_url = "<?php echo base_url(); ?>";
$('.rating').starRating(
{
	starSize: 1.5,
	showInfo: true
});

$(document).on('change', '.rating',
	function (e, stars, index) {
	//alert(`Thx for ${stars} stars!`);
	//console.log(stars);
	$("#h_rating").val(stars);
});

jQuery(document).on('click', '#rating_review_submit', function(){
    
	var coach_id = $("#h_coach_id").val();
	var activity_id = $("#h_activity_id").val();
	var parent_id = $("#h_parent_id").val();
	var coach_review = $("#coach_review").val();
	var star_rating = $("#h_rating").val();
	
    jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/Rating/rating_review_submit',
        data:{coach_id: coach_id,activity_id: activity_id,parent_id: parent_id,coach_review:coach_review,star_rating:star_rating},
        dataType:'json',  
        success: function (data) {
			if(data==1)
			{
				window.location.href="<?php echo base_url();?>Active_kids";
			}
			else
			{
				alert("failed to save");
			}	
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

</script>
