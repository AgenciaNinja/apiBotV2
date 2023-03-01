<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class InformacionContacto extends RestController
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

    public function update_post($idTarea = 0, $dbName = 'default')
    {
        $informacions = json_decode($this->input->post("data"));

        if ($idTarea <= 0) {
            $this->response(
                [
                'status' => false,
                'message' => 'No se encontró el id o el id es inferior a 1'
                ], 200
            );
        }

        if (!$informacions) {
            $this->response(
                [
                'status' => false,
                'message' => 'La data enviada es incorrecta o vacia'
                ], 200
            );
        }

        $this->generic_model->setDb($dbName);

        //$this->db->delete('informacion_contacto', array('id_sitio' => $id_tarea));
        foreach ($informacions as $informacion) {
            $exist = $this->generic_model
                ->countBy("informacion_contacto", ["valor", $informacion->valor]);
            if ($exist === 0 ) {
                $data = [
                    "id_sitio"      => $idTarea,
                    "tipo"          => $informacion->tipo,
                    "valor"         => $informacion->valor,
                ];
                $this->generic_model->insert('informacion_contacto', $data);
            }
        }

        $this->response(
            [
                'status' => true,
                'message' => 'Se actualizó correctamente'
            ], 200
        );
    }
}