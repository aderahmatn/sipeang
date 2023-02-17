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
function cek_bulan_penyerapan($id_detail_belanja)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('penyerapan_m');

    // Call a function of the model
    $data = $CI->penyerapan_m->cek_bulan_penyerapan($id_detail_belanja);
    if ($data) {
        return 1;
    } else {
        return 0;
    }
}
function total_penyerapan_by_id_belanja($id_belanja)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('penyerapan_m');

    // Call a function of the model

    $data = $CI->penyerapan_m->get_total_by_id_belanja($id_belanja);
    if ($data) {
        return $data;
    } else {
        return 0;
    }
}
function get_total_penyerapan_by_detail($tgl_awal, $gl_akhir, $id_detail_belanja)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('penyerapan_m');

    // Call a function of the model

    $data = $CI->penyerapan_m->get_total_by_range($tgl_awal, $gl_akhir, $id_detail_belanja);
    if ($data) {
        return $data;
    } else {
        return 0;
    }
}
function get_total_penyerapan_by_subkegiatan($tgl_awal, $gl_akhir, $id_subkegiatan)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('penyerapan_m');

    // Call a function of the model

    $data = $CI->penyerapan_m->get_total_by_range_by_subkegiatan($tgl_awal, $gl_akhir, $id_subkegiatan);
    if ($data) {
        return $data;
    } else {
        return 0;
    }
}
function get_total_penyerapan_by_kegiatan($tgl_awal, $gl_akhir, $id_kegiatan)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('penyerapan_m');

    // Call a function of the model

    $data = $CI->penyerapan_m->get_total_by_range_by_kegiatan($tgl_awal, $gl_akhir, $id_kegiatan);
    if ($data) {
        return $data;
    } else {
        return 0;
    }
}
function get_total_penyerapan_by_program($tgl_awal, $gl_akhir, $id_program)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('penyerapan_m');

    // Call a function of the model

    $data = $CI->penyerapan_m->get_total_by_range_by_program($tgl_awal, $gl_akhir, $id_program);
    if ($data) {
        return $data;
    } else {
        return 0;
    }
}
