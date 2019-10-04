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
          <a href="<?php echo base_url().'Co_pemasaran';?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
         <?php
        if($angka=='2'){
          echo '<li class="treeview active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>Data Master</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Nasional';?>"><i class="fa fa-circle-o"></i> Manager Nasional</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Area';?>"><i class="fa fa-circle-o"></i> Manager Area</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Perwakilan';?>"><i class="fa fa-circle-o"></i> Kepala Perwakilan</a></li>
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Sales';?>"><i class="fa fa-circle-o"></i> Sales</a></li>
             <?php if($menu=='5'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Adm_perwakilan';?>"><i class="fa fa-circle-o"></i> Admin Perwakilan</a></li>
            <?php if($menu=='6'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Customer';?>"><i class="fa fa-circle-o"></i> Data Customer</a></li>
            <?php if($menu=='7'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Kerjasama';?>"><i class="fa fa-circle-o"></i> Data Kerjasama</a></li>
            <?php if($menu=='8'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Pengajuan';?>"><i class="fa fa-circle-o"></i> Data Pengajuan</a></li>
            <?php if($menu=='9'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Rekanan';?>"><i class="fa fa-circle-o"></i> Data CV Rekanan</a></li>
            <?php if($menu=='10'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Mou';?>"><i class="fa fa-circle-o"></i> MoU CV</a></li>
          </ul>
        </li>
        <?php
        if($angka=='3'){
          echo '<li class="treeview active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>Data Handle</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Wilayah_pemasaran';?>"><i class="fa fa-circle-o"></i> Wilayah Pemasaran</a></li>
          </ul>
        </li>
         <?php
        if($angka=='4'){
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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Report_sales';?>"><i class="fa fa-circle-o"></i>Report Sales</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Report_customer';?>"><i class="fa fa-circle-o"></i>Report Customer</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Report_rekanan';?>"><i class="fa fa-circle-o"></i>Report CV Rekanan</a></li>
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Report_stok';?>"><i class="fa fa-circle-o"></i>Report Stok Buku</a></li>
            <?php if($menu=='5'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Report_pesanan';?>"><i class="fa fa-circle-o"></i>Report Pesanan</a></li>
            <?php if($menu=='6'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Report_alokasiproduk';?>"><i class="fa fa-circle-o"></i>Report Alokasi Produk</a></li>
            <?php if($menu=='7'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Report_pengajuan';?>"><i class="fa fa-circle-o"></i>Report Pengajuan</a></li>
            <?php if($menu=='8'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Co_pemasaran/Report_mou';?>"><i class="fa fa-circle-o"></i>Report MoU</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>