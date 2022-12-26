<?php
$pdf = new FPDF('l', 'mm', array(210, 520));
// membuat halaman baru
$pdf->AddPage();
$pdf->SetTitle("RENCANA PENCAIRAN PER BULAN T.A. $tahun", 1);

// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string 
$pdf->Cell(520, 7, 'PEMERINTAH KABUPATEN TANGERANG', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(520, 7, 'INSPEKTORAT', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$pdf->Cell(520, 7, 'RENCANA PENCAIRAN PER BULAN T.A. ' . $tahun, 0, 1, 'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(6, 10, 'NO', 1, 0, 'C');
$pdf->Cell(30, 10, 'KODE REKENING', 1, 0, 'C');
$pdf->Cell(125, 10, 'URAIAN', 1, 0, 'C');
$pdf->Cell(35, 10, 'JUMLAH ANGGARAN (Rp)', 1, 0, 'C');
$pdf->Cell(25, 10, 'JANUARI', 1, 0, 'C');
$pdf->Cell(25, 10, 'FEBRUARI', 1, 0, 'C');
$pdf->Cell(25, 10, 'MARET', 1, 0, 'C');
$pdf->Cell(25, 10, 'APRIL', 1, 0, 'C');
$pdf->Cell(25, 10, 'MEI', 1, 0, 'C');
$pdf->Cell(25, 10, 'JUNI', 1, 0, 'C');
$pdf->Cell(25, 10, 'JULI', 1, 0, 'C');
$pdf->Cell(25, 10, 'AGUSTUS', 1, 0, 'C');
$pdf->Cell(25, 10, 'SEPTEMBER', 1, 0, 'C');
$pdf->Cell(25, 10, 'OKTOBER', 1, 0, 'C');
$pdf->Cell(25, 10, 'NOVEMBER', 1, 0, 'C');
$pdf->Cell(25, 10, 'DESEMBER', 1, 1, 'C');


// program
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(6, 7, "A", 1, 0, 'C');
$pdf->Cell(30, 7, $anggaran[0]->kode_rekening, 1, 0, 'C');
$pdf->Cell(125, 7, $anggaran[0]->uraian_program, 1, 0,);
$pdf->Cell(35, 7, rupiah_no_rp($total_anggaran), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-01", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-02", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-03", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-04", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-05", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-06", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-07", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-08", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-09", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-10", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-11", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-12", $id_subkegiatan)), 1, 1, 'R');
// kegiatan
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(6, 7, "A", 1, 0, 'C');
$pdf->Cell(30, 7, $anggaran[0]->kode_rekening_kegiatan, 1, 0, 'C');
$pdf->Cell(125, 7, $anggaran[0]->uraian_kegiatan, 1, 0,);
$pdf->Cell(35, 7, rupiah_no_rp($total_anggaran), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-01", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-02", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-03", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-04", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-05", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-06", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-07", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-08", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-09", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-10", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-11", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-12", $id_subkegiatan)), 1, 1, 'R');
// sub kegiatan
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(6, 7, "A", 1, 0, 'C');
$pdf->Cell(30, 7, $anggaran[0]->kode_rekening_subkegiatan, 1, 0, 'C');
$pdf->Cell(125, 7, $anggaran[0]->uraian_subkegiatan, 1, 0,);
$pdf->Cell(35, 7, rupiah_no_rp($total_anggaran), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-01", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-02", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-03", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-04", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-05", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-06", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-07", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-08", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-09", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-10", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-11", $id_subkegiatan)), 1, 0, 'R');
$pdf->Cell(25, 7, rupiah_no_rp(total_per_bulan($tahun . "-12", $id_subkegiatan)), 1, 1, 'R');


$pdf->SetFont('Arial', '', 8);
$no = 1;
foreach ($anggaran  as $key) {
    $pdf->Cell(6, 7, $no++, 1, 0, 'C');
    $pdf->Cell(30, 7, $key->kode_rekening_belanja, 1, 0, 'C');
    $pdf->Cell(125, 7, $key->uraian_belanja, 1, 0,);
    $pdf->Cell(35, 7, rupiah_no_rp($key->anggaran_belanja), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-01')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-02')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-03')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-04')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-05')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-06')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-07')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-08')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-09')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-10')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-11')), 1, 0, 'R');
    $pdf->Cell(25, 7, rupiah_no_rp(penyerapan($key->id_belanja, $tahun . '-12')), 1, 1, 'R');
}

$pdf->Output();
