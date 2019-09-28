<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-edit"></i> Home</li>
      <li class="active">Cetak Data</li>
    </ol>
  </section>
    <section class="content">
      <div class="box box-success">
            <div class="box-body">
              <center>
                Data Retur No <?php echo $this->session->userdata('kode_retur'); ?>
              <form action="<?php echo base_url().'Gudang/Cetakpdf_ttr';?>" method='POST'>
                <button name="kode_retur" id="kode_retur" value="<?php echo $this->session->userdata('kode_retur'); ?>" type="submit" class="btn btn-primary">Downlaod PDF</button>
              </form>
              </center>
              
            </div>
        </div>
    </section>
</div>