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
      <li class="active">Daftar DO</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar DO</h3>
              <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div> 
            </div>
            <div class="box-body">
              <div class="col-lg-3"> 
                <label>Perwakilan</label>
                <select class="form-control" name="kode_wilayah" id="kode_wilayah">
                  <?php foreach ($kawasan as $kawasan) {?>
                    <option value="<?php echo $kawasan['kode_wilayah']; ?>"><?php echo $kawasan['alamat_perwakilan']; ?></option>
                  <?php }?>
                </select>
              </div>
              <div class="col-lg-3">
                <div id="loading" style="margin-top: 15px;">
                  <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                </div>
              </div>
            </div>
            <hr>
            <div class="box-body">
              <form action="<?php echo base_url().'Pemasaran/Hapuspesan';?>" method='POST'>
            <table cellspacing="0" id="gvMain" style="width: 100%; border-collapse: collapse;">
                  <tr class="GridViewScrollHeader">
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">No Pesanan</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Alasan</th>
                    <th scope="col">Nama Customer</th>
                    <th scope="col">CV Rekanan</th>
                    <th scope="col">Kerjasama</th>
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
                    <td scope="col"></td>
                  </tr>
                  <?php $no=1; foreach ($pesanan as $pesanan) {?>

                    <tr class="GridViewScrollItem">
                      <td scope="col"><?php echo $no; ?></td>
                      <td scope="col"><?php echo $pesanan['tanggal']; ?></td>
                      <td scope="col"><?php echo $pesanan['no_pesanan']; ?></td>
                      <td scope="col"><button name="no_pesanan" id="no_pesanan" value="<?php echo $pesanan['no_pesanan']; ?>" type="submit" class="btn btn-danger">Hapus Pesanan</button></td>
                      <td scope="col" width="380" style="white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-wrap:break-word"><?php echo $pesanan['alasan']; ?></td>
                      <td scope="col"><?php echo $pesanan['nama_customer']; ?></td>
                      <td scope="col"><?php echo $pesanan['nama_cv']; ?></td>
                      <td scope="col"><?php echo $pesanan['nama_kerjasama']; ?></td>
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
    $("#kode_wilayah").change(function(){ 
      $("#loading").show();
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Pemasaran/Ambil_req"); ?>",
        data: {data : $("#kode_wilayah").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          $("#data").html(response.data_pesanan).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
  });
  </script>
