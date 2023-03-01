<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{
    public $methods = [
        "response_ok"
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

    public function response_ok_get()
    {
        $this->response(
            [
                'status' => true,
                'message' => 'Response Correct !!!'
            ], 200
        );
    }

    public function agregarUrl_get()
    {
        $this->db->save_queries = false;
        $url    = $_GET['url'];
        $dbName = isset($_GET['dbName']) ? $_GET['dbName'] : 'default';

        if (($url == '') || ($url == false) || ($url == null)) {
            return false;
        }

        $url        = urldecode($url);
        $ele        = explode('/', str_replace(['http://', 'https://', 'ftp://', 'www.'], '', $url));
        $dominio    = $ele[0];
        $dominioArr = explode(".", $dominio);
        $extDominio = end($dominioArr);
        $agregada   = false;

        $this->generic_model->setDb($data->dbName);

        $wheres   = ["domain" => $dominio];
        $count1   = $this->generic_model->countBy("tareas", $wheres);
        $count2   = $this->generic_model->countBy("manuales_excluir", $wheres);
        $agregada = false;

        if (($count1 === 0) && ($count2 === 0)) {
            $data = [
                'id_trabajo' => 1,
                'id_mensaje' => 0,
                'server'     => rand(1, 12),
                'url'        => $url,
                'domain'     => $dominio
            ];
            $id = $this->generic_model->insert('tareas', $data);
            $agregada = ($id > 0) ? true : false;
        }

        $this->response(
            [
                'status' => true,
                'added'  => $agregada,
            ], 200
        );
    }
}
