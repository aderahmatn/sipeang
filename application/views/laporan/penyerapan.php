<script src="<?= base_url('assets/dist/js/jspdf.debug.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/html2canvas.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/html2pdf.min.js') ?>"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Laporan Penyerapan Anggaran</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Laporan Penyerapan Anggaran</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filter laporan penyerapan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" autocomplete="off">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                <input type="hidden" name="fdate_created" value="<?= date('y-m-d') ?>" style="display: none">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ftgl_awal">Tanggal Awal</label>
                                <input type="date" class="form-control <?= form_error('ftgl_awal') ? 'is-invalid' : '' ?>" id="ftgl_awal" name="ftgl_awal" placeholder="Masukan tanggal awal" value="<?= $this->input->post('ftgl_awal'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ftgl_awal') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ftgl_akhir">Tanggal Akhir</label>
                                <input type="date" class="form-control <?= form_error('ftgl_akhir') ? 'is-invalid' : '' ?>" id="ftgl_akhir" name="ftgl_akhir" placeholder="Masukan tanggal akhir" value="<?= $this->input->post('ftgl_akhir'); ?>">
                                <div class="invalid-feedback">
                                    <?= form_error('ftgl_akhir') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
<?php if (!$penyerapan) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <span class="text-center my-4 text-sm">Tidak ada data</span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <script>
        function getKegiatan(tgl_awal, tgl_akhir, id_program) {
            $.ajax({
                type: "get",
                url: "<?= site_url('penyerapan/insert_kegiatan/'); ?>" + tgl_awal + "/" + tgl_akhir + "/" + id_program,
                dataType: "html",
                success: function(response) {
                    console.log(tgl_akhir);
                    $('#program' + id_program).after(response);

                }
            });
        }

        function subKegiatan(tgl_awal, tgl_akhir, idkegiatan) {
            $.ajax({
                type: "get",
                url: "<?= site_url('penyerapan/insert_subkegiatan/'); ?>" + tgl_awal + "/" + tgl_akhir + "/" + idkegiatan,
                dataType: "html",
                success: function(response) {
                    $('#kegiatan' + idkegiatan).after(response);
                }
            });
        }

        function detail(tgl_awal, tgl_akhir, id_subkegiatan) {
            $.ajax({
                type: "get",
                url: "<?= site_url('penyerapan/insert_detail/'); ?>" + tgl_awal + "/" + tgl_akhir + "/" + id_subkegiatan,
                dataType: "html",
                success: function(response) {
                    $('#subkegiatan' + id_subkegiatan).after(response);
                }
            });
        }
    </script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="javascript:void(0)" class="btn-download btn btn-danger float-right btn-sm text-white"><i class="fas fa-file-pdf"></i> Download .Pdf</a></div>
                <div class="card-body" id="TabelPenyerapan">
                    <p class="text-center text-sm text-bold mb-0">LAPORAN REALISASI ANGGARAN SKPD</p>
                    <p class="text-center text-sm text-bold mb-3">PERIODE <?= $tgl_awal ?> S/D <?= $tgl_akhir ?></p>
                    <table class="table table-bordered text-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Uraian</th>
                                <th>Total Anggaran</th>
                                <th>Penyerapan Priode ini</th>
                                <th>Sisa Anggaran</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($penyerapan as $key) : ?>
                                <tr id="program<?= $key->id_program ?>" class="text-bold">
                                    <td><?= $key->kode_rekening ?></td>
                                    <td><?= $key->uraian_program ?></td>
                                    <td><?= rupiah(jumlah_anggaran_per_program($key->id_program)) ?></td>
                                    <td><?= rupiah(get_total_penyerapan_by_program($tgl_awal, $tgl_akhir, $key->id_program)) ?></td>
                                    <td><?= rupiah(jumlah_anggaran_per_program($key->id_program) - get_total_penyerapan_by_program($tgl_awal, $tgl_akhir, $key->id_program)) ?></td>
                                    <td><?= ceil(get_total_penyerapan_by_program($tgl_awal, $tgl_akhir, $key->id_program) / jumlah_anggaran_per_program($key->id_program) * 100) ?><sup>%</sup></td>


                                </tr>
                                <script>
                                    getKegiatan("<?= $tgl_awal ?>", "<?= $tgl_akhir ?>", <?= $key->id_program ?>)
                                </script>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script src="<?= base_url('assets/dist/js/jspdf.debug.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/html2canvas.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/html2pdf.min.js') ?>"></script>
<script>
    const options = {
        margin: 0.5,
        filename: 'REALISASI ANGGARAN SKPD PERIODE <?= $tgl_awal ?> S/D <?= $tgl_akhir ?>.pdf',
        image: {
            type: 'png',
            quality: 1
        },
        html2canvas: {
            dpi: 192,
            scale: 3
        },
        jsPDF: {
            unit: 'in',
            format: 'A3',
            orientation: 'landscape'
        }
    }

    $('.btn-download').click(function(e) {
        e.preventDefault();
        const element = document.getElementById('TabelPenyerapan');
        html2pdf().from(element).set(options).save();
    });
</script>