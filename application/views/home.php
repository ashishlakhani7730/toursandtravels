<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Shakti Tours Travels | Home</title>
<meta charset="utf-8">
<meta name="keywords" content="Shakti Tours Travels, Travel Company India, Travel Company Gujarat, Travels Company Bhavnagar, Gujarat tour operator, Travel Agent in Bhavnagar, Travel Agency Gujarat, Tour operators Gujarat">
<meta name="description" content="'SHAKTI TOURS TRAVELS' 'SHAKTI TOURS TRAVELS' is a Leading Tour Operator and Travel Agent established in 2005 having an India Travel Agency">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo base_url(); ?>assets/images/shakti.jpg" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/shakti.jpg" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" type="text/css" media="screen">    
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/camera.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.ui.totop.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/camera.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mobile.customized.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.caroufredsel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	$(".travels").hide();
	$("#sucess").hide();
	$("#denger").hide();
	
	$("#mybutton").click(function(){
		$(".travels").show();
	}); 
	
	$("#contactbtn2").click(function(){
		$(".travels").hide();
	});
	
	setTimeout(function(){
		$(".travels").hide();
	}, 300000);
	// camera
	$('#camera_wrap').camera({
		//thumbnails: true
		autoAdvance			: true,		
		mobileAutoAdvance	: true,
		//fx					: 'simpleFade',
		height: '51%',
		hover: false,
		loader: 'none',
		navigation: true,
		navigationHover: false,
		mobileNavHover: false,
		playPause: false,
		pauseOnClick: false,
		pagination			: true,
		time: 7000,
		transPeriod: 1000,
		minHeight: '200px'
	});

	<?php if(!empty($records) && count($records) > 4) { ?>
	//	carouFredSel
	$('#slider3 .carousel.main ul').carouFredSel({
		auto: {
			timeoutDuration: 2000					
		},
		responsive: true,
		prev: '.prev3',
		next: '.next3',
		width: '100%',
		scroll: {
			items: 1,
			duration: 1000,
			easing: "easeOutExpo"
		},			
		items: {
        	width: '350',
			height: 'variable',	//	optionally resize item-height
			visible: {
				min: 1,
				max: 4
			}
		},
		mousewheel: false,
		swipe: {
			onMouse: true,
			onTouch: true
			}
	});
	$(window).bind("resize",updateSizes_vat).bind("load",updateSizes_vat);
	function updateSizes_vat(){		
		$('#slider3 .carousel.main ul').trigger("updateSizes");
	}
	updateSizes_vat();
	<?php } ?>
	
	$("#contactbtn").on('click',function(){
		if(!$("form[name='ajax-contact-form']").valid())
		{
			return false;
		}
		else
		{
			$.ajax({
				url: '<?php echo site_url('Home/getestimate'); ?>',
				type: 'post',
				dataType: 'json',
				data: $('form#ajax-contact-form').serialize(),
				success: function(json) {
					
					if(json.code == 1)
					{
						cleardata();
						$("#sucess").html('<strong>'+json.message+'</strong>');
						$("#sucess").show();
						setTimeout(function(){
							$("#sucess").hide();
							$(".travels").hide();
						}, 8000);
					}
					else if(json.code == 0)
					{
						cleardata();
						$("#denger").html('<strong>'+json.message+'</strong>');
						$("#denger").show();
						setTimeout(function(){
							$("#denger").hide();
						}, 5000);
					}
				}
			});
		}
	});
	
	$.validator.addMethod("regx1", function(value, element, regexpr) 
  	{          
    		return regexpr.test(value);
  	}, "Not Valid value...");	

	
	  $("form[name='ajax-contact-form']").validate({
	    onfocusout: function (element) {$(element).valid();},
	    rules: {
	      name: {
			  		required: true,
			  		regx1:  /^[A-z ]+$/,
			  		minlength: 3,
			  		maxlength: 30
		  },
	      phone: {
	        		required: true,
			  		regx1: /^((?!(0))[0-9]{10})$/,
	        		minlength: 10,
			  		maxlength: 10
	      },
		  content: {
					required: true,
	        		minlength: 10,
			  		maxlength: 1024
		  }
	    },
	    messages: {
	    	name:  {
		  				required: "!Please Enter Name",
			  			regx1: "!Enter Only Charecter",
						minlength: "!name minimum 3 Charecter",
						maxlength: "!name maximum 30 Charecter"
		  	},
			phone: {
						required: "!Please Enter Mobile No ",
						regx1: "!Please Enter Valid Mobile No Without 0",
						minlength:"!Please 10 Digit Mobile No",
						maxlength:"!Please 10 Digit Mobile No"
	      	},
			content: {
						required: "!Please Enter Message ",
						minlength:"!Please Enter Minimum 10 Charecters",
						maxlength:"!Please Enter Maximum 1024 Charecters"
			}
	    },
	    errorElement : 'div',
		errorPlacement: function(error, element) {
		  var placement = $(element).data('error');
		  if (placement) {
			$(placement).append(error)
		  } else {
			error.insertAfter(element);
		  }
		}
	  });
	  
	    function cleardata()
		{
			$("#inputName").val('');
			$("#inputPhone").val('');
			$("#inputMessage").val('');
		}
});
</script>
<?php require_once('header.php'); ?>
</head>
<body class="main">
<div id="main">
<?php require_once('navigationbar.php'); ?>
<div id="slider_wrapper">
	<div id="slider" class="clearfix">
		<div id="camera_wrap">
			<div data-src="<?php echo base_url(); ?>assets/pic/banner-5.jpg">    
			</div>
			
			<div data-src="<?php echo base_url(); ?>assets/pic/banner.jpg">    
			</div>
			
			<div data-src="<?php echo base_url(); ?>assets/pic/banner-1.jpg">    
			</div>

			<div data-src="<?php echo base_url(); ?>assets/pic/banner-2.jpg">
			</div>

			<div data-src="<?php echo base_url(); ?>assets/pic/banner-3.jpg">
			</div>
		</div>
	</div>
