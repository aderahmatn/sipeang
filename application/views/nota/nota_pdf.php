<?php

$pdf = new FPDF('p', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
$pdf->SetTitle("Nota Pencairan Dinas", 1);

// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string 
$pdf->Cell(35, 7, '', 0, 0, 'C');
$pdf->Cell(150, 7, 'INSPEKTORAT', 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Image(base_url() . "assets/images/logo_kabupatentangerang_perda.png", 10, 10, 25, 0, 'PNG');
$pdf->Cell(35, 7, '', 0, 0, 'C');
$pdf->Cell(162, 7, 'NOTA PENCAIRAN DINAS', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 10, '', 0, 0, 'C');
$pdf->Cell(150, 10, 'Nomor : ' . strtoupper($nota->nomor_nota), 0, 1, 'L');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 12, '', 0, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(35, 6, 'Jenis NPD', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(1, 6, '', 0, 0, 'L');
$pdf->Cell(5, 5, '', 1, 0, 'L');
$pdf->Cell(10, 6, 'Panjar', 0, 0, 'L');
$pdf->Cell(10, 6, '', 0, 0, 'L');
$pdf->Cell(5, 5, '', 1, 0, 'L');
$pdf->Cell(10, 6, 'Tanpa Panjar', 0, 1, 'L');
$pdf->Cell(35, 6, 'PPTK', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(5, 6, strtoupper($nota->nama_lengkap), 0, 1, 'L');
$pdf->Cell(35, 6, 'Program', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(5, 6, strtoupper($nota->uraian_program), 0, 1, 'L');
$pdf->Cell(35, 6, 'Kegiatan', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(5, 6, strtoupper($nota->uraian_kegiatan), 0, 1, 'L');
$pdf->Cell(35, 6, 'Sub Kegiatan', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(5, 6, strtoupper($nota->uraian_subkegiatan), 0, 1, 'L');
$pdf->Cell(35, 6, 'Nomor DPA', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(5, 6, strtoupper($nota->nomor_dpa), 0, 1, 'L');
$pdf->Cell(35, 6, 'Tahun Anggaran', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'L');
$pdf->Cell(5, 6, $nota->tahun_anggaran_nota, 0, 1, 'L');
$pdf->Cell(35, 15, 'Rincian Belanja', 0, 1, 'L');

$pdf->SetFont('Arial', 'b', 7);
$pdf->setFillColor(230, 230, 230);
$pdf->Cell(7, 5, 'No', 1, 0, 'C', TRUE);
$pdf->Cell(25, 5, 'Kode Rekening', 1, 0, 'C', TRUE);
$pdf->Cell(85, 5, 'Uraian', 1, 0, 'C', TRUE);
$pdf->Cell(25, 5, 'Anggaran', 1, 0, 'C', TRUE);
$pdf->Cell(25, 5, 'Sisa Anggaran', 1, 0, 'C', TRUE);
$pdf->Cell(25, 5, 'Pencairan', 1, 1, 'C', TRUE);

$no = 1;
$pdf->SetFont('Arial', '', 7);
foreach ($detail_nota as $key) {
    $pdf->Cell(7, 5, $no++, 1, 0, 'L');
    $pdf->Cell(25, 5, $key->kode_rekening_belanja, 1, 0, 'L');
    $pdf->Cell(85, 5, $key->uraian_belanja, 1, 0, 'L');
    $pdf->Cell(25, 5, rupiah_no_rp($key->total_anggaran), 1, 0, 'R');
    $pdf->Cell(25, 5, rupiah_no_rp($key->sisa_anggaran), 1, 0, 'R');
    $pdf->Cell(25, 5, rupiah_no_rp($key->total_pencairan), 1, 1, 'R');
}
$pdf->SetFont('Arial', 'b', 7);
$pdf->Cell(117, 5, 'Jumlah', 1, 0, 'R');
$pdf->Cell(25, 5, rupiah_no_rp($jumlah_anggaran), 1, 0, 'R');
$pdf->Cell(25, 5, rupiah_no_rp($sisa_anggaran), 1, 0, 'R');
$pdf->Cell(25, 5, rupiah_no_rp($total_pencairan), 1, 1, 'R');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(10, 20, '', 0, 1, 'R');
$pdf->Cell(64, 4, 'Disetujui Oleh', 0, 0, 'C');
$pdf->Cell(64, 4, '', 0, 0, 'R');
$pdf->Cell(64, 4, 'Disiapkan Oleh', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(64, 4, 'Pengguna Anggaran', 0, 0, 'C');
$pdf->Cell(64, 4, '', 0, 0, 'R');
$pdf->Cell(64, 4, 'Pejabat Pelaksana Teknis Kegiatan', 0, 1, 'C');
$pdf->Cell(10, 25, '', 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 4, '', 0, 0, 'C');
$pdf->Cell(50, 6, 'NIP :', 'T', 0, 'L');
$pdf->Cell(75, 4, '', 0, 0, 'R');
$pdf->Cell(50, 6, 'NIP :', 'T', 1, 'L');


$pdf->SetFont('Arial', '', 10);
// $no = 1;
// foreach ($result as $key) {
//     $pdf->Cell(10, 6, $no++, 1, 0, 'C');
//     $pdf->Cell(45, 6, $key->tanggal, 1, 0, 'C');
//     $pdf->Cell(20, 6, $key->jam, 1, 0, 'C');
//     $pdf->Cell(30, 6, $key->kode_alat, 1, 0, 'C');
//     $pdf->Cell(50, 6, $key->nama_alat, 1, 0, 'C');
//     $pdf->Cell(60, 6, $key->operator, 1, 0, 'C');
//     $pdf->Cell(30, 6, $key->tangki, 1, 0, 'C');
//     $pdf->Cell(30, 6, $key->solar_out, 1, 1, 'C');
// }
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(245, 6, 'TOTAL', 1, 0, 'C');
// $pdf->SetFont('Arial', '', 10);

// $pdf->Cell(30, 6, ' $total', 1, 1, 'C');

$pdf->Output();
