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
        $this->load->model("Acesso_model", "AcessoDAO");
    }

    function cadastrar() {

        if ($this->session->tipo == 2) {
            $disciplinas = $this->DisciplinaDAO->get_all();
            $professores = $this->ProfessorDAO->get_all();
            if (isset($_POST['dados'])) {

                $dados = json_decode($_POST['dados']);

                $semestre = $this->buscarSemestrarAtual();

                for ($i = 0; $i < sizeof($dados); $i++) {
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
                $this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK) . ' Cadastro efetuado com sucesso!');

            }

            $dados = array(
                'professores' => $professores,
                'disciplinas' => $disciplinas,
                'titulo' => 'Sistema de acesso - Cadastrar Acesso',
                'tela' => 'gerenciador/acesso',
            );
            $this->load->view("exibirDados", $dados);
        } else {
            $this->session->set_flashdata('acessoinvalido', IconsUtil::getIcone(IconsUtil::ICON_ALERT) . ' Acesso negado!');
            redirect("gerenciador/consultar");
        }
    }

    private function enviar() {
        $dados = elements(array(''), $this->input->post());

        $this->Horariodao->do_insert($dados);

        $dados = array(
            'titulo' => 'Sistema de Acesso - Disciplina Consultar',
            'tela' => 'disciplina/consultar',
        );
        $this->load->view("exibirDados", $dados);
    }

    public function relatorio() {
        $acessos = $this->AcessoDAO->get_all();
        $dados = array(
            'titulo' => 'Sistema de Acesso - Obter relatório',
            'tela' => 'gerenciador/relatorio',
            'acessos' => $acessos,
        );
        $this->load->view("exibirDados", $dados);
    }

    public function cadastrarIdentificador() {
        if ($this->session->tipo == 2) {
            $this->form_validation->set_rules('professor', 'Professor', 'required|numeric');
            $this->form_validation->set_rules('identificador', 'Identificador', 'required');
            if ($this->form_validation->run() == TRUE):
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
        }else {
            $this->session->set_flashdata('acessoinvalido', IconsUtil::getIcone(IconsUtil::ICON_ALERT) . ' Acesso negado!');
            redirect("gerenciador/consultar");
        }
    }

    public function consultaIdentificador() {
        if (isset($_POST['codigo'])) {
            $query = $this->ProfessorDAO->get_byCodigo($_POST['codigo']);
            $identificador = NULL;
            if ($query != false) {
                foreach ($query as $professor):
                    $identificador = $professor->identificador;
                endforeach;
                echo $identificador;
            }
        }
    }

    public function excluirHorario() {
        if ($this->session->tipo != 2)
            redirect("gerenciador/consultar");
        else {
            $condicao = elements(array('codigo'), $this->input->post());
            $this->HorarioDAO->do_delete($condicao);
            $this->consultar();
        }
    }

    public function consultar() {
        $semestreLetivo = $this->buscarSemestrarAtual();
        $horarios = null;
        for($i = 1; $i <= 4; $i++){
            $horarios[$i] =  array('lab' => $i, 'horariosLab' => $this->HorarioDAO->get_PorLaboratorio($i, $semestreLetivo));
        }
        $dados = array(
            'headerHorario' => true,
            'horarios' => $horarios,
            'titulo' => 'Sistema de Acesso - Horários Consultar',
            'tela' => 'gerenciador/horarios'
        );
        
        $this->load->view("exibirDados", $dados);
    }

    public function editar() {
        if ($this->session->tipo == 2) {
            $semestreLetivo = $this->buscarSemestrarAtual();
            $horarios = null;
            for($i = 1; $i <= 4; $i++){
                $horarios[$i] =  array('lab' => $i, 'horariosLab' => $this->HorarioDAO->get_PorLaboratorio($i, $semestreLetivo));
            }
            $dados = array(
                'headerHorario' => true,
                'horarios' => $horarios,
                'titulo' => 'Sistema de Acesso - Horários Consultar',
                'tela' => 'gerenciador/horariosEditar',
            );
            $this->load->view("exibirDados", $dados);
        } else {
            $this->session->set_flashdata('acessoinvalido', IconsUtil::getIcone(IconsUtil::ICON_ALERT) . ' Acesso negado!');
            redirect("gerenciador/consultar");
        }
    }

    public function buscarSemestrarAtual() {
        $semestre = $this->SemestreDAO->get_SemestreAtual();
        $codigo = -1;
        foreach ($semestre->result() as $s) {
            $codigo = $s->codigo;
        }
        return $codigo;
    }

}
