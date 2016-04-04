<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AbrirPorta extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Professor_model', 'ProfessorDAO');
        $this->load->model('Acesso_model', 'AcessoDAO');
    }

    public function autenticar() {
        $result = null;
        $dados = null;
        $dados = file_get_contents('php://input');
        header('Content-Type: application/json');

        header('Content-Length: ' . 80);

        //$dados = array("laboratorio" => "1", "identificador" => "10 BD CD DC");
        //$dados = json_encode($dados);
        
        if ($dados != null) {
            $dados = json_decode($dados);
            $usuario = $this->ProfessorDAO->get_byIdentificador("$dados->identificador");
            $professor = null;
            if ($usuario != false){
                
                foreach ($usuario->result() as $linha):
                    $professor = $linha;
                endforeach;
                $acesso = array("professor" => $professor->codigo, "laboratorio" => $dados->laboratorio);
                
                $this->AcessoDAO->do_insert($acesso);
                
                $result = array('c' => 'a5e2y6', 'p' => $professor->nome);
            }else{
                $result = array('c' => '00000000', 'p' => "Usuario invalido!");
            }
            
            $result = json_encode($result);
            echo($result);
        } else {
            echo "Nenhum dado foi informado";
        }
    }

}
