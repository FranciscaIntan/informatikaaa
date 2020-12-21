<?php

class NilaiAkhirModel extends CI_Model {

    public function view() {
        return $this->db->get('nilaiakhir')->result_array();
    }

    public function idMakul($data) {
        $this->db->insert('makul', $data);
        $query = $this->db->select('idMakul')->from('makul')->where($data)->get();
        $row = $query->row();
        return $row->idMakul;
    }

    public function idDosen($data) {
        if ($this->db->get_where('dosen', ['nama' => $data])->num_rows() == 0) {
            $this->db->insert('dosen', ['nama' => $data]);
            $query = $this->db->select('idDosen')->from('dosen')->where('nama', $data)->get();
            $row = $query->row();
            return $row->idDosen;
        } else {
            $query = $this->db->select('idDosen')->from('dosen')->where('nama', $data)->get();
            $row = $query->row();
            return $row->idDosen;
        }
    }

    public function insert($data) {
        $this->db->insert_batch('nilaiakhir', $data);
    }

    public function insertMhs($data) {
        $this->db->insert_batch('mahasiswa', $data);
    }

   
    //get data mahasiswa berdasar makul from tabel nilaiakhir, return data
    public function tampilIsi($id)
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('nilaiakhir');
        $this->db->where('idMakul',$id);
        $data = $this->db->get();
        return $data;

    }
     public function idRuangan($data) {
        if ($this->db->get_where('ruangan', ['nama' => $data['nama'], 'makul' => $data['makul']])->num_rows() == 0) {
            $this->db->insert('ruangan', $data);
            $query = $this->db->select('idRuangan')->from('ruangan')->where(['nama' => $data['nama'], 'makul' => $data['makul']])->get();
            $row = $query->row();
            return $row->idRuangan;
        } else {
            $query = $this->db->select('idRuangan')->from('ruangan')->where(['nama' => $data['nama'], 'makul' => $data['makul']])->get();
            $row = $query->row();
            return $row->idRuangan;
        }
    }



    public function cariMakul($id)
    {
        $this->db->from('makul');
        $this->db->where('idMakul',$id);
        $data = $this->db->get();
        return $data->row();
    }

    public function checkMakul($data) {
        return $this->db->get_where('makul', ['nama' => $data['nama'], 'tahun' => $data['tahun'], 'semester' => $data['semester'], 'kelas' => $data['kelas']])->num_rows();
    }

    public function cariDosen($id)
    {
        $this->db->order_by('makul.idMakul', 'ASC');
        $this->db->distinct();
        $this->db->select('dosen.nama as dosen');
        $this->db->from('makul');
        $this->db->join('presensi','presensi.idMakul = makul.idMakul');
        $this->db->join('ruangan','ruangan.idRuangan = presensi.idRuangan');
        $this->db->join('dosen','dosen.idDosen = presensi.idDosen' );
        $this->db->where(' makul.idMakul',$id);
        $data = $this->db->get()->row();
        return $data;
    }

    //by idnilaiakhir
    public function getIdMakul($idn) {
        $this->db->distinct();
        $this->db->select('nilaiakhir.idMakul');
        $this->db->from('nilaiakhir');
        $this->db->where('idNilaiAkhir',$idn);
        $data = $this->db->get()->row_object();
        return $data;
    }

    public function tahun($nim) {
        $th = str_split($nim);
        $data = $th[0] . $th[1];
        if ($this->db->get_where('tahun', ['tahun' => $data])->num_rows() == 0) {
            $this->db->set('tahun', $data);
            $this->db->insert('tahun');
        }
    }
    
    public function tambahKapasitas($id,$hitung)
    {
        $this->db->where('idMakul', $id);
        $this->db->update('makul', ['kapasitas'=>$hitung]);
    }

}