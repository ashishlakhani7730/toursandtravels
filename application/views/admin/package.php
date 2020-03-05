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
                    <h1 class="page-header">Add Packages</h1>
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
                            *FILED REQUIRED
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                    <form role="form" action="<?php echo base_url()."admin/package/addPackage" ?>" method="post" enctype="multipart/form-data" >
									<div class="col-lg-12">
										<div class="form-group">
											<label>* Select Package Type</label>
											<select class="form-control" name="packagetype">
												<option value="">Select Package Type</option>
                                                <option value="1" <?php echo set_select('packagetype','1', ( !empty($data) && $data == "1" ? TRUE : FALSE )); ?>>Domestic</option>
                                                <option value="2" <?php echo set_select('packagetype','2', ( !empty($data) && $data == "2" ? TRUE : FALSE )); ?>>International</option>
                                            </select>
										</div>
										<div class="form-group">
                                            <label>* Select Package Image</label>
                                            <input type="file" name="packageimage" value="<?php echo set_value('packageimage') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>* Enter Package Name</label>
                                            <input class="form-control" name="packagename" value="<?php echo set_value('packagename'); ?>">
                                        </div>
										<div class="form-group">
                                            <label>* Enter Place Name</label>
                                            <input class="form-control" name="placename" value="<?php echo set_value('placename'); ?>">                   
                                        </div>
										<div class="form-group">
                                            <label> Enter Total Days</label>
                                            <input class="form-control" name="totalday" value="<?php echo set_value('totalday'); ?>">                                      
                                        </div>
										<div class="form-group">
                                            <label> Enter Total Nights</label>
                                            <input class="form-control" name="totalnight" value="<?php echo set_value('totalnight'); ?>">                                    
                                        </div>
										<div class="form-group">
                                            <label>* Enter Total Price</label>
                                            <input class="form-control" name="price" value="<?php echo set_value('price'); ?>">
                                            <p class="help-block">Ex.20,000 per couple or 15,000 per person</p>
                                        </div>									
										<div class="form-group">
                                            <label> Enter Discription</label>
                                             <textarea id="summernote" class="form-control" name="description" rows="10"><?php echo set_value('description'); ?></textarea>
                                        </div>
										<div class="form-group">
                                            <label> Select Package Start Date</label>
                                            <input class="form-control" name="sdate" value="<?php echo set_value('sdate'); ?>">
											<p class="help-block">Ex.may-jun-2018 1,2,3,4,5,6 (A/c couch) 7,9,10 (Non A/c couch)</p>											                                          
                                        </div>
										<div class="form-group">
                                            <label> Select Package End Date</label>
                                            <div class="input-group date" id="datetimepicker2">
												<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
												<input type="text" name="edate" value="<?php echo set_value('edate'); ?>" class="form-control" />		
											</div>  
                                        </div>
										<div class="form-group">
                                            <label> Enter Pickup Point</label>
                                            <input class="form-control" name="pickup" value="<?php echo set_value('pickup'); ?>">
                                        </div>
										<div class="form-group">
                                            <label> Select Pickup DateTime </label>
                                             <div class="input-group date" id="datetimepicker3">
												<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
												<input type="text" name="pdatetime" value="<?php echo set_value('pdatetime'); ?>" class="form-control" />		
											</div>  
                                        </div>
										<div class="center">
                                        <button type="submit" class="btn btn-primary">Submit</button>  
										</div>
                                    </div>
									</form>
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
										<th>type</th>
                                        <th>Package</th>
										<th>Place</th>
										<th>Days</th>
										<th>Nights</th>
										<th>Price</th>
										<th>Discription</th>
										<th>Start Date</th>
										<th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(!empty($records)){ foreach($records as $r) { 
                                    echo "<tr class='odd gradeX'>";
									echo "<td><img src=".base_url().$r->pimage." width='50px' height='50px'></td>";
									if($r->packagetype == '1')
									{
										echo "<td>Domestic</td>";
									}
									else if($r->packagetype == '2')
									{
										echo "<td>International</td>";
									}
									else{
										echo "<td>Wrong Package</td>";
									}
                                    echo "<td>".$r->pname."</td>"; 
									echo "<td>".$r->place."</td>"; 	
									echo "<td>".$r->days."</td>";
									echo "<td>".$r->nights."</td>";
									echo "<td>".$r->price."</td>";
									echo "<td>".$r->description."</td>";
									echo "<td>".$r->psdate."</td>";
									echo "<td><a href=".base_url()."admin/package/updatePackage/".$r->pid." name='delete' class='btn btn-success'>Update</a></td>";
								    echo "<td><a href=".base_url()."admin/package/delPackage/".$r->pid."/".$r->pimage." name='delete' class='btn btn-danger'>Delete</a></td>";
                                    echo "</tr>";
							    } } else { echo "<tr class='odd gradeX'><td colspan='12'> NO RECORD FOUND</td></tr>";} ?>
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
<script type="text/javascript">
$(document).ready(function() {
  $('#summernote').summernote();
});
$(function () {
 $('#datetimepicker2').datetimepicker({
	format: 'DD/MM/YYYY',
	
 });
 $('#datetimepicker3').datetimepicker({
	format: 'DD/MM/YYYY HH:mm A',
	 
 });
});
</script>
<?php require_once('footer.php'); ?>