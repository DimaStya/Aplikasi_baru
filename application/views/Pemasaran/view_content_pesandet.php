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
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Permohonan Pembatalan Pesanan</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
              <form role="form" action="<?php echo base_url().'Pemasaran/Tolakpesanan';?>"autocomplete="off" method="POST">
                <div class="box-body">
                  <div class="col-lg-6">                   
                    <label>Alasan Ditolak</label>
                    <input type="hidden" name="no_pesanan" id="no_pesanan">
                      <textarea style="resize:none;width:230px;height:50px;" class="form-control" type="text" name="alasan" id="alasan" placeholder="Isi Dengan alasan singkat" required=""></textarea>
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
                 <th width="15%">Kerjasama</th>
                 <td width="25%">: <?php echo $pesanan['nama_kerjasama']; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Tipe Buku</th>
                 <td width="25%">: <?php echo $pesanan['tipe_buku']; ?></td>
               </tr>
               <tr>
                 <th width="15%">No Pengajuan</th>
                 <td width="25%">: <?php echo $pesanan['no_pengajuan']; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Jenis Pembayaran</th>
                 <td width="25%">: <?php echo $pesanan['jenis_pembayaran']; ?></td>
               </tr>  
               <tr>
                 <th width="15%"></th>
                 <td width="25%"></td>
                 <td width="20%"></td>
                 <th width="15%">Sumber Dana</th>
                 <td width="25%">: <?php echo $pesanan['sumber_dana']; ?></td>
               </tr>
               <tr>
                 <th width="15%">Nama Pelanggan</th>
                 <td width="25%">: <?php echo $pesanan['nama_penerima']; ?></td>
                 <td width="20%"></td>
                 <th width="15%"></th>
                 <td width="25%"></td>
               </tr>
               <tr>
                 <th width="15%">No Telp Pelanggan</th>
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
               <tr>
                 <td colspan="5"> &nbsp; </td>
               </tr>
               <tr>
                 <th width="15%">Keterangan</th>
                 <td colspan="2" width="25%">: <?php echo $pesanan['keterangan'].' // '.$pesanan['stok']; ?></td>
                 <th width="15%"></th>
                 <td width="25%"></td>
               </tr>
            </table>
            <br>
            <hr>
            <form action="<?php echo base_url().'Pemasaran/Simpando/';?>" method="POST">
            <input type="hidden" name="no_pesanan" id="no_pesanan" value="<?php echo $pesanan['no_pesanan'];?>">
            <input type="hidden" name="stok" id="stok" value="<?php echo $pesanan['stok'];?>">
            <table width="100%">
              <tr class="GridViewScrollHeader">
                <th width="3%">No</th>
                <th width="17%">Kode Buku</th>
                <th width="45%">Judul</th>
                <th width="5%">Jumlah DO</th>
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
                  <td>'.$datapesan['jumlah_beli'].'</td>
                  <td>'.$datapesan['nama_penerbit'].'</td>
                  <td>'.$datapesan['jenjang'].'</td>
                  <td>'.$datapesan['edisi'].'</td>
                  <td>'.$datapesan['stok_pesan'].'</td>
                  <td>'.$datapesan['stok_real'].'</td>
                  <input type="hidden" name="kode_buku[]" id="kode_buku[]" value="'.$datapesan['kode_buku'].'">
                  <input type="hidden" name="jumlah[]" id="jumlah[]" value="'.$datapesan['jumlah_beli'].'">
                  <input type="hidden" name="harga[]" id="harga[]" value="'.$datapesan['harga'].'">
                  <input type="hidden" name="ket[]" id="ket[]" value="'.$datapesan['ket'].'">
                </tr>
                '; $no++; $jumlah = $jumlah+$datapesan['jumlah_beli'];
              }
              ?>
              <tr  class="GridViewScrollHeader">
                <th colspan="3">Jumlah</th>
                <th><b><?php echo $jumlah; ?></b></th>
                <th colspan="5"></th>
              </tr>
            </table>
            <hr>
            <?php if ($button == 'ada'){ ?>
            <button type="submit" class="btn btn-primary">Proses dan Cetak</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#myModal' onclick= 'SetInput("<?php echo $pesanan['no_pesanan']; ?>")'>Tolak Pesanan</button>
          <?php }?>
            </form>
            <hr>
            <!-- Tombol -->
            </div>
        </div>
    </section>
</div>
