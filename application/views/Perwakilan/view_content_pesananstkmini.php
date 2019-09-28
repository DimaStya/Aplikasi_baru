<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Daftar Pesanan Stok Mini</li>
    </ol>
  </section>
  
  <div id="myModal_buku" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 75%;">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Jumlah Buku Pesanan Stok Mini</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <form action="<?php echo base_url().'Perwakilan/add_bukustokmini/';?>" method="POST">
          <div class="box box-primary">
          <div id="loading_buku" style="margin-top: 15px;">
            <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
          </div>
          <br>
          <center><b>No Pesan: <div id="no_stokmini"></div></b></center>
          <hr>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Jumlah</th>
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

    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Pesanan Stok Mini</h3></div>
            <div class="box-body">
                <table cellspacing="0" id="gvMain" class="table table-bordered table-striped" style="width: 100%; border-collapse: collapse;">
                  <tr>
                    <th>No</th>
                    <th>Tanggal Pesan</th>
                    <th>No Pesanan</th>
                    <th>Alamat Kirim</th>
                    <th>Keterangan</th>
                    <th colspan="2" width="15%">Aksi</th>
                  </tr>
                  <tbody>
                  <?php $no=1; foreach ($pesanan as $pesanan) {?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $pesanan['tanggal']; ?></td>
                      <td><?php echo $pesanan['no_stokmini']; ?></td>
                      <td><?php echo $pesanan['alamat_kirim']; ?></td>
                      <td><?php echo $pesanan['keterangan']; ?></td>
                      <td>
                        <button type="button" name="add_buku<?php echo $no;?>" id="add_buku<?php echo $no;?>" value="<?php echo $pesanan['no_stokmini']; ?>"class="btn btn-info" data-toggle="modal" data-target="#myModal_buku">Ubah Jumlah</button></td>
                      <td>  
                        <?php 
                            echo '<button onclick="Klik'.$no.'()" type="button" class="btn btn-danger")>Hapus</button>';
                            echo "
                            <script type='text/javascript'>
                                    function Klik".$no."(){
                                      var r = confirm('Yakin Retur Mau Di Update?');
                                      if(r == true){
                                        window.location = '".base_url()."Perwakilan/Hapus_stokmini/?no_stokmini=".$pesanan['no_stokmini']."';
                                      }
                                      
                                    }
                              </script>";?>
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
    //add jumlah buku
    <?php $no=1; foreach ($pesanan as $pesanan) {?>

    $("#add_buku<?php echo $no;?>").click(function(){ 
      $("#loading_buku").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Perwakilan/Ambil_buku_stokmini"); ?>",
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
          document.getElementById("no_stokmini").innerHTML = $("#add_buku<?php echo $no;?>").val();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
     <?php $no++; }?>
  });
  </script>
