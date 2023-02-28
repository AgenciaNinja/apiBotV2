<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ControlUrls extends RestController
{
    public $methods = [
        //"tareas",
    ];

    public $editables = [
        'dominio',
        'contador',
    ];

    public function __construct()
    {
        parent::__construct();
        $r = $this->input->request_headers();
        $m = $this->router->fetch_method();
        if ((!isset($r["Token"]) or ($r["Token"] != env("TOKEN"))) and !in_array($m, $this->methods)) {
            $this->response(
                [
                    'status' => false,
                    'message' => 'Error en el Token',
                ],
                200
            );
        }
    }

    public function insert_post()
    {
        $data = json_decode($this->input->post("data"));
        if (!$data || $data->domain == "") {
            $this->response(
                [
                    'status'  => false,
                    'message' => 'La data enviada es incorrecta o vacia'
                ], 200
            );
        }

        $status = $this->generic_model
            ->insert("control_urls", ["dominio" => $data->domain]);

        $this->response(
            [
                'status' => true,
                'data'   => $status > 0 ? true : false
            ], 200
        );
    }

    public function find_post()
    {
        $data     = json_decode($this->input->post("data"));
        $dominio  = trim($data->domain);
        if (substr($dominio, -1) === "/") {
            $dominio = substr($mystring, 0, -1);
        }

        if ($dominio == "") {
            $this->response(
                [
                    'status' => false,
                    'message' => 'Debe espécificar un dominio valido'
                ], 404
            );
        }

        $d = $this->generic_model
            ->countBy("control_urls", array("dominio" => $dominio));
        $exist = $d > 0 ? true :false;

        if (!$exist) {
            $e = $this->generic_model
                ->countBy(
                    "tareas",
                    array(
                        "domain" => $dominio,
                        "estado" => 'finalizado'
                    )
                );
            $exist = $e > 0 ? true :false;
        }

        if (!$exist) {
            $f =$this->generic_model
                ->countBy(
                    "manuales_excluir",
                    array("domain" => $dominio)
                );
            $exist = $f > 0 ? true :false;
        }

        $this->response(
            [
                'status' => true,
                'data' => $exist
            ], 200
        );
    }

    public function update_post()
    {
        $data = json_decode($this->input->post("data"));
        if (!$data || $data->domain == "") {
            $this->response(
                [
                    'status' => false,
                    'message' => 'Debe espécificar un dominio valido'
                ], 404
            );
        }

        $d = $this->generic_model
            ->getOneBy("control_urls", array("dominio" => $data->domain));
        $data = array("contador" => $d->contador +1);

        $this->generic_model
            ->update("control_urls", $d->id, $data, $this->editables);

        $this->response(
            [
                'status' => true,
                'message' => 'Contador de dominios actualizado',
            ], 200
        );
    }
}