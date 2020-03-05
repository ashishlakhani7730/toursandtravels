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
                    <h1 class="page-header">Add Special Package</h1>
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
                                    <form role="form" action="<?php echo base_url()."admin/Specialpackage/addSpecialpackage" ?>" method="post" enctype="multipart/form-data" >
										<div class="form-group">
											<label>* Select Package Type</label>
											<select class="form-control" name="packagetype">
												<option value="">Select Package Type</option>
                                                <option value="1" <?php echo set_select('packagetype','1', ( !empty($data) && $data == "1" ? TRUE : FALSE )); ?>>Domestic</option>
                                                <option value="2" <?php echo set_select('packagetype','2', ( !empty($data) && $data == "2" ? TRUE : FALSE )); ?>>International</option>
                                            </select>
										</div>
										<div class="form-group">
                                            <label>Select Package Image</label>
                                            <input type="file" name="pimage" value="<?php echo set_value('pimage'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Package Name</label>
                                            <input class="form-control" name="pname" value="<?php echo set_value('pname'); ?>">
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
										<th>Packagetype</th>
                                        <th>Image</th>
                                        <th>Package Name</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(!empty($records)){ foreach($records as $r) { 
                                    echo "<tr class='odd gradeX'>";
									if($r->packagetype)
									{
										echo "<td>Domestic</td>";
									} 
									else if($r->packagetype)
									{
										echo "<td>Dpmestic</td>";
									}
									echo "<td><img src=".base_url().$r->pimage." width='50px' height='50px'></td>";
                                    echo "<td>".$r->pname."</td>";                                  
								    echo "<td><a href=".base_url()."admin/Specialpackage/delspepackage/".$r->spid."/".$r->pimage." name='delete' class='btn btn-danger'>Delete</a></td>";
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