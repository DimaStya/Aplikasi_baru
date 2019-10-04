<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Report LPB</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
        <form action="<?php echo base_url().'Report/Excel_lpb';?>" method="POST">
            <div class="box-header with-border">
              <h3 class="box-title">Report LPB</h3> &nbsp;
              <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-fw fa-file-excel-o"></i>Export Excel</button> 
              <img id="loading" src="<?php echo base_url('images/loading.gif');?>" width="18"><small id="loadingt">Loading...</small>        
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
                <div class="col-lg-1">                   
                  <label></label>
                    <button type="button" class="form-control btn btn-block btn-info btn-xs" id="cari" name="cari">cari</button>

                </div>    
                    
              </div>
            </form> 
            <hr>
            <div class="box-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>No LPB</th>
                  <th>Kode Buku</th>
                  <th>Judul</th>
                  <th>No OC</th>
                  <th>Jumlah Cetak</th>
                </tr>
              </thead>
              <tbody id="data">
                <tr>
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
        </div>
    </section>
</div>

<!-- Load librari/plugin jquery nya -->
<script src="<?php echo base_url("js/jquery-1.7.1.min.js"); ?>" type="text/javascript"></script>
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
        url: "<?php echo base_url("Report/Cari_lpb"); ?>",
        data: {data : $("#awal").val()+'&'+$("#akhir").val()}, 
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
