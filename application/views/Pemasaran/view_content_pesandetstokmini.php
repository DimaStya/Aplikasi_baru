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
      <div class="box box-success">
            <div class="box-body">
            <table width="100%">
              <tr>
                 <td colspan="5"><h4><center><b>SURAT PESANAN</b></center></h4></td>
               </tr>
               <tr>
                 <th width="15%">No Pesan</th>
                 <td width="25%">: <?php echo $pesanan['no_stokmini']; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Tanggal</th>
                 <td width="25%">: <?php echo $pesanan['tanggal']; ?></td>
               </tr>
               <tr>
                 <th width="15%">Alamat Kirim</th>
                 <td width="25%">: <?php echo $pesanan['alamat_kirim']; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Nama Kaper</th>
                 <td width="25%">: <?php echo $pesanan['nama_kaper']; ?></td>
               </tr>
               <tr>
                 <th width="15%">Keterangan</th>
                 <td width="25%">: <?php echo $pesanan['keterangan']; ?></td>
                 <td width="20%"></td>
                 <th width="15%"></th>
                 <td width="25%"></td>
               </tr>
            </table>
            <br>
            <hr>
            <form action="<?php echo base_url().'Pemasaran/Simpando_stokmini/';?>" method="POST">
            <input type="hidden" name="no_stokmini" id="no_stokmini" value="<?php echo $pesanan['no_stokmini'];?>">
            <table width="100%">
              <tr class="GridViewScrollHeader">
                <th width="3%">No</th>
                <th width="17%">Kode Buku</th>
                <th width="45%">Judul</th>
                <th width="5%">Jumlah Pesan</th>
                <th width="10%">Penerbit</th>
                <th width="5%">Jenjang</th>
                <th width="5%">Edisi</th>
                <th width="5%">Stok Pesan</th>
                <th width="5%">Stok Real</th>
              </tr>
              <?php $no=1; $jumlah =0;
              foreach ($buku as $datapesan) {
                echo '
                <tr class="GridViewScrollItem">
                  <td>'.$no.'</td>
                  <td>'.$datapesan['kode_buku'].'</td>
                  <td>'.$datapesan['judul'].'</td>
                  <td>'.$datapesan['jumlah'].'</td>
                  <td>'.$datapesan['nama_penerbit'].'</td>
                  <td>'.$datapesan['jenjang'].'</td>
                  <td>'.$datapesan['edisi'].'</td>
                  <td>'.$datapesan['stok_pesan'].'</td>
                  <td>'.$datapesan['stok_real'].'</td>
                </tr>
                '; $no++; $jumlah = $jumlah+$datapesan['jumlah'];
              }
              ?>
              <tr  class="GridViewScrollHeader">
                <th colspan="3">Jumlah</th>
                <th><b><?php echo $jumlah; ?></b></th>
                <th colspan="5"></th>
              </tr>
            </table>
            <hr>
            <button type="submit" class="btn btn-primary">Proses dan Cetak</button>
            </form>
            <hr>
            <!-- Tombol -->
            </div>
        </div>
    </section>
</div>
