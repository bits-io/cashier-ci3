<!DOCTYPE html>
<html>
<?php
$this->load->view('template/head');
$this->load->view('template/script');
?>

<body class="hold-transition sidebar-mini layout-fixed m-0">
    <div class="wrapper">
        <?php
        $this->load->view('template/preloader');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">User</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.col -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar User</h3>
                                    <button id="tambahkan" class="btn btn-primary float-right" onclick="return tambah()">
                                        <i class="fas fa-plus-circle"></i> Tambah
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table id="tabelku" class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Username</th>
                                                <th class="text-center">Password</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Akses</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($user as $d) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?>.</td>
                                                    <td><?= $d->username ?></td>
                                                    <td><?= $d->password ?></td>
                                                    <td><?= $d->nama ?></td>
                                                    <td><?= $d->akses ?></td>
                                                    <td>
                                                        <button class="btn btn-primary" onclick="return ubah(`<?= $d->username ?>`, `<?= $d->password ?>` , `<?= $d->nama ?>`, `<?= $d->akses ?>`)"><i class="fas fa-pencil-alt"></i> Ubah</button>
                                                        <button class="btn btn-danger" onclick="return hapus(`<?= $d->username ?>`, `<?= $d->password ?>`)"><i class="fas fa-trash"></i> Hapus</button>
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
    <form name="form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
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
                            <div class="form-group" id="usernamedisabled">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label>Akses</label>
                                <select class="form-control" name="akses">
                                    <option value="" selected>Pilih Akses</option>
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                </select>
                            </div>
                        </span>
                        <span id="modal-body-delete">
                            Yakin untuk menghapus <b id="name-delete"></b> dari tabel ini?
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal" aria-d-none="true"><i class="fas fa-arrow-alt-circle-left"></i> Batal</button>
                        <button type="submit" class="btn btn-primary" id="modal-button">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--Modal-->
    <?php $this->load->view('template/script') ?>
    <script>
        $(function() {
            $("#tabelku").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tabelku_wrapper .col-md-6:eq(0)');
        });

        function tambah() {
            $('#Modal').modal('show');
            $('#modal-header').html('<i class="fa fa-plus-circle"></i> Tambah User');
            $('#modal-button').html('<i class="fas fa-save"></i> Simpan');
            $('#batal').removeClass('btn-primary').addClass('btn-primary');
            $('#modal-button').removeClass('btn-danger').addClass('btn-primary');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');

            $('[name="username"]').val("");
            $('[name="password"]').val("");
            $('[name="nama"]').val("");
            $('[name="akses"]').val("");

            document.form.action = '<?php echo base_url(); ?>Admin/user_add';
        };

        function ubah(username, password, nama, akses) {
            $('#Modal').modal('show');

            $('#modal-header').html('<i class="fa fa-pencil"></i> Update User');
            $('#modal-body-update-or-create').removeClass('d-none');
            $('#modal-body-delete').addClass('d-none');
            $('#modal-button').html('<i class="fas fa-plus-circle"></i> Ubah');
            $('#modal-button').removeClass('btn-danger');
            $('#modal-button').addClass('btn-primary');
			$('#usernamedisabled').addClass('d-none');

            $('[name="username"]').val(username);
            $('[name="password"]').val(password);
            $('[name="nama"]').val(nama);
            $('[name="akses"]').val(akses);
            document.form.action = '<?php echo base_url(); ?>Admin/user_update';
        };

        function hapus(username, password) {
            $('#Modal').modal('show');
            $('#modal-button').html('<i class="fa fa-trash"></i> Hapus');
            $('#modal-button').removeClass('btn-success');
            $('#modal-button').addClass('btn-danger');
            $('#modal-body-update-or-create').addClass('d-none');
            $('#modal-body-delete').removeClass('d-none');
            $('#modal-header').html('<i class="fa fa-trash"></i> Hapus Data');

            $('[name="username"]').val(username);
            $('#name-delete').html(password);

            document.form.action = '<?php echo base_url(); ?>Admin/user_delete';
        };
    </script>
</body>

</html>
