<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Anggaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('anggaran') ?>">Data Anggaran</a></li>
                    <li class="breadcrumb-item active">Tambah Anggaran</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Input anggaran belanja</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <input type="hidden" name="fid_belanja" value="<?= encrypt_url($anggaran->id_belanja)  ?>" style="display: none">
                <input type="hidden" name="fcreated_date" value="<?= date('y-m-d') ?>" style="display: none">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fbulan">Bulan Anggaran</label>
                        <select class="form-control <?php echo form_error('fbulan') ? 'is-invalid' : '' ?>" id="fbulan" name="fbulan">
                            <option hidden value="" selected>Pilih Bulan </option>
                            <?php if (cek_bulan_anggaran_for_form(1, $anggaran->id_belanja) != 1) { ?>
                                <option value="1" <?= $this->input->post('fbulan') == 1 ? 'selected' : '' ?>>Januari</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(2, $anggaran->id_belanja) != 1) { ?>
                                <option value="2" <?= $this->input->post('fbulan') == 2 ? 'selected' : '' ?>>Februari</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(3, $anggaran->id_belanja) != 1) { ?>
                                <option value="3" <?= $this->input->post('fbulan') == 3 ? 'selected' : '' ?>>Maret</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(4, $anggaran->id_belanja) != 1) { ?>
                                <option value="4" <?= $this->input->post('fbulan') == 4 ? 'selected' : '' ?>>April</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(5, $anggaran->id_belanja) != 1) { ?>
                                <option value="5" <?= $this->input->post('fbulan') == 5 ? 'selected' : '' ?>>Mei</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(6, $anggaran->id_belanja) != 1) { ?>
                                <option value="6" <?= $this->input->post('fbulan') == 6 ? 'selected' : '' ?>>Juni</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(7, $anggaran->id_belanja) != 1) { ?>
                                <option value="7" <?= $this->input->post('fbulan') == 7 ? 'selected' : '' ?>>Juli</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(8, $anggaran->id_belanja) != 1) { ?>
                                <option value="8" <?= $this->input->post('fbulan') == 8 ? 'selected' : '' ?>>Agustus</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(9, $anggaran->id_belanja) != 1) { ?>
                                <option value="9" <?= $this->input->post('fbulan') == 9 ? 'selected' : '' ?>>September</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(10, $anggaran->id_belanja) != 1) { ?>
                                <option value="10" <?= $this->input->post('fbulan') == 10 ? 'selected' : '' ?>>Oktober</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(11, $anggaran->id_belanja) != 1) { ?>
                                <option value="11" <?= $this->input->post('fbulan') == 11 ? 'selected' : '' ?>>November</option>
                            <?php } ?>
                            <?php if (cek_bulan_anggaran_for_form(12, $anggaran->id_belanja) != 1) { ?>
                                <option value="12" <?= $this->input->post('fbulan') == 12 ? 'selected' : '' ?>>Desember</option>
                            <?php } ?>

                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('fbulan') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fjumlah_anggaran">Jumlah Anggaran</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control <?= form_error('fjumlah_anggaran') ? 'is-invalid' : '' ?>" id="fjumlah_anggaran" name="fjumlah_anggaran" placeholder="Jumlah anggaran" value="<?= $this->input->post('fjumlah_anggaran'); ?>">
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