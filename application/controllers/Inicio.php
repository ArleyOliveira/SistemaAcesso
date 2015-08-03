<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class inicio extends CI_Controller {

    public function index() {
        $this->load->view("login");
    }

    public function home() {
        $dados = array(
            'titulo' => 'Sistema de acesso - Home',
            'tela' => 'home/home',
        );
        $this->load->view("exibirDados", $dados);
    }

}
