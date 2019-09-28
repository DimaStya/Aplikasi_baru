<script src = "<?php echo base_url('js/pesanan.js'); ?>"></script>
<style type="text/css">
  .GridViewScrollHeader TH, .GridViewScrollHeader TD {
    padding: 10px;
    font-weight: normal;
    white-space: nowrap;
    border-right: 1px solid #e6e6e6;
    border-bottom: 1px solid #e6e6e6;
    background-color: #F4F4F4;
    color: #999999;
    text-align: left;
    vertical-align: bottom;}
 .GridViewScrollItem TD {
    padding: 10px;
    white-space: nowrap;
    border-right: 1px solid #e6e6e6;
    border-bottom: 1px solid #e6e6e6;
    background-color: #FFFFFF;
    color: #444444;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Detail Pesanan</li>
    </ol>
  </section>
    <section class="content">
      <form action="<?php echo base_url().'Keuangan/Proses_faktur/';?>" method="POST">
      <div class="box box-success">
            <div class="box-body">
              <center><h4>FAKTUR DETAIL</h4></center>
              <hr>
              <table width="100%">
                <tr>
                  <td width="16%"></td>
                  <td width="27%"></td>
                  <td width="14%"></td>
                  <td width="16%"></td>
                  <td width="27%"></td>
                </tr>
                <tr>
                  <td colspan="2">Yth: </td>
                  <td></td>
                  <td>Tanggal Faktur</td>
                  <input type="hidden" name="tanggal_faktur" id="tanggal_faktur" value="<?php echo $tanggal_faktur;?>">
                  <td>: <?php echo $tanggal_faktur;?></td>
                </tr>
                <tr>
                  <td colspan="2">Bapak/Ibu <?php 
                  if($head['nama_cv'] == 'Tanpa CV'){
                    echo $head['nama_customer'];
                  }else{
                    echo $head['nama_cv'];
                  }
                  ?>
                  </td>
                  <td></td>
                  <td>No Faktur</td>
                  <input type="hidden" name="no_faktur" id="no_faktur" value="<?php echo $no_faktur;?>">
                  <td>: <?php echo $no_faktur;?></td>
                </tr>
                <tr>
                  <td colspan="2">
                    <?php 
                      if($head['nama_cv'] == 'Tanpa CV'){
                        echo $head['alamat_customer'];
                      }else{
                        echo $head['alamat_cv'];
                      }?>
                  </td>
                  <td></td>
                  <td>No SJ</td>
                  <input type="hidden" name="no_suratjalan" id="no_suratjalan" value="<?php echo $head['no_suratjalan'];?>">
                  <td>: <?php echo $head['no_suratjalan'];?></td>
                </tr>
                <tr>
                  <td colspan="2">
                    <?php 
                      if($head['nama_cv'] == 'Tanpa CV'){
                        echo $head['telp_cust'];
                      }else{
                        echo $head['telp_cv'];
                      }?>
                  </td>
                  <td></td>
                  <td>Tanggal SJ</td>
                  <td>: <?php echo $head['tgl_sj'];?></td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td></td>
                  <td>Nama Kerjasama</td>
                  <td>: <?php echo $head['nama_kerjasama'];?></td>
                </tr>
                <tr>
                  <td>Nama CV/Cust</td>
                  <td>: <?php echo $head['nama_cv'];?> / <?php echo $head['nama_customer'];?></td>
                  <td></td>
                  <td>No MoU</td>
                  <td>: 
                    <?php
                      if($head['no_mou']=="Tanpa CV"){
                       echo "-";
                     }else{
                      echo $head['no_mou'];
                     }
                     ?>
                   </td>                  
                </tr>
                <tr>
                  <td>Nama Pelanggan</td>
                  <td>: <?php echo $head['nama_penerima'];?></td>
                  <td></td>
                  <td>No Pengajuan</td>
                  <td>: 
                    <?php
                      if($head['no_pengajuan']=="Tanpa Pengajuan"){
                       echo "-";
                     }else{
                      echo $head['no_pengajuan'];
                     }
                     ?>
                  </td>
                </tr>
                <tr>
                  <td>Telp Pelanggan</td>
                  <td>: <?php echo $head['no_telp_penerima'];?></td>
                  <td></td>
                  <td>Sales</td>
                  <td>: <?php echo $head['nama_sales'];?></td>
                </tr>
                <tr>
                  <td>Dana</td>
                  <td>: <?php echo $head['sumber_dana'];?></td>
                  <td></td>
                  <td>koordinator</td>
                  <td>: <?php echo $head['nama_kaper'];?></td>
                </tr>
                <tr>
                  <td>Alamat Penerima</td>
                  <td>: <?php echo $head['alamat_penerima'];?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
              <hr>
              <table width="100%"  class="table table-bordered table-striped">
                <tr>
                  <th rowspan="2" class="text-center">No</th>
                  <th rowspan="2" class="text-center">Kode Buku</th>
                  <th rowspan="2" class="text-center">Judul</th>
                  <th rowspan="2" class="text-center">Jenjang</th>
                  <th rowspan="2" class="text-center">Edisi</th>
                  <th rowspan="2" class="text-center">Qty</th>
                  <th colspan="3" class="text-center">Rabat:<?php echo $head['rabat'];?>%; Fee: <?php echo $head['fee']; ?> %</th>
                  <th colspan="3" class="text-center">Total</th>
                </tr>
                <tr>
                  <th class="text-center">Bruto</th>
                  <th class="text-center">Netto</th>
                  <th class="text-center">Fee</th>
                  <th class="text-center">Bruto</th>
                  <th class="text-center">Netto</th>
                  <th class="text-center">Fee</th>
                </tr>
                
                  <?php
                  $no =1;
                  $jumlah_buku = 0;
                  $harga_bruto = 0;
                  $harga_nett = 0;
                  $harga_fee = 0;
                    foreach ($buku_sj as $buku_sj) { ?>
                      <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $buku_sj->kode_buku;?></td>
                        <td><?php echo $buku_sj->judul;?></td>
                        <td align="center"><?php echo $buku_sj->jenjang;?></td>
                        <td align="center"><?php echo $buku_sj->edisi;?></td>
                        <td align="right"><?php $jumlah_buku= $jumlah_buku+$buku_sj->jumlah; echo $buku_sj->jumlah;?></td>
                        <!-- Harga  -->
                        <td align="right">
                          <?php echo number_format($buku_sj->harga,0,',','.');?>
                        </td>
                        <td align="right">
                          <?php $nett = $buku_sj->harga - ($buku_sj->harga*$head['rabat']/100); echo number_format($nett,0,',','.');?>
                        </td>
                        <td align="right">
                          <?php $fee = $nett*$head['fee']/100; echo number_format($fee,0,',','.');?>
                        </td>
                        <!-- Total Harga -->
                        <td align="right">
                          <?php $harga_bruto=$harga_bruto+$buku_sj->harga*$buku_sj->jumlah;
                          echo number_format($buku_sj->harga*$buku_sj->jumlah,0,',','.');?>
                        </td>
                        <td align="right">
                          <?php $harga_nett=$harga_nett+$nett*$buku_sj->jumlah;
                          echo number_format($nett*$buku_sj->jumlah,0,',','.');?>
                        </td>
                        <td align="right">
                          <?php $harga_fee=$harga_fee+$fee*$buku_sj->jumlah;
                          echo number_format($fee*$buku_sj->jumlah,0,',','.');?>
                        </td>
                      </tr>
                    <?php $no++;}
                  ?>
                  <tr>
                    <th colspan="5" class="text-center">GRAND TOTAL</th>
                    <th class="text-right"><?php echo $jumlah_buku;?></th>
                    <th colspan="3" class="text-center"></th>
                    <th class="text-right">
                      <?php echo number_format($harga_bruto,0,',','.');?>
                    </th>
                    <th class="text-right">
                      <?php echo number_format($harga_nett,0,',','.');?>
                    </th>
                    <th class="text-right">
                      <?php echo number_format($harga_fee,0,',','.');?>
                    </th>
                  </tr>
              </table><i>
              <table>
                
                <tr>
                  <td rowspan="3" valign="Top"  width="70px">Terbilang &nbsp;</td>
                  <td valign="Top" width="50px"><b>Bruto</b> &nbsp;</td>
                  <td valign="Top">:&nbsp;</td>
                  <td valign="Top"><?php echo terbilang($harga_bruto);?> Rupiah</td>
                </tr>
                <tr>
                  <td valign="Top"  width="50px"><b>Netto</b> &nbsp;</td>
                  <td valign="Top"> :&nbsp;</td>
                  <td valign="Top"><?php echo terbilang($harga_nett);?> Rupiah</td> 
                </tr>
                <tr>
                  <td valign="Top"  width="50px"><b>Fee</b> &nbsp;</td>
                  <td valign="Top"> :&nbsp;</td>
                  <td valign="Top"><?php echo terbilang($harga_fee);?> Rupiah</td>
                </tr>
              </table></i>
              <?php
              $tanggal= date('Y-m-d', strtotime('+3 months', strtotime( $tanggal_faktur )));
               ?>
              <input type="hidden" name="bruto" id="bruto" value="<?php echo $harga_bruto;?>">
              <input type="hidden" name="netto" id="netto" value="<?php echo $harga_nett;?>">
              <input type="hidden" name="fee" id="fee" value="<?php echo $harga_fee;?>">
              <input type="hidden" name="tenggang" id="tenggang" value="<?php echo $tanggal;?>">
              <hr>
              <button type="submit" class="btn btn-info pull-right">Proses Faktur</button>
            </div>
        </div>
        </form>
    </section>
</div>
<?php 
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }
  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else if($nilai==0) {
      $hasil = "Nol";
    } else{
      $hasil = trim(penyebut($nilai));
    }        
    return $hasil;
  }

  ?>