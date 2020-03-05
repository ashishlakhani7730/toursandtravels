<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/admin/dist/js/sb-admin-2.js"></script>
	
    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/datatables-responsive/dataTables.responsive.js"></script>
    
	<script src="<?php echo base_url(); ?>assets/js/moment.js"></script> 
	<script src="<?php echo base_url(); ?>assets/js//bootstrap-datetimepicker.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/summernote/summernote.js"></script>
	
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>