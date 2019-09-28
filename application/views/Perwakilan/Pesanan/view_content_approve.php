
<script src = "<?php echo base_url('js/pesanan.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Data Pesanan</li>
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
              <form role="form" action="<?php echo base_url().'Perwakilan/Detailpesanan/';?>"autocomplete="off" method="POST">
                <div class="box-body">
                  <div class="col-lg-6">                   
                    <label>Alasan Batal</label>
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
            <div class="box-header with-border">
              <h3 class="box-title">Data Pesanan</h3>
              <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div> 
            </div>
            <div class="box-body">
            <table cellspacing="0" id="gvMain" style="width: 100%; border-collapse: collapse;">
                  <tr class="GridViewScrollHeader">
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">No Pesanan</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Customer</th>
                    <th scope="col">CV Rekanan</th>
                    <th scope="col">Nama Sales</th>
                    <th scope="col">Kaper</th>
                    <th scope="col">Penerima</th>
                    <th scope="col">No Telp Penerima</th>
                    <th scope="col">Alamat Kirim</th>
                    <th scope="col">Tipe Buku</th>
                    <th scope="col">Jenjang</th>
                    <th scope="col">Jumlah Judul</th>
                    <th scope="col">Jumlah Buku</th>
                    <th scope="col">Status Proses</th>
                  </tr>
                  <tr class="GridViewScrollItem">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <?php $no=1; foreach ($pesanan as $pesanan) { ?>
                  <tr class="GridViewScrollItem">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $pesanan['tanggal']; ?></td>
                    <td><?php echo $pesanan['no_pesanan']; ?></td>
                    <td>
                        <form method="POST" action="<?php echo base_url().'Perwakilan/Detailpesanan/';?>">
                            <button name="detail" value="<?php echo $pesanan['no_pesanan']; ?>" type="submit" class="btn btn-info">Detail</button>
                            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#myModal' onclick= 'SetInput("<?php echo $pesanan['no_pesanan']; ?>")'>Request Hapus</button>
                          </form>
                        </td>
                    <td><?php echo $pesanan['nama_customer']; ?></td>
                    <td><?php echo $pesanan['nama_cv']; ?></td>
                    <td><?php echo $pesanan['nama_sales']; ?></td>
                    <td><?php echo $pesanan['nama_kaper']; ?></td>
                    <td><?php echo $pesanan['nama_penerima']; ?></td>
                    <td><?php echo $pesanan['no_telp_penerima']; ?></td>
                    <td><?php echo $pesanan['alamat_penerima']; ?></td>
                    <td><?php echo $pesanan['tipe_buku']; ?></td>
                    <td><?php echo $pesanan['jenjang']; ?></td>
                    <td><?php echo $pesanan['jumlah_judul']; ?></td>
                    <td><?php echo $pesanan['jumlah_buku']; ?></td>
                    <td><?php echo $pesanan['proses']; ?></td>
                  </tr>
                  <?php $no++;} ?>
              </table>
            </div>
        </div>
    </section>
</div>
