<div class="sidebar" data-color="purple" data-background-color="white" data-image="<?= base_url('assets/img/cover.jpg') ?>">
    <div class="logo">
        <a href="<?= base_url('Admin') ?>" class="simple-text logo-normal" style="margin: -20px -30px -20px -30px;">
            <div class="card mx-auto" style="width: 4rem;">
                <img class="card-img-top" src="<?= base_url('assets/img/favicon.png') ?>" alt="Card image cap">
            </div>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <!-- QUERY MENU -->
            <?php
            $role_id = $this->session->userdata('id_akses');
            $queryMenu = "SELECT user_menu.id, user_menu.menu
                                FROM user_menu JOIN user_access_menu
                                ON user_menu.id = user_access_menu.menu_id
                                WHERE user_access_menu.role_id = $role_id
                                ORDER BY user_access_menu.menu_id ASC";
            $menu = $this->db->query($queryMenu)->result_array(); ?>
            <?php
            // echo '<pre>';
            // print_r($menu);
            // echo '</pre>';
            // die;
            ?>
            <!-- END QUERY MENU -->

            <!-- LOOPING MENU -->
            <?php foreach ($menu as $m) : ?>
                <li class="nav-header text-secondary text-center m-3">
                    <h6><?= $m['menu']; ?></h6>
                </li>

                <!-- PREPARE SUBMENU SESUAI MENU -->
                <?php
                $menuId = $m['id'];
                $querySubMenu = "SELECT * FROM user_sub_menu JOIN user_menu
                                        ON user_sub_menu.menu_id = user_menu.id
                                        WHERE user_sub_menu.menu_id = $menuId
                                        AND user_sub_menu.is_active = 1
                                        ORDER BY user_sub_menu.urutan ASC";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                // echo '<pre>';
                // print_r($subMenu);
                // echo '</pre>';
                // die;
                ?>

                <?php foreach ($subMenu as $sm) : ?>
                    <?php if ($title == $sm['title']) : ?>

                        <li class="nav-item active">
                            <a href="<?= base_url($sm['url']) ?>" class="nav-link">

                            <?php else : ?>
                        <li class="nav-item">

                            <a href=" <?= base_url($sm['url']) ?>" class="nav-link bg-secondary">

                            <?php endif; ?>

                            <i class="material-icons"><?= $sm['icon']; ?></i>
                            <p>
                                <?= $sm['title']; ?>
                            </p>
                            </a>
                        </li class="mb-3">
                    <?php endforeach; ?>

                <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="main-panel">