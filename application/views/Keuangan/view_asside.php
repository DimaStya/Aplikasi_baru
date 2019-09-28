<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('dist/img/user.jpeg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>Admin Keuangan</a>
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
          <a href="<?php echo base_url().'Keuangan';?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Keuangan/Suratjalan';?>"><i class="fa fa-circle-o"></i> Surat Jalan</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Keuangan/Faktur';?>"><i class="fa fa-circle-o"></i>TerFaktur</a></li>
            </li>
          </ul>
        </li>
        <?php
        if($angka=='3'){
          echo '<li class="active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="<?php echo base_url().'Keuangan/Bkm';?>"><i class="fa fa-table"></i> <span>BKM</span></a>
        </li>
        <?php
        if($angka=='4'){
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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Keuangan/Ttr';?>"><i class="fa fa-circle-o"></i> TTR</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Keuangan/Nota_retur';?>"><i class="fa fa-circle-o"></i>TerNota</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Keuangan/Req_update';?>"><i class="fa fa-circle-o"></i>Req Update</a></li>
            </li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>