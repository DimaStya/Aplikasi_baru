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
<script src = "<?php echo base_url('js/pesanan.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Daftar OC</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog" style="width: 90%; align-content: center; margin:5%;" >
    <div class="modal-dialog" style="width: 100%;">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Buku Order Cetak</h4>
          <div id="loading_buk" style="margin-top: 15px;">
            <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
          </div>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <b><center id="kode_oc"></center></b>
          <hr>
          <form action="<?php echo base_url().'Produksi/Update_oc/';?>" method="POST">
          <table  class="table table-bordered table-striped">
            <thead>
              <tr>
              <th width="8%">No</th>
              <th width="25%">Kode Buku</th>
              <th width="45%">Judul</th>
              <th width="15%">Jumlah</th>
              <th width="15%">Kurangi</th>
              <th></th>
            </tr> 
            </thead>
            <tbody id="buku_oc">
              
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5" align="right"></td>
                <td><button type="submit" class="btn btn-info">Update</button></td>
              </tr>
            </tfoot>     
          </table>
        </form>
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
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Order Cetak</h3>
              <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div> 
            </div>
            <div class="box-body">
              <div class="col-lg-3"> 
                <label>Tanggal Awal</label>
                <input class="form-control" value="<?php echo $awal; ?>" type="text" name="awal" id="awal">
              </div>
              <div class="col-lg-3"> 
                <label>Tanggal Akhir</label>
                <input class="form-control" value="<?php echo $akhir; ?>" type="text" name="akhir" id="akhir"> 
              </div>
              <div class="col-lg-3">
                <div id="loading" style="margin-top: 15px;">
                  <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                </div>
              </div>
            </div>
            <hr>
            <div class="box-body">
                <table cellspacing="0" id="gvMain" style="width: 100%; border-collapse: collapse;">
                  <tr class="GridViewScrollHeader">
                    <th scope="col">No</th>
                    <th scope="col">Tanggal OC</th>
                    <th scope="col">No OC</th>
                    <th scope="col">Nama Admin</th>
                    <th scope="col">Aksi</th>
                  </tr>
                  <tbody id="data">
                    <tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>
                  <?php $no=1; foreach ($order_cetak as $order_cetak) {?>
                    <tr class="GridViewScrollItem">
                      <td scope="col"><?php echo $no; ?></td>
                      <td scope="col"><?php echo $order_cetak['tanggal']; ?></td>
                      <td scope="col"><?php echo $order_cetak['kode_oc']; ?></td>
                      <td scope="col"><?php echo $order_cetak['nama_produksi']; ?></td>
                      <td scope="col"><button type="button" name="klik<?php echo $no;?>" id="klik<?php echo $no;?>" class="btn btn-success" data-toggle="modal" value="<?php echo $order_cetak['kode_oc']; ?>" data-target="#myModal">Update</button></td>
                  </tr>
                  <?php $no++; }?>
                  </tbody>
              </table>
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
    $("#loading").hide();
    $("#loading_buk").hide();
    //awal
    $("#awal").change(function(){ 
      $("#loading").show();
      document.getElementById("akhir").disabled = true;
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Produksi/Ambil_oc"); ?>",
        data: {data : $("#awal").val()+"&"+$("#akhir").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          document.getElementById("akhir").disabled = false;
          $("#data").html(response.data_oc).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //akhir
    $("#akhir").change(function(){ 
      $("#loading").show();
      document.getElementById("awal").disabled = true;
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Produksi/Ambil_oc"); ?>",
        data: {data : $("#awal").val()+"&"+$("#akhir").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          document.getElementById("awal").disabled = false;
          $("#data").html(response.data_oc).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //data buku
    <?php $no=1; foreach ($order_cetak as $order_cetak) {?>
     $("#klik<?php echo $no;?>").click(function(){ 
      $("#loading_buk").show();
      $("#buku_oc").hide();
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Produksi/Ambil_bukuoc"); ?>",
        data: {data : $("#klik<?php echo $no;?>").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading_buk").hide();
          $("#buku_oc").html(response.buku_oc).show();
          document.getElementById("kode_oc").innerHTML = $("#klik<?php echo $no;?>").val();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
     <?php $no++; }?>
  });
  </script>
