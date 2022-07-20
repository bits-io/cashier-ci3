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
            <h3><b>Laporan Data Pemasukan Periode<i class="mdi mdi-package-variant-closed:"></i></b></h3>
            <b>Periode : <?= date('F-Y', strtotime($dari)) ?></b>
			<br>
        </div>
        <div style="width:98%; margin: 10px;" align="center">
            <table id="tabelku" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center" rowspan="2">No</th>
                        <th class="text-center" rowspan="2">Nama Barang</th>
                        <th class="text-center" rowspan="2">Golongan</th>
                        <th class="text-center" rowspan="2">Kategori</th>
                        <th class="text-center" colspan="1<?= date('d', strtotime($dari)) ?>">Periode <?= date('F Y', strtotime($dari)) ?></th>
                    </tr>
					<tr>
						<?php for ($i=1; $i <= date('d', strtotime($sampai)); $i++) { ?>
							<th><?= $i ?></th>
						<?php } ?>
					</tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($produk as $d) {	
						
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?>.</td>
                            <td><?= $d->nama_produk ?></td>
							<td><?= $d->id_owner	 ?></td>
                            <td><?= $d->id_kategori	 ?></td>
							<?php  
								
								for ($i=1; $i <= date('d', strtotime($sampai)); $i++) { 
									$waktu = $_GET['tahun'].'-';
									if($_GET['bulan']<10){
										$waktu .= '0'.$_GET['bulan'].'-';
									}else{
										$waktu .= $_GET['bulan'].'-';
									}
									if($i<10){
										$waktu .= '0'.$i;
									}else{
										$waktu .= $i;
									}
									$select = $this->db->select('sum(kuantitas) as total');
									$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
									$select = $this->db->where('DATE_FORMAT(waktu,"%Y-%m-%d")',  $waktu);
									$select = $this->db->where('id_produk',  $d->id);
									$select = $this->db->group_by('ht_pembelian.id');
									$produk_pertgl = $this->m->Get_All('ht_pembelian', $select);
									$total=0;
									foreach ($produk_pertgl as $p) {$total=$p->total;}
							?>
								<td><?= $total; ?></td>
							<?php 
								}
							?>
                        </tr>
                    <?php } ?>
                    <!-- <tr>
                        <td colspan="2"><b>Total</b></td>
                    </tr> -->
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
