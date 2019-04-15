<script src = "<?php echo base_url('js/harga.js'); ?>"></script>
<script charset="utf-8" type="text/javascript">
  function sekarangjawa(){
    var bilangan=document.getElementById("sekarang_jawa").value;
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
    document.getElementById("sekarangjawa").innerHTML=kalimat;
}
 function sekarangluar(){
    var bilangan=document.getElementById("sekarang_luar").value;
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
    document.getElementById("sekarangluar").innerHTML=kalimat;
}
 function depanjawa(){
    var bilangan=document.getElementById("depan_jawa").value;
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
    document.getElementById("depanjawa").innerHTML=kalimat;
}
 function depanluar(){
    var bilangan=document.getElementById("depan_luar").value;
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
    document.getElementById("depanluar").innerHTML=kalimat;
}
</script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Harga</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Harga Buku Tahun <?php echo $tahun;?></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
              <form role="form" action="<?php echo base_url().'Proses/Harga'; ?>" autocomplete="off" method="POST">
                <input type="hidden" name="tahun_sekarang" id="tahun_sekarang">
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-xs-6">
                        <label>Kode Buku</label>
                        <input type="text" class="form-control col-xs-6" name="kode_bukusekarang" id="kode_bukusekarang"  placeholder="Kode Buku" required="" readonly="">
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-xs-6">
                        <label>Harga Jawa</label>
                        <input type="text" class="form-control col-xs-6" name="sekarang_jawa" id="sekarang_jawa"  placeholder="Harga Jawa" onkeyup="sekarangjawa();" onkeypress="return hanyaAngka(event)" required=""  >
                        <div id="sekarangjawa"></div>
                    </div>
                    <div class="col-xs-6">
                        <label>Harga Luar Jawa</label>
                        <input type="text" class="form-control col-xs-6" name="sekarang_luar" id="sekarang_luar"  placeholder="Harga Luar Jawa" required="" onkeyup="sekarangluar();" onkeypress="return hanyaAngka(event)">
                        <div id="sekarangluar"></div>
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
          <h4 class="modal-title">Kelola Harga Buku Tahun <?php echo $tahun+1;?></h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
              <form role="form" action="<?php echo base_url().'Proses/Harga'; ?>" autocomplete="off" method="POST">
                <input type="hidden" name="tahun_depan" id="tahun_depan">
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-xs-6">
                        <label>Kode Buku</label>
                        <input type="text" class="form-control col-xs-6" name="kode_bukudepan" id="kode_bukudepan"  placeholder="Kode Buku" required="" readonly="">
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="form-group"> 
                    <div class="col-xs-6">
                        <label>Harga Jawa</label>
                        <input type="text" class="form-control col-xs-6" name="depan_jawa" id="depan_jawa"  placeholder="Harga Jawa" required="" onkeyup="depanjawa();" onkeypress="return hanyaAngka(event)">
                        <div id="depanjawa"></div>
                    </div>
                    <div class="col-xs-6">
                        <label>Harga Luar Jawa</label>
                        <input type="text" class="form-control col-xs-6" name="depan_luar" id="depan_luar"  placeholder="Harga Luar Jawa" required="" onkeyup="depanluar();" onkeypress="return hanyaAngka(event)">
                        <div id="depanluar"></div>
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
              <h3 class="box-title">Data Harga Buku</h3>
      
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">No</th>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Kode Buku</th>
                    <th rowspan="3" style="vertical-align: middle; text-align: center;">Judul</th>
                    <td colspan="4" align="center"><b>Harga</b></td>
                    <th rowspan="3" style="vertical-align: middle;  text-align: center;">Ubah Harga Tahun</th>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><?php echo $tahun;?></td>
                    <td colspan="2" align="center"><?php echo $tahun+1;?></td>
                  </tr>
                  <tr>
                    <th style="text-align: center;">Jawa</th>
                    <th style="text-align: center;">Luar Jawa</th>
                    <th style="text-align: center;">Jawa</th>
                    <th style="text-align: center;">Luar Jawa</th>
                  </tr>
                </thead>
                <tbody>
                   <?php $no=1; foreach ($data as $buku) { ?>
                  <tr>
                    <td width="3%"><?php echo $no;?></td>
                    <td width="10%"><?php echo $buku['kode_buku'];?></td>
                    <td width="50%"><?php echo $buku['judul'];?></td>
                    <?php 
                    if($harga=='-1'){
                      echo "
                      <td>".$buku['sekarang_jawa']."</td>
                      <td>".$buku['sekarang_luar']."</td>
                      <td>--</td>
                      <td>--</td>";
                   } 
                   else if($harga=='1'){
                    echo "
                      <td>".$buku['sekarang_jawa']."</td>
                      <td>".$buku['sekarang_luar']."</td>
                      <td>--</td>
                      <td>--</td>";
                   }
                   else if($harga=='2'){
                    echo "
                      <td>".$buku['sekarang_jawa']."</td>
                      <td>".$buku['sekarang_luar']."</td>
                      <td>".$buku['depan_jawa']."</td>
                      <td>".$buku['depan_luar']."</td>";
                   }
                   else if($harga=='3'){
                    echo "
                      <td>".$buku['sekarang_jawa']."</td>
                      <td>".$buku['sekarang_luar']."</td>
                      <td>".$buku['depan_jawa']."</td>
                      <td>".$buku['depan_luar']."></td>";
                   } ?>
                   <?php  
                   if($harga=='-1' OR $harga=='1'){?>

                      <td width= '10%'><button title='Edit' type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick="SetInput('<?php echo $buku['kode_buku'];?>','<?php echo $buku['sekarang_jawa'];?>','<?php echo $buku['sekarang_luar'];?>','<?php echo $tahun;?>','','')"><?php echo $tahun;?></i></button></td>
                    
                   <?php }else if($harga=='2' OR $harga=='3'){
                    $tahun_ = $tahun+1;?>
                      <td width= '13%'><button title='Edit' type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick="SetInput('<?php echo $buku['kode_buku'];?>','<?php echo $buku['sekarang_jawa'];?>','<?php echo $buku['sekarang_luar'];?>','','<?php echo $tahun;?>','','')"><?php echo $tahun;?></button> <button title='Edit' type='button' class='btn-success' data-toggle='modal' data-target='#myModal1' onclick="SetInput('<?php echo $buku['kode_buku'];?>','','','<?php echo $tahun_;?>','','<?php echo $buku['depan_jawa'];?>','<?php echo $buku['depan_luar'];?>')"><?php echo $tahun_;?></button>
                      </td>

                   <?php }
                   ?>
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
  <script type="text/javascript">
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
  </script>