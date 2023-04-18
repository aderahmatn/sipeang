<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Nota Pencairan Dinas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('nota') ?>">Data Nota Pencairan Dinas</a></li>
                    <li class="breadcrumb-item active">Tambah Nota Pencairan Dinas</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Input detail anggaran belanja</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <!-- <input type="hidden" name="fid_subkegiatan" value="<?= encrypt_url($subkegiatan->id_subkegiatan)  ?>" style="display: none"> -->
                <input type="hidden" name="fcreated_date" value="<?= date('y-m-d') ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fnonpd">Nomor NPD</label>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control <?= form_error('fnonpd') ? 'is-invalid' : '' ?>" id="fnourut" name="fnourut" value="NPD/<?= $nourut ?> -" readonly>
                                <div class=" invalid-feedback">
                                    <?= form_error('fnourut') ?>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control <?= form_error('fnomorNPD') ? 'is-invalid' : '' ?>" id="fnomorNPD" name="fnomorNPD" placeholder="kendaraan/2022">
                                <div class=" invalid-feedback">
                                    <?= form_error('fnomorNPD') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fnomor_dpa">Nomor DPA</label>
                        <input type="text" class="form-control <?= form_error('fnomor_dpa') ? 'is-invalid' : '' ?>" id="fnomor_dpa" name="fnomor_dpa" value="<?= $this->input->post('fnomor_dpa') ?>" placeholder="Nomor DPA">
                        <div class=" invalid-feedback">
                            <?= form_error('fnomor_dpa') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ftahun_anggaran_nota">Tahun Anggaran</label>
                        <input type="text" class="form-control <?= form_error('ftahun_anggaran_nota') ? 'is-invalid' : '' ?>" id="ftahun_anggaran_nota" name="ftahun_anggaran_nota" value="<?= $this->input->post('ftahun_anggaran_nota') ?>" placeholder="<?= date('Y') ?>">
                        <div class=" invalid-feedback">
                            <?= form_error('ftahun_anggaran_nota') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fpptk">PPTK</label>
                        <input type="text" class="form-control <?= form_error('fpptk') ? 'is-invalid' : '' ?>" id="fpptk" name="fpptk" value="<?= strtoupper($this->session->userdata('nama_lengkap')) ?>" disabled>
                        <div class=" invalid-feedback">
                            <?= form_error('fpptk') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fprogram">Program</label>
                        <select class="form-control <?php echo form_error('fprogram') ? 'is-invalid' : '' ?>" id="fprogram" name="fprogram">
                            <option hidden value="" selected>Pilih Program </option>
                            <option>Pilih Program</option>
                            <?php foreach ($program as $key) : ?>
                                <option value="<?= $key->id_program ?>" <?= $this->input->post('fprogram') == $key->id_program ? 'selected' : '' ?>><?= $key->uraian_program ?></option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fprogram') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fkegiatan">Kegiatan</label>
                        <select class="form-control <?php echo form_error('fkegiatan') ? 'is-invalid' : '' ?>" id="fkegiatan" name="fkegiatan" disabled>
                            <option hidden value='' selected>Pilih Kegiatan </option>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fkegiatan') ?>
                        </div>
                        <div class="loading" id="loading">
                            <img src="<?= base_url() . 'assets/images/loading.gif' ?>" alt="loading">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fsubkegiatan">Sub Kegiatan</label>
                        <select class="form-control <?php echo form_error('fsubkegiatan') ? 'is-invalid' : '' ?>" id="fsubkegiatan" name="fsubkegiatan" disabled>
                            <option hidden value='' selected>Pilih Sub Kegiatan </option>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fsubkegiatan') ?>
                        </div>
                        <div class="loading" id="subloading">
                            <img src="<?= base_url() . 'assets/images/loading.gif' ?>" alt="loading">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a href="<?= base_url('nota') ?>" class="btn btn-secondary float-left">Batal</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#loading").hide()
        $("#subloading").hide()
        let program = $("#fprogram");
        let value;
        $("#fprogram").change(function() {
            $("#fkegiatan").hide()
            $("#loading").show()
            value = program.find(":selected").val()
            $.ajax({
                type: "GET",
                url: "<?= base_url() . 'nota/listKegiatan/' ?>" + value,
                dataType: "json",
                success: function(response) {
                    $("#loading").hide()
                    $("#fkegiatan").removeAttr("disabled")
                    $("#fkegiatan").html(response.list_kegiatan).show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + "\n" + thrownError); // Munculkan alert error
                }

            })
        })
        $("#fkegiatan").change(function() {
            $("#fsubkegiatan").hide()
            $("#subloading").show()
            let kegiatan = $("#fkegiatan");
            let id_subkegiatan;
            id_subkegiatan = kegiatan.find(":selected").val();
            $.ajax({
                type: "GET",
                url: "<?= base_url() . 'nota/listSubKegiatan/' ?>" + id_subkegiatan,
                dataType: "json",
                success: function(response) {
                    $("#subloading").hide()
                    $("#fsubkegiatan").removeAttr("disabled")
                    $("#fsubkegiatan").html(response.list_subkegiatan).show();
                    console.log(response)
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + "\n" + thrownError); // Munculkan alert error
                }

            })
        })



    })
</script>