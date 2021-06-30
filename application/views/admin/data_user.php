<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <?php if (validation_errors()) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors(); ?>
                            </div>
                        <?php endif; ?>
                        <?= $this->session->flashdata('message') ?>
                        <h4 class="card-title ">Data User</h4>
                        <p class="card-category">Data akun user mlijo.site</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-users" class="table">
                                <thead class="">
                                    <tr class="">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>No Telpon</th>
                                        <th>Alamat</th>
                                        <th>Akses</th>
                                        <th>Tanggal Register</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($data_users as $datusr) : ?>
                                        <?php if ($datusr['id_akses'] == 2 || $datusr['id_akses'] == 3) : ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td>
                                                    <?= $datusr['nama_user']; ?>
                                                </td>
                                                <td>
                                                    <?= $datusr['email_user']; ?>
                                                </td>
                                                <td>
                                                    <?= $datusr['no_telp']; ?>
                                                </td>
                                                <td>
                                                    <?= $datusr['alamat']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($datusr['id_akses'] == 2) : ?>
                                                        Penjual
                                                    <?php else : ?>
                                                        Pembeli
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?= date('d M Y', $datusr['date_created']); ?>
                                                </td>
                                                <td>
                                                    <div class="row justify-content-center">
                                                        <div class="col-xxl-6 mr-2">
                                                            <a href="#delete<?= $datusr['id_user'] ?>" class="badge badge-danger" data-toggle="modal">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                        </div>
                                                        <div class="col-xxl-6 mr-2">
                                                            <a href="#edit<?= $datusr['id_user'] ?>" class="badge badge-warning" data-toggle="modal">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                        </div>
                                                        <div class="col-xxl-6 mr-2">
                                                            <a href="#lihat<?= $datusr['id_user'] ?>" class="badge badge-success" data-toggle="modal">
                                                                <i class="fa fa-info-circle"></i> Lihat
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php
                                        $no++;
                                    endforeach; ?>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-info" data-toggle="modal" data-target="#tambah">
                                <i class="fa fa-plus-circle"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambah">
            <div class=" modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">Tambah <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Admin/data_user'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input type="text" class="form-control" name="name_user" id="name_user">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" name="email_user" id="email_user">
                            </div>
                            <div class="form-group">
                                <label for="No Telpon">No Telpon</label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="Level">Level</label>
                                <input type="text" class="form-control" name="level" id="level">
                            </div>
                            <div class="form-group">
                                <label for="Jenis Kelamin">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            </div>
                            <div class="form-group">
                                <label for="Alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat">
                            </div>
                            <div class="form-group">
                                <label for="Tempat Lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                            </div>
                            <div class="form-group">
                                <label for="Tanggal Lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="submit" class="btn btn-info btn-outline-light">Simpan</button>
                            <button type="button" class="btn btn-danger btn-outline-light" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Modal Delete -->
        <?php foreach ($data_users as $datusr) : ?>
            <div class="modal fade" id="delete<?= $datusr['id_user']; ?>">
                <div class=" modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Delete <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/delete_data_user'); ?>" method="get">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?= $datusr['id_user']; ?>">
                                <p class="text-center">Apakah anda yakin data ini dihapus?</p>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="submit" class="btn btn-danger btn-outline-light">Ya</button>
                                <button type="button" class="btn btn-light btn-outline-light" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endforeach; ?>
        <!-- /.modal -->


        <!-- Modal Edit -->
        <?php foreach ($data_users as $datusr) : ?>
            <div class="modal fade" id="edit<?= $datusr['id_user']; ?>">
                <div class=" modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title">Edit <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/edit_data_user'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="Nama">Nama</label>
                                    <input type="hidden" class="form-control" name="id" id="id" value="<?= $datusr['id_user']; ?>">
                                    <input type="text" class="form-control" name="name_user" id="name_user" value="<?= $datusr['nama_user']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" name="email_user" id="email_user" value="<?= $datusr['email_user'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="No Telpon">No Telpon</label>
                                    <input type="text" name="no_telp" id="no_telp" class="form-control" value="<?= $datusr['no_telp']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" value="<?= $datusr['username']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" value="<?= $datusr['password']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Level">Level</label>
                                    <input type="text" class="form-control" name="level" id="level" value="<?= $datusr['level']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Jenis Kelamin">Jenis Kelamin</label>
                                    <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" value="<?= $datusr['jenis_kelamin']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $datusr['alamat']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Tempat Lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?= $datusr['tempat_lahir']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Tanggal Lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?= date('Y-m-d', strtotime($datusr['tanggal_lahir'])) ?>">
                                </div>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="submit" class="btn bg-warning btn-outline-light text-dark">Update</button>
                                <button type="button" class="btn btn-danger btn-outline-light" data-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endforeach; ?>
        <!-- /.modal -->


        <!-- Modal Edit -->
        <?php foreach ($data_users as $datusr) : ?>
            <div class="modal fade" id="lihat<?= $datusr['id_user']; ?>">
                <div class=" modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Lihat <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card card-nav-tabs justify-content-center">
                                <div class="card-header card-header-info">
                                    <?= $datusr['nama_user']; ?>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Email &nbsp;:&nbsp;<?= $datusr['email_user'] ?></li>
                                    <li class="list-group-item">No Telpon &nbsp;:&nbsp;<?= $datusr['no_telp']; ?></li>
                                    <li class="list-group-item">Username &nbsp;:&nbsp;<?= $datusr['username']; ?></li>
                                    <li class="list-group-item">Password &nbsp;:&nbsp;<?= $datusr['password']; ?></li>
                                    <li class="list-group-item">Level &nbsp;:&nbsp;<?= $datusr['level']; ?></li>
                                    <li class="list-group-item">Jenis Kelamin &nbsp;:&nbsp;<?= $datusr['jenis_kelamin']; ?></li>
                                    <li class="list-group-item">Alamat &nbsp;:&nbsp;<?= $datusr['alamat']; ?></li>
                                    <li class="list-group-item">Tempat Lahir &nbsp;:&nbsp;<?= $datusr['tempat_lahir']; ?></li>
                                    <li class="list-group-item">Tanggal Lahir &nbsp;:&nbsp;<?= date('D, m Y', strtotime($datusr['tanggal_lahir'])) ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger btn-outline-light" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endforeach; ?>
        <!-- /.modal -->
    </div>
</div>