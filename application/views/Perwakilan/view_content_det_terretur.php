<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Daftar SJ</li>
    </ol>
  </section>
  
  <div id="myModal_buku" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 75%;">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Jumlah Buku Retur</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <form action="<?php echo base_url().'Perwakilan/add_bukuretur/';?>" method="POST">
          <div class="box box-primary">
          
          <div id="loading_buku" style="margin-top: 15px;">
            <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
          </div>
          <hr>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Jumlah Kirim</th>
                <th>Jumlah Retur</th>
              </tr> 
            </thead>
            <tbody id="data_add_buku">
              
            </tbody>
            <tfoot>
            </tfoot>     
          </table>
          <hr>
          <button type='submit' class='btn btn-success'>Update Buku</button>
           <hr>
           </div>
           </form> 
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default"  data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

  <div id="myModal_judul" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 75%;">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Judul Buku Retur</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <form action="<?php echo base_url().'Perwakilan/add_judulretur/';?>" method="POST">
          <div class="box box-primary">
          
          <div id="loading_judul" style="margin-top: 15px;">
            <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
          </div>
          <hr>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Jumlah Kirim</th>
                <th>Jumlah Retur</th>
              </tr> 
            </thead>
            <tbody id="data_add_judul">
              
            </tbody>
            <tfoot>
            </tfoot>     
          </table>
          <hr>
          <button type='submit' class='btn btn-success'>Update Judul</button>
           <hr>
           </div>
           </form>
          </div> 
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default"  data-dismiss="modal">Batal</button>
        </div>
      </div>
  </div>
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar SJ</h3></div>
            <div class="box-body">
              <center>No Pesanan : <?php echo $no_do;?></center>
                <table cellspacing="0" id="gvMain" class="table table-bordered table-striped" style="width: 100%; border-collapse: collapse;">
                  <tr>
                    <th>No</th>
                    <th>Tanggal SJ</th>
                    <th>No SJ</th>
                    <th>Customer</th>
                    <th>CV</th>
                    <th>No Retur</th>
                    <th>Download</th>
                    <th>TTR</th>
                    <th>Aksi</th>
                  </tr>
                  <tbody>
                  <?php $no=1; foreach ($pesanan as $pesanan) {?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $pesanan['tanggal']; ?></td>
                      <td><?php echo $pesanan['no_suratjalan']; ?></td>
                      <td><?php echo $pesanan['nama_customer']; ?></td>
                      <td><?php echo $pesanan['nama_cv']; ?></td>
                      <td><?php echo $pesanan['no_suratretur']; ?></td>
                      <td>
                        <form action="<?php echo base_url().'Perwakilan/Cetakpdf';?>" method="POST">
                        <button type="submit" name="no_suratretur" id="no_suratretur" value="<?php echo $pesanan['no_suratretur']; ?>"class="btn btn-info">Pdf Retur</button></form></td>
                      <td><?php echo $pesanan['ttr']; ?></td>
                      <td width="25%">  
                        <?php 
                          if($pesanan['ttr']=='Sudah Terima' && $pesanan['keterangan']=='Admin Telah Menerima' ){
                            echo '<button onclick="Klik'.$no.'()" type="button" class="btn btn-danger")>Req Update</button>';
                            echo "
                            <script type='text/javascript'>
                                    function Klik".$no."(){
                                      var r = confirm('Yakin Retur Mau Di Update?');
                                      if(r == true){
                                        window.location = '".base_url()."Perwakilan/UpdateRetur/?no_suratretur=".$pesanan['no_suratretur']."&&no_do=".$no_do."';
                                      }
                                      
                                    }
                              </script>";

                         }else if($pesanan['ttr']=='Belum Terima' && $pesanan['keterangan']=='Menunggu Admin') {
                           echo '<button  name="add_buku'.$no.'" id="add_buku'.$no.'" value="'.$pesanan['no_suratretur'].'" type="submit" class="btn btn-info" data-toggle="modal" data-target="#myModal_buku")>Add Buku</button> | ';
                           echo '<button  name="add_judul'.$no.'" id="add_judul'.$no.'" value="'.$pesanan['no_suratjalan'].'" type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal_judul")>Add Judul</button> | ';
                           echo '<button onclick="Klik1'.$no.'()" type="button" class="btn btn-danger")>Hapus</button>';
                            echo "
                            <script type='text/javascript'>
                                    function Klik1".$no."(){
                                      var r = confirm('Yakin Retur Mau Di Hapus?');
                                      if(r == true){
                                        window.location = '".base_url()."Perwakilan/HapusRetur/?no_suratretur=".$pesanan['no_suratretur']."&&no_do=".$no_do."';
                                      }
                                      
                                    }
                              </script>";
                         }else if($pesanan['ttr']=='Belum Terima' && $pesanan['keterangan']=='Admin Telah Menerima') {
                           echo "Proses Retur Di terima Admin Pusat";
                         }else{ echo "Proses Permohonan Update";}?>
                        
                      </td>
                  </tr>
                  <?php $no++; }?>
                  </tbody>
              </table>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url("js/jquery-1.7.1.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>
<script>
  $(document).ready(function(){
    $("#loading_buku").hide();
    $("#loading_judul").hide();
    //add jumlah buku
    <?php $no=1; foreach ($pesanan as $pesanan) {?>
    $("#add_buku<?php echo $no;?>").click(function(){ 
      $("#loading_buku").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Perwakilan/Ambil_add_buku"); ?>",
        data: {data : $("#add_buku<?php echo $no;?>").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading_buku").hide();
          $("#data_add_buku").html(response.data_add_buku).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //add jumlah buku
    $("#add_judul<?php echo $no;?>").click(function(){ 
      $("#loading_judul").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Perwakilan/Ambil_add_judul"); ?>",
        data: {data : $("#add_judul<?php echo $no;?>").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading_judul").hide();
          $("#data_add_judul").html(response.data_add_judul).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    <?php $no++; }?>
  });
  </script>
