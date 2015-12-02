<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Professor extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('array');
        //$this->load->library('session');
        $this->load->model('Professor_model', 'ProfessorDAO');
        $this->load->model('Usuario_model', 'UsuarioDAO');
        $this->load->library('table');
    }

    public function cadastrar() {
        //Validação do formulario
        if($this->session->tipo == 2){
            $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]|ucwords');
            $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|max_length[11]|strtolower|is_unique[professor.cpf]');
            $this->form_validation->set_rules('siape', 'SIAPE', 'trim|required|numeric|is_unique[professor.siape]');
            $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|max_length[50]|strtolower|valid_email|is_unique[professor.email]|is_unique[usuario.email]');
            $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|strtolower');
            $this->form_validation->set_rules('sexo', 'Sexo', 'required');
            $this->form_validation->set_rules('datanasc', 'Data de Nascimento', 'trim|required');
            $this->form_validation->set_message('matches', 'O campo %s não corresponde com o campo %s');
            $this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|strtolower|matches[senha]');


            if ($this->form_validation->run() == TRUE):
                $dados = elements(array('nome','siape', 'cpf', 'datanasc', 'sexo', 'email', 'senha'), $this->input->post());
                $dados['senha'] = md5($dados['senha']);

                $this->ProfessorDAO->do_insert($dados);
                echo "Validação ok, inserir no bd";

            endif;

            $dados = array(
                'titulo' => 'Sistema de acesso - Cadastrar Professor',
                'tela' => 'professor/cadastrar',
            );
            $this->load->view("exibirDados", $dados);
        }else{
            redirect("gerenciador/consultar");
        }
    }

    public function login() {
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|max_length[50]|strtolower|valid_email');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|strtolower');

        if ($this->form_validation->run() == TRUE) {
            $dados = elements(array('email', 'senha'), $this->input->post());
            $dados['senha'] = md5($dados['senha']);

            $usuario = $this->UsuarioDAO->get_byEmail($dados['email'], $dados['senha']);

            if ($usuario != false):
                foreach ($usuario->result() as $linha):
                    $nome = $linha->nome;
                    $email = $linha->email;
                endforeach;
                $novousuario = array(
                    'nome' => $nome,
                    'email' => $email,
                    'esta_logado' => TRUE,
                );
                $this->session->set_userdata($novousuario);
                redirect('gerenciador/entrada');
            else:
                $this->session->set_flashdata('usuarioinvalido', 'Email ou senha invalido. Tente novamente!');
                redirect('/');
            endif;
        }else {
            $this->session->set_flashdata('usuarioinvalido', 'Os campos não foram preenchidos corretamente ou podem está vazios!');
            redirect('/');
        }
    }
    public function consultar(){
        
        $professores = $this->ProfessorDAO->get_all();
        $dados = array(
            'professores' => $professores,
            'titulo' => 'Sistema de acesso - Consultar Professor',
            'tela' => 'professor/consultar',
        );
        $this->load->view("exibirDados", $dados);
    }

    
    public function update() {
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]|ucwords');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|max_length[11]|strtolower');
        $this->form_validation->set_rules('siape', 'SIAPE', 'trim|required|numeric');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required');
        $this->form_validation->set_rules('datanasc', 'Data de Nascimento', 'trim|required');
       
        if ($this->form_validation->run() == TRUE):
            $dados = elements(array('nome','siape' ,'cpf', 'datanasc', 'sexo'), $this->input->post());
            $this->session->sexo = $dados['sexo'];
            $this->ProfessorDAO->do_update($dados, array('email' => $this->session->email));
        endif;

        $dados = array(
            'titulo' => 'Sistema de Acesso - Update',
            'tela' => 'usuario/ferramentas',
            'active' => 'perfil',
        );
        $this->load->view("exibirDados", $dados);
    }
}
