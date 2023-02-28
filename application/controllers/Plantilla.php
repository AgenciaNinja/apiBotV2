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

    public function random_get($id = 0, $lang = "ES")
    {
        $spanish = ['', '-', '--', 'ES'];
        if (in_array($lang, $spanish)) {
            $lang = 'ES';
        } else {
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

        $plantilla = $this->db->order_by('rand()')->get_where(
            "plantillas", array(
                "id_trabajo" => $id,
                "lang" => $lang
                )
        )->row();

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