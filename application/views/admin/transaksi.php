<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Transaksi</h4>
                        <p class="card-category">Transaksi mlijo.site</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php if (validation_errors()) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?= validation_errors(); ?>
                                </div>
                            <?php endif; ?>
                            <?= $this->session->flashdata('message') ?>
                            <table id="data-transaksi" class="table">
                                <thead>
                                    <tr class="">
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Berat</th>
                                        <th>Stok</th>
                                        <th class="text-center">Gambar</th>
                                        <th>Keterangan</th>
                                        <th>Username</th>
                                        <th>Lokasi</th>
                                        <th>Tarif</th>
                                        <th>Kategori</th>
                                        <th>Jadwal</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($riwayat_trans as $rwt) : ?>
                                        <?php if ($rwt['status'] == 0) : ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td>
                                                    <?= $rwt['nama_produk']; ?>
                                                </td>
                                                <td>
                                                    <?= $rwt['satuan']; ?>
                                                </td>
                                                <td>
                                                    <?= $rwt['harga']; ?>
                                                </td>
                                                <td>
                                                    <?= $rwt['berat']; ?>
                                                </td>
                                                <td>
                                                    <?= $rwt['stok']; ?>
                                                </td>
                                                <td>
                                                    <div class="row justify-content-center">
                                                        <div class="card" style="width: 10rem;">
                                                            <img src="<?= base_url('assets/img/produk/') . $rwt['gambar']; ?>" class="img-thumbnail" alt="plant-pict">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?= $rwt['keterangan']; ?>
                                                </td>
                                                <td>
                                                    <?= $rwt['username']; ?>
                                                </td>
                                                <td>
                                                    <?= $rwt['tempat_kirim']; ?>
                                                </td>
                                                <td>
                                                    <?= $rwt['tarif']; ?>
                                                </td>
                                                <td>
                                                    <?= $rwt['nama_category']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($rwt['status'] == 0) : ?>
                                                        Proses
                                                    <?php elseif ($rwt['status'] == 1) : ?>
                                                        Dikirim
                                                    <?php elseif ($rwt['status'] == 2) : ?>
                                                        Dijalan
                                                    <?php else : ?>
                                                        Selesai
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?= date('d M Y', strtotime($rwt['waktu_input'])); ?>
                                                </td>
                                                <td>
                                                    <div class="row justify-content-center">
                                                        <div class="col-xxl-6 mr-2">
                                                            <a href="#lihat<?= $rwt['id_product'] ?>" class="badge badge-info" data-toggle="modal">
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
                    </div>
                    <div class="card-footer">
                        <!-- <button class="btn btn-info" data-toggle="modal" data-target="#tambah">
                            <i class="fa fa-plus-circle"></i> Tambah
                        </button> -->
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Nama" class="">Nama Produk</label>
                                        <input type="text" class="form-control" name="nama_produk" id="nama_produk">
                                    </div>
                                    <div class="form-group">
                                        <label for="Jenis" class="">Satuan</label>
                                        <input type="text" class="form-control" name="satuan" id="satuan">
                                    </div>
                                    <div class="form-group">
                                        <label for="Harga" class="">Harga</label>
                                        <input type="text" class="form-control" name="harga" id="harga">
                                    </div>
                                    <div class="form-group">
                                        <label for="Berat" class="">Berat</label>
                                        <input type="number" class="form-control" name="berat" id="berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="Berat" class="">Stok</label>
                                        <input type="number" class="form-control" name="stok" id="stok">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Gambar" class="">Gambar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="gambar" class="custom-file-input" id="gambar">
                                                <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan" class="">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan">
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="">Username</label>
                                        <input type="text" class="form-control" name="username" id="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="Lokasi" class="">Lokasi</label>
                                        <select class="form-control" name="id_ongkir" id="id_ongkir">
                                            <?php foreach ($shipping as $rows) : ?>
                                                <option value="<?= $rows['id_ongkir']; ?>"><?= $rows['tempat_kirim']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="Kategori">Kategori</label>
                                            <select class="form-control" name="id_category" id="id_category">
                                                <?php foreach ($category as $data) : ?>
                                                    <option value="<?= $data['id_category']; ?>"><?= $data['nama_category']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Tanggal" class="">Tanggal</label>
                                        <input type="date" class="form-control" name="waktu_input" id="waktu_input">
                                    </div>
                                </div>
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



        <!-- Modal Pesan -->
        <?php foreach ($riwayat_trans as $rwt) : ?>
            <div class="modal fade" id="pesan<?= $rwt['id_product']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Pesan <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Admin/add_orders'); ?>" method="post">
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="id" id="id" value="<?= $rwt['id_product']; ?>">
                                                <input type="hidden" name="penjual_id" id="penjual_id" value="<?= $rwt['id_user']; ?>">
                                                <div class="form-group">
                                                    <label for="Kode">Kode Transaksi</label>
                                                    <br>
                                                    <input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi" value="<?= $code; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Nama">Nama Produk</label>
                                                    <br>
                                                    <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?= $rwt['nama_produk']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Jenis">Satuan</label>
                                                    <br>
                                                    <input type="text" class="form-control" name="satuan" id="satuan" value="<?= $rwt['satuan']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Harga">Harga</label>
                                                    <br>
                                                    <input type="text" class="form-control" name="harga" id="harga" value="<?= $rwt['harga']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Berat">Berat</label>
                                                    <br>
                                                    <input type="number" class="form-control" name="berat" id="berat" value="<?= $rwt['berat']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Berat">Stok</label>
                                                    <br>
                                                    <input type="number" class="form-control" name="stok" id="stok" value="<?= $rwt['stok']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Gambar">Gambar</label>
                                                    <br>
                                                    <div class="input-group">
                                                        <div class="row">
                                                            <div class="col-lg-9">
                                                                <img src="<?= base_url('assets/img/produk/') . $rwt['gambar']; ?>" class="img-thumbnail" alt="plant-pict">
                                                                <input type="hidden" class="form-control" name="gambar" id="gambar" value="<?= $rwt['gambar']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Keterangan">Keterangan</label>
                                                    <br>
                                                    <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= $rwt['keterangan']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Username">Username</label>
                                                    <br>
                                                    <input type="text" class="form-control" name="username" id="username" value="<?= $rwt['username']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="Lokasi">Nomer Lokasi</label>
                                                        <select class="form-control" data-style="btn btn-link" name="id_ongkir" id="id_ongkir" disabled>
                                                            <option value="<?= $rwt['id_ongkir'] ?>"><?= $rwt['tempat_kirim']; ?></option>
                                                            <?php foreach ($shipping as $rows) : ?>
                                                                <option value="<?= $rows['id_ongkir']; ?>"><?= $rows['id_ongkir'] . ' - ' . $rows['tempat_kirim']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="Kategori">Kategori</label>
                                                        <select class="form-control" data-style="btn btn-link" name="id_category" id="id_category" disabled>
                                                            <option value="<?= $rwt['id_category'] ?>"><?= $rwt['nama_category']; ?></option>
                                                            <?php foreach ($category as $data) : ?>
                                                                <option value="<?= $data['id_category']; ?>"><?= $data['id_category'] . ' - ' . $data['nama_category']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Tanggal">Tanggal</label>
                                                    <br>
                                                    <input type="date" class="form-control" name="waktu_input" id="waktu_input" value="<?= date('Y-m-d', strtotime($rwt['waktu_input'])); ?>" readonly>
                                                </div>
                                                <p class="text-center">Apakah anda yakin menambahkan item ini?</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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


        <!-- Modal Lihat -->
        <?php foreach ($riwayat_trans as $rwt) : ?>
            <div class="modal fade" id="lihat<?= $rwt['id_product']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
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
                                    <?= $rwt['nama_produk']; ?>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <li class="list-group-item">Nama &nbsp;:&nbsp;<?= $rwt['nama_produk']; ?></li>
                                            <li class="list-group-item">Satuan &nbsp;:&nbsp;<?= $rwt['satuan']; ?></li>
                                            <li class="list-group-item">Harga &nbsp;:&nbsp;<?= $rwt['harga']; ?></li>
                                            <li class="list-group-item">Berat &nbsp;:&nbsp;<?= $rwt['berat']; ?></li>
                                            <li class="list-group-item">Stok &nbsp;:&nbsp;<?= $rwt['stok']; ?></li>
                                        </div>
                                        <div class="col-md-6">
                                            <li class="list-group-item">Gambar
                                                <div class="card" style="width: 10rem;">
                                                    <img src="<?= base_url('assets/img/produk/') . $rwt['gambar']; ?>" class="img-thumbnail" alt="plant-pict">
                                                </div>
                                            </li>
                                            <li class="list-group-item">Keterangan &nbsp;:&nbsp;<?= $rwt['keterangan']; ?></li>
                                            <li class="list-group-item">Username &nbsp;:&nbsp;<?= $rwt['username']; ?></li>
                                            <li class="list-group-item">Lokasi &nbsp;:&nbsp;<?= $rwt['tempat_kirim']; ?></li>
                                            <li class="list-group-item">Tanggal &nbsp;:&nbsp;<?= date('D, m Y', strtotime($rwt['waktu_input'])); ?></li>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger btn-outline-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endforeach; ?>
        <!-- /.modal -->


        <!-- Modal Delete -->
        <?php foreach ($riwayat_trans as $rwt) : ?>
            <div class="modal fade" id="delete<?= $rwt['id_product']; ?>">
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
                                <input type="hidden" name="id" id="id" value="<?= $rwt['id_product']; ?>">
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