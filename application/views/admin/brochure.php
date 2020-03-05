<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Shakti Tours Travels | Brochure</title>
<meta charset="utf-8">
<meta name="keywords" content="Shakti Tours Travels, Travel Company India, Travel Company Gujarat, Travels Company Bhavnagar, Gujarat tour operator, Travel Agent in Bhavnagar, Travel Agency Gujarat, Tour operators Gujarat">
<meta name="description" content="'SHAKTI TOURS TRAVELS' 'SHAKTI TOURS TRAVELS' is a Leading Tour Operator and Travel Agent established in 2005 having an India Travel Agency">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" type="text/css" media="screen">    
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/superfish.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.ui.totop.js"></script>
<?php require_once('header.php'); ?>
</head>
<body class="subpage">
<div id="main">
<?php require_once('navigationbar.php'); ?>
<div id="slider_wrapper">
<div class="img"><img src="<?php echo base_url(); ?>assets/pic/brochure.jpg" alt="<?php echo SHAKTI_IMAGE_TAG; ?>"></div>
<img src="<?php echo base_url(); ?>assets/images/camera_grad1.png" alt="<?php echo SHAKTI_IMAGE_TAG; ?>" class="grad2">
<div class="slider_bot">
<div class="page_title">Brochure</div>
<div class="breadcrumbs1">
<div class="breadcrumbs1_inner"><a href="<?php echo base_url(); ?>">Home Page</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;Brochure</div>	
</div>
</div>
</div>
<div id="content2">
<div class="container">
<?php if(!empty($records)) { ?>
<div class="row">
<div class="span12">
<h1>E-Brochure</h1>
</div>
<?php foreach($records as $r) { ?>
<div class="span4">
  <div class="w3-panel w3-card-4 cards"><p><b>Package -<?php echo " ".$r->btitel; ?></b></p><p>Date - <?php if($r->date != ''){ echo $r->date; } else { echo ""; } ?></p><p class="text-center clearfix"><a href="<?php echo $r->bgoogleid; ?>" type="button" target="_blank" role="button" class="btn btn-primary">View / Download</a></p></div>
</div>
<?php } ?>

<?php } else { ?>
<div class="row">
<div class="span12">
<h1>E-Brochure</h1>
<h2>No Any Brochure Back Soon...</h2>
</div>
<?php } ?>
</div>
</div>	
</div>	
</div>
</div>	
</div>
<?php require_once('footer.php'); ?>