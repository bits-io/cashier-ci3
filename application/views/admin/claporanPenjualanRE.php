<!DOCTYPE html>

<head>
    <!-- paper -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/paper/paper.css">
</head>

<body class="A4">
    <div class="sheet">
        <table align="center">
            <td>
                <pre><img src="<?= base_url() ?>assets/img/i.png" width="100px" height="100px">        </pre>
            </td>
            <td align="center">
                <h1>BASDA HOTEL JAWA BARAT</h1>
                <h4>Jl.Nahromi No 1 Banjar 46342 Telp. (0511) 3345216 - 3345876 ( FAX. 3359735 )</h4>
            </td>
        </table>

        <hr noshade size=4 width="90%">

        <div style="width:100%" align="center">

            <h2>Laporan Pemesanan</h2>
            <h5>
                Dari : <?= $dari ?><br>
                Sampai : <?= $sampai ?><br>
            </h5>


        </div>
        <div style="width:100%" align="center">
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
                    foreach ($penjualan as $d) {
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
            <script>
                window.print();
            </script>
        </div>
        <table align="right" width="40%"><br><br>
            <tr align="center">
                <td>Banjar, <?= date('d m Y') ?></td>
            </tr>
            <tr align="center">
                <td>Mengetahui</td>
            </tr>
            <tr align="center">
                <td><b>Kepala Sub.Bag Umum</b></td>
            </tr>
            <tr>
                <td><br><br><br><br><br></td>
            </tr>
            <tr align="center">
                <td><b>Ir. Andi B. Daulat Samallangi, MP</b></td>
            </tr>
            <tr align="center">
                <td>NIP. 20020402 202003 1 007</td>
            </tr>
        </table>
    </div>

</body>