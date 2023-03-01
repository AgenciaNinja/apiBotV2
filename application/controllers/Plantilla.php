<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Plantilla extends RestController
{
    public $methods = [
        //"visitas",
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

    public function random_get($id = 0, $lang = "ES", $dbName = 'default')
    {
        $spanish = ['', '-', '--', 'ES'];
        if (!in_array($lang, $spanish)) {
            $lang = 'US';
        }

        if ($id <= 0) {
            $this->response(
                [
                    'status' => false,
                    'message' => 'No se encontró el id o el id es inferior a 1'
                ], 404
            );
        }

        $this->generic_model->setDb($dbName);

        $wheres    = ["id_trabajo" => $id, "lang" => $lang];
        $plantilla = $this->generic_model
            ->getOneBy('plantillas', "*", $wheres, false, false, 'rand()');

        if (!$plantilla) {
            $this->response(
                [
                    'status' => false,
                    'message' => 'No se encontró plantillas para este id trabajo'
                ], 404
            );
        }

        $this->response(
            [
                'status'  => true,
                'message' => 'Plantilla',
                'data'    => json_encode($plantilla)
            ], 200
        );
    }
}