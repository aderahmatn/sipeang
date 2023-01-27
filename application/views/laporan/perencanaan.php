<script src="<?= base_url('assets/dist/js/jspdf.debug.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/html2canvas.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/html2pdf.min.js') ?>"></script>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Perencanaan Anggaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <ol class="breadcrumb float-sm-right mt-2">
                        <li class="breadcrumb-item active mr-2">Tahun</li>
                        <div class="form-group">
                            <select class="form-control form-control-sm bg-default" id="ftahun_dashboard" name="ftahun_dashboard">
                                <?php
                                $now = date('Y');
                                $range = date('Y') + 10;
                                for ($i = $now; $i < $range; $i++) { ?>
                                    <option value="<?= $i ?>" <?= $tahun == $i ? 'selected' : '' ?>><?= $i ?></option>
                                <?php  } ?>
                            </select>
                        </div>
                    </ol>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Data Perencanaan</h3>
                <a href="javascript:void(0)" class="btn-download btn btn-danger float-right btn-sm text-white"><i class="fas fa-file-pdf"></i> Download .Pdf</a>
            </div>
            <div class="card-body table-responsive scrollme" id="TabelPerencanaan">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center text-bold">Rencana Pencairan Tahun Anggaran <?= $tahun ?></p>
                    </div>
                </div>
                <table class="table table-bordered text-xs">
                    <thead style="border-top: solid; border-color:gray">
                        <tr>
                            <th rowspan="2" class="text-center align-middle">KODE REK.</th>
                            <th rowspan="2" class="text-center align-middle">URAIAN</th>
                            <th rowspan="2" class="text-center align-middle">JUMLAH ANGGARAN</th>
                            <th colspan="12" class="text-center align-middle">BULAN</th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle">1</th>
                            <th class="text-center align-middle">2</th>
                            <th class="text-center align-middle">3</th>
                            <th class="text-center align-middle">4</th>
                            <th class="text-center align-middle">5</th>
                            <th class="text-center align-middle">6</th>
                            <th class="text-center align-middle">7</th>
                            <th class="text-center align-middle">8</th>
                            <th class="text-center align-middle">9</th>
                            <th class="text-center align-middle">10</th>
                            <th class="text-center align-middle">11</th>
                            <th class="text-center align-middle">12</th>
                        </tr>

                    </thead>
                    <script>
                        function getDetail(id) {
                            // console.log(id);
                            $.ajax({
                                type: "get",
                                url: "<?= site_url('anggaran/insert_kegiatan/'); ?>" + id + "/" + <?= $tahun ?>,
                                // data: "id=" + id,
                                dataType: "html",
                                success: function(response) {
                                    console.log(id);
                                    // $('#bodymodal_Detail').empty();
                                    $('#program' + id).after(response);
                                }
                            });
                        }

                        function getSubkegiatan(id, id_kegiatan) {
                            // console.log(id);
                            $.ajax({
                                type: "get",
                                url: "<?= site_url('anggaran/insert_subkegiatan/'); ?>" + id + "/" + <?= $tahun ?>,
                                // data: "id=" + id,
                                dataType: "html",
                                success: function(response) {
                                    console.log(id);
                                    // $('#bodymodal_Detail').empty();
                                    $('#kegiatan' + id_kegiatan).after(response);
                                }
                            });
                        }

                        function getDetailBelanja(id, id_sub) {
                            // console.log(id);
                            $.ajax({
                                type: "get",
                                url: "<?= site_url('anggaran/insert_detail_anggaran/'); ?>" + id + "/" + <?= $tahun ?>,
                                // data: "id=" + id,
                                dataType: "html",
                                success: function(response) {
                                    console.log(id);
                                    // $('#bodymodal_Detail').empty();
                                    $('#subkegiatan' + id_sub).after(response);
                                }
                            });
                        }
                    </script>
                    <?php
                    foreach ($program as $key) : ?>
                        <tbody>
                            <tr id="program<?= $key->id_program ?>" class="text-ITALIC" style="background-color: #d2fafb;">
                                <td><?= $key->kode_rekening ?></td>
                                <td><?= $key->uraian_program ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program($key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(1, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(2, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(3, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(4, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(5, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(6, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(7, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(8, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(9, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(10, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(11, $key->id_program))  ?></td>
                                <td><?= rupiah_no_rp(jumlah_anggaran_per_program_per_bulan(12, $key->id_program))  ?></td>
                            </tr>
                        </tbody>
                        <script>
                            getDetail(<?= $key->id_program ?>);
                        </script>
                    <?php endforeach ?>

                </table>
            </div>
        </div>
</section>
<script src="<?= base_url('assets/dist/js/jspdf.debug.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/html2canvas.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/html2pdf.min.js') ?>"></script>
<script>
    $("#ftahun_dashboard").on('change', function() {
        $thn = $("#ftahun_dashboard").val();
        window.location = "<?= base_url('laporan/perencanaan/') ?>" + $thn;
    })

    const options = {
        margin: 0.5,
        filename: 'Rencana Pencairan Tahun Anggaran <?= $tahun ?>.pdf',
        image: {
            type: 'png',
            quality: 5000
        },
        html2canvas: {
            scale: 1
        },
        jsPDF: {
            unit: 'in',
            format: 'A3',
            orientation: 'landscape'
        }
    }

    $('.btn-download').click(function(e) {
        e.preventDefault();
        const element = document.getElementById('TabelPerencanaan');
        html2pdf().from(element).set(options).save();
    });
</script>