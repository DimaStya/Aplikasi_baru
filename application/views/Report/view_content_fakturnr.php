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
      <li class="active">Report Faktur-Nota Retur</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
        <form action="<?php echo base_url().'Report/Excel_fakturnr';?>" method="POST">
            <div class="box-header with-border">
              <h3 class="box-title">Report Faktur-Nota Retur</h3> &nbsp;
              <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-fw fa-file-excel-o"></i>Export Excel</button> 
              <img id="loading" src="<?php echo base_url('images/loading.gif');?>" width="18"><small id="loadingt">Loading...</small>        
            </div>
              <div class="box-body">
                <div class="col-lg-2">                   
                  <label>Perwakilan</label>
                    <select class="form-control select2" style="width: 100%;" id ='perwakilan' name='perwakilan'>
                    <?php foreach ($kawasan as $data) {
                      echo "<option value= '".$data->kode_wilayah."'>".$data->alamat_perwakilan."</option>";
                    }?>
                    </select>
                </div>
              </div>
              <div class="box-body">
                <div class="col-lg-2"> 
                  <label>Tanggal Awal</label>
                  <input class="form-control" value="<?php echo $awal; ?>" type="text" name="awal" id="awal">
                </div>
                <div class="col-lg-2"> 
                  <label>Tanggal Akhir</label>
                  <input class="form-control" value="<?php echo $akhir; ?>" type="text" name="akhir" id="akhir"> 
                </div> 
              </div>
              <div class="box-body">
                <div class="col-lg-1">                   
                  <label></label>
                    <button type="button" class="form-control btn btn-block btn-info btn-xs" id="cari" name="cari">cari</button>
                </div>
              </div>
            </form> 
            <hr>
            <div class="box-body">
            <table cellspacing="0" id="gvMain" style="width: 100%; border-collapse: collapse;">
              <thead>
                <tr  class="GridViewScrollHeader">
                  <th scope="col">Tanggal</th>
                  <th scope="col">Sales</th>
                  <th scope="col">Customer</th>
                  <th scope="col">CV rekanan</th>
                  <th scope="col">No Faktur</th>
                  <th scope="col">Rabat %</th>
                  <th scope="col">Fee %</th>
                  <th scope="col">Bruto</th>
                  <th scope="col">Netto</th>
                  <th scope="col">Nota Retur</th>
                  <th scope="col">Bruto Retur</th>
                  <th scope="col">Netto Retur</th>
                  <th scope="col">No BKM</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Terbayar</th>
                  <th scope="col">Kurang</th>
                  <th scope="col">Fee</th>
                </tr>
              </thead>
              <tbody id="data">
                <tr class="GridViewScrollItem">
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                  </tr>
              </tbody>
              </table>
            </div>
        </div>
    </section>
</div>

<!-- Load librari/plugin jquery nya -->
<script src="<?php echo base_url("js/jquery-1.7.1.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("js/gridviewscroll.js"); ?>" type="text/javascript"></script>
<script>
  $(function () {
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
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
<script>
  $(document).ready(function(){
  $("#loading").hide();
  $("#loadingt").hide();

    $("#cari").click(function(){ 
      $("#data").hide();
      $("#loading").show(); 
      $("#loadingt").show();     
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Report/Cari_fakturnr"); ?>",
        data: {data : $("#perwakilan").val()+'&'+$("#awal").val()+'&'+$("#akhir").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          $("#loadingt").hide();
          $("#data").html(response.data).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
  });
</script>
