<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // bbertujuan unutk membuat form submit
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'login';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registration()
    {
        // $this->form_validation->set_rules($rules);

        $this->form_validation->set_rules('first_name', 'First', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last', 'required|trim');
        $this->form_validation->set_rules('alamat_email', 'Emial', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'email sudah ada yang pakai'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password tidak sama',
            'min_length' => 'password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',);


        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [

                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('alamat_email'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_create' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('user', $data);

            $this->session->set_flashdata('pesan', 'Akun Sukses Terdaftar Silakan Login');
            redirect('auth');
        }
    }

    public function forgot()
    {
        $this->load->view('templates/auth_header');
        $this->load->view('auth/forgot');
        $this->load->view('templates/auth_footer');
    }
}
