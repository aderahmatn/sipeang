<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Tambah Jenis APBD</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('apbd') ?>">Master jenis APBD</a></li>
                    <li class="breadcrumb-item active">Tambah Jenis APBD</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Input Jenis APBD</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fnamaapbd">Jenis APBD</label>
                        <input type="text" class="form-control <?= form_error('fnamaapbd') ? 'is-invalid' : '' ?>" id="fnamaapbd" name="fnamaapbd" placeholder="Masukan jenis APBD" value="<?= $this->input->post('fnamaapbd'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fnamaapbd') ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a href="<?= base_url('kegiatan') ?>" class="btn btn-secondary float-left">Batal</a>

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>