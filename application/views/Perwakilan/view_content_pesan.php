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
              <h3 class="box-title">Form Pemesanan Buku</h3>
            </div>
            <div class="box-body">
               <div class="box-body">
                  <div class="col-lg-3"> 
                    <label>Nomor Pesanan</label>
                    <input class="form-control" type="text" name="no_pesan" id="no_pesan" readonly="" value="<?php echo $no_pesan;?>">
                  </div>
                  <div class="col-lg-3"> 
                    <label>Nomor MoU</label>
                    <input class="form-control" type="text" name="no_mou" id="no_mou" required="" readonly="">
                  </div>
                  <div class="col-lg-3"> 
                    <label>Nilai Rabat</label>
                    <input class="form-control" type="text" name="rabat" id="rabat" readonly="">
                  </div>
                  <div id="loadinge" style="margin-top: 15px;">
                    <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                  </div>
                </div>
                <div class="box-body">
                  <div class="col-lg-3">                   
                    <label>Pilih Nama Sales</label>
                      <select class="form-control select2" style="width: 100%;" id ='kode_sales' name='kode_sales' required="">
                      <option value= "">--Pilih Nama Sales--</option>
                      <?php foreach ($sales as $sales) { 
                        echo '<option value= "'.$sales['kode_sales'].'">'.$sales['nama_sales'].'</option>';
                      }?>
                      </select>
                  </div>
                  <div class="col-lg-3">                   
                    <label>Pilih CV Rekanan</label>
                      <select class="form-control select2" style="width: 100%;" id ='kode_cv' name='kode_cv' required="">
                      <option value= "">--Pilih CV Rekanan--</option>
                      <?php foreach ($cv as $cv) { 
                        echo '<option value= "'.$cv['kode_cv'].'">'.$cv['nama_cv'].'</option>';
                      }?>
                      </select>
                  </div>
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
                      <option value= "LAIN">LAINNYA</option>
                      </select>
                  </div>
                  </div>
                  <div class="box-body">

                    <div class="col-lg-3"> 
                      <label>Alamat Penerima</label>
                      <textarea style="resize:none;width:230px;height:50px;" class="form-control" type="text" name="alamat_penerima" id="alamat_penerima" placeholder="Alamat Penerima Untuk Pengiriman Barang" required=""></textarea>
                    </div>
                    <div class="col-lg-3"> 
                      <label>Nama Penerima</label>
                      <input class="form-control" type="text" name="nama_penerima" id="nama_penerima" placeholder="Nama Penerima" required="">
                    </div>
                    <div class="col-lg-3"> 
                      <label>No Telp Penerima</label>
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
                  <hr>
                  <div class="box-body">
                    <div class="col-lg-3">                   
                      <label>Penerbit</label>
                        <select class="form-control select2" style="width: 100%;" id ='kode_penerbit' name='kode_penerbit' required="">
                        <option value= "">--Pilih Penerbit--</option>
                        <?php foreach ($penerbit as $penerbit) { 
                          echo '<option value= "'.$penerbit['kode_penerbit'].'">'.$penerbit['nama_penerbit'].'</option>';
                        }?>
                        </select>
                    </div>
                    <div class="col-lg-3">                   
                      <label>Tipe Buku</label>
                        <select class="form-control select2" style="width: 100%;" id ='tipe_buku' name='tipe_buku' required="">
                        <option value= "">--Pilih Tipe Buku--</option>
                        </select>
                        <div id="loading" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                    <div class="col-lg-3">                   
                      <label>Jenjang</label>
                        <select class="form-control select2" style="width: 100%;" id ='jenjang' name='jenjang' required="">
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
                        <select class="form-control select2" style="width: 100%;" id ='edisi' name='edisi' required="">
                        <option value= "">--Pilih Edisi--</option>
                        </select>
                        <div id="loading2" style="margin-top: 15px;">
                        <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                      </div>
                    </div>
                    <div class="col-lg-3">                   
                      <label>Kurikulum</label>
                        <select class="form-control select2" style="width: 100%;" id ='kurikulum' name='kurikulum' required="">
                        <option value= "">--Pilih Kurikulum--</option>
                        </select>
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
    $("#kode_cv").change(function(){
      $("#loadinge").show(); 
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Mou"); ?>",
        data: {kode_cv : $("#kode_cv").val()},
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loadinge").hide(); 
          $("#no_mou").val(response.no_mou);
          $("#rabat").val(response.rabat+ " %");

        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("#loadinge").hide(); 
          $("#no_mou").val('');
          $("#rabat").val('');
          //alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
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
