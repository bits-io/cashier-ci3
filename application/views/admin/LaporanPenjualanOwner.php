<!DOCTYPE html>
<html lang="en">

<head>
    <!-- paper -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/paper/paper.css">
    <?php $this->load->view("template/head") ?>
</head>

<body class="A4 landscape">
    <div class="sheet">
        <table align="center" style="margin-top: 10px; margin-bottom: 2px;">
            <td>
                <pre><img src="https://plb.ac.id/new/wp-content/uploads/2022/01/logo-Politeknik-LP3I.png" width="110px" height="110px"></pre>
            </td>
            <td align="center">
                <h1>RE Politeknik LP3I Kampus Tasikmalaya</h1>
                <h4>Jalan Ir. H. Juanda KM. 2 No. 106, Panglayungan, Kec. Cipedes, Tasikmalaya, Jawa Barat 46151 Telepon: (0265) 311766</h4>
            </td>
        </table>
        <hr noshade size=4 width="98%">
        <div style="width:100%" align="center">
            <h3><b>Laporan Penjualan Owner</b></h3>
            <b>Nama Owner : <span> <?= $nama_owner ?></span></b><br>
            Dari : <?= $dari ?><br>
            Sampai : <?= $sampai ?><br>
        </div>
        <div style="width:98%; margin: 10px;" align="center">
            <table id="tabelku" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Penjualan</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Harga Jual</th>
                        <th class="text-center">Harga Beli</th>
                        <th class="text-center">Total Harga Beli</th>
                        <th class="text-center">% margin</th>
                        <th class="text-center">Margin</th>
                        <th class="text-center">Total Margin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total_penjualan = 0;
                    $total_qty = 0;
                    $total_hargaj = 0;
                    $total_hargab = 0;
                    $total_hb = 0;
                    $total_prsnm = 0;
                    $total_margin = 0;
                    $total_tm = 0;
                    foreach ($penjualan as $d) {
                        $total_penjualan += $d->harga_jual * $d->kuantitas;
                        $total_qty += $d->kuantitas;
                        $total_hargaj += $d->harga_jual;
                        $total_hargab += $d->harga_beli;
                        $total_hb += $d->harga_beli * $d->kuantitas;
                        $total_prsnm += $d->harga_beli / ($d->harga_jual - $d->harga_beli);
                        $total_margin += $d->harga_jual - $d->harga_beli;
                        $total_tm += ($d->harga_jual - $d->harga_beli) * $d->kuantitas;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?>.</td>
                            <td><?= $d->nama_produk ?></td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format($d->harga_jual * $d->kuantitas, 0, ".", "."); ?>
                                </span>
                            </td>
                            <td><?= $d->kuantitas ?></td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format($d->harga_jual, 0, ".", "."); ?>
                                </span>
                            </td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format($d->harga_beli, 0, ".", "."); ?>
                                </span>
                            </td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format($d->harga_beli * $d->kuantitas, 0, ".", "."); ?>
                                </span>
                            </td>
                            <td>
                                <span class="float-right">
                                    <?= number_format($d->harga_beli / ($d->harga_jual - $d->harga_beli), 0, ".", "."); ?>
                                </span>
                            </td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format($d->harga_jual - $d->harga_beli, 0, ".", "."); ?>
                                </span>
                            </td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format(($d->harga_jual - $d->harga_beli) * $d->kuantitas, 0, ".", "."); ?>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2"><b>Total</b></td>
                        <td align="left"><span class="float-right"><b>Rp <?= number_format($total_penjualan, 0, '.', '.') ?></b></td></span>
                        <td align="right"><?= $total_qty ?></td>
                        <td>
                            Rp
                            <span class="float-right">
                                <?= number_format($total_hargaj, 0, ".", "."); ?>
                            </span>
                        </td>
                        <td>
                            Rp
                            <span class="float-right">
                                <?= number_format($total_hargab, 0, ".", "."); ?>
                            </span>
                        </td>
                        <td>
                            Rp
                            <span class="float-right">
                                <?= number_format($total_hb, 0, ".", "."); ?>
                            </span>
                        </td>
                        <td align="right"><?= $total_prsnm ?></td>
                        <td>
                            Rp
                            <span class="float-right">
                                <?= number_format($total_margin, 0, ".", "."); ?>
                            </span>
                        </td>
                        <td>
                            Rp
                            <span class="float-right">
                                <?= number_format($total_tm, 0, ".", "."); ?>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <script>
                window.print();
            </script>
        </div>
        <table align="right" width="40%"><br><br>
            <tr align="center">
                <td>Tasikmalaya, <?= date('d m Y') ?></td>
            </tr>
            <tr align="center">
                <td>Mengetahui</td>
            </tr>
            <tr align="center">
                <td><b>Kepala Kampus</b></td>
            </tr>
            <tr>
                <td><br><br><br><br><br></td>
            </tr>
            <tr align="center">
                <td><b>H. Rudi Kurniawan, S.T., M.M</b></td>
            </tr>
            <tr align="center">
                <td>NIP. XXXXXXXX XXXXXX X XXX</td>
            </tr>
        </table>
    </div>
</body>

</html>