<style type="text/css">
      .scrol{
        overflow-y: auto;
        overflow-x: scroll;
      }
</style>
<script src = "<?php echo base_url('js/buku.js'); ?>"></script>
<script charset="utf-8" type="text/javascript">
  function hargajawa(){
    var bilangan=document.getElementById("harga_jawa").value;
    var kalimat="";
    var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
    var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
    var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
    var panjang_bilangan = bilangan.length;
     
    /* pengujian panjang bilangan */
    if(panjang_bilangan > 15){
        kalimat = "Diluar Batas";
    }else{
        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for(i = 1; i <= panjang_bilangan; i++) {
            angka[i] = bilangan.substr(-(i),1);
        }
         
        var i = 1;
        var j = 0;
         
        /* mulai proses iterasi terhadap array angka */
        while(i <= panjang_bilangan){
            subkalimat = "";
            kata1 = "";
            kata2 = "";
            kata3 = "";
             
            /* untuk Ratusan */
            if(angka[i+2] != "0"){
                if(angka[i+2] == "1"){
                    kata1 = "Seratus";
                }else{
                    kata1 = kata[angka[i+2]] + " Ratus";
                }
            }
             
            /* untuk Puluhan atau Belasan */
            if(angka[i+1] != "0"){
                if(angka[i+1] == "1"){
                    if(angka[i] == "0"){
                        kata2 = "Sepuluh";
                    }else if(angka[i] == "1"){
                        kata2 = "Sebelas";
                    }else{
                        kata2 = kata[angka[i]] + " Belas";
                    }
                }else{
                    kata2 = kata[angka[i+1]] + " Puluh";
                }
            }
             
            /* untuk Satuan */
            if (angka[i] != "0"){
                if (angka[i+1] != "1"){
                    kata3 = kata[angka[i]];
                }
            }
             
            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
            if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
                subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
            }
             
            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
            kalimat = subkalimat + kalimat;
            i = i + 3;
            j = j + 1;
        }
         
        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
        if ((angka[5] == "0") && (angka[6] == "0")){
            kalimat = kalimat.replace("Satu Ribu","Seribu");
        }
    }
    document.getElementById("hargajawa").innerHTML=kalimat;
}
 function hargaluar(){
    var bilangan=document.getElementById("harga_luar").value;
    var kalimat="";
    var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
    var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
    var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
    var panjang_bilangan = bilangan.length;
     
    /* pengujian panjang bilangan */
    if(panjang_bilangan > 15){
        kalimat = "Diluar Batas";
    }else{
        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for(i = 1; i <= panjang_bilangan; i++) {
            angka[i] = bilangan.substr(-(i),1);
        }
         
        var i = 1;
        var j = 0;
         
        /* mulai proses iterasi terhadap array angka */
        while(i <= panjang_bilangan){
            subkalimat = "";
            kata1 = "";
            kata2 = "";
            kata3 = "";
             
            /* untuk Ratusan */
            if(angka[i+2] != "0"){
                if(angka[i+2] == "1"){
                    kata1 = "Seratus";
                }else{
                    kata1 = kata[angka[i+2]] + " Ratus";
                }
            }
             
            /* untuk Puluhan atau Belasan */
            if(angka[i+1] != "0"){
                if(angka[i+1] == "1"){
                    if(angka[i] == "0"){
                        kata2 = "Sepuluh";
                    }else if(angka[i] == "1"){
                        kata2 = "Sebelas";
                    }else{
                        kata2 = kata[angka[i]] + " Belas";
                    }
                }else{
                    kata2 = kata[angka[i+1]] + " Puluh";
                }
            }
             
            /* untuk Satuan */
            if (angka[i] != "0"){
                if (angka[i+1] != "1"){
                    kata3 = kata[angka[i]];
                }
            }
             
            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
            if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
                subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
            }
             
            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
            kalimat = subkalimat + kalimat;
            i = i + 3;
            j = j + 1;
        }
         
        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
        if ((angka[5] == "0") && (angka[6] == "0")){
            kalimat = kalimat.replace("Satu Ribu","Seribu");
        }
    }
    document.getElementById("hargaluar").innerHTML=kalimat;
}
</script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Buku</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Buku</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
              <form role="form" action="<?php echo base_url().'Proses/Add_buku'; ?>"  autocomplete="off" method="POST">
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-xs-6">
                        <label>Kode Buku</label>
                        <input type="text" class="form-control col-xs-6" name="kode_buku" id="kode_buku"  placeholder="Kode Buku" required="">
                    </div>
                    <div class="col-lg-6"> 
                      <label>Pilih Penerbit</label>
                      <select class="form-control" id ='kode_penerbit' name='kode_penerbit' required="">
                        <option value= "">--Pilih Nama Penerbit--</option>
                        <?php foreach ($data2 as $penerbit) { 
                          echo '<option value= "'.$penerbit['kode_penerbit'].'">'.$penerbit['nama_penerbit'].'</option>';
                        }?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-lg-6"> 
                      <label>Pilih Jenjang</label>
                      <select class="form-control" id ='jenjang' name='jenjang' required="">
                        <option value= "">--Pilih Jenjang--</option>
                        <option value= "PAUD/TK">PAUD/TK</option>
                        <option value= "SD/MI">SD/MI</option>
                        <option value= "SMP/MTS">SMP/MTS</option>
                        <option value= "SMA/MA">SMA/MA</option>
                        <option value= "SMK">SMK</option>
                        <option value= "UMUM">UMUM</option>
                      </select>
                    </div>
                    <div class="col-xs-6">
                        <label>Kelas</label>
                        <input type="text" class="form-control col-xs-6" name="kelas" id="kelas"  placeholder="Kelas" required="">
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-lg-6"> 
                      <label>Pilih Tipe</label>
                      <select class="form-control" id ='tipe' name='tipe' required="">
                        <option value= "">--Pilih Tipe--</option>
                        <option value= "MATERI">MATERI</option>
                        <option value= "MODUL">MODUL</option>
                        <option value= "BKS/UN">BKS/UN</option>
                        <option value= "UMUM">UMUM</option>
                      </select>
                    </div>
                    <div class="col-xs-6">
                        <label>Kurikulum</label>
                        <input type="text" class="form-control col-xs-6" name="kurikulum" id="kurikulum"  placeholder="Kurikulum" required="">
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-xs-6">
                        <label>Judul</label>
                        <textarea style="resize:none;width:250px;height:100px;" class="form-control col-xs-6" name="judul" id="judul" required="" placeholder="Judul"></textarea>
                    </div>
                    <div class="col-xs-6">
                        <label>Edisi</label>
                        <input type="text" class="form-control col-xs-6" name="edisi" id="edisi" placeholder="Edisi" required="">
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-xs-6">
                        <label>Harga Jawa</label>
                        <input type="text" class="form-control col-xs-6" name="harga_jawa" id="harga_jawa"  placeholder="Harga Jawa" required="" onkeyup="hargajawa();" onkeypress="return hanyaAngka(event)">
                        <div id="hargajawa"></div>
                    </div>
                    <div class="col-xs-6">
                        <label>Harga Luar Jawa</label>
                        <input type="text" class="form-control col-xs-6" name="harga_luar" id="harga_luar"  placeholder="Harga Luar Jawa" required="" onkeyup="hargaluar();" onkeypress="return hanyaAngka(event)">
                        <div id="hargaluar"></div>
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
          <h4 class="modal-title">Kelola Data Buku</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
              <form role="form" action="<?php echo base_url().'Proses/Add_buku'; ?>"  autocomplete="off" method="POST">
                <input type="hidden" name="kode_bukuhidden" id="kode_bukuhidden">
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-xs-6">
                        <label>Kode Buku</label>
                        <input type="text" class="form-control col-xs-6" name="kode_bukunew" id="kode_bukunew"  placeholder="Kode Buku" required="">
                    </div>
                    <div class="col-lg-6"> 
                      <label>Pilih Penerbit</label>
                      <select class="form-control" id ='kode_penerbitnew' name='kode_penerbitnew' required="">
                        <option value= "">--Pilih Nama Penerbit--</option>
                        <?php foreach ($data2 as $penerbit) { 
                          echo '<option value= "'.$penerbit['kode_penerbit'].'">'.$penerbit['nama_penerbit'].'</option>';
                        }?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-lg-6"> 
                      <label>Pilih Jenjang</label>
                      <select class="form-control" id ='jenjangnew' name='jenjangnew' required="">
                        <option value= "">--Pilih Jenjang--</option>
                        <option value= "PAUD/TK">PAUD/TK</option>
                        <option value= "SD/MI">SD/MI</option>
                        <option value= "SMP/MTS">SMP/MTS</option>
                        <option value= "SMA/MA">SMA/MA</option>
                        <option value= "SMK">SMK</option>
                        <option value= "UMUM">UMUM</option>
                      </select>
                    </div>
                    <div class="col-xs-6">
                        <label>Kelas</label>
                        <input type="text" class="form-control col-xs-6" name="kelasnew" id="kelasnew"  placeholder="Kelas" required="">
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-lg-6"> 
                      <label>Pilih Tipe</label>
                      <select class="form-control" id ='tipenew' name='tipenew' required="">
                        <option value= "">--Pilih Tipe--</option>
                        <option value= "MATERI">MATERI</option>
                        <option value= "MODUL">MODUL</option>
                        <option value= "BKS/UN">BKS/UN</option>
                        <option value= "UMUM">UMUM</option>
                      </select>
                    </div>
                    <div class="col-xs-6">
                        <label>Kurikulum</label>
                        <input type="text" class="form-control col-xs-6" name="kurikulumnew" id="kurikulumnew"  placeholder="Kurikulum" required="">
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-xs-6">
                        <label>Judul</label>
                        <textarea style="resize:none;width:250px;height:100px;" class="form-control col-xs-6" name="judulnew" id="judulnew" required="" placeholder="Judul"></textarea>
                    </div>
                    <div class="col-xs-6">
                        <label>Edisi</label>
                        <input type="text" class="form-control col-xs-6" name="edisinew" id="edisinew" placeholder="Edisi" required="">
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
              <h3 class="box-title">Data Buku</h3>&nbsp;<button title='Tambah Baru' type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','','','','','')">+</button>
      
            </div>
            <div class="box-body">
              <div class="scrol">
            <table id="example1" class="table table-bordered table-striped" style="width: 150%;">
                <thead>
                  <tr>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">No</th>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Kode Buku</th>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Judul</th>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Edisi</th>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Jenjang</th>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Kurikulum</th>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Stok Real</th>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Stok Pesan</th>
                    <td colspan="6" align="center"><b>Harga</b></td>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Aksi</th>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" ><?php echo $tahun-1;?></td>
                    <td colspan="2" align="center"><?php echo $tahun;?></td>
                    <td colspan="2" align="center"><?php echo $tahun+1;?></td>
                  </tr>
                  <tr>
                    <th style="width: 5%; text-align: center;">Jawa</th>
                    <th style="width: 5%; text-align: center;">Luar Jawa</th>
                    <th style="width: 5%; text-align: center;">Jawa</th>
                    <th style="width: 5%; text-align: center;">Luar Jawa</th>
                    <th style="width: 5%; text-align: center;">Jawa</th>
                    <th style="width: 5%; text-align: center;">Luar Jawa</th>
                  </tr>
                </thead>
                <tbody>
                   <?php $no=1; foreach ($data as $buku) { ?>
                  <tr>
                    <td width="3%"><?php echo $no;?></td>
                    <td width="5%"><?php echo $buku['kode_buku'];?></td>
                    <td width="30%"><?php echo $buku['judul'];?></td>
                    <td width="3%"><?php echo $buku['edisi'];?></td>
                    <td width="3%"><?php echo $buku['jenjang'];?></td>
                    <td width="3%"><?php echo $buku['kurikulum'];?></td>
                    <td width="5%"><?php echo $buku['stok_real'];?></td>
                    <td width="5%"><?php echo $buku['stok_pesan'];?></td>
                    <?php 
                    if($harga=='-1'){
                      echo "<td>--</td>
                            <td>--</td>
                      <td>".$buku['sekarang_jawa']."</td>
                      <td>".$buku['sekarang_luar']."</td>
                      <td>--</td>
                      <td>--</td>";
                   } 
                   else if($harga=='1'){
                    echo "
                      <td>".$buku['lalu_jawa']."</td>
                      <td>".$buku['lalu_luar']."</td>
                      <td>".$buku['sekarang_jawa']."</td>
                      <td>".$buku['sekarang_luar']."</td>
                      <td>--</td>
                      <td>--</td>";
                   }
                   else if($harga=='2'){
                    echo "
                      <td>--</td>
                      <td>--</td>
                      <td>".$buku['sekarang_jawa']."</td>
                      <td>".$buku['sekarang_luar']."</td>
                      <td>".$buku['depan_jawa']."</td>
                      <td>".$buku['depan_luar']."</td>";
                   }
                   else if($harga=='3'){
                    echo "
                      <td>".$buku['lalu_jawa']."</td>
                      <td>".$buku['lalu_luar']."</td>
                      <td>".$buku['sekarang_jawa']."</td>
                      <td>".$buku['sekarang_luar']."</td>
                      <td>".$buku['depan_jawa']."</td>
                      <td>".$buku['depan_luar']."></td>";
                   } ?>
                    <td width= '3%'><button title='Edit' type='button' class='btn-info' data-toggle='modal' data-target='#myModal1' onclick="SetInput('<?php echo $buku['kode_buku'];?>','<?php echo $buku['kode_penerbit'];?>','<?php echo $buku['jenjang'];?>','<?php echo $buku['kelas'];?>','<?php echo $buku['tipe'];?>','<?php echo $buku['kurikulum'];?>','<?php echo $buku['judul'];?>','<?php echo $buku['edisi'];?>')"><i class='fa fa-fw fa-pencil-square-o'></i></button></td>
                  </tr>
                  <?php $no++;} ?>
                </tbody>
                </tfoot>
              </table>
            </div>
            </div>
        </div>
    </section>
</div>

<!-- Load librari/plugin jquery nya -->
  <script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>
  <script type="text/javascript">
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
  </script>