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
      <li class="active">Tambah Buku</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
          <div class="box-body">
            <center><h4>Tambah Jumlah Buku No : <?php echo $no_pesanan;?></h4></center>
            <form method="POST" action="<?php echo base_url().'Proses/Ubah_jumlah/';?>">
              <input type="hidden" name="no_pesanan" id="no_pesanan" value="<?php echo $no_pesanan;?>">
            <table width="100%">
                <tr class="GridViewScrollHeader">
                  <th width="5%">No</th>
                  <th width="15%">Kode Buku</th>
                  <th width="50%">Judul Buku</th>
                  <th width="15%">Stok Real</th>
                  <th width="15%">Stok Pesan</th>
                  <th width="15%">Jumlah</th>
                </tr class="GridViewScrollItem">
                <?php $no =1; foreach ($datbuk as $datbuk) {
                  echo'<tr class="GridViewScrollItem">
                    <td>'.$no.'</td>
                    <td>'.$datbuk['kode_buku'].'</td>
                    <td>'.$datbuk['judul'].'</td>
                    <td>'.$datbuk['stok_real'].'</td>
                    <td>'.$datbuk['stok_pesan'].'</td>
                    <td>
                    <input type="hidden" name="kode_buku[]" id="kode_buku[]" value="'.$datbuk['kode_buku'].'">
                    <input type="number" name="jumlah[]" id="jumlah[]" min="0" value="'.$datbuk['jumlah_beli'].'"></td>
                  </tr>';
                  $no++;
                }?>
              </table>
              <button type="submit" class="btn btn-info pull-right">Proses</button>
            </form>
          </div>
      </div>
    </section>
</div>
