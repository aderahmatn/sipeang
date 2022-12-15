<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Data Anggaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('anggaran') ?>">Data Anggaran</a></li>
                    <li class="breadcrumb-item active">Edit Data Anggaran</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit data anggaran belanja</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <input type="hidden" name="fid_subkegiatan" value="<?= encrypt_url($anggaran->id_subkegiatan)  ?>" style="display: none">
                <input type="hidden" name="fid_anggaran" value="<?= encrypt_url($anggaran->id_belanja)  ?>" style="display: none">
                <input type="hidden" name="fkode_rekening_belanja_old" value="<?= $anggaran->kode_rekening_belanja  ?>" style="display: none">
                <input type="hidden" name="furaian_belanja_old" value="<?= $anggaran->uraian_belanja  ?>" style="display: none">
                <input type="hidden" name="fbulan_anggaran_old" value="<?= $anggaran->bulan  ?>" style="display: none">
                <input type="hidden" name="fanggaran_belanja_old" value="<?= $anggaran->anggaran_belanja  ?>" style="display: none">
                <input type="hidden" name="fjenis_apbd_old" value="<?= $anggaran->id_apbd ?>" style="display: none">


                <input type="hidden" name="fcreated_date" value="<?= date('y-m-d') ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="ftahun_program">Tahun Program</label>
                        <input type="text" class="form-control <?= form_error('ftahun_program') ? 'is-invalid' : '' ?>" id="ftahun_program" name="ftahun_program" placeholder="Masukan kode rekening" value="<?= $anggaran->tahun_program ?>" readonly>
                        <div class="invalid-feedback">
                            <?= form_error('ftahun_program') ?>
                        </div>
                    </div>
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
                        <input type="text" class="form-control <?= form_error('fkode_rekening_anggaran') ? 'is-invalid' : '' ?>" id="fkode_rekening_anggaran" name="fkode_rekening_anggaran" placeholder="kode rekening anggaran" value="<?= $anggaran->kode_rekening_belanja ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fkode_rekening_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fbulan_anggaran">Bulan anggaran</label>
                        <input type="month" class="form-control <?= form_error('fbulan_anggaran') ? 'is-invalid' : '' ?>" id="fbulan_anggaran" name="fbulan_anggaran" placeholder="pilih bulan" value="<?= $anggaran->bulan ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fbulan_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="furaian_anggaran">Uraian Anggaran Belanja</label>
                        <textarea name="furaian_anggaran" class="form-control <?= form_error('furaian_anggaran') ? 'is-invalid' : '' ?> text-uppercase" id="furaian_anggaran"><?= $this->input->post('furaian_anggaran'); ?><?= $anggaran->uraian_belanja ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('furaian_anggaran') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fanggaran_belanja">Jumlah anggaran</label>
                        <input type="text" class="form-control <?= form_error('fanggaran_belanja') ? 'is-invalid' : '' ?>" id="fanggaran_belanja" name="fanggaran_belanja" placeholder="jumlah anggaran" value="<?= $anggaran->anggaran_belanja ?>">
                        <div class="invalid-feedback">
                            <?= form_error('fanggaran_belanja') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fjenis_apbd">Jenis APBD</label>
                        <select class="form-control <?php echo form_error('fjenis_apbd') ? 'is-invalid' : '' ?>" id="fjenis_apbd" name="fjenis_apbd">
                            <option hidden value="" selected>Pilih APBD</option>
                            <?php foreach ($apbd as $key) : ?>
                                <option value="<?= $key->id_apbd ?>" <?= $this->input->post('fjenis_apbd') == $key->id_apbd ? 'selected' : '' ?>><?= strtoupper($key->nama_apbd) ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fjenis_apbd') ?>
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
<script>
    var tanpa_rupiah = document.getElementById('fanggaran_belanja');
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