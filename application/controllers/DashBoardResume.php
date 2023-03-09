<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashBoardResume extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!validarAccesso()) {
            redirect('logout');
        }
    }

    public function index()
    {
        $solver             = new \TwoCaptcha\TwoCaptcha(env("API_2CAPTCHA"));
        $timezone           = new DateTimeZone(env("ZONE"));
        $hoy                = new DateTime();
        $data['titlePag']   =  'Bot Forms - DashBoard Resume';
        $data['databases']  = json_decode(env("DATABASES"));
        $data['servers']    = json_decode(env("SERVERS"));
        $estadosToCheck     = json_decode(env("TAREA_EDO"));
        $data['showDetail'] = $this->input->post("showDetail") == 1 ? true : false;
        $data["estados"]    = [];
        $data['balance']    = round($solver->balance(), 2);
        $data['dbName']     = $this->input->post("dbName") ? $this->input->post("dbName") : "default";
        $data['server']     = $this->input->post("server") ? $this->input->post("server") : "0";
        $data['fecha']      = $this->input->post("fecha")  ? $this->input->post("fecha")  : "";
        $data["fechas"]     = [];

        $hoy->setTimezone($timezone);
        if ($data['fecha'] === "") {
            $data['fecha'] = $hoy->format("Y-m-d");
        }
        for ($i = 1; $i <=7; $i++) {
            $data["fechas"][]= $hoy->format("Y-m-d");
            $hoy->modify("-1 day");
        }

        $limitToDia = new DateTime($data['fecha']);
        $limitToDia->setTimezone($timezone);
        $limitToDia->modify("+1 day");

        $wheres1 = [
            "fecha_actualizacion >=" => $data['fecha'],
            "fecha_actualizacion <"  => $limitToDia->format("Y-m-d"),
        ];

        $wheres2 = [
            "fecha_finalizado >=" => $data['fecha'],
            "fecha_finalizado <" => $limitToDia->format("Y-m-d"),
            "estado"             => "finalizado",
            "form"               => "encontrado"
        ];

        $wheres3 = ["estado" => "pendiente"];

        if ($data['server'] !== "0" ) {
            $wheres1["server"] = $data['server'];
            $wheres2["server"] = $data['server'];
            $wheres3["server"] = $data['server'];
        }



        $this->generic_model->setDb($data['dbName']);
        $data['total']      = $this->generic_model->countBy("tareas", $wheres1);
        $data['sended']     = $this->generic_model->countBy("tareas", $wheres2);
        $data['pendientes'] = $this->generic_model->countBy("tareas", $wheres3);
        $data['porc']       = $data['sended'] > 0 ? round(($data['sended'] * 100)/$data['total']) : 0;

        if ($data['showDetail']) {
            $whereTotal= ["estado" => ""];
            if ($data['server'] !== "0" ) {
                $whereTotal["server"] = $data['server'];
            }

            foreach ($estadosToCheck as $estado) {
                $wheres1["estado"]    = $estado;
                $whereTotal["estado"] = $estado;
                $detalle["name"]      = $estado;
                $detalle["fecha"]     = $data['fecha'];
                $detalle["totalDia"]  = $this->generic_model
                    ->countBy("tareas", $wheres1);

                $detalle["total"] = $this->generic_model
                    ->countBy("tareas", $whereTotal);
                $data["estados"][]   = $detalle;
            }
        }
        $this->__vista('dashBoardResume/index', $data);
    }

    public function pasarPendienteAjax()
    {
        $timezone   = new DateTimeZone(env("ZONE"));
        $actualTime = new DateTime();

        $this->generic_model->setDb($this->input->post("dbName"));

        $data = [
            "id_mensaje"          => 0,
            "estado"              => "pendiente",
            "url_formulario"      => "",
            "captcha"             => "pendiente",
            "form"                => "pendiente",
            "fecha_actualizacion" => "",
            "fecha_finalizado" => ""
        ];

        $wheres = [
            'fecha_actualizacion >='  => $this->input->post("fecha"),
            'server' => $this->input->post("server"),
            'estado' => $this->input->post("estado")
        ];

        if ($wheres['server'] === '0') {
            unset($wheres['server']);
        }

        if ($wheres['fecha_actualizacion >='] === '') {
            unset($wheres['fecha_actualizacion >=']);
        } else {
            $limitToDia = new DateTime($wheres['fecha_actualizacion >=']);
            $limitToDia->setTimezone($timezone);
            $limitToDia->modify("+1 day");
            $wheres['fecha_actualizacion <'] = $limitToDia->format("Y-m-d");
        }

        $update = $this->generic_model
            ->updateMultiple("tareas", $wheres, false, $data);
        echo json_encode(["action" => "success", "estado" => "pendiente"]);
    }

    public function emptyTableAjax()
    {
        $dbName = $this->input->post("dbName");
        $table  = $this->input->post("table");

        if ($dbName == null || $dbName == '') {
            $dbName = "default";
        }

        $this->generic_model->setDb($dbName);
        //$this->generic_model->truncate($table);
        $this->generic_model->delete($table, ["id >" => 0]);
        $this->generic_model->query("ALTER TABLE ".$table." AUTO_INCREMENT 1");
        $respuesta = ["action" => "success", "msg" => $table." truncated"];
        echo json_encode($respuesta);
    }

    public function pasarPendiente2Ajax()
    {
        $dbName  = $this->input->post("dbName");
        $server  = $this->input->post("server");
        $estados = $this->input->post("estados");

        if ($dbName == null || $dbName == '') {
            $dbName = "default";
        }
        $this->generic_model->setDb($dbName);

        if ($estados == null) {
            $estados = [];
        }

        $estados[] = "proceso";
        $estados[] = "trabajo";
        $estados[] = "finalizado";
        $estados[] = "error";
        $estados[] = "CAPTCHA_UNSOLVABLE";
        $estados[] = "CAPTCHA_ZERO_BALANCE";
        $estados[] = "CAPTCHA_UNSOLVABLE_TRY2";
        $estados[] = "standbye";

        $wheresIn  = ["estado" => $estados];

        $data = [
            "id_mensaje"          => 0,
            "estado"              => "pendiente",
            "server"              => $server,
            "url_formulario"      => "",
            "captcha"             => "pendiente",
            "form"                => "pendiente",
            "fecha_actualizacion" => "",
            "fecha_finalizado"    => ""
        ];

        $update = $this->generic_model
            ->updateMultiple("tareas", false, $wheresIn, $data);

        $respuesta = ["action" => "success", "msg" => "urls passed to 'pendiente'"];
        echo json_encode($respuesta);
    }

    public function countPendientesAjax()
    {
        $dbName   = $this->input->post("dbName");
        if ($dbName == null || $dbName == '') {
            $dbName = "default";
        }
        $this->generic_model->setDb($dbName);
        $pendientes = $this->generic_model
            ->countBy("tareas", ["estado" => "pendiente"]);

        $respuesta = [
            "action"     => "success",
            "pendientes" => $pendientes
            ];
        echo json_encode($respuesta);
    }

    public function asingPendienteByServerAjax()
    {
        $dbName = $this->input->post("dbName");
        $server = $this->input->post("server");
        $limit  = $this->input->post("limit");

        if ($dbName == null || $dbName == '') {
            $dbName = "default";
        }

        $this->generic_model->setDb($dbName);
        $where = [
            "estado" => "pendiente",
            "server" => 0
        ];
        $data = ["server" => $server];
        $update = $this->generic_model
            ->updateMultiple("tareas", $where, false, $data, $limit);

        $respuesta = ["action" => "success", "server" => $server];
        echo json_encode($respuesta);
    }
}
