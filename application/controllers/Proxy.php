<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Proxy extends RestController
{
    public $methods = [
        //"tareas",
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

    public function random_get($dbName = 'default')
    {
        $this->generic_model->setDb($dbName);
        $select = 'CONCAT("--proxy-server=",ip_domain,":",port) as proxy, ip_domain as ip, user, pass';
        $proxy = $this->generic_model
            ->getOneBy('proxy', $select, ['active' => 1], false, false, 'rand()');
        $this->response(
            [
                'status' => true,
                'data'   => $proxy,
            ], 200
        );
    }
}