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
                    <a href="<?= base_url('anggaran') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-success">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= rupiah($total_penyerapan) ?></h4>
                        <p class="mt-3 mb-0">Total penyerapan tahun <?= $tahun ?></p>
                    </div>
                    <a href="<?= base_url('penyerapan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-info">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= rupiah($total_anggaran - $total_penyerapan) ?></h4>
                        <p class="mt-3 mb-0">Sisa anggaran tahun <?= $tahun ?></p>
                    </div>
                    <a href="<?= base_url('penyerapan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-danger">
                    <div class="inner text-white ">
                        <h4 class="text-bold mt-1"><?= $total_penyerapan == 0 ? '0' : ceil($total_penyerapan / $total_anggaran * 100) ?><sup style="font-size: 16px">%</sup></h4>
                        <p class="mt-3 mb-0">Presentase penyerapan tahun <?= $tahun ?></p>
                    </div>
                    <a href="<?= base_url('penyerapan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
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