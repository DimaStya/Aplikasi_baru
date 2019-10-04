<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('dist/img/user.jpeg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i><?php echo$this->session->userdata('siapa'); ?></a>
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
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Pesan_selesai';?>"><i class="fa fa-circle-o"></i>Pesanan Selesai</a></li>
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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Reqretur';?>"><i class="fa fa-circle-o"></i> Req Retur</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Retur';?>"><i class="fa fa-circle-o"></i>Terproses</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Update';?>"><i class="fa fa-circle-o"></i> Permintaan Update</a></li>
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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Pesanan_stokmini';?>"><i class="fa fa-circle-o"></i> Pesanan</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Proses_stokmini';?>"><i class="fa fa-circle-o"></i>SJ Stok Mini</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Stok_mini';?>"><i class="fa fa-circle-o"></i> Daftar Stok Mini</a></li>
          </ul>
        </li>
        <?php
        if($angka=='5'){
          echo '<li class="treeview active">';
        }else{
          echo '<li class="treeview">';
        }
        ?>
          <a href="#">
            <i class="fa fa-th-large"></i>
            <span>LPB</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Lpb_baru';?>"><i class="fa fa-circle-o"></i> LPB Baru</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Daftar_lpb';?>"><i class="fa fa-circle-o"></i>Daftar LPB</a></li>
          </ul>
        </li>
        <?php
        if($angka=='6'){
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
            <?php if($menu=='1'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Report_stok';?>"><i class="fa fa-circle-o"></i>Report Stok Buku</a></li>
            <?php if($menu=='2'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Report_oc';?>"><i class="fa fa-circle-o"></i>Report OC</a></li>
            <?php if($menu=='3'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Report_lpb';?>"><i class="fa fa-circle-o"></i>Report LPB</a></li>
            <?php if($menu=='4'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Report_pesanan';?>"><i class="fa fa-circle-o"></i>Report Pesanan</a></li>
            <?php if($menu=='5'){echo '<li class="active">';}else{echo '<li>';}?><a href="<?php echo base_url().'Gudang/Report_sjttr';?>"><i class="fa fa-circle-o"></i>Report SJ-TTRs</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>