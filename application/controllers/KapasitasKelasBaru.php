<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KapasitasKelasBaru extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        //load libary pagination
        $this->load->library('pagination');
        //load the department_model
        $this->load->model('list_model');
        $this->load->model('KapasitasKelasBaru_Model');
        $this->load->library('excel');
    }

    public function index() {
        $data['data'] = $this->list_model->get_kapasitaskelas_list();
        $data['title'] = 'Kapasitas Kelas Baru';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('Kapasitas_Kelas_Baru/index', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function isi($id) {
        $data['makul'] = $this->KapasitasKelasBaru_Model->cariMakul($id);
        // $data['mahasiswa'] = $this->KapasitasKelasBaru_Model->mahasiswaPresensi($id);
        $data['data'] = $this->list_model->get_kapasitaskelas_list();
        $data['title'] = 'Detail Kapasitas Kelas ';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('Kapasitas_Kelas_Baru/isi', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function cetakAll() {
        var_dump($this->session->tempdata('item1'));
        $data = $this->session->tempdata('item1');
        $data = (array) $data;
        $excel = new PHPExcel();
        // print $data['data'];die;
        $excel->getProperties()->setTitle("Kapasitas Kelas Baru");

        $style_col = array(
            'font' => array('bold' => true, 'name' => 'Times New Roman', 'size' => 12),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $styleArray = array(
            'font' => array(
                'size' => 12,
                'name' => 'Times New Roman'
        ));
        $style_col1 = array(
            'font' => array('name' => 'Times New Roman'),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "KAPASITAS KELAS BARU");
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Times New Roman');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "MATA KULIAH");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "JUMLAH KAPASITAS");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "BELUM MENGAMBIL");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "MENGULANG");
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col1);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col1);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col1);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col1);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col1);
        // $excel->setActiveSheetIndex(0)->setCellValue('A3', "MAHASISWA AKTIF PER ANGKATAN");
        // $angkatan = $this->kapasitas_model->angkatan();
        // $makul = $this->kapasitas_model->idMakul($data);
        // $data = $this->session->userdata('matkul');
        // $data['matkul'] = $this->session->userdata('matkul');
        // $data['jumlahTotal'] = $this->session->userdata('jumlahTotal');
        // $data['jumlahMengulang'] = $this->session->userdata('jumlahMengulang');
        // $data['jumlahBelumMengambil'] = $this->session->userdata('jumlahBelumMengambil');
        $menu = $this->db->query("SELECT DISTINCT m.nama FROM nilaiakhir n JOIN makul m WHERE n.idMakul = m.idMakul")->result_array();
        
        // $menu = $this->db->query("SELECT DISTINCT m.nama FROM nilaiakhir n JOIN makul m WHERE n.idMakul = m.idMakul". $data['data'])->result_array();
        // $jumlahTotal = $this->db->query("SELECT DISTINCT p.nim FROM presensi p JOIN makul m ON p.idMakul=m.idMakul 
        // WHERE m.nama LIKE '" . $menu['nama'] . "'");
        // $this->db->distinct();
        // SELECT m.nama, n.nilai FROM nilaiakhir n JOIN makul m WHERE n.idMakul = m.idMakul AND n.idMakul=33 
        // $this->db->select('makul.nama, nilaiakhir.nilai, makul.idMakul');
        // $this->db->from('nilaiakhir');
        // $this->db->join('makul','nilaiakhir.idMakul = makul.idMakul');
        // $col = 0;
        $row = 4;
        $i = 1;
        foreach ($menu as $m) {
        // for ($i = 0; $i < count($data); $i++) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $row, $i);
            $excel->setActiveSheetIndex(0)->setCellValue('B'. $row, $m['nama']);
            $excel->setActiveSheetIndex(0)->setCellValue('C'. $row, $this->session->userdata('jumlahTotal')[0]);
            $excel->setActiveSheetIndex(0)->setCellValue('D'. $row, $this->session->userdata('jumlahMengulang'));
            $excel->setActiveSheetIndex(0)->setCellValue('E'. $row, $this->session->userdata('jumlahBelumMengambil'));

            $excel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('E' . $row)->applyFromArray($style_col1);
            $i++;
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, ($i+1));
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data[$i][0]);
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data[$i][1]);
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data[$i][2]);
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data[$i][3]); 
            
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $this->session->userdata('matkul'));
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $this->session->userdata('jumlahTotal'));
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $this->session->userdata('jumlahMengulang'));
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $this->session->userdata('jumlahBelumMengambil')); 
            $row++;
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, '20' . $m['matkul']);
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, '20' . $m['jmlh']);
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, '20' . $m['hasil']);
            // $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, '20' . $m['jumlah']);
        }
        $excel->getActiveSheet()->mergeCellsByColumnAndRow(0, 1, 4, 1);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $excel->getActiveSheet(0)->setTitle("Kapasitas Kelas Baru");
        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Kapasitas Kelas Baru.xlsx"');
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
    
}