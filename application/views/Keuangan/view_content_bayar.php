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
    <section class="content">
      <div id="myModal" class="modal fade" role="dialog" style="width: 90%; align-content: center; margin:5%;" >
    <div class="modal-dialog" style="width: 100%;">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Area</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
              <div class="box-body">
              <div class="col-lg-3"> 
                <label>Perwakilan</label>
                <select class="form-control" name="kode_wilayah" id="kode_wilayah">
                  <?php foreach ($kawasan as $kawasan) {?>
                    <option value="<?php echo $kawasan['kode_wilayah']; ?>"><?php echo $kawasan['alamat_perwakilan']; ?></option>
                  <?php }?>
                </select>
              </div>
              <div class="col-lg-2"> 
                <label>Nomer</label>
                <input class="form-control" type="text" name="no" id="no">
              </div>
              <div class="col-lg-2"> 
                <label>Bulan</label>
                <select  class="form-control" name="bulan" id="bulan">
                  <option value="I">Januari</option>
                  <option value="II">Februari</option>
                  <option value="III">Maret</option>
                  <option value="IV">Apkril</option>
                  <option value="V">Mei</option>
                  <option value="VI">Juni</option>
                  <option value="VII">Juli</option>
                  <option value="VIII">Agustus</option>
                  <option value="IX">September</option>
                  <option value="X">Oktober</option>
                  <option value="XI">November</option>
                  <option value="XII">Desember</option>
                </select>
              </div>
              <div class="col-lg-2"> 
                <label>Tahun</label>
                <select class="form-control" name="tahun" id="tahun">
                  <?php foreach ($tahun as $tahun) {?>
                    <option value="<?php echo $tahun['harga_tahun']; ?>"><?php echo $tahun['harga_tahun']; ?></option>
                  <?php }?>
                </select>
              </div>
              <div class="col-lg-2">
                <label></label>
                <button name="klik" id="klik" class="btn btn-info form-control">Cari Faktur</button>
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
              <th>No Faktur</th>
              <th>Tanggal</th>
              <th>Total Netto</th>
              <th>Total Terbayar</th>
              <th>Total Kurang</th>
            </tr> 
            </thead>
            <tbody id="faktur">
              
            </tbody>
            <tfoot>
            </tfoot>     
          </table>
          <hr>
          <button type='button' class='btn btn-success' name='add' id='add' data-dismiss='modal'>Add</button>
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
              <h3 class="box-title">Add Faktur</h3>&nbsp;<button type="button" name="klik1" id="klik1" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','','','')">+</button>
              <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div> 
            </div>
            <b><center><?php $pakai=$bkm['total']-$bkm['terpakai']; echo 'No BKM :'.$bkm['no_kas'].' Total :'.number_format($bkm['total'],0,',','.').' Tersisa :'.number_format($pakai,0,',','.');?></center></b>
            <hr>
            <div class="box-body">
            <form method="POST" action="<?php echo base_url().'Keuangan/Pembayaran/';?>">
              <input type="hidden" name="no_kas" id="no_kas" value="<?php echo $bkm['no_kas'];?>">
                <table class="table table-bordered table-striped" style="width: 100%;">
                  <tr>
                    <th >No Faktur</th>
                    <th >Tanggal</th>
                    <th >Perwakilan</th>
                    <th >Total Nett</th>
                    <th >Kekurangan</th>
                    <th >Jumlah Bayar</th>
                    <th >Batal Pilih</th>
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
    $("#loading").hide();
    //wilayah
    $("#klik").click(function(){ 
      $("#loading").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Keuangan/Ambil_faktur"); ?>",
        data: {data : $("#no").val()+"&"+$("#kode_wilayah").val()+"&"+$("#bulan").val()+"&"+$("#tahun").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          $("#faktur").html(response.data_faktur).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    $("#klik1").click(function(){ 
      $("#loading").show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Keuangan/Ambil_faktur"); ?>",
        data: {data : '0'+"&"+'0'+"&"+'0'+"&"+'0'}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          $("#faktur").html(response.data_faktur).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    function formatNumber (num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    }
    //add
    $("#add").click(function(){
            var no_faktur = $("#no_faktur").val();
            var kode_piutang = $("#kode_piutang").val();
            var tanggal = $("#tanggal").val();
            var alamat_perwakilan = $("#alamat_perwakilan").val();
            var kurangnya = $("#kurang").val();
            var netto = formatNumber($("#netto").val());
            var kurang = formatNumber($("#kurang").val());
            var markup = "<tr><td>"+no_faktur+"</td><td>"+tanggal+"</td><td>"+alamat_perwakilan+"</td><td align='right'>"+netto+"</td><td align='right'>"+kurang+"</td><td><input type='number' min='0' max='"+kurangnya+"' name='pembayaran[]' id='pembayaran[]' required=''><input type='hidden' name='no_faktur[]' id='no_faktur[]' value='"+no_faktur+"'><input type='hidden' name='kode_piutang[]' id='kode_piutang[]' value='"+kode_piutang+"'></td><td><input type='checkbox' name='record'></td></tr>";
            $("#data").append(markup);
        });
    $("#delete_row").click(function(){
        $("table tbody").find('input[name="record"]').each(function(){
          if($(this).is(":checked")){
                $(this).parents("tr").remove();
            }
        });
      });
  });
  </script>
