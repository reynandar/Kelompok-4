<?php


class M_izin extends CI_Model
{

    public function tampilDataIzinBulanIni()
    {
        $bulanini = date('Y') . '-' . date('m');
        $this->db->order_by('id', 'desc');
        $this->db->like('tanggal_izin', $bulanini);
        $this->db->join('tb_siswa', 'tb_siswa.nis = tb_izin.nis_siswa');
        return $this->db->get('tb_izin')->result_array();
    }
}
