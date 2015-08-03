<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Disciplina extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('array');
        //$this->load->library('session');
        $this->load->library('table');
        $this->load->model('Disciplina_model', 'DisciplinaDAO');
        $this->load->model('Curso_model', 'CursoDAO');
    }
    
    public function cadastrar() {
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('curso', 'Curso', 'trim|required|max_length[100]|strtolower');
        
        if($this->form_validation->run() == TRUE):
            $dados = elements(array('nome', 'curso'), $this->input->post());
            $this->DisciplinaDAO->do_insert($dados);
        endif;
        
        $cursos = $this->CursoDAO->get_all();
        
        $dados = array(
            'titulo' => 'Sistema de Acesso - Cadastrar Disciplina',
            'tela' => 'disciplina/cadastrar',
            'cursos' => $cursos,
        );
        $this->load->view("exibirDados", $dados);
    }
    public function consultar(){
        $disciplinas = $this->DisciplinaDAO->get_all();
        $dados = array(
            'titulo' => 'Sistema de Acesso - Consultar Disciplina',
            'tela' => 'disciplina/consultar',
            'disciplinas' => $disciplinas,
        );
        $this->load->view("exibirDados", $dados);
    }
    public function editar(){
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('curso', 'Curso', 'trim|required|max_length[100]|strtolower');
        
        if($this->form_validation->run() == TRUE):
            $dados = elements(array('nome', 'curso'), $this->input->post());
            $condicao = elements(array('codigo'), $this->input->post());
            $this->DisciplinaDAO->do_update($dados, $condicao);
        endif;
        
        $dados = array(
            'titulo' => 'Sistema de Acesso - Disciplina Editar',
            'tela' => 'disciplina/editar',
        );
        $this->load->view("exibirDados", $dados);
    }
    
    public function excluir(){
        $condicao = elements(array('codigo'), $this->input->post());
        $this->DisciplinaDAO->do_delete($condicao);
        $dados = array(
            'titulo' => 'Sistema de Acesso - Disciplina Consultar',
            'tela' => 'disciplina/consultar',
        );
        $this->load->view("exibirDados", $dados);
    }
}
