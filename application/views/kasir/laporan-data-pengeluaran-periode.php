<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("template/head") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Preloader -->
		<?php $this->load->view("template/preloader") ?>
		<?php $this->load->view("template/navbar") ?>
		<?php $this->load->view("template/sidebar") ?>



		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Laporan Data Pengeluaran per Periode</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Laporan Data Pengeluaran per Periode</li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->


			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-6">
							<div class="card">
								<div class="card-header">
									<h3 class="h3"><b>Laporan Data Pengeluaran per Periode</b></h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<form action="<?= base_url() ?>Admin/CetakLaporanDataPengeluaranPeriode" target="_blank">
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													<label>Bulan</label>
													<select class="form-control" name="bulan" id="bulan" required>
														<option value="">Pilih Bulan</option>
														<option value="1">Januari</option>
														<option value="2">Februari</option>
														<option value="3">Maret</option>
														<option value="4">April</option>
														<option value="5">Mei</option>
														<option value="6">Juni</option>
														<option value="7">Juli</option>
														<option value="8">Agustus</option>
														<option value="9">September</option>
														<option value="10">Oktober</option>
														<option value="11">November</option>
														<option value="12">Desember</option>
													</select>
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label>Tahun</label>
													<select class="form-control" name="tahun" id="tahun" required>
														<option value="">Pilih Tahun</option>
														<option value="2017">2017</option>
														<option value="2018">2018</option>
														<option value="2019">2019</option>
														<option value="2020">2020</option>
														<option value="2021">2021</option>
														<option value="2022">2022</option>
														<option value="2023">2023</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-12">
											<button type="submit" class="btn btn-success">Cetak</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<?php $this->load->view('template/footer') ?>

	</div>
	<!-- ./wrapper -->
	<?php $this->load->view('template/script') ?>
</body>

</html>
