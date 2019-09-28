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
      <li class="active">Perwakilan</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
        <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div>
        <form role="form" action="<?php echo base_url().'Proses/Add_pesan_stokmini'; ?>" autocomplete="off" method="POST">
            <div class="box-header with-border">
              <h3 class="box-title">Form Pemesanan Stok Mini
                    <img id="loadinge" src="<?php echo base_url('images/loading.gif');?>" width="18"> <small id="loadinget">Loading...</small>
                  </h3>               
            </div>
            <div class="box-body">
               <div class="box-body">
                  <div class="col-lg-3"> 
                    <label>Nomor Pesanan</label>
                    <input class="form-control" type="text" name="no_stokmini" id="no_stokmini" readonly="" value="<?php echo $no_stokmini;?>">
                  </div>
                  <div class="col-lg-3"> 
                    <label>Alamat Penerima</label>
                    <textarea style="resize:none;width:230px;height:50px;" class="form-control" type="text" name="alamat_kirim" id="alamat_kirim" placeholder="Alamat Penerima Untuk Pengiriman Barang" required=""></textarea>
                  </div>
                  <div class="col-lg-3"> 
                    <label>Keterangan Tambahan</label>
                    <textarea style="resize:none;width:230px;height:50px;" class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan Tambahan" required=""></textarea>
                  </div>
                </div>
                  <hr>
                  <div class="box-body" id="list_pilih">
                    <div class="col-lg-3">                   
                      <label>Penerbit</label>
                        <select class="form-control select2" style="width: 100%;" id ='kode_penerbit' name='kode_penerbit'>
                        <option value= "">--Pilih Penerbit--</option>
                        <?php foreach ($penerbit as $penerbit) { 
                          echo '<option value= "'.$penerbit['kode_penerbit'].'">'.$penerbit['nama_penerbit'].'</option>';
                        }?>
                        </select>
                    </div>
                    <div class="col-lg-3"> 
                      <div id="div_tipe">
                        <label>Tipe Buku</label>
                          <select class="form-control select2" style="width: 100%;" id ='tipe_buku' name='tipe_buku'>
                          <option value= "">--Pilih Tipe Buku--</option>
                          </select>
                      </div>                 
                      
                        <div id="loading" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div id="div_jenjang">
                        <label>Jenjang</label>
                          <select class="form-control select2" style="width: 100%;" id ='jenjang' name='jenjang'>
                          <option value= "">--Pilih Jenjang--</option>
                          </select>
                      </div>                         
                        <div id="loading1" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                  </div>
                  <div class="box-body"  id="list_pilih1">
                    <div class="col-lg-3">
                      <div id="div_edisi">
                        <label>Edisi</label>
                        <select class="form-control select2" style="width: 100%;" id ='edisi' name='edisi'>
                        <option value= "">--Pilih Edisi--</option>
                        </select>
                      </div> 
                        <div id="loading2" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                    <div class="col-lg-3"> 
                      <div id="div_kurikulum">
                        <label>Kurikulum</label>
                        <select class="form-control select2" style="width: 100%;" id ='kurikulum' name='kurikulum'>
                        <option value= "">--Pilih Kurikulum--</option>
                        </select>
                      </div>
                        <div id="loading3" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                  </div>
                  </div>
                  <div class="box-body">
                  <div class="col-lg-3">
                    <div id="loadingu" style="margin-top: 15px;">
                      <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                    </div>
                  </div>
                  </div>
              
            </div>
            <hr>
            <div class="box-body">
            <table id="buku" class="table table-bordered table-striped" name='buku'>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Buku</th>
                  <th>Judul Buku</th>
                  <th>Stok Real</th>
                  <th>Stok Pesan</th>
                  <th>Harga Jawa</th>
                  <th>Harga Luar</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
              </tbody>
              </table>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info btn-lg pull-right">Buat Pesanan</button>
            </div>
            </form>
        </div>
    </section>
</div>

<!-- Load librari/plugin jquery nya -->
<script src="<?php echo base_url("js/jquery-1.7.1.min.js"); ?>" type="text/javascript"></script>
<script>   
    $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>
  <script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>
  <script>
  $(function () {
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script>
<script>
  $(document).ready(function(){
  $("#loadinge").hide();
  $("#loadinget").hide();
    $("#sumber_dana").change(function(){ 
      $("#loadinge").show();
      $("#loadinget").show(); 
      $("#div_mou").hide();
      $("#div_pengajuan").hide();

    
    });
  });
</script>
<script type="text/javascript">
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
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
      $("#div_tipe").hide();
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
          $("#div_tipe").show();
          $("#tipe_buku").html(response.tipe_buku).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //jenjang
    $("#tipe_buku").change(function(){ 
      $("#div_jenjang").hide();
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
          $("#div_jenjang").show();
          $("#jenjang").html(response.jenjang).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //edisi
    $("#jenjang").change(function(){ 
      $("#div_edisi").hide();
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
          $("#div_edisi").show();
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
      $("#div_kurikulum").hide();
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
          $("#div_kurikulum").show();
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
        url: "<?php echo base_url("Form/Buku"); ?>",
        data: {data : $("#kode_penerbit").val()+"&"+$("#tipe_buku").val()+"&"+$("#jenjang").val()+"&"+$("#edisi").val()+"&"+$("#kurikulum").val()}, 
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
