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
      <li class="active">Daftar Pesanan</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog"  style="width: 75%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Area</h4>
                <div id="loadingklik" style="margin-top: 15px;">
                  <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                </div>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Perwakilan/Add_stokmini'; ?>" autocomplete="off" method="POST">
                <div class="box-body">                  
                   <table width="100%" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th width="5%">No</th>
                          <th width="25%">No Pesan</th>
                          <th width="10%">Kode Buku</th>
                          <th width="41%">Judul</th>
                          <th width="13%">Jumlah Pesan</th>
                        </tr> 
                      </thead>
                      <tbody id="stokmini">
                        
                      </tbody>
                      <tfoot>
                      </tfoot>     
                    </table>
                </div>
                <div class="box-footer" id="button">
              </div>
              </form>
          </div>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Pesanan</h3>
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
            <form method="POST" action="<?php echo base_url().'Perwakilan/Det_terfaktur/';?>">
                <table cellspacing="0" id="gvMain" style="width: 100%; border-collapse: collapse;">
                  <tr class="GridViewScrollHeader">
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Pesan</th>
                    <th scope="col">No Pesanan</th>
                    <th scope="col">Alamat Kirim</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">SJ</th>
                    <th scope="col">Detail</th>
                  </tr>
                  <tbody id="data">
                    <tr class="GridViewScrollItem">
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                      <td scope="col"></td>
                  </tr>
                  <?php $no=1; foreach ($pesanan as $pesanan) {?>
                    <tr class="GridViewScrollItem">
                      <td scope="col"><?php echo $no; ?></td>
                      <td scope="col"><?php echo $pesanan['tanggal']; ?></td>
                      <td scope="col"><?php echo $pesanan['no_do_stokmini']; ?></td>
                      <td scope="col"><?php echo $pesanan['alamat_kirim']; ?></td>
                      <td scope="col"><?php echo $pesanan['keterangan']; ?></td>
                      <td scope="col"><?php echo $pesanan['sj']; ?></td>
                      <td scope="col">
                          <button type='button' class='btn-info' data-toggle='modal' name="klik<?php echo $no;?>" id="klik<?php echo $no;?>" value="<?php echo $pesanan['no_do_stokmini']; ?>" data-target='#myModal'>Detail</button>
                        </td>
                  </tr>
                  <?php $no++; }?>
                  </tbody>
              </table>
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
    $("#loading").hide();
    $("#loadingklik").hide();
    //awal
    $("#awal").change(function(){ 
      $("#loading").show();
      document.getElementById("akhir").disabled = true;
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Perwakilan/Ambil_approve_stokmimni"); ?>",
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
          $("#data").html(response.data_pesanan).show();
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
        url: "<?php echo base_url("Perwakilan/Ambil_approve_stokmimni"); ?>",
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
          $("#data").html(response.data_pesanan).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    //klik
    <?php $no=1; foreach ($pesanan as $pesanan) {?>

    $("#klik<?php echo $no;?>").click(function(){ 
      $("#loadingklik").show();
      $('#stokmini').hide();
      $('#button').hide();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Perwakilan/Detail_stokmini"); ?>",
        data: {data : $("#klik<?php echo $no;?>").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $('#loadingklik').hide();
          $('#stokmini').html(response.stokmini).show();
          $('#button').html(response.button).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    <?php $no++; }?>
  });
  </script>
