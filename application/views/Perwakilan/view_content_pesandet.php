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
      <div class="box box-success">
            <div class="box-body">
            <table width="100%">
              <tr>
                 <th width="15%"></th>
                 <td width="25%"></td>
                 <td width="20%"><h4><b>SURAT PESANAN</b></h4></td>
                 <th width="15%"></th>
                 <td width="25%"></td>
               </tr>
               <tr>
                 <th width="15%">No Pesan</th>
                 <td width="25%">: <?php echo $pesanan['no_pesanan']; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Nama Customer</th>
                 <td width="25%">: <?php echo $pesanan['nama_customer']; ?></td>
               </tr>
               <tr>
                 <th width="15%">Tanggal</th>
                 <td width="25%">: <?php $tanggal = explode("-", $pesanan['tanggal']); echo $tanggal[2]."/".$tanggal[1]."/".$tanggal[0]; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Alamat Customer</th>
                 <td width="25%">: <?php echo $pesanan['alamat_customer']; ?></td>
               </tr>
               <tr>
                 <th width="15%">CV Rekanan</th>
                 <td width="25%">: <?php echo $pesanan['nama_cv']; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Nama Sales</th>
                 <td width="25%">: <?php echo $pesanan['nama_sales']; ?></td>
               </tr>
               <tr>
                 <th width="15%">No MoU</th>
                 <td width="25%">: <?php echo $pesanan['no_mou']; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Nama Kaper</th>
                 <td width="25%">: <?php echo $pesanan['nama_kaper']; ?></td>
               </tr> 
               <tr>
                 <th width="15%">Rabat</th>
                 <td width="25%">: <?php echo $pesanan['rabat']; ?> %</td>
                 <td width="20%"></td>
                 <th width="15%">Tipe Buku</th>
                 <td width="25%">: <?php echo $pesanan['tipe_buku']; ?></td>
               </tr>
               <tr>
                 <th width="15%"></th>
                 <td width="25%"></td>
                 <td width="20%"></td>
                 <th width="15%">Jenis Pemabayaran</th>
                 <td width="25%">: <?php echo $pesanan['jenis_pembayaran']; ?></td>
               </tr>  
               <tr>
                 <th width="15%">Nama Penerima</th>
                 <td width="25%">: <?php echo $pesanan['nama_penerima']; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Sumber Dana</th>
                 <td width="25%">: <?php echo $pesanan['sumber_dana']; ?></td>
               </tr> 
               <tr>
                 <th width="15%">No Telp Penerima</th>
                 <td width="25%">: <?php echo $pesanan['no_telp_penerima']; ?></td>
                 <td width="20%"></td>
                 <th width="15%"></th>
                 <td width="25%"></td>
               </tr>
               <tr>
                 <th width="15%">Alamat Kirim</th>
                 <td colspan="2" width="25%">: <?php echo $pesanan['alamat_penerima']; ?></td>
                 <th width="15%"></th>
                 <td width="25%"></td>
               </tr> 
            </table>
            <br>
            <hr>
            <table width="100%">
              <tr class="GridViewScrollHeader">
                <th width="3%">No</th>
                <th width="17%">Kode Buku</th>
                <th width="50%">Judul</th>
                <th width="5%">Jumlah DO</th>
                <th width="10%">Penerbit</th>
                <th width="5%">Jenjang</th>
                <th width="5%">Edisi</th>
                <th width="5%">Stok Pesan</th>
              </tr>
              <?php $no=1; $jumlah =0;
              foreach ($buku as $datapesan) {
                echo '
                <tr class="GridViewScrollItem">
                  <td>'.$no.'</td>
                  <td>'.$datapesan['kode_buku'].'</td>
                  <td>'.$datapesan['judul'].'</td>
                  <td>'.$datapesan['jumlah_beli'].'</td>
                  <td>'.$datapesan['nama_penerbit'].'</td>
                  <td>'.$datapesan['jenjang'].'</td>
                  <td>'.$datapesan['edisi'].'</td>
                  <td>'.$datapesan['stok_pesan'].'</td>
                </tr>
                '; $no++; $jumlah = $jumlah+$datapesan['jumlah_beli'];
              }
              ?>
              <tr  class="GridViewScrollHeader">
                <th colspan="3">Jumlah</th>
                <th><b><?php echo $jumlah; ?></b></th>
                <th colspan="4"></th>
              </tr>
            </table>
            <hr>
            <!-- Tombol -->
            <?php if($pesanan['proses']== "Menunggu DO"){?>
            <form method="POST" action="<?php echo base_url().'Perwakilan/Editpesanan/';?>">
              <input type="hidden" name="no_pesanan" id="no_pesanan" value="<?php echo $pesanan['no_pesanan']; ?>">
              <input type="hidden" name="kode_penerbit" id="kode_penerbit" value="<?php echo $datbuk['kode_penerbit']; ?>">
              <input type="hidden" name="tipe" id="tipe" value="<?php echo $datbuk['tipe']; ?>">
              <input type="hidden" name="jenjang" id="jenjang" value="<?php echo $datbuk['jenjang']; ?>">
              <input type="hidden" name="edisi" id="edisi" value="<?php echo $datbuk['edisi']; ?>">
              <input type="hidden" name="kurikulum" id="kurikulum" value="<?php echo $datbuk['kurikulum']; ?>">

              <button name="tam_buku" value="tam_buku" type="submit" class="btn btn-primary">Tambah Buku</button>
              <button name="tam_judul" value="tam_judul" type="submit" class="btn btn-info pull-right">Tambah Judul</button>
            </form>
          <?php }?>
            </div>
        </div>
    </section>
</div>
