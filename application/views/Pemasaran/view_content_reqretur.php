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
      <li class="active">Daftar Req Retur</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 75%;">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Detail Req Retur</h4>
          <b><center id="no_suratretur"></center></b>
          <div class="col-lg-3">
                <div id="loadingklik" style="margin-top: 15px;">
                  <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                </div>
              </div>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
                <div class="box-body"> 
                <div id="headretur"></div>  
                <br>          
                   <table width="100%"  rules="rows" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th width="5%">No</th>
                          <th width="15%">Kode Buku</th>
                          <th width="50%">Judul</th>
                          <th width="10%">Jumlah Kirim</th>
                          <th width="10%">Jumlah Retur</th>
                        </tr> 
                      </thead>
                      <tbody id="reqretur">
                        
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="5" align="right"><div id="button"></div></td>
                        </tr>
                      </tfoot>     
                    </table>
                </div>
              </div>
          </div>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="box box-success">
            <div class="box-header with-border">
              <div class="col-lg-2">
                 <h3 class="box-title">Daftar Req Retur</h3>
              <div id="notifications"><?php echo $this->session->flashdata('pesan'); ?></div>
              </div>
              <div class="col-lg-3">
                <div id="loadingklik1" style="margin-top: 0px;">
                  <img src="<?php echo base_url('images/loading.gif');?>" width="18"> <small>Loading...</small>
                </div>
              </div>
              
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
              <div id="alert"></div>
            </div>
            <hr>
            <div class="box-body">
              <form action="<?php echo base_url().'Pemasaran/Hapuspesan';?>" method='POST'>
            <table cellspacing="0" id="gvMain" style="width: 100%; border-collapse: collapse;">
                  <tr class="GridViewScrollHeader">
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">No DO</th>
                    <th scope="col">No Retur</th>
                    <th scope="col">Alasan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                  <tbody id="data">
                    <tr class="GridViewScrollItem">
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                  </tr>
                  <?php $no=1; foreach ($reqretur as $reqretur) {?>

                    <tr class="GridViewScrollItem">
                      <td scope="col"><?php echo $no; ?></td>
                      <td scope="col"><?php echo $reqretur['tanggal']; ?></td>
                      <td scope="col"><?php echo $reqretur['no_do']; ?></td>
                      <td scope="col"><?php echo $reqretur['no_suratretur']; ?></td>
                      <td scope="col"><?php echo $reqretur['alasan']; ?></td>
                      <td scope="col">
                          <button type="button" name="klik<?php echo $no; ?>" id="klik<?php echo $no; ?>" value="<?php echo $reqretur['no_suratretur']; ?>" class="btn btn-info" data-toggle="modal" data-target="#myModal">Detail</button>
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
    $("#loadingklik1").hide();
    //wilayah
    $("#kode_wilayah").change(function(){ 
      $("#loading").show();
    
      $.ajax({
        type: "POST",
        url: "<?php echo base_url("Pemasaran/Ambil_reqretur"); ?>",
        data: {data : $("#kode_wilayah").val()}, 
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#loading").hide();
          $("#data").html(response.reqretur).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
      });
    });
    <?php $no=1; foreach ($reqretur as $reqretur) {?>

    $('#klik<?php echo $no;?>').click(function(){ 
      $('#loadingklik').show();
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url("Pemasaran/Data_reqretur"); ?>",
        data: {data : $("#klik<?php echo $no;?>").val()}, 
        dataType: 'json',
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType('application/json;charset=UTF-8');
          }
        },
        success: function(response){
          $('#loadingklik').hide();
          $('#reqretur').html(response.reqretur).show();
          $('#headretur').html(response.headretur).show();
          $('#button').html(response.button).show();
          document.getElementById('no_suratretur').innerHTML = $("#klik<?php echo $no;?>").val();
        },
      });
    });
    <?php $no++; }?>
  });
  </script>
