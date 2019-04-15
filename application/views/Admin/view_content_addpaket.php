<style type="text/css">
  #notifications {
    cursor: pointer;
    position: fixed;
    right: 0px;
    z-index: 9999;
    top: 110px;
    margin-bottom: 22px;
    margin-right: 15px;
    min-width: 300px; 
    max-width: 800px;  
}
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Add Buku Paket</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
        <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div>
        <form role="form" action="<?php echo base_url().'Proses/Add_paket'; ?>" autocomplete="off" method="POST">
            <div class="box-header with-border">
              <h3 class="box-title">Form Penambahan Buku Paket</h3>
            </div>
            <div class="box-body">
                  <div class="box-body">
                    <div class="col-lg-3">                   
                      <label>Penerbit</label>
                        <select class="form-control" style="width: 100%;" id ='kode_penerbit' name='kode_penerbit' required="">
                        <option value= "">--Pilih Penerbit--</option>
                        <?php foreach ($penerbit as $penerbit) { 
                          echo '<option value= "'.$penerbit['kode_penerbit'].'">'.$penerbit['nama_penerbit'].'</option>';
                        }?>
                        </select>
                    </div>
                    <div class="col-lg-3">                   
                      <label>Tipe Buku</label>
                        <select class="form-control" style="width: 100%;" id ='tipe_buku' name='tipe_buku' required="">
                        <option value= "">--Pilih Tipe Buku--</option>
                        </select>
                        <div id="loading" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                    <div class="col-lg-3">                   
                      <label>Jenjang</label>
                        <select class="form-control" style="width: 100%;" id ='jenjang' name='jenjang' required="">
                        <option value= "">--Pilih Jenjang--</option>
                        </select>
                        <div id="loading1" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="col-lg-3">                   
                      <label>Edisi</label>
                        <select class="form-control" style="width: 100%;" id ='edisi' name='edisi' required="">
                        <option value= "">--Pilih Edisi--</option>
                        </select>
                        <div id="loading2" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                    <div class="col-lg-3">                   
                      <label>Kurikulum</label>
                        <select class="form-control" style="width: 100%;" id ='kurikulum' name='kurikulum' required="">
                        <option value= "">--Pilih Kurikulum--</option>
                        </select>
                        <input type="hidden" name="paket" id="paket" value="<?php echo $kode_paket;?>">
                        <div id="loading3" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                  </div>
                  <div class="col-lg-3">
                    <div id="loadingu" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                  </div>
                  </div>
              
            </div>
            <hr>
            <div class="box-body">
            <table width="100%" id="buku" class="table table-bordered table-striped" name='buku'>
              <thead>
                <tr>
                  <th width="15%">No</th>
                  <th width="30%">Kode Buku</th>
                  <th width="45%">Judul Buku</th>
                  <th width="10%">Tambah</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
              </tbody>
              </table>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info btn-lg pull-right">Tambah Paket</button>
            </div>
            </form>
        </div>
    </section>
</div>
<script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>

<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    $("#loading1").hide();
    $("#loading2").hide();
    $("#loading3").hide();
    $("#loadingu").hide();
    //tipe buku
    $("#kode_penerbit").change(function(){ 
      $("#tipe_buku").hide();
      $("#loading").show(); 
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Tipebuku"); ?>",
        data: {kode_penerbit : $("#kode_penerbit").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          $("#tipe_buku").html(response.tipe_buku).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //jenjang
    $("#tipe_buku").change(function(){ 
      $("#jenjang").hide();
      $("#loading1").show(); 
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Jenjang"); ?>",
        data: {data : $("#kode_penerbit").val()+"&"+$("#tipe_buku").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading1").hide();
          $("#jenjang").html(response.jenjang).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //edisi
    $("#jenjang").change(function(){ 
      $("#edisi").hide();
      $("#loading2").show(); 
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Edisi"); ?>",
        data: {data : $("#kode_penerbit").val()+"&"+$("#tipe_buku").val()+"&"+$("#jenjang").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading2").hide();
          $("#edisi").html(response.edisi).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //kurikulum
    $("#edisi").change(function(){ 
      $("#kurikulum").hide();
      $("#loading3").show(); 
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Kurikulum"); ?>",
        data: {data : $("#kode_penerbit").val()+"&"+$("#tipe_buku").val()+"&"+$("#jenjang").val()+"&"+$("#edisi").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading3").hide();
          $("#kurikulum").html(response.kurikulum).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //Data Buku
    $("#kurikulum").change(function(){ 
    
    $("#loadingu").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Paket"); ?>",
        data: {data : $("#kode_penerbit").val()+"&"+$("#tipe_buku").val()+"&"+$("#jenjang").val()+"&"+$("#edisi").val()+"&"+$("#kurikulum").val()+"&"+$("#paket").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loadingu").hide();
          $("#buku").html(response.buku).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
  });
  </script>
