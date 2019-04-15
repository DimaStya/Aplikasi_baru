<script src = "<?php echo base_url('js/perwakilan.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Perwakilan</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Perwakilan</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_perwakilan'; ?>" autocomplete="off" method="POST">
                <input type="hidden" name="kode_perwakilan" id="kode_perwakilan">
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
                  <div class="col-lg-6">
                    <label>Nama Manajer Area Sebelumnya</label>
                    <input type="text" class="form-control col-xs-6" name="nama_area" id="nama_area" readonly=""></div>
                  </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control col-xs-6" name="nama_kaper" id="nama_kaper"  placeholder="Nama Lengkap" required="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Kode Wilayah</label>
                      <input type="text" class="form-control col-xs-6" name="kode_wilayah" id="kode_wilayah"  placeholder="Kode Wilayah" required="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Alamat Perwakilan</label>
                      <input type="text" class="form-control col-xs-6" name="alamat_perwakilan" id="alamat_perwakilan"  placeholder="Alamat Perwakilan" required="">
                  </div>
                  <div class="col-lg-6"> 
                    <label>Pilih Kawasan</label>
                    <select class="form-control" id ='kawasan' name='kawasan' required="">
                      <option value= "">--Pilih Kawasan--</option>
                      <option value= "jawa">Jawa</option>
                      <option value= "luar">Luar Jawa</option>
                    </select>
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

  <div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Perwakilan Pengganti</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_perwakilan'; ?>" autocomplete="off" method="POST">
                <input type="hidden" name="kode_areanew" id="kode_areanew">
                <input type="hidden" name="kode_perwakilanold" id="kode_perwakilanold">
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nama Lengkap Pengganti</label>
                      <input type="text" class="form-control col-xs-6" name="nama_kapernew" id="nama_kapernew"  placeholder="Nama Lengkap" required="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Kode Wilayah</label>
                      <input type="text" class="form-control col-xs-6" name="kode_wilayahnew" id="kode_wilayahnew"  placeholder="Kode Wilayah" required="" readonly="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Alamat Perwakilan</label>
                      <input type="text" class="form-control col-xs-6" name="alamat_perwakilannew" id="alamat_perwakilannew"  placeholder="Alamat Perwakilan" required="" readonly="">
                  </div>
                </div>
              </div><div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Kawasan</label>
                      <input type="text" class="form-control col-xs-6" name="kawasannew" id="kawasannew"  placeholder="Kawasan" required="" readonly="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                    
                  <div class="col-xs-6">
                      <label>Email</label>
                      <input type="email" class="form-control col-xs-6" name="emailnew" id="emailnew"  placeholder="Email" required="">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>No-telp</label>
                      <input type="text" class="form-control col-xs-6" name="no_telpnew" id="no_telpnew" placeholder="No Telp" required="" onkeypress="return hanyaAngka(event)">
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
              <h3 class="box-title">Data Perwakilan</h3>&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','','','','','','','','','','','','')">+</button>
      
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Nama Kaper</th>
                  <th>Manager Nasional</th>
                  <th>Manager Area</th>
                  <th>Kode Wilayah</th>
                  <th>Alamat Perwakilan</th>
                  <th>Email</th>
                  <th>No Telp</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data1 as $perwakilan) { ?>
                  <tr>
                    <td width="3%"><?php echo $no;?></td>
                    <td width="15%"><?php echo $perwakilan['nama_kaper'];?></td>
                    <td width="15%"><?php echo $perwakilan['nama_nasional'];?></td>
                    <td width="15%"><?php echo $perwakilan['nama_area'];?></td>
                    <td width="5%"><?php echo $perwakilan['kode_wilayah'];?></td>
                    <td width="10%"><?php echo $perwakilan['alamat_perwakilan'];?></td>
                    <td width="11%"><?php echo $perwakilan['email'];?></td>
                    <td width="11%"><?php echo $perwakilan['no_telp'];?></td>
                    <td width="5%"><?php echo $perwakilan['aktif'];?></td>
                    <td width="10%"><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick="SetInput('<?php echo $perwakilan['kode_perwakilan'];?>','<?php echo $perwakilan['kode_nasional'];?>','<?php echo $perwakilan['nama_area'];?>','<?php echo $perwakilan['nama_kaper'];?>','<?php echo $perwakilan['kode_wilayah'];?>','<?php echo $perwakilan['alamat_perwakilan'];?>','<?php echo $perwakilan['email'];?>','<?php echo $perwakilan['no_telp'];?>','','','','','','','<?php echo $perwakilan['kawasan'];?>')"><i class='fa fa-fw fa-pencil-square-o'></i></button>|<button type='button' class='btn-danger' data-toggle='modal' data-target='#myModal1' onclick="SetInput('<?php echo $perwakilan['kode_perwakilan'];?>','','','','','','','','<?php echo $perwakilan['kode_area'];?>','','<?php echo $perwakilan['kode_wilayah'];?>','<?php echo $perwakilan['alamat_perwakilan'];?>','','','<?php echo $perwakilan['kawasan'];?>')"><i class='fa fa-fw fa-repeat'></i></button></td></td>
                  </tr>
                  <?php $no++;} ?>
                </tbody>
                </tfoot>
              </table>
            </div>
        </div>
    </section>
</div>

<!-- Load librari/plugin jquery nya -->
  <script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>
  
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    
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