<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<!-- <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-paper-plane"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Permintaan Aset</span>
                        <span class="info-box-number">4</span>
                        <span class="text-sm text-right"><a href="" class="text-primary">More Info</a></span>

                    </div>

                </div>

            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-secondary elevation-1"> <i class="fa fa-wrench"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Perbaikan Aset</span>
                        <span class="info-box-number">2</span>
                        <span class="text-sm text-right"><a href="" class="text-primary">More Info</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Rekap Aset</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1"> <strong>U</strong></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><strong>Aset In Use</strong></span>
                                        <span class="info-box-number">170</span>
                                        <span class="text-sm text-right"><a href="" class="text-primary">More Info</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-primary elevation-1"> <strong>D</strong></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><strong>Aset Damage</strong></span>
                                        <span class="info-box-number">90</span>
                                        <span class="text-sm text-right"><a href="" class="text-primary">More Info</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-warning elevation-1"> <strong>A</strong></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><strong>Aset Absolute</strong></span>
                                        <span class="info-box-number">190</span>
                                        <span class="text-sm text-right"><a href="" class="text-primary">More Info</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> -->


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