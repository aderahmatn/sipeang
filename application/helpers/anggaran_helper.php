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
        return $data['hasil']->jumlah_anggaran;
    } else {
        return 0;
    }
}
function cek_bulan_anggaran_for_form($bulan, $id_belanja)
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

function total_anggaran_per_detail($id_belanja)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('detail_anggaran_m');
    $data['data'] = $CI->detail_anggaran_m->jumlah_anggaran($id_belanja);
    if ($data['data']) {
        return $data['data']->jumlah_anggaran;
    } else {
        return 0;
    }
}
function total_anggaran_per_subkegiatan($id_subkegiatan)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('detail_anggaran_m');
    $data['data'] = $CI->detail_anggaran_m->jumlah_anggaran_per_subkegiatan($id_subkegiatan);
    if ($data['data']) {
        return $data['data']->jumlah_anggaran;
    } else {
        return 0;
    }
}
function total_anggaran_per_subkegiatan_per_bulan($bulan, $id_subkegiatan)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('detail_anggaran_m');
    $data['data'] = $CI->detail_anggaran_m->jumlah_anggaran_per_subkegiatan_per_bulan($bulan, $id_subkegiatan);
    if ($data['data']) {
        return $data['data']->jumlah_anggaran;
    } else {
        return 0;
    }
}

function jumlah_anggaran_per_kegiatan($id_kegiatan)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('detail_anggaran_m');
    $data['data'] = $CI->detail_anggaran_m->jumlah_anggaran_per_kegiatan($id_kegiatan);
    if ($data['data']) {
        return $data['data']->jumlah_anggaran;
    } else {
        return 0;
    }
}
function jumlah_anggaran_per_kegiatan_per_bulan($bulan, $id_kegiatan)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('detail_anggaran_m');
    $data['data'] = $CI->detail_anggaran_m->jumlah_anggaran_per_kegiatan_per_bulan($bulan, $id_kegiatan);
    if ($data['data']) {
        return $data['data']->jumlah_anggaran;
    } else {
        return 0;
    }
}
function jumlah_anggaran_per_program($id_program)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('detail_anggaran_m');
    $data['data'] = $CI->detail_anggaran_m->jumlah_anggaran_per_program($id_program);
    if ($data['data']) {
        return $data['data']->jumlah_anggaran;
    } else {
        return 0;
    }
}
function jumlah_anggaran_per_program_per_bulan($bulan, $id_program)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('detail_anggaran_m');
    $data['data'] = $CI->detail_anggaran_m->jumlah_anggaran_per_program_per_bulan($bulan, $id_program);
    if ($data['data']) {
        return $data['data']->jumlah_anggaran;
    } else {
        return 0;
    }
}
function sisa_anggaran($id_belanja)
{
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('anggaran_m');
    $data['data'] = $CI->anggaran_m->get_sisa_anggaran($id_belanja);
    if ($data['data']) {
        return $data['data']->jumlah_anggaran;
    } else {
        return 0;
    }
}
