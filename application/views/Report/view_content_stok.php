<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Report Stok Buku</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
        <form action="<?php echo base_url().'Report/Excel_stok';?>" method="POST">
            <div class="box-header with-border">
              <h3 class="box-title">Report Stok Buku</h3> &nbsp;
              <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-fw fa-file-excel-o"></i>Export Excel</button> 
              <img id="loading" src="<?php echo base_url('images/loading.gif');?>" width="18"><small id="loadingt">Loading...</small>        
            </div>
              <div class="box-body">
                <div class="col-lg-2">                   
                  <label>Penerbit</label>
                    <select class="form-control select2" style="width: 100%;" id ='perwakilan' name='perwakilan'>
                    <?php foreach ($penerbit as $data) {
                      echo "<option value= '".$data->kode_penerbit."'>".$data->nama_penerbit."</option>";
                    }?>
                    </select>
                </div>
                <div class="col-lg-2">                   
                  <label>Jenjang</label>
                    <select class="form-control select2" style="width: 100%;" id ='jenjang' name='jenjang'>
                      <option value="">All</option>
                    <?php foreach ($jenjang as $data) {
                      echo "<option value= '".$data->jenjang."'>".$data->jenjang."</option>";
                    }?>
                    </select>
                </div>
                <div class="col-lg-2">                   
                  <label>Tipe</label>
                    <select class="form-control select2" style="width: 100%;" id ='tipe' name='tipe'>
                      <option value="">All</option>
                    <?php foreach ($tipe as $data) {
                      echo "<option value= '".$data->tipe."'>".$data->tipe."</option>";
                    }?>
                    </select>
                </div>
                <div class="col-lg-2">                   
                  <label>Edisi</label>
                    <select class="form-control select2" style="width: 100%;" id ='edisi' name='edisi'>
                      <option value="">All</option>
                    <?php foreach ($edisi as $data) {
                      echo "<option value= '".$data->edisi."'>".$data->edisi."</option>";
                    }?>
                    </select>
                </div>
                <div class="col-lg-2">                   
                  <label>Kurikulum</label>
                    <select class="form-control select2" style="width: 100%;" id ='kurikulum' name='kurikulum'>
                      <option value="">All</option>
                    <?php foreach ($kurikulum as $data) {
                      echo "<option value= '".$data->kurikulum."'>".$data->kurikulum."</option>";
                    }?>
                    </select>
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
                  <th>Kode Buku</th>
                  <th>Judul</th>
                  <th>Edisi</th>
                  <th>Jenjang</th>
                  <th>Kurikulum</th>
                  <th>Stok Real</th>
                  <th>Stok Pesan</th>
                  <th>Stok OC</th>
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
  $(document).ready(function(){
  $("#loading").hide();
  $("#loadingt").hide();
    $("#cari").click(function(){ 
      $("#data").hide();
      $("#loading").show(); 
      $("#loadingt").show(); 
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Report/Cari_stok"); ?>",
        data: {data : $("#penerbit").val()+'&'+$("#jenjang").val()+'&'+$("#tipe").val()+'&'+$("#edisi").val()+'&'+$("#kurikulum").val()}, 
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
