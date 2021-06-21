<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('admin/DashAdmin_model', 'dam');
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
        $this->load->view('templates/admin/navbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/data_user', $data);
        $this->load->view('templates/admin/footer', $data);
    }
    public function inactive_data_user()
    {
        $where =  $this->input->get('id');
        $data = [
            'is_active' => 0,
        ];
        $this->dam->statusUser($where, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Inactive Data User Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin/data_user');
    }
    public function active_data_user()
    {
        $where =  $this->input->get('id');
        $data = [
            'is_active' => 1,
        ];
        $this->dam->statusUser($where, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Aktivasi Data User Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin/data_user');
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



    //Data Banner
    public function data_banner()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Banner';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_banner'] = $this->dam->data_banner();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/data_banner', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/data/admin/banner/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '7000'; // pixel
                $config['max_height'] = '7000'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang baru
                    $data = [
                        'nama' => $this->input->post('nama'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'urutan' => $this->input->post('urutan'),
                        'image' => $this->upload->data('file_name'),
                    ];
                    $this->dam->insert_data_banner($data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Banner berhasil ditambahkan !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/data_banner');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2 MB
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/data_banner');
                }
            }

            $data = [
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'urutan' => $this->input->post('urutan'),
            ];

            $this->dam->insert_data_banner($data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Banner berhasil ditambahkan !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/data_banner');
        }
    }
    public function update_data_banner()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Banner';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_banner'] = $this->dam->data_banner();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/data_banner', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $where = $this->input->post('id');
            $tb['data_bann'] = $this->db->get_where('data_banner', ['id' => $this->input->post('id')])->row_array();

            $data = [
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'urutan' => $this->input->post('urutan'),
            ];

            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/data/admin/banner/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '7000'; // pixel
                $config['max_height'] = '7000'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang lama
                    $old_image = $tb['data_bann']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . 'assets/admin/img/data/admin/banner/' . $old_image);
                    }
                    //get gambar yang baru

                    $data = [
                        'nama' => $this->input->post('nama'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'urutan' => $this->input->post('urutan'),
                        'image' => $this->upload->data('file_name')
                    ];
                    $this->dam->update_data_banner($where, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Banner berhasil diedit !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/data_banner');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2MB
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/data_banner');
                }
            }
            // echo '<pre>';
            // print_r($data);
            // die;
            // echo '</pre>';


            $this->dam->update_data_banner($where, $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Banner berhasil diedit !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/data_banner');
        }
    }
    public function delete_data_banner()
    {
        $where = $this->input->post('id');
        $tb['data_bann'] = $this->db->get_where('data_banner', ['id' => $this->input->post('id')])->row_array();

        //get gambar yang lama
        $old_image = $tb['data_bann']['image'];
        if ($old_image != 'default.png') {
            @unlink(FCPATH . 'assets/admin/img/data/admin/banner/' . $old_image);
        }

        $this->dam->delete_data_banner($where);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Banner berhasil diedit !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>'
        );
        redirect('Admin/data_banner');
    }



    //DataPerawatan
    public function data_penanaman()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
        $this->form_validation->set_rules('subjudul', 'Sub Judul', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Penanaman';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_penanaman'] = $this->dam->data_penanaman();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/data_penanaman', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/data/admin/penanaman/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '700'; // pixel
                $config['max_height'] = '700'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang baru
                    $data = [
                        'judul' => $this->input->post('judul'),
                        'subjudul' => $this->input->post('subjudul'),
                        'urutan' => $this->input->post('urutan'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'image' => $this->upload->data('file_name'),
                    ];
                    $this->dam->insert_data_penanaman($data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Penanaman berhasil ditambahkan !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/data_penanaman');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2 MB dan Dimensi 700 x 700 pixels
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/data_penanaman');
                }
            }

            $data = [
                'judul' => $this->input->post('judul'),
                'subjudul' => $this->input->post('subjudul'),
                'urutan' => $this->input->post('urutan'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            $this->dam->insert_data_penanaman($data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Penanaman berhasil ditambahkan !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/data_penanaman');
        }
    }
    public function update_data_penanaman()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
        $this->form_validation->set_rules('subjudul', 'Sub Judul', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Penanaman';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_penanaman'] = $this->dam->data_penanaman();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/data_penanaman', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $where = $this->input->post('id');
            $tb['data_tanam'] = $this->db->get_where('data_penanaman', ['id' => $this->input->post('id')])->row_array();

            $data = [
                'judul' => $this->input->post('judul'),
                'subjudul' => $this->input->post('subjudul'),
                'urutan' => $this->input->post('urutan'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/data/admin/penanaman/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '700'; // pixel
                $config['max_height'] = '700'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang lama
                    $old_image = $tb['data_tanam']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . 'assets/admin/img/data/admin/penanaman/' . $old_image);
                    }
                    //get gambar yang baru

                    $data = [
                        'judul' => $this->input->post('judul'),
                        'subjudul' => $this->input->post('subjudul'),
                        'urutan' => $this->input->post('urutan'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'image' => $this->upload->data('file_name')
                    ];
                    $this->dam->update_data_penanaman($where, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Penanaman berhasil diedit !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/data_penanaman');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2MB dan dimensi 700 x 700 pixels
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/data_penanaman');
                }
            }
            // echo '<pre>';
            // print_r($data);
            // die;
            // echo '</pre>';


            $this->dam->update_data_penanaman($where, $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Penanaman berhasil diedit !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/data_penanaman');
        }
    }
    public function delete_data_penanaman()
    {
        $where = $this->input->post('id');
        $tb['data_tanam'] = $this->db->get_where('data_penanaman', ['id' => $this->input->post('id')])->row_array();

        //get gambar yang lama
        $old_image = $tb['data_tanam']['image'];
        if ($old_image != 'default.png') {
            @unlink(FCPATH . 'assets/admin/img/data/admin/penanaman/' . $old_image);
        }

        $this->dam->delete_data_penanaman($where);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Penanaman berhasil diedit !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>'
        );
        redirect('Admin/data_penanaman');
    }

    //Data Perawatan
    public function data_perawatan()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
        $this->form_validation->set_rules('subjudul', 'Sub Judul', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Perawatan';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_perawatan'] = $this->dam->data_perawatan();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/data_perawatan', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/data/admin/perawatan/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '700'; // pixel
                $config['max_height'] = '700'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang baru
                    $data = [
                        'judul' => $this->input->post('judul'),
                        'subjudul' => $this->input->post('subjudul'),
                        'urutan' => $this->input->post('urutan'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'image' => $this->upload->data('file_name'),
                    ];
                    $this->dam->insert_data_perawatan($data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Perawatan berhasil ditambahkan !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/data_perawatan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2 MB dan Dimensi 700 x 700 pixels
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/data_perawatan');
                }
            }

            $data = [
                'judul' => $this->input->post('judul'),
                'subjudul' => $this->input->post('subjudul'),
                'urutan' => $this->input->post('urutan'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            $this->dam->insert_data_perawatan($data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Perawatan berhasil ditambahkan !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/data_perawatan');
        }
    }
    public function update_data_perawatan()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
        $this->form_validation->set_rules('subjudul', 'Sub Judul', 'trim|required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Perawatan';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['data_perawatan'] = $this->dam->data_perawatan();
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/navbar', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/data_perawatan', $data);
            $this->load->view('templates/admin/footer', $data);
        } else {
            $where = $this->input->post('id');
            $tb['data_tawar'] = $this->db->get_where('data_perawatan', ['id' => $this->input->post('id')])->row_array();

            $data = [
                'judul' => $this->input->post('judul'),
                'subjudul' => $this->input->post('subjudul'),
                'urutan' => $this->input->post('urutan'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            // cek jika ada gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/admin/img/data/admin/perawatan/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '700'; // pixel
                $config['max_height'] = '700'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get gambar yang lama
                    $old_image = $tb['data_tawar']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . 'assets/admin/img/data/admin/perawatan/' . $old_image);
                    }
                    //get gambar yang baru

                    $data = [
                        'judul' => $this->input->post('judul'),
                        'subjudul' => $this->input->post('subjudul'),
                        'urutan' => $this->input->post('urutan'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'image' => $this->upload->data('file_name')
                    ];
                    $this->dam->update_data_perawatan($where, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Data Perawatan berhasil diedit !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>'
                    );
                    redirect('Admin/data_perawatan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Ukuran melebihi batas. Maksimal 2MB dan dimensi 700 x 700 pixels
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('Admin/data_perawatan');
                }
            }
            // echo '<pre>';
            // print_r($data);
            // die;
            // echo '</pre>';


            $this->dam->update_data_perawatan($where, $data);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Data Perawatan berhasil diedit !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>'
            );
            redirect('Admin/data_perawatan');
        }
    }
    public function delete_data_perawatan()
    {
        $where = $this->input->post('id');
        $tb['data_tawar'] = $this->db->get_where('data_perawatan', ['id' => $this->input->post('id')])->row_array();

        //get gambar yang lama
        $old_image = $tb['data_tawar']['image'];
        if ($old_image != 'default.png') {
            @unlink(FCPATH . 'assets/admin/img/data/admin/perawatan/' . $old_image);
        }

        $this->dam->delete_data_perawatan($where);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Perawatan berhasil diedit !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>'
        );
        redirect('Admin/data_perawatan');
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
