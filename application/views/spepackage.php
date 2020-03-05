<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Shakti Tours Travels | Special package</title>
<meta charset="utf-8">
<meta name="keywords" content="Shakti Tours Travels, Travel Company India, Travel Company Gujarat, Travels Company Bhavnagar, Gujarat tour operator, Travel Agent in Bhavnagar, Travel Agency Gujarat, Tour operators Gujarat">
<meta name="description" content="'SHAKTI TOURS TRAVELS' 'SHAKTI TOURS TRAVELS' is a Leading Tour Operator and Travel Agent established in 2005 having an India Travel Agency">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo base_url(); ?>assets/images/shakti.jpg" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/shakti.jpg" type="image/x-icon" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" type="text/css" media="screen">    
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/touchTouch.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/isotope.css" type="text/css" media="screen">     
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" media="screen">

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/superfish.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.ui.totop.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/touchTouch.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.isotope.min.js"></script>

<script>
$(window).load(function() {
	// isotop
	var $container = $('#isotope-items'),
		$optionSet = $('#isotope-options'), 
	    $optionSets = $('#isotope-filters'), 
	    $optionLinks = $optionSets.find('a'); 
    $container.isotope({ 
        filter: '*',
        layoutMode: 'fitRows'
    });  
   	$optionLinks.click(function(){ 
   		var $this = $(this); 
    	// don't proceed if already selected 
		if ( $this.hasClass('selected') ) { 
			return false; 
		}    		
   		$optionSet.find('.selected').removeClass('selected'); 
   		$this.addClass('selected');

        var selector = $(this).attr('data-filter'); 
        $container.isotope({ 
            filter: selector            
        }); 
      	return false; 
    });    	
	$(window).on("resize", function( event ) {	
		$container.isotope('reLayout');		
	});		

	// touchTouch
	$('.thumb-isotope2 .thumbnail a').touchTouch();

});
</script>	
<?php require_once('header.php'); ?>
</head>
<body class="subpage">
<div id="main">

<?php require_once('navigationbar.php'); ?>

<div id="slider_wrapper">
<div class="img"><img src="<?php echo base_url()."assets/pic/bannerimg.png";?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>"></div>
<img src="<?php echo base_url()."assets/images/camera_grad1.png"; ?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>" class="grad2">
<div class="slider_bot">
<div class="page_title">Special Packages</div>
<div class="breadcrumbs1">
<div class="breadcrumbs1_inner"><a href="<?php echo base_url(); ?>">Home Page</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;Specialpackage<?php if($this->uri->segment(1) == 'spe-dom-package') { ?>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;Special Domestic Package <?php } else if($this->uri->segment(1) == 'spe-int-package') { ?>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;Special International Package<?php } ?></div>	
</div>
</div>
</div>

<div id="content">
<div class="container">
<div class="row">
<div class="span12">
<?php if($this->uri->segment(1) == 'spe-dom-package') { ?>	
<h1>Special Domestic Package</h1>
<?php } else if($this->uri->segment(1) == 'spe-int-package') { ?>
<h1>Special International Package</h1>
<?php } ?>
<?php if(!empty($records)) { ?>
<ul class="thumbnails" id="isotope-items">	
	<?php foreach($records as $r) { ?>
    <li class="span3 isotope-element isotope-filter1">
		<div class="thumb-isotope2">
			<div class="thumbnail clearfix">
				<a href="<?php echo base_url().$r->pimage; ?>">
					<figure>
						<img src="<?php echo base_url().$r->pimage_thumb; ?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>"><em></em>
					</figure>
					<div class="caption">
						<div class="txt1"><?php echo $r->pname; ?></div>							
					</div>
				</a>				
			</div>
		</div>
    </li>    
	<?php } ?>
</ul>
<?php } else { ?>

<h1>No Any Special Package Back Soon...</h1>

<?php } ?>
</div>
</div>	
</div>	
</div>
<?php require_once('footer.php'); ?>