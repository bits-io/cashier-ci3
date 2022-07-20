<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="<?= base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="RIYADI" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-family: Times-New-Roman"><b>RIYADI</b></span>
    </a>
	<?php if(!($this->session->userdata('akses') == "admin" || $this->session->userdata('akses') == "kasir")) {
		redirect(base_url('Auth'));
	}
	?>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://siakad.plb.ac.id/siamhs/photos/202002074.png" class="img-circle img-fluid elevation-2" alt="Owner">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="font-family: Times-New-Roman"><?= $this->session->userdata('nama') ?></a>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Cari" aria-label="Cari">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fal fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php if ($this->session->userdata('akses') == "admin") { ?>
                    <li class="nav-item menu-<?= $this->session->userdata('master') ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
							<?php
							if ($this->session->userdata('akses') == "admin"){
							?>
							<li class="nav-item">
							<a href="<?php if ($this->session->userdata('akses') == "admin") {
										echo base_url('Admin/user');
										}  ?>" class="nav-link<?= $this->session->userdata('user') ?>">
								<i class="far fa-<?= $this->session->userdata('user_dot') ?>circle nav-icon"></i>
								<p>User</p>
							</a>
							</li>
							<?php
							}
							?>
                            <li class="nav-item">
                                <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                                echo base_url('Admin/kategori');
                                            } else {
                                                echo base_url('Kasir/kategori');
                                            } ?>" class="nav-link<?= $this->session->userdata('kategori') ?>">
                                    <i class="far fa-<?= $this->session->userdata('kategori_dot') ?>circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                                echo base_url('Admin/produk');
                                            } else {
                                                echo base_url('Kasir/produk');
                                            } ?>" class="nav-link<?= $this->session->userdata('produk') ?>">
                                    <i class="far fa-<?= $this->session->userdata('produk_dot') ?>circle nav-icon"></i>
                                    <p>Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                                echo base_url('Admin/owner');
                                            } else {
                                                echo base_url('Kasir/owner');
                                            } ?>" class="nav-link<?= $this->session->userdata('owner') ?>">
                                    <i class="far fa-<?= $this->session->userdata('owner_dot') ?>circle nav-icon"></i>
                                    <p>Owner</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                                echo base_url('Admin/customer');
                                            } else {
                                                echo base_url('Kasir/customer');
                                            } ?>" class="nav-link<?= $this->session->userdata('customer') ?>">
                                    <i class="far fa-<?= $this->session->userdata('customer_dot') ?>circle nav-icon"></i>
                                    <p>Customer</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                                echo base_url('Admin/supplier');
                                            } else {
                                                echo base_url('Kasir/supplier');
                                            } ?>" class="nav-link<?= $this->session->userdata('supplier') ?>">
                                    <i class="far fa-<?= $this->session->userdata('supplier_dot') ?>circle nav-icon"></i>
                                    <p>Supplier</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item menu-<?= $this->session->userdata('transaksi') ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/penjualan');
                                        } else {
                                            echo base_url('Kasir/penjualan');
                                        } ?>" class="nav-link<?= $this->session->userdata('penjualan') ?>">
                                <i class="far fa-<?= $this->session->userdata('penjualan_dot') ?>circle nav-icon"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/pembelian');
                                        } else {
                                            echo base_url('Kasir/pembelian');
                                        } ?>" class="nav-link<?= $this->session->userdata('pembelian') ?>">
                                <i class="far fa-<?= $this->session->userdata('pembelian_dot') ?>circle nav-icon"></i>
                                <p>Pembelian</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-<?= $this->session->userdata('laporan') ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/laporanpenjualanre');
                                        } else {
                                            echo base_url('Kasir/laporanpenjualanre');
                                        } ?>" class="nav-link<?= $this->session->userdata('laporanpenjualanre') ?>">
                                <i class="far fa-<?= $this->session->userdata('laporanpenjualanre_dot') ?>circle nav-icon"></i>
                                <p>Penjualan RE</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/laporanpenjualanowner');
                                        } else {
                                            echo base_url('Kasir/laporanpenjualanowner');
                                        } ?>" class="nav-link<?= $this->session->userdata('laporanpenjualanowner') ?>">
                                <i class="far fa-<?= $this->session->userdata('laporanpenjualanowner_dot') ?>circle nav-icon"></i>
                                <p>Penjualan Owner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/laporanpembelianallsupplier');
                                        } else {
                                            echo base_url('Kasir/laporanpembelianallsupplier');
                                        } ?>" class="nav-link<?= $this->session->userdata('laporanpembelianall') ?>">
                                <i class="far fa-<?= $this->session->userdata('laporanpembelianall_dot') ?>circle nav-icon"></i>
                                <p>Pembelian All Supplier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/laporanpembelianpersupplier');
                                        } else {
                                            echo base_url('Kasir/laporanpembelianpersupplier');
                                        } ?>" class="nav-link<?= $this->session->userdata('laporanpembelianper') ?>">
                                <i class="far fa-<?= $this->session->userdata('laporanpembelianper_dot') ?>circle nav-icon"></i>
                                <p>Pembelian Per Supplier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/laporanpiutangpertanggal');
                                        } else {
                                            echo base_url('Kasir/laporanpiutangpertanggal');
                                        } ?>" class="nav-link<?= $this->session->userdata('laporanpiutangpertanggal') ?>">
                                <i class="far fa-<?= $this->session->userdata('laporanpiutangpertanggal_dot') ?>circle nav-icon"></i>
                                <p>Piutang Per Tanggal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/laporanprodukre');
                                        } else {
                                            echo base_url('Kasir/laporanprodukre');
                                        } ?>" class="nav-link<?= $this->session->userdata('laporanprodukre') ?>">
                                <i class="far fa-<?= $this->session->userdata('laporanprodukre_dot') ?>circle nav-icon"></i>
                                <p>Produk RE</p>
                            </a>
                        </li>
						<li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/laporansaldoperiode');
                                        } else {
                                            echo base_url('Kasir/laporansaldoperiode');
                                        } ?>" class="nav-link<?= $this->session->userdata('laporansaldoperiode') ?>">
                                <i class="far fa-<?= $this->session->userdata('laporansaldoperiode_dot') ?>circle nav-icon"></i>
                                <p>Saldo Periode</p>
                            </a>
                        </li>
						<li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/laporandatapemasukanperiode');
                                        } else {
                                            echo base_url('Kasir/laporandatapemasukanperiode');
                                        } ?>" class="nav-link<?= $this->session->userdata('laporandatapemasukanperiode') ?>">
                                <i class="far fa-<?= $this->session->userdata('laporandatapemasukanperiode_dot') ?>circle nav-icon"></i>
                                <p>Pemasukan Periode</p>
                            </a>
                        </li>
						<li class="nav-item">
                            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                                            echo base_url('Admin/laporandatapengeluaranperiode');
                                        } else {
                                            echo base_url('Kasir/laporandatapengeluaranperiode');
                                        } ?>" class="nav-link<?= $this->session->userdata('laporandatapengeluaranperiode') ?>">
                                <i class="far fa-<?= $this->session->userdata('laporandatapengeluaranperiode_dot') ?>circle nav-icon"></i>
                                <p>Pengeluaran Periode</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
