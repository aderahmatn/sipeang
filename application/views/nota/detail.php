<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Detail Nota </h1>
                <p class="text-muted"><?= strtoupper($nota->nomor_nota) ?></p>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('nota') ?>">Data Nota</a></li>
                    <li class="breadcrumb-item active">Detail Nota</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row text-sm">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('nota/create_detail/') . encrypt_url($nota->id_nota)  ?>" class="btn btn-sm btn-primary float-right"> + Tambah Detail Nota</a>
                <a href="<?= base_url('export/pdf/') . encrypt_url($nota->id_nota)  ?>" class="btn btn-sm btn-danger float-right mr-3" target="_blank"> <i class="fas fa-file-pdf"></i> Download PDF</a>
                <a href="<?= base_url('nota/')  ?>" class="btn btn-sm btn-default float-left">
                    Kembali </a>
            </div>
            <div class="card-body">
                <div class="row py-2 bg-light">
                    <div class="col-2"><strong>PPTK </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $nota->nama_lengkap ?> <br></div>
                </div>
                <div class="row py-2 ">
                    <div class="col-2"><strong>Program </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $nota->uraian_program ?> <br></div>
                </div>
                <div class="row py-2 bg-light">
                    <div class="col-2"><strong>Kegiatan </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $nota->uraian_kegiatan ?> <br></div>
                </div>
                <div class="row py-2 ">
                    <div class="col-2"><strong>Sub Kegiatan </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $nota->uraian_subkegiatan  ?> <br></div>
                </div>
                <div class="row py-2 bg-light">
                    <div class="col-2"><strong>Nomor DPA </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $nota->nomor_dpa ?> <br></div>
                </div>
                <div class="row py-2">
                    <div class="col-2"><strong>Tahun Anggaran </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $nota->tahun_anggaran_nota ?> <br></div>
                </div>
                <div class="card-body table-responsive p-0 mt-4">
                    <table id="TabelUser" class="table table-bordered table-striped text-sm">
                        <thead>
                            <tr>
                                <th style="width: 10px">Modify</th>
                                <th>Kode Rekening</th>
                                <th>Uraian</th>
                                <th>Total Anggaran</th>
                                <th>Sisa Anggaran</th>
                                <th>Pencairan</th>
                            </tr>
                        </thead>
                        <?php if (!$detail_nota) { ?>
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center">tidak ada data</td>
                                </tr>
                            </tbody>
                        <?php } else { ?>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($detail_nota as $key) : ?>
                                    <tr>
                                        <td> <button type="button" class="btn btn-default btn-sm px-2" onclick="deleteConfirm('<?= base_url() . 'nota/delete_detail/' . encrypt_url($key->id_detail_nota) . '/' . encrypt_url($key->id_nota) ?>')" data-tolltip="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></button></td>
                                        <td><?= $key->kode_rekening_belanja ?></td>
                                        <td><?= $key->uraian_belanja ?></td>
                                        <td><?= rupiah($key->total_anggaran) ?></td>
                                        <td><?= rupiah($key->sisa_anggaran) ?></td>
                                        <td><?= rupiah($key->total_pencairan) ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        <?php } ?>
                        <tfoot>
                            <tr class="bg-light text-bold">
                                <td colspan="3" class="text-center">Jumlah</td>
                                <td><?= rupiah($jumlah_anggaran)  ?></td>
                                <td><?= rupiah($sisa_anggaran)  ?></td>
                                <td><?= rupiah($total_pencairan)  ?></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>

        <!-- /.card -->
    </div>
</div>

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