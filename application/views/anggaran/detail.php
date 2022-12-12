<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Detail Anggaran</h1>
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
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('anggaran/create/') . encrypt_url($id)  ?>" class="btn btn-sm btn-primary "> + Tambah Anggaran</a>
                <a href="<?= base_url('anggaran/')  ?>" class="btn btn-sm btn-default float-right">
                    Kembali</a>
            </div>
            <div class="card-body">
                <div class="row py-2">
                    <div class="col-2"><strong>Tahun Program </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $subkegiatan->tahun_program ?><br></div>
                </div>
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
                <div class="card-body table-responsive p-0 mt-3">
                    <table id="TabelUser" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Kode Rekening</th>
                                <th>Uraian</th>
                                <th>Anggaran</th>
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
                                    <td><?= $key->uraian_belanja ?></td>
                                    <td><?= rupiah($key->anggaran_belanja)  ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?= base_url('anggaran/edit/') . encrypt_url($key->id_belanja)  ?>"><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-detail" data-tolltip="tooltip" data-placement="top" <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt" data-tolltip="tooltip" data-placement="top" title="Edit"></i></button></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>

        </div>
        <!-- /.card -->
    </div>
</div>

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