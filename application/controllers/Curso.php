<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curso extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('array');
        //$this->load->library('session');
        $this->load->library('table');
        $this->load->model('Curso_model', 'CursoDAO');
    }
    
    public function cadastrar() {
        if($this->session->tipo == 2){//Verifica de é administrador
            $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('area', 'Área do conhecimento', 'trim|required|max_length[100]');

            if($this->form_validation->run() == TRUE):
                $dados = elements(array('nome', 'area'), $this->input->post());
                $this->CursoDAO->do_insert($dados);
            endif;

            $dados = array(
                'titulo' => 'Sistema de Acesso - Cadastrar Curso',
                'tela' => 'curso/cadastrar',
            );
            $this->load->view("exibirDados", $dados);
        }else{
            $this->session->set_flashdata('acessoinvalido', IconsUtil::getIcone(IconsUtil::ICON_ALERT) .' Acesso negado!');
            redirect("curso/consultar");
        }
    }

    public function consultar() {
        $cursos = $this->CursoDAO->get_all();
        $dados = array(
            'cursos' => $cursos,
            'titulo' => 'Sistema de Acesso - Consultar Curso',
            'tela' => 'curso/consultar',
        );
        $this->load->view("exibirDados", $dados);
    }
    
    public function excluir(){
        if($this->session->tipo == 2){//Verifica de é administrador
            $this->form_validation->set_rules('codigo', 'Código', 'required');

            if($this->form_validation->run() == TRUE):
                $condicao = elements(array('codigo'), $this->input->post());
                $dados = array('f' => 0);
                $this->CursoDAO->do_delete($dados, $condicao);
            endif;

            $cursos = $this->CursoDAO->get_all();
            $dados = array(
                'cursos' => $cursos,
                'titulo' => 'Sistema de Acesso - Consultar Curso',
                'tela' => 'curso/consultar',
            );
            $this->load->view("exibirDados", $dados);
        }else{
            $this->session->set_flashdata('acessoinvalido', IconsUtil::getIcone(IconsUtil::ICON_ALERT) .' Acesso negado!');
            redirect("curso/consultar");
        }
    }


    public function editar(){
        if($this->session->tipo == 2){//Verifica de é administrador
            $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('area', 'Área do conhecimento', 'trim|required|max_length[100]');

            if($this->form_validation->run() == TRUE):
                $dados = elements(array('nome', 'area'), $this->input->post());
                $condicao = elements(array('codigo'), $this->input->post());
                $this->CursoDAO->do_update($dados, $condicao);
            endif;

            $dados = array(
                'titulo' => 'Sistema de Acesso - Cadastrar Editar',
                'tela' => 'curso/editar',
            );
            $this->load->view("exibirDados", $dados);
        }else{
            $this->session->set_flashdata('acessoinvalido', IconsUtil::getIcone(IconsUtil::ICON_ALERT) .' Acesso negado!');
            redirect("curso/consultar");
        }
    }
}

