<?php
class M_siswa extends CI_Model
{

    public function datasiswa()
    {
        return  $this->db->select('*')
            ->from('tb_siswa')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.kode_kelas')
            ->get()->result_array();

        // return  $this->db->get('tb_siswa')->result_array();
    }
    public function datasiswaByKelas($idkelas)
    {
        $where = [
            'kode_kelas' => $idkelas
        ];
        return  $this->db->select('*')
            ->from('tb_siswa')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.kode_kelas')
            ->where($where)
            ->get()->result_array();
        // return $this->db->where($where)->get('tb_siswa')->result_array();

    }
    public function dataspesifiksiswa($nis)
    {
        return  $this->db->select('*')
            ->from('tb_siswa')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.kode_kelas')
            ->where('nis', $nis)->get()->result_array();
    }
    public function inputsiswa($nohp)
    {
        $datasiswa = [
            'id_siswa' => 'SISWA' . random_int(100, 999),
            'nama_siswa' => $this->input->post('nama', true),
            'nis' => $this->input->post('nis', true),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jenis_kelamin' => $this->input->post('jeniskelamin', true),
            'alamat' => $this->input->post('alamat', true),
            'no_telepon' => $nohp,
            'kode_jurusan' => 'default',
            'kode_kelas' => $this->input->post('kelas', true),
            'gambar' => 'default.jpg'
        ];
        $this->db->insert('tb_siswa', $datasiswa);
    }

    public function import($data)
    {
        $this->db->insert('tb_siswa', $data);
    }

    public function selectnohp($nomor, $nis)
    {
        return   $this->db->select('no_telepon')
            ->where('nis', $nis)->get('tb_siswa')->num_rows();
    }

    public function editsiswa($nomorhp)
    {
        $data = [
            'nama_siswa' => $this->input->post('nama', true),
            'nis' => $this->input->post('nis'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jenis_kelamin' => $this->input->post('jeniskelamin'),
            'alamat' => $this->input->post('alamat', true),
            'no_telepon' => $nomorhp,
            'kode_kelas' => $this->input->post('kelas')

        ];
        $this->db->where('id_siswa', $this->input->post('id_siswa'))
            ->update('tb_siswa', $data);
    }
    public function deletesiswa($idsiswa)
    {
        $this->db->delete('tb_siswa', ['id_siswa' => $idsiswa]);
    }

    // absen siswa
    public function CekSiswa($nis)
    {
        return $this->db->where('nis', $nis)
            ->get('tb_siswa')->num_rows();
    }
    // absen by siswa,
    public function detailsiswa($nis)
    {
        return $this->db->where('nis', $nis)
            ->get('tb_siswa')->result_array();
    }

    //

    public function DataSiswaByKelasDanJurusan()
    {
        $query = $this->db->query("SELECT DISTINCT kode_kelas FROM tb_siswa ORDER BY kode_kelas ASC");
        $result = $query->result_array();
        return $result;
    }
}
