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
                    <h1 class="page-header">Add E-brochure (pdf)</h1>
                </div>
		<div class="col-lg-12">
                    <div class="well">
			<h4>Upload pdf</h4>
                        <p>Username- shaktitravels59@gmail.com -- Password- 93 77 99 59 59</p>
			<p><a href="https://accounts.google.com/signin/v2/identifier?service=wise&passive=1209600&osid=1&continue=https%3A%2F%2Fdrive.google.com%2F%3Ftab%3Dwo&followup=https%3A%2F%2Fdrive.google.com%2F%3Ftab%3Dwo&emr=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin" target="_blank">Login Upload PDF</a></p>
                    </div>
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
                                    <form role="form" action="<?php echo base_url()."admin/Ebrochure/addbrochure" ?>" method="post">
                                        <div class="form-group">
                                            <label>Enter Brochure Titel</label>
                                            <input class="form-control" name="btitel" value="<?php echo set_value('btitel'); ?>">
                                            <p class="help-block">Example GOA.</p>
                                        </div>
										<div class="form-group">
                                            <label>Enter Brochure Date</label>
                                            <input class="form-control" name="bdate" value="<?php echo set_value('bdate'); ?>">
                                            <p class="help-block">Example whatever you want</p>
                                        </div>
										<div class="form-group">
                                            <label>Enter Google Link</label>
                                            <input class="form-control" name="blink" value="<?php echo set_value('blink'); ?>">
                                            <p class="help-block">Example http://drive.google.com/d/1sasaafde331wdfcaz</p>
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
										<th>Titel</th>
                                        <th>Date</th>
                                        <th>Link</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(!empty($records)){ foreach($records as $r) { 
                                    echo "<tr class='odd gradeX'>";
									echo "<td>".$r->btitel."</td>";
                                    echo "<td>".$r->date."</td>";              
									echo "<td><a href=".$r->bgoogleid." name='delete' class='btn btn-primary' target='_blank'>click to show</a></td>";									
								    echo "<td><a href=".base_url()."admin/Ebrochure/delbrochure/".$r->bid." name='delete' class='btn btn-danger'>Delete</a></td>";
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