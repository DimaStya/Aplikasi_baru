<div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div> 
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>New Sistem Marketing <a href="http://Mediatamasolo.com">Mediatamasolo</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script src="<?php echo base_url('plugins/jQuery/jQuery-2.2.0.min.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<script src="<?php echo base_url('plugins/fastclick/fastclick.js');?>"></script>
<script src="<?php echo base_url('dist/js/app.min.js');?>"></script>
<script src="<?php echo base_url('dist/js/demo.js');?>"></script>

<script>   
    $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>

<script src="<?php echo base_url('plugins/select2/select2.full.min.js');?>"></script>
<script src="<?php echo base_url('plugins/input-mask/jquery.inputmask.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js');?>"></script>
<script src="<?php echo base_url('plugins/daterangepicker/daterangepicker.js');?>"></script>
<script src="<?php echo base_url('plugins/datepicker/bootstrap-datepicker.js');?>"></script>
<script src="<?php echo base_url('plugins/iCheck/icheck.min.js');?>"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
</body>
</html>
