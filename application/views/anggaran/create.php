<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data Perbaikan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('perbaikan') ?>">Data Perbaikan</a></li>
                    <li class="breadcrumb-item active">Tambah Data Perbaikan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Input data perbaikan</h3>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fid_aset">Aset</label>
                        <select class="form-control <?php echo form_error('fid_aset') ? 'is-invalid' : '' ?>" id="fid_aset" name="fid_aset">
                            <option hidden value="" selected>Pilih Aset</option>
                            <?php foreach ($aset as $key) : ?>
                                <option value="<?= $key->id_aset ?>" <?= $this->input->post('fid_aset') == $key->id_aset ? 'selected' : '' ?>><?= $key->kode_aset . ' - ' . $key->nama_aset ?></option>

                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fid_aset') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fketerangan_perbaikan">Keterangan</label>
                        <textarea name="fketerangan_perbaikan" class="form-control <?= form_error('fketerangan_perbaikan') ? 'is-invalid' : '' ?>" id="fketerangan_perbaikan"><?= $this->input->post('fketerangan_perbaikan'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('fketerangan_perbaikan') ?>
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