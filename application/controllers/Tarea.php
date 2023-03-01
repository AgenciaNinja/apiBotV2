<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Tarea extends RestController
{
    public $methods = [
        //"visitas",
    ];

    public $editables = [
        'id_trabajo',
        'country',
        'id_mensaje',
        'estado',
        'server',
        'url',
        'domain',
        'url_formulario',
        'captcha',
        'form',
        'fecha_creacion',
        'fecha_actualizacion',
        'fecha_finalizado'
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

    public function find_get($limit = 0, $server =  1, $minToKill = 15, $dbName = 'default')
    {
        $this->generic_model->setDb($dbName);

        $timezone   = new DateTimeZone(env("ZONE"));
        $actualTime = new DateTime();
        $oldTime    = new DateTime();

        $actualTime->setTimezone($timezone);
        $oldTime->setTimezone($timezone);
        $oldTime->modify("-". $minToKill." minute");

        $wheres = [
            "server"                 => (int)$server ,
            "fecha_actualizacion <=" =>  $oldTime->format("Y-m-d H:i")
        ];

        $wheresIn = [
            "estado" => ["trabajo", "proceso"]
        ];

        $data = [
            "estado"           => "por_repasar",
            "fecha_finalizado" => $actualTime->format("Y-m-d H:i:s")
        ];

        $update = $this->generic_model
            ->updateMultiple("tareas", $wheres, $wheresIn, $data);

        $wheres       = ["server" => (int)$server];
        $inProcces    = $this->generic_model->countBy("tareas", $wheres, $wheresIn);
        $limitAverage = $limit - $inProcces;

        if ($limitAverage > 0) {
            $tareas = $this->generic_model->getMultipleBy(
                "tareas",
                "id,id_trabajo,url,country",
                [
                    "estado" => "pendiente",
                    "server" => (int)$server
                ],
                false,
                false,
                $limitAverage
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'message' => 'Muchas tareas en proceso... Por favor Espere !!!'
                ], 404
            );
        }

        if ($tareas) {
            $this->response(
                [
                    'status'    => true,
                    'message'   => 'Tareas pendientes',
                    'inProcces' => $inProcces,
                    'limitAvg'  => $limitAverage,
                    'data'      => $tareas
                ], 200
            );
        } else {
            $this->response(
                [
                'status' => false,
                'message' => 'No hay trabajos pendientes'
                ], 404
            );
        }
    }

    public function findById_get($id = '',  $dbName = 'default')
    {
        $this->generic_model->setDb($dbName);
        $tarea =  $this->generic_model
            ->getOneBy('tareas',  "*", ["id" => (int)$id]);

        if ($tarea) {
            $this->response(
                [
                    'status'   => true,
                    'message'  => 'Tareas pendientes',
                    'limitAvg' => 1,
                    'data'     => [$tarea]
                ], 200
            );
        } else {
            $this->response(
                [
                'status' => false,
                'message' => 'No hay trabajos pendientes'
                ], 200
            );
        }
    }

    public function findByEdo_get($id = 0, $estado = "trabajo", $dbName = 'default')
    {
        if ($id <= 0) {
            $this->response(
                [
                'status' => false,
                'message' => 'No se encontró el id o el id es inferior a 1'
                ], 404
            );
        }

        $this->generic_model->setDb($dbName);

        $numTareas = $this->generic_model
            ->countBy("tareas", array("id" => $id, "estado" => $estado));

        $this->response(
            [
                'status' => true,
                'message' => 'tarea solicitada',
                'data' => $numTareas > 0 ? true : false
            ], 200
        );
    }

    public function update_post($id = 0)
    {
        $data = json_decode($this->input->post("data"));
        if (!$data) {
            $this->response(
                [
                    'status' => false,
                    'message' => 'La data enviada es incorrecta o vacia'
                ], 200
            );
        }
        if ($id <= 0) {
            $this->response(
                [
                    'status' => false,
                    'message' => 'No se encontró el id o el id es inferior a 1'
                ], 200
            );
        }

        $this->generic_model->setDb($data->dbName);

        $tarea = $this->generic_model->getOneBy("tareas", "*", ["id" => $id]);

        if (!$tarea) {
            $this->response(
                [
                    'status' => false,
                    'message' => 'tarea no encontrada'
                ], 200
            );
        }
        $data->fecha_actualizacion = date("Y-m-d H:i:s");

        if ($tarea->domain == '' || $tarea->domain == null) {
            $url = explode('/', str_replace(array('http://', 'https://', 'ftp://', 'www.'), '', $tarea->url));
            $data->domain = $url[0];
        }

        $status = $this->generic_model
            ->update("tareas", $id, $data, $this->editables);

        if (isset($data->logs)) {
            $logs = json_decode($data->logs);
            foreach ($logs as $log) {
                $data = [
                    "id_tarea" => $id,
                    "tipo"     => $log->tipo,
                    "accion"   => $log->accion,
                    "valor"    => $log->valor,
                ];
                $this->generic_model->insert('log', $data);
            }
        }

        $this->response(
            [
                'status'  => true,
                'message' => 'Se actualizó correctamente',
                'data'    => $status
            ], 200
        );
    }
}