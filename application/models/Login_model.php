<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Login_model extends CI_Model
{
    public function chequear($username, $password)
    {
        $existeUsername = $this->db->select('*')->from('usuario');
        if ($existeUsername->count_all_results() == 1) {
            $usuario = $this->db->select('*')->from('usuario')->get()->row();
            if ((is_object($usuario)) && ($usuario !== null) && ($usuario !== false)) {
                $pass     = $usuario->password;
                $passHash = hash('sha256', $password);
                $name     = $usuario->username;
                if (($pass === $passHash) && ($username === $name)) {
                    $data=[
                        'credential' => [
                            'id'       => $usuario->id,
                            'nombre'   => $usuario->nombre,
                            'username' => $usuario->username,
                            'password' => $usuario->password
                        ]
                    ];
                    $this->session->set_userdata($data);
                    return true;
                }
            }
        }
        $this->session->unset_userdata('credential');
        return false;
    }

    public function getUser($id) {
        return $this->db->get_where(
            "usuario", array(
                "id" => $id
            )
        )->row();
    }
}