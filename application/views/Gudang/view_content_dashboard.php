<div class="content-wrapper">
  <section class="content-header">
    <h1>
      &nbsp;
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Home</li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-dashboard"></i> Dashboard</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <?php print_r($this->session->userdata); 
            ?>
          </div>
        </div>
      </div>
  </section>
</div>