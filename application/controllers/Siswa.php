<?php

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kelas');
        $this->load->model('M_jurusan');
        $this->load->model('M_siswa');
        $this->load->model('M_bantuan');
        $this->load->library('form_validation');
        if (!$this->session->userdata('id')) {
            redirect(base_url() . 'auth');
        }
    }
    public function index()
    {
        $datauser = $this->M_user->getUserById($this->session->userdata('id'))[0];
        $url = $this->uri->segment(1);
        verifikasiuser($datauser['role_id'], $url);

        if (!$this->input->get('kelas') && !$this->input->get('jurusan')) {
            $siswa = $this->M_siswa->datasiswa();
            // $data = [
            //     'title' => WEBNAME . 'Data Siswa',
            //     'webname' => WEBNAME,
            //     'kelasjurusan' => $this->M_siswa->DataSiswaByKelasDanJurusan(),
            //     'user' =>  $this->M_user->getUserById($this->session->userdata('id'))[0]
            // ];
            // $this->load->view('templates/header', $data);
            // $this->load->view('siswa/kelasjurusan');
            // $this->load->view('templates/footer');
        } else {
            $idkelas = $this->input->get('kelas');
            $siswa = $this->M_siswa->datasiswaByKelas($idkelas);
        }

        // $this->load->library('ciqrcode');
        $this->load->helper('sf_helper');

        $data = [
            'title' => WEBNAME . 'Data Siswa',
            'webname' => WEBNAME,
            'siswa' => $siswa,
            'user' =>  $this->M_user->getUserById($this->session->userdata('id'))[0]
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('siswa/index');
        $this->load->view('templates/footer');
    }

    public function daftar_kelas()
    {
        $data = [
            'title' => WEBNAME . 'Data Siswa',
            'webname' => WEBNAME,
            'kelasjurusan' => $this->M_siswa->DataSiswaByKelasDanJurusan(),
            'user' =>  $this->M_user->getUserById($this->session->userdata('id'))[0]
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('siswa/kelasjurusan');
        $this->load->view('templates/footer');
    }
    // halaman formulir tambahsiswa
    public function add()
    {
        $data = [
            'title' => WEBNAME . 'Menu access',
            'webname' => WEBNAME,
            'kelas' => $this->M_kelas->tampilkelas(),
            'user' =>  $this->M_user->getUserById($this->session->userdata('id'))[0]
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('siswa/formtambahsiswa');
        $this->load->view('templates/footer');
    }
    // import
    public function import()
    {
        $upload_status =  $this->uploadDoc();
        $inputFileName = 'assets/' . $upload_status;
        $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheet = $spreadsheet->getSheet(0);
        $count_Rows = 2;
        // Loop melalui baris lembar kedua
        foreach ($sheet->getRowIterator($count_Rows) as $row) {
            $name = $spreadsheet->getActiveSheet()->getCell('A' . $row->getRowIndex());
            $nis = $spreadsheet->getActiveSheet()->getCell('B' . $row->getRowIndex());
            $kelamin = $spreadsheet->getActiveSheet()->getCell('C' . $row->getRowIndex());
            $tanggal = $spreadsheet->getActiveSheet()->getCell('D' . $row->getRowIndex())->getValue();
            $tanggalObj = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tanggal);
            $tanggalFormatted = $tanggalObj->format('Y/m/d');
            $kelas = $spreadsheet->getActiveSheet()->getCell('E' . $row->getRowIndex());
            $phone = $spreadsheet->getActiveSheet()->getCell('F' . $row->getRowIndex());
            $alamat = $spreadsheet->getActiveSheet()->getCell('G' . $row->getRowIndex());
            $data = array(
                'nama_siswa' => $name,
                'nis' => $nis,
                'tgl_lahir' => $tanggalFormatted,
                'jenis_kelamin' => $kelamin,
                'alamat' => $alamat,
                'no_telepon' => $phone,
                'kode_jurusan' => 3,
                'kode_kelas' => $kelas,
                'gambar' => 'default.jpg'
            );
            $this->M_siswa->import($data);
            $count_Rows++;
        }
        $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Siswa Berhasil di tambah']);
        redirect(base_url() . 'siswa');
    }

    function uploadDoc()
    {
        $uploadPath = 'assets/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, TRUE); // FOR CREATING DIRECTORY IF ITS NOT EXIST
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 1000000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('fileExcel')) {
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }
    // proses input tambah siswa
    public function tambahsiswa()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required|min_length[5]|trim');
        $this->form_validation->set_rules('nis', 'nis', 'required|min_length[10]|max_length[10]|is_unique[tb_siswa.nis]', [
            'is_unique' => 'Nomor induk siswa ' . $this->input->post('nis') . ' sudah ada di database'
        ]);
        if ($this->form_validation->run() != FALSE) {
            if ($this->input->post('jeniskelamin')) {
                $nomorhp = $this->M_bantuan->formatnomor($this->input->post('nomor_hp'));
                $this->M_siswa->inputsiswa($nomorhp);
                $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Siswa Berhasil di tambah']);
            } else {
                $this->session->set_flashdata('flash', ['alert' => 'danger', 'message' => 'Jenis kelamin wajib diisi']);
            }
        } else {
            $this->session->set_flashdata('flash', ['alert' => 'danger', 'message' => validation_errors()]);
        }
        $kelas = $this->input->get('kelas');
        $jurusan = $this->input->get('jurusan');
        redirect(base_url() . 'siswa/?kelas=' . $kelas . '&jurusan=' . $jurusan);
    }

    // form edit siswa
    public function edit()
    {
        if ($this->input->post('nis') != FALSE) {
            $nis = $this->input->post('nis');
            $datasiswa = $this->M_siswa->dataspesifiksiswa($nis)[0];
            $data = [
                'title' => WEBNAME . 'Edit Siswa',
                'webname' => WEBNAME,
                'siswa' => $datasiswa,
                'kelas' => $this->M_kelas->tampilkelas(),
                'user' =>  $this->M_user->getUserById($this->session->userdata('id'))[0]
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/formeditsiswa');
            $this->load->view('templates/footer');
        } else {
            redirect(base_url() . 'siswa');
        }
    }

    public function editsiswa()
    {
        $idsiswa = $this->input->post('id_siswa');
        $nisawal = $this->M_bantuan->cekValue('nis', 'tb_siswa', 'id_siswa', $idsiswa);
        // validasi Nis
        if ($this->input->post('nis') == $nisawal) {
            $is_unique_nis = '';
        } else {
            $is_unique_nis = '|is_unique[tb_siswa.nis]';
        }
        $this->form_validation->set_rules('nis', 'nis', 'required|trim' . $is_unique_nis, [
            'is_unique' => 'Nomor induk sudah ada di database'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim');

        if ($this->form_validation->run() != FALSE) {
            $nomorhp = $this->M_bantuan->formatnomor($this->input->post('nomor_hp'));
            $this->M_siswa->editsiswa($nomorhp);
            $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Siswa Berhasil di ubah']);
        } else {
            $this->session->set_flashdata('flash', ['alert' => 'danger', 'message' => validation_errors()]);
        }
        redirect(base_url() . 'siswa');
    }

    public function delete()
    {
        if ($this->input->post('id_siswa') != FALSE) {
            $this->M_siswa->deletesiswa($this->input->post('id_siswa'));
            $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Siswa berhasil dihapus']);
        }
        redirect(base_url() . 'siswa');
    }


    // kelas
    public function kelas()
    {
        $datauser = $this->M_user->getUserById($this->session->userdata('id'))[0];
        $url = $this->uri->segment(1) . '/' . $this->uri->segment(2);
        verifikasiuser($datauser['role_id'], $url);



        $data = [
            'title' => WEBNAME . 'Kelola Kelas & Jurusan',
            'webname' => WEBNAME,
            'kelas' => $this->M_kelas->tampilkelas(),
            'jurusan' => $this->M_jurusan->tampiljurusan(),
            'user' =>  $this->M_user->getUserById($this->session->userdata('id'))[0]
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('siswa/kelas');
        $this->load->view('templates/footer');
    }

    public function tambahkelas()
    {
        $this->form_validation->set_rules(
            'nama_kelas',
            'Nama_kelas',
            'required|is_unique[tb_kelas.nama_kelas]',
            [
                'is_unique' => 'nama kelas ' . $this->input->post('nama_kelas') . ' sudah ada di database'
            ]
        );
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|is_unique[tb_kelas.kelas]', [
            'is_unique' => 'Kelas ' . $this->input->post('kelas') . ' sudah ada di database'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('flash', ['alert' => 'danger', 'message' => validation_errors()]);
        } else {
            $this->M_kelas->inputkelas();
            $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Data berhasil di input']);
        }
        redirect(base_url() . 'siswa/kelas');
    }


    public function hapuskelas()
    {
        $this->M_kelas->hapuskelas(base64_decode($this->uri->segment(3)));
        $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Kelas berhasil di hapus']);
        redirect(base_url() . 'siswa/kelas');
    }

    public function editkelas()
    {
        $this->form_validation->set_rules(
            'nama_kelas',
            'Nama_kelas',
            'required'
        );
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('flash', ['alert' => 'danger', 'message' => validation_errors()]);
        } else {
            $this->M_kelas->editkelas();
            $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Data berhasil di edit']);
        }
        redirect(base_url() . 'siswa/kelas');
    }

    // kelola jurusan 
    public function tambahjurusan()
    {
        $this->form_validation->set_rules('namajurusan', 'Namajurusan', 'required|min_length[3]|is_unique[tabel_jurusan.jurusan]', [
            'min_length' => 'Nama jurusan minimal 3 karakter',
            'is_unique' => 'Jurusan ' . $this->input->post('namajurusan') . ' sudah terdaftar'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('flash', ['alert' => 'danger', 'message' => validation_errors()]);
        } else {
            $this->M_jurusan->tambahjurusan();
            $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Jurusan' . $this->input->post('namajurusan') . ' berhasil di tambahkan']);
        }
        redirect(base_url() . 'siswa/kelas');
    }

    public function hapusjurusan()
    {
        $this->M_jurusan->hapusjurusan(base64_decode($this->uri->segment(3)));
        $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Jurusan berhasil di hapus']);
        redirect(base_url() . 'siswa/kelas');
    }


    public function editjurusan()
    {
        $this->form_validation->set_rules(
            'namajurusan',
            'namajurusan',
            'required|min_length[3]',
            [
                'min_length' => 'Nama jurusan minimal 3 karakter'
            ]
        );
        // $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('flash', ['alert' => 'danger', 'message' => validation_errors()]);
        } else {
            $this->M_jurusan->editjurusan();
            $this->session->set_flashdata('flash', ['alert' => 'success', 'message' => 'Data berhasil di edit']);
        }
        redirect(base_url() . 'siswa/kelas');
    }
}
