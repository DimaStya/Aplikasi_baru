<link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/all.css');?>">
<link rel="stylesheet" href="<?php echo base_url('plugins/select2/select2.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/select2/select2.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/skins/_all-skins.min.css');?>">
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Detail Paket</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data Detail paket <?php echo $kode_paket;?></h3>
              <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div> 
            </div>
            <div class="box-body">
          <form action="<?php echo base_url('Admin/Proses_detpaket');?>" method="POST">
                <button type='submit' class='btn-success' name="tambah" id="tambah" value="<?php echo $kode_paket;?>"><i class='fa fa-fw fa-database'>+</i>Tambah Buku</button>
                <hr>
             
            <table id="example2" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Kode Buku</th>
                  <th>Judul</th>
                  <th>Hapus?</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data as $buku) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $buku['kode_buku'];?></td>
                    <td><?php echo $buku['judul'];?></td>
                    <td>
                      <input type="checkbox" name="hapus[]" id="hapus[]" value="<?php echo $buku['kode_buku'];?>" class="flat-red"></td>
                  </tr>
                  <?php $no++;} ?>
                  <input type="hidden" name="kode_paket" id="kode_paket" value="<?php echo $kode_paket;?>">
                </tbody>
              </table>
              <button  type='submit' class='pull-right btn-danger' name="kurang" id="kurang" value="<?php echo $kode_paket;?>" onclick="return confirm('Yakin Mau menghapus buku?');"> <i class='fa fa-fw fa-database'>-</i>Kurangi Buku</button>
            </form>
            </div>
        </div>
    </section>
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Presensi Marketing <a href="http://Mediatamasolo.com">Mediatamasolo</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>

<script src="<?php echo base_url('plugins/jQuery/jQuery-2.2.0.min.js');?>"></script>
<script src="<?php echo base_url('plugins/select2/select2.full.min.js');?>"></script>
<script src="<?php echo base_url('plugins/input-mask/jquery.inputmask.js');?>"></script>
<script src="<?php echo base_url('plugins/iCheck/icheck.min.js');?>"></script>

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
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": true
    });
  });
</script>
<script>

  $(function () {
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script>
</body>
</html>
