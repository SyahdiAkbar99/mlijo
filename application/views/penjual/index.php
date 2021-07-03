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
                        <p class="card-category">Transaksi Bulan Ini (selesai / pun belum)</p>
                        <?php foreach ($transaksi1 as $trf1) : ?>
                            <h3 class="card-title"><?= $trf1['sumtran']; ?> | <?= $trf1['bulan'] ?>
                            </h3>
                        <?php endforeach; ?>
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
                        <p class="card-category">Transaksi Hari Ini (selesai) </p>
                        <?php foreach ($transaksi2 as $trf2) : ?>
                            <h3 class="card-title"><?= $trf2['sumtran']; ?> | <?= $trf2['bulan']; ?></h3>
                        <?php endforeach; ?>
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
                        <h3 class="card-title">
                            <?php foreach ($countUser as $row) : ?>
                                <?= $row['penjual']; ?>
                            <?php endforeach; ?>
                        </h3>
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
                        <?php foreach ($ongkir1 as $onr) : ?>
                            <h3 class="card-title"><?= $onr['sumrim']; ?></h3>
                        <?php endforeach; ?>
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