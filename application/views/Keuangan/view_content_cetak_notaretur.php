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
                Data Nota Retur No <?php echo $this->session->userdata('no_notaretur'); ?>
              <form action="<?php echo base_url().'Keuangan/Cetakpdf_notaretur';?>" method='POST'>
                <button name="no_notaretur" id="no_notaretur" value="<?php echo $this->session->userdata('no_notaretur'); ?>" type="submit" class="btn btn-primary">Downlaod PDF</button>
              </form>
              </center>
              
            </div>
        </div>
    </section>
</div>