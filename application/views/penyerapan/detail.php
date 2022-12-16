<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <!-- <h1>Detail Anggaran</h1> -->
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('penyerapan') ?>">Data Anggaran</a></li>
                    <li class="breadcrumb-item active">Detail Anggaran</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Data Anggaran</h3>
                </div>
                <!-- <a href="<?= base_url('penyerapan/create/') . encrypt_url($id)  ?>" class="btn btn-sm btn-primary "> + Tambah Penyerapan</a> -->
                <a href="<?= base_url('penyerapan/')  ?>" class="btn btn-sm btn-default float-right">
                    Kembali </a>
            </div>
            <div class="card-body">
                <div class="row py-2 bg-light">
                    <div class="col-2"><strong>Program </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $subkegiatan->uraian_program ?> <br></div>
                </div>
                <div class="row py-2 ">
                    <div class="col-2"><strong>Kegiatan </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $subkegiatan->uraian_kegiatan ?> <br></div>
                </div>
                <div class="row py-2 bg-light">
                    <div class="col-2"><strong>Sub Kegiatan </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $subkegiatan->uraian_subkegiatan ?> <br></div>
                </div>
                <div class="row py-2 ">
                    <div class="col-2"><strong>PIC Kegiatan </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $subkegiatan->nama_lengkap  ?> <br></div>
                </div>
                <div class="card-body table-responsive p-0 mt-4">
                    <table id="TabelUser" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Kode Rekening</th>
                                <th>Tahun Anggaran</th>
                                <th>Uraian</th>
                                <th>Total Anggaran</th>
                                <th>Sisa Anggaran</th>
                                <th style="width: 10px">Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($anggaran as $key) : ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $key->kode_rekening_belanja ?></td>
                                    <td><?= $key->tahun_anggaran ?></td>
                                    <td><?= strtoupper($key->uraian_belanja)  ?></td>
                                    <td><?= rupiah($key->anggaran_belanja)  ?></td>
                                    <td><?= rupiah($key->sisa_anggaran)  ?></td>

                                    <td>
                                        <div class="btn-group">

                                            <a href="<?= base_url('penyerapan/create/') . encrypt_url($key->id_belanja) ?> "><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-detail" data-tolltip="tooltip" data-placement="top" <?= $key->sisa_anggaran != 0 ? '' : 'disabled' ?>>Serap Anggaran
                                                </button>
                                            </a>

                                            <a class="btn btn-default btn-sm" data-toggle="modal" onclick="getHistori(<?= $key->id_belanja ?>)" href="#modal_Detail">Lihat Penyerapan</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Data Penyerapan</h3>
                </div>
            </div>

            <div class="card-body">
                <div class="card-body table-responsive p-0 mt-4">
                    <table id="TabelPenyerapan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Kode Rekening</th>
                                <th>Tahun Anggaran</th>
                                <th>Uraian</th>
                                <th>Lampiran</th>
                                <th width='110'>Penyerapan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penyerapan as $key) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $key->kode_rekening_belanja ?></td>
                                    <td><?= $key->tahun_anggaran ?></td>
                                    <td><?= strtoupper($key->uraian_belanja)  ?></td>
                                    <td><a href="<?= base_url('uploads/') . $key->lampiran ?>" target="_blank" class="text-blue">Lihat Lampiran</a></td>
                                    <td><?= rupiah($key->jumlah_penyerapan)  ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" style="text-align:right">Total Penyerapan:</th>
                                <th><?= rupiah($total_penyerapan)  ?></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="modal fade" id="modal_Detail">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Riwayat data penyerapan</h4>
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
        <!-- /.card -->
    </div>
</div>

<!-- page script -->

<script>
    function getHistori(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('penyerapan/histori/'); ?>" + id,
            // data: "id=" + id,
            dataType: "html",
            success: function(response) {
                console.log(response);
                $('#bodymodal_Detail').empty();
                $('#bodymodal_Detail').append(response);
            }
        });
    }
    $(document).ready(function() {
        $('#closemodal').click(function() {
            $('#modal_Detail').modal('hide');
        });
        $('#TabelUser').DataTable({
            "responsive": true,

        });
        $('#TabelPenyerapan').DataTable({
            "responsive": true,

        });
        $('[data-tolltip="tooltip"]').tooltip({
            trigger: "hover"
        })

    });
</script>