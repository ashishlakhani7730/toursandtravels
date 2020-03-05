<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php require_once('header.php'); ?>
<script>
$(document).ready(function(){
	
	<?php if(empty($this->session->flashdata('message'))) { ?>
			$('#successMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#successMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
	<?php if(empty($this->session->flashdata('fail_message'))) { ?>
			$('#failMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#failMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
});
</script>
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Destination</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
				<?php if(validation_errors()) { ?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo validation_errors(); ?>
					</div>
				<?php } ?>
				<div id="successMessage" class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo $this->session->flashdata('message'); ?>
                </div>
				<div id="failMessage" class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo $this->session->flashdata('fail_message'); ?>
                </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            *ALL FILED REQUIRED
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="<?php echo base_url()."admin/Destination/addDestination" ?>" method="post" enctype="multipart/form-data" >
										<div class="form-group">
                                            <label>Select City Image</label>
                                            <input type="file" name="cityimage" value="<?php echo set_value('cityimage'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter City Name</label>
                                            <input class="form-control" name="cityname" value="<?php echo set_value('cityname'); ?>">
                                            <p class="help-block">Example GOA.</p>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>                                       
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            RECORD
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>City Name</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(!empty($records)){ foreach($records as $r) { 
                                    echo "<tr class='odd gradeX'>";
									echo "<td><img src=".base_url().$r->image." width='50px' height='50px'></td>";
                                    echo "<td>".$r->city."</td>";                                  
								    echo "<td><a href=".base_url()."admin/Destination/delDestination/".$r->dsid."/".$r->image." name='delete' class='btn btn-danger'>Delete</a></td>";
                                    echo "</tr>";
							    } } else { echo "<tr class='odd gradeX'><td colspan='4'> NO RECORD FOUND</td></tr>";} ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php'); ?>