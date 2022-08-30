<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tindakan Perbaikan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('perbaikan') ?>">Data Perbaikan</a></li>
                    <li class="breadcrumb-item active">Tindakan Perbaikan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tindakan perbaikan</h3>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="fid" value="<?= $perbaikan->id_perbaikan ?>">

                <div class="card-body">
                    <div class="form-group">
                        <label for="fid_aset">PIC User</label>
                        <input type="text" class="form-control" value="<?= ucwords($perbaikan->nama_lengkap) ?>" readonly>
                        <div class="invalid-feedback">
                            <?= form_error('fid_aset') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fid_aset">Departemen</label>
                        <input type="text" class="form-control" value="<?= ucwords($perbaikan->departemen) ?>" readonly>
                        <div class="invalid-feedback">
                            <?= form_error('fid_aset') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fid_aset">Kode Aset</label>
                        <input type="text" class="form-control" value="<?= $perbaikan->kode_aset ?>" readonly>
                        <div class="invalid-feedback">
                            <?= form_error('fid_aset') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fketerangan_perbaikan">Keterangan</label>
                        <textarea name="fketerangan_perbaikan" class="form-control <?= form_error('fketerangan_perbaikan') ? 'is-invalid' : '' ?>" id="fketerangan_perbaikan" readonly><?= $perbaikan->keterangan_perbaikan ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('fketerangan_perbaikan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ftindakan">Tindakan Perbaikan</label>
                        <textarea name="ftindakan" class="form-control <?= form_error('ftindakan') ? 'is-invalid' : '' ?>" id="ftindakan"></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('ftindakan') ?>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a href="<?= base_url('perbaikan') ?>" class="btn btn-secondary float-left">Batal</a>

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>