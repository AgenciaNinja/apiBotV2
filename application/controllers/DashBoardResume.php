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
            "fecha_finalizado >=" => $data['fecha'],
            "fecha_finalizado <" => $limitToDia->format("Y-m-d"),
        ];

        $wheres2 = [
            "fecha_finalizado >=" => $data['fecha'],
            "fecha_finalizado <" => $limitToDia->format("Y-m-d"),
            "estado"             => "finalizado",
            "form"               => "encontrado"
        ];

        if ($data['server'] !== "0" ) {
            $wheres1["server"] = $data['server'];
            $wheres2["server"] = $data['server'];
        }

        $this->generic_model->setDb($data['dbName']);

        $data['total']  = $this->generic_model->countBy("tareas", $wheres1);
        $data['sended'] = $this->generic_model->countBy("tareas", $wheres2);
        $data['porc']   = $data['sended'] > 0 ? round(($data['sended'] * 100)/$data['total']) : 0;

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

    /*public function trabajo()
    {
        $this->db->save_queries = false;
        $tomorrow = new DateTime('+1 day');
        $conds = [
            'estado'          => 'finalizado',
            'fecha_inicio >=' => date("Y-m-d"),
            'fecha_inicio <'  => $tomorrow->format('Y-m-d'),
        ];
        $data['titlePag'] = 'Trabajo - Control';
        $data['trabajos'] = $this->trabajos_model
            ->getMultipleBy("*", $conds, false, "web", "web");
        //$data['pedientes']   = [];
        $this->__vista('frontend/trabajo', $data);
    }*/

    /*private function getEstructura()
    {
        $minutos = [];
        $horaIni = 6;
        $horaFin = 22;
        for ($i =  $horaIni; $i < $horaFin; $i++) {
            for ($ii =  0; $ii < 60; $ii++) {
                $minutos[($i < 10 ? "0".$i : $i).":".($ii < 10 ? "0".$ii : $ii)] = [
                    'desktop' => 0,
                    'mobile'  => 0,
                    'tablet'  => 0
                ];
            }
        }
        return $minutos;
    }*/

    /*public function dataVisitasAjax()
    {
        $web  = $this->input->post("web");
        $data = [
            'web'   => $web,
            'fecha' => date("d-M-Y")
        ];
        $next = new DateTime('+1 day');
        $conds= [
            'estado'          => 'finalizado',
            'web'             => $web,
            'fecha_inicio >=' => date("Y-m-d"),
            'fecha_inicio <'  => $next->format('Y-m-d')
        ];

        $trabajos = $this->trabajos_model
            ->getMultipleBy("id", $conds, false);
        if ($trabajos) {
            $ids = [];
            foreach ($trabajos as $trabajo) {
                $ids[] = $trabajo->id;
            }

            $visitas = $this->visitas_model->getVisitasByTrabajos($ids);
            if ($visitas) {
                $contadores =  $this->getEstructura();
                foreach ($visitas as $visita) {
                    $indice1 = trim(substr($visita->fecha, 10, 6));
                    $indice2 = $visita->dispositivo;

                    $contador  = $contadores[$indice1];
                    $contador[$indice2] = $contador[$indice2] +1 ;
                    $contadores[$indice1] = $contador;
                }
                // clasificar por dispositivo
                foreach ($contadores as $key  => $contador) {
                    $data['categorias'][] = $key;
                    $data['desktop'][]= $contador['desktop'];
                    $data['mobile'][] = $contador['mobile'];
                    $data['tablet'][] = $contador['tablet'];
                }
            }
        }
        echo json_encode($data);
    }*/

}
