<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AbrirPorta extends CI_Controller {

    function __construct() {
        parent:: __construct();
        //$this->load->model('Curso_model', 'CursoDAO');
    }

    public function autenticar() {
        $mensagem = "";
        $dados = null;
        $dados = file_get_contents('php://input');
        header('Content-Type: application/json');

        header('Content-Length: ' . 80);
        if (true) {
            $result = array('c' => 'a5e2y6', 'p' => 'Arley Oliveira da Mota');
            $result = json_encode($result);
            echo $result;
        } else {
            echo "Nenhum dado foi informado";
        }
    }

}
