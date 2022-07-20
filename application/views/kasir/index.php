<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('template/head') ?>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<?php $this->load->view('template/preloader') ?>
			<?php $this->load->view('template/navbar') ?>
			<?php $this->load->view('template/sidebar') ?>
			<!-- Content Wrapper. Contains page content -->
	  		<div class="content-wrapper">
	  			<section class="content">
			      <div class="container-fluid">
			        <!-- Small boxes (Stat box) -->
			        <div class="row">
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
						<script type="text/javascript">
						google.charts.load('current', {'packages':['bar']});
						google.charts.setOnLoadCallback(drawStuff);

						function drawStuff() {
							var data = new google.visualization.arrayToDataTable([
							['Opening Move', 'Rupiah'],
							["Penjualan", <?= $penjualan ?>],
							["Pembelian",  <?= $pembelian ?>],
							["Laba",  <?= $laba ?>]
							]);

							var options = {
							title: 'Grafik Penjualan dan Pembelian',
							width: 900,
							legend: { position: 'none' },
							chart: { title: 'Grafik Penjualan dan Pembelian',
									subtitle: 'Dari : <?= $dari ?>  Sampai : <?= $sampai ?>' },
							bars: 'vertical', // Required for Material Bar Charts.
							axes: {
								x: {
								0: { side: 'top', label: ''} // Top x-axis.
								}
							},
							bar: { groupWidth: "90%" }
							};

							var chart = new google.charts.Bar(document.getElementById('top_x_div'));
							chart.draw(data, options);
						};
						</script>

						

						<div class="col-12 ml-5 mt-5">
							<form class="float-left" method="POST">
                                <button name="cari" type="submit" class="btn btn-info float-right ml-2 mb-2">
                                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                                </button>
                                <div class="form-group float-right">
                                    <input type="date" name="sampai" value="<?= $sampai ?>" class="form-control">
                                </div>
                                <div class="form-group float-right p-2">
                                    Sampai :
                                </div>
                                <div class="form-group float-right">
                                    <input type="date" name="dari" value="<?= $dari ?>" class="form-control">
                                </div>
                                <div class="form-group float-right p-2">
                                    Dari :
                                </div>
                            </form>
						</div>
						
						<div class=" ml-5 mt-3">
						<div class="card card-primary card-outline">
						<div class="card-header">
						<h3 class="card-title">
						<i class="far fa-chart-bar"></i>
						Grafik Penjualan dan Pembelian
						</h3>
						<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
						<button type="button" class="btn btn-tool" data-card-widget="remove">
						<i class="fas fa-times"></i>
						</button>
						</div>
						</div>
						<div class="card-body">
						<div id="top_x_div" style="width: 900px; height: 500px;"></div></div>

						</div>	
						</div>
			        </div>
			      </div>
			    </section>
			</div>
	  			<?php $this->load->view('template/footer') ?>
		</div>
	</body>
	<?php $this->load->view('template/script') ?>
</html>
