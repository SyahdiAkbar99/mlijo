<footer class="footer">
    <div class="container-fluid">
        <div class="copyright float-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script> Copyright your website
        </div>
    </div>
</footer>
</div>
</div>
<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title"> Ganti Background </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                    <div class="badge-colors ml-auto mr-auto">
                        <span class="badge filter badge-purple" data-color="purple"></span>
                        <span class="badge filter badge-azure" data-color="azure"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-warning" data-color="orange"></span>
                        <span class="badge filter badge-danger" data-color="danger"></span>
                        <span class="badge filter badge-rose active" data-color="rose"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Images</li>
            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= base_url('assets/img/sidebar-1.jpg') ?>" alt="">
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= base_url('assets/img/sidebar-2.jpg') ?>" alt="">
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= base_url('assets/img/sidebar-3.jpg') ?>" alt="">
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= base_url('assets/img/sidebar-4.jpg') ?>" alt="">
                </a>
            </li>
        </ul>
    </div>
</div>
<!--   Core JS Files   -->
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-material-design.min.js') ?>"></script>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>

<script src="<?= base_url('assets/js/perfect-scrollbar.jquery.min.js') ?>"></script>

<script src="<?= base_url('assets/js/moment.min.js') ?>"></script>

<script src="<?= base_url('assets/js/sweetalert2.js') ?>"></script>

<script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>

<script src="<?= base_url('assets/js/jquery.bootstrap-wizard.js') ?>"></script>

<script src="<?= base_url('assets/js/bootstrap-selectpicker.js') ?>"></script>

<script src="<?= base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>

<script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>

<script src="<?= base_url('assets/js/bootstrap-tagsinput.j') ?>s"></script>

<script src="<?= base_url('assets/js/jasny-bootstrap.min.js') ?>"></script>

<script src="<?= base_url('assets/js/fullcalendar.min.js') ?>"></script>

<script src="<?= base_url('assets/js/jquery-jvectormap.js') ?>"></script>

<script src="<?= base_url('assets/js/nouislider.min.js') ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<script src="<?= base_url('assets/js/arrive.min.js') ?>"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjiJnVUrKFKoh7Rk4ZB10pw32jO6s17mU"></script>
<!-- Chartist JS -->
<script src="<?= base_url('assets/js/chartist.min.js') ?>"></script>

<!-- Datatables -->

<script src="<?= base_url('assets/js/bootstrap-notify.js') ?>"></script>

<script src="<?= base_url('assets/js/material-dashboard.js?v=2.1.2') ?>" type="text/javascript"></script>

<script src="<?= base_url('assets/js/demo.js') ?>"></script>
<script>
    $(document).ready(function() {
        $().ready(function() {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }

            }

            $('.fixed-plugin a').click(function(event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function() {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function() {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').change(function() {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function() {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function() {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function() {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function() {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

    });

    //Button Export Data Tanaman Menu
    $(document).ready(function() {
        $('#data-users').DataTable({
            dom: 'lfrtip',
            autoWidth: true,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            buttons: [{
                    className: 'btn-danger btn-round btn-sm mr-2',
                    extend: 'pdfHtml5',
                    text: 'Cetak (PDF) <i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9],
                    },
                    title: 'User'
                },
                {
                    className: 'btn-success btn-round btn-sm mr-2',
                    extend: 'excelHtml5',
                    text: 'Cetak (Excel) <i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    },
                    title: 'User'
                }
            ],
            select: {
                style: "multi"
            }
        });
    });
    $(document).ready(function() {
        $('#data-produk').DataTable({
            dom: 'lfrtip',
            autoWidth: true,
            lengthMenu: [
                [3, 5, 10, 25, 50, -1],
                [3, 5, 10, 25, 50, "All"]
            ],
            buttons: [{
                    className: 'btn-danger btn-round btn-sm mr-2',
                    extend: 'pdfHtml5',
                    text: 'Cetak (PDF) <i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9],
                    },
                    title: 'Produk'
                },
                {
                    className: 'btn-success btn-round btn-sm mr-2',
                    extend: 'excelHtml5',
                    text: 'Cetak (Excel) <i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    },
                    title: 'Produk'
                }
            ],
            select: {
                style: "multi"
            }
        });
    });
    $(document).ready(function() {
        $('#data-ongkir').DataTable({
            dom: 'lfrtip',
            autoWidth: true,
            lengthMenu: [
                [3, 5, 10, 25, 50, -1],
                [3, 5, 10, 25, 50, "All"]
            ],
            buttons: [{
                    className: 'btn-danger btn-round btn-sm mr-2',
                    extend: 'pdfHtml5',
                    text: 'Cetak (PDF) <i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9],
                    },
                    title: 'Produk'
                },
                {
                    className: 'btn-success btn-round btn-sm mr-2',
                    extend: 'excelHtml5',
                    text: 'Cetak (Excel) <i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    },
                    title: 'Produk'
                }
            ],
            select: {
                style: "multi"
            }
        });
    });
    $(document).ready(function() {
        $('#data-kategori').DataTable({
            dom: 'lfrtip',
            autoWidth: true,
            lengthMenu: [
                [3, 5, 10, 25, 50, -1],
                [3, 5, 10, 25, 50, "All"]
            ],
            buttons: [{
                    className: 'btn-danger btn-round btn-sm mr-2',
                    extend: 'pdfHtml5',
                    text: 'Cetak (PDF) <i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9],
                    },
                    title: 'Produk'
                },
                {
                    className: 'btn-success btn-round btn-sm mr-2',
                    extend: 'excelHtml5',
                    text: 'Cetak (Excel) <i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    },
                    title: 'Produk'
                }
            ],
            select: {
                style: "multi"
            }
        });
    });
    $(document).ready(function() {
        $('#data-transaksi').DataTable({
            dom: 'lfrtip',
            autoWidth: true,
            lengthMenu: [
                [3, 5, 10, 25, 50, -1],
                [3, 5, 10, 25, 50, "All"]
            ],
            buttons: [{
                    className: 'btn-danger btn-round btn-sm mr-2',
                    extend: 'pdfHtml5',
                    text: 'Cetak (PDF) <i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9],
                    },
                    title: 'Produk'
                },
                {
                    className: 'btn-success btn-round btn-sm mr-2',
                    extend: 'excelHtml5',
                    text: 'Cetak (Excel) <i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    },
                    title: 'Produk'
                }
            ],
            select: {
                style: "multi"
            }
        });
    });
    $(document).ready(function() {
        $('#data-jadwal').DataTable({
            dom: 'lfrtip',
            autoWidth: true,
            lengthMenu: [
                [3, 5, 10, 25, 50, -1],
                [3, 5, 10, 25, 50, "All"]
            ],
            buttons: [{
                    className: 'btn-danger btn-round btn-sm mr-2',
                    extend: 'pdfHtml5',
                    text: 'Cetak (PDF) <i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9],
                    },
                    title: 'Produk'
                },
                {
                    className: 'btn-success btn-round btn-sm mr-2',
                    extend: 'excelHtml5',
                    text: 'Cetak (Excel) <i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    },
                    title: 'Produk'
                }
            ],
            select: {
                style: "multi"
            }
        });
    });
</script>
</body>

</html>