<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Tambah Data User</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('alat') ?>">Data User</a></li>
                    <li class="breadcrumb-item active">Tambah Data User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Input data user</h3>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fnama_user">Nama Lengkap</label>
                        <input type="text" class="form-control <?= form_error('fnama_user') ? 'is-invalid' : '' ?>" id="fnama_user" name="fnama_user" placeholder="Enter Nama Lengkap" value="<?= $this->input->post('fnama_user'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fnama_user') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fnip">NIP</label>
                        <input type="text" class="form-control <?= form_error('fnip') ? 'is-invalid' : '' ?>" id="fnip" name="fnip" placeholder="Enter NIP" value="<?= $this->input->post('fnip'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fnip') ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="fusername">Username</label>
                        <input type="text" class="form-control <?= form_error('fusername') ? 'is-invalid' : '' ?>" id="fusername" name="fusername" placeholder="Enter Username" value="<?= $this->input->post('fusername'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fusername') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="femail">Email</label>
                        <input type="text" class="form-control <?= form_error('femail') ? 'is-invalid' : '' ?>" id="femail" name="femail" placeholder="Enter Email" value="<?= $this->input->post('femail'); ?>" type="email">
                        <div class="invalid-feedback">
                            <?= form_error('femail') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fnohp">No Telegram</label>
                        <input type="text" class="form-control <?= form_error('fnohp') ? 'is-invalid' : '' ?>" id="fnohp" name="fnohp" placeholder="Contoh : 6287776241887" value="<?= $this->input->post('fnohp'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fnohp') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fpassword">Password</label>
                        <input type="password" class="form-control <?= form_error('fpassword') ? 'is-invalid' : '' ?>" id="fpassword" name="fpassword" placeholder="Enter Password" value="<?= $this->input->post('fpassword'); ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fpassword') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="frole">Level</label>
                        <select class="form-control <?php echo form_error('frole') ? 'is-invalid' : '' ?>" id="frole" name="frole">
                            <option hidden value="" selected>Pilih Level</option>
                            <option value="operator" <?= $this->input->post('frole') == "operator" ? 'selected' : '' ?>>Operator</option>
                            <option value="pptk" <?= $this->input->post('frole') == "pptk" ? 'selected' : '' ?>>PPTK</option>
                            <option value="pa" <?= $this->input->post('frole') == "pa" ? 'selected' : '' ?>>PA</option>
                            <option value="admin" <?= $this->input->post('frole') == "admin" ? 'selected' : '' ?>>Administrator</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('frole') ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a href="<?= base_url('user') ?>" class="btn btn-secondary float-left">Batal</a>

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>