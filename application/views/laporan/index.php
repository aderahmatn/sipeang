<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Kegiatan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Laporan kegiatan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Filter Data kegiatan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- card-body -->
                    <div class="card-body table-responsive">
                        <form role="form" method="POST" action="" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ftahun_anggaran">Tahun Anggaran</label>
                                        <select class="form-control <?php echo form_error('ftahun_anggaran') ? 'is-invalid' : '' ?>" id="ftahun_anggaran" name="ftahun_anggaran">
                                            <option hidden value="" selected>Pilih Tahun </option>
                                            <?php
                                            $now = date('Y') - 3;
                                            $range = date('Y') + 10;
                                            for ($i = $now; $i < $range; $i++) { ?>
                                                <option value="<?= $i ?>" <?= $this->input->post('ftahun_anggaran') == $i ? 'selected' : '' ?>><?= $i ?></option>
                                            <?php  } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= form_error('ftahun_anggaran') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Kirim</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">Data kegiatan</h3>
            </div>
            <!-- /.card-header -->
            <!-- card-body -->
            <div class="card-body ">
                <table class="table table-bordered table-sm text-sm">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">NO</th>
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
                    <tbody>
                        <?php $no = 1;
                        $i = 0;
                        foreach ($anggaran as $key) :
                        ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td><?= $key->kode_rekening_belanja ?></td>
                                <td><?= $key->uraian_belanja ?></td>
                                <td><?= rupiah($key->anggaran_belanja) ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-01") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-02") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-03") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-04") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-05") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-06") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-07") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-08") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-09") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-10") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-11") ?></td>
                                <td class="text-center align-middle"><?= penyerapan($key->id_belanja, $key->tahun_anggaran . "-12") ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            </form>
        </div>
    </div>
</section>

<!-- page script -->
<script>
    $(document).ready(function() {
        $('#TabelUser').DataTable({
            "responsive": true,

        });
        $('[data-tolltip="tooltip"]').tooltip({
            trigger: "hover"
        })

    });
</script>