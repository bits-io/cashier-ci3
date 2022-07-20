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
                            <h1 class="m-0">Laporan Pembelian Per Supplier</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Pembelian Per Supplier</li>
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
                                    <h3 class="h3"><b>Laporan Pembelian Per Supplier</b></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form id="kamu" action="<?= base_url() ?>Admin/CetakLaporanPembelianPerSupplier" target="_blank">
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select name="id_supplier" class="form-control selectpicker" data-live-search="true" required>
                                                <?php foreach ($nama_supplier as $p) { ?>
                                                    <option value="<?= $p->id ?>" data-tokens="<?= $p->nama ?>"><?= $p->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Dari</label>
                                                <input type="date" name="dari" value="<?= $dari ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Sampai</label>
                                                <input type="date" name="sampai" value="<?= $sampai ?>" class="form-control">
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

<script>
    $('#kamu').validate({
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

</html>
