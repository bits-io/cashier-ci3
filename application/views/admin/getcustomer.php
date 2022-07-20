<?php
foreach ($getcustomer as $g) {
?>
    <div class="form-group">
        <input type="text" class="form-control d-none" name="nama_customer" value="<?= $g->nama ?>" readonly>
    </div>
<?php } ?>