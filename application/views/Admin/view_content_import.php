<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
  
  <script>
  $(document).ready(function(){
    // Sembunyikan alert validasi kosong
    $("#kosong").hide();
  });
  </script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Import Buku</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Form Import </h3>&nbsp;<a href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
            </div>
            <div class="box-body">
            <form method="POST" action="<?php echo base_url("Import/form"); ?>" enctype="multipart/form-data">
    <!-- 
    -- Buat sebuah input type file
    -- class pull-left berfungsi agar file input berada di sebelah kiri
    -->
    <input type="file" name="file">
    
    <!--
    -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
    -->
    <input type="submit" name="preview" value="Preview">
  </form>
  
  <?php
  if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
    if(isset($upload_error)){ // Jika proses upload gagal
      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
      
    }else{
    	// Buat sebuah tag form untuk proses import data ke database
    echo "<form method='POST' action='".base_url("Import/import")."'>";
    
    // Buat sebuah div untuk alert validasi kosong
    echo "<div style='color: red;' id='kosong'>
    Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
    </div>";
    
    echo "<table border='1' cellpadding='8'>
    <tr>
      <th colspan='12'  style='vertical-align: middle; text-align: center;'>Preview Data</th>
    </tr>
    <tr>
      <th style='vertical-align: middle; text-align: center;'>Kode Buku</th>
      <th style='vertical-align: middle; text-align: center;'>Kode Penerbit</th>
      <th style='vertical-align: middle; text-align: center;'>Judul</th>
      <th style='vertical-align: middle; text-align: center;'>Edisi</th>
      <th style='vertical-align: middle; text-align: center;'>Jenjang</th>
      <th style='vertical-align: middle; text-align: center;'>Kelas</th>
      <th style='vertical-align: middle; text-align: center;'>Tipe</th>
      <th style='vertical-align: middle; text-align: center;'>Kurikulum</th>
      <th style='vertical-align: middle; text-align: center;'>Ukuran Kertas</th>
      <th style='vertical-align: middle; text-align: center;'>Warna Kertas</th>
      <th style='vertical-align: middle; text-align: center;'>Harga Jawa</th>
      <th style='vertical-align: middle; text-align: center;'>Harga Luar</th>
    </tr>";
    
    $numrow = 1;
    $kosong = 0;
    
    // Lakukan perulangan dari data yang ada di excel
    // $sheet adalah variabel yang dikirim dari controller
    foreach($sheet as $row){ 
      // Ambil data pada excel sesuai Kolom
      $kode_buku = $row['A']; // Ambil data NIS
      $kode_penerbit = $row['B']; // Ambil data nama
      $judul = $row['C']; // Ambil data jenis kelamin
      $edisi = $row['D']; // Ambil data alamat
      $jenjang = $row['E'];
      $kelas = $row['F'];
      $tipe = $row['G'];
      $kurikulum = $row['H'];
      $ukuran_kertas = $row['I'];
      $warna_kertas = $row['J'];
      $harga_jawa = $row['K'];
      $harga_luar = $row['L'];
      
      // Cek jika semua data tidak diisi
      if(empty($kode_buku) && empty($kode_penerbit)  && empty($judul)  && empty($edisi)  && empty($jenjang)  && empty($kelas)  && empty($tipe) && empty($kurikulum)  && empty($ukuran_kertas)  && empty($warna_kertas)  && empty($harga_jawa)  && empty($harga_luar))
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
      
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Validasi apakah semua data telah diisi
        $kode_buku_td = ( ! empty($kode_buku))? "" : " style='background: #E07171;'"; 
        $kode_penerbit_td = ( ! empty($kode_penerbit))? "" : " style='background: #E07171;'";
        $judul_td = ( ! empty($judul))? "" : " style='background: #E07171;'";
        $edisi_td = ( ! empty($edisi))? "" : " style='background: #E07171;'";
        $jenjang_td = ( ! empty($jenjang))? "" : " style='background: #E07171;'";
        $kelas_td = ( ! empty($kelas))? "" : " style='background: #E07171;'";
        $tipe_td = ( ! empty($tipe))? "" : " style='background: #E07171;'";
        $kurikulum_td = ( ! empty($kurikulum))? "" : " style='background: #E07171;'";
        $ukuran_kertas_td = ( ! empty($ukuran_kertas))? "" : " style='background: #E07171;'";
        $warna_kertas_td = ( ! empty($warna_kertas))? "" : " style='background: #E07171;'";
        $harga_jawa_td = ( ! empty($harga_jawa))? "" : " style='background: #E07171;'";
        $harga_luar_td = ( ! empty($harga_luar))? "" : " style='background: #E07171;'";
        
        // Jika salah satu data ada yang kosong
        if(empty($kode_buku) or empty($kode_penerbit) or empty($judul) or empty($edisi) or empty($jenjang) or empty($kelas) or empty($kurikulum) or empty($ukuran_kertas) or empty($warna_kertas) or empty($harga_jawa) or empty($harga_luar)){
          $kosong++; // Tambah 1 variabel $kosong
        }
        
        echo "<tr>";
        echo "<td".$kode_buku_td.">".$kode_buku."</td>";
        echo "<td".$kode_penerbit_td.">".$kode_penerbit."</td>";
        echo "<td".$judul_td.">".$judul."</td>";
        echo "<td".$edisi_td.">".$edisi."</td>";
        echo "<td".$jenjang_td.">".$jenjang."</td>";
        echo "<td".$kelas_td.">".$kelas."</td>";
        echo "<td".$tipe_td.">".$tipe."</td>";
        echo "<td".$kurikulum_td.">".$kurikulum."</td>";
        echo "<td".$ukuran_kertas_td.">".$ukuran_kertas."</td>";
        echo "<td".$warna_kertas_td.">".$warna_kertas."</td>";
        echo "<td".$harga_jawa_td.">".$harga_jawa."</td>";
        echo "<td".$harga_luar_td.">".$harga_luar."</td>";
        echo "</tr>";
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    
    echo "</table>";
    
    // Cek apakah variabel kosong lebih dari 0
    // Jika lebih dari 0, berarti ada data yang masih kosong
    if($kosong > 0){
    ?>  
      <script>
      $(document).ready(function(){
        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
        $("#jumlah_kosong").html('<?php echo $kosong; ?>');
        
        $("#kosong").show(); // Munculkan alert validasi kosong
      });
      </script>
    <?php
    }else{ // Jika semua data sudah diisi
      echo "<hr>";
      
      // Buat sebuah tombol untuk mengimport data ke database
      echo "<button type='submit' name='import'>Import</button>";
      echo "<a href='".base_url("Admin/Import")."'>Cancel</a>";
    }
    
    echo "</form>";
    }
    
    
  }
  ?>
            </div>
        </div>
    </section>
</div>
