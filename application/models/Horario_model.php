<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Horario_model extends CI_Model{
 	
	public function do_insert($dados=NULL){
		
		if($dados != NULL):
			$this->db->insert('horario', $dados);
			//$this->session->set_flashdata('cadastrook', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Cadastro efetuado com sucesso!');
			//redirect('gerenciador/cadastrar');
		endif;
	}

	public function get_all(){
		return $this->db->get('horario');
	}
	
       
        public function get_PorLaboratorio($lab = NULL, $semestreLetivo = NULL) {
        if ($lab != NULL && $semestreLetivo != NULL):
            $segunda = null;
            $terca = null;
            $quarta = null;
            $quinta = null;
            $sexta = null;
            $sabado = null;
            $sql = "SELECT h.codigo, d.nome as disciplina, TIME_FORMAT(inicio, '%H:%i') as inicio, TIME_FORMAT(fim, '%H:%i') as fim FROM horario h join disciplina d on h.disciplina = d.codigo where lab = ? and semestreletivo = ? and dia = ? order by inicio";

            $query = $this->db->query($sql, array($lab, $semestreLetivo, 2));
            $x = 0;
            foreach ($query->result() as $horario) {
               $segunda[$x] = array('codigo' => $horario->codigo,'disciplina' => $horario->disciplina, 'inicio' => $horario->inicio, 'fim' => $horario->fim);
               $x++;
            }


            //echo "passou aki";
            $query = $this->db->query($sql, array($lab, $semestreLetivo, 3));
            $x = 0;
            foreach ($query->result() as $horario) {
               $terca[$x] = array('codigo' => $horario->codigo, 'disciplina' => $horario->disciplina, 'inicio' => $horario->inicio, 'fim' => $horario->fim);
               $x++;
            }

            $query = $this->db->query($sql, array($lab, $semestreLetivo, 4));
            $x = 0;
            foreach ($query->result() as $horario) {
               $quarta[$x] = array('codigo' => $horario->codigo, 'disciplina' => $horario->disciplina, 'inicio' => $horario->inicio, 'fim' => $horario->fim);
               $x++;
            }

            $query = $this->db->query($sql, array($lab, $semestreLetivo, 5));
            $x = 0;
            foreach ($query->result() as $horario) {
               $quinta[$x] = array('codigo' => $horario->codigo, 'disciplina' => $horario->disciplina, 'inicio' => $horario->inicio, 'fim' => $horario->fim);
               $x++;
            }

            $query = $this->db->query($sql, array($lab, $semestreLetivo, 6));
            $x = 0;
            foreach ($query->result() as $horario) {
               $sexta[$x] = array('codigo' => $horario->codigo, 'disciplina' => $horario->disciplina, 'inicio' => $horario->inicio, 'fim' => $horario->fim);
               $x++;
            }

            $query = $this->db->query($sql, array($lab, $semestreLetivo, 7));
            $x = 0;
            foreach ($query->result() as $horario) {
               $sabado[$x] = array('codigo' => $horario->codigo, 'disciplina' => $horario->disciplina, 'inicio' => $horario->inicio, 'fim' => $horario->fim);
               $x++;
            }

                $horariosLab = array(
                    'segunda' => $segunda,
                    'terca' => $terca,
                    'quarta' => $quarta,
                    'quinta' => $quinta,
                    'sexta' => $sexta,
                    'sabado' => $sabado,
                );
                return $horariosLab;
 
        else:
            return false;

        endif;
    }
    
    public function do_delete($condicao = NULL){
        if($condicao != NULL):
                $this->db->delete('horario', $condicao);
                $this->session->set_flashdata('excluirok', IconsUtil::getIcone(IconsUtil::ICON_OK) .' Registro deletado com sucesso!');
        endif;
    }
	
}
