<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Barang Keluar</h4>
                        <p class="card-category">Barang Keluar mlijo.site</p>
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
                            <table id="data-keluar" class="table">
                                <thead>
                                    <tr class="">
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Berat</th>
                                        <th>Stok yg Keluar</th>
                                        <th class="text-center">Gambar</th>
                                        <th class="">Tanggal</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($barkel as $brl) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td>
                                                <?= $brl['nama_produk']; ?>
                                            </td>
                                            <td>
                                                <?= $brl['berat']; ?>
                                            </td>
                                            <td>
                                                <?= $brl['stok']; ?>
                                            </td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="card" style="width: 10rem;">
                                                        <img src="<?= base_url('assets/img/produk/') . $brl['gambar']; ?>" class="img-thumbnail" alt="plant-pict">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?= date('D, m Y', strtotime($brl['tanggal'])); ?>
                                            </td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <!-- <div class="col-xxl-6 mr-2">
                                                        <a href="#edit<?= $brl['id'] ?>" class="badge badge-info" data-toggle="modal">
                                                            <i class="fa fa-edit"></i>Edit
                                                        </a>
                                                    </div> -->
                                                    <div class="col-xxl-6 mr-2">
                                                        <a href="#delete<?= $brl['id'] ?>" class="badge badge-danger" data-toggle="modal">
                                                            <i class="fa fa-trash"></i> Delete
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
                        <!-- <button class="btn btn-info" data-toggle="modal" data-target="#tambah">
                            <i class="fa fa-plus-circle"></i> Tambah
                        </button> -->
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Delete -->
        <?php foreach ($barkel as $brl) : ?>
            <div class="modal fade" id="delete<?= $brl['id']; ?>">
                <div class=" modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Delete <?= $title ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Penjual/barang_keluar'); ?>" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?= $brl['id']; ?>">
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