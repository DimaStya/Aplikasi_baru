<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('dist/img/user.jpeg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->userdata('alamat'); ?></a>
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
          <a href="<?php echo base_url().'Perwakilan';?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <?php
        if($angka=='2'){
          echo '<li class="active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="<?php echo base_url().'Perwakilan/Pesan';?>"><i class="fa fa-book"></i> <span>Pesan Buku</span></a>
        </li>
        <?php
        if($angka=='3'){
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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/Pesanan';?>"><i class="fa fa-circle-o"></i> Pesanan Baru</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/Decline';?>"><i class="fa fa-circle-o"></i>Tertolak</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/Approve';?>"><i class="fa fa-circle-o"></i> Diterima</a></li>
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/Request';?>"><i class="fa fa-circle-o"></i> Permintaan Hapus</a></li>
            <?php if($menu=='5'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/TerFaktur';?>"><i class="fa fa-circle-o"></i> Ter-Faktur</a></li>
            <?php if($menu=='6'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/TerRetur';?>"><i class="fa fa-circle-o"></i> Ter-Retur</a></li>
      </ul>
      <?php
        if($angka=='4'){
          echo '<li class="treeview active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Stok Mini</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/Pesan_stokmini';?>"><i class="fa fa-circle-o"></i> Pesan Stok Mini</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/Pesanan_stokmini';?>"><i class="fa fa-circle-o"></i>Pesanan</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/Approve_stokmini';?>"><i class="fa fa-circle-o"></i>Di terima</a></li>
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Perwakilan/Stok_mini';?>"><i class="fa fa-circle-o"></i> Stok Mini</a></li>
    </section>
  </aside>