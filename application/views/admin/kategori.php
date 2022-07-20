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
                                                <th class="text-center">Nama Kategori</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($read as $d) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?>.</td>
                                                    <td><?= $d->nama ?></span></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-info" onclick="return ubah(
                                                            `<?= $d->id ?>`, 
                                                            `<?= $d->nama ?>` 
                                                            )"><i class="fas fa-edit"></i> Ubah</button>
                                                            <button class="btn btn-warning" onclick="return hapus(
                                                            `<?= $d->id ?>`, 
                                                            `<?= $d->nama ?>`                                                             )"><i class="fas fa-trash"></i> Hapus</button>
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
                                <label>Nama Kategori</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-ball-pile"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="nama" class="form-control">
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
                    nama: {
                        required: true,
                    },
                },
                messages: {
                    nama: {
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
            $('[name="nama"]').val("");
            document.form.action = '<?= base_url(); ?>admin/tambah_kategori';
        };

        function ubah(id, nama) {
            $('#Modal').modal('show');
            $('#modal-header').html('Ubah Data');
            $('#batal').removeClass('btn-primary').addClass('btn-danger');
            $('#modal-button').removeClass('btn-danger').addClass('btn-primary');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('[name="id"]').val(id);
            $('[name="nama"]').val(nama);
            document.form.action = '<?= base_url(); ?>admin/ubah_kategori';
        };

        function hapus(id, nama) {
            $('#Modal').modal('show');
            $('#modal-header').html('Hapus Data');
            $('#batal').removeClass('btn-danger').addClass('btn-primary');
            $('#modal-button').removeClass('btn-primary').addClass('btn-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').removeClass('d-none');
            $('[name="id"]').val(id);
            $('#name-delete').html(nama);
            document.form.action = '<?= base_url(); ?>admin/hapus_kategori';
        };
    </script>
</body>

</html>
