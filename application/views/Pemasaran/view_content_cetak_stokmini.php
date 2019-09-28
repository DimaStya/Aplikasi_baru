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
                Data Pesanan No <?php echo $this->session->userdata('no_stokmini'); ?>
              <form action="<?php echo base_url().'Pemasaran/Cetakpdf_stokmini';?>" method='POST'>
                <button name="no_stokmini" id="no_stokmini" value="<?php echo $this->session->userdata('no_stokmini'); ?>" type="submit" class="btn btn-primary">Downlaod PDF</button>
              </form>
              </center>
              
            </div>
        </div>
    </section>
</div>
