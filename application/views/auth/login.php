<div class="page-header clear-filter">
    <div class="page-header-image" style="background-image: url('<?= base_url('assets/img/cover.jpg') ?>');"></div>
    <div class="content-center">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="card">
                <?= $this->session->flashdata('message') ?>
                <div class="card-header bg-success py-3 mb-3 text-center card-head">
                    <span class="text my-auto text-center btn btn-success btn-sm">
                        <h4><?= $title; ?></h4>
                    </span>
                </div>
                <div class="card-body p-3">
                    <form action="<?= base_url('Auth'); ?>" method="post">
                        <div class="input-group p-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">email</i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="email_user" id="email_user" value="<?= set_value('email') ?>" placeholder="Email">
                        </div>
                        <?= form_error('email_user', '<small class="text-danger">', '</small>'); ?>
                        <div class="input-group p-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">lock</i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-info">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>