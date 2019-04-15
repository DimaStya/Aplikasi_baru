<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Tahun</li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Tabel Harga Tahun Depan</h3>
    </div>
    <div class="box-body">
      Membuat Tabel Harga Tahun <?php echo $tahun_depan; ?><hr>
      <?php
      if ($status =='1'){
        echo 'Tabel Harga Tahun '.$tahun_depan.' Sudah Tersedia';
      }else if($status =='2'){
        echo '<form action="'.base_url().'Proses/Add_tahun" method="POST">
        <input type="hidden" name="tahun" id="tahun" value="'.$tahun_depan.'">
        <button type="submit" class="btn btn-primary">Buat Harga '.$tahun_depan.'</button> klik untuk membuat tabel harga '.$tahun_depan.'
        ';
      }
      ?>
    </div>
  </div>
  </section>
</div>