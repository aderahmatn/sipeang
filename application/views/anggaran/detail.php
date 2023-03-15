<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Detail Anggaran </h1>
                <p class="text-muted"><?= $subkegiatan->uraian_subkegiatan ?></p>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('anggaran') ?>">Data Anggaran</a></li>
                    <li class="breadcrumb-item active">Detail Anggaran</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row text-sm">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('anggaran/create/') . encrypt_url($id)  ?>" class="btn btn-sm btn-primary "> + Tambah Detail Anggaran</a>
                <a href="<?= base_url('anggaran/')  ?>" class="btn btn-sm btn-default float-right">
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
                    <table id="TabelUser" class="table table-bordered table-striped text-sm">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Kode Rekening</th>
                                <th>Tahun</th>
                                <th>Uraian</th>
                                <th>Total Anggaran</th>
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
                                    <td><?= rupiah(total_anggaran($key->id_belanja)) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?= base_url('anggaran/tambah_anggaran/') . encrypt_url($key->id_belanja)  ?>"><button type="button" class="btn btn-default btn-sm"><i class="fas fa-plus" data-tolltip="tooltip" data-placement="top" title="Tambah Anggaran"></i></button>
                                            </a>
                                            <a href="<?= base_url('anggaran/edit/') . encrypt_url($key->id_belanja)  ?>"><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-detail" data-tolltip="tooltip" data-placement="top" <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt" data-tolltip="tooltip" data-placement="top" title="Edit"></i>
                                                </button>
                                            </a>
                                            <a class="btn btn-default btn-sm" data-toggle="modal" onclick="getDetail(<?= $key->id_belanja ?>)" href="#modal_Detail" data-tolltip="tooltip" data-placement="top" title="Detail Perencanaan"><i class="fas fa-eye"></i></a>
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
<div class="modal fade" id="modal_Detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Perencanaan Anggaran</h4>
            </div>
            <div class="modal-body" id="bodymodal_Detail">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary float-right" id="closemodal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_history">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Riwayat Edit Anggaran</h4>
            </div>
            <div class="modal-body" id="bodymodal_history">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary float-right" id="closemodal-history">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- page script -->

<script>
    function getDetail(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('anggaran/detail_perencanaan/'); ?>" + id,
            // data: "id=" + id,
            dataType: "html",
            success: function(response) {
                console.log(response);
                $('#bodymodal_Detail').empty();
                $('#bodymodal_Detail').append(response);
            }
        });
    }

    function getHistory(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('anggaran/get_history/'); ?>" + id,
            // data: "id=" + id,
            dataType: "html",
            success: function(response) {
                console.log(response);
                $('#bodymodal_history').empty();
                $('#bodymodal_history').append(response);
            }
        });
    }


    $(document).ready(function() {
        $('#closemodal').click(function() {
            $('#modal_Detail').modal('hide');
        });
        $('#closemodal-history').click(function() {
            $('#modal_history').modal('hide');
        });
        $('#TabelUser').DataTable({
            "responsive": true,

        });
        $('[data-tolltip="tooltip"]').tooltip({
            trigger: "hover"
        })

    });
</script>