<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cli extends CI_Controller
{
    public $editablesDomainRaw = [
        "estado"
    ];

    public $curlOpts = [
        CURLOPT_URL            => 'https://sender.prensamadrid.com/api/add_contact',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'POST',
        CURLOPT_POSTFIELDS     => array(
            'email'            => '',
            'id_listado'       => '20',
            'nombre'           => '',
            'Apellidos'        => '',
            'empresa'          => ''
        ),
        CURLOPT_HTTPHEADER => array(
            'token: xMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ',
            'Cookie: sender_email=sc2dcluorsgq0g0644mn88du91dnjf7s'
        ),
    ];

    public function procesarDomainRaw($dbName = "default")
    {
        $this->generic_model->setDb($dbName);
        $ciclo = true;
        while ($ciclo) {
            $this->db->save_queries = false;
            //$server     = 0;
            $wheres     = ["estado" => "pendiente"];
            $domainRaws = $this->generic_model
                ->getMultipleBy("domain_raw", "*", $wheres, false, false, 1000);
            if (count($domainRaws) > 0) {
                foreach ($domainRaws as $domainRaw) {
                    $wheres   = ["domain" => $domainRaw->domain];
                    $count1   = $this->generic_model->countBy("tareas", $wheres);
                    $count2   = $this->generic_model->countBy("manuales_excluir", $wheres);
                    if (($count1 === 0) && ($count2 === 0)) {
                        $tarea = [
                            'id_trabajo' => 1,
                            'id_mensaje' => 0,
                            'server'     => rand(1, 12),
                            'url'        => "http://".$domainRaw->domain."/",
                            'domain'     => $domainRaw->domain
                        ];
                        $id = $this->generic_model->insert('tareas', $tarea);
                        if ($id > 0) {
                            $data = ["estado" => "agregado"];
                        }
                    } else {
                        $data = ["estado" => "ya existe"];
                    }
                    $this->generic_model
                        ->update("domain_raw", $domainRaw->id, $data, $this->editablesDomainRaw);
                }
            } else {
                $ciclo = false;
            }
        }
    }

    public function sendEmails($dbName = "default")
    {
        $this->generic_model->setDb($dbName);
        $ciclo = true;
        while ($ciclo) {
            $this->db->save_queries = false;
            $wheres = ["tipo" => "correo","enviado" => "pendiente"];
            $emails = $this->generic_model
                ->getMultipleBy("informacion_contacto", "*", $wheres, false, false, 100);
            foreach ($emails as $email) {
                echo $email->valor.PHP_EOL;
                $this->curlOpts['CURLOPT_POSTFIELDS']['email'] = $email->valor;
                $curl = curl_init();
                curl_setopt_array($curl, $curlOpts);
                $r       = curl_exec($curl);
                $resp    = json_decode($r);
                $updated = ["enviado" => "error"];
                if ($resp->status === 'success') {
                    $updated = ["enviado" => "finalizado"];
                }
                $this->generic_model->update("informacion_contacto", $email->id, $updated);
                $this->curlOpts['CURLOPT_POSTFIELDS']['email'] = '';
                curl_close($curl);
            }
            sleep(15);
        }
    }
}