<div class="content-body">
    <!-- row -->




    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Siswa</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Siswa</a></li>
            </ol>
        </div>
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="alert alert-<?= $this->session->flashdata('flash')['alert'] ?> alert-dismissible alert-alt fade show my-4 mx-5">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
                <strong><?= $this->session->flashdata('flash')['alert'] ?>!</strong> <?= $this->session->flashdata('flash')['message']; ?>.
            </div>
        <?php endif; ?>
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Siswa </h4>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                Tambah
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url(); ?>siswa/add">Tambah</a>
                                <button class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">import</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Kelas</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Nomor HP</th>
                                        <!-- <th>QR</th> -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($siswa as $s) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $s['nis']; ?></td>
                                            <td><?= $s['nama_siswa']; ?></td>
                                            <td><?= $s['jenis_kelamin']; ?></td>
                                            <td><?= $s['alamat']; ?></td>
                                            <td><?= $s['kelas']; ?></td>
                                            <td><?= $s['tgl_lahir']; ?></td>
                                            <td><?= $s['no_telepon']; ?></td>

                                            <td>
                                                <div class="d-flex">
                                                    <form action="<?= base_url(); ?>siswa/edit" method="POST">
                                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                                        <input type="hidden" name="nis" value="<?= $s['nis'] ?>">
                                                        <button type="submit" class="btn btn-primary shadow btn-xs sharp mr-1" name="editsiswa"><i class="fa fa-pencil"></i></button>
                                                    </form>
                                                    <form action="<?= base_url() ?>siswa/delete" method="POST">
                                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                                        <input type="hidden" name="id_siswa" value="<?= $s['id_siswa'] ?>">
                                                        <button class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import data siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url(); ?>siswa/import" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="custom-file">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="file" class="custom-file-input" id="customFile" name="fileExcel">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <br><br>
                        <a href="<?= base_url('assets/') ?>excel/template.xlsx" target="_blank" rel="noopener noreferrer">Download Template</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>