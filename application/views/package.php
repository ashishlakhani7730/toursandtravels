<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Shakti Tours Travels | Package</title>
<meta charset="utf-8">
<meta name="keywords" content="Shakti Tours Travels, Travel Company India, Travel Company Gujarat, Travels Company Bhavnagar, Gujarat tour operator, Travel Agent in Bhavnagar, Travel Agency Gujarat, Tour operators Gujarat">
<meta name="description" content="'SHAKTI TOURS TRAVELS' 'SHAKTI TOURS TRAVELS' is a Leading Tour Operator and Travel Agent established in 2005 having an India Travel Agency">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo base_url(); ?>assets/images/shakti.jpg" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/shakti.jpg" type="image/x-icon" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" type="text/css" media="screen">    
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/package.css" type="text/css" media="screen">

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.ui.totop.js"></script>
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
	
	$("#contactbtn").on('click',function(){
		if(!$("form[name='ajax-contact-form']").valid())
		{
			return false;
		}
		else
		{
			$.ajax({
				url: '<?php echo site_url('Package/enquiry_now'); ?>',
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
		  email: {
					required: true,
	        		regx1: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
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
			email: {
						required: "!Please Enter Email",
			  			regx1: "!Please Enter Valid Email"
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
			$("#inputEmail").val('');
			$("#inputPhone").val('');
			$("#inputMessage").val('');
		}
});
</script>
<?php require_once('header.php'); ?>
</head>
<body class="subpage">
<div id="main">

<?php require_once('navigationbar.php'); ?>

<div id="slider_wrapper">
<?php if($this->uri->segment(1)=="domestic-packages" || (isset($records[0]->packagetype) && ($records[0]->packagetype == '1'))){ ?>
<div class="img"><img src="<?php echo base_url()."assets/pic/banner-btm-img.png";?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>"></div>
<?php } else if($this->uri->segment(1)=="international-packages" || (isset($records[0]->packagetype) && ($records[0]->packagetype == '2'))) { ?>
<div class="img"><img src="<?php echo base_url()."assets/pic/international.png";?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>"></div>
<?php } ?>
<img src="<?php echo base_url()."assets/images/camera_grad1.png"; ?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>" class="grad2">
<div class="slider_bot">
<div class="page_title">Packages</div>
<div class="breadcrumbs1">
<div class="breadcrumbs1_inner"><a href="<?php echo base_url(); ?>">Home Page</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;Package&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;<?php if($this->uri->segment(1)=="domestic-packages"){ ?>Domestic Package<?php } else if($this->uri->segment(1)=="international-packages") { ?>International Package<?php } else if($records[0]->packagetype == '1') { ?>Domestic Package > package detail<?php }else if($records[0]->packagetype == '2') { ?>International Package > package detail<?php } ?></div>	
</div>
</div>
</div>

<div id="content2">
<div class="container">
<div class="row">
<div class="span12">
<?php if(!$viewpackage)	{ ?>
<?php if($this->uri->segment(1)=="domestic-packages"){ ?>
<h2>Domestic Package </h2>
<?php } else if($this->uri->segment(1)=="international-packages") { ?>
<h2>International Package </h2>
<?php } ?>
<?php if(!empty($records)) { ?>
<div class="row">
<?php foreach($records as $r) { ?>

<div class="span4">
<div class="thumb1">
	<a href="<?php echo base_url()."packages/view-package/".$r->pid."/"; ?>">
     <div class="hovereffect" style="cursor: pointer">
        <img src="<?php echo base_url().$r->pimage; ?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>">
            <div class="overlay">
                <h2><?php echo $r->pname; ?></h2>
				<p>
					CLICK VIEW
				</p>
            </div>
    </div>
	</a>
	<div>		
		<p>
			<h3>Place -<strong><?php echo $r->place; ?></strong></h3>
		</p>
	</div>
</div>	
</div>
<?php } ?>
</div>
<?php } else { ?>
<div class="row">
<div class="span12">
<h1> No Any Packages Please Back Soon...</h1>
</div>
</div>
<?php } } else if($viewpackage) { ?>

<div id="content2">
<div class="container">
<div class="row">
<div class="span12">
</div>	
</div>
</div>
</div>

<div class="row">
<div class="span12">
<?php if($records[0]->packagetype == '1') { ?>
<h2>Domestic Tour Package Detail </h2>
<?php } else if ($records[0]->packagetype == '2') { ?>
<h2>International Tour Package Detail </h2>
<?php } ?>

</div>
<div class="span4">	
<div class="thumb1">
	<div class="thumbnail clearfix">
		<figure class="img-polaroid"><img src="<?php echo base_url().$records[0]->pimage; ?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>"></figure>
		<div class="caption">
		<?php if($records[0]->packagetype == '1') { ?>
			<div class="text-center"><a href="<?php echo base_url()."domestic-packages.html"; ?>" class="request1">Back To Pakages</a></div>
		<?php } else if ($records[0]->packagetype == '2') { ?>
			<div class="text-center"><a href="<?php echo base_url()."international-packages.html"; ?>" class="request1">Back To Pakages</a></div>
		<?php } ?>
		</div>
	</div>
</div>
</div>
<div class="span8">	
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Label</th>
        <th>Package Detail</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Package Type</td>
        <td><strong><?php if(!empty($records[0]->pname)) { echo $records[0]->pname; } else { echo "--In Process--"; } ?></strong></td>
      </tr>
	  <tr>
        <td>Tour Place</td>
        <td><strong><?php if(!empty($records[0]->place)) { echo $records[0]->place; } else { echo "--In Process--"; } ?></strong></td>
      </tr>
	  <tr>
        <td>Journey Starting Date</td>
        <td><strong><?php if(!empty($records[0]->psdate)) { echo $records[0]->psdate; } else { echo "--In Process--"; }?></strong></td>
      </tr>
	  <tr>
        <td>Journey Ending Date</td>
        <td><strong><?php if(!empty($records[0]->pedate)) { echo $records[0]->pedate; } else { echo "--In Process--"; }?></strong></td>
      </tr>
      <tr>
        <td>No Of Days</td>
        <td><strong><?php if(!empty($records[0]->days)) { echo $records[0]->days; } else { echo "--In Process--"; } ?></strong></td>
      </tr>
	  <tr>
        <td>No Of Nights</td>
        <td><strong><?php if(!empty($records[0]->days)) { echo $records[0]->nights; } else { echo "--In Process--"; } ?></strong></td>
      </tr>
	  <tr>
        <td>Price</td>
        <td><strong><?php if(!empty($records[0]->price)) { echo "Rs.".$records[0]->price; } else { echo "--In Process--"; } ?></strong></td>
      </tr>
	  <tr>
        <td>Available Pickup point</td>
        <td><strong><?php if(!empty($records[0]->pickuppoint)) { echo $records[0]->pickuppoint; } else { echo "--In Process--"; } ?></strong></td>
      </tr>
	  <tr>
        <td>Pickup Date & Time</td>
        <td><strong><?php if(!empty($records[0]->pickupdatetime)) { echo $records[0]->pickupdatetime; } else { echo "--In Process--"; }?></strong></td>
      </tr>
	   <tr>
        <td>Description</td>
        <td><strong><?php if(!empty($records[0]->description)) { echo $records[0]->description; } else { echo "--In Process--"; } ?></strong></td>
      </tr>
    </tbody>
</table>
</div>
</div>	
<div class="row">
<div class="span8 offset4 text-center">
<h3><strong>*Note - Here We Are Not Providing Online Booking If You Want To Book Package</strong></h3>
<div class="caption">
	<div class="text-center"><a type="button" href="#content" id="mybutton" name="mybutton" class="find1">Enquiry Now</a></div>
</div>
</div>
</div>
<?php } ?>
</div>	
</div>	
</div>	
</div>
<?php if($viewpackage) { ?>
<div id="content" class="travels hide">
<div class="container">
<div class="row">
<div class="span12">
<h2>
Enquiry Now</h2>
<div id="sucess" class="alert alert-success">
			
</div>
		
<div id="denger" class="alert alert-danger">
  
</div>
<div id="note"></div>
<div id="fields">
	<form id="ajax-contact-form" name="ajax-contact-form" method="post" class="form-horizontal" action="">
		<div class="row">
			<div class="span4">
				<div class="control-group">
				    <label class="control-label" for="inputName">Your full name:</label>
				    <div class="controls">				      
				      <input class="span4" type="text" id="inputName" name="name" placeholder="Your full name:" >
				    </div>
				</div>				
			</div>			
			<div class="span4">
				<div class="control-group">
				    <label class="control-label" for="inputEmail">Your email:</label>
				    <div class="controls">				      
				      <input class="span4" type="text" id="inputEmail" name="email" placeholder="Your email:" >
					  <input type="hidden" name="package" value="<?php echo $this->uri->segment(3); ?>">
				    </div>
				</div>
			</div>
			<div class="span4">
				<div class="control-group">
				    <label class="control-label" for="inputPhone">Mobile number:</label>
				    <div class="controls">				      
				      <input class="span4" type="text" id="inputPhone" name="phone" placeholder="Mobile number:" >
				    </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<div class="control-group">
				    <label class="control-label" for="inputMessage">Message:</label>
				    <div class="controls">				      				      
				      <textarea class="span12" id="inputMessage" name="content" placeholder="Message:I Want To Book This Package If Any Extra Cost For Infant  ..."></textarea>
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
<?php } ?>
<?php require_once('footer.php'); ?>