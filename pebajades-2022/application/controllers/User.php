<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');


            //cek jika ada gammbar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/profile/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }



                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_error();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been update!</div>');
            redirect('user');
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {

            $new_password = $this->input->post('new_password1');

            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

            $this->db->set('password', $password_hash);
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
            redirect('user/changepassword');
        }
    }

    //  Tanah
    public function tanah()
    {
        $data['title'] = 'Tanah';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Tanah_model', 'jns_tanah');
        $this->load->model('Tanah_model', 'kode_barang_tanah');

        $data['Tanah'] = $this->jns_tanah->getTanah();
        $data['Tanah'] = $this->kode_barang_tanah->getTanah();
        $data['jns_tanah'] = $this->db->get('kode_tanah')->result_array();
        $data['kode_barang_tanah'] = $this->db->get('kode_tanah')->result_array();

        $this->form_validation->set_rules('kode_tanah_id', 'Kode_tanah_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('alas_hak', 'Alas', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/tanah', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gammbar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/aset/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['Tanah']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/aset/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_error();
                }
            }

            $data = [
                'kode_tanah_id' => $this->input->post('kode_tanah_id'),
                'nup' => $this->input->post('nup'),
                'luas' => $this->input->post('luas'),
                'th_perolehan' => $this->input->post('th_perolehan'),
                'alas_hak' => $this->input->post('alas_hak'),
                'nilai_perolehan' => $this->input->post('nilai_perolehan'),
                'ket' => $this->input->post('ket'),
                'date_created' => time(),
                'image' => $this->upload->data('file_name'),
                'comment' => $this->input->post('comment'),
                'del' => 1
            ];
            $this->db->insert('tanah', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Tanah added!</div>');
            redirect('user/tanah');
        }
    }

    public function printtanah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Tanah_model', 'jns_tanah');
        $this->load->model('Tanah_model', 'kode_barang_tanah');

        $data['Tanah'] = $this->jns_tanah->getTanah();
        $data['Tanah'] = $this->kode_barang_tanah->getTanah();
        $data['jns_tanah'] = $this->db->get('kode_tanah')->result_array();
        $data['kode_barang_tanah'] = $this->db->get('kode_tanah')->result_array();

        $data['tanah'] = $this->kode_barang_tanah->tampil_data("tanah")->result_array();
        $this->load->view('user/inputaset/print_tanah', $data);
    }

    public function pdftanah()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->library('dompdf_gen');

        $this->load->model('Tanah_model', 'jns_tanah');
        $this->load->model('Tanah_model', 'kode_barang_tanah');

        $data['Tanah'] = $this->jns_tanah->getTanah();
        $data['Tanah'] = $this->kode_barang_tanah->getTanah();
        $data['jns_tanah'] = $this->db->get('kode_tanah')->result_array();
        $data['kode_barang_tanah'] = $this->db->get('kode_tanah')->result_array();


        $data['tanah'] = $this->kode_barang_tanah->tampil_data("tanah")->result_array();
        $this->load->view('user/inputaset/laporan_tanah', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("laporan_tanah.pdf", array('Attachment' => 0));
    }


    // Kendaraaan
    public function kendaraan()
    {
        $data['title'] = 'Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Kendaraan_model', 'nama_brg');
        $this->load->model('Kendaraan_model', 'kode_barang_kendaraan');

        $data['Kendaraan'] = $this->nama_brg->getKendaraan();
        $data['Kendaraan'] = $this->kode_barang_kendaraan->getKendaraan();
        $data['nama_brg'] = $this->db->get('kode_kendaraan')->result_array();
        $data['kode_barang_kendaraan'] = $this->db->get('kode_kendaraan')->result_array();


        $this->form_validation->set_rules('kode_kendaraan_id', 'Kode_kendaraan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('no_identitas', 'No_id', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/kendaraan', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gammbar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/aset/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['Kendaraan']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/aset/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_error();
                }
            }

            $data = [
                'kode_kendaraan_id' => $this->input->post('kode_kendaraan_id'),
                'nup' => $this->input->post('nup'),
                'merk' => $this->input->post('merk'),
                'th_perolehan' => $this->input->post('th_perolehan'),
                'no_identitas' => $this->input->post('no_identitas'),
                'nilai_perolehan' => $this->input->post('nilai_perolehan'),
                'kond_brg' => $this->input->post('kond_brg'),
                'date_created' => time(),
                'ket' => $this->input->post('ket'),
                'image' => $this->upload->data('file_name'),
                'del' => 1
            ];
            $this->db->insert('kendaraan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Kendaraan added!</div>');
            redirect('user/kendaraan');
        }
    }

    public function printkendaraan()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Kendaraan_model', 'nama_brg');
        $this->load->model('Kendaraan_model', 'kode_barang_kendaraan');

        $data['Kendaraan'] = $this->nama_brg->getKendaraan();
        $data['Kendaraan'] = $this->kode_barang_kendaraan->getKendaraan();
        $data['nama_brg'] = $this->db->get('kode_kendaraan')->result_array();
        $data['kode_barang_kendaraan'] = $this->db->get('kode_kendaraan')->result_array();

        $data['kendaraan'] = $this->kode_barang_kendaraan->tampil_data("kendaraan")->result_array();
        $this->load->view('user/inputaset/print_kendaraan', $data);
    }

    public function pdfkendaraan()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->library('dompdf_gen');

        $this->load->model('Kendaraan_model', 'nama_brg');
        $this->load->model('Kendaraan_model', 'kode_barang_kendaraan');

        $data['Kendaraan'] = $this->nama_brg->getKendaraan();
        $data['Kendaraan'] = $this->kode_barang_kendaraan->getKendaraan();
        $data['nama_brg'] = $this->db->get('kode_kendaraan')->result_array();
        $data['kode_barang_kendaraan'] = $this->db->get('kode_kendaraan')->result_array();


        $data['kendaraan'] = $this->kode_barang_kendaraan->tampil_data("kendaraan")->result_array();
        $this->load->view('user/inputaset/laporan_kendaraan', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("laporan_kendaraan.pdf", array('Attachment' => 0));
    }

    // Peralatan
    public function peralatan()
    {
        $data['title'] = 'Peralatan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Peralatan_model', 'nama_brg');
        $this->load->model('Peralatan_model', 'kode_barang_peralatan');

        $data['Peralatan'] = $this->nama_brg->getPeralatan();
        $data['Peralatan'] = $this->kode_barang_peralatan->getPeralatan();
        $data['nama_brg'] = $this->db->get('kode_peralatan')->result_array();
        $data['kode_barang_peralatan'] = $this->db->get('kode_peralatan')->result_array();

        $this->form_validation->set_rules('kode_peralatan_id', 'Kode_peralatan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/peralatan', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gammbar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/aset/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['Peralatan']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/aset/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_error();
                }
            }

            $data = [
                'kode_peralatan_id' => $this->input->post('kode_peralatan_id'),
                'nup' => $this->input->post('nup'),
                'merk' => $this->input->post('merk'),
                'th_perolehan' => $this->input->post('th_perolehan'),
                'nilai_perolehan' => $this->input->post('nilai_perolehan'),
                'kond_brg' => $this->input->post('kond_brg'),
                'ket' => $this->input->post('ket'),
                'date_created' => time(),
                'image' => $this->upload->data('file_name'),
                'del' => 1
            ];
            $this->db->insert('peralatan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Peralatan added!</div>');
            redirect('user/peralatan');
        }
    }

    public function printperalatan()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Peralatan_model', 'nama_brg');
        $this->load->model('Peralatan_model', 'kode_barang_peralatan');

        $data['Peralatan'] = $this->nama_brg->getPeralatan();
        $data['Peralatan'] = $this->kode_barang_peralatan->getPeralatan();
        $data['nama_brg'] = $this->db->get('kode_peralatan')->result_array();
        $data['kode_barang_peralatan'] = $this->db->get('kode_peralatan')->result_array();

        $data['peralatan'] = $this->kode_barang_peralatan->tampil_data("peralatan")->result_array();
        $this->load->view('user/inputaset/print_peralatan', $data);
    }

    public function pdfperalatan()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->library('dompdf_gen');

        $this->load->model('Peralatan_model', 'nama_brg');
        $this->load->model('Peralatan_model', 'kode_barang_peralatan');

        $data['Peralatan'] = $this->nama_brg->getPeralatan();
        $data['Peralatan'] = $this->kode_barang_peralatan->getPeralatan();
        $data['nama_brg'] = $this->db->get('kode_peralatan')->result_array();
        $data['kode_barang_peralatan'] = $this->db->get('kode_peralatan')->result_array();


        $data['peralatan'] = $this->kode_barang_peralatan->tampil_data("peralatan")->result_array();
        $this->load->view('user/inputaset/laporan_peralatan', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("laporan_peralatan.pdf", array('Attachment' => 0));
    }


    //  
    public function bangunan()
    {
        $data['title'] = 'Bangunan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Bangunan_model', 'jns_bangun');
        $this->load->model('Bangunan_model', 'kode_barang_bangunan');

        $data['Bangunan'] = $this->jns_bangun->getBangunan();
        $data['Bangunan'] = $this->kode_barang_bangunan->getBangunan();
        $data['jns_bangun'] = $this->db->get('kode_bangunan')->result_array();
        $data['kode_barang_bangunan'] = $this->db->get('kode_bangunan')->result_array();


        $this->form_validation->set_rules('kode_bangunan_id', 'Kode_bangunan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('tipe_bangun', 'Tipe_bangun', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/bangunan', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gammbar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/aset/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['Bangunan']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/aset/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_error();
                }
            }

            $data = [
                'kode_bangunan_id' => $this->input->post('kode_bangunan_id'),
                'nup' => $this->input->post('nup'),
                'luas' => $this->input->post('luas'),
                'th_perolehan' => $this->input->post('th_perolehan'),
                'tipe_bangun' => $this->input->post('tipe_bangun'),
                'nilai' => $this->input->post('nilai'),
                'ket' => $this->input->post('ket'),
                'date_created' => time(),
                'image' => $this->upload->data('file_name'),
                'del' => 1
            ];
            $this->db->insert('bangunan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Bangunan added!</div>');
            redirect('user/bangunan');
        }
    }

    public function printbangunan()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Bangunan_model', 'jns_bangun');
        $this->load->model('Bangunan_model', 'kode_barang_bangunan');

        $data['Bangunan'] = $this->jns_bangun->getBangunan();
        $data['Bangunan'] = $this->kode_barang_bangunan->getBangunan();
        $data['jns_bangun'] = $this->db->get('kode_bangunan')->result_array();
        $data['kode_barang_bangunan'] = $this->db->get('kode_bangunan')->result_array();

        $data['bangunan'] = $this->kode_barang_bangunan->tampil_data("bangunan")->result_array();
        $this->load->view('user/inputaset/print_bangunan', $data);
    }

    public function pdfbangunan()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->library('dompdf_gen');

        $this->load->model('Bangunan_model', 'jns_bangun');
        $this->load->model('Bangunan_model', 'kode_barang_bangunan');

        $data['Bangunan'] = $this->jns_bangun->getBangunan();
        $data['Bangunan'] = $this->kode_barang_bangunan->getBangunan();
        $data['jns_bangun'] = $this->db->get('kode_bangunan')->result_array();
        $data['kode_barang_bangunan'] = $this->db->get('kode_bangunan')->result_array();


        $data['bangunan'] = $this->kode_barang_bangunan->tampil_data("bangunan")->result_array();
        $this->load->view('user/inputaset/laporan_bangunan', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("laporan_bangunan.pdf", array('Attachment' => 0));
    }


    public function tanahEdit($tanah_id)
    {
        $data['title'] = 'Edit Tanah';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Tanah_model', 'jns_tanah');
        $this->load->model('Tanah_model', 'kode_barang_tanah');

        $data['Tanah'] = $this->jns_tanah->getTanah();
        $data['Tanah'] = $this->kode_barang_tanah->getTanah();
        $data['Tanah'] = $this->db->get_where('tanah', ['tanah_id' => $tanah_id])->row_array();
        $data['jns_tanah'] = $this->db->get('kode_tanah')->result_array();
        $data['kode_barang_tanah'] = $this->db->get('kode_tanah')->result_array();

        $this->form_validation->set_rules('kode_tanah_id', 'Kode_tanah_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('alas_hak', 'Alas', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/tanahEdit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_tanah_id' => $this->input->post('kode_tanah_id', true),
                'nup' => $this->input->post('nup', true),
                'luas' => $this->input->post('luas', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'alas_hak' => $this->input->post('alas_hak', true),
                'nilai_perolehan' => $this->input->post('nilai_perolehan', true),
                'ket' => $this->input->post('ket', true),
                'date_created' => time(),
                'del' => 1
            ];
            $this->db->where('tanah_id', $this->input->post('tanah_id'));
            $this->db->update('tanah', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tanah Updated!</div>');
            redirect('user/tanah');
        }
    }


    public function tanahDelete($tanah_id)
    {
        $data['title'] = 'Delete Tanah';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Tanah_model', 'jns_tanah');
        $this->load->model('Tanah_model', 'kode_barang_tanah');

        $data['Tanah'] = $this->jns_tanah->getTanah();
        $data['Tanah'] = $this->kode_barang_tanah->getTanah();
        $data['Tanah'] = $this->db->get_where('tanah', ['tanah_id' => $tanah_id])->row_array();
        $data['jns_tanah'] = $this->db->get('kode_tanah')->result_array();
        $data['kode_barang_tanah'] = $this->db->get('kode_tanah')->result_array();

        $this->form_validation->set_rules('kode_tanah_id', 'Kode_tanah_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('alas_hak', 'Alas', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/tanahDelete', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_tanah_id' => $this->input->post('kode_tanah_id', true),
                'nup' => $this->input->post('nup', true),
                'luas' => $this->input->post('luas', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'alas_hak' => $this->input->post('alas_hak', true),
                'nilai_perolehan' => $this->input->post('nilai_perolehan', true),
                'ket' => $this->input->post('ket', true),
                'date_created' => time(),
                'del' => 0
            ];
            $this->db->where('tanah_id', $this->input->post('tanah_id'));
            $this->db->update('tanah', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tanah Deleted!</div>');
            redirect('user/tanah');
        }
    }



    public function kendaraanEdit($kendaraan_id)
    {
        $data['title'] = 'Edit Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Kendaraan_model', 'nama_brg');
        $this->load->model('Kendaraan_model', 'kode_barang_kendaraan');

        $data['Kendaraan'] = $this->nama_brg->getKendaraan();
        $data['Kendaraan'] = $this->kode_barang_kendaraan->getKendaraan();
        $data['Kendaraan'] = $this->db->get_where('kendaraan', ['kendaraan_id' => $kendaraan_id])->row_array();
        $data['nama_brg'] = $this->db->get('kode_kendaraan')->result_array();
        $data['kode_barang_kendaraan'] = $this->db->get('kode_kendaraan')->result_array();


        $this->form_validation->set_rules('kode_kendaraan_id', 'Kode_kendaraan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('no_identitas', 'No_id', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/kendaraanEdit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_kendaraan_id' => $this->input->post('kode_kendaraan_id', true),
                'nup' => $this->input->post('nup', true),
                'merk' => $this->input->post('merk', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'no_identitas' => $this->input->post('no_identitas', true),
                'nilai_perolehan' => $this->input->post('nilai_perolehan', true),
                'kond_brg' => $this->input->post('kond_brg', true),
                'date_created' => time(),
                'ket' => $this->input->post('ket', true),
                'del' => 1
            ];

            $this->db->where('kendaraan_id', $this->input->post('kendaraan_id'));
            $this->db->update('kendaraan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kendaraan Updated!</div>');
            redirect('user/kendaraan');
        }
    }


    public function kendaraanDelete($kendaraan_id)
    {
        $data['title'] = 'Delete Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Kendaraan_model', 'nama_brg');
        $this->load->model('Kendaraan_model', 'kode_barang_kendaraan');

        $data['Kendaraan'] = $this->nama_brg->getKendaraan();
        $data['Kendaraan'] = $this->kode_barang_kendaraan->getKendaraan();
        $data['Kendaraan'] = $this->db->get_where('kendaraan', ['kendaraan_id' => $kendaraan_id])->row_array();
        $data['nama_brg'] = $this->db->get('kode_kendaraan')->result_array();
        $data['kode_barang_kendaraan'] = $this->db->get('kode_kendaraan')->result_array();


        $this->form_validation->set_rules('kode_kendaraan_id', 'Kode_kendaraan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('no_identitas', 'No_id', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/kendaraanDelete', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_kendaraan_id' => $this->input->post('kode_kendaraan_id', true),
                'nup' => $this->input->post('nup', true),
                'merk' => $this->input->post('merk', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'no_identitas' => $this->input->post('no_identitas', true),
                'nilai_perolehan' => $this->input->post('nilai_perolehan', true),
                'kond_brg' => $this->input->post('kond_brg', true),
                'date_created' => time(),
                'ket' => $this->input->post('ket', true),
                'del' => 0
            ];

            $this->db->where('kendaraan_id', $this->input->post('kendaraan_id'));
            $this->db->update('kendaraan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kendaraan Deleted!</div>');
            redirect('user/kendaraan');
        }
    }


    public function peralatanEdit($peralatan_id)
    {
        $data['title'] = 'Edit Peralatan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Peralatan_model', 'nama_brg');
        $this->load->model('Peralatan_model', 'kode_barang_peralatan');

        $data['Peralatan'] = $this->nama_brg->getPeralatan();
        $data['Peralatan'] = $this->kode_barang_peralatan->getPeralatan();
        $data['Peralatan'] = $this->db->get_where('peralatan', ['peralatan_id' => $peralatan_id])->row_array();
        $data['nama_brg'] = $this->db->get('kode_peralatan')->result_array();
        $data['kode_barang_peralatan'] = $this->db->get('kode_peralatan')->result_array();


        $this->form_validation->set_rules('kode_peralatan_id', 'Kode_peralatan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/peralatanEdit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_peralatan_id' => $this->input->post('kode_peralatan_id', true),
                'nup' => $this->input->post('nup', true),
                'merk' => $this->input->post('merk', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'nilai_perolehan' => $this->input->post('nilai_perolehan', true),
                'kond_brg' => $this->input->post('kond_brg', true),
                'ket' => $this->input->post('ket', true),
                'date_created' => time(),
                'del' => 1
            ];

            $this->db->where('peralatan_id', $this->input->post('peralatan_id'));
            $this->db->update('peralatan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Peralatan Updated!</div>');
            redirect('user/peralatan');
        }
    }


    public function peralatanDelete($peralatan_id)
    {
        $data['title'] = 'Delete Peralatan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Peralatan_model', 'nama_brg');
        $this->load->model('Peralatan_model', 'kode_barang_peralatan');

        $data['Peralatan'] = $this->nama_brg->getPeralatan();
        $data['Peralatan'] = $this->kode_barang_peralatan->getPeralatan();
        $data['Peralatan'] = $this->db->get_where('peralatan', ['peralatan_id' => $peralatan_id])->row_array();
        $data['nama_brg'] = $this->db->get('kode_peralatan')->result_array();
        $data['kode_barang_peralatan'] = $this->db->get('kode_peralatan')->result_array();


        $this->form_validation->set_rules('kode_peralatan_id', 'Kode_peralatan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/peralatanDelete', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_peralatan_id' => $this->input->post('kode_peralatan_id', true),
                'nup' => $this->input->post('nup', true),
                'merk' => $this->input->post('merk', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'nilai_perolehan' => $this->input->post('nilai_perolehan', true),
                'kond_brg' => $this->input->post('kond_brg', true),
                'ket' => $this->input->post('ket', true),
                'date_created' => time(),
                'del' => 0
            ];

            $this->db->where('peralatan_id', $this->input->post('peralatan_id'));
            $this->db->update('peralatan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Peralatan Deleted!</div>');
            redirect('user/peralatan');
        }
    }


    public function bangunanEdit($bangunan_id)
    {
        $data['title'] = 'Edit Bangunan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Bangunan_model', 'jns_bangun');
        $this->load->model('Bangunan_model', 'kode_barang_bangunan');

        $data['Bangunan'] = $this->jns_bangun->getBangunan();
        $data['Bangunan'] = $this->kode_barang_bangunan->getBangunan();
        $data['Bangunan'] = $this->db->get_where('bangunan', ['bangunan_id' => $bangunan_id])->row_array();
        $data['jns_bangun'] = $this->db->get('kode_bangunan')->result_array();
        $data['kode_barang_bangunan'] = $this->db->get('kode_bangunan')->result_array();


        $this->form_validation->set_rules('kode_bangunan_id', 'Kode_bangunan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('tipe_bangun', 'Tipe_bangun', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/bangunanEdit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_bangunan_id' => $this->input->post('kode_bangunan_id', true),
                'nup' => $this->input->post('nup', true),
                'luas' => $this->input->post('luas', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'tipe_bangun' => $this->input->post('tipe_bangun', true),
                'nilai' => $this->input->post('nilai', true),
                'ket' => $this->input->post('ket', true),
                'date_created' => time(),
                'del' => 1
            ];

            $this->db->where('bangunan_id', $this->input->post('bangunan_id'));
            $this->db->update('bangunan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bangunan Updated!</div>');
            redirect('user/bangunan');
        }
    }


    public function bangunanDelete($bangunan_id)
    {
        $data['title'] = 'Delete Bangunan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Bangunan_model', 'jns_bangun');
        $this->load->model('Bangunan_model', 'kode_barang_bangunan');

        $data['Bangunan'] = $this->jns_bangun->getBangunan();
        $data['Bangunan'] = $this->kode_barang_bangunan->getBangunan();
        $data['Bangunan'] = $this->db->get_where('bangunan', ['bangunan_id' => $bangunan_id])->row_array();
        $data['jns_bangun'] = $this->db->get('kode_bangunan')->result_array();
        $data['kode_barang_bangunan'] = $this->db->get('kode_bangunan')->result_array();


        $this->form_validation->set_rules('kode_bangunan_id', 'Kode_bangunan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('tipe_bangun', 'Tipe_bangun', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/inputaset/bangunanDelete', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_bangunan_id' => $this->input->post('kode_bangunan_id', true),
                'nup' => $this->input->post('nup', true),
                'luas' => $this->input->post('luas', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'tipe_bangun' => $this->input->post('tipe_bangun', true),
                'nilai' => $this->input->post('nilai', true),
                'ket' => $this->input->post('ket', true),
                'date_created' => time(),
                'del' => 0
            ];

            $this->db->where('bangunan_id', $this->input->post('bangunan_id'));
            $this->db->update('bangunan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bangunan Deleted!</div>');
            redirect('user/bangunan');
        }
    }

    public function log_tanah()
    {
        $data['title'] = 'Log Activity Tanah';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Tanah_model', 'image');
        $this->load->model('Tanah_model', 'jns_tanah');
        $this->load->model('Tanah_model', 'kode_barang_tanah');
        $this->load->model('Tanah_model', 'nup');
        $this->load->model('Tanah_model', 'luas');
        $this->load->model('Tanah_model', 'th_perolehan');
        $this->load->model('Tanah_model', 'alas_hak');
        $this->load->model('Tanah_model', 'nilai_perolehan');
        $this->load->model('Tanah_model', 'ket');

        $data['tanah_log'] = $this->kode_barang_tanah->getTanahLog();
        $data['tanah_log'] = $this->jns_tanah->getTanahLog();
        $data['tanah_log'] = $this->image->getTanahLog();
        $data['kode_barang_tanah'] = $this->db->get('tanah')->result_array();
        $data['jns_tanah'] = $this->db->get('tanah')->result_array();
        $data['nup'] = $this->db->get('tanah')->result_array();
        $data['luas'] = $this->db->get('tanah')->result_array();
        $data['th_perolehan'] = $this->db->get('tanah')->result_array();
        $data['alas_hak'] = $this->db->get('tanah')->result_array();
        $data['nilai_perolehan'] = $this->db->get('tanah')->result_array();
        $data['ket'] = $this->db->get('tanah')->result_array();
        $data['image'] = $this->db->get('tanah')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/log_tanah', $data);
        $this->load->view('templates/footer');
    }

    public function log_kendaraan()
    {
        $data['title'] = 'Log Activity Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Kendaraan_model', 'image');
        $this->load->model('Kendaraan_model', 'nama_brg');
        $this->load->model('Kendaraan_model', 'kode_barang_kendaraan');
        $this->load->model('Kendaraan_model', 'nup');
        $this->load->model('Kendaraan_model', 'merk');
        $this->load->model('Kendaraan_model', 'th_perolehan');
        $this->load->model('Kendaraan_model', 'no_identitas');
        $this->load->model('Kendaraan_model', 'nilai_perolehan');
        $this->load->model('Kendaraan_model', 'kond_brg');
        $this->load->model('Kendaraan_model', 'ket');

        $data['kendaraan_log'] = $this->kode_barang_kendaraan->getKendaraanLog();
        $data['kendaraan_log'] = $this->nama_brg->getKendaraanLog();
        $data['kendaraan_log'] = $this->image->getKendaraanLog();
        $data['kode_barang_kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['nama_brg'] = $this->db->get('kendaraan')->result_array();
        $data['nup'] = $this->db->get('kendaraan')->result_array();
        $data['merk'] = $this->db->get('kendaraan')->result_array();
        $data['th_perolehan'] = $this->db->get('kendaraan')->result_array();
        $data['no_identitas'] = $this->db->get('kendaraan')->result_array();
        $data['nilai_perolehan'] = $this->db->get('kendaraan')->result_array();
        $data['kond_brg'] = $this->db->get('kendaraan')->result_array();
        $data['ket'] = $this->db->get('kendaraan')->result_array();
        $data['image'] = $this->db->get('kendaraan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/log_kendaraan', $data);
        $this->load->view('templates/footer');
    }

    public function log_peralatan()
    {
        $data['title'] = 'Log Activity Peralatan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Peralatan_model', 'image');
        $this->load->model('Peralatan_model', 'nama_brg');
        $this->load->model('Peralatan_model', 'kode_barang_peralatan');
        $this->load->model('Peralatan_model', 'nup');
        $this->load->model('Peralatan_model', 'merk');
        $this->load->model('Peralatan_model', 'th_perolehan');
        $this->load->model('Peralatan_model', 'nilai_perolehan');
        $this->load->model('Peralatan_model', 'kond_brg');
        $this->load->model('Peralatan_model', 'ket');

        $data['peralatan_log'] = $this->kode_barang_peralatan->getPeralatanLog();
        $data['peralatan_log'] = $this->nama_brg->getPeralatanLog();
        $data['peralatan_log'] = $this->image->getPeralatanLog();
        $data['kode_barang_peralatan'] = $this->db->get('peralatan')->result_array();
        $data['nama_brg'] = $this->db->get('peralatan')->result_array();
        $data['nup'] = $this->db->get('peralatan')->result_array();
        $data['merk'] = $this->db->get('peralatan')->result_array();
        $data['th_perolehan'] = $this->db->get('peralatan')->result_array();
        $data['nilai_perolehan'] = $this->db->get('peralatan')->result_array();
        $data['kond_brg'] = $this->db->get('peralatan')->result_array();
        $data['ket'] = $this->db->get('peralatan')->result_array();
        $data['image'] = $this->db->get('peralatan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/log_peralatan', $data);
        $this->load->view('templates/footer');
    }

    public function log_bangunan()
    {
        $data['title'] = 'Log Activity Bangunan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Bangunan_model', 'image');
        $this->load->model('Bangunan_model', 'jns_bangun');
        $this->load->model('Bangunan_model', 'kode_barang_bangunan');
        $this->load->model('Bangunan_model', 'nup');
        $this->load->model('Bangunan_model', 'luas');
        $this->load->model('Bangunan_model', 'th_perolehan');
        $this->load->model('Bangunan_model', 'tipe_bangun');
        $this->load->model('Bangunan_model', 'nilai');
        $this->load->model('Bangunan_model', 'ket');

        $data['bangunan_log'] = $this->kode_barang_bangunan->getBangunanLog();
        $data['bangunan_log'] = $this->jns_bangun->getBangunanLog();
        $data['bangunan_log'] = $this->image->getBangunanLog();
        $data['kode_barang_bangunan'] = $this->db->get('bangunan')->result_array();
        $data['jns_bangun'] = $this->db->get('bangunan')->result_array();
        $data['nup'] = $this->db->get('bangunan')->result_array();
        $data['luas'] = $this->db->get('bangunan')->result_array();
        $data['th_perolehan'] = $this->db->get('bangunan')->result_array();
        $data['tipe_bangun'] = $this->db->get('bangunan')->result_array();
        $data['nilai'] = $this->db->get('bangunan')->result_array();
        $data['ket'] = $this->db->get('bangunan')->result_array();
        $data['image'] = $this->db->get('bangunan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/log_bangunan', $data);
        $this->load->view('templates/footer');
    }


    public function comment_tanah()
    {
        $data['title'] = 'Comment Tanah';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Tanah_model', 'jns_tanah');
        $this->load->model('Tanah_model', 'kode_barang_tanah');

        $data['Comment_Tanah'] = $this->jns_tanah->getTanah();
        $data['Comment_Tanah'] = $this->kode_barang_tanah->getTanah();
        $data['jns_tanah'] = $this->db->get('kode_tanah')->result_array();
        $data['kode_barang_tanah'] = $this->db->get('kode_tanah')->result_array();

        $this->form_validation->set_rules('kode_tanah_id', 'Kode_tanah_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('alas_hak', 'Alas', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/comment_aset/comment_tanah', $data);
            $this->load->view('templates/footer');
        } else {
            //cek jika ada gammbar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/aset/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['Tanah']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/aset/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_error();
                }
            }

            $data = [
                'kode_tanah_id' => $this->input->post('kode_tanah_id'),
                'nup' => $this->input->post('nup'),
                'luas' => $this->input->post('luas'),
                'th_perolehan' => $this->input->post('th_perolehan'),
                'alas_hak' => $this->input->post('alas_hak'),
                'nilai_perolehan' => $this->input->post('nilai_perolehan'),
                'ket' => $this->input->post('ket'),
                'date_created' => time(),
                'image' => $this->upload->data('file_name'),
                'comment' => $this->input->post('comment')
            ];
            $this->db->insert('tanah', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Tanah added!</div>');
            redirect('user/comment_tanah');
        }
    }

    public function comment_tanah_edit($tanah_id)
    {
        $data['title'] = 'Add Comment';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Tanah_model', 'jns_tanah');
        $this->load->model('Tanah_model', 'kode_barang_tanah');

        $data['Comment_Tanah'] = $this->jns_tanah->getTanah();
        $data['Comment_Tanah'] = $this->kode_barang_tanah->getTanah();
        $data['Comment_Tanah'] = $this->db->get_where('tanah', ['tanah_id' => $tanah_id])->row_array();
        $data['jns_tanah'] = $this->db->get('kode_tanah')->result_array();
        $data['kode_barang_tanah'] = $this->db->get('kode_tanah')->result_array();

        $this->form_validation->set_rules('kode_tanah_id', 'Kode_tanah_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('alas_hak', 'Alas', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/comment_aset/comment_tanah_edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_tanah_id' => $this->input->post('kode_tanah_id', true),
                'nup' => $this->input->post('nup', true),
                'luas' => $this->input->post('luas', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'alas_hak' => $this->input->post('alas_hak', true),
                'nilai_perolehan' => $this->input->post('nilai_perolehan', true),
                'ket' => $this->input->post('ket', true),
                'date_created' => time(),
                'comment' => $this->input->post('comment', true)
            ];
            $this->db->where('tanah_id', $this->input->post('tanah_id'));
            $this->db->update('tanah', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Coment Added!</div>');
            redirect('user/comment_tanah');
        }
    }



    public function comment_kendaraan()
    {
        $data['title'] = 'Comment Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Kendaraan_model', 'nama_brg');
        $this->load->model('Kendaraan_model', 'kode_barang_kendaraan');

        $data['Comment_Kendaraan'] = $this->nama_brg->getKendaraan();
        $data['Comment_Kendaraan'] = $this->kode_barang_kendaraan->getKendaraan();
        $data['nama_brg'] = $this->db->get('kode_kendaraan')->result_array();
        $data['kode_barang_kendaraan'] = $this->db->get('kode_kendaraan')->result_array();


        $this->form_validation->set_rules('kode_kendaraan_id', 'Kode_kendaraan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('no_identitas', 'No_id', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/comment_aset/comment_kendaraan', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gammbar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/aset/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['Kendaraan']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/aset/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_error();
                }
            }

            $data = [
                'kode_kendaraan_id' => $this->input->post('kode_kendaraan_id'),
                'nup' => $this->input->post('nup'),
                'merk' => $this->input->post('merk'),
                'th_perolehan' => $this->input->post('th_perolehan'),
                'no_identitas' => $this->input->post('no_identitas'),
                'nilai_perolehan' => $this->input->post('nilai_perolehan'),
                'kond_brg' => $this->input->post('kond_brg'),
                'date_created' => time(),
                'ket' => $this->input->post('ket'),
                'image' => $this->upload->data('file_name'),
                'comment' => $this->input->post('comment')
            ];
            $this->db->insert('kendaraan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Kendaraan added!</div>');
            redirect('user/comment_kendaraan');
        }
    }

    public function comment_kendaraan_edit($kendaraan_id)
    {
        $data['title'] = 'Add Comment';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Kendaraan_model', 'nama_brg');
        $this->load->model('Kendaraan_model', 'kode_barang_kendaraan');

        $data['Comment_Kendaraan'] = $this->nama_brg->getKendaraan();
        $data['Comment_Kendaraan'] = $this->kode_barang_kendaraan->getKendaraan();
        $data['Comment_Kendaraan'] = $this->db->get_where('kendaraan', ['kendaraan_id' => $kendaraan_id])->row_array();
        $data['nama_brg'] = $this->db->get('kode_kendaraan')->result_array();
        $data['kode_barang_kendaraan'] = $this->db->get('kode_kendaraan')->result_array();


        $this->form_validation->set_rules('kode_kendaraan_id', 'Kode_kendaraan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('no_identitas', 'No_id', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/comment_aset/comment_kendaraan_edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_kendaraan_id' => $this->input->post('kode_kendaraan_id', true),
                'nup' => $this->input->post('nup', true),
                'merk' => $this->input->post('merk', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'no_identitas' => $this->input->post('no_identitas', true),
                'nilai_perolehan' => $this->input->post('nilai_perolehan', true),
                'kond_brg' => $this->input->post('kond_brg', true),
                'date_created' => time(),
                'ket' => $this->input->post('ket', true),
                'comment' => $this->input->post('comment', true)
            ];

            $this->db->where('kendaraan_id', $this->input->post('kendaraan_id'));
            $this->db->update('kendaraan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kendaraan Updated!</div>');
            redirect('user/comment_kendaraan');
        }
    }

    public function comment_peralatan()
    {
        $data['title'] = 'Comment Peralatan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Peralatan_model', 'nama_brg');
        $this->load->model('Peralatan_model', 'kode_barang_peralatan');

        $data['Comment_Peralatan'] = $this->nama_brg->getPeralatan();
        $data['Comment_Peralatan'] = $this->kode_barang_peralatan->getPeralatan();
        $data['nama_brg'] = $this->db->get('kode_peralatan')->result_array();
        $data['kode_barang_peralatan'] = $this->db->get('kode_peralatan')->result_array();

        $this->form_validation->set_rules('kode_peralatan_id', 'Kode_peralatan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/comment_aset/comment_peralatan', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gammbar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/aset/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['Peralatan']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/aset/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_error();
                }
            }

            $data = [
                'kode_peralatan_id' => $this->input->post('kode_peralatan_id'),
                'nup' => $this->input->post('nup'),
                'merk' => $this->input->post('merk'),
                'th_perolehan' => $this->input->post('th_perolehan'),
                'nilai_perolehan' => $this->input->post('nilai_perolehan'),
                'kond_brg' => $this->input->post('kond_brg'),
                'ket' => $this->input->post('ket'),
                'date_created' => time(),
                'image' => $this->upload->data('file_name'),
                'comment' => $this->input->post('comment')
            ];
            $this->db->insert('peralatan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Peralatan added!</div>');
            redirect('user/comment_peralatan');
        }
    }


    public function comment_peralatan_edit($peralatan_id)
    {
        $data['title'] = 'Add Comment';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Peralatan_model', 'nama_brg');
        $this->load->model('Peralatan_model', 'kode_barang_peralatan');

        $data['Comment_Peralatan'] = $this->nama_brg->getPeralatan();
        $data['Comment_Peralatan'] = $this->kode_barang_peralatan->getPeralatan();
        $data['Comment_Peralatan'] = $this->db->get_where('peralatan', ['peralatan_id' => $peralatan_id])->row_array();
        $data['nama_brg'] = $this->db->get('kode_peralatan')->result_array();
        $data['kode_barang_peralatan'] = $this->db->get('kode_peralatan')->result_array();


        $this->form_validation->set_rules('kode_peralatan_id', 'Kode_peralatan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('nilai_perolehan', 'Nilai', 'required');
        $this->form_validation->set_rules('kond_brg', 'Kond_brg', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/comment_aset/comment_peralatan_edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_peralatan_id' => $this->input->post('kode_peralatan_id', true),
                'nup' => $this->input->post('nup', true),
                'merk' => $this->input->post('merk', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'nilai_perolehan' => $this->input->post('nilai_perolehan', true),
                'kond_brg' => $this->input->post('kond_brg', true),
                'ket' => $this->input->post('ket', true),
                'date_created' => time(),
                'comment' => $this->input->post('comment', true)
            ];

            $this->db->where('peralatan_id', $this->input->post('peralatan_id'));
            $this->db->update('peralatan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Peralatan Updated!</div>');
            redirect('user/comment_peralatan');
        }
    }

    public function comment_bangunan()
    {
        $data['title'] = 'Comment Bangunan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Bangunan_model', 'jns_bangun');
        $this->load->model('Bangunan_model', 'kode_barang_bangunan');

        $data['Comment_Bangunan'] = $this->jns_bangun->getBangunan();
        $data['Comment_Bangunan'] = $this->kode_barang_bangunan->getBangunan();
        $data['jns_bangun'] = $this->db->get('kode_bangunan')->result_array();
        $data['kode_barang_bangunan'] = $this->db->get('kode_bangunan')->result_array();


        $this->form_validation->set_rules('kode_bangunan_id', 'Kode_bangunan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('tipe_bangun', 'Tipe_bangun', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/comment_aset/comment_bangunan', $data);
            $this->load->view('templates/footer');
        } else {

            //cek jika ada gammbar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|JPG|png|PNG|jpeg|JPEG';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/aset/';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['Bangunan']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/aset/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_error();
                }
            }

            $data = [
                'kode_bangunan_id' => $this->input->post('kode_bangunan_id'),
                'nup' => $this->input->post('nup'),
                'luas' => $this->input->post('luas'),
                'th_perolehan' => $this->input->post('th_perolehan'),
                'tipe_bangun' => $this->input->post('tipe_bangun'),
                'nilai' => $this->input->post('nilai'),
                'ket' => $this->input->post('ket'),
                'date_created' => time(),
                'image' => $this->upload->data('file_name'),
                'comment' => $this->input->post('comment')
            ];
            $this->db->insert('bangunan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Bangunan added!</div>');
            redirect('user/comment_bangunan');
        }
    }

    public function comment_bangunan_edit($bangunan_id)
    {
        $data['title'] = 'Add Comment';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('Bangunan_model', 'jns_bangun');
        $this->load->model('Bangunan_model', 'kode_barang_bangunan');

        $data['Comment_Bangunan'] = $this->jns_bangun->getBangunan();
        $data['Comment_Bangunan'] = $this->kode_barang_bangunan->getBangunan();
        $data['Comment_Bangunan'] = $this->db->get_where('bangunan', ['bangunan_id' => $bangunan_id])->row_array();
        $data['jns_bangun'] = $this->db->get('kode_bangunan')->result_array();
        $data['kode_barang_bangunan'] = $this->db->get('kode_bangunan')->result_array();


        $this->form_validation->set_rules('kode_bangunan_id', 'Kode_bangunan_id', 'required');
        $this->form_validation->set_rules('nup', 'Nup', 'required');
        $this->form_validation->set_rules('luas', 'Luas', 'required');
        $this->form_validation->set_rules('th_perolehan', 'Th', 'required');
        $this->form_validation->set_rules('tipe_bangun', 'Tipe_bangun', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        $this->form_validation->set_rules('ket', 'Ket', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/comment_aset/comment_bangunan_edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_bangunan_id' => $this->input->post('kode_bangunan_id', true),
                'nup' => $this->input->post('nup', true),
                'luas' => $this->input->post('luas', true),
                'th_perolehan' => $this->input->post('th_perolehan', true),
                'tipe_bangun' => $this->input->post('tipe_bangun', true),
                'nilai' => $this->input->post('nilai', true),
                'ket' => $this->input->post('ket', true),
                'date_created' => time(),
                'comment' => $this->input->post('comment', true)
            ];

            $this->db->where('bangunan_id', $this->input->post('bangunan_id'));
            $this->db->update('bangunan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bangunan Updated!</div>');
            redirect('user/comment_bangunan');
        }
    }
}
