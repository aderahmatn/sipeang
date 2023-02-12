<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyerapan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('penyerapan_m');

        $this->load->model('subkegiatan_m');
        $this->load->model('anggaran_m');
        $this->load->model('detail_anggaran_m');
        $this->load->helper('anggaran');
        $this->load->helper('bulan');
        $this->load->helper('penyerapan_helper');
    }

    public function insert_kegiatan($tgl_awal, $tgl_akhir, $id_program)
    {
        $data = $this->penyerapan_m->get_kegiatan_by_date_range($tgl_awal, $tgl_akhir, $id_program);
        foreach ($data as $key) : ?>
            <tr id="kegiatan<?= $key->id_kegiatan ?>">
                <td><?= $key->kode_rekening_kegiatan ?></td>
                <td><?= $key->uraian_kegiatan ?></td>
                <td><?= rupiah(jumlah_anggaran_per_kegiatan($key->id_kegiatan)) ?></td>
            </tr>
            <script>
                subKegiatan("<?= $tgl_awal ?>", "<?= $tgl_akhir ?>", <?= $key->id_kegiatan ?>);
            </script>
        <?php endforeach;
    }

    public function insert_subkegiatan($tgl_awal, $tgl_akhir, $id_kegiatan)
    {
        $data = $this->penyerapan_m->get_subkegiatan_by_date_range($tgl_awal, $tgl_akhir, $id_kegiatan);
        foreach ($data as $key) : ?>
            <tr id="subkegiatan<?= $key->id_subkegiatan ?>">
                <td><?= $key->kode_rekening_subkegiatan ?></td>
                <td><?= ucwords($key->uraian_subkegiatan) ?></td>
                <td><?= rupiah(total_anggaran_per_subkegiatan($key->id_subkegiatan)) ?></td>
            </tr>
            <script>
                detail("<?= $tgl_awal ?>", "<?= $tgl_akhir ?>", <?= $key->id_subkegiatan ?>);
            </script>
        <?php endforeach;
    }
    public function insert_detail($tgl_awal, $tgl_akhir, $id_subkegiatan)
    {
        $data = $this->penyerapan_m->get_detail_by_date_range($tgl_awal, $tgl_akhir, $id_subkegiatan);
        foreach ($data as $key) : ?>
            <tr>
                <td><?= $key->kode_rekening_belanja ?></td>
                <td><?= ucwords($key->uraian_belanja) ?></td>
                <td><?= rupiah(total_anggaran_per_detail($key->id_belanja)) ?></td>
            </tr>
        <?php endforeach;
    }

    public function index()
    {
        $data['subkegiatan'] = $this->anggaran_m->get_subkegiatan();
        $this->template->load('shared/index', 'penyerapan/index', $data);
    }
    public function detail($id = null)
    {
        if (!isset($id)) redirect('anggaran');
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        if (!$data['subkegiatan']) {
            $this->session->set_flashdata('error', 'Data anggaran tidak ditemukan!');
            redirect('penyerapan', 'refresh');
        }
        $data['subkegiatan'] = $this->subkegiatan_m->get_by_id(decrypt_url($id));
        // $data['total_penyerapan'] = $this->penyerapan_m->get_total_by_subkegiatan(decrypt_url($id));
        $data['penyerapan'] = $this->penyerapan_m->get_all_by_subkegiatan(decrypt_url($id));
        $data['anggaran'] = $this->anggaran_m->get_all_by_subkegiatan_penyerapan(decrypt_url($id));
        $data['id'] = decrypt_url($id);
        // $data['total_anggaran'] = $this->anggaran_m->get_total_by_subkegiatan(decrypt_url($id));
        $this->template->load('shared/index', 'penyerapan/detail', $data);
    }
    public function create($id = null)
    {
        $anggaran = $this->anggaran_m;
        $penyerapan  = $this->penyerapan_m;
        $validation = $this->form_validation;
        $validation->set_rules($penyerapan->rules());
        if ($validation->run() == FALSE) {
            $data['error_upload'] = null;
            $data['error_penyerapan'] = null;
            $data['anggaran'] = $this->detail_anggaran_m->get_by_id(decrypt_url($id));
            $data['sisa'] = $this->detail_anggaran_m->get_sisa_anggaran($data['anggaran']->id_belanja, $data['anggaran']->bulan);
            $this->template->load('shared/index', 'penyerapan/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $data['anggaran'] = $this->detail_anggaran_m->get_by_id(decrypt_url($id));
            $data['sisa'] = $this->detail_anggaran_m->get_sisa_anggaran($data['anggaran']->id_belanja, $data['anggaran']->bulan);
            $anggaran = $data['anggaran']->jumlah_anggaran + $data['sisa']->sisa_anggaran;

            if ($anggaran - str_replace(".", "", $post['fjumlah_penyerapan']) < 0) {
                $data['error_upload'] = null;
                $data['error_penyerapan'] = 'Anggaran tidak mencukupi.';
                $data['anggaran'] = $this->detail_anggaran_m->get_by_id(decrypt_url($id));
                $data['sisa'] = $this->detail_anggaran_m->get_sisa_anggaran($data['anggaran']->id_belanja, $data['anggaran']->bulan);
                $this->template->load('shared/index', 'penyerapan/create', $data);
            } else {

                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 11000;
                $config['encrypt_name']            = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('flampiran')) {
                    $data['error_penyerapan'] = null;
                    $data['error_jumlah'] = null;
                    $data['anggaran'] = $this->detail_anggaran_m->get_by_id(decrypt_url($id));
                    $data['sisa'] = $this->detail_anggaran_m->get_sisa_anggaran($data['anggaran']->id_belanja, $data['anggaran']->bulan);
                    $data['error_upload'] = array('error' => $this->upload->display_errors());
                    $this->template->load('shared/index', 'penyerapan/create', $data);
                } else {
                    $post = $this->input->post(null, TRUE);
                    $file = $this->upload->data("file_name");
                    $sisa_anggaran = $data['anggaran']->jumlah_anggaran - str_replace(".", "", $post['fjumlah_penyerapan']);
                    $this->detail_anggaran_m->update_sisa_anggaran(decrypt_url($id), $sisa_anggaran);
                    $penyerapan->Add($post, $file);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data penyerapan berhasil disimpan!');
                        redirect('penyerapan', 'refresh');
                    }
                }
            }
        }
    }
    function upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 11000;
        $config['encrypt_name']            = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('flampiran')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('form_upload', $error);
        } else {
            $data['nama_berkas'] = $this->upload->data("file_name");
            $data['keterangan_berkas'] = $this->input->post('keterangan_berkas');
            $data['tipe_berkas'] = $this->upload->data('file_ext');
            $data['ukuran_berkas'] = $this->upload->data('file_size');
            $this->db->insert('tb_berkas', $data);
            redirect('upload');
        }
    }
    public function histori($id)
    {
        $data = $this->penyerapan_m->get_by_anggaran($id);
        $jml = count($data);
        if ($jml == 0) { ?>
            <div class="text-center">
                <p>Data penyerapan belum tersedia.</p>
            </div>
        <?php } else {
        ?>
            <table id="TabelUser" class="table table-bordered table-striped text-sm">
                <thead>
                    <tr>
                        <th>Bulan Anggaran</th>
                        <th>Tanggal Penyerapan</th>
                        <th>PIC Penyerapan</th>
                        <th>Jumlah Penyerapan</th>
                        <th>Lampiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $key) {
                    ?>
                        <tr>
                            <td><?= bulan($key->bulan)  ?></td>
                            <td><?= $key->tanggal_penyerapan ?></td>
                            <td><?= strtoupper($key->nama_lengkap) ?></td>
                            <td><?= rupiah($key->jumlah_penyerapan)  ?></td>
                            <td><a href="<?= base_url('uploads/') . $key->lampiran ?>" target="_blank" class="text-blue">Lihat Lampiran</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
<?php }
    }
    public function test($id_detail_anggaran)
    {
        $data = $this->penyerapan_m->cek_bulan_penyerapan($id_detail_anggaran);
        if ($data) {
            print 1;
        } else {
            print 0;
        }
    }
}

/* End of file Penyerapan.php */
