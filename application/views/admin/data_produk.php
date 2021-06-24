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
                                    <tr class="">
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Satuan</th>
                                        <th>Harga Beli</th>
                                        <th>Harga User</th>
                                        <th>Berat</th>
                                        <th>Gambar</th>
                                        <th>Keterangan</th>
                                        <th>Username</th>
                                        <th>Tanggal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_product as $datprd) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td>
                                                <?= $datprd['nama_produk']; ?>
                                            </td>
                                            <td>
                                                <?= $datprd['satuan']; ?>
                                            </td>
                                            <td>
                                                <?= $datprd['harga_beli']; ?>
                                            </td>
                                            <td>
                                                <?= $datprd['harga_user']; ?>
                                            </td>
                                            <td>
                                                <?= $datprd['berat']; ?>
                                            </td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-9">
                                                        <img src="<?= base_url('assets/img/produk/') . $datprd['gambar']; ?>" class="img-thumbnail" alt="plant-pict">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?= $datprd['keterangan']; ?>
                                            </td>
                                            <td>
                                                <?= $datprd['username']; ?>
                                            </td>
                                            <td>
                                                <?= date('d M Y', strtotime($datprd['waktu_input'])); ?>
                                            </td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <!-- <div class="col-lg-6">
                                                        <a href="#edit-data-tanaman" class="badge badge-warning" role="badge" data-id="<?= $datprd['id_product']; ?>" data-nama="<?= $datprd['nama_produk']; ?>" data-satuan="<?= $datprd['satuan']; ?>" data-harbe="<?= $datprd['harga_beli'] ?>" data-harser="<?= $datprd['harga_user']; ?>" data-berat="<?= $datprd['berat']; ?>" data-gambar="<?= $datprd['gambar']; ?>" data-ket="<?= $datprd['keterangan']; ?>" data-toggle="modal">
                                                            <i class="fa fa-edit"></i>Edit
                                                        </a>
                                                    </div> -->
                                                    <div class="col-lg-6">
                                                        <a href="#pesan<?= $datprd['id_product'] ?>" class="badge badge-info" data-toggle="modal">
                                                            <i class="fa fa-edit"></i>Pesan
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a href="#delete<?= $datprd['id_product'] ?>" class="badge badge-danger" data-toggle="modal">
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
                    <form action="<?= base_url('Admin/data_produk'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group" class="mt-4">
                                <label for="Nama" class="">Nama Produk</label>
                                <br>
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk">
                            </div>
                            <div class="form-group" class="mt-4">
                                <label for="Jenis" class="">Satuan</label>
                                <br>
                                <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan">
                            </div>
                            <div class="form-group" class="mt-4">
                                <label for="Warna" class="">Harga Beli</label>
                                <br>
                                <input type="text" class="form-control" name="harga_beli" id="harga_beli" placeholder="Harga Beli">
                            </div>
                            <div class="form-group" class="mt-4">
                                <label for="Harga" class="">Harga User</label>
                                <br>
                                <input type="text" class="form-control" name="harga_user" id="harga_user" placeholder="Harga User">
                            </div>
                            <div class="form-group" class="mt-4">
                                <label for="Berat" class="">Berat</label>
                                <br>
                                <input type="number" class="form-control" name="berat" id="berat" placeholder="Berat">
                            </div>
                            <div class="form-group" class="mt-4">
                                <label for="Gambar" class="">Gambar</label>
                                <br>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="gambar" class="custom-file-input" id="gambar">
                                        <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" class="mt-4">
                                <label for="keterangan" class="">Keterangan</label>
                                <br>
                                <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan">
                            </div>
                            <div class="form-group" class="mt-4">
                                <label for="username" class="">Username</label>
                                <br>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            </div>
                            <div class="form-group" class="mt-4">
                                <label for="Tanggal" class="">Tanggal</label>
                                <br>
                                <input type="date" class="form-control" name="waktu_input" id="waktu_input" placeholder="Tanggal">
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
        <?php foreach ($data_product as $datprd) : ?>
            <div class="modal fade" id="pesan<?= $datprd['id_product']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Pesan <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/add_orders'); ?>" method="get">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?= $datprd['id_product']; ?>">
                                <div class="form-group" class="mt-4">
                                    <label for="Nama" class="">Nama Produk</label>
                                    <br>
                                    <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?= $datprd['nama_produk']; ?>" placeholder="Nama Produk" readonly>
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="Jenis" class="">Satuan</label>
                                    <br>
                                    <input type="text" class="form-control" name="satuan" id="satuan" value="<?= $datprd['satuan']; ?>" placeholder="Satuan">
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="Warna" class="">Harga Beli</label>
                                    <br>
                                    <input type="text" class="form-control" name="harga_beli" id="harga_beli" value="<?= $datprd['harga_beli']; ?>" placeholder="Harga Beli" readonly>
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="Harga" class="">Harga User</label>
                                    <br>
                                    <input type="text" class="form-control" name="harga_user" id="harga_user" value="<?= $datprd['harga_user']; ?>" placeholder="Harga User" readonly>
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="Berat" class="">Berat</label>
                                    <br>
                                    <input type="number" class="form-control" name="berat" id="berat" value="<?= $datprd['berat']; ?>" placeholder="Berat" readonly>
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="Gambar" class="">Gambar</label>
                                    <br>
                                    <div class="input-group">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <img src="<?= base_url('assets/img/produk/') . $datprd['gambar']; ?>" class="img-thumbnail" alt="plant-pict">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="keterangan" class="">Keterangan</label>
                                    <br>
                                    <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= $datprd['keterangan']; ?>" placeholder="Keterangan" readonly>
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="username" class="">Username</label>
                                    <br>
                                    <input type="text" class="form-control" name="username" id="username" value="<?= $datprd['username']; ?>" placeholder="Username" readonly>
                                </div>
                                <div class="form-group" class="mt-4">
                                    <label for="Tanggal" class="">Tanggal</label>
                                    <br>
                                    <input type="date" class="form-control" name="waktu_input" id="waktu_input" value="<?= $datprd['waktu_input']; ?>" placeholder="Tanggal" readonly>
                                </div>
                                <p class="text-center">Apakah anda yakin menambahkan item ini?</p>
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
        <?php foreach ($data_product as $datprd) : ?>
            <div class="modal fade" id="delete<?= $datprd['id_product']; ?>">
                <div class=" modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Delete <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/delete_produk'); ?>" method="get">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?= $datprd['id_product']; ?>">
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