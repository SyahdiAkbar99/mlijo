<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Data User</h4>
                        <p class="card-category">Data akun user mlijo.site</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-users" class="table">
                                <thead class="text-primary">
                                    <tr class="text-center">
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
                                                        <div class="col-xxl-6">
                                                            <a href="#delete<?= $datusr['id_user'] ?>" class="badge badge-danger" data-toggle="modal">
                                                                <i class="fa fa-trash"></i> Delete
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
                </div>
            </div>
        </div>
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