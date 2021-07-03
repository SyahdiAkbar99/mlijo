<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjual extends CI_Controller
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
        $data['title'] = 'Dashboard Penjual';
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
        $data['countUser'] = $this->dam->count_user();
        $data['transaksi1'] = $this->dam->getOrderMonthly();
        $data['transaksi2'] = $this->dam->getOrderFinish();
        $data['ongkir1'] = $this->dam->getOrderOngkir();

        $this->load->view('templates/penjual/header', $data);
        $this->load->view('templates/penjual/sidebar', $data);
        $this->load->view('templates/penjual/navbar', $data);
        $this->load->view('penjual/index', $data);
        $this->load->view('templates/penjual/footer', $data);
    }

    //Riwayat Penjualan
    public function transaksi()
    {
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();

        //tampilkan data Produk sesuai user
        $data['riwayat_trans'] = $this->dam->riwayat_transaksi();
        $data['code'] = $this->Kode();

        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/transaksi', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            $id = $this->input->post('id_order');
            $data = [
                'status' =>  $this->input->post('status'),
            ];
            $this->db->where('id_order', $id);
            $this->db->update('orders', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                 Data Transaksi berhasil diedit !
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
             </div>'
            );
            redirect('Penjual/transaksi');
        }
    }

    public function riwayat_transaksi()
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();

        //tampilkan data Produk sesuai user
        $data['riwayat_trans'] = $this->dam->riwayat_transaksi();

        $data['code'] = $this->Kode();

        $this->form_validation->set_rules('status', 'Status', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/riwayat_transaksi', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            $id = $this->input->post('id_order');
            $data = [
                'status' =>  $this->input->post('status'),
            ];
            $this->db->where('id_order', $id);
            $this->db->update('orders', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                 Data Transaksi berhasil diedit !
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
             </div>'
            );
            redirect('Penjual/riwayat_transaksi');
        }
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
        $this->form_validation->set_rules('satuan', 'Satuan', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('harga_user', 'Harga User', 'required|trim', [
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
        $this->form_validation->set_rules('waktu_input', 'Waktu', 'required|trim', [
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
            $data['code'] = $this->Kode();

            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/data_produk', $data);
            $this->load->view('templates/penjual/footer', $data);
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
                        'stok' => $this->input->post('stok'),
                        'gambar' => $this->upload->data('file_name'),
                        'keterangan' => $this->input->post('keterangan'),
                        'username' => $this->input->post('username'),

                        'waktu_input' => $this->input->post('waktu_input'),
                        'id_ongkir' => $this->input->post('id_ongkir'),
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
                    redirect('Penjual/data_produk');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                     Ukuran melebihi batas. Maksimal 1000px x 1000px
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>');
                    redirect('Penjual/data_produk');
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
                'username' => $this->input->post('username'),
                'id_ongkir' => $this->input->post('id_ongkir'),
                'id_category' => $this->input->post('id_category'),
                'id_user' => $this->session->userdata('id_user'),

                'waktu_input' => $this->input->post('waktu_input'),
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
            redirect('Penjual/data_produk');
        }
    }


    public function edit_produk()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|trim', [
            'required' => '%s tidak boleh kosong !'
        ]);
        $this->form_validation->set_rules('harga_user', 'Harga User', 'required|trim', [
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
        $this->form_validation->set_rules('waktu_input', 'Waktu', 'required|trim', [
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

            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/data_produk', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            // cek jika ada gambar
            $tb['product'] = $this->db->get_where('product', ['id_product' => $this->input->post('id')])->row_array();
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/produk/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';  //2MB max
                $config['max_width'] = '1024'; // pixel
                $config['max_height'] = '1024'; // pixel

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //get image yang lama
                    $old_image = $tb['product']['image'];
                    if ($old_image != 'default.png') {
                        @unlink(FCPATH . './assets/img/produk/' . $old_image);
                    }

                    //get gambar yang baru
                    $id = $this->input->post('id');
                    $data = [
                        'nama_produk' => $this->input->post('nama_produk'),
                        'satuan' => $this->input->post('satuan'),
                        'harga_beli' => $this->input->post('harga_beli'),
                        'harga_user' => $this->input->post('harga_user'),
                        'berat' => $this->input->post('berat'),
                        'stok' => $this->input->post('stok'),
                        'gambar' => $this->upload->data('file_name'),
                        'keterangan' => $this->input->post('keterangan'),
                        'username' => $this->input->post('username'),
                        'waktu_input' => $this->input->post('waktu_input'),
                        'id_ongkir' => $this->input->post('id_ongkir'),
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
                        redirect('Penjual/data_produk');
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
                        redirect('Penjual/data_produk');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                     Ukuran melebihi batas. Maksimal 1000px x 1000px
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>');
                    redirect('Penjual/data_produk');
                }
            }

            $id = $this->input->post('id');
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'satuan' => $this->input->post('satuan'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_user' => $this->input->post('harga_user'),
                'berat' => $this->input->post('berat'),
                'stok' => $this->input->post('stok'),
                'keterangan' => $this->input->post('keterangan'),
                'username' => $this->input->post('username'),
                'id_ongkir' => $this->input->post('id_ongkir'),
                'id_category' => $this->input->post('id_category'),
                'id_user' => $this->session->userdata('id_user'),

                'waktu_input' => $this->input->post('waktu_input'),
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
                redirect('Penjual/data_produk');
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
                redirect('Penjual/data_produk');
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
            Hapus Data User Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Penjual/data_produk');
    }


    //Data Produk
    public function barang_keluar()
    {
        $this->form_validation->set_rules('id', 'ID PRODUCT', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Barang Keluar';
            $data['user'] = $this->db->get_where('user', ['email_user' => $this->session->userdata('email_user')])->row_array();
            $data['barkel'] = $this->dsm->barang_keluar();

            $this->load->view('templates/penjual/header', $data);
            $this->load->view('templates/penjual/sidebar', $data);
            $this->load->view('templates/penjual/navbar', $data);
            $this->load->view('penjual/barang_keluar', $data);
            $this->load->view('templates/penjual/footer', $data);
        } else {
            $where =  $this->input->post('id');
            $this->db->where('id', $where);
            $this->db->delete('barang_keluar');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Data Barang Berhasil
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('Penjual/barang_keluar');
        }
    }
}
