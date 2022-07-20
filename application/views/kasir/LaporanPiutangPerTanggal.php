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
            Dari : <?= $dari ?><br>
            Sampai : <?= $sampai ?><br>
        </div>
        <div style="width:60%; margin-left: 230px; margin-top:20px;">
            <table id="tabelku" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Customer</th>
                        <th class="text-center">Piutang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total_piutang = 0;
                    foreach ($penjualan as $b) {
                        $total_piutang += $b->total_omset - $b->total_bayar;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?>.</td>
                            <td><?= $b->nama_customer ?></td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format($b->total_omset - $b->total_bayar, 0, ".", "."); ?>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2"><b>Total</b></td>
                        <td><b>
                                Rp
                                <span class="float-right">
                                    <?= number_format($total_piutang, 0, ".", "."); ?>
                                </span></b>
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