
<!-><script>
        var baseurl="<?php echo base_url()?>";
        var resizefunc = [];
    </script>

    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/tether.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/waves.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.nicescroll.js') ?>"></script>

    <script src="<?php echo base_url('assets/plugins/switchery/switchery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/custombox/js/custombox.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/custombox/js/legacy.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>

    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js') ?>"></script>

    <script src="<?php echo base_url('assets/js/jquery.core.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.app.js') ?>"></script>

    <script src="<?php echo base_url('ext/js/plugin/angular.min.js') ?>"></script>
    <script src="<?php echo base_url('ext/js/plugin/commons.js') ?>"></script>

    <script src="<?php echo base_url('ext/js/commons-angular.js') ?>"></script>
    <script src="<?php echo base_url('ext/js/commons-jquery.js') ?>"></script>

    <script src="<?php echo base_url('ext/js/plugin/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('ext/js/plugin/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?php echo base_url('ext/js/plugin/jquery.Jcrop.min.js') ?>"></script>
    <script src="<?php echo base_url('ext/js/plugin/notify.js') ?>"></script>
    <script src="<?php echo base_url('ext/js/plugin/select2.min.js') ?>"></script>

<?php foreach($script as $each):?>
    <script src="<?php echo base_url($each) ?>"></script>
<?php endforeach;?>
