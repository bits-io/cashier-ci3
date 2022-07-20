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
        <div class="content-wrapper" id="konten">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Penjualan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item active">Penjualan</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Penjualan</h3>
                                    <a href="#Modal" id="tambahkan" class="btn btn-info float-right ml-2 mb-2" data-toggle="modal" onclick="return tambah()">
                                        <i class="fas fa-plus-circle"></i> Tambah
                                    </a>
                                    <form class="float-right" method="POST">
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
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="mb-3">
                                        <span class="mr-2">
                                            Total Bayar : <?= $total_bayar ?>
                                        </span>
                                        <span class="mr-2">
                                            Total Piutang : <?= $total_piutang ?>
                                        </span>
                                        <span class="">
                                            Total Omset : <?= $total_omset ?>
                                        </span>
                                    </div>
                                    <table id="tabelku" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Customer</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Waktu</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Bayar</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($read as $d) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?>.</td>
                                                    <td><?= $d->nama_customer ?></td>
                                                    <td><?= date('d/m/Y', strtotime($d->waktu)) ?></td>
                                                    <td><?= date('H:i', strtotime($d->waktu)) ?></td>
                                                    <td>
                                                        Rp
                                                        <span class="float-right">
                                                            <?= number_format($d->total_omset, 0, ".", "."); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        Rp
                                                        <span class="float-right">
                                                            <?= number_format($d->total_bayar, 0, ".", "."); ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-danger" onclick="return hapus(`<?= $d->id ?>`, `<?= $d->nama_customer ?>`)"><i class="fas fa-trash"></i> Hapus</button>
                                                        <a class="btn btn-warning" href="<?= base_url() ?>Admin/CetakFakturPenjualan/<?= $d->id ?>" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php $this->load->view("template/footer") ?>
    </div>
    <!--Modal-->
    <div id="Modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="text-align:center">
                    <h3 id="modal-header"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <span id="modal-body-update-or-create">
                        <div class="form-group">
                            <label>Customer</label>
                            <select class="form-control selectpicker" name="id_customer" data-live-search="true" onchange="return cekCustomer()">
                                <?php foreach ($customer as $r) { ?>
                                    <option value="<?= $r->id ?>"><?= $r->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Produk</label>
                            <select id="produk" name="id_produk" class="form-control selectpicker" data-live-search="true" onchange="return getProduk()">
                                <?php foreach ($produk as $p) { ?>
                                    <option value="<?= $p->id ?>" data-tokens="<?= $p->nama_produk ?>">
                                        <?= $p->nama_produk ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
                        <span id="data-produk">
                            <input type="text" name="nama_produk" class="form-control d-none" readonly>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual" readonly>
                            </div>
                        </span>
                        <div class="form-group">
                            <label>Qty</label>
                            <input type="number" name="kuantitas" class="form-control" placeholder="Kuantitas" onkeyup="return simpan()">
                            <div class="form-group total-bayar">
                                <label>Total Bayar</label>
                                <input type="number" name="total_bayar" class="form-control" placeholder="Total Bayar">
                            </div>
                        </div>
                        <div class="form-group">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Produk</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">QTY</th>
                                        <th class="text-center">Total Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="keranjang">
                                </tbody>
                            </table>
                        </div>
                    </span>
                    <span id="modal-body-delete">
                        Are you sure want to delete <b id="name-delete"></b> from this table?
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="modal-button" onclick="return save()">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal-->
    <?php $this->load->view("template/script") ?>
    <script>
        $(function() {
            $("#tabelku").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tabelku_wrapper .col-md-6:eq(0)');
        });

        function simpan() {
            var id = $('[name="id_produk"]').val();
            var qty = $('[name="kuantitas"]').val();
            if (event.key === "Enter") {
                $('#keranjang').load("AddCart/" + id + "/" + qty);
            }
        }

        function save() {
            var id_customer = $('[name="id_customer"]').val();
            var total_bayar = $('[name="total_bayar"]').val();
            $.ajax({
                url: "<?= base_url() ?>Admin/SaveTransaksiPenjualan",
                method: "POST",
                data: {
                    id_customer: id_customer,
                    total_bayar: total_bayar,
                },
                success: function(data) {
                    window.location = "<?= base_url() ?>Admin/penjualan";
                }
            });
        }

        function batal(row_id) {
            $('#keranjang').load("DeleteCart/" + row_id);
        }

        function getProduk() {
            var id = $('[name="id_produk"]').val();
            $('#data-produk').load("getProduk?id=" + id);
        };

        function cekCustomer() {
            var id = $('[name="id_customer"]').val();
            $('.total-bayar').addClass("d-none");
            if (id != "1") {
                $('.total-bayar').removeClass("d-none");
            }
        };

        function tambah() {
            $('#Modal').modal('show');

            $('#modal-header').html('<i class="fa fa-plus"></i> Create');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('#modal-button').html('Create');
            $('#modal-button').removeClass('btn-danger');
            $('#modal-button').addClass('btn-success');
            $('#modal-button').attr('onclick', 'return save()');

            $('.total-bayar').addClass("d-none");

            $('[name="id"]').val("");
            $('[name="id_customer"]').val(null).trigger('change');
            $('[name="id_produk"]').val(null).trigger('change');
            $('[name="nama_produk"]').val("");
            $('[name="harga_beli"]').val("");
            $('[name="harga_jual"]').val("");
            $('[name="kuantitas"]').val("1");
            $('[name="tanggal"]').val("");
            $('[name="id_customer"]').focus();

            $('#keranjang').load("ShowCart");


        };

        function ubah(id, id_produk, nama_produk, harga_beli, harga_jual, qty, tanggal) {
            $('#Modal').modal('show');

            $('#modal-header').html('<i class="fa fa-plus"></i> Update');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('#modal-button').html('Update');
            $('#modal-button').removeClass('btn-danger');
            $('#modal-button').addClass('btn-success');

            $('[name="id"]').val(id);
            $('[name="id_produk"]').val(id_produk);
            $('[name="nama_produk"]').val(nama_produk);
            $('[name="harga_beli"]').val(harga_beli);
            $('[name="harga_jual"]').val(harga_jual);
            $('[name="qty"]').val(qty);
            $('[name="tanggal"]').val(tanggal);


            document.form.action = '<?php echo base_url(); ?>Admin/penjualan_update';
        };

        function hapus(id, nama_customer) {
            $('#Modal').modal('show');
            $('#modal-button').html('Delete');
            $('#modal-button').removeClass('btn-success');
            $('#modal-button').addClass('btn-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').removeClass('d-none');
            $('#modal-header').html('<i class="fa fa-trash"></i> Delete');
            $('#modal-button').attr('onclick', 'return hapuss()');

            $('[name="id"]').val(id);
            $('#name-delete').html(nama_customer);
        };

        function hapuss() {
            var id = $('[name="id"]').val();
            $.ajax({
                url: "<?= base_url() ?>Admin/penjualan_delete",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    window.location = "<?= base_url() ?>Admin/penjualan";
                }
            });
        }

        $(document).ready(function() {
            $("#Modal").on('shown.bs.modal', function() {
                document.getElementById("produk").focus();
            });
        });

        $('#validasi').validate({
            rules: {
                id_supplier: {
                    required: true,
                },
                dari: {
                    required: true,
                },
                sampai: {
                    required: true,
                },
            },
            messages: {
                id_supplier: {
                    required: "Harap isi supplier",
                },
                dari: {
                    required: "Harap Pilih tanggal",
                },
                sampai: {
                    required: "Harap Pilih tanggal",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('[name="id_supplier"]').val(null).trigger('change');
    </script>
</body>

</html>