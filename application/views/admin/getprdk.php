<?php
foreach ($getprdk as $g) {
?>
    <div class="form-group">
        <input type="text" class="form-control d-none" name="nama_produk" value="<?= $g->nama_produk ?>" readonly>
    </div>
    
    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" value="<?= $g->harga_beli ?>" readonly>
    </div>
<?php } ?>