<!DOCTYPE html>
<html>
<?php
$this->load->view('template/head');
?>
<style type="text/css">
    .m-0 {
        font-weight: bold;
    }

    .card-title {
        font-weight: bold;
        padding-top: 8px;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        $this->load->view('template/preloader');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        ?>
        <div class="content-wrapper" id="konten">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Produk</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Produk</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Produk</h3>
                                    <button id="tambahkan" class="btn btn-info float-right" onclick="return tambah()">
                                        <i class="fas fa-plus-circle"></i>
                                        Tambah Data
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table id="anu" class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Nama Produk</th>
                                                <th class="text-center">Nama Owner</th>
                                                <th class="text-center">Kuantitas</th>
                                                <th class="text-center">Harga Beli</th>
                                                <th class="text-center">Harga Jual</th>
                                                <th class="text-center">Margin</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($read as $d) {
                                                $margin = $d->harga_jual - $d->harga_beli; ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?>.</td>
                                                    <td><?= $d->nama_produk ?></span></td>
                                                    <td><?= $d->nama_owner ?></span></td>
                                                    <td class="text-center"><?= $d->kuantitas ?></span></td>
                                                    <td>Rp<span class="float-right"><?= number_format($d->harga_beli, 0, ".", "."); ?></span></td>
                                                    <td>Rp<span class="float-right"><?= number_format($d->harga_jual, 0, ".", "."); ?></td>
                                                    <td>Rp<span class="float-right"><?= number_format($margin, 0, ".", "."); ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-info" onclick="return ubah(
                                                            `<?= $d->id ?>`, 
                                                            `<?= $d->id_owner ?>`, 
                                                            `<?= $d->id_kategori ?>`,
                                                            `<?= $d->nama_owner ?>`,
                                                            `<?= $d->nama_produk ?>`, 
                                                            `<?= $d->kuantitas ?>`, 
                                                            `<?= $d->harga_beli ?>`, 
                                                            `<?= $d->harga_jual ?>`
                                                            )"><i class="fas fa-edit"></i> Ubah</button>
                                                            <button class="btn btn-warning" onclick="return hapus(
                                                            `<?= $d->id ?>`, 
                                                            `<?= $d->id_owner ?>`,
                                                            `<?= $d->id_kategori ?>`, 
                                                            `<?= $d->nama_produk ?>`, 
                                                            `<?= $d->kuantitas ?>`, 
                                                            `<?= $d->harga_beli ?>`, 
                                                            `<?= $d->harga_jual ?>`
                                                            )"><i class="fas fa-trash"></i> Hapus</button>
                                                        </div>
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
    <form id="formulir" name="form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
        <div id="Modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="text-align:center">
                        <h3 id="modal-header"></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-d-none="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <span id="modal-body-update-or-create">
                            <div class="form-group">
                                <label>Owner</label>
                                <select id="owner" name="owner" class="form-control select2" style="width: 100%;">
									<?php foreach ($owner as $p) { ?>
										<option value="<?= $p->id ?>">
											<?= $p->nama_owner ?>
										</option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                            <label>Kategori</label>
                            <select  name="kategori" class="form-control selectpicker" data-live-search="true">
                                <?php foreach ($kategori as $p) { ?>
                                    <option value="<?= $p->id ?>">
                                        <?= $p->nama ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-boxes-stacked"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="nama_produk" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kuantitas</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-input-numeric"></i>
                                        </span>
                                    </div>
                                    <input type="number" name="kuantitas" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input id="tanpa-rupiah" type="number" name="harga_beli" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga Jual</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" name="harga_jual" class="form-control">
                                </div>
                            </div>
                        </span>
                        <span id="modal-body-delete">
                            Apakah anda yakin ingin menghapus <b id="name-delete"></b> dari tabel ini?
                        </span>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning" data-dismiss="modal" id="batal" aria-d-none="true"><i class="fas fa-arrow-alt-circle-left"></i> Batal</button>
                            <button type="submit" class="btn btn-info" id="modal-button"><i class="fas fa-save"></i> Lanjut</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php $this->load->view('template/script'); ?>
    <script>
        function getkategori() {
            var id = $('[name="id_kategori"]').val();
            $('#data-produk').load("getkategori?id=" + id);
        };

        $('#owner').select2({
            theme: 'bootstrap4',
            dropdownParent: $("#Modal"),
            placeholder: "Pilih Owner",
            ajax: {
                dataType: 'json',
                delay: 250,
                url: '<?= base_url(); ?>admin/daftar_owner',
                data: function(params) {
                    return {
                        searchTerm: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.nama_owner
                            };
                        })
                    };
                }
            }
        });

        $('#ktgr').select2({
            theme: 'bootstrap4',
            dropdownParent: $("#Modal"),
            placeholder: "Pilih Kategori",
            ajax: {
                dataType: 'json',
                delay: 250,
                url: '<?= base_url(); ?>admin/daftar_kategori',
                data: function(params) {
                    return {
                        searchTerm: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.nama_kategori
                            };
                        })
                    };
                }
            }
        });

        $(function() {
            $("#anu").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/id.json"
                }
            });
        });
        $(function() {
            $('#formulir').validate({
                rules: {
                    owner: {
                        required: true,
                    },
                    kategori: {
                        required: true,
                    },
                    nama_produk: {
                        required: true,
                    },
                    kuantitas: {
                        required: true,
                    },
                    harga_beli: {
                        required: true,
                    },
                    harga_jual: {
                        required: true,
                    },
                },
                messages: {
                    owner: {
                        required: "Harap isi kolom ini!"
                    },
                    kategori: {
                        required: "Harap isi kolom ini!"
                    },
                    nama_produk: {
                        required: "Harap isi kolom ini!"
                    },
                    kuantitas: {
                        required: "Harap isi kolom ini!"
                    },
                    harga_beli: {
                        required: "Harap isi kolom ini!"
                    },
                    harga_jual: {
                        required: "Harap isi kolom ini!"
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
        });

        function tambah() {
            $('#Modal').modal('show');
            $('#modal-header').html('Tambah Data');
            $('#batal').removeClass('btn-primary').addClass('btn-danger');
            $('#modal-button').removeClass('btn-danger').addClass('btn-primary');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('[name="id"]').val("");
            $('[name="owner"]').val(null).trigger('change');;
            $('[name="kategori"]').val(null).trigger('change');;
            $('[name="nama_produk"]').val("");
            $('[name="kuantitas"]').val("");
            $('[name="harga_beli"]').val("");
            $('[name="harga_jual"]').val("");
            document.form.action = '<?= base_url(); ?>admin/tambah_produk';
        };

        function ubah(id, id_owner, id_kategori, nama_owner, nama_produk, kuantitas, harga_beli, harga_jual) {
            $('#Modal').modal('show');
            $('#modal-header').html('Ubah Data');
            $('#batal').removeClass('btn-primary').addClass('btn-danger');
            $('#modal-button').removeClass('btn-danger').addClass('btn-primary');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('[name="id"]').val(id);
            var $option = $("<option selected></option>").val(id_owner).text(nama_owner);
            $('#owner').append($option).trigger('change');
            $('[name="id"]').val(id);
            $('[name="id_kategori"]').val(id_kategori);
            $('[name="nama_produk"]').val(nama_produk);
            $('[name="kuantitas"]').val(kuantitas);
            $('[name="harga_beli"]').val(harga_beli);
            $('[name="harga_jual"]').val(harga_jual);
            document.form.action = '<?= base_url(); ?>admin/ubah_produk';
        };

        function hapus(id, id_owner,id_kategori, nama_produk, kuantitas, harga_beli, harga_jual) {
            $('#Modal').modal('show');
            $('#modal-header').html('Hapus Data');
            $('#batal').removeClass('btn-danger').addClass('btn-primary');
            $('#modal-button').removeClass('btn-primary').addClass('btn-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').removeClass('d-none');
            $('[name="id"]').val(id);
            $('#name-delete').html(nama_produk);
            document.form.action = '<?= base_url(); ?>admin/hapus_produk';
        };
    </script>
</body>

</html>
