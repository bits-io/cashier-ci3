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
            <h3><b>Laporan Saldo <i class="mdi mdi-package-variant-closed:"></i></b></h3>
            <b>Periode : <?= date('F-Y', strtotime($tanggal)) ?></b>
			<br>
        </div>
        <div style="width:98%; margin: 10px;" align="center">
            <table id="tabelku" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Saldo Awal</th>
                        <th class="text-center">Saldo Akhir</th>
                        <th class="text-center">Golongan</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Harga Beli</th>
                        <th class="text-center">Harga Jual</th>
                        <th class="text-center">Total Nominal Persediaan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $saldo_awal = 0;
                    $saldo_akhir = 0;
                    $golongan = 0;
                    $kategori = 0;
                    $total_hb = 0;
                    $total_hj = 0;
                    $total_np = 0;
                    foreach ($saldo as $d) {	
						$saldo_awal += $d->kuantitas;
						$saldo_akhir += $d->saldo_akhir;
						$golongan += 1;
						$kategori += 1;
						$total_hb += $d->harga_beli;
						$total_hj += $d->harga_jual;
						$total_np += ($d->harga_jual * $d->kuantitas);
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?>.</td>
                            <td><?= $d->nama_produk ?></td>
                            <td><?= $d->kuantitas ?></td>
                            <td><?= $d->saldo_akhir  ?></td>
                            <td><?= $d->id_owner ?></td>
                            <td><?= $d->id_kategori ?></td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format($d->harga_beli, 0, ".", "."); ?>
                                </span>
                            </td>
                            <td>
                                <span class="float-right">
                                    <?= number_format($d->harga_jual, 0, ".", "."); ?>
                                </span>
                            </td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format($d->kuantitas * $d->harga_jual, 0, ".", "."); ?>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2"><b>Total</b></td>
                        <td align="left"><?= $saldo_awal ?></td>
                        <td align="right"><?= $saldo_akhir ?></td>
                        <td colspan="2"></td>
                        <td>
                            Rp
                            <span class="float-right">
                                <?= number_format($total_hb, 0, ".", "."); ?>
                            </span>
                        </td>
						<td>
                            Rp
                            <span class="float-right">
                                <?= number_format($total_hj, 0, ".", "."); ?>
                            </span>
                        </td>
                        <td>
                            Rp
                            <span class="float-right">
                                <?= number_format($total_np, 0, ".", "."); ?>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <script>
                //window.print();
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
