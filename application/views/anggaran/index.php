<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Anggaran Belanja</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Anggaran Belanja</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Data Sub Kegiatan</h3>
                        <!-- <a href="<?= base_url('anggaran/create') ?>" class="btn btn-sm btn-primary float-right"> + Tambah</a> -->

                    </div>
                    <!-- /.card-header -->
                    <!-- card-body -->
                    <div class="card-body table-responsive">
                        <!--  -->
                        <table id="TabelUser" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Sub Kegiatan</th>
                                    <th style="width: 10px">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($subkegiatan as $key) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><a href="" class="link-blue text-uppercase"><?= $key->uraian_subkegiatan ?></a></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-detail<?= $key->id_subkegiatan ?>" data-tolltip="tooltip" data-placement="top" <button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye" data-tolltip="tooltip" data-placement="top" title="Detail"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Detail-->
                                <?php endforeach; ?>
                        </table>
                        <?php foreach ($subkegiatan as $key) : ?>
                            <div class="modal fade " id="modal-detail<?= $key->id_subkegiatan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title"><strong>Detail Sub Kegiatan</strong></h6>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row py-2">
                                                <div class="col-3"><strong>Tahun Program </strong></div>
                                                <div class="col-1">
                                                    <strong>:</strong>
                                                </div>
                                                <div class="col-8 text-uppercase"><?= $key->tahun_program ?> <br></div>
                                            </div>
                                            <div class="row py-2 bg-light">
                                                <div class="col-3"><strong>Program </strong></div>
                                                <div class="col-1">
                                                    <strong>:</strong>
                                                </div>
                                                <div class="col-8 text-uppercase"><?= $key->uraian_program ?> <br></div>
                                            </div>
                                            <div class="row py-2 ">
                                                <div class="col-3"><strong>Kegiatan </strong></div>
                                                <div class="col-1">
                                                    <strong>:</strong>
                                                </div>
                                                <div class="col-8 text-uppercase"><?= $key->uraian_kegiatan ?> <br></div>
                                            </div>
                                            <div class="row py-2 bg-light">
                                                <div class="col-3"><strong>Sub Kegiatan </strong></div>
                                                <div class="col-1">
                                                    <strong>:</strong>
                                                </div>
                                                <div class="col-8 text-uppercase"><?= $key->uraian_subkegiatan ?> <br></div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 10px">#</th>
                                                                        <th>Kode Rekening</th>
                                                                        <th>Uraian Belanja</th>
                                                                        <th>Anggaran</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1.</td>
                                                                        <td>asas</td>
                                                                        <td>
                                                                            uraian belanja
                                                                        </td>
                                                                        <td>Rp. 8.200.000</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-5 "> <strong><a href="<?= base_url('anggaran/create/') . $key->id_subkegiatan ?>" class="link-blue">[Tambah Detail Belanja]</a></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>
    </div>
</section>






<!-- page script -->
<script>
    $(document).ready(function() {
        $('#TabelUser').DataTable();
        $('[data-tolltip="tooltip"]').tooltip({
            trigger: "hover"
        })

    });
</script>
<!--Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-3 d-flex justify-content-center">
                        <i class="fa  fa-exclamation-triangle" style="font-size: 70px; color:red;"></i>
                    </div>
                    <div class="col-9 pt-2">
                        <h5>Apakah anda yakin?</h5>
                        <span>Data yang dihapus tidak akan bisa dikembalikan.</span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal"> Batal</button>
                <a id="btn-delete" class="btn btn-danger" href="#"> Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirm -->
<script type="text/javascript">
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>