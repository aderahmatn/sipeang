<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-6">
                <h4 class="mt-2 text-dark align-middle">Hallo, <?= ucwords($this->session->userdata('nama_lengkap')) ?></h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right mt-2">
                    <li class="breadcrumb-item active mr-2">Tahun</li>
                    <div class="form-group">
                        <select class="form-control form-control-sm bg-default" id="ftahun_dashboard" name="ftahun_dashboard">
                            <?php

                            $now = date('Y') - 10;
                            $range = date('Y') + 10;
                            for ($i = $now; $i < $range; $i++) { ?>
                                <option value="<?= $i ?>" <?= $tahun == $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-peang">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= rupiah($total_anggaran) ?></h4>
                        <p class="mt-3 mb-0">Total anggaran tahun <?= $tahun ?></p>
                    </div>
                    <?php if ($this->session->userdata('role') == 'pptk') { ?>
                        <a href="<?= base_url('anggaran') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    <?php } ?>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-success">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= rupiah($total_penyerapan) ?></h4>
                        <p class="mt-3 mb-0">Total penyerapan tahun <?= $tahun ?></p>
                    </div>
                    <?php if ($this->session->userdata('role') == 'pptk') { ?>
                        <a href="<?= base_url('penyerapan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    <?php } ?>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-info">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= rupiah($total_anggaran - $total_penyerapan) ?></h4>
                        <p class="mt-3 mb-0">Sisa anggaran tahun <?= $tahun ?></p>
                    </div>
                    <?php if ($this->session->userdata('role') == 'pptk') { ?>
                        <a href="<?= base_url('penyerapan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    <?php } ?>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-danger">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= $total_penyerapan == 0 ? '0' : ceil($total_penyerapan / $total_anggaran * 100) ?><sup style="font-size: 16px">%</sup></h4>
                        <p class="mt-3 mb-0">Presentase penyerapan tahun <?= $tahun ?></p>
                    </div>
                    <?php if ($this->session->userdata('role') == 'pptk') { ?>
                        <a href="<?= base_url('penyerapan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Jadwal realisasi bulan <?= bulan($bulan) ?> tahun <?= $tahun ?></h3>
                    </div>
                    <div class="card-body">
                        <?php if ($jadwal) { ?>
                            <table class="table table-borderles text-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Uraian</th>
                                        <th>Anggaran</th>
                                        <th>PIC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($jadwal as $key) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= strtoupper($key->uraian_belanja) ?></td>
                                            <td><?= rupiah($key->jumlah_anggaran) ?></td>
                                            <td><?= strtoupper($key->nama_lengkap) ?></td>
                                        </tr>
                                    <?php endforeach ?>

                                </tbody>
                            </table>
                        <?php } else { ?>
                            <p class="text-sm text-center">Tidak ada data</p>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Telegram SIPEANG</h3>
                    </div>
                    <div class="card-body">
                        <img src="<?= base_url('assets/images/telegram.jpg') ?>" class="img-fluid" alt="Responsive image">
                        <p class="text-sm mt-4">Aktifkan bot telegram SIPEANG dengan cara : </p>
                        <ul class="text-sm">
                            <li>Cari <b>@SipeangBot</b> pada kolom pencarian telegram.</li>
                            <li>Klik tombol <b>Start</b> untuk memulai sesi.</li>
                            <li>Ikuti langkah selanjutnya untuk melakukan aktivasi akun anda pada bot telegram SIPEANG.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Delete Confirm -->
<script type="text/javascript">
    function getHistori(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('anggaran/detail_dashboard/'); ?>" + id,
            // data: "id=" + id,
            dataType: "html",
            success: function(response) {
                console.log(response);
                $('#bodymodal_Detail').empty();
                $('#bodymodal_Detail').append(response);
            }
        });
    }
    $('#closemodal').click(function() {
        $('#modal_Detail').modal('hide');
    });
    $('#TabelUser').DataTable({
        "responsive": true,

    });
    $("#ftahun_dashboard").on('change', function() {
        $thn = $("#ftahun_dashboard").val();
        window.location = "<?= base_url('dashboard/index/') ?>" + $thn;
    })
</script>