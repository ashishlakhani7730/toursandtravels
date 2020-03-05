<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php require_once('header.php'); ?>
<div id="page-wrapper">
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Request List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>        
                                        <th>Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Message</th>
										<th>Request From</th>
										<th>Packagename</th>
										<th>Place</th>
										<th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(!empty($records))
									  { 
											foreach($records as $r) 
											{ 
												echo "<tr class='odd gradeX'>";
												echo "<td>".$r->name."</td>"; 
												if($r->email != '')
												{
													echo "<td>".$r->email."</td>"; 	
												}
												else
												{
													echo "<td>-</td>"; 
												}
												echo "<td>".$r->mobile."</td>";
												echo "<td>".$r->message."</td>";
												if($r->reqtype == '1')
												{
													echo "<td>Estimate</td>";
												}
												else if ($r->reqtype == '2')
												{
													echo "<td>Package</td>";
												}
												else
												{
													echo "<td>Contact</td>";
												}
												
												if($r->pname != '' && $r->pplace != '')
												{
													echo "<td>".$r->pname."</td>";
													echo "<td>".$r->pplace."</td>";
												}
												else
												{
													echo "<td>-</td>";
													echo "<td>-</td>";
												}
												
												echo "<td>".$r->created_date."</td>";
												echo "</tr>";
												
											} 
									  } 
									  else 
									  { echo "<tr class='odd gradeX'><td colspan='12'> NO RECORD FOUND</td></tr>"; } ?>
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
<?php require_once('footer.php'); ?>