<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Semestre extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('array');
        //$this->load->library('session');
        $this->load->library('table');
        $this->load->model("Semestre_model", "SemestreDAO");

    }
    
    public function cadastrar() {
        $this->form_validation->set_rules('ano', 'Ano', 'trim|required|numeric');
        $this->form_validation->set_rules('semestre', 'Semestre', 'trim|required|numeric');
        
        if($this->form_validation->run() == TRUE):
            if(!$this->SemestreDAO->verificaAnoSemestre($this->input->post('ano'), $this->input->post('semestre'))):
                $dados = elements(array('ano', 'semestre'), $this->input->post());
                $this->SemestreDAO->do_insert($dados);
            else:
                $this->session->set_flashdata('alerta', IconsUtil::getIcone(IconsUtil::ICON_ALERT) .' <strong> Atenção ! </strong> este semestre já foi cadastrado anteriormente.');
            endif;
        endif;
        
        $dados = array(
            'titulo' => 'Sistema de Acesso - Cadastrar Semestre',
            'tela' => 'semestre/cadastrar',
        );
        $this->load->view("exibirDados", $dados);
    }
    
    public function consultar() {
        $cursos = $this->CursoDAO->get_all();
        $dados = array(
            'cursos' => $cursos,
            'titulo' => 'Sistema de Acesso - Consultar Semestre',
            'tela' => 'semestre/consultar',
        );
        $this->load->view("exibirDados", $dados);
    }
   
    
}

