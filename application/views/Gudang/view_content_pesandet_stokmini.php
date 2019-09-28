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
          <h4 class="modal-title">Kelola Data Area</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
              <form role="form" action="<?php echo base_url().'Gudang/ProsesSJstok'; ?>" autocomplete="off" method="POST">
                <?php
                 foreach ($buku as $datapesan) {
                  echo "<input type='hidden' name='kode_buku[]' id='kode_buku[]' value='".$datapesan['kode_buku']."'>";
                  echo "<input type='hidden' name='jumlah[]' id='jumlah[]' value='".$datapesan['jumlah']."'>";
                 }?>
                  <input type="hidden" name="no_stokmini" id="no_stokmini" value="<?php echo $pesanan['no_stokmini'];?>">
              <div class="box-body">
                <div class="form-group">
                  <div class="col-xs-12">
                      <label>No SJ</label>
                      <input type="text" class="form-control col-xs-6" name="no_sj_stokmini" id="no_sj_stokmini" readonly="" required="" value="<?php echo $sj;?>">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="col-xs-6">
                      <label>Ekspedisi</label>
                      <input type="text" class="form-control col-xs-6" name="ekspedisi" id="ekspedisi" required="" placeholder="Ekspedisi">
                  </div>
                  <div class="col-xs-6">
                      <label>No Polisi</label>
                      <input type="text" class="form-control col-xs-6" name="no_polisi" id="no_polisi" required="" placeholder="No Polisi">
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="col-xs-6">
                      <label>Nama Sopir</label>
                      <input type="text" class="form-control col-xs-6" name="nama_sopir" id="nama_sopir" required="" placeholder="Nama Sopir">
                  </div>
                  <div class="col-xs-6">
                      <label>No Telp Sopir</label>
                      <input type="text" class="form-control col-xs-6" name="no_telp_sopir" id="no_telp_sopir" required="" placeholder="No Telp Sopir">
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
            <div class="box-body">
            <table width="100%">
              <tr>
                 <td colspan="5"><center><h4><b>SURAT PESANAN STOK MINI</b></h4></center></td>
               </tr>
               <tr>
                 <th width="15%">No Pesan</th>
                 <td width="25%">: <?php echo $pesanan['no_stokmini']; ?></td>
                 <td width="20%"></td>
                 <th width="15%">Tanggal</th>
                 <td width="25%">: <?php $tanggal = explode("-", $pesanan['tanggal']); echo $tanggal[2]."/".$tanggal[1]."/".$tanggal[0]; ?></td>
               </tr>
               <tr>
                 <th width="15%">ALamat Kirim</th>
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
              $can =0;
              foreach ($buku as $datapesan) {
                if($datapesan['jumlah'] > $datapesan['stok_real']){
                  $style = 'style="color: red;"';
                  $can++;
                }else{
                  $style = '';
                }
                echo '
                <tr class="GridViewScrollItem" '.$style.'>
                  <td>'.$no.'</td>
                  <td>'.$datapesan['kode_buku'].'</td>
                  <td>'.$datapesan['judul'].'</td>
                  <td>'.$datapesan['jumlah'].'</td>
                  <td>'.$datapesan['nama_penerbit'].'</td>
                  <td>'.$datapesan['jenjang'].'</td>
                  <td>'.$datapesan['edisi'].'</td>
                  <td>'.$datapesan['stok_pesan'].'</td>
                </tr>
                '; $no++; $jumlah = $jumlah+$datapesan['jumlah'];
              }
              ?>
              <tr  class="GridViewScrollHeader">
                <th colspan="3">Jumlah</th>
                <th><b><?php echo $jumlah; ?></b></th>
                <th colspan="4"></th>
              </tr>
            </table>
            <hr>
            <?php 
            if($can > 0){
              echo 'Stok Real Tidak Mencukupi !!!';
            }else{
              echo '<button type="button" name="klik" id="klik" value="sj" class="btn btn-success"  data-toggle="modal" data-target="#myModal">Proses SJ</button>';
            }
            ?>
            <hr>
            <!-- Tombol -->
            </div>
        </div>
    </section>
</div>
