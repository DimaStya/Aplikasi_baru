<script src = "<?php echo base_url('js/handle_gudang.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Wilayah Gudang</li>
    </ol>
  </section>
<!-- Modal Form Untuk data baru -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Handle Gudang</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
              <form role="form" action="<?php echo base_url().'Handle/gudang'; ?>" method="POST">
                <div class="box-body">
                  <div class="col-lg-6">                   
                    <label>Pilih Nama Admin gudang</label>
                      <select class="form-control" id ='kode_admgudang' name='kode_admgudang' required="">
                      <option value= "">--Pilih Nama Admin gudang--</option>
                      <?php foreach ($data2 as $admgudang) { 
                        echo '<option value= "'.$admgudang['kode_admgudang'].'">'.$admgudang['nama_admgudang'].'</option>';
                      }?>
                      </select>
                  </div>
                  </div>
                  <div class="box-body">
                    <div class="col-lg-6">
                      <label>------Pilih Wilayah Untuk di Handle------</label>
                    <table border="1">
                      <thead>
                        <tr>
                          <th>Alamat Perwakilan</th>
                          <th>Pilih</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  foreach ($data3 as $perwakilan) { ?>
                          <tr>
                            <td width="230px"><?php echo $perwakilan['alamat_perwakilan'];?></td>
                            <td align="center">
                                <label>
                                  <input type="checkbox" name="kaper[]" id="kaper[]" value="<?php echo $perwakilan['kode_perwakilan'];?>">
                                </label>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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
  <!-- Modal Form Untuk Ubah -->
    <div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Handle Gudang</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
              <form role="form" action="<?php echo base_url().'Handle/gudang'; ?>" method="POST">
                <input type="hidden" name="kode_handle" id="kode_handle">
                <input type="hidden" name="kode_perwakilan" id="kode_perwakilan">
                <div class="box-body">
                  <div class="col-lg-6">                   
                    <label>Pilih Nama Admin Gudang</label>
                      <select class="form-control" id ='kode_admgudang1' name='kode_admgudang1' required="">
                      
                      </select>
                  </div>
                  </div>
                  <div class="box-body">
                    <div class="col-lg-6">
                      <label>---------Wilayah Handle---------</label>
                      <input type="text" name="kaper1" id="kaper1" class="form-control col-xs-6" disabled="">
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
              <h3 class="box-title">Data Wilayah Gudang</h3>&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','','','')">+</button>
      
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Nama Admin gudang</th>
                  <th>Alamat Perwakilan</th>
                  <th>Kondisi</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data1 as $handle) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                     <td><?php echo $handle['nama_admgudang'];?></td>
                    <td><?php echo $handle['alamat_perwakilan'];?></td>
                    <td><?php echo $handle['aktif'];?></td>
                    <td><?php echo $handle['kondisi'];?></td>
                    <td width="10%">
                      <?php if($handle['kondisi']=='Asli' && $handle['aktif']=='Aktif'){?>
                        <button type='button' class='btn-info' data-toggle='modal' data-target='#myModal1' onclick="ubah<?php echo $no;?>();"><i class='fa fa-fw fa-pencil-square-o'></i></button>
                      <?php }else if($handle['kondisi']=='Sementara'){?>
                        <button onclick='Klik<?php echo $no;?>()' type='button' class='btn-danger'><i class='fa fa-fw fa-sign-out'></i></button>
                      <?php }?>
                    </td>
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
  <?php $no=1; foreach ($data1 as $handle) { 
    echo "
      function Klik".$no."(){
        var r = confirm('Data Akan Dihapus dan Status Admin Sebelumnya Aktif?');
        if(r == true){
          window.location = '".base_url()."Handle/Hapus_gudang/".$handle['kode_handle']."';
        }
        
      }
    ";

    $no++;}
  ?>
</script>
<script type="text/javascript">
  <?php $no=1; foreach ($data1 as $handle) { ?>
    function ubah<?php echo $no;?>(){
      SetInput('<?php echo $handle['kode_handle'];?>','<?php echo $handle['alamat_perwakilan'];?>','<?php echo $handle['kode_perwakilan'];?>');
      document.getElementById('kode_admgudang1').innerHTML='<option value= "">--Pilih Admin gudang Pengganti--</option>  <?php foreach ($data2 as $admgudang) {if ($admgudang['kode_admgudang'] != $handle['kode_admgudang']){echo '<option value="'.$admgudang['kode_admgudang'].'">'.$admgudang['nama_admgudang'].'</option>';}}?>';
    }
  <?php $no++;} ?>
  
</script>
