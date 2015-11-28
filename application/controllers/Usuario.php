<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('array');
        //$this->load->library('session');
        $this->load->model('Usuario_model', 'UsuarioDAO');
        $this->load->library('table');
    }

    public function cadastrar() {
        //Validação do formulario
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]|ucwords');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|max_length[50]|strtolower|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required');
        $this->form_validation->set_rules('datanasc', 'Data de Nascimento', 'trim|required');
        $this->form_validation->set_message('matches', 'O campo %s não corresponde com o campo %s');
        $this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|matches[senha]');


        if ($this->form_validation->run() == TRUE):
            $dados = elements(array('nome', 'datanasc', 'sexo', 'email', 'senha'), $this->input->post());
            $dados['senha'] = md5($dados['senha']);
            $imagem = $dados['nome'];
            $imagem = $imagem[0];

            $this->UsuarioDAO->do_insert($dados);
            echo "Validação ok, inserir no bd";

        endif;

        $dados = array(
            'titulo' => 'Sistema de acesso - Cadastrar Usuario',
            'tela' => 'usuario/cadastrar',
        );
        $this->load->view("exibirDados", $dados);
    }

    public function login() {
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|max_length[50]|strtolower|valid_email');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|strtolower');
        $this->form_validation->set_rules('tipo', 'Tipo de acesso', 'required|numeric');
        if ($this->form_validation->run() == TRUE) {
            
            $dados = elements(array('email', 'senha', 'tipo'), $this->input->post());
            $dados['senha'] = md5($dados['senha']);
            $tipo = 0;
            if($dados['tipo'] == 2):
               $usuario = $this->UsuarioDAO->get_byEmail_Admin($dados['email'], $dados['senha']);
                $tipo = 2;
            else:
               $usuario = $this->UsuarioDAO->get_byEmail_Professor($dados['email'], $dados['senha']);
                $tipo = 1;
            endif;
            if ($usuario != false):
                foreach ($usuario->result() as $linha):
                    $nome = $linha->nome;
                    $email = $linha->email;
                    $permissao = $linha->permissao;
                endforeach;
                $novousuario = array(
                    'nome' => $nome,
                    'email' => $email,
                    'permissao'=> $permissao,
                    'tipo' => $tipo,
                    'esta_logado' => TRUE,
                );
                $this->session->set_userdata($novousuario);
                redirect('inicio/home');
            else:
                $this->session->set_flashdata('usuarioinvalido', 'Email ou senha invalido. Tente novamente!');
                //redirect('/');
            endif;
        }else {
            if(isset($_POST['email']) || isset($_POST['senha']) || isset($_POST['tipo']))
               $this->session->set_flashdata('usuarioinvalido', 'Os campos não foram preenchidos corretamente ou podem está vazios!');
        
        }
        $this->load->view("login");
    }

    public function update() {
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]|ucwords');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required');
        $this->form_validation->set_rules('datanasc', 'Data de Nascimento', 'trim|required');
       
        if ($this->form_validation->run() == TRUE):
            $dados = elements(array('nome', 'datanasc', 'sexo'), $this->input->post());
            $this->UsuarioDAO->do_update($dados, array('email' => $this->session->email));
        endif;

        $dados = array(
            'titulo' => 'Sistema de Acesso - Update',
            'tela' => 'usuario/ferramentas',
            'active' => 'perfil',
        );
        $this->load->view("exibirDados", $dados);
    }

    public function updatepassword() {
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required');
        $this->form_validation->set_message('matches', 'O campo %s não corresponde com o campo %s');
        $this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|matches[senha]');
       
        if ($this->form_validation->run() == TRUE):
            $dados = elements(array('senha'), $this->input->post());
            $dados['senha'] = md5($dados['senha']);
            $this->UsuarioDAO->do_updatepassword($dados, array('email' => $this->session->email));
        endif;

        $dados = array(
            'titulo' => 'Sistema de Acesso - Update',
            'tela' => 'usuario/ferramentas',
            'active' => 'senha',
        );
        $this->load->view("exibirDados", $dados);
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect('inicio/');
    }

   public function ferramentas(){
       
       $dados = array(
            'titulo' => 'Sistema de Acesso - Ferramentas',
            'tela' => 'usuario/ferramentas',
            'active' => 'perfil',
        );
        $this->load->view("exibirDados", $dados);
   }
}
