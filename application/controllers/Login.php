<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        if ($this->router->fetch_method() === 'index' && validarAccesso()) {
            redirect('dashBoardResume/index');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'trim|required',
            [
                'required' => 'Debe proporcionar un %s.',
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|required|callback_verifica',
            [
                'required' => 'Debe proporcionar un %s.',
                'verifica' => 'Usuario y/o Contraseña incorrecta'
            ]
        );
        if ($this->form_validation->run() == FALSE) {
            $data['titlePag'] = 'Bot Forms - Control de Acceso';
            $this->__vista('login/index', $data, false);
        } else {
            redirect('dashBoardResume/index');
        }
    }

    public function verifica()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        return $this->login_model->chequear($username, $password);
    }

    public function logout()
    {
        $this->session->unset_userdata('credential');
        redirect('login');
    }
}
