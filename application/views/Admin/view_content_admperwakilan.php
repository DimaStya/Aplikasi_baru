<script src = "<?php echo base_url('js/admperwakilan.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Admin Perwakilan</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Admin Perwakilan</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_admperwakilan'; ?>" autocomplete="off" method="POST">
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
                    <div class="col-lg-6"> 
                      <label>Pilih Nama Manajer Area</label>
                      <select class="form-control" id ='kode_area' name='kode_area' required="">
                        <option value= "">--Pilih Nama Manajer Area--</option>
                      </select>
                      
                        <div id="loading" style="margin-top: 15px;">
                          <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                        </div>
                    </div>
                  </div>
                   <div class="box-body">
                    <div class="col-lg-6"> 
                      <label>Pilih Alamat Perwakilan</label>
                      <select class="form-control" id ='kode_perwakilan' name='kode_perwakilan' required="">
                        <option value= "">--Pilih Alamat Perwakilan--</option>
                      </select>
                      
                        <div id="loading1" style="margin-top: 15px;">
                          <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                        </div>
                    </div>
                  </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control col-xs-6" name="nama_admper" id="nama_admper"  placeholder="Nama Lengkap" required="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Email</label>
                      <input type="text" class="form-control col-xs-6" name="email" id="email"  placeholder="Nama Lengkap" required="">
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
  <div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Admin Perwakilan</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_admperwakilan'; ?>" autocomplete="off" method="POST">
                <input type="hidden" name="kode_admper" id="kode_admper">
               <div class="box-body">
                  <div class="col-lg-6">
                    <label>Nama Manajer Nasional Sebelumnya</label>
                    <input type="text" class="form-control col-xs-6" name="nama_nasional" id="nama_nasional" readonly=""></div>
                  </div>
                  <div class="box-body">
                  <div class="col-lg-6">
                    <label>Nama Manajer Area Sebelumnya</label>
                    <input type="text" class="form-control col-xs-6" name="nama_area" id="nama_area" readonly=""></div>
                  </div>
                   <div class="box-body">
                  <div class="col-lg-6">
                    <label>Alamat Perwakilan Sebelumnya</label>
                    <input type="text" class="form-control col-xs-6" name="alamat_perwakilan" id="alamat_perwakilan" readonly=""></div>
                  </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control col-xs-6" name="upnama_admper" id="upnama_admper"  placeholder="Nama Lengkap" required="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Email</label>
                      <input type="text" class="form-control col-xs-6" name="upemail" id="upemail"  placeholder="Nama Lengkap" required="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>No-telp</label>
                      <input type="text" class="form-control col-xs-6" name="upno_telp" id="upno_telp" placeholder="No Telp" required="" onkeypress="return hanyaAngka(event)">
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
              <h3 class="box-title">Data Admin Perwakilan</h3>&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','','','','','')">+</button>
      
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Nama Admin</th>
                  <th>Alamat Perwakilan</th>
                  <th>Email</th>
                  <th>No Telp</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data1 as $sales) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                     <td><?php echo $sales['nama_admper'];?></td>
                    <td><?php echo $sales['alamat_perwakilan'];?></td>
                    <td><?php echo $sales['email'];?></td>
                    <td><?php echo $sales['no_telp'];?></td>
                    <td><?php echo $sales['aktif'];?></td>
                    <td width="10%"><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal1' onclick="SetInput('<?php echo $sales['kode_admper'];?>','<?php echo $sales['nama_nasional'];?>','<?php echo $sales['nama_area'];?>','<?php echo $sales['alamat_perwakilan'];?>','<?php echo $sales['nama_admper'];?>','<?php echo $sales['email'];?>','<?php echo $sales['no_telp'];?>')"><i class='fa fa-fw fa-pencil-square-o'></i></button>|<button onclick='Klik<?php echo $no;?>()' type='button' class='btn-danger'><i class='fa fa-fw fa-sign-out'></i></button></td></td>
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
  <?php $no=1; foreach ($data1 as $sales) { 
    echo "
      function Klik".$no."(){
        var r = confirm('Yakin Data resign?');
        if(r == true){
          window.location = '".base_url()."Proses/Hapus_admperwakilan/".$sales['kode_admper']."';
        }
        
      }
    ";

    $no++;}
  ?>
</script>

<!-- Load librari/plugin jquery nya -->
  <script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>
  
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    $("#loading1").hide();
    
    $("#kode_nasional").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kode_area").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Form/Area"); ?>", // Isi dengan url/path file php yang dituju
        data: {kode_nasional : $("#kode_nasional").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading").hide(); // Sembunyikan loadingnya

          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#kode_area").html(response.area).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });

    $("#kode_area").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kode_perwakilan").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading1").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Form/Perwakilanadm"); ?>", // Isi dengan url/path file php yang dituju
        data: {kode_area : $("#kode_area").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading1").hide(); // Sembunyikan loadingnya

          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#kode_perwakilan").html(response.perwakilan).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });
  });
  </script>
    <script type="text/javascript">
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
  </script>