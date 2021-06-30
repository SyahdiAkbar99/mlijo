<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Simulasi Transaksi</h4>
                        <p class="card-category">Data akun user mlijo.site</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php if (validation_errors()) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors(); ?>
                                </div>
                            <?php endif; ?>
                            <?= $this->session->flashdata('message') ?>
                            <table id="data-tanaman" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tempat Kirim</th>
                                        <th>Tarif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($shipping as $shp) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td>
                                                <?= $shp['tempat_kirim']; ?>
                                            </td>
                                            <td>
                                                <?= $shp['tarif']; ?>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                        <a href="#edit<?= $shp['id_ongkir'] ?>" class="badge badge-warning" data-toggle="modal">
                                                            <i class="fa fa-edit"></i>Edit
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <a href="#delete<?= $shp['id_ongkir'] ?>" class="badge badge-danger" data-toggle="modal">
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
                    <form action="<?= base_url('Admin/shipping'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group" class="mt-4">
                                <label for="Nama" class="">Tempat Kirim</label>
                                <br>
                                <input type="text" class="form-control" name="tempat_kirim" id="tempat_kirim" placeholder="Tempat Kirim">
                            </div>
                            <br>
                            <div class="form-group" class="mt-4">
                                <label for="Jenis" class="">Tarif</label>
                                <br>
                                <input type="text" class="form-control" name="tarif" id="tarif" placeholder="Tarif">
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




        <?php foreach ($shipping as $shp) : ?>
            <div class="modal fade" id="edit<?= $shp['id_ongkir']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Edit <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/edit_shipping'); ?>" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?= $shp['id_ongkir']; ?>">
                                <div class="form-group" class="mt-4">
                                    <label for="Nama" class="">Tempat Kirim</label>
                                    <br>
                                    <input type="text" class="form-control" name="tempat_kirim" id="tempat_kirim" value="<?= $shp['tempat_kirim']; ?>" placeholder="Tempat Kirim" readonly>
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="Jenis" class="">Tarif</label>
                                    <br>
                                    <input type="text" class="form-control" name="tarif" id="tarif" value="<?= $shp['tarif']; ?>" placeholder="Tarif">
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
        <?php foreach ($shipping as $shp) : ?>
            <div class="modal fade" id="delete<?= $shp['id_ongkir']; ?>">
                <div class=" modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Delete <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/delete_shipping'); ?>" method="get">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?= $shp['id_ongkir']; ?>">
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