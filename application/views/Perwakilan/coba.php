<table class="table table-bordered table-striped">
  
    <?php $no=1; foreach ($buku as $customer) { ?>
    <tr>
      <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $kode_buku;?></td>
        <td><?php echo $judul;?></td>
        <td><?php echo $stok_real;?></td>
        <td><?php echo $stok_pesan;?></td>
        <td><?php echo $harga_jawa;?></td>
        <td><?php echo $harga_luar;?></td>
        <td></td>
      </tr>
    <?php $no++;} ?>
</table>