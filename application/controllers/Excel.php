<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('subkegiatan_m');
        $this->load->model('anggaran_m');
        $this->load->helper('penyerapan');
    }


    public function export($tahun = null, $id_subkegiatan = null)
    {
        $data["subkegiatan"] = $this->subkegiatan_m->get_all();
        $data["total_anggaran"] = $this->anggaran_m->get_total_anggaran_laporan($tahun, $id_subkegiatan);
        $data["anggaran"] = $this->anggaran_m->get_anggaran_laporan($tahun, $id_subkegiatan);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $style_program = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $style_detail = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $style_total = [
            'font' => ['bold' => true],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $style_row = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $sheet->setCellValue('A1', "PEMERINTAH KABUPATEN TANGERANG");
        $sheet->mergeCells('A1:P1');
        $sheet->setCellValue('A2', "INSPEKTORAT");
        $sheet->mergeCells('A2:P2');
        $sheet->setCellValue('A3', "RENCANA PENCAIRAN PER BULAN T.A. $tahun");
        $sheet->mergeCells('A3:P3');
        $sheet->getStyle('A1:A3')->getFont()->setBold(true);
        $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A5', "NO");
        $sheet->setCellValue('B5', "KODE REKENING");
        $sheet->setCellValue('C5', "URAIAN");
        $sheet->setCellValue('D5', "JUMLAH ANGGARAN (RP)");
        $sheet->setCellValue('E5', "JANUARI");
        $sheet->setCellValue('F5', "FEBRUARI");
        $sheet->setCellValue('G5', "MARET");
        $sheet->setCellValue('H5', "APRIL");
        $sheet->setCellValue('I5', "MEI");
        $sheet->setCellValue('J5', "JUNI");
        $sheet->setCellValue('K5', "JULI");
        $sheet->setCellValue('L5', "AGUSTUS");
        $sheet->setCellValue('M5', "SEPTEMBER");
        $sheet->setCellValue('N5', "OKTOBER");
        $sheet->setCellValue('O5', "NOVEMBER");
        $sheet->setCellValue('P5', "DESEMBER");

        $sheet->getStyle('A5:P5')->getFont()->setBold(true);
        $sheet->getStyle('D5')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A5')->applyFromArray($style_col);
        $sheet->getStyle('B5')->applyFromArray($style_col);
        $sheet->getStyle('C5')->applyFromArray($style_col);
        $sheet->getStyle('D5')->applyFromArray($style_col);
        $sheet->getStyle('E5')->applyFromArray($style_col);
        $sheet->getStyle('F5')->applyFromArray($style_col);
        $sheet->getStyle('G5')->applyFromArray($style_col);
        $sheet->getStyle('H5')->applyFromArray($style_col);
        $sheet->getStyle('I5')->applyFromArray($style_col);
        $sheet->getStyle('J5')->applyFromArray($style_col);
        $sheet->getStyle('K5')->applyFromArray($style_col);
        $sheet->getStyle('L5')->applyFromArray($style_col);
        $sheet->getStyle('M5')->applyFromArray($style_col);
        $sheet->getStyle('N5')->applyFromArray($style_col);
        $sheet->getStyle('O5')->applyFromArray($style_col);
        $sheet->getStyle('P5')->applyFromArray($style_col);
        $sheet->getRowDimension('5')->setRowHeight(45);
        $sheet->getColumnDimension('A')->setWidth(2.80);
        $sheet->getColumnDimension('B')->setWidth(18);
        $sheet->getColumnDimension('C')->setWidth(70);
        $sheet->getColumnDimension('D')->setWidth(21.67);
        $sheet->getColumnDimension('E')->setWidth(16.5);
        $sheet->getColumnDimension('F')->setWidth(16.5);
        $sheet->getColumnDimension('G')->setWidth(16.5);
        $sheet->getColumnDimension('H')->setWidth(16.5);
        $sheet->getColumnDimension('I')->setWidth(16.5);
        $sheet->getColumnDimension('J')->setWidth(16.5);
        $sheet->getColumnDimension('K')->setWidth(16.5);
        $sheet->getColumnDimension('L')->setWidth(16.5);
        $sheet->getColumnDimension('M')->setWidth(16.5);
        $sheet->getColumnDimension('N')->setWidth(16.5);
        $sheet->getColumnDimension('O')->setWidth(16.5);
        $sheet->getColumnDimension('P')->setWidth(16.5);


        $sheet->setCellValue('A6', "A");
        $sheet->getStyle('A')->getAlignment()->setHorizontaL(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('B6', $data["anggaran"][0]->kode_rekening);
        $sheet->setCellValue('C6', $data["anggaran"][0]->uraian_program);
        $sheet->setCellValue('D6', $data["total_anggaran"]);
        $sheet->setCellValue('E6', "");
        $sheet->setCellValue('F6', "");
        $sheet->setCellValue('G6', "");
        $sheet->setCellValue('H6', "");
        $sheet->setCellValue('I6', "");
        $sheet->setCellValue('J6', "");
        $sheet->setCellValue('K6', "");
        $sheet->setCellValue('L6', "");
        $sheet->setCellValue('M6', "");
        $sheet->setCellValue('N6', "");
        $sheet->setCellValue('O6', "");
        $sheet->setCellValue('P6', "");
        $sheet->getStyle('A6')->applyFromArray($style_program);
        $sheet->getStyle('B6')->applyFromArray($style_program);
        $sheet->getStyle('C6')->applyFromArray($style_program);
        $sheet->getStyle('D6')->applyFromArray($style_program);
        $sheet->getStyle('E6')->applyFromArray($style_program);
        $sheet->getStyle('F6')->applyFromArray($style_program);
        $sheet->getStyle('G6')->applyFromArray($style_program);
        $sheet->getStyle('H6')->applyFromArray($style_program);
        $sheet->getStyle('I6')->applyFromArray($style_program);
        $sheet->getStyle('J6')->applyFromArray($style_program);
        $sheet->getStyle('K6')->applyFromArray($style_program);
        $sheet->getStyle('L6')->applyFromArray($style_program);
        $sheet->getStyle('M6')->applyFromArray($style_program);
        $sheet->getStyle('N6')->applyFromArray($style_program);
        $sheet->getStyle('O6')->applyFromArray($style_program);
        $sheet->getStyle('P6')->applyFromArray($style_program);
        $sheet->getStyle('D6:P6')->getNumberFormat()->setFormatCode('#,##0');


        $sheet->setCellValue('A7', "I.");
        $sheet->getStyle('A')->getAlignment()->setHorizontaL(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('B7', $data["anggaran"][0]->kode_rekening_kegiatan);
        $sheet->setCellValue('C7', $data["anggaran"][0]->uraian_kegiatan);
        $sheet->setCellValue('D7', $data["total_anggaran"]);
        $sheet->setCellValue('E7', "");
        $sheet->setCellValue('F7', "");
        $sheet->setCellValue('G7', "");
        $sheet->setCellValue('H7', "");
        $sheet->setCellValue('I7', "");
        $sheet->setCellValue('J7', "");
        $sheet->setCellValue('K7', "");
        $sheet->setCellValue('L7', "");
        $sheet->setCellValue('M7', "");
        $sheet->setCellValue('N7', "");
        $sheet->setCellValue('O7', "");
        $sheet->setCellValue('P7', "");
        $sheet->getStyle('A7')->applyFromArray($style_program);
        $sheet->getStyle('B7')->applyFromArray($style_program);
        $sheet->getStyle('C7')->applyFromArray($style_program);
        $sheet->getStyle('D7')->applyFromArray($style_program);
        $sheet->getStyle('E7')->applyFromArray($style_program);
        $sheet->getStyle('F7')->applyFromArray($style_program);
        $sheet->getStyle('G7')->applyFromArray($style_program);
        $sheet->getStyle('H7')->applyFromArray($style_program);
        $sheet->getStyle('I7')->applyFromArray($style_program);
        $sheet->getStyle('J7')->applyFromArray($style_program);
        $sheet->getStyle('K7')->applyFromArray($style_program);
        $sheet->getStyle('L7')->applyFromArray($style_program);
        $sheet->getStyle('M7')->applyFromArray($style_program);
        $sheet->getStyle('N7')->applyFromArray($style_program);
        $sheet->getStyle('O7')->applyFromArray($style_program);
        $sheet->getStyle('P7')->applyFromArray($style_program);
        $sheet->getStyle('D7:P7')->getNumberFormat()->setFormatCode('#,##0');

        $sheet->setCellValue('A8', "1");
        $sheet->getStyle('A')->getAlignment()->setHorizontaL(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('B8', $data["anggaran"][0]->kode_rekening_subkegiatan);
        $sheet->setCellValue('C8', $data["anggaran"][0]->uraian_subkegiatan);
        $sheet->setCellValue('D8', $data["total_anggaran"]);
        $sheet->setCellValue('E8', "");
        $sheet->setCellValue('F8', "");
        $sheet->setCellValue('G8', "");
        $sheet->setCellValue('H8', "");
        $sheet->setCellValue('I8', "");
        $sheet->setCellValue('J8', "");
        $sheet->setCellValue('K8', "");
        $sheet->setCellValue('L8', "");
        $sheet->setCellValue('M8', "");
        $sheet->setCellValue('N8', "");
        $sheet->setCellValue('O8', "");
        $sheet->setCellValue('P8', "");
        $sheet->getStyle('A8')->applyFromArray($style_program);
        $sheet->getStyle('B8')->applyFromArray($style_program);
        $sheet->getStyle('C8')->applyFromArray($style_program);
        $sheet->getStyle('D8')->applyFromArray($style_program);
        $sheet->getStyle('E8')->applyFromArray($style_program);
        $sheet->getStyle('F8')->applyFromArray($style_program);
        $sheet->getStyle('G8')->applyFromArray($style_program);
        $sheet->getStyle('H8')->applyFromArray($style_program);
        $sheet->getStyle('I8')->applyFromArray($style_program);
        $sheet->getStyle('J8')->applyFromArray($style_program);
        $sheet->getStyle('K8')->applyFromArray($style_program);
        $sheet->getStyle('L8')->applyFromArray($style_program);
        $sheet->getStyle('M8')->applyFromArray($style_program);
        $sheet->getStyle('N8')->applyFromArray($style_program);
        $sheet->getStyle('O8')->applyFromArray($style_program);
        $sheet->getStyle('P8')->applyFromArray($style_program);
        $sheet->getStyle('D8:P8')->getNumberFormat()->setFormatCode('#,##0');

        $no = "a";
        $numRow = 9;
        foreach ($data["anggaran"] as $key) {
            $sheet->setCellValue('A' . $numRow, $no . ".");
            $sheet->getStyle('A' . $numRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $numRow)->applyFromArray($style_detail);
            $sheet->setCellValue('B' . $numRow, $key->kode_rekening_belanja);
            $sheet->getStyle('B' . $numRow)->applyFromArray($style_detail);
            $sheet->setCellValue('C' . $numRow, $key->uraian_belanja);
            $sheet->getStyle('C' . $numRow)->applyFromArray($style_detail);
            $sheet->setCellValue('D' . $numRow, $key->anggaran_belanja);
            $sheet->getStyle('D' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('D' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('E' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-01'));
            $sheet->getStyle('E' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('E' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('F' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-02'));
            $sheet->getStyle('F' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('F' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('G' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-03'));
            $sheet->getStyle('G' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('G' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('H' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-04'));
            $sheet->getStyle('H' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('H' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('I' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-05'));
            $sheet->getStyle('I' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('I' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('J' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-06'));
            $sheet->getStyle('J' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('J' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('K' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-07'));
            $sheet->getStyle('K' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('K' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('L' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-08'));
            $sheet->getStyle('L' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('L' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('M' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-09'));
            $sheet->getStyle('M' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('M' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('N' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-10'));
            $sheet->getStyle('N' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('N' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('O' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-11'));
            $sheet->getStyle('O' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('O' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('P' . $numRow, penyerapan($key->id_belanja, $key->tahun_anggaran . '-12'));
            $sheet->getStyle('P' . $numRow)->applyFromArray($style_detail);
            $sheet->getStyle('P' . $numRow)->getNumberFormat()->setFormatCode('#,##0');

            $no++;
            $numRow++;
        }

        $sheet->setCellValue('A' . $numRow, "Total ");
        $sheet->mergeCells('A' . $numRow . ':C' . $numRow);
        $sheet->getStyle('A' . $numRow . ':C' . $numRow)->applyFromArray($style_program);
        $sheet->setCellValue('D' . $numRow, $data["total_anggaran"]);
        $sheet->getStyle('D' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('D' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('E' . $numRow, total_per_bulan($tahun . "-01", $id_subkegiatan));
        $sheet->getStyle('E' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('E' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('F' . $numRow, total_per_bulan($tahun . "-02", $id_subkegiatan));
        $sheet->getStyle('F' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('F' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('G' . $numRow, total_per_bulan($tahun . "-03", $id_subkegiatan));
        $sheet->getStyle('G' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('G' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('H' . $numRow, total_per_bulan($tahun . "-04", $id_subkegiatan));
        $sheet->getStyle('H' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('H' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('I' . $numRow, total_per_bulan($tahun . "-05", $id_subkegiatan));
        $sheet->getStyle('I' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('I' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('J' . $numRow, total_per_bulan($tahun . "-06", $id_subkegiatan));
        $sheet->getStyle('J' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('J' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('K' . $numRow, total_per_bulan($tahun . "-07", $id_subkegiatan));
        $sheet->getStyle('K' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('K' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('L' . $numRow, total_per_bulan($tahun . "-08", $id_subkegiatan));
        $sheet->getStyle('L' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('L' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('M' . $numRow, total_per_bulan($tahun . "-09", $id_subkegiatan));
        $sheet->getStyle('M' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('M' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('N' . $numRow, total_per_bulan($tahun . "-10", $id_subkegiatan));
        $sheet->getStyle('N' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('N' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('O' . $numRow, total_per_bulan($tahun . "-11", $id_subkegiatan));
        $sheet->getStyle('O' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('O' . $numRow)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->setCellValue('P' . $numRow, total_per_bulan($tahun . "-12", $id_subkegiatan));
        $sheet->getStyle('P' . $numRow)->applyFromArray($style_total);
        $sheet->getStyle('P' . $numRow)->getNumberFormat()->setFormatCode('#,##0');


        $writer = new Xlsx($spreadsheet);
        $filename = 'Rencana Pencairan Per Bulan Tahun Anggaran ' . $tahun;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
