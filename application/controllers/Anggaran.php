<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('kegiatan_m');
        $this->load->model('subkegiatan_m');
        $this->load->model('anggaran_m');
        $this->load->model('apbd_m');
        $this->load->model('anggaranupdated_m');
        $this->load->model('Detail_anggaran_m');
        $this->load->model('Detail_anggaran_edited_m');
        $this->load->helper('bulan');
        $this->load->helper('anggaran');
        $this->load->helper('penyerapan');
    }

    public function index()
    {
        $data['subkegiatan'] = $this->subkegiatan_m->get_all();
        $data['anggaran'] = $this->anggaran_m->get_all();
        $this->template->load('shared/index', 'anggaran/index', $data);
    }
    public function insert_kegiatan($id_program = null, $tahun = null)
    {
        $data = $this->anggaran_m->get_kegiatan_by_tahun($id_program, $tahun);
        foreach ($data as $key) :

?>
            <tr class="text-bold" id="kegiatan<?= $key->id_kegiatan ?>" style="background-color: #fbf8d5;">
                <td><?= $key->kode_rekening_kegiatan ?></td>
                <td><?= ucwords($key->uraian_kegiatan) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan($key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(1, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(2, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(3, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(4, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(5, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(6, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(7, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(8, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(9, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(10, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(11, $key->id_kegiatan)) ?></td>
                <td><?= rupiah_no_rp(jumlah_anggaran_per_kegiatan_per_bulan(12, $key->id_kegiatan)) ?></td>
            </tr>
            <script>
                getSubkegiatan(<?= $key->id_kegiatan ?>, <?= $key->id_kegiatan ?>);
            </script>
        <?php endforeach;
    }

    public function insert_subkegiatan($id_program = null, $tahun = null)
    {
        $data = $this->anggaran_m->get_subkegiatan_by_tahun($id_program, $tahun);
        foreach ($data as $key) :

        ?>

            <tr id="subkegiatan<?= $key->id_subkegiatan ?>" style="background-color: #d2fbd3;">
                <td><i><?= $key->kode_rekening_subkegiatan ?></i></td>
                <td><i><?= ucwords($key->uraian_subkegiatan) ?></i></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan($key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(1, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(2, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(3, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(4, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(5, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(6, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(7, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(8, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(9, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(10, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(11, $key->id_subkegiatan)) ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_subkegiatan_per_bulan(12, $key->id_subkegiatan)) ?></td>

            </tr>
            <script>
                getDetailBelanja(<?= $key->id_subkegiatan ?>, <?= $key->id_subkegiatan ?>)
            </script>
        <?php endforeach;
    }
    public function insert_detail_anggaran($id_program = null, $tahun = null)
    {
        $data = $this->anggaran_m->get_detail_belanja_by_tahun($id_program, $tahun);
        foreach ($data as $key) :

        ?>

            <tr style="background-color: #ffcfcf;">
                <td><?= $key->kode_rekening_belanja ?></td>
                <td><?= ucwords($key->uraian_belanja)  ?></td>
                <td><?= rupiah_no_rp(total_anggaran_per_detail($key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(1, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(2, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(3, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(4, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(5, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(6, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(7, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(8, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(9, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(10, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(11, $key->id_belanja)) ?></td>
                <td><?= rupiah_no_rp(cek_bulan_anggaran(12, $key->id_belanja)) ?></td>
            </tr>
        <?php endforeach;
    }

    public function create($id = null)
    {
        $anggaran  = $this->anggaran_m;
        $anggaran  = $this->anggaran_m;
        $validation = $this->form_validation;
        $validation->set_rules($anggaran->rules());
        if ($validation->run() == FALSE) {
            $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
            $data['apbd'] = $this->apbd_m->get_all();
            $this->template->load('shared/index', 'anggaran/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $anggaran->Add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data  anggaran berhasil disimpan!');
                // redirect('anggaran', 'refresh');
                $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
                $data['anggaran'] = $this->anggaran_m->get_by_subkegiatan(decrypt_url($id));
                $data['id'] = decrypt_url($id);
                $id = $id;
                redirect('anggaran/detail/' . $id, 'refresh');
            }
        }
    }
    public function detail($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        if (!$data['subkegiatan']) {
            $this->session->set_flashdata('error', 'Data anggaran tidak ditemukan!');
            redirect('anggaran', 'refresh');
        }
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        $data['anggaran'] = $this->anggaran_m->get_by_subkegiatan(decrypt_url($id));
        $data['id'] = decrypt_url($id);
        $this->template->load('shared/index', 'anggaran/detail', $data);
    }
    public function edit($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $anggaran = $this->anggaran_m;
        $validation = $this->form_validation;
        $validation->set_rules($anggaran->rules());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->anggaran_m->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Anggaran Berhasil Diupdate!');
                redirect('anggaran', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data anggaran Tidak Diupdate!');
                redirect('anggaran', 'refresh');
            }
        }
        $data['anggaran'] = $this->anggaran_m->get_by_id(decrypt_url($id));
        if (!$data['anggaran']) {
            $this->session->set_flashdata('error', 'Data anggaran Tidak ditemukan!');
            redirect('anggaran', 'refresh');
        }
        $data['apbd'] = $this->apbd_m->get_all();
        $this->template->load('shared/index', 'anggaran/edit', $data);
    }
    public function edit_detail($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $anggaran = $this->Detail_anggaran_m;
        $validation = $this->form_validation;
        $validation->set_rules($anggaran->rules_edit_anggaran());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->Detail_anggaran_m->update($post);
            $this->Detail_anggaran_edited_m->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Anggaran Berhasil Diupdate!');
                redirect('anggaran', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data anggaran Tidak Diupdate!');
                redirect('anggaran', 'refresh');
            }
        }
        $data['anggaran'] = $this->Detail_anggaran_m->get_by_id(decrypt_url($id));
        if (!$data['anggaran']) {
            $this->session->set_flashdata('error', 'Data anggaran Tidak ditemukan!');
            redirect('anggaran', 'refresh');
        }
        $data['apbd'] = $this->apbd_m->get_all();
        $this->template->load('shared/index', 'anggaran/edit_detail', $data);
    }
    public function tambah_anggaran($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $detailAnggaran = $this->Detail_anggaran_m;
        $validation = $this->form_validation;
        $validation->set_rules($detailAnggaran->rules_tambah_anggaran());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->Detail_anggaran_m->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Anggaran berhasil ditambahkan!');
                redirect('anggaran', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data anggaran tidak berhasil ditambahkan!');
                redirect('anggaran', 'refresh');
            }
        }
        $data['anggaran'] = $this->anggaran_m->get_by_id(decrypt_url($id));
        if (!$data['anggaran']) {
            $this->session->set_flashdata('error', 'Data anggaran Tidak ditemukan!');
            redirect('anggaran', 'refresh');
        }
        $data['apbd'] = $this->apbd_m->get_all();
        $this->template->load('shared/index', 'anggaran/create_anggaran', $data);
    }
    public function detail_perencanaan($id)
    {
        $data = $this->Detail_anggaran_m->get_all($id);
        if ($data) { ?>
            <p>Uraian Anggaran :<b> <?= $data[0]->uraian_belanja; ?></b></p>
            <p>Tahun Anggaran :<b> <?= $data[0]->tahun_anggaran; ?></b></p>
        <?php } else { ?>
            <p class="text-muted">Belum ada data</p>
        <?php  }
        ?>
        <table class="table table-bordered table-striped text-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Anggaran</th>
                    <th>APBD</th>
                    <th style="width: 15%">Modify</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;

                foreach ($data as $key) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= bulan($key->bulan) ?></td>
                        <td><?= rupiah($key->jumlah_anggaran) ?></td>
                        <td><?= strtoupper($key->nama_apbd) ?></td>
                        <td><a href=" <?= base_url('anggaran/edit_detail/') . encrypt_url($key->id_detail_anggaran)  ?>"><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-detail" data-tolltip="tooltip" data-placement="top" <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt" data-tolltip="tooltip" data-placement="top" title="Edit"></i>
                                </button>
                            </a>
                            <a class="btn btn-default btn-sm" data-toggle="modal" onclick="getHistory(<?= $key->id_detail_anggaran ?>)" href="#modal_history" data-tolltip="tooltip" data-placement="top" title="History"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
        <?php }
    public function detail_perencanaan_for_penyerapan($id)
    {
        $data = $this->Detail_anggaran_m->get_all($id);
        if ($data) { ?>
            <p>Uraian Anggaran :<b> <?= $data[0]->uraian_belanja; ?></b></p>
            <p>Tahun Anggaran :<b> <?= $data[0]->tahun_anggaran; ?></b></p>
        <?php } else { ?>
            <p class="text-muted">Belum ada data</p>
        <?php  }
        ?>
        <table class="table table-bordered table-striped text-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Anggaran</th>
                    <th>APBD</th>
                    <th style="width: 15%">Pilih</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;

                foreach ($data as $key) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= bulan($key->bulan) ?></td>
                        <td><?= rupiah($key->jumlah_anggaran) ?></td>
                        <td><?= strtoupper($key->nama_apbd) ?></td>
                        <td>
                            <?php if (cek_bulan_penyerapan($key->id_detail_anggaran) == 1) { ?>
                                <span class="badge badge-success">Sudah terserap</span>
                            <?php } else { ?>
                                <a class="btn btn-default btn-sm" href="<?= base_url('penyerapan/create/') . encrypt_url($key->id_detail_anggaran)  ?>" data-tolltip="tooltip" data-placement="top" title="Pilih bulan penyerapan"><i class="fas fa-check"></i> Pilih</a>
                            <?php } ?>

                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
        <?php }
    public function get_history($id)
    {
        $data = $this->Detail_anggaran_edited_m->get_all($id);
        if (!$data) { ?>
            <p class="text-center text-muted">Belum ada data</p>
        <?php } else { ?>
            <table class="table table-bordered table-striped text-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggaran</th>
                        <th>APBD</th>
                        <th>Tanggal Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;

                    foreach ($data as $key) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= rupiah($key->jumlah_anggaran_edited) ?></td>
                            <td><?= strtoupper($key->nama_apbd) ?></td>
                            <td><?= $key->edited_date ?>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        <?php }
    }
    public function test($id = null)
    {
        $data['data'] = $this->anggaran_m->get_sisa_anggaran(18);
        print $data['data']->jumlah_anggaran;
    }
    public function detail_dashboard($id = null)
    {
        $data['data'] = $this->anggaran_m->get_by_id($id); ?>
        <div class="row py-2 bg-light">
            <div class="col-2"><strong>Program </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= $data['data']->uraian_program ?> <br></div>
        </div>
        <div class="row py-2">
            <div class="col-2"><strong>Kegiatan </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= $data['data']->uraian_kegiatan ?> <br></div>
        </div>
        <div class="row py-2 bg-light">
            <div class="col-2"><strong>Sub Kegiatan </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= $data['data']->uraian_subkegiatan ?> <br></div>
        </div>
        <div class="row py-2 ">
            <div class="col-2"><strong>PIC </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= $data['data']->nama_lengkap ?> <br></div>
        </div>
        <div class="row py-2 bg-light">
            <div class="col-2"><strong>Total Anggaran </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= rupiah($data['data']->anggaran_belanja)  ?> <br></div>
        </div>
        <!-- <div class="row py-2">
            <div class="col-2"><strong>Total Penyerapan </strong></div>
            <div class="col-1">
                <strong>:</strong>
            </div>
            <div class="col-8 text-uppercase"><?= rupiah($data['data']->jumlah_penyerapan)  ?> <br></div>
        </div> -->
<?php }
}

/* End of file Anggaran.php */