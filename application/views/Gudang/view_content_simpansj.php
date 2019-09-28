<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Simpan SJ</li>
    </ol>
  </section>
    <section class="content">
      <form action="<?php echo base_url().'Gudang/ProsesSJ/';?>" method="POST" autocomplete="off">
      <div class="box box-success">
            <div class="box-body">
              <div class="box-body">
                <div class="col-lg-3">
                  <input type="hidden" name="stok" id="stok" value="<?php echo $stok;?>">
                  <label>Alamat</label>
                  <textarea style="resize:none;width:230px;height:80px;" class="form-control" type="text" name="alamat_penerima" id="alamat_penerima" readonly="" placeholder="Alamat Pengiriman Barang" required="">Yth.
Bapak/Ibu <?php echo $yth;?>
                    <?php echo $alamat;?></textarea>
                </div>
                <div class="col-lg-3"> 
                  <label>No Surat Jalan</label>
                  <input class="form-control" type="text" name="no_suratjalan" id="no_suratjalan" required="" readonly="" value="<?php echo $no_suratjalan; ?>">
                </div>
                <div class="col-lg-3"> 
                  <label>No Polisi</label>
                  <input class="form-control" type="text" name="nopol" id="nopol" required="">
                </div>   
                <div class="col-lg-3">                   
                  <label>Ekspedisi</label>
                  <input class="form-control" type="text" name="ekspedisi" id="ekspedisi" required="">
                </div>
              </div>
              <div class="box-body">
                <div class="col-lg-3"> 
                  <label>Nama Driver</label>
                  <input class="form-control" type="text" name="nama_driver" id="nama_driver" required="">
                </div>
                <div class="col-lg-3"> 
                  <label>No Hp Driver</label>
                  <input class="form-control" type="text" name="no_telp" id="no_telp" required="">
                </div>   
                <div class="col-lg-3">                   
                  <label>Jumlah Koli</label>
                  <input class="form-control" type="number" min="1" name="koli" id="koli" required="">
                </div>  
                <div class="col-lg-3">                   
                  <label>Jumlah Karung</label>
                  <input class="form-control" type="number" min="1" name="karung" id="karung" required="">
                </div>
              </div>
            </div>
            <hr>
            <br>
            <div class="box-body">
            <table class="table table-bordered table-striped" border="1">
              <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Pesan</th>
                <th>Sisa</th>
                <th>Stok</th>
                <th>Kirim</th>
              </tr>
              <?php $no=1; foreach ($buku as $buku) {
                echo '<tr>
                        <td width="5%">'.$no.'</td>
                        <td width="12%">'.$buku->kode_buku.'</td>
                        <td width="38%">'.$buku->judul.'</td>
                        <td width="9%">'.$buku->jumlah_beli.'</td>
                        <td width="9%">'.$buku->sisa_kirim.'</td>
                        <td width="9%">'.$buku->stok.'</td>
                        <td width="18%">
                        <input type="hidden" name="ket[]" id="ket[]" value="'.$buku->ket.'">
                        <input type="hidden" name="harga[]" id="harga[]" value="'.$buku->harga.'">
                        <input type="hidden" name="kode_buku[]" id="kode_buku[]" value="'.$buku->kode_buku.'">
                        <input type="hidden" name="no_do[]" id="no_do[]" value="'.$buku->no_do.'">';
                if ($buku->stok==0 ){
                      echo '<input type="number" name="jumlah[]" id="jumlah[]" min="0" max="0" readonly=""></td>
                      </tr>';
                }else if($buku->sisa_kirim > $buku->stok){
                  // min 0 max stok real
                  echo '<input type="number" name="jumlah[]" id="jumlah[]" min="0" max="'.$buku->stok.'"> Maksimal => '.$buku->stok.'</td>
                      </tr>';
                }else if($buku->sisa_kirim < $buku->stok){
                  // min 0 max jumlah pesan
                  echo '<input type="number" name="jumlah[]" id="jumlah[]" min="0" max="'.$buku->sisa_kirim.'"> Maksimal => '.$buku->sisa_kirim.'</td>
                      </tr>';
                }
                        
             $no++; }?>
              
            </table>
            <hr>
           <button type="submit" class="btn btn-primary">Buat SJ</button>
           </div>
        </div>
        </form>
    </section>
</div>
