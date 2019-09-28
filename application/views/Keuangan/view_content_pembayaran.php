<script src = "<?php echo base_url('js/bkm.js'); ?>"></script>
<script type="text/javascript">
  function terbilang(){
    var bilangan=document.getElementById("total").value;
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
    document.getElementById("terbilang").innerHTML=kalimat;
}
</script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Pembayaran</li>
    </ol>
  </section>
  <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Pembayaran</h3>
      
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="4%">No</th>
                  <th>No BKM</th>
                  <th>No Faktur</th>
                  <th>Tanggal</th>
                  <th>Total Pembayaran</th>
                  <th width="17%" colspan="2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($pembayaran as $pembayaran) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                     <td><?php echo $pembayaran['no_kas'];?></td>
                    <td><?php echo $pembayaran['no_faktur'];?></td>
                    <td><?php echo $pembayaran['tanggal'];?></td>
                    <td align="right"><?php echo number_format($pembayaran['total'],0,',','.');?></td>
                    <td>
                      <form action="<?php echo base_url().'Keuangan/Hapus_bayar/';?>" method="POST">
                        <input type="hidden" name="no_kas" id="no_kas" value="<?php echo $pembayaran['no_kas'];?>">
                        <input type="hidden" name="no_faktur" id="no_faktur" value="<?php echo $pembayaran['no_faktur'];?>">
                        <input type="hidden" name="tanggal" id="tanggal" value="<?php echo $pembayaran['tanggal'];?>">
                        <input type="hidden" name="total" id="total" value="<?php echo $pembayaran['total'];?>">
                        <button type='submit' class='btn btn-danger'><i class='fa fa-scissors'></i>|Hapus</button>
                      </form>
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