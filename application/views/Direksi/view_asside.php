<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('dist/img/user.jpeg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo$this->session->userdata('siapa'); ?></a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <?php
        if($angka=='1'){
          echo '<li class="active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="<?php echo base_url().'Direksi';?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
         <?php
        if($angka=='2'){
          echo '<li class="treeview active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Report</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_sales';?>"><i class="fa fa-circle-o"></i>Report Sales</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_customer';?>"><i class="fa fa-circle-o"></i>Report Customer</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_rekanan';?>"><i class="fa fa-circle-o"></i>Report CV Rekanan</a></li>
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_stok';?>"><i class="fa fa-circle-o"></i>Report Stok Buku</a></li>
            <?php if($menu=='5'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_oc';?>"><i class="fa fa-circle-o"></i>Report OC</a></li>
            <?php if($menu=='6'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_lpb';?>"><i class="fa fa-circle-o"></i>Report LPB</a></li>
            <?php if($menu=='7'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_pesanan';?>"><i class="fa fa-circle-o"></i>Report Pesanan</a></li>
            <?php if($menu=='8'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_alokasiproduk';?>"><i class="fa fa-circle-o"></i>Report Alokasi Produk</a></li>
            <?php if($menu=='9'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_fakturnr';?>"><i class="fa fa-circle-o"></i>Report Faktur-NR</a></li>
            <?php if($menu=='10'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_pengajuan';?>"><i class="fa fa-circle-o"></i>Report Pengajuan</a></li>
            <?php if($menu=='11'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_mou';?>"><i class="fa fa-circle-o"></i>Report MoU</a></li>
            <?php if($menu=='12'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Direksi/Report_sjttr';?>"><i class="fa fa-circle-o"></i>Report SJ-TTR</a></li>
          </ul>
        </li> 
      </ul>
    </section>
  </aside>