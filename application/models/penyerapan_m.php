<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penyerapan_m extends CI_Model
{
    private $_table = "penyerapan";

    public $id_penyerapan;
    public $id_belanja;
    public $jumlah_penyerapan;
    public $lampiran;
    public $created_date;
    public $created_by;
    public $deleted;


    public function rules()
    {
        return [
            [
                'field' => 'fjumlah_penyerapan',
                'label' => 'Jumlah penyerapan',
                'rules' => 'required'
            ],
        ];
    }

    public function add($post, $file)
    {
        $post = $this->input->post();
        $this->id_belanja = decrypt_url($post['fid_belanja']);
        $this->jumlah_penyerapan = $post['fjumlah_penyerapan'];
        $this->lampiran = $file;
        $this->created_date = $post['fcreated_date'];
        $this->created_by = $post['fcreated_by'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
}

/* End of file penyerapan_m.php */
