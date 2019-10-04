<script src = "<?php echo base_url('js/mou.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">MoU</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog"> <!-- Data baru -->
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data MoU CV</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_mou'; ?>" autocomplete="off" method="POST">
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
                    <div class="col-lg-6"> 
                      <label>Pilih Nama CV Rekanan</label>
                      <select class="form-control" id ='kode_cv' name='kode_cv' required="">
                        <option value= "">--Pilih Nama CV--</option>
                      </select>
                      
                        <div id="loading2" style="margin-top: 15px;">
                          <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                        </div>
                    </div>
                  </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                    <label>Tanggal</label>
                      <input type="date" class="form-control col-xs-6" name="tanggal" id="tanggal" required="">
                  </div>
                </div>
              </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nomor MoU</label>
                      <input type="text" class="form-control col-xs-6" name="no_mou" id="no_mou"  placeholder="Nomor MoU" required="">
                  </div>
                </div>
              </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nilai Fee</label>
                      <input type="text" class="form-control col-xs-6" name="fee" id="fee"  placeholder="Nilai Fee Dalam %" required="" onKeyPress="return goodchars(event,'0123456789.',this)">
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

<div id="myModal3" class="modal fade" role="dialog"> <!-- Ubah data -->
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data MoU</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_mou'; ?>" autocomplete="off" method="POST">
                <input type="hidden" name="no_mouhidden" id="no_mouhidden">
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
                  <div class="col-lg-6">
                    <label>Nama CV Sebelumnya</label>
                    <input type="text" class="form-control col-xs-6" name="nama_cv" id="nama_cv" readonly=""></div>
                  </div>
                  <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                    <label>Tanggal</label>
                      <input type="date" class="form-control col-xs-6" name="tanggaledit" id="tanggaledit" required="">
                  </div>
                </div>
              </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nomor MoU</label>
                      <input type="text" class="form-control col-xs-6" name="no_mouedit" id="no_mouedit"  placeholder="Nomor MoU" required="">
                  </div>
                </div>
              </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nilai Fee</label>
                      <input type="text" class="form-control col-xs-6" name="feeedit" id="feeedit"  placeholder="Nilai Fee Dalam %" required="" onKeyPress="return goodchars(event,'0123456789.',this)">
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

  <div id="myModal1" class="modal fade" role="dialog"> <!-- Data Pergantian -->
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data mou Pengganti</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_mou'; ?>" autocomplete="off" method="POST">
                <input type="hidden" name="no_mouold" id="no_mouold">
                <input type="hidden" name="kode_cvold" id="kode_cvold">
                  <div class="box-body">
                    <div class="col-lg-6">
                      <label>Perwakilan</label>
                      <input type="text" class="form-control col-xs-6" name="alamat_perwakilanold" id="alamat_perwakilanold" readonly="">
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="col-lg-6">
                      <label>Nama CV Rekanan</label>
                      <input type="text" class="form-control col-xs-6" name="nama_cvold" id="nama_cvold" readonly="">
                    </div>
                  </div>
                  <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                    <label>Tanggal</label>
                      <input type="date" class="form-control col-xs-6" name="tanggalnew" id="tanggalnew" required="">
                  </div>
                </div>
              </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nomor MoU Baru</label>
                      <input type="text" class="form-control col-xs-6" name="no_mounew" id="no_mounew"  placeholder="Nomor MoU" required="">
                  </div>
                </div>
              </div>
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nilai Fee</label>
                      <input type="text" class="form-control col-xs-6" name="feenew" id="feenew"  placeholder="Nilai Fee Dalam %" required="" onKeyPress="return goodchars(event,'0123456789.',this)">
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
              <h3 class="box-title">Data MoU CV</h3>&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','','','','','','','','','')">+</button>
      
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Nomor MoU</th>
                  <th>Perwakilan</th>
                  <th>Nama CV</th>
                  <th>Tanggal</th>
                  <th>Fee</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data1 as $mou) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                     <td><?php echo $mou['no_mou'];?></td>
                     <td><?php echo $mou['alamat_perwakilan'];?></td>
                     <td><?php echo $mou['nama_cv'];?></td>
                     <td><?php echo $mou['tanggal'];?></td>
                     <td><?php echo $mou['fee'];?> %</td>
                    <td><?php echo $mou['aktif'];?></td>
                    <td width="10%"><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal3' onclick="SetInput('','','','<?php echo $mou['kode_nasional'];?>','<?php echo $mou['no_mou'];?>','<?php echo $mou['tanggal'];?>','<?php echo $mou['nama_area'];?>','<?php echo $mou['alamat_perwakilan'];?>','<?php echo $mou['nama_cv'];?>','<?php echo $mou['fee'];?>')"><i class='fa fa-fw fa-pencil-square-o'></i></button>|<button type='button' class='btn-danger'><i class='fa fa-fw fa-repeat' data-toggle='modal' data-target='#myModal1' onclick="SetInput('','','<?php echo $mou['kode_cv'];?>','','<?php echo $mou['no_mou'];?>','','','<?php echo $mou['alamat_perwakilan'];?>','<?php echo $mou['nama_cv'];?>','')"></i></button></td></td>
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
    $("#loading1").hide();
    $("#loading2").hide();
    
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
        url: "<?php echo base_url("Form/Perwakilan"); ?>", // Isi dengan url/path file php yang dituju
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

    $("#kode_perwakilan").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#kode_cv").hide(); // Sembunyikan dulu combobox kota nya
      $("#loading2").show(); // Tampilkan loadingnya
    
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "<?php echo base_url("Form/CVpengajuan"); ?>", // Isi dengan url/path file php yang dituju
        data: {kode_perwakilan : $("#kode_perwakilan").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading2").hide(); // Sembunyikan loadingnya

          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#kode_cv").html(response.cv).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
        }
      });
    });
  });
  </script>
    <script language="javascript">
function getkey(e)
{
if (window.event)
   return window.event.keyCode;
else if (e)
   return e.which;
else
   return null;
}
function goodchars(e, goods, field)
{
var key, keychar;
key = getkey(e);
if (key == null) return true;
 
keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();
goods = goods.toLowerCase();
 
// check goodkeys
if (goods.indexOf(keychar) != -1)
    return true;
// control keys
if ( key==null || key==0 || key==8 || key==9 || key==27 )
   return true;
    
if (key == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
        if (field == field.form.elements[i])
            break;
    i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
    };
// else return false
return false;
}
</script>