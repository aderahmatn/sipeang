<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data Anggaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('anggaran') ?>">Data Anggaran</a></li>
                    <li class="breadcrumb-item active">Tambah Data Anggaran</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Input data anggaran belanja</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="ftahun_program">Tahun Program</label>
                        <input type="text" class="form-control <?= form_error('ftahun_program') ? 'is-invalid' : '' ?>" id="ftahun_program" name="ftahun_program" placeholder="Masukan kode rekening" value="<?= $subkegiatan->tahun_program ?>" readonly>
                        <div class="invalid-feedback">
                            <?= form_error('ftahun_program') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_progam">Program</label>
                        <textarea name="furaian_progam" class="form-control <?= form_error('furaian_progam') ? 'is-invalid' : '' ?> text-uppercase" id="furaian_progam" readonly><?= $subkegiatan->uraian_program ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_progam') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_kegiatan">Kegiatan</label>
                        <textarea name="furaian_kegiatan" class="form-control <?= form_error('furaian_kegiatan') ? 'is-invalid' : '' ?> text-uppercase" id="furaian_kegiatan" readonly><?= $subkegiatan->uraian_kegiatan ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_kegiatan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_subkegiatan">Sub Kegiatan</label>
                        <textarea name="furaian_subkegiatan" class="form-control <?= form_error('furaian_subkegiatan') ? 'is-invalid' : '' ?> text-uppercase" id="furaian_subkegiatan" readonly><?= $subkegiatan->uraian_subkegiatan ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_subkegiatan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fkode_rekening_anggaran">Kode Rekening</label>
                        <input type="text" class="form-control <?= form_error('fkode_rekening_anggaran') ? 'is-invalid' : '' ?>" id="fkode_rekening_anggaran" name="fkode_rekening_anggaran" placeholder="kode rekening anggaran">
                        <div class="invalid-feedback">
                            <?= form_error('fkode_rekening_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fbulan_anggaran">Bulan anggaran</label>
                        <input type="month" class="form-control <?= form_error('fbulan_anggaran') ? 'is-invalid' : '' ?>" id="fbulan_anggaran" name="fbulan_anggaran" placeholder="pilih bulan">
                        <div class="invalid-feedback">
                            <?= form_error('fbulan_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_anggaran">Uraian Anggaran Belanja</label>
                        <textarea name="furaian_anggaran" class="form-control <?= form_error('furaian_anggaran') ? 'is-invalid' : '' ?> text-uppercase" id="furaian_anggaran"><?= $this->input->post('furaian_anggaran'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fanggaran_belanja">Jumlah anggaran</label>
                        <input type="text" class="form-control <?= form_error('fanggaran_belanja') ? 'is-invalid' : '' ?>" id="fanggaran_belanja" name="fanggaran_belanja" placeholder="jumlah anggaran">
                        <div class="invalid-feedback">
                            <?= form_error('fanggaran_belanja') ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a href="<?= base_url('anggaran') ?>" class="btn btn-secondary float-left">Batal</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>