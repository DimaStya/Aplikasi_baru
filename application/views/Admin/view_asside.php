<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('dist/img/user.jpeg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Administrasi</a>
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
          <a href="<?php echo base_url().'Admin';?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Nasional';?>"><i class="fa fa-circle-o"></i> Manager Nasional</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Area';?>"><i class="fa fa-circle-o"></i> Manager Area</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Perwakilan';?>"><i class="fa fa-circle-o"></i> Kepala Perwakilan</a></li>
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Sales';?>"><i class="fa fa-circle-o"></i> Sales</a></li>
             <?php if($menu=='5'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Adm_perwakilan';?>"><i class="fa fa-circle-o"></i> Admin Perwakilan</a></li>
             <?php if($menu=='6'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Pemasaran';?>"><i class="fa fa-circle-o"></i> Admin Pemasaran</a></li>
            <?php if($menu=='7'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Keuangan';?>"><i class="fa fa-circle-o"></i> Admin Keuangan</a></li>
            <?php if($menu=='8'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Gudang';?>"><i class="fa fa-circle-o"></i> Admin Gudang</a></li>
            <?php if($menu=='9'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Produksi';?>"><i class="fa fa-circle-o"></i> Admin Produksi</a></li>
            <?php if($menu=='10'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Customer';?>"><i class="fa fa-circle-o"></i> Data Customer</a></li>
            <?php if($menu=='11'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Kerjasama';?>"><i class="fa fa-circle-o"></i> Data Kerjasama</a></li>
            <?php if($menu=='12'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Pengajuan';?>"><i class="fa fa-circle-o"></i> Data Pengajuan</a></li>
            <?php if($menu=='13'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Rekanan';?>"><i class="fa fa-circle-o"></i> Data CV Rekanan</a></li>
            <?php if($menu=='14'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Mou';?>"><i class="fa fa-circle-o"></i> MoU CV</a></li>
            <?php if($menu=='15'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Penerbit';?>"><i class="fa fa-circle-o"></i> Data Penerbit</a></li>

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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Wilayah_pemasaran';?>"><i class="fa fa-circle-o"></i> Wilayah Pemasaran</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Wilayah_keuangan';?>"><i class="fa fa-circle-o"></i> Wilayah Keuangan</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Wilayah_gudang';?>"><i class="fa fa-circle-o"></i> Wilayah Gudang</a></li>
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
            <i class="fa fa-book"></i>
            <span>Buku</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Buku';?>"><i class="fa fa-circle-o"></i> Data Buku</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Harga';?>"><i class="fa fa-circle-o"></i> Harga</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Import';?>"><i class="fa fa-circle-o"></i> Import Buku</a></li>
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Admin/Paket';?>"><i class="fa fa-circle-o"></i> Daftar Paket</a></li>
          </ul>
        </li>  
        <?php
        if($angka=='5'){
          echo '<li class="active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="<?php echo base_url().'Admin/Aktivitas';?>"><i class="fa fa-user"></i> <span>Aktivitas Login</span></a>
        </li>
        <?php
        if($angka=='6'){
          echo '<li class="active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="<?php echo base_url().'Admin/Tahun_depan';?>"><i class="fa fa-chain"></i> <span>Tahun Depan</span></a>
        </li> 
      </ul>
    </section>
  </aside>