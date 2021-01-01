<?php

class List_model extends CI_Model {

    //ambil data mahasiswa dari database
    function get_presensi_list() {
        //SELECT DISTINCT a.idMakul, a.nama, a.tahun, a.semester, c.nama, a.kelas, d.nama FROM makul a JOIN presensi b ON a.idMakul=b.idMakul JOIN ruangan c ON b.idRuangan = c.idRuangan JOIN dosen d ON b.idDosen = d.idDosen
        $this->db->order_by('makul.idMakul', 'ASC');
        $this->db->distinct();
        $this->db->select('makul.idMakul, makul.nama as makul, makul.kapasitas as kapasitas, makul.tahun, makul.semester, ruangan.nama as ruang, makul.kelas, dosen.nama as dosen');
        $this->db->from('makul');
        $this->db->join('presensi','presensi.idMakul = makul.idMakul');
        $this->db->join('ruangan','ruangan.idRuangan = presensi.idRuangan');
        $this->db->join('dosen','dosen.idDosen = presensi.idDosen' );
        $data = $this->db->get();
        return $data;

    }

    function get_mahasiswa_list() {
        $this->db->order_by('nim', 'ASC');
        $query = $this->db->get('mahasiswa');
        return $query;
    }

    function get_dosen_list() {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('dosen');
        // var_dump($query->result_array());die;
        return $query;
    }

    function get_ruangan_list() {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('ruangan');
        return $query;
    }
    function get_ruanganSidang_list() {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('ruangsidang');
        return $query;
    }

    function get_makul_list() {
        $this->db->order_by('nama', 'ASC');
        $this->db->select('makul.*,ruangan.nama as ruangan');
        $this->db->from('makul');
        $this->db->join('ruangan','ruangan.makul = makul.idMakul');
        $query = $this->db->get();
        return $query;
    }

    function get_kapasitas_list() {
        $this->db->distinct();
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('makul');
        return $query;
    }

    //daftar kelas nilai akhir
    function get_kelas_list() {
        //SELECT DISTINCT a.idMakul, a.nama, a.tahun, a.semester, a.kelas, d.nama FROM makul a JOIN nilaiakhir b ON a.idMakul=b.idMakul JOIN dosen d ON b.idDosen = d.idDosen
        $this->db->order_by('makul.idMakul', 'ASC');
        $this->db->distinct();
        $this->db->select('makul.idMakul, makul.nama as makul, makul.kapasitas as kapasitas, makul.tahun, makul.semester, makul.kelas, dosen.nama as dosen');
        $this->db->from('makul');
        $this->db->join('nilaiakhir','makul.idMakul = nilaiakhir.idMakul');
        $this->db->join('dosen','dosen.idDosen = nilaiakhir.idDosen' );
        $data = $this->db->get();
        return $data;
    }

    function get_kapasitaskelas_list(){
       // $this->db->order_by('idMatkul', 'ASC');
        $this->db->distinct();
        // SELECT m.nama, n.nilai FROM nilaiakhir n JOIN makul m WHERE n.idMakul = m.idMakul AND n.idMakul=33 
        $this->db->select('makul.nama, makul.idMakul, makul.kapasitas');
        // $this->db->select('makul.nama, nilaiakhir.nilai, makul.idMakul');
        $this->db->from('nilaiakhir');
        $this->db->join('makul','nilaiakhir.idMakul = makul.idMakul');
        // $this->db->join('nilaiakhir','nilaiakhir.idNilaiAkhir = kapasitaskelas.idNilaiAkhir');
        // $this->db->join('presensi','presensi.idPresensi = kapasitaskelas.idPresensi');
        $data = $this->db->get();
        return $data;
    }
}