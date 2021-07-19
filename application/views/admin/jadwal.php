<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Jadwal</h4>
                        <p class="card-category">Data Jadwal mlijo.site</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php if (validation_errors()) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors(); ?>
                                </div>
                            <?php endif; ?>
                            <?= $this->session->flashdata('message') ?>
                            <table id="data-jadwal" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Tanggal Ready</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($jadwals as $jdl) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td>
                                                <?= $jdl['nama_produk']; ?>
                                            </td>
                                            <td>
                                                <?= date('D, m Y', strtotime($jdl['tanggal_ready'])); ?>
                                            </td>
                                            <td>
                                                <?= date('H:i', strtotime($jdl['created_at'])); ?>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <a href="#edit<?= $jdl['id'] ?>" class="badge badge-warning" data-toggle="modal">
                                                            <i class="fa fa-edit"></i>Edit
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a href="#delete<?= $jdl['id'] ?>" class="badge badge-danger" data-toggle="modal">
                                                            <i class="fa fa-edit"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach; ?>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-info" data-toggle="modal" data-target="#tambah">
                            <i class="fa fa-plus-circle"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="tambah">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title">Tambah <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('Admin/jadwal'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group" class="mt-4">
                                <label for="Nama" class="">Hari</label>
                                <br>
                                <input type="date" class="form-control" name="hari" id="hari">
                            </div>
                            <div class="form-group" class="mt-4">
                                <label for="Nama Produk" class="">Nama Produk</label>
                                <br>
                                <select class="form-control" name="nama_produk" id="nama_produk">
                                    <?php foreach ($products as $prd) : ?>
                                        <option value="<?= $prd['id_product']; ?>"><?= $prd['nama_produk']; ?></option>
                                    <?php endforeach; ?>
                                </select>
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




        <?php foreach ($jadwals as $jdl) : ?>
            <div class="modal fade" id="edit<?= $jdl['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Edit <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/edit_jadwal'); ?>" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?= $jdl['id']; ?>">
                                <div class="form-group" class="mt-4">
                                    <label for="Hari" class="">Hari</label>
                                    <br>
                                    <input type="date" class="form-control" name="hari" id="hari" value="<?= $jdl['tanggal_ready']; ?>">
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="Nama Produk" class="">Nama Produk</label>
                                    <br>
                                    <select class="form-control" name="nama_produk" id="nama_produk">
                                        <option value="<?= $jdl['id_product']; ?>"><?= $jdl['nama_produk']; ?></option>
                                        <?php foreach ($products as $prd) : ?>
                                            <option value="<?= $prd['id_product']; ?>"><?= $prd['nama_produk']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <p class="text-center">Apakah anda yakin edit item ini?</p>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="submit" class="btn btn-info btn-outline-light">Ya</button>
                                <button type="button" class="btn btn-danger btn-outline-light" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endforeach; ?>
        <!-- /.modal -->


        <!-- Modal Delete -->
        <?php foreach ($jadwals as $jdl) : ?>
            <div class="modal fade" id="delete<?= $jdl['id']; ?>">
                <div class=" modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Delete <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/delete_jadwal'); ?>" method="get">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?= $jdl['id']; ?>">
                                <p class="text-center">Apakah anda yakin data ini dihapus?</p>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="submit" class="btn btn-danger btn-outline-light">Ya</button>
                                <button type="button" class="btn btn-secondary btn-outline-light" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endforeach; ?>
        <!-- /.modal -->
    </div>
</div>