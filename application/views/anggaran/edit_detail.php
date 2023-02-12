<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Data Detail Perencanaan Anggaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('anggaran') ?>">Data Anggaran</a></li>
                    <li class="breadcrumb-item active">Edit Data Detail Perencanaan Anggaran</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit data detail perencanaan anggaran belanja</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <input type="hidden" name="fcreated_date" value="<?= date('y-m-d') ?>" style="display: none">
                <input type="hidden" name="fbulan" value="<?= $anggaran->bulan ?>" style="display: none">
                <input type="hidden" name="fid_detail_anggaran" value="<?= encrypt_url($anggaran->id_detail_anggaran) ?>" style="display: none">
                <input type="hidden" name="fid_belanja" value="<?= encrypt_url($anggaran->id_belanja) ?>" style="display: none">
                <input type="hidden" name="fjumlah_anggaran_old" value="<?= $anggaran->jumlah_anggaran ?>" style="display: none">
                <input type="hidden" name="fapbd_old" value="<?= $anggaran->id_apbd ?>" style="display: none">
                <input type="hidden" name="fsisa_anggaran" value="<?= $anggaran->sisa_anggaran ?>" style="display: none">

                <div class="card-body">
                    <div class="form-group">
                        <label for="furaian_progam">Program</label>
                        <textarea name="furaian_progam" class="form-control <?= form_error('furaian_progam') ? 'is-invalid' : '' ?> text-uppercase" id="furaian_progam" readonly><?= $anggaran->uraian_program ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_progam') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_kegiatan">Kegiatan</label>
                        <textarea name="furaian_kegiatan" class="form-control <?= form_error('furaian_kegiatan') ? 'is-invalid' : '' ?> text-uppercase" id="furaian_kegiatan" readonly><?= $anggaran->uraian_kegiatan ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_kegiatan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_subkegiatan">Sub Kegiatan</label>
                        <textarea name="furaian_subkegiatan" class="form-control <?= form_error('furaian_subkegiatan') ? 'is-invalid' : '' ?> text-uppercase" id="furaian_subkegiatan" readonly><?= $anggaran->uraian_subkegiatan ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_subkegiatan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fkode_rekening_anggaran">Kode Rekening</label>
                        <input type="text" class="form-control <?= form_error('fkode_rekening_anggaran') ? 'is-invalid' : '' ?>" id="fkode_rekening_anggaran" name="fkode_rekening_anggaran" placeholder="kode rekening anggaran" value="<?= $anggaran->kode_rekening_belanja ?>" readonly>
                        <div class="invalid-feedback">
                            <?= form_error('fkode_rekening_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_anggaran">Uraian Anggaran Belanja</label>
                        <textarea name="furaian_anggaran" class=" form-control <?= form_error('furaian_anggaran') ? 'is-invalid' : '' ?> text-uppercase" id="furaian_anggaran" readonly><?= $this->input->post('furaian_anggaran'); ?><?= $anggaran->uraian_belanja ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fkode_rekening_anggaran">Tahun Anggaran</label>
                        <input type="text" class="form-control <?= form_error('fkode_rekening_anggaran') ? 'is-invalid' : '' ?>" id="fkode_rekening_anggaran" name="fkode_rekening_anggaran" placeholder="kode rekening anggaran" value="<?= $anggaran->tahun_anggaran ?>" readonly>
                        <div class="invalid-feedback">
                            <?= form_error('fkode_rekening_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fkode_rekening_anggaran">Bulan Anggaran</label>
                        <input type="text" class="form-control <?= form_error('fkode_rekening_anggaran') ? 'is-invalid' : '' ?>" id="fkode_rekening_anggaran" name="fkode_rekening_anggaran" placeholder="kode rekening anggaran" value="<?= bulan($anggaran->bulan)  ?>" readonly>
                        <div class="invalid-feedback">
                            <?= form_error('fkode_rekening_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fjumlah_anggaran">Jumlah Anggaran</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control <?= form_error('fjumlah_anggaran') ? 'is-invalid' : '' ?>" id="fjumlah_anggaran" name="fjumlah_anggaran" placeholder="Jumlah anggaran" value="<?= $anggaran->jumlah_anggaran; ?>">
                            <div class=" invalid-feedback">
                                <?= form_error('fjumlah_anggaran') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fapbd">Jenis APBD</label>
                        <select class="form-control <?php echo form_error('fapbd') ? 'is-invalid' : '' ?>" id="fapbd" name="fapbd">
                            <option hidden value="" selected>Pilih APBD </option>
                            <?php foreach ($apbd as $key) : ?>
                                <option value="<?= $key->id_apbd ?>" <?= $this->input->post('fapbd') ==  $key->id_apbd  ? 'selected' : '' ?>><?= strtoupper($key->nama_apbd)  ?></option>
                            <?php endforeach ?>

                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fapbd') ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <a href="<?= base_url('anggaran/detail/') . encrypt_url($anggaran->id_subkegiatan) ?>" class="btn btn-secondary float-left">Batal</a>

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
<script>
    var tanpa_rupiah = document.getElementById('fjumlah_anggaran');
    tanpa_rupiah.addEventListener('keyup', function(e) {
        tanpa_rupiah.value = formatRupiah(this.value);
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>