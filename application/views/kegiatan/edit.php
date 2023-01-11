<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Edit Data Kegiatan</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('Kegiatan') ?>">Master Kegiatan</a></li>
                    <li class="breadcrumb-item active">Edit Data Kegiatan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit data Kegiatan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?= var_dump($kegiatan) ?>
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <input type="text" name="fid_kegiatan" value="<?= $kegiatan->id_kegiatan  ?>">
                <input type="hidden" name="fcreated_date" value="<?= date('y-m-d') ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fkode_rekening">Kode Rekening</label>
                        <input type="text" class="form-control <?= form_error('fkode_rekening') ? 'is-invalid' : '' ?>" id="fkode_rekening" name="fkode_rekening" placeholder="Masukan kode rekening" value="<?= $kegiatan->kode_rekening_kegiatan ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fkode_rekening') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fid_program">Program</label>
                        <select class="form-control <?php echo form_error('fid_program') ? 'is-invalid' : '' ?>" id="fid_program" name="fid_program">
                            <option hidden value="" selected>Pilih Program</option>
                            <?php $keg = $this->input->post('fid_program') ? $this->input->post('fid_program') : $kegiatan->id_program  ?>
                            <?php foreach ($program as $key) : ?>
                                <option value="<?= $key->id_program ?>" <?= $keg == $key->id_program ? 'selected' : '' ?>><?= $key->uraian_program  ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fid_program') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_kegiatan">Uraian Kegiatan</label>
                        <textarea name="furaian_kegiatan" class="form-control <?= form_error('furaian_kegiatan') ? 'is-invalid' : '' ?>" id="furaian_kegiatan"><?= $kegiatan->uraian_kegiatan ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_kegiatan') ?>
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