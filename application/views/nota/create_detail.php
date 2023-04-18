<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-sm-6">
                    <h1>Tambah Detail Nota</h1>
                    <p class="text-muted">Nomor : <?= strtoupper($nota->nomor_nota) ?></p>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('nota/detail/') . encrypt_url($nota->id_nota)  ?>">Data Nota Pencairan Dinas</a></li>
                        <li class="breadcrumb-item active">Tambah Detail Nota</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Input detail anggaran belanja</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="" autocomplete="off">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <input type="hidden" name="fcreated_by" value="<?= $this->session->userdata('nip'); ?>" style="display: none">
                    <input type="hidden" name="fid_nota" value="<?= encrypt_url($nota->id_nota) ?>" style="display: none">
                    <input type="text" name="ftotal_anggaran_h" id="ftotal_anggaran_h" value="" style="display: none">
                    <input type="text" name="fsisa_anggaran_h" id="fsisa_anggaran_h" value="" style="display: none">
                    <input type="hidden" name="fcreated_date" value="<?= date('y-m-d') ?>" style="display: none">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fanggaran">Anggaran</label>
                            <select class="form-control <?php echo form_error('fanggaran') ? 'is-invalid' : '' ?>" id="fanggaran" name="fanggaran">
                                <option hidden value="" selected>Pilih Anggaran </option>
                                <?php foreach ($anggaran as $key) : ?>
                                    <option value="<?= $key->id_belanja ?>" <?= $this->input->post('fanggaran') == $key->id_belanja ? 'selected' : '' ?>><?= $key->uraian_belanja ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('fanggaran') ?>
                            </div>
                        </div>
                        <div class="loading" id="loading">
                            <img src="<?= base_url() . 'assets/images/loading.gif' ?>" alt="loading">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ftotal_anggaran">Total Anggaran</label>
                                    <input type="text" class="form-control <?= form_error('ftotal_anggaran') ? 'is-invalid' : '' ?>" id="ftotal_anggaran" name="ftotal_anggaran" placeholder="Total anggaran" readonly>
                                    <div class=" invalid-feedback">
                                        <?= form_error('ftotal_anggaran') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fsisa_anggaran">Sisa Anggaran</label>
                                    <input type="text" class="form-control <?= form_error('fsisa_anggaran') ? 'is-invalid' : '' ?>" id="fsisa_anggaran" name="fsisa_anggaran" placeholder="Sisa anggaran" readonly>
                                    <div class=" invalid-feedback">
                                        <?= form_error('fsisa_anggaran') ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fpencairan_anggaran">Pencairan Anggaran</label>
                            <input type="text" class="form-control <?= form_error('fpencairan_anggaran') ? 'is-invalid' : '' ?>" id="fpencairan_anggaran" name="fpencairan_anggaran" value="<?= $this->input->post('fpencairan_anggaran') ?>">
                            <div class=" invalid-feedback">
                                <?= form_error('fpencairan_anggaran') ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        <a href="<?= base_url('nota/detail/') . encrypt_url($nota->id_nota)  ?>" class="btn btn-secondary float-left">Batal</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div><!-- Content Header (Page header) -->
<script>
    $(document).ready(function() {
        var tanpa_rupiah = document.getElementById('fpencairan_anggaran');
        tanpa_rupiah.addEventListener('keyup', function(e) {
            tanpa_rupiah.value = formatRupiah(this.value);
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        $("#loading").hide()
        $("#subloading").hide()
        let anggaran = $("#fanggaran");
        let value;
        $("#fanggaran").change(function() {
            $("#ftotal_anggaran").hide()
            $("#fsisa_anggaran").hide()
            $("#loading").show()
            value = anggaran.find(":selected").val()

            $.ajax({
                type: "GET",
                url: "<?= base_url() . 'nota/get_detail_anggaran/' ?>" + value,
                dataType: "json",
                success: function(response) {
                    $("#loading").hide()
                    $("#ftotal_anggaran").show()
                    $("#fsisa_anggaran").show()
                    $("#ftotal_anggaran_h").val(response.jumlah_anggaran)
                    $("#fsisa_anggaran_h").val(response.sisa_anggaran)
                    $("#ftotal_anggaran").val(formatRupiah(response.jumlah_anggaran))
                    $("#fsisa_anggaran").val(formatRupiah(response.sisa_anggaran))
                    // $("#fkegiatan").removeAttr("disabled")
                    // $("#fkegiatan").html(response.list_kegiatan).show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + "\n" + thrownError); // Munculkan alert error
                }

            })
        })
    })
</script>