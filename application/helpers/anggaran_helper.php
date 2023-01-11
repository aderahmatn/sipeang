<?php

function total_anggaran($id_belanja)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('detail_anggaran_m');

    // Call a function of the model
    $data = $CI->detail_anggaran_m->get_total_anggaran_pertahun($id_belanja);
    $hasil = intval($data);
    if ($hasil == 0) {
        return $hasil;
    } else {
        return $hasil;
    }
}
function cek_bulan_anggaran($bulan, $id_belanja)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('detail_anggaran_m');

    // Call a function of the model
    $data['hasil'] = $CI->detail_anggaran_m->cek_bulan($bulan, $id_belanja);

    if ($data['hasil']) {
        return 1;
    } else {
        return 0;
    }
}