</div>
<div class="slogan1">
<div class="container">
<div class="row">
<div class="span2">
<img src="<?php echo base_url(); ?>assets/images/airline1.gif" alt="<?php echo SHAKTI_IMAGE_TAG; ?>">
</div>
<div class="span8">
<div class="slogan1_inner">
<div class="txt1">Start Your Trip With Us</div>	
<div class="txt2">Popular destinations and greate customer service</div>
<div class="txt3"></div>
<div class="txt4 clearfix" style="cursor:pointer"><a type="button" href="#content" id="mybutton" name="mybutton" class="find1">Estimate Request</a></div>
</div>	
</div>	
<div class="span2">
<img src="<?php echo base_url(); ?>assets/images/airline2.gif" alt="<?php echo SHAKTI_IMAGE_TAG; ?>" width="300px" height="30px">
</div>
</div>	
</div>	
</div>
<div id="content" class="travels hide">
<div class="container">
<div class="row">
<div class="span12">
<h2>
Estimate Request</h2>
<div id="sucess" class="alert alert-success">
			
</div>
		
<div id="denger" class="alert alert-danger">
  
</div>
<div id="note"></div>
<div id="fields">
	<form id="ajax-contact-form" name="ajax-contact-form" method="post" class="form-horizontal" action="">
		<div class="row">
			<div class="span6">
				<div class="control-group">
				    <label class="control-label" for="inputName">Your full name:</label>
				    <div class="controls">				      
				      <input class="span6" type="text" id="inputName" name="name" placeholder="Your full name:" >
				    </div>
				</div>				
			</div>			
			<div class="span6">
				<div class="control-group">
				    <label class="control-label" for="inputPhone">Mobile number:</label>
				    <div class="controls">				      
				      <input class="span6" type="text" id="inputPhone" name="phone" placeholder="Mobile number:" >
				    </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<div class="control-group">
				    <label class="control-label" for="inputMessage">Message:</label>
				    <div class="controls">				      				      
				      <textarea class="span12" id="inputMessage" name="content" placeholder="Message:I Want To Hire Full Bus What Is The Price? &#x0a;I Would Like To Start My Journey From ..."></textarea>
				    </div>
				</div>
			</div>
		</div>
		<button type="button" name="contactbtn" id="contactbtn" class="submit">Submit</button>
		<button type="button" name="contactbtn" id="contactbtn2" class="submit">Close</button>
	</form>
</div>	
</div>	
</div>
</div>
</div>
<?php if(!empty($records) && count($records) > 4) { ?>
<div id="slider3_wrapper">
<div class="container">
<div class="row">
<div class="span12">
<div id="slider3">
<div class="slider3-title">Destinations Services</div>	
<a class="prev3" href="#"></a>
<a class="next3" href="#"></a>	
<div class="carousel-box row">
	<div class="inner span12">			
		<div class="carousel main">
			<ul>
				<?php foreach($records as $r) { ?>
				<li>
					<div class="thumb-carousel banner1">
						<div class="thumbnail clearfix">
							<a href="#">
								<figure>
									<img src="<?php echo base_url().$r->image; ?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>">
									<em></em>
								</figure>
								<div class="caption">
									<?php echo $r->city; ?>
								</div>								
							</a>								
						</div>
					</div>
				</li>
				<?php } ?>																							
			</ul>
		</div>
	</div>
</div>
</div>	
</div>	
</div>	
</div>	
</div>
<?php } ?>
<div id="content">
<div class="container">
<div class="row">
<div class="span9 clearfix">
<h1>Welcome to Shakti Tours & Travels</h1>
<h3>We are a full-service travel agency, catering to everyone from backpackers to luxury travelers. We love to share the beauty and culture of india with the world.We pride ourselves on our customer service and are available 24*7.</h3>
<h3>We are providing our satisfactory service to our customers. We arrange tours in many place in india of domestic, inbound & pilgrim tourists by taking under-consideration the desire & budget of a tourist.</h3>
<h3>We are know for our luxurious safe service at affordable rates. We provide quality comforts in 2X2, 2X1(56 seats) and sleeping luxurious, A/C & Non A/C. Coaches Services. We are always committed to customer’s safety and benefits. </h3>
<div class="thumb1">
	<div class="thumbnail clearfix">
		<figure class="img-polaroid"><img src="<?php echo base_url(); ?>assets/pic/bus.jpg" alt="<?php echo SHAKTI_IMAGE_TAG; ?>"></figure>
		<figure class="img-polaroid"><img src="<?php echo base_url(); ?>assets/pic/bus-2.jpg" alt="<?php echo SHAKTI_IMAGE_TAG; ?>"></figure>
		<div class="caption">
			<p>
				
			</p>
		</div>
	</div>
</div>
</div>
<div class="span3">
<h2>We Arrange Tour</h2>
<ul class="ul1">
  <li><a >College / School Tour</a></li>
  <li><a >Family Tour</a></li>
  <li><a >Group Tour</a></li>
  <li><a >Couple Tour</a></li>
  <li><a >Individual Tour</a></li>	
  <li><a >Corporate Tour</a></li>
  <li><a >International & Domestic Tour</a></li>
  <li><a >Marriage Function Also...</a></li>  
</ul>
<h2>By Transportation</h2>
<ul class="ul1">
  <li><a >Bus</a></li>
  <li><a >Train</a></li>
  <li><a >Airplane</a></li>  
</ul>
</div>	
</div>	
</div>	
</div>
<?php require_once('footer.php'); ?>