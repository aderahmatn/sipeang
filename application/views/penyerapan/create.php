<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1>Tambah Data Penyerapan</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('penyerapan') ?>">Data Anggaran</a></li>
                    <li class="breadcrumb-item active">Tambah Data Penyerapan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <p>Detail Anggaran</p>
            </div>
            <div class="card-body">
                <div class="row py-2">
                    <div class="col-2"><strong>Tahun / Bulan Anggaran </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $anggaran->bulan ?><br></div>
                </div>
                <div class="row py-2 bg-light">
                    <div class="col-2"><strong>Program </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $anggaran->uraian_program ?> <br></div>
                </div>
                <div class="row py-2 ">
                    <div class="col-2"><strong>Kegiatan </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $anggaran->uraian_kegiatan ?> <br></div>
                </div>
                <div class="row py-2 bg-light">
                    <div class="col-2"><strong>Sub Kegiatan </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $anggaran->uraian_program ?> <br></div>
                </div>
                <div class="row py-2">
                    <div class="col-2"><strong>Uraian Anggaran </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $anggaran->uraian_belanja  ?> <br></div>
                </div>
                <div class="row py-2 bg-light">
                    <div class="col-2"><strong>Jumlah Anggaran </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= rupiah($anggaran->anggaran_belanja)  ?> <br></div>
                </div>
                <div class="row py-2">
                    <div class="col-2"><strong>PIC Kegiatan </strong></div>
                    <div class="col-1">
                        <strong>:</strong>
                    </div>
                    <div class="col-8 text-uppercase"><?= $anggaran->nama_lengkap  ?> <br></div>
                </div>
                <hr>
                <form role="form" method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                    <input type="hidden" name="fid_belanja" value="<?= encrypt_url($anggaran->id_belanja)  ?>" style="display: none">
                    <input type="hidden" name="fcreated_date" value="<?= date('y-m-d') ?>" style="display: none">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fjumlah_penyerapan">Jumlah Penyerapan</label>
                                <input type="text" class="form-control <?= form_error('fjumlah_penyerapan') ? 'is-invalid' : '' ?>" id="fjumlah_penyerapan" name="fjumlah_penyerapan" placeholder="Jumlah penyerapan">
                                <div class="invalid-feedback">
                                    <?= form_error('fjumlah_penyerapan') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="flampiran">Lampiran</label>
                                <input type="file" class="form-control <?= form_error('flampiran') ? 'is-invalid' : '' ?>" id="flampiran" name="flampiran">
                                <small class="text-red">
                                    <?php if ($error_upload) {
                                        print $error_upload['error'];
                                    } ?>
                                </small>
                                <small class="text-muted">File lampiran format .pdf dengan ukuran maksimal 10 Mb</small>
                            </div>
                        </div>
                    </div>
            </div>


            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                <a href="<?= base_url('penyerapan') ?>" class="btn btn-secondary float-left">Batal</a>
            </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- page script -->

<script>
    function getHistori(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('anggaran/histori/'); ?>" + id,
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
        $('[data-tolltip="tooltip"]').tooltip({
            trigger: "hover"
        })

    });
</script>