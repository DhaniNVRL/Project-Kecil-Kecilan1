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
        $this->load->view('templates/auth_header');
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registration()
    {
        $this->form_validation->set_rules('first_name', 'First', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last', 'required|trim');
        $this->form_validation->set_rules('email', 'Emial', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header');
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            echo 'data berhasil di tambah';
        }
    }

    public function forgot()
    {
        $this->load->view('templates/auth_header');
        $this->load->view('auth/forgot');
        $this->load->view('templates/auth_footer');
    }
}
