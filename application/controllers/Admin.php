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
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin/footer', $data);
    }



    //Data Users
    public function data_user()
    {
        $data['title'] = 'Data Users';
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
        $data['data_users'] = $this->dam->getAllUser();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('admin/data_user', $data);
        $this->load->view('templates/admin/footer', $data);
    }

    public function delete_data_user() //DELETE USER STILL COMPLEX ALGORITHM
    {
        $where =  $this->input->get('id');
        $tb['user'] = $this->db->get_where('user', ['id' => $this->input->get('id')])->row_array();

        //get gambar yang lama
        if ($tb['user']['role_id'] == 2) {
            $old_image = $tb['user']['image'];
            if ($old_image != 'default.png') {
                @unlink(FCPATH . 'assets/admin/img/profile/seller/' . $old_image);
            }
        } else {
            $old_image = $tb['user']['image'];
            if ($old_image != 'default.png') {
                @unlink(FCPATH . 'assets/user/img/profile/' . $old_image);
            }
        }

        $this->dam->deleteUser($where);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Data User Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin/data_user');
    }


    //Data Users
    public function data_produk()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama', 'required|trim');
        $this->form_validation->set_rules('satuan', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('harga_beli', 'Berat', 'required|trim');
        $this->form_validation->set_rules('harga_user', 'Warna', 'required|trim');
        $this->form_validation->set_rules('berat', 'Jumlah', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Harga', 'required|trim');
        $this->form_validation->set_rules('waktu_input', 'Waktu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Produk';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_product'] = $this->dsm->product();

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
                        'satuan' => $this->input->post('satuan'),
                        'harga_beli' => $this->input->post('harga_beli'),
                        'harga_user' => $this->input->post('harga_user'),
                        'berat' => $this->input->post('berat'),
                        'gambar' => $this->upload->data('file_name'),
                        'keterangan' => $this->input->post('keterangan'),
                        'username' => $this->input->post('username'),
                        'waktu_input' => $this->input->post('waktu_input'),
                        // 'user_id' => $this->session->userdata('id'),
                    ];
                    $this->dsm->insert_product($data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Tanaman berhasil ditambahkan !
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
                'satuan' => $this->input->post('satuan'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_user' => $this->input->post('harga_user'),
                'berat' => $this->input->post('berat'),
                'gambar' => $this->upload->data('file_name'),
                'keterangan' => $this->input->post('keterangan'),
                'waktu_input' => $this->input->post('waktu_input'),
            ];

            $this->dsm->insert_product($data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Tanaman berhasil ditambahkan !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/data_produk');
        }
    }

    public function delete_produk() //DELETE USER STILL COMPLEX ALGORITHM
    {
        $where =  $this->input->get('id');
        $tb['product'] = $this->db->get_where('product', ['id_product' => $this->input->get('id')])->row_array();

        //get gambar yang lama
        $old_image = $tb['product']['image'];
        if ($old_image != 'default.png') {
            @unlink(FCPATH . './assets/img/produk/' . $old_image);
        }


        $this->db->where('id_product', $where);
        $this->db->delete('product');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Data User Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin/data_produk');
    }

    public function add_orders()
    {
    }

    public function shipping()
    {
        $this->form_validation->set_rules('tempat_kirim', 'Tempat Kirim', 'required|trim', [
            'tempat_kirim' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tarif', 'Tarif', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Ongkir';
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


    //Riwayat Penjualan
    public function riwayat_transaksi()
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();

        //tampilkan data tanaman sesuai user
        $data['riwayat_penjualan'] = $this->dam->riwayat_transaksi();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('admin/riwayat_transaksi', $data);
        $this->load->view('templates/admin/footer', $data);
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