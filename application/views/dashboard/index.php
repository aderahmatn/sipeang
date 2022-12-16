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

                            $now = date('Y');
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
            <div class="col-lg-3 col-6">
                <div class="small-box bg-peang">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= rupiah($total_anggaran) ?></h4>
                        <p class="mt-3 mb-0">Total anggaran tahun <?= $tahun ?></p>
                    </div>
                    <a href="<?= base_url('anggaran') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= rupiah($total_penyerapan) ?></h4>
                        <p class="mt-3 mb-0">Total penyerapan tahun <?= $tahun ?></p>
                    </div>
                    <a href="<?= base_url('penyerapan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= rupiah($sisa_anggaran) ?></h4>
                        <p class="mt-3 mb-0">Sisa anggaran tahun <?= $tahun ?></p>
                    </div>
                    <a href="<?= base_url('penyerapan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= $total_penyerapan == 0 ? '0' : ceil($total_penyerapan / $total_anggaran * 100) ?><sup style="font-size: 16px">%</sup></h4>
                        <p class="mt-3 mb-0">Presentase penyerapan tahun <?= $tahun ?></p>
                    </div>
                    <a href="<?= base_url('penyerapan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header border-0">
                <h3 class="card-title ml-n2">Data Anggaran Tahun 2023</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-3 ">
                <table id="TabelUser" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!-- <th style="width: 10px">No</th> -->

                            <th></th>
                            <th>Uraian</th>
                            <th>Anggaran</th>
                            <th>Sisa Anggaran</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($anggaran as $key) : ?>
                            <tr>
                                <!-- <td><?= $no++ ?></td> -->
                                <td>
                                    <a class="text-muted" data-toggle="modal" onclick="getHistori(<?= $key->id_belanja ?>)" href="#modal_Detail"><i class="fas fa-eye"></i></a>
                                </td>

                                <td><?= strtoupper($key->uraian_belanja)  ?></td>
                                <td><?= rupiah($key->anggaran_belanja_one)  ?></td>
                                <td><?= rupiah($key->sisa_anggaran)  ?></td>
                                <td><?= ceil($key->jumlah_penyerapan / $key->anggaran_belanja_one * 100)  ?><sup style="font-size: 12px"> %</sup> </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="modal fade" id="modal_Detail">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Detail data</h4>
                            </div>
                            <div class="modal-body" id="bodymodal_Detail">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary float-right" id="closemodal">Tutup</button>
                            </div>
                        </div>
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