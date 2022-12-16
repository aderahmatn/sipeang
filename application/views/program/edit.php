<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Edit Data Program</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('program') ?>">Master Program</a></li>
                    <li class="breadcrumb-item active">Edit Data program</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit data program</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <input type="hidden" name="fid_program" style="display: none" value="<?= encrypt_url($program->id_program) ?>">
                <input type="hidden" name="fdate_created" value="<?= date('y-m-d') ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fkode_rekening">Kode Rekening</label>
                        <input type="text" class="form-control <?= form_error('fkode_rekening') ? 'is-invalid' : '' ?>" id="fkode_rekening" name="fkode_rekening" placeholder="Masukan kode rekening" value="<?= $program->kode_rekening ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fkode_rekening') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_program">Uraian Program</label>
                        <textarea name="furaian_program" class="form-control <?= form_error('furaian_program') ? 'is-invalid' : '' ?>" id="furaian_program"><?= $program->uraian_program ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_program') ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a href="<?= base_url('program') ?>" class="btn btn-secondary float-left">Batal</a>

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>