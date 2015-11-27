<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gerenciador extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('array');
        $this->load->library('table');
        $this->load->model('Disciplina_model', 'DisciplinaDAO');
        $this->load->model('Professor_model', 'ProfessorDAO');
        $this->load->model('Horario_model', 'HorarioDAO');
        $this->load->model("Semestre_model", "SemestreDAO");
    }   
    
    function cadastrar(){
        
        /*$this->form_validation->set_rules('disciplina', 'Disciplina', 'required');
        $this->form_validation->set_rules('professor', 'Professor', 'required');
        $this->form_validation->set_rules('dia', 'Dia', 'required');
        $this->form_validation->set_rules('lab', 'Laboratório', 'required');
        $this->form_validation->set_rules('inicio', 'Inicio', 'required');
        $this->form_validation->set_rules('fim', 'Fim', 'required');*/
        
        $disciplinas = $this->DisciplinaDAO->get_all();
        $professores = $this->ProfessorDAO->get_all();
        if(isset($_POST['dados'])) {
            
            $dados = json_decode($_POST['dados']);
            
            $semestre = $this->buscarSemestrarAtual();
            
            for($i=0; $i < sizeof($dados); $i++){
                $lab = $dados[$i][1];
                $dia = $dados[$i][0];
                $inicio = $dados[$i][2];
                $fim = $dados[$i][3];
                $disciplina = $dados[$i][4];
                $professor = $dados[$i][5];
                $horario = array(
                    'disciplina' => $disciplina,
                    'professor' => $professor,
                    'dia' => $dia,
                    'lab' => $lab,
                    'inicio' => $inicio,
                    'fim' => $fim,
                    'semestreletivo' => $semestre,
                );
                $this->HorarioDAO->do_insert($horario);
            }
            $this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Cadastro efetuado com sucesso!');
           
            //echo 'Cadastro efetuado com sucesso';
            //echo $dados[0][0] . '-' . $dados[0][1] . '-' . $dados[0][2] . '-' . $dados[0][3] . '-' . $dados[0][4] . '-' . $dados[0][5] . '-' . sizeof($dados) . '-' . $semestre; 
        } 
        
        $dados = array(
            'professores' => $professores,
            'disciplinas' => $disciplinas,
            'titulo' => 'Sistema de acesso - Cadastrar Acesso',
            'tela' => 'gerenciador/acesso',
        );
        $this->load->view("exibirDados", $dados);
    }
    
    public function enviar(){
        $dados = elements(array(''), $this->input->post());
        
        $this->Horariodao->do_insert($dados);

        $dados = array(
            'titulo' => 'Sistema de Acesso - Disciplina Consultar',
            'tela' => 'disciplina/consultar',
        );
        $this->load->view("exibirDados", $dados);
    }
    
    public function relatorio(){
        
        $dados = array(
            'titulo' => 'Sistema de Acesso - Obter relatório',
            'tela' => 'gerenciador/relatorio',
        );
        $this->load->view("exibirDados", $dados);
    }
    
    public function cadastrarIdentificador(){
        $this->form_validation->set_rules('professor', 'Professor', 'required|numeric');
        $this->form_validation->set_rules('identificador', 'Identificador', 'required');
        if($this->form_validation->run() == TRUE):
            $condicao = array('codigo' => $this->input->post("professor"));
            $dados = array('identificador' => $this->input->post("identificador"));            
            $this->ProfessorDAO->do_updateIdentificador($dados, $condicao);
        endif;
        $professores = $this->ProfessorDAO->get_all()->result();
        $dados = array(
            'professores' => $professores,
            'titulo' => 'Sistema de Acesso - Cadastrar Identificador',
            'tela' => 'gerenciador/cadastrarIdentificador',
        );
        $this->load->view("exibirDados", $dados);
    }
    
    public function consultaIdentificador(){
        if(isset($_POST['codigo'])) {
            $query = $this->ProfessorDAO->get_byCodigo($_POST['codigo']);
            $identificador = NULL;
            if($query != false){
                foreach ($query as $professor):
                    $identificador = $professor->identificador;
                endforeach;
                echo $identificador;
            }
        }
    }
    
    public function consultar(){
       $semestreLetivo = $this->buscarSemestrarAtual();
       $lab1 = $this->HorarioDAO->get_PorLaboratorio(1, $semestreLetivo);
       $lab2 = $this->HorarioDAO->get_PorLaboratorio(2, $semestreLetivo);
       $lab3 = $this->HorarioDAO->get_PorLaboratorio(3, $semestreLetivo);
       $lab4 = $this->HorarioDAO->get_PorLaboratorio(4, $semestreLetivo);
       $dados = array(
            'headerHorario' => true,
            'lab1' => $lab1,
            'lab2' => $lab2,
            'lab3' => $lab3,
            'lab4' => $lab4,
            'titulo' => 'Sistema de Acesso - Horários Consultar',
            'tela' => 'gerenciador/horarios',
        );
        $this->load->view("exibirDados", $dados);
    }

    public function buscarSemestrarAtual(){
        $semestre = $this->SemestreDAO->get_SemestreAtual();
        $codigo = -1;
        foreach ($semestre->result() as $s) {
            $codigo = $s->codigo;
        }
        
        return $codigo;
    }
}

