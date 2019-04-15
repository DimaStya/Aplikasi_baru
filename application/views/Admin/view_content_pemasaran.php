<script src = "<?php echo base_url('js/pemasaran.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Pemasaran</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Admin Pemasaran</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_pemasaran'; ?>" autocomplete="off" method="POST">
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nama Lengkap</label>
                      <input type="hidden" name="kode_admpusat" id="kode_admpusat">
                      <input type="text" class="form-control col-xs-6" name="nama_admpusat" id="nama_admpusat"  placeholder="Nama Lengkap" required="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                    
                  <div class="col-xs-6">
                      <label>Email</label>
                      <input type="email" class="form-control col-xs-6" name="email" id="email"  placeholder="Email" required="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>No-telp</label>
                      <input type="text" class="form-control col-xs-6" name="no_telp" id="no_telp" placeholder="No Telp" required="" onkeypress="return hanyaAngka(event)">
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
              <h3 class="box-title">Data Admin Pemasaran</h3>&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','')">+</button>
      
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>No Telp</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data1 as $pemasaran) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                     <td><?php echo $pemasaran['nama_admpusat'];?></td>
                    <td><?php echo $pemasaran['email'];?></td>
                    <td><?php echo $pemasaran['no_telp'];?></td>
                    <td><?php echo $pemasaran['aktif'];?></td>
                    <td width="10%"><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick="SetInput('<?php echo $pemasaran['kode_admpusat'];?>','<?php echo $pemasaran['nama_admpusat'];?>','<?php echo $pemasaran['email'];?>','<?php echo $pemasaran['no_telp'];?>')"><i class='fa fa-fw fa-pencil-square-o'></i></button>|<button onclick='Klik<?php echo $no;?>()' type='button' class='btn-danger'><i class='fa fa-fw fa-sign-out'></i></button></td></td>
                  </tr>
                  <?php $no++;} ?>
                </tbody>
                </tfoot>
              </table>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
  <?php $no=1; foreach ($data1 as $pemasaran) { 
    echo "
      function Klik".$no."(){
        var r = confirm('Yakin Data resign?');
        if(r == true){
          window.location = '".base_url()."Proses/Hapus_pemasaran/".$pemasaran['kode_admpusat']."';
        }
        
      }
    ";

    $no++;}
  ?>
</script>
  <script type="text/javascript">
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
  </script>