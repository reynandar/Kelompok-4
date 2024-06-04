<?php

class M_kelas extends CI_Model
{

    public function tampilkelas()
    {
        return $this->db->get('tb_kelas')->result_array();
    }
    public function tampiljurusan()
    {
        return $this->db->get('tabel_jurusan')->result_array();
    }

    public function ambilkelas($idkelas)
    {
        return $this->db->where('id_kelas', $idkelas)->get('tb_kelas')->result_array();
    }
    public function ambiljurusan($idjurusan)
    {
        return $this->db->where('id_jurusan', $idjurusan)->get('tabel_jurusan')->result_array();
    }
    public function inputkelas()
    {
        $tbl_kls = $this->db->get('tb_kelas')->result_array();
        foreach ($tbl_kls as $kelass){
            
        }
        $id_kelas = $kelass['id_kelas']+1;
        $data = [
            'id_kelas' => $id_kelas,
            'nama_kelas' => $this->input->post('nama_kelas', true),
            'kelas' => $this->input->post('kelas', true)
        ];

        $this->db->insert('tb_kelas', $data);
    }
    public function hapuskelas($id)
    {
        $this->db->delete('tb_kelas', ['id_kelas' => $id]);
    }
    public function editkelas()
    {
        $data = [
            'nama_kelas' => $this->input->post('nama_kelas', true),
            'kelas' => $this->input->post('kelas', true)
        ];

        $this->db->where('id_kelas', $this->input->post('idkelas'));
        $this->db->update('tb_kelas', $data);
    }
}
