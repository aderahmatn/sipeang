<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Tambah Data Sub Kegiatan</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('subegiatan') ?>">Master Sub Kegiatan</a></li>
                    <li class="breadcrumb-item active">Tambah Data Sub Kegiatan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Input data Sub Kegiatan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <input type="hidden" name="fcreated_date" value="<?= date('y-m-d') ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fkode_rekening_subkegiatan">Kode Rekening</label>
                        <input type="text" class="form-control <?= form_error('fkode_rekening_subkegiatan') ? 'is-invalid' : '' ?>" id="fkode_rekening_subkegiatan" name="fkode_rekening_subkegiatan" placeholder="Masukan kode rekening" value="<?= $this->input->post('fkode_rekening_subkegiatan'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fkode_rekening_subkegiatan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fid_kegiatan">Kegiatan</label>
                        <select class="form-control <?php echo form_error('fid_kegiatan') ? 'is-invalid' : '' ?>" id="fid_kegiatan" name="fid_kegiatan">
                            <option hidden value="" selected>Pilih Kegiatan</option>
                            <?php foreach ($kegiatan as $key) : ?>
                                <option value="<?= $key->id_kegiatan ?>" <?= $this->input->post('fid_kegiatan') == $key->id_kegiatan ? 'selected' : '' ?>><?= $key->uraian_kegiatan  ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fid_kegiatan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_subkegiatan">Uraian Sub Kegiatan</label>
                        <textarea name="furaian_subkegiatan" class="form-control <?= form_error('furaian_subkegiatan') ? 'is-invalid' : '' ?>" id="furaian_subkegiatan"><?= $this->input->post('furaian_subkegiatan'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_subkegiatan') ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a href="<?= base_url('subkegiatan') ?>" class="btn btn-secondary float-left">Batal</a>

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>