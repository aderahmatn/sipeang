<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Edit Data Sub Kegiatan</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('subegiatan') ?>">Master Sub Kegiatan</a></li>
                    <li class="breadcrumb-item active">Edit Data Sub Kegiatan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit data Sub Kegiatan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <input type="hidden" name="fid_subkegiatan" value="<?= encrypt_url($subkegiatan->id_subkegiatan)  ?>" style="display: none">
                <input type="hidden" name="fcreated_date" value="<?= date('y-m-d') ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fkode_rekening_subkegiatan">Kode Rekening</label>
                        <input type="text" class="form-control <?= form_error('fkode_rekening_subkegiatan') ? 'is-invalid' : '' ?>" id="fkode_rekening_subkegiatan" name="fkode_rekening_subkegiatan" placeholder="Masukan kode rekening" value="<?= $subkegiatan->kode_rekening_subkegiatan ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fkode_rekening_subkegiatan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fid_kegiatan">Kegiatan</label>
                        <select class="form-control <?php echo form_error('fid_kegiatan') ? 'is-invalid' : '' ?>" id="fid_kegiatan" name="fid_kegiatan">
                            <option hidden value="" selected>Pilih Kegiatan</option>
                            <?php $keg = $this->input->post('fid_kegiatan') ? $this->input->post('fid_kegiatan') : $subkegiatan->id_kegiatan  ?>
                            <?php foreach ($kegiatan as $key) : ?>
                                <option value="<?= $key->id_kegiatan ?>" <?= $keg == $key->id_kegiatan ? 'selected' : '' ?>><?= $key->uraian_kegiatan  ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fid_kegiatan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_subkegiatan">Uraian Sub Kegiatan</label>
                        <textarea name="furaian_subkegiatan" class="form-control <?= form_error('furaian_subkegiatan') ? 'is-invalid' : '' ?>" id="furaian_subkegiatan"><?= $subkegiatan->uraian_subkegiatan ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_subkegiatan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fpic_subkegiatan">PIC</label>
                        <select class="form-control <?php echo form_error('fpic_subkegiatan') ? 'is-invalid' : '' ?>" id="fpic_subkegiatan" name="fpic_subkegiatan">
                            <option hidden value="" selected>Pilih PIC</option>
                            <?php $usr = $this->input->post('fpic_subkegiatan') ? $this->input->post('fpic_subkegiatan') : $subkegiatan->pic_subkegiatan  ?>
                            <?php foreach ($user as $key) : ?>
                                <option value="<?= $key->id_user ?>" <?= $usr == $key->id_user ? 'selected' : '' ?>><?= strtoupper($key->nama_lengkap)   ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fpic_subkegiatan') ?>
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