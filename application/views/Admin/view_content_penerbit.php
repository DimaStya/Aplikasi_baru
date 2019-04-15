<script src = "<?php echo base_url('js/penerbit.js'); ?>"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Penerbit</li>
    </ol>
  </section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kelola Data Penerbit</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <div class="box box-primary">
            
              <form role="form" action="<?php echo base_url().'Proses/Add_penerbit'; ?>" autocomplete="off" method="POST">
                <div class="box-body">
                <div class="form-group"> 
                  <div class="col-xs-6">
                      <label>Nama Penerbit</label>
                      <input type="hidden" name="kode_penerbit" id="kode_penerbit">
                      <input type="text" class="form-control col-xs-6" name="nama_penerbit" id="nama_penerbit"  placeholder="Nama Lengkap" required="">
                  </div>
                </div>
              </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
              <h3 class="box-title">Data Penerbit</h3>&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal" onclick= "SetInput('','','','')">+</button>
      
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>

                <tr>
                  <th>No</th>
                  <th>Nama Penerbit</th>
                  <th>Kode Penerbit</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($data as $penerbit) { ?>
                  <tr>
                    <td><?php echo $no;?></td>
                     <td><?php echo $penerbit['kode_penerbit'];?></td>
                     <td><?php echo $penerbit['nama_penerbit'];?></td>
                    <td width="10%"><button type='button' class='btn-info' data-toggle='modal' data-target='#myModal' onclick="SetInput('<?php echo $penerbit['kode_penerbit'];?>','<?php echo $penerbit['nama_penerbit'];?>')"><i class='fa fa-fw fa-pencil-square-o'></i></button></td>
                  </tr>
                  <?php $no++;} ?>
                </tbody>
                </tfoot>
              </table>
            </div>
        </div>
    </section>
</div>