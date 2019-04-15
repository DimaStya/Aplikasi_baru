<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('dist/img/user.jpeg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>Admin Gudang</a>
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
          <a href="<?php echo base_url().'Gudang';?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Pesanan';?>"><i class="fa fa-circle-o"></i> Pesanan Baru</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Proses';?>"><i class="fa fa-circle-o"></i>Proses SJ</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Selesai';?>"><i class="fa fa-circle-o"></i> SJ selesai</a></li>
            </li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>