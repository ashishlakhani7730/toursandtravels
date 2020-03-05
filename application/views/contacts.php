<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Shakti Tours Travels | Contacts</title>
<meta charset="utf-8">
<meta name="keywords" content="Shakti Tours Travels, Travel Company India, Travel Company Gujarat, Travels Company Bhavnagar, Gujarat tour operator, Travel Agent in Bhavnagar, Travel Agency Gujarat, Tour operators Gujarat">
<meta name="description" content="'SHAKTI TOURS TRAVELS' 'SHAKTI TOURS TRAVELS' is a Leading Tour Operator and Travel Agent established in 2005 having an India Travel Agency">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo base_url(); ?>assets/images/shakti.jpg" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/shakti.jpg" type="image/x-icon" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" type="text/css" media="screen">    
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" media="screen">

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/superfish.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.ui.totop.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/cform.js"></script>
<?php require_once('header.php'); ?>
</head>
<body class="subpage">
<div id="main">

<?php require_once('navigationbar.php'); ?>


<div id="slider_wrapper">
<div class="img"><img src="<?php echo base_url()."assets/pic/aboutus.jpg"; ?>" alt="<?php echo SHAKTI_IMAGE_TAG; ?>"></div>
<img src="<?php echo base_url(); ?>assets/images/camera_grad1.png" alt="<?php echo SHAKTI_IMAGE_TAG; ?>" class="grad2">
<div class="slider_bot">
<div class="page_title">Contacts</div>
<div class="breadcrumbs1">
<div class="breadcrumbs1_inner"><a href="<?php echo base_url(); ?>">Home Page</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;Contacts</div>	
</div>
</div>
</div>

<div id="content">
<div class="container">
<div class="row">
<div class="span12">
	
<h1>Our Address</h1>

<figure class="google_map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1039.7772222723468!2d72.15142105801766!3d21.7669123519515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f5a7c9f0d9db1%3A0xd9810462356cd22!2sShakti+Travels!5e0!3m2!1sen!2sin!4v1521790071458" width="1600" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
</figure>

<h3>Address</h3>

<p>
	Surya Darshan Complex, Opp Tanna Travels <br>
Near Rubber Factory, Bhavnagar - 364001<br>
Telephone1: 0278 222 18 18<br>
Telephone2: 0278 300 18 18<br>
E-mail: <a href="mailto:support@shaktitourstravels.com">support@shaktitourstravels.com</a>
</p>
</div>	
</div>	
</div>	
</div>

<div id="content2">
<div class="container">
<div class="row">
<div class="span12">
<h2>Contact Form</h2>
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
				      <textarea class="span12" id="inputMessage" name="content" placeholder="Message:"></textarea>
				    </div>
				</div>
			</div>
		</div>
		<button type="button" name="contactbtn" id="contactbtn" class="submit">Submit</button>
	</form>
</div>	
</div>	
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#sucess").hide();
	$("#denger").hide();
	
	$("#contactbtn").on('click',function(){
		if(!$("form[name='ajax-contact-form']").valid())
		{
			return false;
		}
		else
		{
			$.ajax({
				url: '<?php echo site_url('Contacts/send_mail'); ?>',
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
						}, 8000);
					}
					else if(json.code == 0)
					{
						cleardata();
						$("#denger").html('<strong>'+json.message+'</strong>');
						$("#denger").show();
						setTimeout(function(){
							$("#denger").hide();
						}, 8000);
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
	
});

function cleardata()
{
	$("#inputName").val('');
	$("#inputEmail").val('');
	$("#inputPhone").val('');
	$("#inputMessage").val('');
}
</script>
<?php require_once('footer.php'); ?>

