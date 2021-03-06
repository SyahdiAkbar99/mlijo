<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('admin/DashAdmin_model', 'dam');
        $this->load->model('seller/DashSeller_model', 'dsm');
        $this->load->model('buyer/IndexBuyer_model', 'ibm');
        date_default_timezone_set("Asia/Jakarta");
    }



    //Dashboard Admin
    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
        $data['countUser'] = $this->dam->count_user();
        $data['transaksi1'] = $this->dam->getOrderMonthly();
        $data['transaksi2'] = $this->dam->getOrderFinish();
        $data['ongkir1'] = $this->dam->getLokasiUser();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin/footer', $data);
    }



    //Data Users
    public function data_user()
    {
        $this->form_validation->set_rules('name_user', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email_user', 'Email', 'trim|required|valid_email|is_unique[user.email_user]');
        $this->form_validation->set_rules('no_telp', 'No Telpon', 'trim|required|numeric');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('level', 'Level', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Users';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_users'] = $this->dam->getAllUser();
            $data['ongkir'] = $this->dam->shipping();

            // echo '<pre>';
            // print_r($data['data_users']);
            // echo '</pre>';
            // die;

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/data_user', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $data = [
                'nama_user' => $this->input->post('name_user'),
                'email_user' => $this->input->post('email_user'),
                'no_telp' => $this->input->post('no_telp'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level'),
                'alamat' => $this->input->post('alamat'),
                'date_created' => time(),
                'id_akses' => 2,
            ];
            $query = $this->db->insert('user', $data);
            if ($query) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Input Data Penjual Berhasil
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('Admin/data_user');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Input Data Penjual Gagal (alamat)
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('Admin/data_user');
            }
        }
    }

    public function edit_data_user()
    {
        $this->form_validation->set_rules('name_user', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email_user', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('no_telp', 'No Telpon', 'trim|required|numeric');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('level', 'Level', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Users';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_users'] = $this->dam->getAllUser();


            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/data_user', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $id = $this->input->post('id');
            $data = [
                'nama_user' => $this->input->post('name_user'),
                'email_user' => $this->input->post('email_user'),
                'no_telp' => $this->input->post('no_telp'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level'),
                'alamat' => $this->input->post('alamat'),
                'date_created' => time(),
                'id_akses' => 2,
            ];
            $this->db->where('id_user', $id);
            $query = $this->db->update('user', $data);
            if ($query) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Update Data Penjual Berhasil
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('Admin/data_user');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Update Data Penjual Gagal
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('Admin/data_user');
            }
        }
    }

    public function delete_data_user() //DELETE USER STILL COMPLEX ALGORITHM
    {
        $where =  $this->input->get('id');
        $tb['user'] = $this->db->get_where('user', ['id_user' => $this->input->get('id')])->row_array();

        $this->dam->deleteUser($where);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Data User Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin/data_user');
    }


    // fungsi membuat kode pemesanan sesuai tanggal
    public function Kode()
    {
        $tgl = date('d.m.');
        $tahun = date('Y/');
        $date = date('d.m.');
        $this->db->like('kode_transaksi', $tgl);
        $this->db->like('kode_transaksi', $tahun);
        $this->db->select('RIGHT(orders.kode_transaksi,2) as kode', FALSE);
        $this->db->order_by('kode_transaksi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('orders');  //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //cek kode jika telah tersedia    
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;  //cek jika kode belum terdapat pada table
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = $date . 'PDR/' . $tahun . $batas;  //format kode
        return $kodetampil;
    }

    //Data Produk
    public function data_produk()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('type', 'type', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('harga', 'Harga User', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);

        $this->form_validation->set_rules('id_ongkir', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('id_category', 'Kategori', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Produk';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_product'] = $this->dam->product();
            $data['shipping'] = $this->dam->shipping();
            $data['category'] = $this->dam->category();
            $data['jadwals'] = $this->dam->jadwals();
            $data['code'] = $this->Kode();
            // echo '<pre>';
            // print_r($data['data_product']);
            // echo '</pre>';
            // die;
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/data_produk', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            // cek jika ada gambar
            $upload_image = $_FILES['gambar']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/produk/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '1024'; // pixel
                $config['max_height'] = '1024'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    //get gambar yang baru
                    $data = [
                        'nama_produk' => $this->input->post('nama_produk'),
                        'type' => $this->input->post('type'),
                        'harga' => $this->input->post('harga'),
                        'berat' => $this->input->post('berat'),
                        'stok' => $this->input->post('stok'),
                        'gambar' => $this->upload->data('file_name'),
                        'keterangan' => $this->input->post('keterangan'),
                        'id_lokasi' => $this->input->post('id_ongkir'),
                        'id_category' => $this->input->post('id_category'),
                        'id_user' => $this->session->userdata('id_user'),
                    ];
                    $this->dsm->insert_product($data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Produk berhasil ditambahkan !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/data_produk');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 1000px x 1000px
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/data_produk');
                }
            }

            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'type' => $this->input->post('type'),
                'harga' => $this->input->post('harga'),
                'berat' => $this->input->post('berat'),
                'gambar' => $this->upload->data('file_name'),
                'keterangan' => $this->input->post('keterangan'),
                'id_lokasi' => $this->input->post('id_ongkir'),
                'id_category' => $this->input->post('id_category'),
                'id_user' => $this->session->userdata('id_user'),
            ];

            $this->dsm->insert_product($data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Produk berhasil ditambahkan !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/data_produk');
        }
    }


    public function edit_produk()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('type', 'type', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('harga', 'Harga User', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('berat', 'Berat', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);

        $this->form_validation->set_rules('id_ongkir', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('id_category', 'Kategori', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Produk';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_product'] = $this->dsm->product();
            $data['shipping'] = $this->dam->shipping();
            $data['category'] = $this->dam->category();

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/data_produk', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            // cek jika ada gambar
            $tb['product'] = $this->db->get_where('product', ['id_product' => $this->input->post('id')])->row_array();
            $upload_image = $_FILES['gambar']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/produk/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '1024'; // pixel
                $config['max_height'] = '1024'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    //get gambar yang lama
                    $old_image = $tb['product']['gambar'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . './assets/img/produk/' . $old_image);
                    }

                    //get gambar yang baru
                    $id = $this->input->post('id');
                    $data = [
                        'nama_produk' => $this->input->post('nama_produk'),
                        'type' => $this->input->post('type'),
                        'harga' => $this->input->post('harga'),
                        'berat' => $this->input->post('berat'),
                        'stok' => $this->input->post('stok'),
                        'gambar' => $this->upload->data('file_name'),
                        'keterangan' => $this->input->post('keterangan'),
                        'id_lokasi' => $this->input->post('id_ongkir'),
                        'id_category' => $this->input->post('id_category'),
                        'id_user' => $this->session->userdata('id_user'),
                    ];
                    $this->db->where('id_product', $id);
                    $query = $this->db->update('product', $data);
                    if ($query) {
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-success" role="alert">
                            Data Product berhasil diedit dengan gambar !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        );
                        redirect('Admin/data_produk');
                    } else {
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger" role="alert">
                            Data Product diedit tanpa gambar !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                        );
                        redirect('Admin/data_produk');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 1000px x 1000px
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/data_produk');
                }
            }

            $id = $this->input->post('id');
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'type' => $this->input->post('type'),
                'harga' => $this->input->post('harga'),
                'berat' => $this->input->post('berat'),
                'gambar' => $this->upload->data('file_name'),
                'keterangan' => $this->input->post('keterangan'),
                'id_lokasi' => $this->input->post('id_ongkir'),
                'id_category' => $this->input->post('id_category'),
                'id_user' => $this->session->userdata('id_user'),
            ];

            $this->db->where('id_product', $id);
            $query1 = $this->db->update('product', $data);

            if ($query1) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Data Product berhasil ditambahkan !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Admin/data_produk');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Data Product gagal ditambahkan !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Admin/data_produk');
            }
        }
    }

    public function delete_produk() //DELETE USER STILL COMPLEX ALGORITHM
    {
        $where =  $this->input->get('id');
        $tb['product'] = $this->db->get_where('product', ['id_product' => $this->input->get('id')])->row_array();

        //get gambar yang lama
        $old_image = $tb['product']['gambar'];
        if ($old_image != 'default.png') {
            @unlink(FCPATH . './assets/img/produk/' . $old_image);
        }


        $this->db->where('id_product', $where);
        $this->db->delete('product');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Data Produk Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin/data_produk');
    }


    public function shipping()
    {
        $this->form_validation->set_rules('tempat_kirim', 'Tempat Kirim', 'required|trim', [
            'tempat_kirim' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tarif', 'Tarif', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Lokasi';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['shipping'] = $this->dam->shipping();

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/ongkir', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            // cek jika ada gambar
            $data = [
                'tempat_kirim' => $this->input->post('tempat_kirim'),
                'tarif' => $this->input->post('tarif'),
            ];

            $this->db->insert('ongkir', $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Ongkir berhasil ditambahkan !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );
            redirect('Admin/shipping');
        }
    }

    public function edit_shipping()
    {
        $this->form_validation->set_rules('tempat_kirim', 'Tempat Kirim', 'required|trim', [
            'tempat_kirim' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tarif', 'Tarif', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Lokasi';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['shipping'] = $this->dam->shipping();

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/ongkir', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $id = $this->input->post('id');
            $data = [
                'tempat_kirim' => $this->input->post('tempat_kirim'),
                'tarif' => $this->input->post('tarif'),
            ];

            $this->db->where('id_ongkir', $id);

            $query = $this->db->update('ongkir', $data);
            if ($query) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Data Lokasi berhasil di-edit !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
                );
                redirect('Admin/shipping');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Data Lokasi gagal di-edit !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
                );
                redirect('Admin/shipping');
            }
        }
    }

    public function delete_shipping()
    {
        $where =  $this->input->get('id');

        $this->db->where('id_ongkir', $where);
        $this->db->delete('ongkir');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Hapus Data Ongkir Berhasil
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('Admin/shipping');
    }

    public function data_kategori()
    {
        $this->form_validation->set_rules('nama_category', 'Nama Kategori', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Kategori';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['category'] = $this->dam->category();

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/kategori', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            // cek jika ada gambar
            $data = [
                'nama_category' => $this->input->post('nama_category'),
            ];

            $this->db->insert('category', $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Kategori berhasil ditambahkan !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );
            redirect('Admin/data_kategori');
        }
    }

    public function edit_kategori()
    {
        $this->form_validation->set_rules('nama_category', 'Nama Kategori', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Kategori';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['category'] = $this->dam->category();

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/kategori', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $id = $this->input->post('id');
            $data = [
                'nama_category' => $this->input->post('nama_category'),
            ];

            $this->db->where('id_category', $id);

            $query = $this->db->update('category', $data);
            if ($query) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Data Kategori berhasil di-edit !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
                );
                redirect('Admin/data_kategori');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Data Kategori gagal di-edit !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
                );
                redirect('Admin/data_kategori');
            }
        }
    }

    public function delete_kategori()
    {
        $where =  $this->input->get('id');

        $this->db->where('id_category', $where);
        $this->db->delete('category');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Hapus Data Kategori Berhasil
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('Admin/data_kategori');
    }

    //Riwayat Penjualan
    public function transaksi()
    {
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();

        //tampilkan data Produk sesuai user
        $data['riwayat_trans'] = $this->dam->riwayat_transaksi();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('admin/transaksi', $data);
        $this->load->view('templates/admin/footer', $data);
    }

    public function riwayat_transaksi()
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();

        //tampilkan data Produk sesuai user
        $data['riwayat_trans'] = $this->dam->riwayat_transaksi();
        // echo '<pre>';
        // print_r($data['riwayat_trans']);
        // echo '</pre>';
        // die;
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('admin/riwayat_transaksi', $data);
        $this->load->view('templates/admin/footer', $data);
    }

    public function sended_confirm()
    {
        $id = $this->input->get('id');
        $data = [
            'proses' => 1,
        ];
        $this->db->where('id_order', $id);
        $query = $this->db->update('orders', $data);
        if ($query) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Berhasil Dikonfirmasi "Kirim" !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('Admin/riwayat_transaksi');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                Gagal Dikonfirmasi "Kirim" !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/riwayat_transaksi');
        }
    }

    public function otw_confirm()
    {
        $id = $this->input->get('id');
        $data = [
            'proses' => 2,
        ];
        $this->db->where('id_order', $id);
        $query = $this->db->update('orders', $data);
        if ($query) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Berhasil Dikonfirmasi "Dijalan" !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('Admin/riwayat_transaksi');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                Gagal Dikonfirmasi "Dijalan" !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/riwayat_transaksi');
        }
    }

    public function done_confirm()
    {
        $id = $this->input->get('id');
        $data = [
            'proses' => 3,
        ];
        $this->db->where('id_order', $id);
        $query = $this->db->update('orders', $data);
        if ($query) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Berhasil Dikonfirmasi "Selesai" !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('Admin/riwayat_transaksi');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                Gagal Dikonfirmasi "Selesai" !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/riwayat_transaksi');
        }
    }

    public function add_orders()
    {
        $this->form_validation->set_rules('harga', 'Harga User', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('stok', 'Jumlah', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Produk';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_product'] = $this->dsm->product();
            $data['shipping'] = $this->dam->shipping();
            $data['category'] = $this->dam->category();
            $data['code'] = $this->Kode();

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/data_produk', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $data = [
                'kode_transaksi' => $this->input->post('kode_transaksi'),
                'nama_produk' => $this->input->post('nama_produk'),
                'type' => $this->input->post('type'),
                'harga' => $this->input->post('harga'),
                'berat' => $this->input->post('berat'),
                'stok' => $this->input->post('stok'),
                'gambar' => $this->input->post('gambar'),
                'keterangan' => $this->input->post('keterangan'),
                'username' => $this->input->post('username'),
                'waktu_input' => $this->input->post('waktu_input'),
                'id_ongkir' => $this->input->post('id_ongkir'),
                'id_category' => $this->input->post('id_category'),
                'id_pembeli' => $this->session->userdata('id_user'),
                'id_penjual' => $this->input->post('penjual_id'),
                'id_jadwal' => $this->input->post('id_jadwal'),
                'id_product' => $this->input->post('id'),
            ];
            $query = $this->db->insert('orders', $data);
            $id = $this->db->insert_id();
            if ($query) {
                $data = [
                    'id_order' => $id,
                    'id_product' => $this->input->post('id'),
                    'harga_pesan' => $this->input->post('harga'),
                    'jumlah_pesan' => $this->input->post('stok'),
                    'type' => $this->input->post('type'),
                ];
                $query1 = $this->db->insert('orderdetails', $data);
                if ($query1) {
                    $data = [
                        'id_product' => $this->input->post('id'),
                        'nama_produk' => $this->input->post('nama_produk'),
                        'berat' => $this->input->post('berat'),
                        'stok' => $this->input->post('stok'),
                        'gambar' => $this->input->post('gambar'),
                    ];
                    $query2 = $this->db->insert('barang_keluar', $data);
                    if ($query2) {
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-success" role="alert">
                            Data Order berhasil ditambahkan !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>'
                        );
                        redirect('Admin/riwayat_transaksi');
                    } else {
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger" role="alert">
                            Data Order gagal ditambahkan !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>'
                        );
                        redirect('Admin/riwayat_transaksi');
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                        Data Order gagal ditambahkan (barang keluar) !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/riwayat_transaksi');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Data Order (details) gagal ditambahkan !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Admin/riwayat_transaksi');
            }
        }
    }


    //Riwayat Penjualan
    public function jadwal()
    {

        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Jadwal';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();

            //tampilkan data Produk sesuai user
            $data['jadwals'] = $this->dam->jadwals();
            $data['products'] = $this->dam->only_product();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/jadwal', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $data = [
                'tanggal_ready' => $this->input->post('hari'),
                'id_product' => $this->input->post('nama_produk'),
            ];
            $query = $this->db->insert('jadwal_po', $data);
            if ($query) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Jadwal berhasil ditambahkan !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Admin/jadwal');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Jadwal gagal ditambahkan !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Admin/jadwal');
            }
        }
    }

    public function edit_jadwal()
    {

        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Jadwal';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            //tampilkan data Produk sesuai user
            $data['jadwals'] = $this->dam->jadwals();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('admin/jadwal', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $id = $this->input->post('id');
            $data = [
                'tanggal_ready' => $this->input->post('hari'),
                'id_product' => $this->input->post('nama_produk'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('jadwal_po', $data);
            if ($query) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Jadwal berhasil di-edit !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Admin/jadwal');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Jadwal gagal di-edit !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
                );
                redirect('Admin/jadwal');
            }
        }
    }

    public function delete_jadwal()
    {

        $id = $this->input->get('id');

        $this->db->where('id', $id);
        $query = $this->db->delete('jadwal_po');
        if ($query) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    Jadwal berhasil dihapus !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
            );
            redirect('Admin/jadwal');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                    Jadwal gagal dihapus !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
            );
            redirect('Admin/jadwal');
        }
    }





    public function my_profile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/my_profile', $data);
        $this->load->view('templates/admin/footer', $data);
    }
    public function edit_profile()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telpon', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Profile';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/edit_profile', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $where = $this->input->post('email_user');
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();

            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/profile/admin/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '500'; // pixel
                $config['max_height'] = '500'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang lama
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . 'assets/admin/img/profile/admin/' . $old_image);
                    }

                    //dengan foto
                    $data = [
                        'name' => $this->input->post('name'),
                        'no_telp' => $this->input->post('no_telp'),
                        //get gambar yang baru
                        'image' => $this->upload->data('file_name')
                    ];
                    $this->dam->updateUserAdmin($where, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Profile berhasil diedit !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/edit_profile');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 500px x 500px
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/edit_profile');
                }
            }

            //tanpa foto
            $data = [
                'name' => $this->input->post('name'),
                'no_telp' => $this->input->post('no_telp'),
            ];
            $this->dam->updateUserAdmin($where, $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    Profile anda sudah terupdate !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>'
            );
            redirect('Admin/edit_profile');
        }
    }
    public function change_password()
    {
        $data['title'] = "Change Password";
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim|min_length[6]', [
            'required' => '%s input tidak boleh kosong',
            'min_length' => '%s singkat minimal 6 karakter !',
        ]);
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]', [
            'required' => '%s input tidak boleh kosong',
            'min_length' => '%s singkat minimal 6 karakter !',
            'matches' => '%s tidak sama dengan Confirm New Password!',
        ]);
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]', [
            'required' => '%s input tidak boleh kosong',
            'min_length' => '%s singkat minimal 6 karakter !',
            'matches' => '%s tidak sama dengan New Password !',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/change_password', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                        Current Password Salah !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                );
                redirect('Admin/change_password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> New Password tidak boleh sama dengan Current Password ! 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/change_password');
                } else {
                    //password bener
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email_user', $this->session->userdata('email_user'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Ubah password berhasil ! 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/change_password');
                }
            }
        }
    }
}
