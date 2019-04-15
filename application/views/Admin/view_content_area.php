<script src = "<?php echo base_url('js/area.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Area</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Area</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_area'; ?>" autocomplete="off" method="POST">
                <input type="hidden" name="kode_area" id="kode_area">
                <div class="box-body">
                  <div class="col-lg-6">                   
                    <label>Pilih Nama Manajer Nasional</label>
                      <select class="form-control" id ='kode_nasional' name='kode_nasional' required="">
                      <option value= "">--Pilih Nama Manajer Nasional--</option>
                      <?php foreach ($data2 as $nasional) { 
                        echo '<option value= "'.$nasional['kode_nasional'].'">'.$nasional['nama_nasional'].'</option>';
                      }?>
                      </select>
                  </div>
                  </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control col-xs-6" name="nama_area" id="nama_area"  placeholder="Nama Lengkap" required="">
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
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Area</label>
                      <input type="text" class="form-control col-xs-6" name="area" id="area" placeholder="Area">
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
              <h3 class="box-title">Data Manager Area</h3>&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','','','')">+</button>
      
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Manager Nasional</th>
                  <th>Email</th>
                  <th>No Telp</th>
                  <th>Area</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data1 as $area) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                     <td><?php echo $area['nama_area'];?></td>
                    <td><?php echo $area['nama_nasional'];?></td>
                    <td><?php echo $area['email'];?></td>
                    <td><?php echo $area['no_telp'];?></td>
                    <td><?php echo $area['area'];?></td>
                    <td><?php echo $area['aktif'];?></td>
                    <td width="10%"><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick="SetInput('<?php echo $area['kode_area'];?>','<?php echo $area['nama_area'];?>','<?php echo $area['kode_nasional'];?>','<?php echo $area['email'];?>','<?php echo $area['no_telp'];?>','<?php echo $area['area'];?>')"><i class='fa fa-fw fa-pencil-square-o'></i></button>|<button onclick='Klik<?php echo $no;?>()' type='button' class='btn-danger'><i class='fa fa-fw fa-sign-out'></i></button></td></td>
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
  <?php $no=1; foreach ($data1 as $area) { 
    echo "
      function Klik".$no."(){
        var r = confirm('Yakin Data resign?');
        if(r == true){
          window.location = '".base_url()."Proses/Hapus_area/".$area['kode_area']."';
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