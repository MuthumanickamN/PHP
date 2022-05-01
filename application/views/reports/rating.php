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
<div class="mainbox col-sm-12">
<div class="panel panel-info">
<table id="ratingTable" class="table table-bordered small">
<thead>
<tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">Rating status</th>
    <th scope="col">Overall rating status</th>
</tr>
</thead>
<tbody>
<?php if(isset($coachListArray)){
    $i =1;
    foreach ($coachListArray as $coach) { ?>
<tr>
    <td><?php echo $i;?></td>
    <td>
        <div class="img_div">
        <?php 
        if($coach['passport_size_image'] != ''){
        $imagePath =  base_url().'assets/Coach_images/1/1'.$coach['passport_size_image'];
        }else{
        $imagePath =  base_url().'assets/Coach_images/img_avatar.png';
        }
        ?>
        <img src="<?php echo $imagePath;?>">
        <div class="nameDiv">
            <h4><?php echo $coach['coach_name'];?></h4>
            <h5><?php echo $coach['role'];?></h5>
        </div>
    </div>

    </td>
    <td>
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $coach['5_star'];?>%" aria-valuenow="<?php echo $coach['5_star'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo $coach['5_star'];?></div>
            </div>
            <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $coach['4_star'];?>%" aria-valuenow="<?php echo $coach['4_star'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo $coach['4_star'];?></div>
            </div>
            <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $coach['3_star'];?>%" aria-valuenow="<?php echo $coach['3_star'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo $coach['3_star'];?></div>
            </div>
            <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $coach['2_star'];?>%" aria-valuenow="<?php echo $coach['2_star'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo $coach['2_star'];?></div>
            </div>
            <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: <?php echo $coach['1_star'];?>%" aria-valuenow="<?php echo $coach['1_star'];?>" aria-valuemin="0" aria-valuemax="100"><?php echo $coach['1_star'];?></div>
            </div>
            <h5><?php echo $coach['total_count'];?> Customer Reviewed</h5>
    </td>
    <td class="ratingdiv">
        <h3>Coach star Rating</h3>
        <div class="jstars" data-value="<?php echo ($coach['average']!=0)?$coach['average']:'-1';?>" data-color="#FDE16D" data-size="50px" ></div>
        <h5><?php echo ($coach['average']!=0)?$coach['average']:'0';?> Out of 5 Stars</h5>

    </td>

</tr>
<?php $i++; }
    }
    ?>
</tbody>
</table>
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

