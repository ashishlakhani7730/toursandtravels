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
                    <h1 class="page-header">Update Package</h1>
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
                                    <form role="form" action="<?php echo base_url()."admin/package/upPackage/".$value[0]->pid; ?>" method="post" enctype="multipart/form-data" >
									<div class="col-lg-12">
										<div class="form-group">
											<label>* Select Package Type</label>
											<select class="form-control" name="packagetype">
												<option value="">Select Package Type</option>
                                                <option value="1" <?php  if($value[0]->packagetype == '1') { echo "selected"; } ?>>Domestic</option>
                                                <option value="2" <?php  if($value[0]->packagetype == '2') { echo "selected"; } ?>>International</option>
                                            </select>
										</div>
										<img src="<?php echo base_url().$value[0]->pimage; ?>" width ="75px" height="75px"></img><- Old image
										<input type="hidden" name="pimage" value="<?php echo $value[0]->pimage; ?>">
										<div class="form-group">
											 
                                            <label>* Select Package Image</label>
                                            <input type="file" name="packageimage" value="">
											
                                        </div>
                                        <div class="form-group">
                                            <label>* Enter Package Name</label>
                                            <input class="form-control" name="packagename" value="<?php echo $value[0]->pname; ?>">
                                        </div>
										<div class="form-group">
                                            <label>* Enter Place Name</label>
                                            <input class="form-control" name="placename" value="<?php echo $value[0]->place; ?>">                   
                                        </div>
										<div class="form-group">
                                            <label> Enter Total Days</label>
                                            <input class="form-control" name="totalday" value="<?php echo $value[0]->days; ?>">                                      
                                        </div>
										<div class="form-group">
                                            <label> Enter Total Nights</label>
                                            <input class="form-control" name="totalnight" value="<?php echo $value[0]->nights; ?>">                                    
                                        </div>
										<div class="form-group">
                                            <label>* Enter Total Price</label>
                                            <input class="form-control" name="price" value="<?php echo $value[0]->price; ?>">
                                            <p class="help-block">Ex.20,000 per couple or 15,000 per person</p>
                                        </div>									
										<div class="form-group">
                                            <label> Enter Discription</label>
                                             <textarea id="summernote" class="form-control" name="description" rows="10"><?php echo $value[0]->description; ?></textarea>
                                        </div>
										<div class="form-group">
                                            <label> Select Package Start Date</label>
                                            <input class="form-control" name="sdate" value="<?php echo $value[0]->psdate; ?>">
											<p class="help-block">Ex.may-jun-2018 1,2,3,4,5,6 (A/c couch) 7,9,10 (Non A/c couch)</p>											                                          
                                        </div>
										<div class="form-group">
                                            <label> Select Package End Date</label>
                                            <div class="input-group date" id="datetimepicker2">
												<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
												<input type="text" name="edate" value="<?php echo $value[0]->pedate; ?>" class="form-control" />		
											</div>  
                                        </div>
										<div class="form-group">
                                            <label> Enter Pickup Point</label>
                                            <input class="form-control" name="pickup" value="<?php echo $value[0]->pickuppoint; ?>">
                                        </div>
										<div class="form-group">
                                            <label> Select Pickup DateTime </label>
                                             <div class="input-group date" id="datetimepicker3">
												<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
												<input type="text" name="pdatetime" value="<?php echo $value[0]->pickupdatetime; ?>" class="form-control" />		
											</div>  
                                        </div>
										<div class="center">
                                        <button type="submit" class="btn btn-primary">Update</button>  
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
</div>
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