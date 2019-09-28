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
  .GridViewScrollHeader TH, .GridViewScrollHeader TD {
    padding: 10px;
    font-weight: normal;
    white-space: nowrap;
    border-right: 1px solid #e6e6e6;
    border-bottom: 1px solid #e6e6e6;
    background-color: #F4F4F4;
    color: #999999;
    text-align: left;
    vertical-align: bottom;
}

.GridViewScrollItem TD {
    padding: 10px;
    white-space: nowrap;
    border-right: 1px solid #e6e6e6;
    border-bottom: 1px solid #e6e6e6;
    background-color: #FFFFFF;
    color: #444444;
}

.GridViewScrollItemFreeze TD {
    padding: 10px;
    white-space: nowrap;
    border-right: 1px solid #e6e6e6;
    border-bottom: 1px solid #e6e6e6;
    background-color: #FAFAFA;
    color: #444444;
}

.GridViewScrollFooterFreeze TD {
    padding: 10px;
    white-space: nowrap;
    border-right: 1px solid #e6e6e6;
    border-top: 1px solid #e6e6e6;
    border-bottom: 1px solid #e6e6e6;
    background-color: #F4F4F4;
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
      <li class="active">Buat OC/li>
    </ol>
  </section>
    <section class="content">
      <div id="myModal" class="modal fade" role="dialog" style="width: 90%; align-content: center; margin:5%;" >
    <div class="modal-dialog" style="width: 100%;">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Buku Order Cetak</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            <div class="box-body">
              <div class="col-lg-2"> 
                <label>Penerbit</label>
                <select class="form-control" name="kode_penerbit" id="kode_penerbit">
                  <option value="">--Pilih Penerbit--</option>
                  <?php foreach ($penerbit as $penerbit) {?>
                    <option value="<?php echo $penerbit['kode_penerbit']; ?>"><?php echo $penerbit['nama_penerbit']; ?></option>
                  <?php }?>
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
              <div class="col-lg-2">
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
              <div class="col-lg-2">
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
              <div class="col-lg-2">
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
        </div>
          <div id="loading_buk" style="margin-top: 15px;">
            <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
          </div>
          <hr>
          <table  class="table table-bordered table-striped">
            <thead>
              <tr>
              <th width="8%">No</th>
              <th width="25%">Kode Buku</th>
              <th width="60%">Judul</th>
              <th width="15%">Aksi</th>
            </tr> 
            </thead>
            <tbody id="buku_oc">
              
            </tbody>
            <tfoot>
            </tfoot>     
          </table>
          <hr>
          
           <hr> 
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default"  data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Add Buku</h3>&nbsp;<button type="button" name="klik1" id="klik1" class="btn-info" data-toggle="modal" data-target="#myModal">+</button>
              <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div> 
            </div>
            <div class="box-body">
            <form method="POST" action="<?php echo base_url().'Produksi/Add_oc/';?>">
              <div class="col-lg-3">
              <input class="form-control" type="text" name="kode_oc" id="kode_oc" value="<?php echo $kode_oc;?>" readonly="">
              <hr></div>

                <table class="table table-bordered table-striped" style="width: 100%;">
                  <tr>
                    <th width="25%">Kode Buku</th>
                    <th width="60%">Judul</th>
                    <th width="10%">Jumlah</th>
                    <th width="5%">Hapus</th>
                  </tr>
                  <tbody id="data">
                    
                  </tbody>

              </table>
              <hr>
              <button type='button' class='btn btn-danger pull-right' name='delete_row' id='delete_row'>Batalkan</button>
              <button type='submit' class='btn btn-primary'>Simpan</button>
                </form>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url("js/jquery-1.7.1.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("js/gridviewscroll.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>
<script>   
    $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>
<script>
  $(function () {
    //Date picker
    $('#awal').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
    });

    $('#akhir').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
    });
  });

</script>
<script type="text/javascript">
        var gridViewScroll = null;
        window.onload = function () {
            gridViewScroll = new GridViewScroll({
                elementID: "gvMain",
                width: 1080,
                height: 700,
                freezeColumn: true,
                freezeFooter: true,
                freezeColumnCssClass: "GridViewScrollItemFreeze",
                freezeFooterCssClass: "GridViewScrollFooterFreeze",
                freezeHeaderRowCount: 0,
                freezeColumnCount: 0,
                onscroll: function (scrollTop, scrollLeft) {
                    console.log(scrollTop + " - " + scrollLeft);
                }
            }); 
            gridViewScroll.enhance();
        }
    </script>
    <script>
  $(document).ready(function(){
    function formatNumber (num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    }
    $("#delete_row").click(function(){
        $("table tbody").find('input[name="record"]').each(function(){
          if($(this).is(":checked")){
                $(this).parents("tr").remove();
            }
        });
      });
  });
  </script>
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    $("#loading").hide();
    $("#loading1").hide();
    $("#loading2").hide();
    $("#loading3").hide();
    $("#loading_buk").hide();
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
    $("#loading_buk").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Form/Buku_oc"); ?>",
        data: {data : $("#kode_penerbit").val()+"&"+$("#tipe_buku").val()+"&"+$("#jenjang").val()+"&"+$("#edisi").val()+"&"+$("#kurikulum").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading_buk").hide();
          $("#buku_oc").html(response.buku_oc).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
  });
</script>
