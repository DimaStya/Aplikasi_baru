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
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 75%;">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Permohonan Retur</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <form action="<?php echo base_url().'Proses/add_retur/';?>" method="POST">
          <div class="box box-primary">
            <div class="box-body">
              <div class="col-lg-3"> 
                <label>No Retur </label>
                <div id="no_retur"></div>
              </div>
            </div>
            <div class="box-body">
              <div class="col-lg-3"> 
                <label>Alasan </label>
                <textarea style="resize:none;width:230px;height:50px;" class="form-control" type="text" name="alasan" id="alasan" placeholder="Alasan Retur" required=""></textarea>
              </div>
            </div>
          </div>
          <div id="loading" style="margin-top: 15px;">
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
            <tbody id="data_sj">
              
            </tbody>
            <tfoot>
            </tfoot>     
          </table>
          <hr>
          <button type='submit' class='btn btn-success'>Buat Retur</button>
           <hr>
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
                    <th>Juml Judul</th>
                    <th>Juml Buku</th>
                    <th>Faktur</th>
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
                      <td><?php echo $pesanan['jumlah_judul']; ?></td>
                      <td><?php echo $pesanan['jumlah_buku']; ?></td>
                      <td><?php echo $pesanan['terfaktur']; ?></td>
                      <td>  
                        <?php 
                          if($pesanan['terfaktur']=='Sudah Faktur' && $pesanan['terretur']=='Belum Retur'){?>
                            <button  name="sj<?php echo $no;?>" id="sj<?php echo $no;?>" value="<?php echo $pesanan['no_suratjalan']; ?>" type="submit" class="btn btn-info" data-toggle="modal" data-target="#myModal")>Buat Retur</button>
                         <?php }
                        ?>
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
    $("#loading").hide();
    //Data SJ
    <?php $no=1; foreach ($pesanan as $pesanan) {?>
    $("#sj<?php echo $no;?>").click(function(){ 
      $("#loading").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Perwakilan/Ambil_data_sj"); ?>",
        data: {data : $("#sj<?php echo $no;?>").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          $("#data_sj").html(response.data_sj).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    $("#sj<?php echo $no;?>").click(function(){ 
      $("#loading").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Perwakilan/Buat_noretur"); ?>",
        data: {data : $("#sj<?php echo $no;?>").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          $("#no_retur").html(response.no_retur).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    <?php $no++; }?>
  });
  </script>
