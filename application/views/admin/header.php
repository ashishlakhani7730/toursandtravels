<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shakti | Admin</title>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
	
	
	
	<link href="<?php echo base_url(); ?>assets/css/jquerysctipttop.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/morrisjs/morris.css" rel="stylesheet">
	
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	
	<link href="<?php echo base_url(); ?>assets/admin/summernote/summernote.css" rel="stylesheet">
	
    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url()."admin/Home"; ?>">Shakti Travels</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url()."admin/Login/logout"; ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="https://analytics.google.com/analytics/web/#embed/report-home/a116375231w172801172p172256693/" target="_blank"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<li>
                            <a href="<?php echo base_url().'admin/request' ?>"><i class="fa fa-dashboard fa-fw"></i> ALL Request</a>
                        </li>
						<li>
                            <a href="<?php echo base_url().'admin/destination' ?>"><i class="fa fa-edit fa-fw"></i> Add Destination</a>
                        </li>
						<li>
                            <a href="<?php echo base_url().'admin/gallery' ?>"><i class="fa fa-table fa-fw"></i> Add Gallery</a>
                        </li>
						<li>
                            <a href="<?php echo base_url().'admin/package' ?>"><i class="fa fa-sitemap fa-fw"></i> Add Package</a>
                        </li> 
						<li>
                            <a href="<?php echo base_url().'admin/specialpackage' ?>"><i class="fa fa-sitemap fa-fw"></i> Add Special Package</a>
                        </li>
						<li>
                            <a href="<?php echo base_url().'admin/ebrochure' ?>"><i class="fa fa-sitemap fa-fw"></i> Add Brochure (pdf)</a>
                        </li>							
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

    
