<?php
function penyerapan($id, $bulan)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('penyerapan_m');

    // Call a function of the model
    $data = $CI->penyerapan_m->get_penyerapan_laporan($id, $bulan);
    $hasil = intval($data);
    if ($hasil == 0) {
        return $hasil;
    } else {
        return $hasil;
    }
}
function total_per_bulan($bulan, $id_subkegiatan)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('penyerapan_m');

    // Call a function of the model
    $data = $CI->penyerapan_m->get_total_penyerapan_perbulan($bulan, $id_subkegiatan);
    $hasil = intval($data);
    if ($hasil == 0) {
        return $hasil;
    } else {
        return $hasil;
    }
}
