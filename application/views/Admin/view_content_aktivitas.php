<style type="text/css">
  #notifications {
    cursor: pointer;
    position: fixed;
    right: 0px;
    z-index: 9999;
    top: 110px;
    margin-bottom: 22px;
    margin-right: 15px;
    min-width: 300px; 
    max-width: 800px;  
}
</style>
<script src = "<?php echo base_url('js/area.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Aktivitas</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data Login</h3>
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Jabatan</th>
                  <th>Login Sampai</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data1 as $aktivitas) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $aktivitas['username'];?></td>
                    <td>
                      <?php
                      if($aktivitas['hak_akses'] == 1){
                        echo "Admin Perwakilan";
                      }else if($aktivitas['hak_akses'] == 2){
                        echo "Admin Pemasaran";
                      }else if($aktivitas['hak_akses'] == 3){
                        echo "Admin Keuangan";
                      }else if($aktivitas['hak_akses'] == 4){
                        echo "Admin Gudang";
                      }else if($aktivitas['hak_akses'] == 5){
                        echo "Produksi";
                      }else if($aktivitas['hak_akses'] == 10){
                        echo "Admin";
                      }else if($aktivitas['hak_akses'] == 11){
                        echo "Coordinator Pemasaran";
                      }else if($aktivitas['hak_akses'] == 12){
                        echo "Coordinator Keuangan";
                      }
                      ?>
                    </td>
                    <td><?php echo $aktivitas['tanggal'];?></td>
                  </tr>
                  <?php $no++;} ?>
                </tbody>
                </tfoot>
              </table>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url("js/jquery-1.7.1.min.js"); ?>" type="text/javascript"></script>