<div class="content">
    <div class="container-fluid">
        <?= $this->session->flashdata('message') ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <span class="card-icon">
                            <i class="material-icons">paid</i>
                        </span>
                        <p class="card-category">Transaksi Hari Ini (selesai /pun belum)</p>
                        <h3 class="card-title">n()x
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">paid / event</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">paid</i>
                        </div>
                        <p class="card-category">Transaksi Hari Ini (selesai)</p>
                        <h3 class="card-title">n()x</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> order desc limit 1
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">people</i>
                        </div>
                        <p class="card-category">User</p>
                        <h3 class="card-title">n()x</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-success">people</i> User
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">location_on</i>
                        </div>
                        <p class="card-category">Lokasi</p>
                        <h3 class="card-title">n()x</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">location_on</i> Lokasi Penjual
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>