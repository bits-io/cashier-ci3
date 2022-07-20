<?php
foreach ($getproduk as $g) {
?>
    <div class="form-group">
        <input type="text" class="form-control d-none" name="nama_produk" value="<?= $g->nama_produk ?>" readonly>
    </div>
    
    <div class="form-group">
        <label>Harga Jual</label>
        <input type="number" class="form-control" name="harga_jual" value="<?= $g->harga_jual ?>" readonly>
    </div>
	
<?php } ?>
