</div>
<!-- /#wrapper -->

<!-- Control Sidebar -->

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->

<script type="text/javascript"> var base_url = '<?php echo base_url(); ?>';</script>
<!-- jQuery -->
<script src="<?= base_url() ?>assets/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/metisMenu.min.js"></script>

<script type="text/javascript" src="<?= base_url() ?>assets/plugins/datatables/media/js/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="<?= base_url() ?>assets/plugins/datatables/media/js/dataTables.jqueryui.min.js"></script>

<script type="text/javascript" src="<?= base_url() ?>assets/plugins/blockui/jquery.blockUI.js"></script>

<script type="text/javascript" src="<?= base_url() ?>assets/plugins/animate/packaged/jquery.noty.packaged.min.js"></script>

<script type="text/javascript" src="<?= base_url() ?>assets/custom/funciones_generales.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/sb-admin-2.js"></script>

<?php
if(!empty($js_data) && is_array($js_data))
    foreach($js_data as $js)
        echo '<script src="'.$js.'"></script>';
elseif(!empty($js_data))
    echo '<script src="'.$js_data.'"></script>';
?>
</body>

</html>
