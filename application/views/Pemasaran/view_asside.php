<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('dist/img/user.jpeg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>Admin Pemasaran</a>
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
          <a href="<?php echo base_url().'Pemasaran';?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <?php
        if($angka=='2'){
          echo '<li class="treeview active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Pesanan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Pesanan';?>"><i class="fa fa-circle-o"></i> Daftar Pesanan</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Dopesan';?>"><i class="fa fa-circle-o"></i>Terproses</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Req';?>"><i class="fa fa-circle-o"></i> Permintaan Hapus</a></li>
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Hapus';?>"><i class="fa fa-circle-o"></i> Pesanan Terhapus</a></li>
            <?php if($menu=='5'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Proses_kirim';?>"><i class="fa fa-circle-o"></i> Proses Pengiriman</a></li>
            <?php if($menu=='6'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Selesai';?>"><i class="fa fa-circle-o"></i> Pesanan Selesai</a></li>
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
            <i class="fa fa-reply"></i>
            <span>Retur</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Reqretur';?>"><i class="fa fa-circle-o"></i> Req Retur</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Retur';?>"><i class="fa fa-circle-o"></i>Terproses</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Update';?>"><i class="fa fa-circle-o"></i> Permintaan Update</a></li>
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
            <i class="fa fa-tasks"></i>
            <span>Stok Mini</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Pesanan_stokmini';?>"><i class="fa fa-circle-o"></i> Pesanan</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/DO_stokmini';?>"><i class="fa fa-circle-o"></i>Terproses</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Pemasaran/Stok_mini';?>"><i class="fa fa-circle-o"></i> Daftar Stok Mini</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>