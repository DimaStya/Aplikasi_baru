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
        <form role="form" action="<?php echo base_url().'Proses/Add_pesanan'; ?>" autocomplete="off" method="POST">
            <div class="box-header with-border">
              <h3 class="box-title">Form Pemesanan Buku
                    <img id="loadinge" src="<?php echo base_url('images/loading.gif');?>" width="18"> <small id="loadinget">Loading...</small>
                  </h3>               
            </div>
            <div class="box-body">
               <div class="box-body">
                  <div class="col-lg-3"> 
                    <label>Nomor Pesanan</label>
                    <input class="form-control" type="text" name="no_pesan" id="no_pesan" readonly="" value="<?php echo $no_pesan;?>">
                  </div>
                  <div class="col-lg-3"> 
                    <label>Nama CV</label>
                    <input class="form-control" type="text" name="nama_cv" id="nama_cv" required="" readonly="">
                  </div>
                  <div class="col-lg-3"> 
                    <label>Nama Kerjasama</label>
                    <input class="form-control" type="text" name="nama_kerjasama" id="nama_kerjasama" readonly="">
                  </div>   
                  <div class="col-lg-3">                   
                    <label>Pilih Nama Sales</label>
                      <select class="form-control select2" style="width: 100%;" id ='kode_sales' name='kode_sales' required="">
                      <option value= "">--Pilih Nama Sales--</option>
                      <?php foreach ($sales as $sales) { 
                        echo '<option value= "'.$sales['kode_sales'].'">'.$sales['nama_sales'].'</option>';
                      }?>
                      </select>
                  </div>
                </div>
                <div class="box-body">
                  <div class="col-lg-3">                   
                    <label>Pilih Nama Customer</label>
                      <select class="form-control select2" style="width: 100%;" id ='kode_customer' name='kode_customer' required="">
                      <option value= "">--Pilih Nama Customer--</option>
                      <?php foreach ($customer as $customer) { 
                        echo '<option value= "'.$customer['kode_customer'].'">'.$customer['nama_customer'].'</option>';
                      }?>
                      </select>
                  </div>
                  <div class="col-lg-3">                   
                    <label>Sumber Dana</label>
                      <select class="form-control select2" style="width: 100%;" id ='sumber_dana' name='sumber_dana' required="">
                      <option value= "">--Pilih Sumber Dana--</option>
                      <option value= "BOS">BOS</option>
                      <option value= "SISWA">SISWA</option>
                      </select>
                  </div>
                  <div class="col-lg-3">
                  <div id='div_mou'>
                    <label>Pilih MoU Rekanan</label>
                      <select class="form-control select2" style="width: 100%;" id ='no_mou' name='no_mou' required="">
                          <option value= "">--Pilih No MoU--</option>
                      </select>
                  </div>                   
                  </div>
                  <div class="col-lg-3">
                  <div id="div_pengajuan">
                    <label>Pilih No Pengajuan</label>
                      <select class="form-control select2" style="width: 100%;" id ='no_pengajuan' name='no_pengajuan' >
                      <option value= "">--Pilih No Pengajuan--</option>
                      </select>
                  </div>
                  </div>
                  </div>
                  <div class="box-body">
                    <div class="col-lg-3"> 
                      <label>Alamat Penerima</label>
                      <textarea style="resize:none;width:230px;height:50px;" class="form-control" type="text" name="alamat_penerima" id="alamat_penerima" placeholder="Alamat Penerima Untuk Pengiriman Barang" required=""></textarea>
                    </div>
                    <div class="col-lg-3"> 
                      <label>Nama Pelanggan</label>
                      <input class="form-control" type="text" name="nama_penerima" id="nama_penerima" placeholder="Nama Pelanggan" required="">
                    </div>
                    <div class="col-lg-3"> 
                      <label>No Telp Pelanggan</label>
                      <input class="form-control" type="text" name="no_telp" id="no_telp" placeholder="No Telp" required="" onkeypress="return hanyaAngka(event);">
                    </div>
                    <div class="col-lg-3">                   
                      <label>Jenis Pembayaran</label>
                        <select class="form-control select2" style="width: 100%;" id ='jenis_pembayaran' name='jenis_pembayaran' required="">
                        <option value= "">--Pilih Jenis Pembayaran--</option>
                        <option value= "online">Online (TRANSFER)</option>
                        <option value= "offline">Offline (CASH)</option>
                        </select>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="col-lg-3"> 
                      <label>Keterangan Tambahan</label>
                      <textarea style="resize:none;width:230px;height:50px;" class="form-control" type="text" name="keterangan" id="keterangan" placeholder="Keterangan Tambahan" required=""></textarea>
                    </div>
                  </div>
                  <hr>
                   <div class="box-body">
                    <div class="col-lg-3">                   
                      <label>Stok</label>
                        <select class="form-control" style="width: 100%;" id ='stok' name='stok' required="">
                        <option value= "stok_real">Stok Pusat</option>
                        <option value= "stok_mini">Stok Mini</option>
                        </select>
                    </div>
                    <div class="col-lg-3"> </div>
                    <div class="col-lg-3" id="paket">                   
                      <label>Paket ?</label>
                        <select class="form-control" style="width: 100%;" id ='paket' name='paket' required="">
                        <option value= "no">No</option>
                        <option value= "yes">Yes</option>
                        </select>
                    </div>
                  </div>
                  <hr> 
                  <!-- stok Pusat Paket -->
                  <div  class="box-body" id="list_paket">
                    <div class="col-lg-3">                   
                      <label>Paket</label>
                        <select class="form-control select2" style="width: 100%;" id ='kode_paket' name='kode_paket'>
                        <option value= "">--Pilih Paket--</option>
                        <?php 
                          foreach ($paket as $paket) {
                           echo '<option value= "'.$paket['kode_paket'].'&'.$paket['nama_paket'].'">'.$paket['nama_paket'].'</option>';
                          }
                        ?>
                        </select>
                    </div>
                  </div>
                  <!-- stok Pusat Bukan Paket -->
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
                  <!-- stok mini Bukan Paket -->
                  <div class="box-body" id="list_pilih_mini">
                    <div class="col-lg-3">                   
                      <label>Penerbit</label>
                        <select class="form-control select2" style="width: 100%;" id ='kode_penerbit_mini' name='kode_penerbit_mini'>
                        <option value= "">--Pilih Penerbit--</option>
                        <?php foreach ($penerbit_mini as $penerbit_mini) { 
                          echo '<option value= "'.$penerbit_mini['kode_penerbit'].'">'.$penerbit_mini['nama_penerbit'].'</option>';
                        }?>
                        </select>
                    </div>
                    <div class="col-lg-3"> 
                      <div id="div_tipe_mini">
                        <label>Tipe Buku</label>
                          <select class="form-control select2" style="width: 100%;" id ='tipe_buku_mini' name='tipe_buku_mini'>
                          <option value= "">--Pilih Tipe Buku--</option>
                          </select>
                      </div>                 
                      
                        <div id="loading_mini" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div id="div_jenjang_mini">
                        <label>Jenjang</label>
                          <select class="form-control select2" style="width: 100%;" id ='jenjang_mini' name='jenjang_mini'>
                          <option value= "">--Pilih Jenjang--</option>
                          </select>
                      </div>                         
                        <div id="loading1_mini" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                  </div>
                  <div class="box-body"  id="list_pilih1_mini">
                    <div class="col-lg-3">
                      <div id="div_edisi_mini">
                        <label>Edisi</label>
                        <select class="form-control select2" style="width: 100%;" id ='edisi_mini' name='edisi_mini'>
                        <option value= "">--Pilih Edisi--</option>
                        </select>
                      </div> 
                        <div id="loading2_mini" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                    <div class="col-lg-3"> 
                      <div id="div_kurikulum_mini">
                        <label>Kurikulum</label>
                        <select class="form-control select2" style="width: 100%;" id ='kurikulum_mini' name='kurikulum_mini'>
                        <option value= "">--Pilih Kurikulum--</option>
                        </select>
                      </div>
                        <div id="loading3_mini" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                  </div>
                  </div>
                  <div class="box-body">
                  <div class="col-lg-3">
                    <div id="loadingu_mini" style="margin-top: 15px;">
                      <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                    </div>
                  </div>
                  </div>
              
            </div>
            <hr>
            <div class="box-body">
            <table class="table table-bordered table-striped" name='buku'>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Buku</th>
                  <th>Judul Buku</th>
                  <th>Stok</th>
                  <th>Stok Pesan</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody id="buku" >
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

    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Mou"); ?>",
        data: {sumber_dana : $("#sumber_dana").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loadinge").hide();
          $("#loadinget").hide();
          $("#div_mou").show();
          $("#div_pengajuan").show();
          $("#no_pengajuan").html(response.no_pengajuan).show();
          $("#no_mou").html(response.no_mou).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    $("#no_mou").change(function(){     
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Cv"); ?>",
        data: {no_mou : $("#no_mou").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#nama_cv").val(response.nama_cv);
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });

    $("#no_pengajuan").change(function(){     
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Kerjasama"); ?>",
        data: {no_pengajuan : $("#no_pengajuan").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#nama_kerjasama").val(response.nama_kerjasama);
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
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
<!-- pilih paket -->
<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    $("#loading1").hide();
    $("#loading2").hide();
    $("#loading3").hide();
    $("#loadingu").hide();
    $("#list_paket").hide();

    document.getElementById("kode_paket").required = false;
    document.getElementById("kode_penerbit").required = true;
    document.getElementById("tipe_buku").required = true;
    document.getElementById("jenjang").required = true;
    document.getElementById("edisi").required = true;
    document.getElementById("kurikulum").required = true;

    $("#paket").change(function(){
      if($("#paket").val() == 'yes'){
        $("#list_pilih").hide();
        $("#list_pilih1").hide();
        $("#list_paket").show();
        document.getElementById("kode_paket").required = true;
        document.getElementById("kode_penerbit").required = false;
        document.getElementById("tipe_buku").required = false;
        document.getElementById("jenjang").required = false;
        document.getElementById("edisi").required = false;
        document.getElementById("kurikulum").required = false;
      }else if($("#paket").val() == 'no'){
        $("#list_pilih").show();
        $("#list_pilih1").show();
        $("#list_paket").hide();
        document.getElementById("kode_paket").required = false;
        document.getElementById("kode_penerbit").required = true;
        document.getElementById("tipe_buku").required = true;
        document.getElementById("jenjang").required = true;
        document.getElementById("edisi").required = true;
        document.getElementById("kurikulum").required = true;

      }
      
    });
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
    $("#kode_paket").change(function(){ 
    $("#loadingu").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Buku_paket"); ?>",
        data: {data : $("#kode_paket").val()}, 
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
<!-- pilih stok -->
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading_mini").hide();
    $("#loading1_mini").hide();
    $("#loading2_mini").hide();
    $("#loading3_mini").hide();
    $("#loadingu_mini").hide();
    $("#list_pilih_mini").hide();
    $("#list_pilih1_mini").hide();

    document.getElementById("kode_penerbit_mini").required = false;
    document.getElementById("tipe_buku_mini").required = false;
    document.getElementById("jenjang_mini").required = false;
    document.getElementById("edisi_mini").required = false;
    document.getElementById("kurikulum_mini").required = false;

    $("#stok").change(function(){
      if($("#stok").val() == 'stok_mini'){
        $("#list_pilih").hide();
        $("#list_pilih1").hide();
        $("#paket").hide();
        $("#list_pilih_mini").show();
        $("#list_pilih1_mini").show();
        document.getElementById("kode_paket").required = false;
        document.getElementById("kode_penerbit").required = false;
        document.getElementById("tipe_buku").required = false;
        document.getElementById("jenjang").required = false;
        document.getElementById("edisi").required = false;
        document.getElementById("kurikulum").required = false;

        document.getElementById("kode_penerbit_mini").required = true;
        document.getElementById("tipe_buku_mini").required = true;
        document.getElementById("jenjang_mini").required = true;
        document.getElementById("edisi_mini").required = true;
        document.getElementById("kurikulum_mini").required = true;
      }else if($("#stok").val() == 'stok_real'){
        $("#list_pilih").show();
        $("#paket").show();
        $("#list_pilih1").show();
        $("#list_pilih_mini").hide();
        $("#list_pilih1_mini").hide();
        document.getElementById("kode_paket").required = true;
        document.getElementById("kode_penerbit").required = true;
        document.getElementById("tipe_buku").required = true;
        document.getElementById("jenjang").required = true;
        document.getElementById("edisi").required = true;
        document.getElementById("kurikulum").required = true;

        document.getElementById("kode_penerbit_mini").required = false;
        document.getElementById("tipe_buku_mini").required = false;
        document.getElementById("jenjang_mini").required = false;
        document.getElementById("edisi_mini").required = false;
        document.getElementById("kurikulum_mini").required = false;

      }
      
    });
    //tipe buku
    $("#kode_penerbit_mini").change(function(){ 
      $("#div_tipe_mini").hide();
      $("#loading_mini").show(); 
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Tipebuku_mini"); ?>",
        data: {kode_penerbit_mini : $("#kode_penerbit_mini").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading_mini").hide();
          $("#div_tipe_mini").show();
          $("#tipe_buku_mini").html(response.tipe_buku).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //jenjang
    $("#tipe_buku_mini").change(function(){ 
      $("#div_jenjang_mini").hide();
      $("#loading1_mini").show(); 
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Jenjang_mini"); ?>",
        data: {data : $("#kode_penerbit_mini").val()+"&"+$("#tipe_buku_mini").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading1_mini").hide();
          $("#div_jenjang_mini").show();
          $("#jenjang_mini").html(response.jenjang).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //edisi
    $("#jenjang_mini").change(function(){ 
      $("#div_edisi_mini").hide();
      $("#loading2_mini").show(); 
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Edisi_mini"); ?>",
        data: {data : $("#kode_penerbit_mini").val()+"&"+$("#tipe_buku_mini").val()+"&"+$("#jenjang_mini").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#div_edisi_mini").show();
          $("#loading2_mini").hide();
          $("#edisi_mini").html(response.edisi).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //kurikulum
    $("#edisi_mini").change(function(){ 
      $("#div_kurikulum_mini").hide();
      $("#loading3_mini").show(); 
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Kurikulum_mini"); ?>",
        data: {data : $("#kode_penerbit_mini").val()+"&"+$("#tipe_buku_mini").val()+"&"+$("#jenjang_mini").val()+"&"+$("#edisi_mini").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#div_kurikulum_mini").show();
          $("#loading3_mini").hide();
          $("#kurikulum_mini").html(response.kurikulum).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //Data Buku
    $("#kurikulum_mini").change(function(){ 
    $("#loadingu_mini").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Buku_mini"); ?>",
        data: {data : $("#kode_penerbit_mini").val()+"&"+$("#tipe_buku_mini").val()+"&"+$("#jenjang_mini").val()+"&"+$("#edisi_mini").val()+"&"+$("#kurikulum_mini").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loadingu_mini").hide();
          $("#buku").html(response.buku).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
  });
  </script>
