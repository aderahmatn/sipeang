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
            </div>

            <div class="card-body table-responsive">

                <table class="table table-bordered text-sm">
                    <thead>
                        <tr>
                            <td>Uraian</td>
                            <td>Rp</td>
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
                            <tr id="program<?= $key->id_program ?>">
                                <td class="text-bold"><?= $key->uraian_program ?></td>
                                <td>-</td>
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

<script>
    $("#ftahun_dashboard").on('change', function() {
        $thn = $("#ftahun_dashboard").val();
        window.location = "<?= base_url('laporan/perencanaan/') ?>" + $thn;
    })
</script>