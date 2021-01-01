<?php

defined('BASEPATH') or exit('No direct script access allowed');

class nilaiakhir extends CI_Controller {
	 public function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        //load libary pagination
        $this->load->library('pagination');
        //load the department_model
        $this->load->model('list_model');
        $this->load->model('NilaiAkhirModel');
        $this->load->library('excel');
    }

    

    public function index() {
        $data['data'] = $this->list_model->get_kelas_list();
        $data['title'] = 'Daftar Kelas';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('nilaiakhir/nilaiakhir', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    //parameter idmakul
    public function isi($idmakul) {
        $data['nilaiakhir'] = $this->NilaiAkhirModel->tampilIsi($idmakul);
        $data['makul'] = $this->NilaiAkhirModel->cariMakul($idmakul);
        $data['mahasiswa'] = $this->NilaiAkhirModel->tampilIsi($idmakul);
        $data['datapresensi'] = $this->list_model->get_kelas_list();
        $data['title'] = 'Daftar Nilai Akhir';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('nilaiakhir/isi', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

 
     public function editNilaiAkhir($idNilaiAkhir) {
        $this->session->set_tempdata('item', $idNilaiAkhir);
        redirect('nilaiakhir/editNilaiMahasiswa');
    }

    public function editNilaiMahasiswa() {
        $idNilaiAkhir = urldecode($this->session->tempdata('item'));
        $data['mahasiswa'] = $this->NilaiAkhirModel->tampilIsi($idNilaiAkhir);
        
        $data['title'] = 'Edit Nilai Mahasiswa';

        /*SELECT DISTINCT nilaiakhir.nim, nilaiakhir.nama, makul.nama, dosen.nama, nilaiakhir.nilai
        from nilaiakhir
        JOIN makul 
        on nilaiakhir.idMakul=makul.idMakul
        JOIN dosen
        on nilaiakhir.idDosen=dosen.idDosen*/

        $this->db->select('nilaiakhir.*, makul.nama as namamakul, dosen.nama as namadosen');
        $this->db->from('nilaiakhir');
        $this->db->join('makul','nilaiakhir.idMakul = makul.idMakul');
        $this->db->join('dosen','nilaiakhir.idDosen = dosen.idDosen');
        $this->db->where('nilaiakhir.idNilaiAkhir', $idNilaiAkhir);
        $data['data'] = $this->db->get()->row_array();



        $this->form_validation->set_rules('nilai', 'Nilai', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('nilaiakhir/editNilaiAkhir', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $edit = [
                
               'nilai' => $this->input->post('nilai')
                
            ];
            
                                    
            $this->db->where('idNilaiAkhir', $idNilaiAkhir);
            $this->db->update('nilaiakhir', $edit);
            
        
            $tmp = $data['data']['idMakul'];

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Nilai akhir berhasil di update!</div>');



        redirect('nilaiakhir/isi/'.$tmp);    
            
        }

    }
  
    public function deleteDaftarNilai($idMakul)
    {
        #delete daftar nilai
        $this->db->where('idMakul',$idMakul);
        $this->db->delete('nilaiakhir');
       

        $hapus = array (
            "idMakul" => $idMakul
        );
        $this->db->delete('makul', $hapus);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="success">
        Presensi berhasil di hapus!</div>');
        redirect('nilaiakhir');
    }

/*  public function deleteDaftarNilai($idNilaiAkhir)
    {
        #delete nilai akhir mhs
        $this->db->where('idNilaiAkhir',$idNilaiAkhir);
        $this->db->delete('nilaiakhir');
        
        $hapus = array (
            "idNilaiAkhir" => $idNilaiAkhir
        );
        $this->db->delete('makul', $hapus);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="success">
        Presensi berhasil di hapus!</div>');
        redirect('presensi');
    }*/



    public function upload() {
        
        if (isset($_FILES["file"]["name"])) {
            $countfiles = count($_FILES["file"]["name"]);

            for ($iii = 0; $iii < $countfiles; $iii++) {

                $path = $_FILES["file"]["tmp_name"][$iii];


                $object = PHPExcel_IOFactory::load($path);
                $hitung = 0;
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    $makulkelas = $worksheet->getCellByColumnAndRow(3, 4);
                    $makulkelas_temp = explode(" / ", $makulkelas);
                    $tahun_ajar = $worksheet->getCellByColumnAndRow(1, 2);
                    if (count(explode(" T.A ", $tahun_ajar)) == 2) {
                        $tahun_ajar_temp = explode(" T.A ", $tahun_ajar);
                    } else {
                        $tahun_ajar_temp = explode(" TAHUN AKADEMIK ", $tahun_ajar);
                    }

                    $periode = $tahun_ajar_temp[1];

                    $periode_temp = explode(" ", $periode);

                    $waktu = $worksheet->getCellByColumnAndRow(18, 4);
                    $waktu_temp = explode("/", $waktu);
                    #Dosen                    
                    $dosen = $worksheet->getCellByColumnAndRow(6, 4);

                    #MAKUL
                    #nama Makul
                    $makul = $makulkelas_temp[0];
                    #tahun Makul
                    $tahun = $periode_temp[0];
                    #semester Makul
                    $semester = $periode_temp[3];
                    #ruangan Makul
                    $ruangan = $waktu_temp[2];
                    #kelas Makul                                     
                    $kelas = $makulkelas_temp[1];
                    #hari Makul
                    $hari = $waktu_temp[0];
                    #jam Makul
                    $jam = $waktu_temp[1];
                    $check = ['nama' => $makul, 'tahun' => $tahun, 'semester' => $semester, 'kelas' => $kelas];
                    $data1 = $this->NilaiAkhirModel->checkMakul($check);
                    // var_dump($data1);
                    // die;
                    if ($data1 == 0) {
                        
                        $idMakul = $this->NilaiAkhirModel->idMakul($check);
                        #idDosen
                        $idDosen = $this->NilaiAkhirModel->idDosen($dosen);
                        $ruang = ['nama' => $ruangan, 'makul' => $idMakul, 'hari' => $hari, 'jam' => $jam];
                        $idRuangan = $this->NilaiAkhirModel->idRuangan($ruang);
                        for ($row = 7; $row <= $highestRow; $row++) {
                            $nim = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $nama = ucwords($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                            $nilaiakhir = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                            if (strlen($nim) == 9) {
                                $this->NilaiAkhirModel->tahun($nim);
                                $data[] = array('Nim' => $nim, 'Nama' => $nama, 'idMakul' => $idMakul, 'idDosen' => $idDosen, 'Nilai' => $nilaiakhir);
                                $hitung++;
                            } elseif ($nama == $dosen) {
                                $id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                                if ($id == "") {
                                    $id = mt_rand(0, 999999);
                                }
                                $this->db->set('npp', $id)->where('idDosen', $idDosen)->update('dosen');
                            }
                        }
                        $this->NilaiAkhirModel->tambahKapasitas($idMakul, $hitung);
                        $hitung = 0;
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                        Data sudah di import!</div>');
                    }
                }
            }

            if ($data) {
                
                $this->NilaiAkhirModel->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
                        Data berhasil di import!</div>');
            }
        }
        redirect('nilaiakhir');
    }

}