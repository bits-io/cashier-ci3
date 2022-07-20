<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("template/head") ?>
</head>

<body>
    <?php
        foreach($ht_pembelian as $h) {}
    ?>
    Customer : <?= $h->nama_supplier?><br>
    Tanggal  : <?= date('d/m/Y',strtotime($h->waktu)) ?><br>
    <table id="tabelku" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Produk</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dt_pembelian as $d) {
            ?>
                <tr>
                    <td class="text-center"><?= $no++; ?>.</td>
                    <td><?= $d->nama_produk ?></td>
                    <td>
                        Rp
                        <span class="float-right">
                            <?= number_format($d->harga_jual, 0, ".", "."); ?>
                        </span>
                    </td>
                    <td><?= $d->kuantitas ?></td>
                    <td>
                        Rp
                        <span class="float-right">
                            <?= number_format($d->harga_jual * $d->kuantitas, 0, ".", "."); ?>
                        </span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>