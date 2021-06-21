<div class="page-header clear-filter">
    <div class="page-header-image" style="background-image: url('<?= base_url('assets/img/cover.jpg') ?>');"></div>
    <div class="content-center">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="card">
                <?= $this->session->flashdata('message') ?>
                <div class="card-header bg-success py-3 mb-3 text-center card-head">
                    <h6>
                        <a href="<?= base_url('Auth'); ?>" class="text my-auto text-center btn btn-success btn-sm">Login</a>
                    </h6>
                </div>
                <div class="card-body pr-3">
                    <form action="<?= base_url('Auth/registration_user_admin'); ?>" method="post">
                        <div class="input-group pr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">face</i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="name_user" id="name_user" placeholder="Name">
                        </div>
                        <?= form_error('name_user', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="input-group pr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">email</i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="email_user" id="email_user" value="<?= set_value('email') ?>" placeholder="Email">
                        </div>
                        <?= form_error('email_user', '<small class="text-danger">', '</small>'); ?>
                        <div class="input-group pr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">lock</i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="input-group pr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">call</i>
                                </span>
                            </div>
                            <input type="tel" class="form-control" name="no_telp" id="no_telp" placeholder="No Telpon">
                        </div>
                        <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="input-group pr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">account_circle</i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        </div>
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="input-group pr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">male</i>
                                    <i class="material-icons">female</i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin">
                        </div>
                        <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="input-group pr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">home</i>
                                </span>
                            </div>
                            <input type="tel" class="form-control" name="alamat" id="alamat" placeholder="Alamat">
                        </div>
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="input-group pr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">child_friendly</i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir">
                        </div>
                        <?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="input-group pr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">event</i>
                                </span>
                            </div>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir">
                        </div>
                        <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-info">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>