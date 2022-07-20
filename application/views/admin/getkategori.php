<?php
foreach ($getkategori as $k) {
?>
    <div class="form-group">
        <input type="text" class="form-control d-none" name="nama" value="<?= $k->nama_produk ?>" readonly>
    </div>
    
<?php } ?>