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
<script src = "<?php echo base_url('js/paket.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Paket</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Paket</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_paket'; ?>" autocomplete="off" method="POST">
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nama Paket</label>
                      <input type="hidden" name="kode_paket" id="kode_paket">
                      <input type="text" class="form-control col-xs-6" name="nama_paket" id="nama_paket"  placeholder="Nama Paket" required="">
                  </div>
                </div>
              </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
          </div>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data paket</h3>&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','')">+</button>
              <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div> 
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Kode Paket</th>
                  <th>Nama Paket</th>
                  <th>Jumlah Judul</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data as $paket) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $paket['kode_paket'];?></td>
                    <td><?php echo $paket['nama_paket'];?></td>
                    <td><?php echo $paket['jumlah'];?></td>
                    <td><a href="<?php echo base_url('Admin/Detpaket/'.$paket['kode_paket']);?>">
                      <button title="Data" type='button' class='btn-success'><i class='fa fa-fw fa-database'></i></button></a>|
                      <button title="Ubah" type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick="SetInput('<?php echo $paket['kode_paket'];?>','<?php echo $paket['nama_paket'];?>')"><i class='fa fa-fw fa-pencil-square-o'></i></button>|
                      <button title="Hapus" onclick='Klik<?php echo $no;?>()' type='button' class='btn-danger'><i class='fa fa-fw fa-sign-out'></i></button></td>
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
<script>   
    $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>
<script type="text/javascript">
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
  </script>
  <script type="text/javascript">
  <?php $no=1; foreach ($data as $paket) { 
    echo "
      function Klik".$no."(){
        var r = confirm('Yakin Data Paket \"".$paket['nama_paket']."\" dihapus?');
        if(r == true){
          window.location = '".base_url()."Proses/Hapus_paket/".$paket['kode_paket']."';
        }
        
      }
    ";

    $no++;}
  ?>
</script>