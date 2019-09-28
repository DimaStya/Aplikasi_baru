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
          <table  class="table table-bordered table-striped">
            <thead>
              <tr>
              <th>No</th>
              <th>Kode OC</th>
              <th>Kode Buku</th>
              <th>Judul</th>
              <th>Jumlah</th>
              <th>Kurang</th>
              <th>Baru</th>
            </tr> 
            </thead>
            <tbody>
              <?php
              $no =1;
              foreach ($buku_oc as $data) {
                echo "
                  <tr>
                    <td>".$no."</td>
                    <td>".$data->kode_oc."</td>
                    <td>".$data->kode_buku."</td>
                    <td>".$data->judul."</td>
                    <td>".$data->jumlah."</td>
                    <td>".$data->kurang."</td>
                    <td>
                    <button type='button' class='btn-success' name='add".$no."' id='add".$no."' data-dismiss='modal'>Add</button>
                    </td>
                  </tr>
                ";
              $no++;}
              ?>
            </tbody>
            <tfoot>
            </tfoot>     
          </table>
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
            <form method="POST" action="<?php echo base_url().'Gudang/Add_lpb/';?>">
              <div class="col-lg-3">
              <input class="form-control" type="text" name="kode_lpb" id="kode_lpb" value="<?php echo $kode_lpb;?>" readonly="">
              <hr></div>
                <table class="table table-bordered table-striped" style="width: 100%;">
                  <tr>
                    <th>No</th>
                    <th>Kode OC</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Jumlah</th>
                    <th>Kurang</th>
                    <th>Baru</th>
                  </tr>
                  <tbody id="buku_lpb">
                    
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
  <?php
              $no =1;
              $number = "'number'";
              $text = "'hidden'";
              $min = "'0'";
              $jumlah = "'jumlah[]'";
              $kodebuku = "'kode_buku[]'";
              $kodeoc = "'kode_oc[]'";
              $checkbox = "'checkbox'";
              $record = "'record'";
              $class = "'form-control'";
              foreach ($buku_oc as $data) {
                $max = "'".$data->kurang."'";
                $kode_buku = "'".$data->kode_buku."'";
                $kode_oc = "'".$data->kode_oc."'";
echo '

$("#add'.$no.'").click(function(){            
  var markup = "<tr><td>'.$no.'</td><td>'.$data->kode_oc.'</td><td>'.$data->kode_buku.'</td><td>'.$data->judul.'</td><td>'.$data->jumlah.'</td><td>'.$data->kurang.'</td><td><input  class='.$class.' type='.$text.' name='.$kodebuku.' id='.$kodebuku.' value='.$kode_buku.' required><input  class='.$class.' type='.$text.' name='.$kodeoc.' id='.$kodeoc.' value='.$kode_oc.' required><input  class='.$class.' type='.$number.' min='.$min.' max='.$max.' name='.$jumlah.' id='.$jumlah.' required></td><td><input type='.$checkbox.' name='.$record.'></td></tr>";
  $("#buku_lpb").append(markup);
});
';
$no++;}
?>
</script>
